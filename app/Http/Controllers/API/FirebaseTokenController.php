<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\FirebaseToken;
class FirebaseTokenController extends Controller
{   
    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        DB::beginTransaction();
        try {
            $response['data']=FirebaseToken::create([
                'user_id' => $auth_id,
                'token' => $request->token,
                'ip' => $request->ip,
                'device_name' => $request->device_name,
            ]);           
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
        $response['data'] = FirebaseToken::where('user_id',$id)
        ->get();
        if(count($response['data']))
        {
            $response['data'] = Favourite::where('user_id',$id)
            ->delete();
            $response['status']=true;
        }
        else
        {
            $response['data']="User Token doesn't exist";  
        }
        return response()->json($response);

    }
}
