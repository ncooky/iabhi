<?php
  include('globals.inc.php');

  @set_time_limit(0);

  $files_file = ($Session["config"]["files"]["use_frames"]) ? "files.php" : "files_nf.php";
  
  function show_paths($dir) {
	global $bfexplorer_dir;
	global $Session;

    $result = "";

	$dir = slash_delete($dir);
	$dir .= ($dir != "") ? "/" : "";

	$handle = opendir(getFullPath($dir));
    while ($directory = readdir($handle)) {
      if (is_dir(getFullPath($dir) . '/' . $directory) && $directory != "." && $directory != ".." && $directory != $bfexplorer_dir) {
        $dirs_list[] = $dir . $directory;
      }
    }
    closedir($handle);

    $dirs_list = array_unique(array_merge((array)$dirs_list, (array)getMountedDirs($dir)));

    if (count($dirs_list) > 0) {
      natcasesort($dirs_list);
    }

    while (list($key, $value) = each($dirs_list)) {
      $go = substr($value, 0);
	  $selected = ($Session["config"]["files"]["current_dir"] == $go) ? " selected" : "";
      if (@file_exists(getFullPath($go) . "/.")) {
        $result .= "<option value=\"$go\"$selected>/$go</option>\n";
        $result .= show_paths($value);
      }
    }
    return $result;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['search_f_and_d']; ?></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
<!--
function findObj(n, d) {
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function updateTBButtons() {
  findObj('btnSearch', parent.frames['ToolBar'].document).className='TB_Button_On';
  findObj('btnTree', parent.frames['ToolBar'].document).className='TB_Button_Off';
}
//-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body<?php if ($Session["config"]["files"]["use_frames"] == TRUE) { ?> onload="updateTBButtons();"<?php } ?>>
<form action="search_result.php" method="post" name="form"<?php if ($Session["config"]["files"]["use_frames"]) { ?> target="Files"<?php } ?> id="form">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="accion" type="hidden" id="accion" value="search">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td><img src="../images/toolbar/tb_search.gif" width="16" height="16" border="0" align="texttop"><b>&nbsp;&nbsp;<?php echo $lang['files']['search_f_and_d']; ?></b></td>
    </tr>
    <tr>
      <td><hr size="2" color="#003366"></td>
    </tr>
    <tr>
      <td><?php echo $lang['files']['search_f_and_d']; ?>:</td>
    </tr>
    <tr>
      <td><input name="query" type="text" class="input" id="query"></td>
    </tr>
    <tr>
      <td><?php echo $lang['files']['search_in']; ?>:</td>
    </tr>
    <tr>
      <td><select name="path" class="select" id="path">
          <option value=""<?php echo ($Session["config"]["files"]["current_dir"] == "") ? " selected" : ""; ?>>/</option>
          <?php echo show_paths(""); ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><input name="search" type="submit" class="boton" id="search" value="<?php echo $lang['files']['search']; ?>">
        &nbsp;&nbsp;
        <input  name="cancel" type="button" class="boton" id="cancel"  value="<?php echo $lang['files']['cancel_search']; ?>" onclick="<?php if ($Session["config"]["files"]["use_frames"] == TRUE) { ?>parent.frames['Files'].document.location.href = '<?php echo $files_file; ?>'; document.location.href = 'tree.php';<?php } else { ?>document.location.href = 'files_nf.php';<?php } ?>">
      </td>
    </tr>
    <tr>
      <td><input name="case_sensitive" type="checkbox" class="check" id="case_sensitive" value="1">
        <?php echo $lang['files']['case_sensitive']; ?><br>
      </td>
    </tr>
    <tr>
      <td><input name="subdirs" type="checkbox" class="check" id="subdirs" value="1" checked>
        <?php echo $lang['files']['include_subdirs']; ?><br>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
