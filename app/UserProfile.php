<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'DOB','interests'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
   
    protected $table = 'usersprofile';

    protected $primaryKey = 'user_id';

    
}
