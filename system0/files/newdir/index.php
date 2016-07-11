<?php 
  include('globals.inc.php');
  
  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  $reload = "../reload.php";
  
  if ((!isset($_GET['accion'])) || ($_GET['accion'] != "newdir")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  } elseif ((!isset($_GET['dirname'])) || ($_GET['dirname'] == "")) {
    $Session["files"]["message"] = $lang['files']['newdir']['no_name'];
    header("Location: " . $link);
    die();
  }

  $current_dir = $Session["config"]["files"]["current_dir"];
  $current_dir .= ($Session["config"]["files"]["current_dir"] != "") ? "/" : "";
  $newdir = getFullPath($current_dir) . '/' . urldecode($_GET['dirname']);
  if (!file_exists($newdir)) {
    if (!@mkdir($newdir, 0755)) {
      $Session["files"]["message"] = sprintf($lang['files']['newdir']['couldnt_create'], '/' . $current_dir . urldecode($_GET['dirname']));
      header("Location: " . $link);
	  die();
    }
  } else {
    $Session["files"]["message"] = sprintf($lang['files']['newdir']['dir_exists'], '/' . $current_dir . urldecode($_GET['dirname']));
    header("Location: " . $link);
    die();
  }
  header("Location: " . $reload);
  die();
?>