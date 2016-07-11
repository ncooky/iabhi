<?php
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  $reload = $link;
  
  if ((!isset($_POST['accion'])) || (($_POST['accion'] != "copy") && ($_POST['accion'] != "move"))) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if ((count($_POST['files']) + count($_POST['dirs'])) <= 2) {
    $Session["files"]["message"] = $lang['files']['not_selected'];
    header("Location: " . $link);
	die();
  }
  
  if (isset($_POST['dest_path']) && isset($_POST['from_path'])) {
    if ($_POST['dest_path'] != $_POST['from_path']) {
	  //Copy dirs
      $from_path = $_POST['from_path'];
      $from_path .= ($_POST['from_path'] != "") ? '/' : '';

      $dest_path = $_POST['dest_path'];
      $dest_path .= ($_POST['dest_path'] != "") ? '/' : '';
      if (@count($_POST['dirs']) > 1) {
	    for ($i = 1; $i < (@count($_POST['dirs'])); $i++) {
          $source = urldecode($from_path . $_POST['dirs'][$i]);
          $dest = urldecode($dest_path . $_POST['dirs'][$i]);
          $reload = "../reload.php";

          if (!@dir_copy($source, $dest, TRUE)) {
            $Session["files"]["message"] = $lang['files']['copy']['error_copying_dirs'];
            header("Location: " . $reload);
            die();
          }
          if ($_POST['accion'] == "move") {
            if (!@dir_delete($source)) {
              $Session["files"]["message"] = $lang['files']['delete']['error_deleting_dirs'];
              header("Location: " . $reload);
              die();
            }
          }
        }
      }
      //Copy files
      if (@count($_POST['files']) > 1) {
        for ($i = 1; $i < (@count($_POST['files'])); $i++) {
          $source = getFullPath($from_path) . '/' . urldecode($_POST['files'][$i]);
          $dest = getFullPath($dest_path) . '/' . urldecode($_POST['files'][$i]);

          if (!@copy($source, $dest)) {
            $Session["files"]["message"] = $lang['files']['copy']['error_copying_files'];
            header("Location: " . $reload);
            die();
          }
          if ($_POST['accion'] == "move") {
            if (!@unlink($source)) {
              $Session["files"]["message"] = $lang['files']['delete']['error_deleting_files'];
              header("Location: " . $reload);
              die();
            }
          }
        }
      }

      //Done, we return to the main page
	  header("Location: " . $reload);
	} else {
      $Session["files"]["message"] = $lang['files']['copy']['origin_eq_dest'];
      header("Location: " . $link);
      die();
	}
  }

  function show_paths($dir) {
	global $bfexplorer_dir;
	global $Session;

	$dir = slash_delete($dir);
	$dir .= ($dir != "") ? "/" : "";

	$handle = opendir(getFullPath($dir));
    while ($directory = readdir($handle)) {
      if (is_dir(getFullPath($dir) . '/' . $directory) && $directory != "." && $directory != ".." && $directory != $bfexplorer_dir) {
        $dirs_list[] = $dir . $directory;
      }
    }
    closedir($handle);

    $dirs_list = array_unique(array_merge((array)$dirs_list, (array)getMountedDirs($dir)));

    if (count($dirs_list) > 0) {
      natcasesort($dirs_list);
    }

    while (list($key, $value) = each($dirs_list)) {
      $go = substr($value, 0);
      if ($Session["config"]["files"]["current_dir"] != $go) {
        if (@file_exists(getFullPath($go) . "/.")) {
          $result .= "<option value=\"$go\">/$go</option>\n";
          $result .= show_paths($value);
        }
      }
    }
    return $result;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo ((isset($_POST['accion'])) && ($_POST['accion'] == "move")) ? $lang['files']['copy']['move_files'] : $lang['files']['copy']['copy_files']; ?></title>
<link href="../../style.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<form id="form" name="form" method="post" action="index.php">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="accion" type="hidden" id="accion" value="<?php echo $_POST['accion']; ?>" />
  <input name="from_path" type="hidden" id="from_path" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td><input name="dirs[]" type="hidden" id="dirs[]" value="DATA" />
        <input name="files[]" type="hidden" id="files[]" value="DATA" />
        <b><?php echo ((isset($_POST['accion'])) && ($_POST['accion'] == "move")) ? $lang['files']['copy']['path_to_move'] : $lang['files']['copy']['path_to_copy']; ?>:</b></td>
    </tr>
    <tr>
      <td><select name="dest_path" class="select" id="dest_path">
          <?php if ($Session["config"]["files"]["current_dir"] != "") { ?>
          <option value="" >/</option>
          <?php } ?>
          <?php echo show_paths(""); ?>
        </select>
      </td>
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
      <td><input name="files[]" type="hidden" id="files[]" value="<?php echo str_replace("/", "", str_replace($Session["config"]["files"]["current_dir"], "", $_POST['files'][$i])); ?>" />
        <?php echo "/" . $_POST['files'][$i] . "<br>"; ?></td>
    </tr>
    <?php } ?>
    <?php } ?>
    <tr>
      <td><input name="Copy" type="submit" class="boton" id="Copy" value="<?php echo ((isset($_POST['accion'])) && ($_POST['accion'] == "move")) ? $lang['files']['copy']['move_files'] : $lang['files']['copy']['copy_files']; ?>" />
        <input name="Cancel" type="button" class="boton" id="Cancel" onclick="JavaScript: document.location.href = '../files.php';" value="<?php echo $lang['all']['cancel']; ?>" /></td>
    </tr>
  </table>
</form>
</body>
</html>
