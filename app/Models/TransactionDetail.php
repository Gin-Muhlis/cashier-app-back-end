<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model {
	use HasFactory;
	use Searchable;

	protected $fillable = [
		'sub_total',
		'unit_price',
		'quantity',
		'menu_id',
		'entrusted_product_id',
		'transaction_id',
	];

	protected $searchableFields = ['*'];

	protected $table = 'transaction_details';

	public function menu() {
		return $this->belongsTo(Menu::class);
	}

	public function transaction() {
		return $this->belongsTo(Transaction::class);
	}
}
