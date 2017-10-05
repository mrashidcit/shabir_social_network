<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['u_id', 'c_id', 'comment' ];
}
