<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-group"></i>
              <h3><?php echo $this->lang->line('partner_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                   
<table class="table table-striped table-bordered">
                <thead>
                  <tr >
                    <th> <?php echo $this->lang->line('partner_name'); ?> </th>
                    <th style="text-align: center;"> <?php echo $this->lang->line('partner_logo'); ?> </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					foreach ($partners as $p) {
						echo '<tr>';
						echo '<td><a href="'.$p['partnerLink'].'" target="_blank" alt="'.$p['partnerLink'].'">'.$p['partnerName'].'</a></td>'; ?>
                        <td style="text-align: center;"><img src="<?php if ($p['partnerImg'] != "") { echo BASE_URL.'/uploads/partners/'.$p['partnerImg']; } ?>" id="logo_preloaded" <?php if ($p['partnerImg'] == "") { echo "style='display:none;'"; } ?>></td>
                    <?php 
						echo '<td class="td-actions"><a href="/admin/partners/edit/'.$p['partnerID'].'" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt'.$p['partnerID'].'"><i class="btn-icon-only icon-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
                <!-- /widget-content --> 
            <?php foreach ($partners as $p) {
			echo '<div id="dlt'.$p['partnerID'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('partner_delete').'"'.$p['partnerName'].'"?</h3>';
            echo '</div><div class="modal-body">';
            echo '<p>'.$this->lang->line('partner_delete_message').'</p></div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
            echo '<a class="btn btn-danger" href="'.BASE_URL.'/admin/partners/delete/'.$p['partnerID'].'">'.$this->lang->line('btn_delete').'</a>';
            echo '</div></div>';
			} ?>
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
