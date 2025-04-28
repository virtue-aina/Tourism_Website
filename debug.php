<?php
// Debug script to check file paths and server configuration
echo "<h1>Debug Information</h1>";

// Check if assets directory exists
$assetsDir = __DIR__ . '/assets';
echo "<p>Assets directory: " . $assetsDir . " - " . (file_exists($assetsDir) ? "Exists" : "Does not exist") . "</p>";

// Check if images directory exists
$imagesDir = __DIR__ . '/assets/images';
echo "<p>Images directory: " . $imagesDir . " - " . (file_exists($imagesDir) ? "Exists" : "Does not exist") . "</p>";

// Check if specific files exist
$cssFile = __DIR__ . '/assets/excursions.css';
echo "<p>CSS file: " . $cssFile . " - " . (file_exists($cssFile) ? "Exists" : "Does not exist") . "</p>";

$image1File = __DIR__ . '/assets/images/image1.jpg';
echo "<p>Image 1 file: " . $image1File . " - " . (file_exists($image1File) ? "Exists" : "Does not exist") . "</p>";

// Check server document root
echo "<p>Document root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

// Check script filename
echo "<p>Script filename: " . $_SERVER['SCRIPT_FILENAME'] . "</p>";

// Check PHP version
echo "<p>PHP version: " . phpversion() . "</p>";

// Check server software
echo "<p>Server software: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

// Check if we can access the assets directory
echo "<h2>Directory Contents</h2>";
echo "<h3>Root Directory:</h3>";
echo "<pre>";
print_r(scandir(__DIR__));
echo "</pre>";

echo "<h3>Assets Directory:</h3>";
if (file_exists($assetsDir)) {
    echo "<pre>";
    print_r(scandir($assetsDir));
    echo "</pre>";
} else {
    echo "<p>Assets directory does not exist.</p>";
}

echo "<h3>Images Directory:</h3>";
if (file_exists($imagesDir)) {
    echo "<pre>";
    print_r(scandir($imagesDir));
    echo "</pre>";
} else {
    echo "<p>Images directory does not exist.</p>";
}
?> 