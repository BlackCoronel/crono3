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
                   <i class="fas fa-calendar-plus"></i> NUEVA PRUEBA
               </h3>
               <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-plazos">
                   <i class="fas fa-plus" style="margin-right: 5px;"></i>asignar plazos
               </button>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form action="/nueva_prueba" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="box-body">
                   <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
                       <label for="exampleInputEmail1">Título</label>
                       <input type="text" class="form-control" name="titulo" placeholder="Título de la prueba" value="{{old('titulo')}}">
                       @if ($errors->has('titulo'))
                           <span class="help-block">
                                <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                       @endif
                   </div>
                   <div class="row" style="margin-bottom: 5px;">
                       <div class="col-md-4">
                           <label for="exampleInputPassword1">Ciudad</label>
                           <input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
                       </div>
                       <div class="col-md-1">
                           <label for="exampleInputPassword1">Federada</label>
                           <select name="federada" class="form-control">
                               <option>no</option>
                               <option>si</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <label>Fecha</label>
                           <input type="date" name="fecha" class="form-control">
                       </div>
                       <div class="col-md-2">
                           <label>Hora</label>
                           <input type="time" name="hora" class="form-control">
                       </div>
                       <div class="col-md-3">
                           <label>Distancia</label>
                           <input type="text" name="distancia" class="form-control" placeholder="Distancia">
                       </div>
                   </div>
                   <div class="row" style="margin-bottom: 5px;">
                       <div class="col-md-4">
                           <label>Página web</label>
                           <input type="text" name="pagina" class="form-control" placeholder="Página Web">
                       </div>
                       <div class="col-md-4">
                           <label>Circuito</label>
                           <input type="text" name="circuito" class="form-control" placeholder="Circuito">
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
                               <h4 class="modal-title"><i class="fas fa-plus"></i>Asignar plazos</h4>
                           </div>
                           <div class="modal-body">
                               <div class="form-group row" id="esconder">
                                   <label style="margin-right: 15px;">Crear plazos </label>
                                   <input type="text" name="cantidad" id="cantidad" placeholder="Nº Plazos">
                                   <button type="button"class="btn btn-warning btn-sm" id="crear">crear</button>
                               </div>
                               <div id="plazos"></div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-primary pull-left" data-dismiss="modal" id="asignar"><i class="fas fa-edit"></i> asignar plazos</button>
                               <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="box-footer">
                   <button type="submit" class="btn btn-primary">crear</button>
               </div>
           </form>
       </div>
   </div>
@endsection