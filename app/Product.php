<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Product extends Model
{
    use Sluggable,SoftDeletes;
    protected $fillable = [
        'user_id', 'model','price','size_type','points','dimensions_l','dimensions_w', 'dimensions_h','video_link',
        'dimensions_class','weight', 'weight_class', 'meta_title', 'meta_description', 'meta_keyword', 'slug', 'veg', 'sort', 'status',
    ];
    public function branch()
    {
       return $this->belongsTo('App\ProductBranch','id','product_id')->with('branch')->with('price');
    }
    public function fav()
    {
       return $this->hasOne('App\Favourite');
    }
    public function branches()
    {
       return $this->hasMany('App\ProductBranch')->with('branch')->with('price');
    }
    public function category()
    {
       return $this->hasMany('App\ProductCategory')->with('category');
    }
    public function subcategory()
    {
       return $this->hasMany('App\ProductSubcategory')->with('subcategory');
    }
    public function image()
    {
       return $this->hasMany('App\ProductImage');
    }
    public function info()
    {
       return $this->hasMany('App\ProductInfo');
    }
    public function cuisine()
    {
       return $this->hasMany('App\ProductCuisine')->with('cuisine');
    }
    public function tag()
    {
       return $this->hasMany('App\ProductTag')->with('tag');
    }
    public function ingredient()
    {
       return $this->hasMany('App\ProductIngredient')->with('ingredient');
    }
    public function ingredientsByCategory()
    {
       return $this->hasMany('App\ProductIngredient')->with('ingredient');
    }
    public function cart()
    {
       return $this->hasOne('App\Cart');
    }
    public function group()
    {
       $current_time=Carbon::now()->format('H:i:s');
       return $this->belongsToMany('App\Group', 'product_groups')->select("*",\DB::raw("IF(status = 1 && start_time < '".$current_time."' && end_time > '".$current_time."' , 1, 0) as available"));
    }
    protected $dates = ['deleted_at'];
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'meta_title'
            ]
        ];
    }
}
