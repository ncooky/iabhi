<?php 
  include('globals.inc.php'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['rights']['access_denied']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../favicon.ico">
<script language="JavaScript">
<!--
function openParent() {
  if (parent.frames['Tree']) {
    parent.document.location.href = 'index.php';
  }
}
-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body onload="openParent();"> 
<br> 
<br> 
<br> 
<br> 
<div align="center"> 
  <table width="300" height="120"  border="0" cellspacing="0" cellpadding="1"> 
    <tr height="30"> 
      <th width="2" background="../images/borders/left_topCorner.jpg"></th> 
      <th align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['rights']['access_denied']; ?></th> 
      <th width="2" background="../images/borders/right_topCorner.jpg"></th> 
    </tr> 
    <tr> 
      <td background="../images/borders/leftBorder.jpg"></td> 
      <td align="center" valign="middle"><h1 align="center"><font color="#FF0000"><?php echo $lang['rights']['access_denied']; ?>!</font></h1></td> 
      <td background="../images/borders/rightBorder.jpg"></td> 
    </tr> 
    <tr> 
      <td background="../images/borders/leftBorder.jpg"></td> 
      <td align="center" valign="middle"><a href="../files/index.php"><?php echo $lang['rights']['go_bfexplorer']; ?></a></td> 
      <td background="../images/borders/rightBorder.jpg"></td> 
    </tr> 
    <tr> 
      <td background="../images/borders/leftBorder.jpg"></td> 
      <td align="center" valign="middle"><a href="../cpanel/index.php"><?php echo $lang['rights']['go_cpanel']; ?></a></td> 
      <td background="../images/borders/rightBorder.jpg"></td> 
    </tr> 
    <tr> 
      <td background="../images/borders/leftBorder.jpg"></td> 
      <td align="center" valign="middle"><a href="../login.php"><?php echo $lang['rights']['login']; ?></a></td> 
      <td background="../images/borders/rightBorder.jpg"></td> 
    </tr> 
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
