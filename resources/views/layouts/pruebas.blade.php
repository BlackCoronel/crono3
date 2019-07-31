@extends('welcome')

@section('content')
    <div id="pricing-section">
        <div class="container">
            <div class="clear-fix">
                @foreach($pruebas as $prueba)
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-price-table hvr-float-shadow" style="padding-top: 0px;">
                            <img src="{{ $prueba->portada }}" alt="{{ $prueba->titulo }}">
                            <h6>{{ $prueba->titulo }}</h6>
                            <p style="font-weight: bold; font-size: 18px;">{{ strtoupper($prueba->ciudad) }}</p>
                            <p style="margin-top:-10px;font-weight: bold; font-size: 18px;">{{ date('d-m-Y', strtotime($prueba->fecha)) }}</p>
                            <a href="/pruebas/{{ $prueba->slug }}" class="tran3s p-color-bg">INSCRIBIRSE</a>
                        </div> <!-- /.single-price-table -->
                    </div> <!-- /.col -->
                @endforeach
            </div>
        </div> <!-- /.container -->
    </div> <!-- /#pricing-section -->
@endsection