@extends('layouts.admin')

@section('title')
{{ $faq ? 'Edit FAQ' : 'Add FAQ' }} — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header">
  <div><h1>{{ $faq ? 'Edit FAQ' : 'Add FAQ' }}</h1></div>
  <a href="{{ route('admin.faq') }}" class="btn btn-secondary">← Back</a>
</div>

<form method="POST" action="{{ $faq ? route('admin.faq.update', $faq) : route('admin.faq.store') }}">
  @csrf
  @if ($faq) @method('PUT') @endif

  <div class="card" style="margin-bottom:16px">
    <div class="card-body">
      <div class="form-group" style="margin-bottom:14px">
        <label>Category</label>
        <select name="category" class="form-control">
          @foreach (\App\Models\Faq::CATEGORIES as $c)
            <option @selected(old('category', $faq->category ?? '') === $c)>{{ $c }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group" style="margin-bottom:14px">
        <label>Question *</label>
        <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" class="form-control" required>
        @error('question')<small style="color:var(--danger)">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Answer * <small style="color:var(--text-soft);font-weight:400">(HTML allowed, e.g. &lt;ol&gt;&lt;li&gt; for numbered lists, &lt;strong&gt; for bold)</small></label>
        <textarea name="answer" class="form-control" rows="6" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
        @error('answer')<small style="color:var(--danger)">{{ $message }}</small>@enderror
      </div>
    </div>
  </div>

  <div style="display:flex;gap:10px;justify-content:flex-end">
    <a href="{{ route('admin.faq') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save FAQ</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('faq', {!! $faq ? "'Edit FAQ'" : "'Add FAQ'" !!});
</script>
@endpush
