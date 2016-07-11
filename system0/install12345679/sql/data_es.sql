INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Administraci&oacute;n de usuarios');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Administraci&oacute;n de grupos');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Cambiar contrase&ntilde;a');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Copiar');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Borrar');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Ver archivos');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Editar archivos');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Crear nuevo directorio');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Crear nuevo archivo');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Cambiar el nombre de los directorios');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Cambiar el nombre de los archivos');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Cambiar permisos');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Ver propiedades');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Descargar');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Comprimir archivos');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Subir');
INSERT INTO %%tables_preffix%%functionalities (functionality) VALUES ('Ejecutar comandos');

INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Administradores', 131071, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Usuarios avanzados', 131068, NULL, NULL);
INSERT INTO %%tables_preffix%%groups (creation_date, update_date, name, group1, group2, group3) VALUES (NOW(), NOW(), 'Usuarios', 65532, NULL, NULL);

INSERT INTO %%tables_preffix%%users (creation_date, update_date, username, passwd, id_group, name, lastname, email) VALUES (NOW(), NOW(), 'admin', '%%password%%', 1, 'Administrador', NULL, 'ovidio@users.sourceforge.net');
