ALTER TABLE referral_codes ADD COLUMN is_coach_code INTEGER NOT NULL DEFAULT 0;
--> statement-breakpoint
ALTER TABLE referral_codes ADD COLUMN pricing_mode TEXT NOT NULL DEFAULT 'discount';
--> statement-breakpoint
ALTER TABLE referral_codes ADD COLUMN fixed_price REAL;
