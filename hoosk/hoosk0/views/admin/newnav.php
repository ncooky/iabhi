<?php echo $header; ?> 
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span4">
          <div class="widget">
            <div class="widget-header"> <i class="icon-list"></i>
              <h3><?php echo $this->lang->line('menu_new_pages'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
             <div class="control-group">		
             		
					<?php $attr = array('id' => 'navForm');
					echo form_open('admin/navigation/insert', $attr); ?>	

            		<?php echo form_error('navSlug', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="navSlug"><?php echo $this->lang->line('menu_new_nav_slug'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navSlug',
						  'id'          => 'navSlug',
						  'class'       => 'span3',
						  'maxlength'		=> '10',
						  'value'		=> set_value('navSlug', '', FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
                 <div class="control-group">		
            		<?php echo form_error('navTitle', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="navTitle"><?php echo $this->lang->line('menu_new_nav_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navTitle',
						  'id'          => 'navTitle',
						  'class'       => 'span3',
						  'value'		=> set_value('navTitle', '', FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
              	<hr />
                <h3><?php echo $this->lang->line('menu_new_add_page'); ?></h3>
                <hr />
             <div class="control-group">		
					<label class="control-label" for="pagesList"><?php echo $this->lang->line('menu_new_select_page'); ?></label>
					<div class="controls">
						
                       <?php $att = 'id="pagesList" class="span3"';
				$data = array();
				foreach ($pages as $p){
				$data[$p['pageURL']] = $p['navTitle'];	
				}
				echo form_dropdown('pagesList', $data, '1', $att); ?>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->  
      		<div class="control-group">		
					<div class="controls">
           				<a class="btn btn-primary" onClick="addNav()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->				
			</div> <!-- /control-group -->  
            <hr />
            <div class="control-group">		
					<label class="control-label" for="customlinkTitle"><?php echo $this->lang->line('menu_new_custom_title'); ?></label>
					<div class="controls">
						
                       <input type="text" id="customlinkTitle" value="" />

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->  
            <div class="control-group">		
					<label class="control-label" for="customURLHREF"><?php echo $this->lang->line('menu_new_custom_link'); ?></label>
					<div class="controls">
						
                       <input type="text" id="customURLHREF" value="http://" />

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
      		<div class="control-group">		
					<div class="controls">
           				<a class="btn btn-primary" onClick="addCustomURL()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->				
			</div> <!-- /control-group -->    
            <hr />
            <h3><?php echo $this->lang->line('menu_new_drop_down'); ?></h3>
            <hr />
               <div class="control-group">		
					<label class="control-label" for="parent"><?php echo $this->lang->line('menu_new_drop_title'); ?></label>
					<div class="controls">
                       <input type="text" id="parentTitle" value="" />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                 <div class="control-group">		
					<label class="control-label" for="parent"><?php echo $this->lang->line('menu_new_drop_link'); ?></label>
					<div class="controls">
                       <input type="text" id="parentSlug" value="" />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
      		<div class="control-group">		
					<div class="controls">
           				<a class="btn btn-primary" onClick="addDropDown()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->				
			</div> <!-- /control-group -->    
            </div> 
          </div>
          <!-- /widget -->
 
         
     </div>
      <!-- /span4 -->

	<div class="span8">
          <div class="widget">
            <div class="widget-header"> <i class="icon-list"></i>
              <h3><?php echo $this->lang->line('menu_new_nav'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
      		<div class="dd" id="navHolder">
   			<ul class="dd-list" id="mainNav">
   
   			</ul>
      		</div>
            <hr />
            <div class="control-group">	
               <input type="hidden" id="seriaNav" name="seriaNav"/>
               <input type="hidden" name="convertedNav" id="convertedNav"/>
                <div class="controls">
                    <a class="btn btn-primary" onClick="serializeNav()"><?php echo $this->lang->line('btn_save'); ?></a>
                </div> <!-- /controls -->				
                <?php echo form_close() ?>
			</div> <!-- /control-group -->  
            </div> 
          </div>
          <!-- /widget -->
 
         
     </div>
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<script type="text/javascript">

function addNav(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var navSelected = $('#pagesList').val();
	$.ajax({
		  url: "<?php echo BASE_URL; ?>/admin/navadd/" + navSelected,
		  type: "POST",
		  success: function(html){
			var navContainer = $('#navContainer'); //jquery selector (get element by id)
              if(html){
				 document.getElementById("mainNav").innerHTML += html;
              }
		  },
		  error: function (html){
			alert('error');
		  }
		});
	
}

function addCustomURL(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var customlinkTitle = document.getElementById("customlinkTitle").value;
	var customURLHREF = document.getElementById("customURLHREF").value;
	if (customlinkTitle != ""){
	newLink = "<li class='dd-item' data-href='" + customURLHREF +"' data-title='" + customlinkTitle +"' data-type='1'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='icon-remove'></i></a><div class='dd-handle'>" + customlinkTitle +"</div></li>";	
	document.getElementById("mainNav").innerHTML += newLink;
	}
}

function addDropDown(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var parentTitle = document.getElementById("parentTitle").value;
	var parentSlug = document.getElementById("parentSlug").value;
	var regexp = /^[a-zA-Z0-9-_]+$/;
	if (parentSlug.search(regexp) == -1)
    { alert('<?php echo $this->lang->line('menu_new_drop_error'); ?>'); }
	else
    {  
	if (parentTitle != "" && parentSlug != ""){
	newLink = "<li class='dd-item parent' data-href='" + parentSlug + "' data-title='" + parentTitle +"'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='icon-remove'></i></a><div class='dd-handle'>" + parentTitle +" <b class='caret dd-caret'></b></div></li>";	
	document.getElementById("mainNav").innerHTML += newLink;
	}}
}

 function updateOutput(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
	
$(document).ready(function()
{

   

    // activate Nestable for list 1
    $('.dd').nestable({
        group: 1,
		listNodeName:'ul',
		maxDepth: 2,
    })
    .on('change', updateOutput);
	 // output initial serialised data
    updateOutput($('.dd').data('output', $('#seriaNav')));
});

function serializeNav(){
    updateOutput($('.dd').data('output', $('#seriaNav')));
  	var jsn = JSON.parse(document.getElementById('seriaNav').value);
  	var parentHREF = '';
	var parseJsonAsHTMLTree = function(jsn) {
    var result = '';
	
jsn.forEach(function(item) {
      if (item.title && item.children) {
        result += '<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">' + item.title + '<b class="caret"></b></a><ul class="dropdown-menu">';
		parentHREF = item.href;
        result += parseJsonAsHTMLTree(item.children);
		parentHREF = "";
        result += '</ul></li>';
      } else {
		  if (parentHREF == ""){
			  	if (item.href != "home"){
					if (item.type != "1"){
        				result += '<li><a href="/' + item.href + '">' + item.title + '</a></li>';
					} else {
			  			result += '<li><a href="' + item.href + '">' + item.title + '</a></li>';
					}
				} else {
				result += '<li><a href="<?php echo BASE_URL; ?>">' + item.title + '</a></li>';
				}				
		  } else {
				if (item.type != "1"){
			  	result += '<li><a href="/' + parentHREF + "/" + item.href + '">' + item.title + '</a></li>';
				} else {
			  	result += '<li><a href="' + item.href + '">' + item.title + '</a></li>';
				}
		  }
      }
    });

    return result + '';
  };

  //var result = '<ul class="nav navbar-nav">' + parseJsonAsHTMLTree(jsn) + '</ul>';
  var result = '<ul class="nav navbar-nav">' + parseJsonAsHTMLTree(jsn);    
  document.getElementById('convertedNav').value = result;
  document.getElementById('seriaNav').value = document.getElementById("mainNav").innerHTML;
  document.getElementById("navForm").submit();
 }
</script>
<?php echo $footer; ?>
