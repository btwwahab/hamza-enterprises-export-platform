@extends('layouts.app')

@section('title')
Claim Center — Hamza Enterprises
@endsection

@section('meta_description')
Read Hamza Enterprises claim policy, eligibility requirements, exclusions, and guidelines for filing transport or mechanical claims.
@endsection

@push('styles')
<style>
  /* Claim Center Styles */
  .claim-section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .claim-section-title span {
    color: var(--accent);
  }
  .policy-box {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 30px;
    margin-bottom: 35px;
  }
  .policy-box.warning {
    border-left: 4px solid #dc2626;
  }
  .policy-box.success {
    border-left: 4px solid var(--accent);
  }
  .policy-box h3 {
    font-size: 1.25rem;
    color: var(--ink);
    margin: 0 0 15px 0;
    font-weight: 700;
  }
  .policy-box p {
    color: var(--ink-light);
    line-height: 1.6;
    margin: 0 0 15px 0;
    font-size: 0.95rem;
  }
  .policy-box ul, .policy-box ol {
    margin: 15px 0;
    padding-left: 20px;
    color: var(--ink-light);
    font-size: 0.95rem;
  }
  .policy-box li {
    margin-bottom: 8px;
    line-height: 1.55;
  }
  .policy-box li strong {
    color: var(--ink);
  }

  /* Claim Process Flow */
  .process-flow {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 30px 0;
  }
  .process-step {
    background: var(--surface-light);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 25px 20px;
    text-align: center;
    position: relative;
  }
  .process-step-num {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--accent);
    color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1rem;
    margin: 0 auto 15px auto;
  }
  .process-step h4 {
    margin: 0 0 8px 0;
    font-size: 1.05rem;
    color: var(--ink);
    font-weight: 700;
  }
  .process-step p {
    font-size: 0.85rem;
    color: var(--ink-light);
    line-height: 1.5;
    margin: 0;
  }

  @media (max-width: 768px) {
    .process-flow {
      grid-template-columns: 1fr;
      gap: 15px;
    }
  }

  /* Support Pages list styling */
  .support-pages-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .support-pages-list li {
    margin-bottom: 8px;
  }
  .support-pages-list a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    color: var(--ink-light);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    border: 1px solid transparent;
  }
  .support-pages-list a:hover {
    background: var(--surface-light);
    color: var(--accent);
  }
  .support-pages-list li.active a {
    background: var(--accent-light);
    color: var(--accent);
    border-color: rgba(0, 240, 255, 0.2);
  }

  /* Need Help Widget */
  .need-help-widget {
    background: linear-gradient(135deg, rgba(0, 240, 255, 0.04) 0%, rgba(220, 38, 38, 0.04) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 26px;
    text-align: center;
  }
  .need-help-widget h4 {
    margin: 0 0 10px 0;
    font-size: 1.25rem;
    color: var(--ink);
    font-weight: 700;
  }
  .need-help-widget p {
    font-size: 0.88rem;
    color: var(--ink-light);
    line-height: 1.55;
    margin-bottom: 22px;
  }
  .help-contacts {
    text-align: left;
    margin-bottom: 22px;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .help-contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.92rem;
    color: var(--ink);
  }
  .help-contact-item svg {
    color: var(--accent);
    flex-shrink: 0;
  }
  .help-contact-item a {
    color: var(--ink);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
  }
  .help-contact-item a:hover {
    color: var(--accent);
  }
  .help-footer-meta {
    font-size: 0.72rem;
    color: var(--ink-faint);
    border-top: 1px solid var(--border);
    padding-top: 14px;
    margin-top: 18px;
    display: flex;
    justify-content: space-around;
  }
</style>
@endpush

@section('content')
<main>

  <section class="cars-hero" style="background: linear-gradient(135deg, #090e17 40%, #101926 100%); padding: 60px 0;">
    <div class="container">
      <div class="cars-hero-content">
        <h1>Claim Center</h1>
        <p>Hamza Enterprises values your satisfaction. If you encounter mechanical issues or shipping discrepancies, our resolution team is here to help.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: Claim Guidelines -->
    <div class="events-main-feed">
      
      <div class="policy-box success">
        <h3>1. Compensation is Applicable</h3>
        <p>You are eligible to apply for compensation or resolution if you meet the following terms:</p>
        <ul>
          <li><strong>Eligible Defects:</strong> Severe, non-declared engine internal defects, transmission mechanical failures, or complete 4WD transfer case failures.</li>
          <li><strong>Specification Discrepancies:</strong> Mismatches in the physical chassis number (VIN), engine displacement volume, fuel type, or critical options originally invoiced.</li>
          <li><strong>Strict Filing Window:</strong> The claim must be filed within <strong>14 calendar days</strong> of the vessel's arrival at your destination port.</li>
          <li><strong>Mileage Limit:</strong> The vehicle must have been driven <strong>less than 100 kilometers</strong> after arrival.</li>
          <li><strong>Video Evidence:</strong> You must supply a continuous video proving the issue. The video must show the vehicle chassis number, odometer reading, and symptoms in one take.</li>
        </ul>
      </div>

      <div class="policy-box warning">
        <h3>2. Do Not Disassemble or Fix It First</h3>
        <p><strong>Crucial Warning:</strong> If you suspect any defect, do not proceed with any disassembly, engine opening, or local repair before receiving confirmation from Hamza Enterprises. Any unauthorized alterations to the vehicle's engine or parts automatically voids the claim eligibility.</p>
      </div>

      <div class="policy-box" style="border-left: 4px solid #636b7b;">
        <h3>3. Compensation is NOT Applicable</h3>
        <p>The following issues do not qualify for compensation:</p>
        <ul>
          <li><strong>Exterior &amp; Cosmetic issues:</strong> Normal body scratches, small dents, surface rust, minor glass chips, worn seat upholstery, dirty carpets, or minor cosmetic weathering.</li>
          <li><strong>Missing/Stolen Accessories post-shipment:</strong> Theft of GPS/navigation systems, backup cameras, spare tires, tools, SD cards, or catalytic converters during sea transit or at destination customs.</li>
          <li><strong>Standard Wear &amp; Consumables:</strong> Noise/vibrations standard for used vehicles, minor fluid leaks, batteries, spark plugs, radiator corrosion, water pumps, fuel pumps, or suspension bushings.</li>
          <li><strong>Low Price Capping:</strong> For vehicles sold under <strong>USD 2,000</strong>, the maximum claim compensation is strictly capped at <strong>USD 200</strong> and only applies to severe engine and transmission failures.</li>
          <li><strong>No Repair Costs Reimbursement:</strong> We do not directly pay for local mechanics or workshop repair quotes in the destination country.</li>
          <li><strong>Invoice Value limit:</strong> Under no circumstances can the total compensation amount exceed the initial FOB invoice value of the vehicle.</li>
        </ul>
      </div>

      <h3 class="claim-section-title"><span>02.</span> Claim Process</h3>
      <div class="process-flow">
        <div class="process-step">
          <div class="process-step-num">1</div>
          <h4>Submit Claim</h4>
          <p>Navigate to your Order Details, select "File a Claim" and upload the required video proof showing chassis and odometer.</p>
        </div>
        <div class="process-step">
          <div class="process-step-num">2</div>
          <h4>Verification</h4>
          <p>Our claims department will verify the vehicle condition reports, loading yard images, and the submitted proof within 3 business days.</p>
        </div>
        <div class="process-step">
          <div class="process-step-num">3</div>
          <h4>Resolution</h4>
          <p>Approved claims receive parts replacement, discount credits for future purchases, or a partial refund directly.</p>
        </div>
      </div>

      <div class="policy-box" style="margin-top: 30px; background: var(--surface-light);">
        <h3>How to File a Claim</h3>
        <ol>
          <li>Sign in to your account and go to the <strong>My Orders</strong> section.</li>
          <li>Find the vehicle order in question and click <strong>File a Claim</strong>.</li>
          <li>Complete the form details, write a brief description of the symptoms, and attach your video file.</li>
        </ol>
      </div>

    </div>

    <!-- Right Column: Sidebar -->
    <aside class="events-sidebar">
      
      <!-- Support Pages Widget -->
      <div class="sidebar-widget">
        <h4>Support Pages</h4>
        <ul class="support-pages-list">
          <li><a href="about-us">About Us</a></li>
          <li><a href="cars">About Korean Cars</a></li>
          <li><a href="contact-us">Contact Us</a></li>
          <li><a href="faq">FAQ</a></li>
          <li><a href="privacy-policy">Privacy Policy</a></li>
          <li><a href="terms-conditions">Terms &amp; Conditions</a></li>
        </ul>
      </div>

      <!-- Need Help Widget -->
      <div class="sidebar-widget" style="padding: 0;">
        <div class="need-help-widget">
          <h4>Need Help?</h4>
          <p>If you have any further questions, contact us at any time! We are here to support you 24/7.</p>
          
          <div class="help-contacts">
            <div class="help-contact-item">
              <svg width="18" height="18"><use href="#icon-phone"/></svg>
              <span>Tel: <a href="tel:+821064995384">+82-10-6499-5384</a></span>
            </div>
            <div class="help-contact-item">
              <svg width="18" height="18"><use href="#icon-mail"/></svg>
              <span>WhatsApp: <a href="https://wa.me/821064995384">+82-10-6499-5384</a></span>
            </div>
          </div>

          <a href="contact-us" class="btn btn-primary" style="width: 100%; display: block; background: #dc2626; border-color: #dc2626; font-size: 0.9rem; font-weight: 700; padding: 12px;">Contact us</a>
          
          <div class="help-footer-meta">
            <span>Incheon, South Korea</span>
            <span>·</span>
            <span>24/7 Support</span>
            <span>·</span>
            <span>KST Office</span>
          </div>
        </div>
      </div>

    </aside>
  </div>

</main>
@endsection

@push('scripts')
<!-- Dropdown Interaction Script -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const dropdown = document.querySelector(".nav-dropdown-more");
    const trigger = document.querySelector(".nav-dropdown-more .nav-dropdown-trigger");
    if (dropdown && trigger) {
      trigger.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropdown.classList.toggle("active");
      });
      document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove("active");
        }
      });
    }
  });
</script>
@endpush
