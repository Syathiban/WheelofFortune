<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $filltable = ['question', 'answer', 'category'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
