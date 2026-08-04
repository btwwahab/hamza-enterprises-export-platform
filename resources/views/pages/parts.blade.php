@extends('layouts.app')

@section('title')
Certified Spare Parts Stock — Hamza Enterprises
@endsection

@section('meta_description')
Search and filter our stock of certified, inspected used and rebuilt car parts, including engines, transmissions, headlights, and body parts exported from South Korea.
@endsection

@php($navActive = 'parts')

@section('content')
<main>

  <section class="cars-hero" style="background: linear-gradient(135deg, #0e1726 40%, #1e293b 100%);">
    <div class="container">
      <div class="cars-hero-content">
        <h1>Parts Available Stock</h1>
        <p>Our Parts are certified, inspected, and economical. Providing high-quality car parts at affordable export prices. When you need replacement parts, Hamza Enterprises is your best choice.</p>
      </div>
    </div>
  </section>

  <div class="container cars-page-layout">
    <!-- Left Column: Sidebar Filters -->
    <aside class="cars-sidebar" id="partsSidebar">
      <div class="sidebar-widget search-filter-box">
        <div class="widget-title-bar">
          <h4>Parts Filter</h4>
          <button class="sidebar-close-btn" id="sidebarCloseBtn"><svg width="18" height="18"><use href="#icon-close"/></svg></button>
        </div>
        <form id="filterForm" class="sidebar-filter-form">
          <div class="form-group">
            <label for="makerSelect">Maker</label>
            <select id="makerSelect" class="form-select">
              <option value="">Maker</option>
              <option value="Hyundai">Hyundai</option>
              <option value="Kia">Kia</option>
              <option value="Genesis">Genesis</option>
              <option value="SsangYong">KG Mobility (SsangYong)</option>
              <option value="Chevrolet">Chevrolet</option>
              <option value="Honda">Honda</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="modelSelect">Model</label>
            <select id="modelSelect" class="form-select">
              <option value="">Model</option>
            </select>
          </div>

          <div class="form-group">
            <label for="yearSelect">Model Year</label>
            <select id="yearSelect" class="form-select">
              <option value="">Model Year</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2025">2025</option>
            </select>
          </div>

          <div class="form-group">
            <label for="priceSelect">Price</label>
            <select id="priceSelect" class="form-select">
              <option value="">Price</option>
              <option value="under-500">Under $500</option>
              <option value="500-1000">$500 - $1,000</option>
              <option value="1000-2000">$1,000 - $2,000</option>
              <option value="over-2000">Over $2,000</option>
            </select>
          </div>

          <div class="form-group">
            <label for="locationSelect">Location</label>
            <select id="locationSelect" class="form-select">
              <option value="">Location</option>
              <option value="Incheon Head Yard">Incheon Head Yard</option>
              <option value="Incheon Yard II">Incheon Yard II</option>
              <option value="Pyeongtaek Port Yard">Pyeongtaek Port Yard</option>
              <option value="Dubai Showroom">Dubai Showroom</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-full">Search Now</button>
          <button type="button" id="resetBtn" class="btn btn-outline w-full">Reset Filters</button>
        </form>
      </div>

      <!-- Part Categories Grid Widget -->
      <div class="sidebar-widget">
        <h4>Part Categories</h4>
        <div class="body-types-grid" id="categoryGrid">
          <button class="body-type-btn" data-category="Engine">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-gauge"/></svg></div>
            <span>Engines</span>
          </button>
          <button class="body-type-btn" data-category="Transmission">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-grid"/></svg></div>
            <span>Gearboxes</span>
          </button>
          <button class="body-type-btn" data-category="Lighting">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-bolt"/></svg></div>
            <span>Lighting</span>
          </button>
          <button class="body-type-btn" data-category="Body Parts">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-car"/></svg></div>
            <span>Body Parts</span>
          </button>
        </div>
      </div>

      <!-- Part Brands Widget -->
      <div class="sidebar-widget">
        <h4>Filter by Brand</h4>
        <ul class="sidebar-brands-list" id="sidebarBrandsList">
          <li data-maker="Hyundai"><span>Hyundai Parts</span> <span class="badge">3</span></li>
          <li data-maker="Kia"><span>Kia Parts</span> <span class="badge">3</span></li>
          <li data-maker="Genesis"><span>Genesis Luxury</span> <span class="badge">2</span></li>
          <li data-maker="SsangYong"><span>KG Mobility</span> <span class="badge">1</span></li>
          <li data-maker="Honda"><span>Honda Parts</span> <span class="badge">2</span></li>
        </ul>
      </div>

      <!-- Contact Info Widget -->
      <div class="sidebar-widget contact-info-widget">
        <h4>Quick Contact</h4>
        <ul class="sidebar-contact-info-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px;">
          <li style="display: flex; gap: 12px; align-items: flex-start;">
            <div style="width: 32px; height: 32px; border-radius: 50%; border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0;"><svg width="14" height="14"><use href="#icon-phone"/></svg></div>
            <div>
              <span style="display: block; font-size: 0.72rem; color: var(--ink-faint); font-weight: 700; text-transform: uppercase;">Quick Call</span>
              <a href="tel:+821064995384" style="font-size: 0.88rem; font-weight: 700; color: var(--ink); text-decoration: none;">+82 10 6499 5384</a>
            </div>
          </li>
          <li style="display: flex; gap: 12px; align-items: flex-start;">
            <div style="width: 32px; height: 32px; border-radius: 50%; border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0;"><svg width="14" height="14"><use href="#icon-mail"/></svg></div>
            <div>
              <span style="display: block; font-size: 0.72rem; color: var(--ink-faint); font-weight: 700; text-transform: uppercase;">Quick Email</span>
              <a href="https://wa.me/821064995384" style="font-size: 0.88rem; font-weight: 700; color: var(--ink); text-decoration: none;">WhatsApp: +82 10 6499 5384</a>
            </div>
          </li>
          <li style="display: flex; gap: 12px; align-items: flex-start;">
            <div style="width: 32px; height: 32px; border-radius: 50%; border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0;"><svg width="14" height="14"><use href="#icon-pin"/></svg></div>
            <div>
              <span style="display: block; font-size: 0.72rem; color: var(--ink-faint); font-weight: 700; text-transform: uppercase;">Office Address</span>
              <span style="font-size: 0.82rem; font-weight: 600; color: var(--ink-soft); line-height: 1.4;">Byeoksan Village, Yeonsu-gu, Incheon, South Korea</span>
            </div>
          </li>
        </ul>
      </div>

      @if ($mostViewed->isNotEmpty())
        <!-- Most Viewed Widget -->
        <div class="sidebar-widget most-viewed-widget">
          <h4>Popular Requests</h4>
          <div class="most-viewed-list">
            @foreach ($mostViewed as $p)
              <a href="{{ route('part-detail', ['id' => $p->code]) }}" class="mini-car-card">
                <div style="width:72px; height:52px; background:#0f141d; border-radius:var(--radius-sm); overflow:hidden; border:1px solid var(--border); display:flex; align-items:center; justify-content:center;">
                  <svg width="28" height="28" style="color:var(--accent);"><use href="#{{ $categoryIcons[$p->category] ?? 'icon-grid' }}"/></svg>
                </div>
                <div>
                  <h5>{{ $p->name }}</h5>
                  <span>{{ $p->condition }} · {{ $p->category }}</span>
                  <span class="price">${{ number_format($p->price) }}</span>
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

      <!-- Parts Listing Container -->
      <div class="cars-list-container list-view" id="partsListContainer">
        <!-- Rendered dynamically from parts.js -->
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
  const PARTS_DATABASE = @json($partsDatabase);
  const MODEL_MAPPING = @json($modelMapping);
</script>
<script src="{{ asset('assets/js/parts-blueprint.js') }}"></script>
<script src="{{ asset('assets/js/parts.js') }}"></script>

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
