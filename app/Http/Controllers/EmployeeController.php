<?php

namespace App\Http\Controllers;

use App\models\Department;
use App\Models\Employee;
use App\Models\Zone;
use App\Models\zones;
use Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $model;
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function index()
    {
        $data['employees'] = $this->model->with('department')->get();
        return view('employee.index', $data);
    }

    public function create(Department $department)
    {
        $data['departments'] = $department->with('zone')->get();
        return view('employee.create', $data);
    }

    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'department_id' => 'required',
                'name' => 'required|unique:employees,name',
                /*'aadhar_card_no' => 'numeric|digits:12|unique:employees,aadhar_card_no'.$id,
                'contact_no' => 'numeric|digits:10',*/
                'address' => 'required',
            ]);
            if($validator->fails()){
                return redirect()->route('employee.create')->withErrors($validator)->withInput();
            }

            $inputArr = $request->only('department_id', 'name', 'contact_no', 'address', 'note');
            /*if(!empty($request->dob)){
                $inputArr['dob'] = Carbon::createFromFormat('d-m-Y',$request->dob)->format('Y-m-d');
            }*/
            $this->model->create($inputArr);
            $request->session()->flash('success', 'New employee add successfully');
            return redirect()->route('employee.create');
        }catch(\Exception $e){
            return redirect()->route('employee.create')->with('error', $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Department $department)
    {
        $result = $this->model->find($id);
        if($result){
            $data['departments'] = $department->with('zone')->get();
            $data['result'] = $result;
            return view('employee.edit', $data);
        }else{
            return redirect()->route('employee.index');
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'department_id' => 'required',
                'name' => 'required|unique:employees,name,'.$id,
                'address' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('employee.edit', $id)->withErrors($validator)->withInput();
            }
            $updateArr = $request->only('department_id', 'name', 'contact_no', 'address', 'note');
            $employee = $this->model->findOrFail($id);
            $res = $employee->update($updateArr);
            if($res){
                $request->session()->flash('success', 'Employee info update successfully');
            }else{
                $request->session()->flash('error', 'Something want wrong. Please try again.');
            }
            return redirect()->route('employee.edit', $id);
        }catch(\Exception $e){
            return redirect()->route('employee.edit', $id)->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $employee = $this->model->findOrFail($id);
            $res = $employee->delete($id);
            if($res){
                return response()->json(['title' => 'Deleted!', 'status' => 'success', 'msg' => 'Employee detail delete successfully.']);
            }else{
                return response()->json(['title' => 'Not Deleted!', 'status' => 'error', 'msg' => 'Oops...Something want wrong. Please try again.']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function getInfo(Zone $zone, Request $request){
        $data = $this->model->with('department')->find($request->employeeId);
        if($data->department->zone_id > 0){
            $data->department->zone_name = $zone->find($data->department->zone_id)->name;
        }
        return $data;
    }
}
