<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffersModel extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['retailer_id','address' ,'ShopName','type', 'latitude','longitude','category','offer','offer_desc','short_desc','offer_start','offer_end','status'];
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offers_models';
}
