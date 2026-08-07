<?php
/**
 * Private production export — CLI only.
 * Cron/manual: php wp-content/private-exports/export-prod.php
 */
if ( PHP_SAPI !== 'cli' ) {
	http_response_code( 403 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	echo "Forbidden\n";
	exit;
}

$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_HOST'] ?? 'searchengineoptimization.ae';
$_SERVER['REQUEST_URI'] = $_SERVER['REQUEST_URI'] ?? '/';
if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', dirname( __DIR__ ) );
}
require dirname( __DIR__, 2 ) . '/wp-load.php';
global $wpdb;
$path = __DIR__ . '/mysql-export-latest.sql';
$fh = fopen( $path, 'w' );
fwrite( $fh, "-- SearchEngineOptimization.ae production MySQL export\n" );
fwrite( $fh, '-- Generated: ' . gmdate( 'Y-m-d H:i:s' ) . " UTC\n\n" );
fwrite( $fh, "SET FOREIGN_KEY_CHECKS=0;\nSET NAMES utf8mb4;\n\n" );
foreach ( $wpdb->get_col( 'SHOW TABLES' ) as $table ) {
	$create = $wpdb->get_row( "SHOW CREATE TABLE `{$table}`", ARRAY_N );
	if ( ! $create ) {
		continue;
	}
	fwrite( $fh, "DROP TABLE IF EXISTS `{$table}`;\n" . $create[1] . ";\n\n" );
	$offset = 0;
	$batch  = 200;
	while ( true ) {
		$rows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `{$table}` LIMIT %d OFFSET %d", $batch, $offset ), ARRAY_A );
		if ( ! $rows ) {
			break;
		}
		$cols     = array_keys( $rows[0] );
		$col_list = '`' . implode( '`,`', $cols ) . '`';
		$values   = [];
		foreach ( $rows as $row ) {
			$vals = [];
			foreach ( $cols as $c ) {
				$v      = $row[ $c ];
				$vals[] = ( $v === null ) ? 'NULL' : ( "'" . $wpdb->_real_escape( (string) $v ) . "'" );
			}
			$values[] = '(' . implode( ',', $vals ) . ')';
		}
		fwrite( $fh, "INSERT INTO `{$table}` ({$col_list}) VALUES\n" . implode( ",\n", $values ) . ";\n" );
		$offset += $batch;
		if ( count( $rows ) < $batch ) {
			break;
		}
	}
	fwrite( $fh, "\n" );
}
fwrite( $fh, "SET FOREIGN_KEY_CHECKS=1;\n" );
fclose( $fh );
echo 'WROTE ' . $path . ' bytes=' . filesize( $path ) . "\n";
