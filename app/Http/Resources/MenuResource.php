<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'name' => $this->menu_name,
			'image' => str_replace('public/', '', url("storage/{$this->image}")),
			'price' => $this->price,
			'id' => $this->id,
			'description' => $this->description,
			'type' => [
				'id' => $this->type?->id ?? '-',
				'name' => $this->type?->type_name ?? '-',
			],
			'stock' => [
				'id' => $this->stock?->id ?? '-',
				'amount' => $this->stock?->amount ?? '-',
			],
		];
	}
}
