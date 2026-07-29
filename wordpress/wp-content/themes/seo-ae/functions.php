<?php
/**
 * SearchEngineOptimization.ae Enterprise Theme — functions.php
 * Core setup, CPTs, ACF fields, menus, scripts
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SEOAE_VERSION', '1.0.0' );
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
			[ 'key' => 'field_site_maps_url','label' => 'Google Maps URL', 'name' => 'site_maps_url','type' => 'url' ],
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
		$faqs = get_field( 'page_faqs' ) ?: [];
		if ( empty( $faqs ) && is_single() ) {
			$faqs = get_field( 'article_faqs' ) ?: [];
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
// 6. ORGANIZATION SCHEMA
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'wp_head', function () {
	if ( ! is_front_page() ) return;
	$phone   = '';
	$email   = function_exists( 'get_field' ) ? get_field( 'site_email', 'option' )   : 'sales@searchengineoptimization.ae';
	$address = function_exists( 'get_field' ) ? get_field( 'site_address', 'option' ) : 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE';

	$schema = [
		'@context' => 'https://schema.org',
		'@type'    => ['Organization','LocalBusiness','ProfessionalService'],
		'name'     => 'SearchEngineOptimization.ae',
		'alternateName' => 'SearchEngineOptimization.ae',
		'url'      => home_url(),
		'logo'     => SEOAE_URI . '/assets/images/logo.svg',
		'image'    => SEOAE_URI . '/assets/images/og-image.jpg',
		'description' => "Dubai's #1 enterprise SEO and digital marketing agency — delivering measurable growth through AI-driven SEO, PPC, social media, and web development.",
		'email'       => $email,
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
		'sameAs'       => array_filter( [
			function_exists('get_field') ? get_field('social_linkedin','option') : '',
			function_exists('get_field') ? get_field('social_instagram','option') : '',
			function_exists('get_field') ? get_field('social_facebook','option') : '',
		]),
	];

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
	return ''; // Phone number removed per business requirements
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

	// Save to DB
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

// Create contacts table on theme activation
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
// 10. ADMIN CUSTOMIZATIONS
// ─────────────────────────────────────────────────────────────────────────────
// Custom admin menu order
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', function( $menu_ord ) {
	if ( ! $menu_ord ) return true;
	return [
		'index.php',
		'separator1',
		'edit.php?post_type=service',
		'edit.php?post_type=case_study',
		'edit.php?post_type=portfolio_item',
		'edit.php?post_type=testimonial',
		'edit.php?post_type=team_member',
		'separator2',
		'edit.php',
		'edit.php?post_type=page',
		'separator-last',
		'seoae-theme-settings',
	];
} );

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
