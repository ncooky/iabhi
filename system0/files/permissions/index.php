<?php
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  $reload = $link;
  
  if ((!isset($_POST['accion'])) || ($_POST['accion'] != "permissions")) {
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
    $path = $_POST['path'];
    $path .= ($_POST['path'] != "") ? '/' : '';

    $owner = 0;
    $owner += (isset($_POST['owner_read'])) ? $_POST['owner_read'] : 0;
    $owner += (isset($_POST['owner_write'])) ? $_POST['owner_write'] : 0;
    $owner += (isset($_POST['owner_exec'])) ? $_POST['owner_exec'] : 0;

    $group = 0;
    $group += (isset($_POST['group_read'])) ? $_POST['group_read'] : 0;
    $group += (isset($_POST['group_write'])) ? $_POST['group_write'] : 0;
    $group += (isset($_POST['group_exec'])) ? $_POST['group_exec'] : 0;

    $other = 0;
    $other += (isset($_POST['other_read'])) ? $_POST['other_read'] : 0;
    $other += (isset($_POST['other_write'])) ? $_POST['other_write'] : 0;
    $other += (isset($_POST['other_exec'])) ? $_POST['other_exec'] : 0;

    $perms = $owner*64 + $group*8 + $other;

    //Set permissions to dirs
    if (@count($_POST['dirs']) > 1) {
      for ($i = 1; $i < (@count($_POST['dirs'])); $i++) {
        $dir = urldecode($path . $_POST['dirs'][$i]);
        $reload = "../reload.php";

        if (!@dir_permissions($dir, $perms, (isset($_POST['subdirs']) && ($_POST['subdirs'] == 1)))) {
          $Session["files"]["message"] = $lang['files']['perms']['error_set_perms_dirs'];
          header("Location: " . $reload);
          die();
        }
      }
    }
    //Set permissions to files
    if (@count($_POST['files']) > 0) {
      for ($i = 1; $i < (@count($_POST['files'])); $i++) {
        $file = getFullPath($path) . '/' . urldecode($_POST['files'][$i]);

        if (!@chmod($file, $perms)) {
          $Session["files"]["message"] = $lang['files']['perms']['error_set_perms_files'];
          header("Location: " . $reload);
          die();
        }
      }
    }

    //Done, we return to the main page
    header("Location: " . $reload);
	die();
  }
  
  if (count($_POST['dirs']) > 1) {
    for ($i = -9; $i < 0; $i++) {
	  $tmp = getFullPath($Session["config"]["files"]["current_dir"]) . '/' . $_POST["dirs"][1];
      $checked[$i + 9] = (substr(base_convert(fileperms($tmp), 10, 2), $i, 1) == '1') ? " checked" : "";
    }
  } elseif (count($_POST['files']) > 1) {
    for ($i = -9; $i < 0; $i++) {
	  $tmp = getFullPath($Session["config"]["files"]["current_dir"]) . '/' . $_POST["files"][1];
      $checked[$i + 9] = (substr(base_convert(fileperms($tmp), 10, 2), $i, 1) == '1') ? " checked" : "";
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['set_permissions']; ?></title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<form id="form" name="form" method="post" action="index.php">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER["PHP_SELF"]), "", $_SERVER["PHP_SELF"])); ?>" />
  <input name="accion" type="hidden" id="accion" value="<?php echo $_POST["accion"]; ?>" />
  <input name="path" type="hidden" id="path" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td colspan="2"><input name="dirs[]" type="hidden" id="dirs[]" value="DATA" />
        <input name="files[]" type="hidden" id="files[]" value="DATA" />
        <b><?php echo $lang['files']['perms']['about_change_perms']; ?>:</b></td>
    </tr>
    <tr>
      <td width="10%" align="left" valign="top"><table border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
          <tr>
            <td>&nbsp;</td>
            <td><b><?php echo $lang['files']['perms']['owner']; ?></b></td>
            <td><b><?php echo $lang['files']['perms']['group']; ?></b></td>
            <td><b><?php echo $lang['files']['perms']['others']; ?></b></td>
          </tr>
          <tr>
            <td align="right"><b><?php echo $lang['files']['perms']['read']; ?></b></td>
            <td><input name="owner_read" type="checkbox" class="check" id="owner_read" value="4"<?php echo $checked[0]; ?>></td>
            <td><input name="group_read" type="checkbox" class="check" id="group_read" value="4"<?php echo $checked[3]; ?>></td>
            <td><input name="other_read" type="checkbox" class="check" id="other_read" value="4"<?php echo $checked[6]; ?>></td>
          </tr>
          <tr>
            <td align="right"><b><?php echo $lang['files']['perms']['write']; ?></b></td>
            <td><input name="owner_write" type="checkbox" class="check" id="owner_write" value="2"<?php echo $checked[1]; ?>></td>
            <td><input name="group_write" type="checkbox" class="check" id="group_write" value="2"<?php echo $checked[4]; ?>></td>
            <td><input name="other_write" type="checkbox" class="check" id="other_write" value="2"<?php echo $checked[7]; ?>></td>
          </tr>
          <tr>
            <td align="right"><b><?php echo $lang['files']['perms']['execute']; ?></b></td>
            <td><input name="owner_exec" type="checkbox" class="check" id="owner_exec" value="1"<?php echo $checked[2]; ?>></td>
            <td><input name="group_exec" type="checkbox" class="check" id="group_exec" value="1"<?php echo $checked[5]; ?>></td>
            <td><input name="other_exec" type="checkbox" class="check" id="other_exec" value="1"<?php echo $checked[8]; ?>></td>
          </tr>
        </table></td>
      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <?php if (count($_POST["dirs"]) > 1) { ?>
          <tr>
            <td colspan="2"><b><?php echo $lang['files']['perms']['selected_dirs']; ?>:</b></td>
          </tr>
          <?php for ($i = 1; $i < count($_POST["dirs"]); $i++) { ?>
          <tr>
            <td colspan="2"><input name="dirs[]" type="hidden" id="dirs[]" value="<?php echo $_POST["dirs"][$i]; ?>" />
              <?php echo "/" . $_POST["dirs"][$i] . "<br>"; ?></td>
          </tr>
          <?php } ?>
          <?php } ?>
          <?php if (count($_POST["files"]) > 1) { ?>
          <tr>
            <td colspan="2"><b><?php echo $lang['files']['perms']['selected_files']; ?>:</b></td>
          </tr>
          <?php for ($i = 1; $i < count($_POST["files"]); $i++) { ?>
          <tr>
            <td colspan="2"><input name="files[]" type="hidden" id="files[]" value="<?php echo str_replace("/", "", str_replace($Session["config"]["files"]["current_dir"], "", $_POST["files"][$i])); ?>" />
              <?php echo "/" . $_POST["files"][$i] . "<br>"; ?></td>
          </tr>
          <?php } ?>
          <?php } ?>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"><input name="subdirs" type="checkbox" class="check" id="subdirs" value="1" checked>
        <?php echo $lang['files']['include_subdirs']; ?></td>
    </tr>
    <tr>
      <td colspan="2"><input name="Copy" type="submit" class="boton" id="Copy" value="<?php echo $lang['files']['set_permissions']; ?>" />
        <input name="Cancel" type="button" class="boton" id="Cancel" onclick="JavaScript: document.location.href = '../files.php';" value="<?php echo $lang['all']['cancel']; ?>" /></td>
    </tr>
  </table>
</form>
</center>
</div>
</body>
</html>
