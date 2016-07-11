<?php 
  include('globals.inc.php');
  
  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_GET['accion'])) || ($_GET['accion'] != "newfile")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  } elseif ((!isset($_GET['filename'])) || ($_GET['filename'] == "")) {
    $Session["files"]["message"] = $lang['files']['newfile']['no_name'];
    header("Location: " . $link);
    die();
  }

  $current_dir = $Session["config"]["files"]["current_dir"];
  $current_dir .= ($Session["config"]["files"]["current_dir"] != "") ? "/" : "";
  $newfile = getFullPath('/' . $current_dir . urldecode($_GET['filename']));
  if (!file_exists($newfile)) {
    if (!($handle = @fopen($newfile, 'x+'))) {
      $Session["files"]["message"] = sprintf($lang['files']['newfile']['couldnt_create'], '/' . $current_dir . urldecode($_GET['filename']));
      header("Location: " . $link);
	  die();
    } else {
      fclose($handle);
      chmod($newfile, 0644);
	}
  } else {
    $Session["files"]["message"] = sprintf($lang['files']['newfile']['file_exists'], '/' . $current_dir . urldecode($_GET['filename']));
    header("Location: " . $link);
    die();
  }
  header("Location: " . $link);
  die();
?>