/* nav-toggle.js — shared mobile hamburger menu toggle, loaded on every page. */
document.addEventListener('DOMContentLoaded', () => {
  const header = document.getElementById('siteHeader');
  const navToggle = document.getElementById('navToggle');
  const mainNav = document.getElementById('mainNav');
  if (!header || !navToggle || !mainNav) return;

  // Vehicles / Machinery accordion (mobile only — the CSS scopes the
  // expanded look to the mobile menu, so this toggle is harmless on desktop).
  const dropdowns = Array.from(mainNav.querySelectorAll('.nav-dropdown'));

  function collapseAllDropdowns() {
    dropdowns.forEach(d => {
      d.classList.remove('mobile-expanded');
      d.querySelector('.nav-dropdown-chevron')?.setAttribute('aria-expanded', 'false');
    });
  }

  dropdowns.forEach(dropdown => {
    const chevron = dropdown.querySelector('.nav-dropdown-chevron');
    if (!chevron) return;
    chevron.addEventListener('click', () => {
      const isExpanded = dropdown.classList.contains('mobile-expanded');
      collapseAllDropdowns();
      if (!isExpanded) {
        dropdown.classList.add('mobile-expanded');
        chevron.setAttribute('aria-expanded', 'true');
      }
    });
  });

  navToggle.addEventListener('click', () => {
    const open = header.classList.toggle('nav-open');
    navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (!open) collapseAllDropdowns();
  });

  // Any real navigation link closes the mobile menu (the accordion
  // chevrons are <button>s, not <a>s, so expanding a submenu won't).
  mainNav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      header.classList.remove('nav-open');
      navToggle.setAttribute('aria-expanded', 'false');
      collapseAllDropdowns();
    });
  });
});
