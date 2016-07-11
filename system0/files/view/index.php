<?php
  include('globals.inc.php');
  include('../../libs/geshi/geshi.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_GET['accion'])) || ($_GET['accion'] != "view_file")) {
    $Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if (!isset($_GET['filename']) || ($_GET['filename'] == "")) {
    $Session["files"]["message"] = $lang['files']['view']['not_selected_file'];
    header("Location: " . $link);
	die();
  }

  function imagesList($dir) {
    global $bfexplorer_dir;
    global $names_chars;
    global $lang;

    $dir = slash_delete($dir);
    $current_dir = getFullPath($dir);

    $result = array();

    $handle = opendir($current_dir);
    while ($name = readdir($handle)) {
      if ((@is_file($current_dir . "/" . $name)) && ($name != ".") && ($name != "..") && (get_viewer(file_ext($name)) == 'image')) {
        $result[] = $name;
      }
    }

    return $result;
  }
  
  function imagePos($images, $name) {
    $pos = -1;
    if (is_array($images)) {
      while (list($k, $v) = each($images)) {
        if ($v == $name) $pos = $k;
      }
    }

    return $pos;
  }
  
  function previousImage($images, $name) {
    $pos = imagePos($images, $name);
    return ($pos > 0) ? $images[$pos - 1] : $images[count($images) - 1];
  }
  
  function nextImage($images, $name) {
    $pos = imagePos($images, $name);
    return ($pos < (count($images) - 1)) ? $images[$pos + 1] : $images[0];
  }
  
  $current_dir = $Session["config"]["files"]["current_dir"];
  $current_dir .= ($Session["config"]["files"]["current_dir"] != "") ? "/" : "";
  $filename = getFullPath('/' . $current_dir . urldecode($_GET['filename']));
  
  if (!file_exists($filename) && file_exists(getFullPath('/' . urldecode($_GET['filename'])))){
    $filename = getFullPath('/' . urldecode($_GET['filename']));
  }

  $imageslist = imagesList($Session["config"]["files"]["current_dir"]);
  $previous_image = previousImage($imageslist, $_GET['filename']);
  $next_image = nextImage($imageslist, $_GET['filename']);

  switch (get_viewer(file_ext($_GET['filename']))) {
    case 'text': //Is a text file
      if ($f = @fopen($filename, "r")) {
        if (@filesize($filename) > 0){
          if (FALSE !== ($content = @fread($f, @filesize($filename)))) {
            $highlighter = get_highlighter(file_ext($_GET['filename']));
			if (($highlighter == 'none') && ($highlighter == '')) {
              $content = nl2br(htmlspecialchars($content));
            } else {
              @set_time_limit(0);
			  $content = geshi_highlight($content, $highlighter, '../../libs/geshi/geshi/', true);
            }
            @fclose($f);
          } else {
            $Session["files"]["message"] = sprintf($lang['files']['view']['error_reading_file'], $_GET['filename']);
            header("Location: " . $link);
            die();
          }
        } else {
          $content = "";
        }
      } else {
        $Session["files"]["message"] = sprintf($lang['files']['view']['error_opening_file'], $_GET['filename']);
        header("Location: " . $link);
        die();
      }
    break;
    case 'image':  //Is an image file
      if (list($witdh, $height, $ttype, $attr) = @getimagesize($filename)) {
        $content = sprintf("<img id=\"current_image\" src=\"get_image.php?accion=get_image&filename=%s\" alt=\"%s\" width=\"%s\" height=\"%s\" border=\"0\" onClick=\"JavaScript: setSize();\" />", urlencode($_GET['filename']), $_GET['filename'], $witdh, $height);
	  } else {
        $Session["files"]["message"] = sprintf($lang['files']['view']['error_opening_file'], $_GET['filename']);
        header("Location: " . $link);
        die();
	  }
	break;
    default:
      $Session["files"]["message"] = sprintf($lang['files']['view']['not_viewer'], $_GET['filename']);
      header("Location: " . $link);
      die();
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['view_file']; ?></title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../favicon.ico">
<script language="javascript">
<!--
  var image_width, image_height, is_resized;
  
  image_width = <?php echo (isset($witdh)) ? $witdh : 0; ?>;
  image_height = <?php echo (isset($height)) ? $height : 0; ?>;
  is_resized = false;
  
  function findObj(n, d) {
    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
      d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
    if(!x && d.getElementById) x=d.getElementById(n); return x;
  }

  function frameWidth() {
    if (self.innerWidth) {
      return self.innerWidth;
    } else if (document.documentElement && document.documentElement.clientWidth) {
      return document.documentElement.clientWidth;
    } else if (document.body) {
      return document.body.clientWidth;
    } else return 630;
  }

  function frameHeight() {
    if (self.innerWidth) {
      return self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) {
      return document.documentElement.clientHeight;
    } else if (document.body) {
      return document.body.clientHeight;
    } else return 460;
  }
  
  function resizeImage() {
    if (findObj('current_image').width > (frameWidth())) {
      findObj('current_image').height = findObj('current_image').height*frameWidth()/findObj('current_image').width;
      findObj('current_image').width = frameWidth();
      is_resized = true;
    }
    if (findObj('current_image').height > (frameHeight() - 80)) {
      findObj('current_image').width = findObj('current_image').width*(frameHeight() - 80)/findObj('current_image').height;
      findObj('current_image').height = (frameHeight() - 80);
      is_resized = true;
    }
  }

  function setSize() {
    if (is_resized) {
      findObj('current_image').width = image_width;
      findObj('current_image').height = image_height;
      is_resized = false;
    } else {
      resizeImage();
    }
  }
-->
</script>
</head>
<body<?php if (get_viewer(file_ext($_GET['filename'])) == 'image') { ?> onLoad="JavaScript: resizeImage();"<?php } ?>>
<table width="100%" height="100%" border="0" cellpadding="4" cellspacing="0">
  <tr height="10">
    <td align="left"><b><?php echo sprintf($lang['files']['view']['file_name'], "/" . $current_dir . urldecode($_GET['filename'])); ?></b></td>
  </tr>
  <tr height="10">
    <td align="left"><?php if (can_edit(file_ext($_GET['filename']))) { ?>
      <input name="Edit" type="button" class="boton" id="Edit" value="<?php echo $lang['files']['edit_file'] ?>" onClick="JavaScript: document.location.href = '../edit/index.php?accion=edit_file&filename=<?php echo urlencode($_GET['filename']); ?>';" />
      <?php } ?>
      <input name="Finish" type="button" class="boton" id="Finish" onClick="JavaScript: document.location.href = '<?php echo $link; ?>';" value="<?php echo $lang['all']['finish']; ?>" />
      <?php if (get_viewer(file_ext($_GET['filename'])) == 'image') { ?>
      <input name="Previous" type="button" class="boton" id="Previous" onClick="JavaScript: document.location.href = '<?php echo $_SERVER['PHP_SELF'] . "?accion=view_file&filename=" . urlencode($previous_image); ?>';" value="&lt;&lt;">
      <input name="Next" type="button" class="boton" id="Next" onClick="JavaScript: document.location.href = '<?php echo $_SERVER['PHP_SELF'] . "?accion=view_file&filename=" . urlencode($next_image); ?>';" value="&gt;&gt;">
      <?php } ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo $content; ?></td>
  </tr>
  <tr height="10">
    <td align="left"><?php if (can_edit(file_ext($_GET['filename']))) { ?>
      <input name="Edit" type="button" class="boton" id="Edit" value="<?php echo $lang['files']['edit_file'] ?>" onClick="JavaScript: document.location.href = '../edit/index.php?accion=edit_file&filename=<?php echo urlencode($_GET['filename']); ?>';" />
      <?php } ?>
      <input name="Finish" type="button" class="boton" id="Finish" onClick="JavaScript: document.location.href = '<?php echo $link; ?>';" value="<?php echo $lang['all']['finish']; ?>" />
      <?php if (get_viewer(file_ext($_GET['filename'])) == 'image') { ?>
      <input name="Previous" type="button" class="boton" id="Previous" onClick="JavaScript: document.location.href = '<?php echo $_SERVER['PHP_SELF'] . "?accion=view_file&filename=" . urlencode($previous_image); ?>';" value="&lt;&lt;">
      <input name="Next" type="button" class="boton" id="Next" onClick="JavaScript: document.location.href = '<?php echo $_SERVER['PHP_SELF'] . "?accion=view_file&filename=" . urlencode($next_image); ?>';" value="&gt;&gt;">
      <?php } ?></td>
  </tr>
</table>
</body>
</html>
