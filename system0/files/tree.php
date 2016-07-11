<?php 
  include('globals.inc.php');
  
  $dir_name = ($Session["config"]["files"]["current_dir"] == '') ? '/' : '';
  $dir_name .= $Session["config"]["files"]["current_dir"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?>-<?php echo $lang['files']['tree']; ?></title>
<link href="../libs/livetree/live_tree.css" media="screen" rel="Stylesheet" type="text/css" />
<script src="../libs/livetree/prototype.js" type="text/javascript"></script>
<script src="../libs/livetree/live_tree.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
<!--
function onClickItem(tree, itemId) {
  if (itemId == '') itemId = '/';
  tree.activateItem(itemId);
  open_dir(itemId);
  findObj('selectedNode').value = itemId;
}

function seleccionarNodo(tree, path) {
  if (path == '') path = '/';
  //alert(path);
  tree.expandParentsOfItem(path); 
  onClickItem(tree, path)
}

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
      parent.frames["Files"].document.location.href = 'files.php?current_dir='+escape(dir2open);
    } else {
      alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
    }
  } else {
    alert('<?php echo $lang['files']['cannot_perform_action']; ?>');
  }
}

function updateTBButtons() {
  if (findObj('btnTree', parent.frames['ToolBar'].document)) {
    findObj('btnTree', parent.frames['ToolBar'].document).className='TB_Button_On';
  }
  if (findObj('btnSearch', parent.frames['ToolBar'].document)) {
    findObj('btnSearch', parent.frames['ToolBar'].document).className='TB_Button_Off';
  }
}
//-->
</script>
<link rel="stylesheet" type="text/css" href="../libs/livetree/globalTree.css"/>
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body onLoad="seleccionarNodo(fstree, '<?php echo $dir_name; ?>'); updateTBButtons();">
<div id="treeContainer">
  <script type="text/javascript">
    //<![CDATA[
    var fstree = new LiveTree("fstree", {
      onClickItem:function(item){onClickItem(this, item.id)},
      allowClickBranch:true,
      collapsedItemIconHtml:"<img alt=\"\" src=\"../images/live_tree_branch_collapsed_icon_win.gif\" border=\"0\" />&nbsp;<img alt=\"\" src=\"../images/closed_folder.png\" width=\"24\" height=\"22\" border=\"0\" />", 
      expandedItemIconHtml:"<img alt=\"\" src=\"../images/live_tree_branch_expanded_icon_win.gif\" border=\"0\" />&nbsp;<img alt=\"\" src=\"../images/expanded_folder.png\" width=\"24\" height=\"22\" border=\"0\" />", 
      leafIconHtml:"<img alt=\"\" src=\"../images/live_tree_branch_expanded_icon_win.gif\" border=\"0\" />&nbsp;<img alt=\"\" src=\"../images/expanded_folder.png\" width=\"24\" height=\"22\" border=\"0\" />", 
      initialData:<?php echo get_tree($dir_name, 1, TRUE); ?>,
      dataUrl:"get_tree.php"
    });
    fstree.render();
    //]]>
  </script>
</div>
<form action="files.php" method="post" name="form" target="Files" id="form">
  <input name="page_name" type="hidden" id="page_name" value="<?php echo str_replace("/", "", str_replace(dirname($_SERVER['PHP_SELF']), "", $_SERVER['PHP_SELF'])); ?>" />
  <input name="selectedNode" type="hidden" id="selectedNode" value="<?php echo $dir_name; ?>" />
  <input name="accion" type="hidden" id="accion" value="none" />
  <input name="current_dir" type="hidden" id="current_dir" value="<?php echo $Session["config"]["files"]["current_dir"]; ?>">
</form>
</body>
</html>
