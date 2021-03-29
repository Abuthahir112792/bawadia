<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Page;
use Auth;
use DB;
class PageController extends Controller
{
    public function index()
    {
        $data=Page::orderBy('id','ASC')
        ->with('branch')
        ->get();
       return $data;
    }

    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';

        DB::beginTransaction();
        try {
            foreach($request->all() as $item)
            {
                $validator = Validator::make($item, [
                    'title' => ['required', 'string', 'max:255'],
                    'description' => ['required'],
                ]);
                if ($validator->fails()) {
                    $response['data'] = $validator->errors();
                    return response()->json($response);
                }
                
                $response['data']=Page::where('id',$item['id'])
                ->update([
                    'title' => $item['title'],
                    'description' => $item['description'],
                ]);
    
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

    public function show($id)
    {
        $data=Page::where('page',$id)
        ->get();
        return $data;
    }

    public function edit(Request $request, $id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            $response['data']=Page::where('id',$id)
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

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $response=array();
        $response['status']=false;

        return response()->json($response);

    }

    
}