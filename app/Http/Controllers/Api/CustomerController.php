<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller {
	public function index(Request $request) {

		$search = $request->get('search', '');

		$customers = Customer::all();

		$data = new CustomerCollection($customers);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(CustomerStoreRequest $request): CustomerResource {

		$validated = $request->validated();

		$customer = Customer::create($validated);

		return new CustomerResource($customer);
	}

	public function show(Request $request, Customer $customer): CustomerResource {

		return new CustomerResource($customer);
	}

	public function update(
		CustomerUpdateRequest $request,
		Customer $customer
	): CustomerResource {

		$validated = $request->validated();

		$customer->update($validated);

		return new CustomerResource($customer);
	}

	public function destroy(Request $request, Customer $customer): Response {

		$customer->delete();

		return response()->noContent();
	}
}
