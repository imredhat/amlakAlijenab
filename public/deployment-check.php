<?php

declare(strict_types=1);

if (($_GET['key'] ?? '') !== 'melk-deploy-820') {
    http_response_code(404);
    exit('Not Found');
}

header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$indexPath = __DIR__.'/index.php';
$bootstrapPath = dirname(__DIR__).'/bootstrap/app.php';
$indexContents = is_readable($indexPath) ? file_get_contents($indexPath) : false;
$bootstrapContents = is_readable($bootstrapPath) ? file_get_contents($bootstrapPath) : false;

if (($_GET['view'] ?? '') === 'log') {
    $logFiles = glob(dirname(__DIR__).'/storage/logs/*.log') ?: [];
    usort($logFiles, static fn (string $a, string $b): int => filemtime($b) <=> filemtime($a));
    $logFile = $logFiles[0] ?? null;

    if ($logFile === null || ! is_readable($logFile)) {
        exit('NO_READABLE_LARAVEL_LOG');
    }

    $size = filesize($logFile) ?: 0;
    $handle = fopen($logFile, 'rb');
    if ($handle === false) {
        exit('CANNOT_OPEN_LARAVEL_LOG');
    }

    $bytes = min($size, 60000);
    if ($bytes > 0) {
        fseek($handle, -$bytes, SEEK_END);
    }
    $tail = stream_get_contents($handle) ?: '';
    fclose($handle);

    $lastError = strrpos($tail, '.ERROR:');
    if ($lastError !== false) {
        $lineStart = strrpos(substr($tail, 0, $lastError), "\n");
        $tail = substr($tail, $lineStart === false ? 0 : $lineStart + 1);
    }

    $tail = preg_replace('/(password|passwd|secret|token|api[_-]?key)(["\'\s:=]+)[^\s,"\']+/i', '$1$2[REDACTED]', $tail) ?? $tail;

    echo 'LOG_FILE='.basename($logFile).PHP_EOL;
    echo '--- LAST ERROR ---'.PHP_EOL;
    echo substr($tail, 0, 25000);
    exit;
}

echo 'DOCUMENT_ROOT='.($_SERVER['DOCUMENT_ROOT'] ?? 'unknown').PHP_EOL;
echo 'SCRIPT_DIR='.__DIR__.PHP_EOL;
echo 'INDEX_PATH='.$indexPath.PHP_EOL;
echo 'INDEX_EXISTS='.(is_file($indexPath) ? 'YES' : 'NO').PHP_EOL;
echo 'INDEX_DIRECT_V3='.(is_string($indexContents) && str_contains($indexContents, 'direct-v3') ? 'YES' : 'NO').PHP_EOL;
echo 'INDEX_SHA256='.(is_file($indexPath) ? hash_file('sha256', $indexPath) : 'NONE').PHP_EOL;
echo 'INDEX_MODIFIED='.(is_file($indexPath) ? gmdate('c', filemtime($indexPath)) : 'NONE').PHP_EOL;
echo 'BOOTSTRAP_PATH='.$bootstrapPath.PHP_EOL;
echo 'BOOTSTRAP_SESSION_EXCEPT='.(is_string($bootstrapContents) && str_contains($bootstrapContents, 'melkalijenab_session') ? 'YES' : 'NO').PHP_EOL;
echo 'BOOTSTRAP_SHA256='.(is_file($bootstrapPath) ? hash_file('sha256', $bootstrapPath) : 'NONE').PHP_EOL;
