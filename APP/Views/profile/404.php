<?php
/**
 * View template: profile/404
 */
?>
{{ $this->view('profile/partials/header', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
{{ $this->view('profile/partials/navbar', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}

<main id="main-content" class="flex-grow-1 d-flex align-items-center py-5 my-5">
    <div class="container text-center pt-5">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="display-1 fw-bold text-teal mb-2">404</div>
          <h1 class="h2 fw-bold text-navy mb-3">Page Not Found</h1>
          <p class="lead text-secondary mb-4">
            The page you are looking for might have been moved, renamed, or is temporarily unavailable.
          </p>

          <div class="p-4 bg-white rounded-4 border shadow-sm mb-4">
            <h2 class="h5 fw-bold text-navy mb-3">Helpful Destinations:</h2>
            <div class="d-flex flex-wrap justify-content-center gap-2">
              <a href="{{ pathto('profile') }}" class="btn btn-outline-teal btn-sm">
                <i class="bi bi-house me-1"></i> Home
              </a>
              <a href="{{ pathto('profile/services') }}" class="btn btn-outline-teal btn-sm">
                <i class="bi bi-grid me-1"></i> Services Catalog
              </a>
              <a href="{{ pathto('profile/blog') }}" class="btn btn-outline-teal btn-sm">
                <i class="bi bi-journal-text me-1"></i> Marketing Blog
              </a>
              <a href="{{ pathto('profile/about') }}" class="btn btn-outline-teal btn-sm">
                <i class="bi bi-person me-1"></i> About Binod
              </a>
              <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-primary-cta btn-sm booking-cta-btn">
                <i class="bi bi-calendar-check me-1"></i> Book a Free Consultation Call
              </a>
            </div>
          </div>

          <a href="{{ pathto('profile') }}" class="fw-bold text-teal">
            <i class="bi bi-arrow-left me-1"></i> Return to Homepage
          </a>
        </div>
      </div>
    </div>
  </main>

{{ $this->view('profile/partials/footer', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
