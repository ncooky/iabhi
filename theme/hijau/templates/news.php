<?php echo $header; ?>
<!-- JUMBOTRON 
=================================-->
<?php if ($page['enableSlider'] == 1 || $page['enableJumbotron'] == 1) { ?>    
<div class="jumbotron text-center <?php if ($page['enableJumbotron'] == 1) { echo "jumbo-padding"; } ?>">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
			<?php if ($page['enableJumbotron'] == 1) { echo $page['jumbotronHTML']; } ?>        
        </div>
      </div>
    </div> 
</div>
<?php } ?> 
<!-- /JUMBOTRON container-->
<!-- CONTENT
=================================-->
<?php $totSegments = $this->uri->total_segments();
		if(!is_numeric($this->uri->segment($totSegments))){
		$offset = 0;
		} else if(is_numeric($this->uri->segment($totSegments))){
		$offset = $this->uri->segment($totSegments);
		}
		$limit = 10;
?>
<div class="container">
    <?php echo $page['pageContentHTML']; ?>
    <div class="row">
    	<div class="col-md-4"><div class="row">
           <div class="col-md-10"><?php getLatestNewsSidebarBox(); ?></div>
           <div class="col-md-10"><h3>Kategori:</h3><?php getCategories(); ?></div></div>
        </div>
        <div class="col-md-8">
			<div class="row">
			<div class="col-md-12"><?php getLatestNews($limit,$offset); ?></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php getPrevBtn($limit,$offset); ?>
                    <?php getNextBtn($limit,$offset); ?>
                </div>
            </div>
        	<div class="col-md-12 text-center"><p class="meta"><?php countPosts($limit,$offset); ?></p></div>
        </div>
    </div>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>