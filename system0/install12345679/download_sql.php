<?php
  
  if ((!isset($_POST['accion'])) || ($_POST['accion'] != "install")) {
    header("Location: index.php");
    die();
  }
  
  if (isset($_POST['config'])) {
    $config = $_POST['config'];
  } else {
    $config = array();
  }

  $path = explode("?", $_SERVER['PHP_SELF']);
  $config['cookie_path'] = substr(dirname($path[0]), 0, strrpos(dirname($path[0]), '/') + 1);
  $config['bfexplorer_dir'] = $config['cookie_path'];
  if(substr($config['bfexplorer_dir'], -1) == '/') {
    $config['bfexplorer_dir'] = substr($config['bfexplorer_dir'], 0, -1);
  }
  $config['bfexplorer_dir'] = substr($config['bfexplorer_dir'], strrpos($config['bfexplorer_dir'], '/'));

  $include = (isset($config['language']) && (strlen($config['language']) > 0) && (file_exists(sprintf("lang/lang.%s.php", $config['language'])))) ? sprintf("lang/lang.%s.php", $config['language']) : 'lang/lang.en.php';
  $include2 = (isset($config['dbserver']) && (strlen($config['dbserver']) > 0)) ? sprintf("db/%s.lib.php", $config['dbserver']) : 'db/mysql.lib.php';

  include($include);
  include($include2);
  
  //We read the template for settings.lib.php
    //We read the template for the structure of the tables
    $read_sql = TRUE;
    if ($f = @fopen(sprintf("sql/%s.sql", $config['dbserver']), "r")) {
      if (@filesize(sprintf("sql/%s.sql", $config['dbserver'])) > 0){
        if (FALSE !== ($sql_file = @fread($f, @filesize(sprintf("sql/%s.sql", $config['dbserver']))))) {
          $sql_file = str_replace('%%tables_preffix%%', $config['tables_preffix'], $sql_file);
          @fclose($f);
        } else {
          $read_sql = FALSE;
        }
      } else {
        $sql_file = "";
      }
    } else {
      $read_sql = FALSE;
    }


    //We read the template for the data of the tables
    $read_data_sql = TRUE;
    if ($f = @fopen(sprintf("sql/data_%s.sql", $config['language']), "r")) {
      if (@filesize(sprintf("sql/data_%s.sql", $config['language'])) > 0){
        if (FALSE !== ($data_sql_file = @fread($f, @filesize(sprintf("sql/data_%s.sql", $config['language']))))) {
          $data_sql_file = str_replace('%%tables_preffix%%', $config['tables_preffix'], $data_sql_file);
          $data_sql_file = str_replace('%%password%%', crypt('admin'), $data_sql_file);
          @fclose($f);
        } else {
          $read_data_sql = FALSE;
        }
      } else {
        $data_sql_file = "";
      }
    } else {
      $read_data_sql = FALSE;
    }

  @clearstatcache();
  header("Content-Disposition: filename=\"bfexplorer.sql\"");
  header("Content-Type: application/force-download; name=\"bfexplorer.sql\"");
  echo $sql_file . "\r\n\r\n\r\n" . $data_sql_file;
  die();
?>