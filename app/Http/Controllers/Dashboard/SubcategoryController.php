<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Subcategory;
use App\SubcategoryBranch;
use App\SubcategoryCategory;
use Auth;
use DB;
class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $data=Subcategory::orderBy('id','ASC')->with('branch')->with('category')->active()->get();
       
       return $data;
    }
    public function subcategories()
    {
        $data=Subcategory::orderBy('id','ASC')->where('status',1)->get();
       return $data;
    }

    public function create()
    {
        //
    }

    public function subcategory_by_category(Request $request)
    {
        $category=array();

        foreach($request->all() as $item)
        {
            array_push($category,$item['id']);
        }
        // dd($category);
        $data=SubcategoryCategory::whereIn('category_id',$category)
        ->groupBy('subcategory_id')
        ->with('subcategory')
        ->get();
        return $data;

    }

    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'sub_category_name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $response['data']=Subcategory::create([
                'user_id' => $auth_id,
                'sub_category_name' => $request->sub_category_name,
                'image' => $request->image,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            if(isset($request->branch) && count($request->branch))
            {
                foreach($request->branch as $branch)
                {                  
                    SubcategoryBranch::create([
                        'subcategory_id' => $response['data']->id,
                        'branch_id' => $branch['id'],        
                    ]);
                }
            } 
            
            if(isset($request->category) && count($request->category))
            {
                foreach($request->category as $category)
                {                  
                    SubcategoryCategory::create([
                        'subcategory_id' => $response['data']->id,
                        'category_id' => $category['id'],        
                    ]);
                }
            }               
            DB::commit();
            $response['data']= Subcategory::with('branch')
            ->with('category')
            ->find($response['data']->id);
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
        $data=Subcategory::orderBy('id','ASC')
        ->where('parent_id',$id)
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
            $response['data']=Subcategory::where('id',$id)
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
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $validator = Validator::make($request->all(), [
            'sub_category_name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            Subcategory::where('id',$id)
            ->update([
                'sub_category_name' => $request->sub_category_name,
                'image' => $request->image,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            $delete=SubcategoryBranch::where('subcategory_id',$id)
            ->delete();
            $delete=SubcategoryCategory::where('subcategory_id',$id)
            ->delete();

            if(isset($request->branch) && count($request->branch))
            {
                foreach($request->branch as $branch)
                {                  
                    SubcategoryBranch::create([
                        'subcategory_id' => $id,
                        'branch_id' => $branch['id'],        
                    ]);
                }
            } 
            if(isset($request->category) && count($request->category))
            {
                foreach($request->category as $category)
                {                  
                    SubcategoryCategory::create([
                        'subcategory_id' => $id,
                        'category_id' => $category['id'],        
                    ]);
                }
            }    
            DB::commit();
            $response['data']= Subcategory::with('branch')->with('category')
           ->find($id);
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
        $response['data'] = Subcategory::find($id);
        if($response['data'])
        {
            $branchcounter= \App\ProductSubcategory::where('subcategory_id',$id)->count();
            if($branchcounter==0)
            {
               SubcategoryBranch::where('subcategory_id',$id)->delete();
               SubcategoryCategory::where('subcategory_id',$id)->delete();
                $response['data']=$response['data']->delete();
                $response['status']=true;
            }
            else
            {
                $response['data']="Product exist under this category";

            }   
        }
        else
        {
            $response['data']="Category not Exist";  
        }
        return response()->json($response);

    }

    
}
