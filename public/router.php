<?php

/**
 * Laravel router for PHP's built-in development server.
 * This ensures all requests are handled by Laravel's front controller.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve existing static files directly (css, js, images, etc.)
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Route everything else through Laravel's index.php
require_once __DIR__ . '/index.php';
