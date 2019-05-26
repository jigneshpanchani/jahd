<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable =[
        'zone_id',
        'name',
        'aadhar_card_no',
        'contact_no',
        'dob',
        'address',
        'note'
    ];

    public function works(){
        return $this->hasMany(Work::class);
    }

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
}
