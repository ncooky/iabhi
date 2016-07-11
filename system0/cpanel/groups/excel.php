<?php 
  include('globals.inc.php'); 
  include('../../libs/utils.lib.php');
  include('../../libs/listing.lib.php');
  
  if (!function_exists('html_entity_decode')) {
    function html_entity_decode($string, $quote_style = ENT_COMPAT) {
      $trans_tbl = get_html_translation_table(HTML_ENTITIES, $quote_style);
      $trans_tbl = array_flip($trans_tbl);
      return strtr($string, $trans_tbl);
    }
  }
 
  $query = generateQuery(sprintf("FROM %sgroups", $tables_preffix), '', $Session["groups"]["organizing"], $Session["groups"]["key"], $Session["groups"]["conditions"], $Session["groups"]["substitutions"]);
  
  $groups = bfTable($query);
  
  $xls = "<table border=\"1\">\r\n";
  $xls .= "<tr>\r\n";
  reset($Session["groups"]["conditions"]["show"]);
  unset($alias);
  foreach ($Session["groups"]["conditions"]["show"] as $show_value) {
    //Le quito a $show_value el name de la tabla
    if (strpos($show_value, " AS ") === false) {
      $show_value = substr($show_value, strpos($show_value, ".") + 1);
    } else {
      $show_value = substr($show_value, strpos($show_value, " AS ") + 4);
    }
    //Si tiene un alias lo encuentro
    unset($tmp);
    $tmp[] = $show_value;
    $tmp2 = array_intersect($Session["groups"]["substitutions"]["alias"], $tmp);
    //Saco el name del field
    if (count($tmp2) > 0) {
      list($field, $tmp3) = each($tmp2);
    } else {
      $field = $show_value;
    }
    //Voy guardando los alias de los fields
    $alias[$field] = $show_value;
    $xls .= sprintf("<td>%s</td>\r\n", html_entity_decode($Session["groups"]["substitutions"]["text"][$field]));
  } 
  $xls .= "</tr>\r\n";
  $xls .= "<tr>\r\n";
  while (list($k, $v)=each($groups)) { 
    foreach ($alias as $alias_field) { 
	  $xls .= sprintf("<td>%s</td>\r\n", (isset($Session["groups"]["substitutions"]["funcion"][$alias_field]) ? call_user_func($Session["groups"]["substitutions"]["funcion"][$alias_field], $v->$alias_field) : $v->$alias_field)); 
    } 
    $xls .= "</tr>\r\n";
  } 
  $xls .= "</table>\r\n";

//  $xls = base64_encode($xls);

  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");

//  header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
  header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
  header('Content-Length: ' . strlen($xls));
  header('Content-Disposition: attachment; filename="groups.xls"');

  print $xls;
?> 
