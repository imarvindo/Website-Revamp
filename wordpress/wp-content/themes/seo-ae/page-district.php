<?php
/**
 * Template Name: Dubai District Page
 * Neighbourhood-level SEO landing pages for Dubai districts.
 * Handles: /dubai/{slug}/ for Marina, Business Bay, Downtown, Deira + 8 more.
 */
get_header();

// ── District data ─────────────────────────────────────────────────────────────
$districts = [
	'marina' => [
		'name'        => 'Dubai Marina',
		'slug'        => 'marina',
		'geo_lat'     => '25.0800',
		'geo_lng'     => '55.1404',
		'tagline'     => 'The Marina Mile - Where Luxury Brands Compete for Every Click',
		'hero_intro'  => 'Dubai Marina generates over <strong style="color:#fff;">400,000+ monthly searches</strong> for restaurants, real estate, fitness, and lifestyle. Rank above your Marina neighbours with hyper-local SEO built for this high-density, high-intent district.',
		'searches'    => '400K+',
		'searches_label' => 'Monthly Marina Google Searches',
		'stat1'       => ['value' => '312%',    'label' => 'Avg. Traffic Increase'],
		'stat2'       => ['value' => '60 Days', 'label' => 'First Ranking Results'],
		'landmarks'   => ['Marina Walk', 'JBR Beach', 'Dubai Marina Mall', 'Pier 7', 'The Walk at JBR', 'Bluewater Island', 'Ain Dubai'],
		'business_types' => ['waterfront restaurants & cafés', 'luxury real estate developers', 'fitness studios & wellness centres', 'marina yacht services', 'boutique hotels & serviced apartments', 'retail brands on The Walk'],
		'local_intro' => 'Dubai Marina is one of the most competitive local search markets in the UAE. With over 200 restaurants, dozens of real estate agencies, and hundreds of lifestyle businesses clustered along a 3km waterfront strip, ranking for "near me" and district-specific searches directly drives footfall and leads.',
		'why_points'  => [
			['title' => 'Marina-Specific Keyword Research', 'desc' => 'We map the exact search queries Marina visitors use - from "restaurants Dubai Marina" to "marina apartments for sale" - and build content that captures every stage of buyer intent.'],
			['title' => 'Google Business Profile Optimisation', 'desc' => 'Marina searches are heavily local-pack-driven. We optimise your GBP for the Marina area, generate high-quality review strategies, and build local citations pointing to this district.'],
			['title' => 'Competitor Gap Analysis', 'desc' => 'We analyse every ranking Marina competitor in your sector, identify their content and backlink gaps, and execute a strategy to overtake them on the keywords that matter most.'],
			['title' => 'Hyperlocal Content', 'desc' => 'Our copywriters create Marina-specific landing pages, neighbourhood guides, and service content that Google recognises as genuinely local - not generic templates.'],
		],
		'services_intro' => 'Every major search category in Dubai Marina has fierce competition. Our SEO services are tailored to the Marina\'s unique mix of luxury, lifestyle, and high-turnover hospitality businesses.',
		'faqs' => [
			[
				'question' => 'What types of businesses benefit most from Marina SEO?',
				'answer'   => 'Restaurants, cafés, real estate agencies, fitness studios, hotels, beauty salons, and yacht services in Dubai Marina see the highest ROI from local SEO because residents and tourists search for these services specifically by neighbourhood - "best sushi Dubai Marina", "gym near Marina Walk" - creating high-intent local traffic.',
			],
			[
				'question' => 'How does local SEO work for Dubai Marina businesses?',
				'answer'   => 'Local SEO for Marina combines Google Business Profile optimisation (so you appear in the local map pack), Marina-targeted website content, local citation building across UAE directories, and review generation strategies. Together these signals tell Google your business is the authority for its category in Dubai Marina.',
			],
			[
				'question' => 'How long before my Marina business ranks on Google?',
				'answer'   => 'Most Marina businesses see local pack improvements within 30-60 days for lower-competition searches. Organic page-1 rankings for competitive terms like "Dubai Marina restaurants" or "Marina apartments for sale" typically take 3-6 months of sustained optimisation.',
			],
			[
				'question' => 'Do you manage Google Ads for Marina businesses too?',
				'answer'   => 'Yes. We offer fully managed Google Ads and Meta Ads campaigns targeting Marina audiences. PPC is particularly effective during the Marina\'s peak tourist seasons (October-April) and can be used alongside SEO to capture immediate traffic while organic rankings build.',
			],
			[
				'question' => 'Can you help a new Marina business rank quickly?',
				'answer'   => 'Absolutely. For new businesses with no domain authority, we prioritise Google Business Profile, local citations, and long-tail keyword content - channels that can deliver visible results within 30-45 days even for a brand-new Marina listing.',
			],
		],
	],

	'business-bay' => [
		'name'        => 'Business Bay',
		'slug'        => 'business-bay',
		'geo_lat'     => '25.1865',
		'geo_lng'     => '55.2618',
		'tagline'     => 'The Corporate Heartbeat - B2B Search Dominance in Business Bay',
		'hero_intro'  => 'Business Bay is Dubai\'s fastest-growing business hub with over <strong style="color:#fff;">350,000+ monthly searches</strong> for professional services, corporate real estate, and B2B solutions. Outrank your Business Bay competitors and capture high-value commercial leads.',
		'searches'    => '350K+',
		'searches_label' => 'Monthly Business Bay Google Searches',
		'stat1'       => ['value' => '285%',    'label' => 'Avg. Lead Increase'],
		'stat2'       => ['value' => '75 Days', 'label' => 'First Page Rankings'],
		'landmarks'   => ['Bay Square', 'The Opus', 'Marasi Business Bay', 'Conrad Dubai', 'Business Bay Metro Station', 'Burj Khalifa (adjacent)', 'Dubai Water Canal'],
		'business_types' => ['legal and professional services firms', 'corporate real estate agencies', 'management consultancies', 'financial services and fintech companies', 'co-working spaces and business centres', 'corporate hospitality and events'],
		'local_intro' => 'Business Bay has over 240 completed towers hosting thousands of businesses competing for the same high-value B2B searches. Ranking for "law firm Business Bay", "corporate office Business Bay", or "financial advisory Dubai" means capturing decision-maker traffic that converts at significantly higher rates than consumer searches.',
		'why_points'  => [
			['title' => 'B2B SEO Specialists', 'desc' => 'Business Bay is a B2B-dominated zone. We build keyword strategies around the commercial intent searches decision-makers use: "accounting firm Business Bay", "legal services Dubai CBD", "management consulting UAE".'],
			['title' => 'LinkedIn & Professional Visibility', 'desc' => 'We combine SEO with targeted content strategies that build topical authority for professional services - increasing visibility not just on Google but across the professional digital ecosystem that Business Bay clients use.'],
			['title' => 'Local Citation & Directory Coverage', 'desc' => 'We build citations across UAE business directories, Google Business Profile, and sector-specific platforms - cementing Business Bay as your primary service location for Google\'s local algorithms.'],
			['title' => 'Conversion-Focused Content', 'desc' => 'B2B buyers research thoroughly before contacting. We create service pages, case studies, and comparison content that captures mid-funnel queries and moves high-value prospects toward enquiry.'],
		],
		'services_intro' => 'Business Bay\'s corporate ecosystem demands a sophisticated, B2B-first approach to SEO. We have helped professional services firms, real estate agencies, and corporate service providers rank for the decision-maker searches that drive their pipeline.',
		'faqs' => [
			[
				'question' => 'What industries in Business Bay benefit most from SEO?',
				'answer'   => 'Professional services (legal, financial, consulting), corporate real estate agencies, business centres, and B2B technology companies in Business Bay see the highest return from SEO. Their clients conduct research-heavy searches - "Dubai corporate law firm", "business setup services Business Bay" - making organic visibility a key source of qualified leads.',
			],
			[
				'question' => 'Is SEO effective for B2B businesses in Business Bay?',
				'answer'   => 'Yes - often more effective than for consumer businesses. B2B decision-makers in Dubai conduct extensive research before engaging suppliers, meaning high-ranking content that addresses commercial intent questions (comparisons, guides, case studies) can generate high-quality inbound leads with conversion rates exceeding paid channels.',
			],
			[
				'question' => 'How do you approach SEO for a professional services firm in Business Bay?',
				'answer'   => 'We begin with B2B keyword research mapping every stage of the buyer journey for your sector. We then optimise existing service pages, create new topical authority content, build relevant backlinks from UAE business publications, and optimise your Google Business Profile for the Business Bay location specifically.',
			],
			[
				'question' => 'How quickly can a Business Bay company see results?',
				'answer'   => 'Professional service firms with established domains typically see ranking improvements within 45-75 days. For new Business Bay businesses or those with technical SEO issues, a full technical audit and fix phase is completed in the first month, with ranking progress following in months 2-3.',
			],
			[
				'question' => 'Do you handle SEO for businesses with multiple Business Bay offices?',
				'answer'   => 'Yes. For businesses with multiple Business Bay locations or across several floors in a single tower, we create distinct location-level content and GBP entries for each, maximising local search visibility for every physical presence.',
			],
		],
	],

	'downtown' => [
		'name'        => 'Downtown Dubai',
		'slug'        => 'downtown',
		'geo_lat'     => '25.1972',
		'geo_lng'     => '55.2744',
		'tagline'     => "World's Most Iconic Address - SEO for Downtown Dubai Businesses",
		'hero_intro'  => 'Downtown Dubai drives over <strong style="color:#fff;">500,000+ monthly searches</strong> fuelled by the Burj Khalifa, Dubai Mall, and a global tourist audience. Rank for the highest-value searches in the UAE\'s most prestigious commercial district.',
		'searches'    => '500K+',
		'searches_label' => 'Monthly Downtown Dubai Google Searches',
		'stat1'       => ['value' => '340%',    'label' => 'Avg. Traffic Increase'],
		'stat2'       => ['value' => '60 Days', 'label' => 'First Ranking Results'],
		'landmarks'   => ['Burj Khalifa', 'Dubai Mall', 'Dubai Fountain', 'Souk Al Bahar', 'The Address Downtown', 'Dubai Opera', 'Emaar Boulevard'],
		'business_types' => ['luxury retail and flagship brand stores', 'fine dining and upscale restaurants', 'luxury hotel properties', 'premium real estate developers', 'tourist experience operators', 'high-end wellness and spa brands'],
		'local_intro' => 'Downtown Dubai is the most searched commercial zone in the UAE. With 80+ million annual visitors to Dubai Mall alone, the search volume for Downtown businesses is unmatched in the region. Ranking for "Downtown Dubai restaurants", "Burj Khalifa hotels", or "Dubai Mall luxury shopping" means capturing both resident and global tourist intent at massive scale.',
		'why_points'  => [
			['title' => 'Tourism & Hospitality SEO', 'desc' => 'Downtown\'s business mix is heavily tourism-driven. We build keyword strategies that capture both local resident searches and global tourist queries - including searches from travellers planning before they arrive in Dubai.'],
			['title' => 'Google Maps & Local Pack Dominance', 'desc' => 'Near-me and map searches dominate Downtown. We focus heavily on GBP optimisation, review strategy, and local citation accuracy to ensure you appear in the map pack for your category across the Downtown area.'],
			['title' => 'E-A-T Content for Luxury Brands', 'desc' => 'Luxury and premium brands require authoritative content that matches Google\'s E-E-A-T standards. Our editorial team creates high-quality copy that positions Downtown businesses as the category authority in their niche.'],
			['title' => 'Seasonal & Event SEO', 'desc' => 'Downtown Dubai has distinct search peaks around Dubai Shopping Festival, New Year\'s Eve, Dubai Expo season, and other major events. We plan content calendars that capitalise on these spikes to maximise organic traffic at peak demand.'],
		],
		'services_intro' => 'Downtown Dubai\'s combination of luxury retail, hospitality, and international tourism demands an SEO strategy built for both local and global search intent. Our Downtown SEO campaigns target the full spectrum of high-value queries that drive footfall and direct bookings.',
		'faqs' => [
			[
				'question' => 'What types of Downtown Dubai businesses need SEO the most?',
				'answer'   => 'Restaurants, hotels, retail boutiques, wellness and spa venues, and entertainment experiences in Downtown Dubai benefit enormously from SEO because both residents and global tourists use Google to discover them before and during their visit. With 80M+ annual Dubai Mall visitors, even small gains in search visibility translate to significant footfall increases.',
			],
			[
				'question' => 'How do you target both tourists and residents with Downtown Dubai SEO?',
				'answer'   => 'We segment keyword strategy into two streams: local resident intent ("best restaurant near Dubai Mall", "gym Downtown Dubai") and tourist intent ("things to do near Burj Khalifa", "where to eat Dubai Downtown"). Content, GBP optimisation, and link building are tailored for each audience to maximise combined reach.',
			],
			[
				'question' => 'How competitive is Downtown Dubai for SEO?',
				'answer'   => 'Very competitive. Categories like "restaurants Downtown Dubai" and "Dubai Mall hotels" are among the most contested local search terms in the UAE. Success requires a sustained, multi-channel strategy - technical SEO, on-page optimisation, content authority, link building, and GBP management working together over 6-12 months for top positions.',
			],
			[
				'question' => 'Can SEO drive direct hotel bookings or restaurant reservations in Downtown?',
				'answer'   => 'Yes. For Downtown hotels and restaurants, organic search is one of the highest-converting acquisition channels because intent is highly specific ("Burj Khalifa view restaurant booking", "Downtown Dubai luxury hotel deals"). We optimise for these conversion-intent queries and ensure landing pages are structured to drive reservations directly.',
			],
			[
				'question' => 'Do you manage multilingual SEO for Downtown Dubai businesses?',
				'answer'   => 'Yes. Downtown Dubai has a significant multilingual audience including Arabic, Russian, Chinese, and Indian language searchers. We offer bilingual Arabic-English SEO as standard and can coordinate multilingual campaigns for additional languages based on your target audience.',
			],
		],
	],

	'deira' => [
		'name'        => 'Deira',
		'slug'        => 'deira',
		'geo_lat'     => '25.2721',
		'geo_lng'     => '55.3279',
		'tagline'     => "Dubai's Original Trading Hub - Digital Growth for Deira Businesses",
		'hero_intro'  => 'Deira is Dubai\'s oldest and most densely-traded commercial district, with <strong style="color:#fff;">300,000+ monthly searches</strong> for wholesale, retail, gold, spices, and traditional trade. Modernise your Deira business\'s online presence and capture the district\'s high-frequency commercial searches.',
		'searches'    => '300K+',
		'searches_label' => 'Monthly Deira Google Searches',
		'stat1'       => ['value' => '275%',    'label' => 'Avg. Traffic Increase'],
		'stat2'       => ['value' => '60 Days', 'label' => 'First Ranking Results'],
		'landmarks'   => ['Gold Souk', 'Spice Souk', 'Deira City Centre', 'Dubai Creek', 'Al Rigga Street', 'Naif Souk', 'Muteena Street'],
		'business_types' => ['gold and jewellery retailers', 'wholesale and import/export businesses', 'traditional souks and traders', 'hotels and budget hospitality', 'money exchange and financial services', 'retail and electronics distributors'],
		'local_intro' => 'Deira represents the original commercial heart of Dubai - a high-density trading district where thousands of businesses compete for wholesale buyers, retail customers, and digital-native shoppers who search online before visiting the souk. Many Deira businesses have strong offline reputations but minimal digital presence, creating a significant first-mover SEO opportunity for those who act now.',
		'why_points'  => [
			['title' => 'First-Mover Advantage in Deira', 'desc' => 'Many Deira businesses are yet to invest seriously in SEO, creating an opportunity to rank for high-frequency local searches - "gold souk Dubai", "wholesale electronics Deira" - before competitors build domain authority.'],
			['title' => 'Bilingual Arabic & English SEO', 'desc' => 'Deira\'s search audience is one of the most linguistically diverse in Dubai, including significant Arabic, Hindi, Urdu, and English-language searches. Our bilingual strategy ensures you capture demand across all language segments.'],
			['title' => 'Local Business Profile Optimisation', 'desc' => 'Many Deira businesses lack complete or optimised Google Business Profiles. We conduct a full GBP audit, populate all fields, optimise for Deira-specific search terms, and implement a review generation strategy.'],
			['title' => 'Wholesale & B2B Lead Generation', 'desc' => 'Deira\'s wholesale sector relies on trade buyers finding suppliers online. We target buyer-intent keywords ("wholesale gold Dubai", "electronics suppliers Deira") that drive commercial enquiries, not just footfall.'],
		],
		'services_intro' => 'Deira\'s diverse commercial ecosystem - from gold trading to electronics wholesale - requires a versatile SEO approach that spans consumer local search, wholesale B2B intent, and bilingual audience targeting. Our Deira SEO campaigns are built around the district\'s unique trade mix.',
		'faqs' => [
			[
				'question' => 'Is SEO useful for traditional Deira businesses like souks and traders?',
				'answer'   => 'Absolutely. Today\'s buyers - including wholesale trade buyers and retail shoppers - research online before visiting even traditional markets. Ranking for "gold souk Dubai best prices", "spice supplier Deira", or "wholesale clothing Dubai" drives both footfall to your physical location and online enquiries from buyers across the UAE and GCC.',
			],
			[
				'question' => 'What Deira businesses benefit most from local SEO?',
				'answer'   => 'Gold and jewellery retailers, electronics importers and distributors, textile and garment wholesalers, hotels and guesthouses, money exchange businesses, and food wholesale companies in Deira all see strong returns from SEO because their target buyers search specifically by district and product category.',
			],
			[
				'question' => 'How important is Arabic SEO for Deira businesses?',
				'answer'   => 'Very important. Deira has one of the highest proportions of Arabic-speaking searchers of any Dubai district. Arabic-language searches for categories like gold, jewellery, wholesale trade, and money exchange are significant volume opportunities that English-only SEO entirely misses. Our bilingual Arabic-English SEO is included in all Deira campaigns.',
			],
			[
				'question' => 'Can you help a Deira business generate leads from outside Dubai?',
				'answer'   => 'Yes. Deira is historically a regional trade hub - many of its wholesale customers come from across the GCC, South Asia, and East Africa. We create geo-expanded content strategies that target out-of-market buyers searching for Dubai wholesale suppliers, helping you capture export and regional trade leads alongside local footfall.',
			],
			[
				'question' => 'How do you approach SEO for a new or recently launched Deira business?',
				'answer'   => 'For new Deira businesses we prioritise speed-to-visibility: set up and fully optimise your Google Business Profile (typically delivering local pack results within 30 days), build foundational citations across UAE directories, and create targeted content for your top 10 highest-intent local keywords. Domain authority and organic rankings build from this foundation over months 2-6.',
			],
		],
	],
];

// Merge remaining 8 districts (DIFC, JLT, Jumeirah, Bur Dubai, Al Quoz, Dubai Hills, Palm, Mirdif).
$extra_districts = SEOAE_DIR . '/inc/dubai-districts-extra.php';
if ( is_readable( $extra_districts ) ) {
	$loaded = include $extra_districts;
	if ( is_array( $loaded ) ) {
		$districts = array_merge( $districts, $loaded );
	}
}

// Detect current district from page slug
$page_slug  = get_post_field( 'post_name', get_the_ID() );
$district   = $districts[ $page_slug ] ?? null;

// Fallback: try parent post name matching
if ( ! $district && is_page() ) {
	$parent_slug = get_post_field( 'post_name', wp_get_post_parent_id( get_the_ID() ) );
	if ( $parent_slug === 'dubai' ) {
		$district = $districts[ $page_slug ] ?? null;
	}
}

// Hard fallback if slug not found
if ( ! $district ) {
	wp_redirect( home_url( '/dubai/' ) );
	exit;
}

$name    = $district['name'];
$dslug   = $district['slug'];
$geo_lat = $district['geo_lat'];
$geo_lng = $district['geo_lng'];

// ── LocalBusiness Schema scoped to this district ──────────────────────────────
$schema = [
	'@context' => 'https://schema.org',
	'@type'    => ['LocalBusiness','ProfessionalService','MarketingAgency'],
	'name'     => 'SearchEngineOptimization.ae - ' . $name . ' SEO Agency',
	'alternateName' => ['SEO Agency ' . $name, 'SEO Company ' . $name],
	'description'   => 'SearchEngineOptimization.ae is the leading SEO agency serving ' . $name . ', Dubai. We help ' . $name . ' businesses dominate Google search, drive qualified local traffic, and convert visitors into customers with tailored, district-specific SEO strategies.',
	'url'      => home_url('/dubai/' . $dslug . '/'),
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
		'latitude'  => $geo_lat,
		'longitude' => $geo_lng,
	],
	'areaServed' => [
		$name,
		'Dubai',
	],
	'priceRange'   => '$$$$',
	'openingHours' => 'Mo-Fr 09:00-18:00',
	'sameAs'       => array_filter([
		function_exists('get_field') ? get_field('social_linkedin','option')  : '',
		function_exists('get_field') ? get_field('social_instagram','option') : '',
		function_exists('get_field') ? get_field('social_facebook','option')  : '',
	]),
];
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

// ── FAQ Schema ─────────────────────────────────────────────────────────────────
$faq_schema_items = array_map(fn($f) => [
	'@type'          => 'Question',
	'name'           => $f['question'],
	'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['answer']],
], $district['faqs']);
echo '<script type="application/ld+json">' . wp_json_encode([
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => $faq_schema_items,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>

<!-- ═══════════════════════ HERO ════════════════════════════════════════════ -->
<section class="service-hero bg-dark" style="padding:5rem 0 4rem;">
	<div class="container">
		<!-- Breadcrumb -->
		<nav class="breadcrumbs" aria-label="Breadcrumb">
			<a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
			<span>/</span>
			<a href="<?php echo esc_url(home_url('/dubai/')); ?>">SEO Agency Dubai</a>
			<span>/</span>
			<span>SEO Agency <?php echo esc_html($name); ?></span>
		</nav>

		<div class="service-hero__inner" style="display:grid;grid-template-columns:1.3fr 0.7fr;gap:3.5rem;align-items:start;margin-top:2rem;">

			<!-- Left: Copy -->
			<div>
				<?php seoae_section_label('Dubai District SEO'); ?>
				<h1 style="color:#fff;font-size:clamp(1.9rem,4vw,3.2rem);font-weight:900;line-height:1.1;margin:1.1rem 0;">
					SEO Agency in <?php echo esc_html($name); ?>
					<br><span style="color:var(--color-primary,#16B1D4);"><?php echo esc_html($district['tagline']); ?></span>
				</h1>
				<p style="color:rgba(255,255,255,.78);font-size:1.05rem;max-width:520px;line-height:1.7;margin-bottom:2.25rem;">
					<?php echo $district['hero_intro']; ?>
				</p>
				<div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2rem;">
					<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Get Free <?php echo esc_html($name); ?> SEO Audit →</a>
					<a href="<?php echo esc_url(home_url('/case-studies/')); ?>" class="btn btn--outline-white btn--lg">View Results</a>
				</div>
				<div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
					<div style="display:flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.6);font-size:.825rem;">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
						No lock-in contracts
					</div>
					<div style="display:flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.6);font-size:.825rem;">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
						Free <?php echo esc_html($name); ?> SEO Audit
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
					<div style="font-size:2.4rem;font-weight:900;color:var(--color-primary,#16B1D4);line-height:1;"><?php echo esc_html($district['searches']); ?></div>
					<div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-top:.35rem;"><?php echo esc_html($district['searches_label']); ?></div>
				</div>
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;"><?php echo esc_html($district['stat1']['value']); ?></div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;"><?php echo esc_html($district['stat1']['label']); ?></div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:var(--color-primary,#16B1D4);"><?php echo esc_html($district['stat2']['value']); ?></div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;"><?php echo esc_html($district['stat2']['label']); ?></div>
					</div>
					<div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1.1rem;text-align:center;">
						<div style="font-size:1.5rem;font-weight:800;color:#fff;">4.9★</div>
						<div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-top:.2rem;">Client Rating</div>
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

<!-- ══════════════════ LOCAL CONTEXT STRIP ══════════════════════════════════ -->
<section style="background:linear-gradient(135deg,#101A6A 0%,#0d226a 50%,#101A6A 100%);padding:2.75rem 0;">
	<div class="container">
		<div style="display:grid;grid-template-columns:1fr 2fr;gap:3rem;align-items:center;">
			<div>
				<p style="font-size:.72rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:var(--color-primary,#16B1D4);margin-bottom:.5rem;">Key <?php echo esc_html($name); ?> Landmarks</p>
				<div style="display:flex;flex-wrap:wrap;gap:.5rem;">
					<?php foreach ($district['landmarks'] as $lm) : ?>
					<span style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:6px;padding:.3rem .7rem;font-size:.8rem;color:rgba(255,255,255,.85);font-weight:500;"><?php echo esc_html($lm); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
			<div>
				<p style="font-size:.72rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:var(--color-primary,#16B1D4);margin-bottom:.5rem;">Businesses We Serve in <?php echo esc_html($name); ?></p>
				<div style="display:flex;flex-wrap:wrap;gap:.5rem;">
					<?php foreach ($district['business_types'] as $bt) : ?>
					<span style="background:rgba(22,177,212,.12);border:1px solid rgba(22,177,212,.25);border-radius:6px;padding:.3rem .7rem;font-size:.8rem;color:rgba(255,255,255,.85);font-weight:500;"><?php echo esc_html($bt); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ═══════════════════ WHY THIS DISTRICT ═══════════════════════════════════ -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Local SEO in ' . $name); ?>
			<h2>Why <?php echo esc_html($name); ?> Businesses Need Specialist SEO</h2>
			<p class="section-header__desc" style="max-width:640px;margin-left:auto;margin-right:auto;">
				<?php echo esc_html($district['local_intro']); ?>
			</p>
		</div>
		<div class="why-grid" style="margin-top:2.5rem;">
			<?php foreach ($district['why_points'] as $p) : ?>
			<div class="why-card">
				<div class="why-card__icon" style="color:var(--color-primary,#16B1D4);">
					<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
				</div>
				<h3 class="why-card__title"><?php echo esc_html($p['title']); ?></h3>
				<p class="why-card__desc"><?php echo esc_html($p['desc']); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ═══════════════════ SERVICES IN THIS DISTRICT ═══════════════════════════ -->
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Services in ' . $name); ?>
			<h2>Complete SEO &amp; Digital Marketing for <?php echo esc_html($name); ?></h2>
			<p class="section-header__desc" style="max-width:540px;margin-left:auto;margin-right:auto;">
				<?php echo esc_html($district['services_intro']); ?>
			</p>
		</div>
		<div class="services-grid" style="margin-top:2.5rem;">
			<?php
			$svcs = [
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>',
					'title' => 'Search Engine Optimisation',
					'url'   => '/services/search-engine-optimization/',
					'desc'  => 'Full-service SEO strategy to dominate ' . $name . ' Google results - technical, on-page, and off-page.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
					'title' => 'AI Search Optimisation',
					'url'   => '/services/ai-search-optimization/',
					'desc'  => 'Get your ' . $name . ' business featured in Google AI Overviews, ChatGPT, and Perplexity.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/></svg>',
					'title' => 'PPC Management',
					'url'   => '/services/ppc-management/',
					'desc'  => 'Google Ads and Meta Ads campaigns precisely targeted at ' . $name . ' audiences and buyer intent.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
					'title' => 'Social Media Marketing',
					'url'   => '/services/social-media-marketing/',
					'desc'  => 'Build brand authority and engagement across ' . $name . '\'s Instagram, LinkedIn, and TikTok audiences.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
					'title' => 'Web Design ' . $name,
					'url'   => '/services/web-design/',
					'desc'  => 'High-converting, fast-loading websites designed for ' . $name . ' businesses and their local customers.',
				],
				[
					'icon'  => '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
					'title' => 'Local SEO ' . $name,
					'url'   => '/services/search-engine-optimization/',
					'desc'  => 'Dominate Google Maps and the local pack for ' . $name . ' searches - maps, GBP, and citation building.',
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

<!-- ═══════════════════ FAQ SECTION ═════════════════════════════════════════ -->
<section class="section bg-white">
	<div class="container" style="max-width:800px;">
		<div class="section-header section-header--center">
			<?php seoae_section_label('FAQ'); ?>
			<h2>Frequently Asked Questions - SEO in <?php echo esc_html($name); ?></h2>
			<p class="section-header__desc" style="max-width:520px;margin-left:auto;margin-right:auto;">
				Common questions from <?php echo esc_html($name); ?> businesses about local SEO.
			</p>
		</div>
		<div class="faq-list" style="margin-top:2.5rem;">
			<?php foreach ($district['faqs'] as $i => $faq) :
				$uid = 'dist-faq-' . $i; ?>
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

<!-- ═══════════════════ BACK-LINK TO DUBAI PARENT ═══════════════════════════ -->
<section style="background:#f8fafc;padding:2.5rem 0;border-top:1.5px solid #e2e8f0;">
	<div class="container" style="text-align:center;">
		<p style="font-size:.9rem;color:#6b7280;margin-bottom:1.25rem;">
			We cover all Dubai districts - not just <?php echo esc_html($name); ?>.
		</p>
		<div style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;">
			<a href="<?php echo esc_url(home_url('/dubai/')); ?>" style="display:inline-flex;align-items:center;gap:.5rem;background:#fff;border:1.5px solid #e2e8f0;border-radius:10px;padding:.65rem 1.1rem;font-size:.875rem;font-weight:600;color:#101A6A;text-decoration:none;transition:border-color .2s;" class="hover-primary">
				<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
				All Dubai Districts →
			</a>
			<?php
			// Link to sibling districts
			foreach ($districts as $key => $sibling) {
				if ($key === $dslug) continue;
				echo '<a href="' . esc_url(home_url('/dubai/' . $key . '/')) . '" style="display:inline-flex;align-items:center;gap:.4rem;background:#fff;border:1.5px solid #e2e8f0;border-radius:10px;padding:.65rem 1.1rem;font-size:.875rem;font-weight:600;color:#101A6A;text-decoration:none;transition:border-color .2s;" class="hover-primary">';
				echo '<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>';
				echo esc_html($sibling['name']);
				echo '</a>';
			}
			?>
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
	'Ready to Rank in ' . $name . '?',
	'Get a free, no-obligation SEO audit for your ' . $name . ' business. We will analyse your current rankings, identify your biggest opportunities, and deliver a custom roadmap within 48 hours.',
	'Get Free ' . $name . ' SEO Audit',
	home_url('/contact/'),
	'Email Us',
	'mailto:' . seoae_email()
);
get_footer();
