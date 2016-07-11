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
  
  //We read the template for config.php
  $read_config = TRUE;
  if ($f = @fopen("templates/config.tpl", "r")) {
    if (@filesize("templates/config.tpl") > 0){
      if (FALSE !== ($config_file = @fread($f, @filesize("templates/config.tpl")))) {
        $config_file = str_replace('%%bfexplorer_dir%%', sprintf('$bfexplorer_dir = "%s"', $config['bfexplorer_dir']), $config_file);
        $config_file = str_replace('%%date_format%%', sprintf('$date_format = "%s"', $lang['install']['date_format']), $config_file);

        $fstab = "";
        for ($i = 0; $i < 5; $i++) { 
          if (isset($config['fstab'][$i]['mount_point']) && (strlen($config['fstab'][$i]['mount_point']) > 0) && isset($config['fstab'][$i]['mount_dir']) && (strlen($config['fstab'][$i]['mount_dir']) > 0)) {
            if ($i > 0) {
              $config['fstab'][$i]['mount_point'] = "/" . $config['fstab'][$i]['mount_point'];
            }
            $is_homedir = (isset($config['is_homedir']) && ($config['is_homedir'] == $i)) ? ", 'is_homedir' => TRUE" : "";
            $user_homedir = (isset($config['is_homedir']) && ($config['is_homedir'] == $i)) ? "/%%user_homedir%%" : "";
            $fstab .= sprintf(",\n       '%s' => array('full_path' => '%s%s'%s)", $config['fstab'][$i]['mount_point'], $config['fstab'][$i]['mount_dir'], $user_homedir, $is_homedir);
          }
        }
        $fstab = substr($fstab, 2);
        $config_file = str_replace('%%fstab%%', sprintf('%s', $fstab), $config_file);
        @fclose($f);
      } else {
        $read_config = FALSE;
      }
    } else {
      $config_file = "";
    }
  } else {
    $read_config = FALSE;
  }

  @clearstatcache();
  header("Content-Disposition: filename=\"config.php\"");
  header("Content-Type: application/force-download; name=\"config.php\"");
  echo $config_file;
  die();
?>