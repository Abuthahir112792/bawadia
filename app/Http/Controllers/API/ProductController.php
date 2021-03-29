<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\ProductBranch;
use App\ProductCategory;
use App\ProductImage;
use App\ProductTag;
use App\ProductInfo;
use Auth;
use DB;
use Image;
use App\Category;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $auth_id=Auth::id();
        $data=Product::where('status',1);
        if(isset($request->sort_value) && isset($request->sort_type))
        {
            $data=$data->orderBy($request->sort_value,$request->sort_type);
        }
        if(isset($request->category_id) && !empty($request->category_id))
        {
            $categories=Category::where('parent_id',$request->category_id)->get();
            // $categories=array(6);
            $categories=$categories->pluck('id');
            $categories=$categories->push((int)$request->category_id);
            //  return $categories;
            // if(count($categories)>0)
            //     array_push($categories, (int)$request->category_id);
            // else
            //     $categories=array($request->category_id);
            // return $categories;
            // $category_id=$request->category_id;
            $data=$data->whereHas('category', function ($query) use ($categories) {
                $query->whereIn('category_id', $categories);
            });

    
        }
        $data=$data->whereHas('category.category', function ($query) {
            $query->where('status',1);
        });
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->whereHas('branches', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })
            ->with('branch');
        }
        if(isset($request->group_id) && !empty($request->group_id))
        {
            $group_id=$request->group_id;
            $data=$data->whereHas('group', function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            });
        }
        if(isset($request->search) && !empty($request->search))
        {
            $search='%'.$request->search.'%';

            $data=$data->where('meta_title','like',$search)
            ->orWhere('meta_description',  'like', $search);
    
        }
        
        $data=$data->with('category')
        ->with('image')        
        ->with('group')
        ->with('info')
        ->with('ingredientsByCategory')
        ->with(['fav' => function($q) use($auth_id){
            $q->where('user_id', $auth_id);
        }])
        ->with(['cart' => function($q) use($auth_id, $request){
            $q->where('user_id', $auth_id)
            ->where('branch_id', $request->branch_id);
        }])
        ->paginate(10);
       return $data;
    }
    public function products()
    {
        $data=Product::orderBy('id','ASC')
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
        
    }

    public function show($id)
    {
        $data=Product::with('branch')
        ->with('category')
        ->with('image')
        ->with('info')
        ->find($id);
        return $data;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }

    
}

