<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevoteeOccupation extends Model
{
    use HasFactory;
    protected $table = 'devotee_occupation';
    protected $fillable = [
         'devotee_id',
         'type',
         'industry_type',
         'title',
         'address',
         'country_id',
         'state_id',
         'city_id'
        ];

    public function devotee(){
       return $this->belongsTo('App\Models\Devotee','devotee_id','id');
    }
}
