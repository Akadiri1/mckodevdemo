<?php
$hash    = $uri[2] ?? '';
$postArr = selectContent($conn, "panel_mm_blog", ["hash_id" => $hash, "visibility" => "show"]);
if (empty($postArr)) { include APP_PATH . '/views/404.php'; die; }
$post = $postArr[0];

$page_title      = htmlspecialchars($post['input_title'], ENT_QUOTES, 'UTF-8');
$bodyClass       = "has-dark-hero";
$metaDescription = previewBody($post['text_body'], 30);

$related = selectContentDesc($conn, "panel_mm_blog", ["visibility" => "show"], "id", 4);
$related = array_filter($related, function($r) use ($hash) { return $r['hash_id'] !== $hash; });
$related = array_slice(array_values($related), 0, 3);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_11001o##*/>
<div data-cbcodesection="cbcode_11001">
<section class="page-hero" style="min-height:400px;">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <div data-admc-image="panel_mm_blog" data-admc-id="<?= $post['id'] ?>">
      <img src="<?= htmlspecialchars($post['image_1'], ENT_QUOTES, 'UTF-8') ?>"
           alt="<?= htmlspecialchars($post['input_title'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb">
        <a href="/">Home</a><i class="ph ph-caret-right"></i>
        <a href="/blog">Blog</a><i class="ph ph-caret-right"></i>
        <span>Article</span>
      </div>
      <div class="section-label" style="justify-content:center;">
        <?= htmlspecialchars($post['select_category'], ENT_QUOTES, 'UTF-8') ?>
      </div>
      <h1 data-admc-manage="panel_mm_blog" data-admc-id="<?= $post['id'] ?>">
        <?= htmlspecialchars($post['input_title'], ENT_QUOTES, 'UTF-8') ?>
      </h1>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_11001c##*/>

<?php/*##cbcode_11002o##*/>
<div data-cbcodesection="cbcode_11002">
<section class="article-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="article-container">
      <div class="article-meta fade-in">
        <span class="news-tag" style="position:static;background:var(--primary);color:#000;font-size:12px;padding:5px 12px;border-radius:999px;font-weight:700;">
          <?= htmlspecialchars($post['select_category'], ENT_QUOTES, 'UTF-8') ?>
        </span>
        <span style="font-size:13px;color:var(--text-muted);">
          <?= !empty($post['dated_published']) ? decodeDate($post['dated_published']) : decodeDate($post['date_created']) ?>
        </span>
        <span style="font-size:13px;color:var(--text-muted);">&middot;</span>
        <span style="font-size:13px;color:var(--text-muted);"><?= htmlspecialchars($post['input_read_time'], ENT_QUOTES, 'UTF-8') ?></span>
        <span style="font-size:13px;color:var(--text-muted);">&middot;</span>
        <span style="font-size:13px;color:var(--text-muted);">By <?= htmlspecialchars($post['input_author'] ?: $site_name, ENT_QUOTES, 'UTF-8') ?></span>
      </div>
      <div class="article-body fade-in"
           data-admc-manage="panel_mm_blog" data-admc-id="<?= $post['id'] ?>">
        <?= nl2br(htmlspecialchars($post['text_body'], ENT_QUOTES, 'UTF-8')) ?>
      </div>
      <div class="author-card fade-in">
        <img src="<?= htmlspecialchars($logo_directory, ENT_QUOTES, 'UTF-8') ?>"
             alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
             class="author-avatar">
        <div class="author-info">
          <h4><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></h4>
          <p>Fractional CTO and creator of the Decentralized A-Team Method. Mike has spent 20+ years helping tech leaders build organizations that scale without chaos.</p>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_11002c##*/>

<?php if (!empty($related)): ?>
<?php/*##cbcode_11003o##*/>
<div data-cbcodesection="cbcode_11003">
<section class="blog-section" style="padding:72px 0;background:var(--bg-secondary);">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Keep Reading</div>
      <h2 class="section-title">Related <span class="gradient-text">Articles</span></h2>
    </div>
    <div class="blog-grid" style="grid-template-columns:repeat(3,1fr);">
      <?php foreach ($related as $i => $r): ?>
        <a href="/blog/<?= $r['hash_id'] ?>/<?= cleans($r['input_title']) ?>"
           class="blog-card fade-in" style="transition-delay:<?= $i*0.1 ?>s;text-decoration:none;color:inherit;">
          <div class="blog-img">
            <img src="<?= htmlspecialchars($r['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= htmlspecialchars($r['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                 style="width:100%;height:200px;object-fit:cover;display:block;">
            <span class="blog-tag"><?= htmlspecialchars($r['select_category'], ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="blog-body">
            <div class="blog-meta">
              <span><?= !empty($r['dated_published']) ? decodeDate($r['dated_published']) : decodeDate($r['date_created']) ?></span>
            </div>
            <h3><?= htmlspecialchars($r['input_title'], ENT_QUOTES, 'UTF-8') ?></h3>
            <span class="blog-read-more">Read More <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_11003c##*/>
<?php endif; ?>

<?php/*##cbcode_11004o##*/>
<div data-cbcodesection="cbcode_11004">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Ready to Implement <span class="gradient-text">These Frameworks?</span></h2>
      <p>Reading is step one. Working with Mike is how you make it real in your organization.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book a Strategy Session
        </a>
        <a href="/blog" class="btn btn-outline">
          <i class="ph ph-arrow-left"></i> Back to Blog
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_11004c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
