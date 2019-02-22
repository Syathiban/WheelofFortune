<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Word extends Model
{

    protected $fillable = [
        'name', 'category', 'letters',
    ];

    
}
