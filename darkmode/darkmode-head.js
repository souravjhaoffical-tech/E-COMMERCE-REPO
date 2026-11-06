
(function () {
  var r = document.documentElement;
  var native = r.getAttribute('data-native') || 'light';   /* index.php is natively dark */
  var t = null;
  try { t = localStorage.getItem('shopvibe-theme'); } catch (e) {}
  if (t !== 'dark' && t !== 'light') t = native;
  r.setAttribute('data-theme', t);
  var themed = false;
  try {
    r.removeAttribute('data-theme');
    themed = getComputedStyle(r).getPropertyValue('--page-bg').trim() !== '';
    r.setAttribute('data-theme', t);
  } catch (e) { r.setAttribute('data-theme', t); }
  if (themed) r.classList.add('dm-themed');
  if (!themed && t !== native) r.classList.add('dm-invert');
})();