<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use Sluggable,SoftDeletes;
    protected $guarded = [];
    public function branch()
    {
       return $this->hasMany('App\CategoryBranch')->with('branch');
    } 
    public function parent()
    {
       return $this->belongsTo('App\Category','parent_id','id');
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
                'source' => 'name'
            ]
        ];
    }
}
