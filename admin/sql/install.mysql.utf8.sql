CREATE OR REPLACE VIEW `#__frmtezza_v_user_area` AS  SELECT ugm.user_id, u.name, ugm.group_id, ug.title
FROM `#__users` AS `u`
INNER JOIN `#__user_usergroup_map` AS `ugm` ON `u`.`id` = `ugm`.`user_id`
INNER JOIN `#__usergroups` AS `ug` ON `ugm`.`group_id`=`ug`.`id` WHERE `ug`.`title` LIKE '%Area -%' AND `ug`.`title` NOT LIKE '%JEFE%';


CREATE TABLE IF NOT EXISTS `#__frmtezza_frm_user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_record` int(11) NOT NULL DEFAULT '0',
    `id_user` int(11) NOT NULL DEFAULT '0',
    `id_area` int(11) NOT NULL DEFAULT '0',
    `id_boss` int(11) NOT NULL DEFAULT '0',
    `approval` tinyint(3),
    `observation` varchar(400),
    `id_boss_rrhh` int(11) NOT NULL DEFAULT '0',
    `observation_rrhh` varchar(400),
    `approval_rrhh` tinyint(3),
    `dt_register` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `dt_approval` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    `dt_approval_rrhh` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;


