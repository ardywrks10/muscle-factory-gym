<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ResetPassController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT ? response()->json([
            'massage' => __($status)
        ], 200) : response()->json([
            'massage' => __($status)
        ]);
    }

    public function reset(Request $request){
        $request->validate([
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|string|confirmed|min:6'
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function(User $user, string $password){
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET ? response()->json([
            'massage' => __($status)
        ], 200) : response()->json([
            'massage' => __($status)
        ]);
    }
}
