<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ZoneController extends Controller
{
    private $model;
    public function __construct(Zone $zone)
    {
        $this->model = $zone;
    }
    public function index()
    {
        $zones = $this->model->get();
        return view('zone.index', compact('zones'));
    }

    public function create()
    {
        return view('zone.create');
    }

    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'name' => 'required|unique:zones,name'
            ]);
            if($validator->fails()){
                return redirect()->route('zone.create')->withErrors($validator)->withInput();
            }

            $inputArr = $request->only('name', 'note');
            //dd($inputArr);
            $this->model->create($inputArr);
            $request->session()->flash('success', 'New zone add successfully');
            return redirect()->route('zone.create');
        }catch(\Exception $e){
            return redirect()->route('zone.create')->with('error', $e->getMessage())->withInput();
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
            return view('zone.edit', $data);
        }else{
            return redirect()->route('zone.index');
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'name' => 'required|unique:zones,name,'.$id
            ]);
            if($validator->fails()){
                return redirect()->route('zone.edit', $id)->withErrors($validator)->withInput();
            }
            $updateArr = $request->only('name', 'note');
            $zone = $this->model->findOrFail($id);
            $res = $zone->update($updateArr);

            if($res){
                $request->session()->flash('success', 'Zone info update successfully');
            }else{
                $request->session()->flash('error', 'Something want wrong. Please try again.');
            }
            return redirect()->route('zone.edit', $id);
        }catch(\Exception $e){
            return redirect()->route('zone.edit', $id)->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $zone = $this->model->findOrFail($id);
            $this->historyAdd($zone);
            $res = $zone->delete($id);
            if($res){
                return response()->json(['title' => 'Deleted!', 'status' => 'success', 'msg' => 'Zone detail delete successfully.']);
            }else{
                return response()->json(['title' => 'Not Deleted!', 'status' => 'error', 'msg' => 'Oops...Something want wrong. Please try again.']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function historyAdd($data){
        $logArr = array(
            'data' =>json_encode($data),
            'description' => 'Delete single zone',
            'user_id' => Auth::user()->id
        );
        DB::table('log')->insert($logArr);
        return TRUE;
    }

}
