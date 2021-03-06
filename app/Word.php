<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Word extends Model
{

    protected $fillable = [
        'name', 'category', 'letters',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public static function scopeCategorise($query) {

        return $query ->orderBy('category_id', 'desc');
    }

    
}
