/**
 * SearchEngineOptimization.ae Enterprise Theme — main.js
 * Navbar, mega menu, mobile menu, counter animation, FAQ accordion
 */

document.addEventListener('DOMContentLoaded', function () {

  // ── NAVBAR SCROLL SHADOW ────────────────────────────────────────
  const header = document.getElementById('site-header');
  if (header) {
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      const scrolled = window.scrollY > 10;
      header.classList.toggle('navbar--scrolled', scrolled);
      lastScroll = window.scrollY;
    }, { passive: true });
  }

  // ── DROPDOWN / MEGA MENU ────────────────────────────────────────
  let closeTimer = null;
  document.querySelectorAll('.navbar__item--dropdown').forEach(item => {
    const btn = item.querySelector('.navbar__link--dropdown');

    item.addEventListener('mouseenter', () => {
      clearTimeout(closeTimer);
      // Close all others
      document.querySelectorAll('.navbar__item--dropdown.is-open').forEach(el => {
        if (el !== item) el.classList.remove('is-open');
      });
      item.classList.add('is-open');
      if (btn) btn.setAttribute('aria-expanded', 'true');
    });

    item.addEventListener('mouseleave', () => {
      closeTimer = setTimeout(() => {
        item.classList.remove('is-open');
        if (btn) btn.setAttribute('aria-expanded', 'false');
      }, 150);
    });

    // Keyboard toggle
    if (btn) {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const isOpen = item.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', String(isOpen));
      });
    }
  });

  // Close dropdowns on outside click
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.navbar__item--dropdown')) {
      document.querySelectorAll('.navbar__item--dropdown.is-open').forEach(el => {
        el.classList.remove('is-open');
        const btn = el.querySelector('.navbar__link--dropdown');
        if (btn) btn.setAttribute('aria-expanded', 'false');
      });
    }
  });

  // ── MOBILE MENU ─────────────────────────────────────────────────
  const mobileBtn     = document.getElementById('mobile-menu-btn');
  const mobileClose   = document.getElementById('mobile-menu-close');
  const mobileMenu    = document.getElementById('mobile-menu');
  const mobileOverlay = document.getElementById('mobile-overlay');

  function openMobile() {
    mobileMenu?.classList.add('is-open');
    mobileOverlay?.classList.add('is-open');
    mobileBtn?.setAttribute('aria-expanded', 'true');
    mobileMenu?.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeMobile() {
    mobileMenu?.classList.remove('is-open');
    mobileOverlay?.classList.remove('is-open');
    mobileBtn?.setAttribute('aria-expanded', 'false');
    mobileMenu?.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  mobileBtn?.addEventListener('click', openMobile);
  mobileClose?.addEventListener('click', closeMobile);
  mobileOverlay?.addEventListener('click', closeMobile);

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMobile();
  });

  // ── COUNTER ANIMATION ───────────────────────────────────────────
  function animateCounter(el) {
    const target  = parseFloat(el.dataset.counter);
    const suffix  = el.dataset.suffix || '';
    const prefix  = el.dataset.prefix || '';
    const decimal = (el.dataset.counter.includes('.')) ? 1 : 0;
    const dur     = 1800;
    const steps   = 60;
    const step    = dur / steps;
    let current   = 0;
    let tick      = 0;

    const interval = setInterval(() => {
      tick++;
      const progress = tick / steps;
      // Ease-out
      current = target * (1 - Math.pow(1 - progress, 3));
      el.textContent = prefix + current.toFixed(decimal) + suffix;
      if (tick >= steps) {
        clearInterval(interval);
        el.textContent = prefix + target.toFixed(decimal) + suffix;
      }
    }, step);
  }

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.dataset.animated) {
        entry.target.dataset.animated = 'true';
        animateCounter(entry.target);
      }
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));

  // ── FAQ ACCORDION ────────────────────────────────────────────────
  document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const isOpen = item.classList.contains('is-open');

      // Close all
      document.querySelectorAll('.faq-item.is-open').forEach(el => {
        el.classList.remove('is-open');
        el.querySelector('.faq-question')?.setAttribute('aria-expanded', 'false');
      });

      // Open clicked (toggle)
      if (!isOpen) {
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // ── NEWSLETTER FORM ──────────────────────────────────────────────
  const newsletterForm = document.getElementById('newsletter-form');
  if (newsletterForm && typeof SEOAE !== 'undefined') {
    newsletterForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = newsletterForm.querySelector('[name="email"]').value;
      const msg   = document.getElementById('newsletter-message');

      try {
        const fd = new FormData();
        fd.append('action', 'seoae_newsletter');
        fd.append('nonce', SEOAE.nonce);
        fd.append('email', email);

        const res  = await fetch(SEOAE.ajaxUrl, { method: 'POST', body: fd });
        const data = await res.json();

        if (msg) {
          msg.textContent = data.data || (data.success ? 'Subscribed!' : 'Error, please try again.');
          msg.style.color = data.success ? '#2FBF71' : '#AC192C';
        }
        if (data.success) newsletterForm.reset();
      } catch {
        if (msg) { msg.textContent = 'Something went wrong.'; msg.style.color = '#AC192C'; }
      }
    });
  }

  // ── CONTACT FORM ─────────────────────────────────────────────────
  const contactForm = document.getElementById('contact-ajax-form');
  if (contactForm && typeof SEOAE !== 'undefined') {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const submitBtn = contactForm.querySelector('[type="submit"]');
      const msg       = contactForm.querySelector('.form-message');
      const orig      = submitBtn?.textContent;

      if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Sending…'; }

      try {
        const fd = new FormData(contactForm);
        fd.append('action', 'seoae_contact');
        fd.append('nonce', SEOAE.nonce);

        const res  = await fetch(SEOAE.ajaxUrl, { method: 'POST', body: fd });
        const data = await res.json();

        if (msg) {
          msg.className = 'form-message ' + (data.success ? 'form-message--success' : 'form-message--error');
          msg.textContent = data.data;
          msg.style.display = 'block';
        }
        if (data.success) contactForm.reset();
      } catch {
        if (msg) { msg.className = 'form-message form-message--error'; msg.textContent = 'Something went wrong. Please call us.'; msg.style.display = 'block'; }
      } finally {
        if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = orig; }
      }
    });
  }

  // ── SMOOTH SCROLL ANCHOR LINKS ───────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const id = link.getAttribute('href').slice(1);
      const target = document.getElementById(id);
      if (target) {
        e.preventDefault();
        const offset = (header?.offsetHeight || 80) + 16;
        window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
      }
    });
  });

  // ── LAZY IMAGE OBSERVER ──────────────────────────────────────────
  if ('IntersectionObserver' in window) {
    const imgObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) { img.src = img.dataset.src; delete img.dataset.src; }
          imgObserver.unobserve(img);
        }
      });
    }, { rootMargin: '200px' });

    document.querySelectorAll('img[data-src]').forEach(img => imgObserver.observe(img));
  }

  // ── FADE IN ON SCROLL ────────────────────────────────────────────
  const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        fadeObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.fade-in').forEach(el => fadeObserver.observe(el));

});
