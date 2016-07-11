<?php 
  include('globals.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['reload_title']; ?></title>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body bgcolor="#FFFFFF" text="#000000" onload="parent.document.location.href = '<?php echo ($Session["config"]["files"]["use_frames"]) ? "index.php" : "files_nf.php"; ?>'; ">
<table width="100%" border="0" cellspacing="20" cellpadding="30">
  <tr>
    <td align="center"><table width="50%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><p><font face="Verdana, Arial, Helvetica, sans-serif" size="4"><?php echo sprintf($lang['files']['reload_text'], $lang['all']['bfexplorer']); ?></font><br>
            &nbsp;</p></td>
        </tr>
        <tr>
          <td align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="3"><?php echo $lang['login']['please_wait']; ?></font></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
