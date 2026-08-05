@extends('layouts.app')

@section('title')
Event Details — Hamza Enterprises
@endsection

@section('meta_description')
Full story, photos and details for this Hamza Enterprises event, port log or company update.
@endsection

@section('content')
<main>
  <div class="container detail-breadcrumb">
    <a href="{{ route('home') }}">Home</a> <span>/</span> <a href="{{ route('events') }}">Events</a> <span>/</span> <span id="crumbCurrent">Loading…</span>
  </div>

  <div class="container events-page-layout" style="align-items:start">
    <div class="events-main-feed" id="eventDetailContainer">
      <!-- Populated by event-detail.js -->
    </div>

    <aside class="events-sidebar">
      <div class="sidebar-widget">
        <h4>Quick Search</h4>
        <form class="sidebar-search-form" action="{{ route('events') }}" method="GET">
          <div style="display: flex; gap: 8px;">
            <input type="text" name="q" class="form-input" placeholder="Quick Search..." style="flex: 1;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 16px; background: #dc2626; border-color: #dc2626; display: flex; align-items: center; justify-content: center;">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
          </div>
        </form>
      </div>

      <div class="sidebar-widget">
        <h4>Recent Updates</h4>
        <div class="most-viewed-list" id="recentEventsList">
          <!-- Rendered dynamically -->
        </div>
      </div>
    </aside>
  </div>
</main>
@endsection

@push('scripts')
<script>
  const EVENTS_DATABASE = @json($eventsDatabase);
</script>
<script src="{{ asset('assets/js/event-detail.js') }}"></script>
@endpush
