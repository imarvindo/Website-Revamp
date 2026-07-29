<?php
/**
 * PHP built-in server router for WordPress development on Replit.
 * Usage: php -S 0.0.0.0:$PORT -t /path/to/wordpress /path/to/router.php
 */

$uri = urldecode( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );

// Serve real static files (CSS, JS, images, fonts, etc.) directly
if ( $uri !== '/' && file_exists( __DIR__ . $uri ) ) {
	return false;
}

// All other requests → WordPress
chdir( __DIR__ );
include __DIR__ . '/index.php';
