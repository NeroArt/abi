<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use App\Models\tutores;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\AlumnosPivote;
use DB;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AlumnosController extends Controller
{


    public function __construct()
    {
        $this->middleware('entrena');
    }


    public function index()
    {


        $id = Auth::id();

        if (Auth::user()->role == 'Administrador') {
            $datos['formalumno']=alumnos::paginate(30);
        }
        if (Auth::user()->role == 'Entrenador') {
            $datos['formalumno']=DB::table('alumnos')
            ->where('alumnos.alta_usuario', '=', $id)
            ->select('alumnos.*')
            ->paginate(30);
        }


        return view('formalumno.indexformalumnos',$datos);
    }


    public function create()
    {
        $id = Auth::id();
        // $tutores = tutores::all();
        $tutores=DB::table('tutores')
        ->where('tutores.alta_usuario', '=', $id)
        ->select('tutores.*')
        ->get();
        return view('formalumno.createformalumnos')->with('tutores',$tutores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosformalumnos=request()->except('_token');
        alumnos::insert($datosformalumnos);
///////////////////////////////////////////
        $datosUsuario=[
            'name'=>request('nombres').' '.request('apellido_paterno').' '.request('apellido_materno'),
            'email'=>request('email'),
            'role'=>"Alumno",
            'password'=>Hash::make($request->curp),
        ];
         User::insert($datosUsuario);

         $nombrecorreo=$request->get('email');

         $alumnos =DB::table('alumnos')
         ->where('alumnos.email', '=', $nombrecorreo)
         ->get(array('id'));

         $users =DB::table('users')
         ->where('users.email', '=', $nombrecorreo)   
         ->get(array('id'));


         $valora = '';
         $valorb = '';

         foreach ($alumnos as $a) {
            $valora = $a->id;
        }

        foreach ($users as $b) {
            $valorb = $b->id;
        }

          $datosUsuarioPivote=[
            //->get('alumnos_id'),
            'alumnos_id'=>$valora,
            'users_id'=>$valorb,
        ];
     
        AlumnosPivote::insert($datosUsuarioPivote); 
////////////////////////////

        return redirect('formreg_med/create');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function show(alumnos $alumnos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutores = tutores::all();
        $alumno=alumnos::findOrFail($id);
        return view('formalumno.editformalumnos',compact('alumno'))->with('tutores',$tutores);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosformalumnos=request()->except(['_token','_method']);
        alumnos::where('id','=',$id)->update($datosformalumnos);
        //$alumno=alumnos::findOrFail($id);
        //return view('formalumno.editformalumnos',compact('alumno'));
        return redirect('formalumnos')->with('Mensaje','alumno modificado con ??xito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        alumnos::destroy($id);
        return redirect('formalumnos')->with('Mensaje','alumno elminado con exito');
        }
    }
