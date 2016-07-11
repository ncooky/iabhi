<?php 
  include('globals.inc.php');

  $Session["config"]["files"]["use_frames"] = TRUE;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?></title>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<frameset rows="60,*,30,26" ID="framesetOuter">
  <frame src="toolbar.php" name="ToolBar" id="ToolBar" frameborder="0" scrolling="No" noresize="noresize" marginwidth="10" marginheight="10">
  <frameset cols="300,*" ID="framesetLeft">
    <frame src="tree.php" name="Tree" id="Tree" frameborder="1" scrolling="Auto" marginwidth="10" marginheight="10">
    <frame src="files.php" name="Files" id="Files" application="" frameborder="1" scrolling="Auto" marginwidth="10" marginheight="10">
  </frameset>
  <frame src="upload.php" name="Upload" id="Upload" frameborder="0" scrolling="No" noresize="noresize" marginwidth="0" marginheight="0">
  <frame src="resume.php" name="Resume" id="Resume" frameborder="1" scrolling="No" noresize="noresize" marginwidth="0" marginheight="0">
</frameset>
<noframes>
<body onload="window.document.location.href = 'files_nf.php?current_dir='">
</body>
</noframes>
</html>
