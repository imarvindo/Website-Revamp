<?php
/**
 * Create/update all 12 Dubai district child pages.
 *
 * Web-SAPI safe for Hostinger H5G: forces public_html wp-content before wp-load.
 * Visit: https://searchengineoptimization.ae/publish-districts.php
 */
header( 'Content-Type: text/plain; charset=utf-8' );

// Hostinger CLI/web mismatch: ensure public_html wp-content is used.
if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', __DIR__ . '/wp-content' );
}
if ( ! defined( 'WP_CONTENT_URL' ) ) {
	define( 'WP_CONTENT_URL', 'https://searchengineoptimization.ae/wp-content' );
}

require __DIR__ . '/wp-load.php';

echo 'WP_CONTENT_DIR=' . WP_CONTENT_DIR . "\n";
echo 'stylesheet=' . get_option( 'stylesheet' ) . "\n";

$districts = [
	'marina'         => 'Dubai Marina',
	'business-bay'   => 'Business Bay',
	'downtown'       => 'Downtown Dubai',
	'deira'          => 'Deira',
	'difc'           => 'DIFC',
	'jlt'            => 'JLT',
	'jumeirah'       => 'Jumeirah',
	'bur-dubai'      => 'Bur Dubai',
	'al-quoz'        => 'Al Quoz',
	'dubai-hills'    => 'Dubai Hills',
	'palm-jumeirah'  => 'Palm Jumeirah',
	'mirdif'         => 'Mirdif',
];

$metadesc = [
	'marina'         => 'Local SEO for Dubai Marina businesses. Rank higher in Marina searches with Google Business Profile optimisation, neighbourhood content, and citation building from SearchEngineOptimization.ae.',
	'business-bay'   => 'Local SEO for Business Bay companies. Capture high-intent B2B and professional services searches with district-focused SEO from SearchEngineOptimization.ae.',
	'downtown'       => 'Local SEO for Downtown Dubai businesses. Rank for Burj Khalifa and Dubai Mall area searches with specialist neighbourhood SEO from SearchEngineOptimization.ae.',
	'deira'          => 'Local SEO for Deira businesses. Grow wholesale, retail, and hospitality visibility with bilingual district SEO from SearchEngineOptimization.ae.',
	'difc'           => 'Local SEO for DIFC firms. Rank for financial, legal, and fintech searches in Dubai International Financial Centre with SearchEngineOptimization.ae.',
	'jlt'            => 'Local SEO for JLT businesses. Dominate Jumeirah Lake Towers cluster searches with hyper-local SEO from SearchEngineOptimization.ae.',
	'jumeirah'       => 'Local SEO for Jumeirah brands. Rank for coastal lifestyle, hospitality, and property searches with neighbourhood SEO from SearchEngineOptimization.ae.',
	'bur-dubai'      => 'Local SEO for Bur Dubai businesses. Capture Creek-side tourism and trade searches with district-focused SEO from SearchEngineOptimization.ae.',
	'al-quoz'        => 'Local SEO for Al Quoz businesses. Rank for industrial, logistics, and creative district searches with SearchEngineOptimization.ae.',
	'dubai-hills'    => 'Local SEO for Dubai Hills businesses. Win family-community and mall catchment searches with neighbourhood SEO from SearchEngineOptimization.ae.',
	'palm-jumeirah'  => 'Local SEO for Palm Jumeirah businesses. Rank for resort, beach club, and luxury island searches with SearchEngineOptimization.ae.',
	'mirdif'         => 'Local SEO for Mirdif businesses. Dominate family-suburb and near-me searches with community SEO from SearchEngineOptimization.ae.',
];

// Ensure parent "dubai" page exists (or find it).
$dubai = get_page_by_path( 'dubai' );
if ( ! $dubai ) {
	$found = get_posts(
		[
			'name'           => 'dubai',
			'post_type'      => 'page',
			'post_status'    => [ 'publish', 'draft', 'private' ],
			'posts_per_page' => 1,
		]
	);
	$dubai = $found ? $found[0] : null;
}

if ( ! $dubai ) {
	$dubai_id = wp_insert_post(
		[
			'post_title'   => 'SEO Agency Dubai',
			'post_name'    => 'dubai',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		],
		true
	);
	if ( is_wp_error( $dubai_id ) ) {
		echo 'ERROR creating dubai parent: ' . $dubai_id->get_error_message() . "\n";
		echo "DONE\n";
		exit;
	}
	echo "CREATED parent dubai id={$dubai_id}\n";
} else {
	$dubai_id = (int) $dubai->ID;
	echo "FOUND parent dubai id={$dubai_id}\n";
}

foreach ( $districts as $slug => $name ) {
	$title    = 'SEO Agency ' . $name . ' Dubai';
	$yoast_t  = 'SEO Agency ' . $name . ' Dubai | Local SEO Services';
	$yoast_d  = $metadesc[ $slug ];
	$existing = get_page_by_path( 'dubai/' . $slug );

	if ( ! $existing ) {
		$children = get_posts(
			[
				'name'           => $slug,
				'post_type'      => 'page',
				'post_parent'    => $dubai_id,
				'post_status'    => [ 'publish', 'draft', 'private' ],
				'posts_per_page' => 1,
			]
		);
		$existing = $children ? $children[0] : null;
	}

	$postarr = [
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_parent'  => $dubai_id,
		'post_content' => '',
	];

	if ( $existing ) {
		$postarr['ID'] = (int) $existing->ID;
		$result        = wp_update_post( $postarr, true );
		$action        = 'UPDATED';
	} else {
		$result = wp_insert_post( $postarr, true );
		$action = 'CREATED';
	}

	if ( is_wp_error( $result ) ) {
		echo "ERROR {$slug}: " . $result->get_error_message() . "\n";
		continue;
	}

	$page_id = (int) $result;
	update_post_meta( $page_id, '_wp_page_template', 'page-district.php' );
	update_post_meta( $page_id, '_yoast_wpseo_title', $yoast_t );
	update_post_meta( $page_id, '_yoast_wpseo_metadesc', $yoast_d );

	$permalink = get_permalink( $page_id );
	echo "{$action} {$slug} id={$page_id} template=page-district.php parent={$dubai_id} url={$permalink}\n";
}

flush_rewrite_rules( false );
echo "FLUSHED rewrite rules\n";
echo "DONE\n";
