@extends('layouts.app')

@section('title')
Terms &amp; Conditions — Hamza Enterprises
@endsection

@section('meta_description')
Read Hamza Enterprises' terms and conditions regarding user registration, copyright ownership, buying conditions, and payment processing rules.
@endsection

@push('styles')
<style>
  /* Terms & Conditions Styles */
  .legal-box {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 40px;
    margin-bottom: 30px;
  }
  .legal-box h2 {
    font-size: 1.5rem;
    color: var(--ink);
    margin: 0 0 20px 0;
    font-weight: 700;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--border);
  }
  .legal-box p {
    color: var(--ink-light);
    font-size: 0.96rem;
    line-height: 1.7;
    margin-bottom: 20px;
  }
  .legal-box h3 {
    font-size: 1.2rem;
    color: var(--ink);
    margin: 30px 0 15px 0;
    font-weight: 700;
  }
  .legal-box h4 {
    font-size: 1.05rem;
    color: var(--accent);
    margin: 20px 0 10px 0;
    font-weight: 700;
  }
  .legal-box ul, .legal-box ol {
    margin: 15px 0;
    padding-left: 20px;
    color: var(--ink-light);
    font-size: 0.95rem;
  }
  .legal-box li {
    margin-bottom: 8px;
    line-height: 1.6;
  }
  .accept-bar {
    background: var(--surface-light);
    border: 1px dashed var(--border);
    border-radius: var(--radius-sm);
    padding: 15px 20px;
    margin-bottom: 25px;
    font-size: 0.95rem;
    color: var(--ink);
    font-weight: 700;
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
        <h1>Terms &amp; Conditions</h1>
        <p>Please read our terms of service carefully before registering an account or initiating a vehicle buying process on Hamza Enterprises.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: Terms Text -->
    <div class="events-main-feed">
      
      <div class="legal-box">
        <h2>Website Terms of Use</h2>
        
        <div class="accept-bar">
          By using this website, you accept and agree with our Terms of Use ("I have read and agree to the T&amp;C").
        </div>

        <h3>1. General Provisions</h3>
        <p>Before purchasing any vehicle, the user should confirm all the information (prices and condition of the vehicles). Used vehicles are not in perfect condition. Some parts may need to be fixed or replaced. Vehicles categorized as "Taxis" may be in a poorer condition and have higher mileage compared to other privately owned vehicles.</p>

        <h3>2. Ownership and Permissions</h3>
        <p>Hamza Enterprises was created for your personal, non-commercial use only. All materials used on this site belong to Hamza Enterprises or its licensors and are protected by copyright laws. Except as permitted by the copyright law applicable to you, you may not reproduce or communicate any of the content on this website, including hamzaenterprises.com text and the logo, which are the trademarks of Hamza Enterprises, without the explicit written permission of the copyright owner.</p>

        <h3>3. Registration Process</h3>
        <p>To access Hamza Enterprises customer services and initiate sales, the visitor must register on our platform. The visitor will select a username and a password. The visitor must agree that the information supplied during the registration process is accurate. Hamza Enterprises reserves the right to refuse the use of a username that we consider offensive or inappropriate. The user is fully responsible for preserving the confidentiality of the password and for all actions of a third party accessing the platform through any username/password assigned to the user. The user will notify us immediately of any unknown or suspected unauthorized use of the account.</p>

        <h3>4. Delete Account Process</h3>
        <p>When the users voluntarily choose "Delete Account" to withdraw their membership, the automated emails will be stopped. In case the user breaks any of the membership rules mentioned above, the account will be deleted automatically without notice. Reasons for automatic deletion include:</p>
        <ul>
          <li>The user violates the website agreement or acts against the law.</li>
          <li>The user's registration is not the user oneself.</li>
          <li>The registered information provided is false or misleading.</li>
        </ul>

        <h2 style="margin-top: 40px;">Hamza Enterprises Buying Process T&amp;C</h2>
        
        <h3>1. Trade Conditions</h3>
        <ul>
          <li><strong>Payment Terms:</strong> Hamza Enterprises' strict buying condition of payment is via transfer by <strong>T/T (Telegraphic Transfer)</strong>.</li>
        </ul>

        <h3>2. Payment Rules</h3>
        <ul>
          <li><strong>Invoice Validity:</strong> The buyer must confirm the purchase of the vehicle within <strong>72 hours</strong> after the Proforma Invoice (PI) is sent. An invoice without confirmation within 72 hours will be considered invalid and the process of buying will be canceled.</li>
          <li><strong>Total Deposit:</strong> The transfer amount must be <strong>100%</strong> of the total (the price of the vehicle and shipping cost combined). We do not support installment plans or credit card processing.</li>
          <li><strong>Right to Cancel:</strong> Hamza Enterprises reserves the right to cancel any transaction if there is a problem with the verification of the transaction process or payment clearance.</li>
        </ul>

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
          <li class="active"><a href="terms-conditions">Terms &amp; Conditions</a></li>
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
