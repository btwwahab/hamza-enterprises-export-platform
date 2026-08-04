@extends('layouts.app')

@php($navActive = 'machinery')

@section('title')
Heavy Machinery Inventory — Hamza Enterprises
@endsection

@section('meta_description')
Search and filter our live inventory of certified used construction, heavy equipment, and agricultural machinery available for export from Incheon, South Korea.
@endsection

@section('content')
<main>

  <section class="cars-hero">
    <div class="container">
      <div class="cars-hero-content">
        <h1>Search Heavy Machinery</h1>
        <p>Explore and filter inspected construction, heavy equipment, and agricultural machinery sourced from South Korea.</p>
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
              @foreach (array_keys($makerModels) as $maker)
                <option value="{{ $maker }}">{{ $maker }}</option>
              @endforeach
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
              <option value="Diesel">Diesel</option>
              <option value="Gasoline">Gasoline</option>
              <option value="Electric">Electric</option>
              <option value="Hybrid">Hybrid</option>
            </select>
          </div>

          <div class="form-group">
            <label for="locationSelect">Location</label>
            <select id="locationSelect" class="form-select">
              <option value="">Select Location</option>
              <option value="Incheon Head Yard">Incheon Head Yard</option>
              <option value="Incheon Yard II">Incheon Yard II</option>
              <option value="Pyeongtaek Port Yard">Pyeongtaek Port Yard</option>
              <option value="Busan Export Yard">Busan Export Yard</option>
              <option value="Dubai Showroom">Dubai Showroom</option>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="yearMin">Min Year</label>
              <input type="number" id="yearMin" class="form-input" placeholder="Min" min="1990" max="2030">
            </div>
            <div class="form-group">
              <label for="yearMax">Max Year</label>
              <input type="number" id="yearMax" class="form-input" placeholder="Max" min="1990" max="2030">
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-full">Search Now</button>
          <button type="button" id="resetBtn" class="btn btn-outline w-full">Reset Filters</button>
        </form>
      </div>

      <!-- Category Widget -->
      <div class="sidebar-widget">
        <h4>Category</h4>
        <div class="body-types-grid" id="categoryGrid">
          <button class="body-type-btn" data-category="Construction Machinery">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-truck"/></svg></div>
            <span>Construction</span>
          </button>
          <button class="body-type-btn" data-category="Heavy Equipment">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-bolt"/></svg></div>
            <span>Heavy Equipment</span>
          </button>
          <button class="body-type-btn" data-category="Agricultural Machinery">
            <div class="body-icon-wrap"><svg width="24" height="24"><use href="#icon-grid"/></svg></div>
            <span>Agricultural</span>
          </button>
        </div>
      </div>
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

      <!-- Machinery Listing Grid -->
      <div class="cars-list-container list-view" id="carsListContainer">
        <!-- Rendered dynamically from machinery.js -->
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
  const MACHINERY_DATABASE = @json($machineryDatabase);
  const MAKER_MODELS = @json($makerModels);
</script>
<script src="{{ asset('assets/js/machinery.js') }}"></script>
@endpush
