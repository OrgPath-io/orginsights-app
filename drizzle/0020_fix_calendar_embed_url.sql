INSERT INTO `settings` (`key`, `value`, `updated_at`)
VALUES (
  'booking_embed_url',
  'https://calendar.google.com/calendar/appointments/schedules/AcZssZ0YwI5wbXkIwte7ezgvN2c7-7T1duoVHT-w7VjJg8Lw7tn1D-mmZLlx4FQjxh73OXTY7Yqgqmgy',
  CAST(strftime('%s','now') AS INTEGER) * 1000
)
ON CONFLICT(`key`) DO UPDATE SET
  `value` = excluded.`value`,
  `updated_at` = excluded.`updated_at`;
