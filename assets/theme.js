document.addEventListener('DOMContentLoaded', function () {
  const body = document.body;
  const siteHeader = document.getElementById('site-header');
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileOverlay = document.getElementById('mobile-menu-overlay');
  const cartDrawer = document.getElementById('laura-cart-drawer');
  const cartOverlay = document.getElementById('laura-cart-overlay');
  const cartToggleButtons = document.querySelectorAll('[data-cart-toggle]');
  const cartCloseButtons = document.querySelectorAll('[data-cart-close]');
  const backToTop = document.getElementById('back-to-top');
  const contactFab = document.getElementById('contact-fab');
  const contactFabToggle = document.getElementById('contact-fab-toggle');
  const navbarLogo = document.getElementById('navbar-logo');
  const heroLogoWrap = document.getElementById('hero-logo-wrap');
  const mobileMenuLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
  const artworksCarousel = document.querySelector('[data-artworks-carousel]');
  const artworkGroups = document.querySelector('[data-artwork-groups]');
  const cartForm = document.querySelector('.woocommerce-cart-form');

  let lastScrollY = window.scrollY;
  let scrollLockCount = 0;

  function lockBodyScroll() {
    scrollLockCount += 1;

    if (scrollLockCount > 1) {
      return;
    }

    body.classList.add('overflow-hidden');
  }

  function unlockBodyScroll() {
    if (scrollLockCount === 0) {
      return;
    }

    scrollLockCount -= 1;

    if (scrollLockCount > 0) {
      return;
    }

    body.classList.remove('overflow-hidden');
  }

  function closeMobileMenu() {
    if (!menuToggle || !mobileMenu || !mobileOverlay) return;

    menuToggle.setAttribute('aria-expanded', 'false');
    mobileMenu.setAttribute('aria-hidden', 'true');
    mobileMenu.classList.add('translate-x-full', 'pointer-events-none');
    mobileMenu.classList.remove('translate-x-0', 'pointer-events-auto');
    mobileOverlay.classList.add('pointer-events-none', 'opacity-0', 'bg-black/0');
    mobileOverlay.classList.remove('pointer-events-auto', 'opacity-100', 'bg-black/30');
    if (!cartDrawer || cartDrawer.getAttribute('aria-hidden') === 'true') {
      unlockBodyScroll();
    }
    menuToggle.classList.remove('is-open');
  }

  function openMobileMenu() {
    if (!menuToggle || !mobileMenu || !mobileOverlay) return;

    menuToggle.setAttribute('aria-expanded', 'true');
    mobileMenu.setAttribute('aria-hidden', 'false');
    mobileMenu.classList.remove('translate-x-full', 'pointer-events-none');
    mobileMenu.classList.add('translate-x-0', 'pointer-events-auto');
    mobileOverlay.classList.remove('pointer-events-none', 'opacity-0', 'bg-black/0');
    mobileOverlay.classList.add('pointer-events-auto', 'opacity-100', 'bg-black/30');
    lockBodyScroll();
    menuToggle.classList.add('is-open');
  }

  function closeCartDrawer() {
    if (!cartDrawer || !cartOverlay) return;

    cartDrawer.setAttribute('aria-hidden', 'true');
    cartOverlay.setAttribute('aria-hidden', 'true');
    cartDrawer.classList.remove('is-open');
    cartOverlay.classList.remove('is-open');
    cartToggleButtons.forEach(function (button) {
      button.setAttribute('aria-expanded', 'false');
    });

    if (!mobileMenu || mobileMenu.getAttribute('aria-hidden') === 'true') {
      unlockBodyScroll();
    }
  }

  function openCartDrawer() {
    if (!cartDrawer || !cartOverlay) return;

    closeMobileMenu();
    cartDrawer.setAttribute('aria-hidden', 'false');
    cartOverlay.setAttribute('aria-hidden', 'false');
    cartDrawer.classList.add('is-open');
    cartOverlay.classList.add('is-open');
    cartToggleButtons.forEach(function (button) {
      button.setAttribute('aria-expanded', 'true');
    });
    lockBodyScroll();
  }

  if (menuToggle && mobileMenu && mobileOverlay) {
    menuToggle.addEventListener('click', function () {
      const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
      if (isOpen) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });

    mobileOverlay.addEventListener('click', closeMobileMenu);
    mobileMenuLinks.forEach(function (link) {
      link.addEventListener('click', closeMobileMenu);
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth >= 768) {
        closeMobileMenu();
      }
    });
  }

  if (cartDrawer && cartOverlay && cartToggleButtons.length) {
    cartToggleButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const isOpen = cartDrawer.getAttribute('aria-hidden') === 'false';

        if (isOpen) {
          closeCartDrawer();
        } else {
          openCartDrawer();
        }
      });
    });

    cartCloseButtons.forEach(function (button) {
      button.addEventListener('click', closeCartDrawer);
    });

    cartOverlay.addEventListener('click', closeCartDrawer);
  }

  if (cartForm) {
    const updateCartButtons = cartForm.querySelectorAll('button[name="update_cart"]');
    const quantityInputs = cartForm.querySelectorAll('input.qty');

    function enableUpdateCartButton() {
      if (!updateCartButtons.length) return;

      updateCartButtons.forEach(function (button) {
        button.disabled = false;
        button.removeAttribute('disabled');
        button.classList.remove('disabled');
        button.setAttribute('aria-disabled', 'false');
      });
    }

    enableUpdateCartButton();

    quantityInputs.forEach(function (input) {
      input.addEventListener('input', enableUpdateCartButton);
      input.addEventListener('change', enableUpdateCartButton);
    });
  }

  function updateNavbarLogo() {
    if (!navbarLogo || !heroLogoWrap) return;

    const heroBottom = heroLogoWrap.getBoundingClientRect().bottom;
    const shouldShow = heroBottom <= 0;

    if (shouldShow) {
      navbarLogo.classList.remove('opacity-0', 'pointer-events-none');
      navbarLogo.classList.add('opacity-100');
      navbarLogo.setAttribute('aria-hidden', 'false');
    } else {
      navbarLogo.classList.add('opacity-0', 'pointer-events-none');
      navbarLogo.classList.remove('opacity-100');
      navbarLogo.setAttribute('aria-hidden', 'true');
    }
  }

  function updateScrollUI() {
    if (!backToTop) return;

    const currentScrollY = window.scrollY;
    const scrollingDown = currentScrollY > lastScrollY;
    const pastThreshold = currentScrollY > 120;

    if (siteHeader) {
      if (pastThreshold && scrollingDown) {
        siteHeader.classList.add('-translate-y-full');
      } else {
        siteHeader.classList.remove('-translate-y-full');
      }
    }

    if (pastThreshold && scrollingDown) {
      backToTop.classList.remove('pointer-events-none', 'opacity-0', 'translate-y-4');
      backToTop.classList.add('pointer-events-auto', 'opacity-100', 'translate-y-0');
    } else {
      backToTop.classList.add('pointer-events-none', 'opacity-0', 'translate-y-4');
      backToTop.classList.remove('pointer-events-auto', 'opacity-100', 'translate-y-0');
    }

    if (currentScrollY <= 10) {
      if (siteHeader) {
        siteHeader.classList.remove('-translate-y-full');
      }
      backToTop.classList.add('pointer-events-none', 'opacity-0', 'translate-y-4');
      backToTop.classList.remove('pointer-events-auto', 'opacity-100', 'translate-y-0');
    }

    lastScrollY = currentScrollY;
  }

  if (backToTop) {
    backToTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  function closeContactFab() {
    if (!contactFab || !contactFabToggle) return;

    contactFab.classList.remove('is-open');
    contactFabToggle.setAttribute('aria-expanded', 'false');
    contactFabToggle.setAttribute('aria-label', 'Open contact options');
  }

  function openContactFab() {
    if (!contactFab || !contactFabToggle) return;

    contactFab.classList.add('is-open');
    contactFabToggle.setAttribute('aria-expanded', 'true');
    contactFabToggle.setAttribute('aria-label', 'Close contact options');
  }

  if (contactFab && contactFabToggle) {
    contactFabToggle.addEventListener('click', function (event) {
      event.stopPropagation();
      const isOpen = contactFab.classList.contains('is-open');

      if (isOpen) {
        closeContactFab();
      } else {
        openContactFab();
      }
    });

    document.addEventListener('click', function (event) {
      if (!contactFab.contains(event.target)) {
        closeContactFab();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeContactFab();
        closeCartDrawer();
        closeMobileMenu();
      }
    });
  }

  window.addEventListener('scroll', function () {
    updateNavbarLogo();
    updateScrollUI();
  }, { passive: true });

  window.addEventListener('resize', updateNavbarLogo);
  updateNavbarLogo();
  updateScrollUI();

  if (artworksCarousel) {
    const track = artworksCarousel.querySelector('[data-artworks-track]');
    const slides = Array.from(artworksCarousel.querySelectorAll('[data-artwork-slide]'));
    const prevButton = artworksCarousel.querySelector('[data-artworks-prev]');
    const nextButton = artworksCarousel.querySelector('[data-artworks-next]');
    const currentLabel = artworksCarousel.querySelector('[data-artworks-current]');

    if (track && slides.length && prevButton && nextButton && currentLabel) {
      let currentIndex = 0;

      function renderCarousel() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        currentLabel.textContent = String(currentIndex + 1);

        slides.forEach(function (slide, index) {
          slide.setAttribute('aria-hidden', index === currentIndex ? 'false' : 'true');
        });
      }

      prevButton.addEventListener('click', function () {
        currentIndex = currentIndex === 0 ? slides.length - 1 : currentIndex - 1;
        renderCarousel();
      });

      nextButton.addEventListener('click', function () {
        currentIndex = currentIndex === slides.length - 1 ? 0 : currentIndex + 1;
        renderCarousel();
      });

      renderCarousel();
    }
  }

  if (artworkGroups) {
    const artworkGroupTriggers = Array.from(artworkGroups.querySelectorAll('[data-artwork-group-trigger]'));
    const artworkGroupPanels = Array.from(artworkGroups.querySelectorAll('[data-artwork-group-panel]'));

    function renderArtworkGroup(activeGroup) {
      artworkGroupTriggers.forEach(function (trigger) {
        const isActive = trigger.getAttribute('data-group') === activeGroup;
        trigger.setAttribute('aria-expanded', isActive ? 'true' : 'false');
        trigger.classList.toggle('ring-2', isActive);
        trigger.classList.toggle('ring-neutral-900', isActive);
        trigger.classList.toggle('ring-offset-4', isActive);
      });

      artworkGroupPanels.forEach(function (panel) {
        const isActive = panel.getAttribute('data-group') === activeGroup;
        panel.classList.toggle('hidden', !isActive);
        panel.setAttribute('aria-hidden', isActive ? 'false' : 'true');
      });
    }

    artworkGroupTriggers.forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        renderArtworkGroup(trigger.getAttribute('data-group'));
      });
    });
  }
});

