<?php 
  include('globals.inc.php'); 
  include('../../libs/utils.lib.php');
  include('../../libs/listing.lib.php');

  if (isset($Session["users"]) && isset($_GET['clean']) && ($_GET['clean'] == 1)) {
    $show = $Session["users"]["conditions"]["show"];
	unset($Session["users"]["conditions"]);
    $Session["users"]["conditions"] = array();
    $Session["users"]["conditions"]["show"] = $show;
  } else {
    if (isset($_POST['data'])) {
	  $Session["users"]["conditions"] = $_POST['data'];
	}
  }

  if (isset($Session["users"]) && isset($_GET['organizing_field'])) {
    if ($Session["users"]["organizing"]["field"] == $_GET['organizing_field']) {
	  $Session["users"]["organizing"]["order"] = ($Session["users"]["organizing"]["order"] == "ASC") ? "DESC" : "ASC";
	} else {
      $Session["users"]["organizing"]["field"] = $_GET['organizing_field'];
      $Session["users"]["organizing"]["order"] = "ASC";
	}
  }

  //Si estoy filtrando empiezo en la primera pagina
  if (isset($_POST["data"]["no_fields"])) {
    $Session["users"]["paging"]['current_page'] = 1;
  }
  
  $key = substr($Session["users"]["key"], strpos($Session["users"]["key"], ".") + 1);
  $query = generateQuery(sprintf("FROM %susers LEFT JOIN %sgroups ON (%susers.id_group=%sgroups.id_group)", $tables_preffix, $tables_preffix, $tables_preffix, $tables_preffix), '', $Session["users"]["organizing"], $Session["users"]["key"], $Session["users"]["conditions"], $Session["users"]["substitutions"]);

  //Se calcula la cantidad de paginas
  bfQuery($query . ";", "cant_users");
  $Session["users"]["paging"]['total_records'] = $GLOBALS["cant_users"];
  $Session["users"]["paging"]['total_pages'] = ceil($GLOBALS["cant_users"]/$Session["users"]["paging"]['records_X_page']);

  //Se aplica el paging
  if (isset($_GET['page'])) {
    switch ($_GET['page']) {
	  case "first":
        $Session["users"]["paging"]['current_page'] = 1;
	  break;
	  case "previous":
        $Session["users"]["paging"]['current_page'] = ($Session["users"]["paging"]['current_page'] > 1) ? $Session["users"]["paging"]['current_page'] - 1 : 1;
	  break;
	  case "next":
        $Session["users"]["paging"]['current_page'] = ($Session["users"]["paging"]['current_page'] < $Session["users"]["paging"]['total_pages']) ? $Session["users"]["paging"]['current_page'] + 1 : $Session["users"]["paging"]['total_pages'];
	  break;
	  case "last":
        $Session["users"]["paging"]['current_page'] = $Session["users"]["paging"]['total_pages'];
	  break;
	}
  }

  $limit = sprintf(" LIMIT %d OFFSET %d;", $Session["users"]["paging"]['records_X_page'], (($Session["users"]["paging"]['current_page'] - 1)*$Session["users"]["paging"]['records_X_page']));
  $users = bfTable($query . $limit, $key);
?>
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['cpanel']['users']['users_admin']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/toolbar.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
<!--
function callPage(URLdestino) {
  window.document.location.href = URLdestino;
}
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function findObj(n, d) {
  var p,i,x;
  if(!d) d=document;
  if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);
  }
  if(!(x=d[n])&&d.all) x=d.all[n];
  for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n);
  return x;
}

function toggleTable(tableName) {
  var table = findObj(tableName);
  if (table.style.visibility == 'visible') {
    table.style.position = 'absolute';
    table.style.visibility = 'hidden';
  } else {
    table.style.position = 'relative';
    table.style.visibility = 'visible';
  }
}
//-->
</script>
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<div align="center">
  <table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="2">
    <tr height="30">
      <th width="4" background="../../images/borders/left_topCorner.jpg"></th>
      <th width="98%" align="left" valign="middle" background="../../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['cpanel']['users']['users_admin']; ?></th>
      <td width="20" align="right" valign="middle" background="../../images/borders/topBorder.jpg"><a href="../../logout.php"><img src="../../images/borders/closeButton.jpg" alt="<?php echo $lang['all']['system_logout']; ?>" title="<?php echo $lang['all']['system_logout']; ?>" width="21" height="21" border="0"></a></td>
      <th width="4" background="../../images/borders/right_topCorner.jpg"></th>
    </tr>
    <tr height="20">
      <td background="../../images/borders/leftBorder.jpg"></td>
      <td colspan="2" align="left" valign="top" class="head"><table width="100%">
          <tr class="TB_ToolbarSet">
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('../index.php');" href="#"><img src="../../images/toolbar/tb_config.gif" alt="<?php echo $lang['all']['control_panel']; ?>" title="<?php echo $lang['all']['control_panel']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('../users/index.php');" href="#"><img src="../../images/toolbar/tb_user.gif" alt="<?php echo $lang['cpanel']['users']['users_admin']; ?>" title="<?php echo $lang['cpanel']['users']['users_admin']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('../groups/index.php');" href="#"><img src="../../images/toolbar/tb_group.gif" alt="<?php echo $lang['cpanel']['groups']['groups_admin']; ?>" title="<?php echo $lang['cpanel']['groups']['groups_admin']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('<?php echo $_SERVER['PHP_SELF'] . '?page=first'; ?>');" href="#"><img src="../../images/toolbar/tb_first.gif" alt="<?php echo $lang['cpanel']['first']; ?>" title="<?php echo $lang['cpanel']['first']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('<?php echo $_SERVER['PHP_SELF'] . '?page=previous'; ?>');" href="#"><img src="../../images/toolbar/tb_previous.gif" alt="<?php echo $lang['cpanel']['previous']; ?>" title="<?php echo $lang['cpanel']['previous']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('<?php echo $_SERVER['PHP_SELF'] . '?page=next'; ?>');" href="#"><img src="../../images/toolbar/tb_next.gif" alt="<?php echo $lang['cpanel']['next']; ?>" title="<?php echo $lang['cpanel']['next']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('<?php echo $_SERVER['PHP_SELF'] . '?page=last'; ?>');" href="#"><img src="../../images/toolbar/tb_last.gif" alt="<?php echo $lang['cpanel']['last']; ?>" title="<?php echo $lang['cpanel']['last']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('new.php');" href="#"><img src="../../images/toolbar/tb_newuser.gif" alt="<?php echo $lang['cpanel']['users']['new_user']; ?>" title="<?php echo $lang['cpanel']['users']['new_user']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_End"></td>
            <td class="TB_Background"></td>
          </tr>
        </table></td>
      <td background="../../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr>
      <td background="../../images/borders/leftBorder.jpg"></td>
      <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top"><?php echo generateTable($Session["users"]["tabla"], 4, 'buscar', 'POST', $_SERVER['PHP_SELF'], $Session["users"]["substitutions"], $Session["users"]["conditions"]); ?></td>
          </tr>
          <tr>
            <td align="center" valign="top"><?php if (count($users) > 0) {?>
              <table width="98%" border="0" cellspacing="0" cellpadding="2">
                <tr height="30">
                  <th width="4" align="left" valign="middle" background="../../images/borders/left_topCorner.jpg"></th>
                  <?php 
		                reset($Session["users"]["conditions"]["show"]);
			            unset($alias);
			            foreach ($Session["users"]["conditions"]["show"] as $show_value) {
		                  //Le quito a $show_value el name de la tabla
			              if (strpos($show_value, " AS ") === false) {
			                $show_value = substr($show_value, strpos($show_value, ".") + 1);
			              } else {
			                $show_value = substr($show_value, strpos($show_value, " AS ") + 4);
			              }
			              //Si tiene un alias lo encuentro
			              unset($tmp);
			              $tmp[] = $show_value;
						  if ((!isset($Session["users"]["substitutions"]["alias"])) || (!is_array($Session["users"]["substitutions"]["alias"]))) {
						    $Session["users"]["substitutions"]["alias"] = array();
						  }
			              $tmp2 = array_intersect($Session["users"]["substitutions"]["alias"], $tmp);
			              //Saco el name del field
			              if (count($tmp2) > 0) {
			                list($field, $tmp3) = each($tmp2);
			              } else {
			                $field = $show_value;
			              }
			              //Voy guardando los alias de los fields
			              $alias[$field] = $show_value;
		              ?>
                  <th align="left" valign="middle" background="../../images/borders/topBorder.jpg"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?organizing_field=<?php echo $alias[$field]; ?>" class="an"><b><font color="#FFFFFF"><?php echo $Session["users"]["substitutions"]["text"][$field]; ?></font></b></a></th>
                  <?php } ?>
                  <th width="10%" align="left" valign="middle" background="../../images/borders/topBorder.jpg"><b><font color="#FFFFFF"><?php echo $lang['all']['actions']; ?></font></b></th>
                  <th width="4" align="left" valign="top" background="../../images/borders/right_topCorner.jpg"></th>
                </tr>
                <?php while (list($k, $v) = each($users)) { ?>
                <?php $color = ((isset($color)) && ($color == '#ECF0DE')) ? '#FFFFFF' : '#ECF0DE'; ?>
                <tr bgcolor="<?php echo $color; ?>">
                  <td width="4">&nbsp;</td>
                  <?php foreach ($alias as $alias_field) { ?>
                  <td bgcolor="<?php echo $color; ?>" align="left" valign="top"><?php echo isset($Session["users"]["substitutions"]["funcion"][$alias_field]) ? call_user_func($Session["users"]["substitutions"]["funcion"][$alias_field], $v->$alias_field) : $v->$alias_field; ?></td>
                  <?php } ?>
                  <?php $id = substr($Session["users"]["key"], strpos($Session["users"]["key"], ".") + 1); ?>
                  <td bgcolor="<?php echo $color; ?>" align="left" valign="top"><a href="edit.php<?php echo '?' . $id . '=' . $v->$id; ?>" class="an"><img src="../../images/edit.gif" alt="<?php echo $lang['cpanel']['users']['edit_user']; ?>" title="<?php echo $lang['cpanel']['users']['edit_user']; ?>" width="16" height="16" border="0"></a>&nbsp;<a href="passwd.php<?php echo '?' . $id . '=' . $v->$id; ?>" class="an"><img src="../../images/passwd.gif" alt="<?php echo $lang['passwd']['change_pwd']; ?>" title="<?php echo $lang['passwd']['change_pwd']; ?>" width="16" height="16" border="0"></a>&nbsp;<a href="JavaScript:if (confirm('<?php echo $lang['cpanel']['users']['delete_confirm']; ?>')){ window.document.location='delete.php<?php echo '?' . $id . '=' . $v->$id; ?>';}" class="an"><img src="../../images/delete.gif" alt="<?php echo $lang['cpanel']['users']['delete_user']; ?>" title="<?php echo $lang['cpanel']['users']['delete_user']; ?>" width="16" height="16" border="0"></a></td>
                  <td width="4">&nbsp;</td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="<?php echo count($alias) + 3; ?>" align="left" valign="middle" bgcolor="#DDDDDD"><b><?php echo sprintf($lang['cpanel']['users']['show_info'], ($Session["users"]["paging"]['current_page'] - 1)*$Session["users"]["paging"]['records_X_page'] + 1, ($Session["users"]["paging"]['current_page'] - 1)*$Session["users"]["paging"]['records_X_page'] + count($users), $Session["users"]["paging"]['total_records']); ?></b></td>
                </tr>
              </table>
              <?php } else { ?>
              <div align="left"><?php echo $lang['cpanel']['users']['not_found']; ?></div>
              <?php } ?>
            </td>
          </tr>
        </table></td>
      <td background="../../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr height="4">
      <td background="../../images/borders/left_bottomCorner.jpg"></td>
      <td colspan="2" background="../../images/borders/bottomBorder.jpg"></td>
      <td background="../../images/borders/right_bottomCorner.jpg"></td>
    </tr>
  </table>
</div>
</body>
</html>
