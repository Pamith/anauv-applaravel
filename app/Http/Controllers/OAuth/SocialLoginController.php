<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use App\UserProfile;

class SocialLoginController extends Controller
{
    public function FacebookRedircet()
    {
    	 return Socialite::driver('facebook')->redirect();
    }
    public function FacebookCallback($provider)
    {
      
        $user = $this->createOrGetUser(Socialite::driver('facebook')->user(),'facebook');
        auth()->login($user);
        return redirect()->to('/home');
   
    }
    public function SocialCallback(Request $request)
    { $data['provider'] = $request->provider;
        switch ($data['provider']) {
            case 'phone':
                $data['providerID'] = $request->uid;
                $data['mobile'] = $request->phoneNumber;
                $data['email'] =  !empty($request->email)  ? $request->email : NULL;
                $data['name'] =  !empty($request->displayName)  ? $request->displayName : 'Customer';
                $data['photoUrl']= $request->photoURL;
                $user = $this->createOrGetUser($data);
                break;
            case 'google.com':
                $data['providerID'] = $request->uid;
                $data['mobile'] = !empty($request->phoneNumber)  ? $request->phoneNumber : $request->email;
                $data['email'] =  $request->email;
                $data['name'] =  $request->displayName;
                $data['photoUrl']= $request->photoURL;
                $user = $this->createOrGetUser($data);
                break;              
            
            default:
                
                break;
        }
    
        auth()->login($user);
        if (\Auth::check()) {
            return response()->json([
                'status' =>1,
                'url' => url('/home')
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'url' => url('/login')
            ]);
        }
        
    }

    public function createOrGetUser($data)
    {  
        
        $account = User::whereProvider($data['provider'])
            ->where('provider_id',$data['providerID'] )
            ->first();

        if ($account) {

            return $account;
        } else {      
            switch ($data['provider']) {
                case 'phone':
                    $user = User::where('mobile',$data['mobile'])
                            ->first();
                    break;
                case 'google.com':
                      $user = User::Where('email',$data['email'])
                              ->first();
                    break;
                
                default:
                    
                    break;
            }
            
            if (!$user) {
                $user = User::create([
                    'name' => $data['name'],
                    'email'=> $data['email'],
                    'mobile'=>$data['mobile'],
                    'role'=>'user',
                    'provider_id'=>$data['providerID'],
                    'provider'=>$data['provider'],
                    'password' => bcrypt(rand(1,10000)),
                ]);
                UserProfile::create([
                    'user_id'=>$user->id,
                 ]);

            }
            return $user;
        }
    }
    public function add($value='')
    {
        # code...
    }
}
