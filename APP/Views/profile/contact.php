<?php
/**
 * View template: profile/contact
 */
?>
{{ $this->view('profile/partials/header', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
{{ $this->view('profile/partials/navbar', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}

<main id="main-content">

    <!-- Welcoming Hero -->
    <section class="hero-section" aria-labelledby="contact-hero-heading">
      <div class="container pt-4">
        <div class="row align-items-center">
          <div class="col-lg-8 wow fadeInLeft" data-wow-duration="0.8s">
            <div class="badge-tag">
              <i class="bi bi-chat-dots-fill"></i>
              <span>Direct Conversation</span>
            </div>
            <h1 id="contact-hero-heading" class="hero-headline">
              Let's Discuss Your Business <span class="text-gradient">Goals & Challenges</span>
            </h1>
            <p class="hero-lead">
              Whether you are looking to generate consistent customer inquiries, implement practical AI tools, or fix an underperforming digital campaign, I am here to help you find the right path forward.
            </p>
          </div>
          <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 wow fadeInRight" data-wow-duration="0.8s">
            <div class="p-3 bg-white rounded-3 border text-start shadow-sm">
              <div class="fw-bold text-navy small mb-1"><i class="bi bi-shield-check text-teal me-1"></i>No Obligation Discovery</div>
              <p class="small text-muted mb-0">Direct 1-on-1 dialogue with an experienced practitioner. Transparent feedback with zero sales pressure.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Prominent Consultation & Contact Form Section -->
    <section class="section-padding bg-white" id="consultation" aria-labelledby="consultation-heading">
      <div class="container">
        
        <!-- Consultation Offer Highlight -->
        <div class="p-4 p-md-5 bg-light rounded-4 border mb-5">
          <div class="row align-items-center g-4">
            <div class="col-lg-8">
              <span class="badge bg-teal text-white mb-2 px-3 py-2 fw-semibold">Complimentary 30-Minute Session</span>
              <h2 id="consultation-heading" class="h3 fw-bold text-navy mb-2">
                Book a Free Consultation Call
              </h2>
              <p class="text-secondary mb-0">
                <strong>During your free consultation, I’ll analyze your business and create a customized digital marketing plan you can start implementing immediately.</strong>
              </p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <div id="bookingLinkContainer">
                <!-- Direct Google Calendar Appointment Scheduling -->
                <p class="small text-muted mb-2">Prefer instant calendar scheduling?</p>
                <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-outline-teal booking-cta-btn">
                  <i class="bi bi-calendar-event me-1"></i> Book via Google Calendar
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Form and Contact Details Columns -->
        <div class="row g-5">
          
          <!-- Column 1: Contact Form -->
          <div class="col-lg-7">
            <div class="form-card">
              <h3 class="h4 fw-bold text-navy mb-3">Send a Consultation Inquiry</h3>
              <p class="text-secondary small mb-4">
                Fill in the details below to tell me about your business. I personally review all submissions and reply within 24–48 business hours.
              </p>

              <!-- Status Alert Area for Honest Feedback -->
              <div id="contactFormStatus" aria-live="polite">
                <?php if (isset($contactStatus) && is_array($contactStatus)) { ?>
                  <?php if (!empty($contactStatus['success'])) { ?>
                    <div class="alert alert-success border-0 shadow-sm p-4 mb-4" role="alert">
                      <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-check-circle-fill text-success fs-3 mt-1"></i>
                        <div>
                          <h5 class="fw-bold text-navy mb-1">Inquiry Submitted Successfully</h5>
                          <p class="text-secondary small mb-0">{{ htmlspecialchars($contactStatus['message'] ?? '', ENT_QUOTES, 'UTF-8') }}</p>
                        </div>
                      </div>
                    </div>
                  <?php } elseif (($contactStatus['status'] ?? '') === 'unconfigured') { ?>
                    <div class="alert alert-info border-0 shadow-sm p-4 mb-4" role="alert">
                      <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-info-circle-fill text-teal fs-3 mt-1"></i>
                        <div>
                          <h5 class="fw-bold text-navy mb-1">Inquiry Validated & Ready</h5>
                          <p class="text-secondary small mb-0">{{ htmlspecialchars($contactStatus['message'] ?? '', ENT_QUOTES, 'UTF-8') }}</p>
                        </div>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="alert alert-danger border-0 shadow-sm p-4 mb-4" role="alert">
                      <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-3 mt-1"></i>
                        <div>
                          <h5 class="fw-bold text-navy mb-1">Submission Notice</h5>
                          <p class="text-secondary small mb-1">{{ htmlspecialchars($contactStatus['message'] ?? '', ENT_QUOTES, 'UTF-8') }}</p>
                          <?php if (!empty($contactStatus['errors']) && is_array($contactStatus['errors'])) { ?>
                            <ul class="small mb-0 ps-3">
                              <?php foreach ($contactStatus['errors'] as $err) { ?>
                                <li>{{ htmlspecialchars((string) $err, ENT_QUOTES, 'UTF-8') }}</li>
                              <?php } ?>
                            </ul>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>

              <form id="consultationContactForm" action="{{ pathto('contact') }}" method="POST" novalidate>
                {{ csrf_field() }}
                <!-- Anti-abuse Honeypot Field -->
                <div style="display:none !important;" aria-hidden="true">
                  <label for="hpWebsite">Leave this field blank</label>
                  <input type="text" id="hpWebsite" name="_hp_website" tabindex="-1" autocomplete="off">
                </div>
                <div class="row g-3">
                  <!-- Name -->
                  <div class="col-md-6">
                    <label for="contactName" class="form-label">Your Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactName" name="name" required placeholder="e.g., John Doe" autocomplete="name">
                    <div class="invalid-feedback">Please provide your full name.</div>
                  </div>

                  <!-- Email -->
                  <div class="col-md-6">
                    <label for="contactEmail" class="form-label">Work Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="contactEmail" name="email" required placeholder="e.g., john@company.com" autocomplete="email">
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>

                  <!-- Business Name -->
                  <div class="col-md-6">
                    <label for="contactBusiness" class="form-label">Business / Brand Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactBusiness" name="businessName" required placeholder="e.g., Apex Solutions" autocomplete="organization">
                    <div class="invalid-feedback">Please specify your business or brand name.</div>
                  </div>

                  <!-- Website URL -->
                  <div class="col-md-6">
                    <label for="contactWebsite" class="form-label">Website URL <span class="text-muted small">(Optional)</span></label>
                    <input type="url" class="form-control" id="contactWebsite" name="websiteUrl" placeholder="https://yourwebsite.com">
                    <div class="invalid-feedback">Please enter a valid URL (starting with http:// or https://).</div>
                  </div>

                  <!-- Service of Interest -->
                  <div class="col-12">
                    <label for="contactService" class="form-label">Service of Primary Interest</label>
                    <select class="form-select" id="contactService" name="service">
                      <option value="General Discovery & Growth Strategy" selected>General Discovery & Growth Strategy</option>
                      <option value="AI-Powered Digital Marketing Strategy">AI-Powered Digital Marketing Strategy</option>
                      <option value="Social Media Marketing & Content Creation">Social Media Marketing & Content Creation</option>
                      <option value="Search Engine Optimization & AI Content">Search Engine Optimization & AI Content</option>
                      <option value="Paid Advertising Campaign Management">Paid Advertising Campaign Management</option>
                      <option value="Email Marketing & Marketing Automation">Email Marketing & Marketing Automation</option>
                      <option value="Lead Generation & Conversion Optimization">Lead Generation & Conversion Optimization</option>
                      <option value="AI Tools Consulting & Implementation">AI Tools Consulting & Implementation</option>
                    </select>
                  </div>

                  <!-- Message -->
                  <div class="col-12">
                    <label for="contactMessage" class="form-label">What is your primary marketing goal or current challenge? <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="contactMessage" name="message" rows="4" required placeholder="Tell me a bit about your target customer, what you have tried so far, and what you would like to achieve..."></textarea>
                    <div class="invalid-feedback">Please describe your business goal or challenge.</div>
                  </div>

                  <!-- Privacy Notice -->
                  <div class="col-12">
                    <div class="form-notice-sensitive">
                      <i class="bi bi-shield-lock-fill text-muted me-1"></i>
                      <em>Privacy Notice: Please do not include sensitive financial details, passwords, or confidential account credentials in this form.</em>
                    </div>
                  </div>

                  <!-- Submit CTA Button -->
                  <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary-cta w-100 py-3">
                      <span>Send Inquiry via Email App</span>
                      <i class="bi bi-send-fill"></i>
                    </button>
                    <p class="small text-muted text-center mt-2 mb-0">Directly opens your email client pre-filled • Zero obligation • 100% confidential</p>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- Column 2: Direct Contact Information -->
          <div class="col-lg-5">
            <div class="contact-info-card">
              <span class="badge bg-teal text-white mb-3 px-3 py-1">Direct Contact</span>
              <h3 class="h4 fw-bold mb-3">Direct Communication Channels</h3>
              <p class="text-white-50 mb-4">
                Prefer to reach out directly? Feel free to send an email, call, or initiate a WhatsApp message.
              </p>

              <!-- Location -->
              <div class="contact-detail-item">
                <div class="contact-icon-pill">
                  <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="contact-detail-text">
                  <h4 class="h6 fw-bold mb-1 text-white">Service Location</h4>
                  <p class="mb-0 text-white-50">Kathmandu, Nepal</p>
                  <small class="text-teal">Collaborating with clients locally & globally</small>
                </div>
              </div>

              <!-- Email -->
              <div class="contact-detail-item">
                <div class="contact-icon-pill">
                  <i class="bi bi-envelope-fill"></i>
                </div>
                <div class="contact-detail-text">
                  <h4 class="h6 fw-bold mb-1 text-white">Email Address</h4>
                  <p class="mb-0"><a href="mailto:connect@binodsthapit.com">connect@binodsthapit.com</a></p>
                  <small class="text-white-50">Response within 24–48 business hours</small>
                </div>
              </div>

              <!-- Phone / WhatsApp -->
              <div class="contact-detail-item">
                <div class="contact-icon-pill">
                  <i class="bi bi-whatsapp"></i>
                </div>
                <div class="contact-detail-text">
                  <h4 class="h6 fw-bold mb-1 text-white">WhatsApp & Phone</h4>
                  <p class="mb-0"><a href="https://wa.me/9779849837637" target="_blank" rel="noopener noreferrer">+977 9849837637</a></p>
                  <small class="text-white-50">Available Sun–Fri, 9:00 AM – 6:00 PM NPT</small>
                </div>
              </div>

              <!-- What to expect banner -->
              <div class="p-3 bg-white bg-opacity-10 rounded-3 border border-white border-opacity-25 mt-4">
                <h4 class="h6 fw-bold text-white mb-2"><i class="bi bi-clock-history text-teal me-2"></i>Consultation Expectations:</h4>
                <ul class="text-white-50 small ps-3 mb-0">
                  <li class="mb-1">Detailed analysis of current website & channels</li>
                  <li class="mb-1">Specific AI tools tailored to your workflow</li>
                  <li class="mb-1">Clear digital marketing plan you can use right away</li>
                </ul>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>

{{ $this->view('profile/partials/footer', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'activeTab' => $activeTab ?? '']) }}
