<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntrustedProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'supplier_name' => $this->supplier_name,
            'purchase_price' => $this->purchase_price,
            'sell_price' => $this->sell_price,
            'stock' => $this->stock,
            'description' => $this->description,
        ];
    }
}
