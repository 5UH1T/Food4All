<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
    protected $fillable = ['sub_category_name','category_id','status'];

    public function categories() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
