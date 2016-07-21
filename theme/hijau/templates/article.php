<?php echo $header; ?>
<!-- JUMBOTRON 
=================================-->

<!-- <div class="jumbotron text-center">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
        </div>
      </div>
    </div> 
</div> -->

<!-- /JUMBOTRON container-->
<!-- CONTENT
=================================-->

<div class="container">
    <div class="row">
    	<div class="col-md-4"><div class="row">
           <div class="col-md-10"><?php getLatestNewsSidebarBox(); ?></div>
           <div class="col-md-10"><h3>Kategori:</h3><?php getCategories(); ?></div></div>
        </div>
         <div class="col-md-8">
			<div class="row">
            <div class="col-md-12">
                <div itemscope="" itemtype="http://schema.org/Article" class="entry-article">
                    <div class="bg-title-header"><h1><?php echo $page['pageTitle']; ?></h1></div>
                    <div class="bg-entry-header">
                        <?php $date = date_create($page['datePosted']); ?>
                        <span class="bg-entry-header-section">Dipublikasi pada <strong itemprop="datePublished" content="<?php echo date_format($date,'Y-m-d');?>"><?php echo date_format($date,'j M Y');?></strong></span>
                        <span class="bg-entry-header-section">Ditulis oleh &nbsp;<span itemprop="author" itemscope="" itemtype="http://schema.org/Person"> <strong><?php echo ' '.$page['firstName'].' '; if($page['midName'] !== ""){echo $page['midName'].' ';}; echo $page['lastName']; ?></strong></span></span>
                        <span class="bg-entry-header-section">Diposting pada <strong><a href="<?php echo BASE_URL."/category/".$page['categorySlug']; ?>"><?php echo $page['categoryTitle']; ?></a></strong></span>
                    </div>
                </div>
            </div>
            
			</div>
            <div class="row">
            <div class="col-md-12"><?php echo $page['postContent']; ?></div>
            </div>
            </div>
        </div>
  	<hr>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>