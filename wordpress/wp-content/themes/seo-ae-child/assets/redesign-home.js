/* SearchEngineOptimization.ae — Homepage Redesign interactions */
(function () {
  'use strict';
  var root = document.querySelector('.rhome');
  if (!root) return;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- Scroll reveal + counters ---- */
  var counted = new WeakSet();

  function animateCount(el) {
    if (counted.has(el)) return;
    counted.add(el);
    var target = parseFloat(el.getAttribute('data-count'));
    var dec = (el.getAttribute('data-count').indexOf('.') > -1) ? 1 : 0;
    var prefix = el.getAttribute('data-prefix') || '';
    var suffix = el.getAttribute('data-suffix') || '';
    if (reduce) { el.textContent = prefix + target + suffix; return; }
    var dur = 1600, start = null;
    function step(ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      var val = (target * eased).toFixed(dec);
      el.textContent = prefix + Number(val).toLocaleString('en-US') + suffix;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = prefix + target.toLocaleString('en-US') + suffix;
    }
    requestAnimationFrame(step);
  }

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (!e.isIntersecting) return;
      e.target.classList.add('is-in');
      e.target.querySelectorAll('[data-count]').forEach(animateCount);
      if (e.target.hasAttribute('data-count')) animateCount(e.target);
      io.unobserve(e.target);
    });
  }, { threshold: 0.18, rootMargin: '0px 0px -8% 0px' });

  root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });
  root.querySelectorAll('[data-count]').forEach(function (el) {
    if (!el.closest('[data-reveal]')) io.observe(el);
  });

  /* ---- Hero particles ---- */
  var pWrap = root.querySelector('.rh-particles');
  if (pWrap && !reduce) {
    for (var i = 0; i < 14; i++) {
      var d = document.createElement('span');
      d.className = 'rh-particle';
      d.style.left = Math.random() * 100 + '%';
      d.style.top = Math.random() * 100 + '%';
      d.style.animationDelay = (Math.random() * 6) + 's';
      d.style.animationDuration = (7 + Math.random() * 6) + 's';
      d.style.opacity = (0.25 + Math.random() * 0.4).toFixed(2);
      d.style.transform = 'scale(' + (0.5 + Math.random()) + ')';
      pWrap.appendChild(d);
    }
  }

  /* ---- Hero dashboard mouse parallax ---- */
  var dashPanel = root.querySelector('.rh-dash__panel');
  var hero = root.querySelector('.rh-hero');
  if (dashPanel && hero && !reduce && window.matchMedia('(min-width: 981px)').matches) {
    hero.addEventListener('mousemove', function (ev) {
      var r = hero.getBoundingClientRect();
      var x = (ev.clientX - r.left) / r.width - 0.5;
      var y = (ev.clientY - r.top) / r.height - 0.5;
      dashPanel.style.transform = 'rotateY(' + (-9 + x * 8) + 'deg) rotateX(' + (5 - y * 8) + 'deg) translate(' + (x * 10) + 'px,' + (y * 10) + 'px)';
    });
    hero.addEventListener('mouseleave', function () {
      dashPanel.style.transform = 'rotateY(-9deg) rotateX(5deg)';
    });
  }

  /* ---- Six-step timeline scroll progress ---- */
  var tl = root.querySelector('.rh-timeline');
  if (tl) {
    var fill = tl.querySelector('.rh-timeline__fill');
    var steps = Array.prototype.slice.call(tl.querySelectorAll('.rh-step'));
    function onScroll() {
      var r = tl.getBoundingClientRect();
      var vh = window.innerHeight;
      var mid = vh * 0.55;
      var total = r.height;
      var progressed = Math.min(Math.max(mid - r.top, 0), total);
      if (fill) fill.style.height = progressed + 'px';
      steps.forEach(function (s) {
        var sr = s.getBoundingClientRect();
        var center = sr.top + sr.height / 2;
        if (center < mid + 40) s.classList.add('is-active');
        else s.classList.remove('is-active');
      });
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    onScroll();
  }

  /* ---- Interactive UAE map ---- */
  var mapData = {
    dubai:      { name: 'Dubai',          tag: 'High-intent commercial market', traffic: '+318%', keywords: '840+', clients: '120+', roi: '+206%', quote: 'From page 3 to the map pack and #1 organic for our core money keywords in 5 months.' },
    'abu-dhabi':{ name: 'Abu Dhabi',      tag: 'Capital & enterprise accounts',  traffic: '+241%', keywords: '520+', clients: '48',   roi: '+178%', quote: 'Government and enterprise buyers now find us first for capital-market SEO queries.' },
    sharjah:    { name: 'Sharjah',        tag: 'SME & industrial growth',        traffic: '+197%', keywords: '410+', clients: '62',   roi: '+164%', quote: 'Local lead volume tripled within two quarters across our Sharjah branches.' },
    ajman:      { name: 'Ajman',          tag: 'Emerging local demand',          traffic: '+173%', keywords: '260+', clients: '31',   roi: '+151%', quote: 'We finally own the Ajman-specific searches our competitors ignored.' },
    fujairah:   { name: 'Fujairah',       tag: 'Port & trade economy',           traffic: '+158%', keywords: '190+', clients: '18',   roi: '+140%', quote: 'Bilingual SEO opened a whole new pipeline from the east-coast market.' },
    rak:        { name: 'Ras Al Khaimah', tag: 'Tourism & trade',                traffic: '+182%', keywords: '230+', clients: '26',   roi: '+159%', quote: 'Tourism and trade queries now convert into real bookings and enquiries.' }
  };
  var pins = root.querySelectorAll('.rh-pin');
  var panel = root.querySelector('.rh-map__panel');
  function renderCity(key) {
    var d = mapData[key]; if (!d || !panel) return;
    panel.querySelector('[data-city]').textContent = d.name;
    panel.querySelector('[data-tag]').textContent = d.tag;
    panel.querySelector('[data-traffic]').textContent = d.traffic;
    panel.querySelector('[data-keywords]').textContent = d.keywords;
    panel.querySelector('[data-clients]').textContent = d.clients;
    panel.querySelector('[data-roi]').textContent = d.roi;
    panel.querySelector('[data-quote]').textContent = '“' + d.quote + '”';
    pins.forEach(function (p) { p.classList.toggle('is-active', p.getAttribute('data-city-key') === key); });
  }
  pins.forEach(function (p) {
    p.addEventListener('click', function () { renderCity(p.getAttribute('data-city-key')); });
    p.addEventListener('mouseenter', function () { renderCity(p.getAttribute('data-city-key')); });
  });

  /* ---- FAQ accordion ---- */
  root.querySelectorAll('.rh-acc__q').forEach(function (q) {
    q.addEventListener('click', function () {
      var acc = q.closest('.rh-acc');
      var open = acc.classList.contains('is-open');
      root.querySelectorAll('.rh-acc').forEach(function (a) {
        a.classList.remove('is-open');
        a.querySelector('.rh-acc__a').style.maxHeight = null;
      });
      if (!open) {
        acc.classList.add('is-open');
        var a = acc.querySelector('.rh-acc__a');
        a.style.maxHeight = a.scrollHeight + 'px';
      }
    });
  });

  /* ---- Sticky conversion CTA ---- */
  var sticky = root.querySelector('[data-rh-sticky-cta]');
  if (sticky) {
    sticky.hidden = false;
    var hero = root.querySelector('.rh-hero, .rs-hero');
    var finalCta = root.querySelector('.rh-final, .rh-convert--band');
    function updateSticky() {
      var pastHero = true;
      if (hero) {
        var hr = hero.getBoundingClientRect();
        pastHero = hr.bottom < 80;
      }
      var nearFinal = false;
      if (finalCta) {
        var fr = finalCta.getBoundingClientRect();
        nearFinal = fr.top < window.innerHeight - 40;
      }
      sticky.classList.toggle('is-visible', pastHero && !nearFinal);
    }
    window.addEventListener('scroll', updateSticky, { passive: true });
    window.addEventListener('resize', updateSticky);
    updateSticky();
  }
})();
