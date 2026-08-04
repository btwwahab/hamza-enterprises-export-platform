@extends('layouts.app')

@section('title')
Site Map — Hamza Enterprises
@endsection

@section('meta_description')
View the complete directory map of Hamza Enterprises including member accounts, vehicle listings, parts catalog, shipping schedule, and support resources.
@endsection

@push('styles')
<style>
  /* Site Map Tree Styles */
  .sitemap-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-bottom: 40px;
  }
  @media (max-width: 768px) {
    .sitemap-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }
  }
  .sitemap-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 30px;
  }
  .sitemap-card h3 {
    font-size: 1.2rem;
    color: var(--ink);
    margin: 0 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
  }
  .sitemap-card h3 svg {
    color: var(--accent);
  }
  .sitemap-tree {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .sitemap-tree li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 12px;
    line-height: 1.5;
  }
  .sitemap-tree li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 10px;
    width: 10px;
    height: 1px;
    background: var(--border);
  }
  .sitemap-tree li::after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: -12px;
    width: 1px;
    background: var(--border);
  }
  .sitemap-tree li:last-child::after {
    height: 10px;
  }
  .sitemap-tree a {
    color: var(--ink-light);
    text-decoration: none;
    font-size: 0.92rem;
    font-weight: 500;
    transition: color 0.2s ease;
  }
  .sitemap-tree a:hover {
    color: var(--accent);
  }
  .sitemap-tree .nested-tree {
    list-style: none;
    padding: 8px 0 0 10px;
    margin: 0;
  }
  .sitemap-tree .nested-tree li {
    margin-bottom: 8px;
  }
  .sitemap-tree .nested-tree li::before {
    width: 8px;
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
        <h1>Site Map</h1>
        <p>A comprehensive directory index of all pages, categories, product filters, account features, and legal terms on Hamza Enterprises.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: Sitemap Tree Grid -->
    <div class="events-main-feed">
      
      <div class="sitemap-grid">
        
        <!-- Member Accounts -->
        <div class="sitemap-card">
          <h3><svg width="18" height="18"><use href="#icon-folder"/></svg> Member Accounts</h3>
          <ul class="sitemap-tree">
            <li><a href="#">Register</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Profile Settings</a>
              <ul class="nested-tree">
                <li><a href="#">Update Profile</a></li>
                <li><a href="#">Change Password</a></li>
              </ul>
            </li>
            <li><a href="#">My Bookings</a>
              <ul class="nested-tree">
                <li><a href="#">List of Bookings</a></li>
                <li><a href="#">Track my Booking</a></li>
                <li><a href="#">Update my Booking</a></li>
              </ul>
            </li>
            <li><a href="#">My Orders</a>
              <ul class="nested-tree">
                <li><a href="#">List of Orders</a></li>
                <li><a href="#">Track my Order</a></li>
                <li><a href="#">Upload Payment Receipt</a></li>
                <li><a href="#">Download Invoice</a></li>
              </ul>
            </li>
            <li><a href="#">Delete Account</a></li>
            <li><a href="#">Forgot Password</a></li>
          </ul>
        </div>

        <!-- Inventory: Cars -->
        <div class="sitemap-card">
          <h3><svg width="18" height="18"><use href="#icon-folder"/></svg> Cars</h3>
          <ul class="sitemap-tree">
            <li><a href="cars">Browse All Cars</a></li>
            <li><a href="cars?maker=Hyundai">Filter by Maker</a>
              <ul class="nested-tree">
                <li><a href="cars?maker=Hyundai">Hyundai</a></li>
                <li><a href="cars?maker=Kia">Kia</a></li>
                <li><a href="cars?maker=Genesis">Genesis</a></li>
              </ul>
            </li>
            <li><a href="cars?body=Sedan">Vehicle Type</a>
              <ul class="nested-tree">
                <li><a href="cars?body=Sedan">Sedan</a></li>
                <li><a href="cars?body=Hatchback">Hatchback</a></li>
                <li><a href="cars?body=Coupe">Coupe</a></li>
              </ul>
            </li>
            <li><a href="cars?fuel=Gasoline">Fuel Type</a>
              <ul class="nested-tree">
                <li><a href="cars?fuel=Gasoline">Gasoline</a></li>
                <li><a href="cars?fuel=Diesel">Diesel</a></li>
                <li><a href="cars?fuel=LPG">LPG</a></li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- Inventory: SUVs -->
        <div class="sitemap-card">
          <h3><svg width="18" height="18"><use href="#icon-folder"/></svg> SUVs</h3>
          <ul class="sitemap-tree">
            <li><a href="cars?body=SUV">Browse SUVs</a></li>
            <li><a href="cars?body=SUV&maker=Hyundai">Maker Type</a></li>
            <li><a href="cars?body=SUV">Best Selling Models</a>
              <ul class="nested-tree">
                <li><a href="cars?maker=Kia&model=Sportage">Kia Sportage</a></li>
                <li><a href="cars?maker=Hyundai&model=Palisade">Hyundai Palisade</a></li>
              </ul>
            </li>
            <li><a href="cars?body=SUV&fuel=Diesel">Fuel Type</a></li>
            <li><a href="cars?body=SUV&drive=4WD">Drive Type (2WD/4WD)</a></li>
          </ul>
        </div>

        <!-- Inventory: Trucks & Buses -->
        <div class="sitemap-card">
          <h3><svg width="18" height="18"><use href="#icon-folder"/></svg> Trucks &amp; Buses</h3>
          <ul class="sitemap-tree">
            <li><a href="cars?body=Truck">Browse Trucks</a>
              <ul class="nested-tree">
                <li><a href="cars?body=Truck&maker=Hyundai">Hyundai Porter II</a></li>
                <li><a href="cars?body=Truck&maker=Kia">Kia Bongo III</a></li>
              </ul>
            </li>
            <li><a href="cars?body=Truck">Loading Weight Limits</a></li>
            <li><a href="cars?body=Van">Browse Buses &amp; Vans</a></li>
            <li><a href="cars?body=Van">Seats Count</a></li>
          </ul>
        </div>

        <!-- Spare Parts catalog -->
        <div class="sitemap-card">
          <h3><svg width="18" height="18"><use href="#icon-folder"/></svg> Spare Parts</h3>
          <ul class="sitemap-tree">
            <li><a href="parts">Browse Spare Parts</a></li>
            <li><a href="parts?category=Engine">Engine Assemblies</a></li>
            <li><a href="parts?category=Transmission">Transmission Systems</a></li>
            <li><a href="parts?category=Lighting">Headlights &amp; Lighting</a></li>
            <li><a href="parts?category=Suspension">Suspension &amp; Shocks</a></li>
          </ul>
        </div>

        <!-- Main Schedules & Blogs -->
        <div class="sitemap-card">
          <h3><svg width="18" height="18"><use href="#icon-folder"/></svg> Shipping &amp; Events</h3>
          <ul class="sitemap-tree">
            <li><a href="events">Events &amp; Port Logs</a>
              <ul class="nested-tree">
                <li><a href="events?category=Events">Latest Events</a></li>
                <li><a href="events?category=Port%20Logs">Live Port Loading Logs</a></li>
                <li><a href="events?category=Deliveries">Customer Handover Ceremonies</a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>

    </div>

    <!-- Right Column: Sidebar -->
    <aside class="events-sidebar">
      
      <!-- Support Pages Widget -->
      <div class="sidebar-widget">
        <h4>Support Pages</h4>
        <ul class="support-pages-list">
          <li><a href="about-us">About Us</a></li>
          <li><a href="cars">About Korean Cars</a></li>
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
            <span>24/7 Support</span>
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
