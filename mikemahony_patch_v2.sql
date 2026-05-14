-- ============================================================
-- Mike Mahony — Patch v2
-- Run this ONLY if you already ran mikemahony_tables.sql
-- Adds: SMTP email fields, theme colour table
-- mysql -u root nextshine < mikemahony_patch_v2.sql
-- ============================================================

USE nextshine;

-- ── Add SMTP fields to settings_mm_info ─────────────────────
-- These are edited from the ADMC admin panel and used by
-- the contact and session booking email backends.

ALTER TABLE `settings_mm_info`
  ADD COLUMN `input_email_from`             VARCHAR(255) DEFAULT '' AFTER `input_email`,
  ADD COLUMN `input_email_smtp_host`        VARCHAR(255) DEFAULT 'smtp.gmail.com' AFTER `input_email_from`,
  ADD COLUMN `input_email_smtp_secure_type` VARCHAR(20)  DEFAULT 'tls'  AFTER `input_email_smtp_host`,
  ADD COLUMN `input_email_smtp_port`        VARCHAR(10)  DEFAULT '587'  AFTER `input_email_smtp_secure_type`,
  ADD COLUMN `input_email_password`         VARCHAR(255) DEFAULT '' AFTER `input_email_smtp_port`;

-- Pre-fill defaults for the existing row
UPDATE `settings_mm_info`
SET
  `input_email_smtp_host`        = 'smtp.gmail.com',
  `input_email_smtp_secure_type` = 'tls',
  `input_email_smtp_port`        = '587'
WHERE `hash_id` = 'mminfo001'
  AND (`input_email_smtp_host` IS NULL OR `input_email_smtp_host` = '');

-- ── Create theme colour table ────────────────────────────────
-- bgcolor_  columns → rendered as colour pickers in ADMC
-- textcolor_ columns → rendered as colour pickers in ADMC
-- Values are injected as CSS variables in mm_header.php

CREATE TABLE IF NOT EXISTS `settings_mm_theme` (
  `id`                   INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`              VARCHAR(255) NOT NULL,
  `bgcolor_primary`      VARCHAR(100) DEFAULT '#FFBF00',  -- gold accent
  `bgcolor_primary_dark` VARCHAR(100) DEFAULT '#cc9900',  -- darker gold
  `bgcolor_background`   VARCHAR(100) DEFAULT '#050a14',  -- page background
  `bgcolor_surface`      VARCHAR(100) DEFAULT '#0a1128',  -- card / secondary bg
  `textcolor_heading`    VARCHAR(100) DEFAULT '#f9fafb',  -- h1 h2 h3
  `textcolor_body`       VARCHAR(100) DEFAULT '#d1d5db',  -- paragraph text
  `textcolor_muted`      VARCHAR(100) DEFAULT '#9ca3af',  -- labels, meta
  `visibility`           VARCHAR(50)  DEFAULT 'show',
  `date_created`         DATE NOT NULL,
  `time_created`         TIME NOT NULL,
  `created_by`           VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO `settings_mm_theme` VALUES (
  1, 'mmtheme001',
  '#FFBF00', '#cc9900', '#050a14', '#0a1128',
  '#f9fafb', '#d1d5db', '#9ca3af',
  'show', CURDATE(), CURTIME(), 'system'
);
