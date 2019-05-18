<?php

namespace App\Http\Controllers;

use App\models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $model;
    public function __construct(department $department)
    {
        $this->model = $department;
    }

    public function index()
    {
        $departments = $this->model->get();
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'name' => 'required|unique:departments,name',
                'price' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('department.create')->withErrors($validator)->withInput();
            }

            $inputArr = $request->only('name', 'price', 'note');
            $this->model->create($inputArr);
            $request->session()->flash('success', 'New department add successfully');
            return redirect()->route('department.create');
        }catch(\Exception $e){
            return redirect()->route('department.create')->with('error', $e->getMessage())->withInput();
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
            return view('department.edit', $data);
        }else{
            return redirect()->route('department.index');
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'name' => 'required|unique:departments,name,'.$id,
                'price' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('department.edit', $id)->withErrors($validator)->withInput();
            }
            $updateArr = $request->only('name', 'price', 'note');
            $department = $this->model->findOrFail($id);
            $res = $department->update($updateArr);

            if($res){
                $request->session()->flash('success', 'Department info update successfully');
            }else{
                $request->session()->flash('error', 'Something want wrong. Please try again.');
            }
            return redirect()->route('department.edit', $id);
        }catch(\Exception $e){
            return redirect()->route('department.edit', $id)->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $department = $this->model->findOrFail($id);
            $res = $department->delete($id);
            if($res){
                return response()->json(['status' => 'success', 'msg' => 'Department detail delete successfully.']);
            }else{
                return response()->json(['status' => 'error', 'msg' => 'Oops...Something want wrong. Please try again.']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function getPrice(Request $request){
        return $this->model->findOrFail($request->departmentId)->price;
    }
}
