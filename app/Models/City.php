<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     protected $table = 'city';
     protected $primaryKey = 'id';
     protected $fillable = [
          'country_id',
          'state_id',
          'title',
          'status'
     ];
     
     public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id');
     }

     public function state(){
          return $this->belongsTo('App\Models\States','state_id','id');
     }
}
