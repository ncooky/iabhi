<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $page['pageTitle']; ?> | <?php echo $settings['siteTitle']; ?> </title>
		<meta name="description" content="<?php echo $page['pageDescription']; ?> " />
		<meta name="keywords" content="<?php echo $page['pageKeywords']; ?>" />
	 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <meta name="author" content="Nugraha Saputra"/>
                <meta name="robots" content="NOODP, nofollow"/>
         	<link href="<?php echo THEME_FOLDER; ?>/css/bootstrap.css" rel="stylesheet">
                <link href="<?php echo THEME_FOLDER; ?>/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo THEME_FOLDER; ?>/css/socicon.css" rel="stylesheet">
		<link href="<?php echo THEME_FOLDER; ?>/css/styles.css" rel="stylesheet">
		<link rel="icon" href="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>" type="image/png" sizes="16x16">
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
                <script type="text/javascript" src="<?php echo THEME_FOLDER; ?>/js/jquery.flexisel.min.js"></script> 
                <a href="https://plus.google.com/116224576101547821804?rel=author"></a>
                <a href="https://plus.google.com/116224576101547821804" rel="publisher"></a>       
	</head>
<body>

<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div class="collapse navbar-collapse pull-left">
            <?php hooskNav('header') ?>
        </div>
        <div class="collapse navbar-collapse pull-right">
            <?php hooskNav('headerNavR') ?>
        </div>
    </div><!-- /.container -->
   
</nav><!-- /.navbar -->


  	<div class="container paddingtop">
      <div class="row">
        <div class="col col-md-4 col-xs-12">
			<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>" alt="Hoosk"></a>
     
        </div>
          <div class="col-md-4 locale searchbox">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="cari di website IABHI...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Cari !</button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
      </div>
    </div>    

