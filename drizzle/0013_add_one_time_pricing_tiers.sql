ALTER TABLE `referral_codes` ADD `unlock_tier` text NOT NULL DEFAULT 'full';
--> statement-breakpoint
UPDATE `referral_codes` SET `unlock_tier` = '360' WHERE `is_coach_code` = 1;
--> statement-breakpoint
INSERT INTO `settings` (`key`,`value`,`updated_at`) VALUES ('full_price','99',(unixepoch('now') * 1000)) ON CONFLICT (`key`) DO UPDATE SET `value` = '99', `updated_at` = excluded.`updated_at`;
--> statement-breakpoint
INSERT INTO `settings` (`key`,`value`,`updated_at`) VALUES ('360_price','149',(unixepoch('now') * 1000)) ON CONFLICT (`key`) DO UPDATE SET `value` = '149', `updated_at` = excluded.`updated_at`;
--> statement-breakpoint
INSERT INTO `settings` (`key`,`value`,`updated_at`) VALUES ('coaching_price','199',(unixepoch('now') * 1000)) ON CONFLICT (`key`) DO UPDATE SET `value` = '199', `updated_at` = excluded.`updated_at`;
--> statement-breakpoint
UPDATE `email_templates` SET
  `subject` = replace(replace(replace(replace(replace(`subject`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `preheader` = replace(replace(replace(replace(replace(`preheader`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `heading` = replace(replace(replace(replace(replace(`heading`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `body_html` = replace(replace(replace(replace(replace(`body_html`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `button_label` = replace(replace(replace(replace(replace(`button_label`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `updated_at` = (unixepoch('now') * 1000);
--> statement-breakpoint
UPDATE `rater_email_templates` SET
  `subject` = replace(replace(replace(replace(replace(`subject`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `preheader` = replace(replace(replace(replace(replace(`preheader`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `heading` = replace(replace(replace(replace(replace(`heading`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `body_html` = replace(replace(replace(replace(replace(`body_html`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `button_label` = replace(replace(replace(replace(replace(`button_label`, '/year', ' one-time'), 'per year', 'one-time'), 'Per year', 'One-time'), 'annual', 'one-time'), 'Annual', 'One-time'),
  `updated_at` = (unixepoch('now') * 1000);
--> statement-breakpoint
UPDATE `email_templates` SET
  `subject` = replace(replace(`subject`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `preheader` = replace(replace(`preheader`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `heading` = replace(replace(`heading`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `body_html` = replace(replace(`body_html`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `button_label` = replace(replace(`button_label`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `updated_at` = (unixepoch('now') * 1000);
--> statement-breakpoint
UPDATE `rater_email_templates` SET
  `subject` = replace(replace(`subject`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `preheader` = replace(replace(`preheader`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `heading` = replace(replace(`heading`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `body_html` = replace(replace(`body_html`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `button_label` = replace(replace(`button_label`, 'subscription', 'one-time purchase'), 'Subscription', 'One-time purchase'),
  `updated_at` = (unixepoch('now') * 1000);
