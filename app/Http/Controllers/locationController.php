<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class locationController extends Controller
{
    public function GetAddress(Request $request)
    {
    	if(!empty($request->latitude) && !empty($request->longitude)){
		    //send request and receive json data by latitude and longitude
		    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($request->latitude).','.trim($request->longitude).'&sensor=false$key=AIzaSyCCybB_tGH6COhiyFR0b4Rfng42JOJdZXU';
		    $json = file_get_contents($url);
		    $data = json_decode($json);
		    $response['status'] = $data->status;
		    
		    //if request status is successful
		    if($response['status'] == "OK"){
		        //get address from json data
		        $response['location'] = $data->results[0]->formatted_address;
		    }else{
		        $response['location'] =  'Please Try Again';
		    }
		}
    return response()->json($response);
    }
    public function GetLatLong(Request $request)
    { 
    	$address = $request->address;
    	// return $address;
    	if(!empty($address)){
	        //Formatted address
	        $formattedAddr = str_replace(' ','+',$address);
	        //Send request and receive json data by address
	        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
	        $output = json_decode($geocodeFromAddr);
	        //Get latitude and longitute from json data
	        return $geocodeFromAddr;
	        $data['latitude']  = $output->results[0]->geometry->location->lat; 
	        $data['longitude'] = $output->results[0]->geometry->location->lng;
	        //Return latitude and longitude of the given address
	        if(!empty($data)){
	            $data['status']=1;
	        }else{
	            $data['status']=0;
	            $data['msg']='Please Enter Valid Address';
	        }
	    }else{
	        $data['status']=0;
	        $data['msg']='Please Enter Valid Address';   
	    }
        // return response()->json($data);
    }
}
