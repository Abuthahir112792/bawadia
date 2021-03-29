<?php

namespace App\Http\Controllers\API\Guest;

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
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data=Product::orderBy('id','ASC');
        if(isset($request->category_id) && !empty($request->category_id))
        {
            $category_id=$request->category_id;
            $data=$data->whereHas('category', function ($query) use ($category_id) {
                $query->where('category_id', '=', $category_id);
            });
    
        }
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->whereHas('branches', function ($query) use ($branch_id) {
                $query->where('branch_id', '=', $branch_id);
            })
            ->with('branch');
        }
        else
        {
            $data=$data->with('branches');

        }
        if(isset($request->search) && !empty($request->search))
        {
            $search='%'.$request->search.'%';

            $data=$data->where('meta_title','like',$search)
            ->orWhere('meta_description',  'like', $search);
    
        }
        
        $data=$data->with('category')
        ->with('image')
        ->with('info')
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
