<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\RateLimitProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    RateLimitProvider::class,
];
