<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{    
	protected $table = 'products';
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    public function productHasVariations()
    {
        return $this->hasMany(Variation::class,'product_id','id');
    }

    public function productBelongsToVendor()
    {
        return $this->belongsTo('App\Models\Vendor','vendor_id');
    }

    public function productBelongsToCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function productBelongsToSubCategory()
    {
        return $this->belongsTo('App\Models\Sub_category','sub_category_id');
    }

    public function productsHasMainImage()
    {
        return $this->hasMany(ShopImage::class,'ref_id','id')->where('img_type', 1);
    }

    public function productsHasMultiImages()
    {
        return $this->hasMany(ShopImage::class,'ref_id','id')->where('img_type', 2);
    }

    public function productHasReviews()
    {
        return $this->hasMany(Review::class,'item_id','id')->where('type', 1);
    }
   
    public function productHasFaqs()
    {
        return $this->hasMany(Faq::class,'product_id','id')->where('is_active', 1);
    }

    public function productBelongsToBrand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    

}
