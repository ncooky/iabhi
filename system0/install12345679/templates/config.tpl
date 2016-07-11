<?php
  //Name of bfexplorer's directory
  if (!isset($bfexplorer_dir)) {
    %%bfexplorer_dir%%;
  }

  //bfexplorer's version
  if (!isset($version)) {
    $version = "0.0.9.1";
  }

  //Shares used by bfExplorer. Here you can setup all the shares that you want to load.
  //For now shares are only allowed in the first level:
  // -> '/var' => array('full_path' => '/usr/var'), -> This is allowed
  // -> '/var/tmp' => array('full_path' => '/usr/var'), -> This is NOT allowed
  // A full example could look like this:
  /* Example
  if (!isset($fstab)) {
    $fstab = array(
       '/' => array('full_path' => $_SERVER['DOCUMENT_ROOT']),
       '/home' => array('full_path' => '/home/users/%%user_homedir%%', 'is_homedir' => TRUE),
       '/var' => array('full_path' => '/usr/var'),
       '/tmp' => array('full_path' => '/tmp')
    );
  */
  if (!isset($fstab)) {
    $fstab = array(
%%fstab%%
    );

  }

  //Number of characters shown in names
  if (!isset($names_chars)) {
    $names_chars = 15;
  }

  //Format of dates
  if (!isset($date_format)) {
    %%date_format%%;
  }

  //Properties of the extensions
  if (!isset($extensions)) {
    $extensions = array(
        '' => array('image' => 'generic.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'none', 'highlighter' => 'none'),

        'exe' => array('image' => 'binary.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#00ff00', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'com' => array('image' => 'binary.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#00ff00', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'bat' => array('image' => 'binary.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#00ff00', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),

        'doc' => array('image' => 'doc.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'ppt' => array('image' => 'ppt.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'mdb' => array('image' => 'mdb.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'xls' => array('image' => 'xls.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'csv' => array('image' => 'xls.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'none'),

        'html' => array('image' => 'web.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'html', 'highlighter' => 'html4strict'),
        'shtml' => array('image' => 'web.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'html', 'highlighter' => 'html4strict'),
        'htm' => array('image' => 'web.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'html', 'highlighter' => 'html4strict'),
        'css' => array('image' => 'css.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'css'),
        'vbs' => array('image' => 'script.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'vb'),
        'js' => array('image' => 'java.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'javascript'),

        'phps' => array('image' => 'php.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'php'),
        'php3' => array('image' => 'php.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'php'),
        'php4' => array('image' => 'php.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'php'),
        'phtml' => array('image' => 'php.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'php'),
        'php' => array('image' => 'php.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'php'),

        'asp' => array('image' => 'asp.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'asp'),

        'xml' => array('image' => 'xml.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'xml'),
        'xsl' => array('image' => 'xml.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'xml'),
        'dtd' => array('image' => 'xml.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'xml'),
        'xsd' => array('image' => 'xml.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'xml'),

        'sql' => array('image' => 'sql.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'sql'),

        'pdf' => array('image' => 'pdf.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),

        'java' => array('image' => 'java.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'java'),
        'class' => array('image' => 'java.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#00ff00', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),

        'txt' => array('image' => 'text.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'none', 'highlighter' => 'none'),

        'wav' => array('image' => 'sound.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'mp3' => array('image' => 'sound.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'mid' => array('image' => 'sound.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),

        'c' => array('image' => 'c.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'c'),
        'cpp' => array('image' => 'cpp.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'c'),

        'pas' => array('image' => 'pas.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'pascal'),
        'dpr' => array('image' => 'delphi.gif', 'view' => TRUE, 'edit' => TRUE, 'color' => '#000000', 'viewer' => 'text', 'editor' => 'text', 'highlighter' => 'delphi'),

        'mov' => array('image' => 'video.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'mpg' => array('image' => 'video.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'mpeg' => array('image' => 'video.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'avi' => array('image' => 'video.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'divx' => array('image' => 'video.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),

        'tar' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'zip' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'gzip' => array('image' => 'gz.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'gz' => array('image' => 'gz.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'bzip' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'rar' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'ace' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'arj' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'lzh' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'cab' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'bz2' => array('image' => 'comp.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),
        'tgz' => array('image' => 'gz.gif', 'view' => FALSE, 'edit' => FALSE, 'color' => '#ff00ff', 'viewer' => 'none', 'editor' => 'none', 'highlighter' => 'none'),

        'gif' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none'),
        'bmp' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none'),
        'png' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none'),
        'tga' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none'),
        'tiff' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none'),
        'jpeg' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none'),
        'jpg' => array('image' => 'image.gif', 'view' => TRUE, 'edit' => FALSE, 'color' => '#000000', 'viewer' => 'image', 'editor' => 'none', 'highlighter' => 'none')
    );
  }

  /////////////////////////////////////////////////////////////////////
  //  Don't change below this line                                   //
  /////////////////////////////////////////////////////////////////////

  //Current dir
  if (isset($_GET["current_dir"])) {
    $Session["config"]["files"]["current_dir"] = $_GET["current_dir"];
  } elseif (isset($_POST["current_dir"])) {
    $Session["config"]["files"]["current_dir"] = $_POST["current_dir"];
  } elseif (!isset($Session["config"]["files"]["current_dir"])) { 
    $Session["config"]["files"]["current_dir"] = "";
  }
  $Session["config"]["files"]["current_dir"] = str_replace("../", "", $Session["config"]["files"]["current_dir"]);
  $Session["config"]["files"]["current_dir"] = str_replace("./", "", $Session["config"]["files"]["current_dir"]);
  if ($Session["config"]["files"]["current_dir"] == ".") {
    $Session["config"]["files"]["current_dir"] = "";
  }

  //action to perform
  if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];
  } elseif (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
  } else {
    $accion = "none";
  }
?>