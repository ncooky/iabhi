<?php
  include('globals.inc.php');
  include('../libs/utils.lib.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*$", $username)) { 
    //The username is wrong
    $Session['Message'] = $lang['login']['wrong_pwd'];
    SaveSessionInformation();
    header("Location: myLogin.php");
    die();
  }

  $password = setSQLQuotes($password);

  if (isset($Session['UserId']))
  if ($Session['UserId'] > 0) {
    header("Location: ./index.php");
    die();
  }

  $User = bfRecord(sprintf("SELECT * FROM %susers WHERE username=%s;", $tables_preffix, GetSQLValueString($username, "text")));
  if (($User->id_user < 1) || (crypt($password, $User->passwd) != $User->passwd)) {
    $Session['Message'] = $lang['login']['wrong_pwd'];
    SaveSessionInformation();
    header("Location: myLogin.php");
    die();
  }
  
  $group = bfRecord(sprintf("SELECT * FROM %sgroups WHERE id_group='%s';", $tables_preffix, $User->id_group));
  $group1 = $group->group1;
  $group2 = $group->group2;
  $group3 = $group->group3;
  
  $Session['FullName'] = $User->name . ' ' . $User->lastname;
  $Session['UserId'] = $User->id_user;
  $Session['USER'] = $User;
  $Session['group1'] = $group1;
  $Session['group2'] = $group2;
  $Session['group3'] = $group3;
    
  SaveSessionInformation();
?>
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['login']['loading_user']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
<script language="JavaScript">
<!--
  function redirect(val) {
    if (window.opener) {
      opener.location.href = val; 
      window.close();
      return false;
    } else {
      window.location.href = val; 
      return false;    
    }
  }
//-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body bgcolor="#FFFFFF" text="#000000" onLoad="redirect('<?php echo "../files/index.php"; ?>');">
<table width="100%" border="0" cellspacing="20" cellpadding="30">
  <tr>
    <td align="center"><table width="50%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><p><font face="Verdana, Arial, Helvetica, sans-serif" size="4"><?php echo $lang['login']['loading_user']; ?>.... </font></p></td>
        </tr>
        <tr>
          <td align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="3"><?php echo $lang['login']['please_wait']; ?></font></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
