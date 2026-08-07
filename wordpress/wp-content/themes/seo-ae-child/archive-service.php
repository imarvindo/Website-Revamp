<?php
/**
 * Service CPT archive — conversion-focused redesign.
 */
get_header();

$services = function_exists( 'seoae_get_services' ) ? seoae_get_services() : [];
$email    = function_exists( 'seoae_email' ) ? seoae_email() : 'sales@searchengineoptimization.ae';
$hero_img = content_url( 'uploads/2026/07/seo-analytics.jpg' );
?>
<main class="rhome rservice">
  <section class="rh-hero rs-hero">
    <span class="rh-hero__glow rh-hero__glow--1"></span>
    <span class="rh-hero__glow rh-hero__glow--2"></span>
    <div class="rh-wrap">
      <div class="rs-hero__grid">
        <div data-reveal>
          <span class="rh-eyebrow"><?php echo rh_icon( 'bolt', 14 ); ?> Our services</span>
          <h1 class="rs-hero__title">Full-spectrum digital marketing built for <span class="rh-grad-text">UAE revenue growth</span></h1>
          <p class="rs-hero__lead">From technical SEO to paid media and AI search visibility — every service is designed to generate qualified demand, not vanity metrics.</p>
          <div class="rh-hero__cta">
            <a class="rh-btn rh-btn--primary rh-btn--xl" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo rh_icon( 'rocket', 18 ); ?> Get Free SEO Audit</a>
            <a class="rh-btn rh-btn--ghost" href="#all-services">Browse services</a>
          </div>
        </div>
        <div class="rs-hero__visual" data-reveal data-reveal-delay="2">
          <figure class="rs-hero__photo"><img src="<?php echo esc_url( $hero_img ); ?>" alt="SEO analytics dashboard" width="720" height="520" decoding="async" fetchpriority="high"></figure>
        </div>
      </div>
    </div>
  </section>

  <?php seoae_rh_stats_strip(); ?>

  <section class="rh-section" id="all-services">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'target', 14 ); ?> What we do</span>
        <h2 class="rh-h2">Services engineered for measurable ROI</h2>
        <p class="rh-lead">Pick a focus area — or ask us to recommend the fastest path to pipeline.</p>
      </div>
      <div class="rh-serv">
        <?php
		$i = 0;
		foreach ( $services as $svc ) :
			$i++;
			$desc = get_post_meta( $svc->ID, 'short_description', true ) ?: wp_trim_words( wp_strip_all_tags( $svc->post_content ), 18 );
			$img  = seoae_rh_visual_url( $svc->ID );
			$icons = [ 'search', 'ai', 'ppc', 'social', 'design', 'code', 'gauge', 'pin' ];
			?>
          <a class="rh-serv__card rh-serv__card--media" href="<?php echo esc_url( get_permalink( $svc ) ); ?>" data-reveal data-reveal-delay="<?php echo esc_attr( (string) ( ( $i - 1 ) % 4 ) ); ?>">
            <img class="rh-serv__img" src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" decoding="async">
            <div class="rh-serv__ic"><?php echo rh_icon( $icons[ ( $i - 1 ) % count( $icons ) ], 26 ); ?></div>
            <h3 class="rh-serv__t"><?php echo esc_html( get_the_title( $svc ) ); ?></h3>
            <p class="rh-serv__d"><?php echo esc_html( wp_trim_words( $desc, 16 ) ); ?></p>
            <span class="rh-serv__link">Explore service <?php echo rh_icon( 'arrow', 16 ); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php
	seoae_rh_cta_band(
		[
			'title' => 'Not sure which service you need?',
			'text'  => 'Book a free audit. We’ll recommend the highest-ROI mix for your market, competition, and goals.',
		]
	);
	?>

  <section class="rh-section rh-dark">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'rocket', 14 ); ?> How we work</span>
        <h2 class="rh-h2">A process built for results</h2>
      </div>
      <div class="rs-steps" data-reveal style="grid-template-columns:repeat(4,minmax(0,1fr))">
        <?php
		$steps = [
			[ '01', 'Discover', 'Deep audit of market, competitors, and current performance.', 'search' ],
			[ '02', 'Strategy', 'Prioritised roadmap with clear KPIs and ownership.', 'target' ],
			[ '03', 'Execute', 'Senior specialists ship technical, content, and authority work.', 'bolt' ],
			[ '04', 'Scale', 'Measure, refine, and compound what drives revenue.', 'trend' ],
		];
		foreach ( $steps as $st ) :
			?>
          <div class="rs-step">
            <div class="rs-step__n"><?php echo esc_html( $st[0] ); ?></div>
            <div class="rs-step__ic"><?php echo rh_icon( $st[3], 22 ); ?></div>
            <div class="rs-step__t"><?php echo esc_html( $st[1] ); ?></div>
            <div class="rs-step__d"><?php echo esc_html( $st[2] ); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="rh-section rh-final">
    <span class="rh-final__glow" aria-hidden="true"></span>
    <div class="rh-wrap" style="position:relative;z-index:2" data-reveal>
      <span class="rh-eyebrow"><?php echo rh_icon( 'rocket', 14 ); ?> Let’s grow</span>
      <h2 class="rh-final__title">Ready to turn digital marketing into revenue?</h2>
      <p class="rh-lead" style="margin:0 auto;color:#AFC0E8">Get a free audit with clear opportunities and a recommended service mix.</p>
      <div class="rh-final__cta">
        <a class="rh-btn rh-btn--primary rh-btn--xl" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo rh_icon( 'rocket', 18 ); ?> Get Free SEO Audit</a>
        <a class="rh-btn rh-btn--ghost" href="mailto:<?php echo esc_attr( $email ); ?>">Email Our Team</a>
      </div>
    </div>
  </section>

  <?php seoae_rh_sticky_cta(); ?>
</main>
<?php
get_footer();
