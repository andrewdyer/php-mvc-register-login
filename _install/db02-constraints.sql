--
-- Constraints for table `user_cookies`
--
ALTER TABLE `user_cookies` ADD CONSTRAINT `user_cookies_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

