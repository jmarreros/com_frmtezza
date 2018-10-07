-- DROP TABLE IF EXISTS `#__frmtezza_areas`;

-- CREATE TABLE `#__frmtezza_areas` (
-- 	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
-- 	`area` VARCHAR(25) NOT NULL,
-- 	`published` tinyint(4) NOT NULL DEFAULT '1',
-- 	PRIMARY KEY (`id`)
-- )
-- 	ENGINE =MyISAM
-- 	AUTO_INCREMENT =0
-- 	DEFAULT CHARSET =utf8;

-- INSERT INTO `#__frmtezza_areas` (`area`) VALUES
-- ('Sistemas'),
-- ('Mantenimiento'),
-- ('Ventas');

DROP VIEW IF EXISTS `#__v_user_area`;

CREATE VIEW `#__v_user_area` AS  SELECT ugm.user_id, u.name, ugm.group_id, ug.title
FROM `#__users` AS `u`
INNER JOIN `#__user_usergroup_map` AS `ugm` ON `u`.`id` = `ugm`.`user_id`
INNER JOIN `#__usergroups` AS `ug` ON `ugm`.`group_id`=`ug`.`id` WHERE `ug`.`title` LIKE '%Area -%' AND `ug`.`title` NOT LIKE '%JEFE%';


