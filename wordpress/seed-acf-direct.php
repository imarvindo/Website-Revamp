<?php
/**
 * Seed ACF repeater + scalar fields via direct update_post_meta()
 * Bypasses ACF field resolution issues in WP-CLI context.
 * Run: php wp-cli.phar --path=wordpress eval-file /home/runner/workspace/wordpress/seed-acf-direct.php
 */

// ─────────────────────────────────────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────────────────────────────────────

/** Set a scalar ACF field directly */
function acf_set( $post_id, $field_name, $field_key, $value ) {
  update_post_meta( $post_id, $field_name, $value );
  update_post_meta( $post_id, "_$field_name", $field_key );
}

/** Set an ACF repeater field directly */
function acf_set_repeater( $post_id, $field_name, $field_key, $rows, $sub_keys ) {
  // Remove all old rows
  $old_count = (int) get_post_meta( $post_id, $field_name, true );
  for ( $i = 0; $i < $old_count + 5; $i++ ) {
    foreach ( array_keys( $sub_keys ) as $sub_name ) {
      delete_post_meta( $post_id, "{$field_name}_{$i}_{$sub_name}" );
      delete_post_meta( $post_id, "_{$field_name}_{$i}_{$sub_name}" );
    }
  }
  // Set new rows
  $count = count( $rows );
  update_post_meta( $post_id, $field_name, $count );
  update_post_meta( $post_id, "_$field_name", $field_key );
  foreach ( $rows as $i => $row ) {
    foreach ( $row as $sub_name => $value ) {
      update_post_meta( $post_id, "{$field_name}_{$i}_{$sub_name}", $value );
      if ( isset( $sub_keys[ $sub_name ] ) ) {
        update_post_meta( $post_id, "_{$field_name}_{$i}_{$sub_name}", $sub_keys[ $sub_name ] );
      }
    }
  }
}

// ─────────────────────────────────────────────────────────────────────────────
// SERVICE DATA  (post IDs: SEO=13, PPC=15, AI=14, Social=16, Design=17, Dev=18)
// ─────────────────────────────────────────────────────────────────────────────
$services = [

  13 => [
    'title'              => 'Search Engine Optimisation Services Dubai, UAE',
    'short_description'  => "Dubai's leading enterprise SEO agency delivering sustainable first-page rankings, qualified organic traffic, and compounding revenue growth for ambitious UAE businesses.",
    'category_label'     => 'SEO Services',
    'hero_badge'         => 'Google Partner',
    'hero_badge_sub'     => 'Certified Excellence',
    'cta_primary_text'   => 'Get Free SEO Audit',
    'cta_phone_text'     => 'Call Our SEO Team',
    'benefits' => [
      ['benefit'=>'Rank for high-intent UAE keywords that attract ready-to-buy customers'],
      ['benefit'=>'Build a compounding organic traffic asset that grows month over month'],
      ['benefit'=>'Reduce cost per acquisition by up to 80% versus paid advertising channels'],
      ['benefit'=>'Dominate Google Search, AI Overviews, and featured snippets simultaneously'],
      ['benefit'=>'Full technical SEO audit covering 200+ ranking factors across your website'],
      ['benefit'=>'AI-powered keyword research targeting English and Arabic search queries'],
      ['benefit'=>'Authority link building from UAE publications and high-DA global domains'],
      ['benefit'=>'Local SEO and Google Business Profile optimisation for Dubai map rankings'],
      ['benefit'=>'Monthly ROI reporting tied to leads, revenue, and business outcomes'],
      ['benefit'=>'E-E-A-T optimisation to build Google trust across your entire domain'],
    ],
    'process_steps' => [
      ['step_title'=>'Discovery & Business Analysis','step_desc'=>'We immerse ourselves in your business model, target customers, competitive landscape, and current digital footprint. Every campaign begins with understanding your revenue goals — not just rankings.'],
      ['step_title'=>'Technical & Competitive Audit','step_desc'=>'A 200-point technical SEO audit identifies every barrier between your site and Google\'s first page. We simultaneously reverse-engineer the top competitors ranking for your target keywords.'],
      ['step_title'=>'Keyword Research & Content Strategy','step_desc'=>'Using Ahrefs, SEMrush, and proprietary UAE market data, we map the full keyword universe — identifying priority targets, quick wins, and long-term content opportunity clusters.'],
      ['step_title'=>'Technical Implementation','step_desc'=>'Our developers execute all fixes: Core Web Vitals improvements, crawl optimisation, schema markup, site architecture refinements, and any structural changes needed to unlock ranking potential.'],
      ['step_title'=>'Content Creation & Optimisation','step_desc'=>'We create and optimise content that serves both human readers and AI search systems — comprehensive, authoritative, and structured to capture featured snippets and People Also Ask boxes.'],
      ['step_title'=>'Link Building & Digital PR','step_desc'=>'Systematic outreach to earn high-quality backlinks from UAE publications, industry platforms, and authoritative directories. Every link is genuine, contextually relevant, and built to last.'],
      ['step_title'=>'Monthly Reporting & Strategy Review','step_desc'=>'Live dashboards, monthly performance reports, and quarterly strategy calls keep you fully informed on rankings, traffic, leads, and revenue attribution. We adapt as opportunities emerge.'],
    ],
    'service_faqs' => [
      ['question'=>'How long does SEO take to show results for a Dubai business?','answer'=>'<p>Most Dubai businesses see measurable keyword movement within 3–4 months and significant organic traffic growth between months 5–8. Highly competitive sectors like real estate, legal, and finance may take 9–12 months for top positions. SEO results compound over time — unlike paid ads that stop when your budget does.</p>'],
      ['question'=>'What makes SEO in the UAE different from other markets?','answer'=>'<p>The UAE market has unique characteristics: bilingual search behaviour (English and Arabic), a mobile-first audience with 98% smartphone penetration, intense global competition, and rapidly evolving Google AI Overviews. We tailor every campaign with UAE-specific keyword data, Arabic content capabilities, and deep knowledge of the local competitive landscape.</p>'],
      ['question'=>'How much does SEO cost in Dubai?','answer'=>'<p>Professional SEO in Dubai ranges from AED 3,000–5,000/month for SMEs to AED 15,000–50,000/month for enterprise campaigns. The investment depends on your website size, competitive landscape, and growth goals. We offer transparent milestone-based pricing. <a href="/contact">Contact us</a> for a free audit and custom proposal.</p>'],
      ['question'=>'Do you offer SEO for Arabic language search in the UAE?','answer'=>'<p>Yes. Arabic SEO is a core capability. Our team includes native Arabic content specialists who understand how UAE audiences search in both languages. We conduct separate Arabic keyword research, create culturally appropriate content, implement proper RTL technical setup, and build links from Arabic-language publications.</p>'],
      ['question'=>'Can you guarantee first-page rankings on Google?','answer'=>'<p>No ethical agency can guarantee specific rankings — Google\'s algorithm considers hundreds of factors. What we guarantee is a rigorous data-driven process, transparent reporting, and a track record of delivering first-page results for 94% of our clients\' primary target keywords within 12 months.</p>'],
      ['question'=>'What is the difference between local SEO and national SEO?','answer'=>'<p>Local SEO targets customers searching in specific UAE cities — optimising your Google Business Profile to appear in the map pack. National SEO targets broader commercial keywords regardless of location. Most UAE businesses benefit from both: local SEO for walk-in customers, plus national optimisation for online enquiries from across the Emirates.</p>'],
      ['question'=>'How do you measure SEO success beyond just rankings?','answer'=>'<p>We track organic traffic growth, conversion rate from organic visitors, cost per lead versus paid channels, revenue attributed to organic search, Share of Voice against competitors, and Domain Authority trends. Every monthly report ties SEO activity to bottom-line outcomes.</p>'],
      ['question'=>'Do you provide SEO services for ecommerce websites in the UAE?','answer'=>'<p>Absolutely. We optimise product pages, category architecture, faceted navigation, schema markup for rich results, Core Web Vitals for shopping performance, and product-level content strategies. We have delivered 200–500% organic revenue growth for UAE ecommerce clients across fashion, electronics, beauty, and food sectors.</p>'],
      ['question'=>'What is technical SEO and why does it matter?','answer'=>'<p>Technical SEO covers site speed, Core Web Vitals, mobile usability, crawl budget optimisation, XML sitemaps, canonical tags, structured data, HTTPS, duplicate content resolution, and site architecture. Without a solid technical foundation, even the best content and link-building campaigns underperform. Our audits cover 200+ ranking factors.</p>'],
      ['question'=>'How often will I receive reports on my SEO campaign?','answer'=>'<p>You receive a comprehensive monthly performance report covering keyword rankings, organic traffic, conversions, backlinks acquired, and technical health scores, plus access to a live Looker Studio dashboard showing real-time data 24/7. Enterprise clients receive weekly check-in calls during the first 90 days.</p>'],
    ],
    'technologies' => [
      ['tech_name'=>'Ahrefs'],['tech_name'=>'SEMrush'],['tech_name'=>'Google Search Console'],
      ['tech_name'=>'Screaming Frog'],['tech_name'=>'Google Analytics 4'],['tech_name'=>'Surfer SEO'],
      ['tech_name'=>'Majestic'],['tech_name'=>'PageSpeed Insights'],['tech_name'=>'Looker Studio'],
      ['tech_name'=>'BrightEdge'],
    ],
    'related_services' => [15, 14],
  ],

  15 => [
    'title'              => 'PPC & Google Ads Management Dubai, UAE',
    'short_description'  => "Precision-managed Google Ads and paid media campaigns that maximise your ROI in Dubai's competitive digital marketplace — zero waste spend, measurable results from day one.",
    'category_label'     => 'Paid Advertising',
    'hero_badge'         => 'Google Partner',
    'hero_badge_sub'     => 'Certified Specialists',
    'cta_primary_text'   => 'Get Free PPC Audit',
    'cta_phone_text'     => 'Call Our PPC Team',
    'benefits' => [
      ['benefit'=>'Immediate first-page visibility from day one — no waiting for organic rankings'],
      ['benefit'=>'Precision audience targeting by location, device, time, demographics, and intent'],
      ['benefit'=>'Full Google Ads account audit identifying wasted spend and quick-win optimisations'],
      ['benefit'=>'Conversion-focused landing page strategy to maximise ad spend return'],
      ['benefit'=>'Smart Bidding with AI-powered automated strategies tailored to your goals'],
      ['benefit'=>'Remarketing campaigns re-engaging website visitors across Google Display Network'],
      ['benefit'=>'Competitive conquest campaigns targeting competitor brand keywords in Dubai'],
      ['benefit'=>'Shopping and Performance Max campaigns for UAE ecommerce businesses'],
      ['benefit'=>'Meta Ads, LinkedIn Ads, and TikTok Ads management for full-funnel coverage'],
      ['benefit'=>'Weekly optimisation cycles with transparent revenue-attributed reporting'],
    ],
    'process_steps' => [
      ['step_title'=>'Account Audit & Competitor Research','step_desc'=>'We audit your existing Google Ads account to identify wasted spend, missing keywords, poor Quality Scores, and immediate improvement opportunities — or analyse competitor strategies if you\'re starting fresh.'],
      ['step_title'=>'Campaign Strategy & Structure','step_desc'=>'We architect a clean, logical campaign structure segmented by service, product, location, and intent — ensuring Google\'s algorithm can understand and reward your campaigns with lower CPCs and better Ad Rank.'],
      ['step_title'=>'Keyword Research & Negative Lists','step_desc'=>'Comprehensive keyword research across all match types, combined with exhaustive negative keyword lists, ensures your budget reaches genuine buyers — not irrelevant searches that drain spend.'],
      ['step_title'=>'Ad Copy & Landing Page Creation','step_desc'=>'Our copywriters create compelling, high-CTR ad copy with strong USPs and clear calls-to-action. We also build or optimise conversion-focused landing pages that turn clicks into enquiries and sales.'],
      ['step_title'=>'Bid Strategy & Budget Allocation','step_desc'=>'We configure Smart Bidding strategies — Target CPA, Target ROAS, or Maximise Conversions — calibrated to your specific goals and historical performance data for optimal efficiency from day one.'],
      ['step_title'=>'Continuous Optimisation','step_desc'=>'Weekly optimisation cycles adjust bids, pause underperforming ads, test new copy variations, expand keyword lists, and refine audience targeting to continuously improve performance and reduce wasted spend.'],
      ['step_title'=>'Reporting & Strategic Reviews','step_desc'=>'Weekly performance snapshots and monthly strategy reports detail every metric — impressions, clicks, conversions, CPA, ROAS, and revenue. Quarterly reviews align campaign strategy with evolving business goals.'],
    ],
    'service_faqs' => [
      ['question'=>'How much should a Dubai business spend on Google Ads?','answer'=>'<p>A minimum viable budget for competitive UAE keywords is typically AED 5,000–10,000/month in ad spend. Highly competitive sectors like real estate, legal, or healthcare commonly spend AED 20,000–50,000+/month. The right budget depends on your industry\'s average CPC, conversion rates, and business goals. We always start with a cost-per-acquisition analysis so your budget is determined by target ROI, not guesswork.</p>'],
      ['question'=>'What is ROAS and what should I target for my UAE campaign?','answer'=>'<p>ROAS (Return on Ad Spend) is the revenue earned for every dirham spent. A ROAS of 4x means you earn AED 4 for every AED 1 spent. For UAE ecommerce, a healthy ROAS is typically 3–8x depending on margins. For lead generation, we track Cost Per Lead and Cost Per Acquisition. We set targets based on your actual profit margins to ensure campaigns are genuinely profitable.</p>'],
      ['question'=>'How long does it take for Google Ads to deliver results?','answer'=>'<p>Google Ads delivers results from day one — ads appear in search results as soon as campaigns go live. Smart Bidding algorithms need a 2–4 week learning period to optimise towards your conversion goals. By weeks 4–8, campaigns typically operate at target efficiency. Full optimisation with statistically significant data usually takes 60–90 days.</p>'],
      ['question'=>'Do you manage Meta Ads as well as Google Ads?','answer'=>'<p>Yes. We manage full-funnel paid media across Google Ads (Search, Display, Shopping, Performance Max, YouTube), Meta Ads (Facebook and Instagram), LinkedIn Ads, TikTok Ads, and Snapchat Ads. For UAE businesses, we recommend a Google Ads-first strategy for high-intent searches combined with Meta Ads for brand awareness and remarketing.</p>'],
      ['question'=>'What is remarketing and why is it important for UAE businesses?','answer'=>'<p>Remarketing shows targeted ads to people who visited your website but didn\'t convert. Studies show only 2–4% of visitors convert on their first visit. Remarketing keeps your brand visible to the remaining 96–98% — significantly increasing conversion rates at a fraction of the cost of acquiring new clicks. For UAE businesses with high-value products or services, remarketing is often the highest-ROAS channel in the entire marketing mix.</p>'],
      ['question'=>'What is the difference between Search Ads and Performance Max?','answer'=>'<p>Search Ads target specific keywords users are actively searching — ideal for high-intent bottom-of-funnel capture. Performance Max uses Google\'s AI to serve ads across all Google properties simultaneously based on your conversion goals. We typically recommend running both: Search for intent capture and Performance Max for broad market coverage.</p>'],
      ['question'=>'How do you prevent wasted ad spend?','answer'=>'<p>We prevent waste through comprehensive negative keyword lists (500–2,000+ negatives from day one), precise audience targeting, weekly search term analysis, geographic bid adjustments, device and time-of-day scheduling, and strict match type discipline. Clients from self-managed campaigns see a 30–50% reduction in wasted spend within the first 30 days while maintaining conversion volume.</p>'],
      ['question'=>'Can PPC work alongside SEO, or should I choose one?','answer'=>'<p>PPC and <a href="/services/search-engine-optimization">SEO</a> are most powerful together. PPC delivers immediate visibility while SEO builds long-term organic authority. As SEO rankings improve, you can reduce PPC spend on keywords where you already rank organically. PPC data also provides invaluable keyword insights that inform your SEO content strategy.</p>'],
      ['question'=>'Do you offer Google Shopping Ads for UAE ecommerce?','answer'=>'<p>Yes. Google Shopping (now part of Performance Max) is one of the highest-ROAS channels for UAE ecommerce. We handle complete Merchant Centre setup, product feed optimisation, custom labels, competitive bidding strategies, and PMax asset creation. Our ecommerce PPC campaigns have delivered 4–10x ROAS for clients in fashion, electronics, home, and beauty categories.</p>'],
      ['question'=>'What reports will I receive on my PPC campaigns?','answer'=>'<p>Weekly performance snapshots covering spend, clicks, conversions, CPA, and ROAS. A comprehensive monthly report details campaign-level performance, ad group analysis, search term insights, competitor auction data, and strategic recommendations. You also have access to a live Looker Studio dashboard showing real-time campaign data 24/7.</p>'],
    ],
    'technologies' => [
      ['tech_name'=>'Google Ads'],['tech_name'=>'Meta Ads Manager'],['tech_name'=>'Google Analytics 4'],
      ['tech_name'=>'Google Merchant Centre'],['tech_name'=>'Looker Studio'],['tech_name'=>'SEMrush'],
      ['tech_name'=>'LinkedIn Campaign Manager'],['tech_name'=>'TikTok Ads Manager'],
      ['tech_name'=>'Google Tag Manager'],['tech_name'=>'Optmyzr'],
    ],
    'related_services' => [13, 16],
  ],

  14 => [
    'title'              => 'AI Search Optimisation — GEO & AIO Services Dubai',
    'short_description'  => "Future-proof your brand visibility in the age of AI search. We optimise your content to appear in Google AI Overviews, ChatGPT, Perplexity, and Bing Copilot — the new frontier of search.",
    'category_label'     => 'AI SEO',
    'hero_badge'         => 'First Movers',
    'hero_badge_sub'     => 'AI-Ready Agency',
    'cta_primary_text'   => 'Get AI SEO Strategy',
    'cta_phone_text'     => 'Talk to Our AI Team',
    'benefits' => [
      ['benefit'=>'Appear in Google AI Overviews (AIOs) for your most valuable search queries'],
      ['benefit'=>'Get cited by ChatGPT, Perplexity, Claude, and Bing Copilot as a trusted source'],
      ['benefit'=>'Entity-based SEO building brand knowledge graph presence across the web'],
      ['benefit'=>'Structured data and schema markup optimised for AI-readable content formats'],
      ['benefit'=>'Comprehensive E-E-A-T strategy building expertise signals Google AI trusts'],
      ['benefit'=>'Featured snippet and People Also Ask box optimisation for AI content sourcing'],
      ['benefit'=>'Conversational keyword strategy matching natural language AI query patterns'],
      ['benefit'=>'Brand mention monitoring and PR strategy to amplify citation authority'],
      ['benefit'=>'Voice search optimisation for smart speakers and AI assistants in the UAE'],
      ['benefit'=>'Monthly AI search visibility tracking measuring AIO appearances and citations'],
    ],
    'process_steps' => [
      ['step_title'=>'AI Search Landscape Analysis','step_desc'=>'We audit which AI search platforms are generating traffic in your industry, which competitor content is being cited, and what content characteristics the AI systems are rewarding — giving us a precise target to optimise towards.'],
      ['step_title'=>'Entity & Knowledge Graph Audit','step_desc'=>'We assess your brand\'s entity presence across the web — Google Knowledge Panel, Wikidata, LinkedIn, major publications — and identify the gaps preventing AI systems from recognising your authority.'],
      ['step_title'=>'Content Architecture Redesign','step_desc'=>'We restructure your key pages with AI-friendly content formats: clear definitions, numbered lists, comparison tables, FAQ sections, and expert author signals that AI systems preferentially extract and cite.'],
      ['step_title'=>'Schema & Structured Data','step_desc'=>'Comprehensive schema markup implementation (FAQPage, HowTo, Article, Person, Organization, Service, LocalBusiness) makes your content machine-readable for AI systems and earns rich results in traditional search.'],
      ['step_title'=>'Authority Signal Building','step_desc'=>'Digital PR campaigns, expert commentary placements, podcast appearances, and authoritative publication features build the external citation network that AI models use to assess your expertise and trustworthiness.'],
      ['step_title'=>'Conversational Content Creation','step_desc'=>'We create content optimised for conversational, natural language queries — the query style predominantly used with AI assistants. This includes comprehensive FAQ content, how-to guides, and comparison content.'],
      ['step_title'=>'Monitor & Adapt','step_desc'=>'Monthly tracking of AI Overview appearances, competitor citation rates, and brand mention velocity across AI platforms. We continuously adapt strategy as AI search algorithms evolve rapidly.'],
    ],
    'service_faqs' => [
      ['question'=>'What is Google AI Overviews and how do I appear in them?','answer'=>'<p>Google AI Overviews are AI-generated summaries appearing at the top of Google results, synthesising information from multiple web sources. To appear, your content needs to be comprehensive, well-structured, and trusted by Google as an authoritative source. Key factors: strong E-E-A-T signals, FAQPage/HowTo schema markup, existing first-page rankings for the target query, and a well-established brand entity in Google\'s Knowledge Graph.</p>'],
      ['question'=>'What is GEO (Generative Engine Optimisation)?','answer'=>'<p>GEO is the discipline of optimising your digital presence to be cited and recommended by AI search engines like ChatGPT, Perplexity, Claude, and Google Gemini. Unlike traditional SEO which focuses on ranking in blue-link results, GEO focuses on building the authority, trust signals, and content characteristics that cause AI models to cite your business when users ask relevant questions.</p>'],
      ['question'=>'Does AI search reduce the value of traditional SEO?','answer'=>'<p>AI search complements rather than replaces traditional SEO — approximately 70% of AI Overview citations come from pages already ranking in the top 10 organic results. However, AI search reduces click-through rates for queries where AIOs provide complete answers. The smart strategy: maintain strong <a href="/services/search-engine-optimization">SEO foundations</a> while simultaneously optimising for AI citation.</p>'],
      ['question'=>'Which AI platforms should I optimise for?','answer'=>'<p>Priority platforms for UAE businesses: Google AI Overviews (highest traffic volume), Perplexity AI (fastest growing, influential in B2B research), ChatGPT with Browse/Search (enormous user base), Bing Copilot (integrated into Microsoft 365), and Google Gemini. Optimising for one tends to improve visibility across all, since all AI systems value the same things — comprehensive content, verified expertise, and strong brand authority.</p>'],
      ['question'=>'What is entity SEO and why does it matter for AI search?','answer'=>'<p>Entities are the real-world people, organisations, places, and concepts that knowledge graphs like Google\'s track and connect. AI systems rely heavily on entity relationships when researching topics. Entity SEO builds your brand\'s presence across structured data sources, Knowledge Graph entries, Wikidata, LinkedIn, major directories, and citation networks. Strong entity presence is increasingly critical to AI visibility.</p>'],
      ['question'=>'How do you measure success in AI search optimisation?','answer'=>'<p>We track: frequency of Google AIO appearances for target queries, brand mention velocity on AI platforms, Knowledge Panel presence and completeness, featured snippet ownership rates, Share of Voice in AI-generated responses versus competitors, and referral traffic from AI platforms like Perplexity. We use specialised monitoring tools plus manual query sampling to build a picture of your AI search visibility over time.</p>'],
      ['question'=>'Do I need separate Arabic content for AI search for UAE audiences?','answer'=>'<p>Yes. Arabic-language AI queries require Arabic-language authoritative content to be cited. UAE consumers increasingly use voice search and AI assistants in Arabic, particularly for local service queries. We create bilingual AI-optimised content — English and Arabic — with proper hreflang implementation and outreach to Arabic-language authoritative publications.</p>'],
      ['question'=>'How is AI SEO different from traditional SEO?','answer'=>'<p>Traditional SEO optimises for algorithmic ranking signals — backlinks, keywords, technical factors. AI SEO optimises for trustworthiness and citation-worthiness — comprehensiveness, factual accuracy, expert authorship, brand authority, and structured data. AI systems prefer definitional content, structured answers, numbered processes, and FAQ formats that can be cleanly extracted and synthesised.</p>'],
      ['question'=>'What is schema markup and how does it help AI search?','answer'=>'<p>Schema markup is structured data (JSON-LD) added to your HTML that explicitly describes your content to search engines and AI systems. FAQPage schema tells Google your content contains Q&A pairs ideal for AIO sourcing. HowTo schema marks up step-by-step processes. Organization and LocalBusiness schemas verify your brand identity and Dubai location. AI systems consume schema markup directly.</p>'],
      ['question'=>'How quickly can AI SEO show results?','answer'=>'<p>Some quick wins — appearing in featured snippets or implementing FAQPage schema — can produce visible results within 4–8 weeks. Building comprehensive entity authority and consistent AIO appearances is a 3–6 month process. The competitive advantage is significant: most UAE businesses have not yet begun optimising for AI search, meaning early movers can establish dominant AI visibility before the market catches up. <a href="/contact">Contact us</a> to assess your current AI search visibility.</p>'],
    ],
    'technologies' => [
      ['tech_name'=>'Google Search Labs'],['tech_name'=>'Perplexity AI'],['tech_name'=>'ChatGPT Search'],
      ['tech_name'=>'Schema.org'],['tech_name'=>'Google Search Console'],['tech_name'=>'Ahrefs'],
      ['tech_name'=>'Brand24'],['tech_name'=>'Surfer SEO'],['tech_name'=>'Google Knowledge Graph API'],
      ['tech_name'=>'Screaming Frog'],
    ],
    'related_services' => [13, 15],
  ],

  16 => [
    'title'              => 'Social Media Marketing Services Dubai, UAE',
    'short_description'  => "Strategic social media management and paid social advertising that builds brand authority, engages UAE audiences, and converts followers into paying customers across every platform.",
    'category_label'     => 'Social Media',
    'hero_badge'         => 'Meta Certified',
    'hero_badge_sub'     => 'Full Platform Coverage',
    'cta_primary_text'   => 'Get Social Media Audit',
    'cta_phone_text'     => 'Call Our Social Team',
    'benefits' => [
      ['benefit'=>'Full-service management across Instagram, LinkedIn, TikTok, Facebook, and X'],
      ['benefit'=>'Dubai-focused content strategy aligned with UAE culture, trends, and seasonality'],
      ['benefit'=>'Professional Arabic and English content creation by bilingual specialists'],
      ['benefit'=>'Community management: responding to comments, DMs, and reviews daily'],
      ['benefit'=>'Influencer marketing campaigns connecting your brand with UAE content creators'],
      ['benefit'=>'Paid social advertising — Meta Ads, LinkedIn Ads, TikTok Ads management'],
      ['benefit'=>'30-day content calendar with advance planning and client approval workflow'],
      ['benefit'=>'Brand voice development ensuring consistent messaging across all platforms'],
      ['benefit'=>'Competitor social analysis identifying content gaps and engagement opportunities'],
      ['benefit'=>'Monthly analytics reports tracking reach, engagement, follower growth, and leads'],
    ],
    'process_steps' => [
      ['step_title'=>'Brand & Audience Audit','step_desc'=>'We analyse your current social media presence, audience demographics, content performance history, competitor benchmarks, and UAE market positioning to establish an honest baseline and identify the biggest growth opportunities.'],
      ['step_title'=>'Strategy & Platform Selection','step_desc'=>'Not every platform deserves equal investment. We select the right mix — Instagram for visual brands, LinkedIn for B2B, TikTok for reach, X for real-time engagement — based on where your specific target audience spends their time.'],
      ['step_title'=>'Content Pillars & Calendar','step_desc'=>'We develop 4–6 content pillars aligned with your brand and audience needs, then build a 30-day content calendar mixing educational, entertaining, and promotional content at the optimal frequency for each platform.'],
      ['step_title'=>'Content Creation & Production','step_desc'=>'Our creative team produces platform-native content — Reels, Stories, carousels, infographics, videos, and written posts — in both English and Arabic, tailored to the visual and tonal expectations of UAE social media audiences.'],
      ['step_title'=>'Publishing & Community Management','step_desc'=>'We publish at optimal times for UAE audiences, monitor all comments and DMs, respond to followers and manage any reputation issues in real time — maintaining an active, engaged brand presence.'],
      ['step_title'=>'Paid Social Amplification','step_desc'=>'Organic reach is boosted strategically with targeted paid promotion on the posts with highest organic engagement, plus dedicated paid social campaigns for product launches, lead generation, and remarketing.'],
      ['step_title'=>'Analytics & Monthly Reporting','step_desc'=>'Monthly reports cover reach, impressions, engagement rate, follower growth, website traffic from social, lead generation, and paid social ROAS. We continuously optimise content strategy using this data.'],
    ],
    'service_faqs' => [
      ['question'=>'Which social media platforms should a Dubai business focus on?','answer'=>'<p>It depends on your industry and target audience. Instagram (88% UAE penetration) is essential for consumer brands, hospitality, and retail. LinkedIn is the priority for B2B companies and professional services. TikTok is critical for reaching 18–35 year-olds and brands wanting high organic reach. YouTube is ideal for educational content. We recommend starting with 2–3 platforms done exceptionally well rather than spreading thinly across all channels.</p>'],
      ['question'=>'How many posts per week do I need for effective social media in Dubai?','answer'=>'<p>For Instagram: 4–7 feed posts per week (Reels + carousels + static) plus daily Stories. For LinkedIn: 3–5 posts per week. For TikTok: 5–7 short videos per week for meaningful algorithmic reach. Consistency matters more than volume — a reliable 4-post-per-week strategy executed with quality content will always outperform inconsistent high-frequency posting.</p>'],
      ['question'=>'Do you create Arabic content for UAE social media?','answer'=>'<p>Yes. Our bilingual content team creates authentic Arabic and English content — not machine-translated copy. Arabic content is essential for reaching Emirati and Arab expat audiences. Arabic Reels and posts often achieve higher organic reach within GCC audiences. We create culturally appropriate content that respects Arabic social media norms and avoids translation errors that can damage brand perception.</p>'],
      ['question'=>'What is influencer marketing and is it effective in the UAE?','answer'=>'<p>UAE influencer marketing is one of the highest-ROI social channels available, with engagement rates 3–5x global averages. Micro-influencers (10,000–100,000 followers) typically deliver higher engagement and conversion rates than mega-influencers at a fraction of the cost. We manage end-to-end campaigns: talent identification, contract negotiation, brief creation, content approval, and performance tracking.</p>'],
      ['question'=>'How do you measure social media ROI for a Dubai business?','answer'=>'<p>Social media ROI measurement depends on objectives. For brand awareness: reach, impressions, follower growth, and Share of Voice. For engagement: engagement rate, saves, shares, and comment sentiment. For leads: click-through rates, form completions, and cost per lead from social. For ecommerce: direct social media revenue through UTM-tagged links and Meta Pixel attribution.</p>'],
      ['question'=>'What content performs best on Instagram in the UAE?','answer'=>'<p>Instagram Reels consistently deliver the highest organic reach in the UAE. Educational "how-to" content performs strongly. Behind-the-scenes and human interest content generates high engagement. Dubai lifestyle and aspirational content resonates particularly well. Stories with polls and interactive elements drive engagement and keep accounts algorithmically favoured. We continuously analyse content performance data across our client portfolio to identify what\'s working in your specific industry.</p>'],
      ['question'=>'Can social media marketing generate leads and sales directly?','answer'=>'<p>Absolutely. Instagram and Facebook Lead Ads allow users to submit contact details without leaving the platform — excellent for booking requests and service enquiries. LinkedIn Lead Gen Forms are particularly effective for B2B businesses. We combine organic lead nurturing with targeted paid social campaigns to deliver a measurable pipeline. Pair social with our <a href="/services/ppc-management">PPC management</a> for full-funnel digital marketing coverage.</p>'],
      ['question'=>'What is TikTok\'s potential for UAE businesses?','answer'=>'<p>TikTok UAE has one of the world\'s highest per-capita engagement rates. For consumer brands targeting 18–40 year olds, TikTok offers extraordinary organic reach — a single well-crafted video can reach tens of thousands of UAE users without any paid promotion. The algorithm favours genuine content quality over follower count, creating a level playing field for brands willing to invest in creative, entertaining content.</p>'],
      ['question'=>'Do you manage social media for multiple locations or franchise businesses?','answer'=>'<p>Yes. We manage multi-location social media for brands with presences across Dubai, Abu Dhabi, Sharjah, and other emirates, as well as franchise businesses with individual location accounts. We create master content frameworks localised for each location while maintaining brand consistency, with location-specific community management and paid social targeting.</p>'],
      ['question'=>'How long does it take to see results from social media marketing?','answer'=>'<p>Follower growth and engagement improvements are typically visible within 30–60 days with consistent quality content. Brand awareness lift is usually apparent within the first month. Lead generation typically emerges within 60–90 days. Paid social campaigns can generate leads from day one. <a href="/contact">Get in touch</a> for a free social media audit.</p>'],
    ],
    'technologies' => [
      ['tech_name'=>'Meta Business Suite'],['tech_name'=>'Hootsuite'],['tech_name'=>'Sprout Social'],
      ['tech_name'=>'Canva Pro'],['tech_name'=>'Adobe Premiere Pro'],['tech_name'=>'CapCut'],
      ['tech_name'=>'LinkedIn Campaign Manager'],['tech_name'=>'TikTok Ads Manager'],
      ['tech_name'=>'Later'],['tech_name'=>'BuzzSumo'],
    ],
    'related_services' => [15, 17],
  ],

  17 => [
    'title'              => 'Web Design Services Dubai — Conversion-Optimised Websites',
    'short_description'  => "Award-quality web design for Dubai businesses — conversion-focused, mobile-first, Arabic-ready, and built to rank on Google from day one.",
    'category_label'     => 'Web Design',
    'hero_badge'         => 'Award Winning',
    'hero_badge_sub'     => 'Conversion Focused',
    'cta_primary_text'   => 'Get Free Design Consultation',
    'cta_phone_text'     => 'Call Our Design Team',
    'benefits' => [
      ['benefit'=>'Bespoke designs built to reflect your brand identity and Dubai market positioning'],
      ['benefit'=>'Mobile-first approach designed for the 85%+ of UAE users browsing on smartphone'],
      ['benefit'=>'Arabic and English bilingual layouts with proper RTL support and cultural adaptation'],
      ['benefit'=>'Conversion Rate Optimisation (CRO) built into every page layout and element'],
      ['benefit'=>'Core Web Vitals optimisation ensuring fast, smooth page experience from launch'],
      ['benefit'=>'SEO-ready architecture with clean code, semantic HTML, and schema markup'],
      ['benefit'=>'CMS-powered design — edit any page, any time through a simple admin dashboard'],
      ['benefit'=>'Brand identity and visual language creation for new businesses'],
      ['benefit'=>'Landing page design optimised for PPC campaigns and paid media performance'],
      ['benefit'=>'Post-launch A/B testing to continuously improve conversion rates over time'],
    ],
    'process_steps' => [
      ['step_title'=>'Discovery & Brand Workshop','step_desc'=>'We run a structured discovery session to understand your business goals, target UAE audience, competitive positioning, brand values, and the specific actions you want website visitors to take. This shapes every design decision.'],
      ['step_title'=>'UX Research & Wireframing','step_desc'=>'Before design, we map the optimal user journey through your site — from arrival to conversion. Wireframes define the information architecture, page layouts, and conversion pathways before any visual element is added.'],
      ['step_title'=>'Visual Design & Brand System','step_desc'=>'Our designers create a bespoke visual design that expresses your brand personality, appeals to your target UAE audience, and differentiates you from competitors. You receive a complete design system including colours, typography, and component library.'],
      ['step_title'=>'Prototype & Client Review','step_desc'=>'We build interactive Figma prototypes of all key pages so you can experience the design before a single line of code is written. Multiple revision rounds ensure the final design is exactly right before development begins.'],
      ['step_title'=>'Development & CMS Build','step_desc'=>'Designs are built with clean semantic HTML/CSS, responsive across all devices, and integrated with WordPress CMS that gives your team full control to update content without developer assistance.'],
      ['step_title'=>'Quality Assurance & Launch','step_desc'=>'Rigorous testing across devices, browsers, screen sizes, and connection speeds. Every link, form, animation, and interactive element is checked before launch. Go-live is coordinated to minimise any SEO ranking impact.'],
      ['step_title'=>'Post-Launch Optimisation','step_desc'=>'Website launch is the beginning, not the end. We monitor Core Web Vitals, heatmaps, session recordings, and conversion data post-launch to identify optimisation opportunities and continuously improve performance.'],
    ],
    'service_faqs' => [
      ['question'=>'How much does a website cost in Dubai?','answer'=>'<p>Professional business website design in Dubai ranges from AED 5,000–15,000 for a standard SME site to AED 20,000–80,000+ for complex enterprise or ecommerce projects. Cost depends on page count, design complexity, custom functionality, CMS integration, and Arabic language support. We provide detailed, itemised proposals after a free consultation — no hidden costs or surprise invoices.</p>'],
      ['question'=>'How long does it take to design and build a website in Dubai?','answer'=>'<p>A standard business website (5–15 pages) typically takes 6–10 weeks from project kick-off to launch. This includes discovery (1 week), wireframing (1 week), visual design (2 weeks), development (2–3 weeks), content integration and QA (1–2 weeks). Ecommerce websites and complex custom builds may take 12–20 weeks. The timeline depends heavily on content readiness — clients who have their content prepared benefit from significantly faster delivery.</p>'],
      ['question'=>'Do you design Arabic websites with RTL support?','answer'=>'<p>Yes. Bilingual Arabic-English websites are a core speciality. Arabic web design requires genuine RTL layout implementation — not simply mirroring an English design. We design Arabic layouts natively, select appropriate Arabic typefaces, adapt visual compositions for Arabic reading patterns, and ensure the CMS allows editors to manage Arabic and English content independently.</p>'],
      ['question'=>'What is a conversion-optimised website and why does it matter?','answer'=>'<p>A conversion-optimised website is designed with the primary goal of turning visitors into enquiries, leads, or sales. This means: clear value propositions above the fold, strategic CTA placement, trust signals (testimonials, certifications) at key decision points, frictionless contact forms, fast loading speeds, and mobile usability that matches how UAE users actually browse. A conversion-optimised website can double or triple the leads generated from the same amount of traffic.</p>'],
      ['question'=>'What is Core Web Vitals and why is it important for my Dubai website?','answer'=>'<p>Core Web Vitals are Google\'s user experience metrics measuring Largest Contentful Paint (loading speed), Interaction to Next Paint (responsiveness), and Cumulative Layout Shift (visual stability). These are direct Google ranking factors — poor scores directly reduce your organic search rankings. In the UAE mobile-first market, Core Web Vitals also directly impact bounce rates and conversion rates. All our websites pass Core Web Vitals thresholds from day one.</p>'],
      ['question'=>'Will my website be easy to update without a developer?','answer'=>'<p>Absolutely. Every website we build runs on WordPress CMS that gives your team complete control to update text, images, blog posts, team pages, service descriptions, and more through a simple visual interface — no coding required. We provide a personalised training session covering all updates your team will need, plus written documentation. For clients who prefer not to manage updates, we offer monthly maintenance packages.</p>'],
      ['question'=>'Is my website built to rank on Google from the start?','answer'=>'<p>Yes. SEO-readiness is built into every project from the architecture stage. This includes: clean semantic HTML, proper heading hierarchy, optimised page titles and meta descriptions, XML sitemap and robots.txt configuration, schema markup implementation, compressed WebP-format images with descriptive alt text, canonical tags, and structured internal linking. We also integrate our <a href="/services/search-engine-optimization">SEO service</a> with new web builds for immediate ranking momentum.</p>'],
      ['question'=>'Do you design landing pages for Google Ads campaigns?','answer'=>'<p>Yes. Conversion-focused landing pages are among our most valuable deliverables. A purpose-built landing page — with a single clear offer, compelling headline, trust signals, and frictionless form — can double or triple conversion rates versus sending <a href="/services/ppc-management">PPC</a> traffic to a standard website page. We build, test, and continuously optimise landing pages to maximise advertising ROI.</p>'],
      ['question'=>'What happens after my website launches?','answer'=>'<p>We provide 30 days of post-launch support at no charge — fixing any bugs, addressing browser compatibility issues, and making minor content adjustments. After 30 days, ongoing support is available through maintenance packages covering security updates, WordPress/plugin updates, performance monitoring, and monthly content updates.</p>'],
      ['question'=>'Can you redesign my existing website while keeping my SEO rankings?','answer'=>'<p>Yes. SEO preservation during redesign is something we take extremely seriously. A poorly managed migration can cause significant ranking drops. Our process includes a comprehensive URL audit and redirect mapping before any changes, preserving all existing ranking URLs with 301 redirects, migrating all meta data, and monitoring rankings closely for 3 months post-launch. <a href="/contact">Contact us</a> for a migration audit before committing to any redesign.</p>'],
    ],
    'technologies' => [
      ['tech_name'=>'Figma'],['tech_name'=>'WordPress'],['tech_name'=>'Elementor Pro'],
      ['tech_name'=>'Adobe Creative Suite'],['tech_name'=>'Webflow'],['tech_name'=>'React'],
      ['tech_name'=>'Google PageSpeed Insights'],['tech_name'=>'Hotjar'],
      ['tech_name'=>'GTmetrix'],['tech_name'=>'Google Tag Manager'],
    ],
    'related_services' => [18, 13],
  ],

  18 => [
    'title'              => 'Web Development Services Dubai — WordPress, React & Custom Builds',
    'short_description'  => "Enterprise-grade web development for Dubai businesses — WordPress, React, WooCommerce, custom APIs, and scalable digital platforms built to perform and grow.",
    'category_label'     => 'Web Development',
    'hero_badge'         => 'Enterprise Grade',
    'hero_badge_sub'     => 'Scalable Architecture',
    'cta_primary_text'   => 'Discuss Your Project',
    'cta_phone_text'     => 'Call Our Dev Team',
    'benefits' => [
      ['benefit'=>'Custom WordPress development with bespoke themes, plugins, and integrations'],
      ['benefit'=>'WooCommerce ecommerce development for UAE online stores with local payment gateways'],
      ['benefit'=>'React and Next.js application development for dynamic, app-like web experiences'],
      ['benefit'=>'Arabic language support with full RTL implementation across all platforms'],
      ['benefit'=>'UAE payment gateway integration — PayFort, Telr, Network International, Stripe'],
      ['benefit'=>'REST API development and third-party API integration (CRM, ERP, payment, shipping)'],
      ['benefit'=>'Performance-first development — Core Web Vitals optimised from initial build'],
      ['benefit'=>'Security hardening, SSL, GDPR/PDPL compliance for UAE regulatory requirements'],
      ['benefit'=>'Scalable hosting on Dubai-based or UAE-compliant cloud infrastructure'],
      ['benefit'=>'Ongoing maintenance, updates, and 24/7 monitoring for production applications'],
    ],
    'process_steps' => [
      ['step_title'=>'Technical Discovery & Architecture','step_desc'=>'We map your technical requirements, integration points, scalability needs, and existing infrastructure to architect a solution that solves today\'s problems without creating tomorrow\'s technical debt.'],
      ['step_title'=>'Technology Selection','step_desc'=>'We recommend the right stack based on your requirements: WordPress for CMS flexibility, WooCommerce for ecommerce, React/Next.js for complex applications, or custom PHP/Node.js for unique needs. There is no one-size-fits-all in web development.'],
      ['step_title'=>'Development Sprints','step_desc'=>'Agile development in 2-week sprints with regular demos ensures you see progress continuously, can provide feedback early, and are never surprised at delivery. All code is version-controlled with Git, enabling safe rollbacks at any time.'],
      ['step_title'=>'Integration & API Work','step_desc'=>'We integrate your website with the external systems your business depends on — CRMs, ERPs, payment gateways, shipping providers, accounting systems, marketing automation tools, and custom APIs — ensuring your website is a connected hub.'],
      ['step_title'=>'Quality Assurance','step_desc'=>'Comprehensive testing across browsers, devices, and screen sizes. Performance testing against Core Web Vitals benchmarks. Security audits. Load testing for high-traffic scenarios. Accessibility (WCAG 2.1 AA) verification. Nothing ships until it passes every check.'],
      ['step_title'=>'Deployment & Launch','step_desc'=>'Staged deployment from development to staging to production ensures zero-downtime launches. We configure CDN, caching, SSL, server optimisation, and monitoring before go-live. Launch is coordinated for minimal business impact.'],
      ['step_title'=>'Support & Continuous Development','step_desc'=>'Post-launch support packages range from basic monitoring and updates to dedicated monthly development retainers. We become your long-term technology partner, continuously improving and extending your platform as your business grows.'],
    ],
    'service_faqs' => [
      ['question'=>'Should my Dubai business use WordPress or a custom CMS?','answer'=>'<p>WordPress powers 43% of the world\'s websites and is our recommended solution for the majority of Dubai business websites. It offers unmatched content management flexibility, the largest plugin ecosystem, excellent SEO capabilities, strong security when properly maintained, and lower long-term costs than custom CMS development. Custom CMS makes sense only when you have very specific workflow requirements WordPress genuinely cannot meet — which is rare.</p>'],
      ['question'=>'What UAE payment gateways can you integrate into a website?','answer'=>'<p>We integrate all major UAE-compliant payment gateways: PayFort (Amazon Payment Services) — the most widely used in the UAE; Telr — excellent for SME ecommerce; Network International — preferred by large enterprises; Stripe — strong developer tooling; and PayPal. We also handle Apple Pay and Google Pay integration. For BNPL, we integrate tabby and Tamara — increasingly important for UAE ecommerce conversion.</p>'],
      ['question'=>'Can you build a website that supports Arabic and English with RTL?','answer'=>'<p>Yes. Bilingual Arabic-English web development is a core competency. Full RTL Arabic support requires custom theme development with bidirectional layout support, Arabic font stack implementation, separate Arabic and English admin interfaces in the CMS, hreflang implementation for proper Google language targeting, and testing across all browsers and devices for both language versions.</p>'],
      ['question'=>'How do you ensure a website is fast and meets Core Web Vitals?','answer'=>'<p>Performance is engineered from architecture through deployment: server-side rendering for first-paint speed; image optimisation (WebP, lazy loading, responsive images); code splitting and tree-shaking; efficient CSS without render-blocking stylesheets; CDN implementation; database query optimisation; server-level caching (Redis/Memcached); and HTTP/2 or HTTP/3 protocol. We target LCP under 2.5s, INP under 200ms, and CLS below 0.1 — Google\'s "Good" thresholds for ranking.</p>'],
      ['question'=>'What is headless WordPress and when should I use it?','answer'=>'<p>Headless WordPress separates the CMS backend from the frontend presentation layer (typically React or Next.js). This delivers superior performance — pages served as static HTML via CDN — and allows for extremely custom user experiences. We recommend headless for high-traffic sites (100,000+ monthly visitors) or applications requiring app-like interactivity. For most Dubai SMEs, traditional WordPress delivers excellent performance at lower cost.</p>'],
      ['question'=>'Can you build a WooCommerce store for my UAE ecommerce business?','answer'=>'<p>Yes. WooCommerce handles unlimited products, complex variable products, multiple currencies (AED, USD, GBP), UAE tax configuration, Aramex and DHL API integration, all major UAE payment gateways, Arabic language support, and SEO optimisation for product and category pages. We have built WooCommerce stores processing AED 1M+ monthly transactions for UAE clients across fashion, electronics, beauty, and food sectors.</p>'],
      ['question'=>'How do you handle website security for Dubai businesses?','answer'=>'<p>Security implementation includes: SSL certificate installation and HTTPS enforcement; WordPress core, theme, and plugin update management; Web Application Firewall (WAF) configuration; two-factor authentication for admin access; database hardening; file permission hardening; regular malware scanning; and login attempt limiting. For ecommerce sites handling payment data, we implement additional PCI-DSS compliant security measures.</p>'],
      ['question'=>'What hosting do you recommend for Dubai businesses?','answer'=>'<p>For UAE businesses, we recommend: AWS Middle East Region (Bahrain) for enterprise and high-traffic sites — lowest latency for UAE visitors; SiteGround or Kinsta for managed WordPress hosting; and Digital Ocean for custom application hosting. For UAE-based hosting satisfying data residency requirements, we work with Etisalat e-Cloud and du Datamena. We avoid generic shared hosting for business-critical websites.</p>'],
      ['question'=>'Do you offer ongoing website maintenance and support?','answer'=>'<p>Yes. All clients receive 30 days of post-launch support. Beyond that, monthly maintenance packages cover: WordPress core, theme, and plugin updates; uptime monitoring; weekly automated backups; monthly security scans; Core Web Vitals monitoring; and development hours. Packages start from AED 500/month for basic monitoring to AED 2,500/month for comprehensive care. <a href="/contact">Contact us</a> to discuss your maintenance needs.</p>'],
      ['question'=>'Can you migrate my existing website to a new platform?','answer'=>'<p>Yes. Platform migrations — from Squarespace, Wix, or custom CMS to WordPress; from Shopify to WooCommerce — are regular work. Our migration process includes complete content audit and migration, URL structure preservation with 301 redirect mapping, meta data transfer, image optimisation during migration, and post-migration SEO monitoring to catch any ranking impact immediately. A well-executed migration should improve rather than harm your SEO performance.</p>'],
    ],
    'technologies' => [
      ['tech_name'=>'WordPress'],['tech_name'=>'WooCommerce'],['tech_name'=>'React'],
      ['tech_name'=>'Next.js'],['tech_name'=>'PHP 8'],['tech_name'=>'MySQL'],
      ['tech_name'=>'AWS / Digital Ocean'],['tech_name'=>'Git / GitHub'],
      ['tech_name'=>'REST API'],['tech_name'=>'Cloudflare CDN'],
    ],
    'related_services' => [17, 13],
  ],
];

// ─────────────────────────────────────────────────────────────────────────────
// ACF FIELD KEYS  (from functions.php)
// ─────────────────────────────────────────────────────────────────────────────
$benefit_sub_keys   = [ 'benefit'    => 'field_svc_benefit_item' ];
$process_sub_keys   = [ 'step_title' => 'field_proc_title', 'step_desc' => 'field_proc_desc' ];
$faq_sub_keys       = [ 'question'   => 'field_faq_q',      'answer'    => 'field_faq_a'     ];
$tech_sub_keys      = [ 'tech_name'  => 'field_tech_name'                                    ];

// ─────────────────────────────────────────────────────────────────────────────
// EXECUTE
// ─────────────────────────────────────────────────────────────────────────────
foreach ( $services as $post_id => $d ) {
  // 1. Update post title (content already set by seed-services.php)
  wp_update_post( [ 'ID' => $post_id, 'post_title' => $d['title'], 'post_status' => 'publish' ] );

  // 2. Scalar ACF fields
  acf_set( $post_id, 'short_description', 'field_svc_short_desc',   $d['short_description'] );
  acf_set( $post_id, 'category_label',    'field_svc_category',     $d['category_label']    );
  acf_set( $post_id, 'hero_badge',        'field_svc_hero_badge',   $d['hero_badge']        );
  acf_set( $post_id, 'hero_badge_sub',    'field_svc_hero_subtext', $d['hero_badge_sub']    );
  acf_set( $post_id, 'cta_primary_text',  'field_svc_cta_primary',  $d['cta_primary_text']  );
  acf_set( $post_id, 'cta_phone_text',    'field_svc_cta_phone',    $d['cta_phone_text']    );

  // 3. Repeater fields
  acf_set_repeater( $post_id, 'benefits',      'field_svc_benefits',    $d['benefits'],      $benefit_sub_keys );
  acf_set_repeater( $post_id, 'process_steps', 'field_svc_process',     $d['process_steps'], $process_sub_keys );
  acf_set_repeater( $post_id, 'service_faqs',  'field_svc_faqs',        $d['service_faqs'],  $faq_sub_keys     );
  acf_set_repeater( $post_id, 'technologies',  'field_svc_technologies', $d['technologies'], $tech_sub_keys    );

  // 4. Related services (ACF relationship — store as serialized array of post IDs)
  update_post_meta( $post_id, 'related_services',  $d['related_services'] );
  update_post_meta( $post_id, '_related_services', 'field_svc_related'    );

  echo "✅ {$d['title']} (ID $post_id) — title, " . count($d['benefits']) . " benefits, " . count($d['process_steps']) . " steps, " . count($d['service_faqs']) . " FAQs\n";
}

// ─────────────────────────────────────────────────────────────────────────────
// HOMEPAGE STATS (options)
// ─────────────────────────────────────────────────────────────────────────────
$stats = [
  [ 'stat_prefix'=>'+',  'stat_value'=>'340', 'stat_suffix'=>'%',  'stat_label'=>'AVG. ROI Increase'  ],
  [ 'stat_prefix'=>'',   'stat_value'=>'1200','stat_suffix'=>'+',  'stat_label'=>'Projects Delivered' ],
  [ 'stat_prefix'=>'',   'stat_value'=>'4.9', 'stat_suffix'=>'/5', 'stat_label'=>'Google Rating'      ],
  [ 'stat_prefix'=>'',   'stat_value'=>'10',  'stat_suffix'=>'+',  'stat_label'=>'Years Experience'   ],
];
$stat_sub_keys = [ 'stat_prefix'=>'field_stat_prefix','stat_value'=>'field_stat_value','stat_suffix'=>'field_stat_suffix','stat_label'=>'field_stat_label' ];
acf_set_repeater( 'options', 'hero_stats', 'field_hero_stats', $stats, $stat_sub_keys );
update_post_meta( 0, '_hero_stats', 'field_hero_stats' ); // options page uses ID=0

// Scalar options
update_option( 'hero_stats',           serialize( $stats ) ); // fallback
update_option( 'options_hero_headline',    'Turn Search Visibility Into Business Growth' );
update_option( 'options_hero_badge_text',  "Dubai's #1 Enterprise SEO Agency" );

// Direct ACF options approach
global $wpdb;
$option_rows = [
  'options_hero_headline'        => 'Turn Search Visibility Into Business Growth',
  'options_hero_subheadline'     => "We architect digital dominance for Dubai's most ambitious brands — combining AI-driven SEO, precision paid media, and conversion-led design to make you the market leader.",
  'options_hero_cta_primary'     => 'Get Free SEO Audit',
  'options_hero_cta_primary_url' => '/contact',
  'options_hero_cta_secondary'   => 'View Case Studies',
  'options_hero_cta_secondary_url'=> '/case-studies',
  'options_hero_badge_text'      => "Dubai's #1 Enterprise SEO Agency",
  'options_site_phone'           => '+971 4 568 7444',
  'options_site_email'           => 'sales@searchengineoptimization.ae',
  'options_site_address'         => 'M-01, Muteena Street, Above Saravana Bhavan, Deira, Dubai, UAE',
  'options_footer_tagline'       => "Dubai's #1 Enterprise SEO & Digital Growth Agency",
  'options_social_linkedin'      => 'https://linkedin.com/company/searchengineoptimizationae',
  'options_social_instagram'     => 'https://instagram.com/seo.ae',
  'options_social_facebook'      => 'https://facebook.com/searchengineoptimizationae',
  'options_social_twitter'       => 'https://x.com/seoae',
  'options_cta_heading'          => "Ready to Dominate Dubai's Search Results?",
  'options_cta_description'      => 'Join 1,200+ UAE businesses that trust SearchEngineOptimization.ae to drive measurable organic growth, qualified leads, and revenue from search.',
];

foreach ( $option_rows as $key => $value ) {
  update_option( $key, $value );
}
echo "✅ Options/homepage settings saved\n";

echo "\n🎉 ACF direct seed complete! All 6 services have full content, FAQs, and CMS-editable fields.\n";
