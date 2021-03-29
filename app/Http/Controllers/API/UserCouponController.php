<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\UserCoupon;
use App\UserPoint;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
class UserCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id=Auth::id();
        $data=UserCoupon::where('user_id',$auth_id)
        ->where('status',1)
        ->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        $user_order=Order::where('user_id',$auth_id)
        ->sum('total');
        $used_points=UserPoint::where('user_id',$auth_id)
        ->where('type','reedem')
        ->sum('points');
        
        if($request->buying_point>($user_order-$used_points))
        {
            $response['data'] ='Sorry, not enough point to buy this';
            return response()->json($response);
        }
        $validator = Validator::make($request->all(), [
            'buying_point' => ['required'],
            'amount' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        DB::beginTransaction();
        try {
            $response['data']=UserCoupon::create(
                [
                    'user_id' => $auth_id,
                    'coupon_id' => $request->id,
                    'title' => $request->title,
                    'amount' => $request->amount,
                ]
            );
            $orderProduct=UserPoint::create([
                'user_id' => $auth_id,
                'points' => $request->buying_point,
                
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
