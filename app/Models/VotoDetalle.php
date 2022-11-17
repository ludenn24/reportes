<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotoDetalle extends Model
{
    protected $table = 'tb_elector_voto';

    protected $fillable = [
        'codigo',
        'id_elector',
        'id_usuario',
        'mesa',
        'hora',
        'created_at',
        'updated_at'
    ];
}
