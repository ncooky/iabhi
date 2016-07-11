<?php 
  include('globals.inc.php');
  include('../../libs/utils.lib.php');

  if ((isset($_POST["accion"])) && ($_POST["accion"] == "asign")) {
    $pass = $_POST['pass'];
    $retype_pass = $_POST['retype_pass'];
    $id_user = $_POST['id_user'];
    if ($pass == $retype_pass) {
      $pass = crypt($pass);
      bfBegin();
        bfQuery(sprintf("UPDATE %susers SET passwd=%s WHERE id_user=%s;", $tables_preffix, GetSQLValueString($pass, "text"), GetSQLValueString($id_user, "int")));
      bfCommit ();
      unset($Session["users"]); 
	  header("Location: index.php");
      die();
    }
    $Session["users"]["message"] = $lang['passwd']['pwds_dont_match']; 	 
    header ("Location: passwd.php?id_user=$id_user");
    die();
  }

  $id_user = $_GET['id_user'];
  $users = bfRecord(sprintf("SELECT * FROM %susers WHERE id_user=%s;", $tables_preffix, $id_user));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['passwd']['change_pwd']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script language=javascript>
 function submitAction(action)
  { 
    document.Data.action.value=action;
	window.document.Data.submit(); 
    return false;
  }
 </script>
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body> 
<div align="center"> 
  <table width="450" border="0" cellspacing="0" cellpadding="2"> 
    <tr height="30"> 
      <th width="4" background="../../images/borders/left_topCorner.jpg"></th> 
      <th width="99%" align="left" valign="middle" background="../../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['passwd']['change_pwd']; ?></th> 
      <th width="4" background="../../images/borders/right_topCorner.jpg"></th> 
    </tr> 
    <tr> 
      <td background="../../images/borders/leftBorder.jpg"></td> 
      <td align="left" valign="top"><form action="passwd.php" method="post" name="asign" id="asign"> 
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="3"> 
            <tr align="center" > 
              <td colspan="2"><font color="#FF0000"><b> 
                <?php if (isset($Session["users"]["message"])) { echo $Session["users"]["message"]; unset($Session["users"]["message"]); } ?> 
                </b></font></td> 
            </tr> 
            <tr bgcolor="#FFFFFF"> 
              <td width="47%" align="right"><?php echo $lang['cpanel']['users']['username']; ?>:</td> 
              <td width="53%"><b><?php echo $users->username; ?></b></td> 
            </tr> 
            <tr bgcolor="#FFFFFF"> 
              <td align="right"><?php echo $lang['passwd']['new_pwd']; ?>:</td> 
              <td> <input name="pass" type="password" class="input" value=""></td> 
            </tr> 
            <tr bgcolor="#FFFFFF"> 
              <td align="right"><?php echo $lang['passwd']['retype_new_pwd']; ?>:</td> 
              <td><input name="retype_pass" type="password" class="input" value=""></td> 
            </tr> 
            <tr align="center" bgcolor="#FFFFFF"> 
              <td colspan="2" align="right"><input name="accion" type="hidden" value="asign"> 
                <input name="id_user" type="hidden" id="id_user" value="<?php echo $id_user; ?>"> 
                <input type="button" name="Cancel" class="boton" value="<?php echo $lang['all']['cancel']; ?>" onClick="window.document.location='index.php'"> 
                <input name="Asing" type="submit" class="boton" id="Asing" value="<?php echo $lang['all']['asign']; ?>"> </td> 
            </tr> 
          </table> 
        </form></td> 
      <td background="../../images/borders/rightBorder.jpg"></td> 
    </tr> 
    <tr height="4"> 
      <td background="../../images/borders/left_bottomCorner.jpg"></td> 
      <td background="../../images/borders/bottomBorder.jpg"></td> 
      <td background="../../images/borders/right_bottomCorner.jpg"></td> 
    </tr> 
  </table> 
</div> 
</body>
</html>
