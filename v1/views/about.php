<?php
$page_title = "About Mike Mahony";
$bodyClass  = "has-dark-hero";

$aboutHero    = selectContent($conn, "settings_mm_about_hero",   ["visibility" => "show"])[0];
$about        = selectContent($conn, "settings_mm_about_block",  ["visibility" => "show"])[0];
$aboutFeats   = selectContentAsc($conn, "panel_mm_about_features", ["visibility" => "show"], "input_order", 10);
$testimonials = selectContentAsc($conn, "panel_mm_testimonials",   ["visibility" => "show"], "input_order", 6);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_20001o##*/>
<div data-cbcodesection="cbcode_20001">
<section class="page-hero">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <div data-admc-image="settings_mm_about_hero" data-admc-id="<?= $aboutHero['id'] ?>">
      <img src="<?= htmlspecialchars($aboutHero['image_1'], ENT_QUOTES, 'UTF-8') ?>" alt="About Mike Mahony">
    </div>
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb">
        <a href="/">Home</a><i class="ph ph-caret-right"></i><span>About</span>
      </div>
      <div class="section-label"
           data-admc-manage="settings_mm_about_hero" data-admc-id="<?= $aboutHero['id'] ?>">
        <?= htmlspecialchars($aboutHero['input_label'], ENT_QUOTES, 'UTF-8') ?>
      </div>
      <h1 data-admc-manage="settings_mm_about_hero" data-admc-id="<?= $aboutHero['id'] ?>">
        <?= htmlspecialchars($aboutHero['input_heading'], ENT_QUOTES, 'UTF-8') ?>
        <span class="gradient-text"><?= htmlspecialchars($aboutHero['input_heading_highlight'], ENT_QUOTES, 'UTF-8') ?></span>
      </h1>
      <p data-admc-manage="settings_mm_about_hero" data-admc-id="<?= $aboutHero['id'] ?>">
        <?= htmlspecialchars($aboutHero['text_description'], ENT_QUOTES, 'UTF-8') ?>
      </p>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_20001c##*/>

<?php/*##cbcode_20002o##*/>
<div data-cbcodesection="cbcode_20002">
<section class="innovation" id="about-detail">
  <div class="section-shine"></div>
  <div class="container">
    <div class="innovation-grid">
      <div class="innovation-visual fade-in-left">
        <div data-admc-image="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
          <img src="<?= htmlspecialchars($about['image_1'], ENT_QUOTES, 'UTF-8') ?>"
               alt="Mike Mahony" style="object-position:top;">
        </div>
      </div>
      <div class="innovation-content fade-in-right">
        <div class="section-label"
             data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
          <?= htmlspecialchars($about['input_label'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <h2>
          <span data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
            <?= htmlspecialchars($about['input_heading'], ENT_QUOTES, 'UTF-8') ?>
          </span>
          <span class="gradient-text"
                data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
            <?= htmlspecialchars($about['input_heading_highlight'], ENT_QUOTES, 'UTF-8') ?>
          </span>
        </h2>
        <p data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
          <?= nl2br(htmlspecialchars($about['text_description'], ENT_QUOTES, 'UTF-8')) ?>
        </p>
        <div class="innovation-features" data-admc-tb="panel_mm_about_features">
          <?php foreach ($aboutFeats as $feat): ?>
            <div class="innovation-feature fade-in">
              <div class="icon">
                <i class="<?= htmlspecialchars($feat['icon_feature_icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
              </div>
              <div>
                <h4 data-admc-manage="panel_mm_about_features" data-admc-id="<?= $feat['id'] ?>">
                  <?= htmlspecialchars($feat['input_title'], ENT_QUOTES, 'UTF-8') ?>
                </h4>
                <p data-admc-manage="panel_mm_about_features" data-admc-id="<?= $feat['id'] ?>">
                  <?= htmlspecialchars($feat['text_description'], ENT_QUOTES, 'UTF-8') ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div style="margin-top:28px;display:flex;gap:12px;flex-wrap:wrap;">
          <a href="/book-session" class="btn btn-primary">
            <i class="ph ph-calendar-check"></i> Book Strategy Session
          </a>
          <a href="/services" class="btn btn-outline">
            <i class="ph ph-briefcase"></i> View Services
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_20002c##*/>

<?php/*##cbcode_20003o##*/>
<div data-cbcodesection="cbcode_20003">
<section class="innovation" style="background:var(--bg-secondary);">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Social Proof</div>
      <h2 class="section-title">What Leaders Are <span class="gradient-text">Saying</span></h2>
    </div>
    <div class="opportunities-grid" data-admc-tb="panel_mm_testimonials">
      <?php foreach ($testimonials as $t): ?>
        <div class="opportunity-card fade-in" style="padding:30px;">
          <p style="font-style:italic;margin-bottom:20px;"
             data-admc-manage="panel_mm_testimonials" data-admc-id="<?= $t['id'] ?>">
            "<?= htmlspecialchars($t['text_quote'], ENT_QUOTES, 'UTF-8') ?>"
          </p>
          <div style="display:flex;align-items:center;gap:12px;">
            <div style="width:48px;height:48px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:bold;color:#000;">
              <?= htmlspecialchars($t['input_initials'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <div>
              <h4 style="margin:0;" data-admc-manage="panel_mm_testimonials" data-admc-id="<?= $t['id'] ?>">
                <?= htmlspecialchars($t['input_name'], ENT_QUOTES, 'UTF-8') ?>
              </h4>
              <p style="font-size:12px;margin:0;color:var(--text-muted);">
                <?= htmlspecialchars($t['input_role'], ENT_QUOTES, 'UTF-8') ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_20003c##*/>

<?php/*##cbcode_20004o##*/>
<div data-cbcodesection="cbcode_20004">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Ready to Work with <span class="gradient-text">Mike?</span></h2>
      <p>Whether it's NetSuite chaos, team bottlenecks, or Fractional CTO needs — book a free 30-minute strategy session to start.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book Strategy Session
        </a>
        <a href="/services" class="btn btn-outline">
          <i class="ph ph-briefcase"></i> View Services
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_20004c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
