--
-- Table structure for table 'users'
--
CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(254) NOT NULL,
    `forename` VARCHAR(100) NOT NULL,
    `password` TEXT NOT NULL,
    `salt` TEXT NOT NULL,
    `surname` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Table structure for table 'user_cookies'
--
CREATE TABLE IF NOT EXISTS `user_cookies` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `hash` TEXT NOT NULL,
    `user_id` BIGINT(20) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `user_cookies_user_id` (`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

