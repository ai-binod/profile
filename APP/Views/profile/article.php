<?php
/**
 * View template: profile/article (Single Article Reader)
 */
?>
{{ $this->view('profile/partials/header', ['pageTitle' => $pageTitle ?? '', 'metaDesc' => $metaDesc ?? '', 'canonicalUrl' => $canonicalUrl ?? '', 'activeTab' => 'blog']) }}
{{ $this->view('profile/partials/navbar', ['activeTab' => 'blog']) }}

<main id="main-content" class="article-reader">
  {{ $article['body'] ?? '' }}
</main>

{{ $this->view('profile/partials/footer', ['activeTab' => 'blog']) }}
