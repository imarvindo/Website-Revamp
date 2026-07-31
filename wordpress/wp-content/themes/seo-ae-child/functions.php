<?php
/**
 * SearchEngineOptimization.ae — Child Theme Functions
 *
 * The parent theme (seo-ae) loads its functions.php first automatically.
 * This file adds child-specific behaviour and Elementor enhancements.
 */

// ── 1. Enqueue parent + child stylesheets ────────────────────────────────────
add_action( 'wp_enqueue_scripts', function () {
    // Parent stylesheet (already enqueued by parent, but we ensure correct dependency)
    wp_enqueue_style(
        'seo-ae-parent',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme( 'seo-ae' )->get( 'Version' )
    );

    // Child stylesheet overrides
    wp_enqueue_style(
        'seo-ae-child',
        get_stylesheet_directory_uri() . '/style.css',
        [ 'seo-ae-parent' ],
        wp_get_theme()->get( 'Version' )
    );
}, 20 );

// ── 2. Elementor compatibility ───────────────────────────────────────────────

/**
 * Allow Elementor to use the full page width (no sidebar padding).
 */
add_action( 'elementor/theme/register_conditions', function ( $conditions_manager ) {
    // Elementor handles its own width; nothing extra needed here.
} );

/**
 * Tell Elementor to hide the default WordPress title on Elementor-built pages.
 */
add_filter( 'the_title', function ( $title ) {
    if (
        is_singular() &&
        \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() )
    ) {
        // Title is rendered inside the Elementor layout; suppress the WP default
        if ( in_the_loop() ) {
            return '';
        }
    }
    return $title;
} );

/**
 * Add Elementor support: ensure parent theme body class is still applied.
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

// ── 3. Elementor global colours & fonts (matches brand palette) ──────────────
add_action( 'elementor/element/kit/section_buttons/before_section_end', function ( $element, $args ) {
    // Brand colours are defined in parent theme CSS variables; Elementor picks them up
    // via var(--color-primary) etc. No extra registration needed for free version.
}, 10, 2 );

// ── 4. Child-theme safety: re-define constants if parent didn't load ─────────
if ( ! defined( 'SEOAE_VERSION' ) ) {
    define( 'SEOAE_VERSION', '1.0.0' );
}
if ( ! defined( 'SEOAE_DIR' ) ) {
    define( 'SEOAE_DIR', get_template_directory() );
}
if ( ! defined( 'SEOAE_URI' ) ) {
    define( 'SEOAE_URI', get_template_directory_uri() );
}

// ── 5. Admin notice: confirm child theme is active ───────────────────────────
add_action( 'admin_notices', function () {
    if ( get_stylesheet() !== 'seo-ae-child' ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    // Only show once
    $shown = get_transient( 'seoae_child_notice_shown' );
    if ( $shown ) return;
    set_transient( 'seoae_child_notice_shown', 1, WEEK_IN_SECONDS );
    echo '<div class="notice notice-success is-dismissible">
        <p><strong>✅ SEO.ae Child Theme active.</strong> All future customisations are safely stored here — parent theme updates will never overwrite them. Elementor is ready to use on any page.</p>
    </div>';
} );
