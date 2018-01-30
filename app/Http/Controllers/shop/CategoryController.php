<?php

namespace App\Http\Controllers\shop;

use App\ParentCategory;
use App\OffersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
    	
        $parent = ParentCategory::create([
           'name'=>$request->parentcategory,
        ]);
        if (isset($request->childcategory)) {
        	$this->addSubCategory($request->childcategory,$parent->id);
        }
        	
        
    	return view('admin.addCategory')
    	      ->with('categories',$request->all());
    }

    public function addSubCategory($cat,$parent_id)
    {
    	foreach ($cat as $key => $value) {
	        	$parent = ParentCategory::create([
	                                      'name'=>$value,
	                                      'parent_id'=>$parent_id,
	                                    ]);
	        }
    }
    public function CategoryPageListing($id)
    {
        $parents = ParentCategory::all()->where('parent_id',0);
        $max_distance = 20;
        if (isset($_COOKIE["lat"]) && isset($_COOKIE["lng"]) && $_COOKIE["lng"] !='' &&$_COOKIE["lat"] != '') {
           $lat = $_COOKIE["lat"];
           $lng = $_COOKIE["lng"];
       
          $offers = DB::select(
               'SELECT *, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance FROM offers_models WHERE category = '.$id.' HAVING distance < '.$max_distance.' ORDER BY distance LIMIT 0 , 20;
            ');
           }else{
              $offers = OffersModel::where('category',$id)
                    ->get()
                    ->all();
           }
         
           return view('shop.CategoryPage')
                ->with('offers',$offers)
                  ->with('category',$parents);
    }
    
}
