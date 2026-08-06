<?php
/**
 * SEO Growth layer — conversion, EEAT, auto-indexing, linking helpers.
 *
 * Implements foundations for the UAE SEO expansion roadmap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** WhatsApp business number (international, digits only). Override via filter. */
function seoae_whatsapp_number(): string {
	return apply_filters( 'seoae_whatsapp_number', '918010355718' );
}

/** Public phone display. */
function seoae_phone_display(): string {
	$phone = function_exists( 'seoae_phone' ) ? seoae_phone() : '';
	return apply_filters( 'seoae_phone_display', $phone );
}

// ─────────────────────────────────────────────────────────────────────────────
// A. AUTO INDEXING — IndexNow + sitemap ping on publish/update/delete
// ─────────────────────────────────────────────────────────────────────────────

/**
 * IndexNow API key (Rank Math setting, with fallback).
 */
function seoae_indexnow_key(): string {
	$opts = get_option( 'rank-math-options-instant-indexing', [] );
	$key  = is_array( $opts ) ? (string) ( $opts['indexnow_api_key'] ?? '' ) : '';
	if ( $key === '' ) {
		$key = (string) get_option( 'seoae_indexnow_key', '' );
	}
	return preg_replace( '/[^a-f0-9]/i', '', $key );
}

/**
 * Submit URL list to IndexNow (+ Bing).
 *
 * @param string[] $urls Absolute URLs.
 * @param string   $reason Log label.
 */
function seoae_indexnow_submit_urls( array $urls, string $reason = 'auto' ): void {
	$urls = array_values( array_unique( array_filter( array_map( 'esc_url_raw', $urls ) ) ) );
	if ( ! $urls ) {
		return;
	}

	$key = seoae_indexnow_key();
	if ( $key === '' ) {
		return;
	}

	$host = wp_parse_url( home_url(), PHP_URL_HOST );
	$payload = [
		'host'        => $host,
		'key'         => $key,
		'keyLocation' => home_url( "/{$key}.txt" ),
		'urlList'     => $urls,
	];

	$log = get_option( 'seoae_indexnow_log', [] );
	if ( ! is_array( $log ) ) {
		$log = [];
	}

	foreach ( [ 'https://api.indexnow.org/indexnow', 'https://www.bing.com/indexnow' ] as $endpoint ) {
		$response = wp_remote_post(
			$endpoint,
			[
				'timeout' => 20,
				'headers' => [ 'Content-Type' => 'application/json; charset=utf-8' ],
				'body'    => wp_json_encode( $payload ),
			]
		);
		$code = is_wp_error( $response ) ? 0 : (int) wp_remote_retrieve_response_code( $response );
		$log[] = [
			'time'   => time(),
			'reason' => $reason,
			'endpoint' => $endpoint,
			'code'   => $code,
			'count'  => count( $urls ),
			'url'    => $urls[0] . ( count( $urls ) > 1 ? ' [+' . ( count( $urls ) - 1 ) . ']' : '' ),
		];
	}

	// Keep last 100 entries.
	update_option( 'seoae_indexnow_log', array_slice( $log, -100 ), false );

	// Mirror into Rank Math log when present.
	$rm_log = get_option( 'rank_math_indexnow_log', [] );
	if ( is_array( $rm_log ) ) {
		$rm_log[] = [
			'url'               => $urls[0] . ( count( $urls ) > 1 ? ' [+' . ( count( $urls ) - 1 ) . ']' : '' ),
			'status'            => 200,
			'manual_submission' => false,
			'message'           => 'OK via seoae auto (' . $reason . ')',
			'time'              => time(),
		];
		update_option( 'rank_math_indexnow_log', array_slice( $rm_log, -50 ), false );
	}
}

/**
 * Ping sitemap consumers after content changes.
 */
function seoae_ping_sitemaps(): void {
	$sitemap = home_url( '/sitemap_index.xml' );
	// Best-effort (Google deprecated ping; still useful for some crawlers / logs).
	wp_remote_get( 'https://www.google.com/ping?sitemap=' . rawurlencode( $sitemap ), [ 'timeout' => 10, 'blocking' => false ] );
	wp_remote_get( 'https://www.bing.com/ping?sitemap=' . rawurlencode( $sitemap ), [ 'timeout' => 10, 'blocking' => false ] );

	// Resubmit to GSC when Rank Math Google API is available.
	if ( class_exists( '\RankMath\Google\Api' ) && class_exists( '\RankMath\Google\Authentication' )
		&& \RankMath\Google\Authentication::is_authorized() ) {
		$api  = \RankMath\Google\Api::get();
		$prof = get_option( 'rank_math_google_analytic_profile', [] );
		$site = is_array( $prof ) && ! empty( $prof['profile'] ) ? $prof['profile'] : 'sc-domain:searchengineoptimization.ae';
		$api->add_sitemap( $site, $sitemap );
	}
}

/**
 * Should this post type be auto-submitted?
 */
function seoae_indexable_post_type( string $post_type ): bool {
	$types = apply_filters(
		'seoae_indexable_post_types',
		[ 'post', 'page', 'service', 'case_study', 'portfolio_item' ]
	);
	return in_array( $post_type, $types, true );
}

add_action( 'transition_post_status', function ( string $new, string $old, $post ) {
	if ( ! $post instanceof WP_Post ) {
		return;
	}
	if ( ! seoae_indexable_post_type( $post->post_type ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( wp_is_post_revision( $post->ID ) ) {
		return;
	}

	$url = get_permalink( $post );
	if ( ! $url || is_wp_error( $url ) ) {
		return;
	}

	if ( 'publish' === $new && 'publish' !== $old ) {
		seoae_indexnow_submit_urls( [ $url ], 'publish' );
		seoae_ping_sitemaps();
	} elseif ( 'publish' === $new && 'publish' === $old ) {
		seoae_indexnow_submit_urls( [ $url ], 'update' );
		seoae_ping_sitemaps();
	} elseif ( 'publish' !== $new && 'publish' === $old ) {
		seoae_indexnow_submit_urls( [ $url ], 'unpublish' );
		seoae_ping_sitemaps();
	}
}, 20, 3 );

add_action( 'before_delete_post', function ( int $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post || ! seoae_indexable_post_type( $post->post_type ) ) {
		return;
	}
	if ( 'publish' !== $post->post_status ) {
		return;
	}
	$url = get_permalink( $post );
	if ( $url && ! is_wp_error( $url ) ) {
		seoae_indexnow_submit_urls( [ $url ], 'delete' );
		seoae_ping_sitemaps();
	}
} );

// ─────────────────────────────────────────────────────────────────────────────
// B. MID-CONTENT CTAs (every ~350 words on long singular content)
// ─────────────────────────────────────────────────────────────────────────────

add_filter( 'the_content', function ( $content ) {
	if ( is_admin() || ! is_singular() || ! is_main_query() || ! is_string( $content ) ) {
		return $content;
	}
	if ( is_front_page() ) {
		return $content;
	}

	$post_type = get_post_type();
	if ( ! in_array( $post_type, [ 'post', 'page', 'service', 'case_study' ], true ) ) {
		return $content;
	}

	// Avoid double-inject when content already has CTA markers.
	if ( strpos( $content, 'seoae-inline-cta' ) !== false ) {
		return $content;
	}

	$words = str_word_count( wp_strip_all_tags( $content ) );
	if ( $words < 500 ) {
		return $content;
	}

	$cta = '<aside class="seoae-inline-cta" role="complementary">'
		. '<p class="seoae-inline-cta__eyebrow">Free UAE SEO Audit</p>'
		. '<p class="seoae-inline-cta__text">Want a data-backed growth plan for your Dubai or UAE market? Our strategists map keywords, competitors, and quick wins in one call.</p>'
		. '<p class="seoae-inline-cta__actions">'
		. '<a class="btn btn--primary btn--sm" href="' . esc_url( home_url( '/contact/' ) ) . '">Book Free Audit</a> '
		. '<a class="btn btn--outline btn--sm" href="https://wa.me/' . esc_attr( seoae_whatsapp_number() ) . '" target="_blank" rel="noopener">WhatsApp Us</a>'
		. '</p></aside>';

	// Insert after roughly every 3rd paragraph block beyond the first screen.
	$parts = preg_split( '/(<\/p>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE );
	if ( ! $parts || count( $parts ) < 8 ) {
		return $content . $cta;
	}

	$out           = '';
	$p_count       = 0;
	$insert_every  = 4; // ~ every 4 closed paragraphs ≈ 300–400 words of dense copy
	$inserts       = 0;
	$max_inserts   = 3;

	for ( $i = 0, $n = count( $parts ); $i < $n; $i++ ) {
		$out .= $parts[ $i ];
		if ( isset( $parts[ $i ] ) && preg_match( '/<\/p>/i', $parts[ $i ] ) ) {
			++$p_count;
			if ( $p_count >= 3 && ( $p_count % $insert_every ) === 0 && $inserts < $max_inserts ) {
				$out .= $cta;
				++$inserts;
			}
		}
	}

	return $out;
}, 12 );

// ─────────────────────────────────────────────────────────────────────────────
// C. SPEAKABLE + EEAT meta (visible last updated)
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'wp_head', function () {
	if ( ! is_singular() ) {
		return;
	}
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post ) {
		return;
	}

	$url   = get_permalink( $post );
	$title = wp_strip_all_tags( get_the_title( $post ) );
	$css_sel = is_singular( 'post' ) ? '.post-body, .entry-content' : '.post-body, .service-body, .entry-content, article';

	$speakable = [
		'@context'        => 'https://schema.org',
		'@type'           => 'WebPage',
		'@id'             => $url . '#speakable',
		'name'            => $title,
		'url'             => $url,
		'speakable'       => [
			'@type'       => 'SpeakableSpecification',
			'cssSelector' => [ 'h1', $css_sel ],
		],
		'datePublished'   => get_the_date( 'c', $post ),
		'dateModified'    => get_the_modified_date( 'c', $post ),
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $speakable, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 25 );

/**
 * Render EEAT byline strip (author + dates).
 */
function seoae_eeat_byline( ?WP_Post $post = null ): void {
	$post = $post ?: get_post();
	if ( ! $post ) {
		return;
	}
	$author = get_the_author_meta( 'display_name', (int) $post->post_author );
	if ( ! $author ) {
		$author = 'SearchEngineOptimization.ae Team';
	}
	$published = get_the_date( 'M j, Y', $post );
	$updated   = get_the_modified_date( 'M j, Y', $post );
	?>
	<div class="seoae-eeat" aria-label="Content credentials">
		<span class="seoae-eeat__item"><strong>Author:</strong> <?php echo esc_html( $author ); ?></span>
		<span class="seoae-eeat__sep" aria-hidden="true">·</span>
		<span class="seoae-eeat__item"><strong>Published:</strong> <time datetime="<?php echo esc_attr( get_the_date( 'c', $post ) ); ?>"><?php echo esc_html( $published ); ?></time></span>
		<span class="seoae-eeat__sep" aria-hidden="true">·</span>
		<span class="seoae-eeat__item"><strong>Updated:</strong> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c', $post ) ); ?>"><?php echo esc_html( $updated ); ?></time></span>
		<span class="seoae-eeat__sep" aria-hidden="true">·</span>
		<span class="seoae-eeat__item"><strong>Reviewed by:</strong> SEO Strategy Team</span>
	</div>
	<?php
}

// ─────────────────────────────────────────────────────────────────────────────
// D. INTERNAL LINKING HELPERS
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Related case studies for a service/industry context.
 *
 * @return WP_Post[]
 */
function seoae_related_case_studies( int $limit = 3 ): array {
	$q = new WP_Query( [
		'post_type'      => 'case_study',
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	] );
	return $q->posts ?: [];
}

/**
 * Render a compact related-links module (services / industries / locations / cases).
 */
function seoae_related_links_module( string $heading = 'Explore related growth resources' ): void {
	$services = function_exists( 'seoae_get_services' ) ? seoae_get_services() : [];
	$cases    = seoae_related_case_studies( 3 );
	$links    = [
		[ 'label' => 'SEO Services Dubai', 'url' => home_url( '/services/search-engine-optimization/' ) ],
		[ 'label' => 'AI Search Optimisation', 'url' => home_url( '/services/ai-search-optimization/' ) ],
		[ 'label' => 'PPC Management', 'url' => home_url( '/services/ppc-management/' ) ],
		[ 'label' => 'Dubai SEO Hub', 'url' => home_url( '/dubai/' ) ],
		[ 'label' => 'All Locations', 'url' => home_url( '/locations/' ) ],
		[ 'label' => 'Industries', 'url' => home_url( '/industries/' ) ],
		[ 'label' => 'Case Studies', 'url' => home_url( '/case-studies/' ) ],
		[ 'label' => 'Blog Insights', 'url' => home_url( '/blog/' ) ],
		[ 'label' => 'Contact / Free Audit', 'url' => home_url( '/contact/' ) ],
		[ 'label' => 'About the Agency', 'url' => home_url( '/about/' ) ],
	];
	foreach ( array_slice( $services, 0, 4 ) as $svc ) {
		$links[] = [ 'label' => get_the_title( $svc ), 'url' => get_permalink( $svc ) ];
	}
	foreach ( $cases as $cs ) {
		$links[] = [ 'label' => get_the_title( $cs ), 'url' => get_permalink( $cs ) ];
	}
	// Dedupe by URL.
	$seen = [];
	$uniq = [];
	foreach ( $links as $item ) {
		$u = (string) $item['url'];
		if ( isset( $seen[ $u ] ) ) {
			continue;
		}
		$seen[ $u ] = true;
		$uniq[]     = $item;
	}
	$uniq = array_slice( $uniq, 0, 16 );
	?>
	<section class="seoae-related-links section bg-light">
		<div class="container">
			<h2 class="seoae-related-links__title"><?php echo esc_html( $heading ); ?></h2>
			<ul class="seoae-related-links__list">
				<?php foreach ( $uniq as $item ) : ?>
				<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php
}

// ─────────────────────────────────────────────────────────────────────────────
// E. STICKY CTA + WHATSAPP FLOAT (sitewide)
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'wp_footer', function () {
	if ( is_admin() ) {
		return;
	}
	$wa  = seoae_whatsapp_number();
	?>
	<div class="seoae-sticky-cta" id="seoae-sticky-cta" hidden>
		<div class="seoae-sticky-cta__inner">
			<span class="seoae-sticky-cta__copy">Free SEO audit for UAE businesses</span>
			<div class="seoae-sticky-cta__actions">
				<a class="seoae-sticky-cta__btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get Free Audit</a>
			</div>
			<button type="button" class="seoae-sticky-cta__close" id="seoae-sticky-close" aria-label="Dismiss sticky bar">×</button>
		</div>
	</div>
	<a class="seoae-wa-float" href="https://wa.me/<?php echo esc_attr( $wa ); ?>?text=<?php echo rawurlencode( 'Hi — I want a free SEO audit for my UAE business.' ); ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
		<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.5 0 .16 5.34.16 11.9c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.65a11.86 11.86 0 005.76 1.47h.01c6.56 0 11.9-5.34 11.9-11.9 0-3.18-1.24-6.17-3.45-8.44zM12.07 21.8h-.01a9.87 9.87 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.64-.24-.37a9.86 9.86 0 01-1.51-5.27c0-5.45 4.43-9.88 9.9-9.88 2.64 0 5.12 1.03 6.98 2.9a9.82 9.82 0 012.91 6.98c0 5.45-4.44 9.87-9.9 9.87zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.04-.17-.3-.02-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.07-.8.37-.27.3-1.05 1.02-1.05 2.5s1.08 2.9 1.23 3.1c.15.2 2.12 3.24 5.14 4.54 1.92.83 2.67.9 3.63.76.58-.08 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35z"/></svg>
	</a>
	<script>
	(function(){
	  var bar = document.getElementById('seoae-sticky-cta');
	  var closeBtn = document.getElementById('seoae-sticky-close');
	  if (!bar) return;
	  if (sessionStorage.getItem('seoae_sticky_dismissed') === '1') return;
	  function show(){
	    if (window.scrollY > 480) { bar.hidden = false; bar.classList.add('is-visible'); }
	  }
	  window.addEventListener('scroll', show, {passive:true});
	  show();
	  closeBtn && closeBtn.addEventListener('click', function(){
	    bar.hidden = true;
	    sessionStorage.setItem('seoae_sticky_dismissed','1');
	  });
	})();
	</script>
	<?php
}, 40 );
