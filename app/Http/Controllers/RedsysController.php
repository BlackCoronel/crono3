<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PagosRedsys;
use App\inscripciones;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ssheduardo\Redsys\Facades\Redsys;

class RedsysController extends Controller
{
    public function index($prueba,Request $request) {

        $pruebas = DB::table('pruebas')->where('titulo',$prueba)->get();
        $plazos = DB::table('plazos')->where('id_carrera',$pruebas[0]->id)->get();
        $precio = 0;

        if(date('Y-m-d') > $plazos[count($plazos) - 1]->fin){
            abort(400);
        }

        $inscripcion = new inscripciones([
            'id_prueba' => $pruebas[0]->id,
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
            'club' => $request->club,
            'nombre_dorsal' => $request->ndorsal,
            'observaciones' => $request->observaciones
        ]);

        $inscripcion->save();

        foreach($plazos as $plazo){
            if(date('Y-m-d') >= $plazo->plazo && date('Y-m-d') <= $plazo->fin){
                $precio = $plazo->precio;
            }
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

            Redsys::setTitular($request->nombre .' '. $request->apellidos);
            Redsys::setProductDescription('Inscripción ' . $prueba);
            Redsys::setEnviroment('test'); //Entorno test

            $signature = Redsys::generateMerchantSignature($key);
            Redsys::setMerchantSignature($signature);
            $campos = Redsys::getParameters();
            $pago = new PagosRedsys([
                'referencia' => $campos['DS_MERCHANT_ORDER'],
                'id_inscrito' => $inscripcion->id,
            ]);

            $pago->save();

            Redsys::executeRedirection();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }


    }


    public function comprobar(Request $request) {

        try{

            $key = config('redsys.key');

            $parameters = Redsys::getMerchantParameters($request->input('Ds_MerchantParameters'));

            $DsResponse = $parameters["Ds_Response"];

            $DsResponse += 0;

            if (Redsys::check($key, $request->input()) && $DsResponse <=99) {
               DB::table('pagos')->where('referencia',$parameters['Ds_Order'])->update([
                   'respuesta' => $parameters['Ds_Order'],
               ]);
               if(Auth::user()->rol == 'club'){
                    return redirect('/panel_club'); //si se quiere devolver la vista hay que pasarle mas parametros
               } else {
                   return redirect('/inscripcion_abierta');
               }
            } else {
                // Vista confirmación inscripción a falta de pago.
            }

        } catch (\Sermepa\Tpv\TpvException $e) {

            echo $e->getMessage();

        }

    }

    public function pagoAtrasado($inscrito){

        $datos = DB::table('inscripciones')->where('id',$inscrito)->get();
        $prueba = DB::table('pruebas')->where('id',$datos[0]->id_prueba)->get();
        $plazos = DB::table('plazos')->where('id_carrera',$datos[0]->id_prueba)->get();
        $precio = 0;

        $pagado = DB::table('pagos')->where('id_inscrito',$inscrito)->get();

        if($pagado[0]->referencia == $pagado[0]->respuesta){
            return redirect('/inscribirse/' . $prueba[0]->slug)->with('alert','usted ya ha pagado esta prueba !!!');
        }

        foreach($plazos as $plazo){
            if(date('Y-m-d') >= $plazo->plazo && date('Y-m-d') <= $plazo->fin){
                $precio = $plazo->precio;
            }
        }

        if(date('Y-m-d') > $plazos[count($plazos) - 1]->fin){
            abort(401);
        }

        try{
            $key = config('redsys.key');

            Redsys::setAmount($precio);
            Redsys::setOrder(time());
            Redsys::setMerchantcode('999008881'); //Reemplazar por el código que proporciona el banco
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal('1');
            Redsys::setMethod('T'); //Solo pago con tarjeta, no mostramos iupay
            Redsys::setNotification(config('redsys.url_notification')); //Url de notificacion
            Redsys::setUrlOk(config('redsys.url_ok')); //Url OK
            Redsys::setUrlKo(config('redsys.url_ko')); //Url KO
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName('CRONO3');

            Redsys::setTitular($datos[0]->nombre .' '. $datos[0]->apellidos);
            Redsys::setProductDescription('Inscripción ' . $prueba[0]->titulo);
            Redsys::setEnviroment('test'); //Entorno test

            $signature = Redsys::generateMerchantSignature($key);
            Redsys::setMerchantSignature($signature);
            $campos = Redsys::getParameters();

            DB::table('pagos')->where('id_inscrito',$inscrito)->update([
               'referencia' => $campos['DS_MERCHANT_ORDER'],
            ]);

            Redsys::executeRedirection();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }

    }


}
