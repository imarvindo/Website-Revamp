<?php
/**
 * Template Name: Careers Page
 */
get_header();
?>
<section class="service-hero hero-dark">
	<div class="container" style="text-align:center;max-width:760px;margin:0 auto;padding:4rem 1.5rem;">
		<div class="service-hero__badge-pill">JOIN OUR TEAM</div>
		<h1 class="service-hero__title">Build the Future of Digital Marketing in the UAE</h1>
		<p class="service-hero__desc">We're always looking for exceptional talent who are passionate about SEO, data, and delivering real results for ambitious businesses.</p>
		<a href="#open-roles" class="btn btn--primary btn--lg" style="margin-top:1.5rem;">View Open Roles →</a>
	</div>
</section>

<!-- Why Work With Us -->
<section class="section bg-white">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Life at SearchEngineOptimization.ae'); ?>
			<h2 class="section-header__title">Why You'll Love Working Here</h2>
		</div>
		<div class="why-grid">
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
				<h3 class="why-card__title">Continuous Learning</h3>
				<p class="why-card__desc">Paid training, conference access, tool subscriptions, and a culture that rewards curiosity and growth.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
				<h3 class="why-card__title">Prime Dubai Location</h3>
				<p class="why-card__desc">Modern office in Emirates Towers with flexible hybrid working arrangements.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon"><svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
				<h3 class="why-card__title">Competitive Salary</h3>
				<p class="why-card__desc">Market-leading compensation, performance bonuses, and tax-free UAE salary package.</p>
			</div>
		</div>
	</div>
</section>

<!-- Open Roles -->
<section id="open-roles" class="section bg-light">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('Open Positions'); ?>
			<h2 class="section-header__title">Current Openings</h2>
		</div>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post-content" style="max-width:820px;margin:0 auto;"><?php the_content(); ?></div>
		<?php endwhile; else : ?>
		<div style="max-width:600px;margin:0 auto;display:flex;flex-direction:column;gap:1rem;">
			<?php
			$roles = [
				['title'=>'Senior SEO Strategist', 'type'=>'Full-Time', 'location'=>'Dubai, UAE'],
				['title'=>'PPC Campaign Manager', 'type'=>'Full-Time', 'location'=>'Dubai, UAE'],
				['title'=>'Content Writer — SEO', 'type'=>'Full-Time', 'location'=>'Remote / Dubai'],
				['title'=>'Web Developer (WordPress)', 'type'=>'Full-Time', 'location'=>'Dubai, UAE'],
				['title'=>'Social Media Manager', 'type'=>'Full-Time', 'location'=>'Dubai, UAE'],
			];
			foreach ($roles as $role) :
			?>
			<div class="card" style="display:flex;align-items:center;justify-content:space-between;gap:1rem;">
				<div>
					<h3 style="font-size:1rem;font-weight:700;color:var(--color-heading);margin-bottom:.25rem;"><?php echo esc_html($role['title']); ?></h3>
					<p style="font-size:.825rem;color:var(--color-body);"><?php echo esc_html($role['location']); ?> · <?php echo esc_html($role['type']); ?></p>
				</div>
				<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--outline btn--sm" style="white-space:nowrap;">Apply Now</a>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<div style="text-align:center;margin-top:2.5rem;padding:2rem;background:rgba(22,177,212,.06);border-radius:16px;border:1px solid rgba(22,177,212,.2);">
			<p style="font-weight:600;color:var(--color-heading);margin-bottom:.5rem;">Don't see your role?</p>
			<p style="font-size:.875rem;color:var(--color-body);margin-bottom:1rem;">We're always interested in hearing from talented individuals. Send us your CV.</p>
			<a href="mailto:<?php echo esc_attr(seoae_email()); ?>" class="btn btn--primary">Send Your CV →</a>
		</div>
	</div>
</section>

<?php seoae_cta_dark(); get_footer(); ?>
