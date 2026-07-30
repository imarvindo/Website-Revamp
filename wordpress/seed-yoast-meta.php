<?php
/**
 * Seed Yoast SEO meta titles and descriptions for all key pages.
 *
 * Run via:
 *   php /home/runner/workspace/wp-cli.phar --path=/home/runner/workspace/wordpress \
 *       --allow-root eval-file /home/runner/workspace/wordpress/seed-yoast-meta.php
 */

// ─────────────────────────────────────────────────────────────────────────────
// 1. YOAST GLOBAL SETTINGS
// ─────────────────────────────────────────────────────────────────────────────

// General wpseo options – enable sitemap, OG
$wpseo = get_option( 'wpseo', [] );
$wpseo = array_merge( $wpseo, [
	'enable_xml_sitemap' => true,
	'opengraph'          => true,
	'twitter'            => true,
	'site_type'          => 'company',
] );
update_option( 'wpseo', $wpseo );

// Title & metas settings
$wpseo_titles = get_option( 'wpseo_titles', [] );
$wpseo_titles = array_merge( $wpseo_titles, [
	'separator'              => 'sc-dash',   // —
	'title-home-wpseo'       => 'SEO Agency Dubai — #1 Enterprise SEO & Digital Growth | SearchEngineOptimization.ae',
	'metadesc-home-wpseo'    => 'Dubai\'s leading enterprise SEO agency. AI-driven SEO, PPC, web design and social media services that deliver measurable ROI for UAE businesses. Get a free audit today.',
	// Post type title templates
	'title-service'          => '%%title%% | SearchEngineOptimization.ae',
	'metadesc-service'       => '',
	'title-page'             => '%%title%% | SearchEngineOptimization.ae',
	'metadesc-page'          => '',
	'title-post'             => '%%title%% | SEO Blog UAE',
	'metadesc-post'          => '%%excerpt%%',
	'title-case_study'       => '%%title%% | SEO Case Study UAE',
	'title-portfolio_item'   => '%%title%% | Portfolio | SearchEngineOptimization.ae',
	// Archive templates
	'title-ptarchive-service'      => 'SEO & Digital Marketing Services Dubai, UAE | SearchEngineOptimization.ae',
	'metadesc-ptarchive-service'   => 'Explore our full suite of enterprise SEO, PPC, social media, web design and AI search services tailored for Dubai and UAE businesses.',
	'title-ptarchive-case_study'   => 'SEO Case Studies Dubai & UAE | SearchEngineOptimization.ae',
	'metadesc-ptarchive-case_study'=> 'Real results for real UAE businesses. Browse our SEO, PPC and digital marketing case studies from Dubai and across the Emirates.',
	'title-ptarchive-portfolio_item'     => 'Digital Marketing Portfolio | SearchEngineOptimization.ae',
	'metadesc-ptarchive-portfolio_item'  => 'Award-winning web design, SEO and PPC projects delivered for UAE clients across real estate, ecommerce, hospitality and more.',
	// Search / 404
	'title-search-wpseo'     => 'Search Results for %%searchphrase%% | SearchEngineOptimization.ae',
	'title-404-wpseo'        => 'Page Not Found | SearchEngineOptimization.ae',
	// Company info for Schema
	'company_name'           => 'SearchEngineOptimization.ae',
	'company_or_person'      => 'company',
	'website_name'           => 'SearchEngineOptimization.ae',
	'person_name'            => '',
] );
update_option( 'wpseo_titles', $wpseo_titles );

// Social / OG settings
$wpseo_social = get_option( 'wpseo_social', [] );
$wpseo_social = array_merge( $wpseo_social, [
	'opengraph'           => true,
	'twitter'             => true,
	'twitter_site'        => 'searchengoptae',
	'og_default_image'    => '',
	'og_frontpage_title'  => 'SEO Agency Dubai — #1 Enterprise SEO & Digital Growth',
	'og_frontpage_desc'   => 'Dubai\'s leading enterprise SEO agency. AI-driven SEO, PPC, web design and social media services delivering measurable ROI across the UAE.',
] );
update_option( 'wpseo_social', $wpseo_social );

echo "✓ Global Yoast settings updated\n";

// ─────────────────────────────────────────────────────────────────────────────
// 2. HELPER
// ─────────────────────────────────────────────────────────────────────────────
function yoast_set( $post_id, $title, $desc = '', $focus_kw = '' ) {
	update_post_meta( $post_id, '_yoast_wpseo_title',    $title );
	update_post_meta( $post_id, '_yoast_wpseo_metadesc', $desc );
	if ( $focus_kw ) {
		update_post_meta( $post_id, '_yoast_wpseo_focuskw', $focus_kw );
	}
}

// ─────────────────────────────────────────────────────────────────────────────
// 3. STATIC PAGES
// ─────────────────────────────────────────────────────────────────────────────
$pages = [
	// Home (5) — handled via wpseo_titles option above; also set post meta as fallback
	5 => [
		'title'   => 'SEO Agency Dubai — #1 Enterprise SEO & Digital Growth',
		'desc'    => 'Dubai\'s leading enterprise SEO agency. AI-driven SEO, PPC, web design and social media services that deliver measurable ROI for UAE businesses. Get a free audit today.',
		'keyword' => 'SEO agency Dubai',
	],
	6 => [
		'title'   => 'About Us — SEO Agency Dubai | SearchEngineOptimization.ae',
		'desc'    => 'Meet Dubai\'s award-winning SEO team. 10+ years experience, 345+ UAE clients, data-driven strategies that grow organic traffic and revenue. Based in Deira, Dubai.',
		'keyword' => 'SEO agency Dubai about us',
	],
	7 => [
		'title'   => 'SEO & Digital Marketing Services Dubai | SearchEngineOptimization.ae',
		'desc'    => 'Enterprise SEO, AI search, PPC, social media, web design and development — all under one roof. Dubai\'s full-service digital growth agency.',
		'keyword' => 'digital marketing services Dubai',
	],
	8 => [
		'title'   => 'Contact SEO Agency Dubai | Free SEO Audit | SearchEngineOptimization.ae',
		'desc'    => 'Get your free SEO audit today. Talk to Dubai\'s top SEO team about growing your organic traffic and revenue. Call, email or visit us in Deira, Dubai.',
		'keyword' => 'contact SEO agency Dubai',
	],
	9 => [
		'title'   => 'Careers at SEO Agency Dubai | Join Our Team | SearchEngineOptimization.ae',
		'desc'    => 'Join Dubai\'s fastest-growing SEO and digital marketing agency. Explore open roles in SEO, PPC, content, web design and account management.',
		'keyword' => 'SEO jobs Dubai careers',
	],
	10 => [
		'title'   => 'SEO Blog UAE — Tips, Trends & Strategies | SearchEngineOptimization.ae',
		'desc'    => 'Expert SEO insights for UAE businesses. Actionable tips on search rankings, AI search, Google Ads and digital marketing in Dubai and across the Emirates.',
		'keyword' => 'SEO blog UAE',
	],
	11 => [
		'title'   => 'Digital Marketing Portfolio Dubai | SearchEngineOptimization.ae',
		'desc'    => 'Browse our portfolio of award-winning SEO, web design and PPC projects for UAE clients across real estate, ecommerce, hospitality, legal and more.',
		'keyword' => 'SEO portfolio Dubai',
	],
	12 => [
		'title'   => 'SEO Case Studies Dubai & UAE | SearchEngineOptimization.ae',
		'desc'    => 'Real results from real UAE clients. Explore our SEO, PPC and digital marketing case studies showing measurable growth across Dubai and the Emirates.',
		'keyword' => 'SEO case studies Dubai',
	],
	91 => [
		'title'   => 'SEO by Location — UAE City & Emirate SEO Services',
		'desc'    => 'Hyperlocal SEO services across all seven UAE emirates. Dubai, Abu Dhabi, Sharjah, Ajman, RAK, Fujairah and Al Ain — we rank businesses everywhere in the UAE.',
		'keyword' => 'SEO services UAE locations',
	],
	92 => [
		'title'   => 'SEO by Industry — Sector-Specialist SEO Services UAE',
		'desc'    => 'Industry-specific SEO for real estate, healthcare, ecommerce, hospitality, legal and finance sectors across the UAE. Sector expertise that drives faster rankings.',
		'keyword' => 'SEO by industry UAE',
	],
	139 => [
		'title'   => 'Site Map | SearchEngineOptimization.ae',
		'desc'    => 'Browse all pages on SearchEngineOptimization.ae — services, locations, industries, blog and more.',
		'keyword' => '',
	],
	236 => [
		'title'   => 'Frequently Asked Questions — SEO Agency Dubai | SearchEngineOptimization.ae',
		'desc'    => 'Answers to the most common questions about SEO services, pricing, timelines and results for UAE businesses. Ask Dubai\'s #1 SEO agency anything.',
		'keyword' => 'SEO agency Dubai FAQ',
	],
	237 => [
		'title'   => 'Terms of Service | SearchEngineOptimization.ae',
		'desc'    => 'Read the terms and conditions governing use of SearchEngineOptimization.ae services and website.',
		'keyword' => '',
	],
];

foreach ( $pages as $id => $data ) {
	yoast_set( $id, $data['title'], $data['desc'], $data['keyword'] ?? '' );
	echo "✓ Page {$id}: {$data['title']}\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// 4. SERVICE PAGES
// ─────────────────────────────────────────────────────────────────────────────
$services = [
	13 => [
		'title'   => 'SEO Services Dubai — Enterprise SEO Agency UAE',
		'desc'    => 'Award-winning SEO services for Dubai and UAE businesses. Data-driven strategies that deliver first-page rankings, qualified organic traffic and compounding revenue growth.',
		'keyword' => 'SEO services Dubai',
	],
	14 => [
		'title'   => 'AI Search Optimisation Dubai — GEO & AIO Agency UAE',
		'desc'    => 'Stay visible in ChatGPT, Gemini and Google AI Overviews. Our AI search optimisation (GEO/AIO) service gets UAE brands cited by AI search engines.',
		'keyword' => 'AI search optimisation Dubai',
	],
	15 => [
		'title'   => 'PPC & Google Ads Dubai — Paid Media Agency UAE',
		'desc'    => 'High-ROI Google Ads and paid media management for Dubai businesses. Certified PPC specialists who cut wasted spend and scale conversions across the UAE.',
		'keyword' => 'Google Ads Dubai PPC management',
	],
	16 => [
		'title'   => 'Social Media Marketing Dubai — SMM Agency UAE',
		'desc'    => 'Strategic social media marketing for UAE brands. Content creation, paid social, influencer partnerships and community management across Instagram, LinkedIn and TikTok.',
		'keyword' => 'social media marketing Dubai',
	],
	17 => [
		'title'   => 'Web Design Dubai — Conversion-Optimised Websites UAE',
		'desc'    => 'Beautiful, fast-loading websites built to rank and convert. Our Dubai web design team combines UX expertise with SEO-first architecture for maximum business impact.',
		'keyword' => 'web design Dubai',
	],
	18 => [
		'title'   => 'Web Development Dubai — WordPress & React Builds UAE',
		'desc'    => 'Custom WordPress, React and headless web development for Dubai businesses. Scalable, SEO-optimised builds delivered by experienced UAE developers.',
		'keyword' => 'web development Dubai',
	],
];

foreach ( $services as $id => $data ) {
	yoast_set( $id, $data['title'], $data['desc'], $data['keyword'] );
	echo "✓ Service {$id}: {$data['title']}\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// 5. EMIRATE LOCATION PAGES
// ─────────────────────────────────────────────────────────────────────────────
$locations = [
	84 => [
		'title'   => 'SEO Agency Dubai — #1 SEO Company in Dubai, UAE',
		'desc'    => 'Dubai\'s top-rated SEO agency. We help Dubai businesses rank on page 1 of Google with proven SEO strategies, local search expertise and transparent monthly reporting.',
		'keyword' => 'SEO agency Dubai',
	],
	105 => [
		'title'   => 'SEO Agency Abu Dhabi — Top SEO Company Abu Dhabi',
		'desc'    => 'Expert SEO services for Abu Dhabi businesses. First-page Google rankings, organic traffic growth and ROI-focused strategies tailored for the Abu Dhabi market.',
		'keyword' => 'SEO agency Abu Dhabi',
	],
	106 => [
		'title'   => 'SEO Agency Sharjah — Expert SEO Company in Sharjah',
		'desc'    => 'Sharjah\'s trusted SEO specialists. Local and enterprise SEO strategies that drive qualified search traffic and business growth across Sharjah and the Northern Emirates.',
		'keyword' => 'SEO agency Sharjah',
	],
	107 => [
		'title'   => 'SEO Agency Ajman — Affordable SEO Services Ajman UAE',
		'desc'    => 'Results-driven SEO services for Ajman businesses. Affordable, transparent SEO packages that build organic visibility and attract local customers in Ajman.',
		'keyword' => 'SEO agency Ajman',
	],
	108 => [
		'title'   => 'SEO Agency Ras Al Khaimah — SEO Company RAK, UAE',
		'desc'    => 'SEO services for Ras Al Khaimah businesses. Grow your online presence in RAK with our data-driven SEO strategies, local search optimisation and content marketing.',
		'keyword' => 'SEO agency Ras Al Khaimah RAK',
	],
	109 => [
		'title'   => 'SEO Agency Fujairah — SEO Company in Fujairah UAE',
		'desc'    => 'Professional SEO services for Fujairah businesses. Improve your Google rankings, attract local customers and grow online revenue with our Fujairah SEO experts.',
		'keyword' => 'SEO agency Fujairah',
	],
];

foreach ( $locations as $id => $data ) {
	yoast_set( $id, $data['title'], $data['desc'], $data['keyword'] );
	echo "✓ Location {$id}: {$data['title']}\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// 6. INDUSTRY PAGES
// ─────────────────────────────────────────────────────────────────────────────
$industries = [
	110 => [
		'title'   => 'Real Estate SEO Dubai — SEO for UAE Property Companies',
		'desc'    => 'Specialist real estate SEO for UAE property developers, agents and portals. Rank for high-intent property searches in Dubai and across the Emirates.',
		'keyword' => 'real estate SEO Dubai UAE',
	],
	111 => [
		'title'   => 'Healthcare SEO Dubai — SEO for UAE Hospitals & Clinics',
		'desc'    => 'HIPAA-aware SEO for UAE healthcare providers. Hospitals, clinics and specialists rank higher in Google to reach patients searching for care in Dubai and across the UAE.',
		'keyword' => 'healthcare SEO Dubai UAE',
	],
	112 => [
		'title'   => 'E-commerce SEO Dubai — Drive Organic Sales in UAE',
		'desc'    => 'SEO built for UAE online stores. Product-page optimisation, category rankings and technical SEO that converts organic search traffic into ecommerce revenue.',
		'keyword' => 'ecommerce SEO Dubai UAE',
	],
	113 => [
		'title'   => 'Hospitality SEO Dubai — Hotels, Restaurants & Tourism UAE',
		'desc'    => 'SEO for UAE hospitality brands. Hotels, restaurants, spas and tour operators rank higher to attract international visitors and direct bookings via Google.',
		'keyword' => 'hospitality SEO Dubai UAE hotels',
	],
	114 => [
		'title'   => 'Legal SEO Dubai — SEO for UAE Law Firms & Lawyers',
		'desc'    => 'Specialist SEO for UAE law firms and legal professionals. Rank for high-value legal searches in Dubai and attract qualified client enquiries through organic search.',
		'keyword' => 'legal SEO Dubai law firm',
	],
	115 => [
		'title'   => 'Finance SEO Dubai — SEO for UAE Banks & Fintech',
		'desc'    => 'Compliance-aware SEO for UAE financial services. Banks, fintech startups and investment firms rank for money-intent keywords and generate qualified financial leads.',
		'keyword' => 'finance SEO Dubai fintech UAE',
	],
];

foreach ( $industries as $id => $data ) {
	yoast_set( $id, $data['title'], $data['desc'], $data['keyword'] );
	echo "✓ Industry {$id}: {$data['title']}\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// 7. ADDITIONAL LOCATION PAGES (neighbourhood & extra emirates)
// ─────────────────────────────────────────────────────────────────────────────
$extra_locations = [
	192 => [
		'title'   => 'SEO Company Umm Al Quwain — SEO Services for UAQ',
		'desc'    => 'Local SEO services for Umm Al Quwain businesses. Build Google visibility, attract local customers and compete online with our UAQ SEO specialists.',
		'keyword' => 'SEO company Umm Al Quwain',
	],
	193 => [
		'title'   => 'SEO Agency Al Ain — SEO Company for Al Ain UAE',
		'desc'    => 'Professional SEO services for Al Ain businesses. First-page Google rankings and local search strategies that drive qualified traffic to your Al Ain business.',
		'keyword' => 'SEO agency Al Ain',
	],
	194 => [
		'title'   => 'SEO Company Khor Fakkan — SEO Services in Khor Fakkan',
		'desc'    => 'Grow your Khor Fakkan business online with expert SEO services. Local search optimisation, content marketing and link building for Khor Fakkan brands.',
		'keyword' => 'SEO company Khor Fakkan',
	],
	195 => [
		'title'   => 'SEO Dibba Al Fujairah — SEO Services for Dibba Businesses',
		'desc'    => 'SEO services tailored for Dibba Al Fujairah businesses. Rank higher in local search results and attract more customers with our proven UAE SEO strategies.',
		'keyword' => 'SEO Dibba Al Fujairah',
	],
	196 => [
		'title'   => 'SEO Company Jebel Ali — SEO for JAFZA & Jebel Ali',
		'desc'    => 'Specialist SEO for Jebel Ali Free Zone (JAFZA) and Jebel Ali businesses. Industrial, logistics and B2B SEO strategies that generate qualified corporate leads.',
		'keyword' => 'SEO company Jebel Ali JAFZA',
	],
	197 => [
		'title'   => 'SEO Agency Dubai Marina — SEO for Marina Businesses',
		'desc'    => 'Hyperlocal SEO for Dubai Marina businesses. Restaurants, gyms, clinics and retail brands rank higher in Marina neighbourhood searches on Google Maps and search.',
		'keyword' => 'SEO agency Dubai Marina',
	],
	198 => [
		'title'   => 'SEO Company Business Bay Dubai — Local SEO Agency',
		'desc'    => 'Local SEO for Business Bay, Dubai. Corporate offices, hospitality and retail brands rank higher in Business Bay searches to attract high-value clients.',
		'keyword' => 'SEO company Business Bay Dubai',
	],
	199 => [
		'title'   => 'SEO Company Deira Dubai — SEO for Deira Businesses',
		'desc'    => 'SEO services for Deira, Dubai. Trade, retail and hospitality businesses in Deira rank higher on Google to reach local and international customers.',
		'keyword' => 'SEO company Deira Dubai',
	],
	200 => [
		'title'   => 'SEO Agency Downtown Dubai — SEO for Downtown Businesses',
		'desc'    => 'Premium SEO for Downtown Dubai businesses. Luxury retail, hospitality and professional services rank for Downtown Dubai searches on Google and AI.',
		'keyword' => 'SEO agency Downtown Dubai',
	],
];

foreach ( $extra_locations as $id => $data ) {
	yoast_set( $id, $data['title'], $data['desc'], $data['keyword'] );
	echo "✓ Extra location {$id}: {$data['title']}\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// 8. ADDITIONAL SERVICE PAGES (sector-specific)
// ─────────────────────────────────────────────────────────────────────────────
$extra_services = [
	201 => [
		'title'   => 'SaaS & B2B SEO Dubai — SEO for UAE Tech & B2B Brands',
		'desc'    => 'SEO for UAE SaaS companies and B2B brands. Product-led content, high-intent keyword targeting and link authority strategies that generate qualified B2B leads.',
		'keyword' => 'SaaS B2B SEO Dubai UAE',
	],
	202 => [
		'title'   => 'Education SEO Dubai — SEO for UAE Schools & Universities',
		'desc'    => 'SEO for UAE educational institutions. Schools, universities and training academies rank higher in Google to attract prospective students across the Emirates.',
		'keyword' => 'education SEO Dubai UAE schools',
	],
	203 => [
		'title'   => 'Automotive SEO Dubai — SEO for UAE Car Dealers & Garages',
		'desc'    => 'Specialist automotive SEO for UAE car dealerships, showrooms and garages. Rank for high-intent vehicle searches and drive qualified showroom footfall.',
		'keyword' => 'automotive SEO Dubai UAE car dealers',
	],
];

foreach ( $extra_services as $id => $data ) {
	yoast_set( $id, $data['title'], $data['desc'], $data['keyword'] );
	echo "✓ Extra service {$id}: {$data['title']}\n";
}

echo "\n✅ All Yoast meta titles and descriptions seeded successfully.\n";
echo "   Sitemap available at: /sitemap_index.xml\n";
echo "   OG and Twitter cards: enabled\n";
