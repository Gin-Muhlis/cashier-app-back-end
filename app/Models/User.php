<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
	use HasApiTokens;
	use Notifiable;
	use HasFactory;
	use Searchable;
	use HasRoles;

	protected $fillable = ['name', 'address', 'email', 'phone', 'password'];

	protected $searchableFields = ['*'];

	protected $hidden = ['password', 'remember_token'];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function transactions() {
		return $this->hasMany(Transaction::class);
	}

	public function isSuperAdmin(): bool {
		return in_array($this->email, config('auth.super_admins'));
	}
}
