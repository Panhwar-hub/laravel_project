<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class News extends Model
{
	protected $table = 'news';
    protected $guarded = [
        'id','created_at','updated_at'
    ];
    
    public function thumbnail()
    {
        return $this->hasOne('App\Models\Imagetable', 'ref_id','id')->where('table_name', 'news-thumbnail');
    }

    public function picture()
    {
        return $this->hasOne('App\Models\Imagetable', 'ref_id','id')->where('table_name', 'news-picture');
    }
   
}
