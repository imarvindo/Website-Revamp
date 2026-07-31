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
