@extends('layouts.admin')

@section('title')
{{ $machine ? 'Edit Machinery' : 'Add Machinery' }} — Hamza Enterprises Admin
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
  <div><h1 id="formTitle">{{ $machine ? 'Edit Machinery' : 'Add New Machinery' }}</h1><p>Fill in all details to add a machine to the inventory.</p></div>
  <a href="{{ route('admin.machinery') }}" class="btn btn-secondary">← Back to Inventory</a>
</div>

<form method="POST" action="{{ $machine ? route('admin.machinery.update', $machine) : route('admin.machinery.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($machine) @method('PUT') @endif

  <!-- Basic Info -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Basic Information</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2"><label>Machinery Name *</label><input type="text" name="name" value="{{ old('name', $machine->name ?? '') }}" class="form-control" placeholder="e.g. 2021 Hyundai HX220AL Excavator" required>@error('name')<small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group col-2"><label>Description</label><textarea name="description" class="form-control" rows="4" placeholder="Overview, condition notes, standout features…">{{ old('description', $machine->description ?? '') }}</textarea>@error('description')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group"><label>Make / Brand *</label><input type="text" name="maker" value="{{ old('maker', $machine->maker ?? '') }}" class="form-control" placeholder="e.g. Hyundai" required></div>
        <div class="form-group"><label>Model *</label><input type="text" name="model" value="{{ old('model', $machine->model ?? '') }}" class="form-control" placeholder="e.g. HX220AL" required></div>
        <div class="form-group"><label>Year *</label><input type="number" name="year" value="{{ old('year', $machine->year ?? '') }}" class="form-control" min="1990" max="2030" placeholder="2021" required></div>
        <div class="form-group"><label>Price (USD) *</label><input type="number" name="price" value="{{ old('price', $machine->price ?? '') }}" class="form-control" placeholder="42500" required></div>
        <div class="form-group"><label>Operating Hours *</label><input type="number" name="hours" value="{{ old('hours', $machine->hours ?? '') }}" class="form-control" placeholder="3200" required></div>
        <div class="form-group">
          <label>Category *</label>
          <select name="category" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Construction Machinery','Heavy Equipment','Agricultural Machinery'] as $opt)
              <option @selected(old('category', $machine->category ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Fuel Type *</label>
          <select name="fuel" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Diesel','Gasoline','Electric','Hybrid'] as $opt)
              <option @selected(old('fuel', $machine->fuel ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Location *</label>
          <select name="location" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Incheon Head Yard','Incheon Yard II','Pyeongtaek Port Yard','Busan Export Yard','Dubai Showroom'] as $opt)
              <option @selected(old('location', $machine->location ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Technical Specs -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Technical Specifications</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group"><label>Item No</label><input type="text" name="item_no" value="{{ old('item_no', $machine->item_no ?? '') }}" class="form-control" placeholder="HE-M-2201"></div>
        <div class="form-group"><label>Serial No</label><input type="text" name="serial_no" value="{{ old('serial_no', $machine->serial_no ?? '') }}" class="form-control" placeholder="HHKHZ411KMA00291"></div>
        <div class="form-group"><label>Engine</label><input type="text" name="engine" value="{{ old('engine', $machine->engine ?? '') }}" class="form-control" placeholder="Cummins 6BT 3900cc"></div>
        <div class="form-group"><label>Capacity / Operating Weight</label><input type="text" name="capacity" value="{{ old('capacity', $machine->capacity ?? '') }}" class="form-control" placeholder="e.g. 22 Tons or 3.5 Ton Lift"></div>
        <div class="form-group">
          <label>Status *</label>
          <select name="status" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Available','Reserved','Sold'] as $opt)
              <option @selected(old('status', $machine->status ?? 'Available') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Image -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Machinery Photos</h3></div>
    <div class="card-body">
      @if ($machine && $machine->images)
        <div style="margin-bottom:16px">
          <label style="display:block;margin-bottom:8px">Current photos ({{ count($machine->images) }}) — will be replaced only if you upload new ones below</label>
          <div class="photo-preview-grid">
            @foreach ($machine->images as $img)
              <div class="photo-preview-card">
                <img src="{{ $img }}" alt="">
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <label style="display:block;margin-bottom:8px">{{ $machine ? 'Upload new photos (optional, up to 15)' : 'Machinery photos (up to 15)' }}</label>

      <div class="photo-dropzone" id="photoDropzone">
        <input type="file" name="images[]" id="imagesInput" accept="image/*" multiple @if(!$machine) required @endif>
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        <p><strong>Click to upload</strong> or drag &amp; drop</p>
        <span>PNG or JPG, up to 5MB each — max 15 photos</span>
      </div>

      <div class="photo-preview-grid" id="newPhotoPreviewGrid"></div>
      <small style="color:var(--text-soft);display:block;margin-top:8px">Drag a photo to reorder — the first one becomes the main listing image.</small>
      <small id="photoLimitWarning" style="color:var(--danger);display:none;margin-top:4px"></small>
      @error('images')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
      @error('images.*')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror
    </div>
  </div>

  <!-- Save -->
  <div style="display:flex;gap:10px;justify-content:flex-end">
    <a href="{{ route('admin.machinery') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save Machinery</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('machinery', {!! $machine ? "'Edit Machinery'" : "'Add Machinery'" !!});

(function () {
  const MAX_PHOTOS = 15;
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
