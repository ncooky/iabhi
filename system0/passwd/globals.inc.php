<?php 
  $depth = 1;
  $module = "group1";
  //$module = "group2";
  //$module = "group3";
  $right = 4;
  
  $path='';
  for ($i = 0; $i < $depth; $i++) $path .= '../';

  include ($path . 'globals.inc.php');
  $images_path = $path; 

  $rights = decbin($right);
  if (!isset($Session['USER']) || (!$Session['UserId'] > 0)) {
   //Debe conectarse 
   header("Location: $path" . "login/index.php");
   die();
  } else 
  if (((bindec ($rights) ^ $Session[$module]) & $Session[$module]) == $Session[$module]) {
    //user doesn't have access
    header("Location: $path"."rights/index.php");
    die();
  }
?>
