@extends('welcome')

@section('content')
    <div id="contact-section">
        <div class="container" style="padding-top: 90px;">
            <h1 style="font-size:20px; margin-bottom: 5px;" id="carreraTitulo">{{ $datos[0]-> titulo }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ $datos[0]->portada }}" alt="{{ $datos[0]->titulo }}" class="img-fluid img-thumbnail">
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-3">Ciudad: </dt>
                        <dd class="col-sm-9">
                            @if($datos[0]->ciudad != null){{ strtoupper($datos[0]->ciudad) }}@else - @endif
                        </dd>

                        <dt class="col-sm-3">Federada?:</dt>
                        <dd class="col-sm-9">
                            @if($datos[0]->federada != null){{ $datos[0]->federada }}@else - @endif
                        </dd>

                        <dt class="col-sm-3">Fecha</dt>
                        <dd class="col-sm-9">
                            @if($datos[0]->fecha != null){{ date('d-m-Y', strtotime($datos[0]->fecha)) }}@else - @endif

                        </dd>

                        <dt class="col-sm-3 text-truncate">Distancia: </dt>
                        <dd class="col-sm-9">
                            @if($datos[0]->distancia != null){{ $datos[0]->distancia }}@else - @endif
                        </dd>

                        <dt class="col-sm-3">Nº Inscritos: </dt>
                        <dd class="col-sm-9">{{ count($inscritos) }}  Inscritos</dd>

                        <dt class="col-sm-3">Inscripciones</dt>
                        <dd class="col-sm-9">
                            @if(count($plazos) >= 2)
                                 Desde {{ date('d-m-Y',strtotime($plazos[0]->plazo)) }} hasta {{ date('d-m-Y',strtotime($plazos[1]->plazo)) }}
                            @else
                                -
                            @endif
                        </dd>

                        <dt class="col-sm-3">Página web: </dt>
                        <dd class="col-sm-9">
                            @if($datos[0]->pagina != null){{ $datos[0]->pagina }}@else - @endif
                        </dd>

                        <dt class="col-sm-3">Circuito: </dt>
                        <dd class="col-sm-9">
                            @if($datos[0]->circuito != null){{ $datos[0]->circuito }}@else - @endif
                        </dd>

                        <dt class="col-sm-3">Tipo: </dt>
                        <dd class="col-sm-9">*Tipo de Prueba*</dd>

                        <dt class="col-sm-3">Normativa: </dt>
                        <dd class="col-sm-9">
                            <!--if($datos[0]->normativa != null)-->
                            <a href="{{ $datos[0]->normativa }}">
                                <i class="fas fa-file-pdf"></i> Normativa {{ $datos[0]->titulo }}
                            </a>
                            <!--endif-->
                        </dd>
                    </dl>
                    <div class="container">
                        <div class="row">
                            <input type="text" id="id_prueba" value="{{ $datos[0]->id }}" hidden>
                                <!-- Configurar if para saber si esta abierta o no la prueba-->
                                @if(count($plazos) >= 1)
                                        @if(date('d-m-Y') >= date('d-m-Y',strtotime($plazos[0]->plazo)) && date('d-m-Y') <= date('d-m-Y',strtotime($plazos[(count($plazos)-1)]->fin)))
                                            <p>{{ date('d-m-Y') }} >=  {{ date('d-m-Y',strtotime($plazos[0]->plazo)) }} && {{ date('d-m-Y') }} <= {{date('d-m-Y',strtotime($plazos[(count($plazos)-1)]->fin))}}</p>
                                            <div class="col-md-4">
                                                <!--Aqui hay que poner un if para saber si hay inscritos y que los muestre-->
                                                <a href="#" id="cargarInscritos" data-toggle="modal" data-target="#inscritos" class="btn btn-primary btn-lg">
                                                    <i class="fas fa-clipboard-list"></i> INSCRITOS
                                                </a>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 5px;">
                                                <a href="/inscribirse/{{ $datos[0]->slug }}" class="btn btn-success btn-lg">
                                                    <i class="fas fa-pen"></i> INSCRIBIRSE
                                                </a>
                                            </div>
                                        @elseif(date('d-m-Y') > date('d-m-Y',strtotime($plazos[(count($plazos)-1)]->fin)))
                                            <div class="col-md-4">
                                                <!--Aqui hay que poner un if para saber si hay inscritos y que los muestre-->
                                                <a href="#" id="cargarInscritos" data-toggle="modal" data-target="#inscritos" class="btn btn-primary btn-lg">
                                                    <i class="fas fa-clipboard-list"></i> INSCRITOS
                                                </a>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 5px;">
                                                <button type="button" class="btn btn-danger btn-lg disabled">
                                                    <i class="fas fa-ban"></i> INSCRIPCIÓN CERRADA
                                                </button>
                                            </div>
                                        @endif
                                @else
                                    <div class="col-md-4" style="margin-top:5px;">
                                        <button type="button"  class="btn btn-primary btn-lg disabled">
                                            <i class="far fa-clock"></i> ESPERANDO PLAZOS
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @if(count($plazos) >= 1)
                    <div class="container">
                        <div class="col-md-6" style="margin-top: 30px;">
                            <h4>Observaciones de la carrera</h4>
                            <p style="margin-top: 10px;">SI TU CLUB NO ESTÁ, ANTES DE INSCRIBIRTE PIDE QUE LO DEMOS DE ALTA A TRAVÉS DEL CORREO ELECTRÓNICO
                                inscripciones@crono3.es. SI AUN ASÍ QUIERES TERMINAR LA INSCRIPCIÓN, PONTE COMO INDEPENDIENTE Y EN OBSERVACIONES NOS INDICAS EL CLUB.
                            </p>
                        </div>
                        <div class="col-md-6" style="margin-top: 30px;">
                            <h4 style="margin-bottom: 10px;">Cuotas de la carrera</h4>
                            <?php $i = 1 ?>
                            <table class="table">
                                <thead>
                                <tr class="bg-primary">
                                    <th scope="col">Plazo</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Importe</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($plazos as $plazo)
                                    <tr>
                                        <th scope="row">{{ $i . 'º '}} Plazo </th>
                                        <td>{{ date('d/m/Y',strtotime($plazo->plazo)) }} - {{ date('d/m/Y',strtotime($plazo->fin)) }}</td>
                                        <td>{{ $plazo->precio }}€</td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                            <div class="col-md-6" style="margin-top: 30px;">
                                <h4 style="margin-bottom: 10px;">Formas de pago</h4>
                                <table class="table">
                                    <thead>
                                    <tr class="bg-primary">
                                        <th scope="col">Forma de pago</th>
                                        <th scope="col">Especificaciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>TPV Redsys</td>
                                        <td>Pago mediante TPV Redsys</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
