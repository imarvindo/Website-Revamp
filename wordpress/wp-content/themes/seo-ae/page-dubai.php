<?php
/**
 * Template Name: Dubai Landing Page
 * SEO-optimised location page for Dubai SEO services.
 */
get_header();
?>

<!-- Hero -->
<section class="post-hero hero-dark" style="padding:5rem 0;">
	<div class="container" style="text-align:center;max-width:780px;margin:0 auto;">
		<?php seoae_section_label('SEO DUBAI'); ?>
		<h1 style="font-size:clamp(2rem,4.5vw,3.75rem);color:#fff;margin-top:.75rem;">
			#1 SEO Agency in <span class="gradient-text">Dubai</span>
		</h1>
		<p style="font-size:1.1rem;color:rgba(255,255,255,.75);margin-top:1rem;max-width:640px;margin-left:auto;margin-right:auto;">
			SearchEngineOptimization.ae is Dubai's most trusted SEO partner. We help UAE businesses dominate Google search, capture local traffic, and convert visitors into revenue — with measurable, transparent results.
		</p>
		<div style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center;margin-top:2rem;">
			<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Get a Free Dubai SEO Audit</a>
			<a href="#services" class="btn btn--outline">Our Dubai SEO Services</a>
		</div>
	</div>
</section>

<!-- Stats -->
<section class="section" style="padding:3rem 0;background:var(--color-muted-bg);">
	<div class="container">
		<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1.5rem;text-align:center;">
			<?php
			$stats = [
				['345+', 'Dubai Businesses Served'],
				['94%',  'Client Retention Rate'],
				['412%', 'Average Traffic Growth'],
				['8+',   'Years in Dubai Market'],
			];
			foreach ($stats as [$num, $label]) :
			?>
			<div style="padding:1.5rem;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
				<div style="font-size:2.25rem;font-weight:800;color:var(--color-primary);"><?php echo esc_html($num); ?></div>
				<div style="font-size:.875rem;color:var(--color-body);margin-top:.25rem;"><?php echo esc_html($label); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Why Dubai businesses need SEO -->
<section class="section" id="services">
	<div class="container">
		<div class="section-header" style="text-align:center;max-width:680px;margin:0 auto 3rem;">
			<?php seoae_section_label('WHY DUBAI SEO'); ?>
			<h2 class="section-header__title">Dubai SEO Services That Drive Real Growth</h2>
			<p class="section-header__desc">With over 3.5 million internet users in Dubai and fierce competition across every sector, appearing at the top of Google search results is no longer optional — it is the difference between a thriving business and one struggling to survive.</p>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem;">
			<?php
			$services_grid = [
				['🔍','Local SEO Dubai','Rank for "near me" searches and Google Maps queries that drive foot traffic and phone calls to your Dubai business.'],
				['🤖','AI Search Optimisation','Optimise for ChatGPT, Google AI Overviews, Perplexity and Gemini — the new search frontier reshaping how UAE consumers find businesses.'],
				['📈','Technical SEO','Core Web Vitals, crawlability, structured data and Arabic-language SEO fixes that unlock your site\'s ranking potential.'],
				['✍️','Content Strategy','2,000+ word Arabic and English content strategies built around UAE search intent, E-E-A-T signals and semantic SEO.'],
				['🔗','Link Building','Earn high-authority UAE and GCC backlinks that boost your domain authority and accelerate rankings.'],
				['📊','SEO Analytics & Reporting','Transparent monthly reporting with rank tracking, traffic attribution and ROI calculations — no vanity metrics.'],
			];
			foreach ($services_grid as [$icon, $title, $desc]) :
			?>
			<div style="padding:1.75rem;border:1px solid var(--color-border);border-radius:16px;transition:box-shadow .2s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(22,177,212,.12)'" onmouseout="this.style.boxShadow='none'">
				<div style="font-size:2rem;margin-bottom:.75rem;"><?php echo $icon; ?></div>
				<h3 style="font-size:1.05rem;font-weight:700;color:var(--color-heading);margin-bottom:.5rem;"><?php echo esc_html($title); ?></h3>
				<p style="font-size:.875rem;color:var(--color-body);line-height:1.65;"><?php echo esc_html($desc); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Dubai SEO Process -->
<section class="section" style="background:var(--color-muted-bg);">
	<div class="container">
		<div class="section-header" style="text-align:center;max-width:640px;margin:0 auto 3rem;">
			<?php seoae_section_label('OUR PROCESS'); ?>
			<h2 class="section-header__title">How Our Dubai SEO Process Works</h2>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;">
			<?php
			$steps = [
				['01','Deep SEO Audit','We analyse your current rankings, technical health, competitor landscape and search opportunities across Dubai and the wider UAE.'],
				['02','Strategy & Roadmap','We build a 90-day SEO roadmap aligned to your revenue goals — prioritised by impact, not just effort.'],
				['03','On-Page & Technical Fixes','We fix every technical barrier and optimise your pages for Dubai-specific search intent and Arabic-English bilingual SEO.'],
				['04','Content & Link Building','We produce authoritative long-form content and earn high-quality GCC backlinks that move the needle fast.'],
				['05','Track & Optimise','Weekly rank tracking, monthly reporting and continuous optimisation keep your growth trajectory on course.'],
				['06','Scale & Grow','As rankings and traffic compound, we identify new opportunities to expand your market share across the UAE.'],
			];
			foreach ($steps as [$num, $title, $desc]) :
			?>
			<div style="padding:1.5rem;background:#fff;border-radius:16px;">
				<div style="font-size:2rem;font-weight:800;color:var(--color-primary);margin-bottom:.5rem;"><?php echo $num; ?></div>
				<h3 style="font-size:1rem;font-weight:700;color:var(--color-heading);margin-bottom:.5rem;"><?php echo esc_html($title); ?></h3>
				<p style="font-size:.8125rem;color:var(--color-body);line-height:1.65;"><?php echo esc_html($desc); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Industries we serve in Dubai -->
<section class="section">
	<div class="container">
		<div class="section-header" style="text-align:center;max-width:640px;margin:0 auto 2.5rem;">
			<?php seoae_section_label('INDUSTRIES'); ?>
			<h2 class="section-header__title">Dubai Industries We Serve</h2>
			<p class="section-header__desc">We have deep experience in every major Dubai sector and understand the specific search patterns, competition levels and compliance requirements each industry demands.</p>
		</div>
		<div style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center;">
			<?php
			$industries = [
				'Real Estate & Property','Hospitality & Tourism','Finance & Fintech','Healthcare & Clinics',
				'Retail & E-Commerce','Legal & Professional Services','Education & Training','Restaurants & F&B',
				'Construction & Contracting','Automotive','Tech & SaaS','Logistics & Freight',
			];
			foreach ($industries as $ind) :
			?>
			<span style="padding:.5rem 1.25rem;background:var(--color-muted-bg);border:1px solid var(--color-border);border-radius:100px;font-size:.875rem;color:var(--color-heading);font-weight:500;"><?php echo esc_html($ind); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- FAQ Schema Section -->
<section class="section" style="background:var(--color-muted-bg);">
	<div class="container" style="max-width:800px;">
		<div class="section-header" style="text-align:center;margin-bottom:2.5rem;">
			<?php seoae_section_label('FAQ'); ?>
			<h2 class="section-header__title">Dubai SEO — Frequently Asked Questions</h2>
		</div>
		<?php
		$faqs = [
			['How long does SEO take to work in Dubai?', 'Most Dubai businesses begin seeing measurable ranking improvements within 60–90 days of starting a campaign. Significant organic traffic growth typically occurs between months 4 and 6, with compounding returns thereafter. Highly competitive sectors such as real estate and finance may take 6–12 months for top-3 rankings.'],
			['How much does SEO cost in Dubai?', 'SEO pricing in Dubai typically ranges from AED 3,000 per month for small local campaigns to AED 25,000+ per month for enterprise-level programmes. SearchEngineOptimization.ae offers transparent monthly retainers with no lock-in contracts. We provide custom quotes based on your goals, competition and industry.'],
			['Do you offer Arabic SEO for Dubai businesses?', 'Yes. We provide full Arabic and English bilingual SEO, including Arabic keyword research, Arabic content creation and hreflang implementation. Arabic-language SEO is essential for reaching UAE nationals and Arabic-speaking residents, who make up a significant portion of Dubai\'s 3.5 million internet users.'],
			['What makes your Dubai SEO different from other agencies?', 'We focus exclusively on measurable revenue outcomes, not just rankings and traffic. Every campaign includes weekly rank tracking, transparent reporting and direct access to your dedicated SEO strategist. We have served 345+ UAE businesses across every major sector and understand the unique dynamics of the Dubai search market.'],
			['Can you help with Google Maps and local SEO in Dubai?', 'Absolutely. Local SEO and Google Business Profile optimisation is a core service. We optimise your listing for Dubai-area searches, build local citations across UAE directories, and create location-specific content that ranks for "near me" and location-modifier searches.'],
			['Do you work with e-commerce businesses in Dubai?', 'Yes. We have extensive experience with Shopify, WooCommerce and Magento e-commerce SEO in the UAE market, including product schema, category page optimisation, Arabic language stores and cross-border GCC e-commerce strategies.'],
		];
		echo '<script type="application/ld+json">' . wp_json_encode([
			'@context' => 'https://schema.org',
			'@type'    => 'FAQPage',
			'mainEntity' => array_map(fn($faq) => [
				'@type'          => 'Question',
				'name'           => $faq[0],
				'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
			], $faqs),
		], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
		foreach ($faqs as $faq) :
		?>
		<details style="margin-bottom:.75rem;background:#fff;border:1px solid var(--color-border);border-radius:12px;overflow:hidden;">
			<summary style="padding:1.1rem 1.25rem;cursor:pointer;font-weight:600;color:var(--color-heading);font-size:.9375rem;list-style:none;display:flex;justify-content:space-between;align-items:center;">
				<?php echo esc_html($faq[0]); ?>
				<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-left:1rem;"><polyline points="6 9 12 15 18 9"/></svg>
			</summary>
			<p style="padding:.75rem 1.25rem 1.25rem;font-size:.875rem;color:var(--color-body);line-height:1.7;margin:0;border-top:1px solid var(--color-border);"><?php echo esc_html($faq[1]); ?></p>
		</details>
		<?php endforeach; ?>
	</div>
</section>

<!-- Testimonials from Dubai clients -->
<section class="section">
	<div class="container">
		<div class="section-header" style="text-align:center;margin-bottom:2.5rem;">
			<?php seoae_section_label('CLIENT RESULTS'); ?>
			<h2 class="section-header__title">What Dubai Clients Say</h2>
		</div>
		<?php
		$testimonials = seoae_get_testimonials(3);
		if ($testimonials) :
		?>
		<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem;">
			<?php foreach ($testimonials as $t) :
				$reviewer = get_post_meta($t->ID,'reviewer_name',true) ?: 'Dubai Client';
				$company  = get_post_meta($t->ID,'company',true) ?: '';
				$rating   = intval(get_post_meta($t->ID,'rating',true) ?: 5);
				$result   = get_post_meta($t->ID,'result_metric',true) ?: '';
			?>
			<div style="padding:1.75rem;border:1px solid var(--color-border);border-radius:16px;background:#fff;">
				<div style="color:#F59E0B;font-size:1rem;margin-bottom:.75rem;"><?php echo str_repeat('★',$rating); ?></div>
				<p style="font-size:.9rem;color:var(--color-body);line-height:1.7;margin-bottom:1rem;">"<?php echo esc_html(wp_trim_words($t->post_content,40)); ?>"</p>
				<?php if ($result) : ?>
				<div style="padding:.5rem .875rem;background:rgba(22,177,212,.08);border-radius:8px;font-size:.8rem;font-weight:600;color:var(--color-primary);margin-bottom:.75rem;display:inline-block;"><?php echo esc_html($result); ?></div>
				<?php endif; ?>
				<div style="font-weight:600;font-size:.875rem;color:var(--color-heading);"><?php echo esc_html($reviewer); ?></div>
				<?php if ($company) : ?><div style="font-size:.8rem;color:var(--color-body);"><?php echo esc_html($company); ?></div><?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php seoae_cta_dark(
	'Ready to Dominate Dubai Search Results?',
	'Join 345+ UAE businesses that trust SearchEngineOptimization.ae to deliver measurable organic growth.',
	'Get Free Dubai SEO Audit',
	home_url('/contact/'),
	'View Case Studies',
	get_post_type_archive_link('case_study')
); ?>

<?php get_footer(); ?>
