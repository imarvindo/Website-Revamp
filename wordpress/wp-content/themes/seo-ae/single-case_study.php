<?php
/**
 * Single Case Study Template
 */
get_header();
while (have_posts()) : the_post();
$client   = get_field('client_name')  ?: get_the_title();
$logo     = get_field('client_logo')  ?: '';
$industry = get_field('cs_industry')  ?: '';
$service  = get_field('cs_service')   ?: [];
$duration = get_field('cs_duration')  ?: '6 months';
$challenge= get_field('challenge')    ?: '';
$solution = get_field('solution')     ?: '';
$results  = get_field('results')      ?: [];
$quote    = get_field('client_quote') ?: '';
$quote_a  = get_field('quote_author') ?: '';
$quote_r  = get_field('quote_role')   ?: '';
?>
<section class="post-hero hero-dark">
	<div class="container" style="max-width:800px;margin:0 auto;text-align:center;">
		<div class="post-hero__meta">
			<span class="post-hero__category"><?php echo esc_html($industry); ?></span>
			<span>·</span>
			<span><?php echo esc_html($duration); ?></span>
		</div>
		<h1 class="post-hero__title"><?php echo esc_html($client); ?></h1>
		<?php if ($service) : ?>
		<div style="display:flex;gap:.5rem;flex-wrap:wrap;justify-content:center;margin-top:1rem;">
			<?php foreach((array)$service as $svc): ?>
			<a href="<?php echo esc_url(get_permalink($svc)); ?>" class="section-label section-label--dark"><?php echo esc_html($svc->post_title); ?></a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- Results Bar -->
<?php if ($results) : ?>
<div style="background:var(--color-secondary);padding:2rem 0;">
	<div class="container">
		<div class="stats-bar__inner">
			<?php foreach ($results as $r) : ?>
			<div class="stats-bar__item">
				<span class="stats-bar__value stats-bar--dark"
				      data-counter="<?php echo esc_attr(preg_replace('/[^0-9.]/','', $r['value']??'')); ?>"
				      data-prefix="<?php echo esc_attr(preg_replace('/[0-9.]+.*/','', $r['value']??'')); ?>"
				      data-suffix="<?php echo esc_attr(preg_replace('/^[^0-9]*[0-9.]+/','', $r['value']??'')); ?>">
					<?php echo esc_html($r['value']??''); ?>
				</span>
				<span class="stats-bar__label" style="color:rgba(255,255,255,.6);"><?php echo esc_html($r['metric']??''); ?></span>
				<?php if (!empty($r['period'])) : ?><span style="font-size:.7rem;color:rgba(255,255,255,.4);"><?php echo esc_html($r['period']); ?></span><?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<section class="section bg-white">
	<div class="container" style="max-width:820px;margin:0 auto;">

		<?php if ($challenge) : ?>
		<div style="margin-bottom:2.5rem;">
			<h2 style="margin-bottom:1rem;">The Challenge</h2>
			<div class="post-content"><?php echo wp_kses_post($challenge); ?></div>
		</div>
		<?php endif; ?>

		<?php if ($solution) : ?>
		<div style="margin-bottom:2.5rem;">
			<h2 style="margin-bottom:1rem;">Our Solution</h2>
			<div class="post-content"><?php echo wp_kses_post($solution); ?></div>
		</div>
		<?php endif; ?>

		<?php if ($quote) : ?>
		<blockquote style="border-left:4px solid var(--color-primary);padding:1.25rem 1.75rem;background:rgba(22,177,212,.06);border-radius:0 16px 16px 0;margin:2rem 0;">
			<p style="font-size:1.05rem;font-style:italic;color:var(--color-heading);margin-bottom:.75rem;">"<?php echo esc_html($quote); ?>"</p>
			<?php if ($quote_a) : ?>
			<footer style="font-size:.875rem;font-weight:600;color:var(--color-body);">
				— <?php echo esc_html($quote_a); ?><?php if ($quote_r) echo ', ' . esc_html($quote_r); ?>
			</footer>
			<?php endif; ?>
		</blockquote>
		<?php endif; ?>

		<div style="margin-top:2rem;text-align:center;">
			<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--primary btn--lg">Get Similar Results →</a>
		</div>
	</div>
</section>

<?php seoae_cta_dark(); endwhile; get_footer(); ?>
