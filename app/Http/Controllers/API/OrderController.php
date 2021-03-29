<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
use App\Order;
use App\OrderProduct;
use App\OrderProductIngredient;
use App\User;
use App\FirebaseToken;
use App\Cart;
use App\UserPoint;
use App\UserCoupon;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $auth_id=Auth::id();
        $data=Order::orderBy('id','DESC');
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id',$branch_id);
    
        }        
        $data=$data->with('product')
        ->with('delivery')
        ->with('order_status')        
        ->where('user_id',$auth_id)
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
                'pickup_date' => $request->pickup_date,
                'pickup_time' => $request->pickup_time,
                'car_number' => $request->car_number,
                'car_name' => $request->car_name,
                'type' => $request->type,
                'order_status_id' => 1,
                'discount' => isset($request->discount)?$request->discount:0,
                'coupon_id' => isset($request->coupon_id)?$request->coupon_id:0,
                'ip' => 12,
                'note' => $request->note,
                ]);
            $cart=Cart::where('user_id',$auth_id)
            ->where('branch_id',$request->branch_id)
            ->with('price')
            ->with('product')
            ->with('ingredient')
            ->get();
            if(isset($request->coupon_id) & !empty($request->coupon_id))
            {
                $orderProduct=UserCoupon::where('id',$request->coupon_id)
                ->update([
                    'status' => 0,
                    
                ]); 
            }
            if(count($cart))
            {
                // return $cart;
                foreach($cart as $product)
                {
                    $orderProduct=OrderProduct::create([
                        'order_id' => $response['data']->id,
                        'product_id' => $product['product_id'],
                        'name' => $product['product']['info'][0]['name'],
                        'model' => $product['product']->model,
                        'quantity' => $product['quantity'],
                        'product_price' => $product['total'],
                        'product_size' => $product['price']->tag,
                        'product_branch_id' => $product['product']->branch->id,
                        'note' => $product['note'],
                        'total' => ($product['total']*$product['quantity'])
                    ]);
                    foreach($product['ingredient'] as $ingredient)
                    {
                        OrderProductIngredient::create([
                            'order_product_id' => $orderProduct->id,
                            'ingredient_id' => $ingredient->ingredient_id,
                            'title' => $ingredient->title,
                            'price' => $ingredient->price,
                            'quantity' => isset($ingredient->quantity)?$ingredient->quantity:1,
                        ]);
                    }

                }
            }
            $delete=Cart::where('user_id',$auth_id)->delete();
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line: '.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
        if($response['status'])
        {
            $admin=User::where('type',1)->get();
            $adminpluck = $admin->pluck('id');
            $data=FirebaseToken::whereIn('user_id',$adminpluck)->get();
            $plucked = $data->pluck('token');
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array (
                // array($id),
                    'registration_ids' => $plucked,
    
                    'data' => array (
                            "title" => 'New order asigned',
                            "message" => 'Order #'.$response['data']->id.' added to you',
                            "id" => $response['data']->id
                    ),
                    'time_to_live' => 600,
                   
            );
            $fields = json_encode ( $fields );
    
            $serverKey= config('app.firebase_server_key');
            $headers = array (
                    'Authorization: key=' .$serverKey,
                    'Content-Type: application/json'
            );
    
            if($serverKey)
            {
                $ch = curl_init ();
                curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
                $result = curl_exec ( $ch );
               
                curl_close ( $ch );    
            }

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

