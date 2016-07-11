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
  
  $current_step = 2;
  $total_steps = 4;
?>
<html>
<head>
<title><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['database_configuration']; ?> - <?php echo sprintf($lang['install']['install_wizard'], $current_step, $total_steps); ?></title>
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
      <th align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['install']['bfexplorer']; ?> - <?php echo $lang['install']['database_configuration']; ?></th>
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
      <td align="left" valign="middle"><form action="wizard3.php" method="POST" name="wizard" id="wizard">
          <table width="100%"  border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td><b><i><?php echo $lang['install']['dbserver']; ?>:</i></b></td>
            </tr>
            <tr>
              <td><input name="accion" type="hidden" id="accion" value="install">
                <input name="config[language]" type="hidden" id="config[language]" value="<?php echo (isset($config['language']) && (strlen($config['language']) > 0)) ? $config['language'] : 'en'; ?>">

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

                <select name="config[dbserver]" class="select" id="config[dbserver]">
                  <option value=""><?php echo $lang['install']['select_dbserver']; ?>...</option>
                  <option value="mysql"<?php echo (isset($config['dbserver']) && (file_exists(sprintf("db/%s.lib.php", $config['dbserver']))) && ($config['dbserver'] == 'mysql')) ? " SELECTED" : ""; ?>>MySQL</option>
                  <option value="pgsql"<?php echo (isset($config['dbserver']) && (file_exists(sprintf("db/%s.lib.php", $config['dbserver']))) && ($config['dbserver'] == 'pgsql')) ? " SELECTED" : ""; ?>>PostgreSQL</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><b><i><?php echo $lang['install']['server_name']; ?>:</i></b></td>
            </tr>
            <tr>
              <td><input name="config[db_host]" type="text" class="input" id="config[db_host]" value="<?php echo (isset($config['db_host']) && (strlen($config['db_host']) > 0)) ? $config['db_host'] : 'localhost'; ?>"></td>
            </tr>
            <tr>
              <td><b><i><?php echo $lang['install']['user_name']; ?>:</i></b></td>
            </tr>
            <tr>
              <td><input name="config[db_user]" type="text" class="input" id="config[db_user]" value="<?php echo (isset($config['db_user']) && (strlen($config['db_user']) > 0)) ? $config['db_user'] : ''; ?>"></td>
            </tr>
            <tr>
              <td><b><i><?php echo $lang['install']['password']; ?>:</i></b></td>
            </tr>
            <tr>
              <td><input name="config[db_password]" type="password" class="input" id="config[db_password]" value="<?php echo (isset($config['db_password']) && (strlen($config['db_password']) > 0)) ? $config['db_password'] : ''; ?>"></td>
            </tr>
            <tr>
              <td><b><i><?php echo $lang['install']['db_name']; ?>:</i></b></td>
            </tr>
            <tr>
              <td><input name="config[db_name]" type="text" class="input" id="config[db_name]" value="<?php echo (isset($config['db_name']) && (strlen($config['db_name']) > 0)) ? $config['db_name'] : ''; ?>"></td>
            </tr>
            <tr>
              <td><b><i><?php echo $lang['install']['tables_preffix']; ?>:</i></b></td>
            </tr>
            <tr>
              <td><input name="config[tables_preffix]" type="text" class="input" id="config[tables_preffix]" value="<?php echo (isset($config['tables_preffix']) && (strlen($config['tables_preffix']) > 0)) ? $config['tables_preffix'] : 'bfe_'; ?>"></td>
            </tr>
            <tr>
              <td><b><i><?php echo $lang['install']['options']; ?>:</i></b></td>
            </tr>
			<!--
            <tr>
              <td><input name="config[create_db]" type="checkbox" class="check" id="config[create_db]" value="1"<?php echo (isset($config['create_db']) && ($config['create_db'] == '1')) ? " checked" : ""; ?><?php if (!isset($config['create_db'])) {echo " checked";} ?>>&nbsp;<?php echo $lang['install']['create_db']; ?></td>
            </tr>
			-->
            <tr>
              <td><input name="config[create_tables]" type="checkbox" class="check" id="config[create_tables]" value="1"<?php echo (isset($config['create_tables']) && ($config['create_tables'] == '1')) ? " checked" : ""; ?><?php if (!isset($config['create_tables'])) {echo " checked";} ?>>&nbsp;<?php echo $lang['install']['create_tables']; ?></td>
            </tr>
            <td align="right"><input name="Previuos" type="button" id="Previuos" value="<?php echo $lang['install']['previous']; ?>" class="boton" onClick="JavaScript: document.wizard.action='index.php'; document.wizard.submit();">
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
