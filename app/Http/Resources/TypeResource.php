<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'type_name' => $this->type_name,
			'category' => [
				'id' => $this->category->id,
				'name' => $this->category->name,
			],
		];
	}
}
