<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http;

use App\Http\Middleware\{
    Authenticate,
    EncryptCookies,
    PreventRequestsDuringMaintenance,
    RedirectIfAuthenticated,
    TrimStrings,
    TrustProxies,
    VerifyCsrfToken
};
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\{
    AuthenticateWithBasicAuth,
    Authorize,
    EnsureEmailIsVerified,
    RequirePassword
};
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\{
    ConvertEmptyStringsToNull,
    ValidatePostSize,
};
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\{
    SubstituteBindings,
    ThrottleRequests,
    ValidateSignature
};
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

/**
 * Class Kernel
 *
 * @package App\Http
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'             => Authenticate::class,
        'auth.basic'       => AuthenticateWithBasicAuth::class,
        'cache.headers'    => SetCacheHeaders::class,
        'can'              => Authorize::class,
        'guest'            => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed'           => ValidateSignature::class,
        'throttle'         => ThrottleRequests::class,
        'verified'         => EnsureEmailIsVerified::class,
    ];
}
