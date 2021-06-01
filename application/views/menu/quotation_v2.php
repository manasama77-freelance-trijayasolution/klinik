	
	<script>
	  function undisableTxt(){
		<?php
			$x = 1; 
			while($x <= 3) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	
				<body>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>New Quotation</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large">Start</button>
																	 
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle">Menu<span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>marketing/list_quotation"><i class="icon-th-large"></i> My Quotation</a></li>
								<?php if ($userlevel != "user"){?>
								<li><a href="<?php echo base_url();?>marketing/list_quotation_app"><i class="icon-th-large"></i> My Quotation Staff</a></li>
								<?php }?>
								<li><a href="<?php echo base_url();?>marketing/group_package"><i class="icon-th-large"></i> Master Group Package</a></li>
								<li><a href="#" onclick="list_all_item()" ><i class="icon-th-large"></i> List All Item </a></li>
							 </ul>
							</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>

										<form class="form-horizontal" action="<?php echo base_url();?>marketing/quotation_process_v2" method="post" name="quotation">
										
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Marketing</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="10" style="width: 400px;" name="mkd_id" required>
                                              <option value="">- Choose Marketing Name -</option>
											  <option value="001">Office (Website, Onsite)</option>
                                              <?php 
											  foreach($get_sales->result() as $rows){
											  ?>
												<option value="<?=$rows->id?>" align="justify"><?=$rows->fullname?></option>
											  <?php
											  }
											  ?>
                                            </select> <font color="red">*required</font>
                                          </div>
                                        </div>



										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="2" style="width: 800px;" name="p_client" required>
                                              <option value="">- Choose Company Name -</option>
                                              <?php 
											  foreach($get_client->result() as $rows){
											  ?>
												<option value="<?=$rows->id_package?>" align="justify"><?=$rows->client_name?> | <?=$rows->package_name?></option>
											  <?php
											  }
											  ?>
                                            </select> <font color="red">*required</font>
                                          </div>
                                        </div>


                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Qoutation Name</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="p_name" type="text" id="1" autocomplete="off" value="" disabled required> <font color="red">*required</font>
                                          </div>
                                        </div>

                                        <br><br><br><br><br><br><br><br>
										</fieldset>  
									    </div>
										</div>
										
										<!-- <div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" disabled id="3" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div> -->

										<div class="form-actions">
										<div style="float:right;">
										<input type="submit" class="btn btn-success btn-large" disabled id="3" value="Next">
										<!-- <a href="#myAlert" data-toggle="modal" class="btn btn-success">Next</a> -->
										</div>
										<!-- <button class="btn btn-warning" type="reset">Reset</button>  -->
                                        </div>
										<legend></legend>
										</form>                   						
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
    <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
    <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
	<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
	<script>
	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
    </script>
</body>