<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	use HasFactory;
	use Searchable;

	protected $fillable = ['name'];

	protected $searchableFields = ['*'];

	public function types() {
		return $this->hasMany(Type::class);
	}
}
