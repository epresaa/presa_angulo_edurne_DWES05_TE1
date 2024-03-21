<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Vehiculo
{
    protected $table = 'coches';

    protected $fillable  = [
        'matricula', 'tipo', 'marca', 'modelo', 'anio', 'color', 'precio', 'km', 'combustible', 'categoria'
    ];
}
