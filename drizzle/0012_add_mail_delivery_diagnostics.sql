ALTER TABLE `mail_events` ADD `attempted_at` integer;
--> statement-breakpoint
ALTER TABLE `mail_events` ADD `failure_reason` text;
--> statement-breakpoint
ALTER TABLE `mail_events` ADD `used_port` integer;
--> statement-breakpoint
ALTER TABLE `mail_events` ADD `message_id` text;
