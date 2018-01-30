<?php

namespace App\Http\Controllers\retailers;

use App\OffersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

   public function AddOffer(Request $request)
    {
    	$retailer = auth()->user()->retailerprofile;
    	$loc = explode('-', $request->shop);

      $offer = OffersModel::create([
      	'retailer_id'=>$retailer->retailer_id,
      	'category'=>$request->category,
      	'ShopName'=>$retailer->shopname,
      	'address'=>$loc[0],
      	'latitude'=>$loc[1],
      	'longitude'=>$loc[2],
      	'offer'=>$request->offer,
      	'short_desc'=>$request->shortdescription,
      	'offer_desc'=>$request->description,
      	'offer_start'=>$request->startdate,
      	'offer_end'=>$request->enddate,
      	'status'=>1,
      ]);
       $retailer->verified = 1;
       $retailer->save();
     return redirect()->to('retailer');
    }
}
