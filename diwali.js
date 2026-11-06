/* ShopVibe – Diwali hero (animated diya, rangoli, orbiting products, fireworks, lights)
   Add ONE line before </body> in index.php:  <script src="diwali.js"></script>
   Change any text in the CONFIG block below. */
(function () {
  var hero = document.querySelector('.hero');
  if (!hero) return;

  /* ============ CONFIG (edit freely) ============ */
  var CONFIG = {
    badge: '🪔 Happy Diwali from ShopVibe — festive deals are live',
    orbit: ['🛍️', '🎁', '📱', '👗'],
    tagTop: '🪔 Festive Deals',
    tagBottom: '🎁 Gift Hampers',
    fireworks: true
  };

  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ============ CSS ============ */
  var css = '' +
  '.hero>.hero-text,.hero>.diwali-scene{position:relative;z-index:1}' +
  '.dw-badge{display:inline-flex;align-items:center;gap:8px;margin-bottom:18px;padding:8px 16px;border-radius:999px;' +
    'font:600 14px/1.2 Arial,sans-serif;color:#ffe2a8;background:linear-gradient(90deg,rgba(255,138,31,.22),rgba(255,61,127,.18));' +
    'border:1px solid rgba(255,194,51,.45);box-shadow:0 0 22px rgba(255,138,31,.25);animation:dwGlow 2.6s ease-in-out infinite}' +
  '@keyframes dwGlow{50%{box-shadow:0 0 34px rgba(255,138,31,.55)}}' +

  '.diwali-scene{width:440px;height:440px;flex:none;overflow:hidden;animation:dwIn 1.2s ease both}' +
  '@keyframes dwIn{from{opacity:0;transform:translateX(90px) scale(.9)}to{opacity:1;transform:none}}' +
  '.dw-halo{position:absolute;inset:8%;border-radius:50%;background:radial-gradient(circle,rgba(255,150,30,.42),rgba(255,61,127,.14) 55%,transparent 72%);' +
    'filter:blur(6px);animation:dwPulse 3.4s ease-in-out infinite}' +
  '@keyframes dwPulse{50%{transform:scale(1.1);opacity:.8}}' +
  '.dw-rangoli{position:absolute;inset:0;width:100%;height:100%}' +
  '.dw-r1{transform-origin:0 0;animation:dwSpin 60s linear infinite}' +
  '.dw-r2{transform-origin:0 0;animation:dwSpin 42s linear infinite reverse}' +
  '@keyframes dwSpin{to{transform:rotate(360deg)}}' +
  '.dw-diya{position:absolute;left:50%;top:50%;width:52%;transform:translate(-50%,-46%);animation:dwBob 4s ease-in-out infinite;overflow:visible}' +
  '@keyframes dwBob{50%{transform:translate(-50%,-52%)}}' +
  '.dw-flame{transform-origin:100px 106px;animation:dwFlame 1.1s ease-in-out infinite alternate}' +
  '.dw-flame2{transform-origin:100px 106px;animation:dwFlame 0.8s ease-in-out infinite alternate-reverse}' +
  '@keyframes dwFlame{0%{transform:scale(1,1) skewX(-2deg)}50%{transform:scale(.94,1.07) skewX(2deg)}100%{transform:scale(1.05,.95) skewX(-1deg)}}' +
  '.dw-orbit{position:absolute;inset:0;animation:dwSpin 26s linear infinite}' +
  '.dw-chip{position:absolute;left:50%;top:50%;width:0;height:0;transform:rotate(var(--a)) translateY(-185px)}' +
  '.dw-chip i{position:absolute;left:-27px;top:-27px;width:54px;height:54px;display:flex;align-items:center;justify-content:center;font-style:normal;font-size:26px;' +
    'border-radius:50%;background:rgba(255,255,255,.1);border:1px solid rgba(255,194,51,.5);box-shadow:0 8px 24px rgba(0,0,0,.4),0 0 18px rgba(255,138,31,.35);' +
    'backdrop-filter:blur(6px);animation:dwUp 26s linear infinite}' +
  '@keyframes dwUp{from{transform:rotate(calc(var(--a) * -1))}to{transform:rotate(calc(var(--a) * -1 - 360deg))}}' +
  '.dw-tag{position:absolute;padding:9px 15px;border-radius:14px;font:700 13px/1 Arial,sans-serif;color:#fff;white-space:nowrap;' +
    'background:rgba(20,24,48,.72);border:1px solid rgba(255,194,51,.45);box-shadow:0 10px 26px rgba(0,0,0,.45);backdrop-filter:blur(8px);animation:dwFloat 4.4s ease-in-out infinite}' +
  '.dw-tag.t1{left:0;top:12%}.dw-tag.t2{right:0;bottom:14%;animation-delay:-2.2s}' +
  '@keyframes dwFloat{50%{transform:translateY(-12px)}}' +
  '.dw-spark{position:absolute;width:12px;height:12px;background:#ffd36b;clip-path:polygon(50% 0,62% 38%,100% 50%,62% 62%,50% 100%,38% 62%,0 50%,38% 38%);' +
    'filter:drop-shadow(0 0 6px #ffb703);animation:dwTw 2.4s ease-in-out infinite}' +
  '@keyframes dwTw{0%,100%{opacity:.15;transform:scale(.4) rotate(0)}50%{opacity:1;transform:scale(1) rotate(90deg)}}' +

  '.dw-fx{position:absolute;inset:0;width:100%;height:100%;z-index:0;pointer-events:none}' +

  '.dw-lights{position:absolute;left:0;right:0;top:0;height:46px;z-index:2;pointer-events:none;' +
    'border-top:2px solid rgba(255,194,51,.35)}' +
  '.dw-bulb{position:absolute;top:0;width:2px;height:12px;background:rgba(255,194,51,.5)}' +
  '.dw-bulb:after{content:"";position:absolute;left:-5px;top:11px;width:12px;height:16px;border-radius:50% 50% 50% 50%/40% 40% 60% 60%;' +
    'background:var(--c);box-shadow:0 0 14px 3px var(--c);animation:dwBulb 1.8s ease-in-out infinite;animation-delay:var(--d)}' +
  '@keyframes dwBulb{0%,100%{opacity:.35}50%{opacity:1}}' +

  'html.dm-invert .dw-fx{display:none}' +
  'html.dm-invert .diwali-scene,html.dm-invert .dw-lights{filter:invert(1) hue-rotate(180deg)}' +

  '@media (max-width:900px){.diwali-scene{width:min(340px,86vw);height:min(340px,86vw)}' +
    '.dw-chip{transform:rotate(var(--a)) translateY(-142px)}.dw-chip i{width:44px;height:44px;left:-22px;top:-22px;font-size:21px}' +
    '.dw-tag{font-size:11px;padding:7px 11px}.dw-badge{font-size:12px}}' +
  '@media (prefers-reduced-motion:reduce){.diwali-scene *,.dw-badge,.dw-bulb:after{animation:none!important}}';

  var st = document.createElement('style');
  st.textContent = css;
  document.head.appendChild(st);

  /* ============ Badge above the heading ============ */
  var text = hero.querySelector('.hero-text');
  if (text && CONFIG.badge) {
    var b = document.createElement('div');
    b.className = 'dw-badge';
    b.textContent = CONFIG.badge;
    text.insertBefore(b, text.firstChild);
  }

  /* ============ Scene on the right side ============ */
  var scene = document.createElement('div');
  scene.className = 'diwali-scene';

  var petals = '', i;
  for (i = 0; i < 12; i++) {
    petals += '<ellipse cx="0" cy="-172" rx="15" ry="36" transform="rotate(' + (i * 30) + ')" fill="rgba(255,138,31,.10)" stroke="#ffb703" stroke-width="1.4"/>';
  }
  var petals2 = '';
  for (i = 0; i < 8; i++) {
    petals2 += '<path d="M0,-120 C22,-146 22,-170 0,-190 C-22,-170 -22,-146 0,-120Z" transform="rotate(' + (i * 45 + 22.5) + ')" fill="rgba(255,61,127,.14)" stroke="#ff5c93" stroke-width="1.2"/>';
  }
  var dots = '';
  for (i = 0; i < 36; i++) {
    var a = i * 10 * Math.PI / 180;
    dots += '<circle cx="' + (Math.cos(a) * 208).toFixed(1) + '" cy="' + (Math.sin(a) * 208).toFixed(1) + '" r="' + (i % 3 === 0 ? 3.2 : 1.8) + '" fill="#ffd36b"/>';
  }

  var orbit = '';
  CONFIG.orbit.forEach(function (e, n) {
    orbit += '<div class="dw-chip" style="--a:' + (n * 360 / CONFIG.orbit.length) + 'deg"><i>' + e + '</i></div>';
  });

  var diya =
    '<svg class="dw-diya" viewBox="0 0 200 200" aria-hidden="true">' +
    '<defs>' +
    '<radialGradient id="dwG" cx="50%" cy="55%" r="50%"><stop offset="0" stop-color="#ffb347" stop-opacity=".75"/><stop offset="1" stop-color="#ff5c93" stop-opacity="0"/></radialGradient>' +
    '<linearGradient id="dwBowl" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f08a3c"/><stop offset="1" stop-color="#8a2d0b"/></linearGradient>' +
    '<linearGradient id="dwFl" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="#ff7a00"/><stop offset=".55" stop-color="#ffc233"/><stop offset="1" stop-color="#fff3b0"/></linearGradient>' +
    '</defs>' +
    '<circle cx="100" cy="82" r="84" fill="url(#dwG)"/>' +
    '<path d="M26 118 C38 182 162 182 174 118 Z" fill="url(#dwBowl)"/>' +
    '<ellipse cx="100" cy="118" rx="76" ry="17" fill="#f4a261"/>' +
    '<ellipse cx="100" cy="119" rx="60" ry="10" fill="#ffd27a"/>' +
    '<rect x="97.5" y="98" width="5" height="22" rx="2" fill="#3b2412"/>' +
    '<g class="dw-flame"><path d="M100 36 C121 60 128 86 100 108 C72 86 79 60 100 36Z" fill="url(#dwFl)"/></g>' +
    '<g class="dw-flame2"><path d="M100 64 C110 76 113 90 100 104 C87 90 90 76 100 64Z" fill="#fffbe0" opacity=".92"/></g>' +
    '<circle cx="62" cy="140" r="3.5" fill="#ffd36b"/><circle cx="100" cy="150" r="3.5" fill="#ffd36b"/><circle cx="138" cy="140" r="3.5" fill="#ffd36b"/>' +
    '<circle cx="80" cy="147" r="2.5" fill="#ffd36b"/><circle cx="120" cy="147" r="2.5" fill="#ffd36b"/>' +
    '</svg>';

  scene.innerHTML =
    '<div class="dw-halo"></div>' +
    '<svg class="dw-rangoli" viewBox="-220 -220 440 440" aria-hidden="true">' +
      '<g class="dw-r1">' + petals + dots + '</g>' +
      '<g class="dw-r2">' + petals2 + '<circle r="118" fill="none" stroke="#ffb703" stroke-width="1" stroke-dasharray="3 9" opacity=".7"/></g>' +
    '</svg>' +
    diya +
    '<div class="dw-orbit">' + orbit + '</div>' +
    '<div class="dw-tag t1">' + CONFIG.tagTop + '</div>' +
    '<div class="dw-tag t2">' + CONFIG.tagBottom + '</div>';

  for (i = 0; i < 14; i++) {
    var s = document.createElement('b');
    s.className = 'dw-spark';
    var ang = Math.random() * Math.PI * 2, rad = 36 + Math.random() * 14;
    s.style.left = (50 + Math.cos(ang) * rad) + '%';
    s.style.top = (50 + Math.sin(ang) * rad) + '%';
    s.style.animationDelay = (-Math.random() * 2.4).toFixed(2) + 's';
    s.style.transform = 'scale(' + (0.5 + Math.random() * 0.9).toFixed(2) + ')';
    scene.appendChild(s);
  }
  hero.appendChild(scene);

  /* ============ String lights along the top ============ */
  var lights = document.createElement('div');
  lights.className = 'dw-lights';
  var colors = ['#ffb703', '#ff3d7f', '#22d3ee', '#ff8a1f', '#a78bfa'];
  function buildLights() {
    lights.innerHTML = '';
    var w = hero.clientWidth, n = Math.max(6, Math.round(w / 64));
    for (var k = 0; k < n; k++) {
      var bu = document.createElement('span');
      bu.className = 'dw-bulb';
      var x = (k + 0.5) / n * w;
      bu.style.left = x + 'px';
      bu.style.top = (Math.sin(k / n * Math.PI * 6) * 5 + 5).toFixed(1) + 'px';
      bu.style.setProperty('--c', colors[k % colors.length]);
      bu.style.setProperty('--d', (-(k % 5) * 0.37).toFixed(2) + 's');
      lights.appendChild(bu);
    }
  }
  hero.appendChild(lights);
  buildLights();

  /* ============ Fireworks (inside the hero only) ============ */
  if (!CONFIG.fireworks || reduce) return;

  var cv = document.createElement('canvas');
  cv.className = 'dw-fx';
  hero.insertBefore(cv, hero.firstChild);
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, parts = [], rockets = [], visible = true, raf = 0, timer = 0;
  var hues = [38, 28, 340, 190, 48, 15, 280];

  function size() {
    var r = hero.getBoundingClientRect(), d = Math.min(window.devicePixelRatio || 1, 2);
    W = r.width; H = r.height;
    cv.width = W * d; cv.height = H * d;
    ctx.setTransform(d, 0, 0, d, 0, 0);
    buildLights();
  }
  size();
  window.addEventListener('resize', size);

  function burst(x, y) {
    var h = hues[Math.floor(Math.random() * hues.length)], n = 56;
    for (var k = 0; k < n; k++) {
      var a = Math.PI * 2 * k / n, sp = 1.4 + Math.random() * 3.1;
      parts.push({ x: x, y: y, vx: Math.cos(a) * sp, vy: Math.sin(a) * sp, l: 1, d: 0.011 + Math.random() * 0.012, h: h + Math.random() * 24 - 12 });
    }
    if (parts.length > 700) parts.splice(0, parts.length - 700);
  }
  function launch() {
    var x = W * (0.45 + Math.random() * 0.5);
    rockets.push({ x: x, y: H, ty: H * (0.14 + Math.random() * 0.3), vy: -(6 + Math.random() * 2) });
  }
  function next() {
    timer = setTimeout(function () { if (visible && !document.hidden) launch(); next(); }, 1500 + Math.random() * 1400);
  }

  function tick() {
    ctx.globalCompositeOperation = 'destination-out';
    ctx.fillStyle = 'rgba(0,0,0,.2)';
    ctx.fillRect(0, 0, W, H);
    ctx.globalCompositeOperation = 'lighter';
    var k, p;
    for (k = rockets.length - 1; k >= 0; k--) {
      p = rockets[k]; p.y += p.vy;
      ctx.fillStyle = 'rgba(255,220,150,.9)';
      ctx.fillRect(p.x - 1, p.y, 2, 9);
      if (p.y <= p.ty) { burst(p.x, p.y); rockets.splice(k, 1); }
    }
    for (k = parts.length - 1; k >= 0; k--) {
      p = parts[k];
      p.x += p.vx; p.y += p.vy; p.vx *= 0.985; p.vy = p.vy * 0.985 + 0.045; p.l -= p.d;
      if (p.l <= 0) { parts.splice(k, 1); continue; }
      ctx.fillStyle = 'hsla(' + p.h + ',100%,62%,' + p.l.toFixed(2) + ')';
      ctx.beginPath(); ctx.arc(p.x, p.y, 1.7, 0, 6.2832); ctx.fill();
    }
    raf = requestAnimationFrame(tick);
  }

  function run(on) {
    cancelAnimationFrame(raf);
    if (on) { raf = requestAnimationFrame(tick); }
  }
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (en) { visible = en[0].isIntersecting; run(visible && !document.hidden); }).observe(hero);
  }
  document.addEventListener('visibilitychange', function () { run(visible && !document.hidden); });

  hero.addEventListener('click', function (e) {
    var r = hero.getBoundingClientRect();
    burst(e.clientX - r.left, e.clientY - r.top);
  });

  run(true);
  setTimeout(launch, 500);
  next();
})();