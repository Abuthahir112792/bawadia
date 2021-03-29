<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $auth_id=Auth::id();
        $data=Review::orderBy('id','ASC')
        ->where('user_id',$auth_id)
        ->get();
       return $data;
    }
    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $user_id = Auth::user();
        $request->user_id=$user_id->id;
        $request->name=$user_id->name
         ;
        $validator = Validator::make($request->all(), [
            'rating' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            $response['data']=Review::create($request->all());
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
        $response['data'] = Review::find($id);
        if($response['data'])
        {
                $response['data']=$response['data']->delete();
                $response['status']=true;
        }
        else
        {
            $response['data']="Cuisine not Exist";  
        }
        return response()->json($response);

    }
}
