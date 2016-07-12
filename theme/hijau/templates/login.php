<?php echo $header; ?>


<div class="container">
    <div class="row">
          
    
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-body">
            <img src="<?php echo BASE_URL; ?>/images/logo-iabhi.png" class="login_logo" />
            <?php echo form_open(BASE_URL.'/login/check');  ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                   	    <?php if (isset($error)){
        					if ($error == 1){
        						echo "<div class='alert'>Please correct your log in details!</div>";
        					}elseif ($error == 2){
                                echo "<div class='alert'>Your account is not active, please contact IABHI Administrator to activate your account!</div>";
        					}
        				} ?>
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

</div>

<?php echo $footer; ?>