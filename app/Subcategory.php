<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use Sluggable,SoftDeletes;
    protected $guarded = [];
    public function branch()
    {
       return $this->hasMany('App\SubcategoryBranch')->with('branch');
    } 
    public function category()
    {
       return $this->hasMany('App\SubcategoryCategory')->with('category');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    } 
    protected $dates = ['deleted_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'sub_category_name'
            ]
        ];
    }
}
