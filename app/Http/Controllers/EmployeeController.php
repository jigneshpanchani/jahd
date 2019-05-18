<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
        $employees = $this->model->get();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'name' => 'required|unique:employees,name',
                'address' => 'required',
                /*'aadhar_card_no' => 'numeric|digits:12|unique:employees,aadhar_card_no'.$id,
                'contact_no' => 'numeric|digits:10',*/
            ]);
            if($validator->fails()){
                return redirect()->route('employee.create')->withErrors($validator)->withInput();
            }

            $inputArr = $request->only('name', 'aadhar_card_no', 'contact_no', 'dob', 'address', 'note');
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

    public function edit($id)
    {
        $result = $this->model->find($id);
        if($result){
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
                'name' => 'required|unique:employees,name,'.$id,
                'address' => 'required',
                /*'aadhar_card_no' => 'numeric|digits:12|unique:employees,aadhar_card_no'.$id,
                'contact_no' => 'numeric|digits:10',*/
            ]);
            if($validator->fails()){
                return redirect()->route('employee.edit', $id)->withErrors($validator)->withInput();
            }
            $updateArr = $request->only('name', 'aadhar_card_no', 'contact_no', 'dob', 'address', 'note');
            /*if(!empty($request->dob)){
                $updateArr['dob'] = Carbon::createFromFormat('d-m-Y',$request->dob)->format('Y-m-d');
            }*/
            $employee = $this->model->findOrFail($id);
            $res = $employee->update($updateArr);
            //$res = $this->model->find($id)->fill($updateArr)->save();
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
                return response()->json(['status' => 'success', 'msg' => 'Employee detail delete successfully.']);
            }else{
                return response()->json(['status' => 'error', 'msg' => 'Oops...Something want wrong. Please try again.']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
