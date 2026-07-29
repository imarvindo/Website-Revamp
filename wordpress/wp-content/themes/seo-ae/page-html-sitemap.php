<?php
/**
 * Template Name: HTML Sitemap
 */
get_header();
?>
<section class="section bg-white" style="min-height:60vh;">
<div class="container" style="max-width:900px;">
	<div class="section-header">
		<?php seoae_section_label('Site Navigation'); ?>
		<h1 style="font-size:clamp(1.8rem,3vw,2.5rem);margin:.75rem 0 .5rem;">HTML Sitemap</h1>
		<p>A complete list of all pages, services, blog posts, and resources on SearchEngineOptimization.ae.</p>
	</div>

	<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:2.5rem;margin-top:3rem;">

		<!-- Main Pages -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">Main Pages</h2>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<li><a href="/" style="color:var(--color-body);font-size:.9rem;">Home</a></li>
				<li><a href="/about/" style="color:var(--color-body);font-size:.9rem;">About Us</a></li>
				<li><a href="/services/" style="color:var(--color-body);font-size:.9rem;">Services</a></li>
				<li><a href="/case-studies/" style="color:var(--color-body);font-size:.9rem;">Case Studies</a></li>
				<li><a href="/blog/" style="color:var(--color-body);font-size:.9rem;">Blog</a></li>
				<li><a href="/careers/" style="color:var(--color-body);font-size:.9rem;">Careers</a></li>
				<li><a href="/contact/" style="color:var(--color-body);font-size:.9rem;">Contact Us</a></li>
				<li><a href="/privacy-policy/" style="color:var(--color-body);font-size:.9rem;">Privacy Policy</a></li>
			</ul>
		</div>

		<!-- Services -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">Services</h2>
			<?php
			$services = seoae_get_services();
			if ($services) : ?>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<?php foreach ($services as $svc) : ?>
				<li><a href="<?php echo esc_url(get_permalink($svc)); ?>" style="color:var(--color-body);font-size:.9rem;"><?php echo esc_html($svc->post_title); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>

		<!-- Locations -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">Locations</h2>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<li><a href="/dubai/" style="color:var(--color-body);font-size:.9rem;">SEO Dubai</a></li>
				<li><a href="/locations/seo-abu-dhabi/" style="color:var(--color-body);font-size:.9rem;">SEO Abu Dhabi</a></li>
				<li><a href="/locations/seo-sharjah/" style="color:var(--color-body);font-size:.9rem;">SEO Sharjah</a></li>
				<li><a href="/locations/seo-ajman/" style="color:var(--color-body);font-size:.9rem;">SEO Ajman</a></li>
				<li><a href="/locations/seo-ras-al-khaimah/" style="color:var(--color-body);font-size:.9rem;">SEO Ras Al Khaimah</a></li>
				<li><a href="/locations/seo-fujairah/" style="color:var(--color-body);font-size:.9rem;">SEO Fujairah</a></li>
			</ul>
		</div>

		<!-- Industries -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">Industries</h2>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<li><a href="/industries/real-estate/" style="color:var(--color-body);font-size:.9rem;">Real Estate SEO</a></li>
				<li><a href="/industries/healthcare/" style="color:var(--color-body);font-size:.9rem;">Healthcare SEO</a></li>
				<li><a href="/industries/ecommerce/" style="color:var(--color-body);font-size:.9rem;">Ecommerce SEO</a></li>
				<li><a href="/industries/hospitality/" style="color:var(--color-body);font-size:.9rem;">Hospitality SEO</a></li>
				<li><a href="/industries/legal/" style="color:var(--color-body);font-size:.9rem;">Legal SEO</a></li>
				<li><a href="/industries/finance/" style="color:var(--color-body);font-size:.9rem;">Finance SEO</a></li>
			</ul>
		</div>

		<!-- Case Studies -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">Case Studies</h2>
			<?php
			$cs = new WP_Query(['post_type'=>'case_study','posts_per_page'=>-1,'post_status'=>'publish']);
			if ($cs->have_posts()) : ?>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<?php while ($cs->have_posts()) : $cs->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>" style="color:var(--color-body);font-size:.9rem;"><?php the_title(); ?></a></li>
				<?php endwhile; wp_reset_postdata(); ?>
			</ul>
			<?php endif; ?>
		</div>

	</div>

	<!-- Blog Posts -->
	<div style="margin-top:3rem;">
		<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1.5rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">Blog Articles</h2>
		<?php
		$posts = get_posts(['post_type'=>'post','posts_per_page'=>-1,'post_status'=>'publish','orderby'=>'date','order'=>'DESC']);
		if ($posts) : ?>
		<ul style="list-style:none;padding:0;display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:.5rem .75rem;">
			<?php foreach ($posts as $p) : ?>
			<li>
				<a href="<?php echo esc_url(get_permalink($p)); ?>" style="color:var(--color-body);font-size:.875rem;display:flex;align-items:flex-start;gap:.5rem;">
					<span style="color:var(--color-primary);flex-shrink:0;margin-top:.1rem;">→</span>
					<?php echo esc_html($p->post_title); ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>

</div>
</section>
<?php get_footer(); ?>
