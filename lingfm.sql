CREATE DATABASE IF NOT EXISTS `lingfm`;
USE `lingfm`;

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `image` varchar(128) NOT NULL,
  `play` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `playlist` (`id`, `name`, `image`, `play`) VALUES
(1,	'testname1',	'testimage1',	1),
(2,	'testname2',	'testimage2',	1),
(3,	'testname3',	'testimage3',	2),
(4,	'testname4',	'testimage4',	2);

CREATE TABLE IF NOT EXISTS `musicLocal` (
  `id` bigint(20) unsigned NOT NULL,
  `localURL` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `musicLocal` (`id`, `localURL`) VALUES
(1,	'testlocalurl1'),
(2,	'testlocalurl2');

CREATE TABLE IF NOT EXISTS  `musicNetease` (
  `id` bigint(20) unsigned NOT NULL,
  `neteaseID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `musicNetease` (`id`, `neteaseID`) VALUES
(3,	1),
(4,	2);