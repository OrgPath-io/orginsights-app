ALTER TABLE `email_templates` ADD `enabled` integer NOT NULL DEFAULT 1;
--> statement-breakpoint
ALTER TABLE `rater_email_templates` ADD `enabled` integer NOT NULL DEFAULT 1;
--> statement-breakpoint
ALTER TABLE `rater_email_templates` ADD `button_url` text NOT NULL DEFAULT '{{assessment_link}}';
--> statement-breakpoint
ALTER TABLE `candidate_emails` ADD `recipient_email` text;
--> statement-breakpoint
ALTER TABLE `candidate_emails` ADD `merge_fields` text;
--> statement-breakpoint
ALTER TABLE `candidate_emails` ADD `event_key` text NOT NULL DEFAULT '';
--> statement-breakpoint
DROP INDEX `candidate_emails_profile_template_idx`;
--> statement-breakpoint
CREATE UNIQUE INDEX `candidate_emails_profile_template_event_idx` ON `candidate_emails` (`profile_id`,`template_key`,`event_key`);
--> statement-breakpoint
ALTER TABLE `profiles` ADD `coach_result_token` text;
--> statement-breakpoint
CREATE UNIQUE INDEX `profiles_coach_result_token_idx` ON `profiles` (`coach_result_token`);
--> statement-breakpoint
ALTER TABLE `rater_campaigns` ADD `launched_at` integer;
--> statement-breakpoint
ALTER TABLE `rater_campaigns` ADD `end_at` integer;
