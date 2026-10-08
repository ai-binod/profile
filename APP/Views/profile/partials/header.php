<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ htmlspecialchars($pageTitle ?? 'Binod Sthapit | AI Marketing Expert for Small & Medium Businesses', ENT_QUOTES, 'UTF-8') }}</title>
  <meta name="description" content="{{ htmlspecialchars($metaDesc ?? 'Scale your business with AI-driven digital marketing solutions.', ENT_QUOTES, 'UTF-8') }}">
  <meta name="keywords" content="AI marketing, digital marketing expert, Kathmandu Nepal, SME lead generation, marketing automation, business growth">
  <meta name="author" content="Binod Sthapit">
  
  {{ csrf_meta() }}

  <!-- Canonical URL -->
  <link rel="canonical" href="{{ htmlspecialchars($canonicalUrl ?? pathto(($activeTab ?? '') === 'home' ? '' : ($activeTab ?? '')), ENT_QUOTES, 'UTF-8') }}">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ htmlspecialchars($canonicalUrl ?? pathto(($activeTab ?? '') === 'home' ? '' : ($activeTab ?? '')), ENT_QUOTES, 'UTF-8') }}">
  <meta property="og:title" content="{{ htmlspecialchars($pageTitle ?? 'Binod Sthapit | AI Marketing Expert', ENT_QUOTES, 'UTF-8') }}">
  <meta property="og:description" content="{{ htmlspecialchars($metaDesc ?? 'Scale your business with practical AI tools.', ENT_QUOTES, 'UTF-8') }}">
  <meta property="og:image" content="{{ pathto('images/profile/og-image.svg') }}">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ htmlspecialchars($canonicalUrl ?? pathto(($activeTab ?? '') === 'home' ? '' : ($activeTab ?? '')), ENT_QUOTES, 'UTF-8') }}">
  <meta name="twitter:title" content="{{ htmlspecialchars($pageTitle ?? 'Binod Sthapit | AI Marketing Expert', ENT_QUOTES, 'UTF-8') }}">
  <meta name="twitter:description" content="{{ htmlspecialchars($metaDesc ?? 'Scale your business with practical AI tools.', ENT_QUOTES, 'UTF-8') }}">
  <meta name="twitter:image" content="{{ pathto('images/profile/og-image.svg') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ pathto('images/profile/favicon.svg') }}">
  <link rel="apple-touch-icon" href="{{ pathto('images/profile/apple-touch-icon.png') }}">

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS (local ICTM) & Bootstrap Icons -->
  <link rel="stylesheet" href="{{ pathto('css/bootstrap5.3.8.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Animate.css (local scoped copy) -->
  <link rel="stylesheet" href="{{ pathto('css/animate.min.css') }}">

  <!-- DataTables Bootstrap 5 CSS (when needed) -->
  <?php if (($activeTab ?? '') === 'services') { ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
  <?php } ?>

  <!-- Custom Profile Stylesheet -->
  <link rel="stylesheet" href="{{ pathto('css/profile.css') }}">

  <!-- Structured Data: Schema.org -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "Binod Sthapit",
    "description": "AI Marketing Expert helping small and medium business owners grow online, generate qualified leads, and increase sales.",
    "url": "{{ pathto('profile') }}",
    "email": "connect@binodsthapit.com",
    "telephone": "+977 9849837637",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Kathmandu",
      "addressCountry": "Nepal"
    },
    "priceRange": "$$",
    "areaServed": "Worldwide"
  }
  </script>
</head>
<body>
  <!-- Top Scroll Progress Bar -->
  <div class="scroll-progress-bar" id="scrollProgressBar" aria-hidden="true"></div>

  <!-- Accessible Skip Link -->
  <a href="#main-content" class="skip-to-content">Skip to main content</a>
