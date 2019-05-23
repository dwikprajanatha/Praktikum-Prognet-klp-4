<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verifyUser extends Model
{
    public $table = "verify_token";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token'
    ];
}
