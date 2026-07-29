<?php get_header(); ?>
<section class="notfound-section bg-white">
	<div class="container" style="text-align:center;">
		<div class="notfound__code">404</div>
		<h1 class="notfound__title">Page Not Found</h1>
		<p class="notfound__desc">The page you're looking for doesn't exist or has been moved. Let us help you find what you need.</p>
		<div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Go to Homepage</a>
			<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--outline">Contact Us</a>
		</div>
		<?php if (have_posts()) : ?>
		<div style="margin-top:3rem;max-width:600px;margin-left:auto;margin-right:auto;">
			<h3 style="font-size:1rem;font-weight:600;margin-bottom:1rem;color:var(--color-body);">Popular Services</h3>
			<div style="display:flex;gap:.75rem;flex-wrap:wrap;justify-content:center;">
				<?php foreach (seoae_get_services() as $svc) : ?>
				<a href="<?php echo esc_url(get_permalink($svc)); ?>" class="tech-badge" style="color:var(--color-primary);"><?php echo esc_html($svc->post_title); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
