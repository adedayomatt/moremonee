<?php

namespace Domain\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        "order_id", "provider", "provider_reference", "reference", "amount", "status", "currency", "metadata"
    ];

    protected $casts = [
        "metadata" => "object"
    ];

    public function getMetadataAttribute($value) {
        return json_decode($value);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
    public function getTransactionData($ref) {
    }

    public function saveTransactionData($ref, $data = []) {
    }
}
