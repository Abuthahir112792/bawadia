<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Setting;
use Auth;
use DB;
use Image;
class SettingController extends Controller
{

    public function index()
    {
        $data=Setting::find(1);
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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:255'],
            'description' => ['required'],
            'currency' => ['required'],
            'language' => ['required'],
            'language_admin' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            $response['data']=Setting::where('id',$id)
            ->update($request->all());
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }

        return response()->json($response);
    }

    public function destroy($id)
    {


    }
    public function logo(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        if($request->hasFile('myFile'))
        {
            DB::beginTransaction();
            try {
                $request->file('myFile')->store('public/uploads/logo');
                $pic= '/storage/uploads/logo/'.$request->myFile->hashName();  
                // Image::make('storage/uploads/logo/'.$request->myFile->hashName())->fit(1000, 700, function($constraint) {
                //     $constraint->aspectRatio();})->save('storage/uploads/logo/'.$request->myFile->hashName());       
                $response['data']=Setting::where('id', 1)->update([
                    'image' => $pic
                ]);    
                DB::commit();
                $response['status'] = true;
                $response['data'] = $pic;
            } catch (\Exception $e) {
                $response['data']=$e->getMessage();
                $response['status'] = false;
                DB::rollback();
            }

        }
        return response()->json($response);

    }
}
