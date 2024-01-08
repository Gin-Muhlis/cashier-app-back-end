<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
	use HasFactory;
	use Searchable;

	protected $fillable = [
		'date',
		'total_payment',
		'payment_method_id',
		'description',
		'user_id',
	];

	protected $searchableFields = ['*'];

	protected $casts = [
		'date' => 'date',
	];

	public function transactionDetails() {
		return $this->hasMany(TransactionDetail::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function paymentMethod() {
		return $this->belongsTo(paymentMethod::class);
	}
}
