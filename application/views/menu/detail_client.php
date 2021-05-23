
<?php
	foreach($list_data->result() as $row){}
?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><b>Detail Company</b></div>
                            </div>
							              <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
																			 
										<form class="form-horizontal" action="<?php echo base_url();?>client/save_client" method="post" name="quotation">		
										<!--
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID client</label>
                                          <div class="controls">
                                            
                                          </div>
                                        </div>
										-->
										<input class="input-xlarge focused" name="id_Client" type="hidden" id="1" value="<?=$row->id_Client;?>" readonly>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Name :</label>
                                          <div class="controls">
                                             <?=$row->client_name;?>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">PIC Name :</label>
                                          <div class="controls">
                                            <?=$row->client_pic;?>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Finance Contact :</label>
                                          <div class="controls">
                                            <?=$row->client_contact_name;?>
                                          </div>
                                        </div>																				
										
										<div class="control-group">                                          
										  <label class="control-label" for="focusedInput">Marketing Contact :</label>                                          
											<div class="controls">										   
                            <?=$row->client_phone;?>
											</div>                                        
										</div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address 1 :</label>
                                          <div class="controls">
                                            <?=$row->client_address1;?>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address 2 :</label>
                                          <div class="controls">
                                            <?=$row->client_address2;?>
                                          </div>
										</div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Fax :</label>
                                          <div class="controls">
                                            <?=$row->client_fax;?>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Mobile :</label>
                                          <div class="controls">
                                            <?=$row->client_mobile;?>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Other Information :</label>
                                          <div class="controls">
                                            <?=$row->client_other;?>
                                          </div>
                                        </div>

									</fieldset>                     						
                                </div>
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