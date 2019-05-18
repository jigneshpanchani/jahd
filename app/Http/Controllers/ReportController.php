<?php

namespace App\Http\Controllers;

use App\models\department;
use App\Models\employee;
use App\Models\work;
use Illuminate\Http\Request;

class reportController extends Controller
{
    private $work;
    private $employee;
    private $department;

    public function __construct(work $work, employee $employee, department $department)
    {
        $this->work = $work;
        $this->employee = $employee;
        $this->department = $department;
    }

    public function index(Request $request)
    {
        $data['employees'] = $this->employee->get();
        $data['departments'] = $this->department->get();

        if($request->input()){
            //dd($_POST);
            $eid = $request->input('employee_id');
            $employee = Employee::find($eid);
            $works = $employee->works;
            $data['employee'] = $employee;
            $data['works'] = $works;

            return view('report.index', $data);
        }
        return view('report.index', $data);
    }

    public function add(Request $request){
        if($request->all()){
            dd($_POST);
        }
        return view('report.show');
    }
}
