<?php 
  $lang = array();
  
  //  All pages
  $lang['all']['bfexplorer'] = "BytesFall Explorer";
  $lang['all']['bfexplorer_short'] = "bfExplorer";
  $lang['all']['slogan'] = "The free PHP file manager";
  $lang['all']['control_panel'] = "Control panel";
  $lang['all']['system_logout'] = "Logout";
  $lang['all']['accept'] = "Accept";
  $lang['all']['cancel'] = "Cancel";
  $lang['all']['insert'] = "Insert";
  $lang['all']['update'] = "Update";
  $lang['all']['change'] = "Change";
  $lang['all']['finish'] = "Finish";
  $lang['all']['view'] = "View";
  $lang['all']['edit'] = "Edit";
  $lang['all']['close'] = "Close";
  $lang['all']['actions'] = "Actions";
  $lang['all']['delete'] = "Delete";
  $lang['all']['asign'] = "Asign";
  $lang['all']['errors_ocurred'] = "The required information is incomplete or contains errors";
  $lang['all']['mandatory_fields'] = "Mandatory fields";

  //  rights/index.php
  $lang['rights']['access_denied'] = "Access denied";
  $lang['rights']['go_bfexplorer'] = "Go to " . $lang['all']['bfexplorer'];
  $lang['rights']['go_cpanel'] = "Go to the Control panel";
  $lang['rights']['login'] = "Login with another user";

  //  passwd/index.php
  $lang['passwd']['old_pwd_mandatory'] = "The old password is mandatory";
  $lang['passwd']['old_pwd_wrong'] = "The old password is wrong";
  $lang['passwd']['new_pwd_mandatory'] = "The new password is mandatory";
  $lang['passwd']['must_retype_new_pwd'] = "You must retype the new password";
  $lang['passwd']['pwds_dont_match'] = "Passwords do not match";
  $lang['passwd']['change_pwd'] = "Change password";
  $lang['passwd']['username'] = "User";
  $lang['passwd']['old_pwd'] = "Old password";
  $lang['passwd']['new_pwd'] = "New password";
  $lang['passwd']['retype_new_pwd'] = "Retype new password";

  //  login/myLogin.php
  $lang['login']['login'] = "Login";
  $lang['login']['username'] = "Username";
  $lang['login']['passwd'] = "Password";
  //  login/doLogin.php
  $lang['login']['wrong_pwd'] = "The user or password is wrong.";
  $lang['login']['loading_user'] = "Loading user";
  $lang['login']['please_wait'] = "Please wait";

  //  libs/listing.lib.php
  $lang['cpanel']['none_cond'] = "None";
  $lang['cpanel']['eq'] = "Is equal to";
  $lang['cpanel']['not_eq'] = "Is not equal to";
  $lang['cpanel']['gt'] = "Is greater than";
  $lang['cpanel']['gt_eq'] = "Is greater than or equal to";
  $lang['cpanel']['st'] = "Is smaller than";
  $lang['cpanel']['st_eq'] = "Is smaller than or equal to";
  $lang['cpanel']['bw'] = "Begins with";
  $lang['cpanel']['not_bw'] = "Does not begins with";
  $lang['cpanel']['fw'] = "Finnishes with";
  $lang['cpanel']['not_fw'] = "Does not finnishes with";
  $lang['cpanel']['c'] = "Contains";
  $lang['cpanel']['not_c'] = "Does not contains";
  $lang['cpanel']['e'] = "Is empty";
  $lang['cpanel']['not_e'] = "Is not empty";
  $lang['cpanel']['none_field'] = "None";
  $lang['cpanel']['field'] = "Field";
  $lang['cpanel']['condition'] = "Condition";
  $lang['cpanel']['value'] = "Value";
  $lang['cpanel']['fields_to_show'] = "Fields to show";
  $lang['cpanel']['delete_filter'] = "Delete filter";
  $lang['cpanel']['filter'] = "Filter";

  //  cpanel/index.php
  $lang['cpanel']['welcome'] = "Welcome %s  to the control panel of '%s', to start working select an option in the upper menu, to finish your session use the '%s' icon in the upper right corner.";
  $lang['cpanel']['files'] = "Files";
  $lang['cpanel']['first'] = "First";
  $lang['cpanel']['previous'] = "Previous";
  $lang['cpanel']['next'] = "Next";
  $lang['cpanel']['last'] = "Last";
  //  cpanel/users/globals.inc.php
  $lang['cpanel']['users']['id_user'] = "ID";
  $lang['cpanel']['users']['creation_date'] = "Creation date";
  $lang['cpanel']['users']['update_date'] = "Last update date";
  $lang['cpanel']['users']['username'] = "Username";
  $lang['cpanel']['users']['passwd'] = "Password";
  $lang['cpanel']['users']['id_group'] = "Group";
  $lang['cpanel']['users']['name'] = "Name";
  $lang['cpanel']['users']['lastname'] = "Last name";
  $lang['cpanel']['users']['email'] = "E-mail";
  $lang['cpanel']['users']['homedir'] = "Home directory";
  //  cpanel/users/index.php
  $lang['cpanel']['users']['users_admin'] = "Users administration";
  $lang['cpanel']['users']['delete_confirm'] = "The user will be deleted.\n Do you want to continue?";
  $lang['cpanel']['users']['show_info'] = "Showing users from %s to %s of %s.";
  $lang['cpanel']['users']['not_found'] = "There was not found any user.";
  $lang['cpanel']['users']['delete_user'] = "Delete user";
  //  cpanel/users/edit.php
  $lang['cpanel']['users']['edit_user'] = "Edit user";
  $lang['cpanel']['users']['select_group'] = "Select the group";
  $lang['cpanel']['users']['email_wrong'] = "The e-mail is not valid";
  $lang['cpanel']['users']['name_wrong'] = "The name is mandatory";
  $lang['cpanel']['users']['group_wrong'] = "The group is mandatory";
  //  cpanel/users/new.php
  $lang['cpanel']['users']['new_user'] = "New user";
  $lang['cpanel']['users']['username_exists'] = "The username is already in use!! Please, choose another";
  $lang['cpanel']['users']['username_wrong'] = "The username is not valid";
  //  cpanel/groups/globals.inc.php
  $lang['cpanel']['groups']['id_group'] = "ID";
  $lang['cpanel']['groups']['creation_date'] = "Creation date";
  $lang['cpanel']['groups']['update_date'] = "Last update date";
  $lang['cpanel']['groups']['group1'] = "Permissions (1)";
  $lang['cpanel']['groups']['group2'] = "Permissions (2)";
  $lang['cpanel']['groups']['group3'] = "Permissions (3)";
  $lang['cpanel']['groups']['name'] = "Group name";
  //  cpanel/groups/index.php
  $lang['cpanel']['groups']['groups_admin'] = "Groups administration";
  $lang['cpanel']['groups']['delete_confirm'] = "The group will be deleted.\n Do you want to continue?";
  $lang['cpanel']['groups']['show_info'] = "Showing groups from %s to %s of %s.";
  $lang['cpanel']['groups']['not_found'] = "There was not found any group.";
  $lang['cpanel']['groups']['delete_group'] = "Delete group";
  //  cpanel/groups/edit.php
  $lang['cpanel']['groups']['edit_group'] = "Edit group";
  $lang['cpanel']['groups']['name_wrong'] = "The name is mandatory";
  $lang['cpanel']['groups']['functionalities'] = "Functionalities";
  //  cpanel/groups/new.php
  $lang['cpanel']['groups']['new_group'] = "New group";
  $lang['cpanel']['groups']['groupname_wrong'] = "The groupname is mandatory";

  //  files/files.php
  $lang['files']['dir_doesnt_exists'] = "The directory '%s' doesn't exists.";
  $lang['files']['listing_files'] = "Listing of files";
  $lang['files']['name'] = "Name";
  $lang['files']['size'] = "Size";
  $lang['files']['type'] = "Type";
  $lang['files']['last_accessed'] = "Last accessed";
  $lang['files']['last_modified'] = "Last modified";
  $lang['files']['permissions'] = "Permissions";
  $lang['files']['view_file'] = "View file";
  $lang['files']['edit_file'] = "Edit file";
  $lang['files']['download_file'] = "Download file";
  $lang['files']['file_type'] = "%s file";
  $lang['files']['file_type2'] = "File";
  $lang['files']['file_title'] = "File: %s";
  $lang['files']['dir_type'] = "Directory";
  $lang['files']['dir_title'] = "Directory: %s";
  $lang['files']['prot_dir_alert'] = "This is a protected directory.";
  $lang['files']['prot_dir_title'] = "Protected directory: %s";
  //  files/resume.php
  $lang['files']['resume_title'] = "Resume";
  $lang['files']['resume1'] = "%s directory(ies) and %s file(s) (%s)";
  $lang['files']['resume2'] = "Disk size: %s";
  $lang['files']['resume3'] = "Free space: %s (%s %%)";
  //  files/reload.php
  $lang['files']['reload_title'] = "Reloading...";
  $lang['files']['reload_text'] = "Reloading %s ...";
  //  files/search.php
  $lang['files']['search_f_and_d'] = "Search for files and directories";
  $lang['files']['search_in'] = "Search in";
  $lang['files']['case_sensitive'] = "Case sensitive";
  $lang['files']['include_subdirs'] = "Include subdirectories";
  $lang['files']['search'] = "Search";
  $lang['files']['cancel_search'] = "Cancel search";
  //  files/search_result.php
  $lang['files']['error_in_request'] = "There is an error in your request.";
  $lang['files']['dir_doesnt_exists'] = "The directory '%s' doesn't exists.";
  $lang['files']['search_result'] = "Search result";
  $lang['files']['in_directory'] = "In directory";
  //  files/toolbar.php
  $lang['files']['toolbar'] = "Toolbar";
  $lang['files']['cannot_perform_action'] = "You cannot perform any action until you finish the current one.";
  $lang['files']['name_ZIP_file'] = "Name of the ZIP file";
  $lang['files']['new_name_dir'] = "New name of the directory";
  $lang['files']['new_name_file'] = "New name of the file";
  $lang['files']['not_selected'] = "You have not selected any file or directory.";
  $lang['files']['new_dir_name'] = "Name of the new directory";
  $lang['files']['new_dir_suggested_name'] = "New Directory";
  $lang['files']['new_file_name'] = "Name of the new file";
  $lang['files']['new_file_suggested_name'] = "newfile.txt";
  $lang['files']['functionality_not_implemented'] = "This functionality is not implemented yet.";
  $lang['files']['home_dir'] = "Home directory";
  $lang['files']['refresh'] = "Refresh";
  $lang['files']['upper_dir'] = "Upper directory";
  $lang['files']['show_tree'] = "Show tree";
  $lang['files']['show_search'] = "Show search";
  $lang['files']['copy_sel'] = "Copy selection";
  $lang['files']['move_sel'] = "Move selection";
  $lang['files']['download_comp_sel'] = "Download selection compressed";
  $lang['files']['comp_sel'] = "Compress selection";
  $lang['files']['delete_sel'] = "Delete selection";
  $lang['files']['set_permissions'] = "Set permissions";
  $lang['files']['rename'] = "Rename";
  $lang['files']['see_properties'] = "See properties";
  $lang['files']['shell_cmd'] = "Shell commands";
  $lang['files']['new_dir'] = "New directory";
  $lang['files']['new_file'] = "New file";
  $lang['files']['no_frames'] = "No frames";
  $lang['files']['frames'] = "Frames";
  $lang['files']['go'] = "Go";
  //  files/tree.php
  $lang['files']['tree'] = "Tree";
  $lang['files']['loading_tree'] = "Loading tree data...";
  $lang['files']['searching_item'] = "Searching for item...";
  $lang['files']['loading_item'] = "Loading...";
  //  files/upload.php
  $lang['files']['upload_files'] = "Upload files";
  $lang['files']['upload'] = "Upload";
  //  files/view/index.php
  $lang['files']['view']['not_selected_file'] = "You have not selected any file.";
  $lang['files']['view']['error_reading_file'] = "An error ocurred reading the file '%s'.";
  $lang['files']['view']['error_opening_file'] = "An error ocurred opening the file '%s'.";
  $lang['files']['view']['not_viewer'] = "There is not any viewer for the file '%s'.";
  $lang['files']['view']['file_name'] = "File name: %s";
  //  files/view/get_image.php
  $lang['files']['view']['cannot_open_file'] = "The file cannot be opened for viewing.";
  //  files/edit/index.php
  $lang['files']['edit']['error_writing_file'] = "An error ocurred writing the file '%s'.";
  $lang['files']['edit']['error_opening_file_write'] = "An error ocurred opening the file '%s' for writing.";
  $lang['files']['edit']['save_file'] = "Save file";
  $lang['files']['edit']['windows_format'] = "Windows format";
  $lang['files']['edit']['UNIX_format'] = "UNIX format";
  //  files/upload/index.php
  $lang['files']['uploads']['no_file_selected'] = "You have not selected any file to upload.";
  $lang['files']['uploads']['error_uploading_file'] = "There was an error uploading the file '%s'.";
  //  files/properties/index.php
  $lang['files']['properties']['error_seeing_properties_dirs'] = "An error ocurred while seeing the properties of the directories.";
  $lang['files']['properties']['error_seeing_properties_files'] = "An error ocurred while seeing the properties of the files.";
  $lang['files']['properties']['total'] = "Total";
  $lang['files']['properties']['size'] = "Size";
  $lang['files']['properties']['directories'] = "Directories";
  $lang['files']['properties']['files'] = "Files";
  $lang['files']['properties']['disk'] = "Disk";
  $lang['files']['properties']['free_space'] = "Free space";
  //  files/permissions/index.php
  $lang['files']['perms']['error_set_perms_dirs'] = "An error ocurred while setting the permissions of the directories.";
  $lang['files']['perms']['error_set_perms_files'] = "An error ocurred while setting the permissions of the files.";
  $lang['files']['perms']['about_change_perms'] = "You are about to change the permissions for the selection";
  $lang['files']['perms']['owner'] = "Owner";
  $lang['files']['perms']['group'] = "Group";
  $lang['files']['perms']['others'] = "Others";
  $lang['files']['perms']['read'] = "Read";
  $lang['files']['perms']['write'] = "Write";
  $lang['files']['perms']['execute'] = "Execute";
  $lang['files']['perms']['selected_dirs'] = "Selected directories";
  $lang['files']['perms']['selected_files'] = "Selected files";
  //  files/newfile/index.php
  $lang['files']['newfile']['no_name'] = "You didn't provided a name for the file.";
  $lang['files']['newfile']['couldnt_create'] = "Couldn't create the file '%s'.";
  $lang['files']['newfile']['file_exists'] = "The file '%s' already exists.";
  //  files/newdir/index.php
  $lang['files']['newdir']['no_name'] = "You didn't provided a name for the directory.";
  $lang['files']['newdir']['couldnt_create'] = "Couldn't create the directory '%s'.";
  $lang['files']['newdir']['dir_exists'] = "The directory '%s' already exists.";
  //  files/compress/dialog.php
  $lang['files']['compress']['compression_options'] = "Compression options";
  $lang['files']['compress']['file_name'] = "File name";
  $lang['files']['compress']['comp_type'] = "Compression type";
  $lang['files']['compress']['select_comp_type'] = "Select the compression type";
  $lang['files']['compress']['overwrite'] = "Overwrite if exists";
  $lang['files']['compress']['name_mandatory'] = "The name of the file is mandatory.";
  $lang['files']['compress']['comp_type_mandatory'] = "The compression type is mandatory.";
  //  files/compress/index.php
  $lang['files']['compress']['extension_not_installed'] = "The PHP extension needed to compress the files is not installed";
  //  files/download_compfile/index.php
  $lang['files']['download_compfile']['error_creating_compressed_file'] = "An error ocurred creating the compressed file.";
  //  files/download/index.php
  $lang['files']['download']['cannot_open_file'] = "Cannot open file for download.";
  //  files/delete/index.php
  $lang['files']['delete']['error_deleting_dirs'] = "An error ocurred while deleting the directories.";
  $lang['files']['delete']['error_deleting_files'] = "An error ocurred while deleting the files.";
  $lang['files']['delete']['delete_files'] = "Delete files";
  $lang['files']['delete']['delete_confirm'] = "Are you sure that you want to delete the following files an directories?";
  //  files/copy/index.php
  $lang['files']['copy']['error_copying_dirs'] = "An error ocurred while copying the directories.";
  $lang['files']['copy']['error_copying_files'] = "An error ocurred while copying the files.";
  $lang['files']['copy']['origin_eq_dest'] = "There origin is the same that the destination.";
  $lang['files']['copy']['move_files'] = "Move files";
  $lang['files']['copy']['copy_files'] = "Copy files";
  $lang['files']['copy']['path_to_move'] = "Select the path where you want to move the selection";
  $lang['files']['copy']['path_to_copy'] = "Select the path where you want to copy the selection";
  //  files/chgfilename/index.php
  $lang['files']['chgfilename']['no_old_name'] = "You didn't provided the name of the file.";
  $lang['files']['chgfilename']['no_new_name'] = "You didn't provided a name for the file.";
  $lang['files']['chgfilename']['couldnt_rename_file'] = "Couldn't rename the file '%s'.";
  $lang['files']['chgfilename']['file_doesnt_exists'] = "The file '%s' doesn't exists.";
  //  files/chgdirname/index.php
  $lang['files']['chgdirname']['no_old_name'] = "You didn't provided the name of the directory.";
  $lang['files']['chgdirname']['no_new_name'] = "You didn't provided a name for the directory.";
  $lang['files']['chgdirname']['couldnt_rename_dir'] = "Couldn't rename the directory '%s'.";
  $lang['files']['chgdirname']['dir_doesnt_exists'] = "The directory '%s' doesn't exists.";
  //  files/shell/index.php
  $lang['files']['shell']['exec_shell_cmd'] = "Execute shell commands";
  $lang['files']['shell']['error_exec_cd'] = "The current directory cannot be changed from the shell.";
  $lang['files']['shell']['history'] = "History";
  $lang['files']['shell']['clear_history'] = "Clear history";
?>