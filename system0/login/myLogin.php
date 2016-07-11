<?php
  include ('globals.inc.php');

  if ((isset($Session['UserId'])) && ($Session['UserId'] > 0)) {
    header("Location: ../files/index.php");
    die();
  } 
?>
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['login']['login']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../favicon.ico">
<script language="JavaScript">
<!--
function openParent() {
  if (parent.frames['Tree']) {
    parent.document.location.href = 'myLogin.php';
  } else {
    document.flogin.username.focus();
  }
}
-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body topmargin="0" onLoad="JavaScript: openParent(); ">
<br>
<br>
<br>
<br>
<div align="center">
  <table width="300" height="120"  border="0" cellspacing="0" cellpadding="1">
    <tr height="30">
      <th width="2" background="../images/borders/left_topCorner.jpg"></th>
      <th align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer_short']; ?> - <?php echo $lang['login']['login']; ?></th>
      <th width="2" background="../images/borders/right_topCorner.jpg"></th>
    </tr>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="48"><img src="../images/logo.gif"></td>
            <td><font size="+1"><?php echo $lang['all']['bfexplorer']; ?></font><br />
            <i><?php echo $lang['all']['slogan']; ?></i></td>
          </tr>
        </table></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <?php if (isset($Session['Message'])) { ?>
      <tr>
        <td background="../images/borders/leftBorder.jpg"></td>
        <td align="center" valign="middle"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"> <?php echo $Session['Message']; unset($Session['Message']); ?> </font></td>
        <td background="../images/borders/rightBorder.jpg"></td>
      </tr>
      <?php } ?>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="left" valign="middle"><form action="doLogin.php" method="POST" name="flogin" id="flogin">
          <table width="100%"  border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td align="right" width="35%"><?php echo $lang['login']['username']; ?>:</td>
              <td width="65%"><input name="username" type="text" class="input" id="username" maxlength="64"></td>
            </tr>
            <tr>
              <td align="right"><?php echo $lang['login']['passwd']; ?>:</td>
              <td><input name="password" type="password" class="input" id="password" maxlength="64"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Login" type="submit" id="Login" value="<?php echo $lang['login']['login']; ?>" class="boton"></td>
            </tr>
          </table>
        </form></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr height="4">
      <td background="../images/borders/left_bottomCorner.jpg"></td>
      <td background="../images/borders/bottomBorder.jpg"></td>
      <td background="../images/borders/right_bottomCorner.jpg"></td>
    </tr>
  </table>
</div>
</body>
</html>
