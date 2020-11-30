<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\FindPassword;
use App\Mail\UserSignUp;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signUp', 'findPassword']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'max:20',
                'min:6',             // must be at least 8 characters in length
                // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                // //'regex:/[A-Z]/',      // must contain at least one uppercase letter
                // 'regex:/[0-9]/',      // must contain at least one digit
                // //'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $value) {
                return $this->response(200, [], $value, $validator->errors(), [], false);
            }
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (!Auth::attempt($credentials)) {
            return $this->response(200, [], 'Login information is not valid', [], false);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('SECURITY');
        $token = $tokenResult->token;

        $token->save();

        return $this->response(200, [
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function getUserInfo(Request $request)
    {
        $user = $request->user();
        return $this->response(200, ['user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->response(200, [], 'Logout Success');
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'nullable|max:255',
            'phone_number' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                'min:6',             // must be at least 8 characters in length
            ],
            'password_confirm' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $value) {
                return $this->response(200, [], $value, $validator->errors(), [], false);
            }
        }

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->response(200, ['user' => $user], 'Register successful');
    }

    public function findPassword(Request $request)
    {
        $email = $request->email;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->response(422, [], 'text.invalid_data', $validator->errors());
        }

        $user = User::where('email', $email)->first();
        Mail::to($user->email)->send(new FindPassword($user));

        return $this->response(200, [], 'Please check your email to update password');
    }

    public function updateUserInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => [
                'nullable',
                'max:11',
                'min:10',
                'regex:/[0-9]{10}/',
            ],
            // 'image' => 'nullable|mimes:jpg,png,jpeg,svg',
        ]);

        if ($validator->fails()) {
            return $this->response(422, [], 'invalid_data', $validator->errors());
        }

        $currentUser = $request->user();
        $user = User::find($currentUser->id);
        $user->full_name = $request->full_name;
        $user->level = $request->level;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->gentle = $request->gentle;
        $user->work_total = $request->work_total;
        $user->salary_per_hour = $request->salary_per_hour;
        $user->salary_total = $request->work_total * $request->salary_per_hour;

        if ($currentUser->role == 'admin') {
            $user->role = $request->role;
        }
        
        $user->save();

        return $this->response(200, ['user' => $user], 'Update successful');
    }
    
    public function updateAvatar(){
        
    }
}
