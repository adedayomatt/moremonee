<?php

namespace Domain\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalServiceRequest extends Model
{
    protected $fillable = [
       "method", "service", "activity", "reference", "url", "headers", "request", "response"
    ];
}
