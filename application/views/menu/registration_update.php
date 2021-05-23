	<?php
		$id       = $this->uri->segment(3);
		$id_reg   = $this->uri->segment(4);
		$pat_name = $this->uri->segment(5);
		if($id=="ok"){
	?>
<div class="alert alert-success">
	<button class="close" data-dismiss="alert">&times;</button>
	<strong>Success!</strong> Registration
</div>
<?php
}
if($id_reg) {?>
<script>
window.open("<?php echo base_url();?>registration/print_detail_regpatient/<?php echo $id;?>", "", "width=700, height=550");
</script>
<?php
}
?>
<script>
function getComboA(sel) {
    var value = sel.value;  
	if (sel.value == "2"){
		var y = document.getElementById("id_ins_div").style.display ='';
	}else{
		var y = document.getElementById("id_ins_div").style.display ='none';
	}
	//alert(sel.value);
}
function getComboB(sel) {
    var value = sel.value; 
	if (sel.value != "0"){
		var y = document.getElementById("id_cli_div").style.display ='';
	}else{
		var y = document.getElementById("id_cli_div").style.display ='none';
	}
	//alert(sel.value);
}
</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Patient Data Registration</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<div id="" style="overflow-y: auto; height:auto;">
                                    <form action="<?php echo base_url();?>registration/reg_update_process" method="post" class="form-horizontal" id="form_sample_1" name="quesioner_mcu">
                                    <fieldset>
										<div class="alert alert-error hide" style="width: 550px;">
										<button class="close" data-dismiss="alert">&times;</button>
										You have some form errors. Please check below.
										</div>
										
										<div class="alert alert-success hide" style="width: 550px;">
										<button class="close" data-dismiss="alert">&times;</button>
										Your form validation is successful!
										</div>
                                        <div class="control-group">
                                              <?php 
											  foreach($get_branch->result() as $rows){
											  $codebranch = $rows->kode_company;
											  }
											  foreach($get_data->result() as $row_data){}
											  ?>
                                        <label class="control-label" for="disabledInput">ID Registration</label>
                                          <div class="controls">
											 <input class="input-mini" value="<?php echo $codebranch;?>" name="codebranch" type="text" readonly>
											 <input class="input-medium disabled" id="id_reg" value="<?=$id;?>" name="id_reg" type="text" readonly>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-large" id="pat_mrn" readonly name="pat_mrn" data-required="1" value="<?=$row_data->pat_name;?>" type="text" required>
											<span for="pat_mrn" class="help-inline"></span>
                                          </div>
                                        </div>
					
                                        <div class="control-group">
                                          <label class="control-label" for="">Date of Registration</label>
											<div class="controls">
                                            <input type="text" name="reg_date" class="input-large datepicker" id="reg_date" value="<?=date("d-m-Y",strtotime($row_data->reg_date))?>"> <i class="icon-calendar"></i>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="select01">Patient Charge Rule</label>
                                          <div class="controls">
											<input class="input-large" id="pat_mrn" readonly name="pat_mrn" data-required="1" value="<?=$row_data->price_type;?>" type="text" required>
											<span for="pat_charge_rule" class="help-inline"></span>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="select01">Insurance Company <span class="required">*</span></label>
                                          <div class="controls">
                                            <select class="chzn-select" name="insurance_comp" >
                                              <option value="0">- Choose Insurance -</option>
                                              <?php 
											  foreach($get_insurance->result() as $rows){
											  	if ($row_data->insurance_comp == $rows->id_ins_comp) {
											  		$xins_name = "selected";
											  	}else{
                                              		$xins_name = "";
											  	}
											  ?>
												<option value="<?=$rows->id_ins_comp?>" align="justify" <?php echo $xins_name; ?> ><?=$rows->ins_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<readonly button class="btn-mini tooltip-right" data-original-title="Insurance Company adalah perusahaan Asuransi Kesehatan yang akan membayarkan tagihan pasien."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>
																			
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="id_client" name="id_client" onchange="getComboB(this)" >
                                              <option value="0">- Choose Company Name -</option>
                                              <?php 
											  foreach($get_client->result() as $rows){
											  	if ($rows->client_name == $row_data->client_name) {
											  		$xclient_name = "selected";
											  	}else{
                                              		$xclient_name ="";
											  	}
											  ?>
												<option value="<?=$rows->id_Client?>" align="justify" <?php echo $xclient_name;?> ><?=$rows->client_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<readonly button class="btn-mini tooltip-right" data-original-title="Tempat pasien bekerja."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>


										<div id="id_cli_div">
										<div class="control-group">
                                          <label class="control-label" for="select01">Company Dept.</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_client_dept">
                                              <option value="0">- Choose Company Dept. -</option>
                                              <?php 
											  foreach($get_client_dept->result() as $rows){
											  	if ($rows->id_client_dept == $row_data->id_client_dept) {
											  		$xcd = "selected";
											  	}else{
                                              		$xcd ="";
											  	}
											  ?>
											  <option value="<?=$rows->id_client_dept?>" align="justify" <?php echo $xcd;?> ><?=$rows->client_dept?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
																						
                                        <div class="control-group">
                                          <label class="control-label" id="" for="select01">Job Position</label>
                                          <div class="controls">								
											<input type="text" value="<?php echo $row_data->id_client_job;?>" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 250px;font-style: oblique; text-transform: capitalize;" class="span6" id="typeahead" name="id_client_job" data-provide="typeahead" data-items="20" data-source='[<?php foreach($get_client_job->result() as $row){ echo '"'.$row->client_job_desc.'",'; }?>""]' autocomplete="off">
                                          </div>
                                        </div>
										</div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="">Notes</label>
                                          <div class="controls">
                                            <textarea class="" name="misc_notes" id="notes" placeholder="Optional" style="width: 400px; height: 50px; text-transform: capitalize;"> <?=$row_data->misc_notes;?> </textarea>
											<readonly button class="btn-mini tooltip-right" data-original-title="Apabila ada catatan tambahan mengenai pasien bisa ditulis disini, apabila tidak ada abaikan saja."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>
										
 
<!-- Fitur untuk cancel registrasi . . . 									
										<div class="control-group">
										  <label class="control-label" for="disabledInput">Package </label>
                                          <div class="controls">
											<input class="input-large" id="pat_mrn" readonly name="pat_mrn" data-required="1" value="<?=$row_data->package_name;?>" type="text" required>
										  </div>
										 </div>
                    																						
                                        <div class="control-group">
                                          <label class="control-label" for="select01">Doctor</label>
                                          <div class="controls">
                                           <input class="input-large" id="pat_mrn" readonly name="pat_mrn" data-required="1" value="<?=$row_data->drname;?>" type="text" required>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Patient Order</label>
                                          <div class="controls">
											<input class="uniform_on" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">Data
										    <input class="uniform_on" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">Data
											<input class="uniform_on" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">Data
                                          </div>
                                        </div>	
										
										
                                        <div class="control-group">
                                          <label class="control-label" for="">Reason for Cancel</label>
                                          <div class="controls">
                                            <textarea placeholder="min. 14 char" minlength="14" class="" name="misc_notes" id="notes" style="width: 400px; height: 50px" required></textarea>
                                          </div>
                                        </div>
										
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-danger" id="btn">Delete</button>
                                        </div>
 -->                                      
 										</fieldset>
 									</div>
                                </div>
                            </div>
								<div class="form-actions">
								<div style="float:left;">
                                    <button type="submit" class="btn btn-success" id="btn"><b>Submit</b></button>
								</div>
								<div style="float:right;">
                                    <button onClick="document.getElementById("quesioner_mcu").reset();" class="btn btn-danger"><b>Reset</b></button>
								</div>
                                </div>
                        </div>
						</form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
   	            <!-- /wizard -->
		<!--/.fluid-container-->
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
		function popup(b_id){
			var myWindow = window.open("<?php echo base_url();?>patient/data_patient", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function newclient(b_id){
			var myWindow = window.open("<?php echo base_url();?>client/add_client", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function popup_s(id){
			var myWindow = window.open("<?php echo base_url();?>patient/find_patient_data", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function popup_camera(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_camera/"+id+"", "", "width=950px, height=500px, top=70, left=80");
		}
		
		function finger(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"", "", "width=1200px, height=500px, top=70, left=80");
			
			// window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        // "directories=1,location=1,menubar=1," + 
                        //  "resizable=1 status=1,history=1 top = 50 left = 100");
		}

		function showapp(){
			window.open("<?php echo base_url();?>Registration/reg_app","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
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
</html>	