<?php
/**
 * Index / fallback template
 */
get_header();
?>
<section class="archive-hero hero-dark">
	<div class="container archive-hero__inner">
		<div class="archive-hero__title-wrap">
			<?php if (is_home()) : ?>
				<h1 class="archive-hero__title">Blog &amp; Insights</h1>
				<p class="archive-hero__desc">SEO tips, digital marketing strategies, and industry insights from the UAE's leading digital agency.</p>
			<?php elseif (is_category()) : ?>
				<h1 class="archive-hero__title"><?php single_cat_title(); ?></h1>
				<p class="archive-hero__desc"><?php echo category_description(); ?></p>
			<?php elseif (is_tag()) : ?>
				<h1 class="archive-hero__title">Tag: <?php single_tag_title(); ?></h1>
			<?php elseif (is_author()) : ?>
				<h1 class="archive-hero__title">Posts by <?php the_author(); ?></h1>
			<?php elseif (is_search()) : ?>
				<h1 class="archive-hero__title">Search: "<?php echo esc_html(get_search_query()); ?>"</h1>
			<?php else : ?>
				<h1 class="archive-hero__title"><?php the_archive_title(); ?></h1>
			<?php endif; ?>
		</div>
	</div>
</section>

<div class="section bg-light">
	<div class="container">
		<?php if (have_posts()) : ?>
		<div class="blog-grid">
			<?php while (have_posts()) : the_post();
				$category = get_the_category();
				$cat_name = $category ? $category[0]->name : 'SEO';
				$thumb    = get_the_post_thumbnail_url(null, 'medium_large');
				$rt       = get_field('reading_time') ?: 8;
			?>
			<article class="blog-card">
				<div class="blog-card__image">
					<?php if ($thumb) : ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"><?php endif; ?>
				</div>
				<div class="blog-card__body">
					<span class="blog-card__category"><?php echo esc_html($cat_name); ?></span>
					<h2 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 22); ?></p>
					<div class="blog-card__meta">
						<span><?php the_date('M j, Y'); ?></span>
						<span>·</span>
						<span><?php echo esc_html($rt); ?> min read</span>
					</div>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<div style="margin-top:2.5rem;text-align:center;">
			<?php the_posts_pagination(['mid_size'=>2,'prev_text'=>'← Previous','next_text'=>'Next →']); ?>
		</div>
		<?php else : ?>
		<div style="text-align:center;padding:4rem 0;">
			<p style="font-size:1.1rem;color:var(--color-body);">No posts found.</p>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary" style="margin-top:1rem;">Back to Home</a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
