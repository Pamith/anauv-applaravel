<?php

namespace App\Http\Controllers\shop;

use App\User;
use App\OffersModel;
use App\ParentCategory;
use App\RetailerProfile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RequestOfferNotification;

class HomeController extends Controller
{
    public function ShopHome()
    {
    	$max_distance = 50;
        $parents = ParentCategory::all()->where('parent_id',0);
        if (isset($_COOKIE["lat"]) && isset($_COOKIE["lng"]) && $_COOKIE["lng"] !='' &&$_COOKIE["lat"] != '') {
           $lat = $_COOKIE["lat"];
           $lng = $_COOKIE["lng"];
       
          $offers = DB::select(
               'SELECT *, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance FROM offers_models HAVING distance < '.$max_distance.' ORDER BY distance LIMIT 0 , 20;
            ');
           }else{
              $offers = OffersModel::where('status',1)
                    ->get()
                    ->all();
           }
       
        return view('shop.ShopHome')
               ->with('offers',$offers)
               ->with('category',$parents);
    }
    public function filter(Request $request)
    {
    	$max_distance = $request->distance ? $request->distance : 50;
    	$ids = $request->filter_ids?$request->filter_ids:'null';
        
        if (isset($_COOKIE["lat"]) && isset($_COOKIE["lng"]) && $_COOKIE["lng"] !='' &&$_COOKIE["lat"] != '') {
           $lat = $_COOKIE["lat"];
           $lng = $_COOKIE["lng"];
           
           switch ($ids) {
           	case 'null':
           		$offers = DB::select('SELECT *, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance FROM offers_models HAVING distance < '.$max_distance.' ORDER BY distance;');
           		break;
           	
           	default:
           		$offers = DB::select('SELECT *, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance FROM offers_models WHERE category  IN ('.$ids.') HAVING distance < '.$max_distance.' ORDER BY distance;');
           		break;
           }

           }else{
		           switch ($ids) {
		           	case 'null':
                     $offers = DB::select('SELECT * FROM offers_models ORDER BY id;');
		               
		               break;
		           	
		           	default:
		           	     $offers = DB::select('SELECT * FROM offers_models WHERE category  IN ('.$ids.')  ORDER BY id;');
		           	break;
		           }
		       }
    	$returnHTML = view('shop.filterList')
    	              ->with('offers',$offers)
    	              ->render();// or method that you prefere to return data + RENDER is the key here
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
    public function RequestOffer(Request $request)
    {
      $users;
      $lat = $_COOKIE["lat"];
      $lng = $_COOKIE["lng"];
    	switch ($request->request_type) {
    		case 'modal':
	    		$parents = ParentCategory::all()->where('parent_id',0);
	    	    $returnHTML = view('misc.requestOfferModal')
	    	              ->with('category',$parents)
	    	              ->render();
	    	    return response()->json( array('success' => true, 'html'=>$returnHTML) );
    		break;
    		case 'offer':
    		      $ids = explode(',',$request->offer_ids);
    		     $users = User::whereHas('retailer_types',function($q) use ($ids){     
                  $q->WhereIN('cat_id',$ids);
             })->whereHas('retailer_shops',function($query) use ($lat,$lng){
                   $query->whereRaw('( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) )  < 50');
                   
             })->get();

            $req_cat = ParentCategory::WhereIN('id',$ids)
             ->get();
    			break;	
    		
    		default:
    			# code...
    			break;
    	}
      foreach ($users as $user ) {
       $user->notify(new RequestOfferNotification($user,$req_cat));
      }
      // print_r($users);
      return "true";
    }
}
