<?php
/**
 * Template Name: Contact Page
 */
get_header();
$email   = seoae_email();
$address = seoae_address();
?>
<section class="post-hero hero-dark" style="padding:4rem 0;">
	<div class="container" style="text-align:center;max-width:700px;margin:0 auto;">
		<?php seoae_section_label( 'CONTACT US' ); ?>
		<h1 style="font-size:clamp(2rem,4vw,3.5rem);color:#fff;">Let's Talk <span class="gradient-text">Growth</span></h1>
		<p style="font-size:1.05rem;color:rgba(255,255,255,.7);margin-top:.75rem;">Ready to dominate your market? Fill in the form below and our growth experts will review your enquiry within 24 hours.</p>
	</div>
</section>

<section class="section contact-form-section">
	<div class="container">
		<div class="contact-form-grid">

			<!-- Contact Info -->
			<div class="contact-info-card">
				<h2 style="font-size:1.35rem;font-weight:700;color:var(--color-heading);margin-bottom:.25rem;">Get in Touch</h2>
				<p style="font-size:.875rem;color:var(--color-body);margin-bottom:1.5rem;">Our team responds within 24 hours on business days.</p>

				<div class="contact-info-item">
					<div class="contact-info-icon"><svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
					<div>
						<p class="contact-info-title">Dubai Office</p>
						<p class="contact-info-text"><?php echo esc_html($address); ?></p>
						<p class="contact-info-text" style="font-size:.78rem;color:var(--color-body);margin-top:.25rem;">Mon-Fri, 9am-6pm GST</p>
					</div>
				</div>

				<div class="contact-info-item">
					<div class="contact-info-icon"><svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
					<div>
						<p class="contact-info-title">Email Us</p>
						<p class="contact-info-text"><a href="mailto:<?php echo esc_attr($email); ?>" style="color:var(--color-primary);font-weight:600;"><?php echo esc_html($email); ?></a></p>
					</div>
				</div>

				<div style="margin-top:1.5rem;padding:1rem;background:var(--color-muted-bg);border-radius:12px;">
					<p style="font-size:.8rem;font-weight:600;color:var(--color-heading);margin-bottom:.25rem;"> Average Response Time</p>
					<p style="font-size:1.5rem;font-weight:800;color:var(--color-primary);">&lt; 24 Hours</p>
				</div>

				<div style="margin-top:1.25rem;padding:1rem;background:rgba(22,177,212,.06);border-radius:12px;border:1px solid rgba(22,177,212,.2);">
					<p style="font-size:.8rem;font-weight:600;color:var(--color-heading);margin-bottom:.5rem;">What happens next?</p>
					<ol style="font-size:.8125rem;color:var(--color-body);padding-left:1.1rem;margin:0;display:flex;flex-direction:column;gap:.35rem;">
						<li>We review your enquiry within 24 hours</li>
						<li>A senior specialist contacts you to learn more</li>
						<li>We prepare a tailored strategy &amp; proposal</li>
						<li>You choose whether to proceed  -  no pressure</li>
					</ol>
				</div>
			</div>

			<!-- Contact Form -->
			<div class="form-card">
				<h2 class="form-card__title">Request a Free Proposal</h2>
				<p style="font-size:.875rem;color:var(--color-body);margin-bottom:1.5rem;">Complete the form below and we'll prepare a custom strategy for your business.</p>

				<form id="contact-ajax-form" novalidate>
					<?php wp_nonce_field( 'seoae-nonce', 'nonce' ); ?>

					<!-- Honeypot (hidden from humans, catches bots) -->
					<div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
						<input type="text" name="website_url_hp" tabindex="-1" autocomplete="off">
					</div>

					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Full Name <span style="color:var(--color-primary)">*</span></label>
							<input type="text" name="name" class="form-input" placeholder="John Smith" required autocomplete="name">
						</div>
						<div class="form-group">
							<label class="form-label">Company Name</label>
							<input type="text" name="company" class="form-input" placeholder="Your Company Ltd" autocomplete="organization">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Email Address <span style="color:var(--color-primary)">*</span></label>
							<input type="email" name="email" class="form-input" placeholder="john@company.com" required autocomplete="email">
						</div>
						<div class="form-group">
							<label class="form-label">Phone Number</label>
							<input type="tel" name="phone" class="form-input" placeholder="+971 50 000 0000" autocomplete="tel">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Website URL</label>
							<input type="url" name="website" class="form-input" placeholder="https://yourwebsite.com" autocomplete="url">
						</div>
						<div class="form-group">
							<label class="form-label">Business Name</label>
							<input type="text" name="business" class="form-input" placeholder="Trading / Brand name">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Service Interested In</label>
							<select name="service" class="form-select">
								<option value=""> -  Select a service  - </option>
								<option>Search Engine Optimization (SEO)</option>
								<option>AI Search Optimization (AEO / GEO)</option>
								<option>PPC &amp; Google Ads Management</option>
								<option>Social Media Marketing</option>
								<option>Web Design</option>
								<option>Web Development</option>
								<option>Full Digital Marketing Package</option>
								<option>Other / Not Sure</option>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label">Monthly Marketing Budget</label>
							<select name="budget" class="form-select">
								<option value=""> -  Select budget  - </option>
								<option>Under AED 3,000</option>
								<option>AED 3,000 - 5,000</option>
								<option>AED 5,000 - 10,000</option>
								<option>AED 10,000 - 25,000</option>
								<option>AED 25,000 - 50,000</option>
								<option>AED 50,000+</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="form-label">Country</label>
						<select name="country" class="form-select">
							<option value=""> -  Select country  - </option>
							<option selected>United Arab Emirates</option>
							<option>Saudi Arabia</option>
							<option>Kuwait</option>
							<option>Qatar</option>
							<option>Bahrain</option>
							<option>Oman</option>
							<option>United Kingdom</option>
							<option>United States</option>
							<option>Other</option>
						</select>
					</div>

					<div class="form-group">
						<label class="form-label">Message / Project Requirements <span style="color:var(--color-primary)">*</span></label>
						<textarea name="message" class="form-textarea" rows="5" placeholder="Tell us about your business, current challenges, target audience, and what you're hoping to achieve. The more detail you provide, the more tailored our proposal will be." required></textarea>
					</div>

					<!-- Privacy Policy Consent -->
					<div class="form-group" style="display:flex;align-items:flex-start;gap:.75rem;padding:.75rem;background:var(--color-muted-bg);border-radius:8px;">
						<input type="checkbox" name="privacy" id="privacy-consent" value="1" required style="margin-top:.2rem;flex-shrink:0;width:16px;height:16px;accent-color:var(--color-primary);">
						<label for="privacy-consent" style="font-size:.8125rem;color:var(--color-body);cursor:pointer;line-height:1.5;">
							I agree to the <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" target="_blank" style="color:var(--color-primary);">Privacy Policy</a> and consent to SearchEngineOptimization.ae storing and processing my information to respond to my enquiry. <span style="color:var(--color-primary)">*</span>
						</label>
					</div>

					<button type="submit" class="btn btn--primary form-submit" style="width:100%;margin-top:1rem;justify-content:center;padding:.875rem;">
						<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
						Send My Enquiry
					</button>
					<p style="font-size:.75rem;color:var(--color-body);text-align:center;margin-top:.75rem;"> Your information is secure and will never be shared with third parties.</p>
					<div class="form-message" style="display:none;margin-top:1rem;"></div>
				</form>
			</div>

		</div>
	</div>
</section>

<?php seoae_cta_dark(
	'Have a Specific Project in Mind?',
	'Our team of 40+ specialists is ready to build your digital growth engine. Send us an email and let\'s start the conversation.',
	'Email Us Now',
	'mailto:sales@searchengineoptimization.ae',
	'View Our Work',
	'/case-studies/'
); ?>
<?php get_footer(); ?>
