<?php

// Loading the map of short -> full URLs from /redirects.php
$routes = include('../redirects.php');

// Grab the requested "path" (strip leading/trailing slashes) and normalize to lowercase
$path = strtolower(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/'));

// Figure out the target URL based on the requested path.
// Exact matches are preferred, but if not found, we fall back to the "root" URL.
$defaultTarget = $routes[''] ?? null;
$target = $routes[$path] ?? $defaultTarget;

// Throw a 500 error if no target is found.
if (!$target) {
    http_response_code(500);
    echo '<h1>Configuration error</h1>';
    exit;
}

// Build the redirect URL (add utm_source, respecting any existing ?foo=bar)
$separator = parse_url($target, PHP_URL_QUERY) ? '&' : '?';
$redirectUrl = $target . $separator . 'utm_source=vatsca.org';

// Redirect
header('Location: ' . $redirectUrl, true, 302);
exit;
