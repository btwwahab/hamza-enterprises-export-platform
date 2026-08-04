@extends('layouts.admin')

@section('title')
Testimonials — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>Testimonials</h1><p>Manage customer reviews shown on the homepage.</p></div>
  <a href="{{ route('admin.testimonials.form') }}" class="btn btn-primary">+ Add Review</a>
</div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<div class="testimonial-grid">
  @forelse ($testimonials as $t)
    <div class="testimonial-card">
      <div class="stars">{{ str_repeat('★', $t->rating) . str_repeat('☆', 5 - $t->rating) }}</div>
      <p>{{ $t->text }}</p>
      <div class="testimonial-author">
        <div class="t-avatar" style="background:{{ $t->avatar_color ?: '#ff5a1f' }}">{{ $t->avatar_initial ?: strtoupper(substr($t->author,0,1)) }}</div>
        <div><div class="t-name">{{ $t->author }}</div><div class="t-location">{{ $t->location }}</div></div>
        <div style="margin-left:auto;display:flex;gap:4px">
          <a href="{{ route('admin.testimonials.form', ['id' => $t->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
          <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $t->id }}, '{{ addslashes($t->author) }}')"><svg viewBox="0 0 24 24" width="14" height="14"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg></button>
        </div>
      </div>
    </div>
  @empty
    <div class="empty-state"><h4>No testimonials yet</h4></div>
  @endforelse
</div>

<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Testimonial</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Delete review from <strong id="deleteTName"></strong>?</p></div>
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
renderShell('testimonials','Testimonials');
function openDelete(id, name) {
  document.getElementById('deleteTName').textContent = name;
  document.getElementById('deleteForm').action = '/admin/testimonials/' + id;
  document.getElementById('deleteModal').classList.add('open');
}
document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
