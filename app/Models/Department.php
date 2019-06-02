<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable =[
        'zone_id',
        'name',
        'price',
        'note'
    ];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
}
