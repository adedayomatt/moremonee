<?php

namespace Domain\Commerce\Models;

use App\Classes\Utils;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Notifications\OrderCompletedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

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

    public function complete() {
        $this->update([ "status" => Constants::STATUS_COMPLETED ]);
        $this->orderItems->each(function($item) {
            $item->product->in_stock -= $item->quantity;
            $item->product->save();
        });
        Utils::clearMemory($this->reference);
        if(config('business.enable_order_mail')) {
            try {
                $this->notify(new OrderCompletedNotification());
            } catch (\Exception $e) {}
        }
    }

    public function updateBillingAddress($address) {
        $billing = $this->billing;
        $billing->address = $address;
        $this->billing = $billing;
        $this->save();
        return $this;
    }

}
