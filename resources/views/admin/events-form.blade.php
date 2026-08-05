@extends('layouts.admin')

@section('title')
{{ $event ? 'Edit Event' : 'Add Event' }} — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>{{ $event ? 'Edit Event / News' : 'Add Event / News' }}</h1></div>
  <a href="{{ route('admin.events') }}" class="btn btn-secondary">← Back</a>
</div>

<form method="POST" action="{{ $event ? route('admin.events.update', $event) : route('admin.events.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($event) @method('PUT') @endif

  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Event Details</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2"><label>Title *</label><input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" class="form-control" required placeholder="Hamza Enterprises Export Reunion 2026">@error('title')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group">
          <label>Category *</label>
          <select name="category" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Events','Company News','Port Logs','Deliveries'] as $opt)
              <option @selected(old('category', $event->category ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Date *</label><input type="date" name="event_date" value="{{ old('event_date', optional($event->event_date ?? null)->format('Y-m-d')) }}" class="form-control" required></div>
        <div class="form-group"><label>Author *</label><input type="text" name="author" value="{{ old('author', $event->author ?? '') }}" class="form-control" placeholder="Admin Desk" required></div>
        <div class="form-group"><label>Shares Count</label><input type="number" name="shares_count" value="{{ old('shares_count', $event->shares_count ?? 0) }}" class="form-control" placeholder="0" min="0"></div>
        <div class="form-group col-2">
          <label>Image</label>
          @if ($event && $event->image)
            <div style="margin-bottom:8px"><img src="{{ $event->image }}" alt="" style="height:70px;border-radius:8px;border:1px solid var(--border)"></div>
          @endif
          <input type="file" name="image" class="form-control" accept="image/*">
          @error('image')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
        </div>
        <div class="form-group col-2"><label>Summary *</label><textarea name="summary" class="form-control" rows="2" required placeholder="Short summary shown in event cards…">{{ old('summary', $event->summary ?? '') }}</textarea></div>
        <div class="form-group col-2"><label>Full Content *</label><textarea name="content" class="form-control" rows="5" required placeholder="Full event description shown on detail view…">{{ old('content', $event->content ?? '') }}</textarea></div>
      </div>

      <h4 style="margin:20px 0 10px;font-size:14px;color:var(--text-soft)">Share Links (optional)</h4>
      <p style="margin:-6px 0 12px;font-size:12px;color:var(--text-soft)">Paste a link for any platform you want this event to be shareable on. Only platforms with a link filled in will show their icon on the site — leave blank to hide.</p>
      <div class="form-grid">
        <div class="form-group"><label>Facebook Link</label><input type="url" name="link_facebook" value="{{ old('link_facebook', $event->link_facebook ?? '') }}" class="form-control" placeholder="https://facebook.com/...">@error('link_facebook')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group"><label>Twitter / X Link</label><input type="url" name="link_twitter" value="{{ old('link_twitter', $event->link_twitter ?? '') }}" class="form-control" placeholder="https://twitter.com/...">@error('link_twitter')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group"><label>WhatsApp Link</label><input type="url" name="link_whatsapp" value="{{ old('link_whatsapp', $event->link_whatsapp ?? '') }}" class="form-control" placeholder="https://wa.me/...">@error('link_whatsapp')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:10px;justify-content:flex-end">
    <a href="{{ route('admin.events') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save Event</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('events', {!! $event ? "'Edit Event'" : "'Add Event'" !!});
</script>
@endpush
