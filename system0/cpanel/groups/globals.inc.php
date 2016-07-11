<?php 
  $depth = 2;
  $module = "group1";
  //$module = "group2";
  //$module = "group3";
  $right = 2;
	
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

  //Funciones necesarias para listar los groups
  function fecha($d) {
    global $date_format;
	return date($date_format, strtotime($d));
  }

  function Permissions1($d) {
    global $tables_preffix;

    $index = 1;
	$func = bfTable(sprintf("SELECT * FROM %sfunctionalities WHERE id_functionality > %s AND id_functionality <= %s ORDER BY id_functionality ASC", $tables_preffix, 32*($index - 1), 32*$index), "id_functionality");
	$perm = "";
	while (list($k, $v) = each($func)) {
	  if (!((( (int)pow(2, (($k - 1) % 32)) ^ (int)$d) & (int)$d) == (int)$d)) $perm .= sprintf("%s<br>\r\n", $v->functionality);
	}
	if ($perm == "") $perm = "-";
	return $perm;
  }

  function Permissions2($d) {
    global $tables_preffix;

    $index = 2;
	$func = bfTable(sprintf("SELECT * FROM %sfunctionalities WHERE id_functionality > %s AND id_functionality <= %s ORDER BY id_functionality ASC", $tables_preffix, 32*($index - 1), 32*$index), "id_functionality");
	$perm = "";
	while (list($k, $v) = each($func)) {
	  if (!((( (int)pow(2, (($k - 1) % 32)) ^ (int)$d) & (int)$d) == (int)$d)) $perm .= sprintf("%s<br>\r\n", $v->functionality);
	}
	if ($perm == "") $perm = "-";
	return $perm;
  }

  function Permissions3($d) {
    global $tables_preffix;

    $index = 3;
	$func = bfTable(sprintf("SELECT * FROM %sfunctionalities WHERE id_functionality > %s AND id_functionality <= %s ORDER BY id_functionality ASC", $tables_preffix, 32*($index - 1), 32*$index), "id_functionality");
	$perm = "";
	while (list($k, $v) = each($func)) {
	  if (!((( (int)pow(2, (($k - 1) % 32)) ^ (int)$d) & (int)$d) == (int)$d)) $perm .= sprintf("%s<br>\r\n", $v->functionality);
	}
	if ($perm == "") $perm = "-";
	return $perm;
  }

  //Se inicializan las variables de sesion de los groups
  if (!isset($Session["groups"])) {
    $Session["groups"] = array();

    $Session["groups"]["tabla"] = $tables_preffix . "groups";
    $Session["groups"]["key"] = $tables_preffix . "groups.id_group";

    $Session["groups"]["paging"] = array();
    $Session["groups"]["paging"]['records_X_page'] = 10;
    $Session["groups"]["paging"]['current_page'] = 1;

    $Session["groups"]["conditions"] = array();
    $Session["groups"]["conditions"]["show"] = array();
    $Session["groups"]["conditions"]["show"][] = $tables_preffix . "groups.id_group";
    $Session["groups"]["conditions"]["show"][] = $tables_preffix . "groups.name";
    $Session["groups"]["conditions"]["show"][] = $tables_preffix . "groups.group1";
    $Session["groups"]["conditions"]["show"][] = $tables_preffix . "groups.group2";
    $Session["groups"]["conditions"]["show"][] = $tables_preffix . "groups.group3";

    $Session["groups"]["organizing"]["field"] = "name";
    $Session["groups"]["organizing"]["order"] = "ASC";

    $Session["groups"]["substitutions"] = array();
    $Session["groups"]["substitutions"]["text"]["id_group"] = $lang['cpanel']['groups']['id_group'];
    $Session["groups"]["substitutions"]["text"]["creation_date"] = $lang['cpanel']['groups']['creation_date'];
    $Session["groups"]["substitutions"]["text"]["update_date"] = $lang['cpanel']['groups']['update_date'];
    $Session["groups"]["substitutions"]["text"]["group1"] = $lang['cpanel']['groups']['group1'];
    $Session["groups"]["substitutions"]["text"]["group2"] = $lang['cpanel']['groups']['group2'];
    $Session["groups"]["substitutions"]["text"]["group3"] = $lang['cpanel']['groups']['group3'];
    $Session["groups"]["substitutions"]["text"]["name"] = $lang['cpanel']['groups']['name'];

    $Session["groups"]["substitutions"]["funcion"]["group1"] = "Permissions1";
    $Session["groups"]["substitutions"]["funcion"]["group2"] = "Permissions2";
    $Session["groups"]["substitutions"]["funcion"]["group3"] = "Permissions3";
    $Session["groups"]["substitutions"]["funcion"]["creation_date"] = "fecha";
    $Session["groups"]["substitutions"]["funcion"]["update_date"] = "fecha";
  }
?>
