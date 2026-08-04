@extends('layouts.admin')

@section('title')
Settings — Hamza Enterprises Admin
@endsection

@section('content')
<div class="page-header"><div><h1>Site Settings</h1><p>Manage homepage content and company information.</p></div></div>

@if (session('status'))
  <div class="badge badge-green" style="display:inline-block;margin-bottom:14px;padding:8px 14px;font-size:13px">{{ session('status') }}</div>
@endif

<!-- Hero Settings -->
<form method="POST" action="{{ route('admin.settings.hero') }}">
  @csrf
  <div class="card" style="margin-bottom:16px">
    <div class="card-header"><h3>🏠 Homepage Hero Section</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2"><label>Badge Text (above headline)</label><input type="text" name="hero_badge" value="{{ old('hero_badge', $settings->hero_badge) }}" class="form-control"></div>
        <div class="form-group col-2"><label>Headline (HTML allowed for &lt;span&gt; accent)</label><input type="text" name="hero_headline" value="{{ old('hero_headline', $settings->hero_headline) }}" class="form-control"></div>
        <div class="form-group col-2"><label>Sub-Headline</label><textarea name="hero_subheadline" class="form-control" rows="2">{{ old('hero_subheadline', $settings->hero_subheadline) }}</textarea></div>
        <div class="form-group"><label>Stat — Vehicles Listed</label><input type="number" name="stat_vehicles" value="{{ old('stat_vehicles', $settings->stat_vehicles) }}" class="form-control"></div>
        <div class="form-group"><label>Stat — Verified Dealers</label><input type="number" name="stat_dealers" value="{{ old('stat_dealers', $settings->stat_dealers) }}" class="form-control"></div>
        <div class="form-group col-2"><label>Stat — Countries Served</label><input type="number" name="stat_countries" value="{{ old('stat_countries', $settings->stat_countries) }}" class="form-control"></div>
      </div>
      <div style="margin-top:16px"><button type="submit" class="btn btn-primary">Save Hero Settings</button></div>
    </div>
  </div>
</form>

<!-- Site Info -->
<form method="POST" action="{{ route('admin.settings.company') }}">
  @csrf
  <div class="card">
    <div class="card-header"><h3>🏢 Company Information</h3></div>
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group col-2"><label>Company Name</label><input type="text" name="company_name" value="{{ old('company_name', $settings->company_name) }}" class="form-control"></div>
        <div class="form-group"><label>Hamza Enterprises Phone</label><input type="text" name="hamza_phone" value="{{ old('hamza_phone', $settings->hamza_phone) }}" class="form-control" placeholder="+82 10 6499 5384"></div>
        <div class="form-group"><label>Fatima Trading Phone</label><input type="text" name="fatima_phone" value="{{ old('fatima_phone', $settings->fatima_phone) }}" class="form-control" placeholder="+82 10 8030 1614"></div>
        <div class="form-group col-2"><label>Email</label><input type="email" name="email" value="{{ old('email', $settings->email) }}" class="form-control"></div>
        <div class="form-group col-2"><label>Office Address</label><input type="text" name="address_korea" value="{{ old('address_korea', $settings->address_korea) }}" class="form-control"></div>
      </div>
      <div style="margin-top:16px"><button type="submit" class="btn btn-primary">Save Company Info</button></div>
    </div>
  </div>
</form>

<!-- Showrooms & Yards -->
<form method="POST" action="{{ route('admin.settings.showrooms') }}" style="margin-top:16px">
  @csrf
  <div class="card">
    <div class="card-header"><h3>📍 Showrooms &amp; Yards</h3></div>
    <div class="card-body">
      @foreach ([1, 2] as $i)
        <h4 style="margin:{{ $i === 1 ? '0' : '20px' }} 0 10px">Location {{ $i }}</h4>
        <div class="form-grid" style="margin-bottom:8px">
          <div class="form-group"><label>Tag (e.g. Head Office)</label><input type="text" name="showroom{{ $i }}_tag" value="{{ old("showroom{$i}_tag", $settings->{"showroom{$i}_tag"}) }}" class="form-control"></div>
          <div class="form-group"><label>Name</label><input type="text" name="showroom{{ $i }}_name" value="{{ old("showroom{$i}_name", $settings->{"showroom{$i}_name"}) }}" class="form-control"></div>
          <div class="form-group col-2"><label>Address</label><input type="text" name="showroom{{ $i }}_address" value="{{ old("showroom{$i}_address", $settings->{"showroom{$i}_address"}) }}" class="form-control"></div>
          <div class="form-group"><label>Phone</label><input type="text" name="showroom{{ $i }}_phone" value="{{ old("showroom{$i}_phone", $settings->{"showroom{$i}_phone"}) }}" class="form-control" placeholder="+82 10 6499 5384"></div>
          <div class="form-group"><label>WhatsApp Number</label><input type="text" name="showroom{{ $i }}_whatsapp" value="{{ old("showroom{$i}_whatsapp", $settings->{"showroom{$i}_whatsapp"}) }}" class="form-control" placeholder="+82 10 6499 5384"></div>
          <div class="form-group col-2"><label>Get Directions URL (Google Maps link)</label><input type="text" name="showroom{{ $i }}_maps_url" value="{{ old("showroom{$i}_maps_url", $settings->{"showroom{$i}_maps_url"}) }}" class="form-control" placeholder="https://maps.google.com/?q=..."></div>
        </div>
      @endforeach
      <div style="margin-top:8px"><button type="submit" class="btn btn-primary">Save Showrooms &amp; Yards</button></div>
    </div>
  </div>
</form>

<!-- Leadership & Payments -->
<form method="POST" action="{{ route('admin.settings.leadership') }}" style="margin-top:16px">
  @csrf
  <div class="card">
    <div class="card-header"><h3>🤝 Leadership &amp; Payments</h3></div>
    <div class="card-body">
      @foreach ([1, 2] as $i)
        <h4 style="margin:{{ $i === 1 ? '0' : '20px' }} 0 10px">Leader {{ $i }}</h4>
        <div class="form-grid" style="margin-bottom:8px">
          <div class="form-group"><label>Tag (e.g. CEO · Fatima Trading)</label><input type="text" name="leader{{ $i }}_tag" value="{{ old("leader{$i}_tag", $settings->{"leader{$i}_tag"}) }}" class="form-control"></div>
          <div class="form-group"><label>Name</label><input type="text" name="leader{{ $i }}_name" value="{{ old("leader{$i}_name", $settings->{"leader{$i}_name"}) }}" class="form-control"></div>
          <div class="form-group"><label>Role</label><input type="text" name="leader{{ $i }}_role" value="{{ old("leader{$i}_role", $settings->{"leader{$i}_role"}) }}" class="form-control"></div>
          <div class="form-group"><label>Phone</label><input type="text" name="leader{{ $i }}_phone" value="{{ old("leader{$i}_phone", $settings->{"leader{$i}_phone"}) }}" class="form-control"></div>
          <div class="form-group col-2"><label>WhatsApp Number</label><input type="text" name="leader{{ $i }}_whatsapp" value="{{ old("leader{$i}_whatsapp", $settings->{"leader{$i}_whatsapp"}) }}" class="form-control"></div>
        </div>
      @endforeach

      @foreach ([1, 2] as $i)
        <h4 style="margin:20px 0 10px">Bank Details {{ $i }}</h4>
        <div class="form-grid" style="margin-bottom:8px">
          <div class="form-group"><label>Tag (e.g. Fatima Trading)</label><input type="text" name="bank{{ $i }}_tag" value="{{ old("bank{$i}_tag", $settings->{"bank{$i}_tag"}) }}" class="form-control"></div>
          <div class="form-group"><label>Bank Name</label><input type="text" name="bank{{ $i }}_name" value="{{ old("bank{$i}_name", $settings->{"bank{$i}_name"}) }}" class="form-control" placeholder="Kwangju Bank (광주은행)"></div>
          @foreach ([1, 2, 3, 4] as $r)
            <div class="form-group"><label>Row {{ $r }} Label</label><input type="text" name="bank{{ $i }}_row{{ $r }}_label" value="{{ old("bank{$i}_row{$r}_label", $settings->{"bank{$i}_row{$r}_label"}) }}" class="form-control" placeholder="e.g. USD Account"></div>
            <div class="form-group"><label>Row {{ $r }} Value</label><input type="text" name="bank{{ $i }}_row{{ $r }}_value" value="{{ old("bank{$i}_row{$r}_value", $settings->{"bank{$i}_row{$r}_value"}) }}" class="form-control"></div>
          @endforeach
        </div>
      @endforeach
      <div style="margin-top:8px"><button type="submit" class="btn btn-primary">Save Leadership &amp; Payments</button></div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
<script>
renderShell('settings','Site Settings');
</script>
@endpush
