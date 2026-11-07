/* ShopVibe – pull-cord dark mode (no libraries needed) */
(function () {
  var KEY = 'shopvibe-theme';
  var root = document.documentElement;

  var NATIVE = root.getAttribute('data-native') || 'light';
  function getTheme() {
    var t = root.getAttribute('data-theme');
    return t === 'dark' || t === 'light' ? t : NATIVE;
  }
  function applyInvert(t) {
    var themed = false, cur = root.getAttribute('data-theme');
    try {
      root.removeAttribute('data-theme');
      themed = getComputedStyle(root).getPropertyValue('--page-bg').trim() !== '';
    } catch (e) {}
    root.setAttribute('data-theme', cur || t);
    root.classList.toggle('dm-themed', themed);
    root.classList.toggle('dm-invert', !themed && t !== NATIVE);
  }
  function setTheme(t) {
    root.setAttribute('data-theme', t);
    applyInvert(t);
    try { localStorage.setItem(KEY, t); } catch (e) {}
    if (cord) cord.setAttribute('aria-pressed', t === 'dark' ? 'true' : 'false');
  }

  var REST = 70, MAX_PULL = 90, TRIGGER = 35, W = 60, AX = W / 2;
  var NS = 'http://www.w3.org/2000/svg';

  var cord = document.createElement('div');
  cord.id = 'theme-cord';
  cord.setAttribute('role', 'button');
  cord.setAttribute('tabindex', '0');
  cord.setAttribute('aria-label', 'Toggle dark mode (pull the cord)');
  cord.setAttribute('aria-pressed', getTheme() === 'dark' ? 'true' : 'false');

  var svg = document.createElementNS(NS, 'svg');
  svg.setAttribute('width', W);
  svg.setAttribute('height', REST + MAX_PULL + 40);
  var path = document.createElementNS(NS, 'path');
  path.setAttribute('class', 'cord-line');
  var knob = document.createElementNS(NS, 'circle');
  knob.setAttribute('class', 'cord-knob');
  knob.setAttribute('r', 9);
  svg.appendChild(path);
  svg.appendChild(knob);
  cord.appendChild(svg);

  var tip = document.createElement('div');
  tip.className = 'cord-tip';
  cord.appendChild(tip);
  function tipText(pulledEnough) {
    if (pulledEnough) return 'Now release! ✨';
    return getTheme() === 'dark' ? 'Drag it down for light mode ☀️' : 'Drag it down for dark mode 🌙';
  }
  function showTip(pulledEnough) {
    tip.textContent = tipText(pulledEnough);
    tip.classList.add('show');
  }
  function hideTip() { tip.classList.remove('show'); }

  function draw(x, y) {
    var cx = AX + (x - AX) * 0.35;
    path.setAttribute('d', 'M' + AX + ',0 Q' + cx + ',' + (y * 0.55) + ' ' + x + ',' + y);
    knob.setAttribute('cx', x);
    knob.setAttribute('cy', y + 7);
    tip.style.top = (y - 8) + 'px';
  }
  draw(AX, REST);

  function toggleTheme() {
    var next = getTheme() === 'dark' ? 'light' : 'dark';
    var r = knob.getBoundingClientRect();
    var cx = r.left + r.width / 2, cy = r.top + r.height / 2;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (document.startViewTransition && !reduce) {
      root.style.setProperty('--vt-x', cx + 'px');
      root.style.setProperty('--vt-y', cy + 'px');
      root.style.setProperty('--vt-r',
        Math.hypot(Math.max(cx, innerWidth - cx), Math.max(cy, innerHeight - cy)) + 'px');
      document.startViewTransition(function () { setTheme(next); });
    } else {
      root.classList.add('theme-anim');
      setTheme(next);
      setTimeout(function () { root.classList.remove('theme-anim'); }, 500);
    }
  }

  var raf = null;
  function spring(fromX, fromY) {
    cancelAnimationFrame(raf);
    var x = fromX, y = fromY, vx = 0, vy = 0;
    (function step() {
      vx += (AX - x) * 0.18; vy += (REST - y) * 0.18;
      vx *= 0.82; vy *= 0.82;
      x += vx; y += vy;
      draw(x, y);
      if (Math.abs(x - AX) + Math.abs(y - REST) + Math.abs(vx) + Math.abs(vy) > 0.2) {
        raf = requestAnimationFrame(step);
      } else { draw(AX, REST); }
    })();
  }

  var dragging = false, moved = false, cur = { x: AX, y: REST };
  function pos(e) {
    var b = svg.getBoundingClientRect();
    var x = Math.max(AX - 40, Math.min(AX + 40, e.clientX - b.left));
    var y = Math.max(REST, Math.min(REST + MAX_PULL, e.clientY - b.top - 7));
    return { x: x, y: y };
  }
  cord.addEventListener('pointerdown', function (e) {
    dragging = true; moved = false;
    cancelAnimationFrame(raf);
    cord.setPointerCapture(e.pointerId);
    cord.classList.add('dragging');
    showTip(false);
    e.preventDefault();
  });
  cord.addEventListener('pointermove', function (e) {
    if (!dragging) return;
    cur = pos(e); moved = true; draw(cur.x, cur.y);
    showTip(cur.y - REST > TRIGGER);
  });
  function release() {
    if (!dragging) return;
    dragging = false;
    cord.classList.remove('dragging');
    hideTip();
    var pulled = cur.y - REST;
    if (pulled > TRIGGER || !moved) toggleTheme();
    spring(cur.x, cur.y);
    cur = { x: AX, y: REST };
  }
  cord.addEventListener('pointerenter', function () { if (!dragging) showTip(false); });
  cord.addEventListener('pointerleave', function () { if (!dragging) hideTip(); });
  cord.addEventListener('pointerup', release);
  cord.addEventListener('pointercancel', release);

  cord.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault(); toggleTheme(); spring(AX, REST + 40);
    }
  });

  applyInvert(getTheme());
  document.body.appendChild(cord);
})();