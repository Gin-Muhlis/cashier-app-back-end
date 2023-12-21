<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
	use HasFactory;
	use Searchable;

	protected $fillable = ['icon', 'name'];

	protected $searchableFields = ['*'];

	public function transactions() {
		return $this->hasMany(Transaction::class);
	}
}
