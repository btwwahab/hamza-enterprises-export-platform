@extends('layouts.app')

@section('title')
Vehicle Details — Hamza Enterprises
@endsection

@section('meta_description')
Full specifications, inspection report, and pricing for this certified used vehicle from Hamza Enterprises. Enquire directly on WhatsApp — no sign-up required.
@endsection

@section('content')
<main>
  <div class="container detail-breadcrumb">
    <a href="{{ route('home') }}">Home</a> <span>/</span> <a href="{{ route('cars') }}">Vehicles</a> <span>/</span> <span id="crumbCurrent">Loading…</span>
  </div>

  <div class="container detail-layout" id="detailLayout">
    <!-- Populated by car-detail.js -->
  </div>

  <section class="section similar-vehicles" id="similarVehicles" style="display:none;">
    <div class="container">
      <div class="section-head">
        <h2>Similar vehicles</h2>
        <p>Other units from the same category currently in stock.</p>
      </div>
      <div class="listing-grid" id="similarGrid"></div>
    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
  const CAR_DATABASE = @json($carDatabase);
</script>
<script src="{{ asset('assets/js/car-detail.js') }}"></script>

@endpush
