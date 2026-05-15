<?php
// All site vars ($site_name, $logo_directory, $linkedinLink, $description, etc.)
// are already available from index.php via settings_website_info.
$mmFooterPages  = selectContentAsc($conn, 'panel_mm_pages', ['visibility' => 'show'], 'input_order', 15);
$podcastLink    = $websiteInfo[0]['input_podcast_link']     ?? 'https://gtle.show';
$applePodcast   = $websiteInfo[0]['input_apple_podcast']    ?? 'https://podcasts.apple.com/us/podcast/gaining-the-technology-leadership-edge/id1664607772';
$bookSessionUrl = $websiteInfo[0]['input_book_session_url'] ?? 'https://GetYourVirtualCTO.com/StrategySession';
$site_tagline   = $websiteInfo[0]['input_tagline']          ?? 'Fractional CTO';
?>

  <!-- ── Footer ─────────────────────────────────────────────── -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">

        <!-- Brand — uses settings_website_info via global vars -->
        <div class="footer-brand">
          <a href="/" class="nav-logo">
            <div data-admc-image="settings_website_info"
                 data-admc-id="<?= $websiteInfo[0]['id'] ?? 1 ?>">
              <img src="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
                   class="logo-img">
            </div>
            <div class="logo-text">
              <span class="brand"><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></span>
              <span class="tagline"><?= htmlspecialchars($site_tagline, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
          </a>
          <p data-admc-manage="settings_website_info"
             data-admc-id="<?= $websiteInfo[0]['id'] ?? 1 ?>">
            <?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>
          </p>
          <div class="footer-socials">
            <?php if (!empty($linkedinLink)): ?>
              <a href="<?= htmlspecialchars($linkedinLink, ENT_QUOTES, 'UTF-8') ?>"
                 aria-label="LinkedIn" target="_blank" rel="noopener">
                <i class="ph ph-linkedin-logo"></i>
              </a>
            <?php endif; ?>
            <a href="<?= htmlspecialchars($podcastLink, ENT_QUOTES, 'UTF-8') ?>"
               aria-label="GTLE Podcast" target="_blank" rel="noopener">
              <i class="ph ph-globe"></i>
            </a>
            <a href="<?= htmlspecialchars($applePodcast, ENT_QUOTES, 'UTF-8') ?>"
               aria-label="Apple Podcasts" target="_blank" rel="noopener">
              <i class="ph ph-apple-logo"></i>
            </a>
          </div>
        </div>

        <!-- Quick Links — DB-driven -->
        <div class="footer-col">
          <h4>Quick Links</h4>
          <ul data-admc-tb="panel_mm_pages">
            <?php foreach ($mmFooterPages as $fp):
              if ($fp['input_link'] === '/book-session') continue;
            ?>
              <li>
                <a href="<?= htmlspecialchars($fp['input_link'], ENT_QUOTES, 'UTF-8') ?>"
                   data-admc-manage="panel_mm_pages"
                   data-admc-id="<?= $fp['id'] ?>">
                  <?= htmlspecialchars($fp['input_name'], ENT_QUOTES, 'UTF-8') ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Brands -->
        <div class="footer-col">
          <h4>Brands</h4>
          <ul>
            <li><a href="https://getyourvirtualcto.com" target="_blank" rel="noopener">Your Virtual CTO</a></li>
            <li><a href="https://gtle.show" target="_blank" rel="noopener">GTLE Podcast</a></li>
            <li><a href="/book-session">Book Session</a></li>
          </ul>
        </div>

        <!-- Newsletter -->
        <div class="footer-col footer-newsletter">
          <h4>Stay Updated</h4>
          <p>Subscribe to the GTLE newsletter for tech leadership insights.</p>
          <form class="newsletter-form" onsubmit="mmHandleNewsletter(event)">
            <input type="email" name="email" placeholder="Your email address" required>
            <button type="submit">Subscribe</button>
          </form>
        </div>

      </div>

      <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?>
          <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?> &middot;
          <?= htmlspecialchars($site_address, ENT_QUOTES, 'UTF-8') ?>.
          All Rights Reserved.
        </p>
        <div class="footer-bottom-links">
          <a href="/privacy-policy">Privacy Policy</a>
          <a href="/terms-of-service">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <?php /* ── AI Chat Widget (commented out) ──────────────────────
  <div class="ai-chat-widget">
    <div class="chat-label">Ask AI about <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></div>

    <div class="chat-window" id="chatWindow">
      <div class="chat-header" id="chatHeader">
        <div class="ai-avatar">AI</div>
        <div class="ai-info">
          <h4><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?> Assistant</h4>
          <p>Online | Ask about <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div class="chat-drag-hint" title="Drag to move"><i class="ph ph-dots-six"></i></div>
        <button class="chat-close-btn" id="chatCloseBtn" aria-label="Close chat">
          <i class="ph ph-x"></i>
        </button>
      </div>

      <div class="chat-messages" id="chatMessages">
        <div class="message bot">
          Hi! I'm <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>'s AI assistant. Ask me anything about <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>!
        </div>
      </div>

      <form class="chat-input" id="chatForm">
        <input type="text" id="userInput" placeholder="Ask a question..." required>
        <button type="submit"><i class="ph ph-paper-plane-right"></i></button>
      </form>
    </div>

    <div class="chat-bubble" id="chatBubble">
      <i class="ph ph-chats-circle"></i>
      <div class="notification-dot"></div>
    </div>

  </div>
  */ ?>

  <!-- Mike Mahony shared JS -->
  <script src="/mm_shared.js"></script>

  <script>
    function mmHandleNewsletter(e) {
      e.preventDefault();
      var email = e.target.querySelector('input[type=email]').value;
      fetch('/mm-newsletter', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'email=' + encodeURIComponent(email)
      }).finally(function() {
        e.target.innerHTML = '<p style="color:var(--primary);font-size:14px;font-weight:600;">Thanks! You\'re subscribed.</p>';
      });
    }
  </script>

  <?php if (isset($_SESSION['admin_id'])): ?>
    <script src="https://admc.dev/admc.min.js" charset="utf-8"></script>
  <?php endif; ?>

</body>
</html>
