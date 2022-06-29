-- Add activation_code and activated_at and activation_expiry

ALTER TABLE `esgi_user` ADD `activation_code` VARCHAR(255) NOT NULL AFTER `active`, ADD `activated_at` TIMESTAMP NULL DEFAULT NULL AFTER `activation_code`, ADD `activation_expiry` TIMESTAMP NULL DEFAULT NULL AFTER `activated_at`;
