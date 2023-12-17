<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'amount' => $this->amount,
			'menu' =>
			[
				'id' => $this->menu?->id ?? '-',
				'name' => $this->menu?->menu_name ?? '-',
			],
		];
	}
}
