<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
   protected $fillable = ['user_id','contact','country','address','about','education'];

        public function user() 
        {
    return $this->belongsTo('App/User');
}
 
 
}
