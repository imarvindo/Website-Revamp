<?php
/**
 * Template Name: Dubai Location Page
 * Dubai SEO agency landing page  -  targets "SEO agency Dubai", "digital marketing Dubai"
 * and geo-modified local search queries.
 */
get_header();

// ── Local schema ──────────────────────────────────────────────────────────────
$schema_org = [
	'@context' => 'https://schema.org',
	'@type'    => ['LocalBusiness','ProfessionalService','MarketingAgency'],
	'name'     => 'SearchEngineOptimization.ae  -  Dubai SEO Agency',
	'alternateName' => ['SEO Agency Dubai','Digital Marketing Agency Dubai'],
	'description'   => "Dubai's #1 SEO and digital marketing agency. We help Dubai businesses dominate Google search, drive qualified traffic, and convert visitors into customers. Enterprise SEO, PPC, social media, and web design from our Deira, Dubai office.",
	'url'      => home_url('/dubai/'),
	'logo'     => SEOAE_URI . '/assets/images/logo.svg',
	'image'    => SEOAE_URI . '/assets/images/og-image.jpg',
	'email'    => seoae_email(),
	'address'  => [
		'@type'           => 'PostalAddress',
		'streetAddress'   => 'M-01, Muteena Street, Above Saravana Bhavan',
		'addressLocality' => 'Deira, Dubai',
		'addressRegion'   => 'Dubai',
		'postalCode'      => '00000',
		'addressCountry'  => 'AE',
	],
	'geo' => [
		'@type'     => 'GeoCoordinates',
		'latitude'  => '25.2721',
		'longitude' => '55.3279',
	],
	'areaServed' => [
		'Dubai','Deira','Bur Dubai','Dubai Marina','Business Bay',
		'Downtown Dubai','JLT','DIFC','Al Quoz','Jumeirah',
	],
	'priceRange'   => '$$$$',
	'openingHours' => 'Mo-Fr 09:00-18:00',
	'sameAs'       => array_filter([
		function_exists('get_field') ? get_field('social_linkedin','option')  : '',
		function_exists('get_field') ? get_field('social_instagram','option') : '',
		function_exists('get_field') ? get_field('social_facebook','option')  : '',
	]),
];

// AggregateRating and Review schema are emitted in the GBP widget section below,
// only when the Google Places API is configured and returns real review data.
echo '<script type="application/ld+json">' . wp_json_encode($schema_org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

// ── Dubai FAQs ────────────────────────────────────────────────────────────────
$dubai_faqs = [
	[
		'question' => 'How much do SEO services cost in Dubai?',
		'answer'   => 'Dubai SEO retainers typically range from AED 3,000/month for local SME campaigns to AED 25,000+/month for competitive enterprise programmes. SearchEngineOptimization.ae offers transparent, fixed monthly pricing with no hidden fees and no lock-in contracts. We provide a custom quote after a free SEO audit.',
	],
	[
		'question' => 'How long does SEO take to work for a Dubai business?',
		'answer'   => 'Most Dubai businesses see measurable ranking improvements within 60-90 days. Meaningful organic traffic growth typically follows in months 3-6. Highly competitive sectors such as real estate, finance, and legal may require 6-12 months for top-3 Google positions. Local and long-tail keyword wins often appear within the first 30 days.',
	],
	[
		'question' => 'Do you offer local SEO for specific Dubai areas like Marina or Business Bay?',
		'answer'   => 'Yes. We create neighbourhood-level location pages, optimise your Google Business Profile for specific Dubai districts, and build area-targeted citation networks. We cover all major Dubai zones: Marina, Business Bay, Downtown, Deira, JLT, DIFC, Jumeirah, Bur Dubai, and more.',
	],
	[
		'question' => 'Can you do Arabic SEO for my Dubai business?',
		'answer'   => 'Absolutely. Bilingual Arabic and English SEO is a core offering. We conduct Arabic keyword research, produce native-quality Arabic content by UAE-based writers, and implement hreflang for bilingual sites. Arabic SEO can double your addressable organic audience in the UAE market.',
	],
	[
		'question' => 'Do you provide SEO for e-commerce businesses in Dubai?',
		'answer'   => 'Yes. We deliver full e-commerce SEO including product and category page optimisation, schema markup for products and reviews, site architecture improvements, and conversion-focused content. We have worked with Shopify, WooCommerce, Magento, and custom platforms for Dubai-based online retailers.',
	],
	[
		'question' => 'What industries do you serve in Dubai?',
		'answer'   => 'We serve all major Dubai industries: real estate, hospitality and tourism, healthcare and clinics, legal and professional services, financial services and fintech, e-commerce and retail, restaurants and F&B, construction, education, automotive, SaaS and technology. Each industry has a dedicated sector-specific SEO strategy.',
	],
	[
		'question' => 'Do you also run Google Ads (PPC) campaigns in Dubai?',
		'answer'   => 'Yes. We offer fully managed Google Ads and Meta Ads campaigns targeting Dubai audiences. Our PPC service complements SEO  -  capturing immediate traffic while organic rankings build. Clients often run both services together as an integrated growth package.',
	],
	[
		'question' => 'How do I get a free SEO audit for my Dubai website?',
		'answer'   => 'Simply fill in the contact form on this page or email sales@searchengineoptimization.ae. Our team will conduct a full technical and keyword audit of your site and deliver a personalised report within 48 hours  -  no obligation, no sales pressure.',
	],
	[
		'question' => 'Where is your Dubai office located?',
		'answer'   => 'Our office is located at M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE. We serve clients across all Dubai districts and the wider UAE remotely with monthly in-person strategy sessions available on request.',
	],
	[
		'question' => 'Why choose SearchEngineOptimization.ae over other Dubai SEO agencies?',
		'answer'   => 'We are a UAE-specialist agency, not a global generalist. We have served 345+ UAE businesses across every major sector, deliver full bilingual Arabic and English SEO, and focus exclusively on revenue outcomes. No lock-in contracts, transparent pricing, and a proven track record of measurable organic growth for Dubai businesses.',
	],
];

// FAQ Schema
$faq_schema_items = array_map(fn($f) => [
	'@type'          => 'Question',
	'name'           => $f['question'],
	'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['answer']],
], $dubai_faqs);
echo '<script type="application/ld+json">' . wp_json_encode([
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => $faq_schema_items,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>

<!-- ═══════════════════════════════ HERO ════════════════════════════════════ -->
<section class="service-hero bg-dark" style="padding:5rem 0 4rem;">
	<div class="container">
		<!-- Breadcrumb -->
		<nav class="breadcrumbs" aria-label="Breadcrumb">
			<a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
			<span>/</span>
			<span>SEO Agency Dubai</span>
		</nav>

		<div class="service-hero__inner" style="display:grid;grid-template-columns:1.3fr 0.7fr;gap:3.5rem;align-items:start;margin-top:2rem;">

			<!-- Left: Copy -->
			<div>
				<?php seoae_section_label('Dubai Local SEO'); ?>
				<h1 style="color:#fff;font-size:clamp(2rem,4vw,3.4rem);font-weight:900;line-height:1.1;margin:1.1rem 0;">
					SEO Agency in Dubai
					<br><span style="color:var(--color-primary,#16B1D4);">Drive Local Search Growth</span>
				</h1>
				<p style="color:rgba(255,255,255,.78);font-size:1.075rem;max-width:520px;line-height:1.7;margin-bottom:2.25rem;">
					Dubai sees <strong style="color:#fff;">6M+ monthly Google searches</strong> for products and services. We help Dubai businesses rank higher, capture that traffic, and convert visitors into paying customers  -  with transparent monthly pricing and no lock-in contracts.
				</p>
				<div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2rem;">
					<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Get Free Dubai SEO Audit →</a>
					<a href="<?php echo esc_url(home_url('/case-studies/')); ?>" class="btn btn--outline-white btn--lg">View Results</a>
				</div>
				<div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
					<div style="display:flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.6);font-size:.825rem;">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
						No lock-in contracts
					</div>
					<div style="display:flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.6);font-size:.825rem;">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
						Audit within 48 hours
					</div>
					<div style="display:flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.6);font-size:.825rem;">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
						Arabic + English SEO
					</div>
				</div>
			</div>

			<!-- Right: Stats panel -->
			<div style="display:flex;flex-direction:column;gap:.875rem;">
				<div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:1.5rem;text-align:center;">
					<div style="font-size:2.4rem;font-weight:900;color:var(--color-primary,#16B1D4);line-height:1;">6M+</div>
					<div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-top:.35rem;">Monthly Dubai Google Searches</div>
				</div>
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;">340%</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">Avg. ROI Increase</div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:var(--color-primary,#16B1D4);">90 Days</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">To Page 1 Rankings</div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;">4.9</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">Google Rating</div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;">345+</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">UAE Businesses Served</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- ═══════════════════════════ WHY DUBAI BUSINESSES ════════════════════════ -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Dubai Market Expertise'); ?>
			<h2>Why Dubai Businesses Choose SearchEngineOptimization.ae</h2>
			<p class="section-header__desc" style="max-width:560px;margin-left:auto;margin-right:auto;">
				We are not a global agency applying generic templates. We are Dubai-native SEO specialists with deep knowledge of the UAE search landscape.
			</p>
		</div>
		<div class="why-grid" style="margin-top:2.5rem;">
			<?php
			$points = [
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
					'title' => 'Dubai Market Expertise',
					'desc'  => 'Deep knowledge of the Dubai competitive landscape, local search behaviour, seasonal patterns, and high-value commercial keywords across all major industries.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
					'title' => 'Proven Dubai Rankings',
					'desc'  => 'We have achieved page-1 Google rankings for Dubai businesses in competitive sectors including real estate, hospitality, legal, healthcare, and e-commerce.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 5h12M9 3v2m1.048 3.938C11.25 9.657 11.998 11.02 13 12M5 7a4 4 0 004 4M3 21v-4a2 2 0 012-2h4a2 2 0 012 2v4"/></svg>',
					'title' => 'Arabic + English SEO',
					'desc'  => 'Full bilingual optimisation for Dubai\'s dual-language search audience. Arabic SEO alone can double your organic reach across UAE and GCC markets.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
					'title' => 'Data-Driven Strategy',
					'desc'  => 'Every campaign is backed by Dubai-specific keyword research, competitor analysis, intent mapping, and monthly performance benchmarks aligned to your revenue goals.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>',
					'title' => 'Transparent Reporting',
					'desc'  => 'Weekly rank tracking, monthly strategy calls, and a live dashboard showing exactly how your Dubai SEO is performing  -  no vanity metrics, only revenue-relevant data.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
					'title' => 'Fast Execution',
					'desc'  => 'Strategy to implementation in days, not weeks. We move at the pace Dubai\'s competitive market demands with dedicated senior specialists on every account.',
				],
			];
			foreach ($points as $p) : ?>
			<div class="why-card">
				<div class="why-card__icon" style="color:var(--color-primary,#16B1D4);"><?php echo $p['icon']; ?></div>
				<h3 class="why-card__title"><?php echo esc_html($p['title']); ?></h3>
				<p class="why-card__desc"><?php echo esc_html($p['desc']); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ LOCAL STATS STRIP ════════════════════════════ -->
<section style="background:linear-gradient(135deg,#101A6A 0%,#0d226a 50%,#101A6A 100%);padding:3.5rem 0;">
	<div class="container">
		<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;text-align:center;">
			<?php
			$local_stats = [
				['num' => '6M+',  'label' => 'Dubai monthly Google searches'],
				['num' => '99%',  'label' => 'UAE internet penetration rate'],
				['num' => '#1',   'label' => 'Dubai ranked as MENA\'s digital hub'],
				['num' => '3.5M', 'label' => 'Dubai population actively searching online'],
			];
			foreach ($local_stats as $s) : ?>
			<div>
				<div style="font-size:2.25rem;font-weight:900;color:var(--color-primary,#16B1D4);line-height:1;"><?php echo esc_html($s['num']); ?></div>
				<div style="font-size:.8rem;color:rgba(255,255,255,.6);margin-top:.5rem;line-height:1.4;"><?php echo esc_html($s['label']); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ SERVICES IN DUBAI ═══════════════════════════ -->
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Services in Dubai'); ?>
			<h2>Complete SEO &amp; Digital Marketing Services in Dubai</h2>
			<p class="section-header__desc" style="max-width:540px;margin-left:auto;margin-right:auto;">
				From technical SEO to AI search optimisation  -  every service tuned to Dubai's search landscape.
			</p>
		</div>
		<div class="services-grid" style="margin-top:2.5rem;">
			<?php
			$svcs = [
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>',
					'title' => 'Search Engine Optimisation',
					'url'   => '/services/search-engine-optimization/',
					'desc'  => 'Full-service SEO strategy to dominate Dubai Google results  -  technical, on-page, and off-page.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>',
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
					'title' => 'AI Search Optimisation',
					'url'   => '/services/ai-search-optimization/',
					'desc'  => 'Get your Dubai business featured in Google AI Overviews, ChatGPT, Perplexity, and Gemini.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/></svg>',
					'title' => 'PPC Management Dubai',
					'url'   => '/services/ppc-management/',
					'desc'  => 'Google Ads and Meta Ads campaigns precisely targeted at Dubai audiences and buyer intent.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
					'title' => 'Social Media Marketing',
					'url'   => '/services/social-media-marketing/',
					'desc'  => 'Build brand authority and engagement across Dubai\'s Instagram, LinkedIn, and TikTok audiences.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
					'title' => 'Web Design Dubai',
					'url'   => '/services/web-design/',
					'desc'  => 'High-converting, fast-loading websites designed for Dubai businesses and their customers.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>',
					'title' => 'Web Development',
					'url'   => '/services/web-development/',
					'desc'  => 'Custom web solutions engineered for performance, scalability, and UAE market requirements.',
				],
			];
			foreach ($svcs as $s) : ?>
			<a href="<?php echo esc_url(home_url($s['url'])); ?>" class="service-card">
				<div class="service-card__icon" style="color:var(--color-primary,#16B1D4);margin-bottom:.75rem;"><?php echo $s['icon']; ?></div>
				<h3 class="service-card__title"><?php echo esc_html($s['title']); ?></h3>
				<p class="service-card__desc"><?php echo esc_html($s['desc']); ?></p>
				<span class="service-card__link">Learn More →</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ DUBAI DISTRICTS ═════════════════════════════ -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Hyper-Local Coverage'); ?>
			<h2>SEO Services Across All Dubai Districts</h2>
			<p class="section-header__desc" style="max-width:540px;margin-left:auto;margin-right:auto;">
				We create neighbourhood-level SEO strategies so your business ranks for the exact area searches your customers make.
			</p>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem;margin-top:2.5rem;">
			<?php
			$districts = [
				['name' => 'Dubai Marina',     'url' => '/dubai/marina/',       'has_page' => true],
				['name' => 'Business Bay',     'url' => '/dubai/business-bay/', 'has_page' => true],
				['name' => 'Downtown Dubai',   'url' => '/dubai/downtown/',     'has_page' => true],
				['name' => 'Deira',            'url' => '/dubai/deira/',        'has_page' => true],
				['name' => 'DIFC',             'url' => '/dubai/difc/',         'has_page' => true],
				['name' => 'JLT',              'url' => '/dubai/jlt/',          'has_page' => true],
				['name' => 'Jumeirah',         'url' => '/dubai/jumeirah/',     'has_page' => true],
				['name' => 'Bur Dubai',        'url' => '/dubai/bur-dubai/',    'has_page' => true],
				['name' => 'Al Quoz',          'url' => '/dubai/al-quoz/',      'has_page' => true],
				['name' => 'Dubai Hills',      'url' => '/dubai/dubai-hills/',  'has_page' => true],
				['name' => 'Palm Jumeirah',    'url' => '/dubai/palm-jumeirah/','has_page' => true],
				['name' => 'Mirdif',           'url' => '/dubai/mirdif/',       'has_page' => true],
			];
			foreach ($districts as $d) :
				$tag = $d['has_page'] ? 'a' : 'div';
				$link_attr = $d['has_page'] ? ' href="' . esc_url(home_url($d['url'])) . '"' : '';
				$border_color = $d['has_page'] ? 'var(--color-primary,#16B1D4)' : '#e2e8f0';
			?>
			<<?php echo $tag; ?><?php echo $link_attr; ?> style="background:#f8fafc;border:1.5px solid <?php echo $border_color; ?>;border-radius:12px;padding:1.1rem 1.25rem;transition:border-color .2s,box-shadow .2s;text-decoration:none;display:block;" class="card-lift">
				<div style="display:flex;align-items:center;gap:.6rem;">
					<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
					<span style="font-weight:600;font-size:.875rem;color:#101A6A;"><?php echo esc_html($d['name']); ?></span>
				</div>
				<p style="font-size:.75rem;color:<?php echo $d['has_page'] ? 'var(--color-primary,#16B1D4)' : '#6b7280'; ?>;margin-top:.35rem;font-weight:<?php echo $d['has_page'] ? '600' : '400'; ?>;">
					<?php echo $d['has_page'] ? 'View District SEO →' : 'Local SEO Services'; ?>
				</p>
			</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ PROCESS ═════════════════════════════════════ -->
<section class="section" style="background:#f0f4f8;">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('How We Work'); ?>
			<h2>Our Dubai SEO Process</h2>
			<p class="section-header__desc" style="max-width:520px;margin-left:auto;margin-right:auto;">
				A proven, repeatable process that moves Dubai businesses from obscurity to the first page of Google.
			</p>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;margin-top:2.5rem;">
			<?php
			$steps = [
				['num'=>'01','title'=>'Free SEO Audit','desc'=>'We analyse your site\'s current rankings, technical health, content gaps, and competitive position in Dubai\'s search landscape.'],
				['num'=>'02','title'=>'Dubai Keyword Research','desc'=>'We identify the exact queries Dubai customers use to find businesses like yours  -  including Arabic search terms your competitors are missing.'],
				['num'=>'03','title'=>'Strategy & Roadmap','desc'=>'A clear 90-day roadmap with prioritised actions, traffic projections, and revenue goals specific to your Dubai market.'],
				['num'=>'04','title'=>'Implementation','desc'=>'Senior specialists execute technical fixes, on-page optimisation, content creation, and link building  -  fast and with full QA.'],
				['num'=>'05','title'=>'Track & Report','desc'=>'Weekly rank tracking, monthly performance calls, and a live dashboard. You always know exactly where you stand.'],
				['num'=>'06','title'=>'Compound & Scale','desc'=>'As rankings and authority build, we identify new opportunities and scale the channels delivering the highest ROI for your Dubai business.'],
			];
			foreach ($steps as $s) : ?>
			<div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:16px;padding:1.75rem;">
				<div style="font-size:.75rem;font-weight:800;color:var(--color-primary,#16B1D4);letter-spacing:.15em;text-transform:uppercase;margin-bottom:.75rem;"><?php echo esc_html($s['num']); ?></div>
				<h3 style="font-size:1.05rem;font-weight:700;color:#101A6A;margin-bottom:.6rem;"><?php echo esc_html($s['title']); ?></h3>
				<p style="font-size:.875rem;color:#6b7280;line-height:1.65;"><?php echo esc_html($s['desc']); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ GOOGLE BUSINESS EMBED ═══════════════════════ -->
<section class="section bg-white">
	<div class="container" style="max-width:900px;">
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;">
			<div>
				<?php seoae_section_label('Find Us in Dubai'); ?>
				<h2 style="font-size:clamp(1.5rem,2.5vw,2rem);font-weight:800;color:#101A6A;margin:1rem 0;">
					Visit Our Dubai Office
				</h2>
				<p style="color:#6b7280;font-size:.9375rem;line-height:1.7;margin-bottom:1.5rem;">
					We are conveniently located in Deira, Dubai  -  one of the emirate's most established business districts. Drop in for a consultation or reach us remotely from anywhere in the UAE.
				</p>
				<div style="display:flex;flex-direction:column;gap:.875rem;">
					<div style="display:flex;align-items:flex-start;gap:.875rem;">
						<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2" style="flex-shrink:0;margin-top:.1rem;"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
						<div>
							<p style="font-weight:600;color:#101A6A;font-size:.9rem;margin-bottom:.2rem;">Office Address</p>
							<p style="font-size:.875rem;color:#6b7280;"><?php echo esc_html(seoae_address()); ?></p>
						</div>
					</div>
					<div style="display:flex;align-items:flex-start;gap:.875rem;">
						<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2" style="flex-shrink:0;margin-top:.1rem;"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
						<div>
							<p style="font-weight:600;color:#101A6A;font-size:.9rem;margin-bottom:.2rem;">Email</p>
							<a href="mailto:<?php echo esc_attr(seoae_email()); ?>" style="font-size:.875rem;color:var(--color-primary,#16B1D4);"><?php echo esc_html(seoae_email()); ?></a>
						</div>
					</div>
					<div style="display:flex;align-items:flex-start;gap:.875rem;">
						<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2" style="flex-shrink:0;margin-top:.1rem;"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
						<div>
							<p style="font-weight:600;color:#101A6A;font-size:.9rem;margin-bottom:.2rem;">Business Hours</p>
							<p style="font-size:.875rem;color:#6b7280;">Monday - Friday, 9:00 AM - 6:00 PM</p>
						</div>
					</div>
				</div>
				<div style="margin-top:1.75rem;">
					<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Book a Free Consultation →</a>
				</div>
			</div>
			<!-- Google Maps embed placeholder -->
			<div style="border-radius:16px;overflow:hidden;border:1.5px solid #e2e8f0;height:320px;background:#f0f4f8;display:flex;align-items:center;justify-content:center;">
				<iframe
					title="SearchEngineOptimization.ae Dubai Office Location"
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.5660348994366!2d55.325!3d25.272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjXCsDE2JzE5LjIiTiA1NcKwMTknMzAuMCJF!5e0!3m2!1sen!2sae!4v1690000000000!5m2!1sen!2sae"
					width="100%"
					height="320"
					style="border:0;display:block;"
					allowfullscreen=""
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade">
				</iframe>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ GOOGLE BUSINESS PROFILE REVIEW WIDGET ════════════════ -->
<?php
/**
 * Fetch real Google Business Profile reviews via Places API.
 * seoae_get_gbp_reviews() is defined in functions.php.
 * Returns structured data (rating, user_ratings_total, reviews[], profile_url)
 * or false when the Place ID / API key are not yet configured in Theme Settings.
 */
$gbp = seoae_get_gbp_reviews();
?>
<section class="section" style="background:linear-gradient(180deg,#fff 0%,#f8fafc 100%);">
	<div class="container">

<?php if ( $gbp && ! empty( $gbp['reviews'] ) ) :
	// ── A. GBP API is configured and returned real reviews ──────────────────
	$gbp_rating      = $gbp['rating'];
	$gbp_total       = $gbp['user_ratings_total'];
	$gbp_profile_url = $gbp['profile_url'];

	// Emit Review + AggregateRating schema from real GBP data
	$gbp_schema_reviews = [];
	foreach ( $gbp['reviews'] as $r ) {
		$gbp_schema_reviews[] = [
			'@type'        => 'Review',
			'author'       => [ '@type' => 'Person', 'name' => $r['author_name'] ],
			'reviewBody'   => $r['text'],
			'reviewRating' => [ '@type' => 'Rating', 'ratingValue' => $r['rating'], 'bestRating' => '5' ],
		];
	}
	if ( $gbp_schema_reviews ) {
		$gbp_schema = [
			'@context'        => 'https://schema.org',
			'@type'           => 'LocalBusiness',
			'name'            => 'SearchEngineOptimization.ae  -  Dubai SEO Agency',
			'url'             => home_url( '/dubai/' ),
			'aggregateRating' => [
				'@type'       => 'AggregateRating',
				'ratingValue' => (string) $gbp_rating,
				'reviewCount' => (string) $gbp_total,
				'bestRating'  => '5',
				'worstRating' => '1',
			],
			'review' => $gbp_schema_reviews,
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $gbp_schema, JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
?>
		<div class="section-header section-header--center">
			<?php seoae_section_label('Google Reviews'); ?>
			<h2>What Our Clients Say on Google</h2>
			<p class="section-header__desc" style="max-width:540px;margin-left:auto;margin-right:auto;">
				Real reviews from our Google Business Profile  -  written by Dubai businesses we have helped grow.
			</p>
		</div>

		<!-- Aggregate rating bar  -  sourced from GBP API -->
		<div style="display:flex;align-items:center;justify-content:center;gap:2rem;flex-wrap:wrap;margin:2rem 0 2.75rem;padding:1.5rem 2rem;background:#fff;border:1.5px solid #e2e8f0;border-radius:18px;max-width:520px;margin-left:auto;margin-right:auto;">
			<div style="text-align:center;">
				<div style="font-size:3rem;font-weight:900;color:#101A6A;line-height:1;"><?php echo esc_html( number_format( $gbp_rating, 1 ) ); ?></div>
				<div style="display:flex;gap:3px;justify-content:center;margin:.3rem 0;">
					<?php for ( $s = 1; $s <= 5; $s++ ) : ?>
					<svg width="18" height="18" viewBox="0 0 24 24" fill="<?php echo $s <= floor( $gbp_rating ) ? '#FBBF24' : '#e2e8f0'; ?>"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
					<?php endfor; ?>
				</div>
				<div style="font-size:.8rem;color:#6b7280;font-weight:600;"><?php echo esc_html( number_format( $gbp_rating, 1 ) ); ?> out of 5</div>
			</div>
			<div style="width:1.5px;height:60px;background:#e2e8f0;"></div>
			<div>
				<div style="font-size:1.75rem;font-weight:800;color:#101A6A;line-height:1.1;"><?php echo esc_html( number_format( $gbp_total ) ); ?>+</div>
				<div style="font-size:.8rem;color:#6b7280;margin-top:.25rem;">Google reviews</div>
				<!-- Google logo  -  used only here because data IS from Google -->
				<div style="display:flex;align-items:center;gap:.4rem;margin-top:.5rem;">
					<svg width="16" height="16" viewBox="0 0 24 24" aria-label="Google"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
					<span style="font-size:.75rem;color:#6b7280;font-weight:600;">Google Business Profile</span>
				</div>
			</div>
		</div>

		<!-- Review cards  -  one per GBP review returned by the API (up to 5) -->
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem;">
			<?php foreach ( $gbp['reviews'] as $rev ) :
				$stars    = (int) $rev['rating'];
				$initials = strtoupper( mb_substr( $rev['author_name'], 0, 1 ) );
				$ago      = esc_html( $rev['relative_time_description'] );
			?>
			<div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:18px;padding:1.6rem 1.75rem;display:flex;flex-direction:column;gap:1rem;transition:box-shadow .2s;" class="card-lift">
				<div style="display:flex;align-items:flex-start;gap:.875rem;">
					<div style="flex-shrink:0;">
						<?php if ( ! empty( $rev['profile_photo_url'] ) ) : ?>
						<img src="<?php echo esc_url( $rev['profile_photo_url'] ); ?>" alt="<?php echo esc_attr( $rev['author_name'] ); ?>" width="44" height="44" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;">
						<?php else : ?>
						<div style="width:44px;height:44px;border-radius:50%;background:var(--color-primary,#16B1D4);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:800;color:#fff;"><?php echo esc_html( $initials ); ?></div>
						<?php endif; ?>
					</div>
					<div style="flex:1;min-width:0;">
						<?php if ( ! empty( $rev['author_url'] ) ) : ?>
						<a href="<?php echo esc_url( $rev['author_url'] ); ?>" target="_blank" rel="noopener noreferrer" style="font-weight:700;font-size:.9375rem;color:#101A6A;text-decoration:none;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo esc_html( $rev['author_name'] ); ?></a>
						<?php else : ?>
						<div style="font-weight:700;font-size:.9375rem;color:#101A6A;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo esc_html( $rev['author_name'] ); ?></div>
						<?php endif; ?>
						<?php if ( $ago ) : ?>
						<div style="font-size:.775rem;color:#9ca3af;margin-top:.1rem;"><?php echo $ago; ?></div>
						<?php endif; ?>
						<div style="display:flex;gap:2px;margin-top:.35rem;">
							<?php for ( $s = 1; $s <= 5; $s++ ) : ?>
							<svg width="13" height="13" viewBox="0 0 24 24" fill="<?php echo $s <= $stars ? '#FBBF24' : '#e2e8f0'; ?>"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
							<?php endfor; ?>
						</div>
					</div>
					<!-- Google "G" icon per card  -  data IS from Google -->
					<svg width="18" height="18" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:.2rem;" aria-label="Google review"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
				</div>
				<p style="font-size:.875rem;color:#374151;line-height:1.72;margin:0;flex:1;">
					"<?php echo esc_html( $rev['text'] ); ?>"
				</p>
				<div style="display:flex;align-items:center;gap:.4rem;padding-top:.75rem;border-top:1px solid #f0f4f8;">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#16B1D4" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
					<span style="font-size:.72rem;font-weight:600;color:#16B1D4;text-transform:uppercase;letter-spacing:.07em;">Google Review</span>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div style="text-align:center;margin-top:2.25rem;">
			<a href="<?php echo esc_url( $gbp_profile_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--outline" style="border-color:#e2e8f0;color:#101A6A;">
				See All <?php echo esc_html( number_format( $gbp_total ) ); ?> Google Reviews →
			</a>
		</div>

<?php else :
	// ── B. GBP not yet configured  -  show a transparent, honest placeholder ──
	// No fabricated ratings, no fake reviews. Just a clean prompt to configure or visit the profile.
	$gbp_profile_url = 'https://search.google.com/local/reviews?placeid='; // blank until configured
?>
		<div class="section-header section-header--center">
			<?php seoae_section_label('Google Reviews'); ?>
			<h2>See Our Google Business Profile Reviews</h2>
		</div>

		<div style="max-width:560px;margin:2rem auto 0;padding:2.5rem 2rem;background:#fff;border:2px dashed #e2e8f0;border-radius:20px;text-align:center;">
			<!-- Google logo -->
			<div style="display:flex;align-items:center;justify-content:center;gap:.5rem;margin-bottom:1.25rem;">
				<svg width="28" height="28" viewBox="0 0 24 24" aria-label="Google"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
				<span style="font-size:1.1rem;font-weight:700;color:#101A6A;">Google Business Profile</span>
			</div>
			<p style="color:#6b7280;font-size:.9375rem;line-height:1.7;margin-bottom:1.5rem;">
				We are rated by our clients on Google. Visit our Google Business Profile to read our verified reviews.
			</p>
			<a href="https://www.google.com/search?q=SearchEngineOptimization.ae+Dubai" target="_blank" rel="noopener noreferrer" class="btn btn--primary">
				Read Our Google Reviews →
			</a>
			<?php if ( current_user_can( 'manage_options' ) ) : ?>
			<p style="margin-top:1.25rem;font-size:.8rem;color:#9ca3af;border-top:1px solid #f0f4f8;padding-top:1rem;">
				<strong>Admin notice:</strong> To display live GBP reviews here, add your Google Place ID and Places API key under
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=seoae-theme-settings' ) ); ?>" style="color:var(--color-primary,#16B1D4);">Theme Settings → Google Business</a>.
			</p>
			<?php endif; ?>
		</div>

<?php endif; ?>
	</div>
</section>

<!-- ═══════════════════════════ INDUSTRIES SERVED ════════════════════════════ -->
<section class="section" style="background:#f0f4f8;">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Industry Expertise'); ?>
			<h2>Dubai Industries We Serve</h2>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.875rem;margin-top:2.25rem;">
			<?php
			$industries = [
				['name' => 'Real Estate',          'url' => '/real-estate-seo/'],
				['name' => 'Healthcare',            'url' => '/healthcare-seo/'],
				['name' => 'Hospitality',           'url' => '/hospitality-seo/'],
				['name' => 'Legal Services',        'url' => '/legal-seo/'],
				['name' => 'Finance & Fintech',     'url' => '/finance-seo/'],
				['name' => 'E-Commerce',            'url' => '/ecommerce-seo/'],
				['name' => 'Education',             'url' => '/education-seo/'],
				['name' => 'Automotive',            'url' => '/automotive-seo/'],
				['name' => 'SaaS & B2B',            'url' => '/saas-b2b-seo/'],
			];
			foreach ($industries as $ind) : ?>
			<a href="<?php echo esc_url(home_url($ind['url'])); ?>" style="background:#fff;border:1.5px solid #e2e8f0;border-radius:10px;padding:.9rem 1rem;font-weight:600;font-size:.8125rem;color:#101A6A;display:flex;align-items:center;gap:.5rem;transition:border-color .2s,color .2s;text-decoration:none;" class="hover-primary">
				<svg width="11" height="11" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<?php echo esc_html($ind['name']); ?>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ FAQ SECTION ══════════════════════════════════ -->
<section class="section bg-white">
	<div class="container" style="max-width:800px;">
		<div class="section-header section-header--center">
			<?php seoae_section_label('FAQ'); ?>
			<h2>Frequently Asked Questions  -  SEO Agency Dubai</h2>
			<p class="section-header__desc" style="max-width:520px;margin-left:auto;margin-right:auto;">
				Everything Dubai businesses want to know before starting an SEO campaign.
			</p>
		</div>
		<div class="faq-list" style="margin-top:2.5rem;">
			<?php foreach ($dubai_faqs as $i => $faq) :
				$uid = 'dubai-faq-' . $i; ?>
			<div class="faq-item" style="border:1.5px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:.75rem;">
				<button
					class="faq-trigger"
					aria-expanded="false"
					aria-controls="<?php echo esc_attr($uid); ?>"
					style="width:100%;display:flex;justify-content:space-between;align-items:center;gap:1rem;padding:1.1rem 1.35rem;background:none;border:none;cursor:pointer;text-align:left;">
					<span style="font-weight:700;font-size:.9375rem;color:#101A6A;line-height:1.35;"><?php echo esc_html($faq['question']); ?></span>
					<span class="faq-icon" aria-hidden="true"
						style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--color-primary,#16B1D4);display:flex;align-items:center;justify-content:center;transition:transform .2s;">
						<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
					</span>
				</button>
				<div id="<?php echo esc_attr($uid); ?>" class="faq-body" hidden
					style="padding:0 1.35rem 1.2rem;font-size:.875rem;color:#6b7280;line-height:1.75;border-top:1px solid #f0f4f8;">
					<?php echo esc_html($faq['answer']); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<script>
(function () {
	document.querySelectorAll('.faq-trigger').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var expanded = this.getAttribute('aria-expanded') === 'true';
			var bodyId   = this.getAttribute('aria-controls');
			var body     = document.getElementById(bodyId);
			var icon     = this.querySelector('.faq-icon');
			if (!body) return;
			if (expanded) {
				this.setAttribute('aria-expanded', 'false');
				body.hidden = true;
				if (icon) icon.style.transform = '';
			} else {
				this.setAttribute('aria-expanded', 'true');
				body.hidden = false;
				if (icon) icon.style.transform = 'rotate(45deg)';
			}
		});
	});
})();
</script>

<?php
seoae_cta_dark(
	"Ready to Dominate Dubai's Digital Landscape?",
	'Join 345+ UAE businesses that trust SearchEngineOptimization.ae to drive measurable organic growth. Get your free Dubai SEO audit today.',
	'Get Free Dubai SEO Audit',
	home_url('/contact/'),
	'Email Us',
	'mailto:' . seoae_email()
);
get_footer();
