<?php

declare(strict_types=1);

header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: no-store, private');

if (($_GET['key'] ?? '') !== 'melk-check-820') {
    http_response_code(404);
    exit('Not Found');
}

$root = dirname(__DIR__);

if (($_GET['view'] ?? '') === 'log') {
    $logFiles = glob($root.'/storage/logs/*.log') ?: [];
    usort(
        $logFiles,
        static fn (string $a, string $b): int => filemtime($b) <=> filemtime($a)
    );

    $logFile = $logFiles[0] ?? null;

    if ($logFile === null || !is_readable($logFile)) {
        exit('NO_READABLE_LARAVEL_LOG');
    }

    $size = filesize($logFile) ?: 0;
    $handle = fopen($logFile, 'rb');

    if ($handle === false) {
        exit('CANNOT_OPEN_LARAVEL_LOG');
    }

    $bytes = min($size, 50000);
    fseek($handle, -$bytes, SEEK_END);
    $tail = stream_get_contents($handle) ?: '';
    fclose($handle);

    preg_match_all(
        '/^\[[^\r\n]+\]\s+[^.\r\n]+\.ERROR:/m',
        $tail,
        $errorMarkers,
        PREG_OFFSET_CAPTURE
    );

    $selectedOffset = null;
    $markers = $errorMarkers[0] ?? [];
    for ($index = count($markers) - 1; $index >= 0; $index--) {
        $candidateOffset = $markers[$index][1];
        $candidateEnd = $markers[$index + 1][1] ?? strlen($tail);
        $candidate = substr($tail, $candidateOffset, $candidateEnd - $candidateOffset);

        if (!str_contains($candidate, 'highlight_file()')) {
            $selectedOffset = $candidateOffset;
            break;
        }
    }

    if ($selectedOffset !== null) {
        $tail = substr($tail, $selectedOffset);
    }

    // Avoid exposing accidental credentials embedded in exception context.
    $tail = preg_replace('/(password|passwd|secret|token|api[_-]?key)(["\'\s:=]+)[^\s,"\']+/i', '$1$2[REDACTED]', $tail) ?? $tail;

    echo 'LOG_FILE='.basename($logFile).PHP_EOL;
    echo '--- LAST ERROR ---'.PHP_EOL;
    echo substr($tail, 0, 20000);
    exit;
}

$requiredExtensions = ['ctype', 'fileinfo', 'mbstring', 'openssl', 'pdo', 'tokenizer'];
$missingExtensions = array_values(array_filter(
    $requiredExtensions,
    static fn (string $extension): bool => !extension_loaded($extension)
));

echo "PHP=".PHP_VERSION.PHP_EOL;
echo 'PHP_8_2_OR_NEWER='.(version_compare(PHP_VERSION, '8.2.0', '>=') ? 'YES' : 'NO').PHP_EOL;
echo 'ENV_FILE='.(is_file($root.'/.env') ? 'YES' : 'NO').PHP_EOL;
echo 'VENDOR_AUTOLOAD='.(is_file($root.'/vendor/autoload.php') ? 'YES' : 'NO').PHP_EOL;
echo 'STORAGE_WRITABLE='.(is_writable($root.'/storage') ? 'YES' : 'NO').PHP_EOL;
echo 'BOOTSTRAP_CACHE_WRITABLE='.(is_writable($root.'/bootstrap/cache') ? 'YES' : 'NO').PHP_EOL;
echo 'MISSING_EXTENSIONS='.($missingExtensions === [] ? 'NONE' : implode(',', $missingExtensions)).PHP_EOL;
