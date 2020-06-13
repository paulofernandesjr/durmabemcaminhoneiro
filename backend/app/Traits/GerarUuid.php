<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait GerarUuid
{
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }
}
