<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuarioClub extends Model
{
   protected $fillable = [
       'nombre',
       'apellidos',
       'email', //opcional
       'dni',
       'fecha',
       'domicilio', //opcional
       'localidad',
       'sexo',
       'cpostal', //opcional
       'licencia', //opcional
       'telefono', //opcional
       'talla', //opcional
       'club',
       'nombre_dorsal', //opcional
       'observaciones' //opcional
   ];

   protected $table = "usuarios_club";
}
