-- Convert integer primary keys to serial (auto-increment)

CREATE SEQUENCE IF NOT EXISTS "access_codes_id_seq";
ALTER TABLE "access_codes" ALTER COLUMN "id" SET DEFAULT nextval('"access_codes_id_seq"');
ALTER SEQUENCE "access_codes_id_seq" OWNED BY "access_codes"."id";
SELECT setval('"access_codes_id_seq"', COALESCE((SELECT MAX("id") FROM "access_codes"), 1));

CREATE SEQUENCE IF NOT EXISTS "answers_id_seq";
ALTER TABLE "answers" ALTER COLUMN "id" SET DEFAULT nextval('"answers_id_seq"');
ALTER SEQUENCE "answers_id_seq" OWNED BY "answers"."id";
SELECT setval('"answers_id_seq"', COALESCE((SELECT MAX("id") FROM "answers"), 1));

CREATE SEQUENCE IF NOT EXISTS "assessment_history_id_seq";
ALTER TABLE "assessment_history" ALTER COLUMN "id" SET DEFAULT nextval('"assessment_history_id_seq"');
ALTER SEQUENCE "assessment_history_id_seq" OWNED BY "assessment_history"."id";
SELECT setval('"assessment_history_id_seq"', COALESCE((SELECT MAX("id") FROM "assessment_history"), 1));

CREATE SEQUENCE IF NOT EXISTS "assessment_questions_id_seq";
ALTER TABLE "assessment_questions" ALTER COLUMN "id" SET DEFAULT nextval('"assessment_questions_id_seq"');
ALTER SEQUENCE "assessment_questions_id_seq" OWNED BY "assessment_questions"."id";
SELECT setval('"assessment_questions_id_seq"', COALESCE((SELECT MAX("id") FROM "assessment_questions"), 1));

CREATE SEQUENCE IF NOT EXISTS "assessments_id_seq";
ALTER TABLE "assessments" ALTER COLUMN "id" SET DEFAULT nextval('"assessments_id_seq"');
ALTER SEQUENCE "assessments_id_seq" OWNED BY "assessments"."id";
SELECT setval('"assessments_id_seq"', COALESCE((SELECT MAX("id") FROM "assessments"), 1));

CREATE SEQUENCE IF NOT EXISTS "audit_log_id_seq";
ALTER TABLE "audit_log" ALTER COLUMN "id" SET DEFAULT nextval('"audit_log_id_seq"');
ALTER SEQUENCE "audit_log_id_seq" OWNED BY "audit_log"."id";
SELECT setval('"audit_log_id_seq"', COALESCE((SELECT MAX("id") FROM "audit_log"), 1));

CREATE SEQUENCE IF NOT EXISTS "candidate_emails_id_seq";
ALTER TABLE "candidate_emails" ALTER COLUMN "id" SET DEFAULT nextval('"candidate_emails_id_seq"');
ALTER SEQUENCE "candidate_emails_id_seq" OWNED BY "candidate_emails"."id";
SELECT setval('"candidate_emails_id_seq"', COALESCE((SELECT MAX("id") FROM "candidate_emails"), 1));

CREATE SEQUENCE IF NOT EXISTS "capabilities_id_seq";
ALTER TABLE "capabilities" ALTER COLUMN "id" SET DEFAULT nextval('"capabilities_id_seq"');
ALTER SEQUENCE "capabilities_id_seq" OWNED BY "capabilities"."id";
SELECT setval('"capabilities_id_seq"', COALESCE((SELECT MAX("id") FROM "capabilities"), 1));

CREATE SEQUENCE IF NOT EXISTS "categories_id_seq";
ALTER TABLE "categories" ALTER COLUMN "id" SET DEFAULT nextval('"categories_id_seq"');
ALTER SEQUENCE "categories_id_seq" OWNED BY "categories"."id";
SELECT setval('"categories_id_seq"', COALESCE((SELECT MAX("id") FROM "categories"), 1));

CREATE SEQUENCE IF NOT EXISTS "countries_id_seq";
ALTER TABLE "countries" ALTER COLUMN "id" SET DEFAULT nextval('"countries_id_seq"');
ALTER SEQUENCE "countries_id_seq" OWNED BY "countries"."id";
SELECT setval('"countries_id_seq"', COALESCE((SELECT MAX("id") FROM "countries"), 1));

CREATE SEQUENCE IF NOT EXISTS "email_templates_id_seq";
ALTER TABLE "email_templates" ALTER COLUMN "id" SET DEFAULT nextval('"email_templates_id_seq"');
ALTER SEQUENCE "email_templates_id_seq" OWNED BY "email_templates"."id";
SELECT setval('"email_templates_id_seq"', COALESCE((SELECT MAX("id") FROM "email_templates"), 1));

CREATE SEQUENCE IF NOT EXISTS "industry_capabilities_id_seq";
ALTER TABLE "industry_capabilities" ALTER COLUMN "id" SET DEFAULT nextval('"industry_capabilities_id_seq"');
ALTER SEQUENCE "industry_capabilities_id_seq" OWNED BY "industry_capabilities"."id";
SELECT setval('"industry_capabilities_id_seq"', COALESCE((SELECT MAX("id") FROM "industry_capabilities"), 1));

CREATE SEQUENCE IF NOT EXISTS "learning_id_seq";
ALTER TABLE "learning" ALTER COLUMN "id" SET DEFAULT nextval('"learning_id_seq"');
ALTER SEQUENCE "learning_id_seq" OWNED BY "learning"."id";
SELECT setval('"learning_id_seq"', COALESCE((SELECT MAX("id") FROM "learning"), 1));

CREATE SEQUENCE IF NOT EXISTS "mail_events_id_seq";
ALTER TABLE "mail_events" ALTER COLUMN "id" SET DEFAULT nextval('"mail_events_id_seq"');
ALTER SEQUENCE "mail_events_id_seq" OWNED BY "mail_events"."id";
SELECT setval('"mail_events_id_seq"', COALESCE((SELECT MAX("id") FROM "mail_events"), 1));

CREATE SEQUENCE IF NOT EXISTS "orders_id_seq";
ALTER TABLE "orders" ALTER COLUMN "id" SET DEFAULT nextval('"orders_id_seq"');
ALTER SEQUENCE "orders_id_seq" OWNED BY "orders"."id";
SELECT setval('"orders_id_seq"', COALESCE((SELECT MAX("id") FROM "orders"), 1));

CREATE SEQUENCE IF NOT EXISTS "password_reset_requests_id_seq";
ALTER TABLE "password_reset_requests" ALTER COLUMN "id" SET DEFAULT nextval('"password_reset_requests_id_seq"');
ALTER SEQUENCE "password_reset_requests_id_seq" OWNED BY "password_reset_requests"."id";
SELECT setval('"password_reset_requests_id_seq"', COALESCE((SELECT MAX("id") FROM "password_reset_requests"), 1));

CREATE SEQUENCE IF NOT EXISTS "profile_demographics_id_seq";
ALTER TABLE "profile_demographics" ALTER COLUMN "id" SET DEFAULT nextval('"profile_demographics_id_seq"');
ALTER SEQUENCE "profile_demographics_id_seq" OWNED BY "profile_demographics"."id";
SELECT setval('"profile_demographics_id_seq"', COALESCE((SELECT MAX("id") FROM "profile_demographics"), 1));

CREATE SEQUENCE IF NOT EXISTS "profiles_id_seq";
ALTER TABLE "profiles" ALTER COLUMN "id" SET DEFAULT nextval('"profiles_id_seq"');
ALTER SEQUENCE "profiles_id_seq" OWNED BY "profiles"."id";
SELECT setval('"profiles_id_seq"', COALESCE((SELECT MAX("id") FROM "profiles"), 1));

CREATE SEQUENCE IF NOT EXISTS "questions_id_seq";
ALTER TABLE "questions" ALTER COLUMN "id" SET DEFAULT nextval('"questions_id_seq"');
ALTER SEQUENCE "questions_id_seq" OWNED BY "questions"."id";
SELECT setval('"questions_id_seq"', COALESCE((SELECT MAX("id") FROM "questions"), 1));

CREATE SEQUENCE IF NOT EXISTS "rater_answers_id_seq";
ALTER TABLE "rater_answers" ALTER COLUMN "id" SET DEFAULT nextval('"rater_answers_id_seq"');
ALTER SEQUENCE "rater_answers_id_seq" OWNED BY "rater_answers"."id";
SELECT setval('"rater_answers_id_seq"', COALESCE((SELECT MAX("id") FROM "rater_answers"), 1));

CREATE SEQUENCE IF NOT EXISTS "rater_campaigns_id_seq";
ALTER TABLE "rater_campaigns" ALTER COLUMN "id" SET DEFAULT nextval('"rater_campaigns_id_seq"');
ALTER SEQUENCE "rater_campaigns_id_seq" OWNED BY "rater_campaigns"."id";
SELECT setval('"rater_campaigns_id_seq"', COALESCE((SELECT MAX("id") FROM "rater_campaigns"), 1));

CREATE SEQUENCE IF NOT EXISTS "rater_email_templates_id_seq";
ALTER TABLE "rater_email_templates" ALTER COLUMN "id" SET DEFAULT nextval('"rater_email_templates_id_seq"');
ALTER SEQUENCE "rater_email_templates_id_seq" OWNED BY "rater_email_templates"."id";
SELECT setval('"rater_email_templates_id_seq"', COALESCE((SELECT MAX("id") FROM "rater_email_templates"), 1));

CREATE SEQUENCE IF NOT EXISTS "rater_emails_id_seq";
ALTER TABLE "rater_emails" ALTER COLUMN "id" SET DEFAULT nextval('"rater_emails_id_seq"');
ALTER SEQUENCE "rater_emails_id_seq" OWNED BY "rater_emails"."id";
SELECT setval('"rater_emails_id_seq"', COALESCE((SELECT MAX("id") FROM "rater_emails"), 1));

CREATE SEQUENCE IF NOT EXISTS "raters_id_seq";
ALTER TABLE "raters" ALTER COLUMN "id" SET DEFAULT nextval('"raters_id_seq"');
ALTER SEQUENCE "raters_id_seq" OWNED BY "raters"."id";
SELECT setval('"raters_id_seq"', COALESCE((SELECT MAX("id") FROM "raters"), 1));

CREATE SEQUENCE IF NOT EXISTS "referral_codes_id_seq";
ALTER TABLE "referral_codes" ALTER COLUMN "id" SET DEFAULT nextval('"referral_codes_id_seq"');
ALTER SEQUENCE "referral_codes_id_seq" OWNED BY "referral_codes"."id";
SELECT setval('"referral_codes_id_seq"', COALESCE((SELECT MAX("id") FROM "referral_codes"), 1));

CREATE SEQUENCE IF NOT EXISTS "report_comments_id_seq";
ALTER TABLE "report_comments" ALTER COLUMN "id" SET DEFAULT nextval('"report_comments_id_seq"');
ALTER SEQUENCE "report_comments_id_seq" OWNED BY "report_comments"."id";
SELECT setval('"report_comments_id_seq"', COALESCE((SELECT MAX("id") FROM "report_comments"), 1));

CREATE SEQUENCE IF NOT EXISTS "reputation_findings_id_seq";
ALTER TABLE "reputation_findings" ALTER COLUMN "id" SET DEFAULT nextval('"reputation_findings_id_seq"');
ALTER SEQUENCE "reputation_findings_id_seq" OWNED BY "reputation_findings"."id";
SELECT setval('"reputation_findings_id_seq"', COALESCE((SELECT MAX("id") FROM "reputation_findings"), 1));

CREATE SEQUENCE IF NOT EXISTS "reputation_scans_id_seq";
ALTER TABLE "reputation_scans" ALTER COLUMN "id" SET DEFAULT nextval('"reputation_scans_id_seq"');
ALTER SEQUENCE "reputation_scans_id_seq" OWNED BY "reputation_scans"."id";
SELECT setval('"reputation_scans_id_seq"', COALESCE((SELECT MAX("id") FROM "reputation_scans"), 1));

CREATE SEQUENCE IF NOT EXISTS "response_options_id_seq";
ALTER TABLE "response_options" ALTER COLUMN "id" SET DEFAULT nextval('"response_options_id_seq"');
ALTER SEQUENCE "response_options_id_seq" OWNED BY "response_options"."id";
SELECT setval('"response_options_id_seq"', COALESCE((SELECT MAX("id") FROM "response_options"), 1));
