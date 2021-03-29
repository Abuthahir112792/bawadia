<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
use App\Order;
use App\OrderProduct;
use App\OrderRiderPath;
class OrderRiderPathController extends Controller
{
    public function store(Request $data)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        $request=$data->all();
        // dd(count($request['path']));
        DB::beginTransaction();
        try {
            for($i=0;$i<count($request['path']); $i++)
            {
                $response['data']=OrderRiderPath::create([
                    'user_id' => $auth_id,
                    'order_id' => $request['order_id'],
                    'lat' => $request['path'][$i]['lat'],
                    'lon' => $request['path'][$i]['lon'],
                ]);  
            }
         
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line:'.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
    }
    public function show($id)
    {
        $auth_id=Auth::id();
        $data=OrderRiderPath::where('user_id',$auth_id)
        ->where('order_id',$id)
        ->get();
        return $data;
    }
}
