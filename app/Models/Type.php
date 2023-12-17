<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model {
	use HasFactory;
	use Searchable;

	protected $fillable = ['type_name', 'category_id'];

	protected $searchableFields = ['*'];

	public function category() {
		return $this->belongsTo(Category::class);
	}

	public function menus() {
		return $this->hasMany(Menu::class);
	}
}
