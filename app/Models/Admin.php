<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'ta_usuarios';

    protected $fillable = [
           'codigo',
            'dni',
            'nombres',
            'apellidos',
            'correo',
            'login',
            'clave',
            'foto',
            'tipo',
            'fregistro',
            'flag',
    ];
}
