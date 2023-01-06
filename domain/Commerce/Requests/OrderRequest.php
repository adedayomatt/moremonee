<?php

namespace Domain\Commerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function __authorize()
    {
        return true;
    }

    public function rules() : array
    {
        return [
            "billing.first_name" => ["required"],
            "billing.last_name" => ["required"],
            "billing.email" => ["required"],
            "billing.address" => ["required"],
            "billing.address.city" => ["required"],
            "billing.address.country" => ["required"],
            "billing.address.state" => ["required"],
            "billing.address.address" => ["required"],
            "billing.address.zipcode" => ["required"],

            "shipping.first_name" => ["required"],
            "shipping.last_name" => ["required"],
            "shipping.email" => ["required"],
            "shipping.address" => ["required"],
            "shipping.address.city" => ["required"],
            "shipping.address.country" => ["required"],
            "shipping.address.state" => ["required"],
            "shipping.address.address" => ["required"],
            "shipping.address.zipcode" => ["required"],

            "items" => ["required", "array", "min:1"],
            "items.*.product_id" => ["required", "exists:products,id"],
            "items.*.quantity" => ["required", "min:1"]
        ];
    }

    public function validated() : array
    {
        return $this->all();
    }
}
