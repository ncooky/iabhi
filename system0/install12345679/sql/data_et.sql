INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Kasutajate administreerimine');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Gruppide administreerimine');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Muuda salasõna');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Kopeeri');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Kustuta');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Vaata faile');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Muuda faile');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Loo uus kalaloog');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Loo uus fail');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Muuda kataloogi nime');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Muuda faili nime');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Muuda õiguseid');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Vaata atribuute');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Tõmba alla');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Paki failid kokku');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Lae üles');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Käivita käsurea käske');

INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Administrators', 131071, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Power users', 131068, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Users', 65532, NULL, NULL);

INSERT INTO %%tables_preffix%%users (creation_date, update_date, username, passwd, id_group, name, lastname, email) VALUES (NOW(), NOW(), 'admin', '%%password%%', 1, 'Administrator', NULL, 'raiko@linksys.ee');

