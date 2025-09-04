// ========== 1. jQuery ==========
import './vendor/jquery-3.7.1.min.js';
window.$ = window.jQuery = window.jQuery || window.$;

// ========== 2. Bootstrap ==========
import './vendor/bootstrap.min.js';

// ========== 3. jQuery UI (price slider) ==========
import './vendor/jquery-ui.min.js';

// ========== 4. Plugin jQuery (urut supaya dependency Waypoints yang dibundle di counterup muncul sebelum main.js) ==========
import './vendor/imagesloaded.pkgd.min.js';
import './vendor/isotope.pkgd.min.js';
import './vendor/jquery.magnific-popup.min.js';
import './vendor/jquery.counterup.min.js';   // <-- file ini sudah mengandung Waypoints (lihat header)
import './vendor/circle-progress.js';
import './vendor/tilt.jquery.min.js';

// ========== 5. Non-jQuery ==========
// import './vendor/swiper-bundle.min.js';
import './vendor/smooth-scroll.js';

// ========== 6. GSAP lokal + ScrollTrigger ==========
// import './vendor/gsap.min.js';
// import './vendor/ScrollTrigger.min.js';

// Alias TweenMax untuk kode lama (cursor, dsb)
if (window.gsap && !window.TweenMax) {
  window.TweenMax = window.gsap;
}
if (window.gsap && window.ScrollTrigger) {
  window.gsap.registerPlugin(window.ScrollTrigger);
}

// ========== 7. Ekspor beberapa global (opsional) ==========
window.Swiper        = window.Swiper        || globalThis.Swiper;
window.imagesLoaded  = window.imagesLoaded  || globalThis.imagesLoaded;
window.Isotope       = window.Isotope       || globalThis.Isotope;

// ========== 8. Main logic template (IIFE) ==========
import './main.js';

// ========== 9. Health check logs ==========
console.log('[app.js] Loaded. jQuery:', $.fn.jquery);
console.log('[app.js] GSAP:', window.gsap && window.gsap.version);
console.log('[app.js] Waypoint tersedia? ', typeof $.fn.waypoint);