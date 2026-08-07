<?php
/**
 * About page — conversion-focused redesign.
 * Template Name: About Page
 */
get_header();

$email = function_exists( 'seoae_email' ) ? seoae_email() : 'sales@searchengineoptimization.ae';
$img   = content_url( 'uploads/2026/07/team-meeting.jpg' );
$office = content_url( 'uploads/2026/07/office.jpg' );
$team  = new WP_Query( [ 'post_type' => 'team_member', 'posts_per_page' => 8, 'post_status' => 'publish' ] );
?>
<main class="rhome rservice">
  <section class="rh-hero rs-hero">
    <span class="rh-hero__glow rh-hero__glow--1"></span>
    <span class="rh-hero__glow rh-hero__glow--2"></span>
    <div class="rh-wrap">
      <div class="rs-hero__grid">
        <div data-reveal>
          <span class="rh-eyebrow"><?php echo rh_icon( 'users', 14 ); ?> About us</span>
          <h1 class="rs-hero__title">We don’t guess.<br><span class="rh-grad-text">We dominate.</span></h1>
          <p class="rs-hero__lead">Founded in Dubai, SearchEngineOptimization.ae was built on one premise: most agencies deliver reports — we deliver revenue.</p>
          <div class="rh-hero__cta">
            <a class="rh-btn rh-btn--primary rh-btn--xl" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo rh_icon( 'rocket', 18 ); ?> Work With Us</a>
            <a class="rh-btn rh-btn--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'case_study' ) ?: home_url( '/case-studies/' ) ); ?>">See Our Results</a>
          </div>
        </div>
        <div class="rs-hero__visual" data-reveal data-reveal-delay="2">
          <figure class="rs-hero__photo"><img src="<?php echo esc_url( $img ); ?>" alt="SearchEngineOptimization.ae team collaboration" width="720" height="520" decoding="async" fetchpriority="high"></figure>
        </div>
      </div>
    </div>
  </section>

  <?php seoae_rh_stats_strip( [ [ '8+', 'Years active' ], [ '345+', 'Clients served' ], [ '+92%', 'Avg ROI' ], [ '8+', 'Countries' ] ] ); ?>

  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'shield', 14 ); ?> Our mission</span>
        <h2 class="rh-h2">Built for results. Obsessed with growth.</h2>
        <p class="rh-lead">Every dirham invested in digital marketing should return measurable value. That’s our operating principle.</p>
      </div>
      <div class="rh-choose">
        <?php
		$values = [
			[ 'star', 'Excellence', 'Award-winning strategies that set new benchmarks in UAE digital growth.' ],
			[ 'chart', 'Precision', 'Campaigns backed by competitive intelligence and hard data.' ],
			[ 'bolt', 'Speed', 'Strategy to execution in days — because speed is a competitive advantage.' ],
			[ 'users', 'Partnership', 'Senior-led teams with direct access and zero gatekeeping.' ],
			[ 'eye', 'Transparency', 'Live dashboards, weekly reports, and clear ownership.' ],
			[ 'ai', 'Innovation', 'From AI Search to GEO, we stay ahead of tomorrow’s search landscape.' ],
		];
		foreach ( $values as $vi => $v ) :
			?>
          <div class="rh-feature" data-reveal data-reveal-delay="<?php echo esc_attr( (string) ( $vi % 3 ) ); ?>">
            <div class="rh-feature__ic"><?php echo rh_icon( $v[0], 26 ); ?></div>
            <h3 class="rh-feature__t"><?php echo esc_html( $v[1] ); ?></h3>
            <p class="rh-feature__d"><?php echo esc_html( $v[2] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php
	seoae_rh_image_split(
		[
			'eyebrow' => 'How we operate',
			'title'   => 'Senior specialists. Clear accountability. Revenue outcomes.',
			'text'    => 'We combine elite technical expertise with aggressive growth strategy — so UAE brands can outrank, outconvert, and outgrow their category.',
			'points'  => [
				'Senior-led pods on every account',
				'Bilingual Arabic + English execution',
				'Transparent weekly performance reporting',
				'No lock-in contracts',
			],
			'image'   => $office,
			'cta'     => 'Book a Strategy Call',
		]
	);
	?>

  <?php if ( $team->have_posts() ) : ?>
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'users', 14 ); ?> Leadership</span>
        <h2 class="rh-h2">Meet the people behind the growth</h2>
      </div>
      <div class="rh-serv">
        <?php
		while ( $team->have_posts() ) :
			$team->the_post();
			$role = get_post_meta( get_the_ID(), 'member_role', true ) ?: get_post_meta( get_the_ID(), 'role', true );
			?>
          <div class="rh-serv__card" data-reveal>
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'medium', [ 'class' => 'rh-serv__img', 'loading' => 'lazy' ] ); ?>
            <?php endif; ?>
            <h3 class="rh-serv__t"><?php the_title(); ?></h3>
            <?php if ( $role ) : ?><p class="rh-serv__d"><?php echo esc_html( $role ); ?></p><?php endif; ?>
          </div>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
	seoae_rh_cta_band(
		[
			'title' => 'Want a partner obsessed with your pipeline?',
			'text'  => 'Let’s talk about your market, competitors, and the fastest path to measurable organic growth.',
			'primary_label' => 'Work With Us',
		]
	);
	?>

  <section class="rh-section rh-final">
    <span class="rh-final__glow" aria-hidden="true"></span>
    <div class="rh-wrap" style="position:relative;z-index:2" data-reveal>
      <h2 class="rh-final__title">Let’s build something that ranks — and converts.</h2>
      <div class="rh-final__cta">
        <a class="rh-btn rh-btn--primary rh-btn--xl" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo rh_icon( 'rocket', 18 ); ?> Get Free SEO Audit</a>
        <a class="rh-btn rh-btn--ghost" href="mailto:<?php echo esc_attr( $email ); ?>">Email Us</a>
      </div>
    </div>
  </section>

  <?php seoae_rh_sticky_cta( [ 'label' => 'Work With Us', 'subtext' => 'Talk to a senior strategist about your growth goals' ] ); ?>
</main>
<?php
get_footer();
