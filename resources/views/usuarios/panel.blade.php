@extends('welcome')

@section('content')
    <div class="container" style="margin-top:100px; margin-bottom: 400px;">
        <div class="row">
            <a href="/perfil" class="col-md-2 text-center" style="margin-top:30px;margin-left:10px;border:2px solid black; border-radius: 15px; padding-top: 50px; padding-bottom: 50px; min-width: 180px;">
                    <h4><i class="fas fa-user-circle"></i> Datos Personales</h4>
            </a>
            <a href="/mispruebas" class="col-md-2 text-center" style="margin-top:30px;margin-left:10px; border:2px solid black; border-radius: 15px; padding-top: 50px; padding-bottom: 50px; min-width: 180px;">
                <h4><i class="fas fa-running"></i> Mis Pruebas</h4>
            </a>
            <a href="/pagos_pendiente" class="col-md-2 text-center" style="margin-top:30px;margin-left:10px; border:2px solid black; border-radius: 15px; padding-top: 50px; padding-bottom: 50px; min-width: 180px;">
                <h4><i class="far fa-credit-card"></i> Pagos Pendientes</h4>
            </a>
            <a href="/resultados" class="col-md-2 text-center" style="margin-top:30px;margin-left:10px; border:2px solid black; border-radius: 15px; padding-top: 50px; padding-bottom: 50px; min-width: 180px;">
                <h4><i class="fas fa-clipboard-list"></i> Resultados</h4>
            </a>
            <a href="/cerrar_sesion" class="col-md-2 text-center" style="margin-top:30px;margin-left:10px; border:2px solid black; border-radius: 15px; padding-top: 50px; padding-bottom: 50px; min-width: 180px;">
                <h4><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</h4>
            </a>
        </div>
    </div>
@endsection