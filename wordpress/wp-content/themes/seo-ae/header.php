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
					<div class="mega-menu" role="region" aria-label="Services menu">
						<div class="mega-menu__inner">
							<div class="mega-menu__header">
								<span class="mega-menu__label">Our Services</span>
								<p class="mega-menu__desc">Enterprise digital marketing for UAE businesses</p>
							</div>
							<div class="mega-menu__grid">
								<?php
								$services = seoae_get_services();
								// Compact labels for the mega menu (full titles stay on service pages).
								$menu_copy = [
									'search-engine-optimization' => [
										'title' => 'SEO Services',
										'desc'  => 'Rank higher and grow organic traffic',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/></svg>',
									],
									'ai-search-optimization' => [
										'title' => 'AI Search Optimisation',
										'desc'  => 'Get found in ChatGPT & AI Overviews',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.663 17h4.673M12 3v1m6.364 1.636-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>',
									],
									'ppc-management' => [
										'title' => 'PPC & Google Ads',
										'desc'  => 'Paid campaigns that maximise ROI',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
									],
									'social-media-marketing' => [
										'title' => 'Social Media Marketing',
										'desc'  => 'Brand growth across social channels',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
									],
									'web-design' => [
										'title' => 'Web Design',
										'desc'  => 'Conversion-led UX for UAE brands',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>',
									],
									'web-development' => [
										'title' => 'Web Development',
										'desc'  => 'Fast, secure custom websites',
										'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>',
									],
								];
								$fallback_icon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/></svg>';
								foreach ( $services as $service ) :
									$slug  = $service->post_name;
									$copy  = $menu_copy[ $slug ] ?? null;
									$title = $copy['title'] ?? ( get_post_meta( $service->ID, 'category_label', true ) ?: $service->post_title );
									$desc  = $copy['desc'] ?? wp_trim_words( get_post_meta( $service->ID, 'short_description', true ) ?: $service->post_excerpt, 8 );
									$icon  = $copy['icon'] ?? $fallback_icon;
								?>
								<a href="<?php echo esc_url( get_permalink( $service ) ); ?>" class="mega-menu__item">
									<span class="mega-menu__item-icon" aria-hidden="true"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									<span class="mega-menu__item-body">
										<span class="mega-menu__item-title"><?php echo esc_html( $title ); ?></span>
										<span class="mega-menu__item-desc"><?php echo esc_html( $desc ); ?></span>
									</span>
								</a>
								<?php endforeach; ?>
							</div>
							<div class="mega-menu__footer">
								<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="mega-menu__all-link">
									View All Services
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
						<a href="<?php echo esc_url( home_url('/dubai/') ); ?>" class="dropdown-menu__item">
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
