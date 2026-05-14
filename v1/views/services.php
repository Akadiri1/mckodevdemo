<?php
$page_title = "Services";
$bodyClass  = "has-dark-hero";

$services = selectContentAsc($conn, "panel_mm_services", ["visibility" => "show"], "input_order", 10);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_30001o##*/>
<div data-cbcodesection="cbcode_30001">
<section class="page-hero">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=1920" alt="Services">
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb"><a href="/">Home</a><i class="ph ph-caret-right"></i><span>Services</span></div>
      <div class="section-label">What Mike Offers</div>
      <h1>Scale Your Tech Without the <span class="gradient-text">Chaos</span></h1>
      <p>Three proven services for CTOs, operators, and 7-to-8-figure companies ready to eliminate decision bottlenecks and reporting chaos.</p>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_30001c##*/>

<?php/*##cbcode_30002o##*/>
<div data-cbcodesection="cbcode_30002">
<section class="opportunities" style="padding:80px 0;">
  <div class="section-shine"></div>
  <div class="container">
    <div class="opportunities-grid" data-admc-tb="panel_mm_services">
      <?php foreach ($services as $i => $svc): ?>
        <div class="opportunity-card fade-in" style="transition-delay:<?= $i * 0.1 ?>s">
          <div class="opportunity-image">
            <div data-admc-image="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
              <img src="<?= htmlspecialchars($svc['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                   style="object-position:top;width:100%;height:100%;object-fit:cover;">
            </div>
            <span class="news-tag" style="position:absolute;top:14px;left:14px;background:var(--primary);color:#000;">
              <?= htmlspecialchars($svc['input_badge'], ENT_QUOTES, 'UTF-8') ?>
            </span>
          </div>
          <div class="opportunity-body">
            <div class="opportunity-icon">
              <i class="<?= htmlspecialchars($svc['icon_service_icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
            </div>
            <h3 data-admc-manage="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
              <a href="/services/<?= $svc['hash_id'] ?>/<?= cleans($svc['input_slug'] ?? $svc['input_title']) ?>"
                 class="card-title-link">
                <?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?>
              </a>
            </h3>
            <p data-admc-manage="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
              <?= previewBody($svc['text_description'], 35) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_30002c##*/>

<?php/*##cbcode_30003o##*/>
<div data-cbcodesection="cbcode_30003">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Not Sure Which Service You <span class="gradient-text">Need?</span></h2>
      <p>Book a free 30-minute strategy session. Mike will diagnose the root issue and point you to the right solution.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book a Strategy Session
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_30003c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
