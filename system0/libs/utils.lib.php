<?php
  require_once ("settings.lib.php");

  $Dias_Semana = array ("0"=>"Domingo",
                        "1"=>"Lunes",
                        "2"=>"Martes",
                        "3"=>"Miércoles",
                        "4"=>"Jueves",
                        "5"=>"Viernes",
                        "6"=>"Sábado");
  $Meses_Anno = array ("1"=>"Enero",
                       "2"=>"Febrero",
                       "3"=>"Marzo",
                       "4"=>"Abril",
                       "5"=>"Mayo",
                       "6"=>"Junio",
                       "7"=>"Julio",
                       "8"=>"Agosto",
                       "9"=>"Septiembre",
                       "10"=>"Octubre",
                       "11"=>"Noviembre",
                       "12"=>"Diciembre");


  function spaDate($e) {
    $dias = array ("0"=>"Domingo",
                   "1"=>"Lunes",
                   "2"=>"Martes",
                   "3"=>"Miércoles",
                   "4"=>"Jueves",
                   "5"=>"Viernes",
                   "6"=>"Sábado");
    $meses = array ("1"=>"Enero",
                    "2"=>"Febrero",
                    "3"=>"Marzo",
                    "4"=>"Abril",
                    "5"=>"Mayo",
                    "6"=>"Junio",
                    "7"=>"Julio",
                    "8"=>"Agosto",
                    "9"=>"Septiembre",
                    "10"=>"Octubre",
                    "11"=>"Noviembre",
                    "12"=>"Diciembre");
  
    $str = $dias[date("w", $e)] . " " . date("j", $e) . " de " . $meses[date("n", $e)] . " del " . date("Y", $e);
    return ($str);
  }

  $Today = mktime(0, 0, 0, date('m'), date('j'), date('Y'));


  function  mkTimeStamp($Date) {
    $r = array();
    if (eregi("([0-9]{2,4})-([0-9]{2})-([0-9]{2})", $Date, $r))
      return mktime(0,0,0,$r[2],$r[3],$r[1]);
    return 0;
  }

  function date2my($Date) {  //entrada en formato dia/mes/anno (corto o largo). Salida YYYY-MM-DD
    $r = array();
    if (eregi("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $Date, $r))
      return date("Y-m-d",mktime(0,0,0,$r[2],$r[1],$r[3]));
    return 0;
  }

  function my2date($Date) {  // Entrada en formato YYYY-MM-DD. Salida DD/MM/YYYY largo
    $r = array();
    if (eregi("([0-9]{4})-([0-9]{2})-([0-9]{2})", $Date, $r))
      return $r[3].'/'.$r[2].'/'.$r[1];
    return 0;
  }

  function chkDate($Date) {
    $r = array();
    if (eregi("^ *([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2}) *$", $Date, $r)) {
      if ($r[1] == '00') $r[1] = '2000';
      if (checkdate($r[2], $r[3], $r[1])) return mktime(0, 0, 0, $r[2], $r[3], $r[1]);
    }
    return 0;
  }

  function chkMoneda($d) {
    if ($d>0) {
      $p = strstr($d, '.');
      if ($p[3] == '5') {
        $d += 0.001;
      }
    }
    $d = round($d, 2);
    if (abs($d) < 0.01) $d = '0.00';
    return $d;
  }

  function chkInt($Value) {
    $r = array();
    if (ereg("^ *([0-9]+) *$", $Value, $r)) {
      return TRUE;
    }
    return FALSE;
  }

  function  chkFloat($Value) {   
    if ($Value < 0) $Value = -$Value;
    if (chkInt($Value)) return TRUE;
    $r = array();
    if (ereg("^ *[0-9]*\.[0-9]+ *$", $Value, $r)) {
      return TRUE;
    }
    return FALSE;
  }

  function Porciento($d) {
    return number_format($d, 1, '.', '') . ' %';
  }

  function Moneda($d) {
    return number_format(chkMoneda($d), 2, '.', ',');
  }

  function Moneda2($d) {
    return number_format(chkMoneda($d), 2, '.', '');
  }

  function setSQLQuotes($value) {
    if (get_magic_quotes_gpc()) {
      $value = stripslashes( $value );
    }
    //check if this function exists
    if (function_exists("mysql_real_escape_string")) {
      $value = mysql_real_escape_string( $value );
    } else { //for PHP version < 4.3.0 use addslashes
      $value = addslashes( $value );
    }
    return $value;
}

  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
    $theValue = setSQLQuotes($theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
      case "double":
        $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
    }
    return $theValue;
  }
?>
