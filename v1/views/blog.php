<?php
$page_title = "Blog — Tech Leadership Insights";
$bodyClass  = "has-dark-hero";

$posts    = selectContentDesc($conn, "panel_mm_blog", ["visibility" => "show"], "id", 10);
$featured = !empty($posts) ? $posts[0] : null;
$rest     = array_slice($posts, 1);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_50001o##*/>
<div data-cbcodesection="cbcode_50001">
<section class="page-hero">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=1920" alt="Blog">
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb"><a href="/">Home</a><i class="ph ph-caret-right"></i><span>Blog</span></div>
      <div class="section-label">Insights &amp; Ideas</div>
      <h1>Tech Leadership <span class="gradient-text">Perspectives</span></h1>
      <p>Practical frameworks, hard-won lessons, and straight talk on NetSuite, CTO leadership, and building teams that scale.</p>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_50001c##*/>

<?php/*##cbcode_50002o##*/>
<div data-cbcodesection="cbcode_50002">
<section class="blog-section" style="padding:80px 0;">
  <div class="section-shine"></div>
  <div class="container">
    <div class="blog-grid" data-admc-tb="panel_mm_blog">

      <?php if ($featured): ?>
        <!-- Featured: image links to post, body is plain text -->
        <div class="blog-card-featured fade-in">
          <a href="/blog/<?= $featured['hash_id'] ?>/<?= cleans($featured['input_title']) ?>" class="blog-img">
            <div data-admc-image="panel_mm_blog" data-admc-id="<?= $featured['id'] ?>">
              <img src="<?= htmlspecialchars($featured['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($featured['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                   style="width:100%;height:100%;object-fit:cover;">
            </div>
            <span class="blog-tag">Featured</span>
          </a>
          <div class="blog-body">
            <div class="blog-meta">
              <span><?= htmlspecialchars($featured['select_category'], ENT_QUOTES, 'UTF-8') ?></span>
              <span class="sep"></span>
              <span><?= !empty($featured['dated_published']) ? decodeDate($featured['dated_published']) : decodeDate($featured['date_created']) ?></span>
              <span class="sep"></span>
              <span><?= htmlspecialchars($featured['input_read_time'], ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <h3 data-admc-manage="panel_mm_blog" data-admc-id="<?= $featured['id'] ?>">
              <a href="/blog/<?= $featured['hash_id'] ?>/<?= cleans($featured['input_title']) ?>" class="card-title-link">
                <?= htmlspecialchars($featured['input_title'], ENT_QUOTES, 'UTF-8') ?>
              </a>
            </h3>
            <p><?= previewBody($featured['text_body'], 30) ?></p>
          </div>
        </div>
      <?php endif; ?>

      <?php foreach ($rest as $i => $post): ?>
        <!-- Regular card: image links to post, body is plain text -->
        <div class="blog-card fade-in" style="transition-delay:<?= ($i % 3) * 0.1 ?>s">
          <a href="/blog/<?= $post['hash_id'] ?>/<?= cleans($post['input_title']) ?>" class="blog-img">
            <div data-admc-image="panel_mm_blog" data-admc-id="<?= $post['id'] ?>">
              <img src="<?= htmlspecialchars($post['image_1'], ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($post['input_title'], ENT_QUOTES, 'UTF-8') ?>"
                   style="width:100%;height:200px;object-fit:cover;display:block;">
            </div>
            <span class="blog-tag"><?= htmlspecialchars($post['select_category'], ENT_QUOTES, 'UTF-8') ?></span>
          </a>
          <div class="blog-body">
            <div class="blog-meta">
              <span><?= !empty($post['dated_published']) ? decodeDate($post['dated_published']) : decodeDate($post['date_created']) ?></span>
              <span class="sep"></span>
              <span><?= htmlspecialchars($post['input_read_time'], ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <h3 data-admc-manage="panel_mm_blog" data-admc-id="<?= $post['id'] ?>">
              <a href="/blog/<?= $post['hash_id'] ?>/<?= cleans($post['input_title']) ?>" class="card-title-link">
                <?= htmlspecialchars($post['input_title'], ENT_QUOTES, 'UTF-8') ?>
              </a>
            </h3>
            <p><?= previewBody($post['text_body'], 20) ?></p>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>
</div>
<?php/*##cbcode_50002c##*/>

<?php/*##cbcode_50003o##*/>
<div data-cbcodesection="cbcode_50003">
<section class="cta-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="cta-card fade-in">
      <h2>Want These Frameworks in <span class="gradient-text">Your Organization?</span></h2>
      <p>Reading is step one. Book a strategy session with Mike to implement them directly.</p>
      <div class="hero-actions" style="justify-content:center;">
        <a href="/book-session" class="btn btn-primary">
          <i class="ph ph-calendar-check"></i> Book a Strategy Session
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_50003c##*/>

<?php/*##cb1c##*/>
</div>

<?php include 'includes/mm_footer.php'; ?>
