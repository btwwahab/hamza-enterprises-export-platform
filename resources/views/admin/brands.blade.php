@extends('layouts.admin')

@section('title')
Brands — Hamza Enterprises Admin
@endsection

@push('styles')
<style>
  .brand-logo-cell { display: flex; align-items: center; gap: 10px; }
  .brand-logo-preview {
    width: 40px; height: 40px; border-radius: 8px; border: 1px solid var(--border);
    background: #fff; display: flex; align-items: center; justify-content: center;
    overflow: hidden; flex-shrink: 0; font-weight: 700; color: var(--text-soft); font-size: 14px;
  }
  .brand-logo-preview img { width: 100%; height: 100%; object-fit: contain; }
  .brand-logo-upload {
    font-size: 11px; color: var(--text-soft); max-width: 120px;
  }
</style>
@endpush

@section('content')
<form method="POST" action="{{ route('admin.brands.sync') }}" enctype="multipart/form-data">
  @csrf
  <div class="page-header">
    <div><h1>Brands Editor</h1><p>Manage brand names, logos, and listing counts shown on the homepage brand grid.</p></div>
    <div style="display:flex;gap:8px">
      <button type="button" class="btn btn-secondary" onclick="addRow()">+ Add Brand</button>
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </div>

  @if (session('status'))
    <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
  @endif

  <div class="card">
    <div class="table-wrap" style="border:none;border-radius:0">
      <table>
        <thead><tr><th>#</th><th>Logo</th><th>Brand Name</th><th>Listing Count</th><th>Visible</th><th>Remove</th></tr></thead>
        <tbody id="brandsTable">
          @foreach ($brands as $i => $b)
            @php
              $logoSrc = $b->logo ? (str_starts_with($b->logo, '/') || str_starts_with($b->logo, 'http') ? $b->logo : asset('assets/img/brands/' . $b->logo . '.svg')) : null;
            @endphp
            <tr>
              <td style="color:var(--text-faint);font-size:12px">{{ $i + 1 }}</td>
              <td>
                <div class="brand-logo-cell">
                  <div class="brand-logo-preview" data-preview>
                    @if ($logoSrc)
                      <img src="{{ $logoSrc }}" alt="">
                    @else
                      {{ $b->name ? strtoupper(substr($b->name, 0, 1)) : '?' }}
                    @endif
                  </div>
                  <input type="hidden" name="brands[{{ $i }}][existing_logo]" value="{{ $b->logo }}">
                  <input type="file" name="brands[{{ $i }}][logo]" accept="image/*" class="brand-logo-upload" data-logo-input>
                </div>
              </td>
              <td>
                <input type="hidden" name="brands[{{ $i }}][id]" value="{{ $b->id }}">
                <input type="text" name="brands[{{ $i }}][name]" value="{{ $b->name }}" class="form-control" style="max-width:220px">
              </td>
              <td><input type="number" name="brands[{{ $i }}][count]" value="{{ $b->count }}" class="brand-count-input"></td>
              <td><label class="toggle"><input type="checkbox" name="brands[{{ $i }}][show]" value="1" @checked($b->show)><span class="toggle-slider"></span></label></td>
              <td><button type="button" class="btn-icon danger" onclick="this.closest('tr').remove()"><svg viewBox="0 0 24 24" width="14" height="14"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg></button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @error('brands.*.logo')<p style="color:var(--danger);font-size:12px;margin-top:8px">{{ $message }}</p>@enderror
  <p style="color:var(--text-soft);font-size:12px;margin-top:12px">Click "Save Changes" to persist edits. Uploading a logo replaces the existing one for that brand.</p>
</form>
@endsection

@push('scripts')
<script>
renderShell('brands','Brands Editor');

let rowIndex = {{ $brands->count() }};

function addRow() {
  const tbody = document.getElementById('brandsTable');
  const tr = document.createElement('tr');
  const i = rowIndex++;
  tr.innerHTML = `
    <td style="color:var(--text-faint);font-size:12px">${tbody.children.length + 1}</td>
    <td>
      <div class="brand-logo-cell">
        <div class="brand-logo-preview" data-preview>?</div>
        <input type="hidden" name="brands[${i}][existing_logo]" value="">
        <input type="file" name="brands[${i}][logo]" accept="image/*" class="brand-logo-upload" data-logo-input>
      </div>
    </td>
    <td>
      <input type="hidden" name="brands[${i}][id]" value="">
      <input type="text" name="brands[${i}][name]" value="New Brand" class="form-control" style="max-width:220px">
    </td>
    <td><input type="number" name="brands[${i}][count]" value="0" class="brand-count-input"></td>
    <td><label class="toggle"><input type="checkbox" name="brands[${i}][show]" value="1" checked><span class="toggle-slider"></span></label></td>
    <td><button type="button" class="btn-icon danger" onclick="this.closest('tr').remove()"><svg viewBox="0 0 24 24" width="14" height="14"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg></button></td>
  `;
  tbody.appendChild(tr);
}

document.getElementById('brandsTable').addEventListener('change', (e) => {
  if (!e.target.matches('[data-logo-input]')) return;
  const file = e.target.files[0];
  if (!file) return;
  const preview = e.target.closest('.brand-logo-cell').querySelector('[data-preview]');
  preview.innerHTML = `<img src="${URL.createObjectURL(file)}" alt="">`;
});
</script>
@endpush
