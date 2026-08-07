<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ═══════════════════════════════════════════════════════════════════
     TOP BAR
════════════════════════════════════════════════════════════════════ -->
<div class="topbar">
	<div class="container topbar__inner">
		<div class="topbar__left">
			<a href="https://www.google.com/maps?q=M-01+Muteena+Street+Deira+Dubai" class="topbar__item" target="_blank" rel="noopener">
				<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
				<?php echo esc_html( seoae_address() ); ?>
			</a>
		</div>
		<div class="topbar__right">
			<a href="mailto:<?php echo esc_attr( seoae_email() ); ?>" class="topbar__item">
				<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
				<?php echo esc_html( seoae_email() ); ?>
			</a>
			<span class="topbar__divider">|</span>
			<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'careers' ) ) ?: '/careers' ); ?>" class="topbar__item">Careers</a>
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: '/blog' ); ?>" class="topbar__item">Blog</a>
		</div>
	</div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════
     MAIN NAVIGATION
════════════════════════════════════════════════════════════════════ -->
<header class="navbar" id="site-header">
	<div class="container navbar__inner">

		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar__logo" aria-label="SearchEngineOptimization.ae - Dubai SEO Agency Home">
			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark.png' ); ?>"
				srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark.png' ); ?> 1x, <?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark@2x.png' ); ?> 2x"
				alt="SearchEngineOptimization.ae - Dubai SEO and digital marketing agency"
				class="navbar__logo-img"
				width="40"
				height="40"
				decoding="async"
				fetchpriority="high"
			/>
			<div class="navbar__logo-text">
				<span class="navbar__logo-name">SearchEngine<span class="text-primary">Optimization.ae</span></span>
				<span class="navbar__logo-tagline">DIGITAL GROWTH PARTNER</span>
			</div>
		</a>

		<!-- Desktop Navigation -->
		<nav class="navbar__nav" aria-label="Primary navigation">
			<ul class="navbar__menu">

				<li class="navbar__item <?php echo is_front_page() ? 'navbar__item--active' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar__link">Home</a>
				</li>

				<!-- Services Mega Menu -->
				<li class="navbar__item navbar__item--dropdown" data-dropdown="services">
					<button class="navbar__link navbar__link--dropdown" aria-expanded="false" aria-haspopup="true">
						Services
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
					</button>
					<div class="mega-menu mega-menu--visual" role="region" aria-label="Services menu">
						<div class="mega-menu__inner">
							<div class="mega-menu__top">
								<div class="mega-menu__header">
									<span class="mega-menu__label">Our Services</span>
									<p class="mega-menu__desc">Enterprise digital marketing for ambitious UAE brands</p>
								</div>
								<a class="mega-menu__cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
									<span class="mega-menu__cta-kicker">Free</span>
									<span class="mega-menu__cta-title">SEO Audit</span>
									<span class="mega-menu__cta-arrow" aria-hidden="true">→</span>
								</a>
							</div>
							<div class="mega-menu__grid">
								<?php
								$services  = seoae_get_services();
								$menu_copy = [
									'search-engine-optimization' => [
										'title' => 'SEO Services',
										'desc'  => 'Rank higher & grow organic traffic',
										'tone'  => 'cyan',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-3.5-3.5"/></svg>',
									],
									'ai-search-optimization' => [
										'title' => 'AI Search',
										'desc'  => 'Visibility in AI Overviews & GEO',
										'tone'  => 'violet',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M12 3v3M12 18v3M3 12h3M18 12h3"/><rect x="7" y="7" width="10" height="10" rx="3"/><circle cx="12" cy="12" r="1.5"/></svg>',
									],
									'ppc-management' => [
										'title' => 'PPC & Ads',
										'desc'  => 'High-ROI Google & Meta campaigns',
										'tone'  => 'amber',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M13 2 4 14h7l-1 8 9-12h-7z"/></svg>',
									],
									'social-media-marketing' => [
										'title' => 'Social Media',
										'desc'  => 'Brand growth across channels',
										'tone'  => 'pink',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="18" cy="5" r="2.5"/><circle cx="6" cy="12" r="2.5"/><circle cx="18" cy="19" r="2.5"/><path stroke-linecap="round" d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/></svg>',
									],
									'web-design' => [
										'title' => 'Web Design',
										'desc'  => 'Conversion-led UX for UAE brands',
										'tone'  => 'blue',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="14" rx="2"/><path stroke-linecap="round" d="M3 9h18M8 4v5"/></svg>',
									],
									'web-development' => [
										'title' => 'Web Development',
										'desc'  => 'Fast, secure custom builds',
										'tone'  => 'slate',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m8 8-4 4 4 4M16 8l4 4-4 4M13 6l-2 12"/></svg>',
									],
									'technical-seo' => [
										'title' => 'Technical SEO',
										'desc'  => 'Crawlability, speed & Core Web Vitals',
										'tone'  => 'indigo',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path stroke-linecap="round" d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>',
									],
									'local-seo' => [
										'title' => 'Local SEO',
										'desc'  => 'Dominate nearby search demand',
										'tone'  => 'green',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.8 7-11a7 7 0 1 0-14 0c0 5.2 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>',
									],
									'ecommerce-seo' => [
										'title' => 'Ecommerce SEO',
										'desc'  => 'Product & category ranking systems',
										'tone'  => 'orange',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h2l2.2 10.2a2 2 0 0 0 2 1.6h7.6a2 2 0 0 0 2-1.5L21 8H7"/><circle cx="10" cy="20" r="1.4"/><circle cx="17" cy="20" r="1.4"/></svg>',
									],
									'seo-audit' => [
										'title' => 'SEO Audit',
										'desc'  => 'Find gaps holding rankings back',
										'tone'  => 'teal',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 11l2 2 4-4"/><path stroke-linecap="round" d="M8 4h8a2 2 0 0 1 2 2v14l-6-3-6 3V6a2 2 0 0 1 2-2z"/></svg>',
									],
									'chatgpt-seo' => [
										'title' => 'ChatGPT SEO',
										'desc'  => 'Win AI answers & citations',
										'tone'  => 'violet',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a8 8 0 0 1-11.5 7.2L4 20l1.1-4.2A8 8 0 1 1 21 12z"/><path stroke-linecap="round" d="M8.5 12h.01M12 12h.01M15.5 12h.01"/></svg>',
									],
									'generative-engine-optimization' => [
										'title' => 'GEO',
										'desc'  => 'Optimise for generative engines',
										'tone'  => 'cyan',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M12 3l1.8 4.7L19 9.5l-4 3.1L16.3 18 12 15.4 7.7 18l1.3-5.4-4-3.1 5.2-1.8L12 3z"/></svg>',
									],
									'google-business-profile-seo' => [
										'title' => 'Google Business',
										'desc'  => 'Profile SEO that drives calls',
										'tone'  => 'blue',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1v-9.5z"/></svg>',
									],
									'link-building' => [
										'title' => 'Link Building',
										'desc'  => 'Authority links that move rankings',
										'tone'  => 'green',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M10 13a5 5 0 0 0 7.07 0l1.41-1.41a5 5 0 0 0-7.07-7.07L10 5"/><path stroke-linecap="round" d="M14 11a5 5 0 0 0-7.07 0L5.5 12.43a5 5 0 0 0 7.07 7.07L14 19"/></svg>',
									],
								];
								$fallback = [
									'title' => '',
									'desc'  => 'Explore this service',
									'tone'  => 'cyan',
									'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-3.5-3.5"/></svg>',
								];
								foreach ( $services as $service ) :
									$slug  = $service->post_name;
									$copy  = $menu_copy[ $slug ] ?? $fallback;
									$title = $copy['title'] !== '' ? $copy['title'] : ( get_post_meta( $service->ID, 'category_label', true ) ?: wp_trim_words( $service->post_title, 4, '' ) );
									$desc  = $copy['desc'];
									$tone  = $copy['tone'];
									$icon  = $copy['icon'];
								?>
								<a href="<?php echo esc_url( get_permalink( $service ) ); ?>" class="mega-menu__item mega-menu__item--<?php echo esc_attr( $tone ); ?>">
									<span class="mega-menu__item-icon" aria-hidden="true"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									<span class="mega-menu__item-body">
										<span class="mega-menu__item-title"><?php echo esc_html( $title ); ?></span>
										<span class="mega-menu__item-desc"><?php echo esc_html( $desc ); ?></span>
									</span>
								</a>
								<?php endforeach; ?>
							</div>
							<div class="mega-menu__footer">
								<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ?: home_url( '/services/' ) ); ?>" class="mega-menu__all-link">
									View all services
									<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
								</a>
							</div>
						</div>
					</div>
				</li>

				<!-- Resources Dropdown -->
				<li class="navbar__item navbar__item--dropdown" data-dropdown="resources">
					<button class="navbar__link navbar__link--dropdown" aria-expanded="false" aria-haspopup="true">
						Resources
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
					</button>
					<div class="dropdown-menu" role="region">
						<a href="<?php echo esc_url( get_permalink( get_option('page_for_posts') ) ?: '/blog' ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">Blog & Insights</span>
							<span class="dropdown-menu__desc">SEO tips, strategies &amp; industry news</span>
						</a>
						<a href="<?php echo esc_url( get_post_type_archive_link('case_study') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">Case Studies</span>
							<span class="dropdown-menu__desc">Real results from real clients</span>
						</a>
						<a href="<?php echo esc_url( get_post_type_archive_link('portfolio_item') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">Portfolio</span>
							<span class="dropdown-menu__desc">Our best work</span>
						</a>
						<a href="<?php echo esc_url( home_url('/seo-company-dubai/') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">SEO Dubai</span>
							<span class="dropdown-menu__desc">Local SEO services in Dubai</span>
						</a>
						<a href="<?php echo esc_url( home_url('/faq/') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">FAQ</span>
							<span class="dropdown-menu__desc">Common questions answered</span>
						</a>
					</div>
				</li>

				<!-- Company Dropdown -->
				<li class="navbar__item navbar__item--dropdown" data-dropdown="company">
					<button class="navbar__link navbar__link--dropdown" aria-expanded="false" aria-haspopup="true">
						Company
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
					</button>
					<div class="dropdown-menu" role="region">
						<a href="<?php echo esc_url( home_url('/about') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">About Us</span>
							<span class="dropdown-menu__desc">Our story, mission &amp; team</span>
						</a>
						<a href="<?php echo esc_url( home_url('/careers') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">Careers</span>
							<span class="dropdown-menu__desc">Join our growing team</span>
						</a>
						<a href="<?php echo esc_url( home_url('/contact') ); ?>" class="dropdown-menu__item">
							<span class="dropdown-menu__title">Contact</span>
							<span class="dropdown-menu__desc">Get in touch today</span>
						</a>
					</div>
				</li>

			</ul>
		</nav>

		<!-- Right actions -->
		<div class="navbar__right">
			<div class="navbar__cta">
				<button type="button" class="btn btn--primary btn--sm" id="navbar-cta-btn" onclick="document.getElementById('quick-contact-modal').classList.add('is-open')">
					Get Started
					<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
				</button>
			</div>
			<button class="navbar__hamburger" id="mobile-menu-btn" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
				<span></span><span></span><span></span>
			</button>
		</div>

	</div>
</header>

<!-- ═══════════════════════════════════════════════════════════════════
     MOBILE MENU
════════════════════════════════════════════════════════════════════ -->
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
	<div class="mobile-menu__header">
		<a href="<?php echo esc_url( home_url('/') ); ?>" class="navbar__logo">
			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark.png' ); ?>"
				srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark.png' ); ?> 1x, <?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark@2x.png' ); ?> 2x"
				alt="SearchEngineOptimization.ae logo"
				class="navbar__logo-img"
				width="40"
				height="40"
				decoding="async"
			/>
			<div class="navbar__logo-text">
				<span class="navbar__logo-name">SearchEngine<span class="text-primary">Optimization.ae</span></span>
			</div>
		</a>
		<button class="mobile-menu__close" id="mobile-menu-close" aria-label="Close menu">
			<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
		</button>
	</div>
	<nav class="mobile-menu__nav">
		<a href="<?php echo esc_url( home_url('/') ); ?>" class="mobile-menu__link">Home</a>
		<div class="mobile-menu__section">
			<span class="mobile-menu__section-label">Services</span>
			<?php foreach ( seoae_get_services() as $svc ) : ?>
			<a href="<?php echo esc_url( get_permalink($svc) ); ?>" class="mobile-menu__link mobile-menu__link--sub"><?php echo esc_html($svc->post_title); ?></a>
			<?php endforeach; ?>
		</div>
		<a href="<?php echo esc_url( get_permalink(get_option('page_for_posts')) ?: '/blog' ); ?>" class="mobile-menu__link">Blog</a>
		<a href="<?php echo esc_url( get_post_type_archive_link('case_study') ); ?>" class="mobile-menu__link">Case Studies</a>
		<a href="<?php echo esc_url( home_url('/about') ); ?>" class="mobile-menu__link">About</a>
		<a href="<?php echo esc_url( home_url('/faq/') ); ?>" class="mobile-menu__link">FAQ</a>
		<a href="<?php echo esc_url( home_url('/contact') ); ?>" class="mobile-menu__link">Contact</a>
		<div class="mobile-menu__cta">
			<a href="<?php echo esc_url( home_url('/contact') ); ?>" class="btn btn--primary" style="width:100%;text-align:center;">Get Free Audit</a>
		</div>
	</nav>
</div>
<div class="mobile-menu__overlay" id="mobile-overlay" aria-hidden="true"></div>
