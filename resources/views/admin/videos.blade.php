@extends('layouts.admin')

@section('title')
Videos — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>Video Walkarounds</h1><p>Manage the "Hamza Enterprises TV" section on the homepage.</p></div>
  <a href="{{ route('admin.videos.form') }}" class="btn btn-primary">+ Add Video</a>
</div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<div class="table-wrap">
  <table>
    <thead><tr><th>Thumbnail</th><th>Title</th><th>Duration</th><th>Views</th><th>Published</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach ($videos as $v)
        <tr>
          <td><img src="{{ $v->thumbnail }}" alt="" class="table-img" onerror="this.style.display='none'"></td>
          <td><strong>{{ $v->title }}</strong>@if($v->video_url)<br><small style="color:var(--text-soft)">{{ $v->video_url }}</small>@endif</td>
          <td>{{ $v->duration }}</td>
          <td>{{ number_format($v->views) }}</td>
          <td style="font-size:12px">{{ $v->published_at->format('d M, Y') }}</td>
          <td>
            <div style="display:flex;gap:4px">
              <a href="{{ route('admin.videos.form', ['id' => $v->id]) }}" class="btn-icon" title="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
              <button class="btn-icon danger" title="Delete" onclick="openDelete({{ $v->id }}, '{{ addslashes($v->title) }}')"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg></button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($videos->isEmpty())
    <div class="empty-state">
      <h4>No videos yet</h4><p>Add a video walkaround to feature it on the homepage.</p>
    </div>
  @endif
</div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header"><h3>Delete Video</h3><button class="btn-icon" id="closeModal"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body"><p>Are you sure you want to delete <strong id="deleteVideoTitle"></strong>? This action cannot be undone.</p></div>
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
renderShell('videos','Video Walkarounds');

function openDelete(id, title) {
  document.getElementById('deleteVideoTitle').textContent = title;
  document.getElementById('deleteForm').action = '/admin/videos/' + id;
  document.getElementById('deleteModal').classList.add('open');
}

document.getElementById('closeModal').onclick  = () => document.getElementById('deleteModal').classList.remove('open');
document.getElementById('cancelDelete').onclick = () => document.getElementById('deleteModal').classList.remove('open');
</script>
@endpush
