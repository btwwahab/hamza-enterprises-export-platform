@extends('layouts.app')

@section('title')
About Us — Hamza Enterprises
@endsection

@section('meta_description')
Meet Hamza Enterprises, the leading certified used vehicle exporter in South Korea. Read about our company mission, vision, CEO message, international team, and global showrooms.
@endsection

@php($navActive = 'about')

@push('styles')
<style>
  /* About Us Page Custom Styles */
  .about-intro-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-bottom: 50px;
  }
  @media (max-width: 768px) {
    .about-intro-grid {
      grid-template-columns: 1fr;
      gap: 30px;
    }
  }
  .about-features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 30px;
  }
  .about-feature-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 20px;
    transition: all 0.25s ease;
  }
  .about-feature-card:hover {
    border-color: var(--accent);
  }
  .about-feature-card h4 {
    margin: 0 0 8px 0;
    color: var(--ink);
    font-size: 1rem;
    font-weight: 700;
  }
  .about-feature-card p {
    margin: 0;
    font-size: 0.85rem;
    color: var(--ink-light);
    line-height: 1.5;
  }

  .about-image-wrapper {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--border);
    background: var(--surface-light);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 300px;
  }
  .about-image-wrapper svg {
    color: var(--accent);
    opacity: 0.85;
  }

  /* Vision and Mission */
  .vision-mission-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 50px;
  }
  @media (max-width: 768px) {
    .vision-mission-grid {
      grid-template-columns: 1fr;
    }
  }
  .vision-box {
    background: linear-gradient(135deg, rgba(0, 240, 255, 0.03) 0%, rgba(9, 14, 23, 0.05) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 30px;
  }
  .vision-box h3 {
    margin: 0 0 15px 0;
    font-size: 1.15rem;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
  }
  .vision-box p {
    font-size: 1.05rem;
    color: var(--ink);
    font-style: italic;
    line-height: 1.6;
    margin: 0;
  }

  /* CEO Block */
  .ceo-block {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 40px;
    margin-bottom: 50px;
    position: relative;
    overflow: hidden;
  }
  .ceo-block::before {
    content: "“";
    position: absolute;
    top: -20px;
    left: 20px;
    font-size: 12rem;
    color: var(--border);
    opacity: 0.3;
    font-family: serif;
    pointer-events: none;
  }
  .ceo-block h3 {
    margin: 0 0 20px 0;
    font-size: 1.25rem;
    color: var(--ink);
    font-weight: 700;
  }
  .ceo-block p {
    font-size: 0.96rem;
    color: var(--ink-light);
    line-height: 1.7;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
  }
  .ceo-signature {
    margin-top: 30px;
    border-top: 1px solid var(--border);
    padding-top: 20px;
    display: inline-block;
  }
  .ceo-signature h5 {
    margin: 0;
    font-size: 1.1rem;
    color: var(--ink);
    font-weight: 700;
  }
  .ceo-signature span {
    font-size: 0.8rem;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Showrooms Grid */
  .showrooms-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 50px;
  }
  @media (max-width: 768px) {
    .showrooms-grid {
      grid-template-columns: 1fr;
    }
  }
  .showroom-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px;
    transition: all 0.25s ease;
  }
  .showroom-card:hover {
    border-color: var(--accent);
  }
  .showroom-card h4 {
    margin: 0 0 12px 0;
    font-size: 1.15rem;
    color: var(--ink);
    font-weight: 700;
  }
  .showroom-card p {
    margin: 0 0 16px 0;
    font-size: 0.88rem;
    color: var(--ink-light);
    line-height: 1.5;
  }
  .showroom-meta {
    border-top: 1px solid var(--border);
    padding-top: 14px;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .showroom-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: var(--ink);
  }
  .showroom-meta-item svg {
    color: var(--accent);
  }
  .showroom-meta-item a {
    color: var(--ink);
    text-decoration: none;
  }
  .showroom-meta-item a:hover {
    color: var(--accent);
  }

  /* Team Grid */
  .team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
  }
  @media (max-width: 992px) {
    .team-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 576px) {
    .team-grid {
      grid-template-columns: 1fr;
    }
  }
  .team-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 20px;
    text-align: center;
    transition: all 0.25s ease;
  }
  .team-card:hover {
    border-color: var(--accent);
    transform: translateY(-4px);
  }
  .team-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--surface-light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px auto;
    border: 1px solid var(--border);
    color: var(--accent);
  }
  .team-card h4 {
    margin: 0 0 4px 0;
    font-size: 1.05rem;
    color: var(--ink);
    font-weight: 700;
  }
  .team-card span {
    display: block;
    font-size: 0.8rem;
    color: var(--ink-faint);
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .team-languages {
    font-size: 0.8rem;
    color: var(--ink-light);
    line-height: 1.4;
  }

  /* Section Title */
  .about-sec-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .about-sec-title span {
    color: var(--accent);
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
        <h1>About Our Company</h1>
        <p>Sourcing and exporting certified used vehicles and machinery from South Korea to global buyers with trust and transparency.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: About Main Info -->
    <div class="events-main-feed">
      
      <!-- Welcome Section -->
      <div class="about-intro-grid">
        <div>
          <h2 style="font-size: 1.6rem; color: var(--ink); margin: 0 0 15px 0; font-weight: 800;">Welcome to Hamza Enterprises</h2>
          <p style="color: var(--ink-light); line-height: 1.6; font-size: 0.95rem; margin: 0 0 20px 0;">HAMZA ENTERPRISES is a trusted exporter of Korean used vehicles and machinery. Our experienced team helps customers purchase, inspect, and export vehicles with complete transparency. We export to Africa, the Middle East, Asia, Europe, South America, and many other international markets.</p>

          <div class="about-features-grid">
            <div class="about-feature-card">
              <h4>Competitive Export Prices</h4>
              <p>Fair, transparent pricing on every vehicle and machinery unit we export.</p>
            </div>
            <div class="about-feature-card">
              <h4>Fast Documentation</h4>
              <p>We handle export paperwork quickly so your shipment isn't delayed.</p>
            </div>
            <div class="about-feature-card">
              <h4>Secure Banking</h4>
              <p>Official company bank accounts for safe, verifiable payments.</p>
            </div>
            <div class="about-feature-card">
              <h4>Long-Term Relationships</h4>
              <p>We build lasting partnerships with repeat buyers and dealers worldwide.</p>
            </div>
          </div>
        </div>

        <div class="about-image-wrapper">
          <!-- Placeholder SVG illustration symbolizing trusted automotive export partnership -->
          <svg width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
          </svg>
        </div>
      </div>

      <!-- Vision & Mission -->
      <div class="vision-mission-grid">
        <div class="vision-box">
          <h3>Our Promise</h3>
          <p>"Honesty, quality, competitive pricing, fast response, reliable shipping, and customer satisfaction — your trusted partner for Korean vehicle exports."</p>
        </div>
        <div class="vision-box">
          <h3>Our Mission</h3>
          <p>"To connect buyers worldwide with genuine Korean used vehicles and machinery, backed by honest inspection, fast documentation, and reliable shipping from Korea to your destination."</p>
        </div>
      </div>

      <!-- About Company -->
      <div class="ceo-block" style="margin-bottom: 40px;">
        <h3>About Company</h3>
        <p>HAMZA ENTERPRISES is a trusted exporter of Korean used vehicles and machinery, based in Incheon, South Korea. Our experienced team helps customers purchase, inspect, and export vehicles with complete transparency, working alongside our partner company Fatima Trading to serve buyers across Africa, the Middle East, Asia, Europe, and South America.</p>
      </div>

      <!-- Leadership -->
      <div class="ceo-block">
        <h3>Our Team</h3>
        <p>Hamza Enterprises and Fatima Trading operate together as one export business, led by:</p>

        <div class="ceo-signature" style="display: block; width: 100%;">
          <h5>Hamza Khan Jadoon</h5>
          <span>Manager, Hamza Enterprises</span>
          <p style="margin: 10px 0 0; font-size: 0.9rem;">Tel / WhatsApp: <a href="tel:+821064995384" style="color: var(--accent);">+82 10 6499 5384</a></p>
        </div>
        <div class="ceo-signature" style="display: block; width: 100%; margin-top: 20px;">
          <h5>Muhammad Shahbaz</h5>
          <span>CEO, Fatima Trading</span>
          <p style="margin: 10px 0 0; font-size: 0.9rem;">Tel: <a href="tel:+821080301614" style="color: var(--accent);">+82 10 8030 1614</a></p>
        </div>
      </div>

      <!-- Showrooms Section -->
      <h3 class="about-sec-title"><span>02.</span> Our Office &amp; Yard</h3>
      <div class="showrooms-grid">
        <div class="showroom-card">
          <h4>Hamza Enterprises — Head Office</h4>
          <p>Main headquarters and administrative export desk.</p>
          <div class="showroom-meta">
            <div class="showroom-meta-item">
              <svg width="16" height="16"><use href="#icon-pin"/></svg>
              <span>Room 102, Building 11, Byeoksan Village, 348-141 Okryeon-dong, Yeonsu-gu, Incheon, South Korea</span>
            </div>
            <div class="showroom-meta-item">
              <svg width="16" height="16"><use href="#icon-phone"/></svg>
              <span>Tel: <a href="tel:+821064995384">+82-10-6499-5384</a></span>
            </div>
            <div class="showroom-meta-item">
              <svg width="16" height="16"><use href="#icon-mail"/></svg>
              <span>WhatsApp: <a href="https://wa.me/821064995384">+82-10-6499-5384</a></span>
            </div>
          </div>
        </div>

        <div class="showroom-card">
          <h4>Export Yard — Songdo</h4>
          <p>Our yard stocks a wide range of Korean vehicles and machinery ready for export.</p>
          <div class="showroom-meta">
            <div class="showroom-meta-item">
              <svg width="16" height="16"><use href="#icon-pin"/></svg>
              <span>Incheon Songdo, South Korea</span>
            </div>
            <div class="showroom-meta-item">
              <svg width="16" height="16"><use href="#icon-phone"/></svg>
              <span>Tel: <a href="tel:+821064995384">+82-10-6499-5384</a></span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Column: Sidebar -->
    <aside class="events-sidebar">
      
      <!-- Support Pages Widget -->
      <div class="sidebar-widget">
        <h4>Support Pages</h4>
        <ul class="support-pages-list">
          <li class="active"><a href="about-us">About Us</a></li>
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
