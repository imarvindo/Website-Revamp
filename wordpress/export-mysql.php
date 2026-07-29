<?php
/**
 * MySQL Export Script — SearchEngineOptimization.ae
 * ─────────────────────────────────────────────────
 * Exports all WordPress data from SQLite to MySQL-compatible SQL.
 * Run ONCE in Replit, then import the output on cPanel via phpMyAdmin.
 *
 * Usage:
 *   php wp-cli.phar --path=wordpress eval-file wordpress/export-mysql.php 2>/dev/null
 *   php wp-cli.phar --path=wordpress eval-file wordpress/export-mysql.php 2>/dev/null > mysql-export.sql
 *
 * Then on cPanel:
 *   1. Create MySQL DB + user in cPanel
 *   2. Open phpMyAdmin → select the new database
 *   3. Import the mysql-export.sql file
 *   4. Update wp-config.php with MySQL credentials
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

global $wpdb;

$output = [];
$output[] = "-- SearchEngineOptimization.ae WordPress MySQL Export";
$output[] = "-- Generated: " . date( 'Y-m-d H:i:s' );
$output[] = "-- ============================================================";
$output[] = "";
$output[] = "SET FOREIGN_KEY_CHECKS=0;";
$output[] = "SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';";
$output[] = "SET NAMES utf8mb4;";
$output[] = "";

// Get all WordPress tables
$tables = $wpdb->get_results( "SHOW TABLES", ARRAY_N );

foreach ( $tables as $table_row ) {
    $table = $table_row[0];

    // Skip SQLite-specific tables
    if ( in_array( $table, [ 'sqlite_master', 'sqlite_sequence' ], true ) ) continue;

    // ── CREATE TABLE ──────────────────────────────────────────────
    $output[] = "-- Table: `{$table}`";
    $output[] = "DROP TABLE IF EXISTS `{$table}`;";

    // Get column info from SQLite
    $columns = $wpdb->get_results( "DESCRIBE `{$table}`", ARRAY_A );

    $col_defs   = [];
    $pk_col     = '';
    $ai_col     = '';

    // WordPress table schemas (MySQL-compatible)
    $wp_schemas = seoae_get_wp_table_schema( $table, $wpdb->prefix );

    if ( $wp_schemas ) {
        $output[] = $wp_schemas;
    } else {
        // Generic fallback: build CREATE TABLE from DESCRIBE
        foreach ( $columns as $col ) {
            $name     = $col['Field'];
            $type     = seoae_sqlite_to_mysql_type( $col['Type'] );
            $null     = ( $col['Null'] === 'YES' ) ? 'NULL' : 'NOT NULL';
            $default  = '';
            if ( $col['Default'] !== null ) {
                $dv = $col['Default'];
                $default = " DEFAULT '" . addslashes( $dv ) . "'";
            }
            $extra = ( $col['Extra'] === 'auto_increment' ) ? ' AUTO_INCREMENT' : '';
            $col_defs[] = "  `{$name}` {$type} {$null}{$default}{$extra}";
            if ( $col['Key'] === 'PRI' ) $pk_col = $name;
        }
        if ( $pk_col ) $col_defs[] = "  PRIMARY KEY (`{$pk_col}`)";
        $output[] = "CREATE TABLE `{$table}` (\n" . implode( ",\n", $col_defs ) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    }
    $output[] = "";

    // ── INSERT DATA ───────────────────────────────────────────────
    $rows = $wpdb->get_results( "SELECT * FROM `{$table}`", ARRAY_A );
    if ( empty( $rows ) ) {
        $output[] = "-- (no rows in {$table})";
        $output[] = "";
        continue;
    }

    $col_names = '`' . implode( '`, `', array_keys( $rows[0] ) ) . '`';
    $batch     = [];

    foreach ( $rows as $row ) {
        $vals = [];
        foreach ( $row as $val ) {
            if ( $val === null ) {
                $vals[] = 'NULL';
            } else {
                $vals[] = "'" . addslashes( $val ) . "'";
            }
        }
        $batch[] = '(' . implode( ', ', $vals ) . ')';

        // Write in batches of 50 rows
        if ( count( $batch ) >= 50 ) {
            $output[] = "INSERT INTO `{$table}` ({$col_names}) VALUES";
            $output[] = implode( ",\n", $batch ) . ";";
            $output[] = "";
            $batch    = [];
        }
    }
    if ( $batch ) {
        $output[] = "INSERT INTO `{$table}` ({$col_names}) VALUES";
        $output[] = implode( ",\n", $batch ) . ";";
        $output[] = "";
    }
}

$output[] = "";
$output[] = "SET FOREIGN_KEY_CHECKS=1;";
$output[] = "-- Export complete.";

// Write to file
$sql_content = implode( "\n", $output );
$out_path    = ABSPATH . '../mysql-export.sql';
file_put_contents( $out_path, $sql_content );

echo "✅ MySQL export written to: " . realpath( $out_path ) . "\n";
echo "   Size: " . number_format( filesize( $out_path ) ) . " bytes\n";
echo "   Tables: " . count( $tables ) . "\n";

// ── Helper: SQLite type → MySQL type ──────────────────────────────
function seoae_sqlite_to_mysql_type( $sqlite_type ) {
    $t = strtolower( trim( $sqlite_type ) );
    if ( str_contains( $t, 'bigint' ) )         return 'BIGINT(20)';
    if ( str_contains( $t, 'int' ) )             return 'BIGINT(20)';
    if ( str_contains( $t, 'tinyint' ) )         return 'TINYINT(1)';
    if ( str_contains( $t, 'float' ) )           return 'FLOAT';
    if ( str_contains( $t, 'double' ) )          return 'DOUBLE';
    if ( str_contains( $t, 'datetime' ) )        return 'DATETIME';
    if ( str_contains( $t, 'date' ) )            return 'DATE';
    if ( str_contains( $t, 'text' ) )            return 'LONGTEXT';
    if ( str_contains( $t, 'blob' ) )            return 'LONGBLOB';
    if ( str_contains( $t, 'varchar' ) )         return $sqlite_type;
    if ( str_contains( $t, 'char' ) )            return 'VARCHAR(255)';
    return 'LONGTEXT'; // safe default
}

// ── Helper: Known WP table schemas for MySQL ─────────────────────
function seoae_get_wp_table_schema( $table, $prefix ) {
    $schemas = [
        $prefix . 'posts' => "CREATE TABLE `{$table}` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'postmeta' => "CREATE TABLE `{$table}` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'options' => "CREATE TABLE `{$table}` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'users' => "CREATE TABLE `{$table}` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'usermeta' => "CREATE TABLE `{$table}` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'terms' => "CREATE TABLE `{$table}` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'term_taxonomy' => "CREATE TABLE `{$table}` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'term_relationships' => "CREATE TABLE `{$table}` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'comments' => "CREATE TABLE `{$table}` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'commentmeta' => "CREATE TABLE `{$table}` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

        $prefix . 'links' => "CREATE TABLE `{$table}` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",
    ];
    return $schemas[ $table ] ?? null;
}
