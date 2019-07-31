<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pruebas;
use App\plazos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    /* AQUÍ VAN TODAS LAS FUNCIONES QUE MUESTRAN LAS VISTAS */

    public function index(){
        $pruebas = DB::table('pruebas')->orderBy('fecha','ASC')->get();
        foreach ($pruebas as $prueba){
            $inscritos = DB::table('inscripciones')->where('id_prueba',$prueba->id)->get();
            $prueba->inscritos = count($inscritos);
            $plazos = DB::table('plazos')->where('id_carrera',$prueba->id)->orderBy('plazo', 'asc')->get();
            if(count($plazos) > 0){
                if(date('Y-m-d') >= $plazos[0]->plazo && date('Y-m-d') <= $plazos[count($plazos)-1]->fin ){
                    $prueba->abierta = 'abierta';
                }
            }
        }
        return view('admin.principal', compact('pruebas'));
    }

    public function showPrueba(){
        $pruebas = DB::table('pruebas')->get();
        return view('admin.pruebas.create', compact('pruebas'));
    }

    public function showEditar(Request $request){
        $pruebas = DB::table('pruebas')->get();
        $campos = DB::table('pruebas')->where('titulo',$request->prueba)->get();
        $plazos = DB::table('plazos')->where('id_carrera',$campos[0]->id)->get();
        return view('admin.pruebas.edit',compact('pruebas','campos','plazos'));
    }

    /*
     * Aquí van todas las acciones para las pruebas
     * CREAR -> EDITAR -> ELIMINAR
     */
    public function createPrueba(Request $request){

       $request->validate([
            'titulo' =>'required',
        ]);

        $portada = $request->file('portada');
        if($portada != null){
            $portada->storeAs('/public',$portada->getClientOriginalName());
            $portada_path = storage::url($portada->getClientOriginalName());
        } else {
            $portada_path = '/storage/no-image.png';
        }

        $normativa = $request->file('normativa');
        if($normativa != null){
            $normativa->storeAs('/public',$normativa->getClientOriginalName());
            $normativa_path = storage::url($normativa->getClientOriginalName());
        } else {
            $normativa_path = null;
        }

        $prueba = new pruebas([
            'titulo' => $request->titulo,
            'ciudad' => $request->ciudad,
            'federada' => $request->federada,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'distancia' => $request->distancia,
            'pagina' => $request->pagina,
            'circuito' => $request->circuito,
            'normativa' => $normativa_path,
            'portada' => $portada_path,
            'slug' => str_slug($request->titulo),
        ]);

        $prueba->save();

        $id = DB::table('pruebas')->where('titulo',$request->titulo)->get();

        for ($i = 0; $i < count($request->plazo); $i++){

            $plazo = new plazos([
                'id_carrera' => $id[0]->id,
                'plazo' => $request->plazo[$i],
                'fin' => $request->fin[$i],
                'precio' => $request->precio[$i],
            ]);

            $plazo->save();
        }

        return redirect('/nueva_prueba')->with('status', 'La prueba ha sido creada con éxito!!!');
    }

    public function editPrueba(Request $request, $prueba){

        $campos_antiguos = DB::table('pruebas')->where('id',$prueba)->get();
       $portada = $request->file('portada');
        if($portada != null){
            $portada->storeAs('/public',$portada->getClientOriginalName());
            $portada_path = storage::url($portada->getClientOriginalName());
        } else {
            $portada_path = $campos_antiguos[0]->portada;
        }

        $normativa = $request->file('normativa');
        if($normativa != null){
            $normativa->storeAs('/public',$normativa->getClientOriginalName());
            $normativa_path = storage::url($normativa->getClientOriginalName());
        } else {
            $normativa_path = $campos_antiguos[0]->normativa;
        }

        DB::table('pruebas')->where('id',$prueba)->update([

            'titulo' => $request->titulo,
            'ciudad' => $request->ciudad,
            'federada' => $request->federada,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'distancia' => $request->distancia,
            'pagina' => $request->pagina,
            'circuito' => $request->circuito,
            'normativa' => $normativa_path,
            'portada' => $portada_path,
            'slug' => str_slug($request->titulo)

        ]);

        $campos = DB::table('pruebas')->where('id',$prueba)->get();
        $plazos = DB::table('plazos')->where('id_carrera',$prueba)->get();
        $pruebas = DB::table('pruebas')->get();

        return view('admin.pruebas.edit', compact('campos','plazos','pruebas'))->with('status','Prueba editada con éxito !');

    }

    public function deletePrueba(Request $request){

        DB::table('pruebas')->where('titulo',$request->prueba)->delete();

        return redirect(url()->previous())->with('delete', 'La prueba ha sido eliminada con éxito !');

    }

    /*
     * Funciones para los plazos
     * CREAR-BORRAR-ACTUALIZAR
     */

    public function deletePlazos($plazo){
        DB::table('plazos')->where('id',$plazo)->delete();
    }

    public function crearPlazos($prueba,$cantidad){
        $id_plazos = [];
        for($i = 0; $i < $cantidad; $i++){
            $plazo = new plazos([
               'id_carrera' => $prueba,
            ]);
            $plazo->save();

            $id_plazos[] = $plazo->id;
        }
        $salida = "";
        header('Content-Type: application/json');
        for( $j = 0; $j < count($id_plazos); $j++){
            $salida .= '{ "plazo": "' . $id_plazos[$j] .'"},';
        }

        return '{"plazos": [' . substr($salida,0,(strlen($salida) - 1)) .']}';

    }

    public function actualizarPlazos($prueba,$fecha,$precio){
        DB::table('plazos')->where('id',$prueba)->update([
           'plazo' => $fecha,
           'precio' => $precio,
        ]);
    }


}
