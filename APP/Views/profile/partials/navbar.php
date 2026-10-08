  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-custom sticky-top" aria-label="Main Navigation">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ pathto('') }}">
        <img src="{{ pathto('images/profile/logo.png') }}" alt="Binod Sthapit" width="858" height="627" class="site-logo brand-logo-img">
      </a>

      <!-- Mobile Hamburger Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarNav" aria-controls="mainNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Nav Links & CTA -->
      <div class="collapse navbar-collapse" id="mainNavbarNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item">
            <a class="nav-link {{ (($activeTab ?? '') === 'home') ? 'active' : '' }}" href="{{ pathto('') }}" {{ (($activeTab ?? '') === 'home') ? 'aria-current="page"' : '' }}>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (($activeTab ?? '') === 'about') ? 'active' : '' }}" href="{{ pathto('about') }}" {{ (($activeTab ?? '') === 'about') ? 'aria-current="page"' : '' }}>About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (($activeTab ?? '') === 'services') ? 'active' : '' }}" href="{{ pathto('services') }}" {{ (($activeTab ?? '') === 'services') ? 'aria-current="page"' : '' }}>Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (($activeTab ?? '') === 'blog') ? 'active' : '' }}" href="{{ pathto('blog') }}" {{ (($activeTab ?? '') === 'blog') ? 'aria-current="page"' : '' }}>Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (($activeTab ?? '') === 'contact') ? 'active' : '' }}" href="{{ pathto('contact') }}" {{ (($activeTab ?? '') === 'contact') ? 'aria-current="page"' : '' }}>Contact</a>
          </li>
          <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
            <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-primary-cta booking-cta-btn">
              <span>Book a Free Call</span>
              <i class="bi bi-arrow-right-short fs-5"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
