<?php
/**
 * Generic Page Template
 */
get_header();
while (have_posts()) : the_post();
$faqs = get_field('page_faqs') ?: [];
?>
<section class="post-hero hero-dark" style="padding:3rem 0;">
	<div class="container" style="max-width:760px;margin:0 auto;text-align:center;">
		<?php echo do_shortcode('[seoae_breadcrumbs]'); ?>
		<h1 style="font-size:clamp(2rem,4vw,3rem);color:#fff;"><?php the_title(); ?></h1>
	</div>
</section>
<div class="section bg-white">
	<div class="container" style="max-width:820px;margin:0 auto;">
		<div class="post-content">
			<?php the_content(); ?>
		</div>
		<?php if ($faqs) : ?>
		<div style="margin-top:3rem;">
			<h2 style="margin-bottom:1.5rem;">Frequently Asked Questions</h2>
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
	</div>
</div>
<?php endwhile; get_footer(); ?>
