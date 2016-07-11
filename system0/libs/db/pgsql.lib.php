<?php 
  if (!@pg_connect("host=$dbHost port=5432 dbname=$dbName user=$dbUser password=$dbPassword")) die(pg_last_error());
  $trans = 0;

  function bfBegin() {
    bfQuery('BEGIN WORK');	
    $trans = 1;
  }

  function bfCommit() {
    bfQuery('COMMIT');
    $trans = 0; 
  }

  function bfRollback() {
    bfQuery('ROLLBACK');
    $trans = 0;
  }

  function bfLastError() {
    return pg_last_error();
  }

  function bfQuery($SQL, $Count = '') {
	if (!($result = pg_query($SQL))) 
	  die(pg_last_error() . "<br> Query: " . htmlspecialchars($SQL));
	if ($Count != '') $GLOBALS[$Count] = pg_num_rows($result);
	return $result;
  }


  function bfRecord($SQL, $Count = '') {
	return pg_fetch_object(bfQuery($SQL, $Count));
  }

  function bfTable($SQL, $Index = '', $Count = '') {
	$Result = array();
 	if ($Query = bfQuery($SQL, $Count))
	while ($row = pg_fetch_object($Query)) {
	  if ($Index == '') $Result[] = $row;
	  else $Result[$row->$Index] = $row;
	}
	return $Result;
  }

  function bfTableArray($SQL, $Index = '', $Count = '') {
	$Result = array();
 	if ($Query = bfQuery($SQL, $Count))
	while ($row = pg_fetch_object($Query)) {
	  if ($Index == '') $Result[] = get_object_vars($row);
	  else $Result[$row->$Index] = get_object_vars($row);
	}
	return $Result;
  }

  function fetch_first_row($sql) {
    $result = pg_query($sql);
    if ($result) {
	  $tmp = pg_fetch_array($result);
	  pg_free_result($result);
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
    unset($columnas);
    $columnas['field'][0] = '';
    $columnas['type'][0] = '';
    $result = bfTable(sprintf("SELECT a.attnum, a.attname AS field, t.typname as type, a.attlen AS length, a.atttypmod as lengthvar, a.attnotnull as notnull FROM pg_class c, pg_attribute a, pg_type t WHERE c.relname = '%s' AND a.attnum > 0 AND a.attrelid = c.oid AND a.atttypid = t.oid ORDER BY a.attnum", $table));
    $i = 0;
    while (list($k, $v)=each($result)) { 
	  $columnas['field'][$i] = $v->field;
	  $columnas['type'][$i] = $v->type;
      $i++;
    } 
    return $columnas;
  }
?>