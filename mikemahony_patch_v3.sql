-- ============================================================
-- Mike Mahony — Patch v3
-- Uses existing settings_website_info + website_status tables.
-- No new settings tables needed.
--
-- Run: mysql -u root nextshine < mikemahony_patch_v3.sql
-- ============================================================

USE nextshine;

-- ── 1. Add only the NEW columns that settings_website_info is missing ────────
-- (Existing columns: input_name, input_email, input_email_from,
--  input_email_smtp_host, input_email_smtp_secure_type, input_email_smtp_port,
--  input_email_password, input_phone_number, input_address, input_linkedin,
--  input_facebook, input_instagram, input_twitter, input_pinterest,
--  input_seo_keywords, text_description, image_1, input_image_width, etc.)

ALTER TABLE `settings_website_info`
  ADD COLUMN `input_tagline`          VARCHAR(255) DEFAULT 'Fractional CTO' AFTER `input_name`,
  ADD COLUMN `input_podcast_link`     VARCHAR(255) AFTER `input_linkedin`,
  ADD COLUMN `input_apple_podcast`    VARCHAR(500) AFTER `input_podcast_link`,
  ADD COLUMN `input_book_session_url` VARCHAR(500) AFTER `input_apple_podcast`;

-- ── 2. Update the existing row with Mike Mahony data ────────────────────────
-- This replaces the NextShine Cleaning data.
-- Fill input_email_from, input_email_password after running.

UPDATE `settings_website_info`
SET
  `input_name`             = 'Mike Mahony',
  `input_tagline`          = 'Fractional CTO',
  `input_email`            = 'hello@mikemahony.com',
  `input_email_smtp_host`  = 'smtp.gmail.com',
  `input_email_smtp_secure_type` = 'tls',
  `input_email_smtp_port`  = '587',
  `input_phone_number`     = '',
  `input_address`          = 'North Las Vegas, Nevada',
  `input_linkedin`         = 'https://www.linkedin.com/in/michaeljmahony/',
  `input_podcast_link`     = 'https://gtle.show',
  `input_apple_podcast`    = 'https://podcasts.apple.com/us/podcast/gaining-the-technology-leadership-edge/id1664607772',
  `input_book_session_url` = 'https://GetYourVirtualCTO.com/StrategySession',
  `input_seo_keywords`     = 'Fractional CTO, NetSuite Expert, DCAT Method, Tech Leadership, Mike Mahony',
  `text_description`       = 'Mike Mahony helps tech leaders and NetSuite-driven operators eliminate decision bottlenecks and build autonomous, high-performing teams.',
  `image_1`                = '/uploads/mm_logo.jpg',
  `input_image_width`      = '48'
WHERE id = 1;

-- ── 3. Add extra colour columns to website_status ───────────────────────────
-- website_status already has: color (primary), secondary_color
-- Adding text colors so they are also editable as colour pickers in ADMC.

ALTER TABLE `website_status`
  ADD COLUMN `bgcolor_background`  VARCHAR(100) DEFAULT '#050a14' AFTER `secondary_color`,
  ADD COLUMN `bgcolor_surface`     VARCHAR(100) DEFAULT '#0a1128' AFTER `bgcolor_background`,
  ADD COLUMN `textcolor_heading`   VARCHAR(100) DEFAULT '#f9fafb' AFTER `bgcolor_surface`,
  ADD COLUMN `textcolor_body`      VARCHAR(100) DEFAULT '#d1d5db' AFTER `textcolor_heading`,
  ADD COLUMN `textcolor_muted`     VARCHAR(100) DEFAULT '#9ca3af' AFTER `textcolor_body`;

-- Update website_status with Mike Mahony theme
UPDATE `website_status`
SET
  `status`             = 'live',
  `color`              = '#FFBF00',
  `secondary_color`    = '#050a14',
  `bgcolor_background` = '#050a14',
  `bgcolor_surface`    = '#0a1128',
  `textcolor_heading`  = '#f9fafb',
  `textcolor_body`     = '#d1d5db',
  `textcolor_muted`    = '#9ca3af'
WHERE id = 1;
