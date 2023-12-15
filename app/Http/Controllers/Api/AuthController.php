<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
	public function login(Request $request) {
		try {
			$validator = Validator::make($request->all(), [
				'email' => ['required', 'email'],
				'password' => ['required'],
			], [
				'email.required' => 'Email tidak boleh kosong',
				'email.email' => 'Email tidak valid',
				'password.required' => 'Password tidak boleh kosong',
			]);

			if ($validator->fails()) {
				return response()->json([
					'success' => false,
					'message' => 'Data tidak valid',
					'error' => $validator->errors(),
				], 422);
			}

			$credentials = $validator->validated();

			if (!Auth::attempt($credentials)) {
				return response()->json([
					'success' => false,
					'message' => 'Email atau password salah.',
				], 404);
			}

			$user = Auth::user();

			$token = $user->createToken('auth-token')->accessToken;

			return response()->json([
				'success' => true,
				'token' => $token,
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}

	}

	public function logout(Request $request) {
		try {
			$user = $request->user();
			$user->token()->revoke();
			return response()->json([
				'success' => true,
				'message' => 'Logout berhasil',
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}
	}
}
