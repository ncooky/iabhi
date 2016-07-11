<?php 
  $depth = 0;
  include ('./libs/sessions.lib.php');
  bfQuery(sprintf("DELETE FROM %ssessions WHERE id='%s';", $tables_preffix, $WebSession));
  unset($Session);
  SaveSessionInformation();
  header("Location: ./login/index.php");
  die();
?> 