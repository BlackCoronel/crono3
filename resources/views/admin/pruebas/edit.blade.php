@extends('admin.principal')

@section('content')
    @if(session('status'))
        <div class="container">
            <div class="alert alert-success" style="margin-top: 20px;">
                <h5 class="text-center">{{ session('status') }}</h5>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fas fa-edit"></i> EDITAR PRUEBA
                </h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-plazos">
                    <i class="fas fa-pen-square" style="margin-right: 5px;"></i>editar plazos
                </button>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/update_prueba/{{ $campos[0]->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
                        <label for="exampleInputEmail1">Título</label>
                        <input type="text" class="form-control" name="titulo" placeholder="Título de la prueba" value="{{ $campos[0]->titulo }}">
                        @if ($errors->has('titulo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-4">
                            <label for="exampleInputPassword1">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" value="{{ $campos[0]->ciudad }}">
                        </div>
                        <div class="col-md-1">
                            <label for="exampleInputPassword1">Federada</label>
                            <select name="federada" class="form-control">
                                <option @if($campos[0]->federada == 'no') selected @endif>no</option>
                                <option @if($campos[0]->federada == 'si') selected @endif>si</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ $campos[0]->fecha }}">
                        </div>
                        <div class="col-md-2">
                            <label>Hora</label>
                            <input type="time" name="hora" class="form-control" value="{{ $campos[0]->hora }}">
                        </div>
                        <div class="col-md-3">
                            <label>Distancia</label>
                            <input type="text" name="distancia" class="form-control" placeholder="Distancia" value="{{ $campos[0]->distancia }}">
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-4">
                            <label>Página web</label>
                            <input type="text" name="pagina" class="form-control" placeholder="Página Web" value="{{ $campos[0]->pagina }}">
                        </div>
                        <div class="col-md-4">
                            <label>Circuito</label>
                            <input type="text" name="circuito" class="form-control" placeholder="Circuito" value="{{ $campos[0]->circuito }}">
                        </div>
                        <div class="col-md-4">
                            <label>Normativa</label>
                            <input type="file" name="normativa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Portada</label>
                        <input type="file" name="portada">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="modal fade" id="modal-plazos">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title"><i class="fas fa-pen-square"></i> Editar plazos</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row" id="esconder_ajax" style="@if(count($plazos) > 0)display:none;" @endif>
                                        <label style="margin-right: 15px; margin-left: 20px;">Crear plazos </label>
                                        <input type="text" name="cantidad" id="cantidad" placeholder="Nº Plazos">
                                        <button type="button"class="btn btn-warning btn-sm" id="crear_ajax" prueba="{{ $campos[0]->id }}">crear</button>
                                    </div>
                                    <div id="plazos"></div>
                                    @if(count($plazos) > 0)
                                        <?php $i = 1; ?>
                                        @foreach($plazos as $plazo)
                                            <div class='form-group plazos'>
                                                <h4>Plazo {{ $i }}
                                                    <button type="button" remove="/delete_plazo/{{ $plazo->id }}" class="btn btn-danger pull-right remove" style="margin-top: 5px; margin-bottom: 10px;">
                                                        <i class="fas fa-trash"></i> eliminar plazo
                                                    </button>
                                                </h4>
                                                <input type="text" name="id_prueba" value="{{ $plazo->id }}" hidden>
                                                <input type='date' name='plazo[]' class='form-control' value="{{ $plazo->plazo }}">
                                                <input type='text' name='precio[]' class='form-control' placeholder='precio' value="{{ $plazo->precio }}">

                                            </div>
                                        <?php $i++ ?>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary pull-left" id="editar_plazos">
                                        <i class="fas fa-edit"></i> Editar plazos
                                    </button>
                                    <button type="button" class="btn" data-dismiss="modal">cerrar</button>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar prueba</button>
                </div>
            </form>
        </div>
    </div>
@endsection