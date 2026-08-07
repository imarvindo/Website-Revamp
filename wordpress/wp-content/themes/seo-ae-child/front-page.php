<?php
/**
 * Front Page — Enterprise Homepage Redesign
 * SearchEngineOptimization.ae
 *
 * Self-contained premium homepage. Styles: assets/redesign-home.css
 * Interactions: assets/redesign-home.js (enqueued in functions.php on the front page).
 */

get_header();

$email = function_exists( 'seoae_email' ) ? seoae_email() : 'sales@searchengineoptimization.ae';

/* Local inline-SVG icon helper (kept theme-local to avoid collisions). */
if ( ! function_exists( 'rh_icon' ) ) {
	function rh_icon( $name, $s = 24 ) {
		$p = [
			'search'   => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
			'gauge'    => '<path d="M12 14 4 6"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
			'target'   => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
			'rocket'   => '<path d="M4.5 16.5 3 21l4.5-1.5"/><path d="M15 9a3 3 0 1 0-3 3"/><path d="M9 15c-2 0-5 2-6 6 4-1 6-4 6-6z"/><path d="M13 19 22 10c1-1 1-6 1-8-2 0-7 0-8 1L6 12z"/>',
			'chart'    => '<path d="M3 3v18h18"/><path d="m7 14 3-4 3 3 5-7"/>',
			'trend'    => '<path d="m3 17 6-6 4 4 8-8"/><path d="M17 7h4v4"/>',
			'ai'       => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3"/><rect x="7" y="7" width="10" height="10" rx="3"/><circle cx="12" cy="12" r="1.5"/>',
			'ppc'      => '<path d="M3 3l7 17 2-7 7-2z"/>',
			'social'   => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/>',
			'design'   => '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 9h18M8 4v5"/>',
			'code'     => '<path d="m8 8-4 4 4 4M16 8l4 4-4 4M13 6l-2 12"/>',
			'link'     => '<path d="M10 13a5 5 0 0 0 7 0l2-2a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-2 2a5 5 0 0 0 7 7l1-1"/>',
			'check'    => '<path d="M20 6 9 17l-5-5"/>',
			'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
			'arrowdr'  => '<path d="M7 7h10v10M7 17 17 7"/>',
			'shield'   => '<path d="M12 3 4 6v6c0 5 3.5 7.5 8 9 4.5-1.5 8-4 8-9V6z"/><path d="m9 12 2 2 4-4"/>',
			'users'    => '<circle cx="9" cy="8" r="3"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M16 6a3 3 0 0 1 0 6M21 20a6 6 0 0 0-4-5.6"/>',
			'report'   => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/>',
			'brain'    => '<path d="M9 3a3 3 0 0 0-3 3 3 3 0 0 0-1 5 3 3 0 0 0 2 5 3 3 0 0 0 4 1V4a3 3 0 0 0-2-1zM15 3a3 3 0 0 1 3 3 3 3 0 0 1 1 5 3 3 0 0 1-2 5 3 3 0 0 1-4 1"/>',
			'eye'      => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>',
			'coins'    => '<ellipse cx="8" cy="6" rx="5" ry="2.5"/><path d="M3 6v6c0 1.4 2.2 2.5 5 2.5"/><ellipse cx="16" cy="14" rx="5" ry="2.5"/><path d="M11 14v4c0 1.4 2.2 2.5 5 2.5s5-1.1 5-2.5v-4"/>',
			'bolt'     => '<path d="M13 2 4 14h6l-1 8 9-12h-6z"/>',
			'plus'     => '<path d="M12 5v14M5 12h14"/>',
			'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
			'pin'      => '<path d="M12 21s7-6.5 7-11a7 7 0 1 0-14 0c0 4.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
			'star'     => '<path d="m12 3 2.9 6 6.6.9-4.8 4.6 1.2 6.5L12 18.6 6.1 21.9l1.2-6.5L2.5 9.9 9.1 9z"/>',
			'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		];
		$d = isset( $p[ $name ] ) ? $p[ $name ] : $p['check'];
		return '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
	}
}
?>

<main class="rhome">

  <!-- ============================ 1. HERO ============================ -->
  <section class="rh-hero">
    <span class="rh-hero__glow rh-hero__glow--1"></span>
    <span class="rh-hero__glow rh-hero__glow--2"></span>
    <div class="rh-particles" aria-hidden="true"></div>
    <div class="rh-wrap">
      <div class="rh-hero__grid">
        <div class="rh-hero__copy" data-reveal>
          <span class="rh-eyebrow"><?php echo rh_icon('bolt',14); ?> UAE&rsquo;s #1 Enterprise SEO Agency</span>
          <h1 class="rh-hero__title">SEO That Generates<br><span class="rh-grad-text">Revenue,</span> Not Just Rankings</h1>
          <p class="rh-hero__lead">We combine enterprise-grade strategy with obsessive execution &mdash; turning search visibility into pipeline, leads, and measurable revenue for ambitious UAE businesses.</p>
          <div class="rh-hero__cta">
            <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="rh-btn rh-btn--primary"><?php echo rh_icon('rocket',18); ?> Get Free SEO Audit</a>
            <a href="<?php echo esc_url( home_url('/case-studies/') ); ?>" class="rh-btn rh-btn--ghost">View Case Studies</a>
          </div>
          <div class="rh-hero__trust">
            <div class="rh-trust__item">
              <span class="rh-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
              <span class="rh-trust__label">4.9 Google Rating</span>
            </div>
            <div class="rh-trust__item"><span class="rh-trust__num" data-count="345" data-suffix="+">0</span><span class="rh-trust__label">Clients Served</span></div>
            <div class="rh-trust__item"><span class="rh-trust__num" data-count="206" data-prefix="+" data-suffix="%">0</span><span class="rh-trust__label">Avg. Organic Growth</span></div>
            <div class="rh-trust__item"><span class="rh-trust__num" data-count="99" data-suffix="%">0</span><span class="rh-trust__label">Client Retention</span></div>
          </div>
        </div>

        <div class="rh-dash" data-reveal data-reveal-delay="2">
          <div class="rh-dash__float rh-dash__float--a">
            <span class="rh-dash__ic" style="background:var(--grad-cyan)"><?php echo rh_icon('trend',18); ?></span>
            <span>+318% Traffic<small>Last 6 months</small></span>
          </div>
          <div class="rh-dash__float rh-dash__float--b">
            <span class="rh-dash__ic" style="background:#35e08e"><?php echo rh_icon('target',18); ?></span>
            <span>#1 Rankings<small>842 keywords</small></span>
          </div>
          <div class="rh-dash__panel">
            <div class="rh-dash__top">
              <span class="rh-dash__brand"><span class="rh-dash__dot"></span> Growth Dashboard</span>
              <span class="rh-dash__pill">LIVE</span>
            </div>
            <div class="rh-dash__row">
              <div class="rh-kpi"><div class="rh-kpi__v">12.6M</div><div class="rh-kpi__l">Organic Clicks</div><div class="rh-kpi__up">&#9650; 41%</div></div>
              <div class="rh-kpi"><div class="rh-kpi__v">34.5K</div><div class="rh-kpi__l">Keywords Top 3</div><div class="rh-kpi__up">&#9650; 18%</div></div>
              <div class="rh-kpi"><div class="rh-kpi__v">$8.7M</div><div class="rh-kpi__l">Revenue Influenced</div><div class="rh-kpi__up">&#9650; 63%</div></div>
            </div>
            <div class="rh-chart">
              <svg viewBox="0 0 320 120" preserveAspectRatio="none">
                <defs>
                  <linearGradient id="rhGrad" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0" stop-color="#1CC8FF"/><stop offset="1" stop-color="#6E8BFF"/>
                  </linearGradient>
                  <linearGradient id="rhFillG" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0" stop-color="rgba(28,200,255,.35)"/><stop offset="1" stop-color="rgba(28,200,255,0)"/>
                  </linearGradient>
                </defs>
                <path d="M0,100 L40,92 L80,96 L120,74 L160,78 L200,52 L240,44 L280,26 L320,14 L320,120 L0,120 Z" fill="url(#rhFillG)"/>
                <path class="rh-chart__line" d="M0,100 L40,92 L80,96 L120,74 L160,78 L200,52 L240,44 L280,26 L320,14"/>
              </svg>
            </div>
            <div class="rh-logos-inline">
              <span class="rh-logo-chip">Google Analytics</span>
              <span class="rh-logo-chip">Search Console</span>
              <span class="rh-logo-chip">Semrush</span>
              <span class="rh-logo-chip">Ahrefs</span>
              <span class="rh-logo-chip">ChatGPT</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ 2. LOGO MARQUEE ============================ -->
  <section class="rh-marquee">
    <div class="rh-wrap">
      <p class="rh-marquee__label">Trusted by leading UAE businesses</p>
    </div>
    <?php $brands = ['EMAAR','DAMAC','AZIZI','DP WORLD','NAKHEEL','MERAAS','Al-Futtaim','ALDAR','Majid Al Futtaim']; ?>
    <div class="rh-marquee__track">
      <?php for ( $r = 0; $r < 2; $r++ ) : ?>
        <?php foreach ( $brands as $b ) : ?>
          <span class="rh-marquee__item"><?php echo esc_html( $b ); ?></span>
        <?php endforeach; ?>
      <?php endfor; ?>
    </div>
  </section>

  <!-- ============================ 3. STATS ============================ -->
  <section class="rh-section rh-section--tight rh-gray">
    <div class="rh-wrap">
      <div class="rh-stats">
        <div class="rh-stat" data-reveal><div class="rh-stat__num"><span data-count="206" data-prefix="+" data-suffix="%">0</span></div><div class="rh-stat__label">Average Organic Growth</div></div>
        <div class="rh-stat" data-reveal data-reveal-delay="1"><div class="rh-stat__num"><span data-count="345" data-suffix="+">0</span></div><div class="rh-stat__label">UAE Businesses Served</div></div>
        <div class="rh-stat" data-reveal data-reveal-delay="2"><div class="rh-stat__num"><span data-count="12" data-suffix="M+">0</span></div><div class="rh-stat__label">Organic Clicks Generated</div></div>
        <div class="rh-stat" data-reveal data-reveal-delay="3"><div class="rh-stat__num"><span data-count="99" data-suffix="%">0</span></div><div class="rh-stat__label">Client Retention Rate</div></div>
      </div>
    </div>
  </section>

  <!-- ============================ 4. WHY BUSINESSES FAIL ============================ -->
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('gauge',14); ?> Why most SEO fails</span>
        <h2 class="rh-h2">Three reasons UAE businesses <span class="rh-grad-text">waste budget</span> on SEO</h2>
        <p class="rh-lead">Most agencies chase vanity rankings. We engineer a system that compounds into revenue.</p>
      </div>
      <div class="rh-fail">
        <div class="rh-fail__card" data-reveal><div class="rh-fail__ic"><?php echo rh_icon('code',24); ?></div><div class="rh-fail__t">Poor Technical SEO</div><p class="rh-fail__d">Slow sites, crawl errors, and broken structured data quietly cap your rankings before content even matters.</p></div>
        <div class="rh-fail__card" data-reveal data-reveal-delay="1"><div class="rh-fail__ic"><?php echo rh_icon('report',24); ?></div><div class="rh-fail__t">Weak Content Strategy</div><p class="rh-fail__d">Thin, low-intent content that never maps to how UAE buyers actually search &mdash; so it never converts.</p></div>
        <div class="rh-fail__card" data-reveal data-reveal-delay="2"><div class="rh-fail__ic"><?php echo rh_icon('target',24); ?></div><div class="rh-fail__t">No Clear Strategy</div><p class="rh-fail__d">No roadmap, no tracking, no accountability. Effort is spent, but revenue never moves.</p></div>
        <div class="rh-fail__arrow" data-reveal data-reveal-delay="2"><?php echo rh_icon('arrow',44); ?></div>
        <div class="rh-fail__sol" data-reveal data-reveal-delay="3"><div class="rh-fail__ic"><?php echo rh_icon('shield',24); ?></div><div class="rh-fail__t">Our SEO Growth Framework</div><p class="rh-fail__d">A data-driven, 6-step system that fixes foundations, wins intent coverage, and scales what converts.</p></div>
      </div>
    </div>
  </section>

  <!-- ============================ 5. SERVICES ============================ -->
  <?php
  $svc_icons = ['search','ai','ppc','social','design','code','link','trend'];
  $svc_fallback = [
    ['Search Engine Optimization','Technical + content SEO that earns durable page-one rankings for high-intent UAE keywords.',['Technical SEO & Core Web Vitals','On-page & content optimisation','Authority link building']],
    ['AI Search Optimization','Get cited by ChatGPT, Google AI Overviews, Perplexity and Copilot with entity-first SEO.',['Structured data & entities','Answer-ready content','Generative visibility tracking']],
    ['PPC & Google Ads','High-ROI paid search and shopping campaigns engineered for qualified UAE leads.',['Search, Shopping & Performance Max','Conversion tracking','Landing-page CRO']],
    ['Social Media Marketing','Bilingual social strategy that builds authority and converts followers into customers.',['Instagram, LinkedIn, TikTok','Arabic + English content','Paid social management']],
    ['Web Design','Conversion-optimised, lightning-fast websites that turn visitors into enquiries.',['UX & conversion design','Core Web Vitals friendly','Mobile-first build']],
    ['Web Development','WordPress, React and custom builds engineered for speed, scale and SEO.',['Custom & headless builds','API & integrations','Speed optimisation']],
  ];
  $services = function_exists( 'seoae_get_services' ) ? seoae_get_services( 8 ) : [];
  ?>
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('bolt',14); ?> What we do</span>
        <h2 class="rh-h2">Enterprise digital marketing, <span class="rh-grad-text">built to scale</span></h2>
        <p class="rh-lead">A full-stack growth team covering every channel that moves revenue &mdash; under one roof.</p>
      </div>
      <div class="rh-serv">
        <?php if ( $services ) : $i = 0; foreach ( $services as $svc ) : $i++;
            $title = get_the_title( $svc );
            $desc  = get_post_meta( $svc->ID, 'short_description', true ) ?: wp_trim_words( wp_strip_all_tags( $svc->post_content ), 20 );
            $link  = get_permalink( $svc );
            $ic    = $svc_icons[ ($i-1) % count($svc_icons) ];
            $fb    = $svc_fallback[ ($i-1) % count($svc_fallback) ];
            $list  = $fb[2];
        ?>
          <div class="rh-serv__card" data-reveal data-reveal-delay="<?php echo esc_attr( ($i-1) % 4 ); ?>">
            <div class="rh-serv__ic"><?php echo rh_icon( $ic, 26 ); ?></div>
            <h3 class="rh-serv__t"><?php echo esc_html( $title ); ?></h3>
            <p class="rh-serv__d"><?php echo esc_html( wp_trim_words( $desc, 22 ) ); ?></p>
            <ul class="rh-serv__list">
              <?php foreach ( $list as $li ) : ?><li><?php echo rh_icon('check',17); ?><span><?php echo esc_html( $li ); ?></span></li><?php endforeach; ?>
            </ul>
            <a class="rh-serv__link" href="<?php echo esc_url( $link ); ?>">Learn more <?php echo rh_icon('arrow',16); ?></a>
          </div>
        <?php endforeach; else : foreach ( $svc_fallback as $i => $fb ) : ?>
          <div class="rh-serv__card" data-reveal data-reveal-delay="<?php echo esc_attr( $i % 4 ); ?>">
            <div class="rh-serv__ic"><?php echo rh_icon( $svc_icons[ $i % count($svc_icons) ], 26 ); ?></div>
            <h3 class="rh-serv__t"><?php echo esc_html( $fb[0] ); ?></h3>
            <p class="rh-serv__d"><?php echo esc_html( $fb[1] ); ?></p>
            <ul class="rh-serv__list"><?php foreach ( $fb[2] as $li ) : ?><li><?php echo rh_icon('check',17); ?><span><?php echo esc_html( $li ); ?></span></li><?php endforeach; ?></ul>
            <a class="rh-serv__link" href="<?php echo esc_url( home_url('/services/') ); ?>">Learn more <?php echo rh_icon('arrow',16); ?></a>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 6. INDUSTRIES ============================ -->
  <section class="rh-section rh-section--tight">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('users',14); ?> Industries we serve</span>
        <h2 class="rh-h2">Sector-specific SEO for every UAE industry</h2>
      </div>
      <?php $inds = [
        ['Healthcare','shield'],['Legal','report'],['Real Estate','pin'],['Construction','design'],
        ['Hospitality','star'],['Education','brain'],['Finance','coins'],['Automotive','bolt'],
        ['E-commerce','coins'],['Retail','target'],
      ]; ?>
      <div class="rh-pills" data-reveal>
        <?php foreach ( $inds as $in ) : ?>
          <a class="rh-pill" href="<?php echo esc_url( home_url('/industries/') ); ?>"><?php echo rh_icon( $in[1], 20 ); ?> <?php echo esc_html( $in[0] ); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 7. INTERACTIVE UAE MAP ============================ -->
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('pin',14); ?> Nationwide coverage</span>
        <h2 class="rh-h2">We rank businesses across <span class="rh-grad-text">every emirate</span></h2>
        <p class="rh-lead">Tap a city to see the growth we&rsquo;ve driven for clients on the ground.</p>
      </div>
      <div class="rh-map">
        <div class="rh-map__stage" data-reveal>
          <svg class="rh-map__svg" viewBox="0 0 520 380" role="img" aria-label="Map of the United Arab Emirates">
            <path class="rh-map__region" d="M60 250 L70 180 L120 120 L200 90 L270 70 L340 60 L420 80 L470 130 L480 190 L440 210 L430 260 L470 300 L400 320 L320 330 L250 340 L170 330 L110 300 Z"/>
            <!-- pins -->
            <g class="rh-pin is-active" data-city-key="dubai">
              <circle class="rh-pin__halo" cx="300" cy="215" r="10"/><circle class="rh-pin__dot" cx="300" cy="215" r="7"/>
              <text class="rh-pin__label" x="312" y="219">Dubai</text>
            </g>
            <g class="rh-pin" data-city-key="abu-dhabi">
              <circle class="rh-pin__halo" cx="215" cy="255" r="10"/><circle class="rh-pin__dot" cx="215" cy="255" r="7"/>
              <text class="rh-pin__label" x="150" y="259">Abu Dhabi</text>
            </g>
            <g class="rh-pin" data-city-key="sharjah">
              <circle class="rh-pin__halo" cx="330" cy="190" r="10"/><circle class="rh-pin__dot" cx="330" cy="190" r="7"/>
              <text class="rh-pin__label" x="342" y="194">Sharjah</text>
            </g>
            <g class="rh-pin" data-city-key="ajman">
              <circle class="rh-pin__halo" cx="350" cy="170" r="9"/><circle class="rh-pin__dot" cx="350" cy="170" r="6"/>
              <text class="rh-pin__label" x="362" y="166">Ajman</text>
            </g>
            <g class="rh-pin" data-city-key="rak">
              <circle class="rh-pin__halo" cx="390" cy="130" r="9"/><circle class="rh-pin__dot" cx="390" cy="130" r="6"/>
              <text class="rh-pin__label" x="402" y="126">Ras Al Khaimah</text>
            </g>
            <g class="rh-pin" data-city-key="fujairah">
              <circle class="rh-pin__halo" cx="440" cy="185" r="9"/><circle class="rh-pin__dot" cx="440" cy="185" r="6"/>
              <text class="rh-pin__label" x="452" y="189">Fujairah</text>
            </g>
          </svg>
        </div>
        <div class="rh-map__panel" data-reveal data-reveal-delay="2">
          <div class="rh-map__city" data-city>Dubai</div>
          <div class="rh-map__tag" data-tag>High-intent commercial market</div>
          <div class="rh-map__metrics">
            <div class="rh-map__metric"><b data-traffic>+318%</b><span>Organic traffic</span></div>
            <div class="rh-map__metric"><b data-keywords>840+</b><span>Keywords ranked</span></div>
            <div class="rh-map__metric"><b data-clients>120+</b><span>Clients served</span></div>
            <div class="rh-map__metric"><b data-roi>+206%</b><span>Average ROI</span></div>
          </div>
          <p class="rh-map__quote" data-quote>&ldquo;From page 3 to the map pack and #1 organic for our core money keywords in 5 months.&rdquo;</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ 8. SIX-STEP TIMELINE ============================ -->
  <section class="rh-section rh-dark">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('rocket',14); ?> Our methodology</span>
        <h2 class="rh-h2">The 6-step growth framework</h2>
        <p class="rh-lead">A proven, transparent process that compounds organic visibility into revenue &mdash; scroll to follow the journey.</p>
      </div>
      <?php $steps = [
        ['Discover','search','We deep-dive into your market, competitors, and current search performance to find the fastest paths to revenue.'],
        ['Technical Audit','gauge','A full crawl of your site &mdash; speed, indexation, structured data and Core Web Vitals &mdash; to remove every ranking blocker.'],
        ['SEO Strategy','target','A prioritised roadmap mapping high-intent keywords, content clusters and authority plays to your business goals.'],
        ['Execution','bolt','Senior specialists implement technical fixes, publish conversion-focused content, and build authoritative links.'],
        ['Measure','chart','Transparent reporting on rankings, traffic, leads and revenue &mdash; with weekly visibility into progress.'],
        ['Scale Growth','trend','We double down on what converts, expand coverage, and compound results month over month.'],
      ]; ?>
      <div class="rh-timeline">
        <div class="rh-timeline__spine"></div>
        <div class="rh-timeline__fill"></div>
        <?php foreach ( $steps as $n => $st ) : ?>
          <div class="rh-step<?php echo $n === 0 ? ' is-active' : ''; ?>">
            <div class="rh-step__node"><div class="rh-step__num"><?php echo sprintf('%02d', $n + 1); ?></div></div>
            <div class="rh-step__card">
              <div class="rh-step__head"><span class="rh-step__ic"><?php echo rh_icon( $st[1], 22 ); ?></span><h3 class="rh-step__t"><?php echo esc_html( $st[0] ); ?></h3></div>
              <p class="rh-step__d"><?php echo esc_html( $st[2] ); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 9. FEATURED CASE STUDIES ============================ -->
  <?php
  $cases = [
    ['Luxury Villas Dubai','Real Estate','LV','+248%','+186%','+320%','From page 3 to dominating "off-plan villas Dubai" &mdash; lead volume more than tripled in 6 months.',
     'M0,110 L45,100 L90,104 L135,80 L180,84 L225,54 L270,44 L320,20', 'Organic Traffic','Keyword Growth','Lead Growth'],
    ['Aster Dental Clinic','Healthcare','AD','+210%','+175%','+290%','Bilingual local SEO put every clinic in the map pack &mdash; new patient bookings up 290%.',
     'M0,112 L45,104 L90,108 L135,86 L180,70 L225,60 L270,40 L320,24', 'Organic Traffic','Keyword Growth','Revenue Growth'],
  ];
  ?>
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('chart',14); ?> Proven results</span>
        <h2 class="rh-h2">Featured <span class="rh-grad-text">case studies</span></h2>
        <p class="rh-lead">Real UAE brands, real revenue &mdash; not vanity metrics.</p>
      </div>
      <div class="rh-cases">
        <?php foreach ( $cases as $ci => $c ) : ?>
          <article class="rh-case" data-reveal data-reveal-delay="<?php echo esc_attr( $ci ); ?>">
            <div class="rh-case__head">
              <div class="rh-case__client">
                <div class="rh-case__logo"><?php echo esc_html( $c[2] ); ?></div>
                <div><div class="rh-case__name"><?php echo esc_html( $c[0] ); ?></div><div class="rh-case__sector"><?php echo esc_html( $c[1] ); ?></div></div>
              </div>
              <span class="rh-case__badge"><?php echo esc_html( $c[3] ); ?> traffic</span>
            </div>
            <div class="rh-case__chart">
              <svg viewBox="0 0 320 130" preserveAspectRatio="none">
                <defs><linearGradient id="rhCase<?php echo $ci; ?>" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="rgba(28,200,255,.30)"/><stop offset="1" stop-color="rgba(28,200,255,0)"/></linearGradient></defs>
                <path d="<?php echo esc_attr( $c[7] ); ?> L320,130 L0,130 Z" fill="url(#rhCase<?php echo $ci; ?>)"/>
                <path d="<?php echo esc_attr( $c[7] ); ?>" fill="none" stroke="#1CC8FF" stroke-width="3" stroke-linecap="round" class="rh-chart__line"/>
                <line x1="0" y1="110" x2="320" y2="110" stroke="rgba(8,27,75,.08)" stroke-width="1" stroke-dasharray="4 4"/>
              </svg>
            </div>
            <div class="rh-case__metrics">
              <div class="rh-cm"><b><?php echo esc_html( $c[3] ); ?></b><span><?php echo esc_html( $c[8] ); ?></span></div>
              <div class="rh-cm"><b><?php echo esc_html( $c[4] ); ?></b><span><?php echo esc_html( $c[9] ); ?></span></div>
              <div class="rh-cm"><b><?php echo esc_html( $c[5] ); ?></b><span><?php echo esc_html( $c[10] ); ?></span></div>
            </div>
            <p class="rh-case__quote">&ldquo;<?php echo esc_html( $c[6] ); ?>&rdquo;</p>
            <div class="rh-case__foot"><a class="rh-btn rh-btn--outline" href="<?php echo esc_url( home_url('/case-studies/') ); ?>">Read Case Study <?php echo rh_icon('arrow',16); ?></a></div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 10. WHY CHOOSE US ============================ -->
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('shield',14); ?> Why choose us</span>
        <h2 class="rh-h2">Built like an in-house team, <span class="rh-grad-text">accountable like a partner</span></h2>
      </div>
      <?php $feats = [
        ['users','Dedicated SEO Team','A senior pod assigned to your account &mdash; no juniors, no hand-offs, no guesswork.'],
        ['star','Senior Specialists','8+ years average experience across technical, content and authority SEO.'],
        ['report','Weekly Reports','Transparent dashboards tracking rankings, traffic, leads and revenue every week.'],
        ['brain','AI + Human SEO','We pair generative-search expertise with human strategy for durable results.'],
        ['eye','Transparent Process','You own your data and see exactly what we do and why &mdash; always.'],
        ['coins','ROI Focused','We optimise for pipeline and revenue, not vanity rankings.'],
      ]; ?>
      <div class="rh-choose">
        <?php foreach ( $feats as $fi => $f ) : ?>
          <div class="rh-feature" data-reveal data-reveal-delay="<?php echo esc_attr( $fi % 3 ); ?>">
            <div class="rh-feature__ic"><?php echo rh_icon( $f[0], 26 ); ?></div>
            <h3 class="rh-feature__t"><?php echo esc_html( $f[1] ); ?></h3>
            <p class="rh-feature__d"><?php echo esc_html( $f[2] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 11. TESTIMONIALS ============================ -->
  <?php $tsts = [
    ['GOOGLE REVIEW','This SEO team completely transformed our online visibility. We now outrank every competitor for our core keywords, and organic leads have become our #1 growth channel.','Dr. Mohamed Al Zarooni','CEO, Aster Dental Clinic','MA'],
    ['CLUTCH REVIEW','Finally an agency that speaks revenue, not rankings. Their weekly reporting and senior team make them feel like an in-house department.','Sarah Al Marri','Marketing Director, Luxury Villas Dubai','SM'],
    ['LINKEDIN','The most transparent and technically strong SEO partner we&rsquo;ve worked with in the UAE. Traffic up 240% and still compounding.','James Whitfield','Founder, GulfTech Commerce','JW'],
  ]; ?>
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('star',14); ?> Client testimonials</span>
        <h2 class="rh-h2">Trusted by leaders across the UAE</h2>
      </div>
      <div class="rh-tst">
        <?php foreach ( $tsts as $ti => $t ) : ?>
          <div class="rh-tcard" data-reveal data-reveal-delay="<?php echo esc_attr( $ti ); ?>">
            <div class="rh-tcard__top"><span class="rh-tcard__src"><?php echo esc_html( $t[0] ); ?></span><span class="rh-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span></div>
            <p class="rh-tcard__body"><?php echo wp_kses_post( $t[1] ); ?></p>
            <div class="rh-tcard__who"><span class="rh-tcard__av"><?php echo esc_html( $t[4] ); ?></span><div><div class="rh-tcard__nm"><?php echo esc_html( $t[2] ); ?></div><div class="rh-tcard__rl"><?php echo esc_html( $t[3] ); ?></div></div></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 12. LIVE DASHBOARD ============================ -->
  <section class="rh-section rh-section--tight rh-dark">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('chart',14); ?> Full transparency</span>
        <h2 class="rh-h2">A live view of the metrics that matter</h2>
      </div>
      <?php
      $live = [
        ['Organic Traffic','12.6M','M0,40 L30,36 L60,38 L90,28 L120,30 L150,18 L180,10'],
        ['Keywords Ranked','34.5K','M0,42 L30,38 L60,34 L90,30 L120,26 L150,18 L180,12'],
        ['Backlinks Earned','128K','M0,38 L30,40 L60,30 L90,32 L120,22 L150,20 L180,14'],
        ['Revenue Influenced','$8.7M','M0,44 L30,36 L60,32 L90,26 L120,24 L150,16 L180,8'],
      ]; ?>
      <div class="rh-live">
        <?php foreach ( $live as $li => $l ) : ?>
          <div class="rh-live__card" data-reveal data-reveal-delay="<?php echo esc_attr( $li ); ?>">
            <div class="rh-live__l"><?php echo esc_html( $l[0] ); ?></div>
            <div class="rh-live__v"><?php echo esc_html( $l[1] ); ?></div>
            <div class="rh-live__spark">
              <svg viewBox="0 0 180 48" preserveAspectRatio="none"><path d="<?php echo esc_attr( $l[2] ); ?>" fill="none" stroke="#1CC8FF" stroke-width="2.5" stroke-linecap="round" class="rh-chart__line"/></svg>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 13. PRICING ============================ -->
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('coins',14); ?> Transparent pricing</span>
        <h2 class="rh-h2">Plans that scale with your ambition</h2>
        <p class="rh-lead">No lock-ins. No hidden fees. Just measurable growth.</p>
      </div>
      <?php $plans = [
        [
          'Starter',
          '2,999',
          false,
          [
            'Up to 20 target keywords',
            'On-page SEO optimization',
            'Technical SEO audit',
            'Basic link building',
            'Google My Business setup',
            'Monthly performance report',
          ],
        ],
        [
          'Professional',
          '5,999',
          true,
          [
            'Up to 50 target keywords',
            'Advanced on-page & off-page SEO',
            'Premium link building',
            'Content creation (4 articles/mo)',
            'Local SEO optimization',
            'Conversion rate optimization',
            'Bi-weekly reports + strategy call',
            'Dedicated account manager',
          ],
        ],
        [
          'Enterprise',
          '12,999',
          false,
          [
            'Unlimited target keywords',
            'Full-service SEO management',
            'Authority link building',
            'Content creation (12 articles/mo)',
            'Multi-location SEO',
            'Custom landing pages',
            'Weekly reports + calls',
            'Dedicated team + 24/7 support',
          ],
        ],
      ]; ?>
      <div class="rh-price">
        <?php foreach ( $plans as $pi => $p ) : ?>
          <div class="rh-plan<?php echo $p[2] ? ' rh-plan--hot' : ''; ?>" data-reveal data-reveal-delay="<?php echo esc_attr( $pi ); ?>">
            <?php if ( $p[2] ) : ?><span class="rh-plan__tag">Most Popular</span><?php endif; ?>
            <div class="rh-plan__name"><?php echo esc_html( $p[0] ); ?></div>
            <div class="rh-plan__price">
              <span class="rh-plan__currency">AED</span>
              <span class="rh-plan__amount"><?php echo esc_html( $p[1] ); ?></span>
              <small>/month</small>
            </div>
            <p class="rh-plan__billing">Billed monthly · Cancel anytime</p>
            <ul class="rh-plan__list">
              <?php foreach ( $p[3] as $li ) : ?><li><?php echo rh_icon('check',18); ?><span><?php echo esc_html( $li ); ?></span></li><?php endforeach; ?>
            </ul>
            <a class="rh-btn <?php echo $p[2] ? 'rh-btn--primary' : 'rh-btn--outline'; ?>" href="<?php echo esc_url( home_url('/contact/') ); ?>">Get Started →</a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 14. FREE SEO AUDIT ============================ -->
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-audit">
        <div data-reveal>
          <span class="rh-eyebrow"><?php echo rh_icon('search',14); ?> Free SEO audit</span>
          <h2 class="rh-h2">See exactly what&rsquo;s holding your rankings back</h2>
          <p class="rh-lead" style="margin-bottom:26px">Get a free, no-obligation audit of your website&rsquo;s technical health, content, and competitive gaps &mdash; delivered by a senior specialist within 24 hours.</p>
          <form class="rh-audit__form" action="<?php echo esc_url( home_url('/contact/') ); ?>" method="get">
            <div class="rh-field"><label>Full name</label><input type="text" name="name" placeholder="Your name" required></div>
            <div class="rh-field"><label>Work email</label><input type="email" name="email" placeholder="you@company.ae" required></div>
            <div class="rh-field"><label>Website URL</label><input type="url" name="website" placeholder="https://yourwebsite.ae"></div>
            <button type="submit" class="rh-btn rh-btn--primary" style="width:100%"><?php echo rh_icon('rocket',18); ?> Get My Free Audit</button>
          </form>
        </div>
        <div class="rh-audit__preview" data-reveal data-reveal-delay="2">
          <div class="rh-report">
            <div class="rh-dash__top" style="margin-bottom:8px"><span class="rh-dash__brand"><span class="rh-dash__dot"></span> Audit Report Preview</span><span class="rh-dash__pill">A-</span></div>
            <div class="rh-report__row"><span class="rh-report__k">Core Web Vitals</span><span class="rh-score rh-score--g">92</span></div>
            <div class="rh-report__row"><span class="rh-report__k">On-page SEO</span><span class="rh-score rh-score--y">74</span></div>
            <div class="rh-report__row"><span class="rh-report__k">Technical Health</span><span class="rh-score rh-score--g">88</span></div>
            <div class="rh-report__row"><span class="rh-report__k">Backlink Authority</span><span class="rh-score rh-score--r">51</span></div>
            <div class="rh-report__row"><span class="rh-report__k">Content Coverage</span><span class="rh-score rh-score--y">69</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ 15. FAQ ============================ -->
  <?php $faqs = [
    ['How long does SEO take to show results in the UAE?','Most UAE businesses see measurable keyword movement within 3&ndash;4 months and significant organic growth between months 5&ndash;8. Competitive sectors like real estate and legal can take longer, but SEO compounds &mdash; unlike ads that stop when the budget does.'],
    ['Do you offer bilingual (Arabic + English) SEO?','Yes. Bilingual keyword research and content are core to how we capture the full UAE market. Our specialists optimise for both English and Arabic search behaviour.'],
    ['How is your reporting different?','You get a transparent live dashboard plus weekly updates covering rankings, traffic, leads and revenue &mdash; you always know exactly what we&rsquo;re doing and why.'],
    ['Do you optimise for AI search like ChatGPT and Google AI Overviews?','Absolutely. Entity-first, answer-ready content and structured data are built into every engagement so your brand gets cited across generative search.'],
    ['Are there long-term contracts?','No lock-ins. We earn your business every month with measurable results, and plans can scale up or down as you grow.'],
  ]; ?>
  <section class="rh-section">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('report',14); ?> FAQ</span>
        <h2 class="rh-h2">Questions, answered</h2>
      </div>
      <div class="rh-faq">
        <?php foreach ( $faqs as $qi => $q ) : ?>
          <div class="rh-acc<?php echo $qi === 0 ? ' is-open' : ''; ?>" data-reveal>
            <button class="rh-acc__q" type="button"><?php echo esc_html( $q[0] ); ?> <?php echo rh_icon('plus',22); ?></button>
            <div class="rh-acc__a"<?php echo $qi === 0 ? ' style="max-height:240px"' : ''; ?>><p><?php echo wp_kses_post( $q[1] ); ?></p></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ============================ 16. LATEST RESOURCES ============================ -->
  <?php
  $posts = function_exists( 'seoae_get_recent_posts' ) ? seoae_get_recent_posts( 3 ) : get_posts( [ 'numberposts' => 3 ] );
  if ( $posts ) : ?>
  <section class="rh-section rh-gray">
    <div class="rh-wrap">
      <div class="rh-head-center" data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('report',14); ?> Latest resources</span>
        <h2 class="rh-h2">SEO &amp; growth insights</h2>
      </div>
      <div class="rh-posts">
        <?php foreach ( $posts as $pi => $post ) : setup_postdata( $post );
          $cat = get_the_category( $post->ID ); $catn = $cat ? $cat[0]->name : 'SEO';
        ?>
          <a class="rh-post" href="<?php echo esc_url( get_permalink( $post ) ); ?>" data-reveal data-reveal-delay="<?php echo esc_attr( $pi ); ?>">
            <div class="rh-post__img"><?php if ( has_post_thumbnail( $post ) ) echo get_the_post_thumbnail( $post, 'medium_large' ); ?></div>
            <div class="rh-post__body">
              <span class="rh-post__cat"><?php echo esc_html( $catn ); ?></span>
              <h3 class="rh-post__t"><?php echo esc_html( get_the_title( $post ) ); ?></h3>
              <div class="rh-post__meta"><?php echo esc_html( get_the_date( '', $post ) ); ?> &middot; <?php echo esc_html( max( 1, ceil( str_word_count( wp_strip_all_tags( $post->post_content ) ) / 200 ) ) ); ?> min read</div>
            </div>
          </a>
        <?php endforeach; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============================ 17. FINAL CTA ============================ -->
  <section class="rh-section rh-final">
    <span class="rh-final__glow" aria-hidden="true"></span>
    <div class="rh-wrap" style="position:relative;z-index:2">
      <div data-reveal>
        <span class="rh-eyebrow"><?php echo rh_icon('rocket',14); ?> Let&rsquo;s grow</span>
        <h2 class="rh-final__title">Ready to Outrank Your Competitors?</h2>
        <p class="rh-lead" style="margin:0 auto;color:#AFC0E8">Book a free strategy call or claim your no-obligation SEO audit &mdash; and see how much revenue your search visibility is leaving on the table.</p>
        <div class="rh-final__cta">
          <a class="rh-btn rh-btn--primary" href="<?php echo esc_url( home_url('/contact/') ); ?>"><?php echo rh_icon('rocket',18); ?> Book Strategy Call</a>
          <a class="rh-btn rh-btn--ghost" href="<?php echo esc_url( home_url('/contact/') ); ?>">Get Free SEO Audit</a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
