	<?php
		$id = $this->uri->segment(3);
		$xx = $this->uri->segment(4);
	    include './design/fingers/global.php';
    	include './design/fingers/function.php';
		include './design/koneksi/file.php';
		
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$logic 					="update pat_ms_h set locked=0,lock_by=$user_id where id_reg='".$xx."'";  
		//echo $logic;
		if($hasil 	=mysqli_query($con, $logic)){}
	
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
		} else if ($id=="xxx") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Unlock Marking Sheet for ID : <b><?=$xx;?></b>
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
		window.open("<?php echo base_url();?>patient/find_patient_mark_sheet","Popup","width=1400, height=700, top=50, left=10"); 
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
	  }
	</script>
					<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Marking Sheet Medical Check Up</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>patient/mark_sheet_mcu_act" method="post" name="mark_mcu">
										
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" id="" maxlength="0" autocomplete="off" placeholder=" ... " required>
											<input name="id_reg" type="hidden" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" type="hidden" id=""  autocomplete="off" >
											<?php
											if ($id=="edit"){
											?>
												&nbsp;<button type="button" onclick="popup_edit();" class="btn btn-success"><i class="icon-search"></i></button>
											<?php
												} else {
											?>
												&nbsp;<button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>
											<?php
											}
											?>	
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" maxlength="0" autocomplete="off" readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" type="text" id="" maxlength="0" autocomplete="off" readonly> 	
                                          </div>
                                        </div>		
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" id="myText03" maxlength="0" autocomplete="off" readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="pat_mcu" type="text" id="" maxlength="0" autocomplete="off" readonly> 	
                                          </div>
                                        </div>
										
									</fieldset>     
                                </div>
                            </div>
							<div class="form-actions">
							<button type="submit" class="btn btn-success"><b>Search</b></button>
							</div>
							</form>
                        </div>
                        <!-- /block -->
                    </div>
					</body>
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>