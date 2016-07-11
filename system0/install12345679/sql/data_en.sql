INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Users administration');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Groups administration');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Change password');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Copy');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Delete');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('View files');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Edit files');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Create new directory');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Create new file');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Change directory name');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Change file name');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Change permissions');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('See properties');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Download');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Compress files');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Upload');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Execute shell commands');

INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Administrators', 131071, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Power users', 131068, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Users', 65532, NULL, NULL);

INSERT INTO %%tables_preffix%%users (creation_date, update_date, username, passwd, id_group, name, lastname, email) VALUES (NOW(), NOW(), 'admin', '%%password%%', 1, 'Administrator', NULL, 'ovidio@users.sourceforge.net');
