<?php
/**
 * Template Name: Services Page
 */
get_header();
$services = seoae_get_services(20);
?>
<section class="service-hero hero-dark">
	<div class="container" style="max-width:760px;margin:0 auto;text-align:center;">
		<div class="service-hero__badge-pill">OUR SERVICES</div>
		<h1 class="service-hero__title">Full-Spectrum Digital<br><span class="gradient-text">Marketing Services</span></h1>
		<p class="service-hero__desc">From technical SEO to paid media, AI search visibility to social media — we cover every channel that drives qualified traffic and revenue for UAE businesses.</p>
	</div>
</section>

<!-- Stats -->
<div style="background:var(--color-secondary);">
	<div class="container">
		<div class="stats-bar__inner">
			<div class="stats-bar__item"><span class="stats-bar__value stats-bar--dark" data-counter="345" data-suffix="+">345+</span><span class="stats-bar__label" style="color:rgba(255,255,255,.6);">Clients Served</span></div>
			<div class="stats-bar__item"><span class="stats-bar__value stats-bar--dark" data-counter="92" data-prefix="+" data-suffix="%">+92%</span><span class="stats-bar__label" style="color:rgba(255,255,255,.6);">Avg ROI</span></div>
			<div class="stats-bar__item"><span class="stats-bar__value stats-bar--dark" data-counter="8" data-suffix="+">8+</span><span class="stats-bar__label" style="color:rgba(255,255,255,.6);">Years in UAE</span></div>
			<div class="stats-bar__item"><span class="stats-bar__value stats-bar--dark" data-counter="40" data-suffix="+">40+</span><span class="stats-bar__label" style="color:rgba(255,255,255,.6);">Specialists</span></div>
		</div>
	</div>
</div>

<!-- Services Grid -->
<section class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('What We Do'); ?>
			<h2 class="section-header__title">Services Built for ROI</h2>
			<p class="section-header__desc">Every service we offer is designed around one goal: making your business more money. No vanity metrics. No wasted spend.</p>
		</div>
		<?php if ($services->have_posts()) : ?>
		<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;" class="svc-grid">
			<?php while ($services->have_posts()) : $services->the_post();
				$icon    = get_field('service_icon') ?: '';
				$tagline = get_field('tagline')      ?: '';
				$highlights = get_field('key_benefits') ?: [];
			?>
			<a href="<?php the_permalink(); ?>" class="card card--hover" style="display:block;text-decoration:none;padding:2rem;">
				<?php if ($icon) : ?>
				<div class="service-card__icon" style="font-size:2rem;margin-bottom:1rem;"><?php echo esc_html($icon); ?></div>
				<?php endif; ?>
				<h3 style="font-size:1.15rem;font-weight:700;color:var(--color-heading);margin-bottom:.5rem;"><?php the_title(); ?></h3>
				<?php if ($tagline) : ?><p style="font-size:.875rem;color:var(--color-body);margin-bottom:1rem;"><?php echo esc_html($tagline); ?></p><?php endif; ?>
				<?php if ($highlights) : ?>
				<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.4rem;">
					<?php foreach (array_slice((array)$highlights, 0, 3) as $h) : ?>
					<li style="font-size:.8125rem;display:flex;align-items:center;gap:.5rem;color:var(--color-body);"><span style="color:var(--color-primary);font-size:.6rem;">●</span><?php echo esc_html(is_array($h) ? ($h['benefit']??'') : $h); ?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<span style="display:inline-flex;align-items:center;gap:.35rem;margin-top:1.25rem;font-size:.875rem;font-weight:600;color:var(--color-primary);">Learn more <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></span>
			</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php else: ?>
		<!-- Fallback static grid -->
		<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;" class="svc-grid">
			<?php
			$static_svcs = [
				['icon'=>'🔍','title'=>'SEO','desc'=>'Dominate Google for the keywords that drive revenue in your market.','href'=>home_url('/services/search-engine-optimization/')],
				['icon'=>'🤖','title'=>'AI Search Optimization','desc'=>'Get your brand featured in ChatGPT, Gemini & Perplexity answers.','href'=>home_url('/services/ai-search-optimization/')],
				['icon'=>'💰','title'=>'PPC Management','desc'=>'Stop wasting ad spend. Laser-targeted campaigns that convert.','href'=>home_url('/services/ppc-management/')],
				['icon'=>'📱','title'=>'Social Media Marketing','desc'=>'Turn followers into customers with data-driven social campaigns.','href'=>home_url('/services/social-media-marketing/')],
				['icon'=>'🎨','title'=>'Web Design','desc'=>'Conversion-optimised websites designed to rank and sell.','href'=>home_url('/services/web-design/')],
				['icon'=>'⚡','title'=>'Web Development','desc'=>'Fast, scalable, secure — built for performance and growth.','href'=>home_url('/services/web-development/')],
			];
			foreach ($static_svcs as $svc): ?>
			<a href="<?php echo esc_url($svc['href']); ?>" class="card card--hover" style="display:block;text-decoration:none;padding:2rem;">
				<div style="font-size:2rem;margin-bottom:1rem;"><?php echo $svc['icon']; ?></div>
				<h3 style="font-size:1.15rem;font-weight:700;color:var(--color-heading);margin-bottom:.5rem;"><?php echo esc_html($svc['title']); ?></h3>
				<p style="font-size:.875rem;color:var(--color-body);"><?php echo esc_html($svc['desc']); ?></p>
				<span style="display:inline-flex;align-items:center;gap:.35rem;margin-top:1rem;font-size:.875rem;font-weight:600;color:var(--color-primary);">Learn more →</span>
			</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- Process -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('How We Work'); ?>
			<h2 class="section-header__title">A Process Built for Results</h2>
		</div>
		<div class="process-steps">
			<div class="process-step"><div class="process-step__number">01</div><div><h3 class="process-step__title">Discovery & Audit</h3><p class="process-step__desc">Deep-dive analysis of your business, competitors, and current digital presence to identify the biggest opportunities.</p></div></div>
			<div class="process-step"><div class="process-step__number">02</div><div><h3 class="process-step__title">Strategy</h3><p class="process-step__desc">Custom roadmap built around your goals, market, and budget — with clear KPIs and milestones.</p></div></div>
			<div class="process-step"><div class="process-step__number">03</div><div><h3 class="process-step__title">Execution</h3><p class="process-step__desc">Senior specialists execute the plan with precision — no juniors, no outsourcing.</p></div></div>
			<div class="process-step"><div class="process-step__number">04</div><div><h3 class="process-step__title">Measure & Optimise</h3><p class="process-step__desc">Continuous testing, analysis, and refinement so performance compounds over time.</p></div></div>
		</div>
	</div>
</section>

<?php seoae_cta_dark(); get_footer(); ?>
<style>@media(max-width:900px){.svc-grid{grid-template-columns:repeat(2,1fr)!important}}@media(max-width:600px){.svc-grid{grid-template-columns:1fr!important}}</style>
