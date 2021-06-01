<script>
function undisableTxt() {
	document.getElementById("myText01").disabled = false;
	document.getElementById("myText02").disabled = false;
	document.getElementById("myText03").disabled = false;
	document.getElementById("myText04").disabled = false;
	document.getElementById("myText05").disabled = false;
	document.getElementById("myText06").disabled = false;
	document.getElementById("myText07").disabled = false;
	document.getElementById("1").disabled = false;
	document.getElementById("2").disabled = false;
	document.getElementById("3").disabled = false;
  }
function goBack() {
    window.history.back();
}
</script>          
			 <div class="span9" id="content">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Form Add User</div>
                            </div>
							
										<div class="form-actions">
										    <button onclick="undisableTxt()" class="btn btn-primary btn-large">Start</button>  	
										</div>
										
                            <div class="block-content collapse in">
                                <div class="span12">
                                      <fieldset>
				
										<form class="form-horizontal" action="<?php echo base_url();?>user/save_add" method="post">	
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Full Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="fullname" type="text" id="myText01" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">User Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="username" type="text" id="myText02" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">User Pass</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="userpass" type="password" id="myText03" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Manager 1</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="man1" id="1" required>
                                              <option value="0"> Choose </option>
											  <?php 
											  foreach($user->result() as $rows){
											  ?>
												<option value="<?=$rows->id?>" align="justify"><?=strtoupper($rows->fullname);?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Manager 2</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="man2" id="2">
                                              <option value="0"> Choose </option>
											  <?php 
											  foreach($user->result() as $rows){
											  ?>
												<option value="<?=$rows->id?>" align="justify"><?=strtoupper($rows->fullname);?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Manager 3</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="man3" id="3">
                                              <option value="0"> Choose </option>
											  <?php 
											  foreach($user->result() as $rows){
											  ?>
												<option value="<?=$rows->id?>" align="justify"><?=strtoupper($rows->fullname);?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Branch</label>
                                          <div class="controls">
                                            <select name="branch" id="myText04" disabled required>
                                              <option value=""> Choose </option>
											  <?php 
											  foreach($branch->result() as $rows){
											  ?>
												<option value="<?=$rows->kode_branch?>" align="justify"><?=strtoupper($rows->nama_branch);?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">User Level</label>
                                          <div class="controls">
                                            <select name="userlevel" id="myText05" disabled required>
                                              <option value=""> Choose </option>
											  <option value="ks">User</option>
                                            </select>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Department</label>
                                          <div class="controls">
                                            <select name="job" id="myText06" disabled required>
                                              <option value=""> Choose </option>
											  <option value="0">MASTER</option>
                                              <?php 
											  foreach($job->result() as $rows){
											  ?>
												<option value="<?=$rows->kode_dep?>" align="justify"><?=$rows->nama_dep?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
																												
										<div class="form-actions">
										<input type="submit" class="btn btn-success" value="Save" id="myText07" disabled>
                                        </div>
                                    
									<legend></legend>
									</form>
									</fieldset>							
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <!-- /validation -->
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
</html>