<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
     protected $table = 'states';
     protected $primaryKey = 'id';
     protected $fillable = [
          'country_id',
          'title',
          'status'
     ];
     public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id');
     }
}
