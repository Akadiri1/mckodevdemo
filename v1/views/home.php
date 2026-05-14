<?php
$page_title = "Fractional CTO & NetSuite Expert";
$bodyClass  = "home-page";

// For settings_ tables: set visibility = 'hide' in ADMC to hide that section.
$heroData     = selectContent($conn, "settings_mm_hero",        ["visibility" => "show"]);
$aboutData    = selectContent($conn, "settings_mm_about_block", ["visibility" => "show"]);
$ctaData      = selectContent($conn, "settings_mm_cta",         ["visibility" => "show"]);
$hero         = !empty($heroData)  ? $heroData[0]  : null;
$about        = !empty($aboutData) ? $aboutData[0] : null;
$cta          = !empty($ctaData)   ? $ctaData[0]   : null;
$aboutFeats   = selectContentAsc($conn,  "panel_mm_about_features",  ["visibility" => "show"], "input_order", 10);
$services     = selectContentAsc($conn,  "panel_mm_services",         ["visibility" => "show"], "input_order", 6);
$podcasts     = selectContentDesc($conn, "panel_mm_podcast",          ["visibility" => "show"], "id", 6);
$testimonials = selectContentAsc($conn,  "panel_mm_testimonials",     ["visibility" => "show"], "input_order", 10);
$projects     = selectContentAsc($conn,  "panel_mm_projects",          ["visibility" => "show"], "input_order", 8);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<!-- ── Hero ──────────────────────────────────────────────── -->
<?php/*##cbcode_10001o##*/>
<div data-cbcodesection="cbcode_10001">
<?php if ($hero): ?>
<section class="hero" id="hero">
  <div class="section-shine"></div>
  <div class="hero-slider" id="heroSlider">
    <div class="hero-slide active">
      <div data-admc-image="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
        <img src="<?= htmlspecialchars($hero['image_1'], ENT_QUOTES, 'UTF-8') ?>"
             alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
             style="object-fit:cover;object-position:center top;width:100%;height:100%;">
      </div>
    </div>
    <div class="hero-slide">
      <video class="hero-video" autoplay muted loop playsinline preload="auto">
        <source src="<?= htmlspecialchars($hero['input_video_url'] ?? 'https://videos.pexels.com/video-files/3253106/3253106-hd_1920_1080_25fps.mp4', ENT_QUOTES, 'UTF-8') ?>" type="video/mp4">
      </video>
    </div>
  </div>
  <div class="hero-content">
    <div class="hero-badge" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
      <?= htmlspecialchars($hero['input_badge'], ENT_QUOTES, 'UTF-8') ?>
    </div>
    <h1>
      <span data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
        <?= htmlspecialchars($hero['input_heading'], ENT_QUOTES, 'UTF-8') ?>
      </span>
      <span class="gradient-text" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
        <?= htmlspecialchars($hero['input_heading_highlight'], ENT_QUOTES, 'UTF-8') ?>
      </span><br>
      <span data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
        <?= htmlspecialchars($hero['input_heading_sub'] ?? 'in Tech Teams', ENT_QUOTES, 'UTF-8') ?>
      </span>
    </h1>
    <p class="hero-description" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
      <?= htmlspecialchars($hero['text_description'], ENT_QUOTES, 'UTF-8') ?>
    </p>
    <div class="hero-actions">
      <a href="<?= htmlspecialchars($hero['input_btn1_link'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary">
        <i class="ph ph-chart-line-up"></i>
        <?= htmlspecialchars($hero['input_btn1_label'], ENT_QUOTES, 'UTF-8') ?>
      </a>
      <a href="<?= htmlspecialchars($hero['input_btn2_link'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-outline">
        <i class="ph ph-fire"></i>
        <?= htmlspecialchars($hero['input_btn2_label'], ENT_QUOTES, 'UTF-8') ?>
      </a>
    </div>
    <div class="hero-stats">
      <div class="hero-stat">
        <div class="number" data-target="40" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
          <?= htmlspecialchars($hero['input_stat1_number'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <div class="label" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
          <?= htmlspecialchars($hero['input_stat1_label'], ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
      <div class="hero-stat">
        <div class="number" data-target="85" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
          <?= htmlspecialchars($hero['input_stat2_number'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <div class="label" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
          <?= htmlspecialchars($hero['input_stat2_label'], ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
      <div class="hero-stat">
        <div class="number" data-target="20" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
          <?= htmlspecialchars($hero['input_stat3_number'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <div class="label" data-admc-manage="settings_mm_hero" data-admc-id="<?= $hero['id'] ?>">
          <?= htmlspecialchars($hero['input_stat3_label'], ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    </div>
    <div class="slider-indicators" id="sliderIndicators">
      <div class="slider-dot active" data-slide="0"></div>
      <div class="slider-dot" data-slide="1"></div>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10001c##*/>

<!-- ── About ─────────────────────────────────────────────── -->
<?php/*##cbcode_10002o##*/>
<div data-cbcodesection="cbcode_10002">
<?php if ($about): ?>
<section class="innovation" id="about">
  <div class="section-shine"></div>
  <div class="container">
    <div class="innovation-grid">
      <div class="innovation-visual fade-in-left">
        <div data-admc-image="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
          <img src="<?= htmlspecialchars($about['image_1'], ENT_QUOTES, 'UTF-8') ?>" alt="Mike Mahony" style="object-position:top;">
        </div>
      </div>
      <div class="innovation-content fade-in-right">
        <div class="section-label" data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
          <?= htmlspecialchars($about['input_label'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <h2>
          <span data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
            <?= htmlspecialchars($about['input_heading'], ENT_QUOTES, 'UTF-8') ?>
          </span>
          <span class="gradient-text" data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
            <?= htmlspecialchars($about['input_heading_highlight'], ENT_QUOTES, 'UTF-8') ?>
          </span>
        </h2>
        <p data-admc-manage="settings_mm_about_block" data-admc-id="<?= $about['id'] ?>">
          <?= htmlspecialchars($about['text_description'], ENT_QUOTES, 'UTF-8') ?>
        </p>
        <div class="innovation-features" data-admc-tb="panel_mm_about_features">
          <?php foreach ($aboutFeats as $feat): ?>
            <div class="innovation-feature fade-in">
              <div class="icon"><i class="<?= htmlspecialchars($feat['icon_feature_icon'], ENT_QUOTES, 'UTF-8') ?>"></i></div>
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
        <div style="margin-top:28px;">
          <a href="/about" class="btn btn-outline"><i class="ph ph-user"></i> Full Story</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10002c##*/>

<!-- ── Services ──────────────────────────────────────────── -->
<?php/*##cbcode_10003o##*/>
<div data-cbcodesection="cbcode_10003">
<?php if (!empty($services)): ?>
<section class="opportunities" id="services">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Our Services</div>
      <h2 class="section-title">Scale Your Tech Without the <span class="gradient-text">Chaos</span></h2>
      <p class="section-subtitle">Whether it's NetSuite reporting confusion or team execution bottlenecks, Mike provides the framework to eliminate the noise and drive results.</p>
    </div>
    <div class="opportunities-grid" data-admc-tb="panel_mm_services">
      <?php foreach ($services as $i => $svc): ?>
        <div class="opportunity-card fade-in" style="transition-delay:<?= $i * 0.1 ?>s">
          <!-- Image links to detail page -->
          <div class="opportunity-image">
            <a href="/services/<?= $svc['hash_id'] ?>/<?= cleans($svc['input_slug'] ?? $svc['input_title']) ?>">
              <div data-admc-image="panel_mm_services" data-admc-id="<?= $svc['id'] ?>">
                <img src="<?= htmlspecialchars($svc['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                     alt="<?= htmlspecialchars($svc['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                     style="object-position:top;width:100%;height:100%;object-fit:cover;">
              </div>
            </a>
            <span class="news-tag" style="position:absolute;top:14px;left:14px;background:var(--primary);color:#000;">
              <?= htmlspecialchars($svc['input_badge'], ENT_QUOTES, 'UTF-8') ?>
            </span>
          </div>
          <!-- Card body — title links to detail, description plain -->
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
              <?= previewBody($svc['text_description'], 30) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10003c##*/>

<!-- ── Podcast ───────────────────────────────────────────── -->
<?php/*##cbcode_10004o##*/>
<div data-cbcodesection="cbcode_10004">
<?php if (!empty($podcasts)): ?>
<section class="news" id="podcast">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">The Podcast</div>
      <h2 class="section-title">Gaining the <span class="gradient-text">Technology Leadership</span> Edge</h2>
      <p class="section-subtitle">The podcast for CTOs and senior tech leaders who are tired of being indispensable.</p>
    </div>
    <div class="news-grid" data-admc-tb="panel_mm_podcast" id="podcast-grid">
      <?php foreach ($podcasts as $i => $ep): ?>
        <div class="news-card fade-in <?= $i >= 3 ? 'hidden-item' : '' ?>"
             style="transition-delay:<?= ($i % 3) * 0.1 ?>s">
          <!-- Image links to episode detail -->
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
          <!-- Card body — title links to episode detail, description plain -->
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
    <div class="load-more-container">
      <button type="button" class="btn btn-outline load-more-btn" data-target="podcast-grid">
        Load More Episodes
      </button>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10004c##*/>

<!-- ── Testimonials ──────────────────────────────────────── -->
<?php/*##cbcode_10005o##*/>
<div data-cbcodesection="cbcode_10005">
<?php if (!empty($testimonials)): ?>
<section class="innovation" id="testimonials" style="background:var(--bg-secondary);">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Social Proof</div>
      <h2 class="section-title">What Leaders Are <span class="gradient-text">Saying</span></h2>
    </div>
    <div class="opportunities-grid" data-admc-tb="panel_mm_testimonials" id="testi-grid">
      <?php foreach ($testimonials as $i => $t): ?>
        <div class="opportunity-card fade-in <?= $i >= 3 ? 'hidden-item' : '' ?>"
             style="padding:30px;transition-delay:<?= ($i % 3) * 0.1 ?>s">
          <p style="font-style:italic;margin-bottom:20px;"
             data-admc-manage="panel_mm_testimonials" data-admc-id="<?= $t['id'] ?>">
            "<?= htmlspecialchars($t['text_quote'], ENT_QUOTES, 'UTF-8') ?>"
          </p>
          <div style="display:flex;align-items:center;gap:12px;">
            <div style="width:48px;height:48px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:bold;color:#000;flex-shrink:0;">
              <?= htmlspecialchars($t['input_initials'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <div>
              <h4 style="margin:0;" data-admc-manage="panel_mm_testimonials" data-admc-id="<?= $t['id'] ?>">
                <?= htmlspecialchars($t['input_name'], ENT_QUOTES, 'UTF-8') ?>
              </h4>
              <p style="font-size:12px;margin:0;color:var(--text-muted);"
                 data-admc-manage="panel_mm_testimonials" data-admc-id="<?= $t['id'] ?>">
                <?= htmlspecialchars($t['input_role'], ENT_QUOTES, 'UTF-8') ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="load-more-container">
      <button type="button" class="btn btn-outline load-more-btn" data-target="testi-grid">
        Load More Testimonials
      </button>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10005c##*/>

<!-- ── Projects ──────────────────────────────────────────── -->
<?php/*##cbcode_10007o##*/>
<div data-cbcodesection="cbcode_10007">
<?php if (!empty($projects)): ?>
<section class="opportunities" id="projects">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Portfolio</div>
      <h2 class="section-title">Notable <span class="gradient-text">Projects</span></h2>
      <p class="section-subtitle">Real-world solutions delivered across EDI integrations, e-commerce, and manufacturing workflows.</p>
    </div>
    <div class="opportunities-grid" data-admc-tb="panel_mm_projects" id="projects-grid">
      <?php foreach ($projects as $i => $proj): ?>
        <div class="opportunity-card fade-in <?= $i >= 3 ? 'hidden-item' : '' ?>"
             style="transition-delay:<?= ($i % 3) * 0.1 ?>s">
          <div class="opportunity-image">
            <div data-admc-image="panel_mm_projects" data-admc-id="<?= $proj['id'] ?>">
              <img src="<?= htmlspecialchars($proj['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($proj['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                   style="object-position:top;width:100%;height:100%;object-fit:cover;">
            </div>
          </div>
          <div class="opportunity-body">
            <h3 data-admc-manage="panel_mm_projects" data-admc-id="<?= $proj['id'] ?>">
              <?= htmlspecialchars($proj['input_title'], ENT_QUOTES, 'UTF-8') ?>
            </h3>
            <p data-admc-manage="panel_mm_projects" data-admc-id="<?= $proj['id'] ?>">
              <?= previewBody($proj['text_description'], 25) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="load-more-container">
      <button type="button" class="btn btn-outline load-more-btn" data-target="projects-grid">
        Load More Projects
      </button>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10007c##*/>

<!-- ── CTA ───────────────────────────────────────────────── -->
<?php/*##cbcode_10006o##*/>
<div data-cbcodesection="cbcode_10006">
<?php if ($cta): ?>
<section class="cta-section" id="contact">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2 data-admc-manage="settings_mm_cta" data-admc-id="<?= $cta['id'] ?>">
        <?= htmlspecialchars($cta['input_heading'], ENT_QUOTES, 'UTF-8') ?>
        <span class="gradient-text"><?= htmlspecialchars($cta['input_heading_highlight'], ENT_QUOTES, 'UTF-8') ?></span>
      </h2>
      <p data-admc-manage="settings_mm_cta" data-admc-id="<?= $cta['id'] ?>">
        <?= htmlspecialchars($cta['text_description'], ENT_QUOTES, 'UTF-8') ?>
      </p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="<?= htmlspecialchars($cta['input_btn1_link'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary">
          <i class="ph ph-linkedin-logo"></i> <?= htmlspecialchars($cta['input_btn1_label'], ENT_QUOTES, 'UTF-8') ?>
        </a>
        <a href="<?= htmlspecialchars($cta['input_btn2_link'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-outline">
          <i class="ph ph-linkedin-logo"></i> <?= htmlspecialchars($cta['input_btn2_label'], ENT_QUOTES, 'UTF-8') ?>
        </a>
        <?php if (!empty($cta['input_btn3_label'])): ?>
        <a href="<?= htmlspecialchars($cta['input_btn3_link'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-outline">
          <i class="ph ph-linkedin-logo"></i> <?= htmlspecialchars($cta['input_btn3_label'], ENT_QUOTES, 'UTF-8') ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
</div>
<?php/*##cbcode_10006c##*/>

<?php/*##cb1c##*/>
</div>

<script>
  (function(){
    var slides=document.querySelectorAll('.hero-slide'),dots=document.querySelectorAll('.slider-dot'),cur=0,iv;
    function goTo(i){slides[cur].classList.remove('active');dots[cur].classList.remove('active');cur=i;slides[cur].classList.add('active');dots[cur].classList.add('active');}
    dots.forEach(function(d){d.addEventListener('click',function(){clearInterval(iv);goTo(+d.dataset.slide);iv=setInterval(function(){goTo((cur+1)%slides.length);},6000);});});
    iv=setInterval(function(){goTo((cur+1)%slides.length);},6000);
    function animateNum(el,target){var n=0,inc=target/60;var t=setInterval(function(){n+=inc;if(n>=target){n=target;clearInterval(t);}var txt=el.textContent;if(txt.indexOf('$')>-1){el.textContent='$'+Math.floor(n)+'M';}else if(txt.indexOf('+')>-1){el.textContent=Math.floor(n)+'+';}else{el.textContent=Math.floor(n);}},16);}
    var obs=new IntersectionObserver(function(entries){entries.forEach(function(e){if(e.isIntersecting){e.target.querySelectorAll('.hero-stat .number').forEach(function(s){animateNum(s,+s.dataset.target);});}});},{threshold:0.5});
    var hs=document.querySelector('.hero-stats');if(hs)obs.observe(hs);
  })();
</script>

<?php include 'includes/mm_footer.php'; ?>
