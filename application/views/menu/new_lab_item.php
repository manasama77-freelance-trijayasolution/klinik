		
	<script type="text/javascript">
	  $(function() {
	  $(".uniform_on").uniform();
	  $(".chzn-select").chosen();
	  $('.textarea').wysihtml5();
	  });
		
	  function fetch_select(val)
	  {
	  $.ajax({
	  	type: 'post',
	  	url: 'fetch_data',
	  	data: {
	  	get_option:val
	  	},
	  	success: function (response) {
	  	document.getElementById("new_select").innerHTML=response; 
	  	}
	  });
	  }

	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
        window.open("<?php echo base_url();?>patient/find_patient","Popup","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>lab/mst_lab_item/edit";
	  }

	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>New Lab Item</b></div>
                            </div>
									<div class="form-actions">
										
									</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>										 
										<form class="form-horizontal" action="<?php echo base_url();?>lab/save_item2" method="post" name="mst_service">
										 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Description</label>
                                          <div class="controls">
										  <textarea name="lab_item_desc" id="1" ></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Abbr</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="item_abbr" type="text" id="2" autocomplete="off"  required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Unit</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="item_unit" type="text" id="3" autocomplete="off"  required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Result Type</label>
                                          <div class="controls">
                                            <select name="case" id="4"  required>
                                              <option value="">- Choose -</option>
											  <option value="0">Range Normal</option>
											  <option selected value="1">Kombinasi Karakter</option>
                                            </select>
                                          </div>
                                        </div>
										
									    <div class="control-group">
                                          <label class="control-label" for="select01">Item Group</label>
                                          <div class="controls">
                                            <select name="item_group" id="5" onchange="fetch_select(this.value);"  required >
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($data->result() as $rows){
											  ?>
												<option value="<?=$rows->id_lab_item_group?>"><?=$rows->group_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
																				
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Seq No</label>
                                          <div class="controls" id="new_select">
                                            
                                          </div>
                                        </div>
													
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" id="6" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
                                        </div>
                        
									<legend></legend>
									</form>

						
									
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
		
        <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
		
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
		
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
		
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>