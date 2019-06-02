<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable =[
        'department_id',
        'name',
        'contact_no',
        'address',
        'note'
    ];

    public function works(){
        return $this->hasMany(Work::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
