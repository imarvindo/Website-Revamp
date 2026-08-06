<?php
/**
 * Template Name: Location Page
 * Generic SEO location landing page template
 */
get_header();

$city         = get_field('location_city')        ?: get_the_title();
$country      = get_field('location_country')     ?: 'UAE';
$searches     = get_field('monthly_searches')     ?: '6M+';
$hero_stat1   = get_field('loc_stat1')            ?: ['value'=>'340%','label'=>'Avg. Traffic Increase'];
$hero_stat2   = get_field('loc_stat2')            ?: ['value'=>'90','label'=>'Days to Page 1'];
$hero_stat3   = get_field('loc_stat3')            ?: ['value'=>'4.9','label'=>'Client Rating'];
$intro        = get_field('location_intro')       ?: get_the_content();
$services_text = get_field('location_services_text') ?: '';
$faqs         = get_field('location_faqs') ?: get_post_meta( get_the_ID(), 'location_faqs', true ) ?: [];
$the_content  = get_the_content();
?>

<section class="service-hero bg-dark">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/">Home</a> <span>/</span>
			<a href="/locations/">Locations</a> <span>/</span>
			<span><?php echo esc_html($city); ?> SEO</span>
		</div>
		<div class="service-hero__inner" style="grid-template-columns:1.2fr 0.8fr;gap:3rem;">
			<div>
				<?php seoae_section_label('Local SEO'); ?>
				<h1 style="color:#fff;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;line-height:1.1;margin:1rem 0;">
					SEO Agency in <?php echo esc_html($city); ?>
					<br><span style="color:var(--color-primary);">Drive Local Search Growth</span>
				</h1>
				<p style="color:rgba(255,255,255,.75);font-size:1.05rem;max-width:500px;margin-bottom:2rem;">
					Dominate <?php echo esc_html($city); ?> search results and capture <?php echo esc_html($searches); ?> monthly searches. We help <?php echo esc_html($city); ?> businesses rank higher, attract more traffic, and convert visitors into customers.
				</p>
				<div style="display:flex;gap:1rem;flex-wrap:wrap;">
					<a href="/contact/" class="btn btn--primary btn--lg">Get Free <?php echo esc_html($city); ?> SEO Audit →</a>
					<a href="/case-studies/" class="btn btn--outline-white btn--lg">View Results</a>
				</div>
			</div>
			<div style="display:flex;flex-direction:column;gap:1rem;">
				<div style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:1.5rem;text-align:center;">
					<div style="font-size:2rem;font-weight:900;color:var(--color-primary);"><?php echo esc_html($searches); ?></div>
					<div style="font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.5);margin-top:.25rem;">Monthly Searches in <?php echo esc_html($city); ?></div>
				</div>
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
					<div style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1rem;text-align:center;">
						<div style="font-size:1.4rem;font-weight:800;color:#fff;"><?php echo esc_html(is_array($hero_stat1) ? $hero_stat1['value'] : $hero_stat1); ?></div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;"><?php echo esc_html(is_array($hero_stat1) ? $hero_stat1['label'] : ''); ?></div>
					</div>
					<div style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1rem;text-align:center;">
						<div style="font-size:1.4rem;font-weight:800;color:var(--color-primary);"><?php echo esc_html(is_array($hero_stat2) ? $hero_stat2['value'] : $hero_stat2); ?></div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;"><?php echo esc_html(is_array($hero_stat2) ? $hero_stat2['label'] : ''); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section bg-white">
	<div class="container">
		<div class="post-body" style="max-width:100%;">
			<?php if ($the_content) : ?>
				<?php the_content(); ?>
			<?php else : ?>
			<div class="section-header">
				<?php seoae_section_label('Local SEO Services'); ?>
				<h2>Why <?php echo esc_html($city); ?> Businesses Choose SearchEngineOptimization.ae</h2>
			</div>
			<div class="why-grid" style="margin-top:2rem;">
				<?php
				$points = [
					['icon'=>'','title'=>$city.' Market Expertise','desc'=>'Deep knowledge of the '.$city.' competitive landscape, local search behaviour, and high-value commercial keywords.'],
					['icon'=>'','title'=>'Proven Local Rankings','desc'=>'We\'ve helped '.$city.' businesses achieve page-1 Google rankings for competitive local queries in under 90 days.'],
					['icon'=>'','title'=>'Data-Driven Strategy','desc'=>'Every campaign is backed by '.$city.'-specific keyword research, competitor analysis, and intent mapping.'],
					['icon'=>'','title'=>'Arabic + English SEO','desc'=>'Full bilingual optimisation for '.$city.'\'s dual-language search audience  -  maximising reach across both markets.'],
					['icon'=>'','title'=>'Transparent Reporting','desc'=>'Weekly rank tracking, monthly strategy calls, and a live dashboard showing exactly how your '.$city.' SEO is performing.'],
					['icon'=>'','title'=>'Fast Execution','desc'=>'Strategy to implementation in days. We move as fast as the '.$city.' market demands.'],
				];
				foreach ($points as $p) : ?>
				<div class="why-card">
					<div class="why-card__icon" style="font-size:1.5rem;"><?php echo $p['icon']; ?></div>
					<h3 class="why-card__title"><?php echo esc_html($p['title']); ?></h3>
					<p class="why-card__desc"><?php echo esc_html($p['desc']); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- Services Section -->
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Services in '.$city); ?>
			<h2>Complete SEO & Digital Marketing Services in <?php echo esc_html($city); ?></h2>
		</div>
		<div class="services-grid" style="margin-top:2.5rem;">
			<?php
			$svcs = [
				['title'=>'Search Engine Optimisation','url'=>'/services/search-engine-optimization/','desc'=>'Full-service SEO to dominate '.$city.' Google results.'],
				['title'=>'AI Search Optimisation','url'=>'/services/ai-search-optimization/','desc'=>'Get featured in ChatGPT, Perplexity and Google AI answers.'],
				['title'=>'PPC Management','url'=>'/services/ppc-management/','desc'=>'Google Ads campaigns targeted at '.$city.' audiences.'],
				['title'=>'Social Media Marketing','url'=>'/services/social-media-marketing/','desc'=>'Build brand presence across '.$city.'\'s social platforms.'],
				['title'=>'Web Design','url'=>'/services/web-design/','desc'=>'High-converting websites built for '.$city.' businesses.'],
				['title'=>'Web Development','url'=>'/services/web-development/','desc'=>'Custom web solutions engineered for performance.'],
			];
			foreach ($svcs as $s) : ?>
			<a href="<?php echo esc_url($s['url']); ?>" class="service-card">
				<h3 class="service-card__title"><?php echo esc_html($s['title']); ?></h3>
				<p class="service-card__desc"><?php echo esc_html($s['desc']); ?></p>
				<span class="service-card__link">Learn More →</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- FAQ Section -->
<?php if ($faqs) : ?>
<section class="section bg-white">
	<div class="container" style="max-width:760px;">
		<div class="section-header section-header--center">
			<?php seoae_section_label('FAQ'); ?>
			<h2>Frequently Asked Questions  -  SEO in <?php echo esc_html($city); ?></h2>
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

<?php
if ( function_exists( 'seoae_related_links_module' ) ) {
	seoae_related_links_module( 'Related SEO services, districts & proof for ' . $city );
}
seoae_cta_dark();
get_footer();
?>
