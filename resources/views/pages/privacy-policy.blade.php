@extends('layouts.app')

@section('title')
Privacy Policy — Hamza Enterprises
@endsection

@section('meta_description')
Read Hamza Enterprises' privacy policy statement regarding how we collect, store, protect, and use visitor and member information.
@endsection

@push('styles')
<style>
  /* Privacy Policy Styles */
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
  .legal-box ul {
    margin: 15px 0;
    padding-left: 20px;
    color: var(--ink-light);
    font-size: 0.95rem;
  }
  .legal-box li {
    margin-bottom: 8px;
    line-height: 1.6;
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
        <h1>Privacy Policy</h1>
        <p>Learn more about how Hamza Enterprises collects, utilizes, manages, and safeguards visitor personal data.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: Privacy Policy Text -->
    <div class="events-main-feed">
      
      <div class="legal-box">
        <h2>Privacy Policy Statement</h2>
        <p>The priority of Hamza Enterprises is to protect the privacy of the visitors to our website. To maintain and preserve the respect of confidentiality, Hamza Enterprises created this Privacy Policy Statement that all visitors must read carefully to understand the information we collect on our website and accept the terms of use. This information is collected directly from our website exclusively and not from other websites.</p>
        <p>Hamza Enterprises does not share, sell, or publish the user's personal information to third parties. However, we may use the user's email for informational purposes related to the company products and vehicles that the user might be interested in.</p>

        <h3>1. Information Collected</h3>
        <p>Hamza Enterprises does not generate income from advertisements. As a result, we do not collect data to advertise products from third parties. Our website collects information from our customers exclusively to improve our system features and offer a better, more secure service.</p>
        <p>The information provided by visitors to our website (such as email addresses) and other data that we collect based on user actions (such as what pages the user accesses and the interaction they have with our search functions) are used exclusively to create a better buying experience for our customers.</p>

        <h4>Information Searches</h4>
        <p>To make use of certain features on our site, visitors need to provide limited information about themselves and their vehicle interests. As a result, our platform can suggest optimal shipping and price quotes according to their needs. In this case, Hamza Enterprises gets this kind of information when the user performs a search filter.</p>

        <h4>Email Addresses</h4>
        <p>When the user provides an email address, Hamza Enterprises may email the user about the website and listings, or inquire about the user's experience using the website. Besides, we will also send emails that may include shipping schedule updates, special promotions, and inventory offers that may be of interest to the user.</p>

        <h4>Cookies</h4>
        <p>To adapt our website to the needs and interests of the visitors, we keep track of the pages visited by the users by placing a cookie, a small entry in a text file, on your hard drive. The cookie contains an ID number that allows us to track the pages the user visited. These cookies are used with the purpose to track overall visitor traffic patterns. We use this information to improve the website by making it more responsive to the needs of the users. Cookies do not reveal personal data; the only personal information a cookie can contain is the one the user provides personally.</p>

        <h3>2. Disclosure Cases</h3>
        <p>The website may release information about the visitors in the following cases:</p>
        <ul>
          <li>When required to obey the law or respond to legal processes.</li>
          <li>To enforce our Terms &amp; Conditions.</li>
          <li>To protect the rights, property, or safety of visitors to our site, our customers, the public, or Hamza Enterprises.</li>
        </ul>
        <p>When we use other logistics or IT companies to help operate the website or improve shipping services, we may provide them with information about the visitors that is necessary for those companies to perform their services. We strictly require these companies to commit to using the information only to perform the services that are required.</p>

        <h3>3. Protecting the Privacy of Children</h3>
        <p>Our website is not created for children. As a result, we will not allow them to provide our site any personal information. Children must always get permission from their parents or guardians before sending any kind of personal information about themselves (names, email, address, phone numbers) over the Internet.</p>

        <h3>4. Changes of Privacy Policy</h3>
        <p>In case Hamza Enterprises needs to change the privacy policy of the site, the changes will be posted on the website and notify the effective date. The user must be aware by visiting our site, that they agree with the Privacy Policy and the Terms of Use.</p>

        <h3>5. Security</h3>
        <p>User and visitor information gathered by the website is stored on servers maintained in protected environments. However, Hamza Enterprises cannot guarantee the absolute security of the servers or databases, nor that information supplied by the users and visitors would not be intercepted while it is transmitted to our website over the Internet.</p>
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
          <li class="active"><a href="privacy-policy">Privacy Policy</a></li>
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
