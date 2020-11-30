<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function confirmEmailSignUp(Request $request)
    {

        $currentTime = Carbon::now();
        User::where('user_token', $request->user_token)->update([
            'email_verified_at' => $currentTime,
        ]);

        echo 'active finish';
    }

    public function updatePassword(Request $request)
    {
        $user_token = $request->user_token;
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'string',
                'max:20',
                'min:6',
            ],
            'password_confirm' => 'required|same:password'
        ]);

        if($validator->fails()){
            Session::put(['password'=>'Your password and confirm password are not same']);
            return Redirect::back();
        } else {
            User::where('user_token', $user_token)->update([
                'password'=>bcrypt($request->password)
            ]);
            Session::forget('password');
            echo 'your password was reset';
        }
    }
}
