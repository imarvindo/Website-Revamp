import { Link } from "wouter";

const LAST_UPDATED = "1 January 2025";
const COMPANY = "SearchEngineOptimization.ae FZ-LLC";
const EMAIL = "legal@searchengineoptimization.ae";

export default function Terms() {
  return (
    <div className="flex flex-col min-h-screen">
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-20 relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 max-w-3xl">
          <div className="section-label mb-6 text-white border-white/20 bg-white/10">Legal</div>
          <h1 className="text-5xl font-extrabold text-white mb-4">Terms of Service</h1>
          <p className="text-white/60">Last updated: {LAST_UPDATED}</p>
        </div>
      </section>

      <section className="py-20 bg-background">
        <div className="container mx-auto px-4 max-w-3xl">
          <div className="prose prose-lg max-w-none text-muted-foreground prose-headings:text-foreground prose-headings:font-bold prose-a:text-primary">

            <h2>1. Acceptance of Terms</h2>
            <p>
              By accessing or using the website at{" "}
              <a href="https://searchengineoptimization.ae">searchengineoptimization.ae</a> or
              engaging {COMPANY} ("SEO.ae", "we", "us", "our") for any services, you agree to be
              bound by these Terms of Service ("Terms"). If you do not agree, please do not use
              our website or services.
            </p>

            <h2>2. Services</h2>
            <p>
              SEO.ae provides digital marketing services including but not limited to: search engine
              optimisation, pay-per-click advertising, social media marketing, web design, web
              development, and content strategy (collectively, "Services"). The specific scope,
              deliverables, fees, and timelines for Services are set out in a separate Statement of
              Work ("SOW") or Service Agreement executed between SEO.ae and the client.
            </p>

            <h2>3. Proposals and Agreements</h2>
            <p>
              All proposals issued by SEO.ae are valid for 30 days from the date of issue unless
              stated otherwise. A binding client engagement commences upon receipt of a signed
              Service Agreement or SOW and the applicable initial payment. No work will commence
              prior to this.
            </p>

            <h2>4. Fees and Payment</h2>
            <ul>
              <li>Monthly retainer fees are due on the first business day of each billing month unless otherwise agreed.</li>
              <li>Project-based fees follow the payment schedule set out in the applicable SOW.</li>
              <li>Invoices not settled within 14 days of the due date may attract a late payment interest of 2% per month.</li>
              <li>All fees are exclusive of VAT. SEO.ae will charge UAE Value Added Tax at the applicable rate where required by law.</li>
              <li>Ad spend paid to third-party platforms (Google, Meta, LinkedIn, etc.) is billed separately and is not included in management fees unless explicitly stated.</li>
            </ul>

            <h2>5. Intellectual Property</h2>
            <h3>5.1 Client Materials</h3>
            <p>
              You retain ownership of all brand assets, content, and data you provide to us. You
              grant SEO.ae a non-exclusive, royalty-free licence to use such materials solely for the
              purpose of delivering the Services.
            </p>
            <h3>5.2 Deliverables</h3>
            <p>
              Upon receipt of full payment, all custom deliverables created specifically for your
              project (written content, designs, code) become your property. SEO.ae retains the
              right to display such work in its portfolio unless you request otherwise in writing.
            </p>
            <h3>5.3 Pre-existing Tools & Methodologies</h3>
            <p>
              Any tools, frameworks, scripts, or proprietary methodologies developed by SEO.ae
              independently of your engagement remain the exclusive intellectual property of SEO.ae.
            </p>

            <h2>6. Client Obligations</h2>
            <p>To enable SEO.ae to deliver Services effectively, you agree to:</p>
            <ul>
              <li>Provide timely access to required accounts (Google Analytics, Search Console, CMS, ad platforms) within 5 business days of contract commencement.</li>
              <li>Respond to requests for information, approvals, and feedback within 5 business days unless a shorter timeframe is specified.</li>
              <li>Ensure all materials you provide do not infringe the intellectual property rights of any third party.</li>
              <li>Not implement changes to your website or campaigns in areas under SEO.ae's management without prior written notification.</li>
            </ul>

            <h2>7. Confidentiality</h2>
            <p>
              Both parties agree to keep confidential any information designated as confidential or
              that a reasonable person would consider confidential, including strategies, pricing,
              data, and business plans. This obligation survives termination of the engagement for
              3 years.
            </p>

            <h2>8. No Guarantee of Rankings</h2>
            <p>
              Search engine algorithms are determined by third parties (Google, Bing, etc.) and are
              subject to change without notice. SEO.ae does not guarantee specific rankings,
              positions, traffic volumes, or revenue outcomes. We commit to applying industry best
              practices and measurable, transparent effort toward agreed goals.
            </p>

            <h2>9. Termination</h2>
            <ul>
              <li><strong>By client:</strong> After any minimum term stated in the SOW, you may terminate by providing 30 days' written notice. Fees accrued through the notice period remain payable.</li>
              <li><strong>By SEO.ae:</strong> We may terminate immediately if you breach these Terms, fail to pay invoices within 30 days of the due date, or engage in conduct that is unlawful or harmful to our reputation.</li>
              <li><strong>Effect of termination:</strong> Upon termination, we will transfer all your data, credentials, and deliverables within 14 business days. Any outstanding fees become immediately due.</li>
            </ul>

            <h2>10. Limitation of Liability</h2>
            <p>
              To the maximum extent permitted by UAE law, SEO.ae's total liability for any claim
              arising from these Terms or the provision of Services shall not exceed the total fees
              paid by you to SEO.ae in the 3 months immediately preceding the event giving rise to
              the claim. SEO.ae is not liable for indirect, consequential, or special damages,
              including loss of profits or loss of data.
            </p>

            <h2>11. Indemnification</h2>
            <p>
              You agree to indemnify and hold SEO.ae harmless from any claims, losses, or expenses
              (including legal fees) arising from: (a) your breach of these Terms; (b) content or
              materials you provide that infringe a third party's rights; or (c) your use of
              deliverables in a manner not authorised by these Terms.
            </p>

            <h2>12. Governing Law & Dispute Resolution</h2>
            <p>
              These Terms are governed by the laws of the United Arab Emirates and the Emirate of
              Dubai. Any dispute shall first be referred to good-faith negotiation. If unresolved
              within 30 days, disputes shall be submitted to the exclusive jurisdiction of the
              Dubai Courts.
            </p>

            <h2>13. Changes to Terms</h2>
            <p>
              We may update these Terms from time to time. Updated Terms take effect upon posting to
              this page. Continued use of our website or Services after that date constitutes
              acceptance of the revised Terms.
            </p>

            <h2>14. Contact</h2>
            <p>
              For any questions regarding these Terms:<br />
              <strong>{COMPANY}</strong><br />
              M-01, Muteena Street, Deira, Dubai, UAE<br />
              <a href={`mailto:${EMAIL}`}>{EMAIL}</a>
            </p>
          </div>

          <div className="mt-12 pt-8 border-t border-border flex flex-wrap gap-4">
            <Link href="/privacy" className="text-primary hover:underline text-sm font-medium">Privacy Policy →</Link>
            <Link href="/contact" className="text-primary hover:underline text-sm font-medium">Contact Us →</Link>
          </div>
        </div>
      </section>
    </div>
  );
}
