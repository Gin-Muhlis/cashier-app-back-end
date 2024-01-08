<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'order_date' => $this->order_date->toDateString(),
			'start' => $this->start,
			'end' => $this->end,
			'order_name' => $this->order_name,
			'customer_amount' => $this->customer_amount,
			'table' => [
				'id' => $this->table->id,
				'table_number' => $this->table->table_number,
			],
		];
	}
}
