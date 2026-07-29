<?php
/**
 * WordPress Production Configuration — SearchEngineOptimization.ae
 * ─────────────────────────────────────────────────────────────────
 * USE THIS FILE ON cPanel/Linux Shared Hosting.
 * Rename this to wp-config.php when deploying to production server.
 *
 * Steps:
 * 1. Create a MySQL database + user in cPanel → MySQL Databases
 * 2. Fill in DB_NAME, DB_USER, DB_PASSWORD below
 * 3. Replace the salts (get fresh ones from https://api.wordpress.org/secret-key/1.1/salt/)
 * 4. Rename this file to wp-config.php
 * 5. DELETE the wp-content/plugins/sqlite-database-integration/ folder
 * 6. DELETE the wp-content/database/ folder
 * 7. DELETE the wp-content/mu-plugins/db.php file (if present)
 * 8. Import the mysql-export.sql file via cPanel phpMyAdmin
 * ─────────────────────────────────────────────────────────────────
 */

// ── MySQL Database (fill these in from cPanel) ────────────────────
define( 'DB_NAME',     'cpanel_username_seoae' );   // Your DB name from cPanel
define( 'DB_USER',     'cpanel_username_seoae' );   // Your DB user from cPanel
define( 'DB_PASSWORD', 'YOUR_STRONG_DB_PASSWORD' ); // DB password
define( 'DB_HOST',     'localhost' );               // Usually localhost on cPanel
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  'utf8mb4_unicode_ci' );

// ── Table Prefix ──────────────────────────────────────────────────
$table_prefix = 'wp_';

// ── Site URL — set to your actual domain ─────────────────────────
define( 'WP_HOME',    'https://searchengineoptimization.ae' );
define( 'WP_SITEURL', 'https://searchengineoptimization.ae' );

// ── Security Keys & Salts ─────────────────────────────────────────
// Generate fresh salts at: https://api.wordpress.org/secret-key/1.1/salt/
define( 'AUTH_KEY',         'REPLACE_WITH_FRESH_SALT_1' );
define( 'SECURE_AUTH_KEY',  'REPLACE_WITH_FRESH_SALT_2' );
define( 'LOGGED_IN_KEY',    'REPLACE_WITH_FRESH_SALT_3' );
define( 'NONCE_KEY',        'REPLACE_WITH_FRESH_SALT_4' );
define( 'AUTH_SALT',        'REPLACE_WITH_FRESH_SALT_5' );
define( 'SECURE_AUTH_SALT', 'REPLACE_WITH_FRESH_SALT_6' );
define( 'LOGGED_IN_SALT',   'REPLACE_WITH_FRESH_SALT_7' );
define( 'NONCE_SALT',       'REPLACE_WITH_FRESH_SALT_8' );

// ── Production Settings ───────────────────────────────────────────
define( 'WP_DEBUG',         false );  // MUST be false in production
define( 'WP_DEBUG_LOG',     false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'SCRIPT_DEBUG',     false );
define( 'SAVEQUERIES',      false );

// ── Performance ───────────────────────────────────────────────────
define( 'WP_MEMORY_LIMIT',     '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'AUTOSAVE_INTERVAL',   300 );
define( 'WP_POST_REVISIONS',   5 );
define( 'EMPTY_TRASH_DAYS',    30 );

// ── Security Hardening ────────────────────────────────────────────
define( 'DISALLOW_FILE_EDIT', true );    // Disable theme/plugin editor in admin
define( 'DISALLOW_FILE_MODS', false );   // Keep true if you don't want plugin installs via admin
define( 'FORCE_SSL_ADMIN',    true );    // Force HTTPS for admin panel
define( 'WP_AUTO_UPDATE_CORE', 'minor' ); // Allow minor core auto-updates only

// ── Disable Unused Features ───────────────────────────────────────
define( 'CONCATENATE_SCRIPTS', false );  // Prevents 404 on admin if mod_rewrite issues
define( 'WP_CRON_LOCK_TIMEOUT', 60 );

// ── Absolute Path ─────────────────────────────────────────────────
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
