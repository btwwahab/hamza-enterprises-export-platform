@extends('layouts.admin')

@section('title')
{{ $vehicle ? 'Edit Vehicle' : 'Add Vehicle' }} — Hamza Enterprises Admin
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
  <div><h1 id="formTitle">{{ $vehicle ? 'Edit Vehicle' : 'Add New Vehicle' }}</h1><p>Fill in all details to add a vehicle to the inventory.</p></div>
  <a href="{{ route('admin.vehicles') }}" class="btn btn-secondary">← Back to Inventory</a>
</div>

<form method="POST" action="{{ $vehicle ? route('admin.vehicles.update', $vehicle) : route('admin.vehicles.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($vehicle) @method('PUT') @endif

  <!-- Basic Info -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Basic Information</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2"><label>Vehicle Name *</label><input type="text" name="name" value="{{ old('name', $vehicle->name ?? '') }}" class="form-control" placeholder="e.g. 2022 Hyundai Sonata DOHC" required>@error('name')<small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group col-2"><label>Description</label><textarea name="description" class="form-control" rows="4" placeholder="Overview, condition notes, standout features…">{{ old('description', $vehicle->description ?? '') }}</textarea>@error('description')<br><small style="color:var(--danger)">{{ $message }}</small>@enderror</div>
        <div class="form-group"><label>Make / Brand *</label><input type="text" name="maker" value="{{ old('maker', $vehicle->maker ?? '') }}" class="form-control" placeholder="e.g. Hyundai" required></div>
        <div class="form-group"><label>Model *</label><input type="text" name="model" value="{{ old('model', $vehicle->model ?? '') }}" class="form-control" placeholder="e.g. Sonata" required></div>
        <div class="form-group"><label>Year *</label><input type="number" name="year" value="{{ old('year', $vehicle->year ?? '') }}" class="form-control" min="2000" max="2030" placeholder="2022" required></div>
        <div class="form-group"><label>Price (USD) *</label><input type="number" name="price" value="{{ old('price', $vehicle->price ?? '') }}" class="form-control" placeholder="12500" required></div>
        <div class="form-group"><label>Mileage (km) *</label><input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage ?? '') }}" class="form-control" placeholder="32000" required></div>
        <div class="form-group">
          <label>Fuel Type *</label>
          <select name="fuel" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Gasoline','Diesel','Hybrid','Electric','LPG'] as $opt)
              <option @selected(old('fuel', $vehicle->fuel ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Transmission *</label>
          <select name="transmission" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Automatic','Manual'] as $opt)
              <option @selected(old('transmission', $vehicle->transmission ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Body Type *</label>
          <select name="body" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Sedan','SUV','Van','Truck','Hatchback','Coupe'] as $opt)
              <option @selected(old('body', $vehicle->body ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Location *</label>
          <select name="location" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Incheon Head Yard','Incheon Yard II','Pyeongtaek Port Yard','Busan Export Yard','Dubai Showroom'] as $opt)
              <option @selected(old('location', $vehicle->location ?? '') === $opt)>{{ $opt }}</option>
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
        <div class="form-group"><label>Item No</label><input type="text" name="item_no" value="{{ old('item_no', $vehicle->item_no ?? '') }}" class="form-control" placeholder="HE-9082"></div>
        <div class="form-group"><label>VIN No</label><input type="text" name="vin_no" value="{{ old('vin_no', $vehicle->vin_no ?? '') }}" class="form-control" placeholder="KMHCT41D8MA291**"></div>
        <div class="form-group"><label>Engine CC</label><input type="text" name="engine" value="{{ old('engine', $vehicle->engine ?? '') }}" class="form-control" placeholder="1999 CC"></div>
        <div class="form-group">
          <label>Drive Type</label>
          <select name="drive" class="form-control">
            <option value="">Select…</option>
            @foreach (['FWD','RWD','AWD','4WD'] as $opt)
              <option @selected(old('drive', $vehicle->drive ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Seats</label><input type="text" name="seats" value="{{ old('seats', $vehicle->seats ?? '') }}" class="form-control" placeholder="5 Seats"></div>
        <div class="form-group">
          <label>Status *</label>
          <select name="status" class="form-control" required>
            <option value="">Select…</option>
            @foreach (['Available','Reserved','Sold'] as $opt)
              <option @selected(old('status', $vehicle->status ?? 'Available') === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
            <input type="checkbox" name="featured" value="1" @checked(old('featured', $vehicle->featured ?? false))>
            Feature on homepage ("Today's recommendation")
          </label>
        </div>
      </div>
    </div>
  </div>

  <!-- Image -->
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>Vehicle Photos</h3></div>
    <div class="card-body">
      @if ($vehicle && $vehicle->images)
        <div style="margin-bottom:16px">
          <label style="display:block;margin-bottom:8px">Current photos ({{ count($vehicle->images) }}) — will be replaced only if you upload new ones below</label>
          <div class="photo-preview-grid">
            @foreach ($vehicle->images as $img)
              <div class="photo-preview-card">
                <img src="{{ $img }}" alt="">
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <label style="display:block;margin-bottom:8px">{{ $vehicle ? 'Upload new photos (optional, up to 15)' : 'Vehicle photos (up to 15)' }}</label>

      <div class="photo-dropzone" id="photoDropzone">
        <input type="file" name="images[]" id="imagesInput" accept="image/*" multiple @if(!$vehicle) required @endif>
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
    <a href="{{ route('admin.vehicles') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save Vehicle</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('vehicles', {!! $vehicle ? "'Edit Vehicle'" : "'Add Vehicle'" !!});

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
