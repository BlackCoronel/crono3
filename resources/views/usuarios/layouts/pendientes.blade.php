@extends('welcome')

@section('content')
    <div class="container" style="margin-top: 150px; margin-bottom: 250px;">
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading"><i class="fas fa-money-bill-wave"></i> PAGOS PENDIENTES</h4>
            <a href="/panel_usuario" class="pull-right" style="font-weight: bold;">
                <i class="fas fa-arrow-left"></i> VOLVER
            </a>
            <p>Aquí puedes comprobar si tienes algún pago pendiente, asi como la fecha tope y su precio.</p>
        </div>
        <div class="container" style="margin-top: 30px;">
            <?php $i = 1 ?>
            <table class="table">
                <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Prueba</th>
                    <th scope="col">Plazo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Pagar</th>
                </tr>
                </thead>
                <tbody>
                @if(count($pruebas) > 0)
                    @foreach($pruebas as $prueba)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td><a href="/pruebas/{{ $prueba[0]->slug }}">{{ strtoupper($prueba[0]->titulo) }}</a></td>
                            <td>{{ $prueba[0]->fecha_tope }}</td>
                            <td>{{ strtoupper($prueba[0]->precio) }} @if($prueba[0]->precio != 'cerrada') € @endif</td>
                            <td>
                                @if($prueba[0]->precio == 'cerrada') CERRADA @else <a href="/pago/{{ $prueba[0]->inscripcion_id }}" style="font-weight: bold; color: green;"><i class="far fa-credit-card"></i> PAGAR</a> @endif
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
            @else
                <tr>
                    <th scope="row">NO ESTAS INSCRIT@ EN NINGUNA PRUEBA !!!</th>
                </tr>
                </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection