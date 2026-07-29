<?php
/**
 * Homepage Template — SearchEngineOptimization.ae
 */
get_header();

$hero_badge       = get_field('hero_badge_text','option')    ?: "UAE's Leading SEO & Digital Marketing Agency";
$hero_headline    = get_field('hero_headline','option')      ?: "Turn Search Visibility Into\nBusiness Growth";
$hero_sub         = get_field('hero_subheadline','option')   ?: "We help UAE and GCC businesses dominate organic search, capture high-intent traffic, and convert visitors into qualified leads — backed by data, not guesswork.";
$hero_cta_primary = get_field('hero_cta_primary','option')   ?: 'Get Your Free SEO Audit';
$hero_cta_primary_url = get_field('hero_cta_primary_url','option') ?: '/contact/';
$hero_cta_sec     = get_field('hero_cta_secondary','option') ?: 'View Our Results';
$hero_cta_sec_url = get_field('hero_cta_secondary_url','option') ?: '/case-studies/';
$hero_stats       = get_field('hero_stats','option')         ?: [];

if ( empty($hero_stats) ) {
	$hero_stats = [
		['stat_prefix' => '+', 'stat_value' => '340', 'stat_suffix' => '%',  'stat_label' => 'AVG. ROI INCREASE'],
		['stat_prefix' => '',  'stat_value' => '345', 'stat_suffix' => '+',  'stat_label' => 'PROJECTS DELIVERED'],
		['stat_prefix' => '',  'stat_value' => '4.9', 'stat_suffix' => '/5', 'stat_label' => 'GOOGLE RATING'],
		['stat_prefix' => '',  'stat_value' => '8',   'stat_suffix' => '+',  'stat_label' => 'YEARS EXPERIENCE'],
	];
}

$services     = seoae_get_services();
$testimonials = seoae_get_testimonials(6);
$recent_posts = seoae_get_recent_posts(3);
$case_studies = new WP_Query(['post_type'=>'case_study','posts_per_page'=>4,'post_status'=>'publish']);
?>

<!-- ═══════════════════════════════════════ WOW HERO ══════════════════════════════ -->
<section class="hero-wow">
	<!-- Decorative blobs -->
	<div class="hero-wow__blob hero-wow__blob--1" aria-hidden="true"></div>
	<div class="hero-wow__blob hero-wow__blob--2" aria-hidden="true"></div>
	<div class="hero-wow__grid" aria-hidden="true"></div>

	<div class="container hero-wow__inner">

		<!-- LEFT: Copy -->
		<div class="hero-wow__left">
			<div class="hero-wow__badge">
				<span class="hero-wow__badge-dot"></span>
				<?php echo esc_html($hero_badge); ?>
			</div>

			<h1 class="hero-wow__title">
				Turn Search Visibility Into<br>
				<span class="hero-wow__highlight">Business Growth</span>
			</h1>

			<p class="hero-wow__desc"><?php echo esc_html($hero_sub); ?></p>

			<div class="hero-wow__actions">
				<a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn btn--primary btn--lg hero-wow__btn-primary">
					<?php echo esc_html($hero_cta_primary); ?> <span class="btn-arrow">→</span>
				</a>
				<a href="<?php echo esc_url($hero_cta_sec_url); ?>" class="hero-wow__btn-ghost">
					<?php echo esc_html($hero_cta_sec); ?> <span>↗</span>
				</a>
			</div>

			<div class="hero-wow__tags">
				<span>SEO Strategy</span>
				<span class="hero-wow__tags-sep">|</span>
				<span>Local Search</span>
				<span class="hero-wow__tags-sep">|</span>
				<span>Technical SEO</span>
				<span class="hero-wow__tags-sep">|</span>
				<span>AI Search Visibility</span>
			</div>
		</div>

		<!-- RIGHT: Analytics Dashboard Widget -->
		<div class="hero-wow__right" aria-hidden="true">
			<div class="hero-dashboard">

				<!-- AI Visibility row -->
				<div class="hero-dashboard__ai-row">
					<span class="hero-dashboard__ai-label">AI VISIBILITY</span>
					<span class="hero-dashboard__chip hero-dashboard__chip--navy">ChatGPT ✓</span>
					<span class="hero-dashboard__chip hero-dashboard__chip--cyan">Perplexity ✓</span>
				</div>

				<!-- Organic header -->
				<div class="hero-dashboard__organic">
					<div>
						<div class="hero-dashboard__micro-label">ORGANIC VISIBILITY</div>
						<div class="hero-dashboard__domain">SearchBrand.ae</div>
					</div>
					<div class="hero-dashboard__growth-pill">↑ +218%</div>
				</div>

				<!-- Chart -->
				<div class="hero-dashboard__chart">
					<svg viewBox="0 0 340 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
						<defs>
							<linearGradient id="chartFill" x1="0" y1="0" x2="0" y2="1">
								<stop offset="0%" stop-color="#16B1D4" stop-opacity="0.25"/>
								<stop offset="100%" stop-color="#16B1D4" stop-opacity="0"/>
							</linearGradient>
						</defs>
						<path d="M0,72 C30,68 55,63 80,57 C105,51 130,42 160,31 C185,22 210,15 240,10 C265,6 295,4 340,3"
							stroke="#16B1D4" stroke-width="2.5" fill="none" stroke-linecap="round"/>
						<path d="M0,72 C30,68 55,63 80,57 C105,51 130,42 160,31 C185,22 210,15 240,10 C265,6 295,4 340,3 L340,80 L0,80 Z"
							fill="url(#chartFill)"/>
						<!-- Dot at peak -->
						<circle cx="310" cy="3.8" r="4" fill="#16B1D4"/>
						<circle cx="310" cy="3.8" r="7" fill="#16B1D4" fill-opacity="0.2"/>
					</svg>
					<div class="hero-dashboard__chart-months">
						<span>Jan</span><span>Mar</span><span>May</span><span>Jul</span><span>Sep</span><span>Nov</span>
					</div>
				</div>

				<!-- Stats row -->
				<div class="hero-dashboard__stats">
					<div class="hero-dashboard__stat">
						<div class="hero-dashboard__stat-val">847</div>
						<div class="hero-dashboard__stat-lbl">PAGE-1 RANKINGS</div>
						<div class="hero-dashboard__stat-delta">+234 new</div>
					</div>
					<div class="hero-dashboard__stat">
						<div class="hero-dashboard__stat-val">28.4K</div>
						<div class="hero-dashboard__stat-lbl">MONTHLY TRAFFIC</div>
						<div class="hero-dashboard__stat-delta">+215%</div>
					</div>
					<div class="hero-dashboard__stat">
						<div class="hero-dashboard__stat-val">142</div>
						<div class="hero-dashboard__stat-lbl">LEADS / MONTH</div>
						<div class="hero-dashboard__stat-delta">4.2x ROI</div>
					</div>
				</div>

				<!-- Top keyword positions -->
				<div class="hero-dashboard__kw-head">TOP KEYWORD POSITIONS</div>
				<div class="hero-dashboard__kw-list">
					<div class="hero-dashboard__kw">
						<span class="hero-dashboard__kw-pos">#1</span>
						<span class="hero-dashboard__kw-name">SEO agency Dubai</span>
						<span class="hero-dashboard__kw-up">+12</span>
					</div>
					<div class="hero-dashboard__kw">
						<span class="hero-dashboard__kw-pos">#2</span>
						<span class="hero-dashboard__kw-name">SEO services UAE</span>
						<span class="hero-dashboard__kw-up">+8</span>
					</div>
					<div class="hero-dashboard__kw">
						<span class="hero-dashboard__kw-pos">#1</span>
						<span class="hero-dashboard__kw-name">local SEO Abu Dhabi</span>
						<span class="hero-dashboard__kw-up">+15</span>
					</div>
				</div>

				<!-- Google Maps badge -->
				<div class="hero-dashboard__maps">
					<span class="hero-dashboard__maps-label">GOOGLE MAPS</span>
					<span class="hero-dashboard__maps-val">#1 UAE Local Pack ✓</span>
				</div>

			</div><!-- /.hero-dashboard -->

			<!-- Floating accent cards -->
			<div class="hero-float hero-float--tl">
				<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
				<span>+318% organic traffic</span>
			</div>
			<div class="hero-float hero-float--br">
				<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
				<span>Ranked #1 in 48 hrs</span>
			</div>

		</div><!-- /.hero-wow__right -->
	</div><!-- /.hero-wow__inner -->
</section>

<!-- ═══════════════════════════════════════ STATS BAR ═════════════════════════════ -->
<div class="home-stats-bar">
	<div class="container">
		<div class="home-stats-bar__inner">
			<?php foreach ($hero_stats as $stat) :
				$prefix = $stat['stat_prefix'] ?? '';
				$value  = $stat['stat_value']  ?? '0';
				$suffix = $stat['stat_suffix']  ?? '';
				$label  = $stat['stat_label']   ?? '';
			?>
			<div class="home-stats-bar__item">
				<span class="home-stats-bar__value"
				      data-counter="<?php echo esc_attr(preg_replace('/[^0-9.]/','',$value)); ?>"
				      data-prefix="<?php echo esc_attr($prefix); ?>"
				      data-suffix="<?php echo esc_attr($suffix); ?>">
					<?php echo esc_html($prefix . $value . $suffix); ?>
				</span>
				<span class="home-stats-bar__label"><?php echo esc_html($label); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- ═══════════════════════════════════════ SERVICES ══════════════════════════════ -->
<?php if ($services) : ?>
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Services'); ?>
			<h2 class="section-header__title">Enterprise Digital Marketing Solutions</h2>
			<p class="section-header__desc">From AI-driven SEO to high-converting web development — everything your business needs to dominate online.</p>
		</div>
		<div class="services-grid">
			<?php foreach ($services as $svc) :
				$short    = get_field('short_description', $svc->ID) ?: wp_trim_words($svc->post_excerpt ?: $svc->post_content, 18);
				$icon_svg = get_field('icon_svg', $svc->ID) ?: '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>';
			?>
			<a href="<?php echo esc_url(get_permalink($svc)); ?>" class="service-card">
				<div class="service-card__icon"><?= $icon_svg ?></div>
				<h3 class="service-card__title"><?php echo esc_html($svc->post_title); ?></h3>
				<p class="service-card__desc"><?php echo esc_html($short); ?></p>
				<span class="service-card__link">
					Learn More
					<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
				</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════ UAE COVERAGE ═══════════════════════════════════ -->
<section class="section uae-coverage">
	<div class="container">
		<div class="section-header">
			<?php seoae_section_label('UAE Coverage'); ?>
			<h2 class="section-header__title">Search Specialists Across Every Emirate</h2>
			<p class="section-header__desc" style="max-width:560px;">From Dubai's hypercompetitive commercial market to Fujairah's port-city B2B sector — we deliver measurable search results in every UAE market.</p>
		</div>
		<div class="uae-grid">

			<a href="/dubai/" class="uae-card">
				<div class="uae-card__arrow" aria-hidden="true">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
				</div>
				<h3 class="uae-card__city">Dubai</h3>
				<p class="uae-card__desc">The UAE's most competitive digital market. We help Dubai businesses rank for high-value commercial queries across all major sectors.</p>
				<span class="uae-card__badge">18M+ monthly searches</span>
			</a>

			<a href="/locations/seo-abu-dhabi/" class="uae-card">
				<div class="uae-card__arrow" aria-hidden="true">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
				</div>
				<h3 class="uae-card__city">Abu Dhabi</h3>
				<p class="uae-card__desc">Capital market SEO for government suppliers, hospitality, healthcare, and finance businesses targeting UAE's wealthiest emirate.</p>
				<span class="uae-card__badge">6M+ monthly searches</span>
			</a>

			<a href="/locations/seo-sharjah/" class="uae-card">
				<div class="uae-card__arrow" aria-hidden="true">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
				</div>
				<h3 class="uae-card__city">Sharjah</h3>
				<p class="uae-card__desc">Growing commercial and industrial market. We build organic visibility for Sharjah businesses across English and Arabic search audiences.</p>
				<span class="uae-card__badge">4M+ monthly searches</span>
			</a>

			<a href="/locations/seo-ajman/" class="uae-card">
				<div class="uae-card__arrow" aria-hidden="true">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
				</div>
				<h3 class="uae-card__city">Ajman</h3>
				<p class="uae-card__desc">Cost-effective SEO for Ajman's growing SME and e-commerce sector, with strong local pack and Google Maps optimisation.</p>
				<span class="uae-card__badge">1.5M+ monthly searches</span>
			</a>

			<a href="/locations/seo-ras-al-khaimah/" class="uae-card">
				<div class="uae-card__arrow" aria-hidden="true">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
				</div>
				<h3 class="uae-card__city">Ras Al Khaimah</h3>
				<p class="uae-card__desc">Tourism, logistics, and manufacturing SEO for RAK businesses reaching both local and international search audiences.</p>
				<span class="uae-card__badge">1.2M+ monthly searches</span>
			</a>

			<a href="/locations/seo-fujairah/" class="uae-card">
				<div class="uae-card__arrow" aria-hidden="true">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
				</div>
				<h3 class="uae-card__city">Fujairah</h3>
				<p class="uae-card__desc">Port-city B2B and tourism SEO for Fujairah's unique dual-market search landscape — maritime, logistics, and hospitality.</p>
				<span class="uae-card__badge">900K+ monthly searches</span>
			</a>

		</div>
	</div>
</section>

<!-- ═══════════════════════════════ WHY CHOOSE US ═════════════════════════════════ -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Why SearchEngineOptimization.ae'); ?>
			<h2 class="section-header__title">The Growth Partner UAE Businesses Trust</h2>
			<p class="section-header__desc">We combine enterprise-grade strategy with obsessive execution to deliver results that move the needle.</p>
		</div>
		<?php
		$why_items = (function_exists('get_field') ? get_field('why_choose_items','option') : null) ?: [
			['why_icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>', 'why_title' => 'Data-First Strategy',    'why_desc' => 'Every campaign is backed by hard data, deep market analysis, and competitive intelligence.'],
			['why_icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',          'why_title' => 'Rapid Execution',        'why_desc' => 'We move faster than your competitors can react. Strategy → execution in days, not months.'],
			['why_icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',  'why_title' => 'Guaranteed Transparency', 'why_desc' => 'You own your data. Weekly reports, monthly strategy calls, full dashboard access.'],
			['why_icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>', 'why_title' => 'Senior-Led Teams',       'why_desc' => 'No juniors. Your account is managed by senior specialists with 8+ years of experience.'],
			['why_icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'why_title' => 'UAE Market Expertise',   'why_desc' => 'Deep knowledge of the UAE, GCC, and Arabic digital landscape — including bilingual SEO.'],
			['why_icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.663 17h4.673M12 3v1m6.364 1.636-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>', 'why_title' => 'AI-Search Optimized',    'why_desc' => 'Future-proof strategies covering Google AI Overviews, ChatGPT, Gemini, and Perplexity.'],
		];
		?>
		<div class="why-grid">
			<?php foreach ($why_items as $item) : ?>
			<div class="why-card">
				<div class="why-card__icon"><?= $item['why_icon'] ?? '' ?></div>
				<h3 class="why-card__title"><?php echo esc_html($item['why_title'] ?? ''); ?></h3>
				<p class="why-card__desc"><?php echo esc_html($item['why_desc'] ?? ''); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ══════════════════════════════ SIX-STEP PROCESS ══════════════════════════════ -->
<section class="section process-section">
	<div class="container">
		<div class="section-header">
			<?php seoae_section_label('How We Work'); ?>
			<h2 class="section-header__title" style="max-width:600px;">A Six-Step Methodology Built for Compounding Growth</h2>
			<div class="process-divider"></div>
		</div>
		<div class="process-wrap">
			<div class="process-track" aria-hidden="true"></div>
			<div class="process-steps">

				<div class="process-step">
					<div class="process-step__num">01</div>
					<h3 class="process-step__title">Discover</h3>
					<p class="process-step__desc">Deep-dive into your market, competitors, and current search performance.</p>
				</div>

				<div class="process-step">
					<div class="process-step__num">02</div>
					<h3 class="process-step__title">Diagnose</h3>
					<p class="process-step__desc">Identify every technical, content, and authority gap holding you back.</p>
				</div>

				<div class="process-step">
					<div class="process-step__num">03</div>
					<h3 class="process-step__title">Prioritise</h3>
					<p class="process-step__desc">Rank opportunities by revenue impact and implementation speed.</p>
				</div>

				<div class="process-step">
					<div class="process-step__num">04</div>
					<h3 class="process-step__title">Execute</h3>
					<p class="process-step__desc">Implement changes with disciplined project management and QA.</p>
				</div>

				<div class="process-step">
					<div class="process-step__num">05</div>
					<h3 class="process-step__title">Measure</h3>
					<p class="process-step__desc">Track rankings, traffic, and conversions with transparent reporting.</p>
				</div>

				<div class="process-step">
					<div class="process-step__num">06</div>
					<h3 class="process-step__title">Compound</h3>
					<p class="process-step__desc">Build on what works — authority, content, and technical improvements compound over time.</p>
				</div>

			</div><!-- /.process-steps -->
		</div><!-- /.process-wrap -->
	</div>
</section>

<!-- ══════════════════════════════ CASE STUDIES ═══════════════════════════════════ -->
<?php if ($case_studies->have_posts()) : ?>
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Case Studies'); ?>
			<h2 class="section-header__title">Real Results for Real UAE Businesses</h2>
			<p class="section-header__desc">Our work speaks for itself. Here's what we've achieved for clients across Dubai and the UAE.</p>
		</div>
		<div class="case-study-grid">
			<?php while ($case_studies->have_posts()) : $case_studies->the_post();
				$results  = get_field('results') ?: [];
				$industry = get_field('cs_industry') ?: '';
				$client   = get_field('client_name') ?: get_the_title();
			?>
			<article class="case-study-card">
				<div class="case-study-card__head">
					<div class="case-study-card__industry"><?php echo esc_html($industry); ?></div>
					<h3 class="case-study-card__title"><?php echo esc_html($client); ?></h3>
				</div>
				<?php if ($results) : ?>
				<div class="case-study-card__results">
					<?php foreach (array_slice($results, 0, 3) as $r) : ?>
					<div class="case-study-card__result-item">
						<span class="case-study-card__result-value"><?php echo esc_html($r['value'] ?? ''); ?></span>
						<span class="case-study-card__result-label"><?php echo esc_html($r['metric'] ?? ''); ?></span>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<div class="case-study-card__body">
					<p class="case-study-card__desc"><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25)); ?></p>
					<a href="<?php the_permalink(); ?>" class="service-card__link" style="margin-top:.75rem;display:inline-flex;align-items:center;gap:.35rem;font-size:.875rem;font-weight:600;color:var(--color-primary);">
						Read Case Study →
					</a>
				</div>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div style="text-align:center;margin-top:2.5rem;">
			<a href="<?php echo esc_url(get_post_type_archive_link('case_study')); ?>" class="btn btn--outline">View All Case Studies</a>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════ TESTIMONIALS ══════════════════════════════════ -->
<?php if ($testimonials) : ?>
<section class="section testimonials-section">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Client Reviews'); ?>
			<h2 class="section-header__title">What Our Clients Say</h2>
			<p class="section-header__desc">Over 345 businesses across UAE trust SearchEngineOptimization.ae for measurable digital growth.</p>
		</div>
		<div class="testimonials-grid">
			<?php foreach ($testimonials as $test) :
				$name    = get_field('client_name', $test->ID)    ?: $test->post_title;
				$role    = get_field('client_role', $test->ID)    ?: 'CEO';
				$company = get_field('client_company', $test->ID) ?: '';
				$rating  = intval(get_field('rating', $test->ID)  ?: 5);
				$content = get_field('content', $test->ID)        ?: $test->post_content;
				$avatar  = get_field('avatar', $test->ID)         ?: '';
				$verified= get_field('verified', $test->ID);
				$initial = strtoupper(substr($name, 0, 1));
			?>
			<div class="testimonial-card">
				<div class="testimonial-card__stars"><?php echo seoae_stars($rating); ?></div>
				<p class="testimonial-card__quote">"<?php echo esc_html($content); ?>"</p>
				<div class="testimonial-card__author">
					<div class="testimonial-card__avatar">
						<?php if ($avatar) : ?><img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($name); ?>"><?php else : ?>
						<?php echo esc_html($initial); ?>
						<?php endif; ?>
					</div>
					<div>
						<p class="testimonial-card__name"><?php echo esc_html($name); ?></p>
						<p class="testimonial-card__role"><?php echo esc_html($role . ($company ? ', ' . $company : '')); ?></p>
					</div>
					<?php if ($verified) : ?>
					<div class="testimonial-card__verified">
						<svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
						Verified
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ════════════════════════════════ BLOG POSTS ═══════════════════════════════════ -->
<?php if ($recent_posts) : ?>
<section class="section bg-white">
	<div class="container">
		<div class="section-header">
			<?php seoae_section_label('Latest Insights'); ?>
			<div style="display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
				<h2 class="section-header__title">SEO Tips & Digital Marketing Insights</h2>
				<a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="btn btn--outline btn--sm">View All Posts</a>
			</div>
		</div>
		<div class="blog-grid">
			<?php foreach ($recent_posts as $p) :
				$category = get_the_category($p->ID);
				$cat_name = $category ? $category[0]->name : 'SEO';
				$thumb    = get_the_post_thumbnail_url($p->ID, 'medium_large');
				$rt       = get_field('reading_time', $p->ID) ?: 8;
				$excerpt  = get_the_excerpt($p);
			?>
			<article class="blog-card">
				<div class="blog-card__image">
					<?php if ($thumb) : ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($p->post_title); ?>" loading="lazy"><?php endif; ?>
				</div>
				<div class="blog-card__body">
					<span class="blog-card__category"><?php echo esc_html($cat_name); ?></span>
					<h3 class="blog-card__title"><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html($p->post_title); ?></a></h3>
					<p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words($excerpt ?: $p->post_content, 22)); ?></p>
					<div class="blog-card__meta">
						<span><?php echo get_the_date('M j, Y', $p); ?></span>
						<span>·</span>
						<span><?php echo esc_html($rt); ?> min read</span>
					</div>
				</div>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ════════════════════════════════ DARK CTA ════════════════════════════════════ -->
<?php seoae_cta_dark(); ?>

<?php get_footer(); ?>
