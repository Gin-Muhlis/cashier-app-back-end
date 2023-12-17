<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model {
	use HasFactory;
	use Searchable;

	protected $fillable = ['amount', 'menu_id'];

	protected $searchableFields = ['*'];

	public function menu() {
		return $this->belongsTo(Menu::class);
	}
}
