// State variables
let currentCategory = "All";
let searchKeyword = "";

// DOM Elements
const eventsFeedContainer = document.getElementById("eventsFeedContainer");
const categoryTabs = document.getElementById("categoryTabs");
const eventSearchInput = document.getElementById("eventSearchInput");
const searchForm = document.getElementById("eventSearchForm");
const recentEventsList = document.getElementById("recentEventsList");

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

  // Setup tabs
  if (categoryTabs) {
    const tabButtons = categoryTabs.querySelectorAll(".tab-btn");
    tabButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        tabButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        currentCategory = btn.getAttribute("data-category");
        applyFilterAndRender();
      });
    });
  }

  // Setup search form
  if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      searchKeyword = eventSearchInput.value.trim().toLowerCase();
      applyFilterAndRender();
    });
  }

  // Real-time search keyup
  if (eventSearchInput) {
    eventSearchInput.addEventListener("input", () => {
      searchKeyword = eventSearchInput.value.trim().toLowerCase();
      applyFilterAndRender();
    });
  }

  // Render recent events in sidebar
  renderRecentEvents();

  // Initial render
  applyFilterAndRender();
});

// Filter & Render
function applyFilterAndRender() {
  if (!eventsFeedContainer) return;

  const filteredEvents = EVENTS_DATABASE.filter(ev => {
    // Category match
    const categoryMatch = (currentCategory === "All" || ev.category === currentCategory);
    // Search match
    const searchMatch = !searchKeyword || 
                        ev.title.toLowerCase().includes(searchKeyword) ||
                        ev.summary.toLowerCase().includes(searchKeyword) ||
                        ev.content.toLowerCase().includes(searchKeyword);
    return categoryMatch && searchMatch;
  });

  renderEventCards(filteredEvents);
}

// Render Main Feed
function renderEventCards(events) {
  eventsFeedContainer.innerHTML = "";

  if (events.length === 0) {
    eventsFeedContainer.innerHTML = `
      <div class="no-results-msg" style="padding: 60px 20px; text-align: center; border: 1px dashed var(--border); border-radius: var(--radius-md); background: var(--surface);">
        <svg width="48" height="48" style="color:var(--ink-faint); margin-bottom: 12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
        <h4>No events found</h4>
        <p>Try refining your search keyword or selecting a different category.</p>
        <button class="btn btn-outline" onclick="resetEventsSearch()" style="margin-top: 12px;">Show All Events</button>
      </div>
    `;
    return;
  }

  events.forEach(ev => {
    const detailUrl = `/event-detail?id=${encodeURIComponent(ev.id)}`;

    const shareIcons = [
      ev.linkFacebook ? `<a href="${ev.linkFacebook}" target="_blank" rel="noopener" class="share-dot fb" style="width: 28px; height: 28px; font-size: 0.8rem; background: #1877f2; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none;">f</a>` : '',
      ev.linkTwitter ? `<a href="${ev.linkTwitter}" target="_blank" rel="noopener" class="share-dot tw" style="width: 28px; height: 28px; font-size: 0.8rem; background: #1da1f2; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none;">t</a>` : '',
      ev.linkWhatsapp ? `<a href="${ev.linkWhatsapp}" target="_blank" rel="noopener" class="share-dot wa" style="width: 28px; height: 28px; font-size: 0.8rem; background: #25d366; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none;">w</a>` : '',
    ].join('');
    const hasShareLinks = Boolean(ev.linkFacebook || ev.linkTwitter || ev.linkWhatsapp);

    const cardHTML = `
      <article class="event-feed-card" style="margin-bottom: 30px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; display: flex; flex-direction: column;">
        <div class="event-card-media" style="width: 100%; height: 320px; overflow: hidden; position: relative;">
          <img src="${ev.image}" alt="${ev.title}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="event-card-container" style="display: flex; gap: 20px; padding: 25px;">
          <!-- Date and Share Column -->
          <div class="event-card-left-col" style="flex: 0 0 75px; text-align: center; display: flex; flex-direction: column; align-items: center;">
            <div class="event-date-badge" style="position: static; background: #dc2626; color: #fff; width: 100%; padding: 12px 5px; border-radius: 4px; display: flex; flex-direction: column; align-items: center; line-height: 1.1; font-weight: 700; margin-bottom: 12px; box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2);">
              <span class="day" style="font-size: 1.5rem; display: block; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 4px; margin-bottom: 4px; width: 80%; text-align: center;">${ev.dateDay}</span>
              <span class="month" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">${ev.dateMonth}</span>
              <span class="year" style="font-size: 0.7rem; opacity: 0.8; margin-top: 2px;">2026</span>
            </div>
            ${hasShareLinks ? `
            <div class="share-title" style="font-size: 0.65rem; color: var(--ink-faint); font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">SHARE THIS</div>
            <div class="social-share-dots" style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
              ${shareIcons}
            </div>` : ''}
          </div>
          <!-- Content Column -->
          <div class="event-card-right-col" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <h2 class="event-card-title" style="margin: 0 0 12px 0; font-size: 1.35rem; font-weight: 700; line-height: 1.3;"><a href="${detailUrl}" style="color: var(--ink); text-decoration: none; transition: color 0.2s ease;">${ev.title}</a></h2>
              <p class="event-card-text" style="color: var(--ink-light); font-size: 0.92rem; line-height: 1.55; margin: 0 0 20px 0;">${ev.summary}</p>
            </div>
            <div class="event-card-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: 15px; margin-top: auto; flex-wrap: wrap; gap: 10px;">
              <span class="meta-item" style="font-size: 0.82rem; color: var(--ink-faint); display: flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                ${ev.date} · ${ev.category}
              </span>
              <a href="${detailUrl}" class="read-more-link" style="color: var(--accent); font-weight: 700; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: color 0.2s ease;">Read more &gt;&gt;</a>
            </div>
          </div>
        </div>
      </article>
    `;
    eventsFeedContainer.innerHTML += cardHTML;
  });
}

// Render Recent Events in Sidebar
function renderRecentEvents() {
  if (!recentEventsList) return;
  recentEventsList.innerHTML = "";

  // Get last 3 events
  const recent = EVENTS_DATABASE.slice(0, 3);
  recent.forEach(ev => {
    const itemHTML = `
      <a href="/event-detail?id=${encodeURIComponent(ev.id)}" class="mini-car-card">
        <img src="${ev.image}" alt="${ev.title}">
        <div>
          <h5 style="font-size: 0.82rem; margin-bottom: 2px;">${ev.title}</h5>
          <span style="font-size: 0.72rem; color:var(--ink-faint);">${ev.date} · ${ev.category}</span>
        </div>
      </a>
    `;
    recentEventsList.innerHTML += itemHTML;
  });
}

// Reset Search
window.resetEventsSearch = function() {
  searchKeyword = "";
  currentCategory = "All";
  if (eventSearchInput) eventSearchInput.value = "";
  if (categoryTabs) {
    categoryTabs.querySelectorAll(".tab-btn").forEach(b => {
      b.classList.remove("active");
      if (b.getAttribute("data-category") === "All") b.classList.add("active");
    });
  }
  applyFilterAndRender();
};

// Increment share simulator
window.increaseShare = function(eventId) {
  const ev = EVENTS_DATABASE.find(e => e.id === eventId);
  if (ev) {
    ev.sharesCount++;
    const countSpan = document.getElementById(`share-count-${eventId}`);
    if (countSpan) countSpan.textContent = ev.sharesCount;
  }
};
