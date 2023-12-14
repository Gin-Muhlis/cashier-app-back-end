<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sub_total',
        'quantity',
        'menu_id',
        'transaction_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'transaction_details';

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
