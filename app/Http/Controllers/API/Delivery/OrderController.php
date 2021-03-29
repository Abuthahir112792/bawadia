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
use Carbon\Carbon;
class OrderController extends Controller
{
    public function index()
    {
        $auth_id=Auth::id();
        $data=Order::with('product')
        ->with('delivery')
        ->with('order_status')        
        ->whereIn('order_status_id',[1,2,3]) 
        ->where('delivery_agent',$auth_id)       
        ->paginate(30);
       return $data;
    }
    public function history(Request $request)
    {
        $auth_id=Auth::id();
        $data=Order::orderby('id', 'DESC')
        ->with('product')
        ->with('delivery')
        ->with('order_status')        
        ->whereNotIn('order_status_id',[1,2,3]) 
        ->where('delivery_agent',$auth_id);     
        if(isset($request->date) && !empty($request->date))
        {
            $data= $data->whereDay('created_at',new Carbon($request->date));
        }
        $data=$data->paginate(30);
       return $data;
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
}
