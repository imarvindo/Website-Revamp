<?php get_header(); ?>
<section class="archive-hero hero-dark">
	<div class="container archive-hero__inner">
		<?php if (is_post_type_archive('case_study')) : ?>
			<span class="section-label section-label--dark">Case Studies</span>
			<h1 class="archive-hero__title">Real Results for Real UAE Businesses</h1>
			<p class="archive-hero__desc">Data-driven case studies showing measurable organic growth and ROI for our clients.</p>
		<?php elseif (is_post_type_archive('portfolio_item')) : ?>
			<span class="section-label section-label--dark">Portfolio</span>
			<h1 class="archive-hero__title">Our Work</h1>
			<p class="archive-hero__desc">A showcase of our best digital marketing, web design, and development projects.</p>
		<?php elseif (is_post_type_archive('service')) : ?>
			<span class="section-label section-label--dark">Services</span>
			<h1 class="archive-hero__title">Enterprise Digital Marketing Services</h1>
			<p class="archive-hero__desc">Full-stack digital marketing solutions designed to grow UAE businesses at scale.</p>
		<?php else : ?>
			<span class="section-label section-label--dark"><?php the_archive_title('',''); ?></span>
			<h1 class="archive-hero__title"><?php the_archive_title(); ?></h1>
			<p class="archive-hero__desc"><?php the_archive_description(); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="section bg-light">
<div class="container">
<?php if (have_posts()) : ?>

<?php if (is_post_type_archive('service')) : ?>
<div class="services-grid">
	<?php while (have_posts()) : the_post();
		$short = get_field('short_description') ?: wp_trim_words(get_the_excerpt() ?: get_the_content(), 18);
		$icon  = get_field('icon_svg') ?: '';
	?>
	<a href="<?php the_permalink(); ?>" class="service-card">
		<?php if ($icon) : ?><div class="service-card__icon"><?= $icon ?></div><?php endif; ?>
		<h2 class="service-card__title"><?php the_title(); ?></h2>
		<p class="service-card__desc"><?php echo esc_html($short); ?></p>
		<span class="service-card__link">Learn More →</span>
	</a>
	<?php endwhile; ?>
</div>

<?php elseif (is_post_type_archive('case_study')) : ?>
<div class="case-study-grid">
	<?php while (have_posts()) : the_post();
		$results  = get_field('results') ?: [];
		$industry = get_field('cs_industry') ?: '';
		$client   = get_field('client_name') ?: get_the_title();
	?>
	<article class="case-study-card">
		<div class="case-study-card__head">
			<div class="case-study-card__industry"><?php echo esc_html($industry); ?></div>
			<h2 class="case-study-card__title"><?php echo esc_html($client); ?></h2>
		</div>
		<?php if ($results) : ?>
		<div class="case-study-card__results">
			<?php foreach (array_slice($results,0,3) as $r) : ?>
			<div class="case-study-card__result-item">
				<span class="case-study-card__result-value"><?php echo esc_html($r['value']??''); ?></span>
				<span class="case-study-card__result-label"><?php echo esc_html($r['metric']??''); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class="case-study-card__body">
			<p class="case-study-card__desc"><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25)); ?></p>
			<a href="<?php the_permalink(); ?>" style="display:inline-flex;align-items:center;gap:.35rem;margin-top:.75rem;font-size:.875rem;font-weight:600;color:var(--color-primary);">Read Case Study →</a>
		</div>
	</article>
	<?php endwhile; ?>
</div>

<?php else : ?>
<div class="blog-grid">
	<?php while (have_posts()) : the_post(); ?>
	<article class="blog-card">
		<div class="blog-card__image"><?php if(has_post_thumbnail()): the_post_thumbnail('medium_large'); endif; ?></div>
		<div class="blog-card__body">
			<h2 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
			<div class="blog-card__meta"><span><?php the_date('M j, Y'); ?></span></div>
		</div>
	</article>
	<?php endwhile; ?>
</div>
<?php endif; ?>

<div style="margin-top:2.5rem;text-align:center;">
	<?php the_posts_pagination(['mid_size'=>2]); ?>
</div>

<?php else : ?>
<p style="text-align:center;padding:3rem 0;color:var(--color-body);">No items found.</p>
<?php endif; ?>
</div>
</section>
<?php seoae_cta_dark(); get_footer(); ?>
