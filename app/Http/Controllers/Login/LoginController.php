<?php

namespace App\Http\Controllers\Login;

use App\Models\User\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Sentinel;
use App\Http\Requests\loginUserRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        session(['url.intended' => url()->previous()]);
        $this->insertDefaultData();
        return view('auth.login');
    }

    /**
     * @param  loginUserRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(loginUserRequest $request)
    {
        try {
            if (User::where('email', $request->email)->where('status', 0)->first()) {
                return redirect()->back()->with(['error' => 'You are not allowed to login.']);
            }

            $remember_me = false;
            if (isset($request->remember_me)) {
                $remember_me = true;
            }

            if (Sentinel::authenticate($request->all(), $remember_me)) {
                if (Sentinel::inRole('admin') || Sentinel::inRole('user') || Sentinel::inRole('hr')) {
                    $http     = new Client;
                    $response = $http->post(url('oauth/token'), [
                        'form_params' => [
                            'grant_type'    => 'password',
                            'client_id'     => '2',
                            'client_secret' => '0baNkt9avvek4TyaezFoROncN0RHEHN5hIOj6dVL',
                            'username'      => $request->email,
                            'password'      => $request->password,
                            'scope'         => '',
                        ],
                    ]);

                    $token = json_decode((string) $response->getBody());
                    $route = (session()->has('url.intended')) ? session('url.intended') : route('home');
                    return redirect()->to($route)->with([
                        'access_token' => $token->access_token,
                        'expiration'   => $token->expires_in,
                    ]);
                } else {
                    return redirect()->route('login');
                }
            } else {
                return redirect()->back()->with(['error' => 'Wrong Credentials']);
            }
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return redirect()->back()->with(['error' => "You are banned for $delay seconds"]);
        } catch (NotActivatedException $e) {
            return redirect()->back()->with(['error' => "Your account is not activated yet."]);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Sentinel::logout();
        return redirect()->route('login');
    }

    /**
     *
     */
    public function insertDefaultData()
    {
        $roles = Sentinel::getRoleRepository()->get();

        if (count($roles) == 0) {
            $roleList = ['Admin', 'User', 'HR'];

            foreach ($roleList as $key => $item) {
                $input['slug'] = Str::slug($item, '-');
                $input['name'] = Str::ucfirst($item);
                Sentinel::getRoleRepository()->createModel()->create($input);
            }
        }

        if (!$kapil = User::whereEmail("admin@admin.com")->first()) {
            $kapilData['first_name'] = 'Kapil';
            $kapilData['last_name']  = 'Paul';
            $kapilData['email']      = 'admin@admin.com';
            $kapilData['password']   = '123456';

            $role = Sentinel::findRoleBySlug('admin');
            $user = Sentinel::registerAndActivate($kapilData);
            $role->users()->attach($user);
        }
    }

}
