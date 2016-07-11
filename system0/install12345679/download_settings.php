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
  $read_settings = TRUE;
  if ($f = @fopen("templates/settings.lib.tpl", "r")) {
    if (@filesize("templates/settings.lib.tpl") > 0){
      if (FALSE !== ($settings_file = @fread($f, @filesize("templates/settings.lib.tpl")))) {
        $settings_file = str_replace('%%dbType%%', sprintf('$dbType = "%s"', $config['dbserver']), $settings_file);
        $settings_file = str_replace('%%dbHost%%', sprintf('$dbHost = "%s"', $config['db_host']), $settings_file);
        $settings_file = str_replace('%%dbUser%%', sprintf('$dbUser = "%s"', $config['db_user']), $settings_file);
        $settings_file = str_replace('%%dbPassword%%', sprintf('$dbPassword = "%s"', $config['db_password']), $settings_file);
        $settings_file = str_replace('%%dbName%%', sprintf('$dbName = "%s"', $config['db_name']), $settings_file);
        $settings_file = str_replace('%%tables_preffix%%', sprintf('$tables_preffix = "%s"', $config['tables_preffix']), $settings_file);
        $settings_file = str_replace('%%cookiePath%%', sprintf('$cookiePath = "%s"', $config['cookie_path']), $settings_file);
        $settings_file = str_replace('%%language%%', sprintf('$language = "%s"', $config['language']), $settings_file);
        @fclose($f);
      } else {
        $read_settings = FALSE;
      }
    } else {
      $settings_file = "";
    }
  } else {
    $read_settings = FALSE;
  }

  @clearstatcache();
  header("Content-Disposition: filename=\"settings.lib.php\"");
  header("Content-Type: application/force-download; name=\"settings.lib.php\"");
  echo $settings_file;
  die();
?>