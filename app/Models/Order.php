<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'order_date',
        'start',
        'end',
        'order_name',
        'customer_amount',
        'table_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
