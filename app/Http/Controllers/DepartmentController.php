<?php

namespace App\Http\Controllers;

use App\models\department;
use App\Models\Zone;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $department;
    public function __construct(Zone $zone, department $department)
    {
        $this->zone = $zone;
        $this->department = $department;
    }

    public function index()
    {
        $data['departments'] = $this->department->with('zone')->get();
        return view('department.index', $data);
    }

    public function create()
    {
        $data['zones'] = $this->zone->get();
        return view('department.create', $data);
    }

    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'zone_id' => 'required',
                'name' => 'required',
                'price' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('department.create')->withErrors($validator)->withInput();
            }

            $inputArr = $request->only('zone_id','name', 'price', 'note');
            $this->department->create($inputArr);
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
        $data['zones'] = $this->zone->get();
        $result = $this->department->find($id);
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
                'name' => 'required',
                'price' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->route('department.edit', $id)->withErrors($validator)->withInput();
            }
            $updateArr = $request->only('name', 'price', 'note');
            $department = $this->department->findOrFail($id);
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
            $department = $this->department->findOrFail($id);
            $res = $department->delete($id);
            if($res){
                return response()->json(['title' => 'Deleted!', 'status' => 'success', 'msg' => 'Department detail delete successfully.']);
            }else{
                return response()->json(['title' => 'Not Deleted!', 'status' => 'error', 'msg' => 'Oops...Something want wrong. Please try again.']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function getPrice(Request $request){
        return $this->department->findOrFail($request->departmentId)->price;
    }
}
