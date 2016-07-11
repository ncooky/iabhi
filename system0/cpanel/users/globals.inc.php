<?php 
  $depth = 2;
  $module = "group1";
  //$module = "group2";
  //$module = "group3";
  $right = 1;
	
  $path = '';
  for($i = 0; $i < $depth; $i++) $path .= '../';
	
  include($path . 'files/config.php');

  include($path . 'globals.inc.php');
  $images_path = $path; 
  $rights = decbin($right);
 
  if (!isset($Session['USER']) || (!$Session['UserId'] > 0) ) {
    //must login 
    header("Location: $path" . "login/index.php");
    die();
  } elseif (((bindec($rights) ^ $Session[$module]) & $Session[$module]) == $Session[$module]) {
    //user doesn't have access
    header("Location: $path" . "rights/index.php");
    die();
  }

  //Funciones necesarias para listar los users
  function fecha($d) {
    global $date_format;
	return date($date_format, strtotime($d));
  }

  //Se inicializan las variables de sesion de los users
  if (!isset($Session["users"])) {
    $Session["users"] = array();

    $Session["users"]["tabla"] = $tables_preffix . "users";
    $Session["users"]["key"] = $tables_preffix . "users.id_user";

    $Session["users"]["paging"] = array();
    $Session["users"]["paging"]['records_X_page'] = 20;
    $Session["users"]["paging"]['current_page'] = 1;

    $Session["users"]["conditions"] = array();
    $Session["users"]["conditions"]["show"] = array();
    $Session["users"]["conditions"]["show"][] = $tables_preffix . "users.id_user";
    $Session["users"]["conditions"]["show"][] = $tables_preffix . "users.creation_date";
    $Session["users"]["conditions"]["show"][] = $tables_preffix . "users.username";
    $Session["users"]["conditions"]["show"][] = $tables_preffix . "users.name";
    $Session["users"]["conditions"]["show"][] = $tables_preffix . "groups.name AS user_group";

    $Session["users"]["organizing"]["field"] = $tables_preffix . "users.name";
    $Session["users"]["organizing"]["order"] = "ASC";

    $Session["users"]["substitutions"] = array();
    $Session["users"]["substitutions"]["text"]["id_user"] = $lang['cpanel']['users']['id_user'];
    $Session["users"]["substitutions"]["text"]["creation_date"] = $lang['cpanel']['users']['creation_date'];
    $Session["users"]["substitutions"]["text"]["update_date"] = $lang['cpanel']['users']['update_date'];
    $Session["users"]["substitutions"]["text"]["username"] = $lang['cpanel']['users']['username'];
    $Session["users"]["substitutions"]["text"]["passwd"] = $lang['cpanel']['users']['passwd'];
    $Session["users"]["substitutions"]["text"]["id_group"] = $lang['cpanel']['users']['id_group'];
    $Session["users"]["substitutions"]["text"]["name"] = $lang['cpanel']['users']['name'];
    $Session["users"]["substitutions"]["text"]["lastname"] = $lang['cpanel']['users']['lastname'];
    $Session["users"]["substitutions"]["text"]["email"] = $lang['cpanel']['users']['email'];
    $Session["users"]["substitutions"]["text"]["homedir"] = $lang['cpanel']['users']['homedir'];

    $Session["users"]["substitutions"]["name"]["id_group"] = $tables_preffix . "groups.name";

    $Session["users"]["substitutions"]["alias"]["id_group"] = "user_group";

    $Session["users"]["substitutions"]["funcion"]["creation_date"] = "fecha";
    $Session["users"]["substitutions"]["funcion"]["update_date"] = "fecha";
  }
?>
