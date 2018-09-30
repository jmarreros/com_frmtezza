DROP TABLE IF EXISTS `#__frmtezza_areas`;

CREATE TABLE `#__frmtezza_areas` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`area` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO `#__frmtezza_areas` (`area`) VALUES
('Sistemas'),
('Mantenimiento'),
('Ventas');
