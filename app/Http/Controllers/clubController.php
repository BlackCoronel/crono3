<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\usuarioClub;
use App\inscripciones;
use Illuminate\Support\Facades\DB;
use App\PagosRedsys;
use Ssheduardo\Redsys\Facades\Redsys;

class clubController extends Controller
{
    public function index(){
        $club = DB::table('clubes')->where('club',Auth::user()->name)->get();
        $pruebas = DB::table('pruebas')->get();
        foreach ($pruebas as $prueba){
            $plazos = DB::table('plazos')->where('id_carrera',$prueba->id)->orderBy('plazo', 'asc')->get();
            if(count($plazos) > 0){
                if(date('Y-m-d') >= $plazos[0]->plazo && date('Y-m-d') <= $plazos[count($plazos)-1]->fin ){
                    $prueba->abierta = 'abierta';
                }
            }
        }
        $usuarios = DB::table('usuarios_club')->where('club',$club[0]->id)->get();
        return view('club.principal',compact('usuarios','pruebas'));
    }

    public function registrarUsuario(Request $request){
        $club = DB::table('clubes')->where('club',$request->club)->get();
        $usuario = new usuarioClub([
           'nombre' => $request->nombre,
           'apellidos' => $request->apellidos,
           'email' => $request->email,
           'dni' => $request->dni,
           'fecha' => $request->nacimiento,
           'domicilio' => $request->domicilio,
           'localidad' => $request->localidad,
           'sexo' => $request->sexo,
           'cpostal' => $request->cpostal,
           'licencia' => $request->licencia,
           'telefono' => $request->telefono,
           'talla' => $request->talla,
           'club' => $club[0]->id,
           'nombre_dorsal' => $request->ndorsal,
           'observaciones' => $request->observaciones
       ]);

       $usuario->save();

        $club = DB::table('clubes')->where('club',Auth::user()->name)->get();
        $pruebas = DB::table('pruebas')->get();
        foreach ($pruebas as $prueba){
            $plazos = DB::table('plazos')->where('id_carrera',$prueba->id)->orderBy('plazo', 'asc')->get();
            if(count($plazos) > 0){
                if(date('Y-m-d') >= $plazos[0]->plazo && date('Y-m-d') <= $plazos[count($plazos)-1]->fin ){
                    $prueba->abierta = 'abierta';
                }
            }
        }
        $usuarios = DB::table('usuarios_club')->where('club',$club[0]->id)->get();

       $nav = "alta";
       return view('club.principal',compact('nav','usuarios','pruebas'))->with('status','Usuario registrado en el club con éxito!!!');
    }

    public function inscripcionMultiple(Request $request){
        $precio = 0;
        $prueba = DB::table('pruebas')->where('titulo',$request->pruebas)->get();
        $ids = [];
        $plazos = DB::table('plazos')->where('id_carrera',$prueba[0]->id)->get();
        foreach ($plazos as $plazo){
            if(date('Y-m-d') >= $plazo->plazo && date('Y-m-d') <= $plazo->fin ){
                $precio = $plazo->precio;
            }
        }

        $precio = ($precio * count($request->inscrito));

        foreach ($request->inscrito as $inscrito){
            $usuario = DB::table('usuarios_club')->where('id',$inscrito)->get();

            $inscripcion = new inscripciones([

                'id_prueba' => $prueba[0]->id,
                'nombre' => $usuario[0]->nombre,
                'apellidos' =>  $usuario[0]->apellidos,
                'email' =>  $usuario[0]->email,
                'dni' =>  $usuario[0]->dni,
                'fecha' =>  $usuario[0]->fecha,
                'domicilio' =>  $usuario[0]->domicilio,
                'localidad' =>  $usuario[0]->localidad,
                'sexo' =>  $usuario[0]->sexo,
                'cpostal' =>  $usuario[0]->cpostal,
                'licencia' =>  $usuario[0]->licencia,
                'telefono' =>  $usuario[0]->telefono,
                'talla' =>  $usuario[0]->talla,
                'club' => Auth::user()->name,
                'nombre_dorsal' =>  $usuario[0]->nombre_dorsal,
                'observaciones' =>  $usuario[0]->observaciones

            ]);

            $inscripcion->save();
            $ids [] = $inscripcion->id;
        }


        try{
            $key = config('redsys.key');

            Redsys::setAmount($precio);
            Redsys::setOrder(time());
            Redsys::setMerchantcode('999008881'); //Reemplazar por el código que proporciona el banco
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal('01');
            Redsys::setMethod('T'); //Solo pago con tarjeta, no mostramos iupay
            Redsys::setNotification(config('redsys.url_notification')); //Url de notificacion
            Redsys::setUrlOk(config('redsys.url_ok')); //Url OK
            Redsys::setUrlKo(config('redsys.url_ko')); //Url KO
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName('CRONO3');

            Redsys::setTitular(Auth::user()->name);
            Redsys::setProductDescription('Inscripción ' . $prueba[0]->titulo . ' ' . Auth::user()->name);
            Redsys::setEnviroment('test'); //Entorno test

            $signature = Redsys::generateMerchantSignature($key);
            Redsys::setMerchantSignature($signature);
            $campos = Redsys::getParameters();
            for($i = 0; $i < count($ids); $i++){
                $pago = new PagosRedsys([
                    'referencia' => $campos['DS_MERCHANT_ORDER'],
                    'id_inscrito' => $ids[$i],
                ]);
                $pago->save();
            }

            Redsys::executeRedirection();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function cargarUsuario($usuario){
        $usuario = DB::table('usuarios_club')->where('id',$usuario)->get();
        $club = DB::table('clubes')->where('id',$usuario[0]->club)->get();
        if($usuario[0]->email == null){
            $usuario[0]->email = "";
        }
        if($usuario[0]->domicilio == null){
            $usuario[0]->domicilio = "";
        }
        if($usuario[0]->cpostal == null){
            $usuario[0]->cpostal = "";
        }
        if($usuario[0]->licencia == null){
            $usuario[0]->licencia = "";
        }
        if($usuario[0]->telefono == null){
            $usuario[0]->telefono = "";
        }
        if($usuario[0]->nombre_dorsal == null){
            $usuario[0]->nombre_dorsal = "";
        }
        if($usuario[0]->observaciones == null){
            $usuario[0]->observaciones = "";
        }
        $usuario[0]->club = $club[0]->club;
        header('Content-Type: application/json');
        return $usuario->toJson();
    }

    public function editarUsrClub(Request $request,$id){
        //HAY QUE PONER UNA VALIDACION DE LOS CAMPOS OBLIGATORIOS
        DB::table('usuarios_club')->where('id',$id)->update([
            'nombre' => $request->nombre,
            'apellidos' =>  $request->apellidos,
            'email' =>  $request->email,
            'dni' =>  $request->dni,
            'fecha' =>  $request->nacimiento,
            'domicilio' =>  $request->domicilio,
            'localidad' =>  $request->localidad,
            'sexo' =>  $request->sexo,
            'cpostal' =>  $request->cpostal,
            'licencia' =>  $request->licencia,
            'telefono' =>  $request->telefono,
            'talla' =>  $request->talla,
            'nombre_dorsal' =>  $request->nombre_dorsal,
            'observaciones' =>  $request->observaciones
        ]);

        return redirect('/panel_club');
    }

    public function eliminarUsrClub($id){
        DB::table('usuarios_club')->where('id',$id)->delete();
        return redirect('/panel_club');
    }

}
