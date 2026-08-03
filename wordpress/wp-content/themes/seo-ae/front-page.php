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
// Brand-authoritative stats — hardcoded as single source of truth.
// Update these values here when the agency's real numbers change.
$hero_stats = [
	['stat_prefix' => '+', 'stat_value' => '206', 'stat_suffix' => '%',  'stat_label' => 'AVG. ROI INCREASE'],
	['stat_prefix' => '',  'stat_value' => '345', 'stat_suffix' => '+',  'stat_label' => 'CLIENTS SERVED'],
	['stat_prefix' => '',  'stat_value' => '4.8', 'stat_suffix' => '/5', 'stat_label' => 'GOOGLE RATING'],
	['stat_prefix' => '',  'stat_value' => '5',   'stat_suffix' => '+',  'stat_label' => 'YEARS EXPERIENCE'],
];

$services     = seoae_get_services();
$testimonials = seoae_get_testimonials(20);
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
<section class="process-section-v2" id="process-v2">
	<div class="container">
		<div class="process-v2__header">
			<span class="process-v2__label">HOW WE WORK</span>
			<h2 class="process-v2__title">A Six-Step Methodology<br>Built for Compounding Growth</h2>
			<p class="process-v2__subtitle">Every engagement follows the same proven framework — systematic, measurable, and designed to outperform your competitors long-term.</p>
		</div>

		<div class="process-v2__grid">

			<div class="process-v2__step">
				<div class="process-v2__step-inner">
					<div class="process-v2__step-num">01</div>
					<div class="process-v2__step-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="#16B1D4" stroke-width="2"/><path d="M16.5 16.5L21 21" stroke="#16B1D4" stroke-width="2" stroke-linecap="round"/></svg>
					</div>
					<h3 class="process-v2__step-title">Discover</h3>
					<p class="process-v2__step-desc">Deep-dive into your market, competitors, and current search performance to find real opportunities.</p>
				</div>
				<div class="process-v2__connector" aria-hidden="true"></div>
			</div>

			<div class="process-v2__step">
				<div class="process-v2__step-inner">
					<div class="process-v2__step-num">02</div>
					<div class="process-v2__step-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 11l3 3L22 4" stroke="#16B1D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="#16B1D4" stroke-width="2" stroke-linecap="round"/></svg>
					</div>
					<h3 class="process-v2__step-title">Diagnose</h3>
					<p class="process-v2__step-desc">Identify every technical, content, and authority gap holding your rankings back.</p>
				</div>
				<div class="process-v2__connector" aria-hidden="true"></div>
			</div>

			<div class="process-v2__step">
				<div class="process-v2__step-inner">
					<div class="process-v2__step-num">03</div>
					<div class="process-v2__step-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M3 12h12M3 18h8" stroke="#16B1D4" stroke-width="2" stroke-linecap="round"/><path d="M20 15l-3 3 3 3" stroke="#16B1D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</div>
					<h3 class="process-v2__step-title">Prioritise</h3>
					<p class="process-v2__step-desc">Rank opportunities by revenue impact and implementation speed for maximum ROI.</p>
				</div>
				<div class="process-v2__connector" aria-hidden="true"></div>
			</div>

			<div class="process-v2__step">
				<div class="process-v2__step-inner">
					<div class="process-v2__step-num">04</div>
					<div class="process-v2__step-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke="#16B1D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</div>
					<h3 class="process-v2__step-title">Execute</h3>
					<p class="process-v2__step-desc">Senior specialists implement changes with disciplined project management and QA.</p>
				</div>
				<div class="process-v2__connector" aria-hidden="true"></div>
			</div>

			<div class="process-v2__step">
				<div class="process-v2__step-inner">
					<div class="process-v2__step-num">05</div>
					<div class="process-v2__step-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18 20V10M12 20V4M6 20v-6" stroke="#16B1D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</div>
					<h3 class="process-v2__step-title">Measure</h3>
					<p class="process-v2__step-desc">Track rankings, traffic, and conversions with transparent reporting and real dashboards.</p>
				</div>
				<div class="process-v2__connector" aria-hidden="true"></div>
			</div>

			<div class="process-v2__step process-v2__step--last">
				<div class="process-v2__step-inner">
					<div class="process-v2__step-num">06</div>
					<div class="process-v2__step-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#16B1D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</div>
					<h3 class="process-v2__step-title">Compound</h3>
					<p class="process-v2__step-desc">Build on what works — authority, content, and technical gains compound over time.</p>
				</div>
			</div>

		</div><!-- /.process-v2__grid -->

		<div class="process-v2__cta">
			<a href="<?php echo esc_url(home_url('/free-seo-audit/')); ?>" class="btn btn--primary btn--lg">Start Your Free Audit →</a>
			<span class="process-v2__cta-note">No obligation. Results within 48 hours.</span>
		</div>

	</div>
</section>

<!-- ══════════════════════════════ CLIENT LOGOS ═══════════════════════════════════ -->
<div class="logos-bar">
	<div class="container">
		<p class="logos-bar__label">Trusted by 345+ UAE businesses across every industry</p>
		<div class="logos-bar__track">
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Al Barsha <span>Residences</span></span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Jumeirah <span>Bites</span></span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Tech<span>Flow</span> UAE</span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Med<span>Core</span> Dubai</span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Shop<span>AE</span>.com</span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Khalifa <span>Motors</span></span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Edu<span>Rise</span> Academy</span></div>
			<div class="logos-bar__logo"><span class="logos-bar__logo-text">Emirates <span>Legal</span></span></div>
		</div>
	</div>
</div>

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
<?php if ($testimonials) :
	// Build card data array once
	$testi_cards = [];
	foreach ($testimonials as $t) {
		$testi_cards[] = [
			'name'     => get_field('client_name',    $t->ID) ?: $t->post_title,
			'role'     => get_field('client_role',    $t->ID) ?: 'CEO',
			'company'  => get_field('client_company', $t->ID) ?: '',
			'rating'   => intval(get_field('rating',  $t->ID) ?: 5),
			'content'  => get_field('content',        $t->ID) ?: $t->post_content,
			'avatar'   => get_field('avatar',         $t->ID) ?: '',
			'verified' => get_field('verified',       $t->ID),
		];
	}
	$feat = $testi_cards[0]; // Featured = first card
?>
<section class="testi-section">

	<!-- ── Trust bar ── -->
	<div class="testi-trust-bar">
		<div class="container testi-trust-bar__inner">
			<div class="testi-trust-stat">
				<span class="testi-trust-num">4.9</span>
				<div>
					<div class="testi-trust-stars">★★★★★</div>
					<div class="testi-trust-label">Google Rating</div>
				</div>
			</div>
			<div class="testi-trust-divider"></div>
			<div class="testi-trust-stat">
				<span class="testi-trust-num">345<span class="testi-trust-plus">+</span></span>
				<div class="testi-trust-label">UAE Businesses<br>Served</div>
			</div>
			<div class="testi-trust-divider"></div>
			<div class="testi-trust-stat">
				<span class="testi-trust-num">99<span class="testi-trust-plus">%</span></span>
				<div class="testi-trust-label">Client Retention<br>Rate</div>
			</div>
			<div class="testi-trust-divider"></div>
			<div class="testi-trust-stat">
				<span class="testi-trust-num">8<span class="testi-trust-plus">+</span></span>
				<div class="testi-trust-label">Years Delivering<br>Results in UAE</div>
			</div>
		</div>
	</div>

	<!-- ── Section header ── -->
	<div class="container">
		<div class="testi-header">
			<?php seoae_section_label('Client Reviews'); ?>
			<h2 class="testi-header__title">Trusted by UAE's <span class="text-primary">Leading Businesses</span></h2>
			<p class="testi-header__sub">Real results from real clients, from Dubai startups to enterprise brands across the UAE.</p>
		</div>

		<!-- ── Featured testimonial ── -->
		<div class="testi-featured">
			<div class="testi-featured__quote-mark">"</div>
			<p class="testi-featured__text"><?php echo esc_html($feat['content']); ?></p>
			<div class="testi-featured__author">
				<div class="testi-featured__avatar"><?php echo esc_html(strtoupper(substr($feat['name'],0,1))); ?></div>
				<div>
					<p class="testi-featured__name"><?php echo esc_html($feat['name']); ?></p>
					<p class="testi-featured__role"><?php echo esc_html($feat['role'] . ($feat['company'] ? ', '.$feat['company'] : '')); ?></p>
				</div>
				<div class="testi-featured__stars">
					<?php for($i=0;$i<5;$i++) echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>'; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- ── Single-line marquee ── -->
	<?php
	if ( ! function_exists( 'seoae_testi_card' ) ) {
		function seoae_testi_card( array $c ): string {
			$init = esc_html( strtoupper( substr( $c['name'], 0, 1 ) ) );
			$name = esc_html( $c['name'] );
			$role = esc_html( $c['role'] . ( $c['company'] ? ', ' . $c['company'] : '' ) );
			$quote = esc_html( $c['content'] );
			$ver  = $c['verified'];
			$stars = '';
			for ( $i = 0; $i < 5; $i++ ) {
				$stars .= '<svg width="13" height="13" viewBox="0 0 24 24" fill="#F59E0B"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
			}
			$verified = $ver ? '<span class="tc-verified"><svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Verified</span>' : '';
			return "<div class=\"tc\">
			<div class=\"tc__top\"><div class=\"tc__stars\">$stars</div>$verified</div>
			<p class=\"tc__quote\">\"$quote\"</p>
			<div class=\"tc__author\">
				<div class=\"tc__avatar\">$init</div>
				<div><p class=\"tc__name\">$name</p><p class=\"tc__role\">$role</p></div>
			</div>
		</div>";
		}
	}
	?>

	<div class="testi-marquee testi-marquee--single" aria-label="Client testimonials">
		<div class="testi-marquee__row">
			<div class="testi-marquee__track testi-marquee__track--ltr">
				<?php foreach ( array_merge( $testi_cards, $testi_cards ) as $c ) { echo seoae_testi_card( $c ); } ?>
			</div>
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

<!-- ════════════════════════════ DUBAI LOCAL SEO CTA ════════════════════════════ -->
<section style="background:linear-gradient(135deg,#101A6A 0%,#0e2070 100%);padding:4rem 0;">
	<div class="container">
		<div style="display:grid;grid-template-columns:1fr auto;gap:2rem;align-items:center;flex-wrap:wrap;">
			<div>
				<span style="display:inline-block;background:rgba(22,177,212,.2);color:#16B1D4;font-size:.7rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;padding:.35rem .85rem;border-radius:20px;margin-bottom:.875rem;border:1px solid rgba(22,177,212,.3);">Dubai Local SEO</span>
				<h2 style="color:#fff;font-size:clamp(1.5rem,3vw,2.1rem);font-weight:800;line-height:1.2;margin-bottom:.75rem;">
					Based in Dubai. Serving All UAE Businesses.
				</h2>
				<p style="color:rgba(255,255,255,.72);font-size:.9375rem;line-height:1.7;max-width:520px;margin-bottom:0;">
					Our Dubai office delivers hyper-local SEO campaigns across every district — from Deira to Marina, Business Bay to Downtown. 6M+ monthly Dubai searches are waiting.
				</p>
			</div>
			<div style="display:flex;flex-direction:column;gap:.75rem;min-width:220px;">
				<a href="<?php echo esc_url(home_url('/dubai/')); ?>" class="btn btn--primary btn--lg" style="text-align:center;white-space:nowrap;">
					Dubai SEO Services →
				</a>
				<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--inverted" style="text-align:center;background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.25);">
					Get Free Local Audit
				</a>
			</div>
		</div>
	</div>
</section>

<!-- ════════════════════════════════ HOME FAQ ════════════════════════════════════ -->
<?php
$home_faqs = [
  [
    'q' => 'What are SEO services in Dubai?',
    'a' => 'SEO services in Dubai help businesses rank higher on Google for searches made by UAE customers. This includes technical audits, on-page optimisation, keyword research, content creation, link building, and local SEO. The goal is to drive qualified organic traffic that converts into leads and revenue — without the ongoing cost of paid advertising.',
  ],
  [
    'q' => 'Why does my business need SEO in the UAE?',
    'a' => 'With internet penetration above 99% and millions of monthly searches for business services across Dubai, Abu Dhabi, and the wider UAE, your customers are searching for what you offer right now. Without SEO, they find your competitors instead. Strong organic visibility is the most cost-effective, long-term customer acquisition channel available to UAE businesses.',
  ],
  [
    'q' => 'How long does SEO take to deliver results in the UAE?',
    'a' => 'Most UAE businesses see measurable ranking improvements within 60–90 days. Meaningful organic traffic growth typically follows between months 3 and 6. Highly competitive sectors — real estate, finance, healthcare, and legal — may require 6–12 months for top-3 Google positions. Local and long-tail keyword wins often appear within the first 30 days of a campaign launch.',
  ],
  [
    'q' => 'How much do SEO services cost in Dubai?',
    'a' => 'Dubai SEO retainers typically range from AED 3,000/month for local SME campaigns to AED 25,000+/month for competitive enterprise programmes. SearchEngineOptimization.ae offers transparent, fixed monthly pricing with no hidden fees and no lock-in contracts. We provide a custom quote after a free SEO audit that assesses your current rankings, competition, and growth potential.',
  ],
  [
    'q' => 'Do you provide Local SEO for Dubai and Abu Dhabi businesses?',
    'a' => 'Yes — local SEO is a core service. We optimise Google Business Profiles, build UAE-specific citation networks, create location-targeted landing pages, and implement local structured data. Our local SEO campaigns target the "near me" and location-modifier searches that drive direct calls, enquiries, and foot traffic for businesses serving specific Dubai or Abu Dhabi areas.',
  ],
  [
    'q' => 'Can you help my Google Business Profile rank higher?',
    'a' => 'Absolutely. We optimise every element of your Google Business Profile — categories, services, posts, photos, Q&A, and review management — specifically for UAE map pack rankings. Paired with consistent local citations and geo-targeted content, our GBP optimisation clients regularly enter the Google Maps 3-pack for their primary service categories within 60 days.',
  ],
  [
    'q' => 'What industries do you provide SEO services for?',
    'a' => 'We serve every major UAE industry: real estate, healthcare and clinics, legal and professional services, financial services and fintech, hospitality and tourism, e-commerce and retail, construction, logistics, education, restaurants and F&B, automotive, and technology. Each industry has a distinct search landscape — our sector-specific experience means we skip the learning curve and deliver results from month one.',
  ],
  [
    'q' => 'Do you offer Arabic and English SEO services?',
    'a' => 'Yes — bilingual Arabic and English SEO is a core offering. We conduct Arabic keyword research, produce native-quality Arabic content written by professional UAE-based writers, and implement hreflang for bilingual sites. In the UAE market, Arabic SEO can double your addressable organic audience and unlock commercially valuable searches your competitors are ignoring entirely.',
  ],
  [
    'q' => "What's included in your monthly SEO packages?",
    'a' => "Monthly retainers include: dedicated SEO strategist, full technical audit and implementation, keyword research and content strategy, on-page optimisation, content creation, link building outreach, Google Business Profile management, weekly automated rank tracking, and a monthly performance review call. Everything is in one fixed monthly fee — no surprise add-ons for reporting, content, or technical work.",
  ],
  [
    'q' => 'Do you optimize websites for Google AI Overviews and ChatGPT?',
    'a' => 'Yes — AI search optimisation (GEO/AIO) is a dedicated service. We structure your content, implement comprehensive schema markup, and build the entity authority signals that cause AI search engines to cite your brand in generated answers. Appearing in Google AI Overviews, ChatGPT, Perplexity, and Gemini responses is now essential for UAE brand visibility.',
  ],
  [
    'q' => 'How do you measure SEO success and ROI?',
    'a' => 'We track keyword rankings, organic traffic, organic lead volume, conversion rates, and revenue attribution — not vanity metrics. Every client receives a live dashboard with real-time data, weekly automated rank reports, and monthly strategy calls. We connect SEO performance directly to business outcomes so you always know exactly what your investment is delivering.',
  ],
  [
    'q' => 'Why choose SearchEngineOptimization.ae as your UAE SEO agency?',
    'a' => 'We are a UAE-specialist agency — not a global generalist applying cookie-cutter strategies. We have served 345+ UAE businesses across every major sector, have dedicated market research for every emirate, deliver full bilingual Arabic and English SEO, and focus exclusively on revenue outcomes. No lock-in contracts, transparent pricing, and a track record of measurable organic growth for UAE businesses.',
  ],
];

// FAQPage JSON-LD schema
$schema_items = array_map(fn($f) => [
  '@type'          => 'Question',
  'name'           => $f['q'],
  'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
], $home_faqs);
echo '<script type="application/ld+json">' . wp_json_encode([
  '@context'   => 'https://schema.org',
  '@type'      => 'FAQPage',
  'mainEntity' => $schema_items,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';

// Split into two columns
$col1 = array_slice($home_faqs, 0, 6);
$col2 = array_slice($home_faqs, 6);
?>

<section class="section home-faq-section" style="background:var(--color-muted-bg,#f0f4f8);padding:5rem 0;">
  <div class="container">

    <!-- Header -->
    <div class="section-header section-header--center" style="margin-bottom:3.5rem;">
      <?php seoae_section_label('FAQ'); ?>
      <h2 class="section-header__title" style="font-size:clamp(1.75rem,3.5vw,2.75rem);color:var(--color-heading,#101A6A);max-width:600px;margin-left:auto;margin-right:auto;line-height:1.15;">
        Common Questions<br>About SEO in the UAE
      </h2>
      <p class="section-header__desc" style="max-width:520px;margin-left:auto;margin-right:auto;">
        Everything UAE businesses want to know before starting an SEO campaign — answered clearly.
      </p>
    </div>

    <!-- 2-column accordion grid -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;align-items:start;" class="faq-grid-2col">

      <!-- Column 1 -->
      <div style="display:flex;flex-direction:column;gap:.75rem;">
        <?php foreach ($col1 as $i => $faq) :
          $uid = 'hfaq-a-' . $i; ?>
        <div class="hfaq-item" style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;overflow:hidden;transition:border-color .2s,box-shadow .2s;">
          <button class="hfaq-trigger"
            aria-expanded="false"
            aria-controls="<?php echo $uid; ?>"
            style="width:100%;display:flex;justify-content:space-between;align-items:center;gap:1rem;padding:1.1rem 1.35rem;background:none;border:none;cursor:pointer;text-align:left;">
            <span style="font-weight:700;font-size:.9375rem;color:var(--color-heading,#101A6A);line-height:1.35;"><?php echo esc_html($faq['q']); ?></span>
            <span class="hfaq-icon" aria-hidden="true"
              style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--color-primary,#16B1D4);display:flex;align-items:center;justify-content:center;transition:background .2s,transform .2s;">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            </span>
          </button>
          <div id="<?php echo $uid; ?>" class="hfaq-body" hidden
            style="padding:0 1.35rem 1.2rem;font-size:.875rem;color:var(--color-body,#4a5568);line-height:1.75;border-top:1px solid #f0f4f8;">
            <?php echo esc_html($faq['a']); ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Column 2 -->
      <div style="display:flex;flex-direction:column;gap:.75rem;">
        <?php foreach ($col2 as $i => $faq) :
          $uid = 'hfaq-b-' . $i; ?>
        <div class="hfaq-item" style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;overflow:hidden;transition:border-color .2s,box-shadow .2s;">
          <button class="hfaq-trigger"
            aria-expanded="false"
            aria-controls="<?php echo $uid; ?>"
            style="width:100%;display:flex;justify-content:space-between;align-items:center;gap:1rem;padding:1.1rem 1.35rem;background:none;border:none;cursor:pointer;text-align:left;">
            <span style="font-weight:700;font-size:.9375rem;color:var(--color-heading,#101A6A);line-height:1.35;"><?php echo esc_html($faq['q']); ?></span>
            <span class="hfaq-icon" aria-hidden="true"
              style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--color-primary,#16B1D4);display:flex;align-items:center;justify-content:center;transition:background .2s,transform .2s;">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            </span>
          </button>
          <div id="<?php echo $uid; ?>" class="hfaq-body" hidden
            style="padding:0 1.35rem 1.2rem;font-size:.875rem;color:var(--color-body,#4a5568);line-height:1.75;border-top:1px solid #f0f4f8;">
            <?php echo esc_html($faq['a']); ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div><!-- /faq-grid-2col -->

    <!-- Bottom CTA strip -->
    <div style="text-align:center;margin-top:3rem;padding:2.5rem;background:linear-gradient(135deg,#101A6A 0%,#1a2d8a 100%);border-radius:20px;">
      <p style="color:rgba(255,255,255,.75);font-size:.9375rem;margin-bottom:1rem;">Still have questions? Talk to a UAE SEO specialist — no sales pressure.</p>
      <a href="/contact/" class="btn btn--primary btn--lg" style="background:var(--color-primary,#16B1D4);color:#fff;">Get a Free SEO Consultation →</a>
    </div>

  </div>
</section>

<style>
/* Home FAQ accordion */
.hfaq-item:hover {
  border-color: var(--color-primary, #16B1D4) !important;
  box-shadow: 0 4px 20px rgba(22,177,212,.10);
}
.hfaq-trigger[aria-expanded="true"] .hfaq-icon {
  background: var(--color-heading, #101A6A) !important;
  transform: rotate(45deg);
}
.hfaq-trigger[aria-expanded="true"] {
  color: var(--color-primary, #16B1D4);
}
.hfaq-body {
  display: none;
}
.hfaq-body.is-open {
  display: block;
}
@media (max-width: 768px) {
  .faq-grid-2col { grid-template-columns: 1fr !important; }
}
</style>

<script>
(function () {
  document.querySelectorAll('.hfaq-trigger').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var expanded = this.getAttribute('aria-expanded') === 'true';
      var bodyId   = this.getAttribute('aria-controls');
      var body     = document.getElementById(bodyId);
      if (!body) return;
      if (expanded) {
        this.setAttribute('aria-expanded', 'false');
        body.classList.remove('is-open');
      } else {
        this.setAttribute('aria-expanded', 'true');
        body.classList.add('is-open');
      }
    });
  });
})();
</script>

<!-- ════════════════════════════════ DARK CTA ════════════════════════════════════ -->
<?php seoae_cta_dark(); ?>

<?php get_footer(); ?>
