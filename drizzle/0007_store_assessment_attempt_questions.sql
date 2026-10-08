CREATE TABLE `assessment_questions` (
  `id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  `assessment_id` integer NOT NULL,
  `question_id` integer NOT NULL,
  `display_order` integer NOT NULL,
  `reversed` integer DEFAULT 0 NOT NULL,
  FOREIGN KEY (`assessment_id`) REFERENCES `assessments`(`id`) ON UPDATE no action ON DELETE cascade,
  FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`) ON UPDATE no action ON DELETE no action
);
--> statement-breakpoint
CREATE UNIQUE INDEX `assessment_questions_assessment_question_idx` ON `assessment_questions` (`assessment_id`,`question_id`);
--> statement-breakpoint
CREATE UNIQUE INDEX `assessment_questions_assessment_order_idx` ON `assessment_questions` (`assessment_id`,`display_order`);
