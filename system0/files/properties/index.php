<?php
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_POST['accion'])) || ($_POST['accion'] != "properties")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if ((count($_POST['files']) + count($_POST['dirs'])) <= 2) {
    $Session["files"]["message"] = $lang['files']['not_selected'];
    header("Location: " . $link);
	die();
  }
  
  $dirs_count = 0;
  $dirs_size = 0;
  $files_count = 0;
  $files_size = 0;

  $path = $Session["config"]["files"]["current_dir"];
  $path .= ($Session["config"]["files"]["current_dir"] != "") ? '/' : '';

  //Get the size of dirs
  if (@count($_POST['dirs']) > 1) {
    for ($i = 1; $i < (@count($_POST['dirs'])); $i++) {
      $dir = urldecode($path . $_POST['dirs'][$i]);

      $size = 0;
      $files = 0;
      $dirs = 0;
      if (@dir_size($dir, $size, $dirs, $files)) {
        $dirs_count++;
        $dirs_size += $size;
	  } else {
        $Session["files"]["message"] = $lang['files']['properties']['error_seeing_properties_dirs'];
        header("Location: " . $link);
        die();
      }
    }
  }
  //Get the size of files
  if (@count($_POST['files']) > 0) {
    for ($i = 1; $i < (@count($_POST['files'])); $i++) {
      $file = getFullPath($path) . '/' . urldecode($_POST['files'][$i]);

      $size = 0;
      $files = 0;
      $dirs = 0;
      if (($size = @filesize($file))) {
        $files_count++;
        $files_size += $size;
      } else {
        $Session["files"]["message"] = $lang['files']['properties']['error_seeing_properties_files'];
        header("Location: " . $link);
        die();
      }
    }
  }

  $total_space = disk_total_space(getFullPath($Session["config"]["files"]["current_dir"]));
  $free_space = disk_free_space(getFullPath($Session["config"]["files"]["current_dir"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['see_properties']; ?></title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<div align="center"><br />
  <table border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="head" width="30%" align="right">&nbsp;</td>
      <td class="head" width="35%" align="center"><b><?php echo $lang['files']['properties']['total']; ?></b></td>
      <td class="head" width="35%" align="center"><b><?php echo $lang['files']['properties']['size']; ?></b></td>
    </tr>
    <tr>
      <td align="right" class="head"><b><?php echo $lang['files']['properties']['directories']; ?>:&nbsp;</b></td>
      <td align="center" class="head"><?php echo $dirs_count; ?></td>
      <td align="center" class="head"><?php echo format_size($dirs_size); ?></td>
    </tr>
    <tr>
      <td align="right" class="head"><b><?php echo $lang['files']['properties']['files']; ?>:&nbsp;</b></td>
      <td align="center" class="head"><?php echo $files_count; ?></td>
      <td align="center" class="head"><?php echo format_size($files_size); ?></td>
    </tr>
    <tr>
      <td align="right" class="head"><b><?php echo $lang['files']['properties']['disk']; ?>:&nbsp;</b></td>
      <td align="center" class="head">&nbsp;</td>
      <td align="center" class="head"><?php echo format_size($total_space); ?></td>
    </tr>
    <tr>
      <td align="right" class="head"><b><?php echo $lang['files']['properties']['free_space']; ?>:&nbsp;</b></td>
      <td align="center" class="head">&nbsp;</td>
      <td align="center" class="head"><?php echo format_size($free_space); ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input name="Finish" type="button" class="boton" id="Finish" onclick="JavaScript: document.location.href = '../files.php';" value="<?php echo $lang['all']['finish']; ?>" /></td>
    </tr>
  </table>
</div>
</body>
</html>
