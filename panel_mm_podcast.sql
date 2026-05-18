-- panel_mm_podcast — Podcast episodes for mckodevdemo
CREATE TABLE IF NOT EXISTS `panel_mm_podcast` (
  `id`                int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hash_id`           varchar(150)     NOT NULL,
  `input_title`       varchar(255)     DEFAULT NULL COMMENT 'Episode title',
  `input_theme_number`varchar(100)     DEFAULT NULL COMMENT 'e.g. Theme 01',
  `select_category`   varchar(100)     DEFAULT NULL COMMENT 'Episode category/topic',
  `text_description`  text                         COMMENT 'Full episode description',
  `image_1`           varchar(1000)    DEFAULT NULL COMMENT 'Cover image URL',
  `input_listen_link` varchar(500)     DEFAULT NULL COMMENT 'Podcast platform link',
  `input_order`       int(5)           DEFAULT 0    COMMENT 'Display order',
  `visibility`        char(4)          NOT NULL DEFAULT 'show',
  `date_created`      date             NOT NULL,
  `time_created`      time             NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_id` (`hash_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample episode (remove or update as needed)
INSERT IGNORE INTO `panel_mm_podcast`
  (`hash_id`, `input_title`, `input_theme_number`, `select_category`,
   `text_description`, `image_1`, `input_listen_link`, `input_order`,
   `visibility`, `date_created`, `time_created`)
VALUES
  ('ep001', 'From Firefighter to Leader', 'Theme 01', 'Leadership',
   'How to stop being the person everyone depends on and start building a team that can execute without you.',
   '', 'https://gtle.show', 1, 'show', CURDATE(), CURTIME()),
  ('ep002', 'Building High-Trust Engineering Teams', 'Theme 02', 'Team Culture',
   'The frameworks CTOs use to create psychological safety and unlock peak team performance.',
   '', 'https://gtle.show', 2, 'show', CURDATE(), CURTIME()),
  ('ep003', 'The DCAT Method Explained', 'Theme 03', 'Strategy',
   'A deep dive into the Delegate, Coach, Automate, Transform method for scaling technology leadership.',
   '', 'https://gtle.show', 3, 'show', CURDATE(), CURTIME());
