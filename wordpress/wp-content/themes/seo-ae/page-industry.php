<?php
/**
 * Template Name: Industry Page
 * Generic SEO industry landing page template
 */

$industry     = get_field('industry_name')    ?: get_the_title();
$industry_adj = get_field('industry_adj')     ?: $industry;
$icon         = get_field('industry_icon')    ?: '';
if ( is_string( $icon ) ) {
	$icon = preg_replace( '/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}\x{FE0F}\x{200D}]/u', '', $icon );
}
if ( $icon === '' ) {
	$icon = '<svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#0FB4D9" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/></svg>';
}
$the_content  = get_the_content();
$faqs         = get_post_meta( get_the_ID(), 'location_faqs', true ) ?: [];
if ( ! is_array($faqs) ) {
	$faqs = maybe_unserialize($faqs);
}
if ( ! is_array($faqs) ) {
	$faqs = [];
}

/* ---- FAQPage JSON-LD via wp_head ---- */
if ( ! empty($faqs) ) {
	add_action( 'wp_head', function() use ($faqs, $industry) {
		$entities = [];
		foreach ( $faqs as $faq ) {
			$q = $faq['faq_question'] ?? $faq['question'] ?? '';
			$a = wp_strip_all_tags( $faq['faq_answer'] ?? $faq['answer'] ?? '' );
			if ( $q && $a ) {
				$entities[] = [
					'@type'          => 'Question',
					'name'           => $q,
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ],
				];
			}
		}
		if ( $entities ) {
			$schema = [
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $entities,
			];
			echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
		}
	});
}

get_header();
?>

<section class="service-hero bg-dark">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/">Home</a> <span>/</span>
			<a href="/industries/">Industries</a> <span>/</span>
			<span><?php echo esc_html($industry); ?> SEO</span>
		</div>
		<div class="service-hero__inner" style="gap:3rem;">
			<div>
				<?php seoae_section_label('Industry SEO'); ?>
				<h1 style="color:#fff;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;line-height:1.1;margin:1rem 0;">
					<?php echo esc_html($industry); ?> SEO Services
					<br><span style="color:var(--color-primary);">in Dubai &amp; UAE</span>
				</h1>
				<p style="color:rgba(255,255,255,.75);font-size:1.05rem;max-width:520px;margin-bottom:2rem;">
					Specialised search engine optimisation strategies built specifically for <?php echo esc_html(strtolower($industry)); ?> businesses in the UAE. We understand your market, your buyers, and the keywords that drive qualified enquiries.
				</p>
				<div style="display:flex;gap:1rem;flex-wrap:wrap;">
					<a href="/contact/" class="btn btn--primary btn--lg">Get Free Industry SEO Audit &rarr;</a>
					<a href="/case-studies/" class="btn btn--outline-white btn--lg">View Results</a>
				</div>
			</div>
			<div>
				<div style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:2rem;text-align:center;">
					<div style="font-size:3rem;margin-bottom:.75rem;"><?php echo $icon; ?></div>
					<div style="font-size:1.1rem;font-weight:700;color:#fff;"><?php echo esc_html($industry); ?> SEO</div>
					<div style="font-size:.8rem;color:rgba(255,255,255,.5);margin-top:.35rem;">UAE Specialist</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section bg-white">
	<div class="container">
		<?php if ($the_content) : ?>
			<div class="post-body entry-content">
				<?php the_content(); ?>
			</div>
		<?php else : ?>
		<div class="section-header section-header--center">
			<?php seoae_section_label('Why Choose Us'); ?>
			<h2>Why <?php echo esc_html($industry); ?> Businesses in the UAE Choose SearchEngineOptimization.ae</h2>
		</div>
		<div class="why-grid" style="margin-top:2.5rem;">
			<?php
			$points = [
				['title'=>$industry.' Keyword Research','desc'=>'We identify the exact search terms your potential '.$industry.' clients use, then build content that captures them.'],
				['title'=>'Competitor Intelligence','desc'=>'We analyse every UAE '.$industry.' competitor ranking above you and reverse-engineer their strategy.'],
				['title'=>'Content That Converts','desc'=>'Industry-specific content written by SEO experts who understand the UAE '.$industry.' market.'],
				['title'=>'Technical SEO','desc'=>'Full technical audit and implementation: site speed, schema markup, Core Web Vitals, mobile optimisation.'],
				['title'=>'Local & National Rankings','desc'=>'Whether you\'re targeting Dubai, Abu Dhabi, or all of UAE, we build the right strategy for your coverage area.'],
				['title'=>'ROI-Focused Reporting','desc'=>'Monthly reports showing keyword rankings, organic traffic, leads generated, and revenue attribution.'],
			];
			foreach ($points as $p) : ?>
			<div class="why-card">
				<h3 class="why-card__title"><?php echo esc_html($p['title']); ?></h3>
				<p class="why-card__desc"><?php echo esc_html($p['desc']); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php if ( ! $the_content ) : ?>
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Services'); ?>
			<h2>Our <?php echo esc_html($industry); ?> SEO Services</h2>
		</div>
		<div class="services-grid" style="margin-top:2.5rem;">
			<?php
			$svcs = [
				['title'=>'Local SEO','url'=>'/services/search-engine-optimization/','desc'=>'Rank for location-based '.$industry.' searches across the UAE.'],
				['title'=>'Content Strategy','url'=>'/services/search-engine-optimization/','desc'=>'Authority content that answers what your '.$industry.' buyers are searching for.'],
				['title'=>'Technical Audit','url'=>'/services/web-development/','desc'=>'Fix every technical barrier preventing your site from ranking.'],
				['title'=>'Link Building','url'=>'/services/search-engine-optimization/','desc'=>'High-quality backlinks from UAE '.$industry.' publications and directories.'],
				['title'=>'Google Ads','url'=>'/services/ppc-management/','desc'=>'Complement your organic strategy with targeted '.$industry.' PPC campaigns.'],
				['title'=>'Analytics & Reporting','url'=>'/services/search-engine-optimization/','desc'=>'Full visibility into your '.$industry.' SEO performance.'],
			];
			foreach ($svcs as $s) : ?>
			<a href="<?php echo esc_url($s['url']); ?>" class="service-card">
				<h3 class="service-card__title"><?php echo esc_html($s['title']); ?></h3>
				<p class="service-card__desc"><?php echo esc_html($s['desc']); ?></p>
				<span class="service-card__link">Learn More &rarr;</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php if ( ! empty($faqs) ) : ?>
<section class="section bg-white">
	<div class="container" style="max-width:760px;">
		<div class="section-header section-header--center">
			<?php seoae_section_label('FAQ'); ?>
			<h2>Frequently Asked Questions &mdash; <?php echo esc_html($industry); ?> SEO</h2>
		</div>
		<div class="faq-list" style="margin-top:2.5rem;">
			<?php foreach ($faqs as $faq) : ?>
			<div class="faq-item">
				<h3 class="faq-question"><?php echo esc_html($faq['faq_question'] ?? $faq['question'] ?? ''); ?></h3>
				<div class="faq-answer"><?php echo wp_kses_post($faq['faq_answer'] ?? $faq['answer'] ?? ''); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php seoae_cta_dark(); ?>
<?php get_footer(); ?>
