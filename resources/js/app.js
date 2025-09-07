// ========== Cek apakah libraries tersedia ==========
if (typeof window.$ === 'undefined') {
    console.error('jQuery not loaded!');
}

// ========== Setup global yang masih diperlukan ==========
if (window.gsap && !window.TweenMax) {
  window.TweenMax = window.gsap;
}

// Expose libraries yang mungkin belum ter-expose
window.Swiper = window.Swiper || globalThis.Swiper;
window.imagesLoaded = window.imagesLoaded || globalThis.imagesLoaded;
window.Isotope = window.Isotope || globalThis.Isotope;

// ========== Main logic template ==========
import './main.js';

// ========== Health check logs ==========
console.log('[app.js] All libraries loaded via script tags');
console.log('[app.js] jQuery:', $.fn.jquery);
console.log('[app.js] Waypoint tersedia?', typeof $.fn.waypoint);