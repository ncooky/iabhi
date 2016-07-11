<?php 
  include('globals.inc.php');
  include('../libs/utils.lib.php');

  if ((isset($_POST["accion"])) && ($_POST["accion"] == "cambiar")) {
    $data = $_POST['data'];
    $no = 0;
	$Session["password"]["message"] = '';

	if ($data['old_pass'] == '') { 
	  //The password viejo esta en blanco
      $Session["password"]["message"] .= ', ' . $lang['passwd']['old_pwd_mandatory']; 	
      $no = 1;
    }

    $User = bfRecord(sprintf("SELECT * FROM %susers WHERE id_user='%s'", $tables_preffix, $Session['UserId']));
    if (($User->id_user < 1) || (crypt($data['old_pass'], $User->passwd) != $User->passwd)) {
	  //The password viejo esta mal
      $Session["password"]["message"] .= ', ' . $lang['passwd']['old_pwd_wrong']; 	
      $no = 1;
    }

	if ($data['pass'] == '') { 
	  //The password nuevo esta en blanco
      $Session["password"]["message"] .= ', ' . $lang['passwd']['new_pwd_mandatory']; 	
      $no = 1;
    }

	if ($data['retype_pass'] == '') { 
	  //La repeticion del password nuevo esta en blanco
      $Session["password"]["message"] .= ', ' . $lang['passwd']['must_retype_new_pwd']; 	
      $no = 1;
    }

	if ($data['pass'] != $data['retype_pass']) { 
	  //Los passwords no coinciden
      $Session["password"]["message"] .= ', ' . $lang['passwd']['pwds_dont_match']; 	
      $no = 1;
    }

    if (!$no) { //Si todo esta bien se cambia el password
	  $tmppasswd = crypt($data['pass']);
	  $updateSQL = sprintf("UPDATE %susers SET passwd=%s WHERE id_user=%s;",
                           $tables_preffix,
                           GetSQLValueString($tmppasswd, "text"),
                           GetSQLValueString($data['id_user'], "int"));

      bfBegin();
        $Result = bfQuery($updateSQL) or die(bfLastError());
      bfCommit();
  
      $Session["USER"]->passwd = $tmppasswd;
	  header("Location: ../files/index.php");
      die();
    } else {
      $Session["password"]["message"] = substr($Session["password"]["message"], 2); 
	}
  }

  $id_user = $Session["UserId"];
  $users = bfRecord(sprintf("SELECT * FROM %susers WHERE id_user=%s;", $tables_preffix, $id_user));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['passwd']['change_pwd']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language=javascript>
<!--
function submitAction(action) { 
  document.Data.action.value=action;
  window.document.Data.submit(); 
  return false;
}

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
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
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
<link rel="shortcut icon" href="../favicon.ico">
</head>
<body> 
<div align="center"> 
  <table width="450" border="0" cellspacing="0" cellpadding="2"> 
    <tr height="30"> 
      <th width="4" background="../images/borders/left_topCorner.jpg"></th> 
      <th width="99%" align="left" valign="middle" background="../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['passwd']['change_pwd']; ?></th> 
      <th width="4" background="../images/borders/right_topCorner.jpg"></th> 
    </tr> 
    <tr> 
      <td background="../images/borders/leftBorder.jpg"></td> 
      <td align="left" valign="top"><form action="index.php" method="post" name="cambiar" id="cambiar" onSubmit="YY_checkform('cambiar','data[old_pass]','#q','0','<?php echo $lang['passwd']['old_pwd_mandatory']; ?>.','data[pass]','#q','0','<?php echo $lang['passwd']['new_pwd_mandatory']; ?>.','data[retype_pass]','#data[pass]','6','<?php echo $lang['passwd']['pwds_dont_match']; ?>.');return document.MM_returnValue"> 
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="3"> 
            <tr align="center" > 
              <td colspan="2"><font color="#FF0000"><b> 
                <?php if (isset($Session["password"]["message"])) { echo $Session["password"]["message"]; unset($Session["password"]["message"]); } ?> 
                </b></font></td> 
            </tr> 
            <tr> 
              <td width="47%" align="right"><input name="data[id_user]" type="hidden" id="data[id_user]" value="<?php echo $id_user; ?>"> 
                <?php echo $lang['passwd']['username']; ?>:</td> 
              <td width="53%"><b><?php echo $users->username; ?> </b></td> 
            </tr> 
            <tr> 
              <td align="right"><?php echo $lang['passwd']['old_pwd']; ?>:</td> 
              <td><input name="data[old_pass]" type="password" class="input" id="data[old_pass]" value=""></td> 
            </tr> 
            <tr> 
              <td align="right"><?php echo $lang['passwd']['new_pwd']; ?>:</td> 
              <td><input name="data[pass]" type="password" class="input" id="data[pass]" value=""></td> 
            </tr> 
            <tr> 
              <td align="right"><?php echo $lang['passwd']['retype_new_pwd']; ?>:</td> 
              <td><input name="data[retype_pass]" type="password" class="input" id="data[retype_pass]" value=""></td> 
            </tr> 
            <tr align="center"> 
              <td colspan="2" align="right"><input name="accion" type="hidden" value="cambiar"> 
                <input name="Cancel" type="button" class="boton" id="Cancel" onClick="window.document.location='../files/index.php'" value="<?php echo $lang['all']['cancel']; ?>"> 
                <input name="Change" type="submit" class="boton" id="Change" value="<?php echo $lang['all']['change']; ?>"></td> 
            </tr> 
          </table> 
        </form></td> 
      <td background="../images/borders/rightBorder.jpg"></td> 
    </tr> 
    <tr height="4"> 
      <td background="../images/borders/left_bottomCorner.jpg"></td> 
      <td background="../images/borders/bottomBorder.jpg"></td> 
      <td background="../images/borders/right_bottomCorner.jpg"></td> 
    </tr> 
  </table> 
</div> 
</body>
</html>
