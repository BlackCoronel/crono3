@extends('welcome')

@section('content')
<div class="container" style="margin-top: 150px;">
    <div class="alert alert-info text-center" role="alert">
        <h4 class="alert-heading"><i class="fas fa-user-circle"></i> DATOS PERSONALES</h4>
        <a href="/panel_usuario" class="pull-right" style="font-weight: bold;">
            <i class="fas fa-arrow-left"></i> VOLVER
        </a>
        <p>Aquí puedes modificar tus datos personales, en caso de error o para futuras pruebas.</p>
        <hr>
        <p class="mb-0">Ten en cuenta que modificar estos datos no afectará a las pruebas que estás inscrito, si quieres modificar alguna de tus inscripciones, haz
            <a href="/mispruebas">click aquí</a>
        </p>
    </div>
</div>
<div class="container">
    <button class="btn btn-success btn-lg pull-right"  data-toggle="modal" data-target="#modificarPerfil" style="font-weight: bold;">
        <i class="fas fa-edit"> MODIFICAR PERFIL</i>
    </button>
</div>

<div class="container" style="margin-bottom: 250px;">
    <div class="col-md-6">
        <dl class="row">
            <dt class="col-sm-4">Nombre: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->name }}
            </dd>
            <dt class="col-sm-4">Apellidos: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->apellidos }}
            </dd>
            <dt class="col-sm-4">Email: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->email }}
            </dd>
            <dt class="col-sm-4">DNI/NIF: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->dni }}
            </dd>
            <dt class="col-sm-4">Fecha Nacimiento: </dt>
            <dd class="col-sm-8">
                {{ date('d-m-Y',strtotime(Auth::user()->fecha)) }}
            </dd>
            <dt class="col-sm-4">Domicilio: </dt>
            <dd class="col-sm-8">
                @if(Auth::user()->domicilio != null){{ Auth::user()->domicilio }}@else - @endif
            </dd>
            <dt class="col-sm-4">Localidad: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->localidad }}
            </dd>
            <dt class="col-sm-4">Sexo: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->sexo }}
            </dd>

        </dl>
    </div>
    <div class="col-md-6">
        <dl class="row">
            <dt class="col-sm-4">Codigo postal: </dt>
            <dd class="col-sm-8">
                @if(Auth::user()->cpostal != null){{ Auth::user()->cpostal }}@else - @endif
            </dd>
            <dt class="col-sm-4">Licencia: </dt>
            <dd class="col-sm-8">
                @if(Auth::user()->licencia != null){{ Auth::user()->licencia }}@else - @endif
            </dd>
            <dt class="col-sm-4">Telefono: </dt>
            <dd class="col-sm-8">
                @if(Auth::user()->telefono != null){{ Auth::user()->telefono }}@else - @endif
            </dd>
            <dt class="col-sm-4">Talla: </dt>
            <dd class="col-sm-8">
                {{ Auth::user()->talla }}
            </dd>
            <dt class="col-sm-4">Club: </dt>
            <dd class="col-sm-8">
                {{ $club[0]->club }}
            </dd>
            <dt class="col-sm-4">Nombre Dorsal: </dt>
            <dd class="col-sm-8">
                @if(Auth::user()->nombre_dorsal != null){{ Auth::user()->nombre_dorsal }}@else - @endif
            </dd>
            <dt class="col-sm-4">Observaciones: </dt>
            <dd class="col-sm-8">
                @if(Auth::user()->observaciones != null){{ Auth::user()->observaciones }}@else - @endif
            </dd>
        </dl>
    </div>
</div>
    <div class="modal fade" id="modificarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-user"></i> Modificar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/modificar_perfil" method="POST">
                <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre*</label>
                                <input type="nombre" class="form-control" name="nombre" placeholder="Nombre" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Apellidos*</label>
                                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="{{ Auth::user()->apellidos }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress">DNI*</label>
                            <input type="text" class="form-control" name="dni" placeholder="NIF/DNI" value="{{ Auth::user()->dni }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress2">Email*</label>
                            <input type="email" class="form-control" name="email" placeholder="ejemplo@ejemplo.com" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Domicilio</label>
                                <input type="text" class="form-control" name="domicilio" placeholder="Domicilio" value="{{ Auth::user()->domicilio }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Localidad*</label>
                                <input type="text" class="form-control" name="localidad" placeholder="Localidad" value="{{ Auth::user()->localidad }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCity">Código Postal</label>
                                <input type="text" class="form-control" name="cpostal" placeholder="C.Postal" value="{{ Auth::user()->cpostal }}">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputCity">Fecha Nacimiento*</label>
                                <input type="date" class="form-control" name="nacimiento" value="{{ Auth::user()->fecha }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Sexo</label>
                                <select name="sexo" class="form-control">
                                    <option>Seleccionar sexo...</option>
                                    <option @if(Auth::user()->sexo == "Hombre") selected @endif>Hombre</option>
                                    <option @if(Auth::user()->sexo == "Mujer") selected @endif>Mujer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="inputCity">Licencia</label>
                                <input type="text" class="form-control" name="licencia" placeholder="Licencia" value="{{ Auth::user()->licencia }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" placeholder="Teléfono" value="{{ Auth::user()->telefono }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Talla*</label>
                                <select name="talla" class="form-control">
                                    <option>Talla...</option>
                                    <option @if(Auth::user()->talla == "3_4") selected @endif>3_4</option>
                                    <option @if(Auth::user()->talla == "5_6") selected @endif>5_6</option>
                                    <option @if(Auth::user()->talla == "7_8") selected @endif>7_8</option>
                                    <option @if(Auth::user()->talla == "9_11") selected @endif>9_11</option>
                                    <option @if(Auth::user()->talla == "12_14") selected @endif>12_14</option>
                                    <option @if(Auth::user()->talla == "S") selected @endif>S</option>
                                    <option @if(Auth::user()->talla == "M") selected @endif>M</option>
                                    <option @if(Auth::user()->talla == "L") selected @endif>L</option>
                                    <option @if(Auth::user()->talla == "XL") selected @endif>XL</option>
                                    <option @if(Auth::user()->talla == "XXL") selected @endif>XXL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Club</label>
                                <input type="text" class="form-control" id="buscar" placeholder="🔎 Buscar club...">
                                <span id="resultados" style="display: none;">Buscando resultados...</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Su club*</label>
                                <select name="club" class="form-control" id="clubes">
                                    <option>{{ $club[0]->club }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputCity">Nombre dorsal</label>
                                <input type="text" class="form-control" name="ndorsal" placeholder="Nombre dorsal" value="{{ Auth::user()->nombre_dorsal }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputCity">Observaciones</label>
                                <textarea name="observaciones" class="form-control" placeholder="Observaciones...">{{ Auth::user()->observaciones }}</textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar Perfil</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection