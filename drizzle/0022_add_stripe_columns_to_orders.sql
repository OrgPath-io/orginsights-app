-- Add Stripe and tax columns to orders table
ALTER TABLE orders ADD COLUMN IF NOT EXISTS tax_amount REAL NOT NULL DEFAULT 0;
ALTER TABLE orders ADD COLUMN IF NOT EXISTS tax_rate REAL;
ALTER TABLE orders ADD COLUMN IF NOT EXISTS tax_label TEXT;
ALTER TABLE orders ADD COLUMN IF NOT EXISTS stripe_session_id TEXT;
CREATE UNIQUE INDEX IF NOT EXISTS orders_stripe_session_id_idx ON orders (stripe_session_id);
