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
  $config['bfexplorer_dir'] = substr($config['bfexplorer_dir'], strrpos($config['bfexplorer_dir'], '/') + 1);

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

  //We write the file settings.lib.php
  $write_settings = FALSE;
  if ($read_settings) {
    if ($f = @fopen("../libs/settings.lib.php", "w")) {
      if (@fwrite($f, $settings_file)) {
        fclose($f);
        $write_settings = TRUE;
      }
    }
  }
  
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

  //We write the file config.php
  $write_config = FALSE;
  if ($read_config) {
    if ($f = @fopen("../files/config.php", "w")) {
      if (@fwrite($f, $config_file)) {
        fclose($f);
        $write_config = TRUE;
      }
    }
  }

  $create_tables = FALSE;
  $read_sql = FALSE;
  $load_data = FALSE;
  $read_data_sql = FALSE;

  if (($config['create_tables'] == 1) && (bfConnect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']))) {
    //We read the template for the structure of the tables
    $read_sql = TRUE;
    if ($f = @fopen(sprintf("sql/%s.sql", $config['dbserver']), "r")) {
      if (@filesize(sprintf("sql/%s.sql", $config['dbserver'])) > 0){
        if (FALSE !== ($sql_file = @fread($f, @filesize(sprintf("sql/%s.sql", $config['dbserver']))))) {
          $sql_file = str_replace('%%tables_preffix%%', $config['tables_preffix'], $sql_file);
          $sql_file = str_replace("\r\n", "\n", $sql_file);
          $sql_file = str_replace("\r", "\n", $sql_file);

          $queries = split(";\n",  $sql_file);

          $create_tables = TRUE;
          while (list($k, $v) = each($queries)) {
            if (trim($v) != '') {
              if (!bfQuery(trim($v))) {
                $create_tables = FALSE;
              }
            }
          }
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
          $data_sql_file = str_replace("\r\n", "\n", $data_sql_file);
          $data_sql_file = str_replace("\r", "\n", $data_sql_file);

          $queries = split(";\n",  $data_sql_file);

          $load_data = TRUE;
          while (list($k, $v) = each($queries)) {
            if (trim($v) != '') {
              if (!bfQuery(trim($v))) {
                $load_data = FALSE;
              }
            }
          }
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
  }
?>
<html>
<head>
<title><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['install_complete']; ?> - <?php echo sprintf($lang['install']['install_wizard'], $current_step, $total_steps); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../favicon.ico">
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body topmargin="0">
<br>
<br>
<br>
<br>
<div align="center">
  <table width="400" height="120"  border="0" cellspacing="0" cellpadding="1">
    <tr height="30">
      <th width="2" background="../images/borders/left_topCorner.jpg"></th>
      <th align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['install_complete']; ?></th>
      <th width="2" background="../images/borders/right_topCorner.jpg"></th>
    </tr>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="48"><img src="../images/logo.gif"></td>
            <td><font size="+1"><?php echo $lang['install']['bfexplorer']; ?></font><br />
              <i><?php echo $lang['install']['slogan']; ?></i></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><font size="+1"><?php echo $lang['install']['install_complete_text']; ?></font></td>
          </tr>
        </table></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="center" valign="middle">&nbsp;</td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="left" valign="middle"><form action="download_settings.php" method="POST" name="wizard" id="wizard">
          <table width="100%"  border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td width="80%" valign="top" align="left"><b><i><font size="+1">
                <input name="accion" type="hidden" id="accion" value="install">
                <input name="config[language]" type="hidden" id="config[language]" value="<?php echo (isset($config['language']) && (strlen($config['language']) > 0)) ? $config['language'] : 'en'; ?>">
                <input name="config[dbserver]" type="hidden" id="config[dbserver]" value="<?php echo (isset($config['dbserver']) && (strlen($config['dbserver']) > 0)) ? $config['dbserver'] : ''; ?>">
                <input name="config[db_host]" type="hidden" id="config[db_host]" value="<?php echo (isset($config['db_host']) && (strlen($config['db_host']) > 0)) ? $config['db_host'] : 'localhost'; ?>">
                <input name="config[db_user]" type="hidden" id="config[db_user]" value="<?php echo (isset($config['db_user']) && (strlen($config['db_user']) > 0)) ? $config['db_user'] : ''; ?>">
                <input name="config[db_password]" type="hidden" id="config[db_password]" value="<?php echo (isset($config['db_password']) && (strlen($config['db_password']) > 0)) ? $config['db_password'] : ''; ?>">
                <input name="config[db_name]" type="hidden" id="config[db_name]" value="<?php echo (isset($config['db_name']) && (strlen($config['db_name']) > 0)) ? $config['db_name'] : ''; ?>">
                <input name="config[tables_preffix]" type="hidden" id="config[tables_preffix]" value="<?php echo (isset($config['tables_preffix']) && (strlen($config['tables_preffix']) > 0)) ? $config['tables_preffix'] : 'bfe_'; ?>">
                <input name="config[create_db]" type="hidden" id="config[create_db]" value="<?php echo (isset($config['create_db']) && (strlen($config['create_db']) > 0)) ? $config['create_db'] : '1'; ?>">
                <input name="config[create_tables]" type="hidden" id="config[create_tables]" value="<?php echo (isset($config['create_tables']) && (strlen($config['create_tables']) > 0)) ? $config['create_tables'] : '0'; ?>">
                <input name="config[fstab][0][mount_point]" type="hidden" id="config[fstab][0][mount_point]" value="/">
                <input name="config[fstab][0][mount_dir]" type="hidden" id="config[fstab][0][mount_dir]" value="<?php echo (isset($config['fstab']['0']['mount_dir']) && (strlen($config['fstab']['0']['mount_dir']) > 0)) ? $config['fstab']['0']['mount_dir'] : $_SERVER['DOCUMENT_ROOT']; ?>">
                <input name="config[fstab][1][mount_point]" type="hidden" id="config[fstab][1][mount_point]" value="<?php echo (isset($config['fstab']['1']['mount_point']) && (strlen($config['fstab']['1']['mount_point']) > 0)) ? $config['fstab']['1']['mount_point'] : ''; ?>">
                <input name="config[fstab][1][mount_dir]" type="hidden" id="config[fstab][1][mount_dir]" value="<?php echo (isset($config['fstab']['1']['mount_dir']) && (strlen($config['fstab']['1']['mount_dir']) > 0)) ? $config['fstab']['1']['mount_dir'] : ''; ?>">
                <input name="config[fstab][2][mount_point]" type="hidden" id="config[fstab][2][mount_point]" value="<?php echo (isset($config['fstab']['2']['mount_point']) && (strlen($config['fstab']['2']['mount_point']) > 0)) ? $config['fstab']['2']['mount_point'] : ''; ?>">
                <input name="config[fstab][2][mount_dir]" type="hidden" id="config[fstab][2][mount_dir]" value="<?php echo (isset($config['fstab']['2']['mount_dir']) && (strlen($config['fstab']['2']['mount_dir']) > 0)) ? $config['fstab']['2']['mount_dir'] : ''; ?>">
                <input name="config[fstab][3][mount_point]" type="hidden" id="config[fstab][3][mount_point]" value="<?php echo (isset($config['fstab']['3']['mount_point']) && (strlen($config['fstab']['3']['mount_point']) > 0)) ? $config['fstab']['3']['mount_point'] : ''; ?>">
                <input name="config[fstab][3][mount_dir]" type="hidden" id="config[fstab][3][mount_dir]" value="<?php echo (isset($config['fstab']['3']['mount_dir']) && (strlen($config['fstab']['3']['mount_dir']) > 0)) ? $config['fstab']['3']['mount_dir'] : ''; ?>">
                <input name="config[fstab][4][mount_point]" type="hidden" id="config[fstab][4][mount_point]" value="<?php echo (isset($config['fstab']['4']['mount_point']) && (strlen($config['fstab']['4']['mount_point']) > 0)) ? $config['fstab']['4']['mount_point'] : ''; ?>">
                <input name="config[fstab][4][mount_dir]" type="hidden" id="config[fstab][4][mount_dir]" value="<?php echo (isset($config['fstab']['4']['mount_dir']) && (strlen($config['fstab']['4']['mount_dir']) > 0)) ? $config['fstab']['4']['mount_dir'] : ''; ?>">
                <input name="config[is_homedir]" type="hidden" id="config[is_homedir]" value="<?php echo (isset($config['is_homedir']) && (strlen($config['is_homedir']) > 0)) ? $config['is_homedir'] : '-1'; ?>">
              </font><?php echo $lang['install']['task']; ?></i></b></td>
              <td width="20%" valign="top"><b><i><?php echo $lang['install']['status']; ?></i></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo sprintf($lang['install']['read_template'], 'libs/settings.lib.php'); ?></td>
              <td align="left"><b><font color="<?php echo ($read_settings) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($read_settings) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo sprintf($lang['install']['write_file'], 'libs/settings.lib.php'); ?></td>
              <td align="left"><b><font color="<?php echo ($write_settings) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($write_settings) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo sprintf($lang['install']['read_template'], 'files/config.php'); ?></td>
              <td align="left"><b><font color="<?php echo ($read_config) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($read_config) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo sprintf($lang['install']['write_file'], 'files/config.php'); ?></td>
              <td align="left"><b><font color="<?php echo ($write_config) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($write_config) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo $lang['install']['template_structure']; ?></td>
              <td align="left"><b><font color="<?php echo ($read_sql) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($read_sql) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo $lang['install']['create_structure']; ?></td>
              <td align="left"><b><font color="<?php echo ($create_tables) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($create_tables) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo $lang['install']['template_data']; ?></td>
              <td align="left"><b><font color="<?php echo ($read_data_sql) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($read_data_sql) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td align="left"><?php echo $lang['install']['load_data']; ?></td>
              <td align="left"><b><font color="<?php echo ($load_data) ? '#00FF00' : '#FF0000'; ?>"><?php echo ($load_data) ? $lang['install']['done'] : $lang['install']['failed']; ?></font></b></td>
            </tr>
            <tr>
              <td colspan="3"><hr width="100%" color="#003366" /></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo sprintf($lang['install']['download_file'], 'libs/settings.lib.php', 'JavaScript: document.wizard.action="download_settings.php"; document.wizard.submit();'); ?></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo sprintf($lang['install']['download_file'], 'files/config.php', 'JavaScript: document.wizard.action="download_config.php"; document.wizard.submit();'); ?></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo sprintf($lang['install']['download_file'], 'bfexplorer.sql', 'JavaScript: document.wizard.action="download_sql.php"; document.wizard.submit();'); ?></td>
            </tr>
            <tr>
              <td colspan="3"><hr width="100%" color="#003366" /></td>
            </tr>
            <tr>
              <td colspan="3"><font color="#FF0000"><?php echo $lang['install']['warning']; ?></font></td>
            </tr>
            <tr>
              <td colspan="3"><hr width="100%" color="#003366" /></td>
            </tr>
            <tr>
              <td colspan="2" align="right"><input name="Finish" type="button" id="Finish" value="<?php echo $lang['install']['finish']; ?>" class="boton" onClick="JavaScript: document.location.href='../index.php';"></td>
            </tr>
          </table>
        </form></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr height="4">
      <td background="../images/borders/left_bottomCorner.jpg"></td>
      <td background="../images/borders/bottomBorder.jpg"></td>
      <td background="../images/borders/right_bottomCorner.jpg"></td>
    </tr>
  </table>
</div>
</body>
</html>
