import { Link } from "wouter";

const LAST_UPDATED = "1 January 2025";
const COMPANY = "SearchEngineOptimization.ae FZ-LLC";
const ADDRESS = "M-01, Muteena Street, Deira, Dubai, UAE";
const EMAIL = "privacy@searchengineoptimization.ae";

export default function Privacy() {
  return (
    <div className="flex flex-col min-h-screen">
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-20 relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 max-w-3xl">
          <div className="section-label mb-6 text-white border-white/20 bg-white/10">Legal</div>
          <h1 className="text-5xl font-extrabold text-white mb-4">Privacy Policy</h1>
          <p className="text-white/60">Last updated: {LAST_UPDATED}</p>
        </div>
      </section>

      <section className="py-20 bg-background">
        <div className="container mx-auto px-4 max-w-3xl">
          <div className="prose prose-lg max-w-none text-muted-foreground prose-headings:text-foreground prose-headings:font-bold prose-a:text-primary">

            <h2>1. Who We Are</h2>
            <p>
              {COMPANY} ("SEO.ae", "we", "us", or "our") operates the website{" "}
              <a href="https://searchengineoptimization.ae">searchengineoptimization.ae</a> and all
              associated sub-domains and digital properties. Our registered office is at {ADDRESS}.
              This Privacy Policy explains how we collect, use, share, and protect personal
              information when you visit our website or use our services.
            </p>

            <h2>2. Information We Collect</h2>
            <h3>2.1 Information You Provide</h3>
            <ul>
              <li><strong>Contact forms & audit requests:</strong> name, email address, phone number, website URL, and business description.</li>
              <li><strong>Newsletter sign-ups:</strong> email address only.</li>
              <li><strong>Client onboarding:</strong> company name, billing address, VAT number, and account credentials for third-party tools (e.g. Google Analytics, Google Search Console) you choose to share with us.</li>
            </ul>

            <h3>2.2 Information Collected Automatically</h3>
            <ul>
              <li><strong>Usage data:</strong> pages visited, time on page, referral source, device type, browser, and operating system — collected via Google Analytics 4.</li>
              <li><strong>IP address:</strong> logged for security and geographic analytics; we do not sell or share raw IP data.</li>
              <li><strong>Cookies:</strong> see Section 7 below.</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <p>We use the data we collect to:</p>
            <ul>
              <li>Respond to enquiries and deliver the free SEO audit you requested.</li>
              <li>Provide, manage, and improve our services.</li>
              <li>Send you the newsletter you subscribed to (you may unsubscribe at any time).</li>
              <li>Send service-related updates and invoices.</li>
              <li>Detect fraud and protect the security of our website and systems.</li>
              <li>Comply with legal obligations under UAE law.</li>
            </ul>
            <p>We do <strong>not</strong> sell, rent, or trade your personal information to third parties for marketing purposes.</p>

            <h2>4. Legal Basis for Processing</h2>
            <p>
              We process personal data on the following legal bases: (a) <strong>contract</strong> — where processing is necessary to deliver services you have engaged us for; (b) <strong>legitimate interests</strong> — where we have a genuine business reason (e.g. analytics); (c) <strong>consent</strong> — where you have actively opted in (e.g. newsletter); and (d) <strong>legal obligation</strong> — where UAE law requires us to process or retain data.
            </p>

            <h2>5. Sharing of Information</h2>
            <p>We share your information only with:</p>
            <ul>
              <li><strong>Service providers:</strong> tools we use to operate our business (Google Workspace, HubSpot, Stripe, cloud hosting). These providers process data only on our instructions.</li>
              <li><strong>Legal authorities:</strong> when required by UAE federal law, court order, or regulation.</li>
              <li><strong>Business transfers:</strong> in the event of a merger, acquisition, or sale of assets, personal data may be transferred subject to the same protections.</li>
            </ul>

            <h2>6. Data Retention</h2>
            <p>
              We retain client project data for 5 years following contract termination to comply with
              UAE commercial record-keeping requirements. Contact form data and newsletter
              subscriptions are retained until you ask us to delete them or 2 years of inactivity,
              whichever is sooner. Analytics data is retained for 14 months in line with Google
              Analytics 4 defaults.
            </p>

            <h2>7. Cookies</h2>
            <p>
              Our website uses the following categories of cookies:
            </p>
            <ul>
              <li><strong>Strictly necessary:</strong> session cookies required for the website to function (cannot be disabled).</li>
              <li><strong>Analytics:</strong> Google Analytics 4 cookies to understand how visitors use our site. You can opt out at any time via our cookie banner or the{" "}
                <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics opt-out browser add-on</a>.
              </li>
              <li><strong>Marketing:</strong> Google Ads and LinkedIn Insight Tag for ad conversion tracking. Only activated with your consent.</li>
            </ul>

            <h2>8. Security</h2>
            <p>
              We implement industry-standard security measures including HTTPS/TLS encryption,
              access controls, and regular security audits. No transmission over the internet is
              100% secure. If you suspect a data breach involving your information, please contact us
              immediately at <a href={`mailto:${EMAIL}`}>{EMAIL}</a>.
            </p>

            <h2>9. Your Rights</h2>
            <p>Depending on your location, you may have the right to:</p>
            <ul>
              <li>Access the personal data we hold about you.</li>
              <li>Correct inaccurate data.</li>
              <li>Request deletion of your data (subject to legal retention requirements).</li>
              <li>Withdraw consent for newsletter communications at any time.</li>
              <li>Object to processing based on our legitimate interests.</li>
            </ul>
            <p>To exercise any of these rights, email us at <a href={`mailto:${EMAIL}`}>{EMAIL}</a>. We will respond within 30 days.</p>

            <h2>10. Third-Party Links</h2>
            <p>
              Our website may contain links to third-party websites. We are not responsible for the
              privacy practices of those sites and recommend you review their policies independently.
            </p>

            <h2>11. Children's Privacy</h2>
            <p>
              Our services are not directed to individuals under 18 years of age. We do not
              knowingly collect personal information from children.
            </p>

            <h2>12. Changes to This Policy</h2>
            <p>
              We may update this Privacy Policy periodically. When we do, we will revise the "Last
              updated" date at the top of this page. Continued use of our website after changes
              constitutes acceptance of the updated policy.
            </p>

            <h2>13. Contact Us</h2>
            <p>
              For any privacy-related questions or requests:<br />
              <strong>{COMPANY}</strong><br />
              {ADDRESS}<br />
              <a href={`mailto:${EMAIL}`}>{EMAIL}</a>
            </p>
          </div>

          <div className="mt-12 pt-8 border-t border-border flex flex-wrap gap-4">
            <Link href="/terms" className="text-primary hover:underline text-sm font-medium">Terms of Service →</Link>
            <Link href="/contact" className="text-primary hover:underline text-sm font-medium">Contact Us →</Link>
          </div>
        </div>
      </section>
    </div>
  );
}
