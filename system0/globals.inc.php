<?php
  $path = (isset($path)) ? $path : '';
  $images_path = './';

  if (file_exists($path . 'install/index.php')) {
    header(sprintf("Location: %s", $path . 'install/index.php'));
    die();
  } else {
    include ($path . 'libs/sessions.lib.php');
  }
?>