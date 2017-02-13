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