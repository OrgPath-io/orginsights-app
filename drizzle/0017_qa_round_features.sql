ALTER TABLE `profiles` ADD `coaching_session_date` text;
--> statement-breakpoint
ALTER TABLE `profiles` ADD `coaching_booked_at` integer;
--> statement-breakpoint
ALTER TABLE `questions` ADD `image_blob_key` text;
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('full_title','Full OrgInsights Assessment',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('360_title','OrgInsights & 360 Assessment',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('coaching_title','Assessment & Coaching',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
UPDATE `settings` SET `value`='https://calendar.app.google/xwabGNeAS72avS8J6', `updated_at`=CAST(strftime('%s','now') AS INTEGER)*1000 WHERE `key`='booking_url';