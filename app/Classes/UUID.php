<?php


namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Trait UsesUUIDPrimaryKey
 * @package App\Classes
 * @mixin Model
 */
trait UUID
{
    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
