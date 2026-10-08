/**
 * ====================================================================
 * Binod Sthapit - AI Marketing Expert Portfolio
 * Main Application Script (Vanilla JS + jQuery support)
 * ====================================================================
 */

function initMain() {
  initNavigation();
  initDynamicCopyright();
  initBookingButtons();
  initSocialLinks();
  initWow();
  initScrollProgress();
  initPulseDot();
  initInteractiveTilt();
  initClickRipple();
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initMain);
} else {
  initMain();
}

/**
 * Navigation Bar Behaviors: Scroll styling, active page detection, mobile menu collapse
 */
function initNavigation() {
  const navbar = document.querySelector(".navbar-custom");
  if (navbar && !navbar.dataset.navInitialized) {
    navbar.dataset.navInitialized = "true";
    const handleScroll = () => {
      if (window.scrollY > 40) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    };
    window.addEventListener("scroll", handleScroll, { passive: true });
    handleScroll();
  }

  // Active link detection based on current pathname (handles both .html and clean URLs)
  const rawPath = window.location.pathname.split("/").pop() || "index.html";
  const cleanCurrent = rawPath.replace(/\.html$/, "") || "index";
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  
  navLinks.forEach(link => {
    const href = link.getAttribute("href");
    if (!href) return;
    const rawLink = href.split("/").pop().split("#")[0];
    const cleanLink = rawLink.replace(/\.html$/, "") || "index";

    if (cleanCurrent === cleanLink) {
      link.classList.add("active");
      link.setAttribute("aria-current", "page");
    }
  });

  // Mobile navbar auto-collapse when link is clicked
  const navCollapse = document.getElementById("mainNavbarNav");
  if (navCollapse && !navCollapse.dataset.collapseInitialized) {
    navCollapse.dataset.collapseInitialized = "true";
    const links = navCollapse.querySelectorAll(".nav-link, .btn");
    links.forEach(link => {
      link.addEventListener("click", () => {
        if (window.innerWidth < 992 && navCollapse.classList.contains("show")) {
          if (typeof bootstrap !== "undefined" && bootstrap.Collapse) {
            const bsCollapse = bootstrap.Collapse.getInstance(navCollapse) || new bootstrap.Collapse(navCollapse);
            bsCollapse.hide();
          } else {
            navCollapse.classList.remove("show");
          }
        }
      });
    });
  }
}

/**
 * Connects booking CTA buttons to either:
 * 1. The custom booking URL configured in config.js (e.g., Google Calendar appointment scheduling)
 * 2. Or fallback to contact#consultation if unconfigured.
 */
function initBookingButtons() {
  const bookingUrl = window.SITE_CONFIG?.personal?.bookingUrl?.trim();
  const bookingButtons = document.querySelectorAll(".booking-cta-btn");
  const isContactPage = window.location.pathname.includes("contact");

  bookingButtons.forEach(btn => {
    if (bookingUrl && bookingUrl.length > 0) {
      btn.setAttribute("href", bookingUrl);
      btn.setAttribute("target", "_blank");
      btn.setAttribute("rel", "noopener noreferrer");
    } else {
      const destination = isContactPage ? "#consultation" : "contact#consultation";
      btn.setAttribute("href", destination);
      btn.removeAttribute("target");
      btn.removeAttribute("rel");
    }
  });
}

/**
 * Renders social profiles only if configured with valid links.
 */
function initSocialLinks() {
  const profiles = window.SITE_CONFIG?.personal?.socialProfiles || {};
  const container = document.getElementById("footerSocialLinks");
  if (!container) return;

  const icons = {
    linkedin: "bi-linkedin",
    twitter: "bi-twitter-x",
    facebook: "bi-facebook",
    instagram: "bi-instagram",
    youtube: "bi-youtube"
  };

  const labels = {
    linkedin: "LinkedIn Profile",
    twitter: "X (Twitter) Profile",
    facebook: "Facebook Profile",
    instagram: "Instagram Profile",
    youtube: "YouTube Channel"
  };

  container.innerHTML = "";
  let renderedCount = 0;

  for (const [platform, url] of Object.entries(profiles)) {
    if (url && typeof url === "string" && url.trim().length > 0 && url.trim() !== "#") {
      const a = document.createElement("a");
      a.href = url.trim();
      a.target = "_blank";
      a.rel = "noopener noreferrer";
      a.className = "social-link-btn me-2";
      a.setAttribute("aria-label", labels[platform] || platform);
      a.innerHTML = `<i class="bi ${icons[platform] || 'bi-link-45deg'}"></i>`;
      container.appendChild(a);
      renderedCount++;
    }
  }

  if (renderedCount === 0) {
    const parentCol = container.closest(".social-profiles-container");
    if (parentCol) {
      parentCol.style.display = "none";
    }
  }
}

/**
 * Update dynamic copyright year
 */
function initDynamicCopyright() {
  const yearSpans = document.querySelectorAll(".current-year");
  const year = new Date().getFullYear();
  yearSpans.forEach(span => {
    span.textContent = year;
  });
}

/**
 * Initialize WOW.js for scroll animations
 */
function initWow() {
  if (typeof WOW !== "undefined" && !window.__wowInitialized) {
    window.__wowInitialized = true;
    new WOW().init();
  }
}

/**
 * 1. Top Reading Scroll Progress Bar
 */
function initScrollProgress() {
  let bar = document.getElementById("scrollProgressBar");
  if (!bar) {
    bar = document.createElement("div");
    bar.id = "scrollProgressBar";
    bar.className = "scroll-progress-bar";
    bar.setAttribute("aria-hidden", "true");
    document.body.appendChild(bar);
  }

  if (bar.dataset.progressInitialized) return;
  bar.dataset.progressInitialized = "true";

  let ticking = false;
  const updateProgress = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    bar.style.width = Math.min(Math.max(progress, 0), 100) + "%";
    ticking = false;
  };

  window.addEventListener("scroll", () => {
    if (!ticking) {
      window.requestAnimationFrame(updateProgress);
      ticking = true;
    }
  }, { passive: true });

  updateProgress();
}

/**
 * 2. Pulse Dot Live Availability Indicator
 */
function initPulseDot() {
  const badges = document.querySelectorAll(".badge-tag");
  badges.forEach(badge => {
    if (!badge.querySelector(".pulse-dot")) {
      const dot = document.createElement("span");
      dot.className = "pulse-dot";
      dot.setAttribute("aria-hidden", "true");
      badge.prepend(dot);
    }
  });
}

/**
 * 3. Interactive Desktop 3D Cursor Tilt
 */
function initInteractiveTilt() {
  const isDesktop = window.innerWidth >= 992 && window.matchMedia("(hover: hover)").matches;
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (!isDesktop || prefersReducedMotion) return;

  const tiltElements = document.querySelectorAll(".headshot-wrapper, .consultation-banner");
  tiltElements.forEach(el => {
    if (el.dataset.tiltInitialized) return;
    el.dataset.tiltInitialized = "true";

    el.classList.add("interactive-tilt-card");

    let rafId = null;
    const onMouseMove = (e) => {
      const rect = el.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width - 0.5;
      const y = (e.clientY - rect.top) / rect.height - 0.5;

      if (rafId) cancelAnimationFrame(rafId);
      rafId = requestAnimationFrame(() => {
        const rotateX = (-y * 8).toFixed(2);
        const rotateY = (x * 8).toFixed(2);
        el.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.012, 1.012, 1.012)`;
      });
    };

    const onMouseLeave = () => {
      if (rafId) cancelAnimationFrame(rafId);
      el.style.transform = "";
    };

    el.addEventListener("mousemove", onMouseMove);
    el.addEventListener("mouseleave", onMouseLeave);
  });
}

/**
 * 4. Micro-Ripple Feedback on CTA and Button Clicks
 */
function initClickRipple() {
  const buttons = document.querySelectorAll(".btn-primary-cta, .btn-secondary-custom, .btn-outline-teal");
  buttons.forEach(btn => {
    if (btn.dataset.rippleInitialized) return;
    btn.dataset.rippleInitialized = "true";

    btn.classList.add("btn-ripple-container");
    btn.addEventListener("click", function(e) {
      const rect = this.getBoundingClientRect();
      const ripple = document.createElement("span");
      ripple.className = "btn-ripple";

      const diameter = Math.max(rect.width, rect.height);
      const radius = diameter / 2;

      ripple.style.width = ripple.style.height = `${diameter}px`;
      ripple.style.left = `${e.clientX - rect.left - radius}px`;
      ripple.style.top = `${e.clientY - rect.top - radius}px`;

      const existing = this.querySelector(".btn-ripple");
      if (existing) existing.remove();

      this.appendChild(ripple);
      setTimeout(() => {
        ripple.remove();
      }, 600);
    });
  });
}
