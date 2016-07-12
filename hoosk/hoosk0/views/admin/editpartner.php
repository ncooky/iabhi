<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-group"></i>
              <h3><?php echo $this->lang->line('partner_new_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
            <div class="content">
             <?php foreach ($partners as $u) {
			 echo form_open(BASE_URL.'/admin/partners/edited/'.$this->uri->segment(4)); ?>

                <div class="control-group">		
                <?php echo form_error('partnerName', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="partnerName"><?php echo $this->lang->line('partner_new_name'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'partnerName',
						  'id'          => 'partnerName',
						  'class'       => 'span4 disabled',
                          'placeholder' => 'your partner name',
						  'value'		=> set_value('partnerName', $u['partnerName']),
						  
						);
			
						echo form_input($data); ?>

						<p class="help-block"><?php echo $this->lang->line('user_new_message'); ?></p>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">		
                <?php echo form_error('partnerLink', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="partnerLink"><?php echo $this->lang->line('partner_new_link'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'partnerLink',
						  'id'          => 'partnerLink',
						  'class'       => 'span4',
						  'value'		=> set_value('partnerLink', $u['partnerLink']),
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
				<div class="control-group">		
            		<?php echo form_error('file_upload', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="file_upload"><?php echo $this->lang->line('partner_new_logo'); ?></label>
					<div class="controls">
                        <div><img src="<?php if ($u['partnerImg'] != "") { echo BASE_URL.'/uploads/partners/'.$u['partnerImg']; } ?>" id="logo_preloaded" <?php if ($u['partnerImg'] == "") { echo "style='display:none;'"; } ?>></div>
						<img src="<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic" />
						<?php
							$data = array(
								'name'		=> 'file_upload',
								'id'		=> 'file_upload',
								'class'		=> 'span5'
							);
							echo form_upload($data); 
						?>
						<input type="hidden" id="partnerImg" name="partnerImg" />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

                </div><!-- /content -->
                
                <div class="form-actions">
                <?php 	$data = array(
						  'name'        => 'submit',
						  'id'          => 'submit',
						  'class'       => 'btn btn-primary',
						  'value'		=> $this->lang->line('btn_save'),
						);
					 echo form_submit($data); ?> 
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/partners"><?php echo $this->lang->line('btn_cancel'); ?></a>
				</div> <!-- /form-actions -->
               <?php  echo form_close(); 
			 }
			 ?>
                
                <!-- /widget-content --> 
            </div>
          </div>
          <!-- /widget -->
 
         
     </div>
      <!-- /span12 -->

      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<script type="text/javascript">
$(function () {
	
	if(document.getElementById('file_upload'))
		{
			function prepareUpload(event)
			{
				files = event.target.files;
				uploadFiles(event);
			}
	
			function uploadFiles(event)
			{
				event.stopPropagation();
				event.preventDefault();
	
				$('#loading_pic').show();
	
				var data = new FormData();
				$.each(files, function(key, value){ data.append(key, value); });
				
				$.ajax({
					url: '<?php echo BASE_URL; ?>/admin/partners/submit/?files',
					type: 'POST',
					data: data,
					cache: false,
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(data, textStatus, jqXHR){
						if(data!='0')
						{
							$('#logo_preloaded').show();
							document.getElementById('logo_preloaded').src = '<?php echo BASE_URL; ?>/uploads/partners/' + data;
							document.getElementById('partnerImg').value = data;
							$('#loading_pic').hide();
						}
						else
							alert('<?php echo $this->lang->line('partner_image_error'); ?>');
					}
				});
			}
	
			function submitForm(event, data)
			{
				$form = $(event.target);
				var formData = $form.serialize();
				$.each(data.files, function(key, value){ formData = formData + '&filenames[]=' + value; });
	
				$.ajax({
					url: '<?php echo BASE_URL; ?>/admin/partners/submit',
					type: 'POST',
					data: formData,
					cache: false,
					dataType: 'json',
					success: function(data, textStatus, jqXHR){
						if(typeof data.error === 'undefined')
							console.log('SUCCESS: ' + data.success);
						else
							console.log('ERRORS: ' + data.error);
					},
					error: function(jqXHR, textStatus, errorThrown){
						console.log('ERRORS: ' + textStatus);
					},
					complete: function()
					{
						$('#loading_pic').hide();
					}
				});
			}
			
			var files;
			$('input[type=file]').on('change', prepareUpload);
		}
	});	
</script>
<?php echo $footer; ?>
