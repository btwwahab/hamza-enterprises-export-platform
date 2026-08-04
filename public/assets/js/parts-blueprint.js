// Dynamic SVG Blueprint Generator for Parts — used wherever a part has no
// real uploaded photo (both the listing cards and the part detail page).
function getPartBlueprint(category) {
  let innerSvg = "";
  if (category === "Engine") {
    innerSvg = `
      <!-- Engine Block Outline -->
      <rect x="25" y="30" width="50" height="40" rx="4" fill="none" stroke="#00f0ff" stroke-width="2.5" opacity="0.8"/>
      <rect x="35" y="20" width="30" height="10" rx="2" fill="none" stroke="#00f0ff" stroke-width="2" opacity="0.8"/>
      <!-- Cylinders -->
      <line x1="35" y1="38" x2="35" y2="62" stroke="#00f0ff" stroke-width="1.5" stroke-dasharray="2 2" opacity="0.6"/>
      <line x1="45" y1="38" x2="45" y2="62" stroke="#00f0ff" stroke-width="1.5" stroke-dasharray="2 2" opacity="0.6"/>
      <line x1="55" y1="38" x2="55" y2="62" stroke="#00f0ff" stroke-width="1.5" stroke-dasharray="2 2" opacity="0.6"/>
      <line x1="65" y1="38" x2="65" y2="62" stroke="#00f0ff" stroke-width="1.5" stroke-dasharray="2 2" opacity="0.6"/>
      <!-- Crankshaft/Pulleys -->
      <circle cx="50" cy="70" r="8" fill="none" stroke="#ff5a1f" stroke-width="2"/>
      <circle cx="50" cy="70" r="3" fill="#ff5a1f"/>
      <circle cx="20" cy="50" r="6" fill="none" stroke="#00f0ff" stroke-width="2"/>
      <line x1="20" y1="56" x2="50" y2="78" stroke="#ff5a1f" stroke-width="1.5"/>
      <!-- Turbo/Manifold -->
      <path d="M 75 35 Q 85 35 85 45 Q 85 55 75 55" fill="none" stroke="#00f0ff" stroke-width="2" opacity="0.8"/>
      <path d="M 75 42 L 80 42 M 75 48 L 80 48" stroke="#00f0ff" stroke-width="1.5"/>
    `;
  } else if (category === "Transmission") {
    innerSvg = `
      <!-- Gearbox casing -->
      <path d="M 20 40 L 35 25 L 70 25 L 80 45 L 80 60 L 60 75 L 35 75 L 20 60 Z" fill="none" stroke="#00f0ff" stroke-width="2.5" opacity="0.8"/>
      <!-- Gears -->
      <circle cx="42" cy="50" r="14" fill="none" stroke="#00f0ff" stroke-width="2" stroke-dasharray="4 2"/>
      <circle cx="42" cy="50" r="6" fill="none" stroke="#00f0ff" stroke-width="1.5"/>
      <circle cx="62" cy="50" r="10" fill="none" stroke="#ff5a1f" stroke-width="2" stroke-dasharray="3 2"/>
      <circle cx="62" cy="50" r="4" fill="none" stroke="#ff5a1f" stroke-width="1.5"/>
      <!-- Shaft -->
      <line x1="15" y1="50" x2="85" y2="50" stroke="#00f0ff" stroke-width="3" stroke-linecap="round" opacity="0.7"/>
      <rect x="15" y="44" width="8" height="12" fill="#00f0ff" rx="1" opacity="0.9"/>
    `;
  } else if (category === "Lighting") {
    innerSvg = `
      <!-- Sleek Headlight Assembly -->
      <path d="M 15 35 C 45 30, 80 45, 85 55 C 65 65, 35 65, 15 50 Z" fill="none" stroke="#00f0ff" stroke-width="2.5" opacity="0.8"/>
      <!-- Projector Lenses -->
      <circle cx="35" cy="48" r="7" fill="none" stroke="#ff5a1f" stroke-width="2"/>
      <circle cx="35" cy="48" r="3" fill="#ff5a1f"/>
      <circle cx="55" cy="50" r="5" fill="none" stroke="#00f0ff" stroke-width="1.8"/>
      <!-- LED DRL strip -->
      <path d="M 20 38 Q 45 35 78 48" fill="none" stroke="#00f0ff" stroke-width="3" stroke-linecap="round" opacity="0.9"/>
      <!-- Reflector lines -->
      <line x1="68" y1="52" x2="78" y2="54" stroke="#00f0ff" stroke-width="1" opacity="0.5"/>
      <line x1="66" y1="56" x2="74" y2="57" stroke="#00f0ff" stroke-width="1" opacity="0.5"/>
    `;
  } else {
    // Body Parts / Suspension / Generic
    innerSvg = `
      <!-- Caliper / Shock Absorber / Mechanical -->
      <rect x="42" y="20" width="16" height="45" rx="3" fill="none" stroke="#00f0ff" stroke-width="2.5" opacity="0.8"/>
      <!-- Coil Spring -->
      <path d="M 40 30 Q 60 33 40 36 Q 60 39 40 42 Q 60 45 40 48 Q 60 51 40 54 Q 60 57 40 60" fill="none" stroke="#ff5a1f" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
      <!-- Top Mount & Bottom Eyelet -->
      <rect x="35" y="14" width="30" height="6" rx="1" fill="#00f0ff" opacity="0.9"/>
      <circle cx="50" cy="72" r="6" fill="none" stroke="#00f0ff" stroke-width="2"/>
      <circle cx="50" cy="72" r="2.5" fill="#00f0ff"/>
      <line x1="50" y1="65" x2="50" y2="66" stroke="#00f0ff" stroke-width="3"/>
    `;
  }

  return `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 90" width="100%" height="100%" style="background:#0f141d; display:block;">
      <!-- Grid Background -->
      <defs>
        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
          <path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.5"/>
        </pattern>
      </defs>
      <rect width="100" height="90" fill="url(#grid)" />

      <!-- Tech specs overlay text -->
      <text x="5" y="12" fill="#636b7b" font-family="monospace" font-size="3.5" letter-spacing="0.2">SYS.REF: ${Math.random().toString(36).substring(2, 6).toUpperCase()}</text>
      <text x="5" y="85" fill="#636b7b" font-family="monospace" font-size="3">CAD/CAM OVERLAY 1.0b</text>

      ${innerSvg}
    </svg>
  `;
}
