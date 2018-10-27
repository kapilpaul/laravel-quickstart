<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Activation;

class ActivationController extends Controller
{
    /**
     * activation of user
     * @param $email
     * @param $activationCode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateUser($email, $activationCode)
    {
        $user = User::whereEmail($email)->first();

        if (Activation::complete($user, $activationCode)) {
            return redirect()->route('login')->with(['success' => 'Activation Successful']);
        } else {
            return redirect()->route('login')->with(['error' => 'Invalid Activation Key']);
        }

    }
}
