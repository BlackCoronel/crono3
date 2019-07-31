<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function home(){
        $pruebas = DB::table('pruebas')->orderBy('fecha', 'asc')->get();
        foreach ($pruebas as $prueba){
            $plazo = DB::table('plazos')->where('id_carrera',$prueba->id)->orderBy('plazo', 'asc')->get();
           if(count($plazo) > 0){
               $prueba->plazo = $plazo[0]->plazo;
           } else {
               $prueba->plazo = null;
           }
        }
        return view('welcome',compact('pruebas'));
    }

    public function pruebas(){
        $pruebas = DB::table('pruebas')->get();
        return view('layouts.pruebas',compact('pruebas'));
    }

    public function inscripcionAbierta(){
        $pruebas = DB::table('pruebas')->get();
        return view('layouts.inscripcion_abierta',compact('pruebas'));
    }

    public function cargarPruebas($prueba){
        $datos = DB::table('pruebas')->where('slug',$prueba)->get();
        $inscritos = DB::table('inscripciones')->where('id_prueba',$datos[0]->id)->get();
        $plazos = DB::table('plazos')->where('id_carrera',$datos[0]->id)->orderBy('plazo', 'asc')->get();
        foreach ($inscritos as $inscrito){
            $pagado = DB::table('pagos')->where('id_inscrito',$inscrito->id)->get();

            if($pagado[0]->referencia == $pagado[0]->respuesta){
                $inscrito->pagado = 'si';
            } else {
                $inscrito->pagado = 'no';
            }
        }
        return view('layouts.infopruebas',compact('datos','plazos','inscritos'));
    }

    public function contacto(){
        return view('layouts.contacto');
    }
}