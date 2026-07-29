<?php
/**
 * Single Service Page Template
 */
get_header();
while (have_posts()) : the_post();
$short_desc   = get_post_meta( get_the_ID(), 'short_description', true ) ?: get_the_excerpt();
$category_lbl = get_post_meta( get_the_ID(), 'category_label',    true ) ?: 'Digital Marketing';
$hero_badge   = get_post_meta( get_the_ID(), 'hero_badge',        true ) ?: 'Premium';
$hero_badge_sub = get_post_meta( get_the_ID(), 'hero_badge_sub',  true ) ?: 'Results Driven';
$cta_primary  = get_post_meta( get_the_ID(), 'cta_primary_text',  true ) ?: 'Start Your Campaign';
$cta_phone    = get_post_meta( get_the_ID(), 'cta_phone_text',    true ) ?: 'Call Us Now';
$icon_svg     = get_post_meta( get_the_ID(), 'icon_svg',          true ) ?: '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>';
// PHP-serialised arrays (WordPress handles serialisation natively — no encoding issues)
$benefits     = get_post_meta( get_the_ID(), 'svc_benefits',    true ) ?: [];
$process      = get_post_meta( get_the_ID(), 'svc_process',     true ) ?: [];
$technologies = get_post_meta( get_the_ID(), 'svc_technologies',true ) ?: [];
$faqs         = get_post_meta( get_the_ID(), 'svc_faqs',        true ) ?: [];
$related_ids  = get_post_meta( get_the_ID(), 'svc_related',     true ) ?: [];
$related      = array_filter( array_map( 'get_post', (array) $related_ids ) );
$phone        = seoae_phone();
?>

<!-- SERVICE HERO -->
<section class="service-hero hero-dark">
	<div class="container service-hero__inner">
		<div>
			<?php echo do_shortcode('[seoae_breadcrumbs]'); ?>
			<div class="service-hero__badge-pill"><?php echo esc_html($category_lbl); ?></div>
			<h1 class="service-hero__title"><?php the_title(); ?></h1>
			<p class="service-hero__desc"><?php echo esc_html($short_desc); ?></p>
			<div class="service-hero__actions">
				<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--primary btn--lg"><?php echo esc_html($cta_primary); ?> →</a>
				<a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','', $phone)); ?>" class="btn btn--outline-white btn--lg">
					<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/></svg>
					<?php echo esc_html($cta_phone); ?>
				</a>
			</div>
		</div>
		<div class="service-hero__card">
			<div class="service-hero__card-top">
				<div class="service-hero__card-icon"><?= $icon_svg ?></div>
				<div>
					<p class="service-hero__card-name"><?php echo esc_html($hero_badge); ?></p>
					<p class="service-hero__card-sub"><?php echo esc_html($hero_badge_sub); ?></p>
				</div>
			</div>
			<?php if ($benefits) : ?>
			<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.6rem;">
				<?php foreach (array_slice($benefits,0,5) as $b) : ?>
				<li style="display:flex;align-items:center;gap:.6rem;font-size:.85rem;color:rgba(255,255,255,.8);">
					<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
					<?php echo esc_html($b['benefit'] ?? $b); ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- WHY IT MATTERS / FULL DESCRIPTION -->
<?php if (get_the_content()) : ?>
<section class="section bg-white">
	<div class="container">
		<div style="display:grid;grid-template-columns:1fr 380px;gap:3rem;align-items:start;" class="svc-body-grid">
			<div class="post-content"><?php the_content(); ?></div>
			<?php if ($benefits) : ?>
			<div class="card" style="border-radius:16px;padding:2rem;position:sticky;top:90px;">
				<h3 style="font-size:1.1rem;margin-bottom:1rem;">What You Get</h3>
				<ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.65rem;">
					<?php foreach ($benefits as $b) : ?>
					<li style="display:flex;align-items:center;gap:.6rem;font-size:.875rem;color:var(--color-body);">
						<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="m9 12 2 2 4-4"/></svg>
						<?php echo esc_html($b['benefit'] ?? $b); ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- PROCESS -->
<?php if ($process) : ?>
<section class="section process-section">
	<div class="container">
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
			<div>
				<?php seoae_section_label('Our Process'); ?>
				<h2 style="margin-bottom:1rem;">How We Deliver Results</h2>
				<p style="color:var(--color-body);margin-bottom:2rem;">A proven methodology built on transparency, data, and relentless execution.</p>
				<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--secondary">Start Your Project →</a>
			</div>
			<div class="process-steps">
				<?php $i=1; foreach ($process as $step) : ?>
				<div class="process-step">
					<div class="process-step__num"><?php echo $i++; ?></div>
					<div class="process-step__body">
						<h3 class="process-step__title"><?php echo esc_html($step['step_title'] ?? ''); ?></h3>
						<p class="process-step__desc"><?php echo esc_html($step['step_desc'] ?? ''); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- TECHNOLOGIES -->
<?php if ($technologies) : ?>
<section class="section bg-white" style="padding:2.5rem 0;">
	<div class="container">
		<h3 style="font-size:1rem;font-weight:700;color:var(--color-heading);margin-bottom:1rem;text-transform:uppercase;letter-spacing:.07em;">Tools &amp; Technologies</h3>
		<div class="tech-badges">
			<?php foreach ($technologies as $t) : ?>
			<span class="tech-badge"><?php echo esc_html($t['tech_name'] ?? $t); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- FAQs -->
<?php if ($faqs) : ?>
<section class="section faq-section">
	<div class="container">
		<div class="section-header section-header--center">
			<?php seoae_section_label('FAQ'); ?>
			<h2 class="section-header__title">Frequently Asked Questions</h2>
			<p class="section-header__desc">Everything you need to know about our <?php the_title(); ?> services.</p>
		</div>
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
</section>
<?php endif; ?>

<!-- RELATED SERVICES -->
<?php if ($related) : ?>
<section class="section bg-white" style="padding:3rem 0;">
	<div class="container">
		<h3 style="font-size:1.1rem;font-weight:700;color:var(--color-heading);margin-bottom:1.5rem;">Related Services</h3>
		<div class="services-grid">
			<?php foreach ($related as $svc) :
				$svc_short = get_field('short_description', $svc->ID) ?: wp_trim_words($svc->post_excerpt, 15);
			?>
			<a href="<?php echo esc_url(get_permalink($svc)); ?>" class="service-card">
				<h3 class="service-card__title"><?php echo esc_html($svc->post_title); ?></h3>
				<p class="service-card__desc"><?php echo esc_html($svc_short); ?></p>
				<span class="service-card__link">Learn More →</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php seoae_cta_dark(); ?>

<?php endwhile; get_footer(); ?>

<style>
@media (max-width:768px) {
  .svc-body-grid { grid-template-columns: 1fr !important; }
}
</style>
