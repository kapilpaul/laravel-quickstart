<?php

namespace App\Http\Controllers\Login;

use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use GuzzleHttp\Client;
use League\Flysystem\Config;
use League\Flysystem\Exception;
use Sentinel;
use App\Http\Requests\loginUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(){
        $roles = Sentinel::getRoleRepository()->get();

        if(count($roles) == 0){
            $input['slug'] = 'admin';
            $input['name'] = 'Admin';

            Sentinel::getRoleRepository()->createModel()->create($input);

            $input['slug'] = 'user';
            $input['name'] = 'User';
            Sentinel::getRoleRepository()->createModel()->create($input);

            $input['slug'] = 'premium-user';
            $input['name'] = 'Premium User';
            Sentinel::getRoleRepository()->createModel()->create($input);
        }

        $kapil = User::whereEmail("admin@admin.com")->first();

        if(!$kapil){
            $kapilData['first_name'] = 'Kapil';
            $kapilData['last_name'] = 'Paul';
            $kapilData['email'] = 'admin@admin.com';
            $kapilData['password'] = 'nothing1234';

            $role = Sentinel::findRoleBySlug('admin');

            $user = Sentinel::registerAndActivate($kapilData);

            $role->users()->attach($user);
        }

//        $loginUrl = $this->fbLogin();

        return view('auth.login');
    }

    public function postLogin(loginUserRequest $request){
        try{
            $remember_me = false;
            if(isset($request->remember_me))
                $remember_me = true;

            if(Sentinel::authenticate($request->all(), $remember_me)){

                if(Sentinel::inRole('admin') || Sentinel::inRole('user') || Sentinel::inRole('premium-user')){
                    $http = new Client;
                    $response = $http->post(env('APP_URL').'/oauth/token', [
                        'form_params' => [
                            'grant_type' => 'password',
                            'client_id' => '2',
                            'client_secret' => 'RqMghgLSXWZPbB6QODMq7bIotXWYKLXUTkGMHlzk',
                            'username' => $request->email,
                            'password' => $request->password,
                            'scope' => '',
                        ],
                    ]);
                    $token = json_decode((string) $response->getBody());
                    return redirect('/bots')->with(['access_token' => $token->access_token, 'expiration' => $token->expires_in]);
                } else {
                    return redirect('/login');
                }
            }else{
                return redirect()->back()->with(['error' => 'Wrong Credentials']);
            }
        }catch(ThrottlingException $e){
            $delay = $e->getDelay();

            return redirect()->back()->with(['error' => "You are banned for $delay seconds"]);
        }catch(NotActivatedException $e){
            return redirect()->back()->with(['error' => "Your account is not activated yet."]);
        }
    }

    public function logout(){
        Sentinel::logout();

        return redirect('/');
    }

}
