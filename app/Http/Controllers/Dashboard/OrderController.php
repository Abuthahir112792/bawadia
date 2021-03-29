<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Image;
use App\Order;
use App\OrderProduct;
use Carbon\Carbon;
use App\Events\PendingOrder;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data=Order::orderBy('id','DESC');
        if(isset($request->start) && !empty($request->start))
        {
            $start= new Carbon($request->start);
            $start=$start->startOfDay();
            $data=$data->where('created_at','>=',$start);
    
        } 
        if(isset($request->end) && !empty($request->end))
        {
            $end= new Carbon($request->end);
            $end=$end->endOfDay();
            $data=$data->where('created_at','<=',$end);
    
        } 
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id',$branch_id);
    
        } 
        if(isset($request->order_status_id) && !empty($request->order_status_id))
        {
            $order_status_id=$request->order_status_id;
            $data=$data->where('order_status_id',$order_status_id);
    
        }  
        if(isset($request->order_status_ids) && !empty($request->order_status_ids))
        {
            $order_status_ids=$request->order_status_ids;
            $data=$data->whereIn('order_status_id',$order_status_ids);
    
        }        
        $data=$data->with('product')
        ->with('order_status')
        ->with('branch')
        ->with('path')        
        ->with('delivery');
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
    
        }
        else
        {
            $data=$data->get();
        }
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
        // dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'name' => ['required', 'string', 'max:255'],
        //     'description' => ['required'],
        // ]);
        // if ($validator->fails()) {
        //     $response['data'] = $validator->errors();
        //     return response()->json($response);
        // }

        DB::beginTransaction();
        try {
            $response['data']=Order::create([
                
                'invoice_no' => 0,
                'invoice_prefix' => $request->invoice_prefix,
                'branch_id'=>$request->branch_id,
                'user_id' => $request->customer_id,
                'shipping_address_id' => $request->shipping_address_id,
                'customer_name' => $request->customer_name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'contact' => $request->contact,
                'email' => $request->email,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'total' => $request->total,
                'pickup_date' => $request->pickup_date,
                'pickup_time' => $request->pickup_time,
                'car_number' => $request->car_number,
                'order_status_id' => $request->order_status_id,
                'ip' => $request->ip,
                'note' => $request->note,
                'type' => $request->type,
                'status' => $request->status,
            ]);
            if(isset($request->cart) && count($request->cart))
            {
                foreach($request->cart as $product)
                {
                    $product=json_decode($product);
                    // dd($product->size->tag);
                     OrderProduct::create([
                        'order_id' => $response['data']->id,
                        'product_id' => $product->product_id,
                        'name' => $product->product->info[0]->name,
                        'model' => $product->product->model,
                        'product_branch_id' => $product->id,
                        'quantity' => $product->quantity,
                        'product_size' => $product->size->tag,
                        'product_price' => $product->size->price,
                        'total' => $product->size->price*$product->quantity
                    ]);
                }
            }      

            if($response['data'] && $request->order_status_id==1)
            {
                $emitdata=Order::with('product')
                ->with('order_status')
                ->with('branch')
                ->with('delivery')
                ->find($response['data']->id);
                broadcast(new PendingOrder($emitdata))->toOthers(); 
            }
                  
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line: '.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
    }

    public function show($id)
    {
        $data=Order::with('product')
        ->with('delivery')
        ->with('order_status')
        ->with('customer')
        ->with('branch')
        ->find($id);
        return $data;
    }

    public function edit(Request $request,$id)
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

    public function update(Request $request, $id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            $response['data']=Order::where('id',$id)
            ->update([
                'shipping_address_id' => $request->shipping_address_id,
                'customer_name' => $request->customer_name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'contact' => $request->contact,
                'email' => $request->email,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'total' => $request->total,
                'order_status_id' => $request->order_status_id,
                'pickup_date' => $request->pickup_date,
                'pickup_time' => $request->pickup_time,
                'car_number' => $request->car_number,
                'note' => $request->note,                
                'type' => $request->type,
                'status' => $request->status,
            ]);
            OrderProduct::where('order_id',$id)->delete();
            if(isset($request->cart) && count($request->cart))
            {
                foreach($request->cart as $product)
                {
                    $product=json_decode($product);
                    OrderProduct::create([
                        'order_id' => $id,
                        'product_id' => $product->product_id,
                        'name' => $product->product->info[0]->name,
                        'model' => $product->product->model,
                        'product_branch_id' => $product->product_branch_id,
                        'quantity' => $product->quantity,
                        'product_size' => $product->size->tag,
                        'product_price' => $product->size->price,
                        'total' => $product->size->price*$product->quantity
                    ]);
                }
            }             
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line: '.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
    }

    public function destroy($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] = Product::find($id);
        if($response['data'])
        {
            DB::beginTransaction();
            try {
                DB::commit();
                ProductBranch::where('product_id',$id)->delete();
                ProductImage::where('product_id',$id)->delete();
                ProductCategory::where('product_id',$id)->delete();
                ProductInfo::where('product_id',$id)->delete();
                $response['data']=$response['data']->delete();
                $response['status'] = true;
            } catch (\Exception $e) {
                $response['data']=$e->getMessage();
                $response['status'] = false;
                DB::rollback();
            }            

        }
        else
        {
            $response['data']="Category not Exist";  
        }
        return response()->json($response);

    }

    
}

