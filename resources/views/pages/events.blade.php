@extends('layouts.app')

@section('title')
Events &amp; Port Logs — Hamza Enterprises
@endsection

@section('meta_description')
Read latest dealership events, export celebrations, and real-time port logs from Hamza Enterprises loading yards in South Korea and Dubai.
@endsection

@php($navActive = 'events')

@section('content')
<main>

  <section class="cars-hero" style="background: linear-gradient(135deg, #0f1624 40%, #172439 100%);">
    <div class="container">
      <div class="cars-hero-content">
        <h1>Company Events &amp; Port Logs</h1>
        <p>Stay updated with our latest export ceremonies, container operations, yard news, and shipping announcements from South Korea and Dubai.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: Main Blog Feed -->
    <div class="events-main-feed">
      <!-- Category Tabs filter -->
      <div class="events-tabs-bar" id="categoryTabs">
        <button class="tab-btn active" data-category="All">All Updates</button>
        <button class="tab-btn" data-category="Events">Events</button>
        <button class="tab-btn" data-category="Port Logs">Port Logs</button>
        <button class="tab-btn" data-category="Deliveries">Deliveries</button>
        <button class="tab-btn" data-category="Company News">Company News</button>
      </div>

      <!-- Events List -->
      <div class="events-feed-list" id="eventsFeedContainer">
        <!-- Rendered dynamically from events.js -->
      </div>
    </div>

    <!-- Right Column: Sidebar -->
    <aside class="events-sidebar">
      <!-- Search Widget -->
      <div class="sidebar-widget">
        <h4>Quick Search</h4>
        <form class="sidebar-search-form" id="eventSearchForm">
          <div style="display: flex; gap: 8px;">
            <input type="text" id="eventSearchInput" class="form-input" placeholder="Quick Search..." style="flex: 1;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 16px; background: #dc2626; border-color: #dc2626; display: flex; align-items: center; justify-content: center;">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
          </div>
        </form>
      </div>

      <!-- Quick Links Widget -->
      <!-- <div class="sidebar-widget">
        <h4>Quick Links</h4>
        <ul class="sidebar-categories-list">
          <li><a href="events?category=Events">Events <span class="count">(2)</span></a></li>
          <li><a href="cars?body=Sedan">Cars <span class="count">(657)</span></a></li>
          <li><a href="cars?body=SUV">SUVs <span class="count">(298)</span></a></li>
          <li><a href="cars?body=Truck">Trucks <span class="count">(102)</span></a></li>
          <li><a href="cars?body=Van">Buses <span class="count">(15)</span></a></li>
        </ul>
      </div> -->

      <!-- Recent Events Widget -->
      <div class="sidebar-widget">
        <h4>Recent Updates</h4>
        <div class="most-viewed-list" id="recentEventsList">
          <!-- Rendered dynamically from events.js -->
        </div>
      </div>

      <!-- Popular Cars (Cross Promotion) -->
      <!-- <div class="sidebar-widget">
        <h4>Hot Deal Listings</h4>
        <div class="most-viewed-list">
          <a href="cars?maker=Genesis" class="mini-car-card">
            <img src="{{ asset('assets/img/genesis_g80.png') }}" alt="Genesis G80">
            <div>
              <h5>Genesis G80 Luxury</h5>
              <span>Gasoline · 3470 CC</span>
              <span class="price">$15,800</span>
            </div>
          </a>
          <a href="cars?maker=Hyundai" class="mini-car-card">
            <img src="{{ asset('assets/img/palisade.png') }}" alt="Palisade">
            <div>
              <h5>Hyundai Palisade</h5>
              <span>Diesel · 2199 CC</span>
              <span class="price">$21,500</span>
            </div>
          </a>
          <a href="cars?maker=Kia" class="mini-car-card">
            <img src="{{ asset('assets/img/sportage.png') }}" alt="Sportage">
            <div>
              <h5>Kia Sportage SUV</h5>
              <span>LPG · 1999 CC</span>
              <span class="price">$11,200</span>
            </div>
          </a>
        </div>
      </div> -->
    </aside>
  </div>

</main>
@endsection

@push('scripts')
<script>
  const EVENTS_DATABASE = @json($eventsDatabase);
</script>
<script src="{{ asset('assets/js/events.js') }}"></script>

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
