<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $fillable = [
        'title',
        'price',
        'slug',
        'stock',
        'initial_price',
        'category_id',
        'sub_category_id',
        'description',
        'vendor_id',
        'images',
        'status',
    ];

    public function categories() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategories() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function productImage() {
        return $this->hasMany(ProductImage::class);
    }
    
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', 1);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
