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
        $data['departments'] = $this->department->with('zone')->get();
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
            $filter = $request->input();
            $data['search'] = $filter;
            $data['result'] = $this->report->generateReport($request->input());
            if($filter['radio_type'] != 'E'){
                $count = count($data['result']);
                $displayCount = ($count > 0) ? " (Employee : $count)" : '';
            }elseif ($filter['radio_type'] == 'E' && $filter['employee_id'] == 'ALL'){
                $count = count($data['result']);
                $displayCount = ($count > 0) ? " (Employee : $count)" : '';
            }else{
                $displayCount = '';
            }
            $data['title'] = $this->makeTitle($request->input(), $displayCount);
            //dd($data);
            return view('report.show', $data);
        }else{
            return redirect()->route('report');
        }
    }

    public function makeTitle($data, $displayCount=''){

        if($data['radio_type'] == 'Z'){

            if(!empty($data['zone_id']) && $data['zone_id'] != 'ALL'){
                $res = $this->zone->find($data['zone_id']);
                $name = "Work Report of ".$res->name."'s Zone $displayCount";
            }else{
                $name = "All Zone's Work Report $displayCount";
            }

        }elseif($data['radio_type'] == 'D'){

            if(!empty($data['department_id']) && $data['department_id'] != 'ALL'){
                $res = $this->department->with('zone')->find($data['department_id']);
                $name = "Work Report of ". $res->zone->name. " with department of ". $res->name. $displayCount;
            }else{
                $name = "All Department's Work Report $displayCount";
            }

        }elseif($data['radio_type'] == 'E'){

            if(!empty($data['employee_id']) && $data['employee_id'] != 'ALL'){
                $res = $this->employee->with('department.zone')->find($data['employee_id']);
                $name = "Work Report of Employee ".$res->name." with ".$res->department->zone->name ." (".$res->department->name.") ";
            }else{
                $name = "All Employees's Work Report $displayCount";
            }
        }else{
            $name = "";
        }

        if(!empty($data['start_date']) && !empty($data['end_date'])){
            $dateRange = " At from " .date('d/m/Y', strtotime($data['start_date'])). " to " .date('d/m/Y', strtotime($data['end_date']));
        }else if(!empty($data['start_date'])){
            $dateRange = " At from " .date('d/m/Y', strtotime($data['start_date'])). " to Today";
        }else if(!empty($data['end_date'])){
            $dateRange = " Up to " .date('d/m/Y', strtotime($data['end_date']));
        }else{
            $dateRange = '';
        }

        $title = (!empty($name.$dateRange)) ? $name.$dateRange : "Work Report";
        return $title;
    }

}
