<?php
  include('globals.inc.php'); 
  include('../../libs/utils.lib.php');

  if (isset($_GET["id_group"]) && ($_GET["id_group"] > 0)) {
    bfQuery(sprintf("UPDATE %susers SET id_group=NULL WHERE id_group = %s", $tables_preffix, GetSQLValueString($_GET['id_group'], "int")));
    bfQuery(sprintf("DELETE FROM %sgroups WHERE id_group = %s", $tables_preffix, GetSQLValueString($_GET['id_group'], "int")));
  }

  header("Location: index.php");
?>
