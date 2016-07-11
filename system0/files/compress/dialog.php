<?php
  include('globals.inc.php');

  $compName = (isset($_GET['compName']) && ($_GET['compName'] != '')) ? $_GET['compName'] : 'bfexplorer';
  $compType = (isset($_GET['compType']) && ($_GET['compType'] != '')) ? $_GET['compType'] : 'tar';
  
  $compTypes = array(
    '' => array('name' => $lang['files']['compress']['select_comp_type'] . '...', 'ext' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'ext_installed' => TRUE),
    'tar' => array('name' => 'TAR', 'ext' => '.tar&nbsp;&nbsp;&nbsp;', 'ext_installed' => TRUE),
    'zip' => array('name' => 'ZIP', 'ext' => '.zip&nbsp;&nbsp;&nbsp;', 'ext_installed' => (function_exists('gzopen'))),
    'gzip' => array('name' => 'GZIP', 'ext' => '.tar.gz', 'ext_installed' => (function_exists('gzopen'))),
    'bzip' => array('name' => 'BZIP', 'ext' => '.tar.bz', 'ext_installed' => (function_exists('bzopen')))
  );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['files']['compress']['compression_options']; ?></title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<!--
function findObj(n, d) {
    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
      d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
    if(!x && d.getElementById) x=d.getElementById(n); return x;
  }

  function getFormData(form) {
    var searchString = "?"
    var onePair
    // Harvest values for each type of form element
    for (var i = 0; i < form.elements.length; i++) {
      if (form.elements[i].type == "text") {
        onePair = escape(form.elements[i].name) + "=";
        onePair += escape(form.elements[i].value);
      } else if (form.elements[i].type.indexOf("select") != -1) {
        onePair = escape(form.elements[i].name) + "=";
        onePair += escape(form.elements[i].options[form.elements[i].selectedIndex].value);
      } else if (form.elements[i].type == "radio") {
        onePair = escape(form.elements[i].name) + "=";
        onePair += escape(form.elements[i].value);
      } else if (form.elements[i].type == "checkbox") {
        onePair = escape(form.elements[i].name) + "=";
        onePair += escape(form.elements[i].value);
      } else continue
      searchString += onePair + "&";
    }
    return searchString;
  }

  function handleOK() {
    if (YY_checkform('compress','compName','#q','0','<?php echo $lang['files']['compress']['name_mandatory']; ?>','compType','#q','1','<?php echo $lang['files']['compress']['comp_type_mandatory']; ?>')) {
      if (window.showModalDialog) {
        window.returnValue = getFormData(document.compress);
      } else {
        if ((window.opener) && (!window.opener.closed)) {
          opener.dialogWin.returnFunc(getFormData(document.compress));
        } else {
          return handleCancel();
        }
      }
      window.close();
      return true;
    }
  }

  function handleCancel() {
    window.close();
    return false;
  }

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('<?php echo $lang['all']['errors_ocurred']; ?>:\t\t\t\t\t\n\n'+s)}
  return (s=='');
}
//-->
</script>
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body>
<form action="" method="post" name="compress" id="compress" onSubmit="YY_checkform('compress','compName','#q','0','<?php echo $lang['files']['compress']['name_mandatory']; ?>','compType','#q','1','<?php echo $lang['files']['compress']['comp_type_mandatory']; ?>'); return document.MM_returnValue">
  <table id="parentTable" width="100%" height="100%" border="0" cellspacing="0" cellpadding="4">
    <tr height="95%">
      <td class="head"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <td align="right" width="40%"><?php echo $lang['files']['compress']['file_name']; ?>:&nbsp;</td>
            <td width="50%"><input name="compName" type="text" class="input" id="compName" value="<?php echo $compName; ?>" /></td>
            <td width="10%"><div id="extension"><?php echo $compTypes[$compType]['ext']; ?></div></td>
          </tr>
          <tr>
            <td align="right"><?php echo $lang['files']['compress']['comp_type']; ?>:&nbsp;</td>
            <td colspan="2"><select name="compType" class="select" id="compType">
			  <?php while (list($k, $v) = each($compTypes)) { ?>
			  <?php if ($v['ext_installed']) { ?>
              <option value="<?php echo $k; ?>"<?php echo ($compType == $k) ? ' selected' : ''; ?> onClick="JavaScript: findObj('extension').innerHTML = '<?php echo $v['ext']; ?>';"><?php echo $v['name']; ?></option>
			  <?php } ?>
			  <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td align="right"><?php echo $lang['files']['compress']['overwrite']; ?>:&nbsp;</td>
            <td colspan="2"><input name="overwrite" type="checkbox" id="overwrite" value="1" checked="checked" /></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td align="right" class="head"><input name="Cancel" type="button" class="boton" id="Cancel" value="<?php echo $lang['all']['cancel']; ?>" onClick="handleCancel();" />
        <input name="Accept" type="button" class="boton" id="Accept" value="<?php echo $lang['all']['accept']; ?>" onClick="handleOK();" /></td>
    </tr>
  </table>
</form>
</body>
</html>
