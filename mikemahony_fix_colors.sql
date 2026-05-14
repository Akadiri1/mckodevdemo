-- ============================================================
-- Mike Mahony — Color Fix (no WHERE id needed)
-- Run in phpMyAdmin — Query tab
-- ============================================================

USE nextshine;

-- Fix primary color → gold, set status live
-- Uses hash_id from your row (safe, no hardcoded id)
UPDATE `website_status`
SET
  `color`              = '#FFBF00',
  `secondary_color`    = '#050a14',
  `bgcolor_background` = '#050a14',
  `bgcolor_surface`    = '#0a1128',
  `textcolor_heading`  = '#f9fafb',
  `textcolor_body`     = '#d1d5db',
  `textcolor_muted`    = '#9ca3af',
  `status`             = 'live'
WHERE `hash_id` = 'y7633gusdsd';

-- Update site info
UPDATE `settings_website_info`
SET
  `input_name`                   = 'Mike Mahony',
  `input_email`                  = 'hello@mikemahony.com',
  `input_email_smtp_host`        = 'smtp.gmail.com',
  `input_email_smtp_secure_type` = 'tls',
  `input_email_smtp_port`        = '587',
  `input_address`                = 'North Las Vegas, Nevada',
  `input_linkedin`               = 'https://www.linkedin.com/in/michaeljmahony/',
  `input_seo_keywords`           = 'Fractional CTO, NetSuite Expert, DCAT Method, Tech Leadership',
  `text_description`             = 'Mike Mahony helps tech leaders and NetSuite-driven operators eliminate decision bottlenecks and build autonomous, high-performing teams.',
  `image_1`                      = '/uploads/mm_logo.jpg'
LIMIT 1;
