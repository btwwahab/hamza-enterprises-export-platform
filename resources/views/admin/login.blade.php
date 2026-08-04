<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Admin Login — Hamza Enterprises</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32.png') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/css/admin.css') }}"/>
</head>
<body>
<div class="login-page">

  <!-- Visual panel -->
  <div class="login-visual">
    <video class="login-visual-video" autoplay muted loop playsinline poster="{{ asset('assets/img/hero_car.png') }}">
      <source src="{{ asset('assets/img/video.mp4') }}" type="video/mp4">
    </video>
    <div class="login-visual-overlay"></div>

    <div class="login-brand">
      <img src="{{ asset('assets/img/logo-icon.png') }}" alt="Hamza Enterprises">
      <span>Hamza Enterprises</span>
    </div>

    <div class="login-visual-body">
      <h1>Run your export business from <em>one dashboard.</em></h1>
      <p>Manage vehicles, machinery, parts and customer inquiries for Hamza Enterprises &amp; Fatima Trading — all in a single control panel.</p>

      <div class="login-feature-list">
        <div class="login-feature-item">
          <span class="login-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></span>
          <span>Vehicle &amp; machinery inventory</span>
        </div>
        <div class="login-feature-item">
          <span class="login-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 1 4.93 19.07 10 10 0 0 1 19.07 4.93"/></svg></span>
          <span>Spare parts catalog</span>
        </div>
        <div class="login-feature-item">
          <span class="login-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
          <span>Customer inquiries &amp; leads</span>
        </div>
      </div>
    </div>

    <div class="login-visual-footer">© {{ date('Y') }} Hamza Enterprises · Incheon, South Korea</div>
  </div>

  <!-- Form panel -->
  <div class="login-form-panel">
    <div class="login-form-inner">
      <div class="mobile-brand">
        <img src="{{ asset('assets/img/logo-icon.png') }}" alt="Hamza Enterprises">
        <span>Hamza Enterprises</span>
      </div>

      <h1>Welcome back</h1>
      <p class="subtitle">Sign in to manage your inventory and operations.</p>

      @if ($errors->any())
        <div class="login-error">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.attempt') }}">
        @csrf
        <div class="form-group" style="margin-bottom:16px">
          <label>Email Address</label>
          <div class="input-icon-group">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="admin@hamzaenterprises.com" required autocomplete="email"/>
          </div>
        </div>
        <div class="form-group" style="margin-bottom:24px">
          <label>Password</label>
          <div class="input-icon-group">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <input type="password" name="password" id="passwordInput" class="form-control" placeholder="••••••••" required autocomplete="current-password" style="padding-right:38px"/>
            <button type="button" class="password-toggle-btn" id="togglePassword" aria-label="Show password">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eyeIcon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
        <button type="submit" class="btn btn-primary login-submit-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          Sign In
        </button>
      </form>

      <p class="login-form-footer">Hamza Enterprises Admin · Internal Use Only</p>
    </div>
  </div>

</div>

<script>
  const toggleBtn = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('passwordInput');
  const eyeIcon = document.getElementById('eyeIcon');
  toggleBtn.addEventListener('click', () => {
    const isHidden = passwordInput.type === 'password';
    passwordInput.type = isHidden ? 'text' : 'password';
    eyeIcon.innerHTML = isHidden
      ? '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.5 18.5 0 0 1 5.06-5.94M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
      : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
  });
</script>
</body>
</html>
