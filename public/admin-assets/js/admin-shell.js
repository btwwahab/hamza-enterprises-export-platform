/* admin-shell.js — Shared sidebar + topbar renderer */

function renderShell(activePage, pageTitle) {
  const nav = [
    { id:'dashboard',    label:'Dashboard',    href:'dashboard',    icon:'<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>' },
    { id:'vehicles',     label:'Vehicles',     href:'vehicles',     icon:'<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>' },
    { id:'machinery',    label:'Machinery',    href:'machinery',    icon:'<circle cx="7" cy="17" r="3"/><path d="M10 17h7"/><path d="M13 17V9l6-3"/><path d="M19 6l2 2-3 2"/><path d="M4 20h16"/>' },
    { id:'parts',        label:'Parts',        href:'parts',        icon:'<circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 1 4.93 19.07 10 10 0 0 1 19.07 4.93"/>' },
    { id:'events',       label:'Events & News',href:'events',       icon:'<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>' },
    { id:'inquiries',    label:'Inquiries',    href:'inquiries',    icon:'<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>' },
    { id:'brands',       label:'Brands',       href:'brands',       icon:'<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>' },
    { id:'faq',          label:'FAQ',          href:'faq',          icon:'<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>' },
    { id:'testimonials', label:'Testimonials', href:'testimonials', icon:'<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>' },
    { id:'videos',       label:'Videos',       href:'videos',       icon:'<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>' },
    { id:'newsletter',   label:'Newsletter',   href:'newsletter',   icon:'<path d="M22 6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2z"/><polyline points="22 6 12 13 2 6"/>' },
    { id:'settings',     label:'Settings',     href:'settings',     icon:'<circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>' },
  ];

  const navHtml = nav.map(item => `
    <a href="${item.href}" class="nav-item ${activePage === item.id ? 'active' : ''}" title="${item.label}">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">${item.icon}</svg>
      </span>
      <span class="nav-label">${item.label}</span>
    </a>
  `).join('');

  document.querySelector('.sidebar-nav').innerHTML = navHtml;
  document.querySelector('.topbar-title').textContent = pageTitle || 'Dashboard';

  // Sidebar toggle
  const sidebar = document.querySelector('.sidebar');
  const mainArea = document.querySelector('.main-area');
  document.querySelector('.topbar-toggle').addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainArea.classList.toggle('collapsed');
  });
}
