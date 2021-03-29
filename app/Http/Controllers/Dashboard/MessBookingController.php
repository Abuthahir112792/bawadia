<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\MessBooking;
use Auth;
use DB;
use Carbon\Carbon;
use App\Product;
use App\Meny;
use App\Day;
class MessBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Day::orderBy('id','ASC')
        ->with('breakfast')
        ->with('lunch')
        ->with('dinner')
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
        // $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        DB::beginTransaction();
        try {
            if(isset($request->breakfast) && count($request->breakfast))
            {
                
                foreach($request->breakfast as $breakfast)
                {
                    $breakfast=json_decode($breakfast);                  
                    $data= MessBooking::create([
                        'admin_id' => $auth_id,
                        'day_id' => $request->id,
                        'menu' => 'breakfast',
                        'product_id' => $breakfast,
                        'status' => '1',        
                    ]);
                }
            }
            if(isset($request->lunch) && count($request->lunch))
            {
                
                foreach($request->lunch as $lunch)
                {
                    $lunch=json_decode($lunch);                  
                    $data= MessBooking::create([
                        'admin_id' => $auth_id,
                        'day_id' => $request->id,
                        'menu' => 'lunch',
                        'product_id' => $lunch,
                        'status' => '1',        
                    ]);
                }
            }
            if(isset($request->dinner) && count($request->dinner))
            {
                
                foreach($request->dinner as $dinner)
                {
                    $dinner=json_decode($dinner);                  
                    $data= MessBooking::create([
                        'admin_id' => $auth_id,
                        'day_id' => $request->id,
                        'menu' => 'dinner',
                        'product_id' => $dinner,
                        'status' => '1',        
                    ]);
                }
            }
           
            // $response['data']=Day::with('breakfast')
            // ->with('lunch')
            // ->with('dinner')
            // ->find($data->day_id);
           
            DB::commit();
            // $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            // $response['status'] = false;
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
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            $data=MessBooking::where('id',$id)
            ->update([
                'status' => $request->status=="true"?1:0,
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
        
        $response=array();
         
        MessBooking::where('day_id',$id)->delete();
       
        $response['data']= MessBooking::
        with('breakfast')
        ->with('lunch')
        ->with('dinner')
        ->find($id);
        return response()->json($response);
    }

    public function getproduct()
    {
        $data=Product::orderBy('id','ASC')
        ->get();
        return $data;
    }
}
