<?php

namespace Domain\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        "order_id", "product_id", "reference", "quantity", "amount", "currency", "status"
    ];

    protected $appends = ["total"];

    public function getTotalAttribute() {
        return $this->quantity * $this->amount;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
