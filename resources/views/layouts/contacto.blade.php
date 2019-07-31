@extends('welcome')

@section('content')
<!--
   =====================================================
       Contact Section
   =====================================================
   -->
<div id="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="clear-fix contact-address-content">
                    <div class="left-side">
                        <h2>Información de contacto</h2>
                        <p>Si tiene cualquier duda o incidencia, no dude en ponerse en contacto con nosotros. Le atenderemos en un plazo de 24H máximo</p>
                        <ul>
                            <li>
                                <div class="icon tran3s round-border p-color-bg"><i class="fas fa-phone" aria-hidden="true"></i></div>
                                <h6>Fax</h6>
                                <p>+88 01911854378</p>
                            </li>
                            <li>
                                <div class="icon tran3s round-border p-color-bg"><i class="fas fa-envelope" aria-hidden="true"></i></div>
                                <h6>Email</h6>
                                <p>info@crono3.es</p>
                            </li>
                        </ul>
                    </div> <!-- /.left-side -->
                </div> <!-- /.col- -->
            </div> <!-- /.contact-address-content -->
            <!-- Contact Form -->
            <div class="col-md-6 send-message" style="margin-top: 30px;padding: 15px;">
                <h2>Enviar Mensaje</h2>
                <form action="/contacto" class="form-validation" autocomplete="off" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-input">
                                <input type="text" placeholder="Nombre" name="nombre">
                            </div> <!-- /.single-input -->
                        </div>
                        <div class="col-md-6">
                            <div class="single-input">
                                <input type="text" placeholder="Apellidos" name="apellidos">
                            </div> <!-- /.single-input -->
                        </div>
                    </div> <!-- /.row -->
                    <div class="single-input">
                        <input type="email" placeholder="correo electrónico" name="email">
                    </div> <!-- /.single-input -->
                    <div class="single-input">
                        <input type="text" placeholder="Asunto" name="asunto">
                    </div> <!-- /.single-input -->
                    <textarea placeholder="Escriba su mensaje" name="message"></textarea>


                    <button class="tran3s p-color-bg"><b>Enviar mensaje</b></button>
                </form>
            </div> <!-- /.send-message -->
        </div>
    </div> <!-- /.container -->
</div> <!-- /#contact-section -->
@endsection
