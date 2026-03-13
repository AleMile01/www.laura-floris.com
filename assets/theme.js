document.addEventListener('DOMContentLoaded', function () {
  const body = document.body;
  const siteHeader = document.getElementById('site-header');
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileOverlay = document.getElementById('mobile-menu-overlay');
  const backToTop = document.getElementById('back-to-top');
  const navbarLogo = document.getElementById('navbar-logo');
  const heroLogoWrap = document.getElementById('hero-logo-wrap');
  const mobileMenuLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
  const artworksCarousel = document.querySelector('[data-artworks-carousel]');

  let lastScrollY = window.scrollY;

  function closeMobileMenu() {
    if (!menuToggle || !mobileMenu || !mobileOverlay) return;

    menuToggle.setAttribute('aria-expanded', 'false');
    mobileMenu.setAttribute('aria-hidden', 'true');
    mobileMenu.classList.add('translate-x-full', 'pointer-events-none');
    mobileMenu.classList.remove('translate-x-0', 'pointer-events-auto');
    mobileOverlay.classList.add('pointer-events-none', 'opacity-0', 'bg-black/0');
    mobileOverlay.classList.remove('pointer-events-auto', 'opacity-100', 'bg-black/30');
    body.classList.remove('overflow-hidden');
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
    body.classList.add('overflow-hidden');
    menuToggle.classList.add('is-open');
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
});

