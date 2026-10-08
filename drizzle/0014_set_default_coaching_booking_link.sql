INSERT INTO `settings` (`key`, `value`, `updated_at`) VALUES ('booking_url', 'https://calendar.app.google/VhzSVyaTrN4v3C1f7', (unixepoch('now') * 1000))
ON CONFLICT(`key`) DO UPDATE SET `value` = excluded.`value`, `updated_at` = excluded.`updated_at`
WHERE `settings`.`value` = '';
