<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contactus;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class ContactusController extends Controller
{
    
    public function index()
    {
      
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        DB::beginTransaction();
        try {
            $create=Contactus::create([
                'name' => $request->name,
                'email' => $request->email,
                'body' => $request->body,
            ]);            
            DB::commit();
            $response['status'] = 200;
            $response['message']= "Succesfully Created";
            $response['data'] = $create;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
        return response()->json($response);
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit(Request $request, $id)
    {
       
    }

 
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
