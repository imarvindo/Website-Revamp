<?php
/**
 * Template Name: Abu Dhabi Location Page
 * Abu Dhabi SEO agency landing page — targets "SEO agency Abu Dhabi",
 * "digital marketing Abu Dhabi", "SEO company Abu Dhabi" and geo-modified queries.
 */
get_header();

// ── Local schema ──────────────────────────────────────────────────────────────
$schema_org = [
	'@context' => 'https://schema.org',
	'@type'    => ['LocalBusiness','ProfessionalService','MarketingAgency'],
	'name'     => 'SearchEngineOptimization.ae — Abu Dhabi SEO Agency',
	'alternateName' => ['SEO Agency Abu Dhabi','Digital Marketing Agency Abu Dhabi','SEO Company Abu Dhabi'],
	'description'   => "Abu Dhabi's leading SEO and digital marketing agency. We help Abu Dhabi businesses dominate Google search, attract high-intent traffic, and convert visitors into customers. Enterprise SEO, PPC, social media, and web design tailored to the Abu Dhabi market.",
	'url'      => get_permalink(get_the_ID()),
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
	'areaServed' => [
		'Abu Dhabi','Al Ain','Al Reem Island','Yas Island','Saadiyat Island',
		'Khalidiyah','Corniche','Mussafah','Khalifa City','Al Maryah Island',
	],
	'priceRange'   => '$$$$',
	'openingHours' => 'Mo-Fr 09:00-18:00',
	'sameAs'       => array_filter([
		function_exists('get_field') ? get_field('social_linkedin','option')  : '',
		function_exists('get_field') ? get_field('social_instagram','option') : '',
		function_exists('get_field') ? get_field('social_facebook','option')  : '',
	]),
];
echo '<script type="application/ld+json">' . wp_json_encode($schema_org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

// ── Abu Dhabi FAQs ────────────────────────────────────────────────────────────
$city_faqs = [
	[
		'question' => 'How much do SEO services cost in Abu Dhabi?',
		'answer'   => 'Abu Dhabi SEO retainers typically range from AED 3,500/month for local SME campaigns to AED 30,000+/month for large government-linked enterprise programmes. SearchEngineOptimization.ae provides transparent, fixed monthly pricing with no hidden fees and no lock-in contracts. We deliver a custom quote after a free SEO audit of your site.',
	],
	[
		'question' => 'How long does SEO take to show results for an Abu Dhabi business?',
		'answer'   => 'Most Abu Dhabi businesses see measurable ranking improvements within 60–90 days. Meaningful organic traffic growth typically follows in months 3–6. Competitive sectors such as government services, real estate, finance, and legal services may require 6–12 months for top-3 Google positions. Local and long-tail keyword wins often appear within the first 30 days.',
	],
	[
		'question' => 'Do you provide Arabic SEO for Abu Dhabi businesses?',
		'answer'   => 'Yes. Bilingual Arabic and English SEO is a core offering. Abu Dhabi has a particularly high proportion of Arabic-language searches compared to other emirates. We conduct Arabic keyword research, produce native-quality Arabic content by UAE-based writers, and implement hreflang for bilingual sites. Arabic SEO can double your addressable organic audience in the Abu Dhabi market.',
	],
	[
		'question' => 'Can you help Abu Dhabi government-linked or regulated businesses with SEO?',
		'answer'   => 'Absolutely. We have extensive experience working with Abu Dhabi businesses operating under ADGM, CBUAE, and other regulatory frameworks. Our content and link-building strategies are fully compliant with UAE advertising regulations and government sector guidelines.',
	],
	[
		'question' => 'Do you offer local SEO for specific Abu Dhabi areas like Yas Island or Al Maryah Island?',
		'answer'   => 'Yes. We create area-specific location pages, optimise your Google Business Profile for individual Abu Dhabi districts, and build area-targeted citation networks. We cover all major Abu Dhabi zones including Corniche, Khalidiyah, Al Reem Island, Al Maryah Island, Yas Island, Saadiyat Island, Mussafah, Khalifa City, and Al Ain.',
	],
	[
		'question' => 'What industries do you serve in Abu Dhabi?',
		'answer'   => 'We serve all major Abu Dhabi industries: oil and gas, government and public sector, real estate and property, hospitality and tourism, healthcare and clinics, legal and professional services, financial services and fintech, education, construction, retail and e-commerce, automotive, and SaaS and technology. Each sector has a dedicated, strategy-specific SEO programme.',
	],
	[
		'question' => 'Do you run Google Ads (PPC) campaigns in Abu Dhabi?',
		'answer'   => 'Yes. We offer fully managed Google Ads and Meta Ads campaigns precisely targeted at Abu Dhabi audiences and buyer intent. Our PPC service complements SEO — capturing immediate traffic while organic rankings build. Abu Dhabi clients often combine both services as an integrated growth package.',
	],
	[
		'question' => 'How do I get a free SEO audit for my Abu Dhabi website?',
		'answer'   => 'Fill in the contact form on this page or email sales@searchengineoptimization.ae. Our team will conduct a full technical, on-page, and keyword audit of your site and deliver a personalised report within 48 hours — no obligation, no sales pressure.',
	],
	[
		'question' => 'Can you optimise our site for Abu Dhabi and Dubai simultaneously?',
		'answer'   => 'Yes. Many of our clients are UAE-wide businesses that need to rank in both Abu Dhabi and Dubai. We build a geo-targeted content architecture with separate city landing pages, dual Google Business Profile management, and emirate-specific keyword targeting — all from a single unified SEO strategy.',
	],
	[
		'question' => 'Why choose SearchEngineOptimization.ae over other Abu Dhabi SEO agencies?',
		'answer'   => 'We are a UAE-specialist agency, not a global generalist. We have served 345+ UAE businesses across every major sector, deliver full bilingual Arabic and English SEO, and focus exclusively on revenue outcomes. No lock-in contracts, transparent pricing, and a proven track record of measurable organic growth for Abu Dhabi businesses.',
	],
];

// FAQ Schema
$faq_schema_items = array_map(fn($f) => [
	'@type'          => 'Question',
	'name'           => $f['question'],
	'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['answer']],
], $city_faqs);
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
			<a href="<?php echo esc_url(home_url('/locations/')); ?>">Locations</a>
			<span>/</span>
			<span>SEO Agency Abu Dhabi</span>
		</nav>

		<div class="service-hero__inner" style="display:grid;grid-template-columns:1.3fr 0.7fr;gap:3.5rem;align-items:start;margin-top:2rem;">

			<!-- Left: Copy -->
			<div>
				<?php seoae_section_label('Abu Dhabi Local SEO'); ?>
				<h1 style="color:#fff;font-size:clamp(2rem,4vw,3.4rem);font-weight:900;line-height:1.1;margin:1.1rem 0;">
					SEO Agency in Abu Dhabi
					<br><span style="color:var(--color-primary,#16B1D4);">Drive Local Search Growth</span>
				</h1>
				<p style="color:rgba(255,255,255,.78);font-size:1.075rem;max-width:520px;line-height:1.7;margin-bottom:2.25rem;">
					Abu Dhabi generates <strong style="color:#fff;">2.4M+ monthly Google searches</strong> for local products and services. We help Abu Dhabi businesses rank higher, capture that traffic, and convert visitors into paying customers — with transparent monthly pricing and no lock-in contracts.
				</p>
				<div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2rem;">
					<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Get Free Abu Dhabi SEO Audit →</a>
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
					<div style="font-size:2.4rem;font-weight:900;color:var(--color-primary,#16B1D4);line-height:1;">2.4M+</div>
					<div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-top:.35rem;">Monthly Abu Dhabi Google Searches</div>
				</div>
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;">320%</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">Avg. ROI Increase</div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:var(--color-primary,#16B1D4);">90 Days</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">To Page 1 Rankings</div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;">4.9★</div>
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

<!-- ═══════════════════════════ WHY ABU DHABI BUSINESSES ════════════════════ -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Abu Dhabi Market Expertise'); ?>
			<h2>Why Abu Dhabi Businesses Choose SearchEngineOptimization.ae</h2>
			<p class="section-header__desc" style="max-width:560px;margin-left:auto;margin-right:auto;">
				We are not a global agency applying generic templates. We are UAE-native SEO specialists with deep knowledge of the Abu Dhabi search landscape and its unique industries.
			</p>
		</div>
		<div class="why-grid" style="margin-top:2.5rem;">
			<?php
			$points = [
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
					'title' => 'Abu Dhabi Market Expertise',
					'desc'  => 'Deep knowledge of the Abu Dhabi competitive landscape, including government-linked enterprises, oil & gas, real estate, and the city\'s unique bilingual search behaviour.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
					'title' => 'Proven Abu Dhabi Rankings',
					'desc'  => 'We have achieved page-1 Google rankings for Abu Dhabi businesses in competitive sectors including real estate on Al Reem Island, healthcare clinics, legal firms, and hospitality on Yas Island.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 5h12M9 3v2m1.048 3.938C11.25 9.657 11.998 11.02 13 12M5 7a4 4 0 004 4M3 21v-4a2 2 0 012-2h4a2 2 0 012 2v4"/></svg>',
					'title' => 'Arabic-First SEO',
					'desc'  => 'Abu Dhabi has a higher Arabic-language search share than any other emirate. Our native Arabic SEO content and keyword strategy captures the audience your competitors are missing.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
					'title' => 'Data-Driven Strategy',
					'desc'  => 'Every campaign is backed by Abu Dhabi-specific keyword research, competitor analysis, intent mapping, and monthly performance benchmarks aligned to your revenue goals.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>',
					'title' => 'Transparent Reporting',
					'desc'  => 'Weekly rank tracking, monthly strategy calls, and a live dashboard showing exactly how your Abu Dhabi SEO is performing — no vanity metrics, only revenue-relevant data.',
				],
				[
					'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
					'title' => 'Fast Execution',
					'desc'  => 'Strategy to implementation in days, not weeks. We move at the pace Abu Dhabi\'s competitive market demands, with dedicated senior specialists on every account.',
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
				['num' => '2.4M+', 'label' => 'Abu Dhabi monthly Google searches'],
				['num' => '99%',   'label' => 'UAE internet penetration rate'],
				['num' => '#1',    'label' => 'Abu Dhabi — UAE capital & government hub'],
				['num' => '1.5M',  'label' => 'Abu Dhabi population actively searching online'],
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

<!-- ═══════════════════════════ SERVICES IN ABU DHABI ═══════════════════════ -->
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Services in Abu Dhabi'); ?>
			<h2>Complete SEO &amp; Digital Marketing Services in Abu Dhabi</h2>
			<p class="section-header__desc" style="max-width:540px;margin-left:auto;margin-right:auto;">
				From technical SEO to AI search optimisation — every service tuned to Abu Dhabi's unique search landscape and enterprise market.
			</p>
		</div>
		<div class="services-grid" style="margin-top:2.5rem;">
			<?php
			$svcs = [
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>',
					'title' => 'Search Engine Optimisation',
					'url'   => '/services/search-engine-optimization/',
					'desc'  => 'Full-service SEO strategy to dominate Abu Dhabi Google results — technical, on-page, and off-page.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
					'title' => 'AI Search Optimisation',
					'url'   => '/services/ai-search-optimization/',
					'desc'  => 'Get your Abu Dhabi business featured in Google AI Overviews, ChatGPT, Perplexity, and Gemini.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/></svg>',
					'title' => 'PPC Management Abu Dhabi',
					'url'   => '/services/ppc-management/',
					'desc'  => 'Google Ads and Meta Ads campaigns precisely targeted at Abu Dhabi audiences and buyer intent.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
					'title' => 'Social Media Marketing',
					'url'   => '/services/social-media-marketing/',
					'desc'  => 'Build brand authority and engagement across Abu Dhabi\'s Instagram, LinkedIn, and TikTok audiences.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
					'title' => 'Web Design Abu Dhabi',
					'url'   => '/services/web-design/',
					'desc'  => 'High-converting, fast-loading websites designed for Abu Dhabi businesses and their customers.',
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

<!-- ═══════════════════════════ ABU DHABI AREAS ═════════════════════════════ -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Hyper-Local Coverage'); ?>
			<h2>SEO Services Across All Abu Dhabi Areas</h2>
			<p class="section-header__desc" style="max-width:540px;margin-left:auto;margin-right:auto;">
				We create area-specific SEO strategies so your business ranks for the exact neighbourhood searches your customers make in Abu Dhabi.
			</p>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem;margin-top:2.5rem;">
			<?php
			$districts = [
				'Corniche','Al Reem Island','Al Maryah Island','Khalidiyah',
				'Yas Island','Saadiyat Island','Mussafah','Khalifa City',
				'Al Ain','Al Raha Beach','Mohammed Bin Zayed City','Hamdan Street',
			];
			foreach ($districts as $d) : ?>
			<div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:1.1rem 1.25rem;transition:border-color .2s,box-shadow .2s;" class="card-lift">
				<div style="display:flex;align-items:center;gap:.6rem;">
					<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
					<span style="font-weight:600;font-size:.875rem;color:#101A6A;"><?php echo esc_html($d); ?></span>
				</div>
				<p style="font-size:.75rem;color:#6b7280;margin-top:.35rem;">Local SEO Services</p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════════════ PROCESS ═════════════════════════════════════ -->
<section class="section" style="background:#f0f4f8;">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('How We Work'); ?>
			<h2>Our Abu Dhabi SEO Process</h2>
			<p class="section-header__desc" style="max-width:520px;margin-left:auto;margin-right:auto;">
				A proven, repeatable process that moves Abu Dhabi businesses from obscurity to the first page of Google.
			</p>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;margin-top:2.5rem;">
			<?php
			$steps = [
				['num'=>'01','title'=>'Free SEO Audit','desc'=>'We analyse your site\'s current rankings, technical health, content gaps, and competitive position in Abu Dhabi\'s search landscape.'],
				['num'=>'02','title'=>'Abu Dhabi Keyword Research','desc'=>'We identify the exact queries Abu Dhabi customers use to find businesses like yours — including Arabic search terms and government-sector keywords your competitors are missing.'],
				['num'=>'03','title'=>'Strategy & Roadmap','desc'=>'A clear 90-day roadmap with prioritised actions, traffic projections, and revenue goals specific to your Abu Dhabi target market.'],
				['num'=>'04','title'=>'Implementation','desc'=>'Senior specialists execute technical fixes, on-page optimisation, bilingual Arabic/English content creation, and targeted link building — fast and with full QA.'],
				['num'=>'05','title'=>'Track & Report','desc'=>'Weekly rank tracking, monthly performance calls, and a live dashboard. You always know exactly where you stand in Abu Dhabi search results.'],
				['num'=>'06','title'=>'Compound & Scale','desc'=>'As rankings and domain authority build, we identify new keyword opportunities and scale the channels delivering the highest ROI for your Abu Dhabi business.'],
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

<!-- ═══════════════════════════ INDUSTRIES SERVED ════════════════════════════ -->
<section class="section" style="background:#f0f4f8;">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Industry Expertise'); ?>
			<h2>Abu Dhabi Industries We Serve</h2>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.875rem;margin-top:2.25rem;">
			<?php
			$industries = [
				['name' => 'Oil & Gas',             'url' => '/industries/'],
				['name' => 'Real Estate',            'url' => '/real-estate-seo/'],
				['name' => 'Healthcare',             'url' => '/healthcare-seo/'],
				['name' => 'Hospitality',            'url' => '/hospitality-seo/'],
				['name' => 'Legal Services',         'url' => '/legal-seo/'],
				['name' => 'Finance & Fintech',      'url' => '/finance-seo/'],
				['name' => 'Government & Public',    'url' => '/industries/'],
				['name' => 'Education',              'url' => '/education-seo/'],
				['name' => 'Construction',           'url' => '/industries/'],
				['name' => 'Retail & E-Commerce',    'url' => '/ecommerce-seo/'],
				['name' => 'Automotive',             'url' => '/automotive-seo/'],
				['name' => 'SaaS & B2B',             'url' => '/saas-b2b-seo/'],
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
			<h2>Frequently Asked Questions — SEO Agency Abu Dhabi</h2>
			<p class="section-header__desc" style="max-width:520px;margin-left:auto;margin-right:auto;">
				Everything Abu Dhabi businesses want to know before starting an SEO campaign.
			</p>
		</div>
		<div class="faq-list" style="margin-top:2.5rem;">
			<?php foreach ($city_faqs as $i => $faq) :
				$uid = 'abudhabi-faq-' . $i; ?>
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
	"Ready to Dominate Abu Dhabi's Search Results?",
	'Join 345+ UAE businesses that trust SearchEngineOptimization.ae to drive measurable organic growth. Get your free Abu Dhabi SEO audit today.',
	'Get Free Abu Dhabi SEO Audit',
	home_url('/contact/'),
	'Email Us',
	'mailto:' . seoae_email()
);
get_footer();
