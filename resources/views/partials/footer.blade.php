  <footer class="site-footer" id="contact">
    <div class="container footer-grid">
      <div class="footer-brand">
        <a href="{{ Route::currentRouteName() === 'home' ? '#top' : route('home') }}" class="logo">
          <img src="{{ asset('assets/img/logo.png') }}" alt="Hamza Enterprises" class="site-logo-img">
        </a>
        <p>Reliable Korean used cars, trucks &amp; machinery exported worldwide — your trusted partner for Korean
          vehicle exports.</p>
        <div class="footer-location"><svg width="18" height="18">
            <use href="#icon-pin" />
          </svg> {{ $settings->address_korea }}</div>
        <div class="footer-contact-section">
          <span class="footer-contact-heading">Fatima Trading</span>
          <div class="footer-location"><svg width="18" height="18"><use href="#icon-phone"/></svg> {{ $settings->fatima_phone }}</div>
          <div class="footer-location"><svg width="18" height="18"><use href="#icon-whatsapp"/></svg> WhatsApp: {{ $settings->fatima_phone }}</div>
        </div>
        <div class="footer-contact-section">
          <span class="footer-contact-heading">Hamza Enterprises</span>
          <div class="footer-location"><svg width="18" height="18"><use href="#icon-phone"/></svg> {{ $settings->hamza_phone }}</div>
          <div class="footer-location"><svg width="18" height="18"><use href="#icon-whatsapp"/></svg> WhatsApp: {{ $settings->hamza_phone }}</div>
        </div>

        <div class="footer-social">
          <a href="{{ $settings->social_facebook ?: '#' }}" class="social-dot social-dot-fb" @if($settings->social_facebook) target="_blank" rel="noopener" @endif aria-label="Facebook"><svg width="16" height="16"><use href="#icon-facebook"/></svg></a>
          <a href="{{ $settings->social_linkedin ?: '#' }}" class="social-dot social-dot-li" @if($settings->social_linkedin) target="_blank" rel="noopener" @endif aria-label="LinkedIn"><svg width="16" height="16"><use href="#icon-linkedin"/></svg></a>
          <a href="{{ $settings->social_whatsapp ?: '#' }}" class="social-dot social-dot-wa" @if($settings->social_whatsapp) target="_blank" rel="noopener" @endif aria-label="WhatsApp"><svg width="16" height="16"><use href="#icon-whatsapp"/></svg></a>
          <a href="{{ $settings->social_youtube ?: '#' }}" class="social-dot social-dot-yt" @if($settings->social_youtube) target="_blank" rel="noopener" @endif aria-label="YouTube"><svg width="16" height="16"><use href="#icon-youtube"/></svg></a>
        </div>
      </div>
      <div class="footer-col">
        <h5>Quick Links</h5>
        <a href="{{ route('cars') }}">Vehicles</a>
        <a href="{{ Route::currentRouteName() === 'home' ? '#brands' : route('home').'#brands' }}">Brands</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('faq') }}">FAQ</a>
        <a href="{{ route('contact') }}">Contact Us</a>
        <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
        <a href="{{ route('terms-conditions') }}">Terms &amp; Conditions</a>
      </div>
      <div class="footer-col">
        <h5>Office Hours</h5>
        <div class="office-hours">
          <svg width="16" height="16">
            <use href="#icon-clock" />
          </svg>
          <div>
            <span>Mon – Fri: 9:00 – 18:00 KST</span>
            <span>Saturday: 10:00 – 16:00 KST</span>
            <span>Sunday: Closed</span>
          </div>
        </div>
      </div>
      <div class="footer-col footer-newsletter">
        <h5>Stay updated</h5>
        <p>New inventory drops and shipping deals, in your inbox.</p>
        <form class="newsletter-form" id="newsletterForm">
          <input type="email" placeholder="you@example.com" required aria-label="Email address">
          <button type="submit" class="btn btn-primary">Join</button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container footer-bottom-inner">
        <span>© <span id="year"></span> Hamza Enterprises | Fatima Trading. All rights reserved.</span>
        <div class="footer-legal">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    (function () {
      var y = document.getElementById('year');
      if (y) { y.textContent = new Date().getFullYear(); }
    })();
  </script>
