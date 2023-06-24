<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variationimage extends Model
{
    // use HasFactory;
    protected $table = 'variationimage';
	// public $primaryKey = 'id';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

//     public function orderHasDetail()
//    {     
//        return $this->hasOne('App\Models\OrderDetail', 'order_id','id');  
//    }

    public function variationimageBelongsToColor()
    {
        return $this->belongsTo('App\Models\Flavor','color_id');
    }
    public function variationimageBelongsToSize()
    {
        return $this->belongsTo('App\Models\Size','size_id');
    }


    public function variationimageBelongsToProduct()
    {
        return $this->belongsTo('App\Models\Products','product_id');
    }
}
