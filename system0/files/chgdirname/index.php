<?php 
  include('globals.inc.php');
  
  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  $reload = "../reload.php";
  
  if ((!isset($_GET['accion'])) || ($_GET['accion'] != "changename")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  } elseif ((!isset($_GET['oldname'])) || ($_GET['oldname'] == "")) {
    $Session["files"]["message"] = $lang['files']['chgdirname']['no_old_name'];
    header("Location: " . $link);
    die();
  } elseif ((!isset($_GET['newname'])) || ($_GET['newname'] == "")) {
    $Session["files"]["message"] = $lang['files']['chgdirname']['no_new_name'];
    header("Location: " . $link);
    die();
  }

  $current_dir = $Session["config"]["files"]["current_dir"];
  $current_dir .= ($Session["config"]["files"]["current_dir"] != "") ? "/" : "";
  $oldname = getFullPath($current_dir) . '/' . urldecode($_GET['oldname']);
  $newname = getFullPath($current_dir) . '/' . urldecode($_GET['newname']);
  if (file_exists($oldname)) {
    if (!@rename($oldname, $newname)) {
      $Session["files"]["message"] = sprintf($lang['files']['chgdirname']['couldnt_rename_dir'], '/' . $current_dir . urldecode($_GET['oldname']));
      header("Location: " . $link);
	  die();
    }
  } else {
    $Session["files"]["message"] = sprintf($lang['files']['chgdirname']['dir_doesnt_exists'], '/' . $current_dir . urldecode($_GET['oldname']));
    header("Location: " . $link);
    die();
  }
  header("Location: " . $reload);
  die();
?>