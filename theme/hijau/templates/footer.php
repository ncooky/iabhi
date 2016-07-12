    <div class="modal fade" style="padding-top: 10%;" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLbl">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="padding: 5px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="text-align: center;" id="LoginModalLbl">Log in anggota IABHI</h4>
          </div>
          <div class="modal-body">
            
            <?php echo form_open(BASE_URL.'/login/check');  ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                   
                        <div class="form-group">
                            <label for="username">Nama Pengguna</label>
                            <input class="form-control" id="username" name="username" placeholder="username anda">
                        </div> 
                        <div class="form-group">
                            <label for="password">Sandi</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="kata kunci anda">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Masuk</button>
                        </div>
                        <div class="form-group">
                            <a href="">Lupa Kata Sandi??</a>
                        </div>                        
                        
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer " style="text-align: center;">
                Tidak Memiliki Akun? <a href="<?php echo BASE_URL.'/daftar';  ?>">Daftar &raquo;</a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- FOOTER
    =================================-->
    <footer id="love">
    <div class="container">
        <div class="row">
            <div class="directory">
                <div class="col-md-3 ">
                    <img src="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>" alt="IABHI"></a><br />
                    <h3 class="title logo"><?php echo $settings['siteTitle']; ?></h3>
                    <?php echo $settings['siteAddress']; ?><br />
                    <i class="fa fa-phone"></i>  <?php echo $settings['sitePhone']; ?><br />
                    <i class="fa fa-fax"></i>  <?php echo $settings['siteFax']; ?><br />
                    <i class="fa fa-envelope-o"></i> <?php echo $settings['siteEmail']; ?> <br /><br />              
                </div>
                  <div class="clearfix visible-xs-block"></div>
                <div class="col-md-3 ">
                    <h3 class="title love">Direktori</h3>
                    <ul class="section-list">
                        <li><a href="">Sample Direktori 1</a></li>
                        <li><a href="">Sample Direktori 2</a></li>
                        <li><a href="">Sample Direktori 3</a></li>
                        <li><a href="">Sample Direktori 4</a></li>
                        <li><a href="">Sample Direktori 5</a></li>
                    </ul>
                    <p></p>            
                </div>    
                  <div class="clearfix visible-xs-block"></div>            
                <div class="col-md-3">
                    <h3 class="title love">Acara</h3>
                    <ul class="section-list">
                        <li><a href="">Sample Acara 1</a></li>
                        <li><a href="">Sample Acara 2</a></li>
                        <li><a href="">Sample Acara 3</a></li>
                        <li><a href="">Sample Acara 4</a></li>
                        <li><a href="">Sample Acara 5</a></li>
                    </ul>            
                </div>
                  <div class="clearfix visible-xs-block"></div>
                <div class="col-md-3">
                    <h3 class="title love">Partners</h3>
                    <?php getTop5PartnersBottom();?><br />
                    <p><a href="http://iabhi.or.id/fanggota/form_anggota.php" target="_blank" onclick="window.open('http://iabhi.or.id/fanggota/form_anggota.php','Daftar Menjadi Anggota IABHI','scrollbars=yes,resizable=yes,dependent=yes,left='+(screen.availWidth/2-0)+',top='+(screen.availHeight/2-0)+'');return false;"><img src="<?php echo BASE_URL; ?>/images/daftar.png" /></a></p>            
                </div> 
            </div>                       
        </div>
        <section class="low-footer">
                <div class="col-md-6 legal">
                <p><?php echo $settings['siteFooter']; ?></p>
                </div>
                <div class="col-md-5 soicons locale legal">
                 <?php getSocial(); ?>
                </div> 
        </section>

    </div>
    </footer>

	<!-- /FOOTER ============-->


	</body>
</html>