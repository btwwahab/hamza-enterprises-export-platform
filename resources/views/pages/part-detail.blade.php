@extends('layouts.app')

@php($navActive = 'parts')

@section('title')
Part Details — Hamza Enterprises
@endsection

@section('meta_description')
Full specifications and pricing for this spare part from Hamza Enterprises. Enquire directly on WhatsApp — no sign-up required.
@endsection

@section('content')
<main>
  <div class="container detail-breadcrumb">
    <a href="{{ route('home') }}">Home</a> <span>/</span> <a href="{{ route('parts') }}">Parts</a> <span>/</span> <span id="crumbCurrent">Loading…</span>
  </div>

  <div class="container detail-layout" id="detailLayout">
    <!-- Populated by part-detail.js -->
  </div>

  <section class="section similar-vehicles" id="similarParts" style="display:none;">
    <div class="container">
      <div class="section-head">
        <h2>Similar parts</h2>
        <p>Other parts from the same category currently in stock.</p>
      </div>
      <div class="listing-grid" id="similarGrid"></div>
    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
  const PARTS_DATABASE = @json($partsDatabase);
</script>
<script src="{{ asset('assets/js/parts-blueprint.js') }}"></script>
<script src="{{ asset('assets/js/part-detail.js') }}"></script>

@endpush
