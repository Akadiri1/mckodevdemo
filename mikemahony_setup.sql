-- ============================================================
-- Mike Mahony — Complete Database Setup (MySQL 5.7 compatible)
-- Import in phpMyAdmin or run:
--   mysql -u root nextshine < mikemahony_setup.sql
--
-- ORDER MATTERS:
--   1. New content tables created first (site starts working)
--   2. Existing tables updated last (ALTER TABLE + UPDATE)
-- ============================================================

USE nextshine;

-- ────────────────────────────────────────────────────────────
-- NAVIGATION
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `panel_mm_pages` (
  `id`           INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`      VARCHAR(255) NOT NULL,
  `input_name`   VARCHAR(255),
  `input_link`   VARCHAR(255),
  `input_order`  INT DEFAULT 0,
  `visibility`   VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL,
  `time_created` TIME NOT NULL,
  `created_by`   VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_pages` VALUES
(1,'mmpg001','Home','/',1,'show',CURDATE(),CURTIME(),'system'),
(2,'mmpg002','About','/about',2,'show',CURDATE(),CURTIME(),'system'),
(3,'mmpg003','Services','/services',3,'show',CURDATE(),CURTIME(),'system'),
(4,'mmpg004','Podcast','/podcast',4,'show',CURDATE(),CURTIME(),'system'),
(5,'mmpg005','Blog','/blog',5,'show',CURDATE(),CURTIME(),'system'),
(6,'mmpg006','Contact','/contact',6,'show',CURDATE(),CURTIME(),'system'),
(7,'mmpg007','Book Strategy Session','/book-session',7,'show',CURDATE(),CURTIME(),'system');

CREATE TABLE IF NOT EXISTS `addition_mm_pages` (
  `id`           INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`      VARCHAR(255) NOT NULL,
  `tb`           VARCHAR(255) DEFAULT 'panel_mm_pages',
  `tb_link`      VARCHAR(255),
  `input_name`   VARCHAR(255),
  `input_link`   VARCHAR(255),
  `input_order`  INT DEFAULT 0,
  `visibility`   VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL,
  `time_created` TIME NOT NULL,
  `created_by`   VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `addition_mm_pages` VALUES
(1,'mmapg001','panel_mm_pages','mmpg003','NetSuite Sprint','/services/mmns001/netsuite-reporting-clarity-sprint',1,'show',CURDATE(),CURTIME(),'system'),
(2,'mmapg002','panel_mm_pages','mmpg003','DCAT Method','/services/mmdc001/decentralized-a-team-method',2,'show',CURDATE(),CURTIME(),'system'),
(3,'mmapg003','panel_mm_pages','mmpg003','Fractional CTO','/services/mmcto01/fractional-cto-services',3,'show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- HOMEPAGE HERO
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `settings_mm_hero` (
  `id`                       INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`                  VARCHAR(255) NOT NULL,
  `input_badge`              VARCHAR(255),
  `input_heading`            VARCHAR(255),
  `input_heading_highlight`  VARCHAR(255),
  `input_heading_sub`        VARCHAR(255),
  `text_description`         TEXT,
  `input_btn1_label`         VARCHAR(255),
  `input_btn1_link`          VARCHAR(255),
  `input_btn2_label`         VARCHAR(255),
  `input_btn2_link`          VARCHAR(255),
  `input_stat1_number`       VARCHAR(50),
  `input_stat1_label`        VARCHAR(255),
  `input_stat2_number`       VARCHAR(50),
  `input_stat2_label`        VARCHAR(255),
  `input_stat3_number`       VARCHAR(50),
  `input_stat3_label`        VARCHAR(255),
  `image_1`                  TEXT,
  `input_video_url`          VARCHAR(500),
  `visibility`               VARCHAR(50) DEFAULT 'show',
  `date_created`             DATE NOT NULL,
  `time_created`             TIME NOT NULL,
  `created_by`               VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `settings_mm_hero` VALUES (
  1,'mmhero001',
  'Available for Fractional CTO Roles',
  'I Fix','Decision Bottlenecks','in Tech Teams',
  'Mike Mahony went from 105-hour weeks to building autonomous, high-performing teams. Whether you are a CTO stuck as the approval layer or a $5-20M operator drowning in reporting chaos, Mike has a proven system to fix it.',
  'Fix My NetSuite Reporting','/services/mmns001/netsuite-reporting-clarity-sprint',
  'Escape Firefighter Mode','/services/mmdc001/decentralized-a-team-method',
  '$40M','Revenue Growth',
  '$85M','Acquisition Price',
  '20+','Years Experience',
  'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=1920',
  'https://videos.pexels.com/video-files/3253106/3253106-hd_1920_1080_25fps.mp4',
  'show',CURDATE(),CURTIME(),'system'
);

-- ────────────────────────────────────────────────────────────
-- ABOUT BLOCK + FEATURES + ABOUT PAGE HERO
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `settings_mm_about_block` (
  `id`                       INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`                  VARCHAR(255) NOT NULL,
  `input_label`              VARCHAR(255),
  `input_heading`            VARCHAR(255),
  `input_heading_highlight`  VARCHAR(255),
  `text_description`         TEXT,
  `image_1`                  TEXT,
  `visibility`               VARCHAR(50) DEFAULT 'show',
  `date_created`             DATE NOT NULL,
  `time_created`             TIME NOT NULL,
  `created_by`               VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `settings_mm_about_block` VALUES (
  1,'mmabt001',
  'About Mike Mahony','Two Decades. Two Lanes.','One Mission.',
  'Mike Mahony has spent 20+ years as a CTO, consultant, and coach — working across SaaS, cybersecurity, fintech, manufacturing, and enterprise tech. He helps tech leaders escape the bottleneck trap and build autonomous teams.',
  'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=1920',
  'show',CURDATE(),CURTIME(),'system'
);

CREATE TABLE IF NOT EXISTS `panel_mm_about_features` (
  `id`                INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`           VARCHAR(255) NOT NULL,
  `icon_feature_icon` VARCHAR(100),
  `input_title`       VARCHAR(255),
  `text_description`  TEXT,
  `input_order`       INT DEFAULT 0,
  `visibility`        VARCHAR(50) DEFAULT 'show',
  `date_created`      DATE NOT NULL,
  `time_created`      TIME NOT NULL,
  `created_by`        VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_about_features` VALUES
(1,'mmaf001','ph ph-chart-bar','Lane 1 — NetSuite Clarity','Helping $5-$20M operators fix reporting chaos. His 21-Day Sprint locks KPI definitions and builds exec-ready dashboards.',1,'show',CURDATE(),CURTIME(),'system'),
(2,'mmaf002','ph ph-users-three','Lane 2 — Leadership Decentralization','Creator of the Decentralized A-Team Method (DCAT), helping CTOs escape firefighter mode by building autonomous teams.',2,'show',CURDATE(),CURTIME(),'system'),
(3,'mmaf003','ph ph-trophy','Key Career Milestone','Led tech strategy growing revenue from $4M to $40M, leading to a $85M acquisition by GrubHub.',3,'show',CURDATE(),CURTIME(),'system');

CREATE TABLE IF NOT EXISTS `settings_mm_about_hero` (
  `id`                       INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`                  VARCHAR(255) NOT NULL,
  `input_label`              VARCHAR(255),
  `input_heading`            VARCHAR(255),
  `input_heading_highlight`  VARCHAR(255),
  `text_description`         TEXT,
  `image_1`                  TEXT,
  `visibility`               VARCHAR(50) DEFAULT 'show',
  `date_created`             DATE NOT NULL,
  `time_created`             TIME NOT NULL,
  `created_by`               VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `settings_mm_about_hero` VALUES (
  1,'mmabh001',
  'The Story Behind the Framework','Two Decades.','One Mission.',
  'From 105-hour weeks to a proven system for autonomous tech teams. Mike Mahony has spent 20+ years solving the leadership challenges that stall growing companies.',
  'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=1920',
  'show',CURDATE(),CURTIME(),'system'
);

-- ────────────────────────────────────────────────────────────
-- SERVICES
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `panel_mm_services` (
  `id`                INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`           VARCHAR(255) NOT NULL,
  `icon_service_icon` VARCHAR(100),
  `input_title`       VARCHAR(255),
  `input_badge`       VARCHAR(50),
  `text_description`  TEXT,
  `input_cta_label`   VARCHAR(255),
  `input_cta_link`    VARCHAR(255),
  `input_slug`        VARCHAR(255),
  `input_order`       INT DEFAULT 0,
  `image_1`           TEXT,
  `visibility`        VARCHAR(50) DEFAULT 'show',
  `date_created`      DATE NOT NULL,
  `time_created`      TIME NOT NULL,
  `created_by`        VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_services` VALUES
(1,'mmns001','ph ph-chart-line','NetSuite Reporting Clarity Sprint','21 Days',
 'Stop the metric wars. In 21 days, Mike locks your KPI definitions, builds 3 exec-ready dashboards, and eliminates the reporting confusion slowing your decisions. Ideal for $5-$20M operators running on NetSuite who are tired of arguing over numbers in every leadership meeting.',
 'DM "DASHBOARD" to Get Started','https://www.linkedin.com/in/michaeljmahony/',
 'netsuite-reporting-clarity-sprint',1,
 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800',
 'show',CURDATE(),CURTIME(),'system'),
(2,'mmdc001','ph ph-users-four','The Decentralized A-Team Method','Coaching',
 'A leadership system designed to eliminate approval bottlenecks. Build a team that thinks, decides, and executes even when you step away. The DCAT method installs ownership maps, decision rules, and escalation paths that remove the CTO as the daily approval gate.',
 'DM "FIREFIGHTER" to Learn More','https://www.linkedin.com/in/michaeljmahony/',
 'decentralized-a-team-method',2,
 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=800',
 'show',CURDATE(),CURTIME(),'system'),
(3,'mmcto01','ph ph-strategy','Fractional CTO Services','On-Demand',
 'Senior technology leadership without the full-time cost. Advising on NetSuite, Shopify integrations, SuiteScript, and technology strategy for 7- and 8-figure companies. Mike embeds with your leadership team part-time to drive roadmap, vendor decisions, and engineering culture.',
 'Book a Strategy Session','/book-session',
 'fractional-cto-services',3,
 'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800',
 'show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- PORTFOLIO PROJECTS
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `panel_mm_projects` (
  `id`               INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`          VARCHAR(255) NOT NULL,
  `input_title`      VARCHAR(255),
  `text_description` TEXT,
  `input_order`      INT DEFAULT 0,
  `image_1`          TEXT,
  `visibility`       VARCHAR(50) DEFAULT 'show',
  `date_created`     DATE NOT NULL,
  `time_created`     TIME NOT NULL,
  `created_by`       VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_projects` VALUES
(1,'mmpr001','Cancer Diagnostics EDI','Integrated Cancer Diagnostics with GHX via AS2/EDI using Celigo and SuiteScripts. Zero issues on go-live.',1,'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(2,'mmpr002','Gardyn Integration','Integrated WooCommerce, Amazon, and a mobile app into NetSuite for seamless multi-channel operations.',2,'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(3,'mmpr003','Lean Factory','Revamped NetSuite workflows and Shopify integration. Achieved 10%+ productivity increase within 2 weeks.',3,'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(4,'mmpr004','Executive Dashboard Build','Designed an exec KPI layer that gave leadership a single source of truth for revenue, operations, and delivery status.',4,'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(5,'mmpr005','Team Decentralization Rollout','Implemented ownership maps, decision rules, and escalation paths that removed the CTO as the daily approval gate.',5,'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- PODCAST
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `selection_mm_podcast_cat` (
  `id` INT PRIMARY KEY AUTO_INCREMENT, `hash_id` VARCHAR(255) NOT NULL,
  `input_name` VARCHAR(255), `visibility` VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL, `time_created` TIME NOT NULL, `created_by` VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `selection_mm_podcast_cat` VALUES
(1,'mmpc001','Leadership','show',CURDATE(),CURTIME(),'system'),
(2,'mmpc002','NetSuite','show',CURDATE(),CURTIME(),'system'),
(3,'mmpc003','Scaling','show',CURDATE(),CURTIME(),'system'),
(4,'mmpc004','Strategy','show',CURDATE(),CURTIME(),'system'),
(5,'mmpc005','Hiring','show',CURDATE(),CURTIME(),'system'),
(6,'mmpc006','AI & Tech','show',CURDATE(),CURTIME(),'system');

CREATE TABLE IF NOT EXISTS `panel_mm_podcast` (
  `id`                 INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`            VARCHAR(255) NOT NULL,
  `input_title`        VARCHAR(255),
  `input_theme_number` VARCHAR(50),
  `select_category`    VARCHAR(255),
  `text_description`   TEXT,
  `input_listen_link`  VARCHAR(500),
  `input_order`        INT DEFAULT 0,
  `image_1`            TEXT,
  `visibility`         VARCHAR(50) DEFAULT 'show',
  `date_created`       DATE NOT NULL,
  `time_created`       TIME NOT NULL,
  `created_by`         VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_podcast` VALUES
(1,'mmep001','Escaping the Approval Layer Trap','Key Theme 01','Leadership','Why most CTOs become the bottleneck and how the DCAT method eliminates decision friction. We cover ownership maps, decision rules, and escalation paths — the three structural changes that remove you as the single point of failure in your organization.','https://gtle.show',1,'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(2,'mmep002','NetSuite for 8-Figure Operators','Key Theme 02','NetSuite','How to fix reporting chaos and lock KPI definitions so your execs stop arguing about numbers. A deep dive into the 21-Day Sprint methodology and why most NetSuite implementations fail at the dashboard layer.','https://gtle.show',2,'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(3,'mmep003','Building the Decentralized A-Team','Key Theme 03','Scaling','Practical steps to move from a directive leadership style to a decentralized execution model. Including the common mistakes CTOs make when trying to delegate without the right systems in place.','https://gtle.show',3,'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(4,'mmep004','Making Decisions Without All the Facts','Key Theme 04','Strategy','How senior leaders build judgment frameworks that allow their teams to act with confidence under uncertainty. The difference between a gut call and a structured decision — and how to teach your team the latter.','https://gtle.show',4,'https://images.unsplash.com/photo-1551836022-4c4c79ecde51?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(5,'mmep005','Hiring A-Players Without Breaking the Bank','Key Theme 05','Hiring','How fractional and contract talent strategies let smaller companies punch above their weight class. When to hire full-time vs. fractional — and how to build a blended team that performs like a 50-person engineering org.','https://gtle.show',5,'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(6,'mmep006','Using AI Without Losing Control of Your Stack','Key Theme 06','AI & Tech','Practical guidance for CTOs integrating AI tools into existing operations without creating new chaos. How to evaluate AI vendors, set governance policies, and keep your engineers from going rogue with shadow AI tools.','https://gtle.show',6,'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- BLOG
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `selection_mm_blog_cat` (
  `id` INT PRIMARY KEY AUTO_INCREMENT, `hash_id` VARCHAR(255) NOT NULL,
  `input_name` VARCHAR(255), `visibility` VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL, `time_created` TIME NOT NULL, `created_by` VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `selection_mm_blog_cat` VALUES
(1,'mmbc001','Leadership','show',CURDATE(),CURTIME(),'system'),
(2,'mmbc002','NetSuite','show',CURDATE(),CURTIME(),'system'),
(3,'mmbc003','Fractional CTO','show',CURDATE(),CURTIME(),'system'),
(4,'mmbc004','DCAT','show',CURDATE(),CURTIME(),'system'),
(5,'mmbc005','AI & Tech','show',CURDATE(),CURTIME(),'system');

CREATE TABLE IF NOT EXISTS `panel_mm_blog` (
  `id`               INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`          VARCHAR(255) NOT NULL,
  `input_title`      VARCHAR(255),
  `input_slug`       VARCHAR(255),
  `select_category`  VARCHAR(255),
  `text_body`        LONGTEXT,
  `input_read_time`  VARCHAR(50),
  `input_author`     VARCHAR(255),
  `dated_published`  DATE,
  `image_1`          TEXT,
  `visibility`       VARCHAR(50) DEFAULT 'show',
  `date_created`     DATE NOT NULL,
  `time_created`     TIME NOT NULL,
  `created_by`       VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_blog` VALUES
(1,'mmbl001','Why Every CTO Eventually Becomes the Bottleneck','why-every-cto-becomes-the-bottleneck','Leadership','It starts subtly. You approve one more decision. You review one more PR. Before you know it, your team cannot move without you and you are working 80-hour weeks wondering where your strategy time went.\n\nThis is the bottleneck trap. The fix is structural, not personal. The Decentralized A-Team Method gives your team the systems to act without you: ownership maps, decision rules, and clean escalation paths.\n\nBook a strategy session to see how DCAT applies to your situation.','8 min read','Mike Mahony',CURDATE(),'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(2,'mmbl002','The 5 NetSuite KPIs That Actually Matter for $10M+ Operators','netsuite-kpis-that-matter','NetSuite','Most NetSuite dashboards are full of metrics nobody acts on. The five KPIs that actually drive exec decisions: Days Sales Outstanding, Gross Margin by Product Line, Fulfillment Cycle Time, Return Rate by SKU, and Headcount to Revenue Ratio.\n\nThe 21-Day NetSuite Clarity Sprint locks definitions for all five and builds exec-ready dashboards your team will actually use.','6 min read','Mike Mahony',CURDATE(),'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system'),
(3,'mmbl003','Is a Fractional CTO Right for Your Stage of Growth?','fractional-cto-right-for-you','Fractional CTO','Not every company needs a full-time CTO. Under $5M: you need a strong technical co-founder. $5M to $20M: this is the Fractional CTO sweet spot. $20M and above: you likely need full-time.\n\nBook a session to get an honest read on your situation.','5 min read','Mike Mahony',CURDATE(),'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800','show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- TESTIMONIALS
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `panel_mm_testimonials` (
  `id`             INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`        VARCHAR(255) NOT NULL,
  `input_name`     VARCHAR(255),
  `input_role`     VARCHAR(255),
  `input_company`  VARCHAR(255),
  `text_quote`     TEXT,
  `input_initials` VARCHAR(10),
  `input_order`    INT DEFAULT 0,
  `image_1`        TEXT,
  `visibility`     VARCHAR(50) DEFAULT 'show',
  `date_created`   DATE NOT NULL,
  `time_created`   TIME NOT NULL,
  `created_by`     VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_testimonials` VALUES
(1,'mmtm001','Jon Blaylock','Client','','Working with Mike was a real joy. He broke down the challenges we were facing very quickly, laying out extremely clear and insightful solutions which resonated off the bat.','JB',1,NULL,'show',CURDATE(),CURTIME(),'system'),
(2,'mmtm002','Podcast Listener','Apple Podcasts','','Mike asks questions with the precision of a surgeon. And he also knows when to step in and give great examples that turn abstract ideas into practical steps.','ML',2,NULL,'show',CURDATE(),CURTIME(),'system'),
(3,'mmtm003','Podcast Listener','Apple Podcasts','','Mike Mahony''s show taps into what tech leaders need most — real conversations with experts from all aspects of leading a business.','KP',3,NULL,'show',CURDATE(),CURTIME(),'system'),
(4,'mmtm004','Client Success Lead','Operations','','Mike has a rare ability to make complicated systems feel manageable. He gives structure without adding noise.','CS',4,NULL,'show',CURDATE(),CURTIME(),'system'),
(5,'mmtm005','Tech Leader','CTO','','The DCAT approach gave our team a shared language for ownership and execution. It changed how we operate.','TL',5,NULL,'show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- HOMEPAGE CTA
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `settings_mm_cta` (
  `id`                       INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`                  VARCHAR(255) NOT NULL,
  `input_heading`            VARCHAR(255),
  `input_heading_highlight`  VARCHAR(255),
  `text_description`         TEXT,
  `input_btn1_label`         VARCHAR(255),
  `input_btn1_link`          VARCHAR(255),
  `input_btn2_label`         VARCHAR(255),
  `input_btn2_link`          VARCHAR(255),
  `input_btn3_label`         VARCHAR(255),
  `input_btn3_link`          VARCHAR(255),
  `visibility`               VARCHAR(50) DEFAULT 'show',
  `date_created`             DATE NOT NULL,
  `time_created`             TIME NOT NULL,
  `created_by`               VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `settings_mm_cta` VALUES (
  1,'mmcta001',
  'Ready to Stop Being the','Bottleneck?',
  'Whether it is NetSuite chaos or team chaos, the root issue is the same: unclear decision ownership. Let us fix it.',
  'DM "DASHBOARD"','https://www.linkedin.com/in/michaeljmahony/',
  'DM "FIREFIGHTER"','https://www.linkedin.com/in/michaeljmahony/',
  'DM "PODCAST"','https://www.linkedin.com/in/michaeljmahony/',
  'show',CURDATE(),CURTIME(),'system'
);

-- ────────────────────────────────────────────────────────────
-- CONTACT PAGE
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `settings_mm_contact` (
  `id`                       INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`                  VARCHAR(255) NOT NULL,
  `input_label`              VARCHAR(255),
  `input_heading`            VARCHAR(255),
  `input_heading_highlight`  VARCHAR(255),
  `text_description`         TEXT,
  `image_1`                  TEXT,
  `visibility`               VARCHAR(50) DEFAULT 'show',
  `date_created`             DATE NOT NULL,
  `time_created`             TIME NOT NULL,
  `created_by`               VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `settings_mm_contact` VALUES (
  1,'mmcp001',
  'Get in Touch','Let''s Work','Together',
  'Whether it is a question about a service, a speaking inquiry, or just a quick hello — Mike reads every message.',
  'https://images.unsplash.com/photo-1551836022-4c4c79ecde51?auto=format&fit=crop&q=80&w=1920',
  'show',CURDATE(),CURTIME(),'system'
);

-- ────────────────────────────────────────────────────────────
-- BOOK SESSION — PROCESS STEPS
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `panel_mm_session_steps` (
  `id`               INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`          VARCHAR(255) NOT NULL,
  `icon_step_icon`   VARCHAR(100),
  `input_title`      VARCHAR(255),
  `text_description` TEXT,
  `input_order`      INT DEFAULT 0,
  `visibility`       VARCHAR(50) DEFAULT 'show',
  `date_created`     DATE NOT NULL,
  `time_created`     TIME NOT NULL,
  `created_by`       VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_session_steps` VALUES
(1,'mmss001','ph ph-envelope-open','Confirmation Email','You will receive a confirmation email within 1 business day with your scheduled time and a calendar invite.',1,'show',CURDATE(),CURTIME(),'system'),
(2,'mmss002','ph ph-file-text','Light Prep','Optional: bring 2 to 3 bullet points about your biggest challenge so Mike can go deep fast. No slides needed.',2,'show',CURDATE(),CURTIME(),'system'),
(3,'mmss003','ph ph-video-camera','The 30-Minute Call','Mike listens first, then asks precise diagnostic questions. He will give you honest perspective even if the answer is that you do not need him.',3,'show',CURDATE(),CURTIME(),'system'),
(4,'mmss004','ph ph-arrow-right','Clear Next Steps','Whether it is a proposal, a resource recommendation, or a LinkedIn DM trigger — you will leave with a clear next step, not a vague follow-up.',4,'show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- BOOK SESSION — FAQ
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `panel_mm_faq` (
  `id`               INT PRIMARY KEY AUTO_INCREMENT,
  `hash_id`          VARCHAR(255) NOT NULL,
  `input_question`   VARCHAR(500),
  `text_answer`      TEXT,
  `input_order`      INT DEFAULT 0,
  `visibility`       VARCHAR(50) DEFAULT 'show',
  `date_created`     DATE NOT NULL,
  `time_created`     TIME NOT NULL,
  `created_by`       VARCHAR(255) NOT NULL
);
INSERT IGNORE INTO `panel_mm_faq` VALUES
(1,'mmfq001','Is the strategy session really free?','Yes. Mike offers a free 30-minute session to understand your situation before any engagement. There is no obligation to work together after the call.',1,'show',CURDATE(),CURTIME(),'system'),
(2,'mmfq002','Who is this session for?','CTOs, VPs of Engineering, and business owners running companies on NetSuite or dealing with tech team bottlenecks. Typically companies in the $5M to $50M revenue range.',2,'show',CURDATE(),CURTIME(),'system'),
(3,'mmfq003','What if I am not sure which service I need?','That is fine — it is actually the most common situation. Just describe your biggest pain point in the form. Mike will help you diagnose the root issue on the call.',3,'show',CURDATE(),CURTIME(),'system'),
(4,'mmfq004','How quickly can Mike start after the session?','Sprint engagements typically start within 1 to 2 weeks of a signed agreement. Fractional CTO retainers usually begin the following month.',4,'show',CURDATE(),CURTIME(),'system'),
(5,'mmfq005','Can I just DM Mike on LinkedIn instead?','Absolutely. DM "DASHBOARD" for NetSuite, "FIREFIGHTER" for DCAT coaching, or "PODCAST" to connect around the show.',5,'show',CURDATE(),CURTIME(),'system');

-- ────────────────────────────────────────────────────────────
-- FORM SUBMISSION TABLES (read_ = view/edit only in ADMC)
-- ────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `read_mm_messages` (
  `id` INT PRIMARY KEY AUTO_INCREMENT, `hash_id` VARCHAR(255) NOT NULL,
  `input_name` VARCHAR(255), `input_email` VARCHAR(255),
  `input_subject` VARCHAR(255), `input_service` VARCHAR(255), `text_message` TEXT,
  `visibility` VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL, `time_created` TIME NOT NULL, `created_by` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `read_mm_sessions` (
  `id` INT PRIMARY KEY AUTO_INCREMENT, `hash_id` VARCHAR(255) NOT NULL,
  `input_first_name` VARCHAR(255), `input_last_name` VARCHAR(255),
  `input_email` VARCHAR(255), `input_company` VARCHAR(255), `input_role` VARCHAR(255),
  `input_phone` VARCHAR(50), `input_service` VARCHAR(255), `input_revenue` VARCHAR(50),
  `input_heard` VARCHAR(255), `text_challenge` TEXT,
  `visibility` VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL, `time_created` TIME NOT NULL, `created_by` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `read_mm_newsletter` (
  `id` INT PRIMARY KEY AUTO_INCREMENT, `hash_id` VARCHAR(255) NOT NULL,
  `input_email` VARCHAR(255), `visibility` VARCHAR(50) DEFAULT 'show',
  `date_created` DATE NOT NULL, `time_created` TIME NOT NULL, `created_by` VARCHAR(255) NOT NULL
);

-- ============================================================
-- ALL CONTENT TABLES DONE.
-- Now safely update the two existing tables.
-- Each column is checked individually before adding —
-- safe to re-run even if some columns already exist.
-- ============================================================

-- ── settings_website_info: add columns (skip if already exists) ──────────────

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='settings_website_info' AND COLUMN_NAME='input_tagline');
SET @s=IF(@c=0,CONCAT('ALTER TABLE settings_website_info ADD COLUMN input_tagline VARCHAR(255) DEFAULT ',CHAR(39),CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='settings_website_info' AND COLUMN_NAME='input_podcast_link');
SET @s=IF(@c=0,CONCAT('ALTER TABLE settings_website_info ADD COLUMN input_podcast_link VARCHAR(255) DEFAULT ',CHAR(39),CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='settings_website_info' AND COLUMN_NAME='input_apple_podcast');
SET @s=IF(@c=0,CONCAT('ALTER TABLE settings_website_info ADD COLUMN input_apple_podcast VARCHAR(500) DEFAULT ',CHAR(39),CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='settings_website_info' AND COLUMN_NAME='input_book_session_url');
SET @s=IF(@c=0,CONCAT('ALTER TABLE settings_website_info ADD COLUMN input_book_session_url VARCHAR(500) DEFAULT ',CHAR(39),CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

-- ── Update settings_website_info with Mike Mahony data ───────────────────────

UPDATE `settings_website_info` SET
  `input_name`                   = 'Mike Mahony',
  `input_tagline`                = 'Fractional CTO',
  `input_email`                  = 'hello@mikemahony.com',
  `input_email_smtp_host`        = 'smtp.gmail.com',
  `input_email_smtp_secure_type` = 'tls',
  `input_email_smtp_port`        = '587',
  `input_phone_number`           = '',
  `input_address`                = 'North Las Vegas, Nevada',
  `input_linkedin`               = 'https://www.linkedin.com/in/michaeljmahony/',
  `input_podcast_link`           = 'https://gtle.show',
  `input_apple_podcast`          = 'https://podcasts.apple.com/us/podcast/gaining-the-technology-leadership-edge/id1664607772',
  `input_book_session_url`       = 'https://GetYourVirtualCTO.com/StrategySession',
  `input_seo_keywords`           = 'Fractional CTO, NetSuite Expert, DCAT Method, Tech Leadership, Mike Mahony',
  `text_description`             = 'Mike Mahony helps tech leaders and NetSuite-driven operators eliminate decision bottlenecks and build autonomous, high-performing teams.',
  `image_1`                      = '/uploads/mm_logo.jpg',
  `input_image_width`            = '48'
WHERE id = 1;

-- ── website_status: add colour columns (skip if already exists) ──────────────

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='website_status' AND COLUMN_NAME='bgcolor_background');
SET @s=IF(@c=0,CONCAT('ALTER TABLE website_status ADD COLUMN bgcolor_background VARCHAR(100) DEFAULT ',CHAR(39),'#050a14',CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='website_status' AND COLUMN_NAME='bgcolor_surface');
SET @s=IF(@c=0,CONCAT('ALTER TABLE website_status ADD COLUMN bgcolor_surface VARCHAR(100) DEFAULT ',CHAR(39),'#0a1128',CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='website_status' AND COLUMN_NAME='textcolor_heading');
SET @s=IF(@c=0,CONCAT('ALTER TABLE website_status ADD COLUMN textcolor_heading VARCHAR(100) DEFAULT ',CHAR(39),'#f9fafb',CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='website_status' AND COLUMN_NAME='textcolor_body');
SET @s=IF(@c=0,CONCAT('ALTER TABLE website_status ADD COLUMN textcolor_body VARCHAR(100) DEFAULT ',CHAR(39),'#d1d5db',CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

SET @c=(SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='website_status' AND COLUMN_NAME='textcolor_muted');
SET @s=IF(@c=0,CONCAT('ALTER TABLE website_status ADD COLUMN textcolor_muted VARCHAR(100) DEFAULT ',CHAR(39),'#9ca3af',CHAR(39)),'SELECT 1');
PREPARE st FROM @s; EXECUTE st; DEALLOCATE PREPARE st;

-- ── Update website_status with Mike Mahony theme ─────────────────────────────

UPDATE `website_status` SET
  `status`             = 'live',
  `color`              = '#FFBF00',
  `secondary_color`    = '#050a14',
  `bgcolor_background` = '#050a14',
  `bgcolor_surface`    = '#0a1128',
  `textcolor_heading`  = '#f9fafb',
  `textcolor_body`     = '#d1d5db',
  `textcolor_muted`    = '#9ca3af'
WHERE id = 1;

-- ============================================================
-- SETUP COMPLETE — safe to re-run at any time.
-- Open ADMC → settings_website_info → fill in:
--   input_email_from     = your Gmail address
--   input_email_password = your Gmail App Password (16 chars)
-- ============================================================
