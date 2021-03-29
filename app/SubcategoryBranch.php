<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoryBranch extends Model
{
    protected $fillable = [
        'subcategory_id', 'branch_id','status'
    ];
    public function branch()
    {
       return $this->belongsTo('App\Branch');
    } 
    public function subcategory()
    {
       return $this->belongsTo('App\Subcategory');
    } 
}
