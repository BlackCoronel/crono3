<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosRedsys extends Model
{
    // Modelo para crear la referencia de un nuevo pago

    protected $fillable = ['id_inscrito','referencia','respuesta'];

    protected $table = 'pagos';
}
