<?php

namespace Devchain\LaravelToolkit\Helpers\Model;

use Illuminate\Support\Str;

/**
 * User: gabidj
 * Date: 13.05.2021
 * Time: 18:16
 */
trait ModelUsesUuid
{
    protected static function bootModelUsesUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
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