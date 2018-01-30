<?php

namespace App\Http\Controllers\users;

use Auth;
use App\User;
use App\UserProfile;
use App\ParentCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data,$id)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'mobile' => 'required|string|unique:users,mobile,'.$id,
            'dob' => 'required',
            'gender' => 'required',
            'editpassword' => 'confirmed',
        ]);
    }

    public function gettingUserData(Request $request)
    {
        $user = Auth::user()->userprofile;
    	$data=json_decode($user->interests);
    	return view('users.UserDashboard')
    	         ->with('interests',$data);
    }
    public function listInterests()
    {
    	$user = Auth::user()->userprofile;
    	$selected_data=json_decode($user->interests);
    	if (!empty($selected_data)) {
    		foreach ($selected_data as $key => $value) {
        	$prev_data[] = $value->id;
        }
        }
        else{
        	$prev_data=[];
        }
    	
        
    	$parents = ParentCategory::all()->where('parent_id',0);
    	$childrens = ParentCategory::all()->where('parent_id','!=',0);
    	$data['parents'] = $parents;
    	$data['childrens'] = $childrens;
    	return view('users.listInterests')
    	        ->with(['datas'=>$data,'selected_data'=>$prev_data]);
    }
    public function addUserInterests(Request $request)
    {
        $user = Auth::user()->userprofile;
    	$user->interests = $request->data;
    	$user->interests_status = 1;
    	if ($user->save()) {
    		return 'true';
    	}
    	return 'false';
    	
    }
    public function UserDataEdit()
    {
        $user =Auth::user();
        $userprofile = Auth::user()->userprofile;
        // dd($user->mobile);
        return view('users.edit')
        ->with('profile',$userprofile)
        ->with('user',$user);
    }
    public function updateUserData(Request $request)
    {   $user =Auth::user();
        $validator = $this->validator($request->all(),$user->id);
        // dd($validator);
        if ($validator->fails()) {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput($request->all());        
        }

        $user =Auth::user();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->gender = $request->gender == 'female' ? 0 :1;
        if ($request->editpassword) {
            $user->password = bcrypt($request->editpassword);
        }
        $user->save();

        $userprofile = Auth::user()->userprofile;
        $userprofile->DOB = $request->dob;
        $userprofile->is_completed = 1;
        $userprofile->save();
        return redirect()->to('user');
    }
}
