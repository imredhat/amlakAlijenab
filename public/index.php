<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Create the Laravel session identifier before the framework boots. This is
// intentionally the same direct Set-Cookie approach verified by cookie-test.
$sessionCookieName = 'melkalijenab_session';
$sessionCookieValue = $_COOKIE[$sessionCookieName] ?? '';

if (! is_string($sessionCookieValue) || ! preg_match('/^[A-Za-z0-9]{40}$/', $sessionCookieValue)) {
    $sessionCookieValue = bin2hex(random_bytes(20));
    $_COOKIE[$sessionCookieName] = $sessionCookieValue;
}

$sessionCookieMaxAge = 7200;
header('X-Alijenaab-Session: direct-v4', true);
header(
    'Set-Cookie: '.$sessionCookieName.'='.rawurlencode($sessionCookieValue)
    .'; Expires='.gmdate('D, d M Y H:i:s T', time() + $sessionCookieMaxAge)
    .'; Max-Age='.$sessionCookieMaxAge
    .'; Path=/; HttpOnly; SameSite=Lax',
    false
);

/*
 * Shared-hosting deployments may retain an old bootstrap/cache/config.php
 * because there is no SSH access to run `artisan config:clear`. Point Laravel
 * at an unused cache file so the uploaded .env is always read.
 */
$runtimeCacheOverrides = [
    'APP_CONFIG_CACHE' => __DIR__.'/../bootstrap/cache/config.runtime.php',
    'APP_ROUTES_CACHE' => __DIR__.'/../bootstrap/cache/routes.runtime.php',
    'APP_EVENTS_CACHE' => __DIR__.'/../bootstrap/cache/events.runtime.php',
];

foreach ($runtimeCacheOverrides as $cacheKey => $cachePath) {
    putenv($cacheKey.'='.$cachePath);
    $_ENV[$cacheKey] = $cachePath;
    $_SERVER[$cacheKey] = $cachePath;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../bootstrap/app.php';

/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);
$request = Request::capture();
$response = $kernel->handle($request);

// Some shared-hosting proxy layers turn a 3xx response into 200 and expose
// Symfony's plain "Redirecting to ..." response body. Send the redirect
// header explicitly and keep an HTML redirect as a proxy-safe fallback.
if ($response->isRedirection() && $response->headers->has('Location')) {
    $redirectUrl = $response->headers->get('Location');

    if (is_string($redirectUrl) && $redirectUrl !== '') {
        header('Location: '.$redirectUrl, true, $response->getStatusCode());

        $escapedUrl = htmlspecialchars($redirectUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $javascriptUrl = json_encode(
            $redirectUrl,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        );

        $response->setContent(
            '<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8">'
            .'<meta http-equiv="refresh" content="0;url='.$escapedUrl.'">'
            .'<title>در حال انتقال...</title></head><body>'
            .'<script>window.location.replace('.$javascriptUrl.');</script>'
            .'<a href="'.$escapedUrl.'">ادامه</a></body></html>'
        );
    }
}

try {
    if ($request->hasSession() && ! headers_sent()) {
        $sessionId = rawurlencode($request->session()->getId());
        $maxAge = (int) config('session.lifetime', 120) * 60;
        $expires = gmdate('D, d M Y H:i:s T', time() + $maxAge);

        header(
            'Set-Cookie: melkalijenab_session='.$sessionId
            .'; Expires='.$expires
            .'; Max-Age='.$maxAge
            .'; Path=/; HttpOnly; SameSite=Lax',
            false
        );
    }
} catch (Throwable $exception) {
    error_log('Unable to attach Laravel session cookie: '.$exception->getMessage());
}

$response->send();
$kernel->terminate($request, $response);
