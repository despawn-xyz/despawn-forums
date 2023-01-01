<?php

namespace Despawn\Http\Middleware;

use App\Http\Middleware\HandleInertiaRequests as Middleware;

class ForumsHandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'despawn-forums::app';
}
