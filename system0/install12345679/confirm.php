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
  
  $include = (isset($config['language']) && (strlen($config['language']) > 0) && (file_exists(sprintf("lang/lang.%s.php", $config['language'])))) ? sprintf("lang/lang.%s.php", $config['language']) : 'lang/lang.en.php';

  include($include);

  $message = "";
  $errors = 0;
  if ($config['language'] == '') { 
    //Language not selected
    $message .= "<li>" . $lang['install']['language'] . "</li>\r\n"; 	
    $errors = 1;
  }
  if ($config['dbserver'] == '') { 
    //DB server not selected
    $message .= "<li>" . $lang['install']['dbserver'] . "</li>\r\n"; 	
    $errors = 1;
  }
  if ($config['db_host'] == '') { 
    //Server name not written
    $message .= "<li>" . $lang['install']['server_name'] . "</li>\r\n"; 	
    $errors = 1;
  }
  if ($config['db_user'] == '') { 
    //User name not written
    $message .= "<li>" . $lang['install']['user_name'] . "</li>\r\n"; 	
    $errors = 1;
  }
  if ($config['db_name'] == '') { 
    //DB name not written
    $message .= "<li>" . $lang['install']['db_name'] . "</li>\r\n"; 	
    $errors = 1;
  }
  if (($config['fstab']['0']['mount_dir'] == '') || (!is_dir($config['fstab']['0']['mount_dir'])) || (!file_exists($config['fstab']['0']['mount_dir']))) { 
    //DB name not written
    $message .= "<li>" . $lang['install']['mount_dir'] . "</li>\r\n"; 	
    $errors = 1;
  }
  
  $current_step = 4;
  $total_steps = 4;
  
  $db_ar = array( '' => '-',
                  'mysql' => 'MySQL',
                  'pgsql' => 'PostgreSQL'
  );
?>
<html>
<head>
<title><?php echo $lang['install']['bfexplorer']; ?>-<?php echo $lang['install']['confirm']; ?>-<?php echo sprintf($lang['install']['install_wizard'], $current_step, $total_steps); ?></title>
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
      <th align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['confirm']; ?></th>
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
            <td><font size="+1"><?php echo sprintf($lang['install']['install_wizard'], $current_step, $total_steps); ?></font></td>
          </tr>
        </table></td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <?php if ($errors == 1) { ?>
      <tr>
        <td background="../images/borders/leftBorder.jpg"></td>
        <td align="left" valign="middle"><strong><font color="#FF0000"><?php echo $lang['install']['fields_incompletes']; ?>:
          <ul>
            <?php echo $message; ?>
          </ul>
          </font></strong></td>
        <td background="../images/borders/rightBorder.jpg"></td>
      </tr>
      <?php } ?>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="left" valign="middle"><form action="generate.php" method="POST" name="wizard" id="wizard">
          <table width="100%"  border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['language']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><input name="accion" type="hidden" id="accion" value="install">
                <input name="config[language]" type="hidden" id="config[language]" value="<?php echo (isset($config['language']) && (strlen($config['language']) > 0)) ? $config['language'] : 'en'; ?>">
                <input name="config[dbserver]" type="hidden" id="config[dbserver]" value="<?php echo (isset($config['dbserver']) && (strlen($config['dbserver']) > 0)) ? $config['dbserver'] : ''; ?>">
                <input name="config[db_host]" type="hidden" id="config[db_host]" value="<?php echo (isset($config['db_host']) && (strlen($config['db_host']) > 0)) ? $config['db_host'] : 'localhost'; ?>">
                <input name="config[db_user]" type="hidden" id="config[db_user]" value="<?php echo (isset($config['db_user']) && (strlen($config['db_user']) > 0)) ? $config['db_user'] : ''; ?>">
                <input name="config[db_password]" type="hidden" id="config[db_password]" value="<?php echo (isset($config['db_password']) && (strlen($config['db_password']) > 0)) ? $config['db_password'] : ''; ?>">
                <input name="config[db_name]" type="hidden" id="config[db_name]" value="<?php echo (isset($config['db_name']) && (strlen($config['db_name']) > 0)) ? $config['db_name'] : ''; ?>">
                <input name="config[tables_preffix]" type="hidden" id="config[tables_preffix]" value="<?php echo (isset($config['tables_preffix']) && (strlen($config['tables_preffix']) > 0)) ? $config['tables_preffix'] : 'bfe_'; ?>">
                <!--<input name="config[create_db]" type="hidden" id="config[create_db]" value="<?php echo (isset($config['create_db']) && (strlen($config['create_db']) > 0)) ? $config['create_db'] : '1'; ?>">-->
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
                <?php echo $lang['install']['language_name']; ?> </td>
            </tr>
            <tr>
              <td colspan="3"><hr width="100%" color="#003366" /></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['dbserver']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo $db_ar[$config['dbserver']]; ?></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['server_name']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo $config['db_host']; ?></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['user_name']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo $config['db_user']; ?></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['password']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo str_pad('', strlen($config['db_password']), '*'); ?></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['db_name']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo $config['db_name']; ?></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['tables_preffix']; ?>:</i></b></td>
            </tr>
            <tr>
              <td colspan="3"><?php echo $config['tables_preffix']; ?></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['options']; ?>:</i></b></td>
            </tr>
            <!--
            <tr>
              <td colspan="3"><?php echo $lang['install']['create_db']; ?>: <b><?php echo (isset($config['create_db']) && ($config['create_db'] == '1')) ? $lang['install']['yes'] : $lang['install']['no']; ?></b></td>
            </tr>
			-->
            <tr>
              <td colspan="3"><?php echo $lang['install']['create_tables']; ?>: <b><?php echo (isset($config['create_tables']) && ($config['create_tables'] == '1')) ? $lang['install']['yes'] : $lang['install']['no']; ?></b></td>
            </tr>
            <tr>
              <td colspan="3"><hr width="100%" color="#003366" /></td>
            </tr>
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['config_filesystem']; ?>:</i></b></td>
            </tr>
            <tr>
              <td width="25%" valign="top" align="left"><i><?php echo $lang['install']['mount_point']; ?></i></td>
              <td width="70%" valign="top"><i><?php echo $lang['install']['mount_dir']; ?></i></td>
              <td width="5%" valign="top"><i><?php echo $lang['install']['is_homedir']; ?></i></td>
            </tr>
            <tr>
              <td align="left">/</td>
              <td align="left"><?php echo $config['fstab']['0']['mount_dir']; ?></td>
              <td align="center"><?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == '0')) ? $lang['install']['yes'] : $lang['install']['no']; ?></td>
            </tr>
            <?php for ($i = 1; $i < 5; $i++) { ?>
            <?php if (isset($config['fstab'][$i]['mount_point']) && (strlen($config['fstab'][$i]['mount_point']) > 0) && isset($config['fstab'][$i]['mount_dir']) && (strlen($config['fstab'][$i]['mount_dir']) > 0)) { ?>
              <tr>
                <td align="left">/<?php echo $config['fstab'][$i]['mount_point']; ?></td>
                <td align="left"><?php echo $config['fstab'][$i]['mount_dir']; ?></td>
                <td align="center"><?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == $i)) ? $lang['install']['yes'] : $lang['install']['no']; ?></td>
              </tr>
              <?php } ?>
            <?php } ?>
            <td colspan="3" align="right"><input name="Previuos" type="button" id="Previuos" value="<?php echo $lang['install']['previous']; ?>" class="boton" onClick="JavaScript: document.wizard.action='wizard3.php'; document.wizard.submit();">
                <input name="Next" type="button" id="Next" disabled="disabled" value="<?php echo $lang['install']['next']; ?>" class="botondisabled">
                <input name="Install" type="submit" id="Install"<?php echo ($errors == 1) ? " disabled=\"disabled\"" : ""; ?> value="<?php echo $lang['install']['install']; ?>" class="<?php echo  ($errors == 1) ? "botondisabled" : "boton"; ?>"></td>
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
