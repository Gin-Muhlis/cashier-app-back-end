<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['amount'];

    protected $searchableFields = ['*'];

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }
}
