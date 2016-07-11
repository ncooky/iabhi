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
  
  $current_step = 3;
  $total_steps = 4;
?>
<html>
<head>
<title><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['fileman_configuration']; ?> - <?php echo sprintf($lang['install']['install_wizard'], $current_step, $total_steps); ?></title>
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
      <th align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['fileman_configuration']; ?></th>
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
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="center" valign="middle">&nbsp;</td>
      <td background="../images/borders/rightBorder.jpg"></td>
    </tr>
    <tr>
      <td background="../images/borders/leftBorder.jpg"></td>
      <td align="left" valign="middle"><form action="confirm.php" method="POST" name="wizard" id="wizard">
          <table width="100%"  border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td colspan="3"><b><i><?php echo $lang['install']['config_filesystem']; ?>:</i></b></td>
            </tr>
            <tr>
              <td width="25%" valign="top" align="left"><input name="accion" type="hidden" id="accion" value="install">
                <input name="config[language]" type="hidden" id="config[language]" value="<?php echo (isset($config['language']) && (strlen($config['language']) > 0)) ? $config['language'] : 'en'; ?>">

                <input name="config[dbserver]" type="hidden" id="config[dbserver]" value="<?php echo (isset($config['dbserver']) && (strlen($config['dbserver']) > 0)) ? $config['dbserver'] : ''; ?>">
                <input name="config[db_host]" type="hidden" id="config[db_host]" value="<?php echo (isset($config['db_host']) && (strlen($config['db_host']) > 0)) ? $config['db_host'] : 'localhost'; ?>">
                <input name="config[db_user]" type="hidden" id="config[db_user]" value="<?php echo (isset($config['db_user']) && (strlen($config['db_user']) > 0)) ? $config['db_user'] : ''; ?>">
                <input name="config[db_password]" type="hidden" id="config[db_password]" value="<?php echo (isset($config['db_password']) && (strlen($config['db_password']) > 0)) ? $config['db_password'] : ''; ?>">
                <input name="config[db_name]" type="hidden" id="config[db_name]" value="<?php echo (isset($config['db_name']) && (strlen($config['db_name']) > 0)) ? $config['db_name'] : ''; ?>">
                <input name="config[tables_preffix]" type="hidden" id="config[tables_preffix]" value="<?php echo (isset($config['tables_preffix']) && (strlen($config['tables_preffix']) > 0)) ? $config['tables_preffix'] : 'bfe_'; ?>">
                <!--<input name="config[create_db]" type="hidden" id="config[create_db]" value="<?php echo (isset($config['create_db']) && (strlen($config['create_db']) > 0)) ? $config['create_db'] : '1'; ?>">-->
                <input name="config[create_tables]" type="hidden" id="config[create_tables]" value="<?php echo (isset($config['create_tables']) && (strlen($config['create_tables']) > 0)) ? $config['create_tables'] : '0'; ?>">
                <i><?php echo $lang['install']['mount_point']; ?></i></td>
              <td width="70%" valign="top"><i><?php echo $lang['install']['mount_dir']; ?></i></td>
              <td width="5%" valign="top"><i><?php echo $lang['install']['is_homedir']; ?></i></td>
            </tr>
            <tr>
              <td align="left"><input name="config[fstab][0][mount_point]" type="hidden" id="config[fstab][0][mount_point]" value="/">
              /</td>
              <td align="left"><input name="config[fstab][0][mount_dir]" type="text" class="input" id="config[fstab][0][mount_dir]" value="<?php echo (isset($config['fstab']['0']['mount_dir']) && (strlen($config['fstab']['0']['mount_dir']) > 0)) ? $config['fstab']['0']['mount_dir'] : $_SERVER['DOCUMENT_ROOT']; ?>"></td>
              <td align="center"><input name="config[is_homedir]" type="radio" class="check" value="0"<?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == '0')) ? " checked" : ""; ?>></td>
            </tr>
            <tr>
              <td align="left">/<input name="config[fstab][1][mount_point]" type="text" class="input" style="width: 80%; " id="config[fstab][1][mount_point]" value="<?php echo (isset($config['fstab']['1']['mount_point']) && (strlen($config['fstab']['1']['mount_point']) > 0)) ? $config['fstab']['1']['mount_point'] : ''; ?>"></td>
              <td align="left"><input name="config[fstab][1][mount_dir]" type="text" class="input" id="config[fstab][1][mount_dir]" value="<?php echo (isset($config['fstab']['1']['mount_dir']) && (strlen($config['fstab']['1']['mount_dir']) > 0)) ? $config['fstab']['1']['mount_dir'] : ''; ?>"></td>
              <td align="center"><input name="config[is_homedir]" type="radio" class="check" value="1"<?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == '1')) ? " checked" : ""; ?>></td>
            </tr>
            <tr>
              <td align="left">/<input name="config[fstab][2][mount_point]" type="text" class="input" style="width: 80%; " id="config[fstab][2][mount_point]" value="<?php echo (isset($config['fstab']['2']['mount_point']) && (strlen($config['fstab']['2']['mount_point']) > 0)) ? $config['fstab']['2']['mount_point'] : ''; ?>"></td>
              <td align="left"><input name="config[fstab][2][mount_dir]" type="text" class="input" id="config[fstab][2][mount_dir]" value="<?php echo (isset($config['fstab']['2']['mount_dir']) && (strlen($config['fstab']['2']['mount_dir']) > 0)) ? $config['fstab']['2']['mount_dir'] : ''; ?>"></td>
              <td align="center"><input name="config[is_homedir]" type="radio" class="check" value="2"<?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == '2')) ? " checked" : ""; ?>></td>
            </tr>
            <tr>
              <td align="left">/<input name="config[fstab][3][mount_point]" type="text" class="input" style="width: 80%; " id="config[fstab][3][mount_point]" value="<?php echo (isset($config['fstab']['3']['mount_point']) && (strlen($config['fstab']['3']['mount_point']) > 0)) ? $config['fstab']['3']['mount_point'] : ''; ?>"></td>
              <td align="left"><input name="config[fstab][3][mount_dir]" type="text" class="input" id="config[fstab][3][mount_dir]" value="<?php echo (isset($config['fstab']['3']['mount_dir']) && (strlen($config['fstab']['3']['mount_dir']) > 0)) ? $config['fstab']['3']['mount_dir'] : ''; ?>"></td>
              <td align="center"><input name="config[is_homedir]" type="radio" class="check" value="3"<?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == '3')) ? " checked" : ""; ?>></td>
            </tr>
            <tr>
              <td align="left">/<input name="config[fstab][4][mount_point]" type="text" class="input" style="width: 80%; " id="config[fstab][4][mount_point]" value="<?php echo (isset($config['fstab']['4']['mount_point']) && (strlen($config['fstab']['4']['mount_point']) > 0)) ? $config['fstab']['4']['mount_point'] : ''; ?>"></td>
              <td align="left"><input name="config[fstab][4][mount_dir]" type="text" class="input" id="config[fstab][4][mount_dir]" value="<?php echo (isset($config['fstab']['4']['mount_dir']) && (strlen($config['fstab']['4']['mount_dir']) > 0)) ? $config['fstab']['4']['mount_dir'] : ''; ?>"></td>
              <td align="center"><input name="config[is_homedir]" type="radio" class="check" value="4"<?php echo (isset($config['is_homedir']) && ($config['is_homedir'] == '4')) ? " checked" : ""; ?>></td>
            </tr>
            <td colspan="3" align="right"><input name="Previuos" type="button" id="Previuos" value="<?php echo $lang['install']['previous']; ?>" class="boton" onClick="JavaScript: document.wizard.action='wizard2.php'; document.wizard.submit();">
                <input name="Next" type="submit" id="Next" value="<?php echo $lang['install']['next']; ?>" class="boton">
                <input name="Install" type="button" id="Install" disabled="disabled" value="<?php echo $lang['install']['install']; ?>" class="botondisabled"></td>
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
