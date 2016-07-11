<?php 
  include('globals.inc.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?>-<?php echo $lang['files']['toolbar']; ?></title>
<link href="../css/toolbar.css" rel="stylesheet" type="text/css" />
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

function open_dir(dir2open) {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      parent.frames["Files"].document.location.href = 'files.php?current_dir=' + escape(dir2open);
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function go_dir_up() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      parent.frames["Files"].document.location.href = 'files.php?accion=up_dir';
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function show_left(name) {
  if (name == 'tree') {
    if (findObj('page_name', parent.frames['Tree'].document).value != "tree.php") {
      parent.frames["Tree"].document.location.href = 'tree.php';
	  findObj('btnTree').className='TB_Button_On';
	  findObj('btnSearch').className='TB_Button_Off';
	}
  } else {
    if (findObj('page_name', parent.frames['Tree'].document).value != "search.php") {
      parent.frames["Tree"].document.location.href = 'search.php';
	  findObj('btnSearch').className='TB_Button_On';
	  findObj('btnTree').className='TB_Button_Off';
	}
  }
}

function view_file() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = 'view_file';
      findObj('form', parent.frames["Files"].document).action = 'view/index.php';
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function copy_files(accion) {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = accion;
      findObj('form', parent.frames["Files"].document).action = 'copy/index.php';
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function open_compdialog() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      dml = parent.frames['Files'].document.form;
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
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function compress_files(params) {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = "compress";
      findObj('form', parent.frames["Files"].document).action = 'compress/index.php' + params;
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function open_downloadcompdialog() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      dml = parent.frames['Files'].document.form;
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
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function download_compfile(params) {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = "download_compfile";
      findObj('form', parent.frames["Files"].document).action = 'download_compfile/index.php' + params;
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function delete_files() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = "delete";
      findObj('form', parent.frames["Files"].document).action = 'delete/index.php';
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function set_permissions() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = "permissions";
      findObj('form', parent.frames["Files"].document).action = 'permissions/index.php';
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function rename_file(){
  dml = parent.frames['Files'].document.form;
  len = dml.elements.length;
  var i = 0;
  for (i = 0; i < len; i++) {
    if (dml.elements[i].checked) {
      if (dml.elements[i].name == 'dirs[]') {
        var oldName = dml.elements[i].value;
        var newName = prompt("<?php echo $lang['files']['new_name_dir']; ?>:", oldName);
        if ((newName != "") && (newName != null)) {
          parent.frames["Files"].document.location.href = "chgdirname/index.php?accion=changename&oldname=" + escape(oldName) + "&newname=" + escape(newName);
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
          parent.frames["Files"].document.location.href = "chgfilename/index.php?accion=changename&oldname=" + escape(oldName) + "&newname=" + escape(newName);
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
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = "properties";
      findObj('form', parent.frames["Files"].document).action = 'properties/index.php';
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function shell_cmd() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      findObj('accion', parent.frames['Files'].document).value = "shell_cmd";
      findObj('form', parent.frames["Files"].document).action = 'shell/index.php';
      parent.frames["Files"].document.form.submit();
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function newDir() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      var dirName = prompt("<?php echo $lang['files']['new_dir_name']; ?>:", "<?php echo $lang['files']['new_dir_suggested_name']; ?>");
      if ((dirName != "") && (dirName != null)) {
        parent.frames["Files"].document.location.href = "newdir/index.php?accion=newdir&dirname=" + escape(dirName);
      }
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function newFile() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      var fileName = prompt("<?php echo $lang['files']['new_file_name']; ?>:", "<?php echo $lang['files']['new_file_suggested_name']; ?>");
      if ((fileName != "") && (fileName != null)) {
        parent.frames["Files"].document.location.href = "newfile/index.php?accion=newfile&filename=" + escape(fileName);
      }
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function noFrames() {
  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
      parent.document.location.href = "files_nf.php";
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}
-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body style="background-color:ThreeDFace; ">
<form action="files.php" method="post" name="form" target="Files" id="form" onSubmit="JavaScript: findObj('current_dir').value=findObj('dirs_list').value.substring(1);">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="accion" type="hidden" id="accion" value="none" />
  <input name="current_dir" type="hidden" id="current_dir" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>">
  <table width="100%">
    <tr class="TB_ToolbarSet">
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:open_dir('');" href="#"><img src="../images/toolbar/tb_home.gif" alt="<?php echo $lang['files']['home_dir']; ?>" title="<?php echo $lang['files']['home_dir']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:open_dir(findObj('current_dir').value);" href="#"><img src="../images/toolbar/tb_refresh.gif" alt="<?php echo $lang['files']['refresh']; ?>" title="<?php echo $lang['files']['refresh']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="JavaScript:go_dir_up();" href="#"><img src="../images/toolbar/tb_godirup.gif" alt="<?php echo $lang['files']['upper_dir']; ?>" title="<?php echo $lang['files']['upper_dir']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_On" id="btnTree" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:if (findObj('page_name', parent.frames['Tree'].document).value == 'tree.php') { this.className='TB_Button_On'; } else { this.className='TB_Button_Off'; }"><a onClick="Javascript: show_left('tree');" href="#"><img src="../images/toolbar/tb_showtree.gif" alt="<?php echo $lang['files']['show_tree']; ?>" title="<?php echo $lang['files']['show_tree']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" id="btnSearch" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:if (findObj('page_name', parent.frames['Tree'].document).value == 'search.php') { this.className='TB_Button_On'; } else { this.className='TB_Button_Off'; }"><a onClick="Javascript: show_left('search');" href="#"><img src="../images/toolbar/tb_search.gif" alt="<?php echo $lang['files']['show_search']; ?>" title="<?php echo $lang['files']['show_search']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: copy_files('copy');" href="#"><img src="../images/toolbar/tb_copy.gif" alt="<?php echo $lang['files']['copy_sel']; ?>" title="<?php echo $lang['files']['copy_sel']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: copy_files('move');" href="#"><img src="../images/toolbar/tb_move.gif" alt="<?php echo $lang['files']['move_sel']; ?>" title="<?php echo $lang['files']['move_sel']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: delete_files();" href="#"><img src="../images/toolbar/tb_delete.gif" alt="<?php echo $lang['files']['delete_sel']; ?>" title="<?php echo $lang['files']['delete_sel']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: open_downloadcompdialog();" href="#"><img src="../images/toolbar/tb_comp_download.gif" alt="<?php echo $lang['files']['download_comp_sel']; ?>" title="<?php echo $lang['files']['download_comp_sel']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: open_compdialog();" href="#"><img src="../images/toolbar/tb_compress.gif" alt="<?php echo $lang['files']['comp_sel']; ?>" title="<?php echo $lang['files']['comp_sel']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: set_permissions();" href="#"><img src="../images/toolbar/tb_permissions.gif" alt="<?php echo $lang['files']['set_permissions']; ?>" title="<?php echo $lang['files']['set_permissions']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: rename_file();" href="#"><img src="../images/toolbar/tb_rename.gif" alt="<?php echo $lang['files']['rename']; ?>" title="<?php echo $lang['files']['rename']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: properties();" href="#"><img src="../images/toolbar/tb_properties.gif" alt="<?php echo $lang['files']['see_properties']; ?>" title="<?php echo $lang['files']['see_properties']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: shell_cmd();" href="#"><img src="../images/toolbar/tb_shell.gif" alt="<?php echo $lang['files']['shell_cmd']; ?>" title="<?php echo $lang['files']['shell_cmd']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: newDir();" href="#"><img src="../images/toolbar/tb_newdir.gif" alt="<?php echo $lang['files']['new_dir']; ?>" title="<?php echo $lang['files']['new_dir']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: newFile();" href="#"><img src="../images/toolbar/tb_newfile.gif" alt="<?php echo $lang['files']['new_file']; ?>" title="<?php echo $lang['files']['new_file']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: noFrames();" href="#"><img src="../images/toolbar/tb_noframe.gif" alt="<?php echo $lang['files']['no_frames']; ?>" title="<?php echo $lang['files']['no_frames']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_Start"></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: parent.document.location.href = '../passwd/index.php';" href="#"><img src="../images/toolbar/tb_password.gif" alt="<?php echo $lang['passwd']['change_pwd']; ?>" title="<?php echo $lang['passwd']['change_pwd']; ?>" width="16" height="16" border="0" /></a></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: parent.document.location.href = '../cpanel/index.php';" href="#"><img src="../images/toolbar/tb_config.gif" alt="<?php echo $lang['all']['control_panel']; ?>" title="<?php echo $lang['all']['control_panel']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_End">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a href="../logout.php" target="_parent"><img src="../images/toolbar/tb_close.gif" alt="<?php echo $lang['all']['system_logout']; ?>" title="<?php echo $lang['all']['system_logout']; ?>" width="16" height="16" border="0" /></a></td>
    </tr>
    <tr class="TB_ToolbarSet">
      <td valign="middle" class="TB_Start"></td>
      <td valign="middle" colspan="25" class="TB_Button_Off"><input name="dirs_list" type="text" class="TB_Input" id="dirs_list" style="width:100%;" value="/<?php echo $Session["config"]["files"]["current_dir"]; ?>" /></td>
      <td width="16" class="TB_Button_Off" onMouseOver="Javascript:this.className='TB_Button_On';" onMouseOut="Javascript:this.className='TB_Button_Off';"><a onClick="Javascript: open_dir(findObj('dirs_list').value.substring(1));" href="#"><img src="../images/toolbar/tb_go.gif" alt="<?php echo $lang['files']['go']; ?>" title="<?php echo $lang['files']['go']; ?>" width="16" height="16" border="0" /></a></td>
      <td class="TB_End"></td>
      <td colspan="2"></td>
    </tr>
  </table>
</form>
</body>
</html>
