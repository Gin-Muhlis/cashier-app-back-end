<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'sub_total' => $this->sub_total,
			'unit_price' => $this->unit_price,
			'quantity' => $this->quantity,
			'menu' => [
				'id' => $this->menu->id,
				'name' => $this->menu->menu_name,
			],
			'transaction' => [
				'id' => $this->transaction->id,
				'total_payment' => $this->transaction->total_payment,
			],
		];
	}
}
