<?php
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_GET['accion'])) || ($_GET['accion'] != "download_file")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if (!isset($_GET['filename']) || ($_GET['filename'] == "")) {
    $Session["files"]["message"] = $lang['files']['view']['not_selected_file'];
    header("Location: " . $link);
	die();
  }

  $current_dir = $Session["config"]["files"]["current_dir"];
  $current_dir .= ($Session["config"]["files"]["current_dir"] != "") ? "/" : "";
  $filename = getFullPath('/' . $current_dir . urldecode($_GET['filename']));
  
  if (!file_exists($filename) && file_exists(getFullPath('/' . urldecode($_GET['filename'])))){
    $filename = getFullPath('/' . urldecode($_GET['filename']));
  }

  if (@is_readable($filename)) {
    @clearstatcache();
    header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
    header("Content-Type: application/force-download; name=\"" . basename($filename) . "\"");
    header("Content-Length: " . filesize($filename));
    if (FALSE === @readfile($filename)) {
      $Session["files"]["message"] = $lang['files']['download']['cannot_open_file'];
      header("Location: " . $link);
      die();
    }
  } else {
    $Session["files"]["message"] = $lang['files']['download']['cannot_open_file'];
    header("Location: " . $link);
    die();
  }
?>