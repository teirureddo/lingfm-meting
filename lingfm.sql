CREATE TABLE IF NOT EXISTS `lingfm` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `music` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lingfm` (`id`, `name`, `music`, `image`) VALUES
(1,	'testname1',	'testmusic1',	'testimage1'),
(2,	'testname2',	'testmusic2',	'testimage2');

