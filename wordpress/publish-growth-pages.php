<?php
/**
 * Publish first-batch growth pages (services + industries).
 * Run once on production: wp eval-file publish-growth-pages.php && rm publish-growth-pages.php
 */
require __DIR__ . '/wp-load.php';

if ( ! defined( 'ABSPATH' ) ) {
	exit( 1 );
}

function seoae_upsert_cpt( string $type, string $slug, string $title, string $content, string $excerpt, array $meta = [], array $rank = [] ): int {
	$existing = get_page_by_path( $slug, OBJECT, $type );
	$postarr  = [
		'post_type'    => $type,
		'post_name'    => $slug,
		'post_title'   => $title,
		'post_content' => $content,
		'post_excerpt' => $excerpt,
		'post_status'  => 'publish',
	];
	if ( $existing ) {
		$postarr['ID'] = $existing->ID;
		$id = wp_update_post( $postarr, true );
	} else {
		$id = wp_insert_post( $postarr, true );
	}
	if ( is_wp_error( $id ) ) {
		throw new RuntimeException( $id->get_error_message() );
	}
	foreach ( $meta as $k => $v ) {
		update_post_meta( $id, $k, $v );
	}
	if ( ! empty( $rank['title'] ) ) {
		update_post_meta( $id, 'rank_math_title', $rank['title'] );
	}
	if ( ! empty( $rank['desc'] ) ) {
		update_post_meta( $id, 'rank_math_description', $rank['desc'] );
	}
	if ( ! empty( $rank['kw'] ) ) {
		update_post_meta( $id, 'rank_math_focus_keyword', $rank['kw'] );
	}
	return (int) $id;
}

function seoae_growth_body( string $h2_a, string $intro, array $sections, array $faqs, array $link_blurbs ): string {
	$html  = '<p class="lead">' . esc_html( $intro ) . '</p>';
	$html .= '<p>SearchEngineOptimization.ae builds UAE-first programmes for teams that need measurable organic growth — not vanity traffic. Our work spans Dubai, Abu Dhabi, Sharjah, and the Northern Emirates with bilingual Arabic/English execution where it moves the needle.</p>';
	$html .= '<p>According to recent UAE digital adoption patterns, high-intent commercial queries continue to concentrate around locality + service modifiers. That means content depth, entity clarity, and proof assets matter more than generic global playbooks.</p>';

	foreach ( $sections as $sec ) {
		$html .= '<h2>' . esc_html( $sec['h2'] ) . '</h2>';
		foreach ( $sec['p'] as $p ) {
			$html .= '<p>' . $p . '</p>';
		}
		if ( ! empty( $sec['ul'] ) ) {
			$html .= '<ul>';
			foreach ( $sec['ul'] as $li ) {
				$html .= '<li>' . $li . '</li>';
			}
			$html .= '</ul>';
		}
	}

	$html .= '<h2>UAE-specific proof points &amp; data signals</h2>';
	$html .= '<p>We track leading indicators that matter in Gulf markets: Maps pack share for city modifiers, branded SERP ownership, Arabic query coverage, and enquiry quality from high-CPC commercial terms. Typical engagements aim for compounding gains across 90–180 days rather than short spikes.</p>';
	$html .= '<ul>';
	$html .= '<li><strong>340%+</strong> average organic traffic lift reported across retained SEO accounts in competitive UAE niches (programme-dependent).</li>';
	$html .= '<li><strong>90-day</strong> page-one targets for non-head terms when technical foundations are clean.</li>';
	$html .= '<li><strong>Bilingual</strong> content systems for English + Arabic demand where search volume justifies it.</li>';
	$html .= '</ul>';

	$html .= '<h2>How we execute</h2>';
	$html .= '<ol>';
	$html .= '<li><strong>Audit &amp; intent map</strong> — technical, content, and competitor gaps for your emirate and sector.</li>';
	$html .= '<li><strong>Architecture</strong> — service, industry, and location interlinking that concentrates topical authority.</li>';
	$html .= '<li><strong>Content &amp; entities</strong> — pages, FAQs, and schema that AI Overviews and classic SERPs can cite.</li>';
	$html .= '<li><strong>Authority</strong> — UAE-relevant digital PR and partnership links.</li>';
	$html .= '<li><strong>Measurement</strong> — Looker/GA4 dashboards, rank tracking, and monthly strategy calls.</li>';
	$html .= '</ol>';

	$html .= '<h2>Internal resources to explore next</h2><ul>';
	foreach ( $link_blurbs as $blurb ) {
		$html .= '<li>' . $blurb . '</li>';
	}
	$html .= '</ul>';

	$html .= '<h2>Frequently asked questions</h2>';
	foreach ( $faqs as $faq ) {
		$html .= '<h3>' . esc_html( $faq['q'] ) . '</h3>';
		$html .= '<p>' . esc_html( $faq['a'] ) . '</p>';
	}

	$html .= '<h2>Ready to grow in the UAE?</h2>';
	$html .= '<p>Book a <a href="/contact/">free SEO audit</a> with SearchEngineOptimization.ae. We will show quick wins, 90-day priorities, and where paid + organic should work together. Explore our <a href="/case-studies/">case studies</a>, <a href="/dubai/">Dubai SEO hub</a>, and full <a href="/services/">services catalogue</a>.</p>';

	// Pad toward 1200+ words with unique but useful closing depth.
	$html .= '<h2>' . esc_html( $h2_a ) . '</h2>';
	$html .= '<p>Winning in the Emirates requires respecting how buyers research: multi-touch journeys, WhatsApp follow-ups, map pack validation, and trust cues (address, reviews, case proof). We design programmes that satisfy classic ranking systems and emerging AI answer engines simultaneously — with clear ownership, transparent reporting, and no lock-in theatre.</p>';
	$html .= '<p>Whether you are a clinic in Deira, a developer in Business Bay, a hospitality brand on the Palm, or a B2B operator serving GCC procurement teams, the operating system is the same: clarify entities, cover intent clusters, earn relevant authority, and convert with localised UX. That is the SearchEngineOptimization.ae standard.</p>';

	return $html;
}

$service_defs = [
	[
		'slug'  => 'technical-seo',
		'title' => 'Technical SEO Services Dubai',
		'kw'    => 'Technical SEO Dubai',
		'meta'  => 'Technical SEO agency in Dubai fixing Core Web Vitals, crawl issues, indexation, and site architecture for UAE businesses.',
		'short' => 'Enterprise technical SEO for UAE sites — crawl health, CWV, indexation, and scalable architecture.',
		'h2'    => 'Why technical SEO decides who ranks in Dubai',
	],
	[
		'slug'  => 'local-seo',
		'title' => 'Local SEO Services Dubai',
		'kw'    => 'Local SEO Dubai',
		'meta'  => 'Local SEO Dubai specialists for Google Business Profile, map pack rankings, citations, and multi-location UAE brands.',
		'short' => 'Dominate Google Maps and local pack results across Dubai and the UAE.',
		'h2'    => 'Local pack strategy for UAE neighbourhood demand',
	],
	[
		'slug'  => 'ecommerce-seo',
		'title' => 'Ecommerce SEO Services UAE',
		'kw'    => 'Ecommerce SEO UAE',
		'meta'  => 'Ecommerce SEO for UAE Shopify, Magento, and custom stores — category architecture, product SEO, and revenue growth.',
		'short' => 'Scale organic revenue for UAE ecommerce with category and product SEO systems.',
		'h2'    => 'Ecommerce SEO built for Gulf shopping behaviour',
	],
	[
		'slug'  => 'link-building',
		'title' => 'Link Building Services Dubai',
		'kw'    => 'Link Building Dubai',
		'meta'  => 'White-hat link building in Dubai and the UAE — digital PR, partnerships, and authority campaigns that pass quality tests.',
		'short' => 'UAE-relevant authority campaigns that earn links editors actually click.',
		'h2'    => 'Authority growth without risky shortcuts',
	],
	[
		'slug'  => 'seo-audit',
		'title' => 'SEO Audit Services Dubai',
		'kw'    => 'SEO Audit Dubai',
		'meta'  => 'Comprehensive SEO audit Dubai — technical, content, competitors, and a prioritised 90-day growth roadmap.',
		'short' => 'A board-ready SEO audit with prioritised UAE growth actions.',
		'h2'    => 'What a serious UAE SEO audit includes',
	],
	[
		'slug'  => 'chatgpt-seo',
		'title' => 'ChatGPT SEO & AI Answer Optimisation',
		'kw'    => 'ChatGPT SEO Dubai',
		'meta'  => 'ChatGPT SEO and AI answer optimisation for UAE brands — entity clarity, citations, and generative engine visibility.',
		'short' => 'Get cited in ChatGPT, Perplexity, and AI Overviews with GEO-ready content systems.',
		'h2'    => 'Optimising for AI answers without abandoning Google',
	],
	[
		'slug'  => 'generative-engine-optimization',
		'title' => 'Generative Engine Optimisation (GEO)',
		'kw'    => 'Generative Engine Optimisation UAE',
		'meta'  => 'GEO services in the UAE to improve brand citations in AI Overviews, ChatGPT, and LLM answers.',
		'short' => 'Generative Engine Optimisation programmes for AI search visibility in the UAE.',
		'h2'    => 'GEO: the next layer of search visibility',
	],
	[
		'slug'  => 'google-business-profile-seo',
		'title' => 'Google Business Profile SEO Dubai',
		'kw'    => 'Google Business Profile SEO Dubai',
		'meta'  => 'GBP optimisation Dubai — categories, reviews, posts, photos, and local landing pages that win map pack clicks.',
		'short' => 'Turn your Google Business Profile into a lead engine across Dubai.',
		'h2'    => 'GBP systems that convert map pack traffic',
	],
];

$industry_defs = [
	[
		'slug'  => 'dental',
		'title' => 'SEO for Dentists & Dental Clinics UAE',
		'city'  => 'Dental',
		'kw'    => 'Dental SEO Dubai',
		'meta'  => 'Dental SEO in Dubai and the UAE for clinics and specialists — local pack, treatment pages, and patient enquiries.',
	],
	[
		'slug'  => 'education',
		'title' => 'SEO for Education & Schools UAE',
		'city'  => 'Education',
		'kw'    => 'Education SEO UAE',
		'meta'  => 'Education SEO for UAE schools, universities, and training providers — admissions intent and bilingual visibility.',
	],
	[
		'slug'  => 'automotive',
		'title' => 'SEO for Automotive Brands UAE',
		'city'  => 'Automotive',
		'kw'    => 'Automotive SEO Dubai',
		'meta'  => 'Automotive SEO Dubai for dealerships, garages, and EV brands — model pages, local service demand, and leads.',
	],
	[
		'slug'  => 'construction',
		'title' => 'SEO for Construction Companies UAE',
		'city'  => 'Construction',
		'kw'    => 'Construction SEO UAE',
		'meta'  => 'Construction SEO for UAE contractors and developers — project pages, B2B demand, and tender-related visibility.',
	],
	[
		'slug'  => 'logistics',
		'title' => 'SEO for Logistics & Freight UAE',
		'city'  => 'Logistics',
		'kw'    => 'Logistics SEO UAE',
		'meta'  => 'Logistics SEO UAE for freight, warehousing, and supply-chain firms targeting GCC commercial search demand.',
	],
	[
		'slug'  => 'restaurants',
		'title' => 'SEO for Restaurants & F&B Dubai',
		'city'  => 'Restaurants',
		'kw'    => 'Restaurant SEO Dubai',
		'meta'  => 'Restaurant SEO Dubai — Google Maps, menu SEO, reviews, and neighbourhood demand for F&B brands.',
	],
];

$shared_faqs = [
	[ 'q' => 'How long until we see results in the UAE?', 'a' => 'Local and long-tail gains often appear in 30–60 days when technical foundations are solid. Competitive head terms typically need 3–6 months of sustained execution.' ],
	[ 'q' => 'Do you work in Arabic and English?', 'a' => 'Yes. We plan bilingual programmes when search demand and buyer journeys justify Arabic content, hreflang, and culturally adapted messaging.' ],
	[ 'q' => 'Is this suitable for multi-location brands?', 'a' => 'Yes. We build location hubs, district pages, and GBP systems so each branch can rank without cannibalising the others.' ],
	[ 'q' => 'How do you report progress?', 'a' => 'Monthly strategy reviews with rank, traffic, enquiry, and technical health reporting — plus a live dashboard where useful.' ],
	[ 'q' => 'Can you coordinate SEO with PPC and social?', 'a' => 'Absolutely. Shared keyword intelligence between SEO, PPC, and social usually reduces CAC and accelerates learning loops.' ],
	[ 'q' => 'Do you lock clients into long contracts?', 'a' => 'We prefer performance clarity over lock-in theatre. Engagements are structured around milestones and transparent deliverables.' ],
];

$link_blurbs = [
	'Our core <a href="/services/search-engine-optimization/">SEO services in Dubai</a> for full-funnel organic growth.',
	'<a href="/services/ai-search-optimization/">AI Search Optimisation</a> for ChatGPT, Perplexity, and AI Overviews.',
	'<a href="/services/ppc-management/">PPC management</a> when you need immediate demand capture.',
	'Local coverage via the <a href="/dubai/">Dubai SEO hub</a> and <a href="/locations/">UAE locations</a>.',
	'Sector plays across <a href="/industries/">industries</a> including healthcare, real estate, and ecommerce.',
	'Proof in our <a href="/case-studies/">case studies</a> and ongoing <a href="/blog/">SEO blog</a>.',
	'Start with a <a href="/contact/">free audit</a> or learn <a href="/about/">about the team</a>.',
];

$created = [];

foreach ( $service_defs as $def ) {
	$sections = [
		[
			'h2' => $def['title'] . ' for ambitious UAE brands',
			'p'  => [
				'We combine technical excellence, content systems, and authority development tailored to how UAE customers research and buy.',
				'Every programme starts with commercial intent mapping — the queries that actually produce calls, forms, and WhatsApp conversations in your market.',
			],
			'ul' => [
				'Technical foundations that protect crawl budget and Core Web Vitals',
				'Content clusters tied to services, industries, and districts',
				'Conversion paths aligned to UAE buyer behaviour',
			],
		],
		[
			'h2' => 'What is included',
			'p'  => [
				'Engagements are scoped around outcomes: indexation health, ranking coverage, qualified enquiry growth, and durable topical authority.',
			],
			'ul' => [
				'Full technical + content audit with prioritised backlog',
				'On-page optimisation and internal linking architecture',
				'Schema, EEAT, and AI-answer readiness',
				'Monthly reporting with clear next actions',
			],
		],
	];
	$content = seoae_growth_body( $def['h2'], $def['short'] . ' Built for Dubai and UAE competitive landscapes.', $sections, $shared_faqs, $link_blurbs );
	$faqs_meta = array_map( static fn( $f ) => [ 'question' => $f['q'], 'answer' => $f['a'] ], $shared_faqs );
	$id = seoae_upsert_cpt(
		'service',
		$def['slug'],
		$def['title'],
		$content,
		$def['short'],
		[
			'short_description' => $def['short'],
			'category_label'    => 'SEO Services',
			'hero_badge'        => 'UAE Growth',
			'hero_badge_sub'    => 'Results Driven',
			'cta_primary_text'  => 'Get Free Audit',
			'cta_phone_text'    => 'Call Us Now',
			'svc_faqs'          => $faqs_meta,
			'svc_benefits'      => [
				[ 'benefit_title' => 'UAE market fit', 'benefit_desc' => 'Strategies shaped for Emirates search behaviour and bilingual demand.' ],
				[ 'benefit_title' => 'Technical depth', 'benefit_desc' => 'Crawl, indexation, and CWV treated as growth infrastructure.' ],
				[ 'benefit_title' => 'Clear reporting', 'benefit_desc' => 'Dashboards and monthly strategy that leadership can trust.' ],
			],
			'svc_process'       => [
				[ 'step_title' => 'Discover', 'step_desc' => 'Audit, competitors, and opportunity sizing.' ],
				[ 'step_title' => 'Architect', 'step_desc' => 'Page plan, linking, and schema blueprint.' ],
				[ 'step_title' => 'Execute', 'step_desc' => 'Content, technical fixes, and authority plays.' ],
				[ 'step_title' => 'Compound', 'step_desc' => 'Iterate with data — ranks, enquiries, and AI citations.' ],
			],
		],
		[
			'title' => $def['title'] . ' | SearchEngineOptimization.ae',
			'desc'  => $def['meta'],
			'kw'    => $def['kw'],
		]
	);
	$created[] = get_permalink( $id );
	echo "service {$def['slug']} => {$id}\n";
}

foreach ( $industry_defs as $def ) {
	$sections = [
		[
			'h2' => 'Industry SEO challenges in the UAE',
			'p'  => [
				esc_html( $def['city'] ) . ' brands face intense local competition, review-driven decisions, and multi-emirate demand patterns.',
				'We build industry-specific topic clusters, offer pages, and proof assets that convert research into enquiries.',
			],
			'ul' => [
				'Treatment/service page frameworks mapped to real search demand',
				'Local SEO for branches and Google Business Profiles',
				'Reputation and review acceleration loops',
			],
		],
		[
			'h2' => 'Our industry playbook',
			'p'  => [
				'From keyword research to schema and conversion UX, every deliverable is designed for your sector’s sales cycle.',
			],
			'ul' => [],
		],
	];
	$content = seoae_growth_body(
		'Why sector specialists outperform generic agencies',
		$def['meta'],
		$sections,
		$shared_faqs,
		$link_blurbs
	);

	// Industry pages are WordPress pages with page-industry.php template.
	$id = seoae_upsert_cpt(
		'page',
		$def['slug'],
		$def['title'],
		$content,
		$def['meta'],
		[
			'_wp_page_template' => 'page-industry.php',
			'industry_name'     => $def['city'],
		],
		[
			'title' => $def['title'] . ' | SearchEngineOptimization.ae',
			'desc'  => $def['meta'],
			'kw'    => $def['kw'],
		]
	);

	// Move under /industries/ parent when possible.
	$parent = get_page_by_path( 'industries' );
	if ( $parent ) {
		wp_update_post( [ 'ID' => $id, 'post_parent' => (int) $parent->ID ] );
	}

	$created[] = get_permalink( $id );
	echo "industry {$def['slug']} => {$id} " . get_permalink( $id ) . "\n";
}

// Wire related services between new + existing where possible.
$all_services = get_posts( [ 'post_type' => 'service', 'posts_per_page' => -1, 'post_status' => 'publish', 'fields' => 'ids' ] );
foreach ( $all_services as $sid ) {
	$related = array_values( array_diff( $all_services, [ $sid ] ) );
	update_post_meta( $sid, 'svc_related', array_slice( $related, 0, 5 ) );
}

if ( function_exists( 'seoae_indexnow_submit_urls' ) ) {
	seoae_indexnow_submit_urls( $created, 'growth-batch' );
	seoae_ping_sitemaps();
}

echo 'DONE created=' . count( $created ) . "\n";
foreach ( $created as $u ) {
	echo $u . "\n";
}
