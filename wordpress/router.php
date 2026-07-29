<?php
/**
 * PHP built-in server router for WordPress — SearchEngineOptimization.ae
 * Adds security headers, cache control, and gzip compression.
 */

$uri = urldecode( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );

// ── Serve real static files directly (CSS, JS, images, fonts, etc.) ─────────
if ( $uri !== '/' && file_exists( __DIR__ . $uri ) ) {
	// Add long-lived cache headers for static assets
	$ext = pathinfo( $uri, PATHINFO_EXTENSION );
	$static_types = ['css','js','woff','woff2','ttf','eot','otf','svg','png','jpg','jpeg','gif','webp','avif','ico'];
	if ( in_array( strtolower($ext), $static_types, true ) ) {
		$ttl = 31536000; // 1 year
		header( 'Cache-Control: public, max-age=' . $ttl . ', immutable' );
		header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + $ttl ) . ' GMT' );
		header( 'Vary: Accept-Encoding' );
	}
	return false;
}

// ── Security headers ─────────────────────────────────────────────────────────
header( 'X-Content-Type-Options: nosniff' );
// X-Frame-Options intentionally omitted on dev server — Replit preview needs iframe access.
// On production Apache, .htaccess adds: Header always set X-Frame-Options "SAMEORIGIN"
header( 'X-XSS-Protection: 1; mode=block' );
header( 'Referrer-Policy: strict-origin-when-cross-origin' );
header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(self), payment=()' );

// Light Content-Security-Policy — allows Google Fonts, Analytics, Maps etc.
header( "Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com https://www.googleadservices.com https://maps.googleapis.com https://connect.facebook.net; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https: blob:; frame-src https://www.google.com https://www.youtube.com; connect-src 'self' https://www.google-analytics.com; base-uri 'self'; form-action 'self';" );

// ── HTML cache — short TTL, must-revalidate ──────────────────────────────────
header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
header( 'Vary: Accept-Encoding' );

// ── GZIP compression for HTML output ─────────────────────────────────────────
if ( isset( $_SERVER['HTTP_ACCEPT_ENCODING'] ) &&
     strpos( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) !== false &&
     extension_loaded( 'zlib' ) ) {
	ini_set( 'zlib.output_compression', 'On' );
	ini_set( 'zlib.output_compression_level', '5' );
}

// ── Pass all other requests → WordPress ─────────────────────────────────────
chdir( __DIR__ );
include __DIR__ . '/index.php';
