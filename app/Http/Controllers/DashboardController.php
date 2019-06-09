<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Zone;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $employee;
    private $department;
    public function __construct(Employee $employee, Department $department, Zone $zone)
    {
        $this->employee = $employee;
        $this->department = $department;
        $this->zone = $zone;
    }

    public function index()
    {
        $data['employee'] = $this->employee->count();
        $data['department'] = $this->department->count();
        $data['zone'] = $this->zone->count();
        return view('dashboard', $data);
    }
}
