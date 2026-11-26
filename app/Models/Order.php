<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['customer_name', 'phone', 'address', 'note', 'total', 'status'];

    protected $casts = ['total' => 'float'];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}