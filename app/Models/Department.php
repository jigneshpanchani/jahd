<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable =[
        'name',
        'price',
        'note'
    ];
}
