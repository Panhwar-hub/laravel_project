<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    protected $table = 'flavor';
	// public $primaryKey = 'id';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function orderHasDetail()
   {     
       return $this->hasOne('App\Models\OrderDetail', 'order_id','id');  
   }

   public function hasManyVariation()
    {
        return $this->hasMany('App\Models\Variation', 'id','color_id');
    }
   
   
}
