<?php
/**
 * Template Name: About Page
 */
get_header();
$team = new WP_Query(['post_type'=>'team_member','posts_per_page'=>12,'post_status'=>'publish']);
?>

<section class="service-hero hero-dark">
	<div class="container service-hero__inner">
		<div>
			<div class="service-hero__badge-pill">ABOUT US</div>
			<h1 class="service-hero__title">We Don't Guess.<br><span class="gradient-text">We Dominate.</span></h1>
			<p class="service-hero__desc">Founded in Dubai, SearchEngineOptimization.ae was built on a singular premise: most agencies deliver reports, we deliver revenue. We combine elite technical expertise with aggressive growth strategies to turn businesses into market leaders.</p>
			<div class="service-hero__actions">
				<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--primary btn--lg">Work With Us →</a>
				<a href="<?php echo esc_url(get_post_type_archive_link('case_study')); ?>" class="btn btn--outline-white btn--lg">See Our Results</a>
			</div>
		</div>
		<div class="service-hero__card">
			<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
				<?php
				$about_stats = [
					['value'=>'8+', 'label'=>'Years Active'],
					['value'=>'345+','label'=>'Clients Served'],
					['value'=>'+92%','label'=>'Avg ROI'],
					['value'=>'8+', 'label'=>'Countries'],
				];
				foreach ($about_stats as $s) :
				?>
				<div style="background:rgba(255,255,255,.07);border-radius:12px;padding:1rem;text-align:center;">
					<p style="font-size:1.5rem;font-weight:800;color:#fff;margin:0;"><?php echo esc_html($s['value']); ?></p>
					<p style="font-size:.75rem;color:rgba(255,255,255,.6);margin:0;text-transform:uppercase;letter-spacing:.06em;"><?php echo esc_html($s['label']); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- Mission & Values -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Mission'); ?>
			<h2 class="section-header__title">Built for Results. Obsessed with Growth.</h2>
			<p class="section-header__desc">We believe every dirham invested in digital marketing should return measurable value. That's not just a promise  -  it's our operating principle.</p>
		</div>
		<div class="why-grid">
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg></div>
				<h3 class="why-card__title">Excellence</h3>
				<p class="why-card__desc">Award-winning strategies that consistently break records and set new benchmarks in the UAE digital marketing landscape.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg></div>
				<h3 class="why-card__title">Precision</h3>
				<p class="why-card__desc">Every campaign is backed by hard data, competitive intelligence, and deep market analysis. We don't guess  -  we measure.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
				<h3 class="why-card__title">Speed</h3>
				<p class="why-card__desc">We move faster than your competitors can react. Strategy to execution in days, not months  -  because in digital, speed is a competitive advantage.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
				<h3 class="why-card__title">Partnership</h3>
				<p class="why-card__desc">We treat your business and budget like it's our own. Senior-led teams, direct access, zero account manager gatekeeping.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></div>
				<h3 class="why-card__title">Transparency</h3>
				<p class="why-card__desc">You own your data. Live dashboards, weekly reports, monthly strategy calls  -  everything visible, nothing hidden.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.663 17h4.673M12 3v1m6.364 1.636-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg></div>
				<h3 class="why-card__title">Innovation</h3>
				<p class="why-card__desc">From AI Search Optimization to LLM visibility, we stay years ahead of the curve  -  so our clients dominate tomorrow's search landscape today.</p>
			</div>
		</div>
	</div>
</section>

<!-- Page Content (editable via WP editor) -->
<?php if (have_posts()) : while (have_posts()) : the_post();
	if (get_the_content()) : ?>
<section class="section bg-light">
	<div class="container post-content" style="max-width:820px;margin:0 auto;">
		<?php the_content(); ?>
	</div>
</section>
<?php endif; endwhile; endif; ?>

<!-- Team -->
<?php if ($team->have_posts()) : ?>
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Our Team'); ?>
			<h2 class="section-header__title">The Experts Behind Your Growth</h2>
			<p class="section-header__desc">40+ specialists across SEO, paid media, content, design, and development.</p>
		</div>
		<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;" class="team-grid">
			<?php while ($team->have_posts()) : $team->the_post();
				$role    = get_field('job_role')    ?: 'Specialist';
				$linkedin= get_field('linkedin_url')?? '';
				$avatar  = get_the_post_thumbnail_url(null, 'medium');
				$initial = strtoupper(substr(get_the_title(), 0, 1));
			?>
			<div class="card" style="text-align:center;padding:1.5rem;">
				<div style="width:64px;height:64px;border-radius:50%;margin:0 auto 1rem;overflow:hidden;background:var(--color-primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;font-weight:700;">
					<?php if ($avatar) : ?><img src="<?php echo esc_url($avatar); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;height:100%;object-fit:cover;"><?php else: echo esc_html($initial); endif; ?>
				</div>
				<h3 style="font-size:1rem;font-weight:700;color:var(--color-heading);margin-bottom:.25rem;"><?php the_title(); ?></h3>
				<p style="font-size:.825rem;color:var(--color-body);"><?php echo esc_html($role); ?></p>
				<?php if ($linkedin) : ?><a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" style="display:inline-flex;margin-top:.5rem;color:var(--color-primary);"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a><?php endif; ?>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php seoae_cta_dark(); get_footer(); ?>
<style>@media(max-width:768px){.team-grid{grid-template-columns:repeat(2,1fr)!important}}</style>
