<?php
/**
 * Single Blog Post Template
 */
get_header();
while (have_posts()) : the_post();
	$category    = get_the_category();
	$cat_name    = $category ? $category[0]->name : 'SEO';
	$rt          = get_field('reading_time')   ?: 8;
	$subtitle    = get_field('subtitle')       ?: '';
	$key_taks    = get_field('key_takeaways')  ?: '';
	$ai_summary  = get_field('ai_summary')     ?: '';
	$faqs        = get_field('article_faqs')   ?: [];
	$rel_svcs    = get_field('related_services') ?: [];
	$author_role = get_field('author_role')    ?: 'SEO Specialist';
	$thumb       = get_the_post_thumbnail_url(null, 'full');
?>

<!-- Post Hero -->
<section class="post-hero hero-dark">
	<div class="container post-hero__inner">
		<div class="post-hero__meta">
			<a href="<?php echo esc_url(get_category_link($category[0]->term_id ?? 0)); ?>" class="post-hero__category"><?php echo esc_html($cat_name); ?></a>
			<span>·</span>
			<span><?php echo esc_html($rt); ?> min read</span>
			<span>·</span>
			<span><?php the_date('F j, Y'); ?></span>
		</div>
		<h1 class="post-hero__title"><?php the_title(); ?></h1>
		<?php if ($subtitle) : ?><p class="post-hero__excerpt"><?php echo esc_html($subtitle); ?></p><?php endif; ?>
		<div class="post-hero__author">
			<div class="post-hero__author-avatar"><?php echo strtoupper(substr(get_the_author(), 0, 1)); ?></div>
			<div>
				<p class="post-hero__author-name"><?php the_author(); ?></p>
				<p class="post-hero__author-role"><?php echo esc_html($author_role); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- Post Body -->
<div class="post-body">
	<div class="container">
		<div class="post-body__inner">

			<!-- Main Content -->
			<div class="post-content">
				<?php if ($thumb) : ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" width="1200" height="675" loading="eager" decoding="async" style="border-radius:16px;margin-bottom:2rem;aspect-ratio:16/9;object-fit:cover;width:100%;height:auto;"><?php endif; ?>

				<?php if ( function_exists( 'seoae_eeat_byline' ) ) { seoae_eeat_byline(); } ?>

				<?php if ($key_taks) : ?>
				<div style="background:rgba(22,177,212,.07);border:1px solid rgba(22,177,212,.2);border-radius:12px;padding:1.5rem;margin-bottom:2rem;">
					<p style="font-weight:700;color:var(--color-heading);margin-bottom:.75rem;font-size:.875rem;text-transform:uppercase;letter-spacing:.07em;">Key Takeaways</p>
					<ul style="padding-left:1.25rem;margin:0;">
						<?php foreach(explode("\n", $key_taks) as $tak) : $tak = trim($tak); if(!$tak) continue; ?>
						<li style="font-size:.9rem;color:var(--color-body);margin-bottom:.4rem;"><?php echo esc_html($tak); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php the_content(); ?>

				<?php if ($faqs) : ?>
				<div style="margin-top:3rem;">
					<h2>Frequently Asked Questions</h2>
					<div class="faq-list">
						<?php foreach ($faqs as $faq) : ?>
						<div class="faq-item">
							<button class="faq-question" aria-expanded="false">
								<?php echo esc_html($faq['question']); ?>
								<div class="faq-icon" aria-hidden="true">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
								</div>
							</button>
							<div class="faq-answer" aria-hidden="true">
								<div class="faq-answer__inner"><?php echo wp_kses_post($faq['answer']); ?></div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

				<!-- Tags -->
				<div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--color-border);">
					<?php the_tags('<div class="tech-badges">','','</div>'); ?>
				</div>
			</div>

			<!-- Sidebar -->
			<aside class="post-sidebar">
				<!-- Related Services -->
				<?php if ($rel_svcs) : ?>
				<div class="post-sidebar__card">
					<p class="post-sidebar__title">Related Services</p>
					<?php foreach ($rel_svcs as $svc) : ?>
					<a href="<?php echo esc_url(get_permalink($svc)); ?>" style="display:flex;align-items:center;gap:.5rem;padding:.6rem 0;border-bottom:1px solid var(--color-border);font-size:.875rem;font-weight:500;color:var(--color-heading);">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 5l7 7-7 7"/></svg>
						<?php echo esc_html($svc->post_title); ?>
					</a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<!-- CTA Card -->
				<div class="post-sidebar__card" style="background:var(--color-secondary);border-color:transparent;">
					<p style="color:rgba(255,255,255,.8);font-size:.875rem;margin-bottom:.75rem;">Get a free SEO audit for your website</p>
					<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--primary" style="width:100%;text-align:center;justify-content:center;">Get Free Audit</a>
				</div>

				<!-- Recent Posts -->
				<div class="post-sidebar__card">
					<p class="post-sidebar__title">Recent Posts</p>
					<?php $recent = seoae_get_recent_posts(5); foreach($recent as $rp) : ?>
					<a href="<?php echo esc_url(get_permalink($rp)); ?>" style="display:block;padding:.6rem 0;border-bottom:1px solid var(--color-border);font-size:.85rem;font-weight:500;color:var(--color-heading);line-height:1.4;">
						<?php echo esc_html($rp->post_title); ?>
					</a>
					<?php endforeach; ?>
				</div>
			</aside>

		</div>
	</div>
</div>

<?php
if ( function_exists( 'seoae_related_links_module' ) ) {
	seoae_related_links_module( 'Continue exploring — services, locations & case studies' );
}
seoae_cta_dark();
endwhile;
get_footer();
?>
