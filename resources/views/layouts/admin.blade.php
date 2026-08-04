<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>@yield('title', 'Admin — Hamza Enterprises')</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32.png') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/css/admin.css') }}"/>
@stack('styles')
<script src="{{ asset('admin-assets/js/admin-shell.js') }}"></script>
</head>
<body>
<div class="admin-layout">
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <img src="{{ asset('assets/img/logo-icon.png') }}" alt="Hamza Enterprises" class="brand-icon">
      <div><div class="brand-name">Hamza Enterprises</div><div class="brand-sub">Admin Panel</div></div>
    </div>
    <nav class="sidebar-nav"></nav>
    <div class="sidebar-footer">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="nav-item" style="color:#ef4444;cursor:pointer;background:none;border:none;width:100%;text-align:left">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></span>
          <span class="nav-label">Logout</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- Main -->
  <div class="main-area">
    <header class="topbar">
      <button class="topbar-toggle" title="Toggle sidebar">
        <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <span class="topbar-title"></span>
      <div class="topbar-actions">
        <div class="topbar-admin">
          <div class="admin-avatar">A</div>
          <span class="admin-name">Admin</span>
        </div>
      </div>
    </header>

    <div class="page-content">
@yield('content')
    </div><!-- /page-content -->
  </div><!-- /main-area -->
</div>

@stack('scripts')
</body>
</html>
