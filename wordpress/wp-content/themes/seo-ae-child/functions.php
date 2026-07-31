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
}, 20 );

// ── 2. Child-theme safety: re-define constants if parent didn't load ─────────
if ( ! defined( 'SEOAE_VERSION' ) ) { define( 'SEOAE_VERSION', '1.0.0' ); }
if ( ! defined( 'SEOAE_DIR' ) )     { define( 'SEOAE_DIR',     get_template_directory() ); }
if ( ! defined( 'SEOAE_URI' ) )     { define( 'SEOAE_URI',     get_template_directory_uri() ); }

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
        'telephone'   => '+971 4 320 9898',
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
        [ 'name' => 'Dubai',             'url' => '/seo-company-dubai/',            'searches' => '18M+' ],
        [ 'name' => 'Abu Dhabi',         'url' => '/seo-company-abu-dhabi/',        'searches' => '6M+'  ],
        [ 'name' => 'Sharjah',           'url' => '/seo-company-sharjah/',          'searches' => '4M+'  ],
        [ 'name' => 'Ajman',             'url' => '/seo-company-ajman/',            'searches' => '1.5M+'],
        [ 'name' => 'Ras Al Khaimah',    'url' => '/seo-company-ras-al-khaimah/',   'searches' => '1.2M+'],
        [ 'name' => 'Fujairah',          'url' => '/seo-company-fujairah/',         'searches' => '900K+'],
        [ 'name' => 'Umm Al Quwain',     'url' => '/seo-company-umm-al-quwain/',   'searches' => '400K+'],
        [ 'name' => 'Al Ain',            'url' => '/seo-company-al-ain/',           'searches' => '2M+'  ],
        [ 'name' => 'Dubai Marina',      'url' => '/seo-company-dubai-marina/',     'searches' => '2.5M+'],
        [ 'name' => 'Business Bay',      'url' => '/seo-company-business-bay/',     'searches' => '3M+'  ],
        [ 'name' => 'Deira',             'url' => '/seo-company-deira/',            'searches' => '2.8M+'],
        [ 'name' => 'Downtown Dubai',    'url' => '/seo-company-downtown-dubai/',   'searches' => '3.5M+'],
        [ 'name' => 'Jebel Ali',         'url' => '/seo-company-jebel-ali/',        'searches' => '1.8M+'],
        [ 'name' => 'Khor Fakkan',       'url' => '/seo-company-khor-fakkan/',      'searches' => '200K+'],
        [ 'name' => 'Dibba Al Fujairah', 'url' => '/seo-company-dibba-al-fujairah/','searches' => '180K+'],
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
      <h2 style="font-size:1.5rem;font-weight:800;color:var(--color-heading);margin-bottom:.5rem;">We Deliver This Service Across All UAE Emirates &amp; Districts</h2>
      <p style="color:var(--color-body);font-size:.9375rem;max-width:560px;">From Dubai\'s hypercompetitive commercial market to Fujairah\'s port-city sector — the same service, tuned to your local market.</p>
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
