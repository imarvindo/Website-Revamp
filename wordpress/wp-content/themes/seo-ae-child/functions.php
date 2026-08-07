<?php
/**
 * SearchEngineOptimization.ae — Child Theme Functions
 *
 * Load order:
 *  1. Parent theme (seo-ae) functions.php  — loaded by WordPress automatically
 *  2. This file                             — child-theme additions
 *
 * Includes:
 *  • TGM Plugin Activation   → admin notice listing required/recommended plugins
 *  • Demo Importer           → Appearance → Import Demo one-click importer
 */

// ── 1. Enqueue parent + child stylesheets ────────────────────────────────────
add_action( 'wp_enqueue_scripts', function () {
    // Parent main stylesheet
    wp_enqueue_style(
        'seo-ae-parent',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme( 'seo-ae' )->get( 'Version' )
    );

    // Child-theme overrides (Elementor compatibility, minor tweaks)
    wp_enqueue_style(
        'seo-ae-child',
        get_stylesheet_directory_uri() . '/style.css',
        [ 'seo-ae-parent' ],
        wp_get_theme()->get( 'Version' )
    );

    // ── Redesign assets (homepage + single service pages) ───────────────────
    if ( is_front_page() || is_singular( 'service' ) ) {
        wp_enqueue_style(
            'seoae-inter',
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
            [],
            null
        );
        $rh_dir = get_stylesheet_directory() . '/assets/';
        $rh_uri = get_stylesheet_directory_uri() . '/assets/';
        wp_enqueue_style(
            'seoae-home-redesign',
            $rh_uri . 'redesign-home.css',
            [ 'seo-ae-child' ],
            file_exists( $rh_dir . 'redesign-home.css' ) ? filemtime( $rh_dir . 'redesign-home.css' ) : '1.0.0'
        );
        wp_enqueue_script(
            'seoae-home-redesign',
            $rh_uri . 'redesign-home.js',
            [],
            file_exists( $rh_dir . 'redesign-home.js' ) ? filemtime( $rh_dir . 'redesign-home.js' ) : '1.0.0',
            true
        );
    }
}, 20 );

// ── 2. Child-theme safety: re-define constants if parent didn't load ─────────
if ( ! defined( 'SEOAE_VERSION' ) ) { define( 'SEOAE_VERSION', '1.0.0' ); }
if ( ! defined( 'SEOAE_DIR' ) )     { define( 'SEOAE_DIR',     get_template_directory() ); }
if ( ! defined( 'SEOAE_URI' ) )     { define( 'SEOAE_URI',     get_template_directory_uri() ); }

// ── 2b. Shared inline-SVG icon helper for redesigned templates ───────────────
if ( ! function_exists( 'rh_icon' ) ) {
	function rh_icon( $name, $s = 24 ) {
		$p = [
			'search'  => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
			'gauge'   => '<path d="M12 14 4 6"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
			'target'  => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
			'rocket'  => '<path d="M4.5 16.5 3 21l4.5-1.5"/><path d="M15 9a3 3 0 1 0-3 3"/><path d="M9 15c-2 0-5 2-6 6 4-1 6-4 6-6z"/><path d="M13 19 22 10c1-1 1-6 1-8-2 0-7 0-8 1L6 12z"/>',
			'chart'   => '<path d="M3 3v18h18"/><path d="m7 14 3-4 3 3 5-7"/>',
			'trend'   => '<path d="m3 17 6-6 4 4 8-8"/><path d="M17 7h4v4"/>',
			'ai'      => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3"/><rect x="7" y="7" width="10" height="10" rx="3"/><circle cx="12" cy="12" r="1.5"/>',
			'ppc'     => '<path d="M3 3l7 17 2-7 7-2z"/>',
			'social'  => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/>',
			'design'  => '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 9h18M8 4v5"/>',
			'code'    => '<path d="m8 8-4 4 4 4M16 8l4 4-4 4M13 6l-2 12"/>',
			'link'    => '<path d="M10 13a5 5 0 0 0 7 0l2-2a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-2 2a5 5 0 0 0 7 7l1-1"/>',
			'check'   => '<path d="M20 6 9 17l-5-5"/>',
			'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
			'arrowdr' => '<path d="M7 7h10v10M7 17 17 7"/>',
			'shield'  => '<path d="M12 3 4 6v6c0 5 3.5 7.5 8 9 4.5-1.5 8-4 8-9V6z"/><path d="m9 12 2 2 4-4"/>',
			'users'   => '<circle cx="9" cy="8" r="3"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M16 6a3 3 0 0 1 0 6M21 20a6 6 0 0 0-4-5.6"/>',
			'report'  => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/>',
			'brain'   => '<path d="M9 3a3 3 0 0 0-3 3 3 3 0 0 0-1 5 3 3 0 0 0 2 5 3 3 0 0 0 4 1V4a3 3 0 0 0-2-1zM15 3a3 3 0 0 1 3 3 3 3 0 0 1 1 5 3 3 0 0 1-2 5 3 3 0 0 1-4 1"/>',
			'eye'     => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>',
			'coins'   => '<ellipse cx="8" cy="6" rx="5" ry="2.5"/><path d="M3 6v6c0 1.4 2.2 2.5 5 2.5"/><ellipse cx="16" cy="14" rx="5" ry="2.5"/><path d="M11 14v4c0 1.4 2.2 2.5 5 2.5s5-1.1 5-2.5v-4"/>',
			'bolt'    => '<path d="M13 2 4 14h6l-1 8 9-12h-6z"/>',
			'plus'    => '<path d="M12 5v14M5 12h14"/>',
			'mail'    => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
			'pin'     => '<path d="M12 21s7-6.5 7-11a7 7 0 1 0-14 0c0 4.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
			'star'    => '<path d="m12 3 2.9 6 6.6.9-4.8 4.6 1.2 6.5L12 18.6 6.1 21.9l1.2-6.5L2.5 9.9 9.1 9z"/>',
			'clock'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
			'globe'   => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 2.5 15 0 18M12 3c-2.5 2.5-2.5 15 0 18"/>',
		];
		$d = isset( $p[ $name ] ) ? $p[ $name ] : $p['check'];
		return '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
	}
}

// ── 3. TGM Plugin Activation — required / recommended plugins ────────────────
require_once get_stylesheet_directory() . '/includes/required-plugins.php';

// ── 4. Demo Content Importer ─────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/includes/demo-importer.php';

// ── 5. Elementor compatibility ───────────────────────────────────────────────

/**
 * Hide WP default page title on Elementor-built pages.
 * The title is rendered inside the Elementor layout itself.
 */
add_filter( 'the_title', function ( $title ) {
    if (
        is_singular() &&
        in_the_loop() &&
        class_exists( '\Elementor\Plugin' ) &&
        \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() )
    ) {
        return '';
    }
    return $title;
} );

/**
 * Add body class on Elementor pages so CSS targets are available.
 */
add_filter( 'body_class', function ( $classes ) {
    if (
        is_singular() &&
        class_exists( '\Elementor\Plugin' ) &&
        \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() )
    ) {
        $classes[] = 'elementor-built';
    }
    return $classes;
} );

// ── 6. Admin notice: confirm child theme is active (shown once) ───────────────
add_action( 'admin_notices', function () {
    if ( get_stylesheet() !== 'seo-ae-child' ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( get_transient( 'seoae_child_activated_notice' ) ) return;
    set_transient( 'seoae_child_activated_notice', 1, WEEK_IN_SECONDS );
    ?>
    <div class="notice notice-success is-dismissible">
        <p>
            <strong>✅ SearchEngineOptimization.ae Child Theme activated.</strong>
            Go to <a href="<?= esc_url( admin_url( 'themes.php?page=seoae-demo-import' ) ) ?>">
            <strong>Appearance → Import Demo</strong></a> to import the full demo content in one click.
            &nbsp;|&nbsp;
            <a href="<?= esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) ?>">Install required plugins</a>
        </p>
    </div>
    <?php
} );

// ═══════════════════════════════════════════════════════════════════════════
// CHILD THEME SEO ENHANCEMENTS — Schema + Internal Linking
// ═══════════════════════════════════════════════════════════════════════════

// ── 1. Service schema on every service single page ───────────────────────
add_action( 'wp_head', function () {
    if ( ! is_singular( 'service' ) ) return;
    global $post;
    $title = get_the_title( $post );
    $desc  = get_post_meta( $post->ID, 'short_description', true )
           ?: wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post ) ?: $post->post_content ), 35 );
    $url   = get_permalink( $post );
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        '@id'         => $url . '#service',
        'name'        => $title,
        'description' => $desc,
        'url'         => $url,
        'provider'    => [ '@id' => home_url() . '/#organization' ],
        'areaServed'  => [
            [ '@type' => 'Country',  'name' => 'United Arab Emirates' ],
            [ '@type' => 'City',     'name' => 'Dubai' ],
            [ '@type' => 'City',     'name' => 'Abu Dhabi' ],
        ],
        'serviceType' => $title,
        'offers'      => [
            '@type'       => 'Offer',
            'priceCurrency' => 'AED',
            'availability' => 'https://schema.org/InStock',
            'url'         => $url,
        ],
    ];
    echo '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )
        . '</script>' . "\n";
}, 25 );

// ── 2. City-scoped LocalBusiness schema on location & district pages ──────
add_action( 'wp_head', function () {
    if ( ! is_page() ) return;
    $tpl  = get_page_template_slug();
    $slug = get_post_field( 'post_name', get_queried_object_id() );
    if ( ! in_array( $tpl, [ 'page-location.php', 'page-district.php' ], true ) ) return;
    if ( $slug === 'seo-company-dubai' ) return; // Dubai has its own schema in page-dubai.php

    $city = ( function_exists( 'get_field' ) ? get_field( 'location_city' ) : '' ) ?: get_the_title();
    $url  = get_permalink();
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => [ 'LocalBusiness', 'ProfessionalService', 'MarketingAgency' ],
        '@id'         => $url . '#localbusiness',
        'name'        => 'SearchEngineOptimization.ae — ' . $city . ' SEO',
        'url'         => $url,
        'email'       => 'sales@searchengineoptimization.ae',
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai',
            'addressLocality' => 'Dubai',
            'addressRegion'   => 'Dubai',
            'addressCountry'  => 'AE',
        ],
        'areaServed'  => [ '@type' => 'City', 'name' => $city ],
        'description' => 'Award-winning SEO and digital marketing agency serving businesses in ' . $city . ', UAE.',
        'priceRange'  => '$$$$',
        'openingHours' => 'Mo-Fr 09:00-18:00',
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '127',
            'bestRating'  => '5',
        ],
        'parentOrganization' => [ '@id' => home_url() . '/#organization' ],
    ];
    echo '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )
        . '</script>' . "\n";
}, 26 );

// ── 3. "We Serve All UAE Emirates" internal links appended to service pages
add_filter( 'the_content', function ( $content ) {
    if ( ! is_singular( 'service' ) ) return $content;

    $locations = [
        [ 'name' => 'Dubai',          'url' => '/dubai/',              'searches' => 'High intent' ],
        [ 'name' => 'Abu Dhabi',      'url' => '/seo-abu-dhabi/',      'searches' => 'Capital market' ],
        [ 'name' => 'Sharjah',        'url' => '/seo-sharjah/',        'searches' => 'SME growth' ],
        [ 'name' => 'Ajman',          'url' => '/seo-ajman/',          'searches' => 'Local demand' ],
        [ 'name' => 'Ras Al Khaimah', 'url' => '/seo-ras-al-khaimah/', 'searches' => 'Tourism + trade' ],
        [ 'name' => 'Fujairah',       'url' => '/seo-fujairah/',       'searches' => 'Port economy' ],
        [ 'name' => 'All Locations',  'url' => '/locations/',          'searches' => 'UAE coverage' ],
        [ 'name' => 'Industries',     'url' => '/industries/',         'searches' => 'Sector SEO' ],
        [ 'name' => 'Real Estate',    'url' => '/real-estate/',        'searches' => 'Property leads' ],
        [ 'name' => 'Healthcare',     'url' => '/healthcare/',         'searches' => 'Patient acquisition' ],
        [ 'name' => 'Legal',          'url' => '/legal/',              'searches' => 'Law firm growth' ],
        [ 'name' => 'Ecommerce',      'url' => '/ecommerce/',          'searches' => 'Online sales' ],
        [ 'name' => 'Finance',        'url' => '/finance/',            'searches' => 'Fintech + banking' ],
        [ 'name' => 'Hospitality',    'url' => '/hospitality/',        'searches' => 'Hotel bookings' ],
        [ 'name' => 'Case Studies',   'url' => '/case-studies/',       'searches' => 'Proven results' ],
    ];

    $cards = '';
    foreach ( $locations as $loc ) {
        $cards .= '<a href="' . esc_url( home_url( $loc['url'] ) ) . '" class="uae-card" style="text-decoration:none;">'
            . '<div class="uae-card__arrow"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg></div>'
            . '<h3 class="uae-card__city">' . esc_html( $loc['name'] ) . '</h3>'
            . '<span class="uae-card__badge">' . esc_html( $loc['searches'] ) . ' monthly searches</span>'
            . '</a>';
    }

    $section = '
<section class="section bg-white" style="padding:3.5rem 0;border-top:1px solid var(--color-border);">
  <div class="container">
    <div class="section-header" style="margin-bottom:2rem;">
      <span class="section-label">UAE Coverage</span>
      <h2 style="font-size:1.5rem;font-weight:800;color:var(--color-heading);margin-bottom:.5rem;">We Deliver This Service Across UAE Cities and Industries</h2>
      <p style="color:var(--color-body);font-size:.9375rem;max-width:560px;">From Dubai\'s competitive commercial market to Fujairah\'s port economy, the same service standards adapted to your local audience and sector.</p>
    </div>
    <div class="uae-grid" style="grid-template-columns:repeat(5,1fr);">' . $cards . '
    </div>
    <p style="margin-top:2rem;font-size:.875rem;color:var(--color-body);">
      Not sure which location service fits you? <a href="' . esc_url( home_url( '/contact/' ) ) . '" style="color:var(--color-primary);font-weight:700;">Contact us for a free local SEO audit →</a>
    </p>
  </div>
</section>';

    return $content . $section;
}, 20 );
