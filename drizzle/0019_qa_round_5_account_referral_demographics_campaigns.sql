ALTER TABLE `profiles` ADD `public_referral_code` text;
--> statement-breakpoint
ALTER TABLE `profiles` ADD `referred_by_profile_id` integer;
--> statement-breakpoint
ALTER TABLE `profiles` ADD `password_hash` text;
--> statement-breakpoint
ALTER TABLE `profiles` ADD `password_updated_at` integer;
--> statement-breakpoint
ALTER TABLE `profiles` ADD `billing_cancelled_at` integer;
--> statement-breakpoint
ALTER TABLE `rater_campaigns` ADD `duration_days` integer NOT NULL DEFAULT 30;
--> statement-breakpoint
CREATE UNIQUE INDEX `profiles_public_referral_code_idx` ON `profiles` (`public_referral_code`);
--> statement-breakpoint
CREATE TABLE `profile_demographics` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `profile_id` integer NOT NULL,
  `employment_status` text,
  `education_level` text,
  `seniority_level` text,
  `industry` text,
  `year_of_graduation` integer,
  `job_function` text,
  `years_experience` integer,
  `updated_at` integer NOT NULL,
  FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`) ON UPDATE no action ON DELETE cascade
);
--> statement-breakpoint
CREATE UNIQUE INDEX `profile_demographics_profile_idx` ON `profile_demographics` (`profile_id`);
--> statement-breakpoint
CREATE TABLE `password_reset_requests` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `profile_id` integer NOT NULL,
  `token` text NOT NULL,
  `expires_at` integer NOT NULL,
  `used_at` integer,
  `created_at` integer NOT NULL,
  FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`) ON UPDATE no action ON DELETE cascade
);
--> statement-breakpoint
CREATE UNIQUE INDEX `password_reset_requests_token_idx` ON `password_reset_requests` (`token`);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('demographic_discount_enabled','false',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('demographic_discount_threshold','80',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('demographic_discount_percent','10',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('demographic_discount_message','Complete your optional profile details to unlock a discount on an assessment purchase.',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
INSERT OR IGNORE INTO `settings` (`key`,`value`,`updated_at`) VALUES ('booking_embed_url','https://calendar.app.google/xwabGNeAS72avS8J6',CAST(strftime('%s','now') AS INTEGER)*1000);
--> statement-breakpoint
UPDATE `profiles` SET `public_referral_code` = 'OI-' || printf('%06d', `id`) WHERE `public_referral_code` IS NULL;
--> statement-breakpoint
UPDATE `rater_email_templates` SET `subject` = replace(replace(`subject`, 'Start your assessment', 'Complete your assessment'), 'start your assessment', 'complete your assessment'), `heading` = replace(replace(`heading`, 'Start your assessment', 'Complete your assessment'), 'start your assessment', 'complete your assessment'), `body_html` = replace(replace(`body_html`, 'Start your assessment', 'Complete your assessment'), 'start your assessment', 'complete your assessment'), `updated_at` = CAST(strftime('%s','now') AS INTEGER)*1000 WHERE `template_key` IN ('rater_reminder_1','rater_reminder_2','rater_reminder_3');
