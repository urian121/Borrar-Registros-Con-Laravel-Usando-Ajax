<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $fillable = [
        'nombre','edad','sexo'
    ];
}
