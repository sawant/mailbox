/*!40101 SET NAMES utf8 */;

DROP TABLE IF EXISTS `inbox`;

CREATE TABLE `inbox` (
  `uid` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255) NOT NULL DEFAULT '',
  `message` TEXT,
  `time_sent` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT 0 COMMENT '0 = No, 1 = Yes',
  `is_archived` tinyint(1) DEFAULT 0 COMMENT '0 = No, 1 = Yes',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
