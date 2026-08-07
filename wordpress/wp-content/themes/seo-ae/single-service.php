<?php
/**
 * Single Service Page Template
 */

// ── FAQPage JSON-LD schema ────────────────────────────────────────────────────
// Must be registered before get_header() fires wp_head().
$_svc_faqs = get_post_meta( get_queried_object_id(), 'svc_faqs', true ) ?: [];
if ( ! empty( $_svc_faqs ) ) {
	add_action( 'wp_head', function() use ( $_svc_faqs ) {
		$entities = [];
		foreach ( $_svc_faqs as $faq ) {
			$q = isset( $faq['question'] ) ? trim( $faq['question'] ) : '';
			$a = isset( $faq['answer'] )   ? trim( strip_tags( $faq['answer'] ) ) : '';
			if ( $q && $a ) {
				$entities[] = [
					'@type'          => 'Question',
					'name'           => $q,
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ],
				];
			}
		}
		if ( ! empty( $entities ) ) {
			$schema = [
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $entities,
			];
			echo '<script type="application/ld+json">'
				. wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT )
				. '</script>' . "\n";
		}
	}, 20 );
}
// ─────────────────────────────────────────────────────────────────────────────

get_header();
while ( have_posts() ) : the_post();
$short_desc     = get_post_meta( get_the_ID(), 'short_description', true ) ?: get_the_excerpt();
$category_lbl   = get_post_meta( get_the_ID(), 'category_label',    true ) ?: 'Digital Marketing';
$hero_badge     = get_post_meta( get_the_ID(), 'hero_badge',        true ) ?: 'Premium';
$hero_badge_sub = get_post_meta( get_the_ID(), 'hero_badge_sub',  true ) ?: 'Results Driven';
$cta_primary    = get_post_meta( get_the_ID(), 'cta_primary_text',  true ) ?: 'Start Your Campaign';
$icon_svg       = get_post_meta( get_the_ID(), 'icon_svg',          true ) ?: '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>';
$benefits       = get_post_meta( get_the_ID(), 'svc_benefits',    true ) ?: [];
$process        = get_post_meta( get_the_ID(), 'svc_process',     true ) ?: [];
$technologies   = get_post_meta( get_the_ID(), 'svc_technologies',true ) ?: [];
$faqs           = get_post_meta( get_the_ID(), 'svc_faqs',        true ) ?: [];
$related_ids    = get_post_meta( get_the_ID(), 'svc_related',     true ) ?: [];
$related        = array_filter( array_map( 'get_post', (array) $related_ids ) );

// Reading time + author (CMS-editable scalars; ACF Free safe).
$word_count   = str_word_count( wp_strip_all_tags( get_the_content() ) );
$reading_time = (int) ( get_post_meta( get_the_ID(), 'svc_reading_time', true ) ?: 0 );
if ( $reading_time < 1 ) {
	$reading_time = max( 1, (int) ceil( $word_count / 220 ) );
}
$author_name = get_post_meta( get_the_ID(), 'svc_author_name', true ) ?: 'SearchEngineOptimization.ae Team';
$author_role = get_post_meta( get_the_ID(), 'svc_author_role', true ) ?: 'SEO Strategists';

// Build TOC from H2 headings in content (and named page sections).
$content_raw = get_the_content();
$content_raw = apply_filters( 'the_content', $content_raw );
$toc_items   = [];
$content_toc = preg_replace_callback(
	'/<h2([^>]*)>(.*?)<\/h2>/is',
	static function ( $m ) use ( &$toc_items ) {
		$text = trim( wp_strip_all_tags( $m[2] ) );
		if ( $text === '' ) {
			return $m[0];
		}
		$id = sanitize_title( $text );
		// Keep unique IDs if headings collide.
		$base = $id;
		$n    = 2;
		while ( isset( $toc_items[ $id ] ) ) {
			$id = $base . '-' . $n++;
		}
		$toc_items[ $id ] = $text;
		$attrs = $m[1];
		if ( stripos( $attrs, 'id=' ) === false ) {
			$attrs .= ' id="' . esc_attr( $id ) . '"';
		}
		return '<h2' . $attrs . '>' . $m[2] . '</h2>';
	},
	$content_raw
);
if ( $process ) {
	$toc_items['how-we-deliver-results'] = 'How We Deliver Results';
}
if ( $faqs ) {
	$toc_items['service-faqs'] = 'Frequently Asked Questions';
}
$show_toc = count( $toc_items ) >= 3;
?>

<!-- SERVICE HERO -->
<section class="service-hero hero-dark">
	<div class="container service-hero__inner">
		<div>
			<?php echo do_shortcode( '[seoae_breadcrumbs]' ); ?>
			<div class="service-hero__badge-pill"><?php echo esc_html( $category_lbl ); ?></div>
			<h1 class="service-hero__title"><?php the_title(); ?></h1>
			<p class="service-hero__desc"><?php echo esc_html( $short_desc ); ?></p>
			<div class="service-hero__byline">
				<div class="service-hero__author-avatar" aria-hidden="true"><?php echo esc_html( strtoupper( substr( $author_name, 0, 1 ) ) ); ?></div>
				<div>
					<p class="service-hero__author-name"><?php echo esc_html( $author_name ); ?></p>
					<p class="service-hero__author-meta"><?php echo esc_html( $author_role ); ?> · <?php echo esc_html( (string) $reading_time ); ?> min read</p>
				</div>
			</div>
			<div class="service-hero__actions">
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--primary btn--lg"><?php echo esc_html( $cta_primary ); ?> →</a>
				<a href="mailto:<?php echo esc_attr( seoae_email() ); ?>" class="btn btn--outline-white btn--lg">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
					Email Us
				</a>
			</div>
		</div>
		<div class="service-hero__card">
			<div class="service-hero__card-top">
				<div class="service-hero__card-icon"><?= $icon_svg ?></div>
				<div>
					<p class="service-hero__card-name"><?php echo esc_html( $hero_badge ); ?></p>
					<p class="service-hero__card-sub"><?php echo esc_html( $hero_badge_sub ); ?></p>
				</div>
			</div>
			<?php if ( $benefits ) : ?>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.6rem;">
				<?php foreach ( array_slice( $benefits, 0, 5 ) as $b ) : ?>
				<li style="display:flex;align-items:center;gap:.6rem;font-size:.85rem;color:rgba(255,255,255,.8);">
					<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
					<?php echo esc_html( $b['benefit'] ?? $b ); ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- WHY IT MATTERS / FULL DESCRIPTION -->
<?php if ( get_the_content() ) : ?>
<section class="section section--after-hero bg-white">
	<div class="container">
		<div style="display:grid;grid-template-columns:1fr 320px;gap:2.5rem;align-items:start;" class="svc-body-grid">
			<div class="post-content">
				<?php if ( $show_toc ) : ?>
				<nav class="svc-toc" aria-label="Table of contents">
					<p class="svc-toc__title">On this page</p>
					<ol class="svc-toc__list">
						<?php foreach ( $toc_items as $id => $label ) : ?>
						<li><a href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></a></li>
						<?php endforeach; ?>
					</ol>
				</nav>
				<?php endif; ?>
				<?php echo $content_toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- filtered content with injected heading IDs ?>
			</div>
			<?php if ( $benefits ) : ?>
			<div class="card svc-benefits-card">
				<h3 style="font-size:1.1rem;margin-bottom:1rem;">What You Get</h3>
				<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.65rem;">
					<?php foreach ( $benefits as $b ) : ?>
					<li style="display:flex;align-items:center;gap:.6rem;font-size:.875rem;color:var(--color-body);">
						<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="m9 12 2 2 4-4"/></svg>
						<?php echo esc_html( $b['benefit'] ?? $b ); ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- PROCESS -->
<?php if ( $process ) : ?>
<section class="section process-section" id="how-we-deliver-results">
	<div class="container">
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
			<div>
				<?php seoae_section_label( 'Our Process' ); ?>
				<h2 style="margin-bottom:1rem;">How We Deliver Results</h2>
				<p style="color:var(--color-body);margin-bottom:2rem;">A proven methodology built on transparency, data, and relentless execution.</p>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--secondary">Start Your Project →</a>
			</div>
			<div class="process-steps">
				<?php $i = 1; foreach ( $process as $step ) : ?>
				<div class="process-step">
					<div class="process-step__num"><?php echo $i++; ?></div>
					<div class="process-step__body">
						<h3 class="process-step__title"><?php echo esc_html( $step['step_title'] ?? '' ); ?></h3>
						<p class="process-step__desc"><?php echo esc_html( $step['step_desc'] ?? '' ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- TECHNOLOGIES -->
<?php if ( $technologies ) : ?>
<section class="section bg-white" style="padding:2.5rem 0;">
	<div class="container">
		<h3 style="font-size:1rem;font-weight:700;color:var(--color-heading);margin-bottom:1rem;text-transform:uppercase;letter-spacing:.07em;">Tools &amp; Technologies</h3>
		<div class="tech-badges">
			<?php foreach ( $technologies as $t ) : ?>
			<span class="tech-badge"><?php echo esc_html( $t['tech_name'] ?? $t ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- FAQs -->
<?php if ( $faqs ) : ?>
<section class="section faq-section" id="service-faqs">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label( 'FAQ' ); ?>
			<h2 class="section-header__title">Frequently Asked Questions</h2>
			<p class="section-header__desc">Everything you need to know about our <?php the_title(); ?> services.</p>
		</div>
		<div class="faq-list">
			<?php foreach ( $faqs as $faq ) : ?>
			<div class="faq-item">
				<button class="faq-question" aria-expanded="false">
					<?php echo esc_html( $faq['question'] ); ?>
					<div class="faq-icon" aria-hidden="true">
						<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
					</div>
				</button>
				<div class="faq-answer" aria-hidden="true">
					<div class="faq-answer__inner"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- RELATED SERVICES -->
<?php if ( $related ) : ?>
<section class="section bg-white" style="padding:3rem 0;">
	<div class="container">
		<h3 style="font-size:1.1rem;font-weight:700;color:var(--color-heading);margin-bottom:1.5rem;">Related Services</h3>
		<div class="services-grid">
			<?php foreach ( $related as $svc ) :
				$svc_short = get_post_meta( $svc->ID, 'short_description', true ) ?: wp_trim_words( $svc->post_excerpt, 15 );
			?>
			<a href="<?php echo esc_url( get_permalink( $svc ) ); ?>" class="service-card">
				<h3 class="service-card__title"><?php echo esc_html( $svc->post_title ); ?></h3>
				<p class="service-card__desc"><?php echo esc_html( $svc_short ); ?></p>
				<span class="service-card__link">Learn More →</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- RELATED CASE STUDIES -->
<?php
$rel_cases = function_exists( 'seoae_related_case_studies' ) ? seoae_related_case_studies( 3 ) : [];
if ( $rel_cases ) :
?>
<section class="section bg-light" style="padding:3rem 0;">
	<div class="container">
		<h3 style="font-size:1.1rem;font-weight:700;color:var(--color-heading);margin-bottom:1.5rem;">Related Case Studies</h3>
		<div class="services-grid">
			<?php foreach ( $rel_cases as $cs ) : ?>
			<a href="<?php echo esc_url( get_permalink( $cs ) ); ?>" class="service-card">
				<h3 class="service-card__title"><?php echo esc_html( get_the_title( $cs ) ); ?></h3>
				<p class="service-card__desc"><?php echo esc_html( wp_trim_words( get_the_excerpt( $cs ), 18 ) ); ?></p>
				<span class="service-card__link">View Results →</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
if ( function_exists( 'seoae_related_links_module' ) ) {
	seoae_related_links_module( 'Internal growth links — services, locations & proof' );
}
seoae_cta_dark(
	'Ready to Get Started?',
	'Book a free strategy call. We will audit your current performance and show you exactly where the biggest growth opportunities are.',
	'Book Free Strategy Call',
	home_url( '/contact' )
);
endwhile;
get_footer();
