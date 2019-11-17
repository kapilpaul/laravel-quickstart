<?php

namespace App\Http\Controllers\Login;

use App\Models\User\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use GuzzleHttp\Client;
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
        $roles = Sentinel::getRoleRepository()->get();

        if (count($roles) == 0) {
            $input['slug'] = 'admin';
            $input['name'] = 'Admin';

            Sentinel::getRoleRepository()->createModel()->create($input);
        }

        if (! $kapil = User::whereEmail("admin@admin.com")->first()) {
            $kapilData['first_name'] = 'Kapil';
            $kapilData['last_name']  = 'Paul';
            $kapilData['email']      = 'admin@admin.com';
            $kapilData['password']   = '123456';

            $role = Sentinel::findRoleBySlug('admin');
            $user = Sentinel::registerAndActivate($kapilData);
            $role->users()->attach($user);
        }

        return view('auth.login');
    }

    /**
     * @param loginUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(loginUserRequest $request)
    {
        try {
            $remember_me = false;
            if (isset($request->remember_me))
                $remember_me = true;

            if (Sentinel::authenticate($request->all(), $remember_me)) {

                if (Sentinel::inRole('admin') || Sentinel::inRole('user') || Sentinel::inRole('premium-user')) {
                    $http = new Client;
                    $response = $http->post(url('oauth/token'), [
                        'form_params' => [
                            'grant_type' => 'password',
                            'client_id' => '2',
                            'client_secret' => 'VbWBeDANgZ2oz6CmtzIQl1IQPx0cC2Lh3bgBX4kE',
                            'username' => $request->email,
                            'password' => $request->password,
                            'scope' => '',
                        ],
                    ]);

                    $token = json_decode((string)$response->getBody());
                    return redirect()->route('home')->with(
                        [
                            'access_token' => $token->access_token,
                            'expiration' => $token->expires_in
                        ]
                    );
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

}
