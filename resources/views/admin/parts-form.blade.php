@extends('layouts.admin')

@section('title')
{{ $part ? 'Edit Part' : 'Add Part' }} — Hamza Enterprises Admin
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
    width: 90px;
    height: 90px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1px solid var(--border);
    background: #fff;
  }
  .photo-preview-card img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .photo-preview-card[draggable="true"] { cursor: grab; }
  .photo-preview-card.dragging { opacity: 0.4; }
  .photo-preview-card.drag-over { border-color: var(--primary); box-shadow: 0 0 0 2px var(--primary) inset; }
  .photo-primary-badge {
    position: absolute; top: 4px; left: 4px;
    background: var(--primary); color: #fff;
    font-size: 9px; font-weight: 700; text-transform: uppercase;
    padding: 2px 6px; border-radius: 4px; letter-spacing: 0.03em;
  }
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
  <div><h1>{{ $part ? 'Edit Part' : 'Add New Part' }}</h1><p>{{ $part ? 'Update spare part details.' : 'Add a spare part to the inventory.' }}</p></div>
  <a href="{{ route('admin.parts') }}" class="btn btn-secondary">← Back</a>
</div>

<form method="POST" action="{{ $part ? route('admin.parts.update', $part) : route('admin.parts.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($part) @method('PUT') @endif

  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Part Details</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2"><label>Part Name *</label><input type="text" name="name" value="{{ old('name', $part->name ?? '') }}" class="form-control" placeholder="Hyundai D4CB 2.5L Engine Assembly" required>@error('name')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group col-2"><label>Description</label><textarea name="description" class="form-control" rows="4" placeholder="Overview, condition notes, standout features…">{{ old('description', $part->description ?? '') }}</textarea>@error('description')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group"><label>Maker *</label><input type="text" name="maker" value="{{ old('maker', $part->maker ?? '') }}" class="form-control" placeholder="Hyundai" required></div>
        <div class="form-group"><label>Model</label><input type="text" name="model" value="{{ old('model', $part->model ?? '') }}" class="form-control" placeholder="Grand Starex"></div>
        <div class="form-group">
          <label>Category *</label>
          <select name="category" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Engine','Transmission','Lighting','Body Parts','Suspension'] as $opt)
              <option @selected(old('category', $part->category ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Year</label><input type="number" name="year" value="{{ old('year', $part->year ?? '') }}" class="form-control" placeholder="2021"></div>
        <div class="form-group"><label>Price (USD) *</label><input type="number" name="price" value="{{ old('price', $part->price ?? '') }}" class="form-control" placeholder="2450" required></div>
        <div class="form-group"><label>Stock Qty</label><input type="number" name="stock" value="{{ old('stock', $part->stock ?? '') }}" class="form-control" placeholder="2" min="0"></div>
        <div class="form-group">
          <label>Condition *</label>
          <select name="condition" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['New','Used','Rebuilt'] as $opt)
              <option @selected(old('condition', $part->condition ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Status *</label>
          <select name="status" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Available','Reserved','Sold'] as $opt)
              <option @selected(old('status', $part->status ?? 'Available') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Location</label>
          <select name="location" class="form-control">
            <option value="">Select…</option>
            @foreach (['Incheon Head Yard','Incheon Yard II','Pyeongtaek Port Yard','Dubai Showroom'] as $opt)
              <option @selected(old('location', $part->location ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Part No</label><input type="text" name="part_no" value="{{ old('part_no', $part->part_no ?? '') }}" class="form-control" placeholder="HE-P-8012"></div>
        <div class="form-group"><label>OEM No</label><input type="text" name="oem_no" value="{{ old('oem_no', $part->oem_no ?? '') }}" class="form-control" placeholder="21101-4A700"></div>
        <div class="form-group"><label>Engine Type</label><input type="text" name="engine_type" value="{{ old('engine_type', $part->engine_type ?? '') }}" class="form-control" placeholder="D4CB Euro 6"></div>
        <div class="form-group"><label>Weight</label><input type="text" name="weight" value="{{ old('weight', $part->weight ?? '') }}" class="form-control" placeholder="220 kg"></div>
        <div class="form-group"><label>Horsepower</label><input type="text" name="hp" value="{{ old('hp', $part->hp ?? '') }}" class="form-control" placeholder="133 HP or -"></div>
        <div class="form-group col-2"><label>Fits Models</label><input type="text" name="fits_models" value="{{ old('fits_models', $part->fits_models ?? '') }}" class="form-control" placeholder="Grand Starex, Porter II, Kia Bongo III"></div>
      </div>
    </div>
  </div>

  <!-- Photos -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Part Photos</h3></div>
    <div class="card-body">
      @if ($part && $part->images)
        <div style="margin-bottom:16px">
          <label style="display:block;margin-bottom:8px">Current photos ({{ count($part->images) }}) — will be replaced only if you upload new ones below</label>
          <div class="photo-preview-grid">
            @foreach ($part->images as $img)
              <div class="photo-preview-card">
                <img src="{{ $img }}" alt="">
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <label style="display:block;margin-bottom:8px">{{ $part ? 'Upload new photos (optional, up to 5)' : 'Part photos (optional, up to 5)' }}</label>

      <div class="photo-dropzone" id="photoDropzone">
        <input type="file" name="images[]" id="imagesInput" accept="image/*" multiple>
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        <p><strong>Click to upload</strong> or drag &amp; drop</p>
        <span>PNG or JPG, up to 4MB each — max 5 photos</span>
      </div>

      <div class="photo-preview-grid" id="newPhotoPreviewGrid"></div>
      <small style="color:var(--text-soft);display:block;margin-top:8px">Optional — if left blank, the part shows a generated category diagram instead. Drag a photo to reorder — the first one becomes the main listing image.</small>
      <small id="photoLimitWarning" style="color:var(--danger);display:none;margin-top:4px"></small>
      @error('images')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
      @error('images.*')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
    </div>
  </div>

  <div style="display:flex;gap:10px;justify-content:flex-end">
    <a href="{{ route('admin.parts') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save Part</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('parts', {!! $part ? "'Edit Part'" : "'Add Part'" !!});

(function () {
  const MAX_PHOTOS = 5;
  const dropzone = document.getElementById('photoDropzone');
  const input = document.getElementById('imagesInput');
  const grid = document.getElementById('newPhotoPreviewGrid');
  let files = [];
  let dragIndex = null;

  function syncInput() {
    const dt = new DataTransfer();
    files.forEach(f => dt.items.add(f));
    input.files = dt.files;
  }

  function addFiles(fileList) {
    const warning = document.getElementById('photoLimitWarning');
    let limitHit = false;
    for (const f of fileList) {
      if (files.length >= MAX_PHOTOS) {
        limitHit = true;
        break;
      }
      files.push(f);
    }
    if (limitHit) {
      warning.textContent = 'You can upload a maximum of ' + MAX_PHOTOS + ' photos.';
      warning.style.display = 'block';
    } else {
      warning.style.display = 'none';
    }
    syncInput();
    renderPreviews();
  }

  function renderPreviews() {
    grid.innerHTML = '';
    files.forEach((file, i) => {
      const card = document.createElement('div');
      card.className = 'photo-preview-card';
      card.draggable = true;
      card.dataset.index = String(i);
      card.innerHTML = `
        <img src="${URL.createObjectURL(file)}" alt="">
        ${i === 0 ? '<span class="photo-primary-badge">Main</span>' : ''}
        <button type="button" class="photo-remove-btn" aria-label="Remove">&times;</button>
      `;
      card.querySelector('.photo-remove-btn').addEventListener('click', (e) => {
        e.stopPropagation();
        files.splice(i, 1);
        syncInput();
        renderPreviews();
      });
      card.addEventListener('dragstart', () => {
        dragIndex = i;
        card.classList.add('dragging');
      });
      card.addEventListener('dragend', () => card.classList.remove('dragging'));
      card.addEventListener('dragover', (e) => {
        e.preventDefault();
        card.classList.add('drag-over');
      });
      card.addEventListener('dragleave', () => card.classList.remove('drag-over'));
      card.addEventListener('drop', (e) => {
        e.preventDefault();
        card.classList.remove('drag-over');
        if (dragIndex === null || dragIndex === i) return;
        const [moved] = files.splice(dragIndex, 1);
        files.splice(i, 0, moved);
        syncInput();
        renderPreviews();
      });
      grid.appendChild(card);
    });
  }

  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
  });
  dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    addFiles(e.dataTransfer.files);
  });
  input.addEventListener('change', () => addFiles(input.files));
})();
</script>
@endpush
