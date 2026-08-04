@extends('layouts.admin')

@section('title')
FAQ — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>FAQ Manager</h1><p>Manage frequently asked questions shown on the FAQ page.</p></div>
  <a href="{{ route('admin.faq.form') }}" class="btn btn-primary">+ Add FAQ</a>
</div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<form method="GET" action="{{ route('admin.faq') }}" class="filter-bar">
  <select name="category" class="filter-select" onchange="this.form.submit()">
    <option value="">All Categories</option>
    @foreach (\App\Models\Faq::CATEGORIES as $c)
      <option @selected(request('category') === $c)>{{ $c }}</option>
    @endforeach
  </select>
</form>

<div id="faqList">
  @forelse ($faqs as $f)
    <div class="faq-row">
      <div class="faq-row-header">
        <span class="badge badge-gray" style="margin-right:8px">{{ $f->category }}</span>
        <strong>{{ $f->question }}</strong>
        <div style="display:flex;gap:4px;margin-left:auto">
          <a href="{{ route('admin.faq.form', ['id' => $f->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
          <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $f->id }}, '{{ addslashes($f->question) }}')"><svg viewBox="0 0 24 24" width="14" height="14"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg></button>
        </div>
      </div>
      <div class="faq-row-body" style="display:block">{!! $f->answer !!}</div>
    </div>
  @empty
    <div class="empty-state"><h4>No FAQs yet</h4></div>
  @endforelse
</div>

<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete FAQ</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Delete <strong id="deleteFaqName"></strong>? This cannot be undone.</p></div>
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
renderShell('faq','FAQ Manager');
function openDelete(id, name) {
  document.getElementById('deleteFaqName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/faq/' + id;
  document.getElementById('deleteModal').classList.add('open');
}
document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
