<?php echo $header; ?>
<!-- CONTENT  ===================-->
<?php $totSegments = $this->uri->total_segments();
		if(!is_numeric($this->uri->segment($totSegments))){
		$offset = 0;
		} else if(is_numeric($this->uri->segment($totSegments))){
		$offset = $this->uri->segment($totSegments);
		}
		$limit = 10;
?>
<div class="container">
    <div class="row">
<?php 

if(isset($usrlgn)) { 
                if($this->session->userdata('status') == 1){
?>    
<!-- anggota -->

            <?php }else{?>
<!--  umum  -->

    <div class="col-xs-12 col-sm-8 col-md-12">
          <div class="searchbox">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="cari anggota IABHI">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->        
    </div>    
    
    <?php }}else{ ?>
    
    <?php } ?>


    
    </div>
</div>
<!-- /CONTENT ===================-->
<?php echo $footer; ?>