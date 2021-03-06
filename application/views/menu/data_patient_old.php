	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Patient
		</div>
	<?php
		} else if ($id=="add") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Add New User
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
		//Logic Parameter Button
		if ($id=="ok" || $id=="reg"){
			$id="0";
		}elseif ($id==""){
			$id="1";
		}elseif ($id=="edit"){
			$id="2";
		}else{
			$id=$id;
		}
	?>		
<script>
	  function undisableTxt(){
		    if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>patient/data_patient";
		};
		<?php
			$x = 1; 
			while($x <= 28) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			} 
		?>
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }
	  
	  function fetch_select(val){
		$.ajax({
			type: 'post',
			url: 'fetch_prov',
			data: {
			get_option:val
			},
			success: function (response) {
			document.getElementById("new_select").innerHTML=response; 
			}
		});
	  }

</script>
<?php
	if(empty($_SESSION["regsession"])){
	$reg_form = "patient/data_patient";		
	}else{
	$reg_form = $_SESSION["regsession"];
	}
	//echo $reg_form;
	include './design/koneksi/file.php';
	$query 		="SELECT pat_mrn id,cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";  
    if($result 	=mysqli_query($con, $query))
    {
		//$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$counts	=substr($count, 1, strlen($count)-1);
		//$dater 	=$row['dt'];
		//if ($dater == $date) {
		$counts = $counts+1; 	
		//}else{
		//	$count = 1;
		//}		
        $code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);
    }
?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>New Patient</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
																  
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button>									 
							<button class="btn btn-warning btn-large" onclick="goBack()"><b>Back</b></button>
							</div>
										 
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<div id="" style="overflow-y: scroll; height:460px;">
										<form class="form-horizontal" action="<?php echo base_url();?>patient/save_pat" method="post" name="quotation">
										<!-- 
										<div style="float:right;">
										<b>Manual Book : New Patient</b></br>
										<iframe style="border-radius:8px;" width="185px" height="184px" src="https://www.yumpu.com/id/embed/view/lOcdrD6VtMSqUKhb" frameborder="0" allowfullscreen="true" allowtransparency="true"></iframe>
										</div> -->
										
										<div style="float:left;">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput"></label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="hidden" id="myText01" value="<?=$loc;?>" autocomplete="off" readonly>
                                          </div>
                                        </div>
																												
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Number</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" placeholder="KTP, SIM, KITAS, PASSPORT" name="pat_idno" type="text" id="1" maxlength="20" disabled autocomplete="off"> - 
                                              <select name="pat_idtype" id="2"  style="width:110px" disabled>
													<option value="">Type</option>
													<option value="KTP">KTP</option>
													<option value="SIM">SIM</option>
													<option value="KITAS">KITAS</option>
													<option value="PASSPORT">PASSPORT</option>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Medical Record</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" placeholder="Medical Record Number" name="id_his" type="text" id="3" maxlength="20" disabled autocomplete="off">
                                          </div>
                                        </div>
									
										<div class="control-group">
                                          <label class="control-label" for="focusedInput"> <b>Patient Name</b> <font color="red">*</font> </label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" style="text-transform: uppercase;" name="pat_name" type="text" id="4" disabled autocomplete="off" required> - <select name="pat_title" id="5" style="width:80px"  disabled>
                                              <option value="">Title</option>
                                              <?php 
											  foreach($title->result() as $rows){
											  ?>
												<option value="<?=$rows->id_title?>" align="justify"><?=$rows->title_desc?>.</option>
											  <?php
											  }
											  ?>
											</select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01"><b>Gender</b> <font color="red">*</font> </label>
                                          <div class="controls">
                                            <select name="pat_gender" id="6" disabled required>
                                              <option value=""> Choose </option>
                                              <?php 
											  foreach($gender->result() as $rows){
											  ?>
												<option value="<?=$rows->id_gender?>" align="justify"><?=$rows->gender?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
																	
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Place of Birth</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" style="text-transform: capitalize;" name="pat_pob" type="text" id="7" disabled autocomplete="off">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput"><b>Date of Birth</b> <font color="red">*</font> </label>
                                          <div class="controls">
											 <input type="text" name="reg_date" class="input-large datepicker" id="8" value="<?php echo date("m/d/Y");?>" disabled> <i class="icon-calendar"></i>
                                          </div>
                                        </div>	

	

										<div class="control-group">
                                          <label class="control-label" for="select01">Marital Status</label>
                                          <div class="controls">
                                            <select name="pat_marital_status" id="9" disabled>
                                              <option value=""> Choose </option>
                                              <?php 
											  foreach($marital->result() as $rows){
											  ?>
												<option value="<?=$rows->id_status?>" align="justify"><?=$rows->marital_status?></option>
											  <?php
											  }
											  ?>
                                            </select>                                        
                                          </div>
                                        </div>										
																				
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Home Phone</label>
                                          <div class="controls">
										  <input type="text" name="pat_contact_home[1]" maxlength="4" id="10" style="width:45px" placeholder="0XXX" disabled> - <input type="text" id="11" name="pat_contact_home[2]" style="width:118px" maxlength="10" placeholder="XXXX XXXX" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput"> Mobile Phone</label>
                                          <div class="controls">
										  <input type="text" name="pat_contact_misc[1]" maxlength="4" id="12" style="width:45px" placeholder="08XX" disabled> - <input type="text" name="pat_contact_misc[2]" style="width:45px" maxlength="4" id="13" placeholder="XXXX" disabled> - <input type="text" name="pat_contact_misc[3]" style="width:45px" maxlength="4" id="14" placeholder="XXXX" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Email</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" style="text-transform: lowercase;" name="pat_email" type="text" id="15" disabled autocomplete="off">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="">Patient Nationality</label>
                                          <div class="controls">
                                            <select id="16" name="pat_nationality" style="width:285px" disabled>
                                              <option value="0"> Choose </option>
                                              <?php 
											  foreach($national->result() as $rows){
											  ?>
												<option value="<?=$rows->id_nationality?>" align="justify"><?=$rows->nationality?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address Home</label>
                                          <div class="controls">
											<textarea name="pat_address_home" type="text" style="text-transform: capitalize;" id="17" disabled autocomplete="off"></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Province</label>
                                          <div class="controls">
                                            <select id="18" name="pat_province" onchange="fetch_select(this.value);"  disabled>
                                              <option value="0"> Choose </option>
                                              <?php 
											  foreach($province->result() as $rows){
											  ?>
												<option value="<?=$rows->provinsi_id?>" align="justify"><?=$rows->provinsi_nama;?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">City</label>
                                          <div class="controls" id="new_select">                  
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Pos Code</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pos_code" type="text" id="26" maxlength="5" disabled autocomplete="off">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Relative Type</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="19" name="pat_rel_type" disabled>
                                              <option value="0"> Choose </option>
                                              <?php 
											  foreach($relative->result() as $rows){
											  ?>
												<option value="<?=$rows->id_relative?>" align="justify"><?=$rows->relation?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Relative Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_rel_name" type="text" id="20" disabled autocomplete="off">
                                          </div>
                                        </div>
										

										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Relative Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_rel_contact" type="text" id="21" disabled autocomplete="off">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <select id="22" name="id_client" disabled >
                                              <option value="0"> Choose Company Name </option>
                                              <?php 
											  foreach($get_client->result() as $rows){
											  ?>
												<option value="<?=$rows->id_Client?>" align="justify"><?=$rows->client_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
										 </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="select01">Departement</label>
                                          <div class="controls">
                                            <select id="23" name="id_client_dept" disabled >
                                              <option value="0"> Choose Client Dept. </option>
                                              <?php 
											  foreach($get_client_dept->result() as $rows){
											  ?>
												<option value="<?=$rows->id_client_dept?>" align="justify"><?=$rows->client_dept?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="select01">Group</label>
                                          <div class="controls">
                                            <select id="24" name="id_client_job" disabled >
                                              <option value="0"> Choose Client Group </option>
                                              <?php 

											  foreach($get_client_job->result() as $rows){
											  ?>
												<option value="<?=$rows->id_client_job?>" align="justify"><?=$rows->client_job_desc?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Address</label>
                                          <div class="controls">
										  <textarea name="pat_address_misc" type="text" id="25" disabled autocomplete="off" ></textarea>
                                          </div>
                                        </div>
										</div>

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
									                        
									<legend></legend>
									</form>
									</fieldset>                     						
                                </div>
                            </div>
							<div class="form-actions">
							<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
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
		});
		</script>
		<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.popover-left').popover({placement: 'left', trigger: 'hover'});
			$('.popover-right').popover({placement: 'right', trigger: 'hover'});
			$('.popover-top').popover({placement: 'top', trigger: 'hover'});
			$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});

			$('.notification').click(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("Stick this!", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("Hello world!");
					break;
				}
			});
        });
        </script>


		<?php
		mysqli_close($con);
		?>
</html>