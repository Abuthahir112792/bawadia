<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\ProductBranch;
use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductImage;
use App\ProductTag;
use App\ProductCuisine;
use App\ProductIngredient;
use App\ProductInfo;
use App\ProductPrice;
use App\ProductGroup;
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
        if(isset($request->subcategory_id) && !empty($request->subcategory_id))
        {
            $subcategory_id=$request->subcategory_id;
            $data=$data->whereHas('subcategory', function ($query) use ($subcategory_id) {
                $query->where('subcategory_id', '=', $subcategory_id);
            });
        }
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->whereHas('branches', function ($query) use ($branch_id) {
                $query->where('branch_id', '=', $branch_id);
            });
    
        }
        if(isset($request->search) && !empty($request->search))
        {
            $search='%'.$request->search.'%';
            $data=$data->where('meta_title','like',$search)
            ->orWhere('meta_description',  'like', $search);
        }
        
        $data=$data->with('category')->with('subcategory')
        ->with('branches')
        ->with('image')
        ->with('info')
        ->paginate(10);
       return $data;
    }
    public function products(Request $request)
    {
        $data=ProductBranch::orderBy('id','ASC');
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id', '=', $branch_id);
    
        }
        $data=$data->with('product')
        ->with('product.category')->with('product.subcategory')
        ->with('price')
        ->whereHas('product', function ($query) {
            $query->where('status', '=', 1);
        });
        if(isset($request->category_id) && !empty($request->category_id))
        {
            $category_id=$request->category_id;
            $data=$data->whereHas('product.category', function ($query) use ($category_id) {
                $query->where('category_id', '=', $category_id);
            });
    
        }
        if(isset($request->subcategory_id) && !empty($request->subcategory_id))
        {
            $subcategory_id=$request->subcategory_id;
            $data=$data->whereHas('product.subcategory', function ($query) use ($subcategory_id) {
                $query->where('subcategory_id', '=', $subcategory_id);
            });
    
        }
        $data=$data->get();
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
        $validator = Validator::make(
            $request->all(), [
            'media.*' => 'required|mimes:jpg,jpeg,png,bmp|max:3000'
            ]
        );
        
        if ($validator->fails()) {
            $response['data'] = $validator->getMessageBag()->toArray();
            return response()->json($response);
        }

        DB::beginTransaction();
        try {

            $response['data']=Product::create([
                'user_id' => $auth_id,
                'model' => $request->model,
                'model' => $request->model,
                'video_link' => isset($request->video_link)?$request->video_link:'',
                // 'price' => $request->price,
                'size_type'=>$request->size_type,
                'points' => $request->points,
                'dimensions_l' => $request->dimensions_l,
                'dimensions_w' => $request->dimensions_w,
                'dimensions_h' => $request->dimensions_h,
                'dimensions_class' => $request->dimensions_class,
                'weight' => $request->weight,
                'weight_class' => $request->weight_class,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'veg' => $request->veg,
                'sort' => $request->sort,
                'status' => $request->status,
            ]);
            if(isset($request->media) && count($request->media))
            {
                foreach($request->media as $media)
                {
                    // dd($doc);
                    $name=$media->getClientOriginalName();
                    $src= $media->hashName();
                    $media->store('public/uploads/media');
                    ProductImage::create([
                        'product_id' =>$response['data']->id,
                        'name' => $name,
                        'src' => '/storage/uploads/media/'.$src,
    
                    ]);
                }
        
            }
            if(isset($request->product) && count($request->product))
            {
                foreach($request->product as $product)
                {
                    $product=json_decode($product);
                    ProductInfo::create([
                        'product_id' => $response['data']->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'language' => $product->language,
                    ]);
                }
            } 
            if(isset($request->branch) && count($request->branch))
            {
                foreach($request->branch as $branch)
                {                  
                    $branch=json_decode($branch);
                    $pb=ProductBranch::create([
                        'product_id' => $response['data']->id,
                        'branch_id' => $branch->id,        
                        // 'price' => isset($branch->price)?$branch->price:0,        
                    ]);
                    foreach($branch->price as $price)
                    {                  
                        // $branch=json_decode($branch);
                        ProductPrice::create([
                            'product_branch_id' => $pb->id,
                            'product_id' => $response['data']->id,
                            'tag' => $price->tag,
                            'price' => $price->price,
                        ]);    
                    }
                }
            }            
            if(isset($request->category) && count($request->category))
            {
                
                foreach($request->category as $category)
                {
                    $category=json_decode($category);                  
                    ProductCategory::create([
                        'product_id' => $response['data']->id,
                        'category_id' => $category->id,        
                    ]);
                }
            }
            if(isset($request->subcategory) && count($request->subcategory))
            {
                
                foreach($request->subcategory as $subcategory)
                {
                    $subcategory=json_decode($subcategory);                  
                    ProductSubcategory::create([
                        'product_id' => $response['data']->id,
                        'subcategory_id' => $subcategory->id,        
                    ]);
                }
            }
            if(isset($request->group) && count($request->group))
            {
                
                foreach($request->group as $group)
                {
                    $group=json_decode($group);                  
                    ProductGroup::create([
                        'product_id' => $response['data']->id,
                        'group_id' => $group->id,        
                    ]);
                }
            }
            if(isset($request->cuisine) && count($request->cuisine))
            {
                
                foreach($request->cuisine as $cuisine)
                {
                    $cuisine=json_decode($cuisine);                  
                    ProductCuisine::create([
                        'product_id' => $response['data']->id,
                        'cuisine_id' => $cuisine->id,        
                    ]);
                }
            }
            if(isset($request->tag) && count($request->tag))
            {
                
                foreach($request->tag as $tag)
                {
                    $tag=json_decode($tag);                  
                    ProductTag::create([
                        'product_id' => $response['data']->id,
                        'tag_id' => $tag->id,        
                    ]);
                }
            }
            if(isset($request->ingredient) && count($request->ingredient))
            {
                
                foreach($request->ingredient as $ingredient)
                {
                    $ingredient=json_decode($ingredient);                  
                    ProductIngredient::create([
                        'product_id' => $response['data']->id,
                        'ingredient_id' => $ingredient->id,        
                        'ingredient_category_id' => $ingredient->ingredient_category_id,        
                        'title' => $ingredient->title,        
                        'price' => $ingredient->price,        
                    ]);
                }
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
        $data=Product::with('branches')
        ->with('category')
        ->with('subcategory')
        ->with('group')
        ->with('tag')
        ->with('cuisine')
        ->with('ingredient')
        ->with('image')
        ->with('info')
        ->find($id);
        return $data;
    }

    public function edit(Request $request,$id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            $response['data']=Product::where('id',$id)
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
        // dd($request->all());
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        if(!$auth_id)
            return response()->json($response);

            $validator = Validator::make(
                $request->all(), [
                'media.*' => 'required|mimes:jpg,jpeg,png,bmp|max:3000'
                ]
            );
            
            if ($validator->fails()) {
                $response['data'] = $validator->getMessageBag()->toArray();
                return response()->json($response);
            }

        DB::beginTransaction();
        try {
            $response['data']=Product::where('id',$request->id)
            ->update([
                'model' => $request->model,
                'size_type'=>$request->size_type,
                'video_link'=>$request->video_link,
                'price' => $request->price,
                'points' => $request->points,
                'dimensions_l' => $request->dimensions_l,
                'dimensions_w' => $request->dimensions_w,
                'dimensions_h' => $request->dimensions_h,
                'dimensions_class' => $request->dimensions_class,
                'weight' => $request->weight,
                'weight_class' => $request->weight_class,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'veg' => $request->veg,
                'sort' => $request->sort,
                'status' => $request->status,
            ]);
            if(isset($request->productEdit) && count($request->productEdit))
            {
                foreach($request->productEdit as $product)
                {
                    $product=json_decode($product);
                    ProductInfo::where('id',$product->id)
                    ->update([
                        'name' => $product->name,
                        'description' => $product->description,
                        'language' => $product->language,
                    ]);
                }
            }
            ProductBranch::where('product_id',$request->id)->delete();
            ProductPrice::where('product_id',$request->id)->delete();
            if(isset($request->branchEdit) && count($request->branchEdit))
            {
                foreach($request->branchEdit as $branch)
                {   
                    $branch=json_decode($branch,true);
                    // dd($branch['id']);               
                    $pb=ProductBranch::create([
                        'product_id' => $request->id,
                        'branch_id' => $branch['id'],        
                    ]);
                    foreach($branch['price'] as $price)
                    {                  
                        // $branch=json_decode($branch);
                        ProductPrice::create([
                            'product_branch_id' => $pb->id,
                            'product_id' => $request->id,
                            'tag' => $price['tag'],
                            'price' => $price['price'],
                        ]);    
                    }
                }
            }
            ProductCuisine::where('product_id',$request->id)->delete();
            if(isset($request->cuisineEdit) && count($request->cuisineEdit))
            {
                foreach($request->cuisineEdit as $cuisineEdit)
                {                  
                    $cuisineEdit=json_decode($cuisineEdit);
                    ProductCuisine::create([
                        'product_id' => $request->id,
                        'cuisine_id' => $cuisineEdit->id,        
                    ]);
                }
            }
            ProductGroup::where('product_id',$request->id)->delete();
            if(isset($request->group) && count($request->group))
            {
                foreach($request->group as $group)
                {
                    $group=json_decode($group);                  
                    ProductGroup::create([
                        'product_id' => $request->id,
                        'group_id' => $group->id,        
                    ]);
                }
            }
            ProductTag::where('product_id',$request->id)->delete();
            if(isset($request->tagEdit) && count($request->tagEdit))
            {
                foreach($request->tagEdit as $tagEdit)
                {                  
                    $tagEdit=json_decode($tagEdit);
                    ProductTag::create([
                        'product_id' => $request->id,
                        'tag_id' => $tagEdit->id,        
                    ]);
                }
            }
            ProductIngredient::where('product_id',$request->id)->delete();
            if(isset($request->ingredientEdit) && count($request->ingredientEdit))
            {
                foreach($request->ingredientEdit as $ingredientEdit)
                {                  
                    $ingredientEdit=json_decode($ingredientEdit);
                    ProductIngredient::create([
                        'product_id' => $request->id,
                        'ingredient_id' => $ingredientEdit->id,        
                        'ingredient_category_id' => $ingredientEdit->ingredient_category_id,        
                        'title' => $ingredientEdit->title,        
                        'price' => $ingredientEdit->price,       
                    ]);
                }
            }
            ProductCategory::where('product_id',$request->id)->delete();            
            if(isset($request->categoryEdit) && count($request->categoryEdit))
            {
                
                foreach($request->categoryEdit as $category)
                {
                    $category=json_decode($category);                  
                    ProductCategory::create([
                        'product_id' =>$request->id,
                        'category_id' => $category->id,        
                    ]);
                }
            }
            ProductSubcategory::where('product_id',$request->id)->delete();   
            if(isset($request->subcategoryEdit) && count($request->subcategoryEdit))
            {
                
                foreach($request->subcategoryEdit as $subcategory)
                {
                    $subcategory=json_decode($subcategory);                  
                    ProductSubcategory::create([
                        'product_id' =>$request->id,
                        'subcategory_id' => $subcategory->id,        
                    ]);
                }
            }
            ProductImage::where('product_id',$request->id)->delete();      
            if(isset($request->imageEdit) && count($request->imageEdit))
            {

                foreach($request->imageEdit as $image)
                {
                    $image=json_decode($image); 
                    
                    $created=ProductImage::create([
                        'product_id' =>$request->id,
                        'name' => $image->name,
                        'src' => $image->src,
    
                    ]);
                    // dd($image);
                }
        
            }            
            if(isset($request->media) && count($request->media))
            {
                foreach($request->media as $media)
                {
                    $name=$media->getClientOriginalName();
                    $src= $media->hashName();
                    $media->store('public/uploads/media');
                    ProductImage::create([
                        'product_id' => $request->id,
                        'name' => $name,
                        'src' => '/storage/uploads/media/'.$src,
                    ]);
                }
        
            }            
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line: '.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
    }

    public function destroy($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] = Product::find($id);
        if($response['data'])
        {
            DB::beginTransaction();
            try {
                ProductBranch::where('product_id',$id)->delete();
                ProductPrice::where('product_id',$id)->delete();
                ProductImage::where('product_id',$id)->delete();
                ProductCategory::where('product_id',$id)->delete();
                ProductInfo::where('product_id',$id)->delete();
                ProductCuisine::where('product_id',$id)->delete();
                ProductIngredient::where('product_id',$id)->delete();
                ProductTag::where('product_id',$id)->delete();
                $response['data']=$response['data']->delete();
                $response['status'] = true;
                DB::commit();
            } catch (\Exception $e) {
                $response['data']=$e->getMessage().', Line: '.$e->getLine();
                $response['status'] = false;
                DB::rollback();
            }            

        }
        else
        {
            $response['data']="Product not Exist";  
        }
        return response()->json($response);

    }
    public function branchUpdate(Request $request)
    {
        // dd($request->all());
        $response=array();
        $response['status']=false;
        $response['data'] ='';

        DB::beginTransaction();
        try {
            $response['data']=ProductBranch::where('id',$request->id)
            ->update([
                'status' => $request->status,
            ]);         
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line: '.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
    }

    
}

