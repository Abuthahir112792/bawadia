<?php

namespace App\Http\Controllers\API\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
use App\Order;
use App\OrderProduct;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data=Order::orderBy('id','DESC');
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id',$branch_id);
    
        }        
        $data=$data->with('product')
        ->with('delivery')
        ->with('order_status')        
        ->whereIn('order_status_id',[1,2,3])        
        ->paginate(30);
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
        $response['id'] =$request['id'];
        $response['order_status_id'] =$request->order_status_id;
        DB::beginTransaction();
        try {
            $response['data']=Order::where('id',$request->id)
            ->update([
                'order_status_id' => $request->order_status_id,
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
        $data=Order::with('product')
        ->with('customer')
        ->with('branch')
        ->with('delivery')
        ->with('order_status')  
        ->find($id);
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
        DB::beginTransaction();
        try {
            $response['data']=Order::where('id',$id)
            ->update([
                'order_status_id' => $request->order_status_id,
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
        

    }

    
}

