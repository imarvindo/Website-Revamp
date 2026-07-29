<?php
/**
 * Template Name: Contact Page
 */
get_header();
$phone   = seoae_phone();
$email   = seoae_email();
$address = seoae_address();
?>
<section class="post-hero hero-dark" style="padding:4rem 0;">
	<div class="container" style="text-align:center;max-width:700px;margin:0 auto;">
		<?php seoae_section_label( 'CONTACT US' ); ?>
		<h1 style="font-size:clamp(2rem,4vw,3.5rem);color:#fff;">Let's Talk <span class="gradient-text">Growth</span></h1>
		<p style="font-size:1.05rem;color:rgba(255,255,255,.7);margin-top:.75rem;">Ready to dominate your market? Reach out and our growth experts will audit your digital presence.</p>
	</div>
</section>

<section class="section contact-form-section">
	<div class="container">
		<div class="contact-form-grid">

			<!-- Contact Info -->
			<div class="contact-info-card">
				<h2 style="font-size:1.35rem;font-weight:700;color:var(--color-heading);margin-bottom:.25rem;">Get in Touch</h2>
				<p style="font-size:.875rem;color:var(--color-body);margin-bottom:1.5rem;">Our team responds within 24 hours.</p>

				<div class="contact-info-item">
					<div class="contact-info-icon"><svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
					<div>
						<p class="contact-info-title">Dubai Headquarters</p>
						<p class="contact-info-text"><?php echo esc_html($address); ?><br>Sheikh Zayed Road, Dubai, UAE</p>
					</div>
				</div>

				<div class="contact-info-item">
					<div class="contact-info-icon"><svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/></svg></div>
					<div>
						<p class="contact-info-title">Call Us</p>
						<p class="contact-info-text"><a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]//','',$phone)); ?>"><?php echo esc_html($phone); ?></a></p>
						<p class="contact-info-text" style="font-size:.78rem;">Mon–Fri, 9am–6pm GST</p>
					</div>
				</div>

				<div class="contact-info-item">
					<div class="contact-info-icon"><svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
					<div>
						<p class="contact-info-title">Email Us</p>
						<p class="contact-info-text"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
					</div>
				</div>

				<div style="margin-top:1.5rem;padding:1rem;background:var(--color-muted-bg);border-radius:12px;">
					<p style="font-size:.8rem;font-weight:600;color:var(--color-heading);margin-bottom:.25rem;">Average Response Time</p>
					<p style="font-size:1.5rem;font-weight:800;color:var(--color-primary);">&lt; 24 Hours</p>
				</div>
			</div>

			<!-- Contact Form -->
			<div class="form-card">
				<h2 class="form-card__title">Request a Proposal</h2>
				<form id="contact-ajax-form" novalidate>
					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Full Name <span>*</span></label>
							<input type="text" name="name" class="form-input" placeholder="John Doe" required>
						</div>
						<div class="form-group">
							<label class="form-label">Email <span>*</span></label>
							<input type="email" name="email" class="form-input" placeholder="john@company.com" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Phone</label>
							<input type="tel" name="phone" class="form-input" placeholder="+971 50 000 0000">
						</div>
						<div class="form-group">
							<label class="form-label">Company</label>
							<input type="text" name="company" class="form-input" placeholder="Acme Corp">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group">
							<label class="form-label">Service of Interest</label>
							<select name="service" class="form-select">
								<option value="">Select service</option>
								<option>Search Engine Optimization</option>
								<option>AI Search Optimization</option>
								<option>PPC &amp; Google Ads</option>
								<option>Social Media Marketing</option>
								<option>Web Design</option>
								<option>Web Development</option>
								<option>Full Digital Marketing Package</option>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label">Monthly Budget</label>
							<select name="budget" class="form-select">
								<option value="">Select budget</option>
								<option>AED 3,000 – 5,000</option>
								<option>AED 5,000 – 10,000</option>
								<option>AED 10,000 – 25,000</option>
								<option>AED 25,000+</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Message</label>
						<textarea name="message" class="form-textarea" placeholder="Tell us about your project and goals..."></textarea>
					</div>
					<button type="submit" class="btn btn--primary form-submit">Send Message →</button>
					<div class="form-message" style="display:none;"></div>
				</form>
			</div>

		</div>
	</div>
</section>
<?php get_footer(); ?>
