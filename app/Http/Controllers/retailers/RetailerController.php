<?php

namespace App\Http\Controllers\retailers;

use Hash;
use App\User;
use App\RetailerProfile;
use App\OffersModel;
use App\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RetailerController extends Controller
{


	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'shopownername' => 'required|string|max:255',
            'shopname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|unique:users',
            'retailerpassword' => 'required|string|min:6|confirmed',

        ]);
    }

    public function AddRetailer(Request $request)
    {
      // dd($request->all());
      

    	$validator = $this->validator($request->all());
    	if ($validator->fails()) {
        // dd($validator);
    		return Redirect::back()
        ->withErrors($validator)
        ->withInput($request->all());        
    	}
    	$user = User::create([
          'name'=>$request->shopownername,
          'email'=>$request->email,
          'mobile'=>'+91'.$request->mobile,
          'role'=>'retailer',
          'password'=>Hash::make($request->retailerpassword),
    	]);
      

    	RetailerProfile::create([
    		'retailer_id'=>$user->id,
    		'shopname'=>$request->shopname,
    		'verified'=>0,
    	]);
      $location=[];
      for ($i=0; $i < count($request->retailerlocation) ; $i++) { 
        $data['retailer_id'] = $user->id;
        $data['address']=$request->retailerlocation[$i];
        $data['latitude']=$request->lattitude[$i];
        $data['longitude']=$request->longtitude[$i];
        array_push($location,$data);
      }
      
      // dd($location);
      $cat = [];
      foreach ($request->category as $key => $value) {
        $datas['retailer_id'] = $user->id;
        $datas['cat_id'] = $value;
        array_push($cat,$datas);
      }
      DB::table('retailer_shops')->insert($location);
      DB::table('retailer_types')->insert($cat);

    	auth()->login($user);
        return redirect()->to('retailer/');
    }
    public function gettingRetailerData()
    {
      $user = auth()->user()->retailerprofile;

               if ($user->verified == 0) {
                
                    $msg=['status'=>0,'msg'=>'add Your First Offer','url'=>url('retailer/createoffers')];
                }
                else{
                    $msg=['status'=>1,'msg'=>'add Some More Offer','url'=>url('retailer/createoffers')];
                }
      $offers = OffersModel::where('retailer_id',$user->retailer_id)
                            ->get()
                            ->all();
      return view('retailers.RetailerDashboard')
                   ->with('offers',$offers)
                   ->with('msg',$msg);
    }
    public function createoffers()
    {
     $user = auth()->user()->retailerprofile;
     $retailer_id = $user->retailer_id;
     
     $shops = RetailerProfile::find($retailer_id)->retailer_shops;
            $cat = ParentCategory::where('parent_id',0)->get();
            return view('retailers.createOffers')
            ->with('cat',$cat)
            ->with('shops',$shops);
    }
    
}
