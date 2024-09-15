<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutentikasiController extends Controller
{
    public function sign_up(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => "failed",
                    "message" => $validator->errors()->all(),
                    "data" => [],
                ], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "status" => "success",
                "message" => "Registrasi berhasil",
                "data" => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 201);
        } catch(\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Terjadi kesalahan saat registrasi",
                "data" => [],
            ], 500);
        }
    }

    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => "failed",
                    "message" => $validator->errors()->all(),
                    "data" => [],
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    "status" => "success",
                    "message" => "Login berhasil",
                    "data" => [
                        'user' => $user,
                        'token' => $token,
                    ],
                ], 200);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "Data tidak ditemukan, pastikan username & password anda benar",
                    "data" => [],
                ], 200);
            }

        } catch(\Throwable $th) {
            Log::error('Error during login: ' . $th->getMessage());
            return response()->json([
                "status" => "failed",
                "message" => "Terjadi kesalahan saat login",
                "data" => [],
            ], 500);
        }
    }

    public function logout(Request $request) {
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();

            return response()->json([
                "status" => "success",
                "message" => "Logout berhasil",
                "data" => [],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Terjadi kesalahan saat logout",
                "data" => [],
            ], 500);
        }
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'=>'required',
            'password'=>'required|min:8|max:100',
            'confirm_password'=>'required|same:password'
        ]);
        if ($validator->fails()){
            return response()->json([
                'message'=>'Kesalahan Validasi',
                'errors'=>$validator->errors()
            ], 422);
        }

        $user=$request->user();
        if(Hash::check($request->old_password, $user->password))
        {
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
                'message'=>'Password berhasil diperbarui'
            ], 200);
        }else{
            return response()->json([
                'message'=>'Password lama tidak sesuai'
            ], 400);
        }
    }
}
