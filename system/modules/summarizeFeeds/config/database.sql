-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_summarize_feeds`
-- 

CREATE TABLE `tl_summarize_feeds` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `resource` varchar(8) NOT NULL default '',
  `newsArchives` blob NULL,
  `calendar` blob NULL,
  `news4Archives` blob NULL,
  `title` varchar(255) NOT NULL default '',
  `alias` varbinary(128) NOT NULL default '',
  `description` text NULL,
  `source` varchar(6) NOT NULL default '',
  `letters` int(10) unsigned NOT NULL default '0',
  `maxItems` smallint(5) unsigned NOT NULL default '0',
  `language` varchar(32) NOT NULL default '',
  `format` varchar(4) NOT NULL default '',
  `feedBase` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Table `tl_layout`
-- 

CREATE TABLE `tl_layout` (
  `summarizeFeeds` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;