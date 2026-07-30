<?php
/**
 * ============================================================
 *  wp-config.php — PRODUCTION (Shared Hosting / cPanel)
 *  SearchEngineOptimization.ae
 *
 *  BEFORE UPLOADING:
 *  1. Replace every value marked ← CHANGE THIS
 *  2. Rename this file to wp-config.php
 *  3. Delete wp-config-production.php from the server
 * ============================================================
 */

// ── Database ─────────────────────────────────────────────────
define( 'DB_NAME',     'YOUR_DB_NAME' );      // ← CHANGE THIS (cPanel DB name)
define( 'DB_USER',     'YOUR_DB_USER' );      // ← CHANGE THIS (cPanel DB user)
define( 'DB_PASSWORD', 'YOUR_DB_PASSWORD' );  // ← CHANGE THIS
define( 'DB_HOST',     'localhost' );         // usually localhost on shared hosting
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  '' );

// ── Authentication Keys & Salts ──────────────────────────────
// Get fresh keys from: https://api.wordpress.org/secret-key/1.1/salt/
define( 'AUTH_KEY',         'REPLACE_WITH_FRESH_KEY_1' );  // ← CHANGE THIS
define( 'SECURE_AUTH_KEY',  'REPLACE_WITH_FRESH_KEY_2' );  // ← CHANGE THIS
define( 'LOGGED_IN_KEY',    'REPLACE_WITH_FRESH_KEY_3' );  // ← CHANGE THIS
define( 'NONCE_KEY',        'REPLACE_WITH_FRESH_KEY_4' );  // ← CHANGE THIS
define( 'AUTH_SALT',        'REPLACE_WITH_FRESH_KEY_5' );  // ← CHANGE THIS
define( 'SECURE_AUTH_SALT', 'REPLACE_WITH_FRESH_KEY_6' );  // ← CHANGE THIS
define( 'LOGGED_IN_SALT',   'REPLACE_WITH_FRESH_KEY_7' );  // ← CHANGE THIS
define( 'NONCE_SALT',       'REPLACE_WITH_FRESH_KEY_8' );  // ← CHANGE THIS

// ── Table Prefix ─────────────────────────────────────────────
$table_prefix = 'wp_';

// ── URLs (WordPress will read from DB after import) ──────────
// Leave commented — WordPress reads siteurl/home from the database
// after you run the search-replace step.
// define( 'WP_HOME',    'https://yourdomain.com' );
// define( 'WP_SITEURL', 'https://yourdomain.com' );

// ── Performance ───────────────────────────────────────────────
define( 'WP_MEMORY_LIMIT',     '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'AUTOSAVE_INTERVAL',   300 );
define( 'WP_POST_REVISIONS',   5 );
define( 'DISABLE_WP_CRON',     false ); // re-enable real cron on production

// ── Security ──────────────────────────────────────────────────
define( 'DISALLOW_FILE_EDIT',  true );  // disable theme/plugin editor in WP admin
define( 'WP_DEBUG',            false );
define( 'WP_DEBUG_LOG',        false );
define( 'WP_DEBUG_DISPLAY',    false );

// ── Absolute path ─────────────────────────────────────────────
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
