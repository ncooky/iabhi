<?php
  include('globals.inc.php'); 
  include('../../libs/utils.lib.php');
  include('../../files/config.php');
  include('../../libs/filesystem.lib.php');

  if ((isset($_POST["accion"])) && ($_POST["accion"] == "update")) {
    $data = $_POST['data'];
    $no = 0;
	$Session["users"]["message"] = '';
    if (!eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $data['email'])) { 
	//The correo esta mal
      $Session["users"]["message"].=', ' . $lang['cpanel']['users']['email_wrong']; 	
      $no = 1;
    }

    if (!$no) { //Si todo esta bien se actualiza el user
	  $insertSQL = sprintf("UPDATE %susers SET update_date=NOW(), id_group=%s, name=%s, lastname=%s, email=%s, homedir=%s WHERE id_user=%s;",
                           $tables_preffix,
                           GetSQLValueString($data['id_group'], "int"),
                           GetSQLValueString($data['name'], "text"),
                           GetSQLValueString($data['lastname'], "text"),
                           GetSQLValueString($data['email'], "text"),
                           GetSQLValueString($data['homedir'], "text"),
                           GetSQLValueString($data['id_user'], "int"));

      bfBegin();
        $Result = bfQuery($insertSQL) or die(bfLastError());
      bfCommit();
  
      //Si no existe el home directory trato de crearlo
      if (!file_exists(getUserHome($data['homedir']))) @mkdir(getUserHome($data['homedir']));

      header("Location: index.php");
      die();
    } else {
      $Session["users"]["message"] = substr($Session["users"]["message"], 2); 
	}
  } else { //Si no se ha leido el user se lee ahora
    if (isset($_GET["id_user"]) && ($_GET["id_user"] > 0)) {
      $user = bfRecord(sprintf("SELECT * FROM %susers WHERE id_user = %s", $tables_preffix, $_GET['id_user']));
	  foreach ($user as $field => $value) {
	    $data[$field] = $value;
      }
    } else {
      header("Location: index.php");
	}
  }

  $groups = bfTable(sprintf("SELECT * FROM %sgroups ORDER BY name ASC", $tables_preffix), "id_group");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['cpanel']['users']['edit_user']; ?></title>
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
      <th width="99%" align="left" valign="middle" background="../../images/borders/topBorder.jpg"><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['all']['control_panel']; ?> - <?php echo $lang['cpanel']['users']['edit_user']; ?></th> 
      <th width="4" background="../../images/borders/right_topCorner.jpg"></th> 
    </tr> 
    <tr> 
      <td background="../../images/borders/leftBorder.jpg"></td> 
      <td align="left" valign="top"><form action="edit.php" method="POST" name="update" id="update" onSubmit="YY_checkform('update','data[name]','#q','0','<?php echo $lang['cpanel']['users']['name_wrong']; ?>','data[email]','#S','2','<?php echo $lang['cpanel']['users']['email_wrong']; ?>','data[id_group]','#q','1','<?php echo $lang['cpanel']['users']['group_wrong']; ?>');return document.MM_returnValue"> 
          <table width="100%" border="0" cellspacing="3" cellpadding="5" align="center"> 
            <tr align="center"> 
              <td colspan="2"><b><font color="#FF0000"> 
                <?php if (isset($Session["users"]["message"])) { echo $Session["users"]["message"] ; unset ($Session["users"]["message"]); } ?> 
                </font></b></td> 
            </tr> 
            <tr> 
              <td width="34%" align="right"><?php echo $lang['cpanel']['users']['username']; ?>:</td> 
              <td width="66%"><input type="hidden" name="data[id_user]" id="data[id_user]" value="<?php echo (isset($data["id_user"])) ? $data["id_user"] : ""; ?>"> 
                <b><?php echo (isset($data["username"])) ? $data["username"] : ""; ?></b></td> 
            </tr> 
            <tr> 
              <td align="right">*<?php echo $lang['cpanel']['users']['id_group']; ?>:</td> 
              <td><select class="select" name="data[id_group]" id="data[id_group]"> 
                  <option value="0"><?php echo $lang['cpanel']['users']['select_group']; ?>...</option> 
                  <?php while (list($k, $v) = each($groups)) { ?> 
                  <option value="<?php echo $k; ?>"<?php echo ((isset($data["id_group"])) && ($data["id_group"] == $k)) ? " SELECTED" : ""; ?>><?php echo $v->name; ?></option> 
                  <?php } ?> 
                </select></td> 
            </tr> 
            <tr> 
              <td align="right">*<?php echo $lang['cpanel']['users']['name']; ?>:</td> 
              <td><input type="text" class="input" name="data[name]" id="data[name]" value="<?php echo (isset($data["name"])) ? $data["name"] : ""; ?>"></td> 
            </tr> 
            <tr> 
              <td align="right"><?php echo $lang['cpanel']['users']['lastname']; ?>:</td> 
              <td><input type="text" class="input" name="data[lastname]" id="data[lastname]" value="<?php echo (isset($data["lastname"])) ? $data["lastname"] : ""; ?>"></td> 
            </tr> 
            <tr> 
              <td align="right">*<?php echo $lang['cpanel']['users']['email']; ?>:</td> 
              <td><input type="text" class="input" name="data[email]" id="data[email]" value="<?php echo (isset($data["email"])) ? $data["email"] : ""; ?>"></td> 
            </tr> 
            <tr> 
              <td align="right">*<?php echo $lang['cpanel']['users']['homedir']; ?>:</td> 
              <td><input type="text" class="input" name="data[homedir]" id="data[homedir]" value="<?php echo (isset($data["homedir"])) ? $data["homedir"] : ""; ?>"></td> 
            </tr> 
            <tr align="right"> 
              <td>*<?php echo $lang['all']['mandatory_fields']; ?></td> 
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
