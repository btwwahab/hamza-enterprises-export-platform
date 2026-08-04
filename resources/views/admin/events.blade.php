@extends('layouts.admin')

@section('title')
Events — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>Events & News</h1><p>Manage company news, port logs and delivery updates.</p></div>
  <a href="{{ route('admin.events.form') }}" class="btn btn-primary">+ Add Event</a>
</div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<form method="GET" action="{{ route('admin.events') }}" class="filter-bar">
  <div class="search-wrap">
    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Search events…">
  </div>
  <select name="category" class="filter-select" onchange="this.form.submit()">
    <option value="">All Categories</option>
    @foreach (['Events','Company News','Port Logs','Deliveries'] as $c)
      <option @selected(request('category') === $c)>{{ $c }}</option>
    @endforeach
  </select>
  <button type="submit" class="btn btn-secondary btn-sm">Search</button>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Title</th><th>Category</th><th>Date</th><th>Author</th><th>Shares</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($events as $e)
        @php
          $catColors = ['Events'=>'badge-orange','Company News'=>'badge-blue','Port Logs'=>'badge-amber','Deliveries'=>'badge-green'];
        @endphp
        <tr>
          <td><strong style="font-size:13px">{{ $e->title }}</strong><br><small style="color:var(--text-soft)">{{ \Illuminate\Support\Str::limit($e->summary, 80) }}</small></td>
          <td><span class="badge {{ $catColors[$e->category] ?? 'badge-gray' }}">{{ $e->category }}</span></td>
          <td style="white-space:nowrap;font-size:12px">{{ $e->event_date->format('d M, Y') }}</td>
          <td style="font-size:12px">{{ $e->author }}</td>
          <td>{{ $e->shares_count ?? 0 }}</td>
          <td>
            <div style="display:flex;gap:4px">
              <a href="{{ route('admin.events.form', ['id' => $e->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
              <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $e->id }}, '{{ addslashes($e->title) }}')"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg></button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($events->isEmpty())
    <div class="empty-state"><h4>No events found</h4></div>
  @endif

  <div class="pagination">
    <span class="page-info">Showing {{ $events->firstItem() ?? 0 }}–{{ $events->lastItem() ?? 0 }} of {{ $events->total() }}</span>
    @for ($i = 1; $i <= $events->lastPage(); $i++)
      <a href="{{ $events->appends(request()->query())->url($i) }}" class="page-btn {{ $i === $events->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
  </div>
</div>

<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Event</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Delete <strong id="deleteEventName"></strong>?</p></div>
    <div class="modal-footer">
      <button class="btn btn-secondary" id="cancelDelete">Cancel</button>
      <form id="deleteForm" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
renderShell('events','Events & News');
function openDelete(id, name) {
  document.getElementById('deleteEventName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/events/' + id;
  document.getElementById('deleteModal').classList.add('open');
}
document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
