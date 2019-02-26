<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

   public function word()
   {
       return $this->hasMany('App\Word');
   }

   public function question()
   {
       return $this->hasMany('App\Question');
   }
}
