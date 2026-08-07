<?php
/**
 * Single Service Template — Conversion-focused enterprise layout
 * SearchEngineOptimization.ae (child theme)
 */

$_svc_faqs = get_post_meta( get_queried_object_id(), 'svc_faqs', true ) ?: [];
if ( ! empty( $_svc_faqs ) ) {
	add_action(
		'wp_head',
		function () use ( $_svc_faqs ) {
			$entities = [];
			foreach ( $_svc_faqs as $faq ) {
				$q = isset( $faq['question'] ) ? trim( $faq['question'] ) : '';
				$a = isset( $faq['answer'] ) ? trim( wp_strip_all_tags( $faq['answer'] ) ) : '';
				if ( $q && $a ) {
					$entities[] = [
						'@type'          => 'Question',
						'name'           => $q,
						'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ],
					];
				}
			}
			if ( $entities ) {
				echo '<script type="application/ld+json">' . wp_json_encode(
					[ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ],
					JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
				) . '</script>' . "\n";
			}
		},
		20
	);
}

get_header();

while ( have_posts() ) :
	the_post();

	$sid          = get_the_ID();
	$title        = get_post_field( 'post_title', $sid );
	$title_short  = trim( preg_replace( '/\s*(?:Services?|Company|Agency)\b.*$/i', '', $title ) ) ?: $title;
	$email        = function_exists( 'seoae_email' ) ? seoae_email() : 'sales@searchengineoptimization.ae';
	$short_desc   = get_post_meta( $sid, 'short_description', true ) ?: get_the_excerpt();
	$category_lbl = get_post_meta( $sid, 'category_label', true ) ?: 'Digital Marketing';
	$hero_badge   = get_post_meta( $sid, 'hero_badge', true ) ?: 'Enterprise Grade';
	$hero_sub     = get_post_meta( $sid, 'hero_badge_sub', true ) ?: 'Results Driven';
	$cta_primary  = get_post_meta( $sid, 'cta_primary_text', true ) ?: 'Get Free SEO Audit';
	$benefits     = get_post_meta( $sid, 'svc_benefits', true ) ?: [];
	$process      = get_post_meta( $sid, 'svc_process', true ) ?: [];
	$technologies = get_post_meta( $sid, 'svc_technologies', true ) ?: [];
	$faqs         = get_post_meta( $sid, 'svc_faqs', true ) ?: [];
	$related_ids  = get_post_meta( $sid, 'svc_related', true ) ?: [];
	$related      = array_filter( array_map( 'get_post', (array) $related_ids ) );
	$visual       = function_exists( 'seoae_rh_visual_url' ) ? seoae_rh_visual_url( $sid ) : '';

	$author_name  = get_post_meta( $sid, 'svc_author_name', true ) ?: 'SearchEngineOptimization.ae Team';
	$author_role  = get_post_meta( $sid, 'svc_author_role', true ) ?: 'SEO Strategists';
	$word_count   = str_word_count( wp_strip_all_tags( get_the_content() ) );
	$reading_time = (int) ( get_post_meta( $sid, 'svc_reading_time', true ) ?: 0 ) ?: max( 1, (int) ceil( $word_count / 220 ) );

	$slug = get_post_field( 'post_name', $sid );
	$icon = 'search';
	$map  = [
		'ai' => 'ai', 'chatgpt' => 'ai', 'geo' => 'ai', 'generative' => 'ai',
		'ppc' => 'ppc', 'ads' => 'ppc', 'social' => 'social', 'design' => 'design',
		'develop' => 'code', 'web-dev' => 'code', 'content' => 'report',
		'link' => 'link', 'local' => 'pin', 'audit' => 'gauge', 'technical' => 'gauge',
		'ecommerce' => 'trend', 'business-profile' => 'pin',
	];
	foreach ( $map as $k => $v ) {
		if ( strpos( $slug, $k ) !== false ) {
			$icon = $v;
			break;
		}
	}

	$benefit_list = [];
	foreach ( (array) $benefits as $b ) {
		$benefit_list[] = is_array( $b ) ? ( $b['benefit'] ?? '' ) : $b;
	}
	$benefit_list = array_values( array_filter( $benefit_list ) );
	if ( ! $benefit_list ) {
		$benefit_list = [
			'Dedicated senior specialists',
			'Technical, content & authority coverage',
			'Transparent weekly reporting',
			'Bilingual Arabic + English strategy',
			'ROI & revenue-focused execution',
			'No lock-in contracts',
		];
	}

	$is_elementor = get_post_meta( $sid, '_elementor_edit_mode', true ) === 'builder';
	$raw_content  = get_post_field( 'post_content', $sid );
	$content_raw  = $is_elementor ? wpautop( do_shortcode( $raw_content ) ) : apply_filters( 'the_content', $raw_content );
	$toc          = [];
	$content_html = preg_replace_callback(
		'/<h2([^>]*)>(.*?)<\/h2>/is',
		function ( $m ) use ( &$toc ) {
			$text = trim( wp_strip_all_tags( $m[2] ) );
			if ( $text === '' ) {
				return $m[0];
			}
			$id   = sanitize_title( $text );
			$base = $id;
			$n    = 2;
			while ( isset( $toc[ $id ] ) ) {
				$id = $base . '-' . $n++;
			}
			$toc[ $id ] = $text;
			$attrs      = $m[1];
			if ( stripos( $attrs, 'id=' ) === false ) {
				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}
			return '<h2' . $attrs . '>' . $m[2] . '</h2>';
		},
		$content_raw
	);
	$show_toc = count( $toc ) >= 3;

	$benefit_icons = [ 'target', 'chart', 'shield', 'users', 'bolt', 'eye', 'coins', 'star' ];
	?>

<main class="rhome rservice">

  <!-- 1. HERO -->
  <section class="rh-hero rs-hero">
    <span class="rh-hero__glow rh-hero__glow--1"></span>
    <span class="rh-hero__glow rh-hero__glow--2"></span>
    <div class="rh-particles" aria-hidden="true"></div>
    <div class="rh-wrap">
      <div class="rs-hero__grid">
        <div data-reveal>
          <div class="rs-crumbs">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> &rsaquo;
            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a> &rsaquo;
            <?php echo esc_html( $title_short ); ?>
          </div>
          <span class="rh-eyebrow"><?php echo rh_icon( 'bolt', 14 ); ?> <?php echo esc_html( $category_lbl ); ?></span>
          <h1 class="rs-hero__title"><?php echo esc_html( $title ); ?></h1>
          <p class="rs-hero__lead"><?php echo esc_html( $short_desc ); ?></p>
          <div class="rs-byline">
            <span class="rs-byline__av"><?php echo esc_html( strtoupper( substr( $author_name, 0, 1 ) ) ); ?></span>
            <div>
              <div class="rs-byline__nm"><?php echo esc_html( $author_name ); ?></div>
              <div class="rs-byline__mt"><?php echo esc_html( $author_role ); ?> &middot; <?php echo esc_html( (string) $reading_time ); ?> min read</div>
            </div>
          </div>
          <div class="rh-hero__cta">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="rh-btn rh-btn--primary rh-btn--xl">
              <?php echo rh_icon( 'rocket', 18 ); ?> <?php echo esc_html( $cta_primary ); ?>
            </a>
            <a href="#service-overview" class="rh-btn rh-btn--ghost">See how it works</a>
          </div>
          <div class="rs-hero__badges">
            <div class="rs-badge"><span><?php echo rh_icon( 'shield', 18 ); ?></span> 100% White-Hat</div>
            <div class="rs-badge"><span><?php echo rh_icon( 'chart', 18 ); ?></span> Data-Driven</div>
            <div class="rs-badge"><span><?php echo rh_icon( 'target', 18 ); ?></span> ROI-Focused</div>
          </div>
        </div>

        <div class="rs-hero__visual" data-reveal data-reveal-delay="2">
          <?php if ( $visual ) : ?>
            <figure class="rs-hero__photo">
              <img src="<?php echo esc_url( $visual ); ?>" alt="<?php echo esc_attr( $title ); ?>" width="720" height="520" decoding="async" fetchpriority="high">
            </figure>
          <?php endif; ?>
          <div class="rs-hero__card">
            <div class="rs-hero__card-top">
              <span class="rs-hero__card-ic"><?php echo rh_icon( $icon, 26 ); ?></span>
              <div>
                <div class="rs-hero__card-nm"><?php echo esc_html( $hero_badge ); ?></div>
                <div class="rs-hero__card-sb"><?php echo esc_html( $hero_sub ); ?></div>
              </div>
            </div>
            <ul>
              <?php foreach ( array_slice( $benefit_list, 0, 5 ) as $b ) : ?>
                <li><?php echo rh_icon( 'check', 18 ); ?> <span><?php echo wp_kses_post( $b ); ?></span></li>
              <?php endforeach; ?>
            </ul>
            <a class="rh-btn rh-btn--primary" style="width:100%;margin-top:18px" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
              <?php echo rh_icon( 'rocket', 18 ); ?> Claim Free Audit
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php seoae_rh_stats_strip(); ?>

  <!-- 2. BENEFITS GRID -->
  <section class="rh-section" id="service-overview">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'star', 14 ); ?> Why this service</span>
        <h2 class="rh-h2">Built to drive pipeline — not vanity metrics</h2>
        <p class="rh-lead">Clear outcomes, senior execution, and reporting your leadership team can trust.</p>
      </div>
      <div class="rh-choose rs-benefit-grid">
        <?php foreach ( array_slice( $benefit_list, 0, 8 ) as $bi => $b ) : ?>
          <div class="rh-feature" data-reveal data-reveal-delay="<?php echo esc_attr( (string) ( $bi % 4 ) ); ?>">
            <div class="rh-feature__ic"><?php echo rh_icon( $benefit_icons[ $bi % count( $benefit_icons ) ], 26 ); ?></div>
            <h3 class="rh-feature__t"><?php echo wp_kses_post( $b ); ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="rs-inline-cta" data-reveal>
        <div>
          <strong>Not sure where to start?</strong>
          <span>Get a free audit mapped to your market, competitors, and goals.</span>
        </div>
        <a class="rh-btn rh-btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo esc_html( $cta_primary ); ?></a>
      </div>
    </div>
  </section>

  <?php
	seoae_rh_cta_band(
		[
			'eyebrow'       => 'Free growth audit',
			'title'         => 'See exactly where ' . $title_short . ' can grow your business',
			'text'          => 'We’ll review rankings, technical gaps, content opportunities, and competitor moves — then give you a prioritised action plan.',
			'primary_label' => $cta_primary,
			'image'         => $visual,
			'variant'       => 'split',
		]
	);
	?>

  <!-- 3. CONTENT -->
  <?php if ( trim( wp_strip_all_tags( (string) $content_raw ) ) ) : ?>
  <section class="rh-section rh-section--tight rh-gray">
    <div class="rh-wrap">
      <div class="rs-body">
        <div class="rs-content">
          <div class="rh-head-left" data-reveal>
            <span class="rh-eyebrow"><?php echo rh_icon( 'report', 14 ); ?> Deep dive</span>
            <h2 class="rh-h2">Everything you need to know about <?php echo esc_html( $title_short ); ?></h2>
          </div>
          <?php if ( $show_toc ) : ?>
          <nav class="rs-toc" aria-label="On this page">
            <div class="rs-toc__t">On this page</div>
            <ol>
              <?php foreach ( $toc as $id => $label ) : ?>
                <li><a href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></a></li>
              <?php endforeach; ?>
            </ol>
          </nav>
          <?php endif; ?>
          <?php echo $content_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
        <aside class="rs-aside">
          <div class="rs-getcard" data-reveal data-reveal-delay="1">
            <h3>Engagement includes</h3>
            <ul>
              <?php foreach ( array_slice( $benefit_list, 0, 7 ) as $b ) : ?>
                <li><?php echo rh_icon( 'check', 18 ); ?><span><?php echo wp_kses_post( $b ); ?></span></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="rs-cta-card" data-reveal data-reveal-delay="2">
            <div class="rs-hero__card-nm" style="margin-bottom:8px">Free growth audit</div>
            <p>Find your biggest <?php echo esc_html( strtolower( $title_short ) ); ?> opportunities in one senior-led review.</p>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="rh-btn rh-btn--primary" style="width:100%">
              <?php echo rh_icon( 'rocket', 18 ); ?> Get Free Audit
            </a>
            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="rh-btn rh-btn--ghost" style="width:100%;margin-top:10px">Email Us</a>
          </div>
          <?php if ( $visual ) : ?>
          <figure class="rs-aside__photo" data-reveal>
            <img src="<?php echo esc_url( $visual ); ?>" alt="" loading="lazy" decoding="async" width="480" height="320">
          </figure>
          <?php endif; ?>
        </aside>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 4. PROCESS -->
  <?php
	$steps = [];
	if ( $process ) {
		$ic = [ 'search', 'gauge', 'target', 'bolt', 'chart', 'trend' ];
		$n  = 0;
		foreach ( array_slice( (array) $process, 0, 6 ) as $st ) {
			$steps[] = [ $st['step_title'] ?? '', $st['step_desc'] ?? '', $ic[ $n % 6 ] ];
			$n++;
		}
	}
	if ( count( $steps ) < 3 ) {
		$steps = [
			[ 'Discover', 'We research your market, competitors and current search performance.', 'search' ],
			[ 'Audit', 'A full technical audit to remove every ranking blocker.', 'gauge' ],
			[ 'Strategy', 'A prioritised roadmap aligned to your business goals.', 'target' ],
			[ 'Execute', 'Senior specialists implement fixes, content and links.', 'bolt' ],
			[ 'Measure', 'Transparent tracking of rankings, traffic and revenue.', 'chart' ],
			[ 'Scale', 'We double down on what converts and compound results.', 'trend' ],
		];
	}
	?>
  <section class="rh-section rh-dark">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'rocket', 14 ); ?> Our process</span>
        <h2 class="rh-h2">A proven framework for <span class="rh-grad-text">real results</span></h2>
        <p class="rh-lead">Transparent, data-driven execution that turns <?php echo esc_html( strtolower( $title_short ) ); ?> into measurable growth.</p>
      </div>
      <div class="rs-steps" data-reveal style="grid-template-columns:repeat(<?php echo count( $steps ); ?>,minmax(0,1fr))">
        <?php foreach ( $steps as $n => $st ) : ?>
          <div class="rs-step">
            <div class="rs-step__n"><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></div>
            <div class="rs-step__ic"><?php echo rh_icon( $st[2], 22 ); ?></div>
            <div class="rs-step__t"><?php echo esc_html( $st[0] ); ?></div>
            <div class="rs-step__d"><?php echo esc_html( $st[1] ); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="rh-dark-cta" data-reveal>
        <a class="rh-btn rh-btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
          <?php echo rh_icon( 'rocket', 18 ); ?> Start with a Free Audit
        </a>
      </div>
    </div>
  </section>

  <?php
	seoae_rh_image_split(
		[
			'eyebrow' => 'Engagement model',
			'title'   => 'Senior-led. Transparent. Built for ROI.',
			'text'    => 'Every engagement is owned by specialists who understand UAE search behaviour, bilingual markets, and revenue outcomes.',
			'points'  => array_slice( $benefit_list, 0, 5 ),
			'image'   => $visual ?: content_url( 'uploads/2026/07/team-meeting.jpg' ),
			'cta'     => $cta_primary,
		]
	);
	?>

  <?php if ( $technologies ) : ?>
  <section class="rh-section rh-section--tight rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'code', 14 ); ?> Tools we use</span>
        <h2 class="rh-h2">Enterprise-grade tooling</h2>
      </div>
      <div class="rs-tech" data-reveal>
        <?php foreach ( $technologies as $t ) : ?>
          <span><?php echo esc_html( is_array( $t ) ? ( $t['tech_name'] ?? '' ) : $t ); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 5. WHY US -->
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'shield', 14 ); ?> Why choose us</span>
        <h2 class="rh-h2">The SEO partner UAE businesses trust</h2>
      </div>
      <?php
		$feats = [
			[ 'users', 'Dedicated SEO Team', 'A senior pod assigned to your account — no juniors, no hand-offs.' ],
			[ 'star', 'Senior Specialists', '8+ years average experience across every discipline.' ],
			[ 'report', 'Weekly Reports', 'Transparent dashboards for rankings, traffic, leads and revenue.' ],
			[ 'brain', 'AI + Human SEO', 'Generative-search expertise paired with human strategy.' ],
			[ 'eye', 'Transparent Process', 'You own your data and always know what we do and why.' ],
			[ 'coins', 'ROI Focused', 'We optimise for pipeline and revenue, not vanity metrics.' ],
		];
		?>
      <div class="rh-choose">
        <?php foreach ( $feats as $fi => $f ) : ?>
          <div class="rh-feature" data-reveal data-reveal-delay="<?php echo esc_attr( (string) ( $fi % 3 ) ); ?>">
            <div class="rh-feature__ic"><?php echo rh_icon( $f[0], 26 ); ?></div>
            <h3 class="rh-feature__t"><?php echo esc_html( $f[1] ); ?></h3>
            <p class="rh-feature__d"><?php echo esc_html( $f[2] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 6. RESULTS -->
  <?php
	$cases = [
		[ 'Luxury Villas Dubai', 'Real Estate', 'LV', '+248%', '+186%', '+320%', 'From page 3 to dominating our core keywords — leads more than tripled in 6 months.', 'M0,110 L45,100 L90,104 L135,80 L180,84 L225,54 L270,44 L320,20', 'Organic Traffic', 'Keyword Growth', 'Lead Growth' ],
		[ 'Aster Dental Clinic', 'Healthcare', 'AD', '+210%', '+175%', '+290%', 'Bilingual local SEO put every clinic in the map pack — bookings up 290%.', 'M0,112 L45,104 L90,108 L135,86 L180,70 L225,60 L270,40 L320,24', 'Organic Traffic', 'Keyword Growth', 'Revenue Growth' ],
	];
	?>
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'chart', 14 ); ?> Proven results</span>
        <h2 class="rh-h2">Real results for <span class="rh-grad-text">real businesses</span></h2>
      </div>
      <div class="rh-cases">
        <?php foreach ( $cases as $ci => $c ) : ?>
          <article class="rh-case" data-reveal data-reveal-delay="<?php echo esc_attr( (string) $ci ); ?>">
            <div class="rh-case__head">
              <div class="rh-case__client">
                <div class="rh-case__logo"><?php echo esc_html( $c[2] ); ?></div>
                <div>
                  <div class="rh-case__name"><?php echo esc_html( $c[0] ); ?></div>
                  <div class="rh-case__sector"><?php echo esc_html( $c[1] ); ?></div>
                </div>
              </div>
              <span class="rh-case__badge"><?php echo esc_html( $c[3] ); ?> traffic</span>
            </div>
            <div class="rh-case__chart">
              <svg viewBox="0 0 320 130" preserveAspectRatio="none">
                <defs><linearGradient id="rsCase<?php echo (int) $ci; ?>" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="rgba(28,200,255,.30)"/><stop offset="1" stop-color="rgba(28,200,255,0)"/></linearGradient></defs>
                <path d="<?php echo esc_attr( $c[7] ); ?> L320,130 L0,130 Z" fill="url(#rsCase<?php echo (int) $ci; ?>)"/>
                <path d="<?php echo esc_attr( $c[7] ); ?>" fill="none" stroke="#1CC8FF" stroke-width="3" stroke-linecap="round" class="rh-chart__line"/>
              </svg>
            </div>
            <div class="rh-case__metrics">
              <div class="rh-cm"><b><?php echo esc_html( $c[3] ); ?></b><span><?php echo esc_html( $c[8] ); ?></span></div>
              <div class="rh-cm"><b><?php echo esc_html( $c[4] ); ?></b><span><?php echo esc_html( $c[9] ); ?></span></div>
              <div class="rh-cm"><b><?php echo esc_html( $c[5] ); ?></b><span><?php echo esc_html( $c[10] ); ?></span></div>
            </div>
            <p class="rh-case__quote">&ldquo;<?php echo esc_html( $c[6] ); ?>&rdquo;</p>
            <div class="rh-case__foot">
              <a class="rh-btn rh-btn--outline" href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>">View Case Study <?php echo rh_icon( 'arrow', 16 ); ?></a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php
	seoae_rh_cta_band(
		[
			'eyebrow'         => 'Next step',
			'title'           => 'Let’s build your ' . $title_short . ' growth plan',
			'text'            => 'Book a free strategy call. We’ll show you where the biggest opportunities are and what to do first.',
			'primary_label'   => $cta_primary,
			'secondary_label' => 'Talk to an expert',
			'variant'         => 'band',
		]
	);
	?>

  <!-- 7. RELATED -->
  <?php
	$others = $related;
	if ( ! $others ) {
		$others = get_posts(
			[
				'post_type'      => 'service',
				'posts_per_page' => 4,
				'post__not_in'   => [ $sid ],
				'orderby'        => 'rand',
			]
		);
	}
	if ( $others ) :
		?>
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'bolt', 14 ); ?> Explore more</span>
        <h2 class="rh-h2">Related services</h2>
      </div>
      <div class="rh-serv">
        <?php
		$oi = 0;
		foreach ( array_slice( $others, 0, 4 ) as $svc ) :
			$oi++;
			$od  = get_post_meta( $svc->ID, 'short_description', true ) ?: wp_trim_words( wp_strip_all_tags( $svc->post_content ), 18 );
			$oic = [ 'search', 'ai', 'ppc', 'social', 'design', 'code' ][ ( $oi - 1 ) % 6 ];
			$img = function_exists( 'seoae_rh_visual_url' ) ? seoae_rh_visual_url( $svc->ID ) : '';
			?>
          <a class="rh-serv__card rh-serv__card--media" href="<?php echo esc_url( get_permalink( $svc ) ); ?>" data-reveal data-reveal-delay="<?php echo esc_attr( (string) ( ( $oi - 1 ) % 4 ) ); ?>">
            <?php if ( $img ) : ?><img class="rh-serv__img" src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" decoding="async"><?php endif; ?>
            <div class="rh-serv__ic"><?php echo rh_icon( $oic, 26 ); ?></div>
            <h3 class="rh-serv__t"><?php echo esc_html( get_the_title( $svc ) ); ?></h3>
            <p class="rh-serv__d"><?php echo esc_html( wp_trim_words( $od, 16 ) ); ?></p>
            <span class="rh-serv__link">Learn more <?php echo rh_icon( 'arrow', 16 ); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
	<?php endif; ?>

  <!-- 8. FAQ -->
  <?php if ( $faqs ) : ?>
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'report', 14 ); ?> FAQ</span>
        <h2 class="rh-h2">Frequently asked questions</h2>
      </div>
      <div class="rh-faq">
        <?php foreach ( $faqs as $qi => $faq ) : ?>
          <div class="rh-acc<?php echo 0 === $qi ? ' is-open' : ''; ?>" data-reveal>
            <button class="rh-acc__q" type="button"><?php echo esc_html( $faq['question'] ?? '' ); ?> <?php echo rh_icon( 'plus', 22 ); ?></button>
            <div class="rh-acc__a"<?php echo 0 === $qi ? ' style="max-height:400px"' : ''; ?>><p><?php echo wp_kses_post( $faq['answer'] ?? '' ); ?></p></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 9. FINAL CTA -->
  <section class="rh-section rh-final">
    <span class="rh-final__glow" aria-hidden="true"></span>
    <div class="rh-wrap" style="position:relative;z-index:2">
      <div data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon( 'rocket', 14 ); ?> Let’s grow</span>
        <h2 class="rh-final__title">Ready to grow with <?php echo esc_html( $title_short ); ?>?</h2>
        <p class="rh-lead" style="margin:0 auto;color:#AFC0E8">Book a free strategy call. We’ll audit your current performance and show you exactly where the biggest opportunities are.</p>
        <div class="rh-final__cta">
          <a class="rh-btn rh-btn--primary rh-btn--xl" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
            <?php echo rh_icon( 'rocket', 18 ); ?> <?php echo esc_html( $cta_primary ); ?>
          </a>
          <a class="rh-btn rh-btn--ghost" href="mailto:<?php echo esc_attr( $email ); ?>">Talk to an SEO Expert</a>
        </div>
      </div>
    </div>
  </section>

  <?php
	seoae_rh_sticky_cta(
		[
			'label'   => $cta_primary,
			'subtext' => 'Free senior review for your ' . $title_short . ' opportunity',
		]
	);
	?>

</main>

	<?php
endwhile;
get_footer();
