CREATE TABLE `access_codes` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `code` text NOT NULL,
  `source` text DEFAULT 'clickbank' NOT NULL,
  `status` text DEFAULT 'unused' NOT NULL,
  `order_id` text,
  `buyer_email` text,
  `redeemed_by_profile_id` integer,
  `created_at` integer NOT NULL,
  `assigned_at` integer,
  `redeemed_at` integer,
  CONSTRAINT `access_codes_code_unique` UNIQUE(`code`)
);
--> statement-breakpoint
CREATE INDEX `access_codes_status_created_at_idx` ON `access_codes` (`status`,`created_at`);