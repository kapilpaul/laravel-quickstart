<?php

namespace App\Http\Controllers\Login;

use App\Models\User\User;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Mail;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    /**
     * forgot Password View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotPasword()
    {
        return view('auth.forgotpassword');
    }


    /**
     * Post Forgot Password
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postForgotPassword(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (count($user) == 0)
            return redirect()->back()->with(['success' => 'Reset Code has been sent.']);

        $reminder = Reminder::exists($user) ?: Reminder::create($user);

        $this->sendEmail($user, $reminder->code);

        return redirect()->back()->with(['success' => 'Reset Code has been sent.']);
    }


    /**
     * Reset Password
     * @param $email
     * @param $reset_code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function resetPassword($email, $reset_code)
    {
        $user = User::whereEmail($email)->firstOrFail();

        if ($reminder = Reminder::exists($user)) {
            if ($reset_code == $reminder->code) {
                return view('auth.resetPassword', compact('user', 'reminder'));
            }
        }

        return redirect()->route('home');
    }


    /**
     * Post Reset Password
     * @param Request $request
     * @param $email
     * @param $reset_code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postResetPassword(Request $request, $email, $reset_code)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $user = User::whereEmail($email)->firstOrFail();

        if ($reminder = Reminder::exists($user)) {
            if ($reset_code == $reminder->code) {
                Reminder::complete($user, $reset_code, $request->password);
                return redirect()->route('login')->with(['success' => 'Login with your New Password']);
            }
        }

        return redirect()->route('home');
    }


    /**
     * Sending Email to User
     * @param $user
     * @param $code
     */
    public function sendEmail($user, $code)
    {
        $mail_data = [
            'user' => $user,
            'code' => $code,
        ];

        Mail::send('email.forgotPassword', $mail_data, function ($message) use ($user) {
            $message->to($user->email)->subject("$user->name reset your passowrd");
        });
    }
}
