<?php
/**
 * Template Name: Testimonials Page
 * Dedicated /testimonials/ page — full grid, filterable by industry.
 */

// SEO meta
add_filter( 'seoae_page_title', function() {
	return 'Client Reviews & Testimonials — SearchEngineOptimization.ae';
} );
add_filter( 'seoae_meta_desc', function() {
	return 'Read real client reviews from UAE businesses across real estate, hospitality, e-commerce, legal, and more. 345+ clients trust SearchEngineOptimization.ae with their SEO.';
} );

get_header();

// Fetch ALL published testimonials (no limit)
$testimonials = seoae_get_testimonials( 200 );

// Build card data with industry
$cards = [];
foreach ( $testimonials as $t ) {
	$cards[] = [
		'name'     => get_field( 'client_name',    $t->ID ) ?: $t->post_title,
		'role'     => get_field( 'client_role',    $t->ID ) ?: '',
		'company'  => get_field( 'client_company', $t->ID ) ?: '',
		'industry' => get_field( 'industry',       $t->ID ) ?: 'Other',
		'rating'   => intval( get_field( 'rating', $t->ID ) ?: 5 ),
		'content'  => get_field( 'content',        $t->ID ) ?: $t->post_content,
		'avatar'   => get_field( 'avatar',         $t->ID ) ?: '',
		'verified' => get_field( 'verified',       $t->ID ),
	];
}

// Collect unique industries in the order they appear
$industries = [];
foreach ( $cards as $c ) {
	$ind = $c['industry'];
	if ( $ind && ! in_array( $ind, $industries, true ) ) {
		$industries[] = $ind;
	}
}
sort( $industries );
?>

<!-- ══════════════════ PAGE HERO ══════════════════════════════ -->
<section class="testi-page-hero">
	<div class="testi-page-hero__blob testi-page-hero__blob--1" aria-hidden="true"></div>
	<div class="testi-page-hero__blob testi-page-hero__blob--2" aria-hidden="true"></div>
	<div class="container testi-page-hero__inner">
		<div class="testi-page-hero__badge">
			<span class="testi-page-hero__badge-dot"></span>
			Verified Client Reviews
		</div>
		<h1 class="testi-page-hero__title">
			What Our Clients Say About<br>
			<span class="gradient-text">SearchEngineOptimization.ae</span>
		</h1>
		<p class="testi-page-hero__sub">Real results, real businesses — from Dubai startups to enterprise brands across the UAE and GCC.</p>

		<!-- Stats strip -->
		<div class="testi-page-hero__stats">
			<div class="testi-page-hero__stat">
				<span class="testi-page-hero__stat-num">4.9</span>
				<span class="testi-page-hero__stat-label">
					<span class="testi-page-stars">★★★★★</span>
					Google Rating
				</span>
			</div>
			<div class="testi-page-hero__divider" aria-hidden="true"></div>
			<div class="testi-page-hero__stat">
				<span class="testi-page-hero__stat-num">345<sup>+</sup></span>
				<span class="testi-page-hero__stat-label">UAE Businesses Served</span>
			</div>
			<div class="testi-page-hero__divider" aria-hidden="true"></div>
			<div class="testi-page-hero__stat">
				<span class="testi-page-hero__stat-num">99<sup>%</sup></span>
				<span class="testi-page-hero__stat-label">Client Retention Rate</span>
			</div>
			<div class="testi-page-hero__divider" aria-hidden="true"></div>
			<div class="testi-page-hero__stat">
				<span class="testi-page-hero__stat-num">8<sup>+</sup></span>
				<span class="testi-page-hero__stat-label">Years in UAE Market</span>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ FILTER + GRID ══════════════════════════ -->
<section class="section testi-page-grid-section">
	<div class="container">

		<!-- Filter bar -->
		<?php if ( count( $industries ) > 1 ) : ?>
		<div class="testi-filter" role="group" aria-label="Filter by industry">
			<button class="testi-filter__btn testi-filter__btn--active" data-filter="all">All Reviews</button>
			<?php foreach ( $industries as $ind ) : ?>
			<button class="testi-filter__btn" data-filter="<?php echo esc_attr( $ind ); ?>">
				<?php echo esc_html( $ind ); ?>
			</button>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<!-- Results count -->
		<p class="testi-page-count" aria-live="polite">
			Showing <span id="testi-count"><?php echo count( $cards ); ?></span> review<?php echo count( $cards ) !== 1 ? 's' : ''; ?>
		</p>

		<!-- Grid -->
		<div class="testi-page-grid" id="testi-grid">
			<?php foreach ( $cards as $c ) :
				$init    = esc_html( strtoupper( substr( $c['name'], 0, 1 ) ) );
				$name    = esc_html( $c['name'] );
				$role    = esc_html( $c['role'] );
				$company = esc_html( $c['company'] );
				$ind     = esc_html( $c['industry'] );
				$content = esc_html( $c['content'] );
				$rating  = intval( $c['rating'] );

				// Stars HTML
				$stars = '';
				for ( $i = 1; $i <= 5; $i++ ) {
					$fill  = $i <= $rating ? '#F59E0B' : '#d1d5db';
					$stars .= '<svg width="14" height="14" viewBox="0 0 24 24" fill="' . $fill . '" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
				}
			?>
			<article class="tpc" data-industry="<?php echo esc_attr( $c['industry'] ); ?>"
			         itemscope itemtype="https://schema.org/Review">
				<!-- Industry badge -->
				<span class="tpc__industry" aria-label="Industry: <?php echo esc_attr( $ind ); ?>"><?php echo $ind; ?></span>

				<!-- Stars + verified -->
				<div class="tpc__top">
					<div class="tpc__stars" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
						<meta itemprop="ratingValue" content="<?php echo $rating; ?>">
						<meta itemprop="bestRating" content="5">
						<?php echo $stars; ?>
					</div>
					<?php if ( $c['verified'] ) : ?>
					<span class="tpc__verified">
						<svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
						Verified
					</span>
					<?php endif; ?>
				</div>

				<!-- Full quote — no clamp -->
				<blockquote class="tpc__quote" itemprop="reviewBody">"<?php echo $content; ?>"</blockquote>

				<!-- Author -->
				<div class="tpc__author" itemprop="author" itemscope itemtype="https://schema.org/Person">
					<?php if ( $c['avatar'] ) : ?>
					<img src="<?php echo esc_url( $c['avatar'] ); ?>" alt="<?php echo $name; ?>"
					     class="tpc__avatar tpc__avatar--img" width="44" height="44" loading="lazy">
					<?php else : ?>
					<div class="tpc__avatar" aria-hidden="true"><?php echo $init; ?></div>
					<?php endif; ?>
					<div>
						<p class="tpc__name" itemprop="name"><?php echo $name; ?></p>
						<p class="tpc__role">
							<?php
							echo $role;
							if ( $role && $company ) echo ', ';
							echo '<span itemprop="worksFor">' . $company . '</span>';
							?>
						</p>
					</div>
				</div>

				<!-- Schema: itemReviewed -->
				<div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization" style="display:none">
					<meta itemprop="name" content="SearchEngineOptimization.ae">
				</div>
				<meta itemprop="datePublished" content="<?php echo date('Y-m-d'); ?>">
			</article>
			<?php endforeach; ?>
		</div><!-- /.testi-page-grid -->

		<!-- Empty state (hidden by default) -->
		<p class="testi-page-empty" id="testi-empty" style="display:none">
			No reviews found for this industry yet.
		</p>

	</div>
</section>

<!-- ══════════════════ CTA BAND ═══════════════════════════════ -->
<section class="testi-page-cta">
	<div class="container testi-page-cta__inner">
		<div>
			<h2 class="testi-page-cta__title">Ready to add your success story?</h2>
			<p class="testi-page-cta__sub">Join 345+ UAE businesses growing with SearchEngineOptimization.ae.</p>
		</div>
		<a href="/contact/" class="btn btn--inverted btn--lg">Get a Free SEO Audit →</a>
	</div>
</section>

<script>
(function () {
	var grid   = document.getElementById('testi-grid');
	var count  = document.getElementById('testi-count');
	var empty  = document.getElementById('testi-empty');
	var btns   = document.querySelectorAll('.testi-filter__btn');
	var cards  = Array.prototype.slice.call(grid.querySelectorAll('.tpc'));

	function filter(value) {
		var visible = 0;
		cards.forEach(function(card) {
			var match = (value === 'all') || (card.dataset.industry === value);
			card.style.display = match ? '' : 'none';
			if (match) visible++;
		});
		count.textContent = visible;
		empty.style.display = visible === 0 ? '' : 'none';

		btns.forEach(function(b) {
			b.classList.toggle('testi-filter__btn--active', b.dataset.filter === value);
		});
	}

	btns.forEach(function(btn) {
		btn.addEventListener('click', function() {
			filter(this.dataset.filter);
		});
	});
})();
</script>

<?php get_footer(); ?>
