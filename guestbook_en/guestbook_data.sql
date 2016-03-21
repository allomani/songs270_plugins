CREATE TABLE `guestbook_data` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;