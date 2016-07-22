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
$usrlgn = $this->session->userdata('userID');
if(isset($usrlgn)) { 
               
?>    
<!-- anggota -->
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="row parent-menu">
            <ul class="menu">
                <li><a href="">Info Tender</a></li>
                <li><a href="">Status KUM</a></li>
                <li><a href="">Status Gelar Ahli Bangunan Hijau</a></li>
                <li><a href="">Pengaturan Akun</a></li>
                <li><a href="">Profil Pribadi</a></li>
                <li><a href="">Portofolio</a></li>
            </ul>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-8">
        <div class="row">
          <div class="searchbox">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="cari anggota IABHI">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 --> 
         </div>       
    </div>   
            


 
    
    <?php }else{ ?>
    
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
    <?php } ?>


    
    </div>
</div>
<!-- /CONTENT ===================-->
<?php echo $footer; ?>