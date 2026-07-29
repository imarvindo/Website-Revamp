<?php
/**
 * Homepage Template — SEO.ae
 */
get_header();

// ACF fields with defaults
$hero_headline     = get_field('hero_headline','option')     ?: 'Dominate Search. Scale Revenue.';
$hero_sub          = get_field('hero_subheadline','option')  ?: "We don't just chase rankings. We architect digital dominance. Leveraging AI-driven SEO, high-converting design, and precision paid media to turn your business into a market leader.";
$hero_cta_primary  = get_field('hero_cta_primary','option')  ?: 'Get Free Audit';
$hero_cta_primary_url = get_field('hero_cta_primary_url','option') ?: '/contact';
$hero_cta_sec      = get_field('hero_cta_secondary','option') ?: 'View Our Work';
$hero_cta_sec_url  = get_field('hero_cta_secondary_url','option') ?: '/portfolio';
$hero_badge        = get_field('hero_badge_text','option')   ?: "Dubai's #1 Enterprise SEO & Growth Partner";
$hero_stats        = get_field('hero_stats','option')        ?: [];

// Default stats if none set
if ( empty($hero_stats) ) {
	$hero_stats = [
		['stat_prefix' => '+', 'stat_value' => '340', 'stat_suffix' => '%',  'stat_label' => 'AVG. ROI INCREASE'],
		['stat_prefix' => '',  'stat_value' => '345', 'stat_suffix' => '+',  'stat_label' => 'PROJECTS DELIVERED'],
		['stat_prefix' => '',  'stat_value' => '4.9', 'stat_suffix' => '/5', 'stat_label' => 'GOOGLE RATING'],
		['stat_prefix' => '',  'stat_value' => '8',   'stat_suffix' => '+',  'stat_label' => 'YEARS EXPERIENCE'],
	];
}

$services      = seoae_get_services();
$testimonials  = seoae_get_testimonials(6);
$recent_posts  = seoae_get_recent_posts(3);
$case_studies  = new WP_Query(['post_type'=>'case_study','posts_per_page'=>4,'post_status'=>'publish']);
?>

<!-- ═══════════════════════════════════════ HERO ══════════════════════════════ -->
<section class="hero hero-dark">
	<div class="container hero__inner">
		<div class="hero__content">
			<div class="hero__badge">
				<span class="hero__badge-dot"></span>
				<?php echo esc_html($hero_badge); ?>
			</div>
			<h1 class="hero__title">
				<?php
				// Split headline at period for gradient on second part
				$parts = explode('. ', $hero_headline, 2);
				if (count($parts) === 2) {
					echo esc_html($parts[0]) . '.<br><span class="gradient-text">' . esc_html($parts[1]) . '</span>';
				} else {
					echo esc_html($hero_headline);
				}
				?>
			</h1>
			<p class="hero__desc"><?php echo esc_html($hero_sub); ?></p>
			<div class="hero__actions">
				<a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn btn--primary btn--lg">
					<?php echo esc_html($hero_cta_primary); ?> →
				</a>
				<a href="<?php echo esc_url($hero_cta_sec_url); ?>" class="btn btn--outline-white btn--lg">
					<?php echo esc_html($hero_cta_sec); ?>
				</a>
			</div>
		</div>
		<div class="hero__visual" aria-hidden="true">
			<div class="hero__card">
				<div class="hero__card-icon">
					<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
				</div>
				<p class="hero__card-label">Premium</p>
				<p class="hero__card-sub">Results Driven</p>
			</div>
		</div>
	</div>

	<!-- Stats Bar (inside hero-dark) -->
	<div class="stats-bar">
		<div class="container">
			<div class="stats-bar__inner">
				<?php foreach ($hero_stats as $stat) :
					$prefix = $stat['stat_prefix'] ?? '';
					$value  = $stat['stat_value']  ?? '0';
					$suffix = $stat['stat_suffix']  ?? '';
					$label  = $stat['stat_label']   ?? '';
				?>
				<div class="stats-bar__item">
					<span class="stats-bar__value stats-bar--dark"
					      data-counter="<?php echo esc_attr(preg_replace('/[^0-9.]/','',$value)); ?>"
					      data-prefix="<?php echo esc_attr($prefix); ?>"
					      data-suffix="<?php echo esc_attr($suffix); ?>">
						<?php echo esc_html($prefix . $value . $suffix); ?>
					</span>
					<span class="stats-bar__label"><?php echo esc_html($label); ?></span>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- ═══════════════════════════════════ SERVICES ══════════════════════════════ -->
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
				$short  = get_field('short_description', $svc->ID) ?: wp_trim_words($svc->post_excerpt ?: $svc->post_content, 18);
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

<!-- ═══════════════════════════════ WHY CHOOSE US ═════════════════════════════ -->
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Why SEO.ae'); ?>
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

<!-- ══════════════════════════════ CASE STUDIES ═══════════════════════════════ -->
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
				$results = get_field('results') ?: [];
				$industry = get_field('cs_industry') ?: '';
				$client  = get_field('client_name') ?: get_the_title();
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

<!-- ═══════════════════════════════ TESTIMONIALS ══════════════════════════════ -->
<?php if ($testimonials) : ?>
<section class="section testimonials-section">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Client Reviews'); ?>
			<h2 class="section-header__title">What Our Clients Say</h2>
			<p class="section-header__desc">Over 345 businesses across UAE trust SEO.ae for measurable digital growth.</p>
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

<!-- ════════════════════════════════ BLOG POSTS ═══════════════════════════════ -->
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
				$category  = get_the_category($p->ID);
				$cat_name  = $category ? $category[0]->name : 'SEO';
				$thumb     = get_the_post_thumbnail_url($p->ID, 'medium_large');
				$rt        = get_field('reading_time', $p->ID) ?: 8;
				$excerpt   = get_the_excerpt($p);
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

<!-- ════════════════════════════════ DARK CTA ═════════════════════════════════ -->
<?php seoae_cta_dark(); ?>

<?php get_footer(); ?>
