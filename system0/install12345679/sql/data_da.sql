INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Brugeradministration');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Gruppeadministration');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Skift adgangskode');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Kopier');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Slet');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Vis filer');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Rediger filer');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Opret ny mappe');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Opret ny fil');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Omdøb mappe');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Omdøb fil');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Rediger rettigheder');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Vis egenskaber');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Hent');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Komprimer filer');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Upload');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Kommandolinie');

INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Administratorer', 131071, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Superbrugere', 131068, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Brugere', 65532, NULL, NULL);

INSERT INTO %%tables_preffix%%users (creation_date, update_date, username, passwd, id_group, name, lastname, email) VALUES (NOW(), NOW(), 'admin', '%%password%%', 1, 'Administrator', NULL, 'ovidio@users.sourceforge.net');
