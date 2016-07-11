<?php
  include('globals.inc.php');

  $Session["config"]["files"]["use_frames"] = FALSE;
  
  if ($Session["config"]["files"]["current_dir"] == "") {
    $backdir = "";
    $back = ".";
  } else {
    $backdir = $Session["config"]["files"]["current_dir"];
    $backdir = str_replace(" ", "%20", $backdir);
    $back = dirname($backdir);
  }

  if ($back != '.') {
	$link = "files_nf.php?current_dir=$back";
  } else {
    $link = "files_nf.php?current_dir=";
  }

  if ((isset($_GET['accion'])) && ($_GET['accion'] == 'up_dir')) {
	header("Location: " . $link);
	die();
  }

  $current_dir = getFullPath($Session["config"]["files"]["current_dir"]);

  if(!file_exists($current_dir) || !is_dir($current_dir)) {
    $Session["files"]["message"] = sprintf($lang['files']['dir_doesnt_exists'], "/" . slash_delete($Session["config"]["files"]["current_dir"]));
    header("Location: files_nf.php?current_dir=");
	die();
  }

  $list = file_list($Session["config"]["files"]["current_dir"]);

  $files = $list['files'];
  $dirs = $list['dirs'];
  
  $files_number = count($files);
  $dirs_number = count($dirs);
  $files_size = $list['files_size'];
  
  //We calculate the total and free space in the disk
  $total_space = disk_total_space(getFullPath($Session["config"]["files"]["current_dir"]));
  $free_space = disk_free_space(getFullPath($Session["config"]["files"]["current_dir"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/toolbar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script language="javascript" src="../libs/modal.js"></script>
<script language="JavaScript">
<!--
function findObj(n, d) {
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function SetChecked(val) {
  dml = window.document.form;
  len = dml.elements.length;
  var i = 0;
  for(i = 0; i < len; i++) {
    if ((dml.elements[i].name == 'files[]') || (dml.elements[i].name == 'dirs[]')) {
      dml.elements[i].checked = val;
    }
  }
}

function copy_files(accion) {
  findObj('accion').value = accion;
  findObj('form').action = 'copy/index.php';
  window.document.form.submit();
}

function open_compdialog() {
  dml = window.document.form;
  len = dml.elements.length;
  var i = 0;
  var j = 0;
  var name = "";
  for (i = 0; i < len; i++) 
    if (dml.elements[i].checked) {
      j++;
      if (dml.elements[i].name == 'dirs[]') {
        name = dml.elements[i].value;
      } else {
        name = (dml.elements[i].value.substring(0, dml.elements[i].value.lastIndexOf(".")));
      }
    }

  if (j == 0) {
    alert('<?php echo $lang['files']['not_selected']; ?>');
    return false;
  } else if (j == 1) {
    compName = name;
  } else {
    compName = (findObj('current_dir').value.substring(findObj('current_dir').value.lastIndexOf(".")));
  }

  showDialog('<?php echo $lang['files']['compress']['compression_options']; ?>', 'comp_dialog', 'compress/dialog.php?compName=' + escape(compName) + '&compType=tar', 400, 180, compress_files);
  return true;
}

function compress_files(params) {
  findObj('accion').value = "compress";
  findObj('form').action = 'compress/index.php' + params;
  window.document.form.submit();
}

function open_downloadcompdialog() {
  dml = window.document.form;
  len = dml.elements.length;
  var i = 0;
  var j = 0;
  var name = "";
  for (i = 0; i < len; i++) 
    if (dml.elements[i].checked) {
      j++;
      if (dml.elements[i].name == 'dirs[]') {
        name = dml.elements[i].value;
      } else {
        name = (dml.elements[i].value.substring(0, dml.elements[i].value.lastIndexOf(".")));
      }
    }

  if (j == 0) {
    alert('<?php echo $lang['files']['not_selected']; ?>');
    return false;
  } else if (j == 1) {
    compName = name;
  } else {
    compName = (findObj('current_dir').value.substring(findObj('current_dir').value.lastIndexOf(".")));
  }

  showDialog('<?php echo $lang['files']['compress']['compression_options']; ?>', 'comp_dialog', 'download_compfile/dialog.php?compName=' + escape(compName) + '&compType=tar', 400, 160, download_compfile);
  return true;
}

function download_compfile(params) {
  findObj('accion').value = "download_compfile";
  findObj('form').action = 'download_compfile/index.php' + params;
  window.document.form.submit();
}

function delete_files() {
  findObj('accion').value = "delete";
  findObj('form').action = 'delete/index.php';
  window.document.form.submit();
}

function set_permissions() {
  findObj('accion').value = "permissions";
  findObj('form').action = 'permissions/index.php';
  window.document.form.submit();
}

function rename_file(){
  dml = window.document.form;
  len = dml.elements.length;
  var i = 0;
  for (i = 0; i < len; i++) {
    if (dml.elements[i].checked) {
      if (dml.elements[i].name == 'dirs[]') {
        var oldName = dml.elements[i].value;
        var newName = prompt("<?php echo $lang['files']['new_name_dir']; ?>:", oldName);
        if ((newName != "") && (newName != null)) {
          window.document.location.href = "chgdirname/index.php?accion=changename&oldname=" + oldName + "&newname=" + newName;
          return true;
        } else {
          return false;
		}
	  }
      if (dml.elements[i].name == 'files[]') {
        var oldName = dml.elements[i].value;
		oldName = oldName.substr(oldName.lastIndexOf('/') + 1);
        var newName = prompt("<?php echo $lang['files']['new_name_file']; ?>:", oldName);
        if ((newName != "") && (newName != null)) {
          window.document.location.href = "chgfilename/index.php?accion=changename&oldname=" + oldName + "&newname=" + newName;
          return true;
        } else {
          return false;
        }
      }
    }
  }
  alert('<?php echo $lang['files']['not_selected']; ?>');
  return false
}

function properties() {
  findObj('accion').value = "properties";
  findObj('form').action = 'properties/index.php';
  window.document.form.submit();
}

function shell_cmd() {
  findObj('accion').value = "shell_cmd";
  findObj('form').action = 'shell/index.php';
  window.document.form.submit();
}

function newDir() {
  var dirName = prompt("<?php echo $lang['files']['new_dir_name']; ?>:", "<?php echo $lang['files']['new_dir_suggested_name']; ?>");
  if ((dirName != "") && (dirName != null)) {
    window.document.location.href = "newdir/index.php?accion=newdir&dirname=" + dirName;
  }
}

function newFile() {
  var fileName = prompt("<?php echo $lang['files']['new_file_name']; ?>:", "<?php echo $lang['files']['new_file_suggested_name']; ?>");
  if ((fileName != "") && (fileName != null)) {
    window.document.location.href = "newfile/index.php?accion=newfile&filename=" + fileName;
  }
}

function upload() {
  findObj('accion').value = "upload";
  findObj('form').action = 'upload/index.php';
  window.document.form.submit();
}
//-->
</script>
<title><?php echo $lang['all']['bfexplorer']; ?>-<?php echo $lang['files']['listing_files']; ?></title>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body>
<form method="POST" enctype="multipart/form-data" name="form" id="form">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="accion" type="hidden" id="accion" value="none">
  <input name="current_dir" type="hidden" id="current_dir" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>">
  <input name="dirs[]" type="hidden" id="dirs[]" value="DATA">
  <input name="files[]" type="hidden" id="files[]" value="DATA">
  <table border="0" height="12" width="100%" cellspacing="0" cellpadding="3">
    <?php if (isset($Session["files"]["message"])) { ?>
      <tr>
        <td colspan="10" align="center" class="body"><strong><font color="#FF0000"><?php echo $Session["files"]["message"]; unset ($Session["files"]["message"]); ?> </font></strong></td>
      </tr>
      <?php } ?>
    <tr>
      <td class="head" colspan="10"><table width="100%" class="TB_Toolbar">
          <tr class="TB_ToolbarSet">
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="JavaScript:window.document.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?current_dir=';" href="#"><img src="../images/toolbar/tb_home.gif" alt="<?php echo $lang['files']['home_dir']; ?>" title="<?php echo $lang['files']['home_dir']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="JavaScript:window.document.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?current_dir=<?php echo $Session["config"]["files"]["current_dir"]; ?>';" href="#"><img src="../images/toolbar/tb_refresh.gif" alt="<?php echo $lang['files']['refresh']; ?>" title="<?php echo $lang['files']['refresh']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="JavaScript:window.document.location.href = '<?php echo $link; ?>';" href="#"><img src="../images/toolbar/tb_godirup.gif" alt="<?php echo $lang['files']['upper_dir']; ?>" title="<?php echo $lang['files']['upper_dir']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: window.document.location.href = 'search.php';" href="#"><img src="../images/toolbar/tb_search.gif" alt="<?php echo $lang['files']['show_search']; ?>" title="<?php echo $lang['files']['show_search']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: copy_files('copy');" href="#"><img src="../images/toolbar/tb_copy.gif" alt="<?php echo $lang['files']['copy_sel']; ?>" title="<?php echo $lang['files']['copy_sel']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: copy_files('move');" href="#"><img src="../images/toolbar/tb_move.gif" alt="<?php echo $lang['files']['move_sel']; ?>" title="<?php echo $lang['files']['move_sel']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: delete_files();" href="#"><img src="../images/toolbar/tb_delete.gif" alt="<?php echo $lang['files']['delete_sel']; ?>" title="<?php echo $lang['files']['delete_sel']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: open_downloadcompdialog();" href="#"><img src="../images/toolbar/tb_comp_download.gif" alt="<?php echo $lang['files']['download_comp_sel']; ?>" title="<?php echo $lang['files']['download_comp_sel']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: open_compdialog();" href="#"><img src="../images/toolbar/tb_compress.gif" alt="<?php echo $lang['files']['comp_sel']; ?>" title="<?php echo $lang['files']['comp_sel']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: set_permissions();" href="#"><img src="../images/toolbar/tb_permissions.gif" alt="<?php echo $lang['files']['set_permissions']; ?>" title="<?php echo $lang['files']['set_permissions']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: rename_file();" href="#"><img src="../images/toolbar/tb_rename.gif" alt="<?php echo $lang['files']['rename']; ?>" title="<?php echo $lang['files']['rename']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: properties();" href="#"><img src="../images/toolbar/tb_properties.gif" alt="<?php echo $lang['files']['see_properties']; ?>" title="<?php echo $lang['files']['see_properties']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: shell_cmd();" href="#"><img src="../images/toolbar/tb_shell.gif" alt="<?php echo $lang['files']['shell_cmd']; ?>" title="<?php echo $lang['files']['shell_cmd']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: newDir();" href="#"><img src="../images/toolbar/tb_newdir.gif" alt="<?php echo $lang['files']['new_dir']; ?>" title="<?php echo $lang['files']['new_dir']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: newFile();" href="#"><img src="../images/toolbar/tb_newfile.gif" alt="<?php echo $lang['files']['new_file']; ?>" title="<?php echo $lang['files']['new_file']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: window.document.location.href = 'index.php';" href="#"><img src="../images/toolbar/tb_frame.gif" alt="<?php echo $lang['files']['frames']; ?>" title="<?php echo $lang['files']['frames']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_Start"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: window.document.location.href = '../passwd/index.php';" href="#"><img src="../images/toolbar/tb_password.gif" alt="<?php echo $lang['passwd']['change_pwd']; ?>" title="<?php echo $lang['passwd']['change_pwd']; ?>" width="16" height="16" border="0" /></a></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: window.document.location.href = '../cpanel/index.php';" href="#"><img src="../images/toolbar/tb_config.gif" alt="<?php echo $lang['all']['control_panel']; ?>" title="<?php echo $lang['all']['control_panel']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_End"></td>
            <td class="TB_Background"></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a href="../logout.php" target="_parent"><img src="../images/toolbar/tb_close.gif" alt="<?php echo $lang['all']['system_logout']; ?>" title="<?php echo $lang['all']['system_logout']; ?>" width="16" height="16" border="0" /></a></td>
          </tr>
          <tr class="TB_ToolbarSet">
            <td valign="middle" class="TB_Start"></td>
            <td valign="middle" colspan="24" class="TB_Button_Off"><input name="dirs_list" type="text" class="TB_Input" id="dirs_list" style="width:100%;" value="/<?php echo $Session["config"]["files"]["current_dir"]; ?>" /></td>
            <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="Javascript: window.document.location.href = 'files_nf.php?current_dir='+findObj('dirs_list').value.substring(1);" href="#"><img src="../images/toolbar/tb_go.gif" alt="<?php echo $lang['files']['go']; ?>" title="<?php echo $lang['files']['go']; ?>" width="16" height="16" border="0" /></a></td>
            <td class="TB_End"></td>
            <td colspan="2" class="TB_Background"></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td class="head" width="10"><input name="check" type="checkbox" id="check" value="1" onclick="JavaScript:SetChecked(this.checked);" /></td>
      <td class="head" align="left"><b><?php echo $lang['files']['name']; ?></b></td>
      <td class="head" align="right"><b><?php echo $lang['files']['size']; ?></b></td>
      <td class="head" align="left"><b><?php echo $lang['files']['type']; ?></b></td>
      <td class="head" align="left"><b><?php echo $lang['files']['last_accessed']; ?></b></td>
      <td class="head" align="left"><b><?php echo $lang['files']['last_modified']; ?></b></td>
      <td class="head" align="right"><b><?php echo $lang['files']['permissions'] ?></b></td>
      <td class="head" colspan="3" align="center"><b><?php echo $lang['all']['actions']; ?></b></td>
    </tr>
    <?php if (count($dirs) > 0) { ?>
    <?php while (list($k, $v) = each($dirs)) { ?>
    <tr>
      <td class="body"><a name="<?php echo $v["name"]; ?>"></a>
        <input name="dirs[]" type=checkbox id="dirs[]" value="<?php echo $v["name"]; ?>"></td>
      <td class="body" align="left"><a title="<?php echo $v["title"]; ?>" href="<?php echo $v["link"]; ?>"><img src="../images/folder.png" width="16" height="15" border="0" />&nbsp;<?php echo $v["small_name"]; ?></a> </td>
      <td class="body" align="right"><?php echo $v["size"]; ?></td>
      <td class="body" align="left"><?php echo $v["type"] ?></td>
      <td class="body" align="left"><?php echo date($date_format, $v["last_accessed"]); ?></td>
      <td class="body" align="left"><?php echo date($date_format, $v["last_modified"]); ?></td>
      <td class="body" align="right"><?php echo 'd' . $v["permissions"]; ?></td>
      <td class="body" align="center" colspan="3">&nbsp;</td>
    </tr>
    <?php } ?>
    <?php } ?>
    <?php if (count($files) > 0) { ?>
    <?php while (list($k, $v) = each($files)) { ?>
    <tr>
      <td class="body"><a name="<?php echo  $v["name"]; ?>"></a>
        <input  name="files[]" type="checkbox" id="files[]" value="<?php echo $v["name"]; ?>"></td>
      <td class="body" align="left"><a title="<?php echo  $v["title"]; ?>" href="<?php echo (can_view($v["ext"])) ? "view" : "download"; ?>/index.php?accion=<?php echo (can_view($v["ext"])) ? "view_file" : "download_file"; ?>&filename=<?php echo urlencode($v["name"]); ?>"> <font color="<?php echo $v["color"]; ?>"><img src="../icons/<?php echo mime(strtolower($v["ext"])); ?>" width="16" height="16" border="0" />&nbsp;<?php echo $v["small_name"]; ?></font> </a></td>
      <td class="body" align="right"><?php echo $v["size"]; ?></td>
      <td class="body" align="left"><?php echo $v["type"]; ?></td>
      <td class="body" align="left"><?php echo date($date_format, $v["last_accessed"]); ?></td>
      <td class="body" align="left"><?php echo date($date_format, $v["last_modified"]); ?></td>
      <td class="body" align="right"><?php echo $v["permissions"]; ?></td>
      <td class="body" align="right" width="3%"><?php if (can_view($v["ext"])) { ?>
        <a title="<?php echo $lang['files']['view_file']; ?>" href="view/index.php?accion=view_file&filename=<?php echo urlencode($v["name"]); ?>"><img src="../images/toolbar/tb_viewfile.gif" alt="<?php echo $lang['files']['view_file']; ?>" title="<?php echo $lang['files']['view_file']; ?>" width="16" height="16" border="0" /></a>
        <?php } else { ?>
        &nbsp;
        <?php } ?></td>
      <td class="body" align="center" width="3%"><?php if (can_edit($v["ext"])) { ?>
        <a title="<?php echo $lang['files']['edit_file']; ?>" href="edit/index.php?accion=edit_file&filename=<?php echo urlencode($v["name"]); ?>"><img src="../images/toolbar/tb_editfile.gif" alt="<?php echo $lang['files']['edit_file']; ?>" title="<?php echo $lang['files']['edit_file']; ?>" width="16" height="16" border="0" /></a>
        <?php } else { ?>
        &nbsp;
        <?php } ?></td>
      <td class="body" align="left" width="3%"><a title="<?php echo $lang['files']['download_file']; ?>" href="download/index.php?accion=download_file&filename=<?php echo urlencode($v["name"]); ?>"><img src="../images/toolbar/tb_download.gif" alt="<?php echo $lang['files']['download_file']; ?>" title="<?php echo $lang['files']['download_file']; ?>" width="16" height="16" border="0" /></a></td>
    </tr>
    <?php } ?>
    <?php } ?>
  </table>
</form>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td align="center" class="head"><b><?php echo sprintf("%s v%s. &copy;Copyright 2006. <a href=\"http://www.bytesfall.com\" target=\"_blank\">BytesFall Solutions</a>", $lang['all']['bfexplorer'], $version); ?></b></td>
    <td align="center" class="head"><b><?php echo sprintf($lang['files']['resume1'], $dirs_number, $files_number, format_size($files_size)); ?></b></td>
    <td align="center" class="head"><b><?php echo sprintf($lang['files']['resume2'], format_size($total_space)); ?></b></td>
    <td align="center" class="head"><b><?php echo sprintf($lang['files']['resume3'], format_size($free_space), floor($free_space*100/$total_space)); ?></b></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="head" colspan="10"><table width="100%">
        <tr class="TB_ToolbarSet">
          <td class="TB_Start"></td>
          <td class="TB_Background"><input name="file0" type="file" id="file0" class="TB_Input" style="width:100%;" /></td>
          <td class="TB_Background"><input name="file1" type="file" id="file1" class="TB_Input" style="width:100%;" /></td>
          <td class="TB_Background"><input name="file2" type="file" id="file2" class="TB_Input" style="width:100%;" /></td>
          <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="JavaScript: window.document.upload.submit();" href="#"><img src="../images/toolbar/tb_upload.gif" alt="<?php echo $lang['files']['upload']; ?>" title="<?php echo $lang['files']['upload']; ?>" width="16" height="16" border="0" /></a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
