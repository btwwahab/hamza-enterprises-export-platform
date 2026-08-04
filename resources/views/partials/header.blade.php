  <header class="site-header" id="siteHeader">
    <div class="container header-inner">
      <a href="{{ Route::currentRouteName() === 'home' ? '#top' : route('home') }}" class="logo">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Hamza Enterprises" class="site-logo-img">
      </a>
      <nav class="main-nav" id="mainNav">
        <div class="nav-dropdown nav-dropdown-vehicles">
          <div class="nav-dropdown-head">
            <a href="{{ route('cars') }}" class="nav-dropdown-trigger {{ ($navActive ?? null) === 'vehicles' ? 'active' : '' }}">Vehicles</a>
            <button type="button" class="nav-dropdown-chevron" aria-expanded="false" aria-label="Toggle Vehicles submenu">
              <svg width="12" height="12"><use href="#icon-chevron-down"/></svg>
            </button>
          </div>
          <div class="nav-dropdown-menu nav-dropdown-menu-wide">
            <a href="{{ route('cars') }}?body=Sedan">Passenger Cars</a>
            <a href="{{ route('cars') }}?body=SUV">SUVs</a>
            <a href="{{ route('cars') }}?body=Truck">Pickup Trucks</a>
            <a href="{{ route('cars') }}?body=Van">Vans</a>
            <a href="{{ route('cars') }}?body=Van">Mini Buses</a>
            <a href="{{ route('cars') }}?body=Truck">Commercial Trucks</a>
          </div>
        </div>
        <div class="nav-dropdown">
          <div class="nav-dropdown-head">
            <a href="{{ route('machinery') }}" class="nav-dropdown-trigger {{ ($navActive ?? null) === 'machinery' ? 'active' : '' }}">Machinery</a>
            <button type="button" class="nav-dropdown-chevron" aria-expanded="false" aria-label="Toggle Machinery submenu">
              <svg width="12" height="12"><use href="#icon-chevron-down"/></svg>
            </button>
          </div>
          <div class="nav-dropdown-menu">
            <a href="{{ route('machinery') }}?category=Construction+Machinery">Construction Machinery</a>
            <a href="{{ route('machinery') }}?category=Heavy+Equipment">Heavy Equipment</a>
            <a href="{{ route('machinery') }}?category=Agricultural+Machinery">Agricultural Machinery</a>
          </div>
        </div>
        <a href="{{ route('parts') }}" class="{{ ($navActive ?? null) === 'parts' ? 'active' : '' }}">Parts</a>
        <a href="{{ route('about') }}" class="{{ ($navActive ?? null) === 'about' ? 'active' : '' }}">About Us</a>
        <a href="{{ route('events') }}" class="{{ ($navActive ?? null) === 'events' ? 'active' : '' }}">Events</a>

        <a href="{{ route('cars') }}" class="btn btn-primary mobile-cta">Browse Inventory</a>
        <a href="{{ route('contact') }}" class="btn btn-outline mobile-cta">Contact Us</a>
      </nav>
      <div class="header-actions">
        <div class="header-currency">
          <select class="currency-select" id="navCurrencySelect" data-width="110px" data-compact="1"></select>
        </div>
        <a href="{{ route('contact') }}" class="btn btn-outline">Contact Us</a>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
          <svg width="24" height="24">
            <use href="#icon-menu" />
          </svg>
        </button>
      </div>
    </div>
  </header>
