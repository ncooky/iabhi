<?php 
  $lang = array();
  
  //  All pages
  $lang['all']['bfexplorer'] = "BytesFall Explorer";
  $lang['all']['bfexplorer_short'] = "bfExplorer";
  $lang['all']['slogan'] = "El administrador de archivos PHP libre";
  $lang['all']['control_panel'] = "Panel de control";
  $lang['all']['system_logout'] = "Salir del sistema";
  $lang['all']['accept'] = "Aceptar";
  $lang['all']['cancel'] = "Cancelar";
  $lang['all']['insert'] = "Insertar";
  $lang['all']['update'] = "Actualizar";
  $lang['all']['change'] = "Cambiar";
  $lang['all']['finish'] = "Terminar";
  $lang['all']['view'] = "Ver";
  $lang['all']['edit'] = "Editar";
  $lang['all']['close'] = "Cerrar";
  $lang['all']['actions'] = "Acciones";
  $lang['all']['delete'] = "Borrar";
  $lang['all']['asign'] = "Asignar";
  $lang['all']['errors_ocurred'] = "Ocurrieron los siguientes errores";
  $lang['all']['mandatory_fields'] = "Campos obligatorios";

  //  rights/index.php
  $lang['rights']['access_denied'] = "Aceso denegado";
  $lang['rights']['go_bfexplorer'] = "Ir a " . $lang['all']['bfexplorer'];
  $lang['rights']['go_cpanel'] = "Ir al Panel de control";
  $lang['rights']['login'] = "Conectarse con otro usuario";

  //  passwd/index.php
  $lang['passwd']['old_pwd_mandatory'] = "La contrase&ntilde;a anterior es obligatoria";
  $lang['passwd']['old_pwd_wrong'] = "La contrase&ntilde;a anterior es incorrecta";
  $lang['passwd']['new_pwd_mandatory'] = "La nueva contrase&ntilde;a es obligatoria";
  $lang['passwd']['must_retype_new_pwd'] = "Tiene que volver a escribir la contrase&ntilde;a nueva";
  $lang['passwd']['pwds_dont_match'] = "Las contrase&ntilde;as no coinciden";
  $lang['passwd']['change_pwd'] = "Cambiar contraseña";
  $lang['passwd']['username'] = "Usuario";
  $lang['passwd']['old_pwd'] = "Contrase&ntilde;a anterior";
  $lang['passwd']['new_pwd'] = "Nueva contrase&ntilde;a";
  $lang['passwd']['retype_new_pwd'] = "Repetir nueva contrase&ntilde;a";

  //  login/myLogin.php
  $lang['login']['login'] = "Entrar";
  $lang['login']['username'] = "Usuario";
  $lang['login']['passwd'] = "Contrase&ntilde;a";
  //  login/doLogin.php
  $lang['login']['wrong_pwd'] = "El usuario o contrase&ntilde;a son incorrectos.";
  $lang['login']['loading_user'] = "Cargando usuario";
  $lang['login']['please_wait'] = "Por favor espere";

  //  libs/listing.lib.php
  $lang['cpanel']['none_cond'] = "Ninguna";
  $lang['cpanel']['eq'] = "Es igual a";
  $lang['cpanel']['not_eq'] = "No es igual a";
  $lang['cpanel']['gt'] = "Es mayor que";
  $lang['cpanel']['gt_eq'] = "Es mayor o igual que";
  $lang['cpanel']['st'] = "Es menor que";
  $lang['cpanel']['st_eq'] = "Es menor o igual que";
  $lang['cpanel']['bw'] = "Comienza por";
  $lang['cpanel']['not_bw'] = "No comienza por";
  $lang['cpanel']['fw'] = "Termina con";
  $lang['cpanel']['not_fw'] = "No termina con";
  $lang['cpanel']['c'] = "Contiene";
  $lang['cpanel']['not_c'] = "No contiene";
  $lang['cpanel']['e'] = "Est&aacute; vac&iacute;o";
  $lang['cpanel']['not_e'] = "No est&aacute; vac&iacute;o";
  $lang['cpanel']['none_field'] = "Ninguno";
  $lang['cpanel']['field'] = "Campo";
  $lang['cpanel']['condition'] = "Condici&oacute;n";
  $lang['cpanel']['value'] = "Valor";
  $lang['cpanel']['fields_to_show'] = "Campos a mostrar";
  $lang['cpanel']['delete_filter'] = "Limpiar filtro";
  $lang['cpanel']['filter'] = "Filtrar";

  //  cpanel/index.php
  $lang['cpanel']['welcome'] = "Bienvenido %s  al panel de control de '%s', para comenzar a trabajar seleccione una opci&oacute;n en el men&uacute; superior, para terminar su sesi&oacute;n use el &iacute;cono '%s', en la esquina superior derecha.";
  $lang['cpanel']['files'] = "Archivos";
  $lang['cpanel']['first'] = "Primero";
  $lang['cpanel']['previous'] = "Anterior";
  $lang['cpanel']['next'] = "Siguiente";
  $lang['cpanel']['last'] = "&Uacute;ltimo";
  //  cpanel/users/globals.inc.php
  $lang['cpanel']['users']['id_user'] = "ID";
  $lang['cpanel']['users']['creation_date'] = "Fecha de creaci&oacute;n";
  $lang['cpanel']['users']['update_date'] = "Fecha de &uacute;ltima actualizaci&oacute;n";
  $lang['cpanel']['users']['username'] = "Nombre de usuario";
  $lang['cpanel']['users']['passwd'] = "Contrase&ntilde;a";
  $lang['cpanel']['users']['id_group'] = "Grupo";
  $lang['cpanel']['users']['name'] = "Nombre";
  $lang['cpanel']['users']['lastname'] = "Apellidos";
  $lang['cpanel']['users']['email'] = "E-mail";
  $lang['cpanel']['users']['homedir'] = "Directorio personal";
  //  cpanel/users/index.php
  $lang['cpanel']['users']['users_admin'] = "Administraci&oacute;n de usuarios";
  $lang['cpanel']['users']['delete_confirm'] = "Se borrar&aacute; el usuario.\\n &iquest;Desea continuar?";
  $lang['cpanel']['users']['show_info'] = "Mostrando usuarios del %s al %s, de un total de %s.";
  $lang['cpanel']['users']['not_found'] = "No se encontr&oacute; ning&uacute;n usuario.";
  $lang['cpanel']['users']['delete_user'] = "Borrar usuario";
  //  cpanel/users/edit.php
  $lang['cpanel']['users']['edit_user'] = "Editar usuario";
  $lang['cpanel']['users']['select_group'] = "Seleccione el grupo";
  $lang['cpanel']['users']['email_wrong'] = "El e-mail no es v&aacute;lido";
  $lang['cpanel']['users']['name_wrong'] = "El nombre es obligatorio";
  $lang['cpanel']['users']['group_wrong'] = "El grupo es obligatorio";
  //  cpanel/users/new.php
  $lang['cpanel']['users']['new_user'] = "Nuevo usuario";
  $lang['cpanel']['users']['username_exists'] = "El nombre de usuario ya est&aacute; en uso!! Por favor escoja otro";
  $lang['cpanel']['users']['username_wrong'] = "El nombre de usuario no es v&aacute;lido";
  //  cpanel/groups/globals.inc.php
  $lang['cpanel']['groups']['id_group'] = "ID";
  $lang['cpanel']['groups']['creation_date'] = "Fecha de creaci&oacute;n";
  $lang['cpanel']['groups']['update_date'] = "Fecha de &uacute;ltima actualizaci&oacute;n";
  $lang['cpanel']['groups']['group1'] = "Permisos (1)";
  $lang['cpanel']['groups']['group2'] = "Permisos (2)";
  $lang['cpanel']['groups']['group3'] = "Permisos (3)";
  $lang['cpanel']['groups']['name'] = "Nombre del grupo";
  //  cpanel/groups/index.php
  $lang['cpanel']['groups']['groups_admin'] = "Administraci&oacute;n de grupos";
  $lang['cpanel']['groups']['delete_confirm'] = "Se borrar&aacute; el grupo.\\n &iquest;Desea continuar?";
  $lang['cpanel']['groups']['show_info'] = "Mostrando grupos del %s al %s, de un total de %s.";
  $lang['cpanel']['groups']['not_found'] = "No se encontr&oacute; ning&uacute;n grupo.";
  $lang['cpanel']['groups']['delete_group'] = "Borrar grupo";
  //  cpanel/groups/edit.php
  $lang['cpanel']['groups']['edit_group'] = "Editar grupo";
  $lang['cpanel']['groups']['name_wrong'] = "El nombre es obligatorio";
  $lang['cpanel']['groups']['functionalities'] = "Funcionalidades";
  //  cpanel/groups/new.php
  $lang['cpanel']['groups']['new_group'] = "Nuevo grupo";
  $lang['cpanel']['groups']['groupname_wrong'] = "El nombre del grupo es obligatorio";

  //  files/files.php
  $lang['files']['dir_doesnt_exists'] = "El directorio '%s' no existe.";
  $lang['files']['listing_files'] = "Listado de archivos";
  $lang['files']['name'] = "Nombre";
  $lang['files']['size'] = "Tama&ntilde;o";
  $lang['files']['type'] = "Tipo";
  $lang['files']['last_accessed'] = "&Uacute;ltimo acceso";
  $lang['files']['last_modified'] = "&Uacute;ltima modificaci&oacute;n";
  $lang['files']['permissions'] = "Permisos";
  $lang['files']['view_file'] = "Ver archivo";
  $lang['files']['edit_file'] = "Editar archivo";
  $lang['files']['download_file'] = "Descargar archivo";
  $lang['files']['file_type'] = "Archivo %s";
  $lang['files']['file_type2'] = "Archivo";
  $lang['files']['file_title'] = "Archivo: %s";
  $lang['files']['dir_type'] = "Directorio";
  $lang['files']['dir_title'] = "Directorio: %s";
  $lang['files']['prot_dir_alert'] = "Este es un directorio protegido.";
  $lang['files']['prot_dir_title'] = "Directorio protegido: %s";
  //  files/resume.php
  $lang['files']['resume_title'] = "Resumen";
  $lang['files']['resume1'] = "%s directorio(s) y %s archivo(s) (%s)";
  $lang['files']['resume2'] = "Tama&ntilde;o del disco: %s";
  $lang['files']['resume3'] = "Espacio libre: %s (%s %%)";
  //  files/reload.php
  $lang['files']['reload_title'] = "Recargando...";
  $lang['files']['reload_text'] = "Recargando %s ...";
  //  files/search.php
  $lang['files']['search_f_and_d'] = "Buscar archivos y directorios";
  $lang['files']['search_in'] = "Buscar en";
  $lang['files']['case_sensitive'] = "Coincidir may&uacute;sculas y min&uacute;sculas";
  $lang['files']['include_subdirs'] = "Incluir subdirectorios";
  $lang['files']['search'] = "Buscar";
  $lang['files']['cancel_search'] = "Cancelar b&uacute;squeda";
  //  files/search_result.php
  $lang['files']['error_in_request'] = "Su solicitud est&aacute; incompleta o contiene errores.";
  $lang['files']['dir_doesnt_exists'] = "El directorio '%s' no existe.";
  $lang['files']['search_result'] = "Resultados de la b&uacute;squeda";
  $lang['files']['in_directory'] = "En el directorio";
  //  files/toolbar.php
  $lang['files']['toolbar'] = "Barra de herramientas";
  $lang['files']['cannot_perform_action'] = "No puede realizar esta acción hasta que no termine la anterior.";
  $lang['files']['name_ZIP_file'] = "Nombre del archivo ZIP";
  $lang['files']['new_name_dir'] = "Nuevo nombre del directorio";
  $lang['files']['new_name_file'] = "Nuevo nombre del archivo";
  $lang['files']['not_selected'] = "No ha seleccionado ningún archivo ni directorio.";
  $lang['files']['new_dir_name'] = "Nombre del nuevo directorio";
  $lang['files']['new_dir_suggested_name'] = "Nuevo Directorio";
  $lang['files']['new_file_name'] = "Nombre del nuevo archivo";
  $lang['files']['new_file_suggested_name'] = "nuevo.txt";
  $lang['files']['functionality_not_implemented'] = "Esta funcionalidad no está implementada.";
  $lang['files']['home_dir'] = "Directorio ra&iacute;z";
  $lang['files']['refresh'] = "Refrescar";
  $lang['files']['upper_dir'] = "Directorio superior";
  $lang['files']['show_tree'] = "Mostrar &aacute;rbol";
  $lang['files']['show_search'] = "Mostrar b&uacute;squeda";
  $lang['files']['copy_sel'] = "Copiar la selecci&oacute;n";
  $lang['files']['move_sel'] = "Mover la selecci&oacute;n";
  $lang['files']['download_comp_sel'] = "Descargar la selecci&oacute;n como un archivo comprimido";
  $lang['files']['comp_sel'] = "Comprimir la selecci&oacute;n";
  $lang['files']['delete_sel'] = "Borrar la selecci&oacute;n";
  $lang['files']['set_permissions'] = "Cambiar permisos";
  $lang['files']['rename'] = "Renombrar";
  $lang['files']['see_properties'] = "Ver propiedades";
  $lang['files']['shell_cmd'] = "L&iacute;nea de comandos";
  $lang['files']['new_dir'] = "Nuevo directorio";
  $lang['files']['new_file'] = "Nuevo archivo";
  $lang['files']['no_frames'] = "No usar marcos";
  $lang['files']['frames'] = "Usar marcos";
  $lang['files']['go'] = "Ir";
  //  files/tree.php
  $lang['files']['tree'] = "&Aacute;rbol";
  $lang['files']['loading_tree'] = "Cargando los datos del &aacute;rbol...";
  $lang['files']['searching_item'] = "Buscando el elemento...";
  $lang['files']['loading_item'] = "Cargando...";
  //  files/upload.php
  $lang['files']['upload_files'] = "Subir archivos";
  $lang['files']['upload'] = "Subir";
  //  files/view/index.php
  $lang['files']['view']['not_selected_file'] = "No ha seleccionado ning&uacute;n archivo.";
  $lang['files']['view']['error_reading_file'] = "Ocurri&oacute; un error al leer el archivo '%s'.";
  $lang['files']['view']['error_opening_file'] = "Ocurri&oacute; un error al abrir el archivo '%s'.";
  $lang['files']['view']['not_viewer'] = "No hay ning&uacute;n visor para el archivo '%s'.";
  $lang['files']['view']['file_name'] = "Nombre del archivo: %s";
  //  files/view/get_image.php
  $lang['files']['view']['cannot_open_file'] = "No se pudo abrir el archivo para verlo.";
  //  files/edit/index.php
  $lang['files']['edit']['error_writing_file'] = "Ocurri&oacute; un error al escribir el archivo '%s'.";
  $lang['files']['edit']['error_opening_file_write'] = "Ocurri&oacute; un error al abrir el archivo '%s' en modo de escritura.";
  $lang['files']['edit']['save_file'] = "Guardar archivo";
  $lang['files']['edit']['windows_format'] = "Formato de Windows";
  $lang['files']['edit']['UNIX_format'] = "Formato de UNIX";
  //  files/upload/index.php
  $lang['files']['uploads']['no_file_selected'] = "No ha seleccionado ning&uacute;n archivo para subir.";
  $lang['files']['uploads']['error_uploading_file'] = "Ocurri&oacute; un error al subir el archivo '%s'.";
  //  files/properties/index.php
  $lang['files']['properties']['error_seeing_properties_dirs'] = "Ocurri&oacute; un error al ver las propiedades de los directorios.";
  $lang['files']['properties']['error_seeing_properties_files'] = "Ocurri&oacute; un error al ver las propiedades de los archivos.";
  $lang['files']['properties']['total'] = "Total";
  $lang['files']['properties']['size'] = "Tama&ntilde;o";
  $lang['files']['properties']['directories'] = "Directorios";
  $lang['files']['properties']['files'] = "Archivos";
  $lang['files']['properties']['disk'] = "Disco";
  $lang['files']['properties']['free_space'] = "Espacio libre";
  //  files/permissions/index.php
  $lang['files']['perms']['error_set_perms_dirs'] = "Ocurri&oacute; un error al cambiar los permisos de los directorios.";
  $lang['files']['perms']['error_set_perms_files'] = "Ocurri&oacute; un error al cambiar los permisos de los archivos.";
  $lang['files']['perms']['about_change_perms'] = "Est&aacute; a punto de cambiar los permisos de la selecci&oacute;n";
  $lang['files']['perms']['owner'] = "Due&ntilde;o";
  $lang['files']['perms']['group'] = "Grupo";
  $lang['files']['perms']['others'] = "Otros";
  $lang['files']['perms']['read'] = "Leer";
  $lang['files']['perms']['write'] = "Escribir";
  $lang['files']['perms']['execute'] = "Ejecutar";
  $lang['files']['perms']['selected_dirs'] = "Directorios seleccionados";
  $lang['files']['perms']['selected_files'] = "Archivos seleccionados";
  //  files/newfile/index.php
  $lang['files']['newfile']['no_name'] = "No puso el nombre del archivo.";
  $lang['files']['newfile']['couldnt_create'] = "No se pudo crear el archivo '%s'.";
  $lang['files']['newfile']['file_exists'] = "El archivo '%s' ya existe.";
  //  files/newdir/index.php
  $lang['files']['newdir']['no_name'] = "No puso el nombre del directorio.";
  $lang['files']['newdir']['couldnt_create'] = "No se pudo crear el directorio '%s'.";
  $lang['files']['newdir']['dir_exists'] = "El directorio '%s' ya existe.";
  //  files/compress/index.php
  $lang['files']['compress']['compression_options'] = "Opciones de compresi&oacute;n";
  $lang['files']['compress']['file_name'] = "Nombre del archivo";
  $lang['files']['compress']['comp_type'] = "Tipo de compresi&oacute;n";
  $lang['files']['compress']['select_comp_type'] = "Seleccione el tipo de compresi&oacute;n";
  $lang['files']['compress']['overwrite'] = "Sobreescribir si ya existe";
  $lang['files']['compress']['name_mandatory'] = "El nombre del archivo es obligatorio.";
  $lang['files']['compress']['comp_type_mandatory'] = "El tipo de compresi&oacute;n es obligatorio.";
  //  files/compress/index.php
  $lang['files']['compress']['extension_not_installed'] = "La estensi&oacute; PHP necesaria para comprimir los archivos no est&aacute; instalada";
  //  files/download_compfile/index.php
  $lang['files']['download_compfile']['error_creating_compressed_file'] = "Ocurri&oacute; un error al crear el archivo comprimido.";
  //  files/download/index.php
  $lang['files']['download']['cannot_open_file'] = "No se pudo abrir el archivo para descargarlo.";
  //  files/delete/index.php
  $lang['files']['delete']['error_deleting_dirs'] = "Ocurri&oacute; un error al borrar los directorios.";
  $lang['files']['delete']['error_deleting_files'] = "Ocurri&oacute; un error al borrar los archivos.";
  $lang['files']['delete']['delete_files'] = "Borrar archivos";
  $lang['files']['delete']['delete_confirm'] = "&iquest;Est&aacute; seguro de que desea borrar los siguientes archivos y directorios?";
  //  files/copy/index.php
  $lang['files']['copy']['error_copying_dirs'] = "Ocurri&oacute; un error al copiar los directorios.";
  $lang['files']['copy']['error_copying_files'] = "Ocurri&oacute; un error al copiar los archivos.";
  $lang['files']['copy']['origin_eq_dest'] = "El origen y el destino coinciden.";
  $lang['files']['copy']['move_files'] = "Mover archivos";
  $lang['files']['copy']['copy_files'] = "Copiar archivos";
  $lang['files']['copy']['path_to_move'] = "Seleccione el camino a donde desea mover la selecci&oacute;n";
  $lang['files']['copy']['path_to_copy'] = "Seleccione el camino a donde desea copiar la selecci&oacute;n";
  //  files/chgfilename/index.php
  $lang['files']['chgfilename']['no_old_name'] = "No puso el nombre del archivo.";
  $lang['files']['chgfilename']['no_new_name'] = "No puso un nombre para el archivo.";
  $lang['files']['chgfilename']['couldnt_rename_file'] = "No se pudo renombrar el archivo '%s'.";
  $lang['files']['chgfilename']['file_doesnt_exists'] = "El archivo '%s' no existe.";
  //  files/chgdirname/index.php
  $lang['files']['chgdirname']['no_old_name'] = "No puso el nombre del directorio.";
  $lang['files']['chgdirname']['no_new_name'] = "No puso un nombre para el directorio.";
  $lang['files']['chgdirname']['couldnt_rename_dir'] = "No se pudo renombrar el directorio '%s'.";
  $lang['files']['chgdirname']['dir_doesnt_exists'] = "El directorio '%s' no existe.";
  //  files/shell/index.php
  $lang['files']['shell']['exec_shell_cmd'] = "Ejecutar comandos";
  $lang['files']['shell']['error_exec_cd'] = "No se puede cambiar el directorio actual desde la l&iacute;nea de comandos.";
  $lang['files']['shell']['history'] = "Historial";
  $lang['files']['shell']['clear_history'] = "Limpiar historial";
?>