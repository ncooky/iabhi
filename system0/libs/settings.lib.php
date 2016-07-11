<?php
  //Database type (currently only 'mysql' and 'pgsql' are working
  $dbType = "mysql";
  //Database server
  $dbHost = "localhost";
  //Database user
  $dbUser = "m3y7_ariabhi";
  //Database password
  $dbPassword = "arsolution2016";
  //Database name
  $dbName = "m3y7_ariabhi";
  //Table's preffix
  $tables_preffix = "bfe_";
  
  //Path for the created cookies, that is the directory where you store bfExplorer
  //relative to the document root of your web server, for example if you install
  //bfExplorer in the directory '/var/www/htdocs/bfExplorer' (where '/var/www/htdocs'
  //is the document root then $cookiePath should be '/bfExplorer/'
  $cookiePath = "/system0/";
  
  //Language (Now can be en='English' and es='Spanish', you can create aditional
  //translations in the 'lang' directory (if you send it to me I'll publish it in
  //the next version.
  $language = "en";

  /////////////////////////////////////////////////////////////////////
  //  Don't change below this line                                   //
  /////////////////////////////////////////////////////////////////////

  $depth = (isset($depth) && ($depth > 0)) ? $depth : 0;
  $path = '';
  for($i = 0; $i < $depth; $i++) $path .= '../';

  include_once($path . "libs/db/$dbType.lib.php");
  include_once($path . "lang/lang.$language.php");
?>
