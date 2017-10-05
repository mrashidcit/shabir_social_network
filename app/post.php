<?php

namespace App;

use App\User;

use  Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['u_id'];    

    public function user(){
        return $this->belongsTo('App\User', 'u_id');
    }


}
