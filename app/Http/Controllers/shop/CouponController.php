<?php

namespace App\Http\Controllers\shop;

use App\OffersModel;
use App\Notifications\ReceiveCouponCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
   public function SendCouponCode(Request $request)
   {
   	$response = array();
   	$user = auth()->user();
   	if (!$user) {
   		$response['status'] = 0;
   		$response['msg']='You Must Login First';
   		return json_encode($response);
   	}

   	$OffersModel = OffersModel::where('id', $request->offer_id)
   	                           ->get();
    $code = $OffersModel[0]->offer.'-'.$this->quickRandom(6);
   	$user->notify(new ReceiveCouponCode($user,$OffersModel,$code));                           
   }
   public function quickRandom($size) {

	$alpha_key = '';
	$keys = range('A', 'Z');

	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 2;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
  }

}

