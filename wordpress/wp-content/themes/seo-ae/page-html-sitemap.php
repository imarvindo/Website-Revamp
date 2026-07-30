<?php
/**
 * Template Name: HTML Sitemap
 */
get_header();
?>
<section class="section bg-white" style="min-height:60vh;">
<div class="container" style="max-width:960px;">
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
				<li><a href="/portfolio/" style="color:var(--color-body);font-size:.9rem;">Portfolio</a></li>
				<li><a href="/blog/" style="color:var(--color-body);font-size:.9rem;">Blog</a></li>
				<li><a href="/careers/" style="color:var(--color-body);font-size:.9rem;">Careers</a></li>
				<li><a href="/contact/" style="color:var(--color-body);font-size:.9rem;">Contact Us</a></li>
				<li><a href="/privacy-policy/" style="color:var(--color-body);font-size:.9rem;">Privacy Policy</a></li>
				<li><a href="/terms-of-service/" style="color:var(--color-body);font-size:.9rem;">Terms of Service</a></li>
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

		<!-- Industries -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">SEO by Industry</h2>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<li><a href="/healthcare-seo/" style="color:var(--color-body);font-size:.9rem;">Healthcare SEO</a></li>
				<li><a href="/real-estate-seo/" style="color:var(--color-body);font-size:.9rem;">Real Estate SEO</a></li>
				<li><a href="/ecommerce-seo/" style="color:var(--color-body);font-size:.9rem;">E-commerce SEO</a></li>
				<li><a href="/hospitality-seo/" style="color:var(--color-body);font-size:.9rem;">Hospitality &amp; Tourism SEO</a></li>
				<li><a href="/saas-b2b-seo/" style="color:var(--color-body);font-size:.9rem;">SaaS &amp; B2B SEO</a></li>
				<li><a href="/education-seo/" style="color:var(--color-body);font-size:.9rem;">Education SEO</a></li>
				<li><a href="/automotive-seo/" style="color:var(--color-body);font-size:.9rem;">Automotive SEO</a></li>
				<li><a href="/finance-seo/" style="color:var(--color-body);font-size:.9rem;">Finance SEO</a></li>
				<li><a href="/legal-seo/" style="color:var(--color-body);font-size:.9rem;">Legal SEO</a></li>
			</ul>
		</div>

		<!-- UAE Locations -->
		<div>
			<h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--color-primary);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:2px solid var(--color-border);">SEO by Location</h2>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.5rem;">
				<li><a href="/seo-company-dubai/" style="color:var(--color-body);font-size:.9rem;">SEO Company Dubai</a></li>
				<li><a href="/seo-company-abu-dhabi/" style="color:var(--color-body);font-size:.9rem;">SEO Company Abu Dhabi</a></li>
				<li><a href="/seo-company-sharjah/" style="color:var(--color-body);font-size:.9rem;">SEO Company Sharjah</a></li>
				<li><a href="/seo-company-ajman/" style="color:var(--color-body);font-size:.9rem;">SEO Company Ajman</a></li>
				<li><a href="/seo-company-ras-al-khaimah/" style="color:var(--color-body);font-size:.9rem;">SEO Company Ras Al Khaimah</a></li>
				<li><a href="/seo-company-fujairah/" style="color:var(--color-body);font-size:.9rem;">SEO Company Fujairah</a></li>
				<li><a href="/seo-company-umm-al-quwain/" style="color:var(--color-body);font-size:.9rem;">SEO Company Umm Al Quwain</a></li>
				<li><a href="/seo-company-al-ain/" style="color:var(--color-body);font-size:.9rem;">SEO Company Al Ain</a></li>
				<li><a href="/seo-company-khor-fakkan/" style="color:var(--color-body);font-size:.9rem;">SEO Company Khor Fakkan</a></li>
				<li><a href="/seo-company-dibba-al-fujairah/" style="color:var(--color-body);font-size:.9rem;">SEO Company Dibba Al Fujairah</a></li>
				<li><a href="/seo-company-jebel-ali/" style="color:var(--color-body);font-size:.9rem;">SEO Company Jebel Ali</a></li>
				<li><a href="/seo-company-dubai-marina/" style="color:var(--color-body);font-size:.9rem;">SEO Company Dubai Marina</a></li>
				<li><a href="/seo-company-business-bay/" style="color:var(--color-body);font-size:.9rem;">SEO Company Business Bay</a></li>
				<li><a href="/seo-company-deira/" style="color:var(--color-body);font-size:.9rem;">SEO Company Deira</a></li>
				<li><a href="/seo-company-downtown-dubai/" style="color:var(--color-body);font-size:.9rem;">SEO Company Downtown Dubai</a></li>
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
