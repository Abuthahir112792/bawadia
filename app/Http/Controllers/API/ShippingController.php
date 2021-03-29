<?php

namespace App\Http\Controllers\API;

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
        $auth_id=Auth::id();
        $data=ShippingAddress::orderBy('id','ASC')
        ->where('user_id',$auth_id)
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
            'contact' => ['required'],
            'area' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        DB::beginTransaction();
        try {
            $response['data']=ShippingAddress::create([
                'user_id' => $auth_id,
                'name' => $request->name,
                'area' => $request->area,
                'street' => $request->street,
                'building' => $request->building,
                'floor' => $request->floor,
                'room' => $request->room,
                'city' => $request->city,
                'contact' => $request->contact,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'note' => $request->note,
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

    public function show($id)
    {
        $data=ShippingAddress::find($id);
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
            'area' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
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
                'area' => $request->area,
                'street' => $request->street,
                'building' => $request->building,
                'floor' => $request->floor,
                'room' => $request->room,
                'city' => $request->city,
                'contact' => $request->contact,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'note' => $request->note,
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
            $response['data']="Address doesn't exist";  
        }
        return response()->json($response);

    }

    
}

