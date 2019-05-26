<?php

namespace App\Http\Controllers;

use App\models\department;
use App\Models\employee;
use App\Models\Report;
use App\Models\work;
use App\Models\Zone;
use Illuminate\Http\Request;
use DB;

class reportController extends Controller
{
    private $zone;
    private $work;
    private $report;
    private $employee;
    private $department;

    public function __construct(Zone $zone, Work $work, Report $report,Employee $employee, Department $department)
    {
        $this->zone = $zone;
        $this->work = $work;
        $this->report = $report;
        $this->employee = $employee;
        $this->department = $department;
    }

    public function index(Request $request)
    {
        $data['zones'] = $this->zone->get();
        $data['employees'] = $this->employee->get();
        $data['departments'] = $this->department->get();
        $data['apply_filter'] = 'no';
        if($request->input()){
            $data['result'] = $this->report->generateReport($request->input());
            $data['apply_filter'] = 'yes';
            return view('report.index', $data);
        }
        return view('report.index', $data);
    }

    public function generate(Request $request){
        if($request->input()){
            $data['result'] = $this->report->generateReport($request->input());
            return view('report.show', $data);
        }else{
            return redirect()->route('report');
        }
    }

}
