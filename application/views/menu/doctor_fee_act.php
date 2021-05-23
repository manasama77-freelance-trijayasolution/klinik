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
		
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
		
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script>
		function undisableTxt(){
			document.getElementById("myText123").disabled = false;
		}
		
		function goBack(){
			window.history.back();
		}
		
		function popup(b_id){
			window.open("<?php echo base_url();?>patient/find_pat_doc","Popup","height=550, width=880, top=70, left=180 ");
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
		<script>
		jQuery(document).ready(function() {   
		FormValidation.init();
		});

		$(function() {
		$(".datepicker").datepicker();
		$(".uniform_on").uniform();
		$(".chzn-select").chosen();
		$('.textarea').wysihtml5();
		});
		</script>
		<?php
			foreach($get_regist->result() as $row_regist){}
		?>	
		<body onload="startTime()">
		<div class="row-fluid">
		  <div class="block">
		    <div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><b>Doctor Fee</b></div>
				<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
			</div>
		  <div class="block-content collapse in">
		<div class="span12">
		<?php
		$ndas = "0";
		foreach($detailother->result() as $row_ver){ $ndas = $row_ver->id_dr; }
		
		if($ndas==""){
		?>
		<form class="form-horizontal" action="<?php echo base_url();?>cashier/save_doctor_fee" method="post" name="mst_pr">
		<?php
		}else{
		?>
		<form class="form-horizontal" action="<?php echo base_url();?>cashier/update_doctor_fee" method="post" name="mst_pr">
		<?php
		}
		?>
        <div class="control-group">
			<label class="control-label" for="focusedInput">ID Registration</label>
			<div class="controls">
			<input class="input-xlarge focused" type="hidden" value="<?=$_POST['id_pat'];?>" name="id_pat">
			<input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" value="<?=$_POST['pat_mrn'];?>" maxlength="0" autocomplete="off" placeholder=" ... " required>
			<input name="id_reg" type="hidden" id=""  value="<?=$_POST['id_reg'];?>"  autocomplete="off" >	
			<input name="type" type="hidden" value="<?=$_POST['type'];?>"  autocomplete="off" >				
			</div>
        </div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Patient Name</label>
		<div class="controls">
			<input class="input-xlarge focused" name="pat_name" type="text" id="myText02" value="<?=$_POST['pat_name'];?>"  maxlength="0" autocomplete="off" >
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Charge Rule</label>
		<div class="controls">
			<input class="input-xlarge focused" name="charge_rule" value="<?=$_POST['charge_rule'];?>" type="text" id="myText03" maxlength="0" autocomplete="off">
			<input type="hidden" name="charge" value="<?=$row_regist->pat_charge_rule?>">
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Age</label>
		<div class="controls">
			<input class="input-xlarge focused" name="pat_age" type="text" id="myText03" value="<?=$_POST['pat_age'];?>" maxlength="0" autocomplete="off">
		</div>
		</div>
					
		<div class="control-group">
		<label class="control-label" for="focusedInput">Company</label>
		<div class="controls">
			<input class="input-xlarge focused" name="client_name" type="text" id="myText03"  value="<?=$_POST['client_name'];?>" maxlength="0" autocomplete="off">
		</div>
		</div>
		
		<div class="row-fluid">
        <!-- block -->
        <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left"><b>Doctor Order List</b></div>
                </div>
                <div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto; padding-bottom: 50px;">
                    <div class="span12">
  			<table class="table table-hover">
		            <thead>
		              <tr>
		                <th><font color="red">No</font></th>
		                <th><font color="red">Services</font></th>
		                <th><font color="red">Doctor</font></th>
		              </tr>
		            </thead>
		            <tbody>
					<?php
						$i=1; $y=1; $v=1;
						$x=1; $z=1;
						foreach($detailother->result() as $row3){
					?>	
		              <tr>
		                <td><?=$i++;?></td>
		                <td><b><?php echo $row3->group_desc;?></b> <?php echo $row3->serv_name;?>, <p><font size="1px"><?php echo $row3->order_date;?></font></p></td>
		                <td>
							<select class="chzn-select" name="id_dr_<?=$z++;?>">
                            <option value="">- Choose Doctor -</option>
                            <?php 
							foreach($get_doctor->result() as $rows){
							?>
							<option value="<?=$rows->id?>" <?php if($rows->id==$row3->id_dr) {echo "selected"; } ?>  align="justify"><?=$rows->fullname?></option>
							<?php
							}
							?>
                            </select>
						</td>
		              </tr>
					  <input type="hidden" value="<?=$x++;?>" name="rowc">
					  <input type="hidden" value="<?=$row3->id_fee_d;?>" name="id_fee_<?=$v++;?>">
					  <input style="display:none;" value="<?php echo $row3->id_fee_d;?>" name="id_service_<?=$y++;?>">
					<?php
						}
					?>
					<!--
					<thead>
					 <tr>
		                <th><font color="red">No</font></th>
		                <th><font color="red">Lab Examination</font></th>
		                <th><font color="red">Doctor</font></th>
		             </tr>
					</thead>
					<?php
						$b=1;
						foreach($detaillab->result() as $row1){
					?>	
		              <tr>
		                <td><?=$b++;?></td>
		                <td><?php echo $row1->lab_item_desc;?>, <p><font size="1px"><?php echo $row1->order_date;?></font></p></td>
		                <td>
						<select class="chzn-select" name="id_dr">
                            <option value="">- Choose Doctor -</option>
                            <?php 
							foreach($get_doctor->result() as $rows){
							?>
							<option value="<?=$rows->id_dr?>" align="justify"><?=$rows->drname?></option>
							<?php
							}
							?>
                        </select>
						</td>
		              </tr>
					<?php
						}
					?>
					<thead>
					 <tr>
		                <th><font color="red">No</font></th>
		                <th><font color="red">Radiology & USG Examination</font></th>
		                <th><font color="red">Doctor</font></th>
		             </tr>
					</thead>
					<?php
						$c=1;
						foreach($detailrad->result() as $row2){
					?>
					 <tr>
						<td valign="center"><?=$c++;?></td>
						<td><?php echo $row2->rad_item;?>, <p><font size="1px"><?php echo $row2->order_date;?></font></p></td>
		                <td>
						<select class="chzn-select" name="id_dr">
                            <option value="">- Choose Doctor -</option>
                            <?php 
							foreach($get_doctor->result() as $rows){
							?>
							<option value="<?=$rows->id_dr?>" align="justify"><?=$rows->drname?></option>
							<?php
							}
							?>
                        </select>
						</td>
					 </tr>
					<?php
						}
					?>
		            </tbody>
		          
				  -->
				  </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>

		</div>
		</div>
		<div class="span12">
		<div id="myAlert" class="modal hide">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">&times;</button>
				<h5>Alert!</h5>
			</div>
			<div class="modal-body">
				<p>Are you sure ? [close] button to check again...</p>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" value="Save" onclick="this.disabled=true;this.form.submit();">
				<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
			</div>
		</div>
		</div>
		<div class="form-actions">
		<div style="float:left;">
			<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
		</div>
		<div style="float:right;">
			<button type="reset" class="btn btn-danger"><b>Reset</b></button>
		</div>
		</div>
		</form>
		</body>