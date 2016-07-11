<?php
  include('globals.inc.php');
  include('../../libs/compress.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_POST['accion'])) || ($_POST['accion'] != "download_compfile")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if ((count($_POST['files']) + count($_POST['dirs'])) <= 2) {
    $Session["files"]["message"] = $lang['files']['not_selected'];
    header("Location: " . $link);
	die();
  }
  
  $path = $Session["config"]["files"]["current_dir"];
  $path .= ($Session["config"]["files"]["current_dir"] != "") ? '/' : '';

  $compName = (isset($_GET['compName']) && ($_GET['compName'] != '')) ? $_GET['compName'] : 'bfexplorer';
  $compType = (isset($_GET['compType']) && ($_GET['compType'] != '')) ? $_GET['compType'] : 'tar';
  
  switch ($compType) {
    case 'tar':
      $compfile = new tar_file($compName . '.tar');
    break;
    case 'zip':
      if (function_exists('gzopen')) {
        $compfile = new zip_file($compName . '.zip');
      } else {
        $Session["files"]["message"] = $lang['files']['compress']['extension_not_installed'];
        header("Location: " . $link);
        die();
      }
    break;
    case 'gzip':
      if (function_exists('gzopen')) {
        $compfile = new gzip_file($compName . '.tar.gz');
      } else {
        $Session["files"]["message"] = $lang['files']['compress']['extension_not_installed'];
        header("Location: " . $link);
        die();
      }
    break;
    case 'bzip':
      if (function_exists('bzopen')) {
        $compfile = new bzip_file($compName . '.tar.bz');
      } else {
        $Session["files"]["message"] = $lang['files']['compress']['extension_not_installed'];
        header("Location: " . $link);
        die();
      }
    break;
    default:
      $Session["files"]["message"] = $lang['files']['error_in_request'];
      header("Location: " . $link);
      die();
    break;
  }

  $compfile->set_options(array('inmemory' => 1, 'basedir' => getFullPath($path)));
  
  @set_time_limit(0);

  $file_contents = array();

  // dirs
  if (@count($_POST['dirs']) > 1)
    for ($i = 1; $i < (@count($_POST['dirs'])); $i++) {
      $file_contents[] = urldecode($_POST['dirs'][$i]);
    }

  // files
  if (@count($_POST['files']) > 1)
    for ($i = 1; $i < (@count($_POST['files'])); $i++) {
      $file_contents[] = urldecode($_POST['files'][$i]);
    }

  @$compfile->add_files($file_contents);
  if (count($compfile->error) > 0) {
    $Session["files"]["message"] = $lang['files']['download_compfile']['error_creating_compressed_file'];
    header("Location: " . $link);
    die();
  }

  @$compfile->create_archive();
  if (count($compfile->error) > 0) {
    $Session["files"]["message"] = $lang['files']['download_compfile']['error_creating_compressed_file'];
    header("Location: " . $link);
    die();
  }

  $compfile->download_file();
?>