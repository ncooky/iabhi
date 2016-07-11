<?php 
  $depth = 1;
  include ('../libs/sessions.lib.php');

  if( !isset( $Session['UserId']) ) {
    header("Location: ../login/index.php");
    die();
  }
?>