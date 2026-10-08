  <!-- Shared Footer -->
  <footer class="footer-custom" aria-label="Site footer">
    <div class="container">
      <div class="row g-4 mb-5">
        <div class="col-lg-5 pe-lg-5">
          <img src="{{ pathto('images/profile/logo-footer.png') }}" alt="Binod Sthapit" width="858" height="627" loading="lazy" class="footer-logo brand-logo-img mb-3">
          <p class="text-white-50 small mb-3">
            AI Marketing Expert helping small and medium businesses build high-converting digital marketing systems, automate routine growth tasks, and turn online attention into paying clients.
          </p>
          <div class="social-links-container d-flex gap-2" id="footerSocialLinks">
            <!-- Dynamic Social Links injected by script -->
          </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
          <h5>Quick Links</h5>
          <ul class="footer-links">
            <li><a href="{{ pathto('') }}">Home</a></li>
            <li><a href="{{ pathto('about') }}">About Me</a></li>
            <li><a href="{{ pathto('services') }}">All Services</a></li>
            <li><a href="{{ pathto('blog') }}">AI Blog</a></li>
            <li><a href="{{ pathto('contact') }}">Contact & Booking</a></li>
          </ul>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
          <h5>Services</h5>
          <ul class="footer-links">
            <li><a href="{{ pathto('services#ai-marketing-strategy') }}">AI Strategy</a></li>
            <li><a href="{{ pathto('services#paid-ads-management') }}">Paid Advertising</a></li>
            <li><a href="{{ pathto('services#seo-ai-content') }}">SEO & Content</a></li>
            <li><a href="{{ pathto('services#email-marketing-automation') }}">Automation</a></li>
            <li><a href="{{ pathto('services#ai-tools-consulting') }}">AI Consulting</a></li>
          </ul>
        </div>
        <div class="col-md-6 col-lg-3">
          <h5>Get in Touch</h5>
          <p class="small mb-2"><i class="bi bi-geo-alt-fill text-teal me-2"></i>Kathmandu, Nepal</p>
          <p class="small mb-2"><i class="bi bi-envelope-fill text-teal me-2"></i><a href="mailto:connect@binodsthapit.com">connect@binodsthapit.com</a></p>
          <p class="small mb-3"><i class="bi bi-whatsapp text-teal me-2"></i><a href="https://wa.me/9779849837637" target="_blank" rel="noopener noreferrer">+977 9849837637</a></p>
          <a href="https://calendar.app.google/n4R95r7LdRjVfTHD9" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light btn-sm booking-cta-btn">
            Book a Free Consultation Call
          </a>
        </div>
      </div>
      <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center">
        <p class="mb-0">&copy; <span class="current-year">{{ date('Y') }}</span> Binod Sthapit. All rights reserved.</p>
        <p class="mb-0 text-muted small">Based in Kathmandu, Nepal • Serving Businesses Globally</p>
      </div>
    </div>
  </footer>

  <!-- Framework Core Scripts (local ICTM) -->
  <script src="{{ pathto('js/jquery3.7.1.min.js') }}"></script>
  <script src="{{ pathto('js/bootstrap5.3.8.bundle.min.js') }}"></script>
  
  <?php if (($activeTab ?? '') === 'services') { ?>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ pathto('js/profile-datatables.js') }}"></script>
  <?php } ?>

  <script src="{{ pathto('js/wow.min.js') }}"></script>
  <script src="{{ pathto('js/profile-config.js') }}"></script>

  <?php if (($activeTab ?? '') === 'blog') { ?>
  <script src="{{ pathto('js/profile-articles-data.js') }}"></script>
  <script src="{{ pathto('js/profile-blog.js') }}"></script>
  <?php } ?>

  <?php if (($activeTab ?? '') === 'contact') { ?>
  <script src="{{ pathto('js/profile-contact.js') }}"></script>
  <?php } ?>

  <script src="{{ pathto('js/profile-main.js') }}"></script>
</body>
</html>
