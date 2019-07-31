<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pruebas extends Model
{
    protected $fillable =['titulo','ciudad','federada','fecha','hora','distancia','pagina','circuito','normativa','portada','slug'];
    protected $table = 'pruebas';
}
