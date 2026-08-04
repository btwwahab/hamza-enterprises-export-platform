@extends('layouts.admin')

@section('title')
{{ $video ? 'Edit Video' : 'Add Video' }} — Hamza Enterprises Admin
@endsection

@push('styles')
<style>
  .photo-dropzone {
    position: relative;
    border: 2px dashed var(--border);
    border-radius: var(--radius);
    background: var(--main-bg);
    padding: 28px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.15s ease, background 0.15s ease;
  }
  .photo-dropzone:hover,
  .photo-dropzone.dragover {
    border-color: var(--primary);
    background: #fff5f0;
  }
  .photo-dropzone svg { color: var(--primary); margin-bottom: 8px; }
  .photo-dropzone p { margin: 0; font-size: 13px; color: var(--text); }
  .photo-dropzone span { display: block; margin-top: 4px; font-size: 12px; color: var(--text-soft); }
  .photo-dropzone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
  }
  .photo-preview-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 14px;
  }
  .photo-preview-card {
    position: relative;
    width: 120px;
    height: 80px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1px solid var(--border);
    background: #fff;
  }
  .photo-preview-card img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .photo-remove-btn {
    position: absolute; top: 3px; right: 3px;
    width: 18px; height: 18px; border-radius: 50%;
    background: rgba(15,23,42,0.65); color: #fff; border: none;
    font-size: 13px; line-height: 1; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
  }
  .photo-remove-btn:hover { background: var(--danger); }
</style>
@endpush

@section('content')
<div class="page-header">
  <div><h1>{{ $video ? 'Edit Video' : 'Add New Video' }}</h1><p>{{ $video ? 'Update this video walkaround.' : 'Add a video walkaround to the homepage.' }}</p></div>
  <a href="{{ route('admin.videos') }}" class="btn btn-secondary">← Back</a>
</div>

<form method="POST" action="{{ $video ? route('admin.videos.update', $video) : route('admin.videos.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($video) @method('PUT') @endif

  <!-- Video Details -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Video Details</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2">
          <label>Title *</label>
          <input type="text" name="title" value="{{ old('title', $video->title ?? '') }}" class="form-control" placeholder="2022 Hyundai Sonata Walkaround Review" required>
          @error('title')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
        </div>
        <div class="form-group col-2">
          <label>Video URL (YouTube or other link)</label>
          <input type="url" name="video_url" value="{{ old('video_url', $video->video_url ?? '') }}" class="form-control" placeholder="https://youtube.com/watch?v=...">
          @error('video_url')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
        </div>
        <div class="form-group">
          <label>Duration</label>
          <input type="text" name="duration" value="{{ old('duration', $video->duration ?? '') }}" class="form-control" placeholder="5:42">
        </div>
        <div class="form-group">
          <label>Views</label>
          <input type="number" name="views" value="{{ old('views', $video->views ?? 0) }}" class="form-control" min="0">
        </div>
        <div class="form-group col-2">
          <label>Published Date *</label>
          <input type="date" name="published_at" value="{{ old('published_at', isset($video) ? $video->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}" class="form-control" required>
          @error('published_at')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
        </div>
      </div>
    </div>
  </div>

  <!-- Thumbnail -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Thumbnail</h3></div>
    <div class="card-body">
      @if (!empty($video?->thumbnail))
        <div style="margin-bottom:16px">
          <label style="display:block;margin-bottom:8px">Current thumbnail — will be replaced only if you upload a new one below</label>
          <div class="photo-preview-grid">
            <div class="photo-preview-card"><img src="{{ $video->thumbnail }}" alt=""></div>
          </div>
        </div>
      @endif

      <label style="display:block;margin-bottom:8px">{{ $video && $video->thumbnail ? 'Upload new thumbnail (optional)' : 'Thumbnail image' }}</label>
      <div class="photo-dropzone" id="photoDropzone">
        <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*" @if(!$video) required @endif>
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        <p><strong>Click to upload</strong> or drag &amp; drop</p>
        <span>PNG or JPG, up to 5MB</span>
      </div>
      <div class="photo-preview-grid" id="newPhotoPreviewGrid"></div>
      @error('thumbnail')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
    </div>
  </div>

  <div style="display:flex;gap:10px;justify-content:flex-end">
    <a href="{{ route('admin.videos') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save Video</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('videos', {!! $video ? "'Edit Video'" : "'Add Video'" !!});

(function () {
  const dropzone = document.getElementById('photoDropzone');
  const input = document.getElementById('thumbnailInput');
  const grid = document.getElementById('newPhotoPreviewGrid');
  let file = null;

  function syncInput() {
    const dt = new DataTransfer();
    if (file) dt.items.add(file);
    input.files = dt.files;
  }

  function setFile(newFile) {
    if (!newFile) return;
    file = newFile;
    syncInput();
    renderPreview();
  }

  function renderPreview() {
    grid.innerHTML = '';
    if (!file) return;
    const card = document.createElement('div');
    card.className = 'photo-preview-card';
    card.innerHTML = `
      <img src="${URL.createObjectURL(file)}" alt="">
      <button type="button" class="photo-remove-btn" aria-label="Remove">&times;</button>
    `;
    card.querySelector('.photo-remove-btn').addEventListener('click', (e) => {
      e.stopPropagation();
      file = null;
      syncInput();
      renderPreview();
    });
    grid.appendChild(card);
  }

  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
  });
  dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    setFile(e.dataTransfer.files[0]);
  });
  input.addEventListener('change', () => setFile(input.files[0]));
})();
</script>
@endpush
