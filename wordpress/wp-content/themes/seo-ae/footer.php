<!-- ═══════════════════════════════════════════════════════════════════
     SITE FOOTER
════════════════════════════════════════════════════════════════════ -->
<footer class="footer">

	<!-- Footer Top -->
	<div class="footer__top">
		<div class="container footer__top-inner">

			<!-- Brand Column -->
			<div class="footer__brand">
				<a href="<?php echo esc_url( home_url('/') ); ?>" class="footer__logo">
					<div class="navbar__logo-mark" style="background:#16B1D4;width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;">
						<svg width="24" height="24" viewBox="0 0 32 32" fill="none"><text x="16" y="22" text-anchor="middle" font-family="Outfit,sans-serif" font-weight="700" font-size="14" fill="#FFFFFF">S</text></svg>
					</div>
					<div class="navbar__logo-text">
						<span class="footer__logo-name">SEO<span style="color:#16B1D4">.ae</span></span>
					</div>
				</a>
				<p class="footer__brand-desc">
					<?php echo esc_html( function_exists('get_field') ? get_field('footer_tagline','option') : "Dubai's #1 Enterprise SEO & Digital Growth Agency. We deliver measurable organic growth, paid media ROI, and digital transformation for UAE businesses." ); ?>
				</p>
				<!-- Newsletter -->
				<div class="footer__newsletter">
					<p class="footer__newsletter-label">Get weekly SEO insights</p>
					<form class="footer__newsletter-form" id="newsletter-form">
						<input type="email" name="email" placeholder="your@email.com" class="footer__newsletter-input" required>
						<button type="submit" class="footer__newsletter-btn">
							<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
						</button>
					</form>
					<p class="footer__newsletter-message" id="newsletter-message"></p>
				</div>
			</div>

			<!-- Services Column -->
			<div class="footer__col">
				<h4 class="footer__col-heading">Services</h4>
				<ul class="footer__links">
					<?php foreach ( seoae_get_services() as $svc ) : ?>
					<li><a href="<?php echo esc_url( get_permalink($svc) ); ?>" class="footer__link"><?php echo esc_html($svc->post_title); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Company Column -->
			<div class="footer__col">
				<h4 class="footer__col-heading">Company</h4>
				<ul class="footer__links">
					<li><a href="<?php echo esc_url( home_url('/about') ); ?>" class="footer__link">About Us</a></li>
					<li><a href="<?php echo esc_url( home_url('/careers') ); ?>" class="footer__link">Careers</a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link('case_study') ); ?>" class="footer__link">Case Studies</a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link('portfolio_item') ); ?>" class="footer__link">Portfolio</a></li>
					<li><a href="<?php echo esc_url( home_url('/contact') ); ?>" class="footer__link">Contact</a></li>
					<li><a href="<?php echo esc_url( home_url('/dubai') ); ?>" class="footer__link">SEO Dubai</a></li>
				</ul>
			</div>

			<!-- Resources Column -->
			<div class="footer__col">
				<h4 class="footer__col-heading">Resources</h4>
				<ul class="footer__links">
					<li><a href="<?php echo esc_url( get_permalink(get_option('page_for_posts')) ?: home_url('/blog') ); ?>" class="footer__link">Blog &amp; Insights</a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link('case_study') ); ?>" class="footer__link">Success Stories</a></li>
					<li><a href="<?php echo esc_url( home_url('/contact') ); ?>" class="footer__link">Free SEO Audit</a></li>
					<li><a href="<?php echo esc_url( home_url('/contact') ); ?>" class="footer__link">Get a Proposal</a></li>
				</ul>
				<div class="footer__contact">
					<h4 class="footer__col-heading" style="margin-top:1.5rem">Contact</h4>
					<p><a href="tel:<?php echo esc_attr( preg_replace('/[^+0-9]/', '', seoae_phone()) ); ?>" class="footer__link"><?php echo esc_html( seoae_phone() ); ?></a></p>
					<p><a href="mailto:<?php echo esc_attr( seoae_email() ); ?>" class="footer__link"><?php echo esc_html( seoae_email() ); ?></a></p>
					<p class="footer__address"><?php echo esc_html( seoae_address() ); ?></p>
				</div>
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
				<a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>" class="footer__bottom-link">Privacy Policy</a>
				&nbsp;&bull;&nbsp;
				<a href="<?php echo esc_url( home_url('/terms-of-service') ); ?>" class="footer__bottom-link">Terms of Service</a>
			</p>
			<div class="footer__social">
				<?php
				$social_links = [
					'linkedin'  => [ function_exists('get_field') ? get_field('social_linkedin','option') : '#', '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>' ],
					'instagram' => [ function_exists('get_field') ? get_field('social_instagram','option') : '#', '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>' ],
					'facebook'  => [ function_exists('get_field') ? get_field('social_facebook','option') : '#', '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' ],
				];
				foreach ( $social_links as $network => [$url, $icon] ) :
					if ( $url && $url !== '#' ) :
				?>
				<a href="<?php echo esc_url($url); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
					<?= $icon ?>
				</a>
				<?php endif; endforeach; ?>
			</div>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
