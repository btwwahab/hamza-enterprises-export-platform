@extends('layouts.admin')

@section('title')
Vehicles — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>Vehicle Inventory</h1><p>Manage all vehicle listings, status and pricing.</p></div>
  <a href="{{ route('admin.vehicles.form') }}" class="btn btn-primary">+ Add Vehicle</a>
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
<form method="GET" action="{{ route('admin.vehicles') }}" class="filter-bar">
  <div class="search-wrap">
    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Search by name, VIN or item no…">
  </div>
  <select name="maker" class="filter-select" onchange="this.form.submit()">
    <option value="">All Makes</option>
    @foreach ($makers as $maker)
      <option value="{{ $maker }}" @selected(request('maker') === $maker)>{{ $maker }}</option>
    @endforeach
  </select>
  <select name="body" class="filter-select" onchange="this.form.submit()">
    <option value="">All Types</option>
    @foreach (['Sedan','SUV','Van','Truck','Hatchback','Coupe'] as $b)
      <option @selected(request('body') === $b)>{{ $b }}</option>
    @endforeach
  </select>
  <select name="fuel" class="filter-select" onchange="this.form.submit()">
    <option value="">All Fuels</option>
    @foreach (['Gasoline','Diesel','Hybrid','Electric','LPG'] as $f)
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
    <thead><tr><th>Photo</th><th>Vehicle</th><th>Year</th><th>Price</th><th>Mileage</th><th>Fuel</th><th>Location</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($vehicles as $v)
        <tr>
          <td><img src="{{ $v->image }}" alt="" class="table-img" onerror="this.style.display='none'"></td>
          <td><strong>{{ $v->name }}</strong><br><small style="color:var(--text-soft)">{{ $v->item_no }} · {{ $v->vin_no }}</small></td>
          <td>{{ $v->year }}</td>
          <td><strong>${{ number_format($v->price) }}</strong></td>
          <td>{{ number_format($v->mileage) }} km</td>
          <td>{{ $v->fuel }}</td>
          <td style="font-size:12px">{{ $v->location }}</td>
          <td><span class="badge {{ $v->status === 'Available' ? 'badge-green' : ($v->status === 'Reserved' ? 'badge-amber' : 'badge-red') }}">{{ $v->status }}</span></td>
          <td>
            <div style="display:flex;gap:4px">
              <a href="{{ route('admin.vehicles.form', ['id' => $v->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
              <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $v->id }}, '{{ addslashes($v->name) }}')"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg></button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($vehicles->isEmpty())
    <div class="empty-state">
      <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <h4>No vehicles found</h4><p>Try adjusting your search or filters.</p>
    </div>
  @endif

  <div class="pagination">
    <span class="page-info">Showing {{ $vehicles->firstItem() ?? 0 }}–{{ $vehicles->lastItem() ?? 0 }} of {{ $vehicles->total() }}</span>
    @for ($i = 1; $i <= $vehicles->lastPage(); $i++)
      <a href="{{ $vehicles->appends(request()->query())->url($i) }}" class="page-btn {{ $i === $vehicles->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
  </div>
</div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Vehicle</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Are you sure you want to delete <strong id="deleteVehicleName"></strong>? This action cannot be undone.</p></div>
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
renderShell('vehicles','Vehicle Inventory');

function openDelete(id, name) {
  document.getElementById('deleteVehicleName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/vehicles/' + id;
  document.getElementById('deleteModal').classList.add('open');
}

document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
