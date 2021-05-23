	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Add Insurance
		</div>
	<?php
		} else if ($id=="upd") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Insurance
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Insurance
		</div>
	<?php
		}
	?>		
<script>
	  function undisableTxt() {
		<?php
			$x = 1; 
			while($x <= 12) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			} 
		?>
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }
</script>

                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><b>New Insurance</b></div>
                            </div>
							<div class="form-actions">
								<button onclick="undisableTxt()" class="btn btn-primary">Start</button>   
								<button class="btn btn-warning" onclick="goBack()">Back</button>
								<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="<?php echo base_url();?>client/list_Insurance"><i class="icon-th-large"></i>  List Insurance</a></li>
												<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li>
											</ul>
											</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
																			 
										<form class="form-horizontal" action="<?php echo base_url();?>client/save_insurance" method="post" name="quotation">		
										<!--
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID client</label>
                                          <div class="controls">
                                            
                                          </div>
                                        </div>
										-->
										<input class="input-xlarge focused" name="id_Client" type="hidden" id="1" value="0" readonly>
										
										<!-- <div style="float:right;">
										<b>Manual Book : New Insurance</b></br>
										<iframe style="border-radius:8px;" width="185px" height="184px" src="https://www.yumpu.com/id/embed/view/1ih2nAqWxRlf5dVz" frameborder="0" allowfullscreen="true" allowtransparency="true"></iframe>
										</div> -->
										
										<div style="float:left;">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Insurance Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_name" type="text" id="2" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">PIC Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="picname" type="text" id="3" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Finance Contact</label>
                                          <div class="controls">
											<input type="text" name="pat_contact_home" maxlength="4" id="4" style="width:45px" placeholder="0XXX" disabled> - <input type="text" id="5" name="client_contact_name" style="width:118px" maxlength="10" placeholder="XXXX XXXX" disabled>
                                          </div>
                                        </div>																				
										
										<div class="control-group">                                          
										  <label class="control-label" for="focusedInput">Marketing Contact</label>                                          
											<div class="controls">										   
												<input type="text" name="client_phone" maxlength="4" id="6" style="width:45px" placeholder="08XX" disabled> - <input type="text" name="client_phone2" style="width:45px" maxlength="4" id="7" placeholder="XXXX" disabled> - <input type="text" name="client_phone3" style="width:45px" maxlength="4" id="8" placeholder="XXXX" disabled>                                          
											</div>                                        
										</div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address 1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_address1" type="text" id="9" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address 2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_address2" type="text" id="10" disabled autocomplete="off" required>
                                          </div>
										</div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Fax</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_fax" type="text" id="11"  autocomplete="off" disabled>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Mobile</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_mobile" type="text" id="12"  autocomplete="off" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Other Information</label>
                                          <div class="controls">
                                            <textarea name="other"></textarea>
                                          </div>
                                        </div>
										</div>
									</fieldset>                     						
                                </div>
                            </div>
								<div class="form-actions">
								<input type="submit" class="btn btn-success" value="Submit">
                                </div>
                        </div>
									</form>
                        
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
</html>