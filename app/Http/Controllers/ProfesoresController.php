<?php

namespace App\Http\Controllers;

use App\Profesores;
use Illuminate\Http\Request;

class ProfesoresController extends Controller
{

public function listProfesores(){
    $totalProfesoresList = Profesores::all();
    $profesores = Profesores::orderBy('id', 'DESC')->paginate(8);
    return view('profesores', compact('profesores','totalProfesoresList'));
    }

public function eliminarProfe(Request $request, $idProfe){
        if($request->ajax()){
            $Profe = Profesores::find($idProfe); 
            $Profe->delete(); 

            $totalProfesores = Profesores::all()->count(); //Consulto nuevamenta la cantidad de profesores

            return response()->json([
                'totalprofesores' =>' <strong> ('. $totalProfesores .')</strong>',
                'mensaje'=> '<strong>Felicitaciones ! </strong> El Profesor ('. $Profe->nombre .') fue Borrado.'
            ]);  
        }
}

}
