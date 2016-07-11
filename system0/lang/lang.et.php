<?php 
  $lang = array();
  
  //  All pages
  $lang['all']['bfexplorer'] = "BytesFall Explorer";
  $lang['all']['bfexplorer_short'] = "bfExplorer";
  $lang['all']['slogan'] = "The free PHP file manager";
  $lang['all']['control_panel'] = "Juhtpaneel";
  $lang['all']['system_logout'] = "Logi välja";
  $lang['all']['accept'] = "Nõus";
  $lang['all']['cancel'] = "Katkesta";
  $lang['all']['insert'] = "Lisa";
  $lang['all']['update'] = "Uuenda";
  $lang['all']['change'] = "Muuda";
  $lang['all']['finish'] = "Lõpeta";
  $lang['all']['view'] = "Vaata";
  $lang['all']['edit'] = "Toimeta (Muuda)";
  $lang['all']['close'] = "Sulge";
  $lang['all']['actions'] = "Tegevused";
  $lang['all']['delete'] = "Kustuta";
  $lang['all']['asign'] = "Määra";
  $lang['all']['errors_ocurred'] = "Nõutud informatsioon on mittetäielik või sisaldab vigu";
  $lang['all']['mandatory_fields'] = "Kohustuslikud väljad";

  //  rights/index.php
  $lang['rights']['access_denied'] = "Pole õiguseid";
  $lang['rights']['go_bfexplorer'] = "Mine " . $lang['all']['bfexplorer'];
  $lang['rights']['go_cpanel'] = "Mine Juhtpaneelile";
  $lang['rights']['login'] = "Logi sisse teise kasutajanimega";

  //  passwd/index.php
  $lang['passwd']['old_pwd_mandatory'] = "Vana salasõna on kohustuslik";
  $lang['passwd']['old_pwd_wrong'] = "Vana salasõna pole õige";
  $lang['passwd']['new_pwd_mandatory'] = "Uus salasõna on kohustuslik";
  $lang['passwd']['must_retype_new_pwd'] = "Sa pead uue salasõna uuesti trükkima";
  $lang['passwd']['pwds_dont_match'] = "Uus salasõna on erinev";
  $lang['passwd']['change_pwd'] = "Muuda salasõna";
  $lang['passwd']['username'] = "Kasutajanimi";
  $lang['passwd']['old_pwd'] = "Vana salasõna";
  $lang['passwd']['new_pwd'] = "Uus salasõna";
  $lang['passwd']['retype_new_pwd'] = "Trüki uus salasõna uuesti";

  //  login/myLogin.php
  $lang['login']['login'] = "Logi sisse";
  $lang['login']['username'] = "Kasutajanimi";
  $lang['login']['passwd'] = "Salasõna";
  //  login/doLogin.php
  $lang['login']['wrong_pwd'] = "Kasutajanimi või salasõna on vale.";
  $lang['login']['loading_user'] = "Kasutaja seadeid laaditakse";
  $lang['login']['please_wait'] = "Palun oota";

  //  libs/listing.lib.php
  $lang['cpanel']['none_cond'] = "Puudub";
  $lang['cpanel']['eq'] = "On võrdne";
  $lang['cpanel']['not_eq'] = "Pole võrdne";
  $lang['cpanel']['gt'] = "On suurem";
  $lang['cpanel']['gt_eq'] = "On suurem või võrnde";
  $lang['cpanel']['st'] = "On väiksem";
  $lang['cpanel']['st_eq'] = "On väiksem või võrdne";
  $lang['cpanel']['bw'] = "Algab";
  $lang['cpanel']['not_bw'] = "Ei alga";
  $lang['cpanel']['fw'] = "Lõpeb";
  $lang['cpanel']['not_fw'] = "Ei lõpe";
  $lang['cpanel']['c'] = "Sisaldab";
  $lang['cpanel']['not_c'] = "Ei sisalda";
  $lang['cpanel']['e'] = "On tühi";
  $lang['cpanel']['not_e'] = "Ei ole tühi";
  $lang['cpanel']['none_field'] = "Puudub";
  $lang['cpanel']['field'] = "Väli";
  $lang['cpanel']['condition'] = "Tingimus";
  $lang['cpanel']['value'] = "Väärtus";
  $lang['cpanel']['fields_to_show'] = "Väljad mida näidata";
  $lang['cpanel']['delete_filter'] = "Kustuta filter";
  $lang['cpanel']['filter'] = "Filter";

  //  cpanel/index.php
  $lang['cpanel']['welcome'] = "%s , tere tulemast '%s' juhtpaneelile, et alustada, vali tegevus ülemisest menüüst; et lõpetada oma seanss, kasuta '%s' ikooni üleval paremas nurgas.";
  $lang['cpanel']['files'] = "Failid";
  $lang['cpanel']['first'] = "Esimene";
  $lang['cpanel']['previous'] = "Eelmine";
  $lang['cpanel']['next'] = "Järgmine";
  $lang['cpanel']['last'] = "Viimane";
  //  cpanel/users/globals.inc.php
  $lang['cpanel']['users']['id_user'] = "ID";
  $lang['cpanel']['users']['creation_date'] = "Loomise kuupäev";
  $lang['cpanel']['users']['update_date'] = "Viimase muutmise kuupäev";
  $lang['cpanel']['users']['username'] = "Kasutajanimi";
  $lang['cpanel']['users']['passwd'] = "Salasõna";
  $lang['cpanel']['users']['id_group'] = "Grupp";
  $lang['cpanel']['users']['name'] = "Eesnimi";
  $lang['cpanel']['users']['lastname'] = "Perekonnanimi";
  $lang['cpanel']['users']['email'] = "E-mail";
  $lang['cpanel']['users']['homedir'] = "Kodukataloog";
  //  cpanel/users/index.php
  $lang['cpanel']['users']['users_admin'] = "Kasutajate administreerimine";
  $lang['cpanel']['users']['delete_confirm'] = "Kasutaja kustutatakse.\n Kas tahad jätkata?";
  $lang['cpanel']['users']['show_info'] = "Näitan kasutajaid %s kuni %s hulgast %s.";
  $lang['cpanel']['users']['not_found'] = "Ühtegi kasutajat ei leitud.";
  $lang['cpanel']['users']['delete_user'] = "Kustuta kasutaja";
  //  cpanel/users/edit.php
  $lang['cpanel']['users']['edit_user'] = "Muuda kasutajat";
  $lang['cpanel']['users']['select_group'] = "Vali grupp";
  $lang['cpanel']['users']['email_wrong'] = "E-mail pole korrektne";
  $lang['cpanel']['users']['name_wrong'] = "Nimi on kohustuslik";
  $lang['cpanel']['users']['group_wrong'] = "Grupp on kohustuslik";
  //  cpanel/users/new.php
  $lang['cpanel']['users']['new_user'] = "Uus kasutaja";
  $lang['cpanel']['users']['username_exists'] = "Kasutajanimi on juba olemas, mõtle välja teistsugune";
  $lang['cpanel']['users']['username_wrong'] = "Kasutajanimi pole korrektne";
  //  cpanel/groups/globals.inc.php
  $lang['cpanel']['groups']['id_group'] = "ID";
  $lang['cpanel']['groups']['creation_date'] = "Loomise kuupäev";
  $lang['cpanel']['groups']['update_date'] = "Viimase uuendamise kuupäev";
  $lang['cpanel']['groups']['group1'] = "Õigused (1)";
  $lang['cpanel']['groups']['group2'] = "Õigused (2)";
  $lang['cpanel']['groups']['group3'] = "Õigused (3)";
  $lang['cpanel']['groups']['name'] = "Grupi nimi";
  //  cpanel/groups/index.php
  $lang['cpanel']['groups']['groups_admin'] = "Gruppide administreerimine";
  $lang['cpanel']['groups']['delete_confirm'] = "Grupp kustutatakse.\n Kas tahad jätkata?";
  $lang['cpanel']['groups']['show_info'] = "Näitan gruppe %s kuni %s hulgast %s.";
  $lang['cpanel']['groups']['not_found'] = "Ühtegi gruppi ei leitud.";
  $lang['cpanel']['groups']['delete_group'] = "Kustuta grupp";
  //  cpanel/groups/edit.php
  $lang['cpanel']['groups']['edit_group'] = "Muuda gruppi";
  $lang['cpanel']['groups']['name_wrong'] = "Nimi on kohustuslik";
  $lang['cpanel']['groups']['functionalities'] = "Funktsionaalsus";
  //  cpanel/groups/new.php
  $lang['cpanel']['groups']['new_group'] = "Uus grupp";
  $lang['cpanel']['groups']['groupname_wrong'] = "Grupi  nimi on kohustuslik";

  //  files/files.php
  $lang['files']['dir_doesnt_exists'] = "Kataloogi '%s' pole olemas.";
  $lang['files']['listing_files'] = "Failide loend";
  $lang['files']['name'] = "Nimi";
  $lang['files']['size'] = "Suurus";
  $lang['files']['type'] = "Tüüp";
  $lang['files']['last_accessed'] = "Viimati vaadatud";
  $lang['files']['last_modified'] = "Viimati muudetud";
  $lang['files']['permissions'] = "Õigused";
  $lang['files']['view_file'] = "Vaata faili";
  $lang['files']['edit_file'] = "Muuda faili";
  $lang['files']['download_file'] = "Tõmba fail alla";
  $lang['files']['file_type'] = "%s fail";
  $lang['files']['file_type2'] = "Fail";
  $lang['files']['file_title'] = "Fail: %s";
  $lang['files']['dir_type'] = "Kataloog";
  $lang['files']['dir_title'] = "Kataloog: %s";
  $lang['files']['prot_dir_alert'] = "See on kaitstud kataloog.";
  $lang['files']['prot_dir_title'] = "Kaitstud kataloog: %s";
  //  files/resume.php
  $lang['files']['resume_title'] = "Taastamine";
  $lang['files']['resume1'] = "%s kataloogi ja %s faili (%s)";
  $lang['files']['resume2'] = "Ketta suurus: %s";
  $lang['files']['resume3'] = "Vaba ruum: %s (%s %%)";
  //  files/reload.php
  $lang['files']['reload_title'] = "Uuendan...";
  $lang['files']['reload_text'] = "Uuendan %s ...";
  //  files/search.php
  $lang['files']['search_f_and_d'] = "Failide ja kataloogide otsimine";
  $lang['files']['search_in'] = "Otsi siit";
  $lang['files']['case_sensitive'] = "Suurtähetundlik";
  $lang['files']['include_subdirs'] = "Kaasa alamkataloogid";
  $lang['files']['search'] = "Otsi";
  $lang['files']['cancel_search'] = "Katkesta otsimine";
  //  files/search_result.php
  $lang['files']['error_in_request'] = "Sinu päringus on viga.";
  $lang['files']['dir_doesnt_exists'] = "Kataloogi '%s' pole olemas.";
  $lang['files']['search_result'] = "Otsingu tulemus";
  $lang['files']['in_directory'] = "Kataloogis";
  //  files/toolbar.php
  $lang['files']['toolbar'] = "Tööriistariba";
  $lang['files']['cannot_perform_action'] = "Sa ei või enne midagi teha kuni lõpetad praeguse tegevuse.";
  $lang['files']['name_ZIP_file'] = "ZIP-faili nimi";
  $lang['files']['new_name_dir'] = "Kataloogi uus nimi";
  $lang['files']['new_name_file'] = "Faili uus nimi";
  $lang['files']['not_selected'] = "Sa pole ühtegi faili või kataloogi valinud.";
  $lang['files']['new_dir_name'] = "Uue kaloogi nimi";
  $lang['files']['new_dir_suggested_name'] = "Uus_kataloog";
  $lang['files']['new_file_name'] = "Uue faili nimi";
  $lang['files']['new_file_suggested_name'] = "uus_fail.txt";
  $lang['files']['functionality_not_implemented'] = "See funktsionaalsus pole veel teostatud.";
  $lang['files']['home_dir'] = "Kodukataloog";
  $lang['files']['refresh'] = "Värskenda";
  $lang['files']['upper_dir'] = "Kataloog üles";
  $lang['files']['show_tree'] = "Näita puud";
  $lang['files']['show_search'] = "Näita otsingut";
  $lang['files']['copy_sel'] = "Kopeeri valitud";
  $lang['files']['move_sel'] = "Liiguta valitud";
  $lang['files']['download_comp_sel'] = "Tõmba valitud pakituna alla";
  $lang['files']['comp_sel'] = "Paki valitud kokku";
  $lang['files']['delete_sel'] = "Kustuta valitud";
  $lang['files']['set_permissions'] = "Sea õiguseid";
  $lang['files']['rename'] = "Nimeta ümber";
  $lang['files']['see_properties'] = "Vaata atribuute";
  $lang['files']['shell_cmd'] = "Käsurea käsud";
  $lang['files']['new_dir'] = "Uus kataloog";
  $lang['files']['new_file'] = "Uus fail";
  $lang['files']['no_frames'] = "Raamideta";
  $lang['files']['frames'] = "Raamidega";
  $lang['files']['go'] = "Mine";
  //  files/tree.php
  $lang['files']['tree'] = "Puu";
  $lang['files']['loading_tree'] = "Loading tree data...";
  $lang['files']['searching_item'] = "Searching for item...";
  $lang['files']['loading_item'] = "Loading...";
  //  files/upload.php
  $lang['files']['upload_files'] = "Lae failid üles";
  $lang['files']['upload'] = "Lae üles";
  //  files/view/index.php
  $lang['files']['view']['not_selected_file'] = "Sa pole ühtegi faili valinud.";
  $lang['files']['view']['error_reading_file'] = "Faili '%s' lugemisel tekkis viga.";
  $lang['files']['view']['error_opening_file'] = "Faili '%s' avamisel tekkis viga.";
  $lang['files']['view']['not_viewer'] = "Faili '%s' jaoks puudub vaataja.";
  $lang['files']['view']['file_name'] = "Faili nimi: %s";
  //  files/view/get_image.php
  $lang['files']['view']['cannot_open_file'] = "Faili ei saa vaatamiseks avada.";
  //  files/edit/index.php
  $lang['files']['edit']['error_writing_file'] = "Faili '%s' kirjutamisel tekkis viga.";
  $lang['files']['edit']['error_opening_file_write'] = "Faili '%s' avamisel kirjutamiskes tekkis viga.";
  $lang['files']['edit']['save_file'] = "Salvesta fail";
  $lang['files']['edit']['windows_format'] = "Windowsi formaat";
  $lang['files']['edit']['UNIX_format'] = "UNIXi formaat";
  //  files/upload/index.php
  $lang['files']['uploads']['no_file_selected'] = "Sa pole ühtegi faili valinud, mida üles laadida.";
  $lang['files']['uploads']['error_uploading_file'] = "Faili '%s' üleslaadimisel tekkis tõrge.";
  //  files/properties/index.php
  $lang['files']['properties']['error_seeing_properties_dirs'] = "Kataloogide atribuutide vaatamisel tekkis viga.";
  $lang['files']['properties']['error_seeing_properties_files'] = "Failide atribuutide vaatamisel tekkis viga.";
  $lang['files']['properties']['total'] = "Kokku";
  $lang['files']['properties']['size'] = "Suurus";
  $lang['files']['properties']['directories'] = "Kataloogid";
  $lang['files']['properties']['files'] = "Failid";
  $lang['files']['properties']['disk'] = "Ketas";
  $lang['files']['properties']['free_space'] = "Vaba ruum";
  //  files/permissions/index.php
  $lang['files']['perms']['error_set_perms_dirs'] = "Kataloogide õiguste muutmisel tekkis viga.";
  $lang['files']['perms']['error_set_perms_files'] = "Failide õiguste muutmisel tekkis viga.";
  $lang['files']['perms']['about_change_perms'] = "Sa hakkad muutma õiguseid valitud failidel";
  $lang['files']['perms']['owner'] = "Omanik";
  $lang['files']['perms']['group'] = "Grupp";
  $lang['files']['perms']['others'] = "Kõik ülejäänud";
  $lang['files']['perms']['read'] = "Lugemine";
  $lang['files']['perms']['write'] = "Kirjutamine";
  $lang['files']['perms']['execute'] = "Käivitamine";
  $lang['files']['perms']['selected_dirs'] = "Valitud kataloogid";
  $lang['files']['perms']['selected_files'] = "Valitud failid";
  //  files/newfile/index.php
  $lang['files']['newfile']['no_name'] = "Sa ei andnud failile nime.";
  $lang['files']['newfile']['couldnt_create'] = "Faili '%s'. ei saa luua";
  $lang['files']['newfile']['file_exists'] = "Fail '%s' on juba olemas.";
  //  files/newdir/index.php
  $lang['files']['newdir']['no_name'] = "Sa ei andnud kataloogile nime.";
  $lang['files']['newdir']['couldnt_create'] = "Kataloogi '%s' ei saa luua.";
  $lang['files']['newdir']['dir_exists'] = "Kataloog '%s' on juba olemas.";
  //  files/compress/dialog.php
  $lang['files']['compress']['compression_options'] = "Kokkupakkimise seaded";
  $lang['files']['compress']['file_name'] = "Faili nimi";
  $lang['files']['compress']['comp_type'] = "Kokkupakkimise tüüp";
  $lang['files']['compress']['select_comp_type'] = "Vali kokkupakkimise viis";
  $lang['files']['compress']['overwrite'] = "Kirjuta üle kui on olemas";
  $lang['files']['compress']['name_mandatory'] = "Faili nimi on kohustuslik.";
  $lang['files']['compress']['comp_type_mandatory'] = "Pakkimisviis on kohustuslik.";
  //  files/compress/index.php
  $lang['files']['compress']['extension_not_installed'] = "PHP laiendused failide kokkupakkimiseks pole installeeritud";
  //  files/download_compfile/index.php
  $lang['files']['download_compfile']['error_creating_compressed_file'] = "Kokkupakitud faili loomisel tekkis tõrge.";
  //  files/download/index.php
  $lang['files']['download']['cannot_open_file'] = "Ei saa faili avada allalaadimiseks.";
  //  files/delete/index.php
  $lang['files']['delete']['error_deleting_dirs'] = "Kataloogide kustutamisel tekkis viga.";
  $lang['files']['delete']['error_deleting_files'] = "Failide kustutamisel tekkis viga.";
  $lang['files']['delete']['delete_files'] = "Kustuta failid";
  $lang['files']['delete']['delete_confirm'] = "Kas oled kindel et tahad kustutada need failid ja kataloogid?";
  //  files/copy/index.php
  $lang['files']['copy']['error_copying_dirs'] = "Kataloogide kopeerimisel tekkis viga.";
  $lang['files']['copy']['error_copying_files'] = "Failide kopeerimisel tekkis viga.";
  $lang['files']['copy']['origin_eq_dest'] = "Lähtepunkt ja sihtpunkt on samad.";
  $lang['files']['copy']['move_files'] = "Liiguta failid";
  $lang['files']['copy']['copy_files'] = "Kopeeri failid";
  $lang['files']['copy']['path_to_move'] = "Vali kataloogitee, kuhu tahad valitud asjad liigutada";
  $lang['files']['copy']['path_to_copy'] = "Vali kataloogitee, kuhu tahad valitud asjad kopeerida";
  //  files/chgfilename/index.php
  $lang['files']['chgfilename']['no_old_name'] = "Sa ei andnud faili nime.";
  $lang['files']['chgfilename']['no_new_name'] = "Sa ei andnud faili nime.";
  $lang['files']['chgfilename']['couldnt_rename_file'] = "Faili  '%s' ei saa ümber nimetada.";
  $lang['files']['chgfilename']['file_doesnt_exists'] = "Faili '%s' pole olemas.";
  //  files/chgdirname/index.php
  $lang['files']['chgdirname']['no_old_name'] = "Sa ei andnud kataloogi nime.";
  $lang['files']['chgdirname']['no_new_name'] = "Sa ei andnud kataloogi nime.";
  $lang['files']['chgdirname']['couldnt_rename_dir'] = "Ei saa kataloogi '%s' ümber nimetada.";
  $lang['files']['chgdirname']['dir_doesnt_exists'] = "Kataloogi '%s' pole olemas.";
  //  files/shell/index.php
  $lang['files']['shell']['exec_shell_cmd'] = "Käivita käsurea käske";
  $lang['files']['shell']['error_exec_cd'] = "Jooksvat kataloogi ei saa käsurealt muuta.";
  $lang['files']['shell']['history'] = "Ajalugu";
  $lang['files']['shell']['clear_history'] = "Kustuta ajalugu";
?>