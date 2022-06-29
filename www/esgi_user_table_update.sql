
-- Change status column to active
ALTER TABLE `esgi_user` CHANGE `status` `active` TINYINT(4) NOT NULL DEFAULT '0';

-- Add roles column to user table
ALTER TABLE `esgi_user` ADD `role` INT(2) NULL AFTER `active` NOT NULL DEFAULT '0';
