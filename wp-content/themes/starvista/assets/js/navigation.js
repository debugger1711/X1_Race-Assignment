(function () {
  const header = document.getElementById('masthead');
  const toggle = document.querySelector('.sv-menu-toggle');
  const panel = document.getElementById('sv-mobile-panel');
  const nav = document.getElementById('site-navigation');

  if (!header || !toggle || !panel) {
    return;
  }

  const openLabel = (window.starvistaNav && window.starvistaNav.open) || 'Open menu';
  const closeLabel = (window.starvistaNav && window.starvistaNav.close) || 'Close menu';

  function setOpen(isOpen) {
    document.body.classList.toggle('sv-menu-open', isOpen);
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    toggle.setAttribute('aria-label', isOpen ? closeLabel : openLabel);
    if (isOpen) {
      panel.removeAttribute('hidden');
    } else {
      panel.setAttribute('hidden', 'hidden');
    }
  }

  toggle.addEventListener('click', function () {
    setOpen(!document.body.classList.contains('sv-menu-open'));
  });

  panel.addEventListener('click', function (event) {
    const link = event.target.closest('a');
    if (link) {
      setOpen(false);
    }
  });

  document.addEventListener('keyup', function (event) {
    if (event.key === 'Escape') {
      setOpen(false);
    }
  });

  const media = window.matchMedia('(min-width: 1024px)');
  function onChange(e) {
    if (e.matches) {
      setOpen(false);
    }
  }
  if (media.addEventListener) {
    media.addEventListener('change', onChange);
  } else if (media.addListener) {
    media.addListener(onChange);
  }

  if (nav) {
    /* keep desktop nav in sync if WP fallbacks clone menus */
  }
})();
