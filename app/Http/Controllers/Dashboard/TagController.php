<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tag;
use Auth;
use DB;
class TagController extends Controller
{
    public function index()
    {
        $data=Tag::orderBy('id','ASC')
       ->get();
       return $data;
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            $response['data']=Tag::create($request->all());
            DB::commit();
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
            'name' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);

        DB::beginTransaction();
        try {
            $response['data']=Tag::where('id',$id)
            ->update($request->all());
            DB::commit();
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
        $response['data'] = Tag::find($id);
        if($response['data'])
        {
                $response['data']=$response['data']->delete();
                $response['status']=true;
        }
        else
        {
            $response['data']="Tag not Exist";  
        }
        return response()->json($response);

    }
}