<?php

namespace App\Http\Controllers\API;

use App\Favourite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth_id=Auth::id();
        $data=Favourite::orderBy('id','ASC')
        ->with('product');
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->whereHas('product.branch', function ($query) use ($branch_id) {
                $query->where('branch_id', '=', $branch_id);
            });
        }
        $data=$data->where('user_id',$auth_id)
        ->get()
        ->pluck('product');
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_id' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        DB::beginTransaction();
        try {
            $response['data']=Favourite::create([
                'user_id' => $auth_id,
                'product_id' => $request->product_id,
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
        
        $data=Favourite::where('id',$id)
        ->with('product')
        ->first();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $response['status']=false;
        $response['data'] = Favourite::where('product_id',$id)
        ->get();
        if(count($response['data']))
        {
            $response['data'] = Favourite::where('product_id',$id)
            ->delete();
            $response['status']=true;
        }
        else
        {
            $response['data']="Product doesn't exist";  
        }
        return response()->json($response);

    }
}
