DROP TABLE IF EXISTS %%tables_preffix%%functionalities;
CREATE TABLE %%tables_preffix%%functionalities (
  id_functionality int(11) unsigned NOT NULL auto_increment,
  functionality varchar(100) NOT NULL default '',
  PRIMARY KEY  (id_functionality)
);

DROP TABLE IF EXISTS %%tables_preffix%%groups;
CREATE TABLE %%tables_preffix%%groups (
  id_group int(11) NOT NULL auto_increment,
  creation_date TIMESTAMP NOT NULL default '0000-00-00 00:00:00',
  update_date TIMESTAMP NOT NULL default '0000-00-00 00:00:00',
  name varchar(100) NOT NULL default '',
  group1 bigint(20) default '0',
  group2 bigint(20) default '0',
  group3 bigint(20) default '0',
  PRIMARY KEY  (id_group)
);

DROP TABLE IF EXISTS %%tables_preffix%%sessions;
CREATE TABLE %%tables_preffix%%sessions (
  id varchar(128) NOT NULL default '',
  timestamp int(11) NOT NULL default '0',
  data text
);

DROP TABLE IF EXISTS %%tables_preffix%%users;
CREATE TABLE %%tables_preffix%%users (
  id_user int(11) NOT NULL auto_increment,
  creation_date TIMESTAMP NOT NULL default '0000-00-00 00:00:00',
  update_date TIMESTAMP NOT NULL default '0000-00-00 00:00:00',
  username varchar(100) NOT NULL default '',
  passwd varchar(100) NOT NULL default '',
  id_group int(11) default NULL,
  name varchar(100) NOT NULL default '',
  lastname varchar(100) default '',
  email varchar(100) default '',
  homedir varchar(100) default '',
  PRIMARY KEY  (id_user)
);
