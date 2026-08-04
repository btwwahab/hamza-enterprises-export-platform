@extends('layouts.app')

@section('title')
Live Car Inventory — Hamza Enterprises
@endsection

@section('meta_description')
Search and filter our live inventory of certified used cars, SUVs, and commercial vehicles available for export from Incheon, South Korea.
@endsection

@section('content')
<main>

  <section class="cars-hero">
    <div class="container">
      <div class="cars-hero-content">
        <h1>Search Live Inventory</h1>
        <p>Explore and filter premium inspected vehicles sourced directly from South Korea and UAE yards.</p>
      </div>
    </div>
  </section>

  <div class="container cars-page-layout">
    <!-- Left Column: Sidebar Filters -->
    <aside class="cars-sidebar" id="carsSidebar">
      <div class="sidebar-widget search-filter-box">
        <div class="widget-title-bar">
          <h4>Search Filter</h4>
          <button class="sidebar-close-btn" id="sidebarCloseBtn"><svg width="18" height="18"><use href="#icon-close"/></svg></button>
        </div>
        <form id="filterForm" class="sidebar-filter-form">
          <div class="form-group">
            <label for="makerSelect">Maker</label>
            <select id="makerSelect" class="form-select">
              <option value="">Select Maker</option>
              <option value="Hyundai">Hyundai</option>
              <option value="Kia">Kia</option>
              <option value="Genesis">Genesis</option>
              <option value="Chevrolet">Chevrolet</option>
              <option value="SsangYong">KG Mobility (SsangYong)</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="modelSelect">Model</label>
            <select id="modelSelect" class="form-select">
              <option value="">Select Model</option>
            </select>
          </div>

          <div class="form-group">
            <label for="fuelSelect">Fuel Type</label>
            <select id="fuelSelect" class="form-select">
              <option value="">Select Fuel Type</option>
              <option value="Gasoline">Gasoline</option>
              <option value="Diesel">Diesel</option>
              <option value="Hybrid">Hybrid</option>
              <option value="LPG">LPG</option>
              <option value="Electric">Electric</option>
            </select>
          </div>

          <div class="form-group">
            <label for="transSelect">Transmission</label>
            <select id="transSelect" class="form-select">
              <option value="">Select Transmission</option>
              <option value="Automatic">Automatic</option>
              <option value="Manual">Manual</option>
            </select>
          </div>

          <div class="form-group">
            <label for="locationSelect">Location</label>
            <select id="locationSelect" class="form-select">
              <option value="">Select Location</option>
              <option value="Incheon Head Yard">Incheon Head Yard</option>
              <option value="Incheon Yard II">Incheon Yard II</option>
              <option value="Pyeongtaek Port Yard">Pyeongtaek Port Yard</option>
              <option value="Dubai Showroom">Dubai Showroom</option>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="yearMin">Min Year</label>
              <input type="number" id="yearMin" class="form-input" placeholder="Min" min="2010" max="2026">
            </div>
            <div class="form-group">
              <label for="yearMax">Max Year</label>
              <input type="number" id="yearMax" class="form-input" placeholder="Max" min="2010" max="2026">
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-full">Search Now</button>
          <button type="button" id="resetBtn" class="btn btn-outline w-full">Reset Filters</button>
        </form>
      </div>

      <!-- Body Type Widget -->
      <div class="sidebar-widget">
        <h4>Body Type</h4>
        <div class="body-types-grid" id="bodyTypesGrid">
          <button class="body-type-btn" data-body="Sedan">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-car"/></svg></div>
            <span>Sedan</span>
          </button>
          <button class="body-type-btn" data-body="SUV">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-shield"/></svg></div>
            <span>SUV</span>
          </button>
          <button class="body-type-btn" data-body="Truck">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-truck"/></svg></div>
            <span>Truck</span>
          </button>
          <button class="body-type-btn" data-body="Van">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-bus"/></svg></div>
            <span>Van</span>
          </button>
        </div>
      </div>

      <!-- Car Brands Widget -->
      <div class="sidebar-widget">
        <h4>Car Brands</h4>
        <ul class="sidebar-brands-list" id="sidebarBrandsList">
          <li data-maker="Hyundai"><span>Hyundai</span> <span class="badge">1,273</span></li>
          <li data-maker="Kia"><span>Kia</span> <span class="badge">481</span></li>
          <li data-maker="Genesis"><span>Genesis</span> <span class="badge">56</span></li>
          <li data-maker="Chevrolet"><span>Chevrolet</span> <span class="badge">76</span></li>
          <li data-maker="SsangYong"><span>KG Mobility</span> <span class="badge">116</span></li>
        </ul>
      </div>

      @if ($mostViewed->isNotEmpty())
        <!-- Most Viewed Widget -->
        <div class="sidebar-widget most-viewed-widget">
          <h4>Most Viewed</h4>
          <div class="most-viewed-list">
            @foreach ($mostViewed as $v)
              <a href="{{ route('car-detail', ['id' => $v->code]) }}" class="mini-car-card">
                <img src="{{ $v->image }}" alt="{{ $v->name }}">
                <div>
                  <h5>{{ $v->name }}</h5>
                  <span>{{ $v->fuel }}{{ $v->engine ? ' · ' . $v->engine : '' }}</span>
                  <span class="price">${{ number_format($v->price) }}</span>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif
    </aside>

    <!-- Right Column: Main Content -->
    <div class="cars-main-deck">
      <div class="deck-header-row">
        <div class="result-summary">
          <h4 id="resultSummaryText">Search Result: Loading...</h4>
        </div>
        <div class="deck-toolbar">
          <button class="mobile-filter-trigger" id="mobileFilterTrigger" aria-label="Open filters">
            <svg width="18" height="18"><use href="#icon-filter"/></svg> Filter
          </button>
          <div class="view-toggle-btns">
            <button class="toggle-btn active" id="viewList" aria-label="List View">
              <svg width="18" height="18"><use href="#icon-menu"/></svg>
            </button>
            <button class="toggle-btn" id="viewGrid" aria-label="Grid View">
              <svg width="18" height="18"><use href="#icon-grid"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Active filter chips -->
      <div class="active-chips-bar" id="activeChipsBar">
        <!-- Rendered dynamically -->
      </div>

      <!-- Cars Listing Grid -->
      <div class="cars-list-container list-view" id="carsListContainer">
        <!-- Rendered dynamically from cars.js -->
      </div>

      <!-- Pagination -->
      <div class="pagination-bar" id="paginationBar">
        <!-- Rendered dynamically -->
      </div>
    </div>
  </div>

</main>
@endsection

@push('scripts')
<script>
  const CAR_DATABASE = @json($carDatabase);
  const MAKER_MODELS = @json($makerModels);
</script>
<script src="{{ asset('assets/js/cars.js') }}"></script>

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
