<?php
/**
 * Required & Recommended Plugin Registration (via TGM Plugin Activation)
 *
 * Loaded from child theme functions.php. Shows an admin notice after theme
 * activation listing every plugin needed to replicate the demo exactly.
 */

if ( ! function_exists( 'seoae_register_required_plugins' ) ) :

require_once get_stylesheet_directory() . '/includes/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'seoae_register_required_plugins' );

function seoae_register_required_plugins(): void {

    $plugins = [

        /* ── REQUIRED ─────────────────────────────────────────────────────────── */

        [
            'name'     => 'Elementor',
            'slug'     => 'elementor',
            'required' => true,
        ],
        [
            'name'     => 'Advanced Custom Fields (ACF)',
            'slug'     => 'advanced-custom-fields',
            'required' => true,
        ],

        /* ── RECOMMENDED ──────────────────────────────────────────────────────── */

        [
            'name'     => 'WPForms Lite',
            'slug'     => 'wpforms-lite',
            'required' => false,
        ],
        [
            'name'     => 'Yoast SEO',
            'slug'     => 'wordpress-seo',
            'required' => false,
        ],
        [
            'name'     => 'One Click Demo Import',
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],

    ];

    $config = [
        'id'           => 'seo-ae-child',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'strings'      => [
            'page_title'                      => __( 'Install Required Plugins', 'seo-ae-child' ),
            'menu_title'                      => __( 'Install Plugins', 'seo-ae-child' ),
            'installing'                      => __( 'Installing Plugin: %s', 'seo-ae-child' ),
            'updating'                        => __( 'Updating Plugin: %s', 'seo-ae-child' ),
            'oops'                            => __( 'Something went wrong with the plugin API.', 'seo-ae-child' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'seo-ae-child'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'seo-ae-child'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'seo-ae-child'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'seo-ae-child'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'seo-ae-child'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'seo-ae-child'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'seo-ae-child'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'seo-ae-child'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'seo-ae-child'
            ),
            'return'                          => __( 'Return to Required Plugins Installer', 'seo-ae-child' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'seo-ae-child' ),
            'activated_successfully'          => __( 'The following plugin was activated successfully:', 'seo-ae-child' ),
            'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'seo-ae-child' ),
            'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'seo-ae-child' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'seo-ae-child' ),
            'dismiss'                         => __( 'Dismiss this notice', 'seo-ae-child' ),
            'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'seo-ae-child' ),
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'seo-ae-child' ),
            'nag_type'                        => 'notice-info',
        ],
    ];

    tgmpa( $plugins, $config );
}

endif;
