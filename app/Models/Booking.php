<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model
{
	protected $table = 'booking';
    // protected $fillable = [
    //     'user_id','appointment_date', 'is_active','is_deleted'
    // ];
    
    protected $guarded = ['id', 'created_at','updated_at'];
    //  public function appointmentbelongsToUser()
    // {
    //     return $this->belongsTo('App\Models\User','user_id');
    // }
    
    //  public function appointmentHasDetail()
    // {
    //     return $this->hasMany('App\Models\AppointmentDetail', 'appointment_id','id');
    // }
    // public function appointmentHasDocs()
    // {
    //     return $this->hasMany('App\Models\AppointmentDocs', 'appointment_id','id');
    // }
    // public function appointmentHasReport()
    // {
    //     return $this->hasMany('App\Models\AppointmentReport', 'appointment_id','id');
    // }

    // public function picture()
    // {
    //     return $this->hasOne('App\Models\Imagetable', 'ref_id','id')->where('table_name', 'pet-picture');
    // }
   
}
