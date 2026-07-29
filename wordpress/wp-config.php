<?php
/**
 * WordPress Configuration — SEO.ae Enterprise Site
 * SQLite for dev on Replit → MySQL for production server
 */

// ── Dynamic URL (works on Replit dev + any production host) ──────────────────
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	$_site_url = getenv( 'WP_HOME' ) ?: 'http://localhost:' . ( getenv( 'PORT' ) ?: '8000' );
} else {
	$_proto     = ( ! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' )
	              || ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' )
	              ? 'https' : 'http';
	$_host      = $_SERVER['HTTP_HOST'] ?? 'localhost';
	$_site_url  = $_proto . '://' . $_host;
}
define( 'WP_HOME',    $_site_url );
define( 'WP_SITEURL', $_site_url );

// ── SQLite Database Integration ──────────────────────────────────────────────
define( 'DB_DIR',  __DIR__ . '/wp-content/database/' );
define( 'DB_FILE', 'wordpress.db' );

// MySQL credentials (used on production; ignored by SQLite plugin in dev)
define( 'DB_NAME',     'seo_ae_wp' );
define( 'DB_USER',     'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST',     'localhost' );
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  '' );

// ── Authentication Keys & Salts ──────────────────────────────────────────────
define( 'AUTH_KEY',         'seoae-auth-k3y-r3p1it-d3v-2026-7x9' );
define( 'SECURE_AUTH_KEY',  'seoae-s3cur3-auth-k3y-r3p1it-dev-2026' );
define( 'LOGGED_IN_KEY',    'seoae-l0gg3d-in-k3y-r3p1it-2026-xyz' );
define( 'NONCE_KEY',        'seoae-n0nc3-k3y-r3p1it-d3v-2026-abc' );
define( 'AUTH_SALT',        'seoae-auth-s4lt-r3p1it-d3v-2026-qrs' );
define( 'SECURE_AUTH_SALT', 'seoae-s3cur3-auth-s4lt-r3p1it-2026' );
define( 'LOGGED_IN_SALT',   'seoae-l0gg3d-in-s4lt-r3p1it-2026-lmn' );
define( 'NONCE_SALT',       'seoae-n0nc3-s4lt-r3p1it-d3v-2026-opq' );

// ── Table Prefix ─────────────────────────────────────────────────────────────
$table_prefix = 'wp_';

// ── Development Settings ─────────────────────────────────────────────────────
define( 'WP_DEBUG',         true );
define( 'WP_DEBUG_LOG',     true );
define( 'WP_DEBUG_DISPLAY', false );
// Disable WP-Cron on dev (SQLite can't handle WPForms' Action Scheduler JOIN queries)
// On production (MySQL), remove this line to re-enable cron
define( 'DISABLE_WP_CRON', true );
define( 'SCRIPT_DEBUG',     false );
define( 'SAVEQUERIES',      false );

// ── Performance ───────────────────────────────────────────────────────────────
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );

// ── Absolute Path ─────────────────────────────────────────────────────────────
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
