<?php

declare(strict_types=1);

if (($_GET['key'] ?? '') !== 'melk-cookie-820') {
    http_response_code(404);
    exit('Not Found');
}

header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

header(
    'Set-Cookie: melk_header_probe=works; Max-Age=3600; Path=/; HttpOnly; SameSite=Lax',
    false
);

$setCookieAvailable = function_exists('setcookie');
if ($setCookieAvailable) {
    setcookie('melk_php_probe', 'works-'.time(), [
        'expires' => time() + 3600,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

echo "COOKIE_PROBE_SENT\n";
echo 'SETCOOKIE_FUNCTION='.($setCookieAvailable ? 'YES' : 'NO')."\n";
echo 'HOST='.($_SERVER['HTTP_HOST'] ?? 'unknown')."\n";
echo 'HTTPS='.($_SERVER['HTTPS'] ?? 'off')."\n";
