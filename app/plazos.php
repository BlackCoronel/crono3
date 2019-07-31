<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plazos extends Model
{
    protected $fillable = ['id_carrera','plazo','fin','precio'];

    protected $table = "plazos";
}
