/* Runs in <head> BEFORE the page paints, so there is no white flash on reload */
(function () {
  try {
    var t = localStorage.getItem('shopvibe-theme');
    if (!t && window.matchMedia('(prefers-color-scheme: dark)').matches) t = 'dark';
    if (t === 'dark') document.documentElement.setAttribute('data-theme', 'dark');
  } catch (e) {}
})();