<?php 
  $lang = array();
  
  //  All pages
  $lang['all']['bfexplorer'] = "BytesFall Explorer";
  $lang['all']['bfexplorer_short'] = "bfExplorer";
  $lang['all']['slogan'] = "En gratis PHP-baseret stifinder";
  $lang['all']['control_panel'] = "Kontrolpanel";
  $lang['all']['system_logout'] = "Log ud";
  $lang['all']['accept'] = "Godkend";
  $lang['all']['cancel'] = "Annuler";
  $lang['all']['insert'] = "Indsæt";
  $lang['all']['update'] = "Opdater";
  $lang['all']['change'] = "Skift";
  $lang['all']['finish'] = "Afslut";
  $lang['all']['view'] = "Vis";
  $lang['all']['edit'] = "Rediger";
  $lang['all']['close'] = "Luk";
  $lang['all']['actions'] = "Kommandoer";
  $lang['all']['delete'] = "Slet";
  $lang['all']['asign'] = "Udfør";
  $lang['all']['errors_ocurred'] = "De nødvendige informationer er mangelfulde eller indeholder fejl";
  $lang['all']['mandatory_fields'] = "Skal udfyldes";

  //  rights/index.php
  $lang['rights']['access_denied'] = "Adgang nægtet";
  $lang['rights']['go_bfexplorer'] = "Gå til " . $lang['all']['bfexplorer'];
  $lang['rights']['go_cpanel'] = "Gå til kontrolpanelet";
  $lang['rights']['login'] = "Log på som anden bruger";

  //  passwd/index.php
  $lang['passwd']['old_pwd_mandatory'] = "Det gamle kodeord skal indtastes";
  $lang['passwd']['old_pwd_wrong'] = "Det gamle kodeord er forkert";
  $lang['passwd']['new_pwd_mandatory'] = "Det nye kodeord skal indtastes";
  $lang['passwd']['must_retype_new_pwd'] = "Du skal gentage det nye kodeord";
  $lang['passwd']['pwds_dont_match'] = "Kodeordene er ikke ens";
  $lang['passwd']['change_pwd'] = "Skift kodeord";
  $lang['passwd']['username'] = "Brugernavn";
  $lang['passwd']['old_pwd'] = "Gammelt kodeord";
  $lang['passwd']['new_pwd'] = "Nyt kodeord";
  $lang['passwd']['retype_new_pwd'] = "Gentag nyt kodeord";

  //  login/myLogin.php
  $lang['login']['login'] = "Log på";
  $lang['login']['username'] = "Brugernavn";
  $lang['login']['passwd'] = "Kodeord";
  //  login/doLogin.php
  $lang['login']['wrong_pwd'] = "Brugernavnet eller kodeordet er forkert.";
  $lang['login']['loading_user'] = "Henter bruger";
  $lang['login']['please_wait'] = "Vent venligst";

  //  libs/listing.lib.php
  $lang['cpanel']['none_cond'] = "Intet";
  $lang['cpanel']['eq'] = "Er lig med";
  $lang['cpanel']['not_eq'] = "Er ikke lig med";
  $lang['cpanel']['gt'] = "Er større end";
  $lang['cpanel']['gt_eq'] = "Er større end eller lig med";
  $lang['cpanel']['st'] = "Er mindre end";
  $lang['cpanel']['st_eq'] = "Er mindre end eller lig med";
  $lang['cpanel']['bw'] = "Begynder med";
  $lang['cpanel']['not_bw'] = "Begynder ikke med";
  $lang['cpanel']['fw'] = "Slutter med";
  $lang['cpanel']['not_fw'] = "Slutter ikke med";
  $lang['cpanel']['c'] = "Indeholder";
  $lang['cpanel']['not_c'] = "Indeholder ikke";
  $lang['cpanel']['e'] = "Er tom";
  $lang['cpanel']['not_e'] = "Er ikke tom";
  $lang['cpanel']['none_field'] = "Intet";
  $lang['cpanel']['field'] = "Felt";
  $lang['cpanel']['condition'] = "Betingelse";
  $lang['cpanel']['value'] = "Værdi";
  $lang['cpanel']['fields_to_show'] = "Vis felter";
  $lang['cpanel']['delete_filter'] = "Slet felter";
  $lang['cpanel']['filter'] = "Filter";

  //  cpanel/index.php
  $lang['cpanel']['welcome'] = "Velkommen, %s, til kontrolpanelet for '%s'. Vælg indstillinger fra ovenstående menu. Tryk på '%s' i øverste højre hjørne for at afslutte.";
  $lang['cpanel']['files'] = "Filer";
  $lang['cpanel']['first'] = "Første";
  $lang['cpanel']['previous'] = "Forrige";
  $lang['cpanel']['next'] = "Næste";
  $lang['cpanel']['last'] = "Sidste";
  //  cpanel/users/globals.inc.php
  $lang['cpanel']['users']['id_user'] = "ID";
  $lang['cpanel']['users']['creation_date'] = "Oprettelsesdato";
  $lang['cpanel']['users']['update_date'] = "Sidst opdateret";
  $lang['cpanel']['users']['username'] = "Brugernavn";
  $lang['cpanel']['users']['passwd'] = "Kodeord";
  $lang['cpanel']['users']['id_group'] = "Gruppe";
  $lang['cpanel']['users']['name'] = "Fornavn";
  $lang['cpanel']['users']['lastname'] = "Efternavn";
  $lang['cpanel']['users']['email'] = "E-mail";
  $lang['cpanel']['users']['homedir'] = "Hoved-mappe";
  //  cpanel/users/index.php
  $lang['cpanel']['users']['users_admin'] = "Brugeradministration";
  $lang['cpanel']['users']['delete_confirm'] = "Brugeren vil blive slettet.\n Vil du fortsætte?";
  $lang['cpanel']['users']['show_info'] = "Viser brugere %s - %s af %s.";
  $lang['cpanel']['users']['not_found'] = "Der er ikke oprettet nogle brugere.";
  $lang['cpanel']['users']['delete_user'] = "Slet bruger";
  //  cpanel/users/edit.php
  $lang['cpanel']['users']['edit_user'] = "Rediger bruger";
  $lang['cpanel']['users']['select_group'] = "Vælg gruppe";
  $lang['cpanel']['users']['email_wrong'] = "E-mail adressen er ugyldig";
  $lang['cpanel']['users']['name_wrong'] = "Fornavn skal indtastes";
  $lang['cpanel']['users']['group_wrong'] = "Gruppe skal vælges";
  //  cpanel/users/new.php
  $lang['cpanel']['users']['new_user'] = "Opret bruger";
  $lang['cpanel']['users']['username_exists'] = "Brugernavnet er optaget!! Vælg venligst et andet";
  $lang['cpanel']['users']['username_wrong'] = "Brugernavnet er ugyldigt";
  //  cpanel/groups/globals.inc.php
  $lang['cpanel']['groups']['id_group'] = "ID";
  $lang['cpanel']['groups']['creation_date'] = "Oprettelsesdato";
  $lang['cpanel']['groups']['update_date'] = "Sidst opdateret";
  $lang['cpanel']['groups']['group1'] = "Tilladelser (1)";
  $lang['cpanel']['groups']['group2'] = "Tilladelser (2)";
  $lang['cpanel']['groups']['group3'] = "Tilladelser (3)";
  $lang['cpanel']['groups']['name'] = "Guppenavn";
  //  cpanel/groups/index.php
  $lang['cpanel']['groups']['groups_admin'] = "Gruppeadministration";
  $lang['cpanel']['groups']['delete_confirm'] = "Gruppen vil blive slettet.\n Vil du fortsætte?";
  $lang['cpanel']['groups']['show_info'] = "Viser gruppe %s - %s ad %s.";
  $lang['cpanel']['groups']['not_found'] = "Der er ikke oprettet nogle grupper.";
  $lang['cpanel']['groups']['delete_group'] = "Slet gruppe";
  //  cpanel/groups/edit.php
  $lang['cpanel']['groups']['edit_group'] = "Rediger gruppe";
  $lang['cpanel']['groups']['name_wrong'] = "Navnet skal indtastes";
  $lang['cpanel']['groups']['functionalities'] = "Rettigheder";
  //  cpanel/groups/new.php
  $lang['cpanel']['groups']['new_group'] = "Opret gruppe";
  $lang['cpanel']['groups']['groupname_wrong'] = "Gruppenavnet skal indtastes";

  //  files/files.php
  $lang['files']['dir_doesnt_exists'] = "Mappen'%s' eksisterer ikke.";
  $lang['files']['listing_files'] = "Filer";
  $lang['files']['name'] = "Navn";
  $lang['files']['size'] = "Størrelse";
  $lang['files']['type'] = "Type";
  $lang['files']['last_accessed'] = "Sidst åbnet";
  $lang['files']['last_modified'] = "Sidst ændret";
  $lang['files']['permissions'] = "Rettigheder";
  $lang['files']['view_file'] = "Vis fil";
  $lang['files']['edit_file'] = "Rediger fil";
  $lang['files']['download_file'] = "Hent fil";
  $lang['files']['file_type'] = "%s fil";
  $lang['files']['file_type2'] = "Fil";
  $lang['files']['file_title'] = "Fil: %s";
  $lang['files']['dir_type'] = "Mappe";
  $lang['files']['dir_title'] = "Mappe: %s";
  $lang['files']['prot_dir_alert'] = "Denne mappe er beskyttet.";
  $lang['files']['prot_dir_title'] = "Beskyttet mappe: %s";
  //  files/resume.php
  $lang['files']['resume_title'] = "Fortsæt";
  $lang['files']['resume1'] = "%s mappe(r) og %s fil(er) (%s)";
  $lang['files']['resume2'] = "Disk størrelse: %s";
  $lang['files']['resume3'] = "Ledig diskplads: %s (%s %%)";
  //  files/reload.php
  $lang['files']['reload_title'] = "Henter...";
  $lang['files']['reload_text'] = "Henter %s ...";
  //  files/search.php
  $lang['files']['search_f_and_d'] = "Søg efter filer og mapper";
  $lang['files']['search_in'] = "Søg i";
  $lang['files']['case_sensitive'] = "Forskel på store og små bogstaver";
  $lang['files']['include_subdirs'] = "Søg i undermapper";
  $lang['files']['search'] = "Søg";
  $lang['files']['cancel_search'] = "Annuler søgning";
  //  files/search_result.php
  $lang['files']['error_in_request'] = "Der er fejl i søgningen.";
  $lang['files']['dir_doesnt_exists'] = "Mappen '%s' eksisterer ikke.";
  $lang['files']['search_result'] = "Søgeresultater";
  $lang['files']['in_directory'] = "I mappen";
  //  files/toolbar.php
  $lang['files']['toolbar'] = "Værktøjslinie";
  $lang['files']['cannot_perform_action'] = "Du kan ikke foretage en handling, før den nuværende er afsluttet.";
  $lang['files']['name_ZIP_file'] = "Navn på ZIP filen";
  $lang['files']['new_name_dir'] = "Mappens nye navn";
  $lang['files']['new_name_file'] = "Filens nye navn";
  $lang['files']['not_selected'] = "Du har ikke valgt en file eller mappe.";
  $lang['files']['new_dir_name'] = "Navn på nyt bibliotek";
  $lang['files']['new_dir_suggested_name'] = "Ny mappe";
  $lang['files']['new_file_name'] = "Navn på ny mappe";
  $lang['files']['new_file_suggested_name'] = "unavngivet.txt";
  $lang['files']['functionality_not_implemented'] = "Denne kommando er endnu ikke understøttet.";
  $lang['files']['home_dir'] = "Hoved-mappe";
  $lang['files']['refresh'] = "Opdater";
  $lang['files']['upper_dir'] = "Et niveau op";
  $lang['files']['show_tree'] = "Vis træ";
  $lang['files']['show_search'] = "Vis søgning";
  $lang['files']['copy_sel'] = "Kopier markerede";
  $lang['files']['move_sel'] = "Flyt markerede";
  $lang['files']['download_comp_sel'] = "Hent markerede filer og mapper i komprimeret format";
  $lang['files']['comp_sel'] = "Komprimer markerede filer og mapper";
  $lang['files']['delete_sel'] = "Slet markerede";
  $lang['files']['set_permissions'] = "Sæt rettigheder";
  $lang['files']['rename'] = "Omdøb";
  $lang['files']['see_properties'] = "Vis egenskaber";
  $lang['files']['shell_cmd'] = "Kommandolinie";
  $lang['files']['new_dir'] = "Ny mappe";
  $lang['files']['new_file'] = "Ny fil";
  $lang['files']['no_frames'] = "Ingen 'frames'";
  $lang['files']['frames'] = "Frames";
  $lang['files']['go'] = "Kør";
  //  files/tree.php
  $lang['files']['tree'] = "Træ";
  $lang['files']['loading_tree'] = "Loading tree data...";
  $lang['files']['searching_item'] = "Searching for item...";
  $lang['files']['loading_item'] = "Loading...";
  //  files/upload.php
  $lang['files']['upload_files'] = "Upload filer";
  $lang['files']['upload'] = "Upload";
  //  files/view/index.php
  $lang['files']['view']['not_selected_file'] = "Der er ikke valgt nogen filer.";
  $lang['files']['view']['error_reading_file'] = "Der opstod en fejl ved læsning af filen '%s'.";
  $lang['files']['view']['error_opening_file'] = "Der opstod en fejl ved åbning af filen '%s'.";
  $lang['files']['view']['not_viewer'] = "Der er ingen fremviser for filen '%s'.";
  $lang['files']['view']['file_name'] = "Filnavn: %s";
  //  files/view/get_image.php
  $lang['files']['view']['cannot_open_file'] = "Filen kan ikke vises.";
  //  files/edit/index.php
  $lang['files']['edit']['error_writing_file'] = "Der opstod en fejl ved skrivning af filen '%s'.";
  $lang['files']['edit']['error_opening_file_write'] = "Der opstod en fejl ved åbning af filen '%s' i forbindelse med skrivning.";
  $lang['files']['edit']['save_file'] = "Gem fil";
  $lang['files']['edit']['windows_format'] = "Windows format";
  $lang['files']['edit']['UNIX_format'] = "UNIX format";
  //  files/upload/index.php
  $lang['files']['uploads']['no_file_selected'] = "Du har ikke valgt en fil, som skal uploades.";
  $lang['files']['uploads']['error_uploading_file'] = "Der opstod en fejl ved forsøg på at uploade filen '%s'.";
  //  files/properties/index.php
  $lang['files']['properties']['error_seeing_properties_dirs'] = "Der opstod en fejl ved læsning af mappernes egenskaber.";
  $lang['files']['properties']['error_seeing_properties_files'] = "Der opstod en fejl ved læsning af filernes egenskaber.";
  $lang['files']['properties']['total'] = "Samlet";
  $lang['files']['properties']['size'] = "Størrelse";
  $lang['files']['properties']['directories'] = "Mapper";
  $lang['files']['properties']['files'] = "Filer";
  $lang['files']['properties']['disk'] = "Disk";
  $lang['files']['properties']['free_space'] = "Ledig plads";
  //  files/permissions/index.php
  $lang['files']['perms']['error_set_perms_dirs'] = "Der opstod en fejl ved ændring af rettighederne for mapperne.";
  $lang['files']['perms']['error_set_perms_files'] = "Der opstod en fejl ved ændring af rettighederne for filerne.";
  $lang['files']['perms']['about_change_perms'] = "Du er ved at ændre rettighederne for de valgte filer og mapper";
  $lang['files']['perms']['owner'] = "Ejer";
  $lang['files']['perms']['group'] = "Gruppe";
  $lang['files']['perms']['others'] = "Andre";
  $lang['files']['perms']['read'] = "Læs";
  $lang['files']['perms']['write'] = "Skriv";
  $lang['files']['perms']['execute'] = "Kør";
  $lang['files']['perms']['selected_dirs'] = "Valgte mapper";
  $lang['files']['perms']['selected_files'] = "Valgte filer";
  //  files/newfile/index.php
  $lang['files']['newfile']['no_name'] = "Du har ikke angivet et navn til filen.";
  $lang['files']['newfile']['couldnt_create'] = "Kunne ikke oprette filen '%s'.";
  $lang['files']['newfile']['file_exists'] = "Filen '%s' eksisterer allerede.";
  //  files/newdir/index.php
  $lang['files']['newdir']['no_name'] = "Du har ikke angivet et navn til mappen.";
  $lang['files']['newdir']['couldnt_create'] = "Kunne ikke oprette mappen '%s'.";
  $lang['files']['newdir']['dir_exists'] = "Mappen '%s' eksisterer allerede.";
  //  files/compress/dialog.php
  $lang['files']['compress']['compression_options'] = "Komprimerings indstillinger";
  $lang['files']['compress']['file_name'] = "Filnavn";
  $lang['files']['compress']['comp_type'] = "Kompressionstype";
  $lang['files']['compress']['select_comp_type'] = "Vælg kompressionstype";
  $lang['files']['compress']['overwrite'] = "Overskriv hvis filen eksisterer i forvejen";
  $lang['files']['compress']['name_mandatory'] = "Filnavn skal anføres.";
  $lang['files']['compress']['comp_type_mandatory'] = "Kompressionstype skal anføres.";
  //  files/compress/index.php
  $lang['files']['compress']['extension_not_installed'] = "PHP-udvidelsen til at komprimere filer er ikke installeret";
  //  files/download_compfile/index.php
  $lang['files']['download_compfile']['error_creating_compressed_file'] = "Der opstod en fejl ved kompression af filen.";
  //  files/download/index.php
  $lang['files']['download']['cannot_open_file'] = "Kan ikke åbne filen, der skal downloades.";
  //  files/delete/index.php
  $lang['files']['delete']['error_deleting_dirs'] = "Der opstod en fejl ved sletning af mapperne.";
  $lang['files']['delete']['error_deleting_files'] = "Der opstod en fejl ved sletning af filerne.";
  $lang['files']['delete']['delete_files'] = "Slet filer";
  $lang['files']['delete']['delete_confirm'] = "Er du sikker på, du vil slette følgende filer og mapper?";
  //  files/copy/index.php
  $lang['files']['copy']['error_copying_dirs'] = "Der opstod en fejl ved kopiering af mapperne.";
  $lang['files']['copy']['error_copying_files'] = "Der opstod en fejl ved kopiering af filerne.";
  $lang['files']['copy']['origin_eq_dest'] = "Kildemappen og destinationsmappen er ens.";
  $lang['files']['copy']['move_files'] = "Flyt filer";
  $lang['files']['copy']['copy_files'] = "Kopier filer";
  $lang['files']['copy']['path_to_move'] = "Vælg destinationsmappen for flytning af de valgte filer";
  $lang['files']['copy']['path_to_copy'] = "Vælg destinationsmappen for kopiering af de valgte filer";
  //  files/chgfilename/index.php
  $lang['files']['chgfilename']['no_old_name'] = "Du har ikke angivet en fil.";
  $lang['files']['chgfilename']['no_new_name'] = "Du har ikke angivet et nyt filnavn.";
  $lang['files']['chgfilename']['couldnt_rename_file'] = "Kunne ikke omdøbe filen '%s'.";
  $lang['files']['chgfilename']['file_doesnt_exists'] = "Filen '%s' eksisterer ikke.";
  //  files/chgdirname/index.php
  $lang['files']['chgdirname']['no_old_name'] = "Du har ikke angivet en mappe.";
  $lang['files']['chgdirname']['no_new_name'] = "Du har ikke angivet et nyt navn for mappen.";
  $lang['files']['chgdirname']['couldnt_rename_dir'] = "Kunne ikke omdøbe mappen '%s'.";
  $lang['files']['chgdirname']['dir_doesnt_exists'] = "Mappen '%s' eksisterer ikke.";
  //  files/shell/index.php
  $lang['files']['shell']['exec_shell_cmd'] = "Kommandolinie";
  $lang['files']['shell']['error_exec_cd'] = "Den angivne mappe kan ikke ændres fra kommandolinien.";
  $lang['files']['shell']['history'] = "Tidligere kommandoer";
  $lang['files']['shell']['clear_history'] = "Ryd oversigt over tidligere kommandoer";
?>
