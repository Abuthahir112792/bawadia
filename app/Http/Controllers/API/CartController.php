<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CartIngredient;
use App\Cart;
use Auth;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth_id=Auth::id();
        $data=Cart::orderBy('id','ASC')
        ->with('ingredient')
        ->with('product')
        ->with('price')
        ->where('user_id',$auth_id);
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
             $data= $data->where('branch_id',$request->branch_id);
    
        }
        $data= $data->get();
       return $data;
    }
        public function count(Request $request)
    {
        $auth_id=Auth::id();
        $data=Cart::where('user_id',$auth_id);
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
             $data= $data->where('branch_id',$request->branch_id);
        }
        $data= $data->count();
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
            'quantity' => ['required','integer','min:1'],
            'product_price_id' => ['required'],
            'branch_id' => ['required']
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $response['data']=Cart::create([
                'user_id' => $auth_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_price_id' => $request->product_price_id,
                'branch_id' => $request->branch_id,
                'total' => isset($request->total)?$request->total:0,
                'note' => isset($request->note)?$request->note:'No Note',
                
            ]);
            $response['data']=Cart::find($response['data']->id);   
            $ingredients=json_decode($request->ingredients);
            if(isset($request->ingredients) && count($ingredients))
            {
                foreach($ingredients as $ingredient)
                {
                    CartIngredient::create([
                        'cart_id' => $response['data']->id,
                        'ingredient_id' => $ingredient->ingredient_id,
                        'title' => $ingredient->title,
                        'price' => $ingredient->price,
                        'quantity' => isset($ingredient->quantity)?$ingredient->quantity:1,
                    ]);
                }
            } 
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
        
        $data=Cart::where('id',$id)
        ->with('product')
        ->with('price')
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
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $validator = Validator::make($request->all(), [
            'quantity' => ['required','integer','min:1'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            $response['data']=Cart::where('id',$id)
            ->update([
                'quantity' => $request->quantity,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] = Cart::find($id);
        $auth_id=Auth::id();
        if($response['data'])
        {
            $response['data']=$response['data']->delete();
            $response['status']=true;
        }
        else
        {
            $response['data']="Product dosen't exist or Wrong User";  
        }
        return response()->json($response);

    }
}
