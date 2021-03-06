<?php

namespace App\Http\Controllers;

use App\Models\tutores;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class TutoresController extends Controller
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
    public function index()
    {
        $id = Auth::id();

        if (Auth::user()->role == 'Administrador') {
            $datos['formtutor']=tutores::paginate(30);
        }
        if (Auth::user()->role == 'Entrenador') {
            $datos['formtutor']=DB::table('tutores')
            ->where('tutores.alta_usuario', '=', $id)
            ->select('tutores.*')
            ->paginate(30);
        }

        return view('formtutor.indexformtutor',$datos);
    }
    

    public function create()
    {

        return view('formtutor.createformtutor');
    }


    public function store(Request $request)
    {
        //$datosformtutores=request()->all();   

        $datosformtutor=request()->except('_token');
        tutores::insert($datosformtutor);
        //return response()->json($datosformtutor);

        // return redirect('formtutores')->with('Mensaje','tutor agregado con exito');

        return redirect('formalumnos/create');
        // ->with('Mensaje','tutor agregado con exito');
    }

    public function show(tutores $tutores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutor=tutores::findOrFail($id);
        return view('formtutor.editformtutor',compact('tutor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosformtutor=request()->except(['_token','_method']);
        tutores::where('id','=',$id)->update($datosformtutor);

        //$tutor=tutores::findOrFail($id);
        //return view('formtutor.editformtutor',compact('tutor'));
        return redirect('formtutores')->with('Mensaje','Tutor modificado con ??xito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tutores::destroy($id);
        return redirect('formtutores')->with('Mensaje','tutor eliminado con exito');
        
        }
    }

