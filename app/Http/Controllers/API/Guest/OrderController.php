<?php

namespace App\Http\Controllers\API\Guest;

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
        ->paginate(10);
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
        $validator = Validator::make($request->all(), [
            'address1' => ['required'],
            'contact' => ['required'],
            'branch_id' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $response['data']=Order::create([
                'invoice_no' => 0,
                'invoice_prefix' => $request->invoice_prefix,
                'branch_id'=>$request->branch_id,
                'user_id' => $auth_id,
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
                'order_status_id' => 1,
                'ip' => 12,
                'note' => $request->note,
                ]);
            $cart=Cart::where('user_id',$auth_id)
            ->where('branch_id',$request->branch_id)
            ->get();
            if(isset($request->cart) && count($request->cart))
            {
                foreach($request->cart as $product)
                {
                    // dd($product['product_id']);
                    // $product=json_decode($product);
                    // dd($product['quantity']);
                    OrderProduct::create([
                        'order_id' => $response['data']->id,
                        'product_id' => $product['product_id'],
                        'name' => $product['name'],
                        'quantity' => $product['quantity'],
                        'price' => $product['price'],
                        'total' => ((int)$product['price']*(int)$product['quantity'])
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
                'note' => $request->note,                
                'status' => $request->status,
            ]);
            OrderProduct::where('order_id',$id)->delete();
            if(isset($request->cart) && count($request->cart))
            {
                foreach($request->cart as $product)
                {
                    $product=json_decode($product);
                    OrderProduct::create([
                        'order_id' => $response['data']->id,
                        'product_id' => $product->product_id,
                        'name' => $product->product->info[0]->name,
                        'model' => $product->product->model,
                        'quantity' => $product->quantity,
                        'price' => $product->price,
                        'total' => $product->price*$product->quantity
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
        $response['data'] = Order::find($id);
        if($response['data'])
        {
            DB::beginTransaction();
            try {
                DB::commit();
                OrderProduct::where('order_id',$id)->delete();
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
            $response['data']="Order does not Exist";  
        }
        return response()->json($response);

    }

    
}

