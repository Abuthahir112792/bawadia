<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contactus;
use Auth;
use DB;


class ContactusController extends Controller
{
    
    public function index(Request $request)
    {
        $data=Contactus::orderBy('id','DESC')
        ->paginate(20);
       return $data;
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
       
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit(Request $request, $id)
    {
        // dd($request->all());
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            $response['data']=Contactus::where('id',$id)
            ->update([
                'status' => $request->status,
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
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
