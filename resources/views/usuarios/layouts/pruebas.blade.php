@extends('welcome')

@section('content')
    <div class="container" style="margin-top: 150px; margin-bottom: 250px;">
        <div class="alert alert-info text-center" role="alert">
            <h4 class="alert-heading"><i class="fas fa-running"></i> Mis pruebas</h4>
            <a href="/panel_usuario" class="pull-right" style="font-weight: bold;">
                <i class="fas fa-arrow-left"></i> VOLVER
            </a>
            <p>Aquí puedes comprobar las pruebas en las que estas inscrito, así como modificar tu inscripción en caso de error.</p>
        </div>
        <div class="container" style="margin-top: 30px;">
            <?php $i = 1 ?>
            <table class="table">
                <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Prueba</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Localidad</th>
                    <th scope="col">Pagada</th>
                    <th scope="col">Modificar Inscripciòn</th>
                </tr>
                </thead>
                <tbody>
                @if(count($pruebas) > 0)
                    @foreach($pruebas as $prueba)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td><a href="/pruebas/{{ $prueba[0]->slug }}">{{ strtoupper($prueba[0]->titulo) }}</a></td>
                            <td>{{ date('d-m-Y',strtotime($prueba[0]->fecha)) }}</td>
                            <td>{{ strtoupper($prueba[0]->ciudad) }}</td>
                            <td>
                                @if($prueba[0]->pagado == 'si') SI @else <a href="/pago/{{ $prueba[0]->inscripcion_id }}" style="font-weight: bold; color: green;"><i class="far fa-credit-card"></i> PAGAR</a> @endif
                            </td>
                            <td>
                            @if($prueba[0]->pagado == 'si')
                                <!-- Solución temporal, para dejar modificar la inscripción-->
                                @if(date('d-m-Y') < date('d-m-Y',strtotime($prueba[0]->fecha)))
                                    <a href="/modificar_inscripcion/{{ $prueba[0]->inscripcion_id }}" style="font-weight: bold;">
                                        <i class="fas fa-edit"></i> MODIFICAR INSCRIPCIONES
                                    </a>
                                @else
                                    <p style="color:red;" class="disabled"><i class="fas fa-block"></i> MODIFICACIONES CERRADAS</p>
                                @endif
                            @else
                                    <p style="color:red; font-weight: bold;" class="disabled"><i class="fas fa-arrow-left"></i> ANTES DEBES PAGAR</p>
                            @endif
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
                @else
                    <tr>
                        <th scope="row" class="">NO ESTAS INSCRIT@ EN NINGUNA PRUEBA !!!</th>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection