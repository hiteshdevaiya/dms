<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devotee extends Model
{
     protected $table = 'devotee';
     protected $primaryKey = 'id';
     protected $fillable = [
          'surname',
          'category_id',
          'first_name',
          'last_name',
          'email',
          'password',
          'otp',
          'image',
          'country_code',
          'mobile_no',
          'mobile_no_2',
          'whatsapp_no',
          'dob',
          'gender',
          'address',
          'area',
          'country_id',
          'state_id',
          'city_id',
          'native_place',
          'marital_status',
          'marriage_date',
          'status',
     ];

     public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id');
     }
     public function state(){
        return $this->belongsTo('App\Models\States','state_id','id');
     }
     public function city(){
        return $this->belongsTo('App\Models\City','city_id','id');
     }
     public function occupation(){
        return $this->hasOne('App\Models\DevoteeOccupation','devotee_id','id');
     }
     public function permanentAddress(){
        return $this->hasOne('App\Models\DevoteeAddress','devotee_id','id')->where('type',1);
     }
     public function communicationAddress(){
        return $this->hasOne('App\Models\DevoteeAddress','devotee_id','id')->where('type',2);
     }
     public function magazineAddress(){
        return $this->hasOne('App\Models\DevoteeAddress','devotee_id','id')->where('type',3);
     }
     public function relationships(){
        return $this->hasMany('App\Models\DevoteeRelation','devotee_id','id');
     }
     public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
     }
}
