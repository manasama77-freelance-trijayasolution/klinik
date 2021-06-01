        <!--/.fluid-container-->
		<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
		<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
		<script>
		function undisableTxt(){
			document.getElementById("myText123").disabled = false;
		}
		
		function goBack(){
			window.history.back();
		}
		
		function popup(b_id){
			window.open("<?php echo base_url();?>patient/find_pat_doc","Popup","height=550, width=1025, top=70, left=180 ");
		}
		
		function popup_edit(b_id){
			window.open("<?php echo base_url();?>patient/find_patient_mcu","Popup","height=auto,width=auto,scrollbars=1,"+ 
							"directories=1,location=1,menubar=1," + 
							"resizable=1 status=1,history=1 top = 50 left = 100");
		}
		
		function btntest_onclick(){
			window.location.href = "<?php echo base_url();?>lab/order_lab/edit";
		}
		</script>
		
		<body onload="startTime()">
		<div class="row-fluid">
		  <div class="block">
		    <div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><b>Doctor Fee</b></div>
				<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
			</div>
		  <div class="block-content collapse in">
		<div class="span12">
		<form class="form-horizontal" action="<?php echo base_url();?>cashier/doctor_fee_act" method="post" name="mst_pr">
		
        <div class="control-group">
			<label class="control-label" for="focusedInput">ID Registration</label>
			<div class="controls">
			<input class="input-xlarge focused" type="hidden" name="id_pat">
			<input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" maxlength="0" autocomplete="off" placeholder=" ... " required>
			<input name="id_reg" type="hidden" id=""  autocomplete="off" >
			<input name="type" type="hidden" id=""  autocomplete="off" >
			&nbsp; <button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>							
			</div>
        </div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Patient Name</label>
		<div class="controls">
			<input class="input-xlarge focused" name="pat_name" type="text" id="myText02" maxlength="0" autocomplete="off" >
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Charge Rule</label>
		<div class="controls">
			<input class="input-xlarge focused" name="charge_rule" type="text" id="myText03" maxlength="0" autocomplete="off">
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Age</label>
		<div class="controls">
			<input class="input-xlarge focused" name="pat_age" type="text" id="myText03" maxlength="0" autocomplete="off">
		</div>
		</div>
					
		<div class="control-group">
		<label class="control-label" for="focusedInput">Company</label>
		<div class="controls">
			<input class="input-xlarge focused" name="client_name" type="text" id="myText03" maxlength="0" autocomplete="off">
		</div>
		</div>
	
		</div>
		</div>
				<div class="form-actions">
			<button type="submit" class="btn btn-success">Submit</button>
        </div>
		</form>
		</div>
		</div>
		</body>