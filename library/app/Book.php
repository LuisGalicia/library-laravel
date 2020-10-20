<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
      //es necesario agregar todos los campos que pueden ser llenados de manera masiva
      protected $fillable = ['name','author','published_date','available','category_id','guest_id', 'id'];
}
