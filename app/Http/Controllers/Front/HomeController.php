<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Branch;
use App\ProductBranch;
use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductPrice;
use App\ProductImage;
use App\ProductTag;
use App\ProductInfo;
use Auth;
use DB;
use Image;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
       
        return view('front.home');
    }

    public function aboutus(){
       
        return view('front.aboutus');
    }

    public function product(){

        $data=Product::where('status',1);
        if(empty(request()->branch_id) && empty(request()->category_id) && empty(request()->subcategory_id)){
            $branch_id='1';
            $data=$data->whereHas('branches', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })
            ->with('branch');
        }
        if(isset(request()->branch_id) && !empty(request()->branch_id))
        {
            $branch_id=request()->branch_id;
            $data=$data->whereHas('branches', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })
            ->with('branch');
        }
        if(isset(request()->category_id) && !empty(request()->category_id))
        {
            $category_id=request()->category_id;
            $branch_id=request()->branch_id;
            $data=$data->whereHas('category', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            });
        }
        $data=$data->whereHas('category.category', function ($query) {
            $query->where('status',1);
        });
        if(isset(request()->subcategory_id) && !empty(request()->subcategory_id))
        {
            $subcategory_id=request()->subcategory_id;
            $branch_id=request()->branch_id;
            $data=$data->whereHas('subcategory', function ($query) use ($subcategory_id) {
                $query->where('subcategory_id', $subcategory_id);
            });
        }
        $data=$data->whereHas('subcategory.subcategory', function ($query) {
            $query->where('status',1);
        });
        $allproduct=$data
        ->with('category')
        ->with('subcategory')
        ->with('image') 
        ->with('info') 
       ->paginate(10);
       $branchdata=Branch::where('status',1)->get();
       $categorydata=Category::where('status',1)->get();
       $subcategorydata=Subcategory::where('status',1)->get();
        return view('front.product',compact('allproduct','branch_id','branchdata','categorydata','subcategorydata'));
    }

    public function productdetails(){
        $branch_id = request()->branch_id;
        $product_id = request()->product_id;
        
        
        $productdetailsdata=Product::
        with('category')
        ->with('image')
        ->with('info')
        ->whereHas('branches', function ($query) use ($branch_id,$product_id) {
            $query->where('branch_id', $branch_id)->where('product_id', $product_id);
        })
        ->with('branch')
        ->find($product_id);
        $productbranchdata=ProductBranch::where('branch_id', $branch_id)->where('product_id', $product_id)->first();
        $productpricedata=ProductPrice::where('product_branch_id', $productbranchdata->id)->where('product_id', $product_id)->get();
        return view('front.productdetails',compact('productdetailsdata','productpricedata'));
    }

    public function shoppingcart(){
       
        return view('front.shoppingcart');
    }

    public function checkout(){
       
        return view('front.checkout');
    }

    public function wishlist(){
       
        return view('front.wishlist');
    }

    public function customerregister(){
       
        return view('front.customerregister');
    }

    public function customerlogin(){
       
        return view('front.customerlogin');
    }

    public function contactus(){
       
        return view('front.contactus');
    }

    public function product_size($product_size){
        $data=ProductPrice::where('id', $product_size)->first();
        return response()->json([
            'data' => $data
        ],200);
    }
    
}
