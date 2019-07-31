<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscripciones extends Model
{
    // Modelo para las inscripciones

    protected $fillable = [
        'id_prueba',
        'nombre',
        'apellidos',
        'email',
        'dni',
        'fecha',
        'domicilio',
        'localidad',
        'sexo',
        'cpostal',
        'licencia',
        'telefono',
        'talla',
        'club',
        'nombre_dorsal',
        'observaciones'
    ];

    protected $table = 'inscripciones';
}
