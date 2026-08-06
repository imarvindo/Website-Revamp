<!-- ═══════════════════════════════════════════════════════════════════
     SITE FOOTER
════════════════════════════════════════════════════════════════════ -->
<footer class="footer">

	<!-- Pre-footer CTA bar -->
	<div class="footer__prebar">
		<div class="container footer__prebar-inner">
			<div class="footer__prebar-text">
				<span class="footer__prebar-tag">UAE's #1 SEO Agency</span>
				<h3 class="footer__prebar-heading">Ready to dominate search in Dubai?</h3>
				<p class="footer__prebar-sub">Get your free audit  -  results within 48 hours, no obligation.</p>
			</div>
			<div class="footer__prebar-actions">
				<button type="button" class="footer__prebar-btn" onclick="window.seoaeOpenContactModal&&window.seoaeOpenContactModal()">
					Get Free Audit
					<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
				</button>
	
			</div>
		</div>
	</div>

	<!-- Footer Main -->
	<div class="footer__top">
		<div class="container footer__top-inner">

			<!-- Brand Column -->
			<div class="footer__brand">
				<a href="<?php echo esc_url( home_url('/') ); ?>" class="footer__logo">
					<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="6" y="7" width="18" height="7" rx="3.5" fill="#fff"/>
						<rect x="6" y="22" width="24" height="7" rx="3.5" fill="#fff"/>
						<path d="M26 18 L30 12 L26 14 M30 12 L28 16" stroke="#16B1D4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span class="footer__logo-name">SearchEngine<span class="footer__logo-accent">Optimization.ae</span></span>
				</a>
				<p class="footer__brand-desc">Dubai's #1 Enterprise SEO &amp; Digital Growth Agency. Measurable organic growth, paid media ROI, and digital transformation for UAE businesses.</p>

				<!-- Social Icons -->
				<div class="footer__social">
					<?php
					$social_links = [
						'linkedin'  => [ function_exists('get_field') ? get_field('social_linkedin','option')  : '#', '<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>' ],
						'instagram' => [ function_exists('get_field') ? get_field('social_instagram','option') : '#', '<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>' ],
						'facebook'  => [ function_exists('get_field') ? get_field('social_facebook','option')  : '#', '<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' ],
					];
					foreach ( $social_links as $network => [$url, $icon] ) :
					?>
					<a href="<?php echo esc_url($url ?: '#'); ?>" class="footer__social-link" <?php if($url && $url!='#') echo 'target="_blank" rel="noopener noreferrer"'; ?> aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
						<?= $icon ?>
					</a>
					<?php endforeach; ?>
				</div>

				<!-- Newsletter -->
				<div class="footer__newsletter">
					<p class="footer__newsletter-label">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
						Weekly SEO insights  -  free
					</p>
					<form class="footer__newsletter-form" id="newsletter-form">
						<input type="email" name="email" placeholder="your@email.com" class="footer__newsletter-input" required>
						<button type="submit" class="footer__newsletter-btn" aria-label="Subscribe">
							<svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
						</button>
					</form>
					<p class="footer__newsletter-message" id="newsletter-message"></p>
				</div>
			</div>

			<!-- Services Column -->
			<div class="footer__col">
				<h4 class="footer__col-heading">Services</h4>
				<ul class="footer__links">
					<?php
					$services = seoae_get_services();
					$shown = 0;
					foreach ( $services as $svc ) :
						if ( $shown >= 7 ) break;
						$shown++;
					?>
					<li>
						<a href="<?php echo esc_url( get_permalink($svc) ); ?>" class="footer__link">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							<?php echo esc_html($svc->post_title); ?>
						</a>
					</li>
					<?php endforeach; ?>
					<?php if ( count($services) > 7 ) : ?>
					<li><a href="<?php echo esc_url( home_url('/services') ); ?>" class="footer__link footer__link--more">View All Services →</a></li>
					<?php endif; ?>
				</ul>
			</div>

			<!-- Company Column -->
			<div class="footer__col">
				<h4 class="footer__col-heading">Company</h4>
				<ul class="footer__links">
					<li><a href="<?php echo esc_url( home_url('/about') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>About Us</a></li>
					<li><a href="<?php echo esc_url( home_url('/careers') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Careers</a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link('case_study') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Case Studies</a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link('portfolio_item') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Portfolio</a></li>
					<li><a href="<?php echo esc_url( home_url('/contact') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Contact</a></li>
					<li><a href="<?php echo esc_url( home_url('/dubai/') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>SEO Dubai</a></li>
					<li><a href="<?php echo esc_url( home_url('/locations/') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Locations</a></li>
					<li><a href="<?php echo esc_url( home_url('/industries/') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Industries</a></li>
				</ul>
			</div>

			<!-- Resources & Contact Column -->
			<div class="footer__col">
				<h4 class="footer__col-heading">Resources</h4>
				<ul class="footer__links">
					<li><a href="<?php echo esc_url( get_permalink(get_option('page_for_posts')) ?: home_url('/blog') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Blog &amp; Insights</a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link('case_study') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Success Stories</a></li>
					<li><a href="<?php echo esc_url( home_url('/faq') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>FAQ</a></li>
					<li><a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Privacy Policy</a></li>
					<li><a href="<?php echo esc_url( home_url('/terms-of-service') ); ?>" class="footer__link">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5 2l3 3-3 3" stroke="#16B1D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Terms of Service</a></li>
				</ul>

				<div class="footer__contact-block">
					<h4 class="footer__col-heading" style="margin-top:1.75rem">Contact</h4>
					<a href="mailto:<?php echo esc_attr( seoae_email() ); ?>" class="footer__contact-item">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
						<?php echo esc_html( seoae_email() ); ?>
					</a>
					<p class="footer__contact-addr">
						<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
						<?php echo esc_html( seoae_address() ); ?>
					</p>
				</div>
			</div>

		</div>
	</div>

	<!-- ── SEO Coverage Bar (compact) ── -->
	<div class="footer__coverage">
		<div class="container">

			<div class="footer__coverage-row">
				<span class="footer__coverage-label">
					<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5"/></svg>
					Industries
				</span>
				<nav class="footer__coverage-links" aria-label="Industry pages">
					<?php
					// Canonical industry URLs (live page-industry.php pages).
					$ind = [
						'All Industries' => '/industries/',
						'Healthcare'     => '/industries/healthcare/',
						'Real Estate'    => '/industries/real-estate/',
						'E-commerce'     => '/industries/ecommerce/',
						'Hospitality'    => '/industries/hospitality/',
						'Finance'        => '/industries/finance/',
						'Legal'          => '/industries/legal/',
					];
					$i = 0;
					foreach ( $ind as $label => $slug ) :
						if ( $i++ ) echo '<span class="footer__coverage-sep">·</span>';
					?>
					<a href="<?php echo esc_url( home_url( $slug ) ); ?>" class="footer__coverage-link"><?php echo esc_html( $label ); ?></a>
					<?php endforeach; ?>
				</nav>
			</div>

			<div class="footer__coverage-row">
				<span class="footer__coverage-label">
					<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
					UAE Cities
				</span>
				<nav class="footer__coverage-links" aria-label="Location pages">
					<?php
					// Canonical location / district URLs currently published on production.
					$cities = [
						'All Locations'    => '/locations/',
						'Dubai'            => '/dubai/',
						'Abu Dhabi'        => '/locations/seo-abu-dhabi/',
						'Sharjah'          => '/locations/seo-sharjah/',
						'Ajman'            => '/locations/seo-ajman/',
						'Ras Al Khaimah'   => '/locations/seo-ras-al-khaimah/',
						'Fujairah'         => '/locations/seo-fujairah/',
						'Dubai Marina'     => '/dubai/marina/',
						'Business Bay'     => '/dubai/business-bay/',
						'Downtown Dubai'   => '/dubai/downtown/',
						'Deira'            => '/dubai/deira/',
						'DIFC'             => '/dubai/difc/',
						'JLT'              => '/dubai/jlt/',
						'Jumeirah'         => '/dubai/jumeirah/',
						'Bur Dubai'        => '/dubai/bur-dubai/',
						'Al Quoz'          => '/dubai/al-quoz/',
						'Dubai Hills'      => '/dubai/dubai-hills/',
						'Palm Jumeirah'    => '/dubai/palm-jumeirah/',
						'Mirdif'           => '/dubai/mirdif/',
					];
					$i = 0;
					foreach ( $cities as $label => $slug ) :
						if ( $i++ ) echo '<span class="footer__coverage-sep">·</span>';
					?>
					<a href="<?php echo esc_url( home_url( $slug ) ); ?>" class="footer__coverage-link"><?php echo esc_html( $label ); ?></a>
					<?php endforeach; ?>
				</nav>
			</div>

		</div>
	</div>

	<!-- Certifications Bar -->
	<div class="footer__certs">
		<div class="container footer__certs-inner">
			<span class="footer__certs-label">Certified Partner:</span>
			<div class="footer__certs-list">
				<?php
				$certs = function_exists('get_field') ? get_field('certifications','option') : null;
				if ( $certs ) :
					foreach ( $certs as $cert ) :
					?>
					<div class="footer__cert-badge">
						<?php if (!empty($cert['cert_image'])) : ?>
						<img src="<?php echo esc_url($cert['cert_image']); ?>" alt="<?php echo esc_attr($cert['cert_name']); ?>" loading="lazy">
						<?php else : ?>
						<span><?php echo esc_html($cert['cert_name']); ?></span>
						<?php endif; ?>
					</div>
					<?php endforeach; ?>
				<?php else : ?>
				<span class="footer__cert-badge footer__cert-badge--text">Google Partner</span>
				<span class="footer__cert-badge footer__cert-badge--text">Meta Business Partner</span>
				<span class="footer__cert-badge footer__cert-badge--text">SEMrush Certified</span>
				<span class="footer__cert-badge footer__cert-badge--text">Ahrefs Certified</span>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Footer Bottom -->
	<div class="footer__bottom">
		<div class="container footer__bottom-inner">
			<p class="footer__copyright">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.
				&nbsp;&bull;&nbsp;
				<a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>" class="footer__bottom-link">Privacy</a>
				&nbsp;&bull;&nbsp;
				<a href="<?php echo esc_url( home_url('/terms-of-service') ); ?>" class="footer__bottom-link">Terms</a>
				&nbsp;&bull;&nbsp;
				<a href="<?php echo esc_url( home_url('/sitemap.xml') ); ?>" class="footer__bottom-link">Sitemap</a>
			</p>
			<p class="footer__made">Made with  in Dubai, UAE 🇦🇪</p>
		</div>
	</div>

</footer>

<!-- ═══════════════════════════════════════════════════════════════════
     QUICK CONTACT MODAL
════════════════════════════════════════════════════════════════════ -->
<div id="quick-contact-modal" class="qcm-overlay" role="dialog" aria-modal="true" aria-labelledby="qcm-title" aria-hidden="true" inert hidden>
	<div class="qcm-panel">
		<!-- Close -->
		<button class="qcm-close" id="qcm-close-btn" aria-label="Close">
			<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
		</button>

		<!-- Header -->
		<div class="qcm-header">
			<span class="qcm-tag">Free Consultation</span>
			<h2 id="qcm-title" class="qcm-title">Get Your Free SEO Audit</h2>
			<p class="qcm-subtitle">Fill in the form  -  our team will respond within 2 hours.</p>
		</div>

		<!-- Form -->
		<form class="qcm-form" id="qcm-form" novalidate>
			<input type="hidden" name="nonce" id="qcm-nonce">

			<div class="qcm-row qcm-row--2">
				<div class="qcm-field">
					<label for="qcm-name">Full Name <span>*</span></label>
					<input type="text" id="qcm-name" name="name" placeholder="Ahmed Al Rashid" required autocomplete="name">
				</div>
				<div class="qcm-field">
					<label for="qcm-email">Email Address <span>*</span></label>
					<input type="email" id="qcm-email" name="email" placeholder="ahmed@company.ae" required autocomplete="email">
				</div>
			</div>

			<div class="qcm-row">
				<div class="qcm-field">
					<label for="qcm-website">Website URL</label>
					<input type="url" id="qcm-website" name="website" placeholder="https://yoursite.ae" autocomplete="url">
				</div>
			</div>

			<div class="qcm-row">
				<div class="qcm-field">
					<label for="qcm-service">Service Interested In</label>
					<select id="qcm-service" name="service">
						<option value="">Select a service</option>
						<option>Search Engine Optimisation (SEO)</option>
						<option>AI Search / GEO Optimisation</option>
						<option>PPC &amp; Google Ads Management</option>
						<option>Social Media Marketing</option>
						<option>Web Design &amp; Development</option>
						<option>Local SEO Dubai</option>
						<option>Full Digital Growth Package</option>
					</select>
				</div>
			</div>

			<div class="qcm-row">
				<div class="qcm-field">
					<label for="qcm-message">Tell Us About Your Goals <span>*</span></label>
					<textarea id="qcm-message" name="message" rows="3" placeholder="e.g. We want to rank #1 for 'SEO agency Dubai' and generate 50+ leads/month…" required></textarea>
				</div>
			</div>

			<!-- Honeypot -->
			<input type="text" name="website_url_hp" style="display:none" tabindex="-1" autocomplete="off">

			<div class="qcm-privacy">
				<label class="qcm-checkbox-label">
					<input type="checkbox" name="privacy" id="qcm-privacy" value="1" required>
					<span>I agree to the <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" target="_blank">Privacy Policy</a></span>
				</label>
			</div>

			<button type="submit" class="qcm-submit" id="qcm-submit-btn">
				<span class="qcm-submit-text">Send My Enquiry</span>
				<span class="qcm-submit-loader" hidden>
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="qcm-spin"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
					Sending…
				</span>
			</button>

			<p class="qcm-error" id="qcm-error" hidden></p>
		</form>

		<!-- Success State -->
		<div class="qcm-success" id="qcm-success" hidden>
			<div class="qcm-success-icon">
				<svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#16B1D4" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
			</div>
			<h3>Enquiry Received!</h3>
			<p>Thank you  -  our senior SEO specialist will contact you within 2 business hours.</p>
			<button type="button" class="qcm-success-close" onclick="window.seoaeCloseContactModal&&window.seoaeCloseContactModal()">Close</button>
		</div>
	</div>
</div>

<script>
(function(){
  var overlay  = document.getElementById('quick-contact-modal');
  var closeBtn = document.getElementById('qcm-close-btn');
  var form     = document.getElementById('qcm-form');
  var submitBtn= document.getElementById('qcm-submit-btn');
  var errEl    = document.getElementById('qcm-error');
  var success  = document.getElementById('qcm-success');
  if (!overlay) return;

  document.getElementById('qcm-nonce').value =
    (typeof SEOAE !== 'undefined' && SEOAE.nonce) ? SEOAE.nonce : '';

  function openModal(){
    overlay.hidden = false;
    overlay.removeAttribute('inert');
    overlay.setAttribute('aria-hidden', 'false');
    overlay.classList.add('is-open');
    var focusEl = overlay.querySelector('#qcm-name, #qcm-close-btn, input, button');
    if (focusEl) focusEl.focus();
  }
  function closeModal(){
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    overlay.setAttribute('inert', '');
    overlay.hidden = true;
  }
  window.seoaeOpenContactModal = openModal;
  window.seoaeCloseContactModal = closeModal;

  closeBtn.addEventListener('click', closeModal);
  overlay.addEventListener('click', function(e){ if(e.target===overlay) closeModal(); });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape' && overlay.classList.contains('is-open')) closeModal(); });

  form.addEventListener('submit', function(e){
    e.preventDefault();
    var txt  = submitBtn.querySelector('.qcm-submit-text');
    var spin = submitBtn.querySelector('.qcm-submit-loader');
    txt.hidden = true; spin.hidden = false;
    submitBtn.disabled = true;
    errEl.hidden = true;

    var data = new FormData(form);
    data.append('action', 'seoae_contact');

    fetch((typeof SEOAE!=='undefined'&&(SEOAE.ajaxUrl||SEOAE.ajax_url))||'/wp-admin/admin-ajax.php', {
      method: 'POST', body: data
    })
    .then(function(r){ return r.json(); })
    .then(function(json){
      if(json.success){
        form.hidden = true;
        success.hidden = false;
      } else {
        errEl.textContent = json.data || 'Something went wrong. Please try again.';
        errEl.hidden = false;
        txt.hidden = false; spin.hidden = true;
        submitBtn.disabled = false;
      }
    })
    .catch(function(){
      errEl.textContent = 'Network error. Please try again or email us directly.';
      errEl.hidden = false;
      txt.hidden = false; spin.hidden = true;
      submitBtn.disabled = false;
    });
  });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
