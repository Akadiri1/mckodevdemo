<?php
// ── All core site vars already set by index.php from settings_website_info ───
// $site_name, $site_email, $logo_directory, $description, $linkedinLink,
// $site_email_from, $site_email_smtp_host, $site_email_smtp_secure_type,
// $site_email_smtp_port, $site_email_password, $metakeys, etc.

// Additional fields — graceful fallback if column not yet in the DB
$site_tagline    = $websiteInfo[0]['input_tagline']          ?? 'Fractional CTO';
$podcastLink     = $websiteInfo[0]['input_podcast_link']     ?? 'https://gtle.show';
$applePodcast    = $websiteInfo[0]['input_apple_podcast']    ?? 'https://podcasts.apple.com/us/podcast/gaining-the-technology-leadership-edge/id1664607772';
$bookSessionUrl  = $websiteInfo[0]['input_book_session_url'] ?? 'https://GetYourVirtualCTO.com/StrategySession';

// ── Theme colours from website_status (already loaded by index.php) ──────────
// website_status.color           → --primary  (gold)
// website_status.secondary_color → --bg-primary (dark navy)
$mmPrimary    = $websiteStyle[0]['color']            ?? '#FFBF00';
$mmPrimaryDrk = '#cc9900'; // derived; not editable separately
$mmBgPrimary  = $websiteStyle[0]['bgcolor_background'] ?? ($websiteStyle[0]['secondary_color'] ?? '#050a14');
$mmBgSurface  = $websiteStyle[0]['bgcolor_surface']    ?? '#0a1128';
$mmTextHead   = $websiteStyle[0]['textcolor_heading']  ?? '#f9fafb';
$mmTextBody   = $websiteStyle[0]['textcolor_body']     ?? '#d1d5db';
$mmTextMuted  = $websiteStyle[0]['textcolor_muted']    ?? '#9ca3af';

// Page meta fallback
$metaDescription = $metaDescription ?? $description;

// ── DB-driven navigation ─────────────────────────────────────────────────────
$mmNavParents = selectContentAsc($conn, 'panel_mm_pages',    ['visibility' => 'show'], 'input_order', 15);
$mmNavDropRaw = selectContentAsc($conn, 'addition_mm_pages', ['visibility' => 'show'], 'input_order', 30);

$mmNavDropByHash = [];
foreach ($mmNavDropRaw as $drop) {
    $mmNavDropByHash[$drop['tb_link']][] = $drop;
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars($page_title ?? 'Home', ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="keywords" content="<?= htmlspecialchars($metakeys, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:title" content="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars($page_title ?? 'Home', ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:image" content="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:type" content="website">

  <link rel="icon" type="image/jpeg" href="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>">
  <link rel="apple-touch-icon" href="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Phosphor Icons -->
  <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css">

  <!-- Mike Mahony Styles -->
  <link rel="stylesheet" href="/mm_styles.css">

  <!-- ── Dynamic theme colours from ADMC (website_status table) ───────────
       Primary/accent colour injected on BOTH dark + light with equal weight.
       Dark/light backgrounds are handled by mm_styles.css [data-theme] blocks.
  ──────────────────────────────────────────────────────────────────────── -->
  <style data-admc-manage="website_status" data-admc-id="<?= $websiteStyle[0]['id'] ?>">
    /* --primary applies in both modes — overrides any hardcoded green */
    :root,
    [data-theme="dark"],
    [data-theme="light"] {
      --primary:       <?= htmlspecialchars($mmPrimary,    ENT_QUOTES, 'UTF-8') ?>;
      --primary-dark:  <?= htmlspecialchars($mmPrimaryDrk, ENT_QUOTES, 'UTF-8') ?>;
      --primary-light: <?= htmlspecialchars($mmPrimary,    ENT_QUOTES, 'UTF-8') ?>;
      --accent:        <?= htmlspecialchars($mmPrimary,    ENT_QUOTES, 'UTF-8') ?>;
      --primary-glow:  rgba(255, 191, 0, 0.3);
      --shadow-glow:   0 0 40px rgba(255, 191, 0, 0.3);
      --border-hover:  rgba(255, 191, 0, 0.35);
    }
    /* Dark mode backgrounds — only applied when dark theme is active */
    [data-theme="dark"] {
      --bg-primary:     <?= htmlspecialchars($mmBgPrimary, ENT_QUOTES, 'UTF-8') ?>;
      --bg-secondary:   <?= htmlspecialchars($mmBgSurface, ENT_QUOTES, 'UTF-8') ?>;
      --bg-tertiary:    <?= htmlspecialchars($mmBgSurface, ENT_QUOTES, 'UTF-8') ?>;
      --bg-card:        <?= htmlspecialchars($mmBgSurface, ENT_QUOTES, 'UTF-8') ?>;
      --text-primary:   <?= htmlspecialchars($mmTextHead,  ENT_QUOTES, 'UTF-8') ?>;
      --text-secondary: <?= htmlspecialchars($mmTextBody,  ENT_QUOTES, 'UTF-8') ?>;
      --text-muted:     <?= htmlspecialchars($mmTextMuted, ENT_QUOTES, 'UTF-8') ?>;
    }
    /* Light mode keeps its own palette from mm_styles.css [data-theme="light"] */
  </style>
</head>
<body class="<?= $bodyClass ?? 'has-dark-hero' ?>">

  <!-- Cursor Glow -->
  <div class="cursor-glow" id="cursorGlow"></div>

  <!-- Ember Canvas -->
  <canvas id="emberCanvas"></canvas>

  <!-- Background Particles -->
  <div class="bg-particles">
    <?php for ($i = 0; $i < 8; $i++): ?><div class="particle"></div><?php endfor; ?>
  </div>

  <!-- ── Navbar ──────────────────────────────────────────────── -->
  <nav class="navbar" id="navbar">
    <div class="container">

      <!-- Logo — editable via ADMC (settings_website_info) -->
      <a href="/" class="nav-logo">
        <div data-admc-image="settings_website_info"
             data-admc-id="<?= $websiteInfo[0]['id'] ?? 1 ?>">
          <img src="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>"
               alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
               class="logo-img">
        </div>
        <div class="logo-text">
          <span class="brand"
                data-admc-manage="settings_website_info"
                data-admc-id="<?= $websiteInfo[0]['id'] ?? 1 ?>">
            <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>
          </span>
          <span class="tagline"
                data-admc-manage="settings_website_info"
                data-admc-id="<?= $websiteInfo[0]['id'] ?? 1 ?>">
            <?= htmlspecialchars($site_tagline, ENT_QUOTES, 'UTF-8') ?>
          </span>
        </div>
      </a>

      <div class="nav-right">
        <!-- Nav links — DB-driven via panel_mm_pages + addition_mm_pages -->
        <div class="nav-links" id="navLinks" data-admc-tb="panel_mm_pages">
          <!-- Sidebar header: logo + name + close -->
          <div class="sidebar-header">
            <a href="/" class="sidebar-logo-wrap">
              <img src="<?= htmlspecialchars($logo_directory ?? '', ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
                   class="sidebar-avatar">
              <div class="sidebar-logo-text">
                <span class="sidebar-name"><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></span>
                <span class="sidebar-tagline"><?= htmlspecialchars($site_tagline ?? '', ENT_QUOTES, 'UTF-8') ?></span>
              </div>
            </a>
            <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
              <i class="ph ph-x"></i>
            </button>
          </div>

          <?php foreach ($mmNavParents as $nav):
            $hasDropdown = isset($mmNavDropByHash[$nav['hash_id']]);
            $isCta       = ($nav['input_link'] === '/book-session');
          ?>
            <?php if ($isCta): ?>
              <a href="<?= htmlspecialchars($nav['input_link'], ENT_QUOTES, 'UTF-8') ?>"
                 class="nav-cta"
                 data-admc-manage="panel_mm_pages"
                 data-admc-id="<?= $nav['id'] ?>">
                <?= htmlspecialchars($nav['input_name'], ENT_QUOTES, 'UTF-8') ?>
              </a>

            <?php elseif ($hasDropdown): ?>
              <div class="nav-dropdown-wrap">
                <a href="<?= htmlspecialchars($nav['input_link'], ENT_QUOTES, 'UTF-8') ?>"
                   data-admc-manage="panel_mm_pages"
                   data-admc-id="<?= $nav['id'] ?>">
                  <?= htmlspecialchars($nav['input_name'], ENT_QUOTES, 'UTF-8') ?>
                  <i class="ph ph-caret-down" style="font-size:12px;margin-left:2px;"></i>
                </a>
                <ul class="nav-dropdown"
                    data-admc-tb="addition_mm_pages"
                    data-admc-tbadd="panel_mm_pages"
                    data-admc-tblink="<?= $nav['hash_id'] ?>">
                  <?php foreach ($mmNavDropByHash[$nav['hash_id']] as $child): ?>
                    <li>
                      <a href="<?= htmlspecialchars($child['input_link'], ENT_QUOTES, 'UTF-8') ?>"
                         data-admc-manage="addition_mm_pages"
                         data-admc-id="<?= $child['id'] ?>">
                        <?= htmlspecialchars($child['input_name'], ENT_QUOTES, 'UTF-8') ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>

            <?php else: ?>
              <a href="<?= htmlspecialchars($nav['input_link'], ENT_QUOTES, 'UTF-8') ?>"
                 data-admc-manage="panel_mm_pages"
                 data-admc-id="<?= $nav['id'] ?>">
                <?= htmlspecialchars($nav['input_name'], ENT_QUOTES, 'UTF-8') ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>

          <div class="sidebar-spacer"></div>
          <div class="sidebar-socials">
            <a href="<?= htmlspecialchars($linkedinLink, ENT_QUOTES, 'UTF-8') ?>"
               aria-label="LinkedIn" target="_blank" rel="noopener">
              <i class="ph ph-linkedin-logo"></i>
            </a>
            <a href="<?= htmlspecialchars($podcastLink, ENT_QUOTES, 'UTF-8') ?>"
               aria-label="GTLE Podcast" target="_blank" rel="noopener">
              <i class="ph ph-globe"></i>
            </a>
          </div>
        </div>

        <!-- Theme toggle -->
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
          <i class="ph ph-moon icon-moon"></i>
          <i class="ph ph-sun icon-sun"></i>
        </button>

        <!-- Mobile hamburger -->
        <div class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
          <span></span><span></span><span></span>
        </div>
      </div>

    </div>
  </nav>
  <div class="nav-overlay" id="navOverlay"></div>
