<?php
/**
 * Shared conversion-focused layout blocks for the child theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve a strong visual for a service/page.
 */
function seoae_rh_visual_url( $post_id = 0 ): string {
	$post_id = $post_id ?: get_the_ID();
	if ( $post_id && has_post_thumbnail( $post_id ) ) {
		$url = get_the_post_thumbnail_url( $post_id, 'large' );
		if ( $url ) {
			return $url;
		}
	}

	$slug = $post_id ? (string) get_post_field( 'post_name', $post_id ) : '';
	$map  = [
		'search-engine-optimization'     => 'seo-analytics.jpg',
		'technical-seo'                  => 'data-analytics.jpg',
		'local-seo'                      => 'dubai-business.jpg',
		'link-building'                  => 'link-building.jpg',
		'ecommerce-seo'                  => 'digital-marketing.jpg',
		'seo-audit'                      => 'content-strategy.jpg',
		'chatgpt-seo'                    => 'ai-search.jpg',
		'generative-engine-optimization' => 'ai-search.jpg',
		'google-business-profile-seo'    => 'office.jpg',
		'ai-search-optimization'         => 'ai-search.jpg',
		'social-media-marketing'         => 'social-media.jpg',
		'ppc-management'                 => 'digital-marketing.jpg',
		'web-design'                     => 'team-meeting.jpg',
		'web-development'                => 'office.jpg',
		'about'                          => 'team-meeting.jpg',
		'services'                       => 'seo-analytics.jpg',
		'contact'                        => 'dubai-business.jpg',
	];
	$file = $map[ $slug ] ?? 'team-meeting.jpg';
	$path = WP_CONTENT_DIR . '/uploads/2026/07/' . $file;
	if ( ! file_exists( $path ) ) {
		$file = 'seo-analytics.jpg';
	}
	return content_url( 'uploads/2026/07/' . $file );
}

/**
 * High-visibility mid-page CTA band.
 *
 * @param array $args {
 *   @type string $eyebrow
 *   @type string $title
 *   @type string $text
 *   @type string $primary_label
 *   @type string $primary_url
 *   @type string $secondary_label
 *   @type string $secondary_url
 *   @type string $image
 *   @type string $variant  band|split|compact
 * }
 */
function seoae_rh_cta_band( array $args = [] ): void {
	$a = wp_parse_args(
		$args,
		[
			'eyebrow'          => 'Free strategy call',
			'title'            => 'Ready to turn search into revenue?',
			'text'             => 'Get a free audit with clear opportunities, priorities, and next steps — no lock-in, no fluff.',
			'primary_label'    => 'Get Free SEO Audit',
			'primary_url'      => home_url( '/contact/' ),
			'secondary_label'  => 'Email Our Team',
			'secondary_url'    => 'mailto:' . ( function_exists( 'seoae_email' ) ? seoae_email() : 'sales@searchengineoptimization.ae' ),
			'image'            => '',
			'variant'          => 'band',
		]
	);
	$variant = in_array( $a['variant'], [ 'band', 'split', 'compact' ], true ) ? $a['variant'] : 'band';
	?>
	<section class="rh-section rh-convert rh-convert--<?php echo esc_attr( $variant ); ?>">
		<div class="rh-wrap">
			<div class="rh-convert__panel" data-reveal>
				<?php if ( $a['image'] && $variant === 'split' ) : ?>
					<figure class="rh-convert__media">
						<img src="<?php echo esc_url( $a['image'] ); ?>" alt="" loading="lazy" decoding="async" width="720" height="480">
					</figure>
				<?php endif; ?>
				<div class="rh-convert__copy">
					<span class="rh-eyebrow"><?php echo function_exists( 'rh_icon' ) ? rh_icon( 'rocket', 14 ) : ''; ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
					<h2 class="rh-convert__title"><?php echo esc_html( $a['title'] ); ?></h2>
					<p class="rh-convert__text"><?php echo esc_html( $a['text'] ); ?></p>
					<div class="rh-convert__actions">
						<a class="rh-btn rh-btn--primary" href="<?php echo esc_url( $a['primary_url'] ); ?>">
							<?php echo function_exists( 'rh_icon' ) ? rh_icon( 'rocket', 18 ) : ''; ?>
							<?php echo esc_html( $a['primary_label'] ); ?>
						</a>
						<?php if ( $a['secondary_label'] && $a['secondary_url'] ) : ?>
							<a class="rh-btn rh-btn--ghost" href="<?php echo esc_url( $a['secondary_url'] ); ?>">
								<?php echo esc_html( $a['secondary_label'] ); ?>
							</a>
						<?php endif; ?>
					</div>
					<ul class="rh-convert__proof">
						<li>Response within 24 hours</li>
						<li>No lock-in contracts</li>
						<li>Senior strategist review</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Image + content split section.
 */
function seoae_rh_image_split( array $args = [] ): void {
	$a = wp_parse_args(
		$args,
		[
			'eyebrow' => 'What you get',
			'title'   => 'A clear plan. Measurable growth.',
			'text'    => '',
			'points'  => [],
			'image'   => '',
			'reverse' => false,
			'cta'     => 'Book Free Audit',
			'cta_url' => home_url( '/contact/' ),
		]
	);
	?>
	<section class="rh-section rh-split<?php echo ! empty( $a['reverse'] ) ? ' rh-split--rev' : ''; ?>">
		<div class="rh-wrap">
			<div class="rh-split__grid">
				<figure class="rh-split__media" data-reveal>
					<?php if ( $a['image'] ) : ?>
						<img src="<?php echo esc_url( $a['image'] ); ?>" alt="<?php echo esc_attr( $a['title'] ); ?>" loading="lazy" decoding="async" width="800" height="560">
					<?php endif; ?>
				</figure>
				<div class="rh-split__copy" data-reveal data-reveal-delay="1">
					<span class="rh-eyebrow"><?php echo function_exists( 'rh_icon' ) ? rh_icon( 'target', 14 ) : ''; ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
					<h2 class="rh-h2"><?php echo esc_html( $a['title'] ); ?></h2>
					<?php if ( $a['text'] ) : ?>
						<p class="rh-lead"><?php echo esc_html( $a['text'] ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $a['points'] ) ) : ?>
						<ul class="rh-split__list">
							<?php foreach ( $a['points'] as $point ) : ?>
								<li><?php echo function_exists( 'rh_icon' ) ? rh_icon( 'check', 18 ) : ''; ?><span><?php echo wp_kses_post( $point ); ?></span></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<a class="rh-btn rh-btn--primary" href="<?php echo esc_url( $a['cta_url'] ); ?>">
						<?php echo function_exists( 'rh_icon' ) ? rh_icon( 'arrow', 18 ) : ''; ?>
						<?php echo esc_html( $a['cta'] ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Trust / proof stats strip.
 */
function seoae_rh_stats_strip( array $stats = [] ): void {
	if ( ! $stats ) {
		$stats = [
			[ '345+', 'Clients served' ],
			[ '+206%', 'Avg organic growth' ],
			[ '99%', 'Client retention' ],
			[ '24h', 'Audit turnaround' ],
		];
	}
	?>
	<section class="rh-stats-strip" aria-label="Key results">
		<div class="rh-wrap">
			<div class="rh-stats-strip__grid">
				<?php foreach ( $stats as $stat ) : ?>
					<div class="rh-stats-strip__item" data-reveal>
						<strong><?php echo esc_html( $stat[0] ); ?></strong>
						<span><?php echo esc_html( $stat[1] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Sticky mobile/desktop conversion bar.
 */
function seoae_rh_sticky_cta( array $args = [] ): void {
	$a = wp_parse_args(
		$args,
		[
			'label'   => 'Get Free SEO Audit',
			'url'     => home_url( '/contact/' ),
			'subtext' => 'Talk to a senior strategist — free, no obligation',
		]
	);
	?>
	<div class="rh-sticky-cta" data-rh-sticky-cta hidden>
		<div class="rh-sticky-cta__inner">
			<div class="rh-sticky-cta__copy">
				<strong><?php echo esc_html( $a['label'] ); ?></strong>
				<span><?php echo esc_html( $a['subtext'] ); ?></span>
			</div>
			<a class="rh-btn rh-btn--primary" href="<?php echo esc_url( $a['url'] ); ?>"><?php echo esc_html( $a['label'] ); ?></a>
		</div>
	</div>
	<?php
}
