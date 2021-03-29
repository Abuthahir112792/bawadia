<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Branch;
use App\CategoryBranch;
use App\SubcategoryBranch;
use Auth;
use DB;
class BranchController extends Controller
{

    public function index()
    {
        $data=Branch::orderBy('id','ASC')
       ->get();
       return $data;
    }

    public function create()
    {

    }
    public function branch_by_category(Request $request)
    {
        $category=array();

        foreach($request->all() as $item)
        {
            array_push($category,$item['id']);
        }
        // dd($category);
        $data=CategoryBranch::whereIn('category_id',$category)
        ->groupBy('branch_id')
        ->with('branch')
        ->get();
        return $data;

    }

    public function branch_by_subcategory(Request $request)
    {
        $subcategory=array();

        foreach($request->all() as $item)
        {
            array_push($subcategory,$item['id']);
        }
        // dd($category);
        $data=SubcategoryBranch::whereIn('subcategory_id',$subcategory)
        ->groupBy('branch_id')
        ->with('branch')
        ->get();
        return $data;

    }

    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        $validator = Validator::make($request->all(), [
            'address' => ['required'],
            'contact_1' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            $response['data']=Branch::create($request->all());
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
            'address' => ['required'],
            'contact_1' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);

        DB::beginTransaction();
        try {
            $response['data']=Branch::where('id',$id)
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
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $response['data'] = Branch::find($id);
        if($response['data'])
        {
            $branchcounter= \App\CategoryBranch::where('category_id',$id)->count();
            if($branchcounter==0)
            {
                $response['data']=$response['data']->delete();
                $response['status']=true;
            }
            else
            {
                $response['data']="Branch exist under this category";

            }   
        }
        else
        {
            $response['data']="Category not Exist";  
        }
        return response()->json($response);

    }
}

