<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $this->lang->line('user_edit_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="content">
                 <?php foreach ($users as $u) {
    			 echo form_open(BASE_URL.'/admin/users/edited/'.$this->uri->segment(4)); ?>
                    <div class="container">
                    <div class="rows">
                    <div class="col col-md-4">    
                        <div class="control-group">		
                        <?php echo form_error('username', '<div class="alert">', '</div>'); ?>									
        					<label class="control-label" for="username"><?php echo $this->lang->line('user_new_username'); ?></label>
        					<div class="controls" data-toggle="tooltip" title="<?php echo $this->lang->line('user_new_message'); ?>">
                            <?php 	$data = array(
        						  'name'        => 'username',
        						  'id'          => 'username',
        						  'class'       => 'span4 disabled',
        						  'value'		=> set_value('username', $u['userName']),
        						  'disabled'	=> ''
        						);
        			
        						echo form_input($data); ?>

        					</div> <!-- /controls -->				
        				</div> <!-- /control-group -->
        
        				<div class="control-group">		
                        <?php echo form_error('email', '<div class="alert">', '</div>'); ?>									
        					<label class="control-label" for="email"><?php echo $this->lang->line('user_new_email'); ?></label>
        					<div class="controls">
        						 <?php 	$data = array(
        						  'name'        => 'email',
        						  'id'          => 'email',
        						  'class'       => 'span4',
        						  'value'		=> set_value('email', $u['email']),
        						);
        			
        						echo form_input($data); ?>
        
        					</div> <!-- /controls -->				
        				</div> <!-- /control-group -->
                        
                        <div class="control-group">		
                        <?php echo form_error('password', '<div class="alert">', '</div>'); ?>									
        					<label class="control-label" for="password"><?php echo $this->lang->line('user_new_pass'); ?></label>
        					<div class="controls">
        						<?php 	$data = array(
        						  'name'        => 'password',
        						  'id'          => 'password',
        						  'class'       => 'span4',
        						  'value'		=> set_value('password')
        						);
        			
        						echo form_password($data); ?>
        					</div> <!-- /controls -->				
        				</div> <!-- /control-group -->
        
        				<div class="control-group">	
                        <?php echo form_error('con_password', '<div class="alert">', '</div>'); ?>									
        					<label class="control-label" for="con_password"><?php echo $this->lang->line('user_new_confirm'); ?></label>
        					<div class="controls">
        						<?php 	$data = array(
        						  'name'        => 'con_password',
        						  'id'          => 'con_password',
        						  'class'       => 'span4',
        						  'value'		=> set_value('con_password')
        						);
        			
        						echo form_password($data); ?>
        					</div> <!-- /controls -->				
        				</div> <!-- /control-group -->
                    </div>
                    <div class="col col-md-4">
                        <div class="control-group">	
                        <?php echo form_error('firstName', '<div class="alert">', '</div>'); ?>		
        					<label class="control-label" for="firstName"><?php echo $this->lang->line('user_new_firstname'); ?></label>
        					<div class="controls">
                            <?php 	$data = array(
        						  'name'        => 'firstName',
        						  'id'          => 'firstName',
        						  'class'       => 'span4',
        						  'value'		=> set_value('firstName', $u['firstName']),
        						  
        						);
        			
        						echo form_input($data); ?>
        
        						
        					</div> <!-- /controls -->  
                        </div>
                        <div class="control-group">
                        <?php echo form_error('midName', '<div class="alert">', '</div>'); ?>		
        					<label class="control-label" for="midName"><?php echo $this->lang->line('user_new_midname'); ?></label>
        					<div class="controls">
                            <?php 	$data = array(
        						  'name'        => 'midName',
        						  'id'          => 'midName',
        						  'class'       => 'span4',
        						  'value'		=> set_value('midName', $u['midName']),
        						  
        						);
        			
        						echo form_input($data); ?>
        
        						
        					</div> <!-- /controls -->                          
                        </div>                        
                        <div class="control-group">
                        <?php echo form_error('lastName', '<div class="alert">', '</div>'); ?>		
        					<label class="control-label" for="lastName"><?php echo $this->lang->line('user_new_lastname'); ?></label>
        					<div class="controls">
                            <?php 	$data = array(
        						  'name'        => 'lastName',
        						  'id'          => 'lastName',
        						  'class'       => 'span4',
        						  'value'		=> set_value('lastName', $u['lastName']),
        						  
        						);
        			
        						echo form_input($data); ?>
        
        						
        					</div> <!-- /controls -->                          
                        </div>
                        <div class="control-group">
                        <?php echo form_error('role', '<div class="alert">', '</div>'); ?>		
        					<label class="control-label" for="role"><?php echo $this->lang->line('user_new_role'); ?></label>
        					<div class="controls">
                        <?php 
                            if ($this->session->userdata('roleID') == 1){
                                $use = $userRole;
                            } else {
                                $use = $userRoleNA;
                            }
                                 echo form_dropdown('role', $use, $u['roleID'], 'id="role" class="span4"');?>
        
        						
        					</div> <!-- /controls -->                          
                        </div>                        
                    </div>
                    </div>
                    </div>
                </div><!-- /content -->
                
                <div class="form-actions">
                <?php 	$data = array(
						  'name'        => 'submit',
						  'id'          => 'submit',
						  'class'       => 'btn btn-primary',
						  'value'		=> $this->lang->line('btn_save'),
						);
					 echo form_submit($data); ?> 
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/users"><?php echo $this->lang->line('btn_cancel'); ?></a>
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
<?php echo $footer; ?>
