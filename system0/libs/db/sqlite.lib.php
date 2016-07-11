<?php 
  global $db;
  if (!($db = sqlite_open($path . $dbName, 0666, $sqlite_error))) die($sqlite_error);
  $trans = 0;

  function bfBegin() {
    bfQuery('BEGIN;');	
    $trans = 1;
  }

  function bfCommit() {
    bfQuery('COMMIT;');
    $trans = 0; 
  }

  function bfRollback() {
    bfQuery('ROLLBACK;');
    $trans = 0;
  }

  function bfLastError() {
    global $db;
    return sqlite_error_string(sqlite_last_error($db));
  }

  function bfQuery($SQL, $Count = '') {
    global $db;
	if (!($result = sqlite_query($db, $SQL))) 
	  die(bfLastError() . "<br> Query: " . htmlspecialchars($SQL));
	if ($Count != '') $GLOBALS[$Count] = sqlite_num_rows($result);
	return $result;
  }

  function bfRecord($SQL, $Count = '') {
	return sqlite_fetch_object(bfQuery($SQL, $Count));
  }

  function bfTable($SQL, $Index = '', $Count = '') {
	$Result = array();
 	if ($Query = bfQuery($SQL, $Count))
	while ($row = sqlite_fetch_object($Query)) {
	  if ($Index == '') $Result[] = $row;
	  else $Result[$row->$Index] = $row;
	}
	return $Result;
  }

  function bfTableArray($SQL, $Index = '', $Count = '') {
	$Result = array();
 	if ($Query = bfQuery($SQL, $Count))
	while ($row = sqlite_fetch_object($Query)) {
	  if ($Index == '') $Result[] = get_object_vars($row);
	  else $Result[$row->$Index] = get_object_vars($row);
	}
	return $Result;
  }

  function fetch_first_row($sql) {
    global $db;
    $result = sqlite_query($db, $sql);
    if ($result) {
	  $tmp = sqlite_fetch_array($result);
//	  mysql_free_result($result);
    }
    return $tmp;
  }

  function Date2Str($Fecha) {
	$reg = array();
	if (ereg("([0-9]+)-([0-9]+)-([0-9]+)", $Fecha, $reg))
	if ($reg[1]*$reg[2]*$reg[3]>0) {
	  return date('j/m/Y', mktime(0, 0, 0, $reg[2], $reg[3], $reg[1]));
	}
	return '';
  }

  function Str2Date ($Fecha) {
	$reg = array();
	if (ereg("([0-9]+)/([0-9]+)/([0-9]+)", $Fecha, $reg)) {
	  return date('Y-m-d', mktime(0, 0, 0, $reg[2], $reg[1], $reg[3]));
	}
	return '';
  }

  function Unix2Str ($Fecha) {
	return ibDate2Str(ibDate($Fecha));
  }

  function preSerialize($tmp) {
	if (is_object($tmp)) {
	  settype($tmp, 'array');
	  $tmp = preSerialize($tmp);
	  settype($tmp, 'object');
	  return $tmp;
	}
	if (is_array($tmp)) {
	  while (list($k, $v) = each($tmp)) {
		$tmp[$k] = preSerialize($v);
	  }
	  reset($tmp);
	  return $tmp;
	}
	return stripslashes($tmp);
  }

  function htmlPrepare($tmp) {
	if (is_object($tmp)) {
	  settype($tmp, 'array');
	  $tmp = htmlPrepare($tmp);
	  settype($tmp, 'object');
	  return $tmp;
	}
	if (is_array($tmp)) {
	  while (list($k, $v) = each($tmp)) {
		$tmp[$k] = htmlPrepare($v);
	  }
	  reset($tmp);
	  return $tmp;
	}
	return htmlspecialchars($tmp);
  }

  function shiftDate($Date, $diaDelta=0, $mesDelta=0) {
	if (!$Date= chkDate($Date)) {
	  return '';
	}
	$Date = mktime(0, 0, 0, date('m', $Date) + $mesDelta, date('d', $Date) + $diaDelta, date('Y', $Date));
	return date('d/m/Y', $Date);
  }

  function showColumns($table) {
    global $db;
    unset($columnas);
    $columnas['field'][0] = '';
    $columnas['type'][0] = '';
    $result = sqlite_fetch_column_types($table, $db);
	$i = 0;
    while (list($columnas['field'][$i], $columnas['type'][$i]) = each($result)) { 
      $i++;
    } 
    return $columnas;
  }
?>