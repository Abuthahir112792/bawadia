<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\ShippingAddress;
class ShippingController extends Controller
{
    public function index()
    {
        $data=ShippingAddress::orderBy('id','ASC')
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
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'contact' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $response['data']=ShippingAddress::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'contact' => $request->contact,
                'lat' => $request->lat,
                'lon' => $request->lon,
            ]);           
            DB::commit();
            $response['data']= ShippingAddress::find($response['data']->id);
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
        $data=ShippingAddress::orderBy('id','ASC')
        ->where('user_id',$id)
        ->get();
        return $data;
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
            'contact' => ['required'],
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
            $response['data']=ShippingAddress::where('id',$id)
            ->update([
                'name' => $request->name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'contact' => $request->contact,
                'lat' => $request->lat,
                'lon' => $request->lon,
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
        $response['data'] = ShippingAddress::find($id);
        if($response['data'])
        {
                $response['data']=$response['data']->delete();
                $response['status']=true;
        }
        else
        {
            $response['data']="Address doesn't not Exist";  
        }
        return response()->json($response);

    }

    
}
