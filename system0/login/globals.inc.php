<?php 
  if (file_exists('../install/index.php')) {
    header(sprintf("Location: %s", '../install/index.php'));
    die();
  } else {
    $depth = 1;
    include ('../libs/sessions.lib.php');  
  }
?>