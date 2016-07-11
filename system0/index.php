<?php 
  if (file_exists('install/index.php')) {
    header(sprintf("Location: %s", 'install/index.php'));
    die();
  } else {
    include('globals.inc.php');

    header('Location: login/index.php');
    die();
  }
?>
