<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\CategoryBranch;
use App\ProductCategory;
use Auth;
use DB;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data=Category::orderBy('id','ASC');
        if(isset($request->parent_id))
        {
            // dd($request->parent_id);
             $data= $data->where('parent_id',$request->parent_id);
    
        }
        $data= $data->with('branch')
        ->with('parent')
        ->active()
        ->get();
       return $data;
    }
    public function categories()
    {
        $data=Category::orderBy('id','ASC')
        ->where('status',1)
        ->get();
       return $data;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $response['data']=Category::create([
                'user_id' => $auth_id,
                'name' => $request->name,
                'image' => $request->image,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
            ]);
            if(isset($request->branch) && count($request->branch))
            {
                foreach($request->branch as $branch)
                {                  
                    CategoryBranch::create([
                        'category_id' => $response['data']->id,
                        'branch_id' => $branch['id'],        
                    ]);
                }
            }            
            DB::commit();
            $response['data']= Category::with('branch')
            ->with('parent')
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
        $data=Category::orderBy('id','ASC')
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
            $response['data']=Category::where('id',$id)
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
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);
        DB::beginTransaction();
        try {
            Category::where('id',$id)
            ->update([
                'name' => $request->name,
                'image' => $request->image,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
            ]);
            $delete=CategoryBranch::where('category_id',$id)
            ->delete();

            if(isset($request->branch) && count($request->branch))
            {
                foreach($request->branch as $branch)
                {                  
                    CategoryBranch::create([
                        'category_id' => $id,
                        'branch_id' => $branch['id'],        
                    ]);
                }
            }  
            DB::commit();
            $response['data']= Category::with('branch')
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
        $response['data'] = Category::find($id);
        if($response['data'])
        {
            $branchcounter= \App\ProductCategory::where('category_id',$id)->count();
            if($branchcounter==0)
            {
                CategoryBranch::where('category_id',$id)->delete();
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
