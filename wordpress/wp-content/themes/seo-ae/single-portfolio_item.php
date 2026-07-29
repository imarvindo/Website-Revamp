<?php
/**
 * Single Portfolio Item Template
 */
get_header();
while (have_posts()) : the_post();
$client   = get_field('client_name') ?: get_the_title();
$services = get_field('services_used') ?: [];
$url      = get_field('project_url') ?: '';
$tags     = get_the_tags();
?>
<section class="post-hero hero-dark">
	<div class="container" style="max-width:760px;margin:0 auto;text-align:center;">
		<div class="post-hero__meta">
			<?php
			$terms = get_the_terms(get_the_ID(), 'industry');
			if ($terms) echo '<span class="post-hero__category">' . esc_html($terms[0]->name) . '</span><span>·</span>';
			?>
			<span><?php echo esc_html($client); ?></span>
		</div>
		<h1 class="post-hero__title"><?php the_title(); ?></h1>
		<p class="post-hero__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
		<?php if ($url) : ?><a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="btn btn--primary btn--lg" style="margin-top:1.5rem;">View Live Project →</a><?php endif; ?>
	</div>
</section>

<?php if (has_post_thumbnail()) : ?>
<div style="max-width:1000px;margin:-2rem auto 0;padding:0 1.5rem;">
	<div style="border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.15);">
		<?php the_post_thumbnail('large', ['style'=>'width:100%;height:auto;display:block;']); ?>
	</div>
</div>
<?php endif; ?>

<section class="section bg-white">
	<div class="container" style="max-width:820px;margin:0 auto;">
		<?php if ($services) : ?>
		<div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:2rem;">
			<?php foreach ((array)$services as $svc_id) :
				$svc = get_post($svc_id);
				if (!$svc) continue;
			?><a href="<?php echo esc_url(get_permalink($svc)); ?>" class="section-label"><?php echo esc_html($svc->post_title); ?></a><?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class="post-content"><?php the_content(); ?></div>
		<div style="margin-top:2.5rem;display:flex;gap:1rem;flex-wrap:wrap;">
			<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--primary">Start a Similar Project</a>
			<a href="<?php echo esc_url(get_post_type_archive_link('portfolio_item')); ?>" class="btn btn--outline">← All Portfolio</a>
		</div>
	</div>
</section>

<?php seoae_cta_dark(); endwhile; get_footer(); ?>
