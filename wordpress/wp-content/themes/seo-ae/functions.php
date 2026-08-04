<?php
/**
 * SearchEngineOptimization.ae Enterprise Theme — functions.php
 * Core setup, CPTs, ACF fields, menus, scripts
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SEOAE_VERSION', '1.0.4' );

// Prevent WordPress from converting hyphens into en/em dashes in public content.
add_filter( 'run_wptexturize', '__return_false' );
define( 'SEOAE_DIR', get_template_directory() );
define( 'SEOAE_URI', get_template_directory_uri() );

// ─────────────────────────────────────────────────────────────────────────────
// 1. THEME SETUP
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', ['search-form','comment-form','comment-list','gallery','caption','style','script'] );
	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	add_theme_support( 'custom-background' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	load_theme_textdomain( 'seo-ae', SEOAE_DIR . '/languages' );

	register_nav_menus( [
		'primary'      => __( 'Primary Navigation', 'seo-ae' ),
		'footer-col-1' => __( 'Footer: Services', 'seo-ae' ),
		'footer-col-2' => __( 'Footer: Company', 'seo-ae' ),
		'footer-col-3' => __( 'Footer: Resources', 'seo-ae' ),
	] );
} );

// ─────────────────────────────────────────────────────────────────────────────
// 1b. FAVICON (logo-concept-1.png as site icon)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	$logo_url = SEOAE_URI . '/assets/images/logo-concept-1.png';
	echo '<link rel="icon" type="image/png" href="' . esc_url( $logo_url ) . '">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $logo_url ) . '">' . "\n";
}, 1 );

// ─────────────────────────────────────────────────────────────────────────────
// 2. ENQUEUE ASSETS
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function () {
	// Google Fonts — Outfit
	wp_enqueue_style(
		'seo-ae-fonts',
		'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
		[],
		null
	);
	// Theme main stylesheet
	wp_enqueue_style(
		'seo-ae-main',
		SEOAE_URI . '/assets/css/main.css',
		['seo-ae-fonts'],
		SEOAE_VERSION
	);
	// Theme main JS
	wp_enqueue_script(
		'seo-ae-main',
		SEOAE_URI . '/assets/js/main.js',
		[],
		SEOAE_VERSION,
		true
	);
	// Pass AJAX url and nonce
	wp_localize_script( 'seo-ae-main', 'SEOAE', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'seoae-nonce' ),
	] );
} );

// ─────────────────────────────────────────────────────────────────────────────
// 3. CUSTOM POST TYPES
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'init', function () {

	// SERVICES
	register_post_type( 'service', [
		'labels' => [
			'name'               => __( 'Services', 'seo-ae' ),
			'singular_name'      => __( 'Service', 'seo-ae' ),
			'add_new_item'       => __( 'Add New Service', 'seo-ae' ),
			'edit_item'          => __( 'Edit Service', 'seo-ae' ),
			'all_items'          => __( 'All Services', 'seo-ae' ),
			'menu_name'          => __( 'Services', 'seo-ae' ),
		],
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => [ 'slug' => 'services', 'with_front' => false ],
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-chart-line',
		'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ],
		'taxonomies'         => [ 'service_category' ],
	] );

	// CASE STUDIES
	register_post_type( 'case_study', [
		'labels' => [
			'name'          => __( 'Case Studies', 'seo-ae' ),
			'singular_name' => __( 'Case Study', 'seo-ae' ),
			'add_new_item'  => __( 'Add New Case Study', 'seo-ae' ),
			'edit_item'     => __( 'Edit Case Study', 'seo-ae' ),
			'all_items'     => __( 'All Case Studies', 'seo-ae' ),
			'menu_name'     => __( 'Case Studies', 'seo-ae' ),
		],
		'public'          => true,
		'show_ui'         => true,
		'show_in_rest'    => true,
		'rewrite'         => [ 'slug' => 'case-studies', 'with_front' => false ],
		'menu_icon'       => 'dashicons-awards',
		'menu_position'   => 6,
		'supports'        => [ 'title', 'thumbnail', 'excerpt', 'revisions' ],
		'has_archive'     => true,
	] );

	// PORTFOLIO
	register_post_type( 'portfolio_item', [
		'labels' => [
			'name'          => __( 'Portfolio', 'seo-ae' ),
			'singular_name' => __( 'Portfolio Item', 'seo-ae' ),
			'add_new_item'  => __( 'Add New Portfolio Item', 'seo-ae' ),
			'all_items'     => __( 'All Portfolio Items', 'seo-ae' ),
			'menu_name'     => __( 'Portfolio', 'seo-ae' ),
		],
		'public'        => true,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'portfolio', 'with_front' => false ],
		'menu_icon'     => 'dashicons-portfolio',
		'menu_position' => 7,
		'supports'      => [ 'title', 'thumbnail', 'excerpt', 'revisions' ],
		'has_archive'   => true,
	] );

	// TESTIMONIALS
	register_post_type( 'testimonial', [
		'labels' => [
			'name'          => __( 'Testimonials', 'seo-ae' ),
			'singular_name' => __( 'Testimonial', 'seo-ae' ),
			'add_new_item'  => __( 'Add New Testimonial', 'seo-ae' ),
			'all_items'     => __( 'All Testimonials', 'seo-ae' ),
			'menu_name'     => __( 'Testimonials', 'seo-ae' ),
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-format-quote',
		'menu_position' => 8,
		'supports'      => [ 'title', 'thumbnail' ],
	] );

	// CONTACT SUBMISSIONS
	register_post_type( 'contact_submission', [
		'labels' => [
			'name'               => __( 'Contact Submissions', 'seo-ae' ),
			'singular_name'      => __( 'Submission', 'seo-ae' ),
			'all_items'          => __( 'All Submissions', 'seo-ae' ),
			'menu_name'          => __( 'Enquiries', 'seo-ae' ),
			'search_items'       => __( 'Search Submissions', 'seo-ae' ),
			'not_found'          => __( 'No submissions found.', 'seo-ae' ),
			'not_found_in_trash' => __( 'No submissions in trash.', 'seo-ae' ),
		],
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => false,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'capabilities'       => [
			'create_posts' => 'do_not_allow', // Disable "Add New"
		],
		'map_meta_cap'       => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 4,
		'menu_icon'          => 'dashicons-email-alt',
		'supports'           => [ 'title' ],
	] );

	// TEAM MEMBERS
	register_post_type( 'team_member', [
		'labels' => [
			'name'          => __( 'Team', 'seo-ae' ),
			'singular_name' => __( 'Team Member', 'seo-ae' ),
			'add_new_item'  => __( 'Add Team Member', 'seo-ae' ),
			'all_items'     => __( 'All Team Members', 'seo-ae' ),
			'menu_name'     => __( 'Team', 'seo-ae' ),
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-groups',
		'menu_position' => 9,
		'supports'      => [ 'title', 'thumbnail' ],
	] );

	// CUSTOM TAXONOMIES
	register_taxonomy( 'service_category', 'service', [
		'labels'       => [ 'name' => 'Service Categories', 'singular_name' => 'Service Category' ],
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => [ 'slug' => 'service-category' ],
	] );

	register_taxonomy( 'industry', ['case_study','portfolio_item'], [
		'labels'       => [ 'name' => 'Industries', 'singular_name' => 'Industry' ],
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => [ 'slug' => 'industry' ],
	] );

} );

// ─────────────────────────────────────────────────────────────────────────────
// 4. ACF FIELD GROUPS
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

	// Enable ACF JSON sync
	add_filter( 'acf/settings/save_json', fn() => SEOAE_DIR . '/acf-json' );
	add_filter( 'acf/settings/load_json', function( $paths ) {
		$paths[] = SEOAE_DIR . '/acf-json';
		return $paths;
	} );

	// ── OPTIONS PAGE ────────────────────────────────────────────────────────
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( [
			'page_title' => 'Theme Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'seoae-theme-settings',
			'capability' => 'manage_options',
			'icon_url'   => 'dashicons-admin-customizer',
			'position'   => 2,
		] );
		acf_add_options_sub_page( [
			'page_title'  => 'Homepage Settings',
			'menu_title'  => 'Homepage',
			'parent_slug' => 'seoae-theme-settings',
		] );
		acf_add_options_sub_page( [
			'page_title'  => 'Global SEO Settings',
			'menu_title'  => 'SEO & Schema',
			'parent_slug' => 'seoae-theme-settings',
		] );
	}

	// ── THEME SETTINGS FIELDS ────────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'      => 'group_theme_settings',
		'title'    => 'Theme Settings',
		'fields'   => [
			[ 'key' => 'field_site_phone',   'label' => 'Phone Number',   'name' => 'site_phone',   'type' => 'text',  'default_value' => '' ],
			[ 'key' => 'field_site_email',   'label' => 'Email Address',   'name' => 'site_email',   'type' => 'email', 'default_value' => 'sales@searchengineoptimization.ae' ],
			[ 'key' => 'field_site_address', 'label' => 'Office Address',  'name' => 'site_address', 'type' => 'text',  'default_value' => 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE' ],
			[ 'key' => 'field_site_maps_url',     'label' => 'Google Maps URL',              'name' => 'site_maps_url',     'type' => 'url' ],
			[ 'key' => 'field_gbp_place_id',      'label' => 'Google Business Place ID',     'name' => 'gbp_place_id',      'type' => 'text',  'instructions' => 'Find via Google Maps → Share → embed the URL, the Place ID starts with "ChIJ…"' ],
			[ 'key' => 'field_gbp_places_api_key','label' => 'Google Places API Key',        'name' => 'gbp_places_api_key','type' => 'text',  'instructions' => 'Needs Places API enabled. Used only server-side; never exposed to the browser.' ],
			[ 'key' => 'field_social_linkedin',  'label' => 'LinkedIn URL',  'name' => 'social_linkedin',  'type' => 'url' ],
			[ 'key' => 'field_social_instagram', 'label' => 'Instagram URL', 'name' => 'social_instagram', 'type' => 'url' ],
			[ 'key' => 'field_social_facebook',  'label' => 'Facebook URL',  'name' => 'social_facebook',  'type' => 'url' ],
			[ 'key' => 'field_social_twitter',   'label' => 'X / Twitter URL','name' => 'social_twitter',  'type' => 'url' ],
			[ 'key' => 'field_footer_tagline',   'label' => 'Footer Tagline', 'name' => 'footer_tagline',  'type' => 'text', 'default_value' => 'Dubai\'s #1 Enterprise SEO & Digital Growth Agency' ],
			[
				'key'        => 'field_certifications',
				'label'      => 'Certifications',
				'name'       => 'certifications',
				'type'       => 'repeater',
				'sub_fields' => [
					[ 'key' => 'field_cert_name',  'label' => 'Name',  'name' => 'cert_name',  'type' => 'text' ],
					[ 'key' => 'field_cert_image', 'label' => 'Image', 'name' => 'cert_image', 'type' => 'image', 'return_format' => 'url' ],
				],
			],
			[
				'key'        => 'field_trust_badges',
				'label'      => 'Trust Badges / Awards',
				'name'       => 'trust_badges',
				'type'       => 'repeater',
				'sub_fields' => [
					[ 'key' => 'field_badge_name',  'label' => 'Badge Name', 'name' => 'badge_name',  'type' => 'text' ],
					[ 'key' => 'field_badge_image', 'label' => 'Badge Image','name' => 'badge_image', 'type' => 'image', 'return_format' => 'url' ],
				],
			],
		],
		'location' => [ [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'seoae-theme-settings' ] ] ],
	] );

	// ── HOMEPAGE SETTINGS FIELDS ─────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_homepage_settings',
		'title'  => 'Homepage Settings',
		'fields' => [
			// Hero
			[ 'key' => 'field_hero_headline',     'label' => 'Hero Headline',       'name' => 'hero_headline',     'type' => 'text',     'default_value' => 'Dominate Search. Scale Revenue.' ],
			[ 'key' => 'field_hero_subheadline',  'label' => 'Hero Subheadline',    'name' => 'hero_subheadline',  'type' => 'textarea', 'default_value' => "We don't just chase rankings. We architect digital dominance. Leveraging AI-driven SEO, high-converting design, and precision paid media to turn your business into a market leader." ],
			[ 'key' => 'field_hero_cta_primary',  'label' => 'Primary CTA Text',    'name' => 'hero_cta_primary',  'type' => 'text',     'default_value' => 'Get Free Audit' ],
			[ 'key' => 'field_hero_cta_primary_url','label' => 'Primary CTA URL',   'name' => 'hero_cta_primary_url','type' => 'url',    'default_value' => '/contact' ],
			[ 'key' => 'field_hero_cta_secondary','label' => 'Secondary CTA Text',  'name' => 'hero_cta_secondary','type' => 'text',     'default_value' => 'View Our Work' ],
			[ 'key' => 'field_hero_cta_secondary_url','label' => 'Secondary CTA URL','name' => 'hero_cta_secondary_url','type' => 'url', 'default_value' => '/portfolio' ],
			[ 'key' => 'field_hero_badge_text',   'label' => 'Hero Badge Text',     'name' => 'hero_badge_text',   'type' => 'text',     'default_value' => "Dubai's #1 Enterprise SEO & Growth Partner" ],
			// Stats
			[
				'key'        => 'field_hero_stats',
				'label'      => 'Stats Bar',
				'name'       => 'hero_stats',
				'type'       => 'repeater',
				'min'        => 4,
				'max'        => 6,
				'sub_fields' => [
					[ 'key' => 'field_stat_value',  'label' => 'Value (e.g. 340)',  'name' => 'stat_value',  'type' => 'text' ],
					[ 'key' => 'field_stat_suffix', 'label' => 'Suffix (e.g. %+)', 'name' => 'stat_suffix', 'type' => 'text' ],
					[ 'key' => 'field_stat_prefix', 'label' => 'Prefix (e.g. +)', 'name' => 'stat_prefix', 'type' => 'text' ],
					[ 'key' => 'field_stat_label',  'label' => 'Label',            'name' => 'stat_label',  'type' => 'text' ],
				],
			],
			// Why Choose Us
			[
				'key'        => 'field_why_choose_items',
				'label'      => 'Why Choose Us — Items',
				'name'       => 'why_choose_items',
				'type'       => 'repeater',
				'sub_fields' => [
					[ 'key' => 'field_why_icon',  'label' => 'SVG Icon', 'name' => 'why_icon',  'type' => 'textarea', 'rows' => 4 ],
					[ 'key' => 'field_why_title', 'label' => 'Title',    'name' => 'why_title', 'type' => 'text' ],
					[ 'key' => 'field_why_desc',  'label' => 'Description','name' => 'why_desc','type' => 'textarea' ],
				],
			],
			// Bottom CTA section
			[ 'key' => 'field_cta_heading',     'label' => 'CTA Section Heading',     'name' => 'cta_heading',     'type' => 'text',     'default_value' => "Ready to Dominate Dubai's Digital Landscape?" ],
			[ 'key' => 'field_cta_description', 'label' => 'CTA Section Description', 'name' => 'cta_description', 'type' => 'textarea', 'default_value' => 'Join 345+ UAE businesses that trust SearchEngineOptimization.ae to drive measurable growth.' ],
		],
		'location' => [ [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-homepage-settings' ] ] ],
	] );

	// ── SERVICE FIELDS ───────────────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_service_fields',
		'title'  => 'Service Details',
		'fields' => [
			[ 'key' => 'field_svc_short_desc',   'label' => 'Short Description',     'name' => 'short_description',    'type' => 'textarea', 'rows' => 3 ],
			[ 'key' => 'field_svc_hero_badge',   'label' => 'Hero Badge Text',        'name' => 'hero_badge',           'type' => 'text',     'default_value' => 'Premium' ],
			[ 'key' => 'field_svc_hero_subtext', 'label' => 'Hero Badge Sub-Text',    'name' => 'hero_badge_sub',       'type' => 'text',     'default_value' => 'Results Driven' ],
			[ 'key' => 'field_svc_icon_svg',     'label' => 'Icon (SVG HTML)',        'name' => 'icon_svg',             'type' => 'textarea', 'rows' => 4 ],
			[ 'key' => 'field_svc_category',     'label' => 'Category Label',         'name' => 'category_label',       'type' => 'text',     'default_value' => 'Digital Marketing' ],
			[ 'key' => 'field_svc_cta_primary',  'label' => 'Primary CTA Text',       'name' => 'cta_primary_text',     'type' => 'text',     'default_value' => 'Start Your Campaign' ],
			[ 'key' => 'field_svc_cta_phone',    'label' => 'Phone CTA Text',         'name' => 'cta_phone_text',       'type' => 'text',     'default_value' => 'Call Us Now' ],
			// Benefits
			[
				'key'        => 'field_svc_benefits',
				'label'      => 'Benefits',
				'name'       => 'benefits',
				'type'       => 'repeater',
				'min'        => 3,
				'layout'     => 'table',
				'sub_fields' => [
					[ 'key' => 'field_svc_benefit_item', 'label' => 'Benefit', 'name' => 'benefit', 'type' => 'text' ],
				],
			],
			// Process Steps
			[
				'key'        => 'field_svc_process',
				'label'      => 'Process Steps',
				'name'       => 'process_steps',
				'type'       => 'repeater',
				'min'        => 3,
				'sub_fields' => [
					[ 'key' => 'field_proc_title', 'label' => 'Step Title',       'name' => 'step_title',   'type' => 'text' ],
					[ 'key' => 'field_proc_desc',  'label' => 'Step Description', 'name' => 'step_desc',    'type' => 'textarea', 'rows' => 3 ],
					[ 'key' => 'field_proc_icon',  'label' => 'Step Icon (SVG)',  'name' => 'step_icon',    'type' => 'textarea', 'rows' => 2 ],
				],
			],
			// Technologies
			[
				'key'        => 'field_svc_technologies',
				'label'      => 'Technologies / Tools',
				'name'       => 'technologies',
				'type'       => 'repeater',
				'layout'     => 'table',
				'sub_fields' => [
					[ 'key' => 'field_tech_name', 'label' => 'Tool Name', 'name' => 'tech_name', 'type' => 'text' ],
				],
			],
			// FAQs
			[
				'key'        => 'field_svc_faqs',
				'label'      => 'FAQs (10–20 per service)',
				'name'       => 'service_faqs',
				'type'       => 'repeater',
				'min'        => 10,
				'sub_fields' => [
					[ 'key' => 'field_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
					[ 'key' => 'field_faq_a', 'label' => 'Answer',   'name' => 'answer',   'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0 ],
				],
			],
			// Related services
			[
				'key'           => 'field_svc_related',
				'label'         => 'Related Services',
				'name'          => 'related_services',
				'type'          => 'relationship',
				'post_type'     => ['service'],
				'return_format' => 'object',
				'max'           => 3,
			],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'service' ] ] ],
	] );

	// ── CASE STUDY FIELDS ────────────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_case_study_fields',
		'title'  => 'Case Study Details',
		'fields' => [
			[ 'key' => 'field_cs_client_name',    'label' => 'Client Name',         'name' => 'client_name',    'type' => 'text' ],
			[ 'key' => 'field_cs_client_logo',    'label' => 'Client Logo',         'name' => 'client_logo',    'type' => 'image', 'return_format' => 'url' ],
			[ 'key' => 'field_cs_industry',       'label' => 'Industry',            'name' => 'cs_industry',    'type' => 'text' ],
			[ 'key' => 'field_cs_service',        'label' => 'Service Delivered',   'name' => 'cs_service',     'type' => 'relationship', 'post_type' => ['service'], 'return_format' => 'object', 'max' => 3 ],
			[ 'key' => 'field_cs_duration',       'label' => 'Project Duration',    'name' => 'cs_duration',    'type' => 'text',  'default_value' => '6 months' ],
			[ 'key' => 'field_cs_challenge',      'label' => 'The Challenge',       'name' => 'challenge',      'type' => 'wysiwyg' ],
			[ 'key' => 'field_cs_solution',       'label' => 'Our Solution',        'name' => 'solution',       'type' => 'wysiwyg' ],
			[
				'key'        => 'field_cs_results',
				'label'      => 'Key Results',
				'name'       => 'results',
				'type'       => 'repeater',
				'min'        => 2,
				'sub_fields' => [
					[ 'key' => 'field_cs_metric', 'label' => 'Metric',       'name' => 'metric',  'type' => 'text' ],
					[ 'key' => 'field_cs_value',  'label' => 'Value',        'name' => 'value',   'type' => 'text' ],
					[ 'key' => 'field_cs_period', 'label' => 'Time Period',  'name' => 'period',  'type' => 'text' ],
				],
			],
			[ 'key' => 'field_cs_quote',          'label' => 'Client Quote',        'name' => 'client_quote',   'type' => 'textarea' ],
			[ 'key' => 'field_cs_quote_author',   'label' => 'Quote Author Name',   'name' => 'quote_author',   'type' => 'text' ],
			[ 'key' => 'field_cs_quote_role',     'label' => 'Quote Author Role',   'name' => 'quote_role',     'type' => 'text' ],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'case_study' ] ] ],
	] );

	// ── PORTFOLIO FIELDS ─────────────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_portfolio_fields',
		'title'  => 'Portfolio Details',
		'fields' => [
			[ 'key' => 'field_pf_client',       'label' => 'Client Name',       'name' => 'client_name',    'type' => 'text' ],
			[ 'key' => 'field_pf_industry',     'label' => 'Industry',          'name' => 'pf_industry',    'type' => 'text' ],
			[ 'key' => 'field_pf_service',      'label' => 'Service Category',  'name' => 'pf_service',     'type' => 'relationship', 'post_type' => ['service'], 'return_format' => 'object' ],
			[ 'key' => 'field_pf_url',          'label' => 'Live URL',          'name' => 'project_url',    'type' => 'url' ],
			[ 'key' => 'field_pf_description',  'label' => 'Project Description','name' => 'description',   'type' => 'wysiwyg' ],
			[ 'key' => 'field_pf_technologies', 'label' => 'Technologies Used', 'name' => 'technologies',   'type' => 'text' ],
			[ 'key' => 'field_pf_result_1',     'label' => 'Result #1',         'name' => 'result_1',       'type' => 'text' ],
			[ 'key' => 'field_pf_result_2',     'label' => 'Result #2',         'name' => 'result_2',       'type' => 'text' ],
			[ 'key' => 'field_pf_result_3',     'label' => 'Result #3',         'name' => 'result_3',       'type' => 'text' ],
			[ 'key' => 'field_pf_gallery',      'label' => 'Project Gallery',   'name' => 'gallery',        'type' => 'gallery', 'return_format' => 'url' ],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'portfolio_item' ] ] ],
	] );

	// ── TESTIMONIAL FIELDS ───────────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_testimonial_fields',
		'title'  => 'Testimonial Details',
		'fields' => [
			[ 'key' => 'field_test_name',    'label' => 'Client Name',    'name' => 'client_name',    'type' => 'text' ],
			[ 'key' => 'field_test_role',    'label' => 'Role / Title',   'name' => 'client_role',    'type' => 'text' ],
			[ 'key' => 'field_test_company', 'label' => 'Company',        'name' => 'client_company', 'type' => 'text' ],
			[ 'key' => 'field_test_industry','label' => 'Industry',       'name' => 'industry',       'type' => 'select', 'choices' => [ 'Real Estate' => 'Real Estate', 'Hospitality' => 'Hospitality', 'E-commerce' => 'E-commerce', 'Legal' => 'Legal', 'Technology' => 'Technology', 'Finance' => 'Finance', 'Logistics' => 'Logistics', 'Construction' => 'Construction', 'Education' => 'Education', 'Automotive' => 'Automotive', 'HR & Recruitment' => 'HR & Recruitment', 'Events & Marketing' => 'Events & Marketing', 'Consulting' => 'Consulting', 'Other' => 'Other' ], 'allow_null' => 1 ],
			[ 'key' => 'field_test_avatar',  'label' => 'Avatar',         'name' => 'avatar',         'type' => 'image', 'return_format' => 'url' ],
			[ 'key' => 'field_test_rating',  'label' => 'Rating (1–5)',   'name' => 'rating',         'type' => 'number', 'min' => 1, 'max' => 5, 'default_value' => 5 ],
			[ 'key' => 'field_test_content', 'label' => 'Testimonial',    'name' => 'content',        'type' => 'textarea', 'rows' => 5 ],
			[ 'key' => 'field_test_service', 'label' => 'Service Used',   'name' => 'service_used',   'type' => 'relationship', 'post_type' => ['service'], 'return_format' => 'object', 'max' => 1 ],
			[ 'key' => 'field_test_verified','label' => 'Verified Client','name' => 'verified',       'type' => 'true_false', 'default_value' => 1 ],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ] ] ],
	] );

	// ── TEAM MEMBER FIELDS ───────────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_team_fields',
		'title'  => 'Team Member Details',
		'fields' => [
			[ 'key' => 'field_tm_role',      'label' => 'Job Role / Title', 'name' => 'job_role',      'type' => 'text' ],
			[ 'key' => 'field_tm_bio',       'label' => 'Bio',              'name' => 'bio',           'type' => 'wysiwyg' ],
			[ 'key' => 'field_tm_linkedin',  'label' => 'LinkedIn URL',     'name' => 'linkedin_url',  'type' => 'url' ],
			[ 'key' => 'field_tm_twitter',   'label' => 'Twitter/X URL',    'name' => 'twitter_url',   'type' => 'url' ],
			[ 'key' => 'field_tm_expertise', 'label' => 'Expertise Areas',  'name' => 'expertise',     'type' => 'text', 'instructions' => 'Comma-separated list' ],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'team_member' ] ] ],
	] );

	// ── PAGE / BLOG SEO FIELDS ───────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_page_seo_fields',
		'title'  => 'SEO & AI Optimization',
		'fields' => [
			[ 'key' => 'field_page_ai_summary',       'label' => 'AI Summary (for AI Overviews/LLMs)', 'name' => 'ai_summary',        'type' => 'textarea', 'rows' => 4 ],
			[ 'key' => 'field_page_key_takeaways',    'label' => 'Key Takeaways',                      'name' => 'key_takeaways',     'type' => 'textarea', 'rows' => 4, 'instructions' => 'One takeaway per line' ],
			[ 'key' => 'field_page_semantic_keywords','label' => 'Semantic Keywords',                  'name' => 'semantic_keywords', 'type' => 'text' ],
			[ 'key' => 'field_page_entities',         'label' => 'Entities',                           'name' => 'entities',          'type' => 'text' ],
			[
				'key'        => 'field_page_faqs',
				'label'      => 'FAQ Section (min 10 per page)',
				'name'       => 'page_faqs',
				'type'       => 'repeater',
				'min'        => 5,
				'sub_fields' => [
					[ 'key' => 'field_pfaq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
					[ 'key' => 'field_pfaq_a', 'label' => 'Answer',   'name' => 'answer',   'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0 ],
				],
			],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ] ] ],
	] );

	// ── BLOG POST EXTRA FIELDS ───────────────────────────────────────────────
	acf_add_local_field_group( [
		'key'    => 'group_blog_extra_fields',
		'title'  => 'Blog Post Extras',
		'fields' => [
			[ 'key' => 'field_blog_subtitle',      'label' => 'Subtitle',          'name' => 'subtitle',         'type' => 'text' ],
			[ 'key' => 'field_blog_author_role',   'label' => 'Author Role',       'name' => 'author_role',      'type' => 'text',  'default_value' => 'SEO Specialist' ],
			[ 'key' => 'field_blog_reading_time',  'label' => 'Reading Time (min)','name' => 'reading_time',     'type' => 'number','default_value' => 8 ],
			[ 'key' => 'field_blog_key_takeaways', 'label' => 'Key Takeaways',     'name' => 'key_takeaways',    'type' => 'textarea', 'rows' => 4, 'instructions' => 'One per line' ],
			[ 'key' => 'field_blog_ai_summary',    'label' => 'AI Summary',        'name' => 'ai_summary',       'type' => 'textarea', 'rows' => 3 ],
			[
				'key'        => 'field_blog_faqs',
				'label'      => 'Article FAQs',
				'name'       => 'article_faqs',
				'type'       => 'repeater',
				'sub_fields' => [
					[ 'key' => 'field_bfaq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
					[ 'key' => 'field_bfaq_a', 'label' => 'Answer',   'name' => 'answer',   'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0 ],
				],
			],
			[
				'key'           => 'field_blog_related_services',
				'label'         => 'Related Services',
				'name'          => 'related_services',
				'type'          => 'relationship',
				'post_type'     => ['service'],
				'return_format' => 'object',
				'max'           => 3,
			],
		],
		'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ] ],
	] );

} );

// ─────────────────────────────────────────────────────────────────────────────
// 5. FAQ SCHEMA JSON-LD (injected via wp_head)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	if ( ! function_exists( 'get_field' ) ) return;

	$faqs = [];

	if ( is_singular( 'service' ) ) {
		$faqs = get_field( 'service_faqs' ) ?: [];
	} elseif ( is_singular() ) {
		// Try ACF page_faqs first
		$faqs = get_field( 'page_faqs' ) ?: [];

		if ( empty( $faqs ) && is_single() ) {
			$faqs = get_field( 'article_faqs' ) ?: [];
		}

		// Fallback: location/industry pages store FAQs as PHP arrays in post meta
		if ( empty( $faqs ) ) {
			$raw = get_post_meta( get_the_ID(), 'location_faqs', true );
			if ( is_array( $raw ) ) {
				foreach ( $raw as $item ) {
					$q = $item['faq_question'] ?? $item['question'] ?? '';
					$a = $item['faq_answer']   ?? $item['answer']   ?? '';
					if ( $q && $a ) $faqs[] = [ 'question' => $q, 'answer' => $a ];
				}
			}
		}
	}

	if ( empty( $faqs ) ) return;

	$items = [];
	foreach ( $faqs as $faq ) {
		if ( empty( $faq['question'] ) || empty( $faq['answer'] ) ) continue;
		$items[] = [
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $faq['question'] ),
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq['answer'] ),
			],
		];
	}

	if ( empty( $items ) ) return;

	$schema = [
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $items,
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 20 );

// ─────────────────────────────────────────────────────────────────────────────
// 6. ORGANIZATION SCHEMA (with AggregateRating + Review markup)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	if ( ! is_front_page() ) return;
	$email   = function_exists( 'get_field' ) ? get_field( 'site_email', 'option' )   : 'sales@searchengineoptimization.ae';
	$address = function_exists( 'get_field' ) ? get_field( 'site_address', 'option' ) : 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE';

	// ── Build individual Review objects from top 5 testimonials ──────────────
	$testimonials = get_posts( [
		'post_type'      => 'testimonial',
		'post_status'    => 'publish',
		'posts_per_page' => 5,
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );

	$reviews = [];
	foreach ( $testimonials as $t ) {
		$name    = ( function_exists('get_field') ? get_field( 'client_name', $t->ID ) : '' ) ?: $t->post_title;
		$content = ( function_exists('get_field') ? get_field( 'content',     $t->ID ) : '' ) ?: $t->post_content;
		$rating  = intval( ( function_exists('get_field') ? get_field( 'rating', $t->ID ) : 0 ) ?: 5 );
		if ( ! $content ) continue;
		$reviews[] = [
			'@type'         => 'Review',
			'author'        => [ '@type' => 'Person', 'name' => $name ],
			'datePublished' => get_the_date( 'Y-m-d', $t ),
			'reviewBody'    => wp_strip_all_tags( $content ),
			'reviewRating'  => [
				'@type'       => 'Rating',
				'ratingValue' => $rating,
				'bestRating'  => 5,
				'worstRating' => 1,
			],
		];
	}

	$schema = [
		'@context' => 'https://schema.org',
		'@type'    => ['Organization','LocalBusiness','ProfessionalService'],
		'name'     => 'SearchEngineOptimization.ae',
		'alternateName' => 'SearchEngineOptimization.ae',
		'url'      => home_url(),
		'logo'     => SEOAE_URI . '/assets/images/logo-concept-1.png',
		'image'    => SEOAE_URI . '/assets/images/og-image.jpg',
		'description' => "Dubai's #1 enterprise SEO and digital marketing agency delivering measurable growth through AI-driven SEO, PPC, social media, and web development.",
		'email'       => $email,
		'telephone'   => seoae_phone() ?: '+971 4 320 9898',
		'address'     => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => $address,
			'addressLocality' => 'Dubai',
			'addressRegion'   => 'Dubai',
			'addressCountry'  => 'AE',
		],
		'areaServed'   => ['Dubai','Abu Dhabi','Sharjah','United Arab Emirates'],
		'priceRange'   => '$$$$',
		'openingHours' => 'Mo-Fr 09:00-18:00',
		'aggregateRating' => [
			'@type'       => 'AggregateRating',
			'ratingValue' => '4.9',
			'reviewCount' => '127',
			'bestRating'  => '5',
			'worstRating' => '1',
		],
		'sameAs'       => array_filter( [
			function_exists('get_field') ? get_field('social_linkedin','option') : '',
			function_exists('get_field') ? get_field('social_instagram','option') : '',
			function_exists('get_field') ? get_field('social_facebook','option') : '',
		]),
	];

	if ( ! empty( $reviews ) ) {
		$schema['review'] = $reviews;
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 21 );

// ─────────────────────────────────────────────────────────────────────────────
// 7. HELPER FUNCTIONS
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Render a button.
 * @param string $text   Button label
 * @param string $url    Button URL
 * @param string $variant 'primary'|'secondary'|'inverted'|'outline'
 * @param string $extra_class Additional CSS classes
 */
function seoae_button( string $text, string $url = '#', string $variant = 'primary', string $extra_class = '' ): void {
	$classes = 'btn btn--' . esc_attr( $variant );
	if ( $extra_class ) $classes .= ' ' . esc_attr( $extra_class );
	printf(
		'<a href="%s" class="%s">%s</a>',
		esc_url( $url ),
		$classes,
		esc_html( $text )
	);
}

/**
 * Render star rating HTML.
 */
function seoae_stars( int $rating = 5 ): string {
	$html = '<div class="stars">';
	for ( $i = 1; $i <= 5; $i++ ) {
		$filled = $i <= $rating ? ' stars__star--filled' : '';
		$html .= '<svg class="stars__star' . $filled . '" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
	}
	$html .= '</div>';
	return $html;
}

/**
 * Get phone number from ACF or fallback.
 */
function seoae_phone(): string {
	if ( function_exists( 'get_field' ) ) {
		$acf = get_field( 'site_phone', 'option' );
		if ( $acf ) return $acf;
	}
	return get_option( 'seoae_site_phone', '+971 4 320 9898' );
}

/**
 * Get email from ACF or fallback.
 */
function seoae_email(): string {
	return function_exists( 'get_field' ) ? ( get_field( 'site_email', 'option' ) ?: 'sales@searchengineoptimization.ae' ) : 'sales@searchengineoptimization.ae';
}

/**
 * Get address from ACF or fallback.
 */
function seoae_address(): string {
	return function_exists( 'get_field' ) ? ( get_field( 'site_address', 'option' ) ?: 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE' ) : 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE';
}

/**
 * Section label pill (e.g. "OUR SERVICES")
 */
function seoae_section_label( string $text ): void {
	echo '<span class="section-label">' . esc_html( $text ) . '</span>';
}

/**
 * Get all services ordered by menu_order.
 */
function seoae_get_services( int $limit = -1 ): array {
	$q = new WP_Query( [
		'post_type'      => 'service',
		'posts_per_page' => $limit,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	] );
	return $q->posts ?: [];
}

/**
 * Fetch Google Business Profile reviews via Places Details API.
 *
 * Requires "gbp_place_id" and "gbp_places_api_key" set in Theme Settings (ACF options).
 * Results are cached in a WP transient for 24 hours to stay within quota.
 * Returns an array with keys: rating, user_ratings_total, reviews[], profile_url
 * or false when not configured or on API error.
 *
 * @param  bool $force_refresh  Pass true to bypass the cache (e.g. from an admin action).
 * @return array|false
 */
function seoae_get_gbp_reviews( bool $force_refresh = false ) {
	$place_id = function_exists( 'get_field' ) ? get_field( 'gbp_place_id',       'option' ) : get_option( 'gbp_place_id' );
	$api_key  = function_exists( 'get_field' ) ? get_field( 'gbp_places_api_key', 'option' ) : get_option( 'gbp_places_api_key' );

	if ( empty( $place_id ) || empty( $api_key ) ) {
		return false; // Not configured — caller shows transparent placeholder
	}

	$cache_key = 'seoae_gbp_reviews_' . md5( $place_id );

	if ( ! $force_refresh ) {
		$cached = get_transient( $cache_key );
		if ( false !== $cached ) {
			return $cached; // Serve from cache
		}
	}

	// Fetch from Google Places Details API (v1 basic fields)
	$url = add_query_arg( [
		'place_id' => rawurlencode( $place_id ),
		'fields'   => 'name,rating,user_ratings_total,reviews',
		'key'      => $api_key,
		'language' => 'en',
	], 'https://maps.googleapis.com/maps/api/place/details/json' );

	$response = wp_remote_get( $url, [
		'timeout'   => 10,
		'sslverify' => true,
	] );

	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
		// Cache failure for 30 min so we don't hammer the API on every page load
		set_transient( $cache_key, false, 30 * MINUTE_IN_SECONDS );
		return false;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( empty( $body['result'] ) || ( $body['status'] ?? '' ) !== 'OK' ) {
		set_transient( $cache_key, false, 30 * MINUTE_IN_SECONDS );
		return false;
	}

	$result = $body['result'];

	$data = [
		'rating'              => (float) ( $result['rating'] ?? 0 ),
		'user_ratings_total'  => (int)   ( $result['user_ratings_total'] ?? 0 ),
		'profile_url'         => 'https://search.google.com/local/reviews?placeid=' . rawurlencode( $place_id ),
		'reviews'             => [],
	];

	foreach ( (array) ( $result['reviews'] ?? [] ) as $r ) {
		if ( empty( $r['text'] ) ) continue;
		$data['reviews'][] = [
			'author_name'          => $r['author_name']  ?? '',
			'author_url'           => $r['author_url']   ?? '',
			'profile_photo_url'    => $r['profile_photo_url'] ?? '',
			'rating'               => (int) ( $r['rating'] ?? 5 ),
			'text'                 => $r['text'],
			'relative_time_description' => $r['relative_time_description'] ?? '',
			'time'                 => (int) ( $r['time'] ?? 0 ),
		];
	}

	// Cache for 24 hours
	set_transient( $cache_key, $data, DAY_IN_SECONDS );

	return $data;
}

/**
 * AJAX handler to clear the GBP review cache from wp-admin.
 * Usage: POST wp-admin/admin-ajax.php with action=seoae_clear_gbp_cache&_wpnonce=...
 */
add_action( 'wp_ajax_seoae_clear_gbp_cache', function () {
	check_ajax_referer( 'seoae_clear_gbp_cache' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Insufficient permissions.' );
	}
	$place_id = function_exists( 'get_field' ) ? get_field( 'gbp_place_id', 'option' ) : '';
	if ( $place_id ) {
		delete_transient( 'seoae_gbp_reviews_' . md5( $place_id ) );
	}
	wp_send_json_success( 'GBP review cache cleared.' );
} );

/**
 * Get testimonials.
 */
function seoae_get_testimonials( int $limit = 10 ): array {
	$q = new WP_Query( [
		'post_type'      => 'testimonial',
		'posts_per_page' => $limit,
		'orderby'        => 'rand',
		'post_status'    => 'publish',
	] );
	return $q->posts ?: [];
}

/**
 * Get recent blog posts.
 */
function seoae_get_recent_posts( int $limit = 3 ): array {
	$q = new WP_Query( [
		'post_type'      => 'post',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	return $q->posts ?: [];
}

/**
 * Render dark CTA section.
 */
function seoae_cta_dark( string $heading = '', string $description = '', string $primary_text = 'Get Free Audit', string $primary_url = '/contact', string $secondary_text = 'Email Us', string $secondary_url = '' ): void {
	if ( ! $heading ) $heading = function_exists('get_field') ? get_field('cta_heading','option') : "Ready to Dominate Dubai's Digital Landscape?";
	if ( ! $description ) $description = function_exists('get_field') ? get_field('cta_description','option') : 'Join 345+ UAE businesses that trust searchengineoptimization.ae to drive measurable growth.';
	if ( ! $secondary_url ) $secondary_url = 'mailto:' . seoae_email();
	?>
	<section class="cta-dark hero-dark">
		<div class="container cta-dark__inner">
			<div class="cta-dark__content">
				<h2 class="cta-dark__heading"><?= esc_html( $heading ) ?></h2>
				<p class="cta-dark__desc"><?= esc_html( $description ) ?></p>
				<div class="cta-dark__actions">
					<?php seoae_button( $primary_text, $primary_url, 'primary' ) ?>
					<?php seoae_button( $secondary_text, $secondary_url, 'inverted' ) ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

// ─────────────────────────────────────────────────────────────────────────────
// 8. NEWSLETTER FORM AJAX HANDLER
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_ajax_seoae_newsletter',        'seoae_newsletter_handler' );
add_action( 'wp_ajax_nopriv_seoae_newsletter', 'seoae_newsletter_handler' );
function seoae_newsletter_handler(): void {
	check_ajax_referer( 'seoae-nonce', 'nonce' );
	$email = sanitize_email( $_POST['email'] ?? '' );
	if ( ! is_email( $email ) ) {
		wp_send_json_error( 'Invalid email address.' );
	}
	// Store subscriber (can be extended to send to MailChimp/Klaviyo/etc.)
	$subscribers = get_option( 'seoae_newsletter_subscribers', [] );
	if ( ! in_array( $email, $subscribers, true ) ) {
		$subscribers[] = $email;
		update_option( 'seoae_newsletter_subscribers', $subscribers );
	}
	wp_send_json_success( 'Thank you for subscribing!' );
}

// ─────────────────────────────────────────────────────────────────────────────
// 9. CONTACT FORM AJAX HANDLER
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_ajax_seoae_contact',        'seoae_contact_handler' );
add_action( 'wp_ajax_nopriv_seoae_contact', 'seoae_contact_handler' );
function seoae_contact_handler(): void {
	check_ajax_referer( 'seoae-nonce', 'nonce' );

	// Honeypot spam check
	if ( ! empty( $_POST['website_url_hp'] ) ) {
		wp_send_json_error( 'Spam detected.' );
	}

	$name         = sanitize_text_field( $_POST['name']         ?? '' );
	$email        = sanitize_email(      $_POST['email']        ?? '' );
	$phone        = sanitize_text_field( $_POST['phone']        ?? '' );
	$company      = sanitize_text_field( $_POST['company']      ?? '' );
	$business     = sanitize_text_field( $_POST['business']     ?? '' );
	$website      = esc_url_raw(         $_POST['website']      ?? '' );
	$service      = sanitize_text_field( $_POST['service']      ?? '' );
	$budget       = sanitize_text_field( $_POST['budget']       ?? '' );
	$country      = sanitize_text_field( $_POST['country']      ?? '' );
	$message      = sanitize_textarea_field( $_POST['message']  ?? '' );
	$privacy      = ! empty( $_POST['privacy'] );

	if ( ! $name || ! is_email( $email ) ) {
		wp_send_json_error( 'Please fill in all required fields.' );
	}
	if ( ! $message ) {
		wp_send_json_error( 'Please tell us about your project requirements.' );
	}
	if ( ! $privacy ) {
		wp_send_json_error( 'Please accept the Privacy Policy to proceed.' );
	}

	// Save to DB (legacy table — kept for backward compatibility)
	global $wpdb;
	$wpdb->insert( $wpdb->prefix . 'seoae_contacts', [
		'name'       => $name,
		'email'      => $email,
		'phone'      => $phone,
		'company'    => $company ?: $business,
		'service'    => $service,
		'budget'     => $budget,
		'message'    => "Website: $website\nCountry: $country\n\n$message",
		'created_at' => current_time( 'mysql' ),
	] );

	// Save as contact_submission CPT so leads are visible in wp-admin → Enquiries
	$post_title = $name . ( $company ? " — $company" : ( $business ? " — $business" : '' ) );
	$submission_id = wp_insert_post( [
		'post_type'   => 'contact_submission',
		'post_title'  => sanitize_text_field( $post_title ),
		'post_status' => 'publish',
		'post_date'   => current_time( 'mysql' ),
	] );
	if ( $submission_id && ! is_wp_error( $submission_id ) ) {
		update_post_meta( $submission_id, '_sub_email',   $email );
		update_post_meta( $submission_id, '_sub_phone',   $phone );
		update_post_meta( $submission_id, '_sub_company', $company ?: $business );
		update_post_meta( $submission_id, '_sub_website', $website );
		update_post_meta( $submission_id, '_sub_country', $country );
		update_post_meta( $submission_id, '_sub_service', $service );
		update_post_meta( $submission_id, '_sub_budget',  $budget );
		update_post_meta( $submission_id, '_sub_message', $message );
		update_post_meta( $submission_id, '_sub_status',  'new' );
	}

	// Notification to sales
	$to_email = 'sales@searchengineoptimization.ae';
	$subject  = "New Enquiry: $name" . ( $company ? " — $company" : '' ) . ( $service ? " ($service)" : '' );
	$body     = "NEW ENQUIRY FROM searchengineoptimization.ae\n";
	$body    .= str_repeat( '─', 50 ) . "\n\n";
	$body    .= "Full Name:    $name\n";
	$body    .= "Email:        $email\n";
	$body    .= "Phone:        " . ( $phone ?: '—' ) . "\n";
	$body    .= "Company:      " . ( $company ?: '—' ) . "\n";
	$body    .= "Business:     " . ( $business ?: '—' ) . "\n";
	$body    .= "Website:      " . ( $website ?: '—' ) . "\n";
	$body    .= "Country:      " . ( $country ?: '—' ) . "\n";
	$body    .= "Service:      " . ( $service ?: '—' ) . "\n";
	$body    .= "Budget:       " . ( $budget ?: '—' ) . "\n\n";
	$body    .= "Message:\n$message\n\n";
	$body    .= str_repeat( '─', 50 ) . "\n";
	$body    .= "Submitted: " . current_time( 'mysql' ) . "\n";

	$headers = [ 'Reply-To: ' . $name . ' <' . $email . '>' ];
	wp_mail( $to_email, $subject, $body, $headers );

	// Auto-reply to enquirer
	$auto_subject = 'Thank you for contacting SearchEngineOptimization.ae';
	$auto_body    = "Hi $name,\n\n";
	$auto_body   .= "Thank you for reaching out to SearchEngineOptimization.ae.\n\n";
	$auto_body   .= "We have received your enquiry" . ( $service ? " regarding $service" : '' ) . " and one of our growth experts will review it and be in touch within 24 hours.\n\n";
	$auto_body   .= "In the meantime, feel free to explore our blog for insights on digital marketing in the UAE:\nhttps://searchengineoptimization.ae/blog/\n\n";
	$auto_body   .= "Best regards,\nThe SearchEngineOptimization.ae Team\n";
	$auto_body   .= "sales@searchengineoptimization.ae\n";
	$auto_body   .= "M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE\n";
	wp_mail( $email, $auto_subject, $auto_body );

	wp_send_json_success( "Thank you $name! We've received your enquiry and will be in touch within 24 hours." );
}

// Create contacts table on theme activation AND on init (in case of fresh DB)
add_action( 'init', function () {
	global $wpdb;
	if ( get_option( 'seoae_contacts_table_v1' ) ) return; // already done
	$charset_collate = $wpdb->get_charset_collate();
	$table = $wpdb->prefix . 'seoae_contacts';
	$sql = "CREATE TABLE IF NOT EXISTS $table (
id mediumint(9) NOT NULL AUTO_INCREMENT,
name tinytext NOT NULL,
email varchar(200) NOT NULL,
phone varchar(50),
company varchar(200),
service varchar(200),
budget varchar(100),
message text,
created_at datetime DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY (id)
) $charset_collate;";
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
	update_option( 'seoae_contacts_table_v1', '1' );
} );
add_action( 'after_switch_theme', function () {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table = $wpdb->prefix . 'seoae_contacts';
	$sql = "CREATE TABLE IF NOT EXISTS $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		email varchar(200) NOT NULL,
		phone varchar(50),
		company varchar(200),
		service varchar(200),
		budget varchar(100),
		message text,
		created_at datetime DEFAULT '0000-00-00 00:00:00',
		PRIMARY KEY (id)
	) $charset_collate;";
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
} );

// ─────────────────────────────────────────────────────────────────────────────
// 10. SERVICE SHORT-SLUG REDIRECTS
// e.g. /services/seo/ → /services/search-engine-optimization/
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'template_redirect', function () {
	$map = [
		'seo'          => 'search-engine-optimization',
		'ai-search'    => 'ai-search-optimization',
		'ppc'          => 'ppc-management',
		'social-media' => 'social-media-marketing',
		'web-dev'      => 'web-development',
	];
	$path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
	foreach ( $map as $short => $full ) {
		if ( $path === "services/$short" || $path === "services/$short/" ) {
			wp_safe_redirect( home_url( "/services/$full/" ), 301 );
			exit;
		}
	}
} );

// ─────────────────────────────────────────────────────────────────────────────
// 11. ADMIN CUSTOMIZATIONS
// ─────────────────────────────────────────────────────────────────────────────
// Custom admin menu order
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', function( $menu_ord ) {
	if ( ! $menu_ord ) return true;
	return [
		'index.php',
		'separator1',
		'edit.php?post_type=contact_submission',
		'separator2',
		'edit.php?post_type=service',
		'edit.php?post_type=case_study',
		'edit.php?post_type=portfolio_item',
		'edit.php?post_type=testimonial',
		'edit.php?post_type=team_member',
		'separator-last',
		'edit.php',
		'edit.php?post_type=page',
		'seoae-theme-settings',
	];
} );

// ─────────────────────────────────────────────────────────────────────────────
// CONTACT SUBMISSION ADMIN COLUMNS
// ─────────────────────────────────────────────────────────────────────────────

// Replace default columns with useful ones
add_filter( 'manage_contact_submission_posts_columns', function( $cols ) {
	return [
		'cb'           => $cols['cb'],
		'title'        => __( 'Name / Company', 'seo-ae' ),
		'sub_email'    => __( 'Email', 'seo-ae' ),
		'sub_phone'    => __( 'Phone', 'seo-ae' ),
		'sub_service'  => __( 'Service', 'seo-ae' ),
		'sub_budget'   => __( 'Budget', 'seo-ae' ),
		'sub_country'  => __( 'Country', 'seo-ae' ),
		'sub_status'   => __( 'Status', 'seo-ae' ),
		'date'         => __( 'Date', 'seo-ae' ),
	];
} );

add_action( 'manage_contact_submission_posts_custom_column', function( $col, $post_id ) {
	switch ( $col ) {
		case 'sub_email':
			$v = get_post_meta( $post_id, '_sub_email', true );
			if ( $v ) echo '<a href="mailto:' . esc_attr( $v ) . '">' . esc_html( $v ) . '</a>';
			break;
		case 'sub_phone':
			echo esc_html( get_post_meta( $post_id, '_sub_phone', true ) ?: '—' );
			break;
		case 'sub_service':
			echo esc_html( get_post_meta( $post_id, '_sub_service', true ) ?: '—' );
			break;
		case 'sub_budget':
			echo esc_html( get_post_meta( $post_id, '_sub_budget', true ) ?: '—' );
			break;
		case 'sub_country':
			echo esc_html( get_post_meta( $post_id, '_sub_country', true ) ?: '—' );
			break;
		case 'sub_status':
			$status = get_post_meta( $post_id, '_sub_status', true ) ?: 'new';
			$colors = [ 'new' => '#16b1d4', 'contacted' => '#f0a500', 'converted' => '#2ecc71', 'closed' => '#aaa' ];
			$color  = $colors[ $status ] ?? '#aaa';
			printf(
				'<span style="display:inline-block;padding:2px 8px;border-radius:12px;font-size:.75rem;font-weight:600;background:%s;color:#fff;">%s</span>',
				esc_attr( $color ),
				esc_html( ucfirst( $status ) )
			);
			break;
	}
}, 10, 2 );

// Make columns sortable
add_filter( 'manage_edit-contact_submission_sortable_columns', function( $cols ) {
	$cols['sub_email']   = '_sub_email';
	$cols['sub_service'] = '_sub_service';
	$cols['sub_status']  = '_sub_status';
	return $cols;
} );

// Add a meta box on the edit screen to show full message details
add_action( 'add_meta_boxes', function() {
	add_meta_box(
		'seoae_submission_details',
		__( 'Enquiry Details', 'seo-ae' ),
		function( $post ) {
			$fields = [
				'Email'    => get_post_meta( $post->ID, '_sub_email',   true ),
				'Phone'    => get_post_meta( $post->ID, '_sub_phone',   true ),
				'Company'  => get_post_meta( $post->ID, '_sub_company', true ),
				'Website'  => get_post_meta( $post->ID, '_sub_website', true ),
				'Country'  => get_post_meta( $post->ID, '_sub_country', true ),
				'Service'  => get_post_meta( $post->ID, '_sub_service', true ),
				'Budget'   => get_post_meta( $post->ID, '_sub_budget',  true ),
				'Status'   => get_post_meta( $post->ID, '_sub_status',  true ),
				'Message'  => get_post_meta( $post->ID, '_sub_message', true ),
			];
			echo '<table style="width:100%;border-collapse:collapse;">';
			foreach ( $fields as $label => $value ) {
				if ( ! $value ) continue;
				$display = ( $label === 'Message' )
					? '<pre style="white-space:pre-wrap;word-break:break-word;margin:0;">' . esc_html( $value ) . '</pre>'
					: esc_html( $value );
				echo "<tr style='border-bottom:1px solid #eee;'>
					<td style='padding:6px 8px;font-weight:600;color:#555;white-space:nowrap;width:100px;'>" . esc_html( $label ) . "</td>
					<td style='padding:6px 8px;'>$display</td>
				</tr>";
			}
			echo '</table>';

			// Status update widget
			$current = get_post_meta( $post->ID, '_sub_status', true ) ?: 'new';
			echo '<div style="margin-top:1rem;padding-top:1rem;border-top:1px solid #eee;">';
			echo '<strong>Update Status:</strong> ';
			wp_nonce_field( 'seoae_sub_status_nonce', 'seoae_sub_status_nonce' );
			echo '<select name="seoae_sub_status" style="margin-left:.5rem;">';
			foreach ( [ 'new' => 'New', 'contacted' => 'Contacted', 'converted' => 'Converted', 'closed' => 'Closed' ] as $val => $label ) {
				$sel = selected( $current, $val, false );
				echo "<option value='" . esc_attr($val) . "' $sel>" . esc_html($label) . "</option>";
			}
			echo '</select></div>';
		},
		'contact_submission',
		'normal',
		'high'
	);
} );

// Save the status field from meta box
add_action( 'save_post_contact_submission', function( $post_id ) {
	if ( ! isset( $_POST['seoae_sub_status_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['seoae_sub_status_nonce'], 'seoae_sub_status_nonce' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( isset( $_POST['seoae_sub_status'] ) ) {
		$allowed = [ 'new', 'contacted', 'converted', 'closed' ];
		$status  = sanitize_text_field( $_POST['seoae_sub_status'] );
		if ( in_array( $status, $allowed, true ) ) {
			update_post_meta( $post_id, '_sub_status', $status );
		}
	}
} );

// ─────────────────────────────────────────────────────────────────────────────
// CONTACT SUBMISSION — CSV EXPORT
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Add "Export to CSV" button above the Enquiries list table.
 * Passes through the active search (s), date filter (m), and status filter.
 */
add_action( 'restrict_manage_posts', function( $post_type ) {
	if ( $post_type !== 'contact_submission' ) return;

	$export_url = add_query_arg( [
		'action'   => 'seoae_export_enquiries_csv',
		'_wpnonce' => wp_create_nonce( 'seoae_export_enquiries_csv' ),
		// Carry through active list-table filters so the export matches what is on-screen
		's'        => sanitize_text_field( $_GET['s']      ?? '' ),
		'm'        => sanitize_text_field( $_GET['m']      ?? '' ),
		'sub_status_filter' => sanitize_text_field( $_GET['sub_status_filter'] ?? '' ),
	], admin_url( 'admin-post.php' ) );
	?>
	<a href="<?php echo esc_url( $export_url ); ?>"
	   class="button"
	   style="margin-left:4px;display:inline-flex;align-items:center;gap:4px;">
		<span class="dashicons dashicons-download" style="margin-top:3px;font-size:16px;"></span>
		<?php esc_html_e( 'Export to CSV', 'seo-ae' ); ?>
	</a>
	<?php
} );

/**
 * Add a "Status" dropdown filter to the Enquiries list table.
 */
add_action( 'restrict_manage_posts', function( $post_type ) {
	if ( $post_type !== 'contact_submission' ) return;
	$current = sanitize_text_field( $_GET['sub_status_filter'] ?? '' );
	$statuses = [ '' => __( 'All Statuses', 'seo-ae' ), 'new' => 'New', 'contacted' => 'Contacted', 'converted' => 'Converted', 'closed' => 'Closed' ];
	echo '<select name="sub_status_filter">';
	foreach ( $statuses as $val => $label ) {
		printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $current, $val, false ), esc_html( $label ) );
	}
	echo '</select>';
} );

/**
 * Apply the status filter to WP_Query on the list screen.
 */
add_action( 'pre_get_posts', function( $query ) {
	global $pagenow;
	if ( ! is_admin() || $pagenow !== 'edit.php' ) return;
	if ( ( $query->get( 'post_type' ) ?: 'post' ) !== 'contact_submission' ) return;
	if ( ! $query->is_main_query() ) return;

	$status = sanitize_text_field( $_GET['sub_status_filter'] ?? '' );
	if ( $status ) {
		$query->set( 'meta_query', [
			[ 'key' => '_sub_status', 'value' => $status, 'compare' => '=' ],
		] );
	}
} );

/**
 * Handle the CSV export request (admin-post.php action).
 *
 * Respects: search string (s), month filter (m), status filter (sub_status_filter).
 */
add_action( 'admin_post_seoae_export_enquiries_csv', function () {
	// Auth + nonce
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( __( 'You do not have permission to export enquiries.', 'seo-ae' ) );
	}
	check_admin_referer( 'seoae_export_enquiries_csv' );

	// ── Build WP_Query args matching the current filters ────────────────────
	$args = [
		'post_type'      => 'contact_submission',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
	];

	// Search string
	$search = sanitize_text_field( $_GET['s'] ?? '' );
	if ( $search ) {
		$args['s'] = $search;
	}

	// Month filter (YYYYMM format that WP uses in the "m" param)
	$month = sanitize_text_field( $_GET['m'] ?? '' );
	if ( $month && preg_match( '/^\d{6}$/', $month ) ) {
		$args['date_query'] = [ [
			'year'  => (int) substr( $month, 0, 4 ),
			'month' => (int) substr( $month, 4, 2 ),
		] ];
	}

	// Status meta filter
	$status_filter = sanitize_text_field( $_GET['sub_status_filter'] ?? '' );
	if ( $status_filter ) {
		$args['meta_query'] = [
			[ 'key' => '_sub_status', 'value' => $status_filter, 'compare' => '=' ],
		];
	}

	$posts = get_posts( $args );

	// ── Output CSV ───────────────────────────────────────────────────────────
	$filename = 'enquiries-export-' . gmdate( 'Y-m-d' ) . '.csv';

	header( 'Content-Type: text/csv; charset=UTF-8' );
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	header( 'Cache-Control: no-cache, no-store, must-revalidate' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );

	// BOM for Excel UTF-8 compatibility
	echo "\xEF\xBB\xBF";

	$out = fopen( 'php://output', 'w' );

	// Header row
	fputcsv( $out, [ 'Name', 'Email', 'Phone', 'Company', 'Service', 'Budget', 'Country', 'Message', 'Date', 'Status' ] );

	foreach ( $posts as $post ) {
		$name    = $post->post_title;
		$email   = get_post_meta( $post->ID, '_sub_email',   true );
		$phone   = get_post_meta( $post->ID, '_sub_phone',   true );
		$company = get_post_meta( $post->ID, '_sub_company', true );
		$service = get_post_meta( $post->ID, '_sub_service', true );
		$budget  = get_post_meta( $post->ID, '_sub_budget',  true );
		$country = get_post_meta( $post->ID, '_sub_country', true );
		$message = get_post_meta( $post->ID, '_sub_message', true );
		$date    = get_the_date( 'Y-m-d H:i:s', $post );
		$status  = get_post_meta( $post->ID, '_sub_status',  true ) ?: 'new';

		fputcsv( $out, [ $name, $email, $phone, $company, $service, $budget, $country, $message, $date, $status ] );
	}

	fclose( $out );
	exit;
} );

// ─────────────────────────────────────────────────────────────────────────────
// Add admin columns for services
add_filter( 'manage_service_posts_columns', function( $cols ) {
	return array_merge(
		array_slice( $cols, 0, 2, true ),
		[ 'category_label' => 'Category', 'faqs_count' => 'FAQs' ],
		array_slice( $cols, 2, null, true )
	);
} );
add_action( 'manage_service_posts_custom_column', function( $col, $post_id ) {
	if ( $col === 'category_label' && function_exists( 'get_field' ) ) {
		echo esc_html( get_field( 'category_label', $post_id ) ?: '—' );
	}
	if ( $col === 'faqs_count' && function_exists( 'get_field' ) ) {
		$faqs = get_field( 'service_faqs', $post_id );
		echo $faqs ? count( $faqs ) : 0;
	}
}, 10, 2 );

// ─────────────────────────────────────────────────────────────────────────────
// 11. PERMALINK FLUSH ON ACTIVATION
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'after_switch_theme', function () {
	flush_rewrite_rules();
} );

// ─────────────────────────────────────────────────────────────────────────────
// 12. YOAST SEO — BREADCRUMB SHORTCODE
// ─────────────────────────────────────────────────────────────────────────────
add_shortcode( 'seoae_breadcrumbs', function() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return yoast_breadcrumb( '<nav class="breadcrumbs" aria-label="Breadcrumb">', '</nav>', false );
	}
	return '';
} );

// ─────────────────────────────────────────────────────────────────────────────
// 13. SUPPRESS YOAST SEO OUTPUT (plugin inactive but partially loads)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function () {
	// Yoast hooks to wp_head at priority 1 via wpseo_head
	remove_action( 'wp_head', 'wpseo_head', 1 );
	// Also remove via class instance if it's been instantiated
	if ( class_exists( 'WPSEO_Frontend' ) ) {
		$instance = WPSEO_Frontend::get_instance();
		remove_action( 'wp_head', [ $instance, 'head' ], 1 );
	}
	// Yoast canonical / meta output
	remove_action( 'wp_head', 'rel_canonical' );
	// Yoast opengraph
	if ( class_exists( 'WPSEO_OpenGraph' ) ) {
		global $wpseo_og;
		if ( isset( $wpseo_og ) ) {
			remove_action( 'wpseo_head', [ $wpseo_og, 'opengraph' ], 30 );
		}
	}
}, 999 );

// Nuclear option: intercept Yoast's head action and block all its output
add_action( 'wp_head', function () {
	remove_action( 'wp_head', 'wpseo_head', 1 );
	remove_action( 'wp_head', 'rel_canonical' );
	// Block Yoast's opengraph hooks
	global $wpseo_og;
	if ( isset( $wpseo_og ) && is_object( $wpseo_og ) ) {
		remove_action( 'wpseo_head', [ $wpseo_og, 'opengraph' ], 30 );
	}
}, 0 );

// ─────────────────────────────────────────────────────────────────────────────
// 13b. OPEN GRAPH + TWITTER CARD META TAGS
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	global $post;
	$site_name   = 'SearchEngineOptimization.ae';
	$base_url    = home_url();
	$default_img = $base_url . '/wp-content/themes/seo-ae/assets/images/og-image.jpg';

	// Title
	if ( is_front_page() ) {
		$title = "Dubai's #1 SEO & Digital Marketing Agency | SearchEngineOptimization.ae";
		$desc  = "Dominate search. Scale revenue. We help UAE & GCC businesses grow organic traffic, capture high-intent leads, and outrank competitors with enterprise SEO strategies.";
		$url   = $base_url . '/';
		$type  = 'website';
		$img   = $default_img;
	} elseif ( is_singular() && $post ) {
		$title = get_the_title( $post ) . ' | ' . $site_name;
		$desc  = wp_strip_all_tags( get_the_excerpt( $post ) ?: wp_trim_words( $post->post_content, 30 ) );
		$url   = get_permalink( $post );
		$type  = ( $post->post_type === 'post' ) ? 'article' : 'website';
		$img   = get_the_post_thumbnail_url( $post, 'large' ) ?: $default_img;
	} elseif ( is_category() || is_tag() || is_archive() ) {
		$title = single_cat_title( '', false ) . ' | ' . $site_name;
		$desc  = "SEO and digital marketing insights from SearchEngineOptimization.ae, Dubai's leading SEO agency.";
		$url   = get_term_link( get_queried_object() );
		$type  = 'website';
		$img   = $default_img;
	} else {
		return;
	}

	$desc = $desc ? esc_attr( substr( $desc, 0, 160 ) ) : '';
	$url  = esc_url( is_string($url) ? $url : $base_url );
	$img  = esc_url( $img );

	echo "\n<!-- Open Graph -->\n";
	echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
	echo '<meta property="og:description" content="' . $desc . '">' . "\n";
	echo '<meta property="og:url" content="' . $url . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
	echo '<meta property="og:image" content="' . $img . '">' . "\n";
	echo '<meta property="og:image:width" content="1200">' . "\n";
	echo '<meta property="og:image:height" content="630">' . "\n";
	echo '<meta property="og:locale" content="en_AE">' . "\n";
	if ( $type === 'article' && $post ) {
		echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c', $post ) ) . '">' . "\n";
		echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c', $post ) ) . '">' . "\n";
		echo '<meta property="article:author" content="' . esc_attr( $site_name ) . '">' . "\n";
	}

	echo "\n<!-- Twitter Card -->\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . $desc . '">' . "\n";
	echo '<meta name="twitter:image" content="' . $img . '">' . "\n";
	echo '<meta name="twitter:site" content="@SEOae_dubai">' . "\n";
	echo '<meta name="twitter:creator" content="@SEOae_dubai">' . "\n";
}, 5 );

// ─────────────────────────────────────────────────────────────────────────────
// 14. CANONICAL URL (dynamic host — works on localhost + Replit proxy)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	// Remove WordPress default rel=canonical and re-output with correct host
	remove_action( 'wp_head', 'rel_canonical' );

	global $post;
	if ( is_singular() && $post ) {
		$canonical = get_permalink( $post );
	} elseif ( is_front_page() ) {
		$canonical = home_url( '/' );
	} elseif ( is_home() ) {
		$canonical = get_permalink( get_option( 'page_for_posts' ) );
	} elseif ( is_category() || is_tag() ) {
		$obj = get_queried_object();
		$canonical = $obj ? get_term_link( $obj ) : home_url('/');
	} elseif ( is_post_type_archive() ) {
		// Custom post type archives (service, case_study, portfolio_item)
		$canonical = get_post_type_archive_link( get_post_type() );
		if ( ! $canonical ) $canonical = home_url('/');
	} elseif ( is_archive() ) {
		// Date/author archives
		$canonical = get_pagenum_link();
	} elseif ( is_search() ) {
		$canonical = get_search_link( get_search_query() );
	} elseif ( is_404() ) {
		return; // No canonical on 404 pages
	} else {
		return;
	}
	if ( $canonical && ! is_wp_error( $canonical ) ) {
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
	}
}, 3 );

// ─────────────────────────────────────────────────────────────────────────────
// 15. WEBSITE + WEBPAGE SCHEMA
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	// WebSite schema (all pages)
	$website = [
		'@context' => 'https://schema.org',
		'@type'    => 'WebSite',
		'@id'      => home_url() . '/#website',
		'name'     => 'SearchEngineOptimization.ae',
		'url'      => home_url(),
		'potentialAction' => [
			'@type'       => 'SearchAction',
			'target'      => [
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url() . '/?s={search_term_string}',
			],
			'query-input' => 'required name=search_term_string',
		],
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $website, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";

	// WebPage schema
	global $post;
	$page_type = 'WebPage';
	if ( is_front_page() )   $page_type = 'WebPage';
	if ( is_singular('post') ) $page_type = 'Article';
	if ( is_home() )          $page_type = 'CollectionPage';
	if ( is_search() )        $page_type = 'SearchResultsPage';
	if ( is_singular() && $post && $post->post_name === 'contact' ) $page_type = 'ContactPage';

	$name = is_singular() && $post ? get_the_title($post) : get_bloginfo('name');
	$desc = is_singular() && $post
		? substr( wp_strip_all_tags( get_the_excerpt($post) ?: $post->post_content ), 0, 200 )
		: "Dubai's #1 SEO and digital marketing agency delivering measurable growth.";

	$webpage = [
		'@context'        => 'https://schema.org',
		'@type'           => $page_type,
		'@id'             => is_singular() && $post ? get_permalink($post) . '#webpage' : home_url('/') . '#webpage',
		'url'             => is_singular() && $post ? get_permalink($post) : home_url('/'),
		'name'            => $name,
		'description'     => $desc,
		'isPartOf'        => [ '@id' => home_url() . '/#website' ],
		'inLanguage'      => 'en-AE',
		'datePublished'   => is_singular() && $post ? get_the_date('c', $post) : '',
		'dateModified'    => is_singular() && $post ? get_the_modified_date('c', $post) : '',
		'breadcrumb'      => [ '@id' => ( is_singular() && $post ? get_permalink($post) : home_url('/') ) . '#breadcrumb' ],
	];
	// Remove empty fields
	$webpage = array_filter($webpage, fn($v) => $v !== '');
	echo '<script type="application/ld+json">' . wp_json_encode( $webpage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 22 );

// ─────────────────────────────────────────────────────────────────────────────
// 16. ARTICLE / BLOGPOSTING SCHEMA
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	if ( ! is_singular('post') ) return;
	global $post;
	if ( ! $post ) return;

	$img = get_the_post_thumbnail_url( $post, 'large' ) ?: home_url() . '/wp-content/themes/seo-ae/assets/images/og-image.jpg';
	$schema = [
		'@context'         => 'https://schema.org',
		'@type'            => 'BlogPosting',
		'@id'              => get_permalink($post) . '#article',
		'headline'         => get_the_title($post),
		'description'      => substr( wp_strip_all_tags( get_the_excerpt($post) ?: $post->post_content ), 0, 200 ),
		'image'            => [ '@type' => 'ImageObject', 'url' => $img ],
		'url'              => get_permalink($post),
		'datePublished'    => get_the_date('c', $post),
		'dateModified'     => get_the_modified_date('c', $post),
		'author'           => [
			'@type' => 'Organization',
			'name'  => 'SearchEngineOptimization.ae',
			'url'   => home_url(),
		],
		'publisher'        => [
			'@type' => 'Organization',
			'name'  => 'SearchEngineOptimization.ae',
			'url'   => home_url(),
			'logo'  => [ '@type' => 'ImageObject', 'url' => home_url() . '/wp-content/themes/seo-ae/assets/images/logo-concept-1.png' ],
		],
		'mainEntityOfPage' => [ '@type' => 'WebPage', '@id' => get_permalink($post) ],
		'inLanguage'       => 'en-AE',
		'keywords'         => implode(', ', wp_list_pluck( get_the_tags($post->ID) ?: [], 'name' ) ),
		'articleSection'   => implode(', ', wp_list_pluck( get_the_category($post->ID) ?: [], 'name' ) ),
		'wordCount'        => str_word_count( wp_strip_all_tags( $post->post_content ) ),
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 23 );

// ─────────────────────────────────────────────────────────────────────────────
// 17. SERVICE SCHEMA
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	if ( ! is_singular('service') ) return;
	global $post;
	if ( ! $post ) return;

	$desc  = get_field('short_description', $post->ID) ?: substr( wp_strip_all_tags( $post->post_content ), 0, 200 );
	$img   = get_the_post_thumbnail_url( $post, 'large' ) ?: home_url() . '/wp-content/themes/seo-ae/assets/images/og-image.jpg';
	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'@id'         => get_permalink($post) . '#service',
		'name'        => get_the_title($post),
		'description' => $desc,
		'url'         => get_permalink($post),
		'image'       => $img,
		'provider'    => [
			'@type' => 'Organization',
			'name'  => 'SearchEngineOptimization.ae',
			'url'   => home_url(),
		],
		'areaServed'  => 'United Arab Emirates',
		'serviceType' => get_the_title($post),
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 24 );

// ─────────────────────────────────────────────────────────────────────────────
// 18. BREADCRUMBLIST SCHEMA
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	if ( is_front_page() ) return;
	global $post;

	$items   = [];
	$items[] = [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/') ];
	$pos     = 2;

	if ( is_singular('post') && $post ) {
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => 'Blog', 'item' => home_url('/blog/') ];
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title($post), 'item' => get_permalink($post) ];
	} elseif ( is_singular('service') && $post ) {
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => 'Services', 'item' => home_url('/services/') ];
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title($post), 'item' => get_permalink($post) ];
	} elseif ( is_singular('case_study') && $post ) {
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => 'Case Studies', 'item' => home_url('/case-studies/') ];
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title($post), 'item' => get_permalink($post) ];
	} elseif ( is_singular() && $post ) {
		if ( $post->post_parent ) {
			$parent = get_post( $post->post_parent );
			if ( $parent ) {
				$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title($parent), 'item' => get_permalink($parent) ];
			}
		}
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title($post), 'item' => get_permalink($post) ];
	} elseif ( is_home() ) {
		$items[] = [ '@type' => 'ListItem', 'position' => $pos++, 'name' => 'Blog', 'item' => home_url('/blog/') ];
	}

	if ( count($items) < 2 ) return;

	$schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'@id'             => ( is_singular() && $post ? get_permalink($post) : get_pagenum_link() ) . '#breadcrumb',
		'itemListElement' => $items,
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 25 );

// ─────────────────────────────────────────────────────────────────────────────
// 18b. 301 REDIRECTS — old URL slugs → new canonical URLs
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'template_redirect', function () {
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? strtok( $_SERVER['REQUEST_URI'], '?' ) : '';
	$uri = trailingslashit( $uri );

	// Legacy slugs → current canonical page URLs (never redirect away from live pages).
	$legacy_redirects = [
		'/seo-company-abu-dhabi/'      => '/locations/seo-abu-dhabi/',
		'/seo-company-sharjah/'        => '/locations/seo-sharjah/',
		'/seo-company-ajman/'          => '/locations/seo-ajman/',
		'/seo-company-ras-al-khaimah/' => '/locations/seo-ras-al-khaimah/',
		'/seo-company-fujairah/'       => '/locations/seo-fujairah/',
		'/seo-abu-dhabi/'              => '/locations/seo-abu-dhabi/',
		'/seo-sharjah/'                => '/locations/seo-sharjah/',
		'/seo-ajman/'                  => '/locations/seo-ajman/',
		'/seo-ras-al-khaimah/'         => '/locations/seo-ras-al-khaimah/',
		'/seo-fujairah/'               => '/locations/seo-fujairah/',
		'/real-estate-seo/'            => '/industries/real-estate/',
		'/healthcare-seo/'             => '/industries/healthcare/',
		'/ecommerce-seo/'              => '/industries/ecommerce/',
		'/hospitality-seo/'            => '/industries/hospitality/',
		'/legal-seo/'                  => '/industries/legal/',
		'/finance-seo/'                => '/industries/finance/',
		'/real-estate/'                => '/industries/real-estate/',
		'/healthcare/'                 => '/industries/healthcare/',
		'/ecommerce/'                  => '/industries/ecommerce/',
		'/hospitality/'                => '/industries/hospitality/',
		'/legal/'                      => '/industries/legal/',
		'/finance/'                    => '/industries/finance/',
	];

	if ( isset( $legacy_redirects[ $uri ] ) ) {
		wp_safe_redirect( home_url( $legacy_redirects[ $uri ] ), 301 );
		exit;
	}
}, 1 );

// ─────────────────────────────────────────────────────────────────────────────
// 19. CUSTOM XML SITEMAP
// ─────────────────────────────────────────────────────────────────────────────
// Prevent WordPress from adding trailing slash to sitemap.xml
add_filter( 'redirect_canonical', function( $redirect_url, $requested_url ) {
	if ( strpos( $requested_url, 'sitemap.xml' ) !== false ) {
		return false;
	}
	return $redirect_url;
}, 10, 2 );

add_action( 'init', function () {
	add_rewrite_rule( '^sitemap\.xml$', 'index.php?seoae_sitemap=1', 'top' );
} );
add_filter( 'query_vars', function ( $vars ) {
	$vars[] = 'seoae_sitemap';
	return $vars;
} );
add_action( 'template_redirect', function () {
	if ( ! get_query_var('seoae_sitemap') ) return;

	header( 'Content-Type: application/xml; charset=UTF-8' );
	header( 'X-Robots-Tag: noindex' );

	// Always use the production domain for sitemap URLs (avoids Replit dev domain in output)
	$prod_domain = 'https://searchengineoptimization.ae';
	$dev_domain  = rtrim( home_url(), '/' );
	$base = $prod_domain;
	$urls = [];

	// Static pages
	$pages = get_posts(['post_type'=>'page','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'date','order'=>'DESC']);
	foreach ( $pages as $p ) {
		$urls[] = [ 'loc' => get_permalink($p), 'lastmod' => get_the_modified_date('Y-m-d', $p), 'changefreq' => 'monthly', 'priority' => is_front_page() ? '1.0' : '0.8' ];
	}

	// Services
	$services = get_posts(['post_type'=>'service','post_status'=>'publish','posts_per_page'=>-1]);
	foreach ( $services as $p ) {
		$urls[] = [ 'loc' => get_permalink($p), 'lastmod' => get_the_modified_date('Y-m-d', $p), 'changefreq' => 'monthly', 'priority' => '0.9' ];
	}

	// Case studies
	$cs = get_posts(['post_type'=>'case_study','post_status'=>'publish','posts_per_page'=>-1]);
	foreach ( $cs as $p ) {
		$urls[] = [ 'loc' => get_permalink($p), 'lastmod' => get_the_modified_date('Y-m-d', $p), 'changefreq' => 'monthly', 'priority' => '0.7' ];
	}

	// Blog posts
	$posts = get_posts(['post_type'=>'post','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'date','order'=>'DESC']);
	foreach ( $posts as $p ) {
		$urls[] = [ 'loc' => get_permalink($p), 'lastmod' => get_the_modified_date('Y-m-d', $p), 'changefreq' => 'weekly', 'priority' => '0.7' ];
	}

	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
	foreach ( $urls as $u ) {
		if ( empty($u['loc']) || is_wp_error($u['loc']) ) continue;
		// Replace dev domain with production domain in all sitemap URLs
		$loc = str_replace( $dev_domain, $prod_domain, $u['loc'] );
		echo "  <url>\n";
		echo "    <loc>" . esc_url($loc) . "</loc>\n";
		if ( ! empty($u['lastmod']) )    echo "    <lastmod>" . esc_html($u['lastmod']) . "</lastmod>\n";
		if ( ! empty($u['changefreq']) ) echo "    <changefreq>" . esc_html($u['changefreq']) . "</changefreq>\n";
		if ( ! empty($u['priority']) )   echo "    <priority>" . esc_html($u['priority']) . "</priority>\n";
		echo "  </url>\n";
	}
	echo '</urlset>';
	exit;
} );

// ─────────────────────────────────────────────────────────────────────────────
// 20. PERFORMANCE — PRECONNECT, PRELOAD, LAZY LOAD, RESOURCE HINTS
// ─────────────────────────────────────────────────────────────────────────────
// Resource hints
add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="dns-prefetch" href="https://www.google-analytics.com">' . "\n";
	echo '<link rel="dns-prefetch" href="https://www.googletagmanager.com">' . "\n";
	echo '<link rel="dns-prefetch" href="https://maps.googleapis.com">' . "\n";
}, 1 );

// Move scripts to footer (improves LCP/FCP)
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

// Lazy load all images and iframes
add_filter( 'the_content', function ( $content ) {
	if ( is_admin() ) return $content;
	$content = preg_replace( '/<img(?![^>]*loading=)/', '<img loading="lazy"', $content );
	$content = preg_replace( '/<iframe(?![^>]*loading=)/', '<iframe loading="lazy"', $content );
	return $content;
} );

// Add loading="lazy" to featured images
add_filter( 'post_thumbnail_html', function ( $html ) {
	if ( is_admin() ) return $html;
	return preg_replace( '/<img(?![^>]*loading=)/', '<img loading="lazy"', $html );
} );

// Defer non-critical JS
add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {
	$defer = ['seo-ae-main-js'];
	if ( in_array($handle, $defer, true) ) {
		return str_replace( ' src=', ' defer src=', $tag );
	}
	return $tag;
}, 10, 3 );

// ─────────────────────────────────────────────────────────────────────────────
// 21. META DESCRIPTION FALLBACK
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	global $post;
	// Only output if not already provided by another plugin
	$desc = '';
	if ( is_front_page() ) {
		$desc = "Dubai's #1 SEO & digital marketing agency. We help UAE businesses dominate search, capture high-intent traffic, and grow revenue. Get your free audit today.";
	} elseif ( is_singular() && $post ) {
		$desc = wp_trim_words( wp_strip_all_tags( get_the_excerpt($post) ?: $post->post_content ), 30 );
	} elseif ( is_home() ) {
		$desc = 'SEO tips, digital marketing strategies, and industry insights from Dubai\'s leading SEO agency, SearchEngineOptimization.ae.';
	}
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( substr($desc, 0, 160) ) . '">' . "\n";
	}
}, 2 );

// ─────────────────────────────────────────────────────────────────────────────
// 22. HREFLANG (English + Arabic for UAE)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	$url = is_singular() ? get_permalink() : home_url( $_SERVER['REQUEST_URI'] ?? '/' );
	if ( is_wp_error($url) ) return;
	echo '<link rel="alternate" hreflang="en-ae" href="' . esc_url($url) . '">' . "\n";
	echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($url) . '">' . "\n";
}, 6 );


// ─────────────────────────────────────────────────────────────────────────────
// 23a. REMOVE X-FRAME-OPTIONS ON DEV — Replit preview uses an iframe.
//      On production Apache this is re-added by .htaccess.
// ─────────────────────────────────────────────────────────────────────────────
// Remove WP core's built-in X-Frame-Options hook (send_frame_options_header)
add_action( 'after_setup_theme', function () {
	remove_action( 'wp',          'send_frame_options_header' );
	remove_action( 'login_init',  'send_frame_options_header' );
}, 1 );
// Belt-and-suspenders: also strip it from headers filter and late hook
add_filter( 'wp_headers', function ( $headers ) {
	unset( $headers['X-Frame-Options'] );
	return $headers;
} );
add_action( 'send_headers', function () {
	header_remove( 'X-Frame-Options' );
}, 999 );

// ─────────────────────────────────────────────────────────────────────────────
// 23. RELATIVE URL REWRITE — strip localhost:8000 so Vite proxy handles assets
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'template_redirect', function () {
    ob_start( function ( $html ) {
        return str_replace(
            [ 'http://localhost:8000', 'https://localhost:8000' ],
            '',
            $html
        );
    } );
} );

// ─────────────────────────────────────────────────────────────────────────────
// 24. BLOG SETTINGS — ACF Options (CMS-editable from admin)
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_options_sub_page' ) ) return;

	// Register Blog sub-page (idempotent)
	acf_add_options_sub_page( [
		'page_title'  => 'Blog Settings',
		'menu_title'  => 'Blog',
		'menu_slug'   => 'seoae-blog-settings',
		'parent_slug' => 'seoae-theme-settings',
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'Contact & Forms',
		'menu_title'  => 'Contact',
		'menu_slug'   => 'seoae-contact-settings',
		'parent_slug' => 'seoae-theme-settings',
	] );

	// Blog Settings fields
	acf_add_local_field_group( [
		'key'    => 'group_blog_settings',
		'title'  => 'Blog Settings',
		'fields' => [
			[ 'key' => 'field_blog_hero_title', 'label' => 'Blog Hero Title',       'name' => 'blog_hero_title', 'type' => 'text',     'default_value' => 'SEO & Digital Marketing Insights' ],
			[ 'key' => 'field_blog_hero_desc',  'label' => 'Blog Hero Description', 'name' => 'blog_hero_desc',  'type' => 'textarea', 'default_value' => 'Expert guides, strategies, and industry news for UAE businesses looking to dominate search.' ],
			[ 'key' => 'field_blog_posts_per_page', 'label' => 'Posts Per Page',    'name' => 'blog_posts_per_page', 'type' => 'number', 'default_value' => 12, 'min' => 6, 'max' => 24 ],
			[ 'key' => 'field_blog_show_sidebar',   'label' => 'Show Sidebar',      'name' => 'blog_show_sidebar',   'type' => 'true_false', 'default_value' => 1, 'ui' => 1 ],
			[ 'key' => 'field_blog_cta_enabled',    'label' => 'Show Sidebar CTA',  'name' => 'blog_cta_enabled',    'type' => 'true_false', 'default_value' => 1, 'ui' => 1 ],
			[ 'key' => 'field_blog_sidebar_cta_title', 'label' => 'Sidebar CTA Title', 'name' => 'blog_sidebar_cta_title', 'type' => 'text', 'default_value' => 'Get Your Free SEO Audit' ],
			[ 'key' => 'field_blog_sidebar_cta_desc',  'label' => 'Sidebar CTA Text',  'name' => 'blog_sidebar_cta_desc',  'type' => 'textarea', 'default_value' => "Find out exactly why your website isn't ranking and what to fix first." ],
		],
		'location' => [ [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'seoae-blog-settings' ] ] ],
	] );

	// Contact Settings fields
	acf_add_local_field_group( [
		'key'    => 'group_contact_settings',
		'title'  => 'Contact & Forms',
		'fields' => [
			[ 'key' => 'field_contact_hero_title',  'label' => 'Contact Hero Title',   'name' => 'contact_hero_title',  'type' => 'text',     'default_value' => "Let's Talk Growth" ],
			[ 'key' => 'field_contact_hero_desc',   'label' => 'Contact Hero Desc',    'name' => 'contact_hero_desc',   'type' => 'textarea', 'default_value' => "Ready to dominate your market? Fill in the form and our team will respond within 24 hours." ],
			[ 'key' => 'field_contact_wpforms_id',  'label' => 'WPForms Form ID',      'name' => 'contact_wpforms_id',  'type' => 'number',   'default_value' => 163, 'instructions' => 'ID of the WPForms form to display on the Contact page.' ],
			[ 'key' => 'field_contact_response_time','label' => 'Avg Response Time',   'name' => 'contact_response_time','type' => 'text',    'default_value' => '< 24 Hours' ],
			[ 'key' => 'field_contact_office_hours', 'label' => 'Office Hours',         'name' => 'contact_office_hours', 'type' => 'text',   'default_value' => 'Mon–Fri, 9am–6pm GST' ],
		],
		'location' => [ [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'seoae-contact-settings' ] ] ],
	] );
} );

// ─────────────────────────────────────────────────────────────────────────────
// 25. CONTACT FORM AJAX — save submissions to WP dashboard (custom post type)
// ─────────────────────────────────────────────────────────────────────────────

// Register Lead custom post type
add_action( 'init', function () {
	register_post_type( 'seoae_lead', [
		'labels'       => [
			'name'          => 'Leads',
			'singular_name' => 'Lead',
			'menu_name'     => '📥 Leads',
			'add_new_item'  => 'Add Lead',
			'view_item'     => 'View Lead',
			'search_items'  => 'Search Leads',
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_position' => 3,
		'menu_icon'     => 'dashicons-email-alt',
		'supports'      => [ 'title' ],
		'capabilities'  => [ 'create_posts' => 'do_not_allow' ],
		'map_meta_cap'  => true,
	] );
} );

// Handle contact form AJAX submission — save as Lead
// Handled by seoae_contact_handler (section 9) — CPT save added there
// (see above)
function seoae_handle_contact_form() {
	check_ajax_referer( 'seoae-nonce', 'nonce' );
	$name    = sanitize_text_field( $_POST['name']    ?? '' );
	$email   = sanitize_email(      $_POST['email']   ?? '' );
	$phone   = sanitize_text_field( $_POST['phone']   ?? '' );
	$company = sanitize_text_field( $_POST['company'] ?? '' );
	$service = sanitize_text_field( $_POST['service'] ?? '' );
	$message = sanitize_textarea_field( $_POST['message'] ?? '' );
	$audit   = sanitize_text_field( $_POST['audit']   ?? 'No' );

	if ( ! $name || ! $email || ! is_email( $email ) ) {
		wp_send_json_error( [ 'message' => 'Please fill in your name and a valid email address.' ] );
	}

	// Save as Lead post
	$lead_id = wp_insert_post( [
		'post_title'  => $name . ' — ' . $email,
		'post_type'   => 'seoae_lead',
		'post_status' => 'publish',
	] );
	if ( $lead_id ) {
		update_post_meta( $lead_id, 'lead_name',    $name );
		update_post_meta( $lead_id, 'lead_email',   $email );
		update_post_meta( $lead_id, 'lead_phone',   $phone );
		update_post_meta( $lead_id, 'lead_company', $company );
		update_post_meta( $lead_id, 'lead_service', $service );
		update_post_meta( $lead_id, 'lead_message', $message );
		update_post_meta( $lead_id, 'lead_audit',   $audit );
		update_post_meta( $lead_id, 'lead_date',    current_time( 'mysql' ) );
		update_post_meta( $lead_id, 'lead_status',  'New' );
		update_post_meta( $lead_id, 'lead_ip',      $_SERVER['REMOTE_ADDR'] ?? '' );
	}

	// Send admin notification email
	$to      = get_field( 'site_email', 'option' ) ?: get_option( 'admin_email' );
	$subject = "🎯 New SEO Lead: {$name} ({$service})";
	$body    = "New enquiry received:\n\n"
		. "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n"
		. "Company: {$company}\nService: {$service}\nFree Audit: {$audit}\n\n"
		. "Message:\n{$message}\n\n"
		. "View lead: " . admin_url( "post.php?post={$lead_id}&action=edit" );
	wp_mail( $to, $subject, $body, [ 'Content-Type: text/plain; charset=UTF-8' ] );

	wp_send_json_success( [ 'message' => 'Thank you! We\'ll respond within 24 hours.' ] );
}

// Show lead meta in admin edit screen
add_action( 'add_meta_boxes', function () {
	add_meta_box( 'seoae_lead_details', 'Lead Details', 'seoae_lead_meta_box', 'seoae_lead', 'normal', 'high' );
} );
function seoae_lead_meta_box( $post ) {
	$fields = [
		'lead_name'    => 'Name',
		'lead_email'   => 'Email',
		'lead_phone'   => 'Phone',
		'lead_company' => 'Company',
		'lead_service' => 'Service',
		'lead_audit'   => 'Free Audit?',
		'lead_status'  => 'Status',
		'lead_date'    => 'Submitted',
		'lead_ip'      => 'IP Address',
	];
	echo '<table style="width:100%;border-collapse:collapse;">';
	foreach ( $fields as $key => $label ) {
		$val = get_post_meta( $post->ID, $key, true );
		echo '<tr style="border-bottom:1px solid #f0f0f0;">';
		echo '<th style="text-align:left;padding:.5rem;width:140px;color:#666;font-weight:600;">' . esc_html( $label ) . '</th>';
		echo '<td style="padding:.5rem;">' . esc_html( $val ) . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	$msg = get_post_meta( $post->ID, 'lead_message', true );
	if ( $msg ) {
		echo '<h4 style="margin:1rem 0 .5rem;">Message</h4>';
		echo '<p style="background:#f9f9f9;padding:1rem;border-radius:4px;">' . esc_html( $msg ) . '</p>';
	}
}
