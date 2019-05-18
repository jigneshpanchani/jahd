<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    private $model;
    public function __construct(Work $work)
    {
        $this->model = $work;
    }
    
    public function index()
    {
        $works = $this->model->with('employee', 'department')->get();
        return view('work.index', compact('works'));
    }

    public function create(Employee $employee, Department $department)
    {
        $data['employees'] = $employee->get();
        $data['departments'] = $department->get();
        return view('work.create', $data);
    }

    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'date' => 'required',
                'employee_id' => 'required',
                'department_id' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric|min:1',
                'withdrawal' => 'required|numeric',
                'salary' => 'required|numeric'
            ]);
            if($validator->fails()){
                return redirect()->route('work.create')->withErrors($validator)->withInput();
            }

            $inputArr = $request->only('date', 'employee_id', 'department_id', 'price', 'quantity', 'withdrawal', 'salary', 'note');
            $inputArr['total'] = ($request->price * $request->quantity);
                /*if(!empty($request->date)){
                    $inputArr['date'] = Carbon::createFromFormat('d.m.Y',$request->date)->format('Y-m-d');
                }*/

            $this->model->create($inputArr);
            $request->session()->flash('success', 'Work add successfully');
            return redirect()->route('work.create');
        }catch(\Exception $e){
            return redirect()->route('work.create')->with('error', $e->getMessage())->withInput();
        }
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id, Employee $employee, Department $department)
    {
        $result = $this->model->find($id);
        if($result){
            $data['employees'] = $employee->get();
            $data['departments'] = $department->get();
            $data['result'] = $result;
            return view('work.edit', $data);
        }else{
            return redirect()->route('work.index');
        }
    }
    
    public function update(Request $request, $id)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'date' => 'required',
                'employee_id' => 'required',
                'department_id' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric|min:1',
                'withdrawal' => 'required|numeric',
                'salary' => 'required|numeric',
                /*'contact_no' => 'numeric|digits:10',*/
            ]);
            if($validator->fails()){
                return redirect()->route('work.edit', $id)->withErrors($validator)->withInput();
            }
            $updateArr = $request->only('date', 'employee_id', 'department_id', 'price', 'quantity', 'withdrawal', 'salary', 'note');
            $updateArr['total'] = ($request->price * $request->quantity);
            //echo "<pre>";print_r($updateArr);die;
            $work = $this->model->findOrFail($id);
            $res = $work->update($updateArr);

            if($res){
                $request->session()->flash('success', 'Work info update successfully');
            }else{
                $request->session()->flash('error', 'Something want wrong. Please try again.');
            }
            return redirect()->route('work.edit', $id);
        }catch(\Exception $e){
            return redirect()->route('work.edit', $id)->with('error', $e->getMessage())->withInput();
        }
    }
    
    public function destroy($id)
    {
        try{
            $work = $this->model->findOrFail($id);
            $res = $work->delete($id);
            if($res){
                return response()->json(['status' => 'success', 'msg' => 'Work detail delete successfully.']);
            }else{
                return response()->json(['status' => 'error', 'msg' => 'Oops...Something want wrong. Please try again.']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}