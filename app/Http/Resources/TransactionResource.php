<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'date' => $this->date->toDateString(),
			'total_payment' => $this->total_payment,
			'description' => $this->description,
			'payment' => [
				'id' => $this->paymentMethod->id,
				'name' => $this->paymentMethod->name,
			],
			'user' => [
				'id' => $this->user->id,
				'name' => $this->user->name,
			],
		];
	}
}
