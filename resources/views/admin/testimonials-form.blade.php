@extends('layouts.admin')

@section('title')
{{ $testimonial ? 'Edit Review' : 'Add Review' }} — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>{{ $testimonial ? 'Edit Review' : 'Add Review' }}</h1></div>
  <a href="{{ route('admin.testimonials') }}" class="btn btn-secondary">← Back</a>
</div>

<form method="POST" action="{{ $testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" style="max-width:520px">
  @csrf
  @if ($testimonial) @method('PUT') @endif

  <div class="card" style="margin-bottom:16px">
    <div class="card-body">
      <div class="form-group" style="margin-bottom:12px">
        <label>Author Name *</label>
        <input type="text" name="author" value="{{ old('author', $testimonial->author ?? '') }}" class="form-control" required>
        @error('author')<small style="color:var(--danger)">{{ $message }}</small>@enderror
      </div>
      <div class="form-group" style="margin-bottom:12px">
        <label>Location / Country *</label>
        <input type="text" name="location" value="{{ old('location', $testimonial->location ?? '') }}" class="form-control" placeholder="Dubai, UAE" required>
      </div>
      <div class="form-group" style="margin-bottom:12px">
        <label>Rating *</label>
        <div style="display:flex;gap:6px;align-items:center;margin-top:4px">
          <input type="range" name="rating" id="ratingInput" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" style="flex:1" oninput="document.getElementById('ratingDisplay').textContent=this.value">
          <span id="ratingDisplay" style="font-weight:700;color:var(--warning)">{{ old('rating', $testimonial->rating ?? 5) }}</span> ⭐
        </div>
      </div>
      <div class="form-group" style="margin-bottom:12px">
        <label>Avatar Initial (e.g. A)</label>
        <input type="text" name="avatar_initial" value="{{ old('avatar_initial', $testimonial->avatar_initial ?? '') }}" class="form-control" maxlength="2" placeholder="A">
      </div>
      <div class="form-group" style="margin-bottom:12px">
        @php $hasCustomColor = old('use_custom_color', $testimonial->avatar_color ?? null); @endphp
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:normal">
          <input type="checkbox" id="useCustomColor" name="use_custom_color" value="1" @checked($hasCustomColor) onchange="document.getElementById('avatarColorInput').disabled = !this.checked">
          Use a custom avatar color
        </label>
        <input type="color" name="avatar_color" id="avatarColorInput" value="{{ old('avatar_color', $testimonial->avatar_color ?? '#ff5a1f') }}" class="form-control" style="height:38px;cursor:pointer;margin-top:8px" @disabled(! $hasCustomColor)>
        <small style="color:var(--text-soft);display:block;margin-top:4px">Leave unchecked to use the site's default avatar color (soft peach).</small>
      </div>
      <div class="form-group">
        <label>Review Text *</label>
        <textarea name="text" class="form-control" rows="4" required placeholder="Great experience…">{{ old('text', $testimonial->text ?? '') }}</textarea>
        @error('text')<small style="color:var(--danger)">{{ $message }}</small>@enderror
      </div>
    </div>
  </div>

  <div style="display:flex;gap:10px;justify-content:flex-end">
    <a href="{{ route('admin.testimonials') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('testimonials', {!! $testimonial ? "'Edit Review'" : "'Add Review'" !!});
</script>
@endpush
