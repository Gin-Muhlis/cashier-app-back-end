<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {
	use HasApiTokens;
	use Notifiable;
	use HasFactory;
	use Searchable;

	protected $fillable = ['name', 'address', 'email', 'phone', 'password', 'role_id'];

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

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function getRole() {
		return $this->role->name;
	}
}
