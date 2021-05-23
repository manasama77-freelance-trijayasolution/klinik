	
	<?php
		$id = $this->uri->segment(3);
		if ($id > "0"){
	?>
		<script>
		window.open("<?php echo base_url();?>cashier/print_receipt/<?php echo $id_bh;?>/<?php echo $id_billing;?>", "", "width=700, height=550, top=60, left=0");
		</script>
		
	<?php
		}
	?>	

		
	<script>
	  function undisableTxt(){
		document.getElementById("myText123").disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
		window.open("<?php echo base_url();?>cashier/list_billing","Popup","width=1200px, height=500px, top=70, left=80");
      }
	  
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Patient Payment</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
                                      
										<form class="form-horizontal" action="<?php echo base_url();?>cashier/payment_process" method="post" name="mark_mcu">
										
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="id_reg" type="text" maxlength="0" autocomplete="off" required>
											<input name="id_pat" type="hidden" id=""  autocomplete="off" >
											<input name="id_bh" type="hidden" value="" autocomplete="off" >
											<button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>
										  </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Billing Number</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="bill_no" type="text" id="bill_no" readonly autocomplete="off" required>
                                             <input class="input-xlarge focused" name="id_billing" type="hidden" id="id_billing" readonly autocomplete="off" required>
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" type="text" id="" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>		
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" id="myText03" readonly autocomplete="off" >
                                           <input class="input-xlarge focused" name="id_client" type="hidden">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="package_name" type="text" id="" readonly autocomplete="off" > 	
											<input class="input-xlarge focused" name="id_package" type="hidden" > 	
                                          </div>
                                        </div>
											
										<div class="form-actions">
										<button type="submit" class="btn btn-success">Search</button>
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
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>