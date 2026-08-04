@extends('layouts.admin')

@section('title')
Newsletter Subscribers — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header"><div><h1>Newsletter Subscribers</h1><p>Emails collected from the site footer signup form.</p></div></div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<div class="stats-bar">
  <div class="stats-bar-item"><span class="label">Total Subscribers</span><span class="value">{{ $total }}</span></div>
</div>

<form method="GET" action="{{ route('admin.newsletter') }}" class="filter-bar">
  <div class="search-wrap">
    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Search by email…">
  </div>
  <button type="submit" class="btn btn-secondary btn-sm">Search</button>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Email</th><th>Subscribed On</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($subscribers as $s)
        <tr>
          <td>{{ $s->email }}</td>
          <td style="font-size:12px;white-space:nowrap">{{ $s->created_at->format('d M, Y') }}</td>
          <td>
            <button class="btn btn-danger btn-sm" type="button" onclick="openDelete({{ $s->id }}, '{{ addslashes($s->email) }}')">Remove</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($subscribers->isEmpty())
    <div class="empty-state"><h4>No subscribers yet</h4></div>
  @endif

  <div class="pagination">
    <span class="page-info">Showing {{ $subscribers->firstItem() ?? 0 }}–{{ $subscribers->lastItem() ?? 0 }} of {{ $subscribers->total() }}</span>
    @for ($i = 1; $i <= $subscribers->lastPage(); $i++)
      <a href="{{ $subscribers->appends(request()->query())->url($i) }}" class="page-btn {{ $i === $subscribers->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
  </div>
</div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Remove Subscriber</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Are you sure you want to remove <strong id="deleteSubscriberEmail"></strong>? This action cannot be undone.</p></div>
    <div class="modal-footer">
      <button class="btn btn-secondary" id="cancelDelete">Cancel</button>
      <form id="deleteForm" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Remove</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
renderShell('newsletter','Newsletter Subscribers');

function openDelete(id, email) {
  document.getElementById('deleteSubscriberEmail').textContent = email;
  document.getElementById('deleteForm').action = '/admin/newsletter/' + id;
  document.getElementById('deleteModal').classList.add('open');
}

document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
