<?php
// Route: /services/{hash_id} or /services/{hash_id}/{slug}
$hash   = $uri[2] ?? '';
$svcArr = selectContent($conn, "panel_mm_services", ["hash_id" => $hash, "visibility" => "show"]);
if (empty($svcArr)) { include APP_PATH . '/views/404.php'; die; }
$svc = $svcArr[0];

$page_title      = htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8');
$bodyClass       = "has-dark-hero";
$metaDescription = previewBody($svc['text_description'], 30);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_80001o##*/>
<div data-cbcodesection="cbcode_80001">
<section class="page-hero" style="min-height:420px;">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <div data-admc-image="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
      <img src="<?= htmlspecialchars($svc['image_1'], ENT_QUOTES, 'UTF-8') ?>"
           alt="<?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb">
        <a href="/">Home</a><i class="ph ph-caret-right"></i>
        <a href="/services">Services</a><i class="ph ph-caret-right"></i>
        <span><?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?></span>
      </div>
      <div class="section-label" style="justify-content:center;">
        <?= htmlspecialchars($svc['input_badge'], ENT_QUOTES, 'UTF-8') ?>
      </div>
      <h1 data-admc-manage="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
        <span class="gradient-text"><?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?></span>
      </h1>
      <p data-admc-manage="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
        <?= previewBody($svc['text_description'], 25) ?>
      </p>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_80001c##*/>

<?php/*##cbcode_80002o##*/>
<div data-cbcodesection="cbcode_80002">
<section class="innovation" style="padding:80px 0;">
  <div class="section-shine"></div>
  <div class="container">
    <div class="innovation-grid">
      <div class="innovation-visual fade-in-left">
        <div data-admc-image="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
          <img src="<?= htmlspecialchars($svc['image_1'], ENT_QUOTES, 'UTF-8') ?>"
               alt="<?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?>"
               style="object-position:top;">
        </div>
      </div>
      <div class="innovation-content fade-in-right">
        <div class="section-label">Service Details</div>
        <h2 data-admc-manage="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
          <?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?>
        </h2>
        <div style="font-size:16px;color:var(--text-secondary);line-height:1.9;"
             data-admc-manage="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
          <?= nl2br(htmlspecialchars($svc['text_description'], ENT_QUOTES, 'UTF-8')) ?>
        </div>
        <div style="margin-top:32px;display:flex;gap:12px;flex-wrap:wrap;">
          <a href="/book-session" class="btn btn-primary">
            <i class="ph ph-calendar-check"></i> Book a Strategy Session
          </a>
          <a href="/services" class="btn btn-outline">
            <i class="ph ph-arrow-left"></i> All Services
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_80002c##*/>

<?php/*##cbcode_80003o##*/>
<div data-cbcodesection="cbcode_80003">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Ready to Get <span class="gradient-text">Started?</span></h2>
      <p>Book a free 30-minute strategy session to talk through your situation and see if this is the right fit.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book a Strategy Session
        </a>
        <a href="<?= htmlspecialchars($svc['input_cta_link'], ENT_QUOTES, 'UTF-8') ?>"
           class="btn btn-outline" target="_blank" rel="noopener">
          <i class="ph ph-linkedin-logo"></i>
          <?= htmlspecialchars($svc['input_cta_label'], ENT_QUOTES, 'UTF-8') ?>
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_80003c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
