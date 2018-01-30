<?php

namespace App\Http\Controllers;

use App\OffersModel;
use App\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('LoginRole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->to('/');
    }
    public function mainpage(Request $request)
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
       
        return view('welcome')
               ->with('offers',$offers)
               ->with('category',$parents);
    }
}
