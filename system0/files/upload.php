<?php
  include('globals.inc.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['upload_files']; ?></title>
<link href="../css/toolbar.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--
function findObj(n, d) {
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function upload_files() {
  if (findObj('page_name', parent.frames['Files'].document).value == "files.php") {
    window.document.form.submit();
	findObj('file0').value = '';
	findObj('file1').value = '';
	findObj('file2').value = '';
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}
-->
</script>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body style="background-color:ThreeDFace; ">
<form action="upload/index.php" method="POST"  enctype="multipart/form-data" name="form" target="Files" id="form">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" /> 
  <input name="accion" type="hidden" id="accion" value="upload" /> 
  <input name="current_dir" type="hidden" id="current_dir" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>" />
  <table height="100%" width="100%">
    <tr class="TB_ToolbarSet">
      <td class="TB_Start"></td>
      <td><input name="file0" type="file" id="file0" class="TB_Input" style="width:100%;" /></td>
      <td><input name="file1" type="file" id="file1" class="TB_Input" style="width:100%;" /></td>
      <td><input name="file2" type="file" id="file2" class="TB_Input" style="width:100%;" /></td>
      <td width="16" class="TB_Button_Off" onmouseover="Javascript:this.className='TB_Button_On';" onmouseout="Javascript:this.className='TB_Button_Off';"><a onclick="JavaScript: upload_files();" href="#"><img src="../images/toolbar/tb_upload.gif" alt="<?php echo $lang['files']['upload']; ?>" title="<?php echo $lang['files']['upload']; ?>" width="16" height="16" border="0" /></a></td>
    </tr>
  </table>
</form>
</body>
</html>
