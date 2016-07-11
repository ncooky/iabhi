<?php
  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_GET['accion'])) || ($_GET['accion'] != "edit_file")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if (!isset($_GET['filename']) || ($_GET['filename'] == "")) {
    $Session["files"]["message"] = $lang['files']['view']['not_selected_file'];
    header("Location: " . $link);
	die();
  }

  $current_dir = $Session["config"]["files"]["current_dir"];
  $current_dir .= ($Session["config"]["files"]["current_dir"] != "") ? "/" : "";
  $filename = getFullPath('/' . $current_dir . urldecode($_GET['filename']));
  
  if (!file_exists($filename) && file_exists(getFullPath('/' . urldecode($_GET['filename'])))){
    $filename = getFullPath('/' . urldecode($_GET['filename']));
  }

  if (isset($_POST['filename']) && ($_POST['filename'] != '')) {
    $filename = getFullPath('/' . $current_dir . urldecode($_POST['filename']));
  
    if (!file_exists($filename) && file_exists(getFullPath('/' . urldecode($_POST['filename'])))){
      $filename = getFullPath('/' . urldecode($_POST['filename']));
    }
    if ($f = @fopen($filename, "w")) {
      $content = stripslashes($_POST['content']);
      $content = str_replace("\r\n", "\n", $content);
      if ((!isset($_POST['os'])) || ($_POST['os'] == "win")) $content = str_replace("\n", "\r\n", $content);
      if (@fwrite($f, $content)) {
        fclose($f);
        chmod($filename, 0644);
      } else {
        $Session["files"]["message"] = sprintf($lang['files']['edit']['error_writing_file'], $_GET['filename']);;
        header("Location: " . $link);
        die();
      }
    } else {
      $Session["files"]["message"] = sprintf($lang['files']['edit']['error_opening_file_write'], $_GET['filename']);
      header("Location: " . $link);
      die();
    }

    header("Location: " . $link);
    die();
  }

  if ($f = @fopen($filename, "r")) {
    if (@filesize($filename) > 0){
      if (FALSE !== ($content = @fread($f, @filesize($filename)))) {
        if (FALSE === strpos($content, "\r\n")) {
          $chk_win = "";
          $chk_unix = " checked";
        } else {
          $chk_win = " checked";
          $chk_unix = "";
        }
        @fclose($f);
      } else {
        $Session["files"]["message"] = sprintf($lang['files']['view']['error_reading_file'], $_GET['filename']);
        header("Location: " . $link);
        die();
      }
    } else {
      $content = "";
      $chk_win = "";
      $chk_unix = "";
    }
  } else {
    $Session["files"]["message"] = sprintf($lang['files']['view']['error_opening_file'], $_GET['filename']);
    header("Location: " . $link);
	die();
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['edit_file']; ?></title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<form id="form" name="form" method="post" action="index.php?accion=edit_file&filename=<?php echo urlencode($_GET['filename']); ?>">
  <table width="100%" height="95%" border="0" cellspacing="0" cellpadding="4">
    <tr height="10">
      <td colspan="2" align="left"><b><?php echo sprintf($lang['files']['view']['file_name'], "/" . $current_dir . urldecode($_GET['filename'])); ?></b></td>
    </tr>
    <tr height="10">
      <td width="400" align="left"><input name="filename" type="hidden" id="filename" value="<?php echo $_GET['filename']; ?>" />
        <input name="save" type="submit" class="boton" id="save" value="<?php echo $lang['files']['edit']['save_file']; ?>" />
        <input name="view" type="button" class="boton" id="view" value="<?php echo $lang['files']['view_file']; ?>" onClick="JavaScript: document.location.href = '../view/index.php?accion=view_file&filename=<?php echo urlencode($_GET['filename']); ?>';" />
        <input name="Cancel" type="button" class="boton" id="Cancel" onClick="JavaScript: document.location.href = '<?php echo $link; ?>';" value="<?php echo $lang['all']['cancel']; ?>" /></td>
      <td align="left"><input name="os" type="radio" value="win"<?php echo $chk_win; ?> />
        <?php echo $lang['files']['edit']['windows_format']; ?><br />
        <input name="os" type="radio" value="unix"<?php echo $chk_unix; ?> />
        <?php echo $lang['files']['edit']['UNIX_format']; ?></td>
    </tr>
    <?php if (get_editor(file_ext($_GET['filename'])) == 'html') { ?>
    <?php 
      include("../../libs/FCKeditor/fckeditor.php");
      $oFCKeditor = new FCKeditor('content');
      $oFCKeditor->BasePath	= "../../libs/FCKeditor/";
      $oFCKeditor->Value = $content;
      $oFCKeditor->Config['AutoDetectLanguage'] = false;
      $oFCKeditor->Config['DefaultLanguage'] = $language;
      $oFCKeditor->Config['FullPage'] = true;
      $oFCKeditor->ToolbarSet = "Default";
      $oFCKeditor->Width = "100%";
      $oFCKeditor->Height = "400";
	?>
    <tr>
      <td colspan="2" align="left" valign="top"><?php $oFCKeditor->Create(); ?></td>
    </tr>
    <?php } else { ?>
    <tr>
      <td colspan="2" align="left" valign="top"><textarea name="content" wrap="virtual" class="input" id="content" style="width:100%; height:100%; max-width:800;"><?php echo htmlentities($content); ?></textarea></td>
    </tr>
    <?php } ?>
    <tr height="10">
      <td colspan="2" align="left"><input name="filename" type="hidden" id="filename" value="<?php echo $_GET['filename']; ?>" />
        <input name="save" type="submit" class="boton" id="save" value="<?php echo $lang['files']['edit']['save_file']; ?>" />
        <input name="view" type="button" class="boton" id="view" value="<?php echo $lang['files']['view_file']; ?>" onClick="JavaScript: document.location.href = '../view/index.php?accion=view_file&filename=<?php echo urlencode($_GET['filename']); ?>';" />
        <input name="Cancel" type="button" class="boton" id="Cancel" onClick="JavaScript: document.location.href = '<?php echo $link; ?>';" value="<?php echo $lang['all']['cancel']; ?>" /></td>
    </tr>
  </table>
</form>
</body>
</html>
