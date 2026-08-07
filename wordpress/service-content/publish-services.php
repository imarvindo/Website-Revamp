<?php
/**
 * Publish premium service page content packs to WordPress.
 *
 * Usage (on server or local):
 *   php publish-services.php
 * Or via wp-load:
 *   php -d display_errors=1 publish-services.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	$root = dirname( __DIR__ );
	require_once $root . '/wp-load.php';
}

$packs = [
	__DIR__ . '/web-design.php',
	__DIR__ . '/web-development.php',
	__DIR__ . '/search-engine-optimization.php',
	__DIR__ . '/ai-search-optimization.php',
	__DIR__ . '/ppc-management.php',
	__DIR__ . '/social-media-marketing.php',
];

function seoae_publish_service_pack( array $pack ) {
	$post_id = (int) $pack['post_id'];
	$post    = get_post( $post_id );
	if ( ! $post || $post->post_type !== 'service' ) {
		throw new RuntimeException( "Invalid service post ID {$post_id}" );
	}

	$updated = wp_update_post(
		[
			'ID'           => $post_id,
			'post_title'   => $pack['post_title'],
			'post_content' => $pack['content'],
			'post_excerpt' => $pack['excerpt'],
			'post_status'  => 'publish',
		],
		true
	);
	if ( is_wp_error( $updated ) ) {
		throw new RuntimeException( $updated->get_error_message() );
	}

	// Scalar meta (ACF + parent template).
	$scalars = [
		'short_description' => $pack['short_description'],
		'category_label'    => $pack['category_label'],
		'hero_badge'        => $pack['hero_badge'],
		'hero_badge_sub'    => $pack['hero_badge_sub'],
		'cta_primary_text'  => $pack['cta_primary_text'],
		'cta_phone_text'    => $pack['cta_phone_text'],
	];
	foreach ( $scalars as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	$benefits = array_values( $pack['benefits'] );
	$process  = array_values( $pack['process'] );
	$techs    = array_values( $pack['technologies'] );
	$faqs     = array_values( $pack['faqs'] );
	$related  = array_map( 'intval', $pack['related'] );

	// Parent template keys.
	update_post_meta( $post_id, 'svc_benefits', $benefits );
	update_post_meta( $post_id, 'svc_process', $process );
	update_post_meta( $post_id, 'svc_technologies', $techs );
	update_post_meta( $post_id, 'svc_faqs', $faqs );
	update_post_meta( $post_id, 'svc_related', $related );

	// JSON mirrors used by some seed tooling.
	update_post_meta( $post_id, 'svc_benefits_json', wp_json_encode( $benefits ) );
	update_post_meta( $post_id, 'svc_process_json', wp_json_encode( $process ) );
	update_post_meta( $post_id, 'svc_technologies_json', wp_json_encode( $techs ) );
	update_post_meta( $post_id, 'svc_faqs_json', wp_json_encode( $faqs ) );
	update_post_meta( $post_id, 'svc_related_json', wp_json_encode( $related ) );

	// ACF repeater-style storage for admin editing compatibility.
	update_post_meta( $post_id, 'benefits', count( $benefits ) );
	foreach ( $benefits as $i => $row ) {
		update_post_meta( $post_id, "benefits_{$i}_benefit", $row['benefit'] );
		update_post_meta( $post_id, "_benefits_{$i}_benefit", 'field_svc_benefit_item' );
	}
	update_post_meta( $post_id, '_benefits', 'field_svc_benefits' );

	update_post_meta( $post_id, 'process_steps', count( $process ) );
	foreach ( $process as $i => $row ) {
		update_post_meta( $post_id, "process_steps_{$i}_step_title", $row['step_title'] );
		update_post_meta( $post_id, "process_steps_{$i}_step_desc", $row['step_desc'] );
		update_post_meta( $post_id, "_process_steps_{$i}_step_title", 'field_proc_title' );
		update_post_meta( $post_id, "_process_steps_{$i}_step_desc", 'field_proc_desc' );
	}
	update_post_meta( $post_id, '_process_steps', 'field_svc_process' );

	update_post_meta( $post_id, 'technologies', count( $techs ) );
	foreach ( $techs as $i => $row ) {
		update_post_meta( $post_id, "technologies_{$i}_tech_name", $row['tech_name'] );
		update_post_meta( $post_id, "_technologies_{$i}_tech_name", 'field_tech_name' );
	}
	update_post_meta( $post_id, '_technologies', 'field_svc_technologies' );

	update_post_meta( $post_id, 'service_faqs', count( $faqs ) );
	foreach ( $faqs as $i => $row ) {
		update_post_meta( $post_id, "service_faqs_{$i}_question", $row['question'] );
		update_post_meta( $post_id, "service_faqs_{$i}_answer", $row['answer'] );
		update_post_meta( $post_id, "_service_faqs_{$i}_question", 'field_faq_q' );
		update_post_meta( $post_id, "_service_faqs_{$i}_answer", 'field_faq_a' );
	}
	update_post_meta( $post_id, '_service_faqs', 'field_svc_faqs' );
	update_post_meta( $post_id, 'service_faq', $faqs );
	update_post_meta( $post_id, 'related_services', $related );
	update_post_meta( $post_id, '_related_services', 'field_svc_related' );
	update_post_meta( $post_id, '_short_description', 'field_svc_short_desc' );
	update_post_meta( $post_id, '_category_label', 'field_svc_category' );
	update_post_meta( $post_id, '_hero_badge', 'field_svc_hero_badge' );
	update_post_meta( $post_id, '_hero_badge_sub', 'field_svc_hero_subtext' );
	update_post_meta( $post_id, '_cta_primary_text', 'field_svc_cta_primary' );
	update_post_meta( $post_id, '_cta_phone_text', 'field_svc_cta_phone' );

	// Yoast.
	update_post_meta( $post_id, '_yoast_wpseo_title', $pack['seo_title'] );
	update_post_meta( $post_id, '_yoast_wpseo_metadesc', $pack['meta_description'] );
	update_post_meta( $post_id, '_yoast_wpseo_focuskw', $pack['focus_keyword'] );

	// Clear Elementor leftovers if any.
	delete_post_meta( $post_id, '_elementor_edit_mode' );
	delete_post_meta( $post_id, '_elementor_data' );
	delete_post_meta( $post_id, '_elementor_css' );

	clean_post_cache( $post_id );

	$words = str_word_count( wp_strip_all_tags( $pack['content'] ) );
	return [
		'id'     => $post_id,
		'slug'   => $post->post_name,
		'title'  => $pack['post_title'],
		'words'  => $words,
		'faqs'   => count( $faqs ),
		'permalink' => get_permalink( $post_id ),
	];
}

$results = [];
foreach ( $packs as $file ) {
	if ( ! file_exists( $file ) ) {
		fwrite( STDERR, "Missing pack: {$file}\n" );
		exit( 1 );
	}
	$pack = include $file;
	if ( ! is_array( $pack ) ) {
		fwrite( STDERR, "Invalid pack: {$file}\n" );
		exit( 1 );
	}
	$result    = seoae_publish_service_pack( $pack );
	$results[] = $result;
	echo "Published #{$result['id']} {$result['slug']} words={$result['words']} faqs={$result['faqs']}\n";
	echo "  {$result['permalink']}\n";
}

if ( function_exists( 'flush_rewrite_rules' ) ) {
	flush_rewrite_rules( false );
}

echo "DONE " . count( $results ) . " services\n";
