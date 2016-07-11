<?php
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  $reload = $link;
  
  if ((!isset($_POST['accion'])) || ($_POST['accion'] != "delete")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if ((count($_POST['files']) + count($_POST['dirs'])) <= 2) {
    $Session["files"]["message"] = $lang['files']['not_selected'];
    header("Location: " . $link);
	die();
  }
  
  if (isset($_POST['path'])) {
    //delete dirs
    $path = $_POST['path'];
    $path .= ($_POST['path'] != "") ? '/' : '';

    if (@count($_POST['dirs']) > 1) {
      for ($i = 1; $i < (@count($_POST['dirs'])); $i++) {
        $dir = urldecode($path . $_POST['dirs'][$i]);
        $reload = "../reload.php";

        if (!@dir_delete($dir)) {
          $Session["files"]["message"] = $lang['files']['delete']['error_deleting_dirs'];
          header("Location: " . $reload);
          die();
        }
      }
    }
    //delete files
    if (@count($_POST['files']) > 0) {
      for ($i = 1; $i < (@count($_POST['files'])); $i++) {
        $file = getFullPath($path) . '/' . urldecode($_POST['files'][$i]);

        if (!@unlink($file)) {
          $Session["files"]["message"] = $lang['files']['delete']['error_deleting_files'];
          header("Location: " . $reload);
          die();
        }
      }
    }

    //Done, we return to the main page
    header("Location: " . $reload);
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['delete']['delete_files']; ?></title>
<link href="../../style.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<form id="form" name="form" method="post" action="index.php">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="accion" type="hidden" id="accion" value="<?php echo $_POST['accion']; ?>" />
  <input name="path" type="hidden" id="path" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td><input name="dirs[]" type="hidden" id="dirs[]" value="DATA" />
        <input name="files[]" type="hidden" id="files[]" value="DATA" />
        <b><?php echo $lang['files']['delete']['delete_confirm']; ?></b></td>
    </tr>
    <?php if (count($_POST['dirs']) > 1) { ?>
    <tr>
      <td><b><?php echo $lang['files']['perms']['selected_dirs']; ?>:</b></td>
    </tr>
    <?php for ($i = 1; $i < count($_POST['dirs']); $i++) { ?>
    <tr>
      <td><input name="dirs[]" type="hidden" id="dirs[]" value="<?php echo $_POST['dirs'][$i]; ?>" />
        <?php echo "/" . $_POST['dirs'][$i] . "<br>"; ?></td>
    </tr>
    <?php } ?>
    <?php } ?>
    <?php if (count($_POST['files']) > 1) { ?>
    <tr>
      <td><b><?php echo $lang['files']['perms']['selected_files']; ?>:</b></td>
    </tr>
    <?php for ($i = 1; $i < count($_POST['files']); $i++) { ?>
    <tr>
      <td><input name="files[]" type="hidden" id="files[]" value="<?php echo (file_exists(getFullPath($Session["config"]["files"]["current_dir"]) . '/' . $_POST['files'][$i])) ? $_POST['files'][$i] : str_replace("/", "", str_replace($Session["config"]["files"]["current_dir"], "", $_POST['files'][$i])); ?>" />
        <?php echo "/" . $_POST['files'][$i] . "<br>"; ?></td>
    </tr>
    <?php } ?>
    <?php } ?>
    <tr>
      <td><input name="delete" type="submit" class="boton" id="delete" value="<?php echo $lang['all']['delete']; ?>" />
        <input name="Cancel" type="button" class="boton" id="Cancel" onclick="JavaScript: document.location.href = '../files.php';" value="<?php echo $lang['all']['cancel']; ?>" /></td>
    </tr>
  </table>
</form>
</body>
</html>
