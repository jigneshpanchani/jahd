<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Report extends Model
{
    public function generateReport($data)
    {
        $type = $data['radio_type'];
        $start = $data['start_date'];
        $end = $data['end_date'];

        $whereArr = array();
        if($type == 'Z')
        {
            if((!empty($data['zone_id'])) && ($data['zone_id'] != 'ALL')){
                $whereArr[] = ['d.zone_id', '=', $data['zone_id']];
            }
            $groupByArr = ['e.id'];
        }
        else if($type == 'E')
        {
            if((!empty($data['employee_id'])) && ($data['employee_id'] != 'ALL')){
                $whereArr[] = ['e.id', '=', $data['employee_id']];
                $groupByArr = ['w.id'];
            } else if ($data['employee_id'] == 'ALL'){
                $groupByArr = ['e.id'];
            }
        }else{
            $groupByArr = ['w.id'];
        }

        if(!empty($start) && !empty($end)){
            $whereArr[] = ['w.date', '>=', $start];
            $whereArr[] = ['w.date', '<=', $end];
        }else if(!empty($start)){
            $whereArr[] = ['w.date', '>=', $start];
        }else if(!empty($end)){
            $whereArr[] = ['w.date', '<=', $end];
        }else{
            //
        }
        //dd($whereArr);

        $res = DB::table('works AS w')
            ->join('employees AS e', 'e.id', '=', 'w.employee_id')
            ->join('departments AS d', 'd.id', '=', 'w.department_id')
            ->join('zones AS z', 'z.id', '=', 'd.zone_id')
            ->where($whereArr)
            ->select(
                'e.id',
                'e.name AS employee_name',
                'd.name AS department_name',
                'z.name AS zone_name',
                'w.date',
                'w.price',
                DB::raw('SUM(w.quantity) as quantity'),
                DB::raw('SUM(w.withdrawal) as withdrawal'),
                DB::raw('SUM(w.salary) as salary'),
                DB::raw('SUM(w.total) as total')
                )
            ->groupBy($groupByArr)
            ->orderBy('w.date', 'DESC')
            ->get();

        return $res;
//        dd($res);
    }
}
