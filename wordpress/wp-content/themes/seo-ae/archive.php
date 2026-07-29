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
<!-- Blog archive with sidebar (category / tag pages) -->
<div style="display:grid;grid-template-columns:1fr 300px;gap:3rem;align-items:start;" class="blog-layout-grid">

  <!-- Posts Grid -->
  <div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;">
    <?php while (have_posts()) : the_post();
      $thumb  = get_the_post_thumbnail_url(null, 'medium_large');
      $cats   = get_the_category();
      $cat_nm = $cats ? $cats[0]->name : '';
      $rt     = get_post_meta(get_the_ID(), 'reading_time', true) ?: 8;
    ?>
    <article style="background:#fff;border-radius:14px;overflow:hidden;border:1px solid var(--color-border,#e2e8f0);display:flex;flex-direction:column;transition:box-shadow .2s,transform .2s;"
      onmouseover="this.style.boxShadow='0 8px 30px rgba(22,177,212,.12)';this.style.transform='translateY(-3px)'"
      onmouseout="this.style.boxShadow='none';this.style.transform='none'">
      <a href="<?php the_permalink(); ?>" style="display:block;overflow:hidden;">
        <?php if ($thumb) : ?>
        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>"
          style="width:100%;height:180px;object-fit:cover;display:block;" loading="lazy">
        <?php else : ?>
        <div style="width:100%;height:180px;background:linear-gradient(135deg,#101A6A 0%,#16B1D4 100%);display:flex;align-items:center;justify-content:center;">
          <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,.3)" stroke-width="1.5"><path stroke-linecap="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <?php endif; ?>
      </a>
      <div style="padding:1.25rem;flex:1;display:flex;flex-direction:column;gap:.5rem;">
        <?php if ($cat_nm) : ?>
        <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-primary,#16B1D4);"><?php echo esc_html($cat_nm); ?></span>
        <?php endif; ?>
        <h2 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);line-height:1.4;flex:1;margin:0;">
          <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
        </h2>
        <p style="font-size:.8125rem;color:var(--color-body,#4a5568);line-height:1.6;margin:0;">
          <?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?>
        </p>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:.5rem;padding-top:.75rem;border-top:1px solid var(--color-border,#e2e8f0);">
          <span style="font-size:.75rem;color:var(--color-body,#4a5568);"><?php the_date('M j, Y'); ?> · <?php echo $rt; ?> min</span>
          <a href="<?php the_permalink(); ?>" style="font-size:.75rem;font-weight:600;color:var(--color-primary,#16B1D4);">Read →</a>
        </div>
      </div>
    </article>
    <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <div style="margin-top:3rem;text-align:center;">
      <?php the_posts_pagination(['mid_size'=>2,'prev_text'=>'← Previous','next_text'=>'Next →','screen_reader_text'=>' ']); ?>
    </div>
  </div>

  <!-- Sidebar -->
  <aside>
    <!-- Search -->
    <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
      <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Search Articles</h3>
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div style="display:flex;gap:.5rem;">
          <input type="search" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>"
            style="flex:1;padding:.6rem .9rem;border:1.5px solid var(--color-border,#e2e8f0);border-radius:8px;font-size:.875rem;">
          <button type="submit" style="padding:.6rem 1rem;background:var(--color-primary,#16B1D4);color:#fff;border:none;border-radius:8px;cursor:pointer;font-weight:600;">→</button>
        </div>
      </form>
    </div>

    <!-- Categories -->
    <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
      <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Categories</h3>
      <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.35rem;">
        <?php
        $sidebar_cats = get_categories(['hide_empty'=>true,'orderby'=>'count','order'=>'DESC']);
        $cur_cat = get_query_var('cat');
        foreach ($sidebar_cats as $cat) :
        ?>
        <li>
          <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
            style="display:flex;justify-content:space-between;align-items:center;padding:.45rem .6rem;border-radius:8px;font-size:.875rem;color:var(--color-heading,#101A6A);text-decoration:none;<?php echo ($cur_cat==$cat->term_id)?'background:rgba(22,177,212,.08);color:var(--color-primary,#16B1D4);font-weight:600;':''; ?>">
            <?php echo esc_html($cat->name); ?>
            <span style="font-size:.75rem;color:var(--color-body);background:var(--color-muted-bg,#f0f4f8);padding:.15rem .5rem;border-radius:100px;"><?php echo $cat->count; ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Recent Posts -->
    <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
      <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Recent Posts</h3>
      <?php $recent = get_posts(['posts_per_page'=>5,'post_status'=>'publish']);
      foreach ($recent as $rp) : ?>
      <a href="<?php echo esc_url(get_permalink($rp)); ?>"
        style="display:block;padding:.6rem 0;border-bottom:1px solid var(--color-border,#e2e8f0);font-size:.8125rem;font-weight:500;color:var(--color-heading,#101A6A);text-decoration:none;line-height:1.4;">
        <?php echo esc_html(wp_trim_words($rp->post_title, 10)); ?>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- Sidebar CTA -->
    <div style="background:linear-gradient(135deg,#101A6A 0%,#1e3a9a 100%);border-radius:14px;padding:1.75rem;text-align:center;">
      <?php seoae_section_label('FREE AUDIT','dark'); ?>
      <h3 style="color:#fff;font-size:1.1rem;font-weight:700;margin:.75rem 0 .5rem;">Get Your Free SEO Audit</h3>
      <p style="color:rgba(255,255,255,.7);font-size:.8125rem;line-height:1.6;margin-bottom:1.25rem;">Find out exactly why your website isn't ranking and what to fix first.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary" style="width:100%;text-align:center;display:block;">Get Free Audit →</a>
    </div>
  </aside>

</div><!-- /blog-layout-grid -->

<style>
@media (max-width:900px){.blog-layout-grid{grid-template-columns:1fr !important;}
.blog-layout-grid aside{display:none;}}
</style>

<?php endif; ?>

<?php else : ?>
<p style="text-align:center;padding:3rem 0;color:var(--color-body);">No items found.</p>
<?php endif; ?>
</div>
</section>
<?php seoae_cta_dark(); get_footer(); ?>
