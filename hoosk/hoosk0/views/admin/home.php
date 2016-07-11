<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-dashboard"></i>
              <h3><?php echo $this->lang->line('dash_welcome'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                    <div class="text">
                    <p><?php echo $this->lang->line('dash_message'); ?></p>
                    </div>
                <!-- /widget-content --> 
            </div>
          </div>
          <!-- /widget -->

          <div class="widget action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $this->lang->line('dash_newuser'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
               <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line('user_username'); ?> </th>
                    <th> <?php echo $this->lang->line('user_email'); ?> </th>
                    <th class="td-actions"> Activation </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					foreach ($newUser as $u) {
						echo '<tr>';
						echo '<td>'.$u['userName'].'</td>';
						echo '<td>'.$u['email'].'</td>';
						echo '<td class="td-actions"><a data-toggle="modal" role="button" class="btn btn-warning btn-small" href="#act'.$u['userID'].'"><i class="btn-icon-only icon-ok"> </i></a><a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt'.$u['userID'].'"><i class="btn-icon-only icon-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              
                <!-- /widget-content --> 
            <?php foreach ($newUser as $u) {
			echo '<div id="dlt'.$u['userID'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('user_delete').'"'.$u['userName'].'"?</h3>';
            echo '</div><div class="modal-body">';
            echo '<p>'.$this->lang->line('user_deleteA_message').'</p></div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
            echo '<a class="btn btn-danger" href="'.BASE_URL.'/admin/users/delete/'.$u['userID'].'">'.$this->lang->line('btn_delete').'</a>';
            echo '</div></div>';
            
			echo '<div id="act'.$u['userID'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('user_activate').'"'.$u['userName'].'"?</h3>';
            echo '</div><div class="modal-body">';
            echo '<p>'.$this->lang->line('user_activate_message').'</p></div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
            echo '<a class="btn btn-success" href="'.BASE_URL.'/admin/users/activate/'.$u['userID'].'">'.$this->lang->line('btn_activate').'</a>';
            echo '</div></div>';            
			} ?>
                <!-- /widget-content --> 
            </div>
          </div>
          <!-- /widget -->
         
        </div>
        <!-- /span6 -->
        <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3><?php echo $this->lang->line('dash_recent'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
				<?php 
				function wordlimit($string, $length = 40, $ellipsis = "...")
					{
						$string = strip_tags($string, '<div>');
						$string = strip_tags($string, '<p>');
						$words = explode(' ', $string);
						if (count($words) > $length)
							return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
						else
							return $string.$ellipsis;
					}
				foreach ($recenltyUpdated as $p) {
                echo "<li>";
                	echo '<div class="news-item-date"><span class="news-item-day">'.date("jS", strtotime($p["pageUpdated"])).'</span> <span class="news-item-month">'.date("M", strtotime($p["pageUpdated"])).'</span> </div>';
                  	echo '<div class="news-item-detail"> <a href="/admin/pages/edit/'.$p['pageID'].'" class="news-item-title" target="_blank">'.$p['pageTitle'].'</a>';
                   	echo '<p class="news-item-preview">'.wordlimit($p['pageContentHTML']).'</p>';
                  	echo '</div>';
				echo '</li>';
				} ?>
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->


        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

<?php echo $footer; ?>