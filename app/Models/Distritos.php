<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
    protected $table = 'tb_distritos';

    protected $fillable = [

        'idDist',
        'distrito',
        'idProv',

    ];
}
