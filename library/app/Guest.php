<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
        //es necesario agregar todos los campos que pueden ser llenados de manera masiva
        protected $fillable = ['name', 'id'];
}
