import { boolean, index, integer, pgTable, real, text, timestamp, uniqueIndex } from "drizzle-orm/pg-core";

export const categories = pgTable("categories", {
  id: integer("id").primaryKey(), name: text("name").notNull(), description: text("description").notNull(), active: boolean("active").notNull(),
});
export const capabilities = pgTable("capabilities", {
  id: integer("id").primaryKey(), name: text("name").notNull(), description: text("description").notNull(), active: boolean("active").notNull(),
});
export const questions = pgTable("questions", {
  id: integer("id").primaryKey(), prompt: text("prompt").notNull(), instruction: text("instruction").notNull(), questionTypeId: integer("question_type_id").notNull(), categoryId: integer("category_id").notNull(), capabilityId: integer("capability_id").notNull(), track: text("track").notNull(), showType: text("show_type").notNull(), imageBlobKey: text("image_blob_key"), active: boolean("active").notNull(), status: text("status").notNull(),
});
export const responseOptions = pgTable("response_options", {
  id: integer("id").primaryKey(), questionId: integer("question_id").notNull(), label: text("label").notNull(), score: real("score").notNull(),
});
export const countries = pgTable("countries", { id: integer("id").primaryKey(), code: text("code").notNull(), name: text("name").notNull() });
export const industryCapabilities = pgTable("industry_capabilities", { id: integer("id").primaryKey(), industryName: text("industry_name").notNull(), categoryId: integer("category_id").notNull(), capabilityId: integer("capability_id").notNull(), level: text("level").notNull(), active: boolean("active").notNull() });
export const learning = pgTable("learning", { id: integer("id").primaryKey(), length: text("length").notNull(), title: text("title").notNull(), link: text("link").notNull(), capability: text("capability").notNull(), level: text("level").notNull(), source: text("source").notNull(), sourceLink: text("source_link").notNull() });
export const reportComments = pgTable("report_comments", { id: integer("id").primaryKey(), categoryId: integer("category_id").notNull(), top: text("top").notNull(), low: text("low").notNull(), hidden: text("hidden").notNull(), blind: text("blind").notNull() });

export const profiles = pgTable("profiles", {
  id: integer("id").primaryKey({ autoIncrement: true }), firstName: text("first_name").notNull(), lastName: text("last_name").notNull(), email: text("email").notNull(), country: text("country").notNull(), plan: text("plan").notNull(), assessmentMode: text("assessment_mode"), referralCode: text("referral_code"), publicReferralCode: text("public_referral_code").unique(), referredByProfileId: integer("referred_by_profile_id"), passwordHash: text("password_hash"), passwordUpdatedAt: timestamp("password_updated_at"), billingCancelledAt: timestamp("billing_cancelled_at"), coachDisclosure: boolean("coach_disclosure").notNull(), coachResultToken: text("coach_result_token").unique(), accessExpiresAt: timestamp("access_expires_at"), coachingSessionDate: text("coaching_session_date"), coachingBookedAt: timestamp("coaching_booked_at"), isAdmin: boolean("is_admin").notNull().default(false), createdAt: timestamp("created_at").notNull(),
});
export const assessments = pgTable("assessments", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull(), attemptGroup: integer("attempt_group").notNull().default(1), kind: text("kind").notNull(), status: text("status").notNull(), startedAt: timestamp("started_at"), completedAt: timestamp("completed_at"),
});
export const assessmentHistory = pgTable("assessment_history", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), attemptGroup: integer("attempt_group").notNull(), mode: text("mode").notNull(), selfAssessmentId: integer("self_assessment_id").notNull(), professionalAssessmentId: integer("professional_assessment_id").notNull(), reportJson: text("report_json").notNull(), completedAt: timestamp("completed_at").notNull(),
}, (table) => [uniqueIndex("assessment_history_profile_group_idx").on(table.profileId, table.attemptGroup), index("assessment_history_profile_completed_idx").on(table.profileId, table.completedAt)]);
export const assessmentQuestions = pgTable("assessment_questions", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  assessmentId: integer("assessment_id").notNull().references(() => assessments.id, { onDelete: "cascade" }),
  questionId: integer("question_id").notNull().references(() => questions.id),
  displayOrder: integer("display_order").notNull(),
  reversed: boolean("reversed").notNull().default(false),
}, (table) => [
  uniqueIndex("assessment_questions_assessment_question_idx").on(table.assessmentId, table.questionId),
  uniqueIndex("assessment_questions_assessment_order_idx").on(table.assessmentId, table.displayOrder),
]);
export const answers = pgTable("answers", {
  id: integer("id").primaryKey({ autoIncrement: true }), assessmentId: integer("assessment_id").notNull(), questionId: integer("question_id").notNull(), optionId: integer("option_id").notNull(), score: real("score").notNull(), updatedAt: timestamp("updated_at").notNull(),
});
export const raterCampaigns = pgTable("rater_campaigns", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  status: text("status").notNull().default("draft"),
  reminderDays: integer("reminder_days").notNull().default(7),
  durationDays: integer("duration_days").notNull().default(30),
  createdAt: timestamp("created_at").notNull(),
  launchedAt: timestamp("launched_at"),
  endAt: timestamp("end_at"),
  closedAt: timestamp("closed_at"),
}, (table) => [uniqueIndex("rater_campaigns_profile_idx").on(table.profileId)]);
export const raters = pgTable("raters", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull(), name: text("name").notNull(), email: text("email").notNull(), relationship: text("relationship").notNull(), reminderDays: integer("reminder_days"), status: text("status").notNull(), accessToken: text("access_token").unique(), inviteSentAt: timestamp("invite_sent_at"), lastRemindedAt: timestamp("last_reminded_at"), nextReminderAt: timestamp("next_reminder_at"), reminderCount: integer("reminder_count").notNull().default(0), createdAt: timestamp("created_at").notNull(), startedAt: timestamp("started_at"), completedAt: timestamp("completed_at"),
});
export const raterAnswers = pgTable("rater_answers", { id: integer("id").primaryKey({ autoIncrement: true }), raterId: integer("rater_id").notNull(), questionId: integer("question_id").notNull(), optionId: integer("option_id").notNull(), score: real("score").notNull() });
export const raterEmailTemplates = pgTable("rater_email_templates", {
  id: integer("id").primaryKey({ autoIncrement: true }), templateKey: text("template_key").notNull().unique(), name: text("name").notNull(), enabled: boolean("enabled").notNull().default(true), subject: text("subject").notNull(), preheader: text("preheader").notNull(), heading: text("heading").notNull(), bodyHtml: text("body_html").notNull(), buttonLabel: text("button_label").notNull(), buttonUrl: text("button_url").notNull().default("{{assessment_link}}"), brandPrimary: text("brand_primary").notNull().default("#075d46"), brandAccent: text("brand_accent").notNull().default("#a9ddc5"), updatedAt: timestamp("updated_at").notNull(),
}, (table) => [uniqueIndex("rater_email_templates_key_idx").on(table.templateKey)]);
export const raterEmails = pgTable("rater_emails", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  raterId: integer("rater_id").notNull().references(() => raters.id, { onDelete: "cascade" }),
  templateKey: text("template_key").notNull(),
  sequenceNumber: integer("sequence_number").notNull(),
  status: text("status").notNull(),
  scheduledAt: timestamp("scheduled_at").notNull(),
  queuedAt: timestamp("queued_at"),
  attemptedAt: timestamp("attempted_at"),
  sentAt: timestamp("sent_at"),
  cancelledAt: timestamp("cancelled_at"),
  failureReason: text("failure_reason"),
  subjectSnapshot: text("subject_snapshot").notNull(),
  htmlSnapshot: text("html_snapshot").notNull(),
  assessmentLink: text("assessment_link").notNull(),
  createdAt: timestamp("created_at").notNull(),
}, (table) => [uniqueIndex("rater_emails_rater_sequence_idx").on(table.raterId, table.sequenceNumber), index("rater_emails_status_scheduled_idx").on(table.status, table.scheduledAt)]);
export const referralCodes = pgTable("referral_codes", { id: integer("id").primaryKey({ autoIncrement: true }), code: text("code").notNull(), ownerType: text("owner_type").notNull(), ownerName: text("owner_name").notNull(), ownerEmail: text("owner_email"), discountPercent: integer("discount_percent").notNull(), isCoachCode: boolean("is_coach_code").notNull().default(false), pricingMode: text("pricing_mode").notNull().default("discount"), fixedPrice: real("fixed_price"), unlockTier: text("unlock_tier").notNull().default("full"), active: boolean("active").notNull(), createdAt: timestamp("created_at").notNull() });
export const accessCodes = pgTable("access_codes", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  code: text("code").notNull().unique(),
  source: text("source").notNull().default("clickbank"),
  status: text("status").notNull().default("unused"),
  orderId: text("order_id"),
  buyerEmail: text("buyer_email"),
  redeemedByProfileId: integer("redeemed_by_profile_id"),
  createdAt: timestamp("created_at").notNull(),
  assignedAt: timestamp("assigned_at"),
  redeemedAt: timestamp("redeemed_at"),
}, (table) => [index("access_codes_status_created_at_idx").on(table.status, table.createdAt)]);
export const orders = pgTable("orders", { id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull(), item: text("item").notNull(), amount: real("amount").notNull(), taxAmount: real("tax_amount").notNull().default(0), taxRate: real("tax_rate"), taxLabel: text("tax_label"), stripeSessionId: text("stripe_session_id"), discountCode: text("discount_code"), status: text("status").notNull(), createdAt: timestamp("created_at").notNull() }, (table) => [uniqueIndex("orders_stripe_session_id_idx").on(table.stripeSessionId)]);
export const mailEvents = pgTable("mail_events", { id: integer("id").primaryKey({ autoIncrement: true }), kind: text("kind").notNull(), recipient: text("recipient").notNull(), subject: text("subject").notNull(), status: text("status").notNull(), relatedId: integer("related_id"), attemptedAt: timestamp("attempted_at"), failureReason: text("failure_reason"), usedPort: integer("used_port"), messageId: text("message_id"), createdAt: timestamp("created_at").notNull() });
export const emailTemplates = pgTable("email_templates", {
  id: integer("id").primaryKey({ autoIncrement: true }), templateKey: text("template_key").notNull().unique(), name: text("name").notNull(), enabled: boolean("enabled").notNull().default(true), subject: text("subject").notNull(), preheader: text("preheader").notNull(), heading: text("heading").notNull(), bodyHtml: text("body_html").notNull(), buttonLabel: text("button_label").notNull(), buttonUrl: text("button_url").notNull(), imageUrl: text("image_url"), brandPrimary: text("brand_primary").notNull().default("#075d46"), brandAccent: text("brand_accent").notNull().default("#a9ddc5"), updatedAt: timestamp("updated_at").notNull(),
}, (table) => [uniqueIndex("email_templates_template_key_idx").on(table.templateKey)]);
export const candidateEmails = pgTable("candidate_emails", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), assessmentId: integer("assessment_id").references(() => assessments.id, { onDelete: "set null" }), templateKey: text("template_key").notNull(), eventKey: text("event_key").notNull().default(""), recipientEmail: text("recipient_email"), mergeFields: text("merge_fields"), status: text("status").notNull(), scheduledAt: timestamp("scheduled_at").notNull(), queuedAt: timestamp("queued_at"), attemptedAt: timestamp("attempted_at"), sentAt: timestamp("sent_at"), cancelledAt: timestamp("cancelled_at"), failureReason: text("failure_reason"), subjectSnapshot: text("subject_snapshot").notNull(), htmlSnapshot: text("html_snapshot").notNull(), createdAt: timestamp("created_at").notNull(),
}, (table) => [uniqueIndex("candidate_emails_profile_template_event_idx").on(table.profileId, table.templateKey, table.eventKey), index("candidate_emails_status_scheduled_idx").on(table.status, table.scheduledAt)]);
export const settings = pgTable("settings", { key: text("key").primaryKey(), value: text("value").notNull(), updatedAt: timestamp("updated_at").notNull() });
export const profileDemographics = pgTable("profile_demographics", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), employmentStatus: text("employment_status"), educationLevel: text("education_level"), seniorityLevel: text("seniority_level"), industry: text("industry"), yearOfGraduation: integer("year_of_graduation"), jobFunction: text("job_function"), yearsExperience: integer("years_experience"), updatedAt: timestamp("updated_at").notNull(),
}, (table) => [uniqueIndex("profile_demographics_profile_idx").on(table.profileId)]);
export const passwordResetRequests = pgTable("password_reset_requests", {
  id: integer("id").primaryKey({ autoIncrement: true }), profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }), token: text("token").notNull().unique(), expiresAt: timestamp("expires_at").notNull(), usedAt: timestamp("used_at"), createdAt: timestamp("created_at").notNull(),
});
export const auditLog = pgTable("audit_log", { id: integer("id").primaryKey({ autoIncrement: true }), actor: text("actor").notNull(), action: text("action").notNull(), entity: text("entity").notNull(), details: text("details").notNull(), createdAt: timestamp("created_at").notNull() });

export const reputationScans = pgTable("reputation_scans", {
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
  status: text("status").notNull().default("complete"),
  createdAt: timestamp("created_at").notNull().$defaultFn(() => new Date()),
}, (table) => [index("reputation_scans_profile_id_idx").on(table.profileId)]);

export const reputationFindings = pgTable("reputation_findings", {
  id: integer("id").primaryKey({ autoIncrement: true }),
  scanId: integer("scan_id").notNull().references(() => reputationScans.id, { onDelete: "cascade" }),
  title: text("title").notNull(),
  url: text("url").notNull(),
  source: text("source"),
  snippet: text("snippet"),
  publishedAt: text("published_at"),
  rank: integer("rank").notNull(),
  matchConfidence: text("match_confidence").notNull(),
  sentiment: text("sentiment").notNull(),
  category: text("category").notNull(),
  reason: text("reason").notNull(),
  nextStep: text("next_step").notNull(),
  userMatch: text("user_match").notNull().default("auto"),
  createdAt: timestamp("created_at").notNull().$defaultFn(() => new Date()),
}, (table) => [index("reputation_findings_scan_id_idx").on(table.scanId)]);

export const sessions = pgTable("sessions", {
  id: text("id").primaryKey(),
  profileId: integer("profile_id").notNull().references(() => profiles.id, { onDelete: "cascade" }),
  createdAt: timestamp("created_at").notNull().$defaultFn(() => new Date()),
  expiresAt: timestamp("expires_at").notNull(),
}, (table) => [index("sessions_profile_id_idx").on(table.profileId)]);
