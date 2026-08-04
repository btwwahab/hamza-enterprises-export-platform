@extends('layouts.admin')

@section('title')
Dashboard — Hamza Enterprises Admin
@endsection

@section('content')
<!-- KPIs -->
<div class="kpi-grid">
  <div class="kpi-card">
    <div class="kpi-icon orange"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
    <div class="kpi-data"><h2>{{ $vehicleStats['total'] }}</h2><span>Total Vehicles</span><small>✓ {{ $vehicleStats['available'] }} Available · {{ $vehicleStats['reserved'] }} Reserved · {{ $vehicleStats['sold'] }} Sold</small></div>
  </div>
  <div class="kpi-card">
    <div class="kpi-icon blue"><svg viewBox="0 0 24 24"><circle cx="7" cy="17" r="3"/><path d="M10 17h7"/><path d="M13 17V9l6-3"/><path d="M19 6l2 2-3 2"/><path d="M4 20h16"/></svg></div>
    <div class="kpi-data"><h2>{{ $machineryStats['total'] }}</h2><span>Total Machinery</span><small>✓ {{ $machineryStats['available'] }} Available</small></div>
  </div>
  <div class="kpi-card">
    <div class="kpi-icon green"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 1 4.93 19.07"/></svg></div>
    <div class="kpi-data"><h2>{{ $partsTotal }}</h2><span>Parts in Stock</span><small>Across {{ $partsCategories }} categories</small></div>
  </div>
  <div class="kpi-card">
    <div class="kpi-icon {{ $unreadInquiries > 0 ? 'red' : 'amber' }}"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
    <div class="kpi-data"><h2>{{ $unreadInquiries }}</h2><span>Unread Inquiries</span><small>{{ $totalInquiries }} total messages</small></div>
  </div>
</div>

<!-- Row: chart + recent inquiries -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
  <div class="card" style="height:400px;display:flex;flex-direction:column">
    <div class="card-header" style="flex-shrink:0"><h3>Inventory Stock by Make</h3></div>
    <div style="padding:16px 16px 0;flex:1;overflow-y:auto;display:flex;flex-direction:column">
      @php
        $maxVal = $stockByMake->max('total') ?: 1;
        $colors = ['#ff5a1f','#3b82f6','#22c55e','#f59e0b','#8b5cf6','#ec4899','#14b8a6','#f97316'];
      @endphp
      <div style="display:flex;align-items:flex-end;gap:8px;height:220px;padding-bottom:0;flex-shrink:0">
        @foreach ($stockByMake as $i => $row)
          @php $pct = round(($row->total / $maxVal) * 100); @endphp
          <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:4px;height:100%;justify-content:flex-end">
            <span style="font-size:11px;font-weight:700;color:#475569">{{ $row->total }}</span>
            <div style="width:100%;background:{{ $colors[$i % count($colors)] }};border-radius:5px 5px 0 0;height:{{ $pct }}%;min-height:4px;transition:height 0.4s ease"></div>
          </div>
        @endforeach
      </div>
      <div style="display:flex;gap:8px;border-top:1px solid #f1f5f9;padding-top:8px;margin-top:8px;flex-shrink:0">
        @foreach ($stockByMake as $i => $row)
          <div style="flex:1;text-align:center">
            <span style="display:inline-block;width:8px;height:8px;background:{{ $colors[$i % count($colors)] }};border-radius:2px;margin-right:2px;vertical-align:middle"></span>
            <span style="font-size:10px;color:#94a3b8">{{ strlen($row->maker) > 7 ? substr($row->maker,0,7).'…' : $row->maker }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="card" style="height:400px;display:flex;flex-direction:column">
    <div class="card-header" style="flex-shrink:0">
      <h3>Recent Inquiries</h3>
      <a href="{{ route('admin.inquiries') }}" class="btn btn-secondary btn-sm">View All</a>
    </div>
    <div style="flex:1;overflow-y:auto">
      <table>
        <thead><tr><th>Name</th><th>Subject</th><th>Status</th></tr></thead>
        <tbody>
          @foreach ($recentInquiries as $i)
            @php
              $statusBadge = $i->status === 'New' ? 'badge-red' : ($i->status === 'Read' ? 'badge-blue' : 'badge-green');
            @endphp
            <tr onclick="location.href='{{ route('admin.inquiries') }}'" style="cursor:pointer">
              <td><strong>{{ $i->name }}</strong><br><small style="color:var(--text-soft)">{{ $i->email }}</small></td>
              <td style="font-size:12px">{{ $i->subject }}</td>
              <td><span class="badge {{ $statusBadge }}">{{ $i->status }}</span></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Recent vehicles -->
<div class="card">
  <div class="card-header">
    <h3>Recent Vehicle Listings</h3>
    <a href="{{ route('admin.vehicles.form') }}" class="btn btn-primary btn-sm">+ Add Vehicle</a>
  </div>
  <div class="table-wrap" style="border:none;border-radius:0">
    <table>
      <thead><tr><th>Photo</th><th>Name</th><th>Year</th><th>Price</th><th>Mileage</th><th>Status</th></tr></thead>
      <tbody>
        @foreach ($recentVehicles as $v)
          <tr>
            <td><img src="{{ $v->image }}" alt="" class="table-img" onerror="this.style.display='none'"></td>
            <td><strong>{{ $v->name }}</strong><br><small style="color:var(--text-soft)">{{ $v->item_no }}</small></td>
            <td>{{ $v->year }}</td>
            <td><strong>${{ number_format($v->price) }}</strong></td>
            <td>{{ number_format($v->mileage) }} km</td>
            <td><span class="badge {{ $v->status === 'Available' ? 'badge-green' : ($v->status === 'Reserved' ? 'badge-amber' : 'badge-red') }}">{{ $v->status }}</span></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script>
renderShell('dashboard', 'Dashboard');
</script>
@endpush
