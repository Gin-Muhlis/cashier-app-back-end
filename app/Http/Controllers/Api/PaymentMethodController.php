<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodStoreRequest;
use App\Http\Resources\PaymentMethodCollection;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller {
	public function index() {
		$methods = PaymentMethod::all();

		$data = new PaymentMethodCollection($methods);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);

	}
	public function store(PaymentMethodStoreRequest $request) {
		try {
			$validated = $request->validated();

			if ($request->hasFile('icon')) {
				$validated['icon'] = $request->file('icon')->store('public');
			}

			PaymentMethod::create($validated);

			return response()->json([
				'success' => true,
				'message' => 'Jenis pembayaran berhasil ditambahkan',
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => 'Server Error',
				'error' => $e->getMessage(),
			], 500);
		}
	}
}
