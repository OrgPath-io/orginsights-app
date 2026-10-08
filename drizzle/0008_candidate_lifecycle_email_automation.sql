ALTER TABLE `raters` ADD `started_at` integer;
--> statement-breakpoint
CREATE TABLE `email_templates` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `template_key` text NOT NULL,
  `name` text NOT NULL,
  `subject` text NOT NULL,
  `preheader` text NOT NULL,
  `heading` text NOT NULL,
  `body_html` text NOT NULL,
  `button_label` text NOT NULL,
  `button_url` text NOT NULL,
  `image_url` text,
  `brand_primary` text NOT NULL DEFAULT '#075d46',
  `brand_accent` text NOT NULL DEFAULT '#a9ddc5',
  `updated_at` integer NOT NULL
);
--> statement-breakpoint
CREATE UNIQUE INDEX `email_templates_template_key_idx` ON `email_templates` (`template_key`);
--> statement-breakpoint
CREATE TABLE `candidate_emails` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `profile_id` integer NOT NULL REFERENCES `profiles`(`id`) ON DELETE CASCADE,
  `assessment_id` integer REFERENCES `assessments`(`id`) ON DELETE SET NULL,
  `template_key` text NOT NULL,
  `status` text NOT NULL,
  `scheduled_at` integer NOT NULL,
  `queued_at` integer,
  `sent_at` integer,
  `cancelled_at` integer,
  `subject_snapshot` text NOT NULL,
  `html_snapshot` text NOT NULL,
  `created_at` integer NOT NULL
);
--> statement-breakpoint
CREATE UNIQUE INDEX `candidate_emails_profile_template_idx` ON `candidate_emails` (`profile_id`,`template_key`);
--> statement-breakpoint
CREATE INDEX `candidate_emails_status_scheduled_idx` ON `candidate_emails` (`status`,`scheduled_at`);