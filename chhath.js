/* ShopVibe – Chhath Puja hero (sunset river scene, devotee with soop, floating diyas, bunting, embers)
   Add ONE line before </body> in index.php (replace the diwali.js line):  <script src="chhath.js"></script>
   Change any text in the CONFIG block below. */
(function () {
  var hero = document.querySelector('.hero');
  if (!hero) return;

  /* ============ CONFIG (edit freely) ============ */
  var CONFIG = {
    badge: '🌅 Chhath Puja ki hardik shubhkamnayein — ShopVibe ki taraf se',
    items: ['🍌', '🌾', '🥥'],
    tagTop: '🌅 Chhath Specials',
    tagBottom: '🎁 Gift Hampers',
    embers: true
  };

  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ============ CSS ============ */
  var css = '' +
  '.hero>.hero-text,.hero>.chhath-scene{position:relative;z-index:1}' +
  '.ch-glow{position:absolute;left:-10%;top:10%;width:60%;height:80%;z-index:0;pointer-events:none;' +
    'background:radial-gradient(ellipse at 30% 50%,rgba(255,110,30,.20),rgba(255,61,60,.08) 50%,transparent 72%);animation:chPulse 5s ease-in-out infinite}' +
  '.ch-badge{display:inline-flex;align-items:center;gap:8px;margin-bottom:18px;padding:8px 16px;border-radius:999px;' +
    'font:600 14px/1.2 Arial,sans-serif;color:#ffd9a8;background:linear-gradient(90deg,rgba(255,120,30,.24),rgba(230,60,40,.18));' +
    'border:1px solid rgba(255,160,70,.5);box-shadow:0 0 22px rgba(255,120,30,.25);animation:chGlow 2.6s ease-in-out infinite}' +
  '@keyframes chGlow{50%{box-shadow:0 0 34px rgba(255,120,30,.55)}}' +
  '@keyframes chPulse{50%{opacity:.65;transform:scale(1.06)}}' +

  '.chhath-scene{position:relative;width:480px;height:480px;flex:none;animation:chIn 1.2s ease both}' +
  '@keyframes chIn{from{opacity:0;transform:translateX(90px) scale(.9)}to{opacity:1;transform:none}}' +
  '.ch-svg{position:absolute;inset:0;width:100%;height:100%;display:block;' +
    '-webkit-mask-image:radial-gradient(closest-side at 50% 50%,#000 58%,rgba(0,0,0,.55) 82%,transparent 100%);' +
    'mask-image:radial-gradient(closest-side at 50% 50%,#000 58%,rgba(0,0,0,.55) 82%,transparent 100%)}' +
  '.ch-rays{transform-origin:220px 218px;animation:chSpin 90s linear infinite}' +
  '@keyframes chSpin{to{transform:rotate(360deg)}}' +
  '.ch-sun{transform-origin:220px 218px;animation:chSun 6s ease-in-out infinite}' +
  '@keyframes chSun{50%{transform:scale(1.04)}}' +
  '.ch-shim{transform-box:fill-box;transform-origin:50% 50%;animation:chShim 2.6s ease-in-out infinite alternate}' +
  '.ch-shim:nth-child(2){animation-delay:-.9s}.ch-shim:nth-child(3){animation-delay:-1.7s}' +
  '@keyframes chShim{from{transform:scaleX(1);opacity:.85}to{transform:scaleX(.7);opacity:.45}}' +
  '.ch-rip{animation:chRip 6s ease-in-out infinite alternate}' +
  '.ch-rip:nth-child(2n){animation-duration:8s;animation-direction:alternate-reverse}' +
  '.ch-rip:nth-child(3n){animation-duration:7s;animation-delay:-3s}' +
  '@keyframes chRip{from{transform:translateX(-14px)}to{transform:translateX(14px)}}' +
  '.ch-bird{animation:chBird 18s linear infinite}' +
  '.ch-bird.b2{animation-duration:24s;animation-delay:-9s}' +
  '@keyframes chBird{from{transform:translateX(-60px)}to{transform:translateX(520px)}}' +
  '.ch-bob{animation:chBob 3.2s ease-in-out infinite}' +
  '.ch-bob.d2{animation-delay:-1.1s}.ch-bob.d3{animation-delay:-2.1s}' +
  '@keyframes chBob{50%{transform:translateY(-5px)}}' +
  '.ch-fl{transform-box:fill-box;transform-origin:50% 100%;animation:chFl .9s ease-in-out infinite alternate}' +
  '@keyframes chFl{from{transform:scale(1,1)}to{transform:scale(.9,1.14)}}' +
  '.ch-arms{transform-box:fill-box;transform-origin:50% 100%;animation:chArm 5s ease-in-out infinite}' +
  '@keyframes chArm{50%{transform:translateY(-3px)}}' +

  '.ch-chip{position:absolute;width:46px;height:46px;display:flex;align-items:center;justify-content:center;font-size:22px;' +
    'border-radius:50%;background:rgba(255,255,255,.16);border:1px solid rgba(255,200,120,.6);box-shadow:0 8px 20px rgba(0,0,0,.3),0 0 16px rgba(255,150,40,.4);' +
    'backdrop-filter:blur(6px);animation:chFloat 4s ease-in-out infinite}' +
  '.ch-tag{position:absolute;padding:9px 15px;border-radius:14px;font:700 13px/1 Arial,sans-serif;color:#fff;white-space:nowrap;' +
    'background:rgba(60,14,10,.62);border:1px solid rgba(255,190,110,.5);box-shadow:0 10px 26px rgba(0,0,0,.4);backdrop-filter:blur(8px);animation:chFloat 4.4s ease-in-out infinite}' +
  '.ch-tag.t1{left:4%;top:18%}.ch-tag.t2{right:4%;bottom:18%;animation-delay:-2.2s}' +
  '@keyframes chFloat{50%{transform:translateY(-10px)}}' +
  '.ch-spark{position:absolute;width:11px;height:11px;background:#ffe3a0;clip-path:polygon(50% 0,62% 38%,100% 50%,62% 62%,50% 100%,38% 62%,0 50%,38% 38%);' +
    'filter:drop-shadow(0 0 6px #ffb703);animation:chTw 2.4s ease-in-out infinite}' +
  '@keyframes chTw{0%,100%{opacity:.15;transform:scale(.4) rotate(0)}50%{opacity:1;transform:scale(1) rotate(90deg)}}' +

  '.ch-fx{position:absolute;inset:0;width:100%;height:100%;z-index:0;pointer-events:none}' +

  '.ch-bunting{position:absolute;left:0;right:0;top:0;height:90px;z-index:2;pointer-events:none;overflow:hidden}' +
  '.ch-bunting svg{width:100%;height:100%;display:block;overflow:visible}' +
  '.ch-flag{transform-box:fill-box;transform-origin:50% 0;animation:chSway 2.6s ease-in-out infinite alternate;animation-delay:var(--d)}' +
  '@keyframes chSway{from{transform:rotate(-7deg)}to{transform:rotate(7deg)}}' +

  'html.dm-invert .ch-fx{display:none}' +
  'html.dm-invert .chhath-scene,html.dm-invert .ch-bunting{filter:invert(1) hue-rotate(180deg)}' +

  '@media (max-width:900px){.chhath-scene{width:min(380px,94vw);height:min(380px,94vw)}' +
    '.ch-chip{width:38px;height:38px;font-size:18px}.ch-tag{font-size:11px;padding:7px 11px}.ch-badge{font-size:12px}}' +
  '@media (prefers-reduced-motion:reduce){.chhath-scene *,.ch-badge,.ch-flag,.ch-glow,.chhath-scene{animation:none!important}}';

  var st = document.createElement('style');
  st.textContent = css;
  document.head.appendChild(st);

  /* ============ Badge above the heading ============ */
  var text = hero.querySelector('.hero-text');
  if (text && CONFIG.badge) {
    var b = document.createElement('div');
    b.className = 'ch-badge';
    b.textContent = CONFIG.badge;
    text.insertBefore(b, text.firstChild);
  }

  var glow = document.createElement('div');
  glow.className = 'ch-glow';
  hero.insertBefore(glow, hero.firstChild);

  /* ============ Scene on the right side ============ */
  var scene = document.createElement('div');
  scene.className = 'chhath-scene';

  var i, rays = '';
  for (i = 0; i < 16; i++) {
    rays += '<path d="M220 218 L' + (220 - 14) + ' ' + (218 - 330) + ' L' + (220 + 14) + ' ' + (218 - 330) + 'Z" transform="rotate(' + (i * 22.5) + ' 220 218)" fill="rgba(255,226,150,.13)"/>';
  }

  var ripples = '';
  var rp = [[30, 306, 70], [230, 300, 90], [330, 312, 60], [90, 326, 100], [290, 332, 80], [20, 352, 60],
            [180, 352, 90], [340, 360, 70], [60, 396, 90], [230, 392, 100], [350, 410, 60], [140, 422, 80]];
  rp.forEach(function (r) {
    ripples += '<rect class="ch-rip" x="' + r[0] + '" y="' + r[1] + '" width="' + r[2] + '" height="3.4" rx="1.7" fill="#fff3e6" opacity=".55"/>';
  });

  function diya(x, y, s, cls) {
    return '<g class="ch-bob ' + cls + '"><g transform="translate(' + x + ' ' + y + ') scale(' + s + ')">' +
      '<circle cx="0" cy="-6" r="22" fill="#ffb347" opacity=".35"/>' +
      '<path d="M-16 0 C-12 12 12 12 16 0Z" fill="#9a3410"/><ellipse cx="0" cy="0" rx="16" ry="4.5" fill="#f4a261"/>' +
      '<path class="ch-fl" d="M0 -17 C6 -10 7 -4 0 0 C-7 -4 -6 -10 0 -17Z" fill="#ffd23f"/>' +
      '<path class="ch-fl" d="M0 -10 C3 -7 3.5 -4 0 -1 C-3.5 -4 -3 -7 0 -10Z" fill="#fffbe0"/></g></g>';
  }

  var svg =
    '<svg class="ch-svg" viewBox="0 0 440 440" aria-hidden="true">' +
    '<defs>' +
    '<linearGradient id="chSky" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#b8260e"/><stop offset=".5" stop-color="#e8541a"/><stop offset="1" stop-color="#ffa347"/></linearGradient>' +
    '<linearGradient id="chWater" gradientUnits="userSpaceOnUse" x1="0" y1="284" x2="0" y2="440"><stop offset="0" stop-color="#ff9466"/><stop offset="1" stop-color="#d9482a"/></linearGradient>' +
    '<radialGradient id="chSunG" cx="50%" cy="50%" r="50%"><stop offset="0" stop-color="#fff3b0"/><stop offset=".6" stop-color="#ffc233"/><stop offset="1" stop-color="#ff8a1f"/></radialGradient>' +
    '<radialGradient id="chHalo" cx="50%" cy="50%" r="50%"><stop offset="0" stop-color="#ffd27a" stop-opacity=".75"/><stop offset="1" stop-color="#ff7a1a" stop-opacity="0"/></radialGradient>' +
    '</defs>' +
    '<rect width="440" height="440" fill="url(#chSky)"/>' +
    '<g class="ch-rays">' + rays + '</g>' +
    '<circle cx="220" cy="218" r="130" fill="url(#chHalo)"/>' +
    '<g class="ch-sun"><circle cx="220" cy="218" r="56" fill="url(#chSunG)"/></g>' +
    '<g class="ch-bird" ><path d="M60 80 q6 -7 12 0 q6 -7 12 0" fill="none" stroke="#5a1408" stroke-width="2" stroke-linecap="round"/></g>' +
    '<g class="ch-bird b2"><path d="M20 120 q5 -6 10 0 q5 -6 10 0" fill="none" stroke="#5a1408" stroke-width="1.8" stroke-linecap="round"/></g>' +
    '<path d="M0 266 C60 240 120 256 170 246 C230 236 300 212 360 240 C400 256 420 248 440 254 L440 300 L0 300Z" fill="#c4471b"/>' +
    '<path d="M0 284 C80 270 160 286 250 278 C330 270 390 282 440 274 L440 300 L0 300Z" fill="#a0361a"/>' +
    '<rect y="284" width="440" height="156" fill="url(#chWater)"/>' +
    '<g><ellipse class="ch-shim" cx="220" cy="298" rx="52" ry="4" fill="#ffd98a"/><ellipse class="ch-shim" cx="220" cy="314" rx="40" ry="3.6" fill="#ffd98a"/><ellipse class="ch-shim" cx="220" cy="332" rx="28" ry="3.2" fill="#ffd98a"/></g>' +
    ripples +
    '<g class="ch-dev" transform="translate(120 376) scale(1.5) translate(-120 -376)">' +
      '<path d="M132 292 C147 306 151 334 145 362 C142 372 135 372 135 362 C137 336 132 316 124 304Z" fill="#1c0f1a"/>' +
      '<circle cx="143" cy="318" r="4.2" fill="#ff9f1c"/><circle cx="145" cy="334" r="4.2" fill="#ffb703"/><circle cx="143" cy="350" r="4.2" fill="#ff9f1c"/>' +
      '<path d="M88 390 C88 358 96 338 106 324 L134 324 C144 338 152 358 152 390Z" fill="#0f7a6b"/>' +
      '<path d="M104 326 L134 324 L152 376 L142 384Z" fill="#14907e"/>' +
      '<path d="M134 324 L152 374" stroke="#f4c542" stroke-width="3" fill="none"/>' +
      '<rect x="88" y="366" width="64" height="4" fill="#f4c542"/>' +
      '<path d="M105 324 L135 324 L137 340 L103 340Z" fill="#7a1038"/>' +
      '<rect x="114" y="302" width="12" height="16" fill="#d98e5f"/>' +
      '<path d="M102 292 C101 268 139 268 138 292 C139 306 133 313 128 315 L112 315 C107 313 101 306 102 292Z" fill="#0f7a6b"/>' +
      '<ellipse cx="120" cy="292" rx="13" ry="15" fill="#e8a87c"/>' +
      '<path d="M104 291 C103 270 137 270 136 291 C132 281 126 278 120 278 C114 278 108 281 104 291Z" fill="#0f7a6b" stroke="#f4c542" stroke-width="1.6"/>' +
      '<path d="M107 289 C109 283 114 281 120 281 C126 281 131 283 133 289 C128 285 124 284 120 284 C116 284 112 285 107 289Z" fill="#1c0f1a"/>' +
      '<ellipse cx="114" cy="291" rx="2" ry="2.5" fill="#2a1410"/><ellipse cx="126" cy="291" rx="2" ry="2.5" fill="#2a1410"/>' +
      '<path d="M110 286 Q114 284 118 286 M122 286 Q126 284 130 286" fill="none" stroke="#2a1410" stroke-width="1.2" stroke-linecap="round"/>' +
      '<circle cx="120" cy="286" r="1.6" fill="#d62828"/><circle cx="122.5" cy="296" r=".9" fill="#f4c542"/>' +
      '<path d="M115 300 Q120 304 125 300" fill="none" stroke="#a0402a" stroke-width="1.4" stroke-linecap="round"/>' +
      '<circle cx="110" cy="297" r="2.6" fill="#ff8f70" opacity=".5"/><circle cx="130" cy="297" r="2.6" fill="#ff8f70" opacity=".5"/>' +
      '<circle cx="106" cy="302" r="2.6" fill="#f4c542"/><circle cx="134" cy="302" r="2.6" fill="#f4c542"/>' +
      '<g class="ch-arms">' +
        '<path d="M106 330 L95 342" stroke="#e8a87c" stroke-width="7" stroke-linecap="round"/>' +
        '<path d="M134 330 L145 342" stroke="#e8a87c" stroke-width="7" stroke-linecap="round"/>' +
        '<path d="M99 337 L93 343 M141 337 L147 343" stroke="#d62828" stroke-width="3" stroke-linecap="round"/>' +
        '<path d="M89 339 C93 354 147 354 151 339Z" fill="#7a4a1f"/><ellipse cx="120" cy="339" rx="31" ry="7" fill="#c98a3d"/>' +
        '<circle cx="103" cy="334" r="6" fill="#ff8a1f"/><circle cx="137" cy="334" r="6" fill="#e8c43a"/><rect x="113" y="326" width="14" height="8" rx="4" fill="#5fa35a"/>' +
        '<circle cx="94" cy="341" r="4" fill="#e8a87c"/><circle cx="146" cy="341" r="4" fill="#e8a87c"/>' +
        '<ellipse cx="120" cy="331" rx="9" ry="3.4" fill="#8a2d0b"/>' +
        '<path class="ch-fl" d="M120 309 C128 318 129 326 120 331 C111 326 112 318 120 309Z" fill="#ffd23f"/>' +
        '<path class="ch-fl" d="M120 318 C124 322 125 327 120 330 C115 327 116 322 120 318Z" fill="#fffbe0"/>' +
      '</g>' +
    '</g>' +
    '<path d="M0 374 C30 368 50 380 90 374 C130 368 160 380 200 374 C240 368 280 380 330 374 C380 368 410 378 440 372 L440 440 L0 440Z" fill="url(#chWater)"/>' +
    '<rect class="ch-rip" x="70" y="384" width="90" height="3.4" rx="1.7" fill="#fff3e6" opacity=".6"/>' +
    '<rect class="ch-rip" x="20" y="404" width="70" height="3.4" rx="1.7" fill="#fff3e6" opacity=".5"/>' +
    diya(300, 350, 1, '') + diya(366, 326, .75, 'd2') + diya(236, 408, 1.1, 'd3') + diya(60, 424, .8, 'd2') +
    '<path d="M0 440 L0 426 C40 420 90 432 140 426 L140 440Z" fill="#8f2f12" opacity="0"/>' +
    '</svg>';

  scene.innerHTML = svg +
    '<div class="ch-tag t1">' + CONFIG.tagTop + '</div>' +
    '<div class="ch-tag t2">' + CONFIG.tagBottom + '</div>';

  var pos = [['60%', '20%', '0s'], ['78%', '36%', '-1.3s'], ['62%', '50%', '-2.4s']];
  (CONFIG.items || []).slice(0, 3).forEach(function (e, n) {
    var c = document.createElement('div');
    c.className = 'ch-chip';
    c.textContent = e;
    c.style.left = pos[n][0]; c.style.top = pos[n][1]; c.style.animationDelay = pos[n][2];
    scene.appendChild(c);
  });

  for (i = 0; i < 12; i++) {
    var s = document.createElement('b');
    s.className = 'ch-spark';
    s.style.left = (6 + Math.random() * 88) + '%';
    s.style.top = (8 + Math.random() * 38) + '%';
    s.style.animationDelay = (-Math.random() * 2.4).toFixed(2) + 's';
    scene.appendChild(s);
  }
  hero.appendChild(scene);

  /* ============ Bunting flags along the top ============ */
  var bunting = document.createElement('div');
  bunting.className = 'ch-bunting';
  var fc = ['#ff8a1f', '#e8321a', '#ffb703', '#d62828'];
  function buildBunting() {
    var w = hero.clientWidth, n = Math.max(2, Math.round(w / 380)), seg = w / n, out = '', k, t, c = 0;
    out += '<svg viewBox="0 0 ' + w + ' 90" preserveAspectRatio="none" aria-hidden="true">';
    for (k = 0; k < n; k++) {
      var x0 = k * seg, x1 = x0 + seg, cx = x0 + seg / 2, y0 = -4, cy = 70;
      out += '<path d="M' + x0 + ' ' + y0 + ' Q' + cx + ' ' + cy + ' ' + x1 + ' ' + y0 + '" fill="none" stroke="#7a1d0c" stroke-width="1.6"/>';
      var cnt = Math.max(6, Math.round(seg / 34));
      for (t = 0.5; t < cnt; t++) {
        var u = t / cnt, mt = 1 - u;
        var px = mt * mt * x0 + 2 * mt * u * cx + u * u * x1;
        var py = mt * mt * y0 + 2 * mt * u * cy + u * u * y0;
        out += '<polygon class="ch-flag" style="--d:' + (-(c % 6) * 0.43).toFixed(2) + 's" points="' + (px - 10).toFixed(1) + ',' + py.toFixed(1) + ' ' + (px + 10).toFixed(1) + ',' + py.toFixed(1) + ' ' + px.toFixed(1) + ',' + (py + 24).toFixed(1) + '" fill="' + fc[c % fc.length] + '"/>';
        c++;
      }
    }
    out += '</svg>';
    bunting.innerHTML = out;
  }
  hero.appendChild(bunting);
  buildBunting();

  /* ============ Rising embers / floating glow (inside the hero only) ============ */
  if (!CONFIG.embers || reduce) { window.addEventListener('resize', buildBunting); return; }

  var cv = document.createElement('canvas');
  cv.className = 'ch-fx';
  hero.insertBefore(cv, hero.firstChild);
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, parts = [], visible = true, raf = 0;

  function size() {
    var r = hero.getBoundingClientRect(), d = Math.min(window.devicePixelRatio || 1, 2);
    W = r.width; H = r.height;
    cv.width = W * d; cv.height = H * d;
    ctx.setTransform(d, 0, 0, d, 0, 0);
    buildBunting();
  }
  size();
  window.addEventListener('resize', size);

  function ember(initial) {
    parts.push({
      x: Math.random() * W, y: initial ? Math.random() * H : H + 10,
      vx: (Math.random() - 0.5) * 0.3, vy: -(0.3 + Math.random() * 0.7),
      r: 1 + Math.random() * 2.2, ph: Math.random() * 6.28, l: 1, d: 0, h: 28 + Math.random() * 20, burst: false
    });
  }
  function burst(x, y) {
    for (var k = 0; k < 34; k++) {
      var a = Math.PI * 2 * k / 34, sp = 1.2 + Math.random() * 2.6;
      parts.push({ x: x, y: y, vx: Math.cos(a) * sp, vy: Math.sin(a) * sp - 0.6, r: 2 + Math.random() * 2, ph: 0, l: 1, d: 0.014 + Math.random() * 0.012, h: 30 + Math.random() * 20, burst: true });
    }
    if (parts.length > 260) parts.splice(0, parts.length - 260);
  }
  for (i = 0; i < 38; i++) ember(true);

  function tick() {
    ctx.clearRect(0, 0, W, H);
    ctx.globalCompositeOperation = 'lighter';
    var k, p, a;
    for (k = parts.length - 1; k >= 0; k--) {
      p = parts[k];
      if (p.burst) {
        p.x += p.vx; p.y += p.vy; p.vx *= 0.97; p.vy = p.vy * 0.97 + 0.05; p.l -= p.d;
        if (p.l <= 0) { parts.splice(k, 1); continue; }
        a = p.l;
      } else {
        p.ph += 0.03; p.x += p.vx + Math.sin(p.ph) * 0.35; p.y += p.vy;
        if (p.y < -10) { parts.splice(k, 1); ember(false); continue; }
        a = 0.35 + Math.sin(p.ph * 1.7) * 0.25;
      }
      var g = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.r * 4);
      g.addColorStop(0, 'hsla(' + p.h + ',100%,65%,' + a.toFixed(2) + ')');
      g.addColorStop(1, 'hsla(' + p.h + ',100%,55%,0)');
      ctx.fillStyle = g;
      ctx.beginPath(); ctx.arc(p.x, p.y, p.r * 4, 0, 6.2832); ctx.fill();
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
})();