<?php echo $header; ?>
<!-- JUMBOTRON 
=================================-->
    <?php if ($page['enableSlider'] == 1 || $page['enableJumbotron'] == 1) { ?>
<div class="container">   
 
    <div class="jumbotron text-center <?php if (($page['enableJumbotron'] == 1) && ($page['enableSlider'] == 1)) { echo "carouselpadding"; } elseif (($page['enableJumbotron'] == 1) && ($page['enableSlider'] == 0)) { echo "errorpadding"; } elseif (($page['enableJumbotron'] == 0) && ($page['enableSlider'] == 1)) { echo "slider-padding"; } ?>">
    
    	<?php if ($page['enableSlider'] == 1) { ?>
       
        <div id="carousel" class="carousel slide " data-ride="carousel">
            <?php getCarousel($page['pageID']); ?>
          <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          
        </div>
        <?php } ?>
    <?php if ($page['enableJumbotron'] == 1) { ?>
        <div class="container">
          <div class="row">
    			<?php  echo $page['jumbotronHTML'];  ?>        
            </div>
          </div>
    <?php } ?>
    
    </div> 
</div>
<!-- /end container of jumbotron -->
<?php } ?> 
<!-- /JUMBOTRON container-->

<!-- CONTENT
=================================-->
<div class="container">
    <?php echo $page['pageContentHTML']; ?>
    <br />
    <?php getLatest3articles();?>
 <div class="row">
    <?php getPartnerCarousel();?>
    <script type="text/javascript">
		$(window).load(function() {
			$("#partnerLogo").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
    </script>
  </div>
</div>

<!-- /CONTENT ============-->

<?php echo $footer; ?>