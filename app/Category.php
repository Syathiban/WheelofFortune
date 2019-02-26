<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

   public function words()
   {
       return $this->hasMany('App\Word');
   }

   public function questions()
   {
       return $this->hasMany('App\Question');
   }
}
