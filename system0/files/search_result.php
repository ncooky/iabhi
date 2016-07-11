<?php
  include('globals.inc.php');
  
  $files_file = ($Session["config"]["files"]["use_frames"]) ? "files.php" : "files_nf.php";

  if ($Session["config"]["files"]["current_dir"] == "") {
    $backdir = "";
    $back = ".";
  } else {
    $backdir = $Session["config"]["files"]["current_dir"];
    $backdir = str_replace(" ", "%20", $backdir);
    $back = dirname($backdir);
  }

  if ($back != '.') {
	$link = "$files_file?current_dir=$back";
  } else {
    $link = "$files_file?current_dir=";
  }

  if ((!isset($_POST['accion'])) || ($_POST['accion'] != 'search')) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
	header("Location: " . $$files_file);
	die();
  }


  if (isset($_POST['query']) && ($_POST['query'] != '')) {
    $search = $_POST['query'];
	$search = str_replace('^', '\^', $search);
    $search = str_replace('[', '\[', $search);
    $search = str_replace('$', '\$', $search);
    $search = str_replace('(', '\(', $search);
    $search = str_replace(')', '\)', $search);
    $search = str_replace('|', '\|', $search);
    $search = str_replace('+', '\+', $search);
    $search = str_replace('{', '\{', $search);
    $search = str_replace('?', '.?', $search);
    $search = str_replace('*', '.*', $search);
    if (($search[0] == '"') && ($search[strlen($search) - 1] == '"')) {
      $search = '^' . substr($search, 1, -1) . '$';
    } else {
      if ($search[0] != '*') {
        $search = '^' . $search;
      }
      if ($search[strlen($search) - 1] != '*') {
        $search = $search . '$';
      }
    }
  } else {
    $search = NULL;
  }

  $current_dir = getFullPath($_POST['path']);

  if(!file_exists($current_dir) || !is_dir($current_dir)) {
    $Session["files"]["message"] = sprintf($lang['files']['dir_doesnt_exists'], slash_delete($_POST['path']));
    header("Location: $files_file?current_dir=");
	die();
  }

  $list = file_list($_POST['path'], (isset($_POST['subdirs']) && ($_POST['subdirs'] == 1)), $search, (isset($_POST['case_sensitive']) && ($_POST['case_sensitive'] == 1)));

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
<link rel="stylesheet" type="text/css" href="../css/style.css">
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
	dml = document.form;
	len = dml.elements.length;
	var i = 0;
	for(i = 0; i<len; i++) {
		if (dml.elements[i].name=='files[]'||dml.elements[i].name=='dirs[]') {
			dml.elements[i].checked=val;
		}
	}
}

function seleccionarNodo(tree, path) {
  if (findObj('page_name', parent.frames['Tree'].document)) {
    if (findObj('page_name', parent.frames['Tree'].document).value == "tree.php") {
      if (path == '') path = '/';
      tree.expandParentsOfItem(path); 
      tree.activateItem(path);
      findObj('selectedNode', parent.frames['Tree'].document).value = path;
    }
  }
}

function updateDirs(dir_name) {
  if (dir_name == '/') dir_name = '';
  if (findObj('page_name', parent.frames['ToolBar'].document)) {
    if (findObj('page_name', parent.frames['ToolBar'].document).value == "toolbar.php") {
      findObj('current_dir', parent.frames['ToolBar'].document).value = dir_name;
      findObj('dirs_list', parent.frames['ToolBar'].document).value = '/' + dir_name;
    }
  }

  if (findObj('page_name', parent.frames['Tree'].document)) {
    if (findObj('page_name', parent.frames['Tree'].document).value == "tree.php") {
      findObj('current_dir', parent.frames['Tree'].document).value = dir_name;
    }
  }

  if (findObj('page_name', parent.frames['Files'].document)) {
    if (findObj('page_name', parent.frames['Files'].document).value == "<?php echo $files; ?>") {
      findObj('current_dir', parent.frames['Files'].document).value = dir_name;
    }
  }

  if (findObj('page_name', parent.frames['Upload'].document)) {
    if (findObj('page_name', parent.frames['Upload'].document).value == "upload.php") {
      findObj('current_dir', parent.frames['Upload'].document).value = dir_name;
    }
  }
}
//-->
</script>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['search_result']; ?></title>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body<?php if ($Session["config"]["files"]["use_frames"]) { ?> onload="JavaScript:seleccionarNodo(parent.frames['Tree'].window.fstree, '<?php echo ($Session["config"]["files"]["current_dir"] == '') ? '/' : ''; ?><?php echo $Session["config"]["files"]["current_dir"]; ?>'); updateDirs('<?php echo $Session["config"]["files"]["current_dir"]; ?>');"<?php } ?>>
<form method="POST" name="form" id="form">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="accion" type="hidden" id="accion" value="none">
  <input name="current_dir" type="hidden" id="current_dir" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>">
  <input name="dirs[]" type="hidden" id="dirs[]" value="DATA">
  <input name="files[]" type="hidden" id="files[]" value="DATA">
  <table border="0" height="12" width="100%" cellspacing="0" cellpadding="3">
    <?php if (isset($Session["files"]["message"])) { ?>
      <tr>
        <td colspan="7" align="center" class="body"><strong><font color="#FF0000"><?php echo $Session["files"]["message"]; unset ($Session["files"]["message"]); ?> </font></strong></td>
      </tr>
      <?php } ?>
    <tr>
      <td class="head" align="left"><b><?php echo $lang['files']['name']; ?></b></td>
      <td class="head" align="right"><b><?php echo $lang['files']['size']; ?></b></td>
      <td class="head" align="left"><b><?php echo $lang['files']['type']; ?></b></td>
      <td class="head" align="left"><b><?php echo $lang['files']['in_directory']; ?></b></td>
      <td class="head" colspan="3" align="center"><b><?php echo $lang['all']['actions']; ?></b></td>
    </tr>
    <?php if (count($dirs) > 0) { ?>
    <?php while (list($k, $v) = each($dirs)) { ?>
    <tr>
      <td class="body" align="left"><a title="<?php echo $v["title"]; ?>" href="<?php echo $files_file . $v["link"]; ?>"><img src="../images/folder.png" width="16" height="15" border="0" />&nbsp;<?php echo $v["small_name"]; ?></a> </td>
      <td class="body" align="right"><?php echo $v["size"]; ?></td>
      <td class="body" align="left"><?php echo $v["type"] ?></td>
      <td class="body" align="left"><a title="<?php echo $v["title"]; ?>" href="<?php echo $files_file . "?current_dir=" . $v["in_dir"]; ?>"><?php echo '/' . $v["in_dir"]; ?></a></td>
      <td class="body" align="center" colspan="3">&nbsp;</td>
    </tr>
    <?php } ?>
    <?php } ?>
    <?php if (count($files) > 0) { ?>
    <?php while (list($k, $v) = each($files)) { ?>
    <tr>
      <td class="body" align="left"><a title="<?php echo  $v["title"]; ?>" href="<?php echo (can_view($v["ext"])) ? "view" : "download"; ?>/index.php?accion=<?php echo (can_view($v["ext"])) ? "view_file" : "download_file"; ?>&filename=<?php echo $v["in_dir"] . '/' . $v["name"] ?>"> <font color="<?php echo $v["color"]; ?>"><img src="../icons/<?php echo mime(strtolower($v["ext"])); ?>" width="16" height="16" border="0" />&nbsp;<?php echo $v["small_name"]; ?></font> </a></td>
      <td class="body" align="right"><?php echo $v["size"]; ?></td>
      <td class="body" align="left"><?php echo ($v["ext"] != "") ? $v["ext"] . " file" : "File"; ?></td>
      <td class="body" align="left"><a title="<?php echo $v["title"]; ?>" href="<?php echo $files_file . "?current_dir=" . $v["in_dir"]; ?>"><?php echo '/' . $v["in_dir"]; ?></a></td>
      <td class="body" align="right" width="3%"><?php if (can_view($v["ext"])) { ?>
        <a title="<?php echo $lang['files']['view_file']; ?>" href="view/index.php?accion=view_file&filename=<?php echo $v["in_dir"] . '/' . $v["name"] ?>"><img src="../images/toolbar/tb_viewfile.gif" alt="<?php echo $lang['files']['view_file']; ?>" title="<?php echo $lang['files']['view_file']; ?>" width="16" height="16" border="0" /></a>
        <?php } else { ?>
        &nbsp;
        <?php } ?></td>
      <td class="body" align="center" width="3%"><?php if (can_edit($v["ext"])) { ?>
        <a title="<?php echo $lang['files']['edit_file']; ?>" href="edit/index.php?accion=edit_file&filename=<?php echo $v["in_dir"] . '/' . $v["name"] ?>"><img src="../images/toolbar/tb_editfile.gif" alt="<?php echo $lang['files']['edit_file']; ?>" title="<?php echo $lang['files']['edit_file']; ?>" width="16" height="16" border="0" /></a>
        <?php } else { ?>
        &nbsp;
        <?php } ?></td>
      <td class="body" align="left" width="3%"><a title="<?php echo $lang['files']['download_file']; ?>" href="download/index.php?accion=download_file&filename=<?php echo $v["in_dir"] . '/' . $v["name"] ?>"><img src="../images/toolbar/tb_download.gif" alt="<?php echo $lang['files']['download_file']; ?>" title="<?php echo $lang['files']['download_file']; ?>" width="16" height="16" border="0" /></a></td>
    </tr>
    <?php } ?>
    <?php } ?>
  </table>
</form>
<?php if ($Session["config"]["files"]["use_frames"]) { ?>
<script language="JavaScript">
<!--
  if (findObj('resume01', parent.frames['Resume'].document)) {
    findObj('resume01', parent.frames['Resume'].document).innerHTML = "<b><?php echo sprintf($lang['files']['resume1'], $dirs_number, $files_number, format_size($files_size)); ?></b>";
  }
  if (findObj('resume02', parent.frames['Resume'].document)) {
    findObj('resume02', parent.frames['Resume'].document).innerHTML = "<b><?php echo sprintf($lang['files']['resume2'], format_size($total_space)); ?></b>";
  }
  if (findObj('resume03', parent.frames['Resume'].document)) {
    findObj('resume03', parent.frames['Resume'].document).innerHTML = "<b><?php echo sprintf($lang['files']['resume3'], format_size($free_space), floor($free_space*100/$total_space)); ?></b>";
  }
-->
</script>
<?php } ?>
</body>
</html>
