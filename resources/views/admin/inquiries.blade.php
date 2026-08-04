@extends('layouts.admin')

@section('title')
Inquiries — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header"><div><h1>Customer Inquiries</h1><p>Incoming messages from the contact form.</p></div></div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<div class="stats-bar">
  <div class="stats-bar-item"><span class="label">Total</span><span class="value">{{ $stats['total'] }}</span></div>
  <div class="stats-bar-item"><span class="label">New</span><span class="value" style="color:var(--danger)">{{ $stats['new'] }}</span></div>
  <div class="stats-bar-item"><span class="label">Read</span><span class="value" style="color:var(--info)">{{ $stats['read'] }}</span></div>
  <div class="stats-bar-item"><span class="label">Replied</span><span class="value" style="color:var(--success)">{{ $stats['replied'] }}</span></div>
</div>

<form method="GET" action="{{ route('admin.inquiries') }}" class="filter-bar">
  <div class="search-wrap">
    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Search by name or subject…">
  </div>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All Status</option>
    @foreach (['New','Read','Replied'] as $s)
      <option @selected(request('status') === $s)>{{ $s }}</option>
    @endforeach
  </select>
  <button type="submit" class="btn btn-secondary btn-sm">Search</button>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Sender</th><th>Subject</th><th>Vehicle Interest</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($inquiries as $i)
        @php
          $statusBadge = $i->status === 'New' ? 'badge-red' : ($i->status === 'Read' ? 'badge-blue' : 'badge-green');
        @endphp
        <tr>
          <td>
            <strong>{{ $i->name }}</strong><br>
            <small style="color:var(--text-soft)">{{ $i->email }}</small><br>
            <small style="color:var(--text-faint)">{{ $i->phone }}</small>
          </td>
          <td>
            <div style="font-size:13px;font-weight:600">{{ $i->subject }}</div>
            <div style="font-size:12px;color:var(--text-soft);margin-top:4px;max-width:280px;line-height:1.5">{{ $i->message }}</div>
          </td>
          <td style="font-size:12px;color:var(--text-soft)">{{ $i->vehicle_interest ?: '—' }}</td>
          <td style="font-size:12px;white-space:nowrap">{{ $i->created_at->format('d M, Y') }}</td>
          <td><span class="badge {{ $statusBadge }}">{{ $i->status }}</span></td>
          <td>
            <div style="display:flex;gap:4px;flex-direction:column;min-width:100px">
              @if ($i->status !== 'Read' && $i->status !== 'Replied')
                <form method="POST" action="{{ route('admin.inquiries.update-status', $i) }}">
                  @csrf @method('PATCH')
                  <input type="hidden" name="status" value="Read">
                  <button type="submit" class="btn btn-secondary btn-sm" style="width:100%">Mark Read</button>
                </form>
              @endif
              @if ($i->status !== 'Replied')
                <form method="POST" action="{{ route('admin.inquiries.update-status', $i) }}">
                  @csrf @method('PATCH')
                  <input type="hidden" name="status" value="Replied">
                  <button type="submit" class="btn btn-success btn-sm" style="width:100%">Mark Replied</button>
                </form>
              @endif
              <button class="btn btn-danger btn-sm" style="width:100%" type="button" onclick="openDelete({{ $i->id }}, '{{ addslashes($i->name) }}')">Delete</button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($inquiries->isEmpty())
    <div class="empty-state"><h4>No inquiries found</h4></div>
  @endif

  <div class="pagination">
    <span class="page-info">Showing {{ $inquiries->firstItem() ?? 0 }}–{{ $inquiries->lastItem() ?? 0 }} of {{ $inquiries->total() }}</span>
    @for ($i = 1; $i <= $inquiries->lastPage(); $i++)
      <a href="{{ $inquiries->appends(request()->query())->url($i) }}" class="page-btn {{ $i === $inquiries->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
  </div>
</div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Inquiry</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Are you sure you want to delete the inquiry from <strong id="deleteInquiryName"></strong>? This action cannot be undone.</p></div>
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
renderShell('inquiries','Customer Inquiries');

function openDelete(id, name) {
  document.getElementById('deleteInquiryName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/inquiries/' + id;
  document.getElementById('deleteModal').classList.add('open');
}

document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
