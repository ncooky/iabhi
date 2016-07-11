<?php
  $CurrentTime = time();
  include('settings.lib.php');
  $WebSession = (isset($_COOKIE['WebSession'])) ? $_COOKIE['WebSession'] : "";
  $TimeToLive = 1;

  //Borramos los accesos que tengan mas de $TimeToLive horas
  bfQuery(sprintf("DELETE FROM %ssessions WHERE timestamp < %s;", $tables_preffix, ($CurrentTime - 3600*$TimeToLive)));

  //Pedimos los datos de session
  $data = fetch_first_row(sprintf("SELECT * FROM %ssessions WHERE id='%s';", $tables_preffix, $WebSession));

  if ($WebSession == '') {
    $WebSession = md5(uniqid(rand()));
    setcookie("WebSession", $WebSession, 0, $cookiePath); 
  }

  if ($data['id'] != $WebSession) {
    bfQuery(sprintf("INSERT INTO %ssessions (id, timestamp) VALUES ('%s', %s);", $tables_preffix, $WebSession, $CurrentTime));
    $Session = array();
  } else $Session = unserialize(str_replace("\\\"", "\"", $data['data']));

  $sid = $WebSession;
  bfQuery(sprintf("UPDATE %ssessions SET timestamp='%s' WHERE id='%s';", $tables_preffix, $CurrentTime, $sid));

  function SaveSessionInformation() {
    global $sid, $Session, $trans, $tables_preffix;
    if ($trans) bfRollback();
    if (is_array($Session)) {
	  $tmp = addslashes(serialize($Session));
	  bfQuery(sprintf("UPDATE %ssessions SET data='%s' WHERE id='%s';", $tables_preffix, $tmp, $sid));
    }
  }
  register_shutdown_function('SaveSessionInformation');

  //Se obliga a cargar la pagina nuevamente
  header('Cache-Control: no-cache, must-revalidate');
  header('Pragma: no-cache');
?>
