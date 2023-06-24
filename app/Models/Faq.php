<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Faq extends Model
{
	protected $table = 'faq';
     protected $guarded = [
        'id','created_at','updated_at'
    ];
    
    public function faqBelongsToProducts()
    {
        return $this->belongsTo('App\Models\Products','product_id')->where('active',1);
    }
    
   
}
