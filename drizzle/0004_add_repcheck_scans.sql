CREATE TABLE reputation_scans (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  profile_id INTEGER NOT NULL REFERENCES profiles(id) ON DELETE CASCADE,
  full_name TEXT NOT NULL,
  city TEXT,
  country TEXT,
  employer TEXT,
  handles TEXT,
  keywords TEXT,
  score INTEGER,
  result_count INTEGER NOT NULL DEFAULT 0,
  matched_count INTEGER NOT NULL DEFAULT 0,
  negative_count INTEGER NOT NULL DEFAULT 0,
  status TEXT NOT NULL DEFAULT 'complete',
  created_at INTEGER NOT NULL
);
--> statement-breakpoint
CREATE INDEX reputation_scans_profile_id_idx ON reputation_scans(profile_id);
--> statement-breakpoint
CREATE TABLE reputation_findings (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  scan_id INTEGER NOT NULL REFERENCES reputation_scans(id) ON DELETE CASCADE,
  title TEXT NOT NULL,
  url TEXT NOT NULL,
  source TEXT,
  snippet TEXT,
  published_at TEXT,
  rank INTEGER NOT NULL,
  match_confidence TEXT NOT NULL,
  sentiment TEXT NOT NULL,
  category TEXT NOT NULL,
  reason TEXT NOT NULL,
  next_step TEXT NOT NULL,
  user_match TEXT NOT NULL DEFAULT 'auto',
  created_at INTEGER NOT NULL
);
--> statement-breakpoint
CREATE INDEX reputation_findings_scan_id_idx ON reputation_findings(scan_id);
