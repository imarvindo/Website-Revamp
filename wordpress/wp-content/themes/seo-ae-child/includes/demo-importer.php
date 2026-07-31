<?php
/**
 * SEO.ae Child Theme — Demo Content Importer
 *
 * Two integration modes:
 *  A) One Click Demo Import plugin active  → registers demo data automatically
 *  B) Plugin not present                  → built-in admin importer page
 *
 * Demo data files (in theme's /demo-data/ folder):
 *   content.xml   – WordPress export (WXR) — pages, posts, services, CPTs
 *   widgets.json  – Widget settings
 *   settings.json – Site settings, menus, Elementor data
 */

defined( 'ABSPATH' ) || exit;

/* ═══════════════════════════════════════════════════════════════════════════
   A) ONE CLICK DEMO IMPORT integration
═══════════════════════════════════════════════════════════════════════════ */

/**
 * Register demo data for OCDI plugin.
 * OCDI hook: https://github.com/proteusthemes/one-click-demo-import
 */
add_filter( 'ocdi/import_files', 'seoae_ocdi_import_files' );
function seoae_ocdi_import_files(): array {
    return [
        [
            'import_file_name'           => 'SearchEngineOptimization.ae — Full Demo',
            'local_import_file'          => get_stylesheet_directory() . '/demo-data/content.xml',
            'local_import_widget_file'   => get_stylesheet_directory() . '/demo-data/widgets.json',
            'import_preview_image_url'   => get_stylesheet_directory_uri() . '/demo-data/preview.jpg',
            'import_notice'              => __( 'The import process takes 1–2 minutes. Do not close this window. Images will be downloaded automatically from the internet after import.', 'seo-ae-child' ),
        ],
    ];
}

/**
 * Run post-import setup after OCDI finishes.
 */
add_action( 'ocdi/after_import', 'seoae_ocdi_after_import' );
function seoae_ocdi_after_import( $selected_import ): void {
    seoae_configure_after_import();
}

/* ═══════════════════════════════════════════════════════════════════════════
   B) BUILT-IN ADMIN IMPORTER  (used when OCDI is not installed)
═══════════════════════════════════════════════════════════════════════════ */

add_action( 'admin_menu', 'seoae_add_demo_import_page' );
function seoae_add_demo_import_page(): void {
    add_theme_page(
        __( 'Import Demo Content', 'seo-ae-child' ),
        __( '⬇ Import Demo',      'seo-ae-child' ),
        'manage_options',
        'seoae-demo-import',
        'seoae_demo_import_page'
    );
}

function seoae_demo_import_page(): void {
    $demo_dir   = get_stylesheet_directory() . '/demo-data/';
    $xml_exists = file_exists( $demo_dir . 'content.xml' );
    $done       = get_option( 'seoae_demo_imported' );
    ?>
    <style>
    .seoae-import-wrap{max-width:800px;margin:40px auto;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;}
    .seoae-import-hero{background:#0a2540;border-radius:12px;padding:48px 40px;color:#fff;text-align:center;margin-bottom:32px;}
    .seoae-import-hero h1{font-size:2rem;font-weight:800;margin:0 0 12px;color:#fff;}
    .seoae-import-hero p{font-size:1.05rem;opacity:.85;margin:0;}
    .seoae-import-preview{width:100%;max-width:680px;border-radius:8px;margin:24px 0 0;box-shadow:0 8px 32px rgba(0,0,0,.4);}
    .seoae-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:32px;}
    .seoae-step{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:20px;text-align:center;}
    .seoae-step-num{background:#00b4d8;color:#fff;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;margin:0 auto 10px;}
    .seoae-step h3{font-size:.9rem;font-weight:600;color:#0a2540;margin:0 0 6px;}
    .seoae-step p{font-size:.82rem;color:#64748b;margin:0;}
    .seoae-includes{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:24px;margin-bottom:28px;}
    .seoae-includes h3{font-size:1rem;font-weight:700;color:#0a2540;margin:0 0 14px;}
    .seoae-includes ul{columns:2;margin:0;padding:0 0 0 16px;color:#475569;font-size:.9rem;}
    .seoae-includes ul li{margin-bottom:5px;}
    .seoae-notice{padding:14px 18px;border-radius:8px;margin-bottom:20px;font-size:.9rem;}
    .seoae-notice--warn{background:#fef9c3;border:1px solid #fde047;color:#713f12;}
    .seoae-notice--success{background:#dcfce7;border:1px solid #86efac;color:#166534;}
    .seoae-notice--error{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;}
    #seoae-import-btn{background:#00b4d8;color:#fff;border:none;padding:16px 40px;font-size:1.05rem;font-weight:700;border-radius:8px;cursor:pointer;transition:opacity .2s;}
    #seoae-import-btn:hover{opacity:.88;}
    #seoae-import-btn:disabled{opacity:.5;cursor:not-allowed;}
    #seoae-progress{display:none;margin-top:24px;}
    .seoae-progress-bar{background:#e2e8f0;border-radius:999px;height:10px;overflow:hidden;margin-bottom:12px;}
    .seoae-progress-fill{background:#00b4d8;height:100%;width:0%;border-radius:999px;transition:width .4s;}
    #seoae-log{background:#0a2540;color:#a5f3fc;border-radius:8px;padding:16px;font-family:monospace;font-size:.82rem;line-height:1.7;max-height:240px;overflow-y:auto;white-space:pre-wrap;}
    </style>

    <div class="seoae-import-wrap">

        <div class="seoae-import-hero">
            <h1>🚀 SearchEngineOptimization.ae Demo Import</h1>
            <p>One click installs all pages, posts, menus, settings and Elementor layouts — exactly as you see in the demo.</p>
            <?php if ( file_exists( $demo_dir . 'preview.jpg' ) ) : ?>
            <img src="<?= esc_url( get_stylesheet_directory_uri() . '/demo-data/preview.jpg' ) ?>" class="seoae-import-preview" alt="Demo Preview">
            <?php endif; ?>
        </div>

        <div class="seoae-steps">
            <div class="seoae-step"><div class="seoae-step-num">1</div><h3>Install Plugins</h3><p>Use the "Install Plugins" notice to install Elementor &amp; ACF.</p></div>
            <div class="seoae-step"><div class="seoae-step-num">2</div><h3>Import Demo</h3><p>Click the button below to import all demo content automatically.</p></div>
            <div class="seoae-step"><div class="seoae-step-num">3</div><h3>Customise</h3><p>Edit any page visually with Elementor from Pages → Edit with Elementor.</p></div>
        </div>

        <div class="seoae-includes">
            <h3>📦 What gets imported</h3>
            <ul>
                <li>✅ Homepage (Elementor hero + stats + services)</li>
                <li>✅ About, Services, Contact, Careers, FAQ</li>
                <li>✅ 6 Service pages (SEO, PPC, Social, Web…)</li>
                <li>✅ 12 Dubai location pages</li>
                <li>✅ 9 Industry-specific SEO pages</li>
                <li>✅ 20 Blog posts with featured images</li>
                <li>✅ 5 Case study pages</li>
                <li>✅ 4 Portfolio project pages</li>
                <li>✅ Navigation menus (header + footer)</li>
                <li>✅ All Elementor page layouts &amp; global colours</li>
                <li>✅ Site title, tagline &amp; reading settings</li>
                <li>✅ Widget sidebar content</li>
            </ul>
        </div>

        <?php if ( $done ) : ?>
        <div class="seoae-notice seoae-notice--success">
            ✅ <strong>Demo already imported.</strong> Your site matches the demo. You can re-import to reset all content — this will overwrite existing posts and pages.
            <br><br><small>Last imported: <?= esc_html( $done ) ?></small>
        </div>
        <?php endif; ?>

        <?php if ( ! $xml_exists ) : ?>
        <div class="seoae-notice seoae-notice--error">
            ❌ Demo content file not found at <code>/demo-data/content.xml</code>. Please re-install the theme.
        </div>
        <?php else : ?>

        <div class="seoae-notice seoae-notice--warn">
            ⚠️ <strong>Important:</strong> The import will add or overwrite pages, posts and settings. Back up your site before proceeding if it has existing content you want to keep.
        </div>

        <?php
        // Check required plugins
        $missing = [];
        if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
            $missing[] = 'Elementor (required for page layouts)';
        }
        if ( ! class_exists( 'ACF' ) && ! function_exists( 'acf_register_block_type' ) ) {
            $missing[] = 'Advanced Custom Fields (required for service/team meta)';
        }
        if ( $missing ) : ?>
        <div class="seoae-notice seoae-notice--warn">
            ⚠️ <strong>Missing required plugins — install before importing:</strong><br>
            <?= implode( ', ', array_map( 'esc_html', $missing ) ) ?><br>
            <a href="<?= esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) ?>">→ Install plugins now</a>
        </div>
        <?php endif; ?>

        <p style="text-align:center;margin-top:8px;">
            <button id="seoae-import-btn" <?= $missing ? 'disabled title="Install required plugins first"' : '' ?>>
                <?= $done ? '🔄 Re-Import Demo Content' : '⬇ Import Demo Content' ?>
            </button>
        </p>

        <div id="seoae-progress">
            <div class="seoae-progress-bar"><div class="seoae-progress-fill" id="seoae-fill"></div></div>
            <pre id="seoae-log">Starting import…</pre>
        </div>

        <script>
        (function(){
            var btn   = document.getElementById('seoae-import-btn');
            var prog  = document.getElementById('seoae-progress');
            var fill  = document.getElementById('seoae-fill');
            var log   = document.getElementById('seoae-log');
            var steps = [
                {pct:5,  label:'Starting import…'},
                {pct:20, label:'Importing pages & posts (WXR)…', action:'wxr'},
                {pct:60, label:'Applying Elementor page layouts…', action:'elementor'},
                {pct:75, label:'Setting up navigation menus…',    action:'menus'},
                {pct:85, label:'Configuring widgets…',            action:'widgets'},
                {pct:95, label:'Applying site settings…',         action:'settings'},
                {pct:100,label:'✅ Import complete! Redirecting…', action:'done'},
            ];

            btn.addEventListener('click', function(){
                btn.disabled = true;
                prog.style.display = 'block';
                runStep(0);
            });

            function runStep(i){
                if(i >= steps.length) return;
                var s = steps[i];
                fill.style.width = s.pct + '%';
                log.textContent += '\n' + s.label;
                log.scrollTop = log.scrollHeight;

                if(!s.action){ setTimeout(function(){ runStep(i+1); }, 400); return; }
                if(s.action === 'done'){
                    setTimeout(function(){ window.location = '<?= admin_url( "?seoae_import_done=1" ) ?>'; }, 1500);
                    return;
                }

                fetch('<?= admin_url( "admin-ajax.php" ) ?>', {
                    method: 'POST',
                    headers: {'Content-Type':'application/x-www-form-urlencoded'},
                    body: 'action=seoae_demo_import&step=' + s.action + '&nonce=<?= wp_create_nonce( "seoae_demo_import" ) ?>'
                })
                .then(function(r){ return r.json(); })
                .then(function(res){
                    if(res.message) log.textContent += '\n   ' + res.message;
                    if(res.error)   log.textContent += '\n   ⚠ ' + res.error;
                    log.scrollTop = log.scrollHeight;
                    runStep(i+1);
                })
                .catch(function(e){ log.textContent += '\n   Error: '+e; runStep(i+1); });
            }
        })();
        </script>

        <?php endif; // xml_exists ?>
    </div>
    <?php
}

/* ═══════════════════════════════════════════════════════════════════════════
   AJAX HANDLERS — one per import step
═══════════════════════════════════════════════════════════════════════════ */

add_action( 'wp_ajax_seoae_demo_import', 'seoae_demo_import_ajax' );
function seoae_demo_import_ajax(): void {
    check_ajax_referer( 'seoae_demo_import', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Permission denied.' );
    }

    $step = sanitize_key( $_POST['step'] ?? '' );
    set_time_limit( 300 );

    switch ( $step ) {

        case 'wxr':
            wp_send_json( seoae_import_wxr() );
            break;

        case 'elementor':
            wp_send_json( seoae_import_elementor() );
            break;

        case 'menus':
            wp_send_json( seoae_import_menus() );
            break;

        case 'widgets':
            wp_send_json( seoae_import_widgets() );
            break;

        case 'settings':
            wp_send_json( seoae_import_settings() );
            break;

        default:
            wp_send_json( [ 'message' => 'Unknown step.' ] );
    }
}

/* ── Step: WXR import ──────────────────────────────────────────────────── */
function seoae_import_wxr(): array {
    $xml_file = get_stylesheet_directory() . '/demo-data/content.xml';
    if ( ! file_exists( $xml_file ) ) {
        return [ 'error' => 'content.xml not found.' ];
    }

    // Use WordPress Importer plugin if available
    if ( ! class_exists( 'WP_Import' ) ) {
        $importer_file = WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
        if ( file_exists( $importer_file ) ) {
            require_once $importer_file;
        } else {
            // Fallback: lightweight WXR parser
            return seoae_import_wxr_lite( $xml_file );
        }
    }

    if ( class_exists( 'WP_Import' ) ) {
        $importer                  = new WP_Import();
        $importer->fetch_attachments = true;

        ob_start();
        $importer->import( $xml_file );
        ob_end_clean();

        return [ 'message' => 'WXR imported via WordPress Importer.' ];
    }

    return seoae_import_wxr_lite( $xml_file );
}

/* ── Lightweight WXR parser (fallback when WP Importer not installed) ─── */
function seoae_import_wxr_lite( string $xml_file ): array {
    $xml = @simplexml_load_file( $xml_file, 'SimpleXMLElement', LIBXML_NOCDATA );
    if ( ! $xml ) {
        return [ 'error' => 'Could not parse content.xml — libxml may be missing.' ];
    }

    $ns      = $xml->getNamespaces( true );
    $channel = $xml->channel;
    $count   = 0;
    $skipped = 0;

    foreach ( $channel->item as $item ) {
        $wp   = $item->children( $ns['wp'] ?? '' );
        $dc   = $item->children( $ns['dc'] ?? '' );

        $post_type   = (string) $wp->post_type;
        $post_name   = (string) $wp->post_name;
        $post_status = (string) $wp->post_status;
        $post_id     = (int)    $wp->post_id;
        $title       = (string) $item->title;
        $content     = (string) $item->children( $ns['content'] ?? '' )->encoded ?? '';
        $excerpt     = (string) $item->children( $ns['excerpt'] ?? '' )->encoded ?? '';
        $pub_date    = (string) $item->pubDate;

        $allowed_types = [ 'post', 'page', 'service', 'case_study', 'portfolio_item', 'team_member', 'attachment' ];
        if ( ! in_array( $post_type, $allowed_types, true ) ) {
            continue;
        }
        if ( 'attachment' === $post_type ) {
            continue; // skip media — images referenced by Elementor will load from URLs
        }

        // Skip if slug already exists
        $existing = get_posts( [
            'name'           => $post_name,
            'post_type'      => $post_type,
            'post_status'    => 'any',
            'numberposts'    => 1,
            'fields'         => 'ids',
        ] );
        if ( $existing ) {
            $skipped++;
            continue;
        }

        $postarr = [
            'import_id'      => $post_id,
            'post_title'     => wp_slash( $title ),
            'post_name'      => $post_name,
            'post_content'   => wp_slash( $content ),
            'post_excerpt'   => wp_slash( $excerpt ),
            'post_type'      => $post_type,
            'post_status'    => $post_status,
            'post_date'      => $pub_date ? date( 'Y-m-d H:i:s', strtotime( $pub_date ) ) : current_time( 'mysql' ),
        ];

        $new_id = wp_insert_post( $postarr, false, false );
        if ( is_wp_error( $new_id ) ) continue;

        // Post meta
        foreach ( $wp->postmeta as $meta ) {
            $key   = (string) $meta->meta_key;
            $value = (string) $meta->meta_value;
            if ( str_starts_with( $key, '_' ) && ! in_array( $key, [
                '_wp_page_template', '_elementor_edit_mode', '_elementor_data',
                '_elementor_version', '_elementor_template_type', '_thumbnail_id',
                '_yoast_wpseo_title', '_yoast_wpseo_metadesc',
                'short_description', 'price_from',
            ], true ) ) {
                continue; // skip internal WP meta noise
            }
            update_post_meta( $new_id, $key, wp_slash( $value ) );
        }

        $count++;
    }

    return [ 'message' => "Imported $count posts/pages ($skipped skipped — already exist)." ];
}

/* ── Step: Elementor data ─────────────────────────────────────────────── */
function seoae_import_elementor(): array {
    $settings_file = get_stylesheet_directory() . '/demo-data/settings.json';
    if ( ! file_exists( $settings_file ) ) {
        return [ 'error' => 'settings.json not found.' ];
    }

    $data = json_decode( file_get_contents( $settings_file ), true );
    if ( empty( $data['elementor_pages'] ) ) {
        return [ 'message' => 'No Elementor page data found.' ];
    }

    $count = 0;
    foreach ( $data['elementor_pages'] as $page ) {
        $posts = get_posts( [
            'name'       => $page['post_name'],
            'post_type'  => $page['post_type'],
            'numberposts' => 1,
            'fields'     => 'ids',
        ] );
        if ( ! $posts ) continue;

        $id = $posts[0];
        update_post_meta( $id, '_elementor_data',          wp_slash( $page['el_data'] ) );
        update_post_meta( $id, '_elementor_edit_mode',     'builder' );
        update_post_meta( $id, '_elementor_version',       '3.0.0' );
        update_post_meta( $id, '_elementor_template_type', 'wp-page' );
        if ( $page['template'] ) {
            update_post_meta( $id, '_wp_page_template', $page['template'] );
        }
        $count++;
    }

    // Restore Elementor global kit colours
    if ( ! empty( $data['settings']['elementor_active_kit'] ) ) {
        $kit_id       = (int) $data['settings']['elementor_active_kit'];
        $kit_settings = get_post_meta( $kit_id, '_elementor_page_settings', true ) ?: [];
        $kit_settings['system_colors'] = [
            [ '_id' => 'primary',   'title' => 'Primary',   'color' => '#00b4d8' ],
            [ '_id' => 'secondary', 'title' => 'Secondary', 'color' => '#0a2540' ],
            [ '_id' => 'text',      'title' => 'Text',      'color' => '#1e293b' ],
            [ '_id' => 'accent',    'title' => 'Accent',    'color' => '#16b1d4' ],
        ];
        update_post_meta( $kit_id, '_elementor_page_settings', $kit_settings );
    }

    return [ 'message' => "Applied Elementor layouts to $count pages." ];
}

/* ── Step: navigation menus ───────────────────────────────────────────── */
function seoae_import_menus(): array {
    $settings_file = get_stylesheet_directory() . '/demo-data/settings.json';
    if ( ! file_exists( $settings_file ) ) {
        return [ 'error' => 'settings.json not found.' ];
    }

    $data  = json_decode( file_get_contents( $settings_file ), true );
    $menus = $data['menus'] ?? [];
    $count = 0;

    foreach ( $menus as $name => $menu_data ) {
        $menu_obj = wp_get_nav_menu_object( $menu_data['slug'] );
        if ( ! $menu_obj ) {
            $menu_id = wp_create_nav_menu( $name );
            if ( is_wp_error( $menu_id ) ) continue;
        } else {
            $menu_id = $menu_obj->term_id;
        }

        // Clear existing items and rebuild
        $existing_items = wp_get_nav_menu_items( $menu_id );
        if ( $existing_items ) {
            foreach ( $existing_items as $ei ) {
                wp_delete_post( $ei->ID, true );
            }
        }

        foreach ( $menu_data['items'] ?? [] as $item ) {
            $url = $item['url'] ?? '#';
            // Replace localhost with current site URL
            $url = str_replace(
                [ 'http://localhost:8000', 'https://localhost:8000' ],
                untrailingslashit( home_url() ),
                $url
            );

            wp_update_nav_menu_item( $menu_id, 0, [
                'menu-item-title'   => $item['title'],
                'menu-item-url'     => $url,
                'menu-item-status'  => 'publish',
                'menu-item-type'    => 'custom',
            ] );
        }
        $count++;
    }

    // Assign menus to locations
    $locations  = $data['settings']['nav_menu_locations'] ?? [];
    if ( $locations ) {
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    return [ 'message' => "Created $count navigation menus." ];
}

/* ── Step: widgets ────────────────────────────────────────────────────── */
function seoae_import_widgets(): array {
    $widget_file = get_stylesheet_directory() . '/demo-data/widgets.json';
    if ( ! file_exists( $widget_file ) ) {
        return [ 'message' => 'No widget data found (skipped).' ];
    }

    $data = json_decode( file_get_contents( $widget_file ), true );
    $sidebar_data = $data['sidebars_widgets'] ?? null;
    $widget_list  = $data['widgets'] ?? [];

    if ( $sidebar_data ) {
        update_option( 'sidebars_widgets', $sidebar_data );
    }

    foreach ( $widget_list as $sidebar_id => $widgets ) {
        foreach ( $widgets as $widget ) {
            $id_base  = $widget['id_base']  ?? '';
            $instance = $widget['instance'] ?? [];
            if ( ! $id_base ) continue;

            $existing = get_option( "widget_$id_base" );
            if ( ! is_array( $existing ) ) $existing = [];
            $num = ( count( $existing ) + 1 );
            $existing[ $num ] = $instance;
            update_option( "widget_$id_base", $existing );
        }
    }

    return [ 'message' => 'Widgets restored.' ];
}

/* ── Step: site settings ──────────────────────────────────────────────── */
function seoae_import_settings(): array {
    $settings_file = get_stylesheet_directory() . '/demo-data/settings.json';
    if ( ! file_exists( $settings_file ) ) {
        return [ 'error' => 'settings.json not found.' ];
    }

    $data     = json_decode( file_get_contents( $settings_file ), true );
    $settings = $data['settings'] ?? [];

    if ( $settings['blogname'] )        update_option( 'blogname',        $settings['blogname'] );
    if ( $settings['blogdescription'] ) update_option( 'blogdescription', $settings['blogdescription'] );
    if ( $settings['seoae_site_phone'] ) update_option( 'seoae_site_phone', $settings['seoae_site_phone'] );

    seoae_configure_after_import();

    return [ 'message' => 'Site settings and reading options configured.' ];
}

/* ─────────────────────────────────────────────────────────────────────── */

/** Shared post-import configuration — sets homepage, blog page, flush rewrite. */
function seoae_configure_after_import(): void {
    // Homepage
    $front = get_page_by_path( 'home' ) ?: get_posts( [ 'post_type' => 'page', 'name' => 'home', 'numberposts' => 1 ] )[0] ?? null;
    if ( ! $front ) {
        // try by title
        $pages = get_posts( [ 'post_type' => 'page', 'post_status' => 'publish', 'numberposts' => -1 ] );
        foreach ( $pages as $p ) {
            if ( strtolower( $p->post_title ) === 'home' || strtolower( $p->post_name ) === 'home' ) {
                $front = $p; break;
            }
        }
    }
    if ( $front ) {
        update_option( 'show_on_front',  'page' );
        update_option( 'page_on_front',  $front->ID );
    }

    // Blog page
    $blog = get_page_by_path( 'blog' );
    if ( $blog ) {
        update_option( 'page_for_posts', $blog->ID );
    }

    // Record import timestamp
    update_option( 'seoae_demo_imported', current_time( 'mysql' ) );

    // Flush rewrite rules
    flush_rewrite_rules();
}

/* ─────────────────────────────────────────────────────────────────────── */

/** Admin notice after import completes */
add_action( 'admin_notices', function () {
    if ( ! isset( $_GET['seoae_import_done'] ) ) return;
    ?>
    <div class="notice notice-success is-dismissible">
        <p>✅ <strong>Demo imported successfully!</strong>
        <a href="<?= esc_url( home_url( '/' ) ) ?>" target="_blank">View your site →</a>
        &nbsp;|&nbsp;
        <a href="<?= esc_url( admin_url( 'edit.php?post_type=page' ) ) ?>">Manage pages</a>
        </p>
    </div>
    <?php
} );
