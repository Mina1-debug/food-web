

CREATE TABLE `accompaniment` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `food_id` int NOT NULL,
  `added_by` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `foods` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `added_by` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `profile_image` text NOT NULL,
  `role` enum('Waiter','Admin') NOT NULL DEFAULT 'Waiter',
  `added_by` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `accompaniment` ADD PRIMARY KEY (`id`);

ALTER TABLE `foods` ADD PRIMARY KEY (`id`);

ALTER TABLE `users` ADD PRIMARY KEY (`id`);

ALTER TABLE `accompaniment` MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `foods` MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `users` MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
