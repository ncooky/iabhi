<?php 
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_POST['accion'])) || ($_POST['accion'] != "upload")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }

  $directory = getFullPath($Session["config"]["files"]["current_dir"]) . '/';

  $j = 0;
  for ($i=0; $i < 3; $i++) {
    if ($_FILES["file$i"]['name'] != NULL) {
      $filename = $_FILES["file$i"]['name'];
      $filesize = $_FILES["file$i"]['size'];
      $tmp = $_FILES["file$i"]['tmp_name'];
      $tmpsize = filesize($tmp);
      $filename = $directory . $filename;
      if (FALSE !== @copy($tmp, $filename)) {
        @chmod($filename, 0644);
      } else {
        $Session["files"]["message"] = sprintf($lang['files']['uploads']['error_uploading_file'], $_FILES["file$i"]['name']);
        header("Location: " . $link);
        die();
      }
      $j++;
    }
  }
  if ($j == 0) {
    $Session["files"]["message"] = $lang['files']['uploads']['no_file_selected'];
    header("Location: " . $link);
    die();
  }
  
  header("Location: " . $link);
?>