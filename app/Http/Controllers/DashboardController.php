<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $employee;
    private $department;
    public function __construct(Employee $employee, Department $department)
    {
        $this->employee = $employee;
        $this->department = $department;
    }

    public function index()
    {
        $data['employee'] = $this->employee->count();
        $data['department'] = $this->department->count();
        return view('dashboard', $data);
    }
}
