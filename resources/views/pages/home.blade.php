@extends('layouts.app')

@section('title')
Hamza Enterprises — Certified Used Cars, Exported Worldwide
@endsection

@section('meta_description')
Hamza Enterprises connects global buyers with certified, inspected used vehicles from South Korea. Browse inventory, get a 200-point inspection, and ship worldwide.
@endsection

@section('content')
<main id="top">

    <section class="hero hero-video-banner">
      <video class="hero-bg-video" autoplay muted loop playsinline poster="{{ asset('assets/img/hero_car.png') }}">
        <source src="{{ asset('assets/img/video.mp4') }}" type="video/mp4">
      </video>
      <div class="hero-overlay"></div>
      <div class="container hero-inner">
        <div class="hero-copy reveal">
          <span class="eyebrow">{{ $settings->hero_badge }}</span>
          <h1>{!! $settings->hero_headline !!}</h1>
          <p class="hero-sub">{{ $settings->hero_subheadline }}</p>

          <div class="hero-cta-row">
            <a href="#filter" class="btn btn-primary">
              <svg width="18" height="18">
                <use href="#icon-search" />
              </svg>
              Search Inventory
            </a>
            <a href="#contact" class="btn btn-outline">Talk to Our Team</a>
          </div>

          <div class="hero-stats">
            <div class="stat-gauge-card">
              <div class="gauge-wrapper">
                <svg class="gauge-svg" viewBox="0 0 100 62">
                  <defs>
                    <linearGradient id="gradVehicles" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#ff8a4c" />
                      <stop offset="100%" stop-color="#ff5a1f" />
                    </linearGradient>
                  </defs>
                  <line class="gauge-tick" x1="10" y1="50" x2="14" y2="50" />
                  <line class="gauge-tick" x1="50" y1="10" x2="50" y2="14" />
                  <line class="gauge-tick" x1="90" y1="50" x2="86" y2="50" />
                  <path class="gauge-track" d="M 15 50 A 35 35 0 0 1 85 50" fill="none" stroke="rgba(255,255,255,0.12)"
                    stroke-width="6" stroke-linecap="round" />
                  <path class="gauge-fill" id="gaugeVehicles" d="M 15 50 A 35 35 0 0 1 85 50" fill="none"
                    stroke="url(#gradVehicles)" stroke-width="6" stroke-linecap="round" stroke-dasharray="110"
                    stroke-dashoffset="110" />
                  <line class="gauge-needle" id="needleVehicles" x1="50" y1="50" x2="22" y2="50" />
                  <circle class="gauge-hub-ring" cx="50" cy="50" r="4" />
                  <circle class="gauge-hub-dot" cx="50" cy="50" r="1.6" />
                </svg>
                <div class="gauge-value">
                  <strong id="statVehicles">0</strong>
                </div>
              </div>
              <span>Vehicles listed</span>
            </div>
            <div class="stat-gauge-card">
              <div class="gauge-wrapper">
                <svg class="gauge-svg" viewBox="0 0 100 62">
                  <defs>
                    <linearGradient id="gradDealers" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#ff8a4c" />
                      <stop offset="100%" stop-color="#ff5a1f" />
                    </linearGradient>
                  </defs>
                  <line class="gauge-tick" x1="10" y1="50" x2="14" y2="50" />
                  <line class="gauge-tick" x1="50" y1="10" x2="50" y2="14" />
                  <line class="gauge-tick" x1="90" y1="50" x2="86" y2="50" />
                  <path class="gauge-track" d="M 15 50 A 35 35 0 0 1 85 50" fill="none" stroke="rgba(255,255,255,0.12)"
                    stroke-width="6" stroke-linecap="round" />
                  <path class="gauge-fill" id="gaugeDealers" d="M 15 50 A 35 35 0 0 1 85 50" fill="none"
                    stroke="url(#gradDealers)" stroke-width="6" stroke-linecap="round" stroke-dasharray="110"
                    stroke-dashoffset="110" />
                  <line class="gauge-needle" id="needleDealers" x1="50" y1="50" x2="22" y2="50" />
                  <circle class="gauge-hub-ring" cx="50" cy="50" r="4" />
                  <circle class="gauge-hub-dot" cx="50" cy="50" r="1.6" />
                </svg>
                <div class="gauge-value">
                  <strong id="statDealers">0</strong>
                </div>
              </div>
              <span>Verified dealers</span>
            </div>
            <div class="stat-gauge-card">
              <div class="gauge-wrapper">
                <svg class="gauge-svg" viewBox="0 0 100 62">
                  <defs>
                    <linearGradient id="gradCountries" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#ff8a4c" />
                      <stop offset="100%" stop-color="#ff5a1f" />
                    </linearGradient>
                  </defs>
                  <line class="gauge-tick" x1="10" y1="50" x2="14" y2="50" />
                  <line class="gauge-tick" x1="50" y1="10" x2="50" y2="14" />
                  <line class="gauge-tick" x1="90" y1="50" x2="86" y2="50" />
                  <path class="gauge-track" d="M 15 50 A 35 35 0 0 1 85 50" fill="none" stroke="rgba(255,255,255,0.12)"
                    stroke-width="6" stroke-linecap="round" />
                  <path class="gauge-fill" id="gaugeCountries" d="M 15 50 A 35 35 0 0 1 85 50" fill="none"
                    stroke="url(#gradCountries)" stroke-width="6" stroke-linecap="round" stroke-dasharray="110"
                    stroke-dashoffset="110" />
                  <line class="gauge-needle" id="needleCountries" x1="50" y1="50" x2="22" y2="50" />
                  <circle class="gauge-hub-ring" cx="50" cy="50" r="4" />
                  <circle class="gauge-hub-dot" cx="50" cy="50" r="1.6" />
                </svg>
                <div class="gauge-value">
                  <strong id="statCountries">0</strong>
                </div>
              </div>
              <span>Countries served</span>
            </div>
          </div>

          <div class="trusted-row">
            <div class="trusted-avatars">
              <span class="avatar avatar-sm">AF</span>
              <span class="avatar avatar-sm">NK</span>
              <span class="avatar avatar-sm">JC</span>
              <span class="avatar avatar-sm">DK</span>
            </div>
            <div class="trusted-text">
              <div class="stars"><svg width="14" height="14">
                  <use href="#icon-star" />
                </svg><svg width="14" height="14">
                  <use href="#icon-star" />
                </svg><svg width="14" height="14">
                  <use href="#icon-star" />
                </svg><svg width="14" height="14">
                  <use href="#icon-star" />
                </svg><svg width="14" height="14">
                  <use href="#icon-star" />
                </svg></div>
              <span>Trusted by 12,000+ buyers worldwide</span>
            </div>
          </div>
        </div>

        <!-- <div class="hero-visual" aria-hidden="true">
          <div class="hero-trust-panel">
            <div class="trust-panel-row">
              <span class="trust-panel-icon trust-panel-icon-success">
                <svg width="18" height="18"><use href="#icon-shield" /></svg>
              </span>
              <span class="trust-panel-label">200-Point Inspected</span>
            </div>
            <div class="trust-panel-divider"></div>
            <div class="trust-panel-row">
              <span class="trust-panel-icon">
                <svg width="18" height="18"><use href="#icon-truck" /></svg>
              </span>
              <span class="trust-panel-label">Ships in 7–14 days</span>
            </div>
            <div class="trust-panel-divider"></div>
            <div class="trust-panel-row trust-panel-price-row">
              <span class="trust-panel-label">Starting from</span>
              <strong class="trust-panel-price">$8,400</strong>
            </div>
          </div>
        </div> -->
      </div>
    </section>

    <section class="filter-band" id="filter">
      <div class="container filter-band-inner">
        <div class="filter-band-head">
          <span class="eyebrow eyebrow-invert">Find your vehicle</span>
          <h2>Search live inventory</h2>
          <p>Filter by make, model, body type, price, and year across our full dealer network.</p>
        </div>
        <form class="search-card filter-form" id="searchForm">
          <div class="search-field">
            <label for="fMake">Make</label>
            <select id="fMake" name="make">
              <option value="">Any make</option>
              <option>Hyundai</option>
              <option>Kia</option>
              <option>Genesis</option>
              <option>Chevrolet</option>
              <option>SsangYong</option>
              <option>Renault Korea</option>
            </select>
          </div>
          <div class="search-field">
            <label for="fModel">Model</label>
            <select id="fModel" name="model">
              <option value="">Any model</option>
              <option>Sonata</option>
              <option>Sportage</option>
              <option>Tucson</option>
              <option>K5</option>
              <option>G80</option>
              <option>Palisade</option>
            </select>
          </div>
          <div class="search-field">
            <label for="fBody">Body type</label>
            <select id="fBody" name="body">
              <option value="">Any type</option>
              <option>Sedan</option>
              <option>SUV</option>
              <option>Truck</option>
              <option>Van / Bus</option>
              <option>Hatchback</option>
            </select>
          </div>
          <div class="search-field">
            <label for="fBudget">Price range</label>
            <select id="fBudget" name="price">
              <option value="">Any price</option>
              <option>Under $10,000</option>
              <option>$10,000 – $20,000</option>
              <option>$20,000 – $35,000</option>
              <option>$35,000+</option>
            </select>
          </div>
          <div class="search-field">
            <label for="fYear">Year</label>
            <select id="fYear" name="year">
              <option value="">Any year</option>
              <option>2022 – 2024</option>
              <option>2019 – 2021</option>
              <option>2015 – 2018</option>
              <option>2014 &amp; older</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary search-submit">
            <svg width="18" height="18">
              <use href="#icon-search" />
            </svg>
            Search
          </button>
        </form>
      </div>
    </section>

    <nav class="quick-categories" aria-label="Browse by vehicle type">
      <div class="container quick-categories-inner">
        <a href="cars?body=Sedan"><svg width="22" height="22">
            <use href="#icon-car" />
          </svg>Sedans</a>
        <a href="cars?body=SUV"><svg width="22" height="22">
            <use href="#icon-tag" />
          </svg>SUVs</a>
        <a href="cars?body=Truck"><svg width="22" height="22">
            <use href="#icon-truck" />
          </svg>Trucks</a>
        <a href="cars?body=Van"><svg width="22" height="22">
            <use href="#icon-bus" />
          </svg>Vans &amp; Buses</a>
        <a href="#contact"><svg width="22" height="22">
            <use href="#icon-phone" />
          </svg>Contact Us</a>
      </div>
    </nav>

    <section class="trust-bar">
      <div class="container trust-grid">
        <div class="trust-item"><svg width="22" height="22">
            <use href="#icon-badge" />
          </svg>
          <div><strong>70+</strong><span>Partner dealers</span></div>
        </div>
        <div class="trust-item"><svg width="22" height="22">
            <use href="#icon-tag" />
          </svg>
          <div><strong>30+</strong><span>Brands available</span></div>
        </div>
        <div class="trust-item"><svg width="22" height="22">
            <use href="#icon-shield" />
          </svg>
          <div><strong>$99</strong><span>Full inspection report</span></div>
        </div>
        <div class="trust-item"><svg width="22" height="22">
            <use href="#icon-truck" />
          </svg>
          <div><strong>45+</strong><span>Countries shipped to</span></div>
        </div>
      </div>
    </section>

    <section class="section listings" id="recommendation">
      <div class="container">
        <div class="section-head split">
          <div>
            <span class="eyebrow">Hand-picked this week</span>
            <h2>Today's recommendation</h2>
            <p>A curated shortlist from our top-rated partner dealers.</p>
          </div>
          <a href="#stock" class="btn btn-outline">View all stock <svg width="16" height="16">
              <use href="#icon-arrow" />
            </svg></a>
        </div>
        <div class="listing-grid" id="recommendationGrid"></div>
      </div>
    </section>

    <section class="category-strip">
      <div class="container category-strip-inner">
        <a class="category-banner cat-cars reveal reveal-drop" href="cars" style="transition-delay:0ms">
          <svg class="banner-bg-icon" viewBox="0 0 64 32">
            <use href="#icon-car" />
          </svg>
          <div class="banner-content">
            <div class="banner-icon-badge"><svg width="22" height="22">
                <use href="#icon-car" />
              </svg></div>
            <h4>All Cars</h4>
            <p>Sedans &amp; hatchbacks, ready to ship</p>
            <span class="cat-link">See More <svg width="14" height="14">
                <use href="#icon-arrow" />
              </svg></span>
          </div>
        </a>
        <a class="category-banner cat-trucks reveal reveal-drop" href="cars?body=SUV"
          style="transition-delay:120ms">
          <svg class="banner-bg-icon" viewBox="0 0 64 32">
            <use href="#icon-car" />
          </svg>
          <div class="banner-content">
            <div class="banner-icon-badge"><svg width="22" height="22">
                <use href="#icon-truck" />
              </svg></div>
            <h4>SUVs &amp; Trucks</h4>
            <p>Built for cargo &amp; rough terrain</p>
            <span class="cat-link">See More <svg width="14" height="14">
                <use href="#icon-arrow" />
              </svg></span>
          </div>
        </a>
        <a class="category-banner cat-buses" href="cars?body=Van">
          <svg class="banner-bg-icon" viewBox="0 0 24 24">
            <use href="#icon-bus" />
          </svg>
          <div class="banner-content">
            <div class="banner-icon-badge"><svg width="22" height="22">
                <use href="#icon-bus" />
              </svg></div>
            <h4>Vans &amp; Buses</h4>
            <p>Fleet &amp; group transport, built to last</p>
            <span class="cat-link">See More <svg width="14" height="14">
                <use href="#icon-arrow" />
              </svg></span>
          </div>
        </a>
      </div>
    </section>

    <section class="section listings stock-section" id="stock">
      <div class="container">
        <div class="section-head split">
          <div>
            <h2>Vehicles in stock</h2>
            <p>Full inventory currently available across our South Korea yards.</p>
          </div>
        </div>
        <div class="listing-grid stock-grid" id="stockGrid"></div>
      </div>
    </section>

    <section class="section brands" id="brands">
      <div class="container">
        <div class="section-head">
          <h2>Browse by brand</h2>
          <p>Every listing is sourced from vetted dealers across South Korea's export hubs.</p>
        </div>
        <div class="brands-layout">
          <div class="brand-grid" id="brandGrid"></div>
          <div class="brand-promo">
            <span class="eyebrow" style="background:rgba(255,255,255,.12);color:#fff;">Global logistics</span>
            <h3>Your way, shipped worldwide.</h3>
            <p>From Incheon port to your driveway — we coordinate freight, customs, and documentation for every order.
            </p>
            <a href="#contact" class="btn btn-primary">Get Shipping Quote</a>
          </div>
        </div>
      </div>
    </section>

    <section class="section about" id="about">
      <div class="container about-inner">
        <div class="about-copy">
          <span class="eyebrow">About Hamza Enterprises</span>
          <h2>A trusted exporter of Korean vehicles &amp; machinery.</h2>
          <p>Our experienced team helps customers purchase, inspect, and export Korean used vehicles and heavy
            machinery with complete transparency — exporting to Africa, the Middle East, Asia, Europe, South
            America, and many other international markets.</p>
          <div class="about-features">
            <div class="about-feature">
              <svg width="24" height="24">
                <use href="#icon-badge" />
              </svg>
              <div>
                <h4>Genuine Korean vehicles</h4>
                <p>Every unit sourced directly from verified Korean yards and dealers.</p>
              </div>
            </div>
            <div class="about-feature">
              <svg width="24" height="24">
                <use href="#icon-shield" />
              </svg>
              <div>
                <h4>Vehicle inspection</h4>
                <p>Full inspection before export, with complete transparency.</p>
              </div>
            </div>
            <div class="about-feature">
              <svg width="24" height="24">
                <use href="#icon-grid" />
              </svg>
              <div>
                <h4>Wide export range</h4>
                <p>Passenger cars, SUVs, trucks, vans, and construction &amp; agricultural machinery.</p>
              </div>
            </div>
            <div class="about-feature">
              <svg width="24" height="24">
                <use href="#icon-truck" />
              </svg>
              <div>
                <h4>Worldwide shipping</h4>
                <p>Container loading and Ro-Ro shipping to ports around the world.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="about-visual">
          <div class="about-stat-card">
            <span class="eyebrow" style="background:rgba(255,90,31,.15);color:#ff5a1f;">Incheon, South Korea</span>
            <strong>12,480+</strong>
            <span>vehicles &amp; machinery exported worldwide</span>
            <div class="about-stat-row">
              <div><strong>4.8/5</strong><span>Buyer rating</span></div>
              <div><strong>7–14d</strong><span>Avg. shipping time</span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section how-it-works" id="how-it-works">
      <div class="container">
        <div class="section-head">
          <h2>How Hamza Enterprises works</h2>
          <p>From search to your driveway, in four straightforward steps.</p>
        </div>
        <div class="steps">
          <div class="step reveal">
            <span class="step-num">01</span>
            <div class="step-icon">
              <svg width="24" height="24">
                <use href="#icon-search" />
              </svg>
            </div>
            <h3>Search &amp; compare</h3>
            <p>Filter thousands of listings by make, model, price, and body type across our dealer network.</p>
          </div>
          <div class="step reveal">
            <span class="step-num">02</span>
            <div class="step-icon">
              <svg width="24" height="24">
                <use href="#icon-shield" />
              </svg>
            </div>
            <h3>Verified inspection</h3>
            <p>Every vehicle passes a 200-point inspection with a public report before it's listed for sale.</p>
          </div>
          <div class="step reveal">
            <span class="step-num">03</span>
            <div class="step-icon">
              <svg width="24" height="24">
                <use href="#icon-badge" />
              </svg>
            </div>
            <h3>Secure purchase</h3>
            <p>Pay through escrow-backed transactions with full documentation and title transfer support.</p>
          </div>
          <div class="step reveal">
            <span class="step-num">04</span>
            <div class="step-icon">
              <svg width="24" height="24">
                <use href="#icon-truck" />
              </svg>
            </div>
            <h3>Worldwide shipping</h3>
            <p>Track your vehicle door-to-door with real-time shipping updates and customs support.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section showrooms" id="showrooms">
      <div class="container">
        <div class="section-head">
          <h2>Our showrooms &amp; yards</h2>
          <p>Visit us in person, or let our team handle everything remotely.</p>
        </div>
        <div class="showroom-grid">
          @foreach ([1, 2] as $i)
            <div class="showroom-card">
              <span class="showroom-tag">{{ $settings->{"showroom{$i}_tag"} }}</span>
              <div class="showroom-icon"><svg width="26" height="26">
                  <use href="#icon-pin" />
                </svg></div>
              <h4>{{ $settings->{"showroom{$i}_name"} }}</h4>
              <p>{{ $settings->{"showroom{$i}_address"} }}</p>
              <div class="showroom-contact">
                <a href="tel:{{ str_replace(' ', '', $settings->{"showroom{$i}_phone"}) }}"><svg width="14" height="14">
                    <use href="#icon-phone" />
                  </svg> {{ $settings->{"showroom{$i}_phone"} }}</a>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->{"showroom{$i}_whatsapp"}) }}"><svg width="14" height="14">
                    <use href="#icon-mail" />
                  </svg> WhatsApp: {{ $settings->{"showroom{$i}_whatsapp"} }}</a>
              </div>
              @if ($settings->{"showroom{$i}_maps_url"})
                <a href="{{ $settings->{"showroom{$i}_maps_url"} }}" target="_blank" rel="noopener" class="showroom-directions">Get Directions <svg width="14" height="14"><use href="#icon-arrow" /></svg></a>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section features" id="inspections">
      <div class="container features-inner">
        <div class="features-visual reveal">
          <div class="feature-badge-card">
            <svg width="40" height="40">
              <use href="#icon-shield" />
            </svg>
            <h4>200-Point Inspection</h4>
            <p>Engine, transmission, frame, electronics, and cosmetic checks — every time.</p>
            <span class="price-tag">$99 report</span>
          </div>
        </div>
        <div class="features-copy">
          <span class="eyebrow">Why buyers choose us</span>
          <h2>Built for buyers who can't inspect in person.</h2>
          <div class="feature-list">
            <div class="feature-row reveal">
              <svg width="22" height="22">
                <use href="#icon-badge" />
              </svg>
              <div>
                <h4>Certified dealer network</h4>
                <p>Every partner dealer is vetted and re-verified annually.</p>
              </div>
            </div>
            <div class="feature-row reveal">
              <svg width="22" height="22">
                <use href="#icon-gauge" />
              </svg>
              <div>
                <h4>Transparent history</h4>
                <p>Mileage, accident, and service records included on every listing.</p>
              </div>
            </div>
            <div class="feature-row reveal">
              <svg width="22" height="22">
                <use href="#icon-tag" />
              </svg>
              <div>
                <h4>Upfront pricing</h4>
                <p>No hidden fees — shipping and duties estimated before you buy.</p>
              </div>
            </div>
            <div class="feature-row reveal">
              <svg width="22" height="22">
                <use href="#icon-truck" />
              </svg>
              <div>
                <h4>Door-to-door logistics</h4>
                <p>We handle customs paperwork so your car arrives ready to register.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section news-updates" id="updates">
      <div class="container">
        <div class="section-head split">
          <div>
            <span class="eyebrow">Export Gallery &amp; News</span>
            <h2>Latest exports &amp; port operations</h2>
            <p>Real-time updates from our loading yards and shipping terminals.</p>
          </div>
          <a href="{{ route('events') }}" class="btn btn-outline">View full gallery</a>
        </div>
        <div class="updates-grid">
          @foreach ($portUpdates as $u)
            <div class="update-card reveal">
              <div class="update-media">
                <img src="{{ $u['image'] }}" alt="{{ $u['title'] }}" loading="lazy">
                <span class="update-tag">{{ $u['tag'] }}</span>
              </div>
              <div class="update-body">
                <span class="update-date">{{ $u['date'] }}</span>
                <h4>{{ $u['title'] }}</h4>
                <p>{{ $u['summary'] }}</p>
                <a href="{{ route('events') }}" class="update-link">Read update <svg width="14" height="14">
                    <use href="#icon-arrow" />
                  </svg></a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section video-showcase" id="videos">
      <div class="container">
        <div class="section-head text-center">
          <span class="eyebrow">Video walkarounds</span>
          <h2>Hamza Enterprises TV</h2>
          <p>Explore our premium stock through detailed video walkthroughs and review tours.</p>
        </div>
        <div class="videos-grid">
          @foreach ($videos as $v)
            <a href="{{ $v['url'] ?: '#' }}" @if($v['url']) target="_blank" rel="noopener" @endif class="video-card reveal">
              <div class="video-thumbnail">
                <img src="{{ $v['thumbnail'] }}" alt="{{ $v['title'] }}" loading="lazy">
                <div class="play-overlay">
                  <span class="play-btn"><svg viewBox="0 0 24 24" width="24" height="24">
                      <path d="M8 5v14l11-7z" fill="currentColor" />
                    </svg></span>
                </div>
                @if ($v['duration'])
                  <span class="video-duration">{{ $v['duration'] }}</span>
                @endif
              </div>
              <div class="video-info">
                <h4>{{ $v['title'] }}</h4>
                <span class="video-meta">{{ number_format($v['views']) }} views · {{ $v['timeAgo'] }}</span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section we-export" id="we-export">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">What we export</span>
          <h2>Vehicles &amp; machinery, ready to ship</h2>
          <p>From passenger cars to heavy equipment, sourced and inspected in Korea.</p>
        </div>
        <div class="export-chip-grid">
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-car"/></svg> Passenger Cars</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-tag"/></svg> SUVs</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-truck"/></svg> Pickup Trucks</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-bus"/></svg> Vans</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-bus"/></svg> Mini Buses</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-truck"/></svg> Commercial Trucks</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-bolt"/></svg> Construction Machinery</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-badge"/></svg> Heavy Equipment</span>
          <span class="export-chip"><svg width="18" height="18"><use href="#icon-grid"/></svg> Agricultural Machinery</span>
        </div>
      </div>
    </section>

    <section class="section our-services" id="services">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Our services</span>
          <h2>End-to-end export support</h2>
          <p>Everything handled in-house, from sourcing to your destination port.</p>
        </div>
        <div class="steps">
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-tag"/></svg></div>
            <h3>Used Car Export</h3>
            <p>Sourced, negotiated, and prepared for international shipment.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-bolt"/></svg></div>
            <h3>Machinery Export</h3>
            <p>Construction, agricultural, and heavy equipment export.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-shield"/></svg></div>
            <h3>Vehicle Inspection</h3>
            <p>Every unit checked before it leaves Korea.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-truck"/></svg></div>
            <h3>Container Loading</h3>
            <p>Careful, secure loading at our Incheon yard.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-bus"/></svg></div>
            <h3>Ro-Ro Shipping</h3>
            <p>Roll-on/roll-off shipping for vehicles and machinery.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-badge"/></svg></div>
            <h3>Export Documentation</h3>
            <p>Complete paperwork prepared and handled for you.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-grid"/></svg></div>
            <h3>Customs Clearance</h3>
            <p>Guidance through customs on both ends of the shipment.</p>
          </div>
          <div class="step reveal">
            <div class="step-icon"><svg width="24" height="24"><use href="#icon-pin"/></svg></div>
            <h3>Worldwide Delivery</h3>
            <p>Delivered to your destination, wherever you are.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section export-destinations" id="destinations">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Export destinations</span>
          <h2>We proudly export to customers worldwide</h2>
          <p>Including — and not limited to — the following countries.</p>
        </div>
        <div class="destination-track-wrap">
          <button class="carousel-btn prev" id="destPrev" aria-label="Previous destinations"><svg width="20" height="20" style="transform:scaleX(-1)"><use href="#icon-chevron"/></svg></button>
          <div class="destination-viewport">
            <div class="destination-track" id="destinationTrack"></div>
          </div>
          <button class="carousel-btn next" id="destNext" aria-label="Next destinations"><svg width="20" height="20"><use href="#icon-chevron"/></svg></button>
        </div>
      </div>
    </section>

        <section class="section leadership-banking" id="leadership">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Leadership &amp; payments</span>
          <h2>Who you're working with</h2>
          <p>Two trusted companies, one export operation — direct contact and official banking details below.</p>
        </div>
        <div class="leadership-grid">
          @foreach ([1, 2] as $i)
            <div class="leader-card">
              <span class="showroom-tag">{{ $settings->{"leader{$i}_tag"} }}</span>
              <h4>{{ $settings->{"leader{$i}_name"} }}</h4>
              <p class="leader-role">{{ $settings->{"leader{$i}_role"} }}</p>
              <a href="tel:{{ str_replace(' ', '', $settings->{"leader{$i}_phone"}) }}"><svg width="14" height="14"><use href="#icon-phone"/></svg> {{ $settings->{"leader{$i}_phone"} }}</a>
              <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->{"leader{$i}_whatsapp"}) }}"><svg width="14" height="14"><use href="#icon-mail"/></svg> WhatsApp: {{ $settings->{"leader{$i}_whatsapp"} }}</a>
            </div>
          @endforeach
        </div>

        <div class="banking-grid">
          @foreach ([1, 2] as $i)
            <div class="bank-card">
              <div class="bank-card-head">
                <span class="showroom-tag">{{ $settings->{"bank{$i}_tag"} }}</span>
                <h4>{{ $settings->{"bank{$i}_name"} }}</h4>
              </div>
              <div class="bank-rows">
                @foreach ([1, 2, 3, 4] as $r)
                  @if ($settings->{"bank{$i}_row{$r}_label"})
                    <div class="bank-row"><span>{{ $settings->{"bank{$i}_row{$r}_label"} }}</span><strong>{{ $settings->{"bank{$i}_row{$r}_value"} }}</strong></div>
                  @endif
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section testimonials" id="testimonials">
      <div class="container">
        <div class="section-head">
          <h2>Trusted by buyers worldwide</h2>
          <p>Real feedback from recent Hamza Enterprises customers.</p>
        </div>
        <div class="testimonial-track-wrap">
          <button class="carousel-btn prev" id="testPrev" aria-label="Previous testimonial"><svg width="20" height="20"
              style="transform:scaleX(-1)">
              <use href="#icon-chevron" />
            </svg></button>
          <div class="testimonial-viewport">
            <div class="testimonial-track" id="testimonialTrack">
              @foreach ($testimonials as $t)
              <div class="testimonial-card">
                <div class="stars">
                  @for ($i = 0; $i < 5; $i++)
                    <svg width="16" height="16" style="{{ $i < $t->rating ? '' : 'opacity:.3' }}"><use href="#icon-star"/></svg>
                  @endfor
                </div>
                <p>"{{ $t->text }}"</p>
                <div class="testimonial-author"><span class="avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->avatar_initial ?: strtoupper(substr($t->author,0,2)) }}</span>
                  <div><strong>{{ $t->author }}</strong><span>{{ $t->location }}</span></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <button class="carousel-btn next" id="testNext" aria-label="Next testimonial"><svg width="20" height="20">
              <use href="#icon-chevron" />
            </svg></button>
        </div>
      </div>
    </section>


    <section class="cta-band">
      <div class="container cta-inner">
        <div>
          <h2>Ready to find your next vehicle?</h2>
          <p>Get matched with inspected inventory in your budget, or talk to our export team directly.</p>
          <a class="cta-phone" href="tel:+821064995384"><svg width="16" height="16">
              <use href="#icon-phone" />
            </svg> +82 10 6499 5384</a>
        </div>
        <div class="cta-actions">
          <a href="cars" class="btn btn-primary">Browse Inventory</a>
          <a href="#contact" class="btn btn-ghost-invert">Talk to Our Team</a>
        </div>
      </div>
    </section>

    <section class="partners-logo-row">
      <div class="container">
        <div class="partners-inner">
          <span class="partners-label">Global shipping &amp; logistics:</span>
          <div class="logos-container">
            <span class="partner-logo">MAERSK</span>
            <span class="partner-logo">HYUNDAI GLOVIS</span>
            <span class="partner-logo">CMA CGM</span>
            <span class="partner-logo">MSC</span>
            <span class="partner-logo">HMM CO.</span>
          </div>
        </div>
      </div>
    </section>

  </main>
@endsection

@push('scripts')
<script>
  const BRANDS = @json($brands);
  const recommendation = @json($recommendationData);
  const stock = @json($stockData);
  const STAT_TARGETS = {
    statVehicles: {{ $settings->stat_vehicles }},
    statDealers: {{ $settings->stat_dealers }},
    statCountries: {{ $settings->stat_countries }},
  };
</script>
<script src="{{ asset('assets/js/main.js') }}"></script>

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
