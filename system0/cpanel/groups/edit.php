<?php
  include('globals.inc.php'); 
  include('../../libs/utils.lib.php');

  if ((isset($_POST["accion"])) && ($_POST["accion"] == "update")) {
    $data = $_POST['data'];
    if (isset($_POST['functionalities1'])) $funci1 = $_POST['functionalities1']; 
    if (isset($_POST['functionalities2'])) $funci2 = $_POST['functionalities2']; 
    if (isset($_POST['functionalities3'])) $funci3 = $_POST['functionalities3']; 
    $no = 0;
	$Session["groups"]["message"] = '';
    
	//Se calculan los valuees de cada group de permisos
	$data["group1"] = $data["group2"] = $data["group3"] = 0;
    if (isset($funci1)) while (list($k, $v) = each($funci1)) $data["group1"] += $v;
    if (isset($funci2)) while (list($k, $v) = each($funci2)) $data["group2"] += $v;
    if (isset($funci3)) while (list($k, $v) = each($funci3)) $data["group3"] += $v;	      
    
	if ($data['name'] == '') { 
	//The group esta mal
      $Session["groups"]["message"] .= ', ' . $lang['cpanel']['groups']['name_wrong']; 	
      $no = 1;
    }

    if (!$no) { //Si todo esta bien se actualiza el group
	  $insertSQL = sprintf("UPDATE %sgroups SET update_date=NOW(), group1=%s, group2=%s, group3=%s, name=%s WHERE id_group=%s;",
                           $tables_preffix,
                           GetSQLValueString($data['group1'], "int"),
                           GetSQLValueString($data['group2'], "int"),
                           GetSQLValueString($data['group3'], "int"),
                           GetSQLValueString($data['name'], "text"),
                           GetSQLValueString($data['id_group'], "int"));

      bfBegin();
        $Result = bfQuery($insertSQL) or die(bfLastError());
      bfCommit();
  
      header("Location: index.php");
      die();
    } else {
      $Session["groups"]["message"] = substr($Session["groups"]["message"], 2); 
	}
  } else { //Si no se ha leido el group se lee ahora
    if (isset($_GET["id_group"]) && ($_GET["id_group"] > 0)) {
      $group = bfRecord(sprintf("SELECT * FROM %sgroups WHERE id_group = %s", $tables_preffix, GetSQLValueString($_GET['id_group'], "int")));
	  foreach ($group as $field => $value) {
	    $data[$field] = $value;
      }
    } else {
      header("Location: index.php");
	}
  }

    $functionalities = bfTable(sprintf("SELECT * FROM %sfunctionalities ORDER BY id_functionality ASC", $tables_preffix), "id_functionality");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['cpanel']['groups']['edit_group']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('<?php echo $lang['all']['errors_ocurred']; ?>:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>
<link rel="shortcut icon" href="../../favicon.ico">
</head>
<body> 
<div align="center"> 
  <table width="700" border="0" cellspacing="0" cellpadding="2"> 
    <tr height="30"> 
      <th width="4" background="../../images/borders/left_topCorner.jpg"></th> 
      <th width="99%" align="left" valign="middle" background="../../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['cpanel']['groups']['edit_group']; ?></th> 
      <th width="4" background="../../images/borders/right_topCorner.jpg"></th> 
    </tr> 
    <tr> 
      <td background="../../images/borders/leftBorder.jpg"></td> 
      <td align="left" valign="top"><form action="edit.php" method="POST" name="update" id="update" onSubmit="YY_checkform('update','data[name]','#q','0','<?php echo $lang['cpanel']['groups']['groupname_wrong']; ?>');return document.MM_returnValue"> 
          <table width="100%" border="0" cellspacing="3" cellpadding="5" align="center"> 
            <tr align="center"> 
              <td colspan="2" bgcolor="#FFFFFF" ><b></b> </td> 
            </tr> 
            <tr align="center" bgcolor="#FFFFFF"> 
              <td colspan="2"><b><font color="#FF0000"> 
                <?php if (isset($Session["groups"]["message"])) { echo $Session["groups"]["message"] ; unset ($Session["groups"]["message"]); } ?> 
                </font></b></td> 
            </tr> 
            <tr bgcolor="#FFFFFF"> 
              <td width="29%" align="right"><input type="hidden" name="data[id_group]" id="data[id_group]" value="<?php echo (isset($data["id_group"])) ? $data["id_group"] : ""; ?>"> 
                *<?php echo $lang['cpanel']['groups']['name']; ?>:</td> 
              <td width="71%"><input type="text" class="input" name="data[name]" id="data[name]" value="<?php echo (isset($data["name"])) ? $data["name"] : ""; ?>"> </td> 
            </tr> 
            <tr bgcolor="#FFFFFF"> 
              <td align="right" valign="top"><?php echo $lang['cpanel']['groups']['functionalities']; ?>:</td> 
              <td valign="middle"><?php while (list($k, $v) = each($functionalities)) { ?>
              <?php $index = ((($k - 1) - (($k - 1) % 32))/32) + 1; ?>
              <?php $power = pow(2, (($k - 1) % 32)); ?>
              <input type="checkbox" name="functionalities<?php echo $index; ?>[f<?php echo $k ?>]" id="functionalities<?php echo $index; ?>[f<?php echo $k ?>]" value="<?php echo $power; ?>"<?php if (isset($data["group" . $index]) && (!((( (int)$power ^ (int)$data["group" . $index]) & (int)$data["group" . $index]) == (int)$data["group" . $index]))) echo ' checked'; ?>>
              <?php echo $v->functionality ?><br>
              <?php } ?></td> 
            </tr> 
            <tr align="right"> 
              <td>*<?php echo $lang['all']['mandatory_fields']; ?> </td> 
              <td><input type="hidden" name="accion" value="update"> 
                <input name="Cancel" type="button" class="boton" id="Cancel" value="<?php echo $lang['all']['cancel']; ?>" onClick="window.document.location='index.php'"> 
                <input name="Update" type="submit" class="boton" id="Update" value="<?php echo $lang['all']['update']; ?>"></td> 
            </tr> 
          </table> 
        </form></td> 
      <td background="../../images/borders/rightBorder.jpg"></td> 
    </tr> 
    <tr height="4"> 
      <td background="../../images/borders/left_bottomCorner.jpg"></td> 
      <td background="../../images/borders/bottomBorder.jpg"></td> 
      <td background="../../images/borders/right_bottomCorner.jpg"></td> 
    </tr> 
  </table> 
</div> 
</body>
</html>
