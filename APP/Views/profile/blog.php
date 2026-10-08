<?php
/**
 * View template: profile/blog
 */
?>
{{ $this->view('profile/partials/header', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
{{ $this->view('profile/partials/navbar', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}

<main id="main-content">

    <!-- Header Section -->
    <section class="hero-section" aria-labelledby="blog-heading">
      <div class="container pt-4">
        <div class="row align-items-center">
          <div class="col-lg-8 wow fadeInLeft" data-wow-duration="0.8s">
            <div class="badge-tag">
              <i class="bi bi-journal-text"></i>
              <span>Marketing Insights & Strategy</span>
            </div>
            <h1 id="blog-heading" class="hero-headline">
              Practical Insights for <span class="text-gradient">Modern Business Growth</span>
            </h1>
            <p class="hero-lead">
              Ground-level advice on utilizing artificial intelligence, choosing digital channels, and building sustainable lead generation systems—free from corporate hype and exaggerated claims.
            </p>
          </div>
          <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 wow fadeInRight" data-wow-duration="0.8s">
            <div class="p-3 bg-white rounded-3 border shadow-sm text-start">
              <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-calendar-check text-teal fs-5"></i>
                <span class="fw-bold small text-navy">Need Custom Strategy?</span>
              </div>
              <p class="small text-muted mb-2">Book a one-on-one session to build an actionable digital marketing plan for your business.</p>
              <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-outline-teal btn-sm w-100">Book Free Consultation</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Search & Filter Controls -->
    <section class="py-4 bg-white border-bottom" aria-label="Article filters">
      <div class="container">
        <div class="row g-3 align-items-center justify-content-between">
          <div class="col-md-5 col-lg-4">
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0 text-muted">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" id="blogSearchInput" class="form-control border-start-0 bg-light" placeholder="Search by title, topic, or keyword..." aria-label="Search articles">
            </div>
          </div>
          <div class="col-md-7 col-lg-8 d-flex flex-wrap align-items-center justify-content-md-end gap-2">
            <span class="small text-muted me-1 d-none d-lg-inline">Filter:</span>
            <div class="filter-btn-group d-flex flex-wrap gap-2" role="group" aria-label="Category filters">
              <button type="button" class="btn active" data-category="all">All Articles</button>
              <button type="button" class="btn" data-category="AI Strategy">AI Strategy</button>
              <button type="button" class="btn" data-category="Digital Planning">Digital Planning</button>
              <button type="button" class="btn" data-category="Content & Social">Content & Social</button>
            </div>
          </div>
        </div>
        <div class="mt-3">
          <span id="blogResultsCount" class="text-muted small">Showing 5 of 5 articles</span>
        </div>
      </div>
    </section>

    <!-- Articles Listing Grid -->
    <section class="section-padding" aria-label="Articles list">
      <div class="container">

        <!-- Grid Container (Populated dynamically by blog.js with initial HTML fallback) -->
        <div class="row g-4" id="articlesGrid">
          <!-- Article: 7 AI Tools in 2026 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <article class="article-card h-100">
              <div class="article-card-body">
                <div class="article-meta">
                  <span class="article-category-badge">AI Strategy</span>
                  <span><i class="bi bi-clock me-1"></i>6 min read</span>
                </div>
                <h3 class="article-card-title">
                  <a href="{{ pathto('profile/blog/article-7-ai-tools-every-small-business-owner-should-use-in-2026') }}">7 AI Tools Every Small Business Owner Should Use in 2026</a>
                </h3>
                <p class="text-secondary small mb-3 flex-grow-1">
                  Artificial intelligence is no longer reserved for Fortune 500 tech giants. Here are the 7 battle-tested AI tools that allow SME owners to automate marketing, close more sales, and save 15+ hours weekly.
                </p>
                <div class="article-card-footer">
                  <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>Oct 2, 2026</span>
                  <a href="{{ pathto('profile/blog/article-7-ai-tools-every-small-business-owner-should-use-in-2026') }}" class="fw-bold small text-teal">Read Article <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </article>
          </div>

          <!-- Article: Facebook & Instagram Customers -->
          <div class="col-md-6 col-lg-4 mb-4">
            <article class="article-card h-100">
              <div class="article-card-body">
                <div class="article-meta">
                  <span class="article-category-badge">Content & Social</span>
                  <span><i class="bi bi-clock me-1"></i>5 min read</span>
                </div>
                <h3 class="article-card-title">
                  <a href="{{ pathto('profile/blog/article-how-to-get-more-customers-from-facebook-and-instagram') }}">How to Get More Customers from Facebook & Instagram Without Wasting Money on Ads</a>
                </h3>
                <p class="text-secondary small mb-3 flex-grow-1">
                  Tired of clicking "Boost Post" only to watch your budget evaporate? Learn the proven direct-response framework that turns social media scrollers into paying in-store and online clients with high-converting DM funnels.
                </p>
                <div class="article-card-footer">
                  <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>Oct 2, 2026</span>
                  <a href="{{ pathto('profile/blog/article-how-to-get-more-customers-from-facebook-and-instagram') }}" class="fw-bold small text-teal">Read Article <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </article>
          </div>

          <!-- Article 1 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <article class="article-card h-100">
              <div class="article-card-body">
                <div class="article-meta">
                  <span class="article-category-badge">AI Strategy</span>
                  <span><i class="bi bi-clock me-1"></i>5 min read</span>
                </div>
                <h3 class="article-card-title">
                  <a href="{{ pathto('profile/blog/article-small-business-ai') }}">How Small Businesses Can Get Started with AI Marketing</a>
                </h3>
                <p class="text-secondary small mb-3 flex-grow-1">
                  A practical, non-technical roadmap for small business owners looking to leverage artificial intelligence in their marketing without getting lost in hype or complex tools.
                </p>
                <div class="article-card-footer">
                  <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>Oct 2, 2026</span>
                  <a href="{{ pathto('profile/blog/article-small-business-ai') }}" class="fw-bold small text-teal">Read Article <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </article>
          </div>

          <!-- Article 2 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <article class="article-card h-100">
              <div class="article-card-body">
                <div class="article-meta">
                  <span class="article-category-badge">Digital Planning</span>
                  <span><i class="bi bi-clock me-1"></i>6 min read</span>
                </div>
                <h3 class="article-card-title">
                  <a href="{{ pathto('profile/blog/article-digital-marketing-plan') }}">How to Build a Digital Marketing Plan for Your Business</a>
                </h3>
                <p class="text-secondary small mb-3 flex-grow-1">
                  A structured, pragmatic guide to creating an actionable digital marketing plan that aligns your channels, messaging, and budget with genuine business growth.
                </p>
                <div class="article-card-footer">
                  <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>Oct 2, 2026</span>
                  <a href="{{ pathto('profile/blog/article-digital-marketing-plan') }}" class="fw-bold small text-teal">Read Article <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </article>
          </div>

          <!-- Article 3 -->
          <div class="col-md-6 col-lg-4 mb-4">
            <article class="article-card h-100">
              <div class="article-card-body">
                <div class="article-meta">
                  <span class="article-category-badge">Content & Social</span>
                  <span><i class="bi bi-clock me-1"></i>5 min read</span>
                </div>
                <h3 class="article-card-title">
                  <a href="{{ pathto('profile/blog/article-ai-social-media') }}">Using AI to Save Time on Social Media Content</a>
                </h3>
                <p class="text-secondary small mb-3 flex-grow-1">
                  How small businesses can reclaim hours each week by using AI for content ideation, structuring, and repurposing while maintaining an authentic brand voice.
                </p>
                <div class="article-card-footer">
                  <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>Oct 2, 2026</span>
                  <a href="{{ pathto('profile/blog/article-ai-social-media') }}" class="fw-bold small text-teal">Read Article <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </article>
          </div>
        </div>

        <!-- Empty State (Shown when no search/filter matches exist) -->
        <div id="blogEmptyState" class="text-center py-5 d-none">
          <div class="p-5 bg-white rounded-4 border max-w-md mx-auto" style="max-width: 500px;">
            <i class="bi bi-journal-x fs-1 text-muted mb-3 d-block"></i>
            <h3 class="h5 fw-bold text-navy mb-2">No Matching Articles Found</h3>
            <p class="text-secondary small mb-4">
              We couldn't find any articles matching your search query or selected category. Try checking your spelling or clearing active filters.
            </p>
            <button type="button" id="resetSearchBtn" class="btn btn-outline-teal btn-sm">
              <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters & Show All
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Consultation CTA -->
    <section class="section-padding bg-light border-top" aria-labelledby="blog-cta-heading">
      <div class="container text-center">
        <div class="row justify-content-center">
          <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.8s">
            <span class="section-subtitle">Take Action</span>
            <h2 id="blog-cta-heading" class="h1 fw-bold mb-3 text-navy">
              Ready to Implement These Strategies in Your Business?
            </h2>
            <p class="lead text-secondary mb-4">
              During your free consultation, I’ll analyze your business and create a customized digital marketing plan you can start implementing immediately.
            </p>
            <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-primary-cta btn-lg px-5 booking-cta-btn">
              <span>Book a Free Consultation Call</span>
              <i class="bi bi-calendar-check"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

  </main>

{{ $this->view('profile/partials/footer', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
