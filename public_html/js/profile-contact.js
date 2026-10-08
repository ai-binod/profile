/**
 * ====================================================================
 * Binod Sthapit - AI Marketing Expert Portfolio
 * Contact Form Handler: Verified Server-Side Dispatch, CSRF Protection,
 * Real Validation Feedback & Google Calendar Integration
 * ====================================================================
 */

function initContactForm() {
  const contactForm = document.getElementById("consultationContactForm");
  if (!contactForm || contactForm.dataset.initialized) return;
  contactForm.dataset.initialized = "true";

  const formStatus = document.getElementById("contactFormStatus");
  const submitBtn = contactForm.querySelector("button[type='submit']");
  const originalBtnHtml = submitBtn ? submitBtn.innerHTML : "<span>Send Inquiry</span>";

  // Helper to escape HTML characters in dynamic strings
  function escapeHtml(str) {
    if (!str) return "";
    return String(str)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // Clear specific server field errors
  function clearFieldErrors() {
    contactForm.querySelectorAll(".is-invalid").forEach((el) => {
      el.classList.remove("is-invalid");
    });
  }

  // Display specific server field error
  function setFieldError(fieldName, message) {
    const input = contactForm.querySelector(`[name="${fieldName}"]`);
    if (input) {
      input.classList.add("is-invalid");
      const feedback = input.parentNode.querySelector(".invalid-feedback");
      if (feedback) {
        feedback.textContent = message;
      }
    }
  }

  contactForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    clearFieldErrors();

    // Check client-side HTML5 validation first
    if (!contactForm.checkValidity()) {
      contactForm.classList.add("was-validated");
      const firstInvalid = contactForm.querySelector(":invalid");
      if (firstInvalid) firstInvalid.focus();
      return;
    }

    contactForm.classList.remove("was-validated");

    // Gather form input data
    const name = (document.getElementById("contactName")?.value || "").trim();
    const email = (document.getElementById("contactEmail")?.value || "").trim();
    const businessName = (document.getElementById("contactBusiness")?.value || "").trim();
    const websiteUrl = (document.getElementById("contactWebsite")?.value || "").trim();
    const service = (document.getElementById("contactService")?.value || "").trim();
    const message = (document.getElementById("contactMessage")?.value || "").trim();
    const hpWebsite = (contactForm.querySelector("[name='_hp_website']")?.value || "").trim();

    // Retrieve CSRF token
    const csrfToken =
      contactForm.querySelector("input[name='_csrf_token']")?.value ||
      document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") ||
      "";

    const receiverEmail = window.SITE_CONFIG?.personal?.email || "connect@binodsthapit.com";
    const calendarUrl = window.SITE_CONFIG?.personal?.bookingUrl || "https://calendar.app.google/n4R95r7LdRjVfTHD9";

    // Format fallback subject & body for mailto dispatch
    const subjectText = `Google Calendar - Book a Call: ${service} - ${businessName} (${name})`;
    const subjectAndLinkText = `Subject: ${subjectText}\nGoogle Calendar Link: ${calendarUrl}`;
    const bodyText =
`Hello Binod,

I would like to book a consultation call regarding digital marketing and AI growth solutions for my business.

--- CONTACT & BUSINESS DETAILS ---
• Name: ${name}
• Email: ${email}
• Business Name: ${businessName}
• Website URL: ${websiteUrl || "Not provided"}
• Primary Service of Interest: ${service}

--- GOAL & CURRENT CHALLENGE ---
${message}

--- GOOGLE CALENDAR BOOKING LINK ---
Schedule directly on Google Calendar: ${calendarUrl}

---
Sent via portfolio consultation form at binodsthapit.com.np`;

    const encodedSubject = encodeURIComponent(subjectText);
    const encodedBody = encodeURIComponent(bodyText);
    const mailtoUrl = `mailto:${receiverEmail}?subject=${encodedSubject}&body=${encodedBody}`;

    // Target endpoint
    const postUrl = contactForm.getAttribute("action") || "/contact";

    // Set submitting UI state
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        <span>Sending Inquiry...</span>
      `;
    }

    try {
      const response = await fetch(postUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
          _csrf_token: csrfToken,
          _hp_website: hpWebsite,
          name: name,
          email: email,
          businessName: businessName,
          websiteUrl: websiteUrl,
          service: service,
          message: message,
        }),
      });

      const data = await response.json().catch(() => null);

      if (!response.ok) {
        // Validation Error (422)
        if (response.status === 422 && data && data.errors) {
          let firstErrorField = null;
          for (const [field, errorMsg] of Object.entries(data.errors)) {
            setFieldError(field, errorMsg);
            if (!firstErrorField) firstErrorField = field;
          }

          if (firstErrorField) {
            const firstEl = contactForm.querySelector(`[name="${firstErrorField}"]`);
            if (firstEl) firstEl.focus();
          }

          if (formStatus) {
            formStatus.innerHTML = `
              <div class="alert alert-danger border-0 shadow-sm p-3 mb-4" role="alert">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
                  <div><strong>Please check your entries:</strong> ${escapeHtml(data.message || "Invalid input detected.")}</div>
                </div>
              </div>
            `;
          }
          return;
        }

        // Rate Limit Exceeded (429)
        if (response.status === 429) {
          if (formStatus) {
            formStatus.innerHTML = `
              <div class="alert alert-warning border-0 shadow-sm p-4 mb-4" role="alert">
                <div class="d-flex align-items-start gap-3">
                  <i class="bi bi-clock-history fs-3 text-warning"></i>
                  <div>
                    <h5 class="fw-bold text-navy mb-1">Rate Limit Active</h5>
                    <p class="small text-secondary mb-2">${escapeHtml(data?.message || "Please wait before submitting another request.")}</p>
                    <a href="${calendarUrl}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-teal btn-sm">
                      <i class="bi bi-calendar-event me-1"></i> Book via Google Calendar Instead
                    </a>
                  </div>
                </div>
              </div>
            `;
          }
          return;
        }

        // CSRF Token Mismatch (403)
        if (response.status === 403) {
          if (formStatus) {
            formStatus.innerHTML = `
              <div class="alert alert-warning border-0 shadow-sm p-3 mb-4" role="alert">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-shield-exclamation fs-5 text-warning"></i>
                  <div>Session security token expired. Please <a href="javascript:location.reload()" class="alert-link">refresh this page</a> and try again.</div>
                </div>
              </div>
            `;
          }
          return;
        }
      }

      // Success or Unconfigured Response
      const isDelivered = data && data.status === "delivered";
      const isUnconfigured = data && data.status === "unconfigured";

      if (formStatus) {
        if (isDelivered) {
          formStatus.innerHTML = `
            <div class="alert alert-success border-0 shadow-sm p-4 mb-4" role="alert">
              <div class="d-flex align-items-start gap-3">
                <i class="bi bi-check-circle-fill text-success fs-2 mt-1"></i>
                <div class="w-100">
                  <h5 class="fw-bold text-navy mb-1">Inquiry Sent Successfully!</h5>
                  <p class="text-secondary small mb-3">
                    Thank you, <strong>${escapeHtml(name)}</strong>. Your inquiry has been received. I review all submissions personally and reply within 24–48 business hours.
                  </p>
                  <div class="p-3 bg-white rounded border">
                    <p class="small text-muted mb-2">Want to guarantee a dedicated discussion slot right now?</p>
                    <a href="${calendarUrl}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-cta btn-sm">
                      <i class="bi bi-calendar-plus me-1"></i> Book Immediate Google Calendar Slot
                    </a>
                  </div>
                </div>
              </div>
            </div>
          `;
          contactForm.reset();
        } else {
          // Unconfigured or Simulated State: Honest feedback with immediate mailto & calendar options
          formStatus.innerHTML = `
            <div class="alert alert-info border-0 shadow-sm p-4 mb-4" role="alert">
              <div class="d-flex align-items-start gap-3">
                <i class="bi bi-calendar-check-fill text-teal fs-2 mt-1"></i>
                <div class="w-100">
                  <h5 class="fw-bold text-navy mb-1">Inquiry Validated & Ready to Send</h5>
                  <p class="text-secondary small mb-2">
                    ${escapeHtml(data?.message || "Direct server delivery transport is currently in setup mode.")}
                    <br>
                    Your consultation inquiry details have been preserved and formatted with subject:
                    <br>
                    <span class="d-inline-block bg-white text-navy fw-semibold px-2 py-1 rounded border mt-1">
                      ${escapeHtml(subjectText)}
                    </span>
                  </p>

                  <!-- Google Calendar Direct Booking Card -->
                  <div class="p-3 bg-white rounded border my-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-1">
                      <span class="small fw-bold text-navy">
                        <i class="bi bi-calendar-event text-teal me-1"></i> Google Calendar Booking Link:
                      </span>
                      <a href="${calendarUrl}" target="_blank" rel="noopener noreferrer" class="small fw-semibold text-teal text-decoration-none">
                        Open Google Calendar <i class="bi bi-box-arrow-up-right ms-1"></i>
                      </a>
                    </div>
                    <div class="small text-muted text-break">${calendarUrl}</div>
                  </div>

                  <!-- Action Buttons -->
                  <div class="d-flex flex-wrap gap-2 mt-3">
                    <a href="${calendarUrl}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-cta btn-sm">
                      <i class="bi bi-calendar-plus me-1"></i> Book a Call on Google Calendar
                    </a>
                    <a href="${mailtoUrl}" class="btn btn-outline-secondary btn-sm" id="launchMailtoBtn">
                      <i class="bi bi-envelope-arrow-up me-1"></i> Open in Email App
                    </a>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="copySubjectLinkBtn">
                      <i class="bi bi-clipboard-check me-1"></i> Copy Subject & Calendar Link
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="copyInquiryTextBtn">
                      <i class="bi bi-clipboard-data me-1"></i> Copy Full Message
                    </button>
                  </div>
                </div>
              </div>
            </div>
          `;

          // Setup copy button handlers
          const copySubjectBtn = document.getElementById("copySubjectLinkBtn");
          if (copySubjectBtn) {
            copySubjectBtn.addEventListener("click", () => {
              navigator.clipboard.writeText(subjectAndLinkText).then(() => {
                copySubjectBtn.innerHTML = `<i class="bi bi-check2 text-success me-1"></i> Subject & Link Copied!`;
                setTimeout(() => {
                  copySubjectBtn.innerHTML = `<i class="bi bi-clipboard-check me-1"></i> Copy Subject & Calendar Link`;
                }, 3000);
              });
            });
          }

          const copyInquiryBtn = document.getElementById("copyInquiryTextBtn");
          if (copyInquiryBtn) {
            copyInquiryBtn.addEventListener("click", () => {
              navigator.clipboard.writeText(bodyText).then(() => {
                copyInquiryBtn.innerHTML = `<i class="bi bi-check2 text-success me-1"></i> Message Copied!`;
                setTimeout(() => {
                  copyInquiryBtn.innerHTML = `<i class="bi bi-clipboard-data me-1"></i> Copy Full Message`;
                }, 3000);
              });
            });
          }

          // Also launch mail client
          window.location.href = mailtoUrl;
        }
      }

    } catch (err) {
      // Fallback on network failure
      console.warn("Server submission error, falling back to client mailto:", err);
      window.location.href = mailtoUrl;
    } finally {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
      }
    }
  });
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initContactForm);
} else {
  initContactForm();
}
