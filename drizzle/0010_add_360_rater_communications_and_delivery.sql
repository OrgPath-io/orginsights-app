ALTER TABLE `raters` ADD `access_token` text;
--> statement-breakpoint
ALTER TABLE `raters` ADD `invite_sent_at` integer;
--> statement-breakpoint
ALTER TABLE `raters` ADD `last_reminded_at` integer;
--> statement-breakpoint
ALTER TABLE `raters` ADD `next_reminder_at` integer;
--> statement-breakpoint
ALTER TABLE `raters` ADD `reminder_count` integer NOT NULL DEFAULT 0;
--> statement-breakpoint
CREATE UNIQUE INDEX `raters_access_token_idx` ON `raters` (`access_token`);
--> statement-breakpoint
ALTER TABLE `candidate_emails` ADD `attempted_at` integer;
--> statement-breakpoint
ALTER TABLE `candidate_emails` ADD `failure_reason` text;
--> statement-breakpoint
CREATE TABLE `rater_campaigns` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `profile_id` integer NOT NULL REFERENCES `profiles`(`id`) ON DELETE CASCADE,
  `status` text NOT NULL DEFAULT 'draft',
  `reminder_days` integer NOT NULL DEFAULT 7,
  `created_at` integer NOT NULL,
  `closed_at` integer
);
--> statement-breakpoint
CREATE UNIQUE INDEX `rater_campaigns_profile_idx` ON `rater_campaigns` (`profile_id`);
--> statement-breakpoint
CREATE TABLE `rater_email_templates` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `template_key` text NOT NULL,
  `name` text NOT NULL,
  `subject` text NOT NULL,
  `preheader` text NOT NULL,
  `heading` text NOT NULL,
  `body_html` text NOT NULL,
  `button_label` text NOT NULL,
  `brand_primary` text NOT NULL DEFAULT '#075d46',
  `brand_accent` text NOT NULL DEFAULT '#a9ddc5',
  `updated_at` integer NOT NULL
);
--> statement-breakpoint
CREATE UNIQUE INDEX `rater_email_templates_key_idx` ON `rater_email_templates` (`template_key`);
--> statement-breakpoint
CREATE TABLE `rater_emails` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `profile_id` integer NOT NULL REFERENCES `profiles`(`id`) ON DELETE CASCADE,
  `rater_id` integer NOT NULL REFERENCES `raters`(`id`) ON DELETE CASCADE,
  `template_key` text NOT NULL,
  `sequence_number` integer NOT NULL,
  `status` text NOT NULL,
  `scheduled_at` integer NOT NULL,
  `queued_at` integer,
  `attempted_at` integer,
  `sent_at` integer,
  `cancelled_at` integer,
  `failure_reason` text,
  `subject_snapshot` text NOT NULL,
  `html_snapshot` text NOT NULL,
  `assessment_link` text NOT NULL,
  `created_at` integer NOT NULL
);
--> statement-breakpoint
CREATE UNIQUE INDEX `rater_emails_rater_sequence_idx` ON `rater_emails` (`rater_id`,`sequence_number`);
--> statement-breakpoint
CREATE INDEX `rater_emails_status_scheduled_idx` ON `rater_emails` (`status`,`scheduled_at`);
