DROP TABLE %%tables_preffix%%functionalities;
CREATE TABLE %%tables_preffix%%functionalities (
  id_functionality serial NOT NULL,
  functionality varchar(100) default '' NOT NULL,
  PRIMARY KEY  (id_functionality)
);

DROP TABLE %%tables_preffix%%groups;
CREATE TABLE %%tables_preffix%%groups (
  id_group serial NOT NULL,
  creation_date timestamp without time zone NOT NULL DEFAULT now(),
  update_date timestamp without time zone NOT NULL DEFAULT now(),
  name varchar(100) default '' NOT NULL,
  group1 integer default NULL,
  group2 integer default NULL,
  group3 integer default NULL,
  PRIMARY KEY  (id_group)
);

DROP TABLE %%tables_preffix%%sessions;
CREATE TABLE %%tables_preffix%%sessions (
  id varchar(128) default '' NOT NULL,
  timestamp integer default 0 NOT NULL,
  data text
);

DROP TABLE %%tables_preffix%%users;
CREATE TABLE %%tables_preffix%%users (
  id_user serial NOT NULL,
  creation_date timestamp without time zone NOT NULL DEFAULT now(),
  update_date timestamp without time zone NOT NULL DEFAULT now(),
  username varchar(100) default '' NOT NULL,
  passwd varchar(100) default '' NOT NULL,
  id_group integer default NULL,
  name varchar(100) default '' NOT NULL,
  lastname varchar(100) default '',
  email varchar(100) default '',
  homedir varchar(100) default '',
  PRIMARY KEY  (id_user)
);
        