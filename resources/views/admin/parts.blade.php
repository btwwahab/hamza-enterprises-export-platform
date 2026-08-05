@extends('layouts.admin')

@section('title')
Parts — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>Parts Inventory</h1><p>Manage spare parts listings and stock.</p></div>
  <div style="display:flex;gap:10px">
    <a href="{{ route('admin.parts.export', request()->query()) }}" class="btn btn-secondary">⬇ Export Report</a>
    <a href="{{ route('admin.parts.form') }}" class="btn btn-primary">+ Add Part</a>
  </div>
</div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<form method="GET" action="{{ route('admin.parts') }}" class="filter-bar">
  <div class="search-wrap">
    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Search by name, Part No or OEM…">
  </div>
  <select name="category" class="filter-select" onchange="this.form.submit()">
    <option value="">All Categories</option>
    @foreach (['Engine','Transmission','Lighting','Body Parts','Suspension'] as $c)
      <option @selected(request('category') === $c)>{{ $c }}</option>
    @endforeach
  </select>
  <select name="condition" class="filter-select" onchange="this.form.submit()">
    <option value="">All Conditions</option>
    @foreach (['New','Used','Rebuilt'] as $c)
      <option @selected(request('condition') === $c)>{{ $c }}</option>
    @endforeach
  </select>
  <button type="submit" class="btn btn-secondary btn-sm">Search</button>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Part Name</th><th>Category</th><th>Maker</th><th>Condition</th><th>Price</th><th>Stock</th><th>Part No</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($parts as $p)
        @php
          $catColors = ['Engine'=>'badge-orange','Transmission'=>'badge-blue','Lighting'=>'badge-amber','Suspension'=>'badge-green','Body Parts'=>'badge-gray'];
        @endphp
        <tr>
          <td><strong>{{ $p->name }}</strong><br><small style="color:var(--text-soft)">{{ $p->fits_models }}</small></td>
          <td><span class="badge {{ $catColors[$p->category] ?? 'badge-gray' }}">{{ $p->category }}</span></td>
          <td>{{ $p->maker }}</td>
          <td><span class="badge {{ $p->condition === 'New' ? 'badge-green' : ($p->condition === 'Used' ? 'badge-amber' : 'badge-blue') }}">{{ $p->condition }}</span></td>
          <td><strong>${{ number_format($p->price) }}</strong></td>
          <td>{{ $p->stock ?? 0 }} units</td>
          <td><code style="font-size:11px">{{ $p->part_no }}</code></td>
          <td>
            <div style="display:flex;gap:4px">
              <a href="{{ route('admin.parts.form', ['id' => $p->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
              <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $p->id }}, '{{ addslashes($p->name) }}')"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg></button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($parts->isEmpty())
    <div class="empty-state"><h4>No parts found</h4><p>Adjust filters or add a new part.</p></div>
  @endif

  <div class="pagination">
    <span class="page-info">Showing {{ $parts->firstItem() ?? 0 }}–{{ $parts->lastItem() ?? 0 }} of {{ $parts->total() }}</span>
    @for ($i = 1; $i <= $parts->lastPage(); $i++)
      <a href="{{ $parts->appends(request()->query())->url($i) }}" class="page-btn {{ $i === $parts->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
  </div>
</div>

<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Part</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Delete <strong id="deletePartName"></strong>? This cannot be undone.</p></div>
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
renderShell('parts','Parts Inventory');

function openDelete(id, name) {
  document.getElementById('deletePartName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/parts/' + id;
  document.getElementById('deleteModal').classList.add('open');
}
document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
