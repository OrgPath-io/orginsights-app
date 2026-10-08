ALTER TABLE profiles ADD COLUMN access_expires_at INTEGER;
--> statement-breakpoint
UPDATE profiles SET access_expires_at = created_at + 31536000000 WHERE plan IN ('full', '360', 'coaching') AND access_expires_at IS NULL;
--> statement-breakpoint
ALTER TABLE assessments ADD COLUMN attempt_group INTEGER NOT NULL DEFAULT 1;
--> statement-breakpoint
CREATE TABLE assessment_history (
  id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  profile_id INTEGER NOT NULL REFERENCES profiles(id) ON DELETE CASCADE,
  attempt_group INTEGER NOT NULL,
  mode TEXT NOT NULL,
  self_assessment_id INTEGER NOT NULL,
  professional_assessment_id INTEGER NOT NULL,
  report_json TEXT NOT NULL,
  completed_at INTEGER NOT NULL
);
--> statement-breakpoint
CREATE UNIQUE INDEX assessment_history_profile_group_idx ON assessment_history(profile_id, attempt_group);
--> statement-breakpoint
CREATE INDEX assessment_history_profile_completed_idx ON assessment_history(profile_id, completed_at);
