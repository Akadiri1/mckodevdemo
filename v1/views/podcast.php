<?php
$page_title = "GTLE Podcast";
$bodyClass  = "has-dark-hero";

try { $episodes = selectContentAsc($conn, "panel_mm_podcast", ["visibility" => "show"], "input_order", 20); } catch (Exception $e) { $episodes = []; }

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_40001o##*/>
<div data-cbcodesection="cbcode_40001">
<section class="page-hero">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1920" alt="GTLE Podcast">
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb"><a href="/">Home</a><i class="ph ph-caret-right"></i><span>Podcast</span></div>
      <div class="section-label">
        <i class="ph ph-microphone" style="margin-right:6px;"></i> Gaining the Technology Leadership Edge
      </div>
      <h1>The Podcast for <span class="gradient-text">Tech Leaders</span></h1>
      <p>For CTOs and senior tech leaders tired of being indispensable. Break free from firefighter mode and build teams that think, decide, and execute.</p>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:24px;">
        <a href="https://gtle.show" class="btn btn-primary" target="_blank" rel="noopener">
          <i class="ph ph-globe"></i> Listen at gtle.show
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
<?php/*##cbcode_40001c##*/>

<?php/*##cbcode_40002o##*/>
<div data-cbcodesection="cbcode_40002">
<section class="news" style="padding:80px 0;">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Episode Themes</div>
      <h2 class="section-title">Key Topics We <span class="gradient-text">Cover</span></h2>
      <p class="section-subtitle">Every episode digs into the practical problems tech leaders face every day.</p>
    </div>
    <div class="news-grid" data-admc-tb="panel_mm_podcast">
      <?php foreach ($episodes as $i => $ep): ?>
        <!-- Image links to episode detail, body is plain text -->
        <div class="news-card fade-in" style="transition-delay:<?= ($i % 3) * 0.1 ?>s">
          <div class="news-image">
            <a href="/podcast/<?= $ep['hash_id'] ?>">
              <div data-admc-image="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
                <img src="<?= htmlspecialchars($ep['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                     alt="<?= htmlspecialchars($ep['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                     style="object-position:top;width:100%;height:100%;object-fit:cover;">
              </div>
            </a>
            <span class="news-tag"><?= htmlspecialchars($ep['select_category'], ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="news-body">
            <p class="news-date" data-admc-manage="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
              <?= htmlspecialchars($ep['input_theme_number'], ENT_QUOTES, 'UTF-8') ?>
            </p>
            <h3 data-admc-manage="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
              <a href="/podcast/<?= $ep['hash_id'] ?>" class="card-title-link">
                <?= htmlspecialchars($ep['input_title'], ENT_QUOTES, 'UTF-8') ?>
              </a>
            </h3>
            <p data-admc-manage="panel_mm_podcast" data-admc-id="<?= $ep['id'] ?>">
              <?= previewBody($ep['text_description'], 20) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_40002c##*/>

<?php/*##cbcode_40003o##*/>
<div data-cbcodesection="cbcode_40003">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Want to Go Deeper Than the <span class="gradient-text">Podcast?</span></h2>
      <p>The podcast gives you the framework. Working with Mike gives you the transformation.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book a Strategy Session
        </a>
        <a href="https://gtle.show" class="btn btn-outline" target="_blank" rel="noopener">
          <i class="ph ph-microphone"></i> Listen Now
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_40003c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
