<?php
// Simple router for PHP built-in server

// Get the requested URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove leading slash
$uri = ltrim($uri, '/');

// If the URI is empty, redirect to index.php
if (empty($uri)) {
    include __DIR__ . '/index.php';
    exit;
}

// If the URI starts with 'assets/', serve the file directly
if (strpos($uri, 'assets/') === 0) {
    $file = __DIR__ . '/' . $uri;
    if (file_exists($file)) {
        // Set the appropriate content type
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        switch ($extension) {
            case 'css':
                header('Content-Type: text/css');
                break;
            case 'js':
                header('Content-Type: application/javascript');
                break;
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            case 'gif':
                header('Content-Type: image/gif');
                break;
            case 'pdf':
                header('Content-Type: application/pdf');
                break;
            default:
                // For unknown file types, let the browser figure it out
                break;
        }
        readfile($file);
        exit;
    }
}

// If the URI starts with 'content/', include the file
if (strpos($uri, 'content/') === 0) {
    $file = __DIR__ . '/' . $uri;
    if (file_exists($file)) {
        include $file;
        exit;
    }
}

// If the file exists, include it
$file = __DIR__ . '/' . $uri;
if (file_exists($file)) {
    include $file;
    exit;
}

// If we get here, the file doesn't exist
header('HTTP/1.0 404 Not Found');
echo '404 Not Found';
?> 