<?php
$page_title = "Book a Strategy Session";
$bodyClass  = "has-dark-hero";

$steps = selectContentAsc($conn, "panel_mm_session_steps", ["visibility" => "show"], "input_order", 10);
$faqs  = selectContentAsc($conn, "panel_mm_faq",           ["visibility" => "show"], "input_order", 10);

include 'includes/mm_header.php';
?>

<div data-cbsection="cb1">
<?php/*##cb1o##*/>

<!-- ── Page Hero ─────────────────────────────────────────── -->
<?php/*##cbcode_70001o##*/>
<div data-cbcodesection="cbcode_70001">
<section class="page-hero">
  <div class="section-shine"></div>
  <div class="page-hero-bg">
    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1920" alt="Book a Strategy Session">
  </div>
  <div class="container">
    <div class="page-hero-content">
      <div class="breadcrumb">
        <a href="/">Home</a><i class="ph ph-caret-right"></i><span>Book a Strategy Session</span>
      </div>
      <div class="section-label">Free 30-Minute Call</div>
      <h1>Book Your <span class="gradient-text">Strategy Session</span></h1>
      <p>A focused conversation about your biggest tech challenge. No pitch, no pressure. Just honest guidance on whether and how Mike can help.</p>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_70001c##*/>

<!-- ── Booking Form + Info ───────────────────────────────── -->
<?php/*##cbcode_70002o##*/>
<div data-cbcodesection="cbcode_70002">
<section class="contact-section">
  <div class="section-shine"></div>
  <div class="container">
    <div class="contact-grid">

      <!-- Left: What to expect -->
      <div class="fade-in-left">
        <h3>What to <span class="gradient-text">Expect</span></h3>
        <p style="font-size:15px;color:var(--text-secondary);line-height:1.8;margin-bottom:28px;">
          This is a 30-minute working call — not a sales pitch. Mike will ask sharp questions and give honest guidance, whether or not there is a fit.
        </p>
        <div class="contact-methods">
          <div class="contact-method">
            <div class="icon"><i class="ph ph-clock"></i></div>
            <div>
              <h4>30 Minutes</h4>
              <p>Focused and efficient — Mike respects your calendar.</p>
            </div>
          </div>
          <div class="contact-method">
            <div class="icon"><i class="ph ph-video-camera"></i></div>
            <div>
              <h4>Video Call (Zoom / Google Meet)</h4>
              <p>Link sent via email after booking confirmation.</p>
            </div>
          </div>
          <div class="contact-method">
            <div class="icon"><i class="ph ph-map-pin"></i></div>
            <div>
              <h4>Available Globally</h4>
              <p>Mike works with clients across North America, Europe, and beyond.</p>
            </div>
          </div>
          <div class="contact-method">
            <div class="icon"><i class="ph ph-chat-circle-dots"></i></div>
            <div>
              <h4>Topics We Can Cover</h4>
              <p>NetSuite reporting, team bottlenecks, DCAT Method, Fractional CTO needs, or technology strategy.</p>
            </div>
          </div>
        </div>
        <div style="margin-top:28px;">
          <p style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1.2px;color:var(--text-muted);margin-bottom:12px;">
            OR BOOK DIRECTLY
          </p>
          <a href="https://GetYourVirtualCTO.com/StrategySession"
             target="_blank" rel="noopener"
             class="contact-method" style="display:flex;text-decoration:none;color:inherit;">
            <div class="icon"><i class="ph ph-calendar-check"></i></div>
            <div>
              <h4>Open Booking Calendar</h4>
              <p>Pick a time directly at GetYourVirtualCTO.com</p>
            </div>
            <i class="ph ph-arrow-square-out" style="margin-left:auto;color:var(--primary);font-size:20px;align-self:center;"></i>
          </a>
        </div>
      </div>

      <!-- Right: Booking form -->
      <div class="contact-form-card fade-in-right">
        <h3>Request Your <span class="gradient-text">Session</span></h3>
        <p style="font-size:14px;color:var(--text-muted);margin-bottom:24px;line-height:1.6;">
          Fill out the form and Mike's team will confirm your time within 1 business day.
        </p>

        <form id="mmSessionForm" onsubmit="mmHandleSession(event)">
          <div class="form-row">
            <div class="form-group">
              <label>First Name *</label>
              <input type="text" name="first_name" placeholder="John" required>
            </div>
            <div class="form-group">
              <label>Last Name *</label>
              <input type="text" name="last_name" placeholder="Smith" required>
            </div>
          </div>
          <div class="form-group">
            <label>Email Address *</label>
            <input type="email" name="email" placeholder="john@company.com" required>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Company</label>
              <input type="text" name="company" placeholder="Acme Corp">
            </div>
            <div class="form-group">
              <label>Your Role</label>
              <input type="text" name="role" placeholder="CTO / CEO / VP Eng">
            </div>
          </div>
          <div class="form-group">
            <label>Phone Number (optional)</label>
            <input type="tel" name="phone" placeholder="+1 (555) 000-0000">
          </div>
          <div class="form-group">
            <label>Primary Topic *</label>
            <select name="service" required>
              <option value="">Select the main topic&hellip;</option>
              <option value="netsuite">NetSuite Reporting Chaos</option>
              <option value="dcat">Team Bottlenecks / DCAT Method</option>
              <option value="cto">Fractional CTO Services</option>
              <option value="strategy">General Technology Strategy</option>
              <option value="other">Other / Not Sure Yet</option>
            </select>
          </div>
          <div class="form-group">
            <label>Company Revenue Range</label>
            <select name="revenue">
              <option value="">Select&hellip;</option>
              <option value="under5">Under $5M</option>
              <option value="5-10">$5M &ndash; $10M</option>
              <option value="10-20">$10M &ndash; $20M</option>
              <option value="20-50">$20M &ndash; $50M</option>
              <option value="50plus">$50M+</option>
            </select>
          </div>
          <div class="form-group">
            <label>Describe Your Biggest Challenge *</label>
            <textarea name="challenge" placeholder="Give Mike a quick summary of what is going wrong and what outcome you are hoping for&hellip;" required></textarea>
          </div>
          <div class="form-group">
            <label>How did you hear about Mike?</label>
            <select name="heard">
              <option value="">Select&hellip;</option>
              <option value="podcast">GTLE Podcast</option>
              <option value="linkedin">LinkedIn</option>
              <option value="google">Google Search</option>
              <option value="referral">Referral</option>
              <option value="other">Other</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary"
                  style="width:100%;justify-content:center;padding:16px 32px;">
            <i class="ph ph-calendar-check"></i> Request Strategy Session
          </button>
          <p style="font-size:12px;color:var(--text-muted);text-align:center;margin-top:12px;line-height:1.6;">
            Your info is never shared with third parties.
          </p>
        </form>

        <div id="mmSessionSuccess" style="display:none;text-align:center;padding:48px 20px;">
          <div style="font-size:56px;color:var(--primary);margin-bottom:20px;">
            <i class="ph ph-check-circle"></i>
          </div>
          <h3 style="margin-bottom:12px;">Request Received!</h3>
          <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:24px;">
            Mike's team will contact you within 1 business day to confirm your session time.
          </p>
          <a href="https://GetYourVirtualCTO.com/StrategySession"
             class="btn btn-outline" target="_blank" rel="noopener">
            <i class="ph ph-calendar"></i> Also Book Directly
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
</div>
<?php/*##cbcode_70002c##*/>

<!-- ── What Happens Next (Process Steps) ─────────────────── -->
<?php/*##cbcode_70003o##*/>
<div data-cbcodesection="cbcode_70003">
<section class="opportunities" style="background:var(--bg-secondary);padding:80px 0;">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">After You Book</div>
      <h2 class="section-title">What Happens <span class="gradient-text">Next</span></h2>
    </div>
    <div class="process-grid" data-admc-tb="panel_mm_session_steps">
      <?php foreach ($steps as $i => $step): ?>
        <div class="process-step fade-in" style="transition-delay:<?= $i * 0.08 ?>s">
          <div class="step-icon">
            <i class="<?= htmlspecialchars($step['icon_step_icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
          </div>
          <h4 data-admc-manage="panel_mm_session_steps"
              data-admc-id="<?= $step['id'] ?>">
            <?= htmlspecialchars($step['input_title'], ENT_QUOTES, 'UTF-8') ?>
          </h4>
          <p data-admc-manage="panel_mm_session_steps"
             data-admc-id="<?= $step['id'] ?>">
            <?= htmlspecialchars($step['text_description'], ENT_QUOTES, 'UTF-8') ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_70003c##*/>

<!-- ── FAQ ───────────────────────────────────────────────── -->
<?php/*##cbcode_70004o##*/>
<div data-cbcodesection="cbcode_70004">
<section class="faq-section" style="background:var(--bg-primary);">
  <div class="section-shine"></div>
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Before You Book</div>
      <h2 class="section-title">Common <span class="gradient-text">Questions</span></h2>
    </div>
    <div class="faq-list" data-admc-tb="panel_mm_faq">
      <?php foreach ($faqs as $faq): ?>
        <div class="faq-item fade-in">
          <div class="faq-question">
            <h4 data-admc-manage="panel_mm_faq" data-admc-id="<?= $faq['id'] ?>">
              <?= htmlspecialchars($faq['input_question'], ENT_QUOTES, 'UTF-8') ?>
            </h4>
            <span class="faq-toggle"><i class="ph ph-plus"></i></span>
          </div>
          <div class="faq-answer">
            <p data-admc-manage="panel_mm_faq" data-admc-id="<?= $faq['id'] ?>">
              <?= htmlspecialchars($faq['text_answer'], ENT_QUOTES, 'UTF-8') ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>
<?php/*##cbcode_70004c##*/>

<?php/*##cb1c##*/>
</div>

<script>
function mmHandleSession(e) {
  e.preventDefault();
  var data = {};
  e.target.querySelectorAll('input, select, textarea').forEach(function(el) {
    if (el.name) data[el.name] = el.value;
  });
  fetch('/mm-book-session', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  }).finally(function() {
    document.getElementById('mmSessionForm').style.display = 'none';
    document.getElementById('mmSessionSuccess').style.display = 'block';
  });
}
</script>

<?php include 'includes/mm_footer.php'; ?>
