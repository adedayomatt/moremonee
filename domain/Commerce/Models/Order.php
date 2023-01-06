<?php

namespace Domain\Commerce\Models;

use Carbon\Carbon;
use Domain\Commerce\Constants\Constants;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        "reference", "status", "email", "billing", "shipping", "metadata"
    ];

    protected $casts = [
        "billing" => "object",
        "shipping" => "object",
        "metadata" => "object"
    ];

    protected $appends = [
        "totalAmount", "currency"
    ];

    public function getBillingAttribute($value) {
        return json_decode($value);
    }

    public function getShippingAttribute($value) {
        return json_decode($value);
    }

    public function getMetadataAttribute($value) {
        return json_decode($value);
    }

    public function getTotalAmountAttribute() {
        return $this->orderItems->map(function ($item) {
            $item->total = $item->amount * $item->quantity;
            return $item;
        })->sum("total");
    }

    public function getCurrencyAttribute() {
        return optional($this->orderItems->first())->currency ?? Constants::CURRENCY_USD;
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public static function generateOrderRef() {
        return uniqid("MM-".time()."-");
    }


}
