<?php
function generateTable($table, $no_conditions, $form_name, $method, $accion, $substitutions = NULL, $selected_values = NULL) {
  global $lang;

  $conditions[0] = $lang['cpanel']['none_cond'];
  $conditions[1] = $lang['cpanel']['eq'];
  $conditions[2] = $lang['cpanel']['not_eq'];
  $conditions[3] = $lang['cpanel']['gt'];
  $conditions[4] = $lang['cpanel']['gt_eq'];
  $conditions[5] = $lang['cpanel']['st'];
  $conditions[6] = $lang['cpanel']['st_eq'];
  $conditions[7] = $lang['cpanel']['bw'];
  $conditions[8] = $lang['cpanel']['not_bw'];
  $conditions[9] = $lang['cpanel']['fw'];
  $conditions[10] = $lang['cpanel']['not_fw'];
  $conditions[11] = $lang['cpanel']['c'];
  $conditions[12] = $lang['cpanel']['not_c'];
  $conditions[13] = $lang['cpanel']['e'];
  $conditions[14] = $lang['cpanel']['not_e'];
  $fields = showColumns($table);
  $result_table = sprintf('<form action="%s" name="%s" method="%s">', $accion, $form_name, $method) . "\r\n";
  $result_table .= sprintf('  <input name="data[no_fields]" Type="hidden" id="data[no_fields]" value="%s">', $no_conditions) . "\r\n";
  $result_table .= '  <table width="100%" border="0" cellspacing="0" cellpadding="2">' . "\r\n";
  $result_table .= '    <tr>' . "\r\n";
  $result_table .= '	  <td width="25%">' . $lang['cpanel']['field'] . "</td>\r\n";
  $result_table .= '	  <td width="25%">' . $lang['cpanel']['condition'] . "</td>\r\n";
  $result_table .= '	  <td width="25%">' . $lang['cpanel']['value'] . "</td>\r\n";
  $result_table .= '	  <td width="25%">' . $lang['cpanel']['fields_to_show'] . "</td>\r\n";
  $result_table .= '    </tr>' . "\r\n";
  for($i=1; $i<=$no_conditions; $i++) {
    $result_table .= '    <tr>' . "\r\n";
    $result_table .= sprintf('      <td><select name="data[field%s]" id="data[field%s]" class="select"">', $i, $i) . "\r\n";
    $result_table .= '          <option value="0">' . $lang['cpanel']['none_field'] . '</option>' . "\r\n";
	foreach ($fields['field'] as $value) {
	  $value01 = (isset($substitutions['name'][$value])) ? $substitutions['name'][$value] : $table . '.' . $value;
	  $value02 = (isset($substitutions['text'][$value])) ? $substitutions['text'][$value] : $value;
	  $selected = (isset($selected_values['field' . $i]) && ($selected_values['field' . $i] == $value01)) ? ' SELECTED' : '';
      $result_table .= sprintf('          <option value="%s"%s>%s</option>', $value01, $selected, $value02) . "\r\n";
	}
    $result_table .= '        </select></td>' . "\r\n";
    $result_table .= sprintf('      <td><select name="data[condicion%s]" id="data[condicion%s]" class="select">', $i, $i) . "\r\n";
    reset($conditions);
	while (list($value01, $value02) = each ($conditions)) {
	  $selected = (isset($selected_values['condicion' . $i]) && ($selected_values['condicion' . $i] == $value01)) ? ' SELECTED' : '';
      $result_table .= sprintf('          <option value="%s"%s>%s</option>', $value01, $selected, $value02) . "\r\n";
	}
    $result_table .= '        </select></td>' . "\r\n";
	$value = (isset($selected_values['value' . $i])) ? $selected_values['value' . $i] : '';
    $result_table .= sprintf('      <td><input name="data[value%s]" Type="text" id="data[value%s]" value="%s" class="input"></td>', $i, $i, $value) . "\r\n";
    if ($i == 1) {
      $result_table .= sprintf('      <td rowspan="%s" align="center" valign="top"><select name="data[show][]" size="%s" multiple="multiple" id="data[show][]" class="list">', $no_conditions, (2*($no_conditions - 1))) . "\r\n";
      reset($fields['field']);
	  foreach ($fields['field'] as $value) {
	    $value01 = (isset($substitutions['alias'][$value])) ? $substitutions['name'][$value] . " AS " . $substitutions['alias'][$value] : $table . '.' . $value;
	    $value02 = (isset($substitutions['text'][$value])) ? $substitutions['text'][$value] : $value;
  	    $selected = '';
		if (isset($selected_values['show'])) {
		  reset($selected_values['show']);
		  foreach ($selected_values['show'] as $show_value) {
		    if ($show_value == $value01) $selected = ' SELECTED';
		  }
        }
		$result_table .= sprintf('          <option value="%s"%s>%s</option>', $value01, $selected, $value02) . "\r\n";
	  }
      $result_table .= '        </select></td>' . "\r\n";
	}
	$result_table .= '    </tr>' . "\r\n";
  }
  $clean_action = $accion;
  $clean_action .= (strpos($accion, '?')) ? "&" : "?";
  $clean_action .= "clean=1";
  $result_table .= '    <tr>' . "\r\n";
  $result_table .= '      <td colspan="4" align="right">' . "\r\n";
  $result_table .= '        <input name="Limpiar" Type="button" onClick="window.location=\'' . $clean_action . '\'" id="Limpiar" value="' . $lang['cpanel']['delete_filter'] . '" class="boton">' . "\r\n";
  $result_table .= '        <input name="Filtrar" Type="submit" id="Filtrar" value="' . $lang['cpanel']['filter'] . '" class="boton">' . "\r\n";
  $result_table .= '      </td>' . "\r\n";
  $result_table .= '    </tr>' . "\r\n";
  $result_table .= '  </table>' . "\r\n";
  $result_table .= '</form>' . "\r\n";
  return $result_table;
}

function generateQuery($tables, $group_by, $organizing_by, $key, $objects_array = NULL, $substitutions = NULL) {
  $query = ' ';
  $having = ' ';
  $begining = 'SELECT ';
  $end = (isset($organizing_by["field"]) && isset($organizing_by["order"])) ? 'ORDER BY ' . $organizing_by["field"] . ' ' . $organizing_by["order"] : $organizing_by;
  if (isset($objects_array['show'])) {
    reset($objects_array['show']);
	$found_key = FALSE;
    foreach ($objects_array['show'] as $show_value) {
      $begining .= $show_value;
	  $begining .= (strpos($show_value, 'AS') === FALSE) ? ' AS ' . substr($show_value, strpos($show_value, '.') + 1) : '';
      $begining .= ', ';
	  if ($key == $show_value) $found_key = TRUE;
    }
	if ($found_key) { //Si se encontro la key quito la ultima coma
	  $begining = substr($begining, 0, -2) . ' ';
	} else { //Si no se encontro la agrego
      $begining .= $key;
	  $begining .= (strpos($key, 'AS') === FALSE) ? ' AS ' . substr($key, strpos($key, '.') + 1) : '';
      $begining .= ' ';
	}
  } else {
    $begining .= '* ';
  }
  $begining .= $tables;
  $condition[0] = '';
  $condition[1] = "(%s = '%s')"; //Es igual a
  $condition[2] = "(%s != '%s')"; //No es igual a
  $condition[3] = "(%s > '%s')"; //Es mayor que
  $condition[4] = "(%s >= '%s')"; //Es mayor o igual que
  $condition[5] = "(%s < '%s')"; //Es menor que
  $condition[6] = "(%s <= '%s')"; //Es menor o igual que
  $condition[7] = "(%s LIKE '%s%%')"; //Comienza por
  $condition[8] = "(%s NOT LIKE '%s%%')"; //No comienza por
  $condition[9] = "(%s LIKE '%%%s')"; //Termina con
  $condition[10] = "(%s NOT LIKE '%%%s')"; //No termina con
  $condition[11] = "(%s LIKE '%%%s%%')"; //Contiene
  $condition[12] = "(%s NOT LIKE '%%%s%%')"; //No contiene
  $condition[13] = "((%s='') OR (%s IS NULL))"; //Esta vacio
  $condition[14] = "((%s!='') AND (%s IS NOT NULL))"; //No esta vacio
  if (isset($objects_array['no_fields']) && ($objects_array['no_fields'] > 0)) {
    $query .= ' WHERE';
    $having .= ' HAVING';
	$and = ' ';
    for($i=1; $i<=$objects_array['no_fields']; $i++) {
	  if (($objects_array['field' . $i] != "0") && ($objects_array['condicion' . $i] > 0)) {
	    if ($objects_array['condicion' . $i] > 12) $objects_array['value' . $i] = $objects_array['field' . $i];
		if (isset($substitutions["isgroup"][$objects_array['field' . $i]]) && ($substitutions["isgroup"][$objects_array['field' . $i]] == 1)) {
          $query .= $and . 'TRUE';
		  $having .= $and . sprintf($condition[$objects_array['condicion' . $i]], $objects_array['field' . $i], $objects_array['value' . $i]);
		} else {
		  $query .= $and . sprintf($condition[$objects_array['condicion' . $i]], $objects_array['field' . $i], $objects_array['value' . $i]);
          $having .= $and . 'TRUE';
		}
	  } else {
        $query .= $and . 'TRUE';
        $having .= $and . 'TRUE';
	  }
      $and = ' AND ';
	}
  }
  if (($group_by != '') && (strpos($group_by, "GROUP BY") !== FALSE)) {$group_by .= $having;}
  return $begining . $query . ' ' . $group_by . ' ' . $end;
}
?>
