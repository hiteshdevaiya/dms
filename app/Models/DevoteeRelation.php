<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevoteeRelation extends Model
{
    use HasFactory;
    protected $table = 'devotee_relation';
    protected $fillable = [
         'devotee_id',
         'first_name',
         'middle_name',
         'last_name',
         'mobile',
         'relation'
        ];

    public function devotee(){
       return $this->belongsTo('App\Models\Devotee','devotee_id','id');
    }
}
