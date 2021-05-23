	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Marking Sheet Medical Check Up
		</div>
	<?php
		} else if ($id=="update") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Marking Sheet Medical Check Up
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete User
		</div>
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
		window.open("<?php echo base_url();?>patient/find_patient_doctor","Popup","height=550, width=880, top=70, left=180 ");
      }
	  
	  function popup_lab(){
        window.open("<?php echo base_url();?>lab/order_lab","","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
	  }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
	  }
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Doctor Order</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>docter/save_doc_order" method="post" name="quesioner_mcu">		
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" readonly autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" id="test"  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" type="hidden" id=""  autocomplete="off" >
											&nbsp; <button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="pat_age" type="text" id="myText03" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Client Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" id="myText03" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<hr></hr>
										<div style="position: absolute; left:20px; center:15px;"><b>Medical Treatment</b></div>
										<div class="well" style="margin-top:30px;">
							            <button type="button" onclick="popup_lab();" class="btn btn-inverse">LAB</button>
										<button class="btn btn-inverse">RADIOLOGY</button>
										<button class="btn btn-inverse">PHARMACY</button>
										<button class="btn btn-inverse">VACCINE</button>
							            </div>
										<hr></hr>
									
										<div class="control-group">
                                          <label class="control-label" for="textarea2">(S)</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 410px; height: 100px"></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="textarea2">(O)</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 410px; height: 100px"></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="textarea2">(A)</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 410px; height: 100px"></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="textarea2">(P)</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 410px; height: 100px"></textarea>
                                          </div>
                                        </div>
											
										<div class="form-actions">
										<button type="submit" class="btn btn-success">Submit</button>
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