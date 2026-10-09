CREATE TABLE "access_codes" (
	"id" serial PRIMARY KEY NOT NULL,
	"code" text NOT NULL,
	"source" text DEFAULT 'clickbank' NOT NULL,
	"status" text DEFAULT 'unused' NOT NULL,
	"order_id" text,
	"buyer_email" text,
	"redeemed_by_profile_id" integer,
	"created_at" timestamp NOT NULL,
	"assigned_at" timestamp,
	"redeemed_at" timestamp,
	CONSTRAINT "access_codes_code_unique" UNIQUE("code")
);
--> statement-breakpoint
CREATE TABLE "answers" (
	"id" serial PRIMARY KEY NOT NULL,
	"assessment_id" integer NOT NULL,
	"question_id" integer NOT NULL,
	"option_id" integer NOT NULL,
	"score" real NOT NULL,
	"updated_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "assessment_history" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"attempt_group" integer NOT NULL,
	"mode" text NOT NULL,
	"self_assessment_id" integer NOT NULL,
	"professional_assessment_id" integer NOT NULL,
	"report_json" text NOT NULL,
	"completed_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "assessment_questions" (
	"id" serial PRIMARY KEY NOT NULL,
	"assessment_id" integer NOT NULL,
	"question_id" integer NOT NULL,
	"display_order" integer NOT NULL,
	"reversed" boolean DEFAULT false NOT NULL
);
--> statement-breakpoint
CREATE TABLE "assessments" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"attempt_group" integer DEFAULT 1 NOT NULL,
	"kind" text NOT NULL,
	"status" text NOT NULL,
	"started_at" timestamp,
	"completed_at" timestamp
);
--> statement-breakpoint
CREATE TABLE "audit_log" (
	"id" serial PRIMARY KEY NOT NULL,
	"actor" text NOT NULL,
	"action" text NOT NULL,
	"entity" text NOT NULL,
	"details" text NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "candidate_emails" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"assessment_id" integer,
	"template_key" text NOT NULL,
	"event_key" text DEFAULT '' NOT NULL,
	"recipient_email" text,
	"merge_fields" text,
	"status" text NOT NULL,
	"scheduled_at" timestamp NOT NULL,
	"queued_at" timestamp,
	"attempted_at" timestamp,
	"sent_at" timestamp,
	"cancelled_at" timestamp,
	"failure_reason" text,
	"subject_snapshot" text NOT NULL,
	"html_snapshot" text NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "capabilities" (
	"id" serial PRIMARY KEY NOT NULL,
	"name" text NOT NULL,
	"description" text NOT NULL,
	"active" boolean NOT NULL
);
--> statement-breakpoint
CREATE TABLE "categories" (
	"id" serial PRIMARY KEY NOT NULL,
	"name" text NOT NULL,
	"description" text NOT NULL,
	"active" boolean NOT NULL
);
--> statement-breakpoint
CREATE TABLE "countries" (
	"id" serial PRIMARY KEY NOT NULL,
	"code" text NOT NULL,
	"name" text NOT NULL
);
--> statement-breakpoint
CREATE TABLE "email_templates" (
	"id" serial PRIMARY KEY NOT NULL,
	"template_key" text NOT NULL,
	"name" text NOT NULL,
	"enabled" boolean DEFAULT true NOT NULL,
	"subject" text NOT NULL,
	"preheader" text NOT NULL,
	"heading" text NOT NULL,
	"body_html" text NOT NULL,
	"button_label" text NOT NULL,
	"button_url" text NOT NULL,
	"image_url" text,
	"brand_primary" text DEFAULT '#075d46' NOT NULL,
	"brand_accent" text DEFAULT '#a9ddc5' NOT NULL,
	"updated_at" timestamp NOT NULL,
	CONSTRAINT "email_templates_template_key_unique" UNIQUE("template_key")
);
--> statement-breakpoint
CREATE TABLE "industry_capabilities" (
	"id" serial PRIMARY KEY NOT NULL,
	"industry_name" text NOT NULL,
	"category_id" integer NOT NULL,
	"capability_id" integer NOT NULL,
	"level" text NOT NULL,
	"active" boolean NOT NULL
);
--> statement-breakpoint
CREATE TABLE "learning" (
	"id" serial PRIMARY KEY NOT NULL,
	"length" text NOT NULL,
	"title" text NOT NULL,
	"link" text NOT NULL,
	"capability" text NOT NULL,
	"level" text NOT NULL,
	"source" text NOT NULL,
	"source_link" text NOT NULL
);
--> statement-breakpoint
CREATE TABLE "mail_events" (
	"id" serial PRIMARY KEY NOT NULL,
	"kind" text NOT NULL,
	"recipient" text NOT NULL,
	"subject" text NOT NULL,
	"status" text NOT NULL,
	"related_id" integer,
	"attempted_at" timestamp,
	"failure_reason" text,
	"used_port" integer,
	"message_id" text,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "orders" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"item" text NOT NULL,
	"amount" real NOT NULL,
	"discount_code" text,
	"status" text NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "password_reset_requests" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"token" text NOT NULL,
	"expires_at" timestamp NOT NULL,
	"used_at" timestamp,
	"created_at" timestamp NOT NULL,
	CONSTRAINT "password_reset_requests_token_unique" UNIQUE("token")
);
--> statement-breakpoint
CREATE TABLE "profile_demographics" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"employment_status" text,
	"education_level" text,
	"seniority_level" text,
	"industry" text,
	"year_of_graduation" integer,
	"job_function" text,
	"years_experience" integer,
	"updated_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "profiles" (
	"id" serial PRIMARY KEY NOT NULL,
	"first_name" text NOT NULL,
	"last_name" text NOT NULL,
	"email" text NOT NULL,
	"country" text NOT NULL,
	"plan" text NOT NULL,
	"assessment_mode" text,
	"referral_code" text,
	"public_referral_code" text,
	"referred_by_profile_id" integer,
	"password_hash" text,
	"password_updated_at" timestamp,
	"billing_cancelled_at" timestamp,
	"coach_disclosure" boolean NOT NULL,
	"coach_result_token" text,
	"access_expires_at" timestamp,
	"coaching_session_date" text,
	"coaching_booked_at" timestamp,
	"is_admin" boolean DEFAULT false NOT NULL,
	"created_at" timestamp NOT NULL,
	CONSTRAINT "profiles_public_referral_code_unique" UNIQUE("public_referral_code"),
	CONSTRAINT "profiles_coach_result_token_unique" UNIQUE("coach_result_token")
);
--> statement-breakpoint
CREATE TABLE "questions" (
	"id" serial PRIMARY KEY NOT NULL,
	"prompt" text NOT NULL,
	"instruction" text NOT NULL,
	"question_type_id" integer NOT NULL,
	"category_id" integer NOT NULL,
	"capability_id" integer NOT NULL,
	"track" text NOT NULL,
	"show_type" text NOT NULL,
	"image_blob_key" text,
	"active" boolean NOT NULL,
	"status" text NOT NULL
);
--> statement-breakpoint
CREATE TABLE "rater_answers" (
	"id" serial PRIMARY KEY NOT NULL,
	"rater_id" integer NOT NULL,
	"question_id" integer NOT NULL,
	"option_id" integer NOT NULL,
	"score" real NOT NULL
);
--> statement-breakpoint
CREATE TABLE "rater_campaigns" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"status" text DEFAULT 'draft' NOT NULL,
	"reminder_days" integer DEFAULT 7 NOT NULL,
	"duration_days" integer DEFAULT 30 NOT NULL,
	"created_at" timestamp NOT NULL,
	"launched_at" timestamp,
	"end_at" timestamp,
	"closed_at" timestamp
);
--> statement-breakpoint
CREATE TABLE "rater_email_templates" (
	"id" serial PRIMARY KEY NOT NULL,
	"template_key" text NOT NULL,
	"name" text NOT NULL,
	"enabled" boolean DEFAULT true NOT NULL,
	"subject" text NOT NULL,
	"preheader" text NOT NULL,
	"heading" text NOT NULL,
	"body_html" text NOT NULL,
	"button_label" text NOT NULL,
	"button_url" text DEFAULT '{{assessment_link}}' NOT NULL,
	"brand_primary" text DEFAULT '#075d46' NOT NULL,
	"brand_accent" text DEFAULT '#a9ddc5' NOT NULL,
	"updated_at" timestamp NOT NULL,
	CONSTRAINT "rater_email_templates_template_key_unique" UNIQUE("template_key")
);
--> statement-breakpoint
CREATE TABLE "rater_emails" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"rater_id" integer NOT NULL,
	"template_key" text NOT NULL,
	"sequence_number" integer NOT NULL,
	"status" text NOT NULL,
	"scheduled_at" timestamp NOT NULL,
	"queued_at" timestamp,
	"attempted_at" timestamp,
	"sent_at" timestamp,
	"cancelled_at" timestamp,
	"failure_reason" text,
	"subject_snapshot" text NOT NULL,
	"html_snapshot" text NOT NULL,
	"assessment_link" text NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "raters" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"name" text NOT NULL,
	"email" text NOT NULL,
	"relationship" text NOT NULL,
	"reminder_days" integer,
	"status" text NOT NULL,
	"access_token" text,
	"invite_sent_at" timestamp,
	"last_reminded_at" timestamp,
	"next_reminder_at" timestamp,
	"reminder_count" integer DEFAULT 0 NOT NULL,
	"created_at" timestamp NOT NULL,
	"started_at" timestamp,
	"completed_at" timestamp,
	CONSTRAINT "raters_access_token_unique" UNIQUE("access_token")
);
--> statement-breakpoint
CREATE TABLE "referral_codes" (
	"id" serial PRIMARY KEY NOT NULL,
	"code" text NOT NULL,
	"owner_type" text NOT NULL,
	"owner_name" text NOT NULL,
	"owner_email" text,
	"discount_percent" integer NOT NULL,
	"is_coach_code" boolean DEFAULT false NOT NULL,
	"pricing_mode" text DEFAULT 'discount' NOT NULL,
	"fixed_price" real,
	"unlock_tier" text DEFAULT 'full' NOT NULL,
	"active" boolean NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "report_comments" (
	"id" serial PRIMARY KEY NOT NULL,
	"category_id" integer NOT NULL,
	"top" text NOT NULL,
	"low" text NOT NULL,
	"hidden" text NOT NULL,
	"blind" text NOT NULL
);
--> statement-breakpoint
CREATE TABLE "reputation_findings" (
	"id" serial PRIMARY KEY NOT NULL,
	"scan_id" integer NOT NULL,
	"title" text NOT NULL,
	"url" text NOT NULL,
	"source" text,
	"snippet" text,
	"published_at" text,
	"rank" integer NOT NULL,
	"match_confidence" text NOT NULL,
	"sentiment" text NOT NULL,
	"category" text NOT NULL,
	"reason" text NOT NULL,
	"next_step" text NOT NULL,
	"user_match" text DEFAULT 'auto' NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "reputation_scans" (
	"id" serial PRIMARY KEY NOT NULL,
	"profile_id" integer NOT NULL,
	"full_name" text NOT NULL,
	"city" text,
	"country" text,
	"employer" text,
	"emails" text,
	"handles" text,
	"keywords" text,
	"score" integer,
	"result_count" integer DEFAULT 0 NOT NULL,
	"matched_count" integer DEFAULT 0 NOT NULL,
	"negative_count" integer DEFAULT 0 NOT NULL,
	"status" text DEFAULT 'complete' NOT NULL,
	"created_at" timestamp NOT NULL
);
--> statement-breakpoint
CREATE TABLE "response_options" (
	"id" serial PRIMARY KEY NOT NULL,
	"question_id" integer NOT NULL,
	"label" text NOT NULL,
	"score" real NOT NULL
);
--> statement-breakpoint
CREATE TABLE "settings" (
	"key" text PRIMARY KEY NOT NULL,
	"value" text NOT NULL,
	"updated_at" timestamp NOT NULL
);
--> statement-breakpoint
ALTER TABLE "assessment_history" ADD CONSTRAINT "assessment_history_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "assessment_questions" ADD CONSTRAINT "assessment_questions_assessment_id_assessments_id_fk" FOREIGN KEY ("assessment_id") REFERENCES "public"."assessments"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "assessment_questions" ADD CONSTRAINT "assessment_questions_question_id_questions_id_fk" FOREIGN KEY ("question_id") REFERENCES "public"."questions"("id") ON DELETE no action ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "candidate_emails" ADD CONSTRAINT "candidate_emails_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "candidate_emails" ADD CONSTRAINT "candidate_emails_assessment_id_assessments_id_fk" FOREIGN KEY ("assessment_id") REFERENCES "public"."assessments"("id") ON DELETE set null ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "password_reset_requests" ADD CONSTRAINT "password_reset_requests_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "profile_demographics" ADD CONSTRAINT "profile_demographics_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "rater_campaigns" ADD CONSTRAINT "rater_campaigns_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "rater_emails" ADD CONSTRAINT "rater_emails_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "rater_emails" ADD CONSTRAINT "rater_emails_rater_id_raters_id_fk" FOREIGN KEY ("rater_id") REFERENCES "public"."raters"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "reputation_findings" ADD CONSTRAINT "reputation_findings_scan_id_reputation_scans_id_fk" FOREIGN KEY ("scan_id") REFERENCES "public"."reputation_scans"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
ALTER TABLE "reputation_scans" ADD CONSTRAINT "reputation_scans_profile_id_profiles_id_fk" FOREIGN KEY ("profile_id") REFERENCES "public"."profiles"("id") ON DELETE cascade ON UPDATE no action;--> statement-breakpoint
CREATE INDEX "access_codes_status_created_at_idx" ON "access_codes" USING btree ("status","created_at");--> statement-breakpoint
CREATE UNIQUE INDEX "assessment_history_profile_group_idx" ON "assessment_history" USING btree ("profile_id","attempt_group");--> statement-breakpoint
CREATE INDEX "assessment_history_profile_completed_idx" ON "assessment_history" USING btree ("profile_id","completed_at");--> statement-breakpoint
CREATE UNIQUE INDEX "assessment_questions_assessment_question_idx" ON "assessment_questions" USING btree ("assessment_id","question_id");--> statement-breakpoint
CREATE UNIQUE INDEX "assessment_questions_assessment_order_idx" ON "assessment_questions" USING btree ("assessment_id","display_order");--> statement-breakpoint
CREATE UNIQUE INDEX "candidate_emails_profile_template_event_idx" ON "candidate_emails" USING btree ("profile_id","template_key","event_key");--> statement-breakpoint
CREATE INDEX "candidate_emails_status_scheduled_idx" ON "candidate_emails" USING btree ("status","scheduled_at");--> statement-breakpoint
CREATE UNIQUE INDEX "email_templates_template_key_idx" ON "email_templates" USING btree ("template_key");--> statement-breakpoint
CREATE UNIQUE INDEX "profile_demographics_profile_idx" ON "profile_demographics" USING btree ("profile_id");--> statement-breakpoint
CREATE UNIQUE INDEX "rater_campaigns_profile_idx" ON "rater_campaigns" USING btree ("profile_id");--> statement-breakpoint
CREATE UNIQUE INDEX "rater_email_templates_key_idx" ON "rater_email_templates" USING btree ("template_key");--> statement-breakpoint
CREATE UNIQUE INDEX "rater_emails_rater_sequence_idx" ON "rater_emails" USING btree ("rater_id","sequence_number");--> statement-breakpoint
CREATE INDEX "rater_emails_status_scheduled_idx" ON "rater_emails" USING btree ("status","scheduled_at");--> statement-breakpoint
CREATE INDEX "reputation_findings_scan_id_idx" ON "reputation_findings" USING btree ("scan_id");--> statement-breakpoint
CREATE INDEX "reputation_scans_profile_id_idx" ON "reputation_scans" USING btree ("profile_id");