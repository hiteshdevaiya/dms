<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevoteeAddress extends Model
{
    use HasFactory;
    protected $table = 'devotee_address';
    protected $fillable = [
         'devotee_id',
         'address',
         'pincode',
         'area',
         'country_id',
         'state_id',
         'city_id',
         'type'
        ];

    public function devotee(){
       return $this->belongsTo('App\Models\Devotee','devotee_id','id');
    }
}
