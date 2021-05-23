                    <!-- morris stacked chart -->
                    <div class="row-fluid">
					<script>
					function popup(){
					window.open("<?php echo base_url();?>patient/find_patient_mark","Popup","width=1400, height=700, top=50, left=10"); 
						}
					</script>
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Upload Image Result</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                      <fieldset>
										<?php echo form_open_multipart('patient/uploadImage', 'name="mark_mcu"')?>
										<div class="control-group">
                                          <div class="controls">
											<input name="id_reg"		type="hidden" id=""  autocomplete="off" >
											<input name="client_name"	type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" 		type="hidden" id=""  autocomplete="off" >
											<input name="pat_name" 		type="hidden" id=""  autocomplete="off" >
											<input name="age" 			type="hidden" id=""  autocomplete="off" >
											<input name="pat_mcu" 		type="hidden" id=""  autocomplete="off" >
                                            <input placeholder="Registration ID" name="pat_mrn" type="text" readonly autocomplete="off" placeholder="..."> <button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>
                                          </div>
                                        </div>
										<input class="btn" type="file" name="userfile" /></br>
										</br>
											<p><button type="submit" class="btn btn-info"><i class="icon-upload"></i> Upload</button></p>
										<?php echo form_close();?>
                                      </fieldset>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
   	            <!-- /wizard -->
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
	$(function() {
		$(".datepicker").datepicker();
		$(".uniform_on").uniform();
		//$(".chzn-select").chosen();
		$('.textarea').wysihtml5();
	});
	</script>
</html>