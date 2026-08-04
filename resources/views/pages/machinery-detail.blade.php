@extends('layouts.app')

@php($navActive = 'machinery')

@section('title')
Machinery Details — Hamza Enterprises
@endsection

@section('meta_description')
Full specifications, inspection report, and pricing for this certified used machine from Hamza Enterprises. Enquire directly on WhatsApp — no sign-up required.
@endsection

@section('content')
<main>
  <div class="container detail-breadcrumb">
    <a href="{{ route('home') }}">Home</a> <span>/</span> <a href="{{ route('machinery') }}">Machinery</a> <span>/</span> <span id="crumbCurrent">Loading…</span>
  </div>

  <div class="container detail-layout" id="detailLayout">
    <!-- Populated by machinery-detail.js -->
  </div>

  <section class="section similar-vehicles" id="similarVehicles" style="display:none;">
    <div class="container">
      <div class="section-head">
        <h2>Similar machinery</h2>
        <p>Other units from the same category currently in stock.</p>
      </div>
      <div class="listing-grid" id="similarGrid"></div>
    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
  const MACHINERY_DATABASE = @json($machineryDatabase);
</script>
<script src="{{ asset('assets/js/machinery-detail.js') }}"></script>

@endpush
