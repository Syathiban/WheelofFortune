<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $filltable = ['question', 'answer', 'category'];
}
