<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class usuariosController extends Controller
{
    public function index(){
        return view('usuarios.panel');
    }

    public function showInscripcion($prueba){
        $prueba = DB::table('pruebas')->where('slug',$prueba)->get();
        $plazos = DB::table('plazos')->where('id_carrera',$prueba[0]->id)->orderBy('plazo','asc')->get();

        return view('layouts.inscribirse',compact('plazos','prueba'));
    }

    public function cargarClubes($club){
        $club = DB::table('clubes')->where('club','LIKE','%'. $club . '%')->orderBy('club','ASC')->get();
        $salida = "";
        header('Content-Type: application/json');
        foreach ($club as $campo){
            $salida .='{ "club": "' . $campo->club .'"},';
        }
        return '{ "clubes":['. substr($salida,0,(strlen($salida) - 1)) .']}';
    }

    public function cargarInscritos($param,$filtro,$id_prueba){

        $inscritos = DB::table('inscripciones')
            ->where($filtro,'LIKE', '%' . $param .'%')
            ->where('id_prueba',$id_prueba)
            ->orderBy('apellidos','ASC')->get();

        foreach ($inscritos as $inscrito) {
            $pagado = DB::table('pagos')->where('id_inscrito', $inscrito->id)->get();

            if ($pagado[0]->referencia == $pagado[0]->respuesta) {
                $inscrito->pagado = 'si';
            } else {
                $inscrito->pagado = 'no';
            }
        }

        header('Content-Type: application/json');

        $inscritos->toJson();

        return $inscritos;

    }

    public function perfil(){
        $club = DB::table('clubes')->where('id',Auth::user()->club)->get();
        return view('usuarios.layouts.perfil',compact('club'));
    }

    public function misPruebas(){
        $inscripciones = DB::table('inscripciones')->where('dni',auth()->user()->dni)->get();
        $pruebas = [];
        foreach ($inscripciones as $inscripcion){
            $prueba = DB::table('pruebas')->where('id',$inscripcion->id_prueba)->get();
            $pagado = DB::table('pagos')->where('id_inscrito', $inscripcion->id)->get();
            foreach ($prueba as $pr){
                if ($pagado[0]->referencia == $pagado[0]->respuesta) {
                    $pr->pagado = 'si';
                    $pr->inscripcion_id = $inscripcion->id;
                } else {
                    $pr->pagado = 'no';
                    $pr->inscripcion_id = $inscripcion->id;
                }
            }
            $pruebas[] = $prueba;
        }

        return view('usuarios.layouts.pruebas',compact('pruebas'));
    }

    public function pagosPendientes(){
        $inscripciones = DB::table('inscripciones')->where('dni',auth()->user()->dni)->get();
        $pruebas = [];
        foreach ($inscripciones as $inscripcion){

            $prueba = DB::table('pruebas')->where('id',$inscripcion->id_prueba)->get();
            $pagado = DB::table('pagos')->where('id_inscrito', $inscripcion->id)->get();
            foreach ($prueba as $pr){
                $plazo = DB::table('plazos')->where('id_carrera',$pr->id)->get();
                foreach ($plazo as $pl){
                    if(date('Y-m-d') >= $pl->plazo && date('Y-m-d') <= $pl->fin){
                        $pr->precio = $pl->precio;
                        $pr->fecha_tope = date('d-m-Y',strtotime($pl->fin));
                    } else {
                        $pr->fecha_tope = date('d-m-Y',strtotime($pl->fin));
                        $pr->precio = 'cerrada';
                    }
                }
                if ($pagado[0]->referencia == $pagado[0]->respuesta) {
                    $pr->pagado = 'si';
                } else {
                    $pr->pagado = 'no';
                    $pr->inscripcion_id = $inscripcion->id;
                }
            }
            $pruebas[] = $prueba;
        }
        return view('usuarios.layouts.pendientes',compact('pruebas'));
    }

    public function resultados(){
        return view('usuarios.layouts.resultados');
    }
}
