<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierRestaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthCashierController extends Controller
{
    public function login(Request $request)
    {
       $validator = Validator::make ($request->all(), [
            'username' => 'required',
            'nik'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cashier = $request->only('username', 'nik');

        if (!$token = auth('api')->attempt($cashier)) {
            return response()->json(
                ['error' => 'Username atau NIK salah'], 
                401);
        }

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'cashier' => auth('api')->user(),
        ]);
    }
}
