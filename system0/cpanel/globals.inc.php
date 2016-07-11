<?php 
  $depth = 1;
	
  $path = '';
  for($i = 0; $i < $depth; $i++) $path .= '../';
	
  include($path . 'globals.inc.php');
  if(!isset($Session['UserId'])) {
    header("Location: $path" . "login.php");
    die();
  }
?>
