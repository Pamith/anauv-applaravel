<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email','mobile', 'password','role','provider_id','provider'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userprofile()
    {
      return $this->hasOne('App\UserProfile','user_id');
    }
    public function retailerprofile()
    {
      return $this->hasOne('App\RetailerProfile','retailer_id');
    }
    public function retailer_types()
    {
      return $this->hasMany('App\RetailerType','retailer_id');
    }
}
