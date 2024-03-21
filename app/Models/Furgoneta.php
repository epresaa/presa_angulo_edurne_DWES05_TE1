<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furgoneta extends Vehiculo
{
    protected $table = 'furgonetas';

    protected $fillable  = [
        'matricula', 'tipo', 'marca', 'modelo', 'anio', 'color', 'precio', 'km', 'combustible', 'tamanio', 'volumen_carga_m3'
    ];
}
