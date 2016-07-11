<?php 
  function bfConnect($dbHost, $dbUser, $dbPassword, $dbName) {
    return (@pg_connect("host=$dbHost user=$dbUser password=$dbPassword port=5432 dbname=$dbName"));
  }

  function bfQuery($SQL, $Count = '') {
	if (($result = @pg_query($SQL))) 
      if ($Count != '') $GLOBALS[$Count] = @pg_num_rows($result);
	return $result;
  }
?>