(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var sleep = function (ms) { return new Promise(function (r) { setTimeout(r, ms); }); };
  var esc = function (t) { var d = document.createElement('div'); d.textContent = t; return d.innerHTML; };

  // Header + mobile menu
  var header = $('[data-header]');
  var onScroll = function () { if (header) header.classList.toggle('scrolled', window.scrollY > 8); };
  window.addEventListener('scroll', onScroll, { passive: true }); onScroll();
  var toggle = $('[data-toggle]'), menu = $('[data-menu]');
  if (toggle && menu) toggle.addEventListener('click', function () { menu.classList.toggle('open'); });

  // Reveal on scroll
  if ('IntersectionObserver' in window && !reduce) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    $$('.reveal').forEach(function (el) { io.observe(el); });
  } else { $$('.reveal').forEach(function (el) { el.classList.add('in'); }); }

  // Run a function only while an element is on screen
  function whenVisible(el, start, stop) {
    if (!el) return;
    if (!('IntersectionObserver' in window)) { start(); return; }
    var on = false;
    new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (e.isIntersecting && !on) { on = true; start(); }
        else if (!e.isIntersecting && on) { on = false; if (stop) stop(); }
      });
    }, { threshold: 0.2 }).observe(el);
  }

  function bubble(type, text) {
    var d = document.createElement('div');
    d.className = 'msg ' + type;
    var who = type === 'ai' ? 'Ava' : (type === 'pt' ? 'Patient' : '');
    d.innerHTML = (who ? '<span class="who">' + who + '</span>' : '') + esc(text);
    return d;
  }

  // Plays a list of [type,text] lines into a container. Returns a cancel fn.
  function playLines(box, lines, opts) {
    opts = opts || {};
    var cancelled = false;
    (async function () {
      box.innerHTML = '';
      for (var i = 0; i < lines.length; i++) {
        if (cancelled) return;
        var el = bubble(lines[i][0], lines[i][1]);
        box.appendChild(el);
        if (opts.max) { while (box.children.length > opts.max) box.removeChild(box.firstChild); }
        requestAnimationFrame(function (x) { return function () { x.classList.add('show'); }; }(el));
        if (opts.onLine) opts.onLine(i);
        await sleep(reduce ? 0 : Math.min(3200, 900 + lines[i][1].length * 22));
      }
      if (opts.done && !cancelled) opts.done();
    })();
    return function () { cancelled = true; };
  }

  // HERO: live call card + stacked event notifications
  var hero = $('[data-hero]');
  if (hero) {
    var heroLines = [
      ['ai', 'Hi Helen, it’s Ava from Dr. Patel’s office. Is now a good time for your monthly check-in?'],
      ['pt', 'Yes, go ahead.'],
      ['ai', 'How has your breathing been since we last spoke?'],
      ['pt', 'Better. I’m using the inhaler every morning.'],
      ['ai', 'Great. Your refill is due Friday. Shall I send the request to Dr. Patel’s team?'],
      ['pt', 'Please do.'],
      ['sys', 'Refill request sent · check-in logged for APCM']
    ];
    var box = $('[data-lines]', hero), wave = $('[data-wave]', hero), evs = $$('[data-ev]', hero), timerEl = $('[data-timer]', hero);
    var heroRun = false, cancel = null, front = -1, t0 = 0, tick = null;
    var stackTo = function (k) {
      front = k;
      evs.forEach(function (e, j) {
        var d = k - j;
        if (k < 0 || d < 0 || d > 2) { e.style.opacity = '0'; e.style.transform = 'translateY(16px)'; return; }
        e.style.opacity = [1, .7, .4][d];
        e.style.transform = 'translateY(' + (-d * 12) + 'px) scale(' + (1 - d * .05) + ')';
        e.style.zIndex = 10 - d;
      });
    };
    var loopHero = async function () {
      while (heroRun) {
        stackTo(-1);
        wave.classList.remove('idle');
        t0 = Date.now(); clearInterval(tick);
        tick = setInterval(function () { var s = Math.floor((Date.now() - t0) / 1000); timerEl.textContent = Math.floor(s / 60) + ':' + ('0' + s % 60).slice(-2); }, 500);
        var finished = false;
        cancel = playLines(box, heroLines, {
          max: 2,
          onLine: function (i) { var k = Math.min(evs.length - 1, Math.floor(i * evs.length / heroLines.length)); if (k !== front) stackTo(k); },
          done: function () { finished = true; }
        });
        while (!finished && heroRun) await sleep(300);
        stackTo(evs.length - 1);
        wave.classList.add('idle'); clearInterval(tick);
        await sleep(4000);
      }
    };
    whenVisible(hero, function () { heroRun = true; loopHero(); }, function () { heroRun = false; clearInterval(tick); if (cancel) cancel(); });
  }

  // PROCESS TABS
  var proc = $('[data-process]');
  if (proc) {
    var ptabs = $$('[data-ptab]', proc), panes = $$('[data-pane]', proc), pauseBtn = $('[data-ppause]', proc);
    var cur = 0, timer = null, paused = false, cancelMini = null, DUR = 8000, started = 0, remaining = DUR;
    var animatePane = function (pane) {
      var rows = $$('[data-r]', pane); rows.forEach(function (r) { r.classList.remove('on'); });
      var bar = $('[data-bar]', pane); if (bar) { bar.style.transition = 'none'; bar.style.width = '0'; }
      rows.forEach(function (r, i) { setTimeout(function () { r.classList.add('on'); if (bar) { bar.style.transition = 'width .9s linear'; bar.style.width = ((i + 1) / rows.length * 100) + '%'; } }, reduce ? 0 : 500 + i * 900); });
      var mini = $('[data-mini]', pane);
      if (cancelMini) cancelMini();
      if (mini) cancelMini = playLines(mini, JSON.parse(mini.getAttribute('data-mini')));
    };
    var show = function (i) {
      cur = i;
      ptabs.forEach(function (t, k) {
        t.setAttribute('aria-selected', 'false');
        t.classList.toggle('done', k < i);
        t.classList.remove('paused');
        t.style.setProperty('--dur', DUR / 1000 + 's');
      });
      void proc.offsetWidth;
      ptabs[i].setAttribute('aria-selected', 'true');
      panes.forEach(function (p, k) { p.classList.toggle('on', k === i); });
      animatePane(panes[i]);
      schedule(DUR);
    };
    var schedule = function (ms) {
      clearTimeout(timer); started = Date.now(); remaining = ms;
      if (!paused) timer = setTimeout(function () { show((cur + 1) % ptabs.length); }, ms);
    };
    ptabs.forEach(function (t, k) { var go = function () { paused = false; setPauseIcon(); show(k); }; t.addEventListener('click', go); t.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); go(); } }); });
    var setPauseIcon = function () {
      pauseBtn.innerHTML = paused ? '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"/></svg>' : '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="5" width="4" height="14" rx="1"/><rect x="14" y="5" width="4" height="14" rx="1"/></svg>';
      pauseBtn.setAttribute('aria-label', paused ? 'Play' : 'Pause');
    };
    pauseBtn.addEventListener('click', function () {
      paused = !paused; setPauseIcon();
      ptabs[cur].classList.toggle('paused', paused);
      if (paused) { clearTimeout(timer); remaining -= Date.now() - started; } else { schedule(Math.max(500, remaining)); }
    });
    var procStarted = false;
    whenVisible(proc, function () { if (!procStarted) { procStarted = true; show(0); } else if (!paused) { schedule(Math.max(500, remaining)); } }, function () { clearTimeout(timer); remaining -= Date.now() - started; });
  }

  // SCENARIOS
  var scen = $('[data-scen]'), scenData = $('#aicc-scenarios');
  if (scen && scenData) {
    var data = JSON.parse(scenData.textContent);
    var stabs = $$('[data-stab]', scen), sname = $('[data-sname]', scen), slines = $('[data-slines]', scen), srec = $('[data-srec]', scen), simg = $('[data-simg]', scen);
    var sCur = 0, sTimer = null, sCancel = null, sRun = false;
    var showScen = function (i) {
      sCur = i; var d = data[i];
      var dur = d.lines.reduce(function (a, l) { return a + Math.min(3200, 900 + l[1].length * 22); }, 0) + 3500;
      stabs.forEach(function (t, k) {
        t.setAttribute('aria-selected', k === i ? 'true' : 'false');
        var m = $('.meter', t); m.style.animation = 'none'; void m.offsetWidth; m.style.animation = '';
        t.style.setProperty('--dur', dur / 1000 + 's');
      });
      sname.textContent = d.name;
      if (simg && d.img && simg.getAttribute('src') !== d.img) { simg.style.opacity = '0'; setTimeout(function () { simg.src = d.img; simg.onload = function () { simg.style.opacity = '1'; }; }, 250); }
      srec.innerHTML = d.rec.map(function (r) { return '<div class="row"><div>' + esc(r[0]) + '</div><span class="badge ' + r[1] + '">' + esc(r[2]) + '</span></div>'; }).join('');
      var rows = $$('.row', srec);
      if (sCancel) sCancel();
      sCancel = playLines(slines, d.lines, { max: 4, onLine: function (k) { var n = Math.round((k + 1) / d.lines.length * rows.length); rows.slice(0, n).forEach(function (r) { r.classList.add('on'); }); } });
      clearTimeout(sTimer);
      if (sRun) sTimer = setTimeout(function () { showScen((sCur + 1) % data.length); }, dur);
    };
    stabs.forEach(function (t, k) { t.addEventListener('click', function () { showScen(k); }); });
    whenVisible(scen, function () { sRun = true; showScen(sCur); }, function () { sRun = false; clearTimeout(sTimer); if (sCancel) sCancel(); });
  }

  // AUDIO PLAYER
  $$('[data-player]').forEach(function (pl) {
    var audio = $('audio', pl), btn = $('[data-play]', pl), barsEl = $('[data-bars]', pl), curEl = $('[data-cur]', pl), script = $('[data-script]', pl);
    var peaks = (pl.getAttribute('data-peaks') || '').split(',').map(Number);
    barsEl.innerHTML = peaks.map(function (p) { return '<i style="height:' + Math.max(8, p) + '%"></i>'; }).join('');
    var bars = $$('i', barsEl), lines = $$('p', script);
    var fmt = function (s) { s = Math.floor(s); return Math.floor(s / 60) + ':' + ('0' + s % 60).slice(-2); };
    var setIcon = function () { btn.innerHTML = audio.paused ? '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"/></svg>' : '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="5" width="4" height="14" rx="1"/><rect x="14" y="5" width="4" height="14" rx="1"/></svg>'; btn.setAttribute('aria-label', audio.paused ? 'Play the sample call' : 'Pause'); };
    btn.addEventListener('click', function () { if (audio.paused) audio.play(); else audio.pause(); });
    audio.addEventListener('play', setIcon); audio.addEventListener('pause', setIcon); audio.addEventListener('ended', setIcon);
    var last = -1;
    audio.addEventListener('timeupdate', function () {
      var t = audio.currentTime, d = audio.duration || 106.8, k = Math.floor(t / d * bars.length);
      bars.forEach(function (b, i) { b.classList.toggle('played', i <= k); });
      curEl.textContent = fmt(t);
      var idx = -1; lines.forEach(function (l, i) { if (t >= parseFloat(l.getAttribute('data-t'))) idx = i; });
      if (idx !== last) {
        lines.forEach(function (l, i) { l.classList.toggle('now', i === idx); });
        if (idx >= 0) script.scrollTo({ top: lines[idx].offsetTop - script.offsetTop - 40, behavior: 'smooth' });
        last = idx;
      }
    });
    barsEl.addEventListener('click', function (e) {
      var r = barsEl.getBoundingClientRect(), d = audio.duration || 106.8;
      audio.currentTime = (e.clientX - r.left) / r.width * d; if (audio.paused) audio.play();
    });
    lines.forEach(function (l) { l.addEventListener('click', function () { audio.currentTime = parseFloat(l.getAttribute('data-t')); if (audio.paused) audio.play(); }); });
  });

  // CALCULATOR
  $$('[data-calc]').forEach(function (c) {
    var v = function (k) { return parseFloat($('[data-i="' + k + '"]', c).value); };
    var r = function (k) { return parseFloat($('[data-r="' + k + '"]', c).value) || 0; };
    var money = function (n) { return '$' + Math.round(n).toLocaleString('en-US'); };
    var calc = function () {
      var panel = v('panel'), enroll = v('enroll') / 100, multi = v('multi') / 100, qmb = v('qmb') / 100;
      $('[data-o="panel"]', c).textContent = panel.toLocaleString('en-US');
      $('[data-o="enroll"]', c).textContent = Math.round(enroll * 100) + '%';
      $('[data-o="multi"]', c).textContent = Math.round(multi * 100) + '%';
      $('[data-o="qmb"]', c).textContent = Math.round(qmb * 100) + '%';
      var n = Math.round(panel * enroll), m = Math.round(n * multi), l3 = Math.round(m * qmb), l2 = m - l3, l1 = n - m;
      var month = l1 * r('r1') + l2 * r('r2') + l3 * r('r3');
      $('[data-out="year"]', c).textContent = money(month * 12);
      $('[data-out="month"]', c).textContent = money(month);
      $('[data-out="patients"]', c).textContent = n.toLocaleString('en-US');
      $('[data-out="mix"]', c).textContent = l1 + ' / ' + l2 + ' / ' + l3;
      var fm = Math.round(panel * multi), f3 = Math.round(fm * qmb), full = (panel - fm) * r('r1') + (fm - f3) * r('r2') + f3 * r('r3');
      var fo = $('[data-out="full"]', c); if (fo) fo.textContent = money(full * 12) + ' / yr';
    };
    $$('input', c).forEach(function (i) { i.addEventListener('input', calc); });
    calc();
  });
})();
