<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Scalar\Scalar
*/

class Scalar extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return \App\Services\Scalar\Scalar::class;
    }

}