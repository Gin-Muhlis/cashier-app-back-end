<?php

namespace App\Http\Resources;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportEntrustedProductResource extends JsonResource
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
            'sell_price' => $this->sell_price,
            'solds' => $this->handleSold($this->id)
        ];
    }

    private function handleSold(int $id) {
        $transactionDetail = TransactionDetail::with('transaction')->where('entrusted_product_id', $id)->get();

        $result = [];

        foreach ($transactionDetail as $item) {
            $result[$item->id] = [
                'transaction_id' => $item->transaction->id,
                'date_transaction' => $item->transaction->date->toDateString(),
                'sold' => 0
            ];
        }

        foreach ($transactionDetail as $item) {
            $data = $result[$item->id];
            if ($item->transaction_id == $data['transaction_id']) {
                $result[$item->id] = [
                    ...$data,
                    'sold' => $data['sold'] + $item->quantity,
                ];
            } else {
                $result[$item->id] = [
                    ...$data,
                    'sold' => $data['sold'] + 0,
                ];
            }
        }

        $report_sold = [];

        return $result;
    }
}
