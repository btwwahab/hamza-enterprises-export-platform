@extends('layouts.app')

@section('title')
Frequently Asked Questions — Hamza Enterprises
@endsection

@section('meta_description')
Find answers to frequently asked questions about vehicle safety, purchasing processes, shipping methods, customs duties, and local agents of Hamza Enterprises.
@endsection

@push('styles')
<style>
  /* FAQ Accordion Styles */
  .faq-section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .faq-section-title span {
    color: var(--accent);
  }
  .faq-group {
    margin-bottom: 40px;
  }
  .faq-accordion-item {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface);
    margin-bottom: 14px;
    overflow: hidden;
    transition: all 0.25s ease;
  }
  .faq-accordion-item:hover {
    border-color: var(--accent);
    box-shadow: 0 4px 20px rgba(0, 240, 255, 0.05);
  }
  .faq-header {
    width: 100%;
    background: none;
    border: none;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: left;
    color: var(--ink);
    font-weight: 700;
    font-size: 1.05rem;
    cursor: pointer;
    font-family: inherit;
    gap: 15px;
    transition: background-color 0.2s ease;
  }
  .faq-header svg {
    flex-shrink: 0;
    transition: transform 0.3s ease;
    color: var(--ink-faint);
  }
  .faq-accordion-item.active {
    border-color: var(--accent);
  }
  .faq-accordion-item.active .faq-header {
    background: var(--surface-light);
    color: var(--accent);
  }
  .faq-accordion-item.active .faq-header svg {
    transform: rotate(180deg);
    color: var(--accent);
  }
  .faq-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
  }
  .faq-body-content {
    padding: 0 24px 24px 24px;
    color: var(--ink-light);
    font-size: 0.95rem;
    line-height: 1.6;
    border-top: 1px solid var(--border);
    background: var(--surface);
  }
  .faq-body-content ol, .faq-body-content ul {
    margin: 12px 0;
    padding-left: 20px;
  }
  .faq-body-content li {
    margin-bottom: 8px;
  }
  .faq-body-content strong {
    color: var(--ink);
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
        <h1>Frequently Asked Questions</h1>
        <p>Everything you need to know about our vehicle quality standards, safety programs, payment terms, and global shipping policies.</p>
      </div>
    </div>
  </section>

  <div class="container events-page-layout">
    <!-- Left Column: FAQ Accordion Group -->
    <div class="events-main-feed">
      
@php
  $categoryMeta = [
    'Safety' => ['num' => '01', 'label' => 'About Safety', 'anchor' => 'sec-safety'],
    'Purchasing' => ['num' => '02', 'label' => 'About Purchasing', 'anchor' => 'sec-purchasing'],
    'Shipping' => ['num' => '03', 'label' => 'About Shipping', 'anchor' => 'sec-shipping'],
    'Company' => ['num' => '04', 'label' => 'About Hamza Enterprises', 'anchor' => 'sec-company'],
  ];
@endphp
@foreach ($categoryMeta as $catKey => $meta)
  @if (!empty($faqsByCategory[$catKey]))
    <div class="faq-group" id="{{ $meta['anchor'] }}">
      <h3 class="faq-section-title"><span>{{ $meta['num'] }}.</span> {{ $meta['label'] }}</h3>

      @foreach ($faqsByCategory[$catKey] as $item)
        <div class="faq-accordion-item">
          <button class="faq-header">
            Q. {{ $item->question }}
            <svg width="18" height="18"><use href="#icon-chevron-down"/></svg>
          </button>
          <div class="faq-body">
            <div class="faq-body-content">
              {!! $item->answer !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endforeach


    <!-- Right Column: Sidebar -->
    <aside class="events-sidebar">
      
      <!-- Support Pages Widget -->
      <div class="sidebar-widget">
        <h4>Support Pages</h4>
        <ul class="support-pages-list">
          <li><a href="about-us">About Us</a></li>
          <li><a href="cars">About Korean Cars</a></li>
          <li><a href="contact-us">Contact Us</a></li>
          <li class="active"><a href="faq">FAQ</a></li>
          <li><a href="privacy-policy">Privacy Policy</a></li>
          <li><a href="terms-conditions">Terms &amp; Conditions</a></li>
        </ul>
      </div>

      <!-- Quick Links Widget -->
      <div class="sidebar-widget">
        <h4>Quick Links</h4>
        <ul class="sidebar-categories-list">
          <li><a href="#sec-safety">About Safety <span class="count">&gt;</span></a></li>
          <li><a href="#sec-purchasing">About Purchasing <span class="count">&gt;</span></a></li>
          <li><a href="#sec-shipping">About Shipping <span class="count">&gt;</span></a></li>
          <li><a href="#sec-company">About Our Company <span class="count">&gt;</span></a></li>
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
            <span>KST Office</span>
          </div>
        </div>
      </div>

    </aside>
  </div>

</main>
@endsection

@push('scripts')
<script>
  // Simple Accordion Toggle Logic
  document.addEventListener("DOMContentLoaded", () => {
    // FAQ Accordion
    const accordionHeaders = document.querySelectorAll(".faq-header");
    accordionHeaders.forEach(header => {
      header.addEventListener("click", () => {
        const item = header.parentElement;
        const body = item.querySelector(".faq-body");
        const isActive = item.classList.contains("active");

        // Close all other accordions
        document.querySelectorAll(".faq-accordion-item").forEach(otherItem => {
          if (otherItem !== item) {
            otherItem.classList.remove("active");
            otherItem.querySelector(".faq-body").style.maxHeight = null;
          }
        });

        // Toggle current accordion
        if (isActive) {
          item.classList.remove("active");
          body.style.maxHeight = null;
        } else {
          item.classList.add("active");
          body.style.maxHeight = body.scrollHeight + "px";
        }
      });
    });

    // Expand the first FAQ by default
    const firstAccordion = document.querySelector(".faq-accordion-item");
    if (firstAccordion) {
      firstAccordion.classList.add("active");
      const firstBody = firstAccordion.querySelector(".faq-body");
      firstBody.style.maxHeight = firstBody.scrollHeight + "px";
    }
  });
</script>

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
