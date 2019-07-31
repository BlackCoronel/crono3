@extends('welcome')

@section('content')
<div class="container" style="margin-top: 150px">
    <div class="alert alert-info text-center" role="alert">
        <h4 class="alert-heading"><i class="fas fa-clipboard"></i> PANEL DE GESTIÓN {{ Auth::user()->name }}</h4>
        <p>En este panel, puedes gestionar todas las acciones relacioandas con tu club, gestionar la informacíon del club, agergar, borar y editar sus usuarios, así como inscribirlos en pruebas, y
        poder pagar conjuntamente como club. En caso de incidencias, ir a la pestaña de incidencias, para contactar con el administrador.</p>
    </div>
</div>
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link show" id="home-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-user"></i> DATOS
            </a>
        </li>
        <li class="nav-item @if(!empty($nav) && $nav== 'alta') active @endif">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#alta" role="tab" aria-controls="profile" aria-selected="false">
                <i class="fas fa-user-plus"></i> ALTA USUARIO
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="1" data-toggle="tab" href="#lista" role="tab" aria-controls="1" aria-selected="false">
                <i class="fas fa-address-book"></i> LISTA USUARIOS
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#nuevo" role="tab" aria-controls="contact" aria-selected="false">
               <i class="fas fa-user-cog"></i> ADMINISTRAR USUARIOS
            </a>
        </li>
        <li class="nav-item @if(!empty($nav) && $nav== 'registro') active @endif">
            <a class="nav-link" id="2" data-toggle="tab" href="#inscripcion" role="tab" aria-controls="1" aria-selected="false">
                <i class="fas fa-running"></i> INSCRIBIR USUARIOS
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="2" data-toggle="tab" href="#incidencias" role="tab" aria-controls="1" aria-selected="false">
                <i class="fas fa-exclamation-triangle"></i> INCIDENCIAS
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="home-tab">
            <div class="container" style="margin-top:25px;">
                <button class="btn btn-primary pull-right">
                    <i class="fas fa-edit"></i> Editar Club
                </button>
            </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Club: </dt>
                        <dd class="col-sm-8">
                            {{ Auth::user()->name }}
                        </dd>
                        <dt class="col-sm-4">Email: </dt>
                        <dd class="col-sm-8">
                            {{ Auth::user()->email }}
                        </dd>
                        <dt class="col-sm-4">Localidad: </dt>
                        <dd class="col-sm-8">
                            {{ Auth::user()->localidad }}
                        </dd>
                    </dl>
                </div>
                <div class="col-md-6" style="margin-top:25px;">
                    <dl class="row">
                        <dt class="col-sm-4">Codigo postal: </dt>
                        <dd class="col-sm-8">
                            @if(Auth::user()->cpostal != null){{ Auth::user()->cpostal }}@else - @endif
                        </dd>
                        <dt class="col-sm-4">Telefono: </dt>
                        <dd class="col-sm-8">
                            @if(Auth::user()->telefono != null){{ Auth::user()->telefono }}@else - @endif
                        </dd>
                    </dl>
                </div>
        </div>
        <div class="tab-pane fade @if(!empty($nav) && $nav== 'alta') active in @endif" id="alta" role="tabpanel" aria-labelledby="profile-tab">
            <form action="/registro_usuario" method="POST" class="col-md-8" style="margin-top: 25px;">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nombre*</label>
                            <input type="nombre" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Apellidos*</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress">DNI*</label>
                        <input type="text" class="form-control" name="dni" placeholder="NIF/DNI">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress2">Email*</label>
                        <input type="email" class="form-control" name="email" placeholder="ejemplo@ejemplo.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Domicilio</label>
                            <input type="text" class="form-control" name="domicilio" placeholder="Domicilio">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputZip">Localidad*</label>
                            <input type="text" class="form-control" name="localidad" placeholder="Localidad">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputCity">Código Postal</label>
                            <input type="text" class="form-control" name="cpostal" placeholder="C.Postal">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputCity">Fecha Nacimiento*</label>
                            <input type="date" class="form-control" name="nacimiento">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Sexo</label>
                            <select name="sexo" class="form-control">
                                <option>Seleccionar sexo...</option>
                                <option>Hombre</option>
                                <option>Mujer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputCity">Licencia</label>
                            <input type="text" class="form-control" name="licencia" placeholder="Licencia">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">Talla*</label>
                            <select name="talla" class="form-control">
                                <option>Talla...</option>
                                <option>3_4</option>
                                <option>5_6</option>
                                <option>7_8</option>
                                <option>9_11</option>
                                <option>12_14</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Su club*</label>
                            <input name="club" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputCity">Nombre dorsal</label>
                            <input type="text" class="form-control" name="ndorsal" placeholder="Nombre dorsal">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputCity">Observaciones</label>
                        <textarea name="observaciones" class="form-control" placeholder="Observaciones..."></textarea>

                        <button type="submit" class="btn btn-primary pull-right" style="margin-top: 15px;">
                            <i class="fas fa-user-plus"></i> ALTA
                        </button>
                    </div>
            </form>
            <div class="col-md-3" style="margin-top: 25px">
                <div class="btn btn-primary pull-right" style="font-weight: bold;">
                    <i class="far fa-file-excel"></i> IMPORTAR USUARIOS <!-- Esto abre un modal y te permite importar los usuarios-->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nuevo" role="tabpanel" aria-labelledby="contact-tab">
            <table class="table" style="margin-top: 25px;">
                <thead>
                <tr class="bg-primary">
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Fecha Nacimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ strtoupper($usuario->nombre) }}</td>
                        <td>{{  strtoupper($usuario->apellidos) }}</td>
                        <td>{{ $usuario->dni }}</td>
                        <td>{{ date('d-m-Y',strtotime($usuario->fecha)) }}</td>
                        <td class="text-center" style="font-size: 18px;">
                            <a href="#" style="color:#337ab7;"  class="editar" insc="{{ $usuario->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" style="color:red;" class="eliminar" insc="{{ $usuario->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="modal" tabindex="-1" role="dialog" id="eliminarUsr">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-user-minus"></i> ELIMINAR USUARIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/eliminarUsrClub" method="POST" id="elm">
                                @csrf
                                <div class="alert alert-danger text-center" role="alert">
                                    <h4 class="alert-heading" style="font-size: 17px;margin-bottom: 10px;">¿ Está segur@ de que quiere eliminar este usuario ?</h4>
                                        <button type="submit" class="btn btn-danger">SI, ELIMINAR</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editarUsr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/editarUsrClub" method="POST" id="edt">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Nombre*</label>
                                        <input type="nombre" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Apellidos*</label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">DNI*</label>
                                    <input type="text" class="form-control" name="dni" id="dni" placeholder="NIF/DNI">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Email*</label>
                                    <input type="email" class="form-control" name="email"  id="mail" placeholder="ejemplo@ejemplo.com">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Domicilio</label>
                                        <input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputZip">Localidad*</label>
                                        <input type="text" class="form-control" name="localidad" id="localidad" placeholder="Localidad">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputCity">Código Postal</label>
                                        <input type="text" class="form-control" name="cpostal"  id="cpostal" placeholder="C.Postal">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputCity">Fecha Nacimiento*</label>
                                        <input type="date" class="form-control"  id="fecha" name="nacimiento">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Sexo</label>
                                        <select name="sexo" class="form-control" id="sexo">
                                            <option>Hombre</option>
                                            <option>Mujer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="inputCity">Licencia</label>
                                        <input type="text" class="form-control" name="licencia" id="licencia" placeholder="Licencia">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputCity">Talla*</label>
                                        <select name="talla" class="form-control">
                                            <option>Talla...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputCity">Nombre dorsal</label>
                                        <input type="text" class="form-control" name="ndorsal" id="ndorsal" placeholder="Nombre dorsal">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputCity">Observaciones</label>
                                        <textarea name="observaciones" class="form-control" id="observaciones" placeholder="Observaciones..."></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="lista" role="tabpanel" aria-labelledby="1">
            <table class="table" style="margin-top: 25px;">
                <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Fecha Nacimiento</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ strtoupper($usuario->nombre) }}</td>
                        <td>{{  strtoupper($usuario->apellidos) }}</td>
                        <td>{{ $usuario->dni }}</td>
                        <td>{{ date('d-m-Y',strtotime($usuario->fecha)) }}</td>
                <?php $i++ ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade @if(!empty($nav) && $nav== 'registro') active in @endif" id="inscripcion" role="tabpanel" aria-labelledby="1">
            @if(session('status'))
            <div class="container">
                <div class="alert alert-success" style="margin-top: 20px;">
                    <h5 class="text-center">{{ session('status') }}</h5>
                </div>
            </div>
            @endif
            <form action="/inscripcionMultiple" method="POST">
                @csrf
                <div class="col-md-8" style="margin-top: 25px;">
                    <table class="table">
                        <thead>
                        <tr class="bg-primary">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Fecha Nacimiento</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td><input name="inscrito[]" type="checkbox" value="{{ $usuario->id }}"></td>
                                <td>{{ strtoupper($usuario->nombre) }}</td>
                                <td>{{  strtoupper($usuario->apellidos) }}</td>
                                <td>{{ $usuario->dni }}</td>
                                <td>{{ date('d-m-Y',strtotime($usuario->fecha)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4" style="margin-top: 25px;">
                    <label>Pruebas Abiertas</label>
                    <select name="pruebas" class="form-control">
                        @foreach($pruebas as $prueba)
                            @if(!empty($prueba->abierta) && $prueba->abierta == 'abierta')
                                <option>{{ $prueba->titulo }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary pull-right" style="margin-top:15px;">
                        <i class="fas fa-pencil-alt"></i> Inscribir atletas
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="incidencias" role="tabpanel" aria-labelledby="1">
            INCIDENCIAS
        </div>
    </div>
</div>
@endsection