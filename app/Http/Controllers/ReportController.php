<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\TransactionDetail;

class ReportController extends Controller {
	public function stockReport() {
		$menus = Menu::all();
		$result = [];
		$stock_amount = 0;

		foreach ($menus as $menu) {
			$menu_transactions = TransactionDetail::whereMenuId($menu->id)->get();
			$result[] = [
				'menu_id' => $menu->id,
				'menu_name' => $menu->menu_name,
				'stock' => $menu->stock->amount,
				'sold' => $this->soldCount($menu_transactions),
				'type_id' => $menu->type->id,
			];
			$stock_amount += $menu->stock->amount;
		}

		return response()->json([
			'stock_amount' => $stock_amount,
			'data' => $result,
		]);
	}

	private function soldCount($data) {
		$amount = 0;
		foreach ($data as $item) {
			$amount += $item->quantity;
		}

		return $amount;
	}
}
