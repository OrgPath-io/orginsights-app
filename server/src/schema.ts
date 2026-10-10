import { index, integer, real, sqliteTable, text, uniqueIndex } from "drizzle-orm/sqlite-core";

export const categories = sqliteTable("categories", {
  id: integer("id").primaryKey(), name: text("name").notNull(), description: text("description").notNull(), active: integer("active", { mode: "boolean" }).notNull(),
});
export const capabilities = sqliteTable("capabilities", {
  id: integer("id").primaryKey(), name: text("name").notNull(), description: text("description").notNull(), active: integer("active", { mode: "boolean" }).notNull(),
});
export const questions = sqliteTable("questions", {
  id: integer("id").primaryKey(), prompt: text("prompt").notNull(), instruction: text("instruction").notNull(), questionTypeId: integer("question_type_id").notNull(), categoryId: integer("category_id").notNull(), capabilityId: integer("capability_id").notNull(), track: text("track").notNull(), showType: text("show_type").notNull(), imageBlobKey: text("image_blob_key"), active: integer("active", { mode: "boolean" }).notNull(), status: text("status", { enum: ["live", "draft"] }).notNull(),
});
export const responseOptions = sqliteTable("response_options", {
  id: integer("id").primaryKey(), questionId: integer("question_id").notNull(), label: text("label").notNull(), score: real("score").notNull(),
});
export const countries = sqliteTable("countries", { id: integer("id").primaryKey(), code: text("code").notNull(), name: text("name").notNull() });
export const industryCapabilities = sqliteTable("industry_capabilities", { id: integer("id").primaryKey(), industryName: text("industry_name").notNull(), categoryId: integer("category_id").notNull(), capabilityId: integer("capability_id").notNull(), level: text("level").notNull(), active: integer("active", { mode: "boolean" }).notNull() });
export const learning = sqliteTable("learning", { id: integer("id").primaryKey(), length: text("length").notNull(), title: text("title").notNull(), link: text("link").notNull(), capability: text("capability").notNull(), level: text("level").notNull(), source: text("source").notNull(), sourceLink: text("source_link").notNull() });
export const reportComments = sqliteTable("report_comments", { id: integer("id").primaryKey(), categoryId: integer("category_id").notNull(), top: text("top").notNull(), low: text("low").notNull(), hidden: text("hidden").notNull(), blind: text("blind").notNull() });

export const profiles = sqliteTable("profiles", {
  id: integer("id").primaryKey({ autoIncrement: true }), firstName: text("first_name").notNull(), lastName: text("last_name").notNull(), email: text("email").notNull(), country: text("country").notNull(), plan: text("plan", { enum: ["free", "full", "360", "coaching"] }).notNull(), assessmentMode: text("assessment_mode", { enum: ["snapshot", "summary", "360"] }), referralCode: text("referral_code"), publicReferralCode: text("public_referral_code").unique(), referredByProfileId: integer("referred_by_profile_id"), passwordHash: text("password_hash"), passwordUpdatedAt: integer("password_updated_at", { mode: "timestamp_ms" }), billingCancelledAt: integer("billing_cancelled_at", { mode: "timestamp_ms" }), coachDisclosure: integer("coach_disclosure", { mode: "boolean" }).notNull(), coachResultToken: text("coach_result_token").unique(), accessExpiresAt: integer("access_expires_at", { mode: "timestamp_ms" }), coachingSessionDate: text("coaching_session_date"), coachingBookedAt: integer("coaching_booked_at", { mode: "timestamp_ms" }), coachAssessmentChoice: text("coach_assessment_choice", { enum: ["orginsights", "360", "both"] }), isAdmin: integer("is_admin", { mode: "boolean" }).notNull().default(false), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(),
});
export const assessments = sqliteTable("assessments", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull(), attemptGroup: integer("attempt_group").notNull().default(1), kind: text("kind", { enum: ["self", "professional"] }).notNull(), status: text("status", { enum: ["not_started", "in_progress", "completed"] }).notNull(), startedAt: integer("started_at", { mode: "timestamp_ms" }), completedAt: integer("completed_at", { mode: "timestamp_ms" }),
});
export const assessmentHistory = sqliteTable("assessment_history", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), attemptGroup: integer("attempt_group").notNull(), mode: text("mode", { enum: ["snapshot", "summary", "360"] }).notNull(), selfAssessmentId: integer("self_assessment_id").notNull(), professionalAssessmentId: integer("professional_assessment_id").notNull(), reportJson: text("report_json").notNull(), completedAt: integer("completed_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [uniqueIndex("assessment_history_profile_group_idx").on(table.profileId, table.attemptGroup), index("assessment_history_profile_completed_idx").on(table.profileId, table.completedAt)]);
export const assessmentQuestions = sqliteTable("assessment_questions", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  assessmentId: integer("assessment_id").notNull().references(() => assessments.id, { onDelete: "cascade" }),
  questionId: integer("question_id").notNull().references(() => questions.id),
  displayOrder: integer("display_order").notNull(),
  reversed: integer("reversed", { mode: "boolean" }).notNull().default(false),
}, (table) => [
  uniqueIndex("assessment_questions_assessment_question_idx").on(table.assessmentId, table.questionId),
  uniqueIndex("assessment_questions_assessment_order_idx").on(table.assessmentId, table.displayOrder),
]);
export const answers = sqliteTable("answers", {
  id: integer("id").primaryKey({ autoIncrement: true }), assessmentId: integer("assessment_id").notNull(), questionId: integer("question_id").notNull(), optionId: integer("option_id").notNull(), score: real("score").notNull(), updatedAt: integer("updated_at", { mode: "timestamp_ms" }).notNull(),
});
export const raterCampaigns = sqliteTable("rater_campaigns", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  status: text("status", { enum: ["draft", "open", "closed"] }).notNull().default("draft"),
  reminderDays: integer("reminder_days").notNull().default(7),
  durationDays: integer("duration_days").notNull().default(30),
  createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(),
  launchedAt: integer("launched_at", { mode: "timestamp_ms" }),
  endAt: integer("end_at", { mode: "timestamp_ms" }),
  closedAt: integer("closed_at", { mode: "timestamp_ms" }),
}, (table) => [uniqueIndex("rater_campaigns_profile_idx").on(table.profileId)]);
export const raters = sqliteTable("raters", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull(), name: text("name").notNull(), email: text("email").notNull(), relationship: text("relationship").notNull(), reminderDays: integer("reminder_days"), status: text("status", { enum: ["draft", "invited", "started", "completed"] }).notNull(), accessToken: text("access_token").unique(), inviteSentAt: integer("invite_sent_at", { mode: "timestamp_ms" }), lastRemindedAt: integer("last_reminded_at", { mode: "timestamp_ms" }), nextReminderAt: integer("next_reminder_at", { mode: "timestamp_ms" }), reminderCount: integer("reminder_count").notNull().default(0), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(), startedAt: integer("started_at", { mode: "timestamp_ms" }), completedAt: integer("completed_at", { mode: "timestamp_ms" }),
});
export const raterAnswers = sqliteTable("rater_answers", { id: integer("id").primaryKey({ autoIncrement: true }), raterId: integer("rater_id").notNull(), questionId: integer("question_id").notNull(), optionId: integer("option_id").notNull(), score: real("score").notNull() });
export const raterEmailTemplates = sqliteTable("rater_email_templates", {
  id: integer("id").primaryKey({ autoIncrement: true }), templateKey: text("template_key").notNull().unique(), name: text("name").notNull(), enabled: integer("enabled", { mode: "boolean" }).notNull().default(true), subject: text("subject").notNull(), preheader: text("preheader").notNull(), heading: text("heading").notNull(), bodyHtml: text("body_html").notNull(), buttonLabel: text("button_label").notNull(), buttonUrl: text("button_url").notNull().default("{{assessment_link}}"), brandPrimary: text("brand_primary").notNull().default("#075d46"), brandAccent: text("brand_accent").notNull().default("#a9ddc5"), updatedAt: integer("updated_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [uniqueIndex("rater_email_templates_key_idx").on(table.templateKey)]);
export const raterEmails = sqliteTable("rater_emails", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  raterId: integer("rater_id").notNull().references(() => raters.id, { onDelete: "cascade" }),
  templateKey: text("template_key").notNull(),
  sequenceNumber: integer("sequence_number").notNull(),
  status: text("status", { enum: ["scheduled", "queued", "sent", "cancelled", "failed"] }).notNull(),
  scheduledAt: integer("scheduled_at", { mode: "timestamp_ms" }).notNull(),
  queuedAt: integer("queued_at", { mode: "timestamp_ms" }),
  attemptedAt: integer("attempted_at", { mode: "timestamp_ms" }),
  sentAt: integer("sent_at", { mode: "timestamp_ms" }),
  cancelledAt: integer("cancelled_at", { mode: "timestamp_ms" }),
  failureReason: text("failure_reason"),
  subjectSnapshot: text("subject_snapshot").notNull(),
  htmlSnapshot: text("html_snapshot").notNull(),
  assessmentLink: text("assessment_link").notNull(),
  createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [uniqueIndex("rater_emails_rater_sequence_idx").on(table.raterId, table.sequenceNumber), index("rater_emails_status_scheduled_idx").on(table.status, table.scheduledAt)]);
export const referralCodes = sqliteTable("referral_codes", { id: integer("id").primaryKey({ autoIncrement: true }), code: text("code").notNull(), ownerType: text("owner_type", { enum: ["coach", "organization"] }).notNull(), ownerName: text("owner_name").notNull(), ownerEmail: text("owner_email"), discountPercent: integer("discount_percent").notNull(), isCoachCode: integer("is_coach_code", { mode: "boolean" }).notNull().default(false), pricingMode: text("pricing_mode", { enum: ["discount", "free", "fixed"] }).notNull().default("discount"), fixedPrice: real("fixed_price"), unlockTier: text("unlock_tier", { enum: ["full", "360", "coaching"] }).notNull().default("full"), active: integer("active", { mode: "boolean" }).notNull(), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull() });
export const accessCodes = sqliteTable("access_codes", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  code: text("code").notNull().unique(),
  source: text("source").notNull().default("clickbank"),
  status: text("status", { enum: ["unused", "assigned", "redeemed", "revoked"] }).notNull().default("unused"),
  orderId: text("order_id"),
  buyerEmail: text("buyer_email"),
  redeemedByProfileId: integer("redeemed_by_profile_id"),
  createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(),
  assignedAt: integer("assigned_at", { mode: "timestamp_ms" }),
  redeemedAt: integer("redeemed_at", { mode: "timestamp_ms" }),
}, (table) => [index("access_codes_status_created_at_idx").on(table.status, table.createdAt)]);
export const orders = sqliteTable("orders", { id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull(), item: text("item").notNull(), amount: real("amount").notNull(), discountCode: text("discount_code"), status: text("status", { enum: ["test_paid", "clickbank_paid", "refunded"] }).notNull(), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull() });
export const mailEvents = sqliteTable("mail_events", { id: integer("id").primaryKey({ autoIncrement: true }), kind: text("kind").notNull(), recipient: text("recipient").notNull(), subject: text("subject").notNull(), status: text("status", { enum: ["queued", "sent", "failed"] }).notNull(), relatedId: integer("related_id"), attemptedAt: integer("attempted_at", { mode: "timestamp_ms" }), failureReason: text("failure_reason"), usedPort: integer("used_port"), messageId: text("message_id"), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull() });
export const emailTemplates = sqliteTable("email_templates", {
  id: integer("id").primaryKey({ autoIncrement: true }), templateKey: text("template_key").notNull().unique(), name: text("name").notNull(), enabled: integer("enabled", { mode: "boolean" }).notNull().default(true), subject: text("subject").notNull(), preheader: text("preheader").notNull(), heading: text("heading").notNull(), bodyHtml: text("body_html").notNull(), buttonLabel: text("button_label").notNull(), buttonUrl: text("button_url").notNull(), imageUrl: text("image_url"), brandPrimary: text("brand_primary").notNull().default("#075d46"), brandAccent: text("brand_accent").notNull().default("#a9ddc5"), updatedAt: integer("updated_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [uniqueIndex("email_templates_template_key_idx").on(table.templateKey)]);
export const candidateEmails = sqliteTable("candidate_emails", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), assessmentId: integer("assessment_id").references(() => assessments.id, { onDelete: "set null" }), templateKey: text("template_key").notNull(), eventKey: text("event_key").notNull().default(""), recipientEmail: text("recipient_email"), mergeFields: text("merge_fields"), status: text("status", { enum: ["scheduled", "queued", "sent", "cancelled", "failed"] }).notNull(), scheduledAt: integer("scheduled_at", { mode: "timestamp_ms" }).notNull(), queuedAt: integer("queued_at", { mode: "timestamp_ms" }), attemptedAt: integer("attempted_at", { mode: "timestamp_ms" }), sentAt: integer("sent_at", { mode: "timestamp_ms" }), cancelledAt: integer("cancelled_at", { mode: "timestamp_ms" }), failureReason: text("failure_reason"), subjectSnapshot: text("subject_snapshot").notNull(), htmlSnapshot: text("html_snapshot").notNull(), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [uniqueIndex("candidate_emails_profile_template_event_idx").on(table.profileId, table.templateKey, table.eventKey), index("candidate_emails_status_scheduled_idx").on(table.status, table.scheduledAt)]);
export const settings = sqliteTable("settings", { key: text("key").primaryKey(), value: text("value").notNull(), updatedAt: integer("updated_at", { mode: "timestamp_ms" }).notNull() });
export const profileDemographics = sqliteTable("profile_demographics", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), employmentStatus: text("employment_status"), educationLevel: text("education_level"), seniorityLevel: text("seniority_level"), industry: text("industry"), yearOfGraduation: integer("year_of_graduation"), jobFunction: text("job_function"), yearsExperience: integer("years_experience"), updatedAt: integer("updated_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [uniqueIndex("profile_demographics_profile_idx").on(table.profileId)]);
export const passwordResetRequests = sqliteTable("password_reset_requests", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), token: text("token").notNull().unique(), expiresAt: integer("expires_at", { mode: "timestamp_ms" }).notNull(), usedAt: integer("used_at", { mode: "timestamp_ms" }), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull(),
});
export const auditLog = sqliteTable("audit_log", { id: integer("id").primaryKey({ autoIncrement: true }), actor: text("actor").notNull(), action: text("action").notNull(), entity: text("entity").notNull(), details: text("details").notNull(), createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull() });

export const reputationScans = sqliteTable("reputation_scans", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  fullName: text("full_name").notNull(),
  city: text("city"),
  country: text("country"),
  employer: text("employer"),
  emails: text("emails"),
  handles: text("handles"),
  keywords: text("keywords"),
  score: integer("score"),
  resultCount: integer("result_count").notNull().default(0),
  matchedCount: integer("matched_count").notNull().default(0),
  negativeCount: integer("negative_count").notNull().default(0),
  status: text("status", { enum: ["complete", "no_results"] }).notNull().default("complete"),
  createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull().$defaultFn(() => new Date()),
}, (table) => [index("reputation_scans_profile_id_idx").on(table.profileId)]);

export const reputationFindings = sqliteTable("reputation_findings", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  scanId: integer("scan_id").notNull().references(() => reputationScans.id, { onDelete: "cascade" }),
  title: text("title").notNull(),
  url: text("url").notNull(),
  source: text("source"),
  snippet: text("snippet"),
  publishedAt: text("published_at"),
  rank: integer("rank").notNull(),
  matchConfidence: text("match_confidence", { enum: ["likely", "possible", "unlikely"] }).notNull(),
  sentiment: text("sentiment", { enum: ["positive", "neutral", "negative", "unclear"] }).notNull(),
  category: text("category", { enum: ["professional", "news", "social", "directory", "other"] }).notNull(),
  reason: text("reason").notNull(),
  nextStep: text("next_step").notNull(),
  userMatch: text("user_match", { enum: ["auto", "confirmed", "excluded"] }).notNull().default("auto"),
  createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull().$defaultFn(() => new Date()),
}, (table) => [index("reputation_findings_scan_id_idx").on(table.scanId)]);

export const sessions = sqliteTable("sessions", {
  id: text("id").primaryKey(),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  createdAt: integer("created_at", { mode: "timestamp_ms" }).notNull().$defaultFn(() => new Date()),
  expiresAt: integer("expires_at", { mode: "timestamp_ms" }).notNull(),
}, (table) => [index("sessions_profile_id_idx").on(table.profileId)]);
