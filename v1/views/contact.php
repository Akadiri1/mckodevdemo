<?php
$page_title = "Contact";
$bodyClass  = "has-dark-hero";

$cs = selectContent($conn, "settings_mm_contact", ["visibility" => "show"]);
$cs = !empty($cs) ? $cs[0] : [];

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<?php/*##cbcode_60001o##*/>
<div data-cbcodesection="cbcode_60001">
<section class="page-hero">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <img src="https://images.unsplash.com/photo-1551836022-4c4c79ecde51?auto=format&fit=crop&q=80&w=1920" alt="Contact">
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb"><a href="/">Home</a><i class="ph ph-caret-right"></i><span>Contact</span></div>
      <div class="section-label"
           <?= !empty($cs) ? 'data-admc-manage="settings_mm_contact" data-admc-id="'.$cs['id'].'"' : '' ?>>
        <?= htmlspecialchars($cs['input_label'] ?? 'Get in Touch', ENT_QUOTES, 'UTF-8') ?>
      </div>
      <h1 <?= !empty($cs) ? 'data-admc-manage="settings_mm_contact" data-admc-id="'.$cs['id'].'"' : '' ?>>
        <?= htmlspecialchars($cs['input_heading'] ?? "Let's Work", ENT_QUOTES, 'UTF-8') ?>
        <span class="gradient-text">
          <?= htmlspecialchars($cs['input_heading_highlight'] ?? 'Together', ENT_QUOTES, 'UTF-8') ?>
        </span>
      </h1>
      <p <?= !empty($cs) ? 'data-admc-manage="settings_mm_contact" data-admc-id="'.$cs['id'].'"' : '' ?>>
        <?= htmlspecialchars($cs['text_description'] ?? 'Whether it is a question about a service, a speaking inquiry, or just a quick hello — Mike reads every message.', ENT_QUOTES, 'UTF-8') ?>
      </p>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_60001c##*/>

<?php/*##cbcode_60002o##*/>
<div data-cbcodesection="cbcode_60002">
<section class="contact-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="contact-grid">

      <!-- Contact info -->
      <div class="fade-in-left">
        <h3>Reach <span class="gradient-text">Mike</span></h3>
        <p style="font-size:15px;color:var(--text-secondary);line-height:1.8;margin-bottom:28px;">
          The quickest path is a LinkedIn DM. Use the triggers below for the fastest response.
        </p>
        <div class="contact-methods">
          <a href="<?= htmlspecialchars($linkedinLink, ENT_QUOTES, 'UTF-8') ?>"
             class="contact-method" target="_blank" rel="noopener">
            <div class="icon"><i class="ph ph-linkedin-logo"></i></div>
            <div>
              <h4>LinkedIn</h4>
              <p>DM "DASHBOARD", "FIREFIGHTER", or "PODCAST" for fastest response.</p>
            </div>
          </a>
          <?php if (!empty($site_email)): ?>
            <a href="mailto:<?= htmlspecialchars($site_email, ENT_QUOTES, 'UTF-8') ?>" class="contact-method">
              <div class="icon"><i class="ph ph-envelope"></i></div>
              <div>
                <h4>Email</h4>
                <p><?= htmlspecialchars($site_email, ENT_QUOTES, 'UTF-8') ?></p>
              </div>
            </a>
          <?php endif; ?>
          <a href="/book-session" class="contact-method">
            <div class="icon"><i class="ph ph-calendar-check"></i></div>
            <div>
              <h4>Book a Strategy Session</h4>
              <p>Free 30-minute focused call — no pitch, just honest guidance.</p>
            </div>
          </a>
          <a href="https://gtle.show" class="contact-method" target="_blank" rel="noopener">
            <div class="icon"><i class="ph ph-microphone"></i></div>
            <div>
              <h4>Podcast — GTLE</h4>
              <p>Listen to 100+ episodes at gtle.show</p>
            </div>
          </a>
        </div>
      </div>

      <!-- Contact form -->
      <div class="contact-form-card fade-in-right">
        <h3>Send a <span class="gradient-text">Message</span></h3>
        <form id="mmContactForm" onsubmit="mmHandleContact(event)">
          <div class="form-row">
            <div class="form-group">
              <label>Name *</label>
              <input type="text" name="name" placeholder="Your full name" required>
            </div>
            <div class="form-group">
              <label>Email *</label>
              <input type="email" name="email" placeholder="you@company.com" required>
            </div>
          </div>
          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" placeholder="What is this about?">
          </div>
          <div class="form-group">
            <label>I am interested in&hellip;</label>
            <select name="service">
              <option value="">Select a topic</option>
              <option value="netsuite">NetSuite Reporting Sprint</option>
              <option value="dcat">DCAT Method / Team Coaching</option>
              <option value="cto">Fractional CTO Services</option>
              <option value="podcast">Podcast / Speaking</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>Message *</label>
            <textarea name="message" placeholder="Tell Mike what you are working on&hellip;" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:16px;">
            <i class="ph ph-paper-plane-right"></i> Send Message
          </button>
        </form>
        <div id="mmContactSuccess" style="display:none;text-align:center;padding:48px 20px;">
          <div style="font-size:48px;color:var(--primary);margin-bottom:16px;">
            <i class="ph ph-check-circle"></i>
          </div>
          <h3>Message Received!</h3>
          <p style="color:var(--text-secondary);margin-top:8px;">Mike will be in touch within 1 business day.</p>
        </div>
      </div>

    </div>
  </div>
</section>
</div>
<?php/*##cbcode_60002c##*/>

<?php/*##cb1c##*/>
</div>

<script>
function mmHandleContact(e) {
  e.preventDefault();
  var data = {};
  var inputs = e.target.querySelectorAll('input, select, textarea');
  inputs.forEach(function(el) { if(el.name) data[el.name] = el.value; });
  fetch('/mm-contact', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  }).finally(function() {
    document.getElementById('mmContactForm').style.display = 'none';
    document.getElementById('mmContactSuccess').style.display = 'block';
  });
}
</script>

<?php include 'includes/mm_footer.php'; ?>
