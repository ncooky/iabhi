<?php 
  include('globals.inc.php');

  @set_time_limit(0);

  $item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : "/";
  $depth = (isset($_GET['depth'])) ? $_GET['depth'] : 1;
  $include_parents = (isset($_GET['include_parents'])) ? $_GET['include_parents'] : FALSE;
  $root_item_id = (isset($_GET['root_item_id'])) ? $_GET['root_item_id'] : "/";
  
  echo @get_tree($item_id, $depth, $include_parents, $root_item_id, 1);
?>