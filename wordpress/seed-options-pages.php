<?php
/**
 * Seed: Homepage Options, Theme Settings, Dubai page, About page, Location pages
 * Run: php wp-cli.phar --path=wordpress eval-file seed-options-pages.php
 */
if ( ! defined( 'ABSPATH' ) ) define( 'ABSPATH', __DIR__ . '/' );

// ─────────────────────────────────────────────────────────────────────────────
// 1. THEME SETTINGS (global options)
// ─────────────────────────────────────────────────────────────────────────────
update_field( 'site_phone',    '+971 4 568 7444',                                            'option' );
update_field( 'site_email',    'sales@searchengineoptimization.ae',                          'option' );
update_field( 'site_address',  'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE', 'option' );
update_field( 'site_maps_url', 'https://goo.gl/maps/DeiraDubai',                            'option' );
update_field( 'footer_tagline','Dubai\'s #1 Enterprise SEO & Digital Growth Agency',         'option' );
update_field( 'social_linkedin',  'https://linkedin.com/company/searchengineoptimizationae', 'option' );
update_field( 'social_instagram', 'https://instagram.com/seo.ae',                           'option' );
update_field( 'social_facebook',  'https://facebook.com/searchengineoptimizationae',         'option' );
update_field( 'social_twitter',   'https://x.com/seoae',                                    'option' );
echo "✅ Theme settings updated\n";

// ─────────────────────────────────────────────────────────────────────────────
// 2. HOMEPAGE SETTINGS
// ─────────────────────────────────────────────────────────────────────────────
update_field( 'hero_headline',           'Turn Search Visibility Into Business Growth',                                                                'option' );
update_field( 'hero_subheadline',        "We architect digital dominance for Dubai's most ambitious brands — combining AI-driven SEO, precision paid media, and conversion-led design to make you the market leader.",                          'option' );
update_field( 'hero_cta_primary',        'Get Free SEO Audit',                                                                                        'option' );
update_field( 'hero_cta_primary_url',    '/contact',                                                                                                  'option' );
update_field( 'hero_cta_secondary',      'View Case Studies',                                                                                         'option' );
update_field( 'hero_cta_secondary_url',  '/case-studies',                                                                                             'option' );
update_field( 'hero_badge_text',         "Dubai's #1 Enterprise SEO Agency",                                                                          'option' );
update_field( 'cta_heading',             "Ready to Dominate Dubai's Search Results?",                                                                 'option' );
update_field( 'cta_description',         'Join 1,200+ UAE businesses that trust SearchEngineOptimization.ae to drive measurable organic growth, qualified leads, and revenue from search.',                                                    'option' );

update_field( 'hero_stats', [
  [ 'stat_prefix' => '+',  'stat_value' => '340', 'stat_suffix' => '%', 'stat_label' => 'AVG. ROI Increase'   ],
  [ 'stat_prefix' => '',   'stat_value' => '1200','stat_suffix' => '+', 'stat_label' => 'Projects Delivered'  ],
  [ 'stat_prefix' => '',   'stat_value' => '4.9', 'stat_suffix' => '/5','stat_label' => 'Google Rating'       ],
  [ 'stat_prefix' => '',   'stat_value' => '10',  'stat_suffix' => '+', 'stat_label' => 'Years Experience'    ],
], 'option' );

update_field( 'why_choose_items', [
  [
    'why_icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
    'why_title' => 'Data-Driven Strategy',
    'why_desc'  => 'Every decision backed by real UAE market data — keyword volumes, competitor analysis, and revenue attribution — never guesswork.',
  ],
  [
    'why_icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
    'why_title' => 'AI-Powered Execution',
    'why_desc'  => 'We leverage the latest AI tools for keyword research, content strategy, and competitive intelligence to stay ahead of Google\'s evolving algorithm.',
  ],
  [
    'why_icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>',
    'why_title' => 'Certified Google Partner',
    'why_desc'  => 'Certified by Google, Bing, Meta, and HubSpot. Our specialists hold current certifications and maintain cutting-edge knowledge of platform best practices.',
  ],
  [
    'why_icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'why_title' => 'Revenue-First Reporting',
    'why_desc'  => 'We report on the metrics that matter — leads, revenue, and ROI — not vanity rankings. Every campaign is tied to measurable business outcomes.',
  ],
  [
    'why_icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'why_title' => 'UAE Market Specialists',
    'why_desc'  => 'Ten years of operating exclusively in the UAE and GCC gives us unmatched local market knowledge — English and Arabic, across every emirate and sector.',
  ],
  [
    'why_icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
    'why_title' => 'Dedicated Account Teams',
    'why_desc'  => 'You get a dedicated Account Manager, Senior SEO Strategist, and Technical Lead — real specialists accountable for your results, not an anonymous support queue.',
  ],
], 'option' );
echo "✅ Homepage settings updated\n";

// ─────────────────────────────────────────────────────────────────────────────
// 3. DUBAI PAGE (ID 84) — 1200-word SEO content
// ─────────────────────────────────────────────────────────────────────────────
$dubai_content = '<p class="lead">Dubai is the digital marketing capital of the Middle East — a global business hub where over 3.5 million residents, thousands of international companies, and millions of annual tourists converge in one of the world\'s most connected and commercially dynamic cities. For businesses competing in this extraordinary marketplace, ranking on Google\'s first page for Dubai-specific search queries is not just an advantage — it is the primary driver of sustainable customer acquisition in 2026 and beyond.</p>

<h2>Why Dubai SEO Is Different From Every Other Market</h2>
<p>Dubai\'s search landscape is unique in ways that profoundly impact SEO strategy. The population is over 88% expatriate, creating a market where searchers span 200+ nationalities using different languages, cultural contexts, and search behaviours simultaneously. Bilingual English-Arabic search optimisation is not optional here — it is essential. A strategy that ignores Arabic search terms misses a significant portion of the UAE\'s highest-income consumer segments and the entire Arabic-speaking GCC export market.</p>

<p>Dubai also has one of the world\'s highest smartphone penetration rates — over 98%. Mobile-first indexing and Core Web Vitals scores are therefore directly correlated with commercial success in a way that is more acute here than almost any other market. Google\'s mobile-first crawling means your Dubai site\'s mobile experience must be flawless to achieve and maintain rankings.</p>

<p>Competition levels for Dubai commercial keywords are intense. "SEO agency Dubai," "digital marketing Dubai," "real estate Dubai" — these keywords attract global players, established regional agencies, and local specialists all competing fiercely for first-page visibility. Breaking through requires a genuinely sophisticated, multi-layered strategy, not the template-based SEO that works in lower-competition markets.</p>

<h2>Dubai\'s Digital Economy: The Opportunity Is Enormous</h2>
<p>Dubai\'s e-commerce market is projected to reach $9.2 billion by 2026. Digital advertising spend in the UAE exceeds $1.5 billion annually. Dubai\'s internet penetration rate of 99% means virtually every consumer and business decision-maker is reachable through digital channels. For businesses with ambitions in the UAE market, the opportunity to capture organic search traffic — free, qualified, and continuously compounding — is arguably the highest-return marketing investment available.</p>

<p>Consider the numbers: a first-page ranking for "SEO agency Dubai" reaches thousands of monthly searchers. A top-three position for "digital marketing Dubai" captures the majority of that traffic. Multiply this across dozens or hundreds of relevant keywords in your industry, and organic search becomes a lead generation engine that works 24 hours a day, 365 days a year, delivering compounding returns that grow over time rather than stopping when your budget does.</p>

<h2>Our Dubai SEO Agency: Where Strategy Meets Execution</h2>
<p>SearchEngineOptimization.ae was founded in Dubai in 2015. Our headquarters on Muteena Street, Deira places us at the heart of the city we serve. In the decade since, we have grown into a team of 50+ specialists — SEO strategists, technical developers, Arabic and English content creators, digital PR specialists, and paid media experts — all dedicated to a single mission: making Dubai businesses dominant in their digital markets.</p>

<p>Our Dubai office is your strategic partner, not a distant agency managing your account from another continent. We understand Dubai\'s business culture, its seasonal rhythms (Ramadan marketing strategy, Dubai Shopping Festival, Expo-driven demand surges), its regulatory environment (UAE advertising standards), and its competitive dynamics across every major industry sector.</p>

<h2>Industries We Serve in Dubai</h2>
<p>Our Dubai client portfolio spans every major commercial sector:</p>
<ul>
<li><strong>Real Estate:</strong> Competing for Dubai\'s highest-value keywords — "luxury apartments Dubai," "off-plan properties Dubai Marina" — requires domain authority, local content expertise, and precise geographic targeting we have spent years building.</li>
<li><strong>Healthcare & Medical:</strong> Healthcare searches are among Dubai\'s highest-volume commercial categories. We help hospitals, clinics, specialists, and wellness brands build the E-E-A-T signals Google requires for medical content to rank.</li>
<li><strong>Legal Services:</strong> Dubai law firms competing for "corporate lawyer Dubai" or "employment law UAE" need highly authoritative content and a reputation built through digital PR — our speciality.</li>
<li><strong>Hospitality & Tourism:</strong> From luxury hotels to tour operators, Dubai\'s hospitality sector demands both local SEO for direct bookings and broader content strategies for travel intent queries.</li>
<li><strong>Financial Services:</strong> Banks, fintech startups, insurance brokers, and wealth management firms navigate a regulated marketing environment where SEO provides compliant, cost-effective customer acquisition.</li>
<li><strong>Ecommerce:</strong> Dubai\'s booming online retail market rewards ecommerce brands with strong SEO foundations, fast websites, and product content that converts mobile browsers into buyers.</li>
</ul>

<h2>Local SEO: Dominating Google\'s Map Pack in Dubai</h2>
<p>For businesses serving specific Dubai districts — Business Bay, Downtown Dubai, Dubai Marina, JLT, DIFC, Deira, Bur Dubai, Dubai Healthcare City — local SEO is a critical revenue driver. When someone searches "best restaurant near DIFC" or "accountant Business Bay Dubai," Google displays a local map pack above organic results, capturing over 40% of all clicks.</p>

<p>Our local SEO service for Dubai includes: complete Google Business Profile optimisation with accurate NAP, compelling business description, photo optimisation, and review response management; local citation building across UAE and Dubai-specific directories; location-specific landing pages targeting individual Dubai districts and communities; and structured data implementation with LocalBusiness, GeoCoordinates, and OpeningHours schema.</p>

<h2>Visit Our Dubai Headquarters</h2>
<p>We believe the best client relationships are built face-to-face. Our Deira office welcomes clients for strategic consultations, campaign reviews, and discovery sessions. Whether you are a Dubai-based business looking to dominate local search, a regional brand expanding into the UAE market, or an international company seeking a local digital marketing partner, we invite you to experience our approach in person.</p>

<p>Our address is M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai — easily accessible from both the Deira area and central Dubai. We are open Sunday to Thursday, 9am to 6pm GST, and can arrange early morning or evening appointments for international clients in different time zones.</p>

<p><a href="/contact">Book your free Dubai SEO consultation today</a> and discover exactly what it would take to dominate Google search in your Dubai market sector. Our team will deliver a complete competitor analysis, keyword opportunity assessment, and a clear roadmap to first-page rankings — at no cost and with no obligation.</p>';

$dubai_id = get_page_by_path( 'dubai', OBJECT, 'page' );
if ( ! $dubai_id ) {
  $posts = get_posts(['name'=>'dubai','post_type'=>'page','post_status'=>'publish','numberposts'=>1]);
  if ($posts) $dubai_id = $posts[0];
}
$dubai_post_id = is_object($dubai_id) ? $dubai_id->ID : 84;

wp_update_post([
  'ID'           => $dubai_post_id,
  'post_title'   => 'SEO Dubai — #1 Search Engine Optimisation Agency in Dubai, UAE',
  'post_content' => $dubai_content,
  'post_status'  => 'publish',
]);

// ACF fields for Dubai page
update_post_meta( $dubai_post_id, 'seo_title',       'SEO Agency Dubai — #1 Ranked Search Engine Optimisation Company UAE | SearchEngineOptimization.ae' );
update_post_meta( $dubai_post_id, 'seo_description', 'Dubai\'s leading SEO agency. First-page Google rankings, Arabic SEO, local search & AI optimisation for UAE businesses. Free audit. ☎ +971 4 568 7444.' );
echo "✅ Dubai page updated (ID: $dubai_post_id)\n";

// ─────────────────────────────────────────────────────────────────────────────
// 4. ABOUT PAGE — 800-word content
// ─────────────────────────────────────────────────────────────────────────────
$about_content = '<p class="lead">SearchEngineOptimization.ae is Dubai\'s leading enterprise SEO and digital marketing agency. Founded in 2015, we have spent a decade helping UAE businesses achieve first-page Google rankings, build lasting organic authority, and grow revenue through the full spectrum of digital marketing — from technical SEO and content strategy to paid media, AI search optimisation, and conversion-led web design.</p>

<h2>Our Mission: Digital Dominance for UAE Businesses</h2>
<p>We founded this agency with a clear conviction: that too many Dubai businesses were being underserved by generic, offshore, or template-driven digital marketing agencies that did not understand the UAE market, did not speak Arabic, and measured success by vanity metrics rather than revenue outcomes. We built SearchEngineOptimization.ae to be the agency we wished existed — deeply specialised, rigorously data-driven, and focused exclusively on results that move the bottom line.</p>

<p>Ten years and over 1,200 client campaigns later, that mission has not changed. We remain entirely focused on delivering measurable, attributable business growth through digital marketing excellence.</p>

<h2>Our Team of 50+ Digital Marketing Specialists</h2>
<p>Our team of 50+ specialists is the foundation of everything we deliver. We hire for deep expertise — not generalists who do everything adequately, but specialists who are exceptional in their domain. Our team includes:</p>
<ul>
<li><strong>Senior SEO Strategists</strong> with 7–15 years of specialist SEO experience, each managing a maximum of 8 client accounts to ensure genuine strategic attention</li>
<li><strong>Arabic Content Specialists</strong> — native Arabic writers and linguists who create culturally authentic content for UAE and GCC audiences</li>
<li><strong>Technical SEO Developers</strong> who implement complex technical fixes, schema markup, Core Web Vitals improvements, and site architecture refinements</li>
<li><strong>Digital PR Specialists</strong> with established relationships at UAE publications, regional news outlets, and international industry platforms</li>
<li><strong>Certified PPC Managers</strong> holding current Google Ads, Meta Blueprint, and Microsoft Advertising certifications</li>
<li><strong>UX Designers and Web Developers</strong> who build conversion-optimised websites that rank from day one</li>
</ul>

<h2>Certified & Recognised</h2>
<p>We are a certified Google Partner, Meta Business Partner, and HubSpot Solutions Provider. Our team holds current certifications across Google Ads (Search, Display, Shopping, Video), Google Analytics 4, Google Marketing Platform, Meta Blueprint, Microsoft Advertising, and HubSpot. We invest in continuous learning — algorithm updates, platform changes, and emerging channels like AI search are tracked and integrated into client strategies as they emerge.</p>

<h2>Our Values</h2>
<p>Three values define how we work with every client, every day:</p>
<ul>
<li><strong>Transparency:</strong> No black boxes, no hidden tactics, no inflated reporting. You see exactly what we do, why we do it, and what it achieves. Our reporting connects every activity to business outcomes.</li>
<li><strong>Excellence:</strong> We hold ourselves to the standard of the world\'s best digital marketing agencies — not merely the best in the UAE. Every deliverable, from a technical audit to a blog post, is produced to the highest standard or not at all.</li>
<li><strong>Partnership:</strong> We do not take clients — we build partnerships. Your long-term growth is our success metric. We average a client retention rate of 94% because we treat every business as if it were our own.</li>
</ul>

<h2>Our Dubai Headquarters</h2>
<p>We are proudly headquartered in Dubai, UAE — not managing UAE accounts from London, Mumbai, or Cairo. Our Deira office houses our full team and serves as the creative and strategic hub for every client campaign. Being based in Dubai means we understand the market, the culture, the competition, and the opportunity from the inside.</p>

<p>Explore our <a href="/services">full range of digital marketing services</a>, review our <a href="/case-studies">client case studies</a>, or <a href="/contact">book a free consultation</a> with our team to discuss your growth goals. We look forward to becoming your long-term digital marketing partner in the UAE.</p>';

$about_page = get_page_by_path( 'about', OBJECT, 'page' );
$about_id   = $about_page ? $about_page->ID : 0;
if ( ! $about_id ) {
  $posts = get_posts(['name'=>'about','post_type'=>'page','post_status'=>'publish','numberposts'=>1]);
  if ($posts) $about_id = $posts[0]->ID;
}
if ( $about_id ) {
  wp_update_post([
    'ID'           => $about_id,
    'post_title'   => 'About SearchEngineOptimization.ae — Dubai\'s #1 SEO Agency',
    'post_content' => $about_content,
    'post_status'  => 'publish',
  ]);
  echo "✅ About page updated (ID: $about_id)\n";
} else {
  echo "⚠️  About page not found — skipping\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// 5. CONTACT PAGE — content
// ─────────────────────────────────────────────────────────────────────────────
$contact_content = '<p>Ready to dominate your Dubai market? Whether you want a free SEO audit, a paid media strategy review, a new website quote, or just a conversation about your digital marketing goals — our team is here and ready to help.</p>

<h2>How We Can Help Your UAE Business</h2>
<p>Our free initial consultation includes a review of your current search visibility, a competitor gap analysis, and specific recommendations you can act on immediately — regardless of whether you choose to work with us. We believe the best way to earn your trust is to deliver value before asking for anything in return.</p>

<ul>
<li><strong>Free SEO Audit:</strong> A complete technical and competitive analysis of your website\'s current SEO health</li>
<li><strong>Free PPC Account Review:</strong> An honest assessment of your current Google Ads performance and wasted spend</li>
<li><strong>Website Review:</strong> Conversion rate analysis and recommendations for your existing site</li>
<li><strong>Social Media Audit:</strong> Platform-by-platform analysis of your current social presence and opportunities</li>
</ul>

<h2>Visit Our Dubai Office</h2>
<p>We welcome in-person consultations at our Deira headquarters. Coffee is always on, and strategic conversations are always free. Our office is open Sunday to Thursday, 9am–6pm GST.</p>
<p><strong>Address:</strong> M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE<br>
<strong>Email:</strong> sales@searchengineoptimization.ae<br>
<strong>Phone:</strong> +971 4 568 7444</p>

<p>Explore our <a href="/services">services</a>, read our <a href="/case-studies">case studies</a>, or learn <a href="/about">about our agency</a> before getting in touch. We typically respond to all enquiries within 2 business hours.</p>';

$contact_page = get_page_by_path( 'contact', OBJECT, 'page' );
$contact_id   = $contact_page ? $contact_page->ID : 8;
wp_update_post([
  'ID'           => $contact_id,
  'post_content' => $contact_content,
  'post_status'  => 'publish',
]);
echo "✅ Contact page updated (ID: $contact_id)\n";

// ─────────────────────────────────────────────────────────────────────────────
// 6. CAREERS PAGE — content
// ─────────────────────────────────────────────────────────────────────────────
$careers_content = '<p class="lead">Join the team building Dubai\'s most ambitious digital marketing agency. At SearchEngineOptimization.ae, we hire exceptional people who are deeply passionate about their craft, obsessed with results, and excited by the extraordinary opportunity the UAE\'s digital market represents.</p>

<h2>Why Work at SearchEngineOptimization.ae?</h2>
<p>We are not a typical agency. We have deliberately stayed focused on digital marketing excellence rather than diversifying into every possible service. This means our team members become genuinely world-class in their discipline — working on complex, high-stakes campaigns for ambitious UAE businesses, with access to the best tools, real strategic responsibility, and colleagues who take their craft as seriously as they do.</p>

<h2>Our Culture</h2>
<ul>
<li><strong>Continuous Learning:</strong> AED 5,000 annual training budget per team member, weekly internal knowledge-sharing sessions, and paid conference attendance</li>
<li><strong>Real Ownership:</strong> Strategists manage their accounts with genuine autonomy — not following a rigid script but thinking strategically about their clients\' businesses</li>
<li><strong>Work-Life Balance:</strong> Core hours 9am–6pm with no expectation of weekend work. High performance is about quality, not hours</li>
<li><strong>Competitive Compensation:</strong> Base salary at the 75th percentile for the UAE market, plus performance bonuses tied to client results</li>
<li><strong>Dubai Benefits:</strong> Health insurance (self + family), visa sponsorship, annual flights allowance, and team social events</li>
</ul>

<h2>Current Openings</h2>
<p>We are currently hiring for the following roles:</p>
<ul>
<li>Senior SEO Strategist (3+ years enterprise SEO experience)</li>
<li>PPC Manager — Google & Meta Certified (2+ years agency experience)</li>
<li>Arabic Content Writer (native Arabic, strong SEO knowledge)</li>
<li>Technical SEO Developer (WordPress, PHP, Python, Core Web Vitals)</li>
<li>Account Manager (UAE digital marketing experience preferred)</li>
</ul>

<p>Even if your role is not listed, we review speculative applications from exceptional candidates. <a href="/contact">Send your CV and a brief introduction</a> to careers@searchengineoptimization.ae and tell us why you would be an asset to our team.</p>';

$careers_page = get_page_by_path( 'careers', OBJECT, 'page' );
$careers_id   = $careers_page ? $careers_page->ID : 9;
wp_update_post([
  'ID'           => $careers_id,
  'post_content' => $careers_content,
  'post_status'  => 'publish',
]);
echo "✅ Careers page updated (ID: $careers_id)\n";

// ─────────────────────────────────────────────────────────────────────────────
// 7. UPDATE NAVIGATION MENUS
// ─────────────────────────────────────────────────────────────────────────────
// Ensure Main Navigation has key pages
$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
if ( $main_menu ) {
  $menu_id = $main_menu->term_id;
  // Clear and rebuild
  $existing = wp_get_nav_menu_items($menu_id);
  foreach ((array)$existing as $item) {
    wp_delete_post($item->ID, true);
  }
  
  // Home
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Home','menu-item-url'=>home_url('/'),'menu-item-status'=>'publish','menu-item-type'=>'custom']);
  
  // Services (parent)
  $svc_item = wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Services','menu-item-url'=>home_url('/services'),'menu-item-status'=>'publish','menu-item-type'=>'custom']);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'SEO Services','menu-item-url'=>home_url('/services/search-engine-optimization'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$svc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'PPC Management','menu-item-url'=>home_url('/services/ppc-management'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$svc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'AI Search Optimisation','menu-item-url'=>home_url('/services/ai-search-optimization'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$svc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Social Media Marketing','menu-item-url'=>home_url('/services/social-media-marketing'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$svc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Web Design','menu-item-url'=>home_url('/services/web-design'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$svc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Web Development','menu-item-url'=>home_url('/services/web-development'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$svc_item]);
  
  // Locations
  $loc_item = wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Locations','menu-item-url'=>home_url('/locations'),'menu-item-status'=>'publish','menu-item-type'=>'custom']);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'SEO Dubai','menu-item-url'=>home_url('/locations/dubai'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$loc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'SEO Abu Dhabi','menu-item-url'=>home_url('/locations/seo-abu-dhabi'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$loc_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'SEO Sharjah','menu-item-url'=>home_url('/locations/seo-sharjah'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$loc_item]);
  
  // Company
  $company_item = wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Company','menu-item-url'=>'#','menu-item-status'=>'publish','menu-item-type'=>'custom']);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'About Us','menu-item-url'=>home_url('/about'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$company_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Case Studies','menu-item-url'=>home_url('/case-studies'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$company_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Blog','menu-item-url'=>home_url('/blog'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$company_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Careers','menu-item-url'=>home_url('/careers'),'menu-item-status'=>'publish','menu-item-type'=>'custom','menu-item-parent-id'=>$company_item]);
  wp_update_nav_menu_item($menu_id, 0, ['menu-item-title'=>'Contact','menu-item-url'=>home_url('/contact'),'menu-item-status'=>'publish','menu-item-type'=>'custom']);
  
  echo "✅ Main Navigation menu updated\n";
}

echo "\n🎉 All options, pages, and navigation seeded successfully!\n";
