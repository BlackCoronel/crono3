@extends('welcome')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <h1 style="font-size:20px; margin-bottom: 10px;">INSCRIPCIÓN {{ strtoupper($prueba[0]->titulo) }}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="{{ $prueba[0]->portada }}" alt="" class="img-thumbnail hvr-float-shadow img-fluid" style="box-shadow: 4px 4px 4px rgba(0,0,0,0.22);">
                    </div>
                </div>
                <div class="col-md-8" style="margin-top: 30px;">
                    <h4 style="margin-bottom: 10px;">Cuota de la carrera</h4>
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
                            @if(date('d-m-Y') >= date('d-m-Y',strtotime($plazo->plazo)) && date('d-m-Y') <= date('d-m-Y',strtotime($plazo->fin)))
                            <tr>
                                <th scope="row">{{ $i . 'º '}} Plazo </th>
                                <td>{{ date('d/m/Y',strtotime($plazo->plazo)) }} - {{ date('d/m/Y',strtotime($plazo->fin)) }}</td>
                                <td>{{ $plazo->precio }}€</td>
                            </tr>
                            @endif
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if(! Auth::check())
                <div class="col-md-6" style="margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLogin" style="margin-right: 25px;">
                        <i class="far fa-user"></i> Iniciar sesión
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-user-tag"></i> Registrarse
                    </button>
                </div>
            @if(session('alert'))
                    <div class="col-md-6">
                        <div class="alert alert-danger" style="margin-top: 20px;">
                            <h5 class="text-center">{{ session('alert') }}</h5>
                        </div>
                    </div>
            @endif
            <div class="col-md-6">
                <form action="/pagar/{{ $prueba[0]->titulo }}" method="POST">
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
                            <label for="inputCity">Club</label>
                            <input type="text" class="form-control" id="buscar" placeholder="🔎 Buscar club...">
                            <span id="resultados" style="display: none;">Buscando resultados...</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Su club*</label>
                            <select name="club" class="form-control" id="clubes">
                                <option>INDEPENDIENTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputCity">Nombre dorsal</label>
                            <input type="text" class="form-control" name="ndorsal" placeholder="Nombre dorsal">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputCity">Observaciones</label>
                            <textarea name="observaciones" class="form-control" placeholder="Observaciones..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success pull-left btn-sm" style="margin-right: 5px;">
                            <i class="far fa-credit-card"></i> Pagar
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i> Limpiar campos
                        </button>
                        <a href="/pruebas/{{ $prueba[0]->slug }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-undo"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
                @elseif(Auth::check())
                <div class="col-md-6">
                    <form action="/pagar/{{ $prueba[0]->titulo }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre*</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{ Auth::user()->name }}">
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
                                <label for="inputCity">Sexo*</label>
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
                            <div class="form-group col-md-5">
                                <label for="inputCity">Su club*</label>
                                <select name="club" class="form-control" id="clubes">
                                    <option>INDEPENDIENTE</option>
                                </select>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="inputCity">Nombre dorsal</label>
                                <input type="text" class="form-control" name="ndorsal" placeholder="Nombre dorsal" value="{{ Auth::user()->cpostal }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputCity">Observaciones</label>
                                <textarea name="observaciones" class="form-control" placeholder="Observaciones..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success pull-left btn-sm" style="margin-right: 5px;">
                                <i class="far fa-credit-card"></i> Pagar
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt"></i> Limpiar campos
                            </button>
                            <a href="/pruebas/{{ $prueba[0]->slug }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-undo"></i> Volver
                            </a>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection