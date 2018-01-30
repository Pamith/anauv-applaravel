<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailerProfile extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['retailer_id','location' ,'shopname','type', 'latitude','longtitude','verified'];
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'retailersprofile';

    protected $primaryKey = 'retailer_id';
    // protected $casts = [
    //     'location' => 'array'
    // ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function offersmodel()
    {
        return $this->hasMany('App\OffersModel');
    }
    public function retailer_types()
    {
        return $this->hasMany('App\RetailerType','retailer_id');
    }
    public function retailer_shops()
    {
        return $this->hasMany('App\Retailer_Shop','retailer_id');
    }
}
