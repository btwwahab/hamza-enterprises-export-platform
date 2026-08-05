@extends('layouts.admin')

@section('title')
Machinery — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>Machinery Inventory</h1><p>Manage all heavy machinery listings, status and pricing.</p></div>
  <div style="display:flex;gap:10px">
    <a href="{{ route('admin.machinery.export', request()->query()) }}" class="btn btn-secondary">⬇ Export Report</a>
    <a href="{{ route('admin.machinery.form') }}" class="btn btn-primary">+ Add Machinery</a>
  </div>
</div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<!-- Stats bar -->
<div class="stats-bar">
  <div class="stats-bar-item"><span class="label">Total</span><span class="value">{{ $stats['total'] }}</span></div>
  <div class="stats-bar-item"><span class="label">Available</span><span class="value" style="color:var(--success)">{{ $stats['available'] }}</span></div>
  <div class="stats-bar-item"><span class="label">Reserved</span><span class="value" style="color:var(--warning)">{{ $stats['reserved'] }}</span></div>
  <div class="stats-bar-item"><span class="label">Sold</span><span class="value" style="color:var(--danger)">{{ $stats['sold'] }}</span></div>
</div>

<!-- Filters -->
<form method="GET" action="{{ route('admin.machinery') }}" class="filter-bar">
  <div class="search-wrap">
    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Search by name, serial or item no…">
  </div>
  <select name="maker" class="filter-select" onchange="this.form.submit()">
    <option value="">All Makes</option>
    @foreach ($makers as $maker)
      <option value="{{ $maker }}" @selected(request('maker') === $maker)>{{ $maker }}</option>
    @endforeach
  </select>
  <select name="category" class="filter-select" onchange="this.form.submit()">
    <option value="">All Categories</option>
    @foreach (['Construction Machinery','Heavy Equipment','Agricultural Machinery'] as $c)
      <option @selected(request('category') === $c)>{{ $c }}</option>
    @endforeach
  </select>
  <select name="fuel" class="filter-select" onchange="this.form.submit()">
    <option value="">All Fuels</option>
    @foreach (['Diesel','Gasoline','Electric','Hybrid'] as $f)
      <option @selected(request('fuel') === $f)>{{ $f }}</option>
    @endforeach
  </select>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All Status</option>
    @foreach (['Available','Reserved','Sold'] as $s)
      <option @selected(request('status') === $s)>{{ $s }}</option>
    @endforeach
  </select>
  <button type="submit" class="btn btn-secondary btn-sm">Search</button>
</form>

<!-- Table -->
<div class="table-wrap">
  <table>
    <thead><tr><th>Photo</th><th>Machinery</th><th>Year</th><th>Price</th><th>Hours</th><th>Fuel</th><th>Location</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($machines as $m)
        <tr>
          <td><img src="{{ $m->image }}" alt="" class="table-img" onerror="this.style.display='none'"></td>
          <td><strong>{{ $m->name }}</strong><br><small style="color:var(--text-soft)">{{ $m->item_no }} · {{ $m->serial_no }}</small></td>
          <td>{{ $m->year }}</td>
          <td><strong>${{ number_format($m->price) }}</strong></td>
          <td>{{ number_format($m->hours) }} hrs</td>
          <td>{{ $m->fuel }}</td>
          <td style="font-size:12px">{{ $m->location }}</td>
          <td><span class="badge {{ $m->status === 'Available' ? 'badge-green' : ($m->status === 'Reserved' ? 'badge-amber' : 'badge-red') }}">{{ $m->status }}</span></td>
          <td>
            <div style="display:flex;gap:4px">
              <a href="{{ route('admin.machinery.form', ['id' => $m->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
              <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $m->id }}, '{{ addslashes($m->name) }}')"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg></button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($machines->isEmpty())
    <div class="empty-state">
      <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <h4>No machinery found</h4><p>Try adjusting your search or filters.</p>
    </div>
  @endif

  <div class="pagination">
    <span class="page-info">Showing {{ $machines->firstItem() ?? 0 }}–{{ $machines->lastItem() ?? 0 }} of {{ $machines->total() }}</span>
    @for ($i = 1; $i <= $machines->lastPage(); $i++)
      <a href="{{ $machines->appends(request()->query())->url($i) }}" class="page-btn {{ $i === $machines->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
  </div>
</div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Machinery</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Are you sure you want to delete <strong id="deleteMachineName"></strong>? This action cannot be undone.</p></div>
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
renderShell('machinery','Machinery Inventory');

function openDelete(id, name) {
  document.getElementById('deleteMachineName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/machinery/' + id;
  document.getElementById('deleteModal').classList.add('open');
}

document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
