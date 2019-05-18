<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable =[
        'date',
        'employee_id',
        'department_id',
        'price',
        'quantity',
        'total',
        'withdrawal',
        'salary',
        'note'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
