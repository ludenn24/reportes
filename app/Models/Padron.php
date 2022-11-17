<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Padron extends Model
{
    protected $table = 'tb_electores';

    protected $fillable = [
        'codigo',
        'ubigeo',
        'departamento',
        'provincia',
        'distrito',
        'voto',
        'dni',
        'apepat',
        'apemat',
        'nombres',
    ];
}
