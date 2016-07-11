<?php
  include('globals.inc.php'); 
?>
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/toolbar.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
<!--
function callPage(URLdestino) {
  window.document.location.href = URLdestino;
}
//-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body>
<div align="center">
  <table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="2">
    <tr height="30">
      <th width="4" background="../images/borders/left_topCorner.jpg"></th>
      <th width="98%" align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?></th>
      <td width="20" align="right" valign="middle" background="../images/borders/topBorder.jpg"><a href="../logout.php"><img src="../images/borders/closeButton.jpg" alt="<?php echo $lang['all']['system_logout']; ?>" title="<?php echo $lang['all']['system_logout']; ?>" width="21" height="21" border="0"></a></td>
      <th width="4" background="../images/borders/right_topCorner.jpg"></th>
    </tr>
    <tr height="20">
      <td background="../images/borders/leftBorder.jpg"></td>
      <td colspan="2" align="left" valign="top" class="head"><table width="100%">
          <tr class="TB_ToolbarSet">
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('../files/<?php echo ($Session["config"]["files"]["use_frames"]) ? 'index.php' : 'files_nf.php'; ?>');" href="#"><img src="../images/toolbar/tb_showtree.gif" alt="<?php echo $lang['cpanel']['files']; ?>" title="<?php echo $lang['cpanel']['files']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('users/index.php');" href="#"><img src="../images/toolbar/tb_user.gif" alt="<?php echo $lang['cpanel']['users']['users_admin']; ?>" title="<?php echo $lang['cpanel']['users']['users_admin']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:callPage('groups/index.php');" href="#"><img src="../images/toolbar/tb_group.gif" alt="<?php echo $lang['cpanel']['groups']['groups_admin']; ?>" title="<?php echo $lang['cpanel']['groups']['groups_admin']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_End"></td>
            <td class="TB_Background"></td>
          </tr>
        </table></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td colspan="2" align="left" valign="top"><table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top"><?php echo sprintf($lang['cpanel']['welcome'], $Session['FullName'], $lang['all']['bfexplorer'], $lang['all']['close']); ?></td>
          </tr>
        </table></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr height="4">
      <td background="../images/borders/left_bottomCorner.jpg"></td>
      <td colspan="2" background="../images/borders/bottomBorder.jpg"></td>
      <td background="../images/borders/right_bottomCorner.jpg"></td>
    </tr>
  </table>
</div>
</body>
</html>
