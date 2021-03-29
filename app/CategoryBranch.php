<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBranch extends Model
{
    protected $fillable = [
        'category_id', 'branch_id','status'
    ];
    public function branch()
    {
       return $this->belongsTo('App\Branch');
    } 
    public function category()
    {
       return $this->belongsTo('App\Category');
    } 
}
