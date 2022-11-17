<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geo extends Model
{
    protected $table = 'tb_geo';

    protected $fillable = [
        'geo_id',
        'programa_id',
        'descripcion_actividad',
        'latitud',
        'longitud',
        'created_at',
        'updated_at',
    ];
}
