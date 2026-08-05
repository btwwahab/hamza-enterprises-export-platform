document.addEventListener("DOMContentLoaded", () => {
  // Mobile menu toggle
  const navToggle = document.getElementById("navToggle");
  const mainNav = document.getElementById("mainNav");
  if (navToggle && mainNav) {
    navToggle.addEventListener("click", () => {
      const expanded = navToggle.getAttribute("aria-expanded") === "true" || false;
      navToggle.setAttribute("aria-expanded", !expanded);
      mainNav.classList.toggle("open");
    });
  }

  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");
  const event = EVENTS_DATABASE.find(ev => ev.id === id);

  const container = document.getElementById("eventDetailContainer");
  const crumb = document.getElementById("crumbCurrent");

  if (!event) {
    if (container) {
      container.innerHTML = `<div style="padding:60px 20px;text-align:center;"><h3>Event not found</h3><p><a href="/events">&larr; Back to Events</a></p></div>`;
    }
    return;
  }

  document.title = event.title + " — Hamza Enterprises";
  if (crumb) crumb.textContent = event.title;

  const shareIcons = [
    event.linkFacebook ? `<a href="${event.linkFacebook}" target="_blank" rel="noopener" class="share-dot fb" style="width: 32px; height: 32px; font-size: 0.85rem; background: #1877f2; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none;">f</a>` : '',
    event.linkTwitter ? `<a href="${event.linkTwitter}" target="_blank" rel="noopener" class="share-dot tw" style="width: 32px; height: 32px; font-size: 0.85rem; background: #1da1f2; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none;">t</a>` : '',
    event.linkWhatsapp ? `<a href="${event.linkWhatsapp}" target="_blank" rel="noopener" class="share-dot wa" style="width: 32px; height: 32px; font-size: 0.85rem; background: #25d366; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none;">w</a>` : '',
  ].join('');
  const hasShareLinks = Boolean(event.linkFacebook || event.linkTwitter || event.linkWhatsapp);

  container.innerHTML = `
    <article class="event-feed-card" style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden;">
      <div class="event-card-media" style="width: 100%; height: 400px; overflow: hidden; position: relative;">
        <img src="${event.image}" alt="${event.title}" style="width: 100%; height: 100%; object-fit: cover;">
      </div>
      <div style="padding: 30px;">
        <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap; margin-bottom:16px;">
          <span style="background:#dc2626; color:#fff; font-size:0.75rem; font-weight:700; padding:5px 12px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px;">${event.category}</span>
          <span style="font-size:0.85rem; color:var(--ink-faint);">${event.date}</span>
          <span style="font-size:0.85rem; color:var(--ink-faint);">· By ${event.author}</span>
        </div>
        <h1 style="margin:0 0 20px; font-size:1.9rem; font-weight:800; line-height:1.25;">${event.title}</h1>
        <div style="font-size:1rem; line-height:1.8; color:var(--ink-light); white-space:pre-line; margin-bottom:28px;">${event.content}</div>

        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; border-top:1px solid var(--border); padding-top:20px;">
          <a href="/events" class="btn btn-outline" style="text-decoration:none;">&larr; Back to all updates</a>
          ${hasShareLinks ? `
          <div style="display:flex; align-items:center; gap:10px;">
            <span style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:var(--ink-faint);">Share:</span>
            ${shareIcons}
          </div>` : ''}
        </div>
      </div>
    </article>
  `;

  renderRecentEvents(event.id);
});

function renderRecentEvents(currentId) {
  const list = document.getElementById("recentEventsList");
  if (!list) return;

  const recent = EVENTS_DATABASE.filter(ev => ev.id !== currentId).slice(0, 3);
  list.innerHTML = "";
  recent.forEach(ev => {
    const itemHTML = `
      <a href="/event-detail?id=${ev.id}" class="mini-car-card">
        <img src="${ev.image}" alt="${ev.title}">
        <div>
          <h5 style="font-size: 0.82rem; margin-bottom: 2px;">${ev.title}</h5>
          <span style="font-size: 0.72rem; color:var(--ink-faint);">${ev.date} · ${ev.category}</span>
        </div>
      </a>
    `;
    list.innerHTML += itemHTML;
  });
}
