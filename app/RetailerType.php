<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailerType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['retailer_id','cat_id'];
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'retailer_types';

    protected $primaryKey = 'retailer_id';

    public function retailersprofile()
    {
      return $this->belongsTo('App\RetailerProfile','retailer_id');
    }
}

