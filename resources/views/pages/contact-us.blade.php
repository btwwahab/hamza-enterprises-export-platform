@extends('layouts.app')

@section('title')
Contact Us — Hamza Enterprises
@endsection

@section('meta_description')
Contact the export team of Hamza Enterprises. Send an inquiry, get phone or WhatsApp support, check our yard showroom locations, and connect with us online.
@endsection

@push('styles')
<style>
  /* Contact Us Layout */
  .contact-layout-grid {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
    margin-bottom: 50px;
  }
  @media (max-width: 992px) {
    .contact-layout-grid {
      grid-template-columns: 1fr;
      gap: 30px;
    }
  }

  /* Left Column: Support Info */
  .support-info-sec {
    display: flex;
    flex-direction: column;
    gap: 25px;
  }
  .info-detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 26px;
  }
  .info-detail-card h3 {
    margin: 0 0 15px 0;
    font-size: 1.15rem;
    color: var(--ink);
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .info-detail-card h3 svg {
    color: var(--accent);
  }
  .info-detail-card p {
    margin: 0 0 12px 0;
    font-size: 0.92rem;
    color: var(--ink-light);
    line-height: 1.55;
  }
  .info-items-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .info-item-row {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.92rem;
    color: var(--ink);
  }
  .info-item-row svg {
    color: var(--accent);
  }
  .info-item-row a {
    color: var(--ink);
    text-decoration: none;
    font-weight: 600;
  }
  .info-item-row a:hover {
    color: var(--accent);
  }

  /* Social Icons Grid */
  .social-connect-grid {
    display: flex;
    gap: 12px;
    margin-top: 15px;
  }
  .social-connect-btn {
    width: 42px;
    height: 42px;
    border-radius: var(--radius-sm);
    background: var(--surface-light);
    border: 1px solid var(--border);
    color: var(--ink-light);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    text-decoration: none;
  }
  .social-connect-btn:hover {
    background: var(--accent-light);
    color: var(--accent);
    border-color: var(--accent);
    transform: translateY(-2px);
  }

  /* Map Card */
  .map-embed-container {
    background: var(--surface-light);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
  }
  .map-embed-container svg {
    color: var(--accent);
    opacity: 0.85;
  }

  /* Right Column: Contact Form */
  .contact-form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 30px;
    align-self: start;
  }
  .contact-form-card h2 {
    margin: 0 0 8px 0;
    font-size: 1.4rem;
    color: var(--ink);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .contact-form-card p {
    margin: 0 0 25px 0;
    font-size: 0.92rem;
    color: var(--ink-light);
  }
  .form-group-item {
    margin-bottom: 16px;
  }
  .form-group-item label {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .form-group-item input, .form-group-item textarea {
    width: 100%;
    background: var(--surface-light);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 12px 16px;
    color: var(--ink);
    font-family: inherit;
    font-size: 0.92rem;
    transition: all 0.2s ease;
  }
  .form-group-item input:focus, .form-group-item textarea:focus {
    border-color: var(--accent);
    outline: none;
    box-shadow: 0 0 10px rgba(0, 240, 255, 0.05);
  }
  .form-group-item textarea {
    resize: vertical;
    min-height: 120px;
  }

  .form-submit-btn {
    width: 100%;
    background: #dc2626;
    border: 1px solid #dc2626;
    color: #fff;
    padding: 14px 20px;
    border-radius: var(--radius-sm);
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.2s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .form-submit-btn:hover {
    background: #b91c1c;
    border-color: #b91c1c;
  }
</style>
@endpush

@section('content')
<main>

  <section class="cars-hero" style="background: linear-gradient(135deg, #090e17 40%, #101926 100%); padding: 60px 0;">
    <div class="container">
      <div class="cars-hero-content">
        <h1>Contact Us</h1>
        <p>Our global export desks are standing by. Get in touch with us today for stock inquiries, shipping quotes, or dealer registration.</p>
      </div>
    </div>
  </section>

  <div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="contact-layout-grid">
      
      <!-- Left Column: Support Info & Map -->
      <div class="support-info-sec">
        
        <div class="info-detail-card">
          <h3><svg width="20" height="20"><use href="#icon-pin"/></svg> Support &amp; Headquarters</h3>
          <p>Hamza Enterprises export division is open Monday through Saturday KST. Contact us directly for stock inquiries, shipping, or dealer registration.</p>
          <div class="info-items-list">
            <div class="info-item-row">
              <svg width="16" height="16"><use href="#icon-pin"/></svg>
              <span>Room 102, Building 11, Byeoksan Village, 348-141 Okryeon-dong, Yeonsu-gu, Incheon, South Korea</span>
            </div>
            <div class="info-item-row">
              <svg width="16" height="16"><use href="#icon-phone"/></svg>
              <span>Fatima Trading: <a href="tel:+821080301614">+82-10-8030-1614</a></span>
            </div>
            <div class="info-item-row">
              <svg width="16" height="16"><use href="#icon-whatsapp"/></svg>
              <span>WhatsApp: <a href="https://wa.me/821080301614" target="_blank" rel="noopener">+82-10-8030-1614</a></span>
            </div>
            <div class="info-item-row">
              <svg width="16" height="16"><use href="#icon-phone"/></svg>
              <span>Hamza Enterprises: <a href="tel:+821064995384">+82-10-6499-5384</a></span>
            </div>
            <div class="info-item-row">
              <svg width="16" height="16"><use href="#icon-whatsapp"/></svg>
              <span>WhatsApp: <a href="https://wa.me/821064995384" target="_blank" rel="noopener">+82-10-6499-5384</a></span>
            </div>
          </div>
        </div>

        <div class="info-detail-card">
          <h3>Connect with Us</h3>
          <p>Follow our shipping updates and live yard arrival ceremonies on social channels:</p>
          <div class="social-connect-grid">
            <a href="#" class="social-connect-btn" aria-label="Facebook"><svg width="18" height="18"><use href="#icon-facebook"/></svg></a>
            <a href="#" class="social-connect-btn" aria-label="YouTube"><svg width="18" height="18"><use href="#icon-youtube"/></svg></a>
            <a href="#" class="social-connect-btn" aria-label="Instagram"><svg width="18" height="18"><use href="#icon-instagram"/></svg></a>
            <a href="#" class="social-connect-btn" aria-label="LinkedIn"><svg width="18" height="18"><use href="#icon-linkedin"/></svg></a>
          </div>
        </div>

        <!-- Interactive Google Map Embed -->
        <div class="map-embed-container" style="height: 350px;">
          <iframe src="https://maps.google.com/maps?q=Byeoksan%20Village,%20Yeonsu-gu,%20Incheon,%20South%20Korea&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

      </div>

      <!-- Right Column: Contact Form -->
      <div class="contact-form-card">
        <h2>Contact Us for Help</h2>
        <p>We are here to support you! Fill out the inquiry form below and an agent will reply within 24 hours.</p>

        @if (session('status'))
          <div class="badge badge-green" style="display:block;margin-bottom:16px;padding:12px 14px;font-size:14px;font-weight:600;border-radius:8px;background:#dcfce7;color:#15803d">{{ session('status') }}</div>
        @endif

        <form id="contactForm" method="POST" action="{{ route('inquiries.store') }}">
          @csrf
          <div class="form-group-item">
            <label for="nameInput">Your Name (required)</label>
            <input type="text" id="nameInput" name="name" value="{{ old('name') }}" placeholder="Please enter your full name *" required>
            @error('name')<small style="color:#dc2626">{{ $message }}</small>@enderror
          </div>

          <div class="form-group-item">
            <label for="emailInput">Your Email (required)</label>
            <input type="email" id="emailInput" name="email" value="{{ old('email') }}" placeholder="Please enter your email *" required>
            @error('email')<small style="color:#dc2626">{{ $message }}</small>@enderror
          </div>

          <div class="form-group-item">
            <label for="subjectInput">Subject (required)</label>
            <input type="text" id="subjectInput" name="subject" value="{{ old('subject') }}" placeholder="Please enter your Subject *" required>
            @error('subject')<small style="color:#dc2626">{{ $message }}</small>@enderror
          </div>

          <div class="form-group-item">
            <label for="msgInput">Message (required)</label>
            <textarea id="msgInput" name="message" placeholder="Message for us *" required>{{ old('message') }}</textarea>
            @error('message')<small style="color:#dc2626">{{ $message }}</small>@enderror
          </div>

          <button type="submit" class="form-submit-btn">Send message</button>
        </form>
      </div>

    </div>
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
