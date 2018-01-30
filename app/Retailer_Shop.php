<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer_Shop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['retailer_id','location','latitude','longtitude'];
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'retailer_shops';

    protected $primaryKey = 'retailer_id';

    public function retailersprofile()
    {
      return $this->belongsTo('App\RetailerProfile','retailer_id');
    }
}
