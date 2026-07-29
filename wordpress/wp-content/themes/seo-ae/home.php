<?php
/**
 * Blog Index Template (home.php)
 * Used when a static front page is set and a separate blog page is assigned.
 * Covers: /blog/ — blog listing with category filters, sidebar, pagination.
 */
get_header();

// Blog settings from ACF Options (CMS-editable)
$blog_hero_title = function_exists('get_field') ? get_field('blog_hero_title', 'option') : '';
$blog_hero_desc  = function_exists('get_field') ? get_field('blog_hero_desc',  'option') : '';
$blog_hero_title = $blog_hero_title ?: 'SEO & Digital Marketing Insights';
$blog_hero_desc  = $blog_hero_desc  ?: 'Expert guides, strategies, and industry news for UAE businesses looking to dominate search.';

// Current category filter
$current_cat = get_query_var('cat') ? get_query_var('cat') : 0;
$current_tag = get_query_var('tag') ? get_query_var('tag') : '';
?>

<!-- ── Blog Hero ─────────────────────────────────────────────── -->
<section class="post-hero hero-dark" style="padding:4rem 0 3rem;">
  <div class="container" style="text-align:center;max-width:760px;margin:0 auto;">
    <?php seoae_section_label('BLOG & INSIGHTS'); ?>
    <h1 style="font-size:clamp(2rem,4vw,3rem);color:#fff;margin:.75rem 0 1rem;">
      <?php echo esc_html($blog_hero_title); ?>
    </h1>
    <p style="font-size:1.05rem;color:rgba(255,255,255,.75);max-width:580px;margin:0 auto;">
      <?php echo esc_html($blog_hero_desc); ?>
    </p>
  </div>
</section>

<!-- ── Category Filter Bar ───────────────────────────────────── -->
<?php
$blog_cats = get_categories([
  'orderby'    => 'count',
  'order'      => 'DESC',
  'hide_empty' => true,
]);
if ( $blog_cats ) :
?>
<div style="background:#fff;border-bottom:1px solid var(--color-border,#e2e8f0);position:sticky;top:0;z-index:90;">
  <div class="container" style="overflow-x:auto;white-space:nowrap;padding:0;">
    <div style="display:inline-flex;gap:.25rem;padding:.75rem 0;">
      <a href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/blog/')); ?>"
        style="display:inline-block;padding:.45rem 1.1rem;border-radius:100px;font-size:.8125rem;font-weight:600;text-decoration:none;
        <?php echo !$current_cat && !$current_tag ? 'background:var(--color-primary,#16B1D4);color:#fff;' : 'background:var(--color-muted-bg,#f0f4f8);color:var(--color-heading,#101A6A);'; ?>">
        All Posts
      </a>
      <?php foreach ( $blog_cats as $cat ) : ?>
      <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
        style="display:inline-block;padding:.45rem 1.1rem;border-radius:100px;font-size:.8125rem;font-weight:600;text-decoration:none;
        <?php echo ($current_cat == $cat->term_id) ? 'background:var(--color-primary,#16B1D4);color:#fff;' : 'background:var(--color-muted-bg,#f0f4f8);color:var(--color-heading,#101A6A);'; ?>">
        <?php echo esc_html($cat->name); ?> <span style="opacity:.6;font-weight:400;">(<?php echo $cat->count; ?>)</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ── Blog Grid + Sidebar ───────────────────────────────────── -->
<section class="section bg-light" style="padding:3.5rem 0;">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 300px;gap:3rem;align-items:start;" class="blog-layout-grid">

      <!-- Posts Grid -->
      <div>
        <?php if ( have_posts() ) : ?>

        <!-- Featured Post (first post, full-width) -->
        <?php the_post(); ?>
        <?php
          $feat_thumb = get_the_post_thumbnail_url(null, 'large');
          $feat_cat   = get_the_category();
          $feat_cat_name = $feat_cat ? $feat_cat[0]->name : 'SEO';
          $feat_rt    = get_post_meta(get_the_ID(), 'reading_time', true) ?: 8;
        ?>
        <article style="background:#fff;border-radius:16px;overflow:hidden;border:1px solid var(--color-border,#e2e8f0);margin-bottom:2rem;display:grid;grid-template-columns:<?php echo $feat_thumb ? '1fr 1fr' : '1fr'; ?>;gap:0;">
          <?php if ($feat_thumb) : ?>
          <a href="<?php the_permalink(); ?>" style="display:block;overflow:hidden;">
            <img src="<?php echo esc_url($feat_thumb); ?>" alt="<?php the_title_attribute(); ?>"
              style="width:100%;height:100%;min-height:280px;object-fit:cover;display:block;transition:transform .3s;"
              loading="lazy">
          </a>
          <?php endif; ?>
          <div style="padding:2rem;">
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;">
              <span style="padding:.3rem .85rem;background:var(--color-primary,#16B1D4);color:#fff;border-radius:100px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;">
                <?php echo esc_html($feat_cat_name); ?>
              </span>
              <span style="font-size:.75rem;color:var(--color-body,#4a5568);"><?php echo $feat_rt; ?> min read</span>
            </div>
            <h2 style="font-size:1.35rem;font-weight:800;color:var(--color-heading,#101A6A);line-height:1.3;margin-bottom:.75rem;">
              <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
            </h2>
            <p style="font-size:.875rem;color:var(--color-body,#4a5568);line-height:1.65;margin-bottom:1.25rem;">
              <?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?>
            </p>
            <div style="display:flex;align-items:center;justify-content:space-between;">
              <span style="font-size:.8rem;color:var(--color-body,#4a5568);"><?php the_date('M j, Y'); ?></span>
              <a href="<?php the_permalink(); ?>" style="font-size:.875rem;font-weight:600;color:var(--color-primary,#16B1D4);text-decoration:none;">
                Read Article →
              </a>
            </div>
          </div>
        </article>

        <!-- Remaining Posts Grid (3-column) -->
        <?php if ( have_posts() ) : ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.5rem;">
          <?php while ( have_posts() ) : the_post();
            $thumb   = get_the_post_thumbnail_url(null, 'medium_large');
            $cats    = get_the_category();
            $cat_nm  = $cats ? $cats[0]->name : '';
            $rt      = get_post_meta(get_the_ID(), 'reading_time', true) ?: 8;
          ?>
          <article class="blog-card" style="background:#fff;border-radius:14px;overflow:hidden;border:1px solid var(--color-border,#e2e8f0);display:flex;flex-direction:column;transition:box-shadow .2s,transform .2s;"
            onmouseover="this.style.boxShadow='0 8px 30px rgba(22,177,212,.12)';this.style.transform='translateY(-3px)'"
            onmouseout="this.style.boxShadow='none';this.style.transform='none'">
            <a href="<?php the_permalink(); ?>" style="display:block;overflow:hidden;">
              <?php if ($thumb) : ?>
              <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>"
                style="width:100%;height:180px;object-fit:cover;display:block;transition:transform .3s;"
                loading="lazy">
              <?php else : ?>
              <div style="width:100%;height:180px;background:linear-gradient(135deg,#101A6A 0%,#16B1D4 100%);display:flex;align-items:center;justify-content:center;">
                <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,.3)" stroke-width="1.5"><path stroke-linecap="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              </div>
              <?php endif; ?>
            </a>
            <div style="padding:1.25rem;flex:1;display:flex;flex-direction:column;gap:.5rem;">
              <?php if ($cat_nm) : ?>
              <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-primary,#16B1D4);">
                <?php echo esc_html($cat_nm); ?>
              </span>
              <?php endif; ?>
              <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);line-height:1.4;flex:1;">
                <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
              </h3>
              <p style="font-size:.8125rem;color:var(--color-body,#4a5568);line-height:1.6;">
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
        <?php endif; ?>

        <!-- Pagination -->
        <div style="margin-top:3rem;text-align:center;">
          <?php
          the_posts_pagination([
            'mid_size'           => 2,
            'prev_text'          => '← Previous',
            'next_text'          => 'Next →',
            'screen_reader_text' => ' ',
            'before_page_number' => '',
          ]);
          ?>
        </div>

        <?php else : ?>
        <div style="text-align:center;padding:4rem 0;color:var(--color-body,#4a5568);">
          <p style="font-size:1.1rem;">No posts found. Check back soon for new articles.</p>
        </div>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <aside class="blog-sidebar">

        <!-- Search -->
        <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
          <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Search Articles</h3>
          <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <div style="display:flex;gap:.5rem;">
              <input type="search" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>"
                style="flex:1;padding:.6rem .9rem;border:1.5px solid var(--color-border,#e2e8f0);border-radius:8px;font-size:.875rem;outline:none;">
              <button type="submit" style="padding:.6rem 1rem;background:var(--color-primary,#16B1D4);color:#fff;border:none;border-radius:8px;cursor:pointer;font-weight:600;">
                →
              </button>
            </div>
          </form>
        </div>

        <!-- Categories -->
        <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
          <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Categories</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.35rem;">
            <?php
            $sidebar_cats = get_categories(['hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC']);
            foreach ($sidebar_cats as $cat) :
            ?>
            <li>
              <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                style="display:flex;justify-content:space-between;align-items:center;padding:.45rem .6rem;border-radius:8px;font-size:.875rem;color:var(--color-heading,#101A6A);text-decoration:none;
                <?php echo ($current_cat == $cat->term_id) ? 'background:rgba(22,177,212,.08);color:var(--color-primary,#16B1D4);font-weight:600;' : ''; ?>"
                onmouseover="this.style.background='rgba(22,177,212,.06)'"
                onmouseout="this.style.background='<?php echo ($current_cat == $cat->term_id) ? 'rgba(22,177,212,.08)' : 'transparent'; ?>'">
                <?php echo esc_html($cat->name); ?>
                <span style="font-size:.75rem;color:var(--color-body,#4a5568);background:var(--color-muted-bg,#f0f4f8);padding:.15rem .5rem;border-radius:100px;"><?php echo $cat->count; ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Recent Posts -->
        <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
          <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Recent Posts</h3>
          <?php
          $recent = get_posts(['posts_per_page' => 5, 'post_status' => 'publish']);
          foreach ($recent as $rp) :
          ?>
          <a href="<?php echo esc_url(get_permalink($rp)); ?>"
            style="display:block;padding:.6rem 0;border-bottom:1px solid var(--color-border,#e2e8f0);font-size:.8125rem;font-weight:500;color:var(--color-heading,#101A6A);text-decoration:none;line-height:1.4;"
            onmouseover="this.style.color='var(--color-primary,#16B1D4)'"
            onmouseout="this.style.color='var(--color-heading,#101A6A)'">
            <?php echo esc_html(wp_trim_words($rp->post_title, 10)); ?>
          </a>
          <?php endforeach; ?>
        </div>

        <!-- Popular Tags -->
        <?php $tags = get_tags(['orderby' => 'count', 'order' => 'DESC', 'number' => 15]); if ($tags) : ?>
        <div style="background:#fff;border:1px solid var(--color-border,#e2e8f0);border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;">
          <h3 style="font-size:.9375rem;font-weight:700;color:var(--color-heading,#101A6A);margin-bottom:1rem;">Popular Topics</h3>
          <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
            <?php foreach ($tags as $tag) : ?>
            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
              style="padding:.3rem .8rem;background:var(--color-muted-bg,#f0f4f8);border:1px solid var(--color-border,#e2e8f0);border-radius:100px;font-size:.75rem;color:var(--color-heading,#101A6A);font-weight:500;text-decoration:none;transition:all .15s;"
              onmouseover="this.style.background='var(--color-primary,#16B1D4)';this.style.color='#fff';this.style.borderColor='var(--color-primary,#16B1D4)'"
              onmouseout="this.style.background='var(--color-muted-bg,#f0f4f8)';this.style.color='var(--color-heading,#101A6A)';this.style.borderColor='var(--color-border,#e2e8f0)'">
              <?php echo esc_html($tag->name); ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Sidebar CTA -->
        <div style="background:linear-gradient(135deg,#101A6A 0%,#1e3a9a 100%);border-radius:14px;padding:1.75rem;text-align:center;">
          <?php seoae_section_label('FREE AUDIT', 'dark'); ?>
          <h3 style="color:#fff;font-size:1.1rem;font-weight:700;margin:.75rem 0 .5rem;line-height:1.3;">Get Your Free SEO Audit</h3>
          <p style="color:rgba(255,255,255,.7);font-size:.8125rem;line-height:1.6;margin-bottom:1.25rem;">Find out exactly why your website isn't ranking and what to fix first.</p>
          <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary" style="width:100%;text-align:center;justify-content:center;display:block;">
            Get Free Audit →
          </a>
        </div>

      </aside>
    </div><!-- /blog-layout-grid -->
  </div>
</section>

<style>
@media (max-width: 900px) {
  .blog-layout-grid { grid-template-columns: 1fr !important; }
  .blog-sidebar { display: none; }
}
</style>

<?php seoae_cta_dark(); get_footer(); ?>
