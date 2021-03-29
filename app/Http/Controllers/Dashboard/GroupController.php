<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Group;
use Auth;
use DB;

class GroupController extends Controller
{
    
    public function index()
    {
        $data=Group::orderBy('id','DESC')
        ->get();
       return $data;
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $create=Group::create([
                'user_id' => $auth_id,
                'name' => $request->name,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'image' => $request->image,
                'status' => $request->status,
            ]);            
            DB::commit();
            $response['data'] = Group::find($create->id);
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
    }

  
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            Group::where('id',$id)
            ->update([
                'name' => $request->name,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'image' => $request->image,
                'status' => $request->status,
            ]);
           
            DB::commit();
            $response['data'] = Group::find($id);
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }

        return response()->json($response);
    }

   
    public function destroy($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] = Group::find($id);
        if($response['data'])
        {
                $response['data']=$response['data']->delete();
                $response['status']=true;
           
        }
        else
        {
            $response['data']="Group not Exist";  
        }
        return response()->json($response);
    }
}
