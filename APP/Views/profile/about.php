<?php

/**
 * View template: profile/about
 */
?>
{{ $this->view('profile/partials/header', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
{{ $this->view('profile/partials/navbar', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}

<main id="main-content">

    <!-- About Hero / Header -->
    <section class="hero-section" aria-labelledby="about-heading">
      <div class="container pt-4">
        <div class="row align-items-center g-5">
          <div class="col-lg-6 wow fadeInLeft" data-wow-duration="0.8s">
            <div class="badge-tag">
              <i class="bi bi-person-badge"></i>
              <span>About My Practice</span>
            </div>
            <h1 id="about-heading" class="hero-headline">
              Practical AI Marketing Tailored for <span class="text-gradient">Real Business Growth</span>
            </h1>
            <p class="hero-lead">
              I am an AI Marketing Expert based in Kathmandu, Nepal, dedicated to helping small and medium business owners navigate the rapidly shifting digital landscape with confidence, clarity, and measurable return on investment.
            </p>
            <div class="d-flex flex-wrap gap-3 align-items-center">
              <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-primary-cta booking-cta-btn">
                <span>Book a Free Consultation Call</span>
                <i class="bi bi-calendar-check"></i>
              </a>
              <a href="{{ pathto('profile/services') }}" class="btn btn-secondary-custom">
                <span>View My Services</span>
              </a>
            </div>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.8s">
            <div class="headshot-wrapper">
              <div class="headshot-frame">
                <img src="{{ pathto('images/profile/headshot.jpg') }}" alt="Binod Sthapit - AI Marketing Expert" class="headshot-img" width="440" height="550" fetchpriority="high">
              </div>
              <div class="experience-floating-pill">
                <div class="floating-pill-icon">
                  <i class="bi bi-check2-circle"></i>
                </div>
                <div>
                  <div class="fw-bold text-dark small">Grounded & Honest</div>
                  <div class="text-muted" style="font-size: 0.8rem;">No Vanity Metrics or Hype</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Approach -->
    <section class="section-padding bg-white" aria-labelledby="mission-heading">
      <div class="container">
        <div class="row g-5">
          <!-- Mission -->
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="p-4 p-md-5 bg-light rounded-4 border h-100">
              <span class="section-subtitle">My Mission</span>
              <h2 id="mission-heading" class="h3 fw-bold mb-3 text-navy">
                Making Effective AI-Powered Digital Marketing Practical and Accessible
              </h2>
              <p class="text-secondary mb-3">
                Modern artificial intelligence tools have immense potential, but enterprise software suites and dense technical jargon often put them out of reach for independent business owners.
              </p>
              <p class="text-secondary mb-0">
                My mission is to strip away the noise and bring powerful, accessible AI capabilities directly into your daily marketing workflows—enabling your business to compete effectively, attract qualified prospects, and expand your market reach without unsustainable overhead.
              </p>
            </div>
          </div>
          <!-- Approach -->
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="p-4 p-md-5 bg-light rounded-4 border h-100">
              <span class="section-subtitle">My Approach</span>
              <h2 class="h3 fw-bold mb-3 text-navy">
                A Disciplined, Four-Pillar Methodology
              </h2>
              <div class="d-flex align-items-start gap-3 mb-3">
                <div class="badge bg-teal rounded-circle p-2 mt-1"><i class="bi bi-1-circle text-white"></i></div>
                <div>
                  <h3 class="h6 fw-bold mb-1">Understand Business Goals</h3>
                  <p class="small text-secondary mb-0">Every engagement begins by examining your customer economics, sales cycles, and commercial priorities.</p>
                </div>
              </div>
              <div class="d-flex align-items-start gap-3 mb-3">
                <div class="badge bg-teal rounded-circle p-2 mt-1"><i class="bi bi-2-circle text-white"></i></div>
                <div>
                  <h3 class="h6 fw-bold mb-1">Select Suitable Tools & Channels</h3>
                  <p class="small text-secondary mb-0">We focus on channels where your buyers actually spend time, avoiding shiny object syndrome.</p>
                </div>
              </div>
              <div class="d-flex align-items-start gap-3 mb-3">
                <div class="badge bg-teal rounded-circle p-2 mt-1"><i class="bi bi-3-circle text-white"></i></div>
                <div>
                  <h3 class="h6 fw-bold mb-1">Implement a Focused Strategy</h3>
                  <p class="small text-secondary mb-0">Execute targeted campaigns, automation, and content workflows with high quality standards.</p>
                </div>
              </div>
              <div class="d-flex align-items-start gap-3">
                <div class="badge bg-teal rounded-circle p-2 mt-1"><i class="bi bi-4-circle text-white"></i></div>
                <div>
                  <h3 class="h6 fw-bold mb-1">Improve Based on Real Results</h3>
                  <p class="small text-secondary mb-0">Refine campaigns continuously based on qualified inquiries, conversion rates, and revenue impact.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Core Values -->
    <section class="section-padding" aria-labelledby="values-heading">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-subtitle">Guiding Principles</span>
          <h2 id="values-heading" class="section-title">The Values That Shape My Work</h2>
          <p class="section-desc mx-auto">
            Honest partnerships are built on transparency, pragmatic advice, and accountable progress.
          </p>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="custom-card text-center">
              <div class="card-icon-box mx-auto">
                <i class="bi bi-chat-heart"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Clear Communication</h3>
              <p class="text-secondary small mb-0">Plain English explanations without confusing marketing jargon. You always know exactly what is being done and why.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
            <div class="custom-card text-center">
              <div class="card-icon-box mx-auto">
                <i class="bi bi-tools"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Practical Advice</h3>
              <p class="text-secondary small mb-0">Actionable recommendations that work within your team's real budget, schedule, and operational capacity.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
            <div class="custom-card text-center">
              <div class="card-icon-box mx-auto">
                <i class="bi bi-eye"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Full Transparency</h3>
              <p class="text-secondary small mb-0">Direct access to your advertising accounts, tool configurations, and honest reporting on what is working and what needs refinement.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.4s">
            <div class="custom-card text-center">
              <div class="card-icon-box mx-auto">
                <i class="bi bi-bar-chart-line"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Measurable Progress</h3>
              <p class="text-secondary small mb-0">We prioritize commercial results—qualified appointments, conversion rates, and revenue—rather than superficial vanity likes.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Professional Background & Experience Placeholders -->
    <!-- Instruction Requirement: Editable placeholders for background, experience, qualifications, and personal story without inventing claims -->
    <section class="section-padding bg-white" aria-labelledby="background-heading">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-subtitle">Background & Credentials</span>
          <h2 id="background-heading" class="section-title">Professional Background & Story</h2>
          <p class="section-desc mx-auto">
            A transparent overview of experience, qualifications, and journey.
          </p>
        </div>

        <div class="row g-4 justify-content-center">
          <div class="col-lg-10">
            
            <!-- EDITABLE PLACEHOLDER: Personal Story & Journey -->
            <div class="card border-0 bg-light p-4 p-md-5 rounded-4 mb-4">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="h4 fw-bold text-navy mb-0">
                  <i class="bi bi-book-half text-teal me-2"></i>Personal Story & Journey
                </h3>
                <!-- <span class="badge bg-secondary-subtle text-secondary small">Editable Section</span> -->
              </div>
              <p class="text-secondary">
                <!-- EDITABLE CONTENT: Add your personal story and industry background below -->
                My focus on AI-assisted marketing grew from seeing passionate business owners struggle with repetitive digital tasks while trying to stay afloat in competitive markets. By combining fundamental marketing principles—such as sharp value positioning, buyer psychology, and high-intent channel focus—with newly accessible generative AI tooling, I help business owners run effective digital campaigns with speed and precision.
              </p>
              <p class="text-secondary mb-0">
                Based in Kathmandu, Nepal, I collaborate with local and international businesses looking to systematize their lead generation and scale their presence sustainably.
              </p>
            </div>

            <!-- EDITABLE PLACEHOLDER: Experience & Qualifications -->
            <div class="row g-4">
              <div class="col-md-6">
                <div class="card border-0 bg-light p-4 rounded-4 h-100">
                  <div class="mb-3">
                    <h4 class="h5 fw-bold text-navy mb-0">
                      <i class="bi bi-briefcase-fill text-teal me-2"></i>Core Expertise Areas
                    </h4>
                  </div>
                  <ul class="deliverable-list">
                    <li>AI-Assisted Digital Marketing & Growth Strategy</li>
                    <li>Search Engine Optimization & Intent-Driven Content</li>
                    <li>Paid Campaign Management (Google & Meta Ads)</li>
                    <li>Email Automation & Customer Nurturing Workflows</li>
                    <li>AI Tool Deployment & Prompt Engineering for Teams</li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card border-0 bg-light p-4 rounded-4 h-100">
                  <div class="mb-3">
                    <h4 class="h5 fw-bold text-navy mb-0">
                      <i class="bi bi-cpu-fill text-teal me-2"></i>Applied AI & Marketing Stack
                    </h4>
                  </div>
                  <ul class="deliverable-list">
                    <li>Meta Ads Manager, Google Ads & Performance Scaling</li>
                    <li>Google Analytics 4, Tag Manager & Attribution Tracking</li>
                    <li>Claude & ChatGPT Advanced Prompting & Content Workflows</li>
                    <li>Make.com, Zapier & Multi-Step CRM Automations</li>
                    <li>SEMrush, Ahrefs & Search Intent Architecture</li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Closing Consultation CTA -->
    <section class="section-padding bg-light border-top" aria-labelledby="about-cta-heading">
      <div class="container text-center">
        <div class="row justify-content-center">
          <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.8s">
            <span class="section-subtitle">Let's Connect</span>
            <h2 id="about-cta-heading" class="h1 fw-bold mb-3 text-navy">
              Let's Discuss How Practical AI Can Grow Your Business
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
