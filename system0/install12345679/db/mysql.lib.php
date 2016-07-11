<?php 
  function bfConnect($dbHost, $dbUser, $dbPassword, $dbName) {
    if (@mysql_connect($dbHost, $dbUser, $dbPassword)) {
      return (boolean)(@mysql_select_db($dbName));
    } else {
	  return FALSE;
    }
  }

  function bfQuery($SQL, $Count = '') {
	if (($result = @mysql_query($SQL))) 
      if ($Count != '') $GLOBALS[$Count] = @mysql_num_rows($result);
	return $result;
  }
?>