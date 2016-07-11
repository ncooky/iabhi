<?php
  include('globals.inc.php'); 
  include('../../libs/utils.lib.php');

  if (isset($_GET["id_user"]) && ($_GET["id_user"] > 0)) {
    bfQuery(sprintf("DELETE FROM %susers WHERE id_user = %s", $tables_preffix, GetSQLValueString($_GET['id_user'], "int")));
  }

  header("Location: index.php");
?>
