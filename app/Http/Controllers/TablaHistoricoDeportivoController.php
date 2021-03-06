<?php

namespace App\Http\Controllers;

use App\Models\historicos_deportivos;
use App\Models\asistencias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\grupo_alumnos;
use App\Models\alumnos;
use App\Models\entrenadores;
use App\Models\Grupos;
use DB;
use Illuminate\Support\Facades\Auth;

class TablaHistoricoDeportivoController extends Controller
{


    public function __construct()
    {
        $this->middleware('entrena');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $id = Auth::id();
        $nombrealumno=$request->get('buscarpor');
    

        //$historicos_deportivos = historicos_deportivos::all();
        if (Auth::user()->role == 'Administrador') {
            $alumnos =DB::table('grupo_alumnos')
            ->join('alumnos','alumnos.id', '=','grupo_alumnos.alumnos_id')
            ->join('grupos','grupos.id', '=','grupo_alumnos.grupos_id')
            ->where('grupo_alumnos.estado','=', 'Activo')
            ->where('grupos.estado', '=', 'Activo')
            ->select('grupo_alumnos.id as idgrupo_al','alumnos.*','grupos.*')
            ->get();
        }
        if (Auth::user()->role == 'Entrenador') {
            $alumnos =DB::table('grupo_alumnos')
            ->join('alumnos','alumnos.id', '=','grupo_alumnos.alumnos_id')
            ->join('grupos','grupos.id', '=','grupo_alumnos.grupos_id')
            ->where('alumnos.alta_usuario', '=', $id)
            ->where('grupo_alumnos.estado','=', 'Activo')
            ->where('grupos.estado', '=', 'Activo')
            ->select('grupo_alumnos.id as idgrupo_al','alumnos.*','grupos.*')
            ->get();
        } 
        
        $historicos_deportivos2 =DB::table('historicos_deportivos')
        ->join('alumnos','alumnos.id', '=','historicos_deportivos.alumnos_id')
        ->where('historicos_deportivos.relacion_grupo_alumnos', '=', $nombrealumno)
        ->select('historicos_deportivos.*','alumnos.nombres','alumnos.apellido_paterno','alumnos.apellido_materno')
        ->get();

        //Se obtiene el nombre del alumno, por la el id del grupo_alumno($nombrealumno)
        $nombrecompleto =DB::table('grupo_alumnos')
        ->join('alumnos','alumnos.id', '=','grupo_alumnos.alumnos_id')
        ->where('grupo_alumnos.id', '=', $nombrealumno)
        ->select('alumnos.*')
        ->get();

////////////////////////////////////////////////////
//Se obtiene el id del alumno, para posteriormente sumar las evaluaciones de sus secciones y mostrarlos

//Se obtiene el id del grupo, atraves del id del grupo_alumno
$datosgrupo_alumnos =DB::table('grupo_alumnos')
->where('grupo_alumnos.grupos_id', '=', $nombrealumno)
->select('grupo_alumnos.*')
->get(array('grupos_id'));

$nombregrupo = 0;
      foreach ($datosgrupo_alumnos as $datogrupo_alumno) {
      $nombregrupo = $datogrupo_alumno->grupos_id;
      }

 //Obtener el valor maximo de los entrenamientos, en la tabla de grupo
 $datosgrupos =DB::table('grupos')
 ->where('grupos.id', '=', $nombregrupo)
 ->select('grupos.evaluaciones_maximo')
 ->get(array('evaluaciones_maximo'));

 $valormaximo = 0;
       foreach ($datosgrupos as $valor) {
       $valormaximo = $valor->evaluaciones_maximo;
       }

//Se realiza el conteo y suma de secciones

$datosalumnos =DB::table('grupo_alumnos')
        ->join('grupos','grupos.id', '=','grupo_alumnos.grupos_id')
        ->where('grupo_alumnos.grupos_id', '=', $nombregrupo)
        ->select('grupo_alumnos.id as idalumnos')
        ->get(array('idalumnos'));

        //$valorb representa el id del grupo_alumnos
        $valorb = '';
        
        foreach ($datosalumnos as $a) {
            $valorb = $a->idalumnos;

            $total_liderazgo=0;
            $total_manejobalon=0;
            $total_pases=0;
            $total_pies=0;
            $total_lanzamiento=0;
            $total_defensa=0;

            $contador_evaluaciones = DB::table('historicos_deportivos')
           ->join('grupo_alumnos','grupo_alumnos.id', '=','historicos_deportivos.relacion_grupo_alumnos')
           ->where('historicos_deportivos.relacion_grupo_alumnos', '=', $valorb)
           ->get(array('seccionliderazgo','seccionmanejobalon','seccionpases','seccionpies','seccionlanzamiento','secciondefensa'));

           foreach($contador_evaluaciones as $contador) {
                $total_liderazgo=$total_liderazgo+$contador->seccionliderazgo;
                $total_manejobalon=$total_manejobalon+$contador->seccionmanejobalon;
                $total_pases=$total_pases+$contador->seccionpases;
                $total_pies=$total_pies+$contador->seccionpies;
                $total_lanzamiento=$total_lanzamiento+$contador->seccionlanzamiento;
                $total_defensa=$total_defensa+$contador->secciondefensa;
            }


            if ($valormaximo==0) {
                $resultado=0;
                $resultadobalon=0;
                $resultadopases=0;
                $resultadopies=0;
                $resultadolanzamiento=0;
                $resultadodefensa=0;
            } else {
                $resultado=(100/($valormaximo*36))*$total_liderazgo;
                $resultadobalon=(100/($valormaximo*16))*$total_manejobalon;
                $resultadopases=(100/($valormaximo*16))*$total_pases;
                $resultadopies=(100/($valormaximo*8))*$total_pies;
                $resultadolanzamiento=(100/($valormaximo*16))*$total_lanzamiento;
                $resultadodefensa=(100/($valormaximo*16))*$total_defensa;
            }
            
            

//Obtener los ids de los alumnos en el grupo
$datosalumnos =DB::table('grupo_alumnos')
        ->join('grupos','grupos.id', '=','grupo_alumnos.grupos_id')
        ->where('grupo_alumnos.grupos_id', '=', $nombregrupo)
        ->select('grupo_alumnos.id as idalumnos')
        ->get(array('idalumnos'));

        $valorb = '';
        

        foreach ($datosalumnos as $a) {
           $valorb = $a->idalumnos;
           $totalvalorporcentajes=0;

           $contador_evaluaciones = DB::table('historicos_deportivos')
           ->join('grupo_alumnos','grupo_alumnos.id', '=','historicos_deportivos.relacion_grupo_alumnos')
           ->where('historicos_deportivos.relacion_grupo_alumnos', '=', $valorb)
           ->get(array('total_historico'));

           foreach($contador_evaluaciones as $contador) {
            $totalvalorporcentajes=$totalvalorporcentajes+$contador->total_historico;

            }

          
           if ($valormaximo==0) {
            $resultado=0;
           } else {
            $resultado=(100/($valormaximo*100))*$totalvalorporcentajes;
           }
           
           $datosGrupoAlumno=[
            
              'calificacion_entrenamiento'=>round($resultado),
          ];
           grupo_alumnos::where('id','=',$valorb)->update($datosGrupoAlumno);

        }

    

            $datosGrupoAlumno=[
               'total_liderazgo'=>round($resultado),
               'total_manejobalon'=>round($resultadobalon),
               'total_pases'=>round($resultadopases),
               'total_pies'=>round($resultadopies),
               'total_lanzamiento'=>round($resultadolanzamiento),
               'total_defensa'=>round($resultadodefensa),
              
           ];
            grupo_alumnos::where('id','=',$valorb)->update($datosGrupoAlumno);
        }
     
//Se envia a la vista los datos para su visualizacion

$alumnoestadisticas =DB::table('grupo_alumnos')
->join('grupos','grupos.id', '=','grupo_alumnos.grupos_id')
->where('grupo_alumnos.id', '=', $nombrealumno)
->where('grupos.estado', '=', 'Activo')
->where('grupo_alumnos.estado', '=', 'Activo')
->select('grupo_alumnos.*')
->get();


////////////////////////////////////////////////////
        return view('tabladeportiva.indextabladeportiva')->with('alumnos',$alumnos)
        ->with('alumnoestadisticas',$alumnoestadisticas)
        ->with('nombrecompleto',$nombrecompleto)
        ->with('historicos_deportivos2',$historicos_deportivos2);
    }

  
}
