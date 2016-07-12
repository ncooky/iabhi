<?php echo $header; ?>
<!-- CONTENT  ===================-->
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="bg-title-header"><h3><?php echo $page['pageTitle']; ?></h3></div>
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="username" class="col-sm-3 control-label pull-left">Username:</label>
                <div class="col-sm-7">
                  <input type="text" name="username" class="form-control" id="username" placeholder="Contoh: jdoe98">
                </div>
              </div>            
              <div class="form-group">
                <label for="namaDepan" class="col-sm-3 control-label pull-left">Nama Depan:</label>
                <div class="col-sm-7">
                  <input type="text" name="firstname" class="form-control" id="namaDepan" placeholder="Contoh: John">
                </div>
              </div>
              <div class="form-group">
                <label for="namaBelakang" class="col-sm-3 control-label">Nama Belakang:</label>
                <div class="col-sm-7">
                  <input type="text" name="lastname" class="form-control" id="namaBelakang" placeholder="Contoh: Doe">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email:</label>
                <div class="col-sm-7">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Contoh: John.doe@email.com">
                </div>
              </div> 
              <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-7">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Contoh: password">
                </div>
              </div> 
              <div class="form-group">
                <label for="con_password" class="col-sm-3 control-label">Password <small>(konfirmasi)</small></label>
                <div class="col-sm-7">
                  <input type="password" name="con_password" class="form-control" id="con_password" placeholder="Contoh: password">
                </div>
              </div>               
              <div class="form-group">
                <label for="mobile" class="col-sm-3 control-label">Mobile:</label>
                <div class="col-sm-7">
                  <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Contoh: 08579787896">
                </div>
              </div>                                        
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> saya seorang Pelajar / Mahasiswa
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3">
                    <?=$cap['image'];?>
                </div>
                <div class="col-sm-7">
                  <input type="text" name="captcha" class="form-control" id="captcha" placeholder="masukkan captcha disini">
                </div>                                
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                  <button type="submit" class="btn btn-default">Daftar</button>
                  <button type="cancel" class="btn btn-default">Batal</button>
                </div>
              </div>
            </form>
        </div>    
    </div>
</div>
<!-- /CONTENT ===================-->
<?php echo $footer; ?>