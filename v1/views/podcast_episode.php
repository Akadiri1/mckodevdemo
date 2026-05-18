<?php
$hash  = $uri[2] ?? '';
try { $epArr = selectContent($conn, "panel_mm_podcast", ["hash_id" => $hash, "visibility" => "show"]); } catch (Exception $e) { $epArr = []; }
if (empty($epArr)) { include APP_PATH . '/views/404.php'; die; }
$ep = $epArr[0];

$page_title      = htmlspecialchars($ep['input_title'], ENT_QUOTES, 'UTF-8');
$bodyClass       = "has-dark-hero";
$metaDescription = previewBody($ep['text_description'], 30);

try { $related = selectContentDesc($conn, "panel_mm_podcast", ["visibility" => "show"], "id", 4); } catch (Exception $e) { $related = []; }
$related = array_filter($related, function($r) use ($hash) { return $r['hash_id'] !== $hash; });
$related = array_slice(array_values($related), 0, 3);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_90001o##*/>
<div data-cbcodesection="cbcode_90001">
<section class="page-hero" style="min-height:480px;">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <div data-admc-image="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
      <img src="<?= htmlspecialchars($ep['image_1'], ENT_QUOTES, 'UTF-8') ?>"
           alt="<?= htmlspecialchars($ep['input_title'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb">
        <a href="/">Home</a><i class="ph ph-caret-right"></i>
        <a href="/podcast">Podcast</a><i class="ph ph-caret-right"></i>
        <span>Episode</span>
      </div>
      <div class="section-label" style="justify-content:center;">
        <i class="ph ph-microphone" style="margin-right:6px;"></i>
        <?= htmlspecialchars($ep['input_theme_number'], ENT_QUOTES, 'UTF-8') ?>
        &middot; <?= htmlspecialchars($ep['select_category'], ENT_QUOTES, 'UTF-8') ?>
      </div>
      <h1 data-admc-manage="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
        <span class="gradient-text"><?= htmlspecialchars($ep['input_title'], ENT_QUOTES, 'UTF-8') ?></span>
      </h1>
      <p data-admc-manage="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
        <?= previewBody($ep['text_description'], 25) ?>
      </p>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:24px;">
        <a href="<?= htmlspecialchars($ep['input_listen_link'] ?: 'https://gtle.show', ENT_QUOTES, 'UTF-8') ?>"
           class="btn btn-primary" target="_blank" rel="noopener">
          <i class="ph ph-play-circle"></i> Listen Now
        </a>
        <a href="https://podcasts.apple.com/us/podcast/gaining-the-technology-leadership-edge/id1664607772"
           class="btn btn-outline" target="_blank" rel="noopener">
          <i class="ph ph-apple-logo"></i> Apple Podcasts
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_90001c##*/>

<?php/*##cbcode_90002o##*/>
<div data-cbcodesection="cbcode_90002">
<section class="article-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="article-container">
      <div class="article-meta fade-in">
        <span class="news-tag" style="position:static;background:var(--primary);color:#000;font-size:12px;padding:5px 12px;border-radius:999px;font-weight:700;">
          <?= htmlspecialchars($ep['select_category'], ENT_QUOTES, 'UTF-8') ?>
        </span>
        <span style="font-size:13px;color:var(--text-muted);">
          <?= htmlspecialchars($ep['input_theme_number'], ENT_QUOTES, 'UTF-8') ?>
        </span>
      </div>
      <div class="article-body fade-in"
           data-admc-manage="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
        <?= nl2br(htmlspecialchars($ep['text_description'], ENT_QUOTES, 'UTF-8')) ?>
      </div>
      <div class="author-card fade-in">
        <img src="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>"
             alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
             class="author-avatar">
        <div class="author-info">
          <h4><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></h4>
          <p>Fractional CTO, creator of the DCAT Method, and host of the Gaining the Technology Leadership Edge podcast.</p>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_90002c##*/>

<?php if (!empty($related)): ?>
<?php/*##cbcode_90003o##*/>
<div data-cbcodesection="cbcode_90003">
<section class="news" style="background:var(--bg-secondary);padding:72px 0;">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Keep Listening</div>
      <h2 class="section-title">Related <span class="gradient-text">Themes</span></h2>
    </div>
    <div class="news-grid">
      <?php foreach ($related as $r): ?>
        <div class="news-card fade-in">
          <div class="news-image">
            <img src="<?= htmlspecialchars($r['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= htmlspecialchars($r['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                 style="object-position:top;width:100%;height:100%;object-fit:cover;">
            <span class="news-tag"><?= htmlspecialchars($r['select_category'], ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="news-body">
            <p class="news-date"><?= htmlspecialchars($r['input_theme_number'], ENT_QUOTES, 'UTF-8') ?></p>
            <h3><?= htmlspecialchars($r['input_title'], ENT_QUOTES, 'UTF-8') ?></h3>
            <a href="/podcast/<?= $r['hash_id'] ?>" class="news-read-more">
              Explore <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_90003c##*/>
<?php endif; ?>

<?php/*##cbcode_90004o##*/>
<div data-cbcodesection="cbcode_90004">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Ready to Implement <span class="gradient-text">These Frameworks?</span></h2>
      <p>The podcast gives you the ideas. Working with Mike gives you the results.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book a Strategy Session
        </a>
        <a href="/podcast" class="btn btn-outline">
          <i class="ph ph-arrow-left"></i> Back to Podcast
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_90004c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
