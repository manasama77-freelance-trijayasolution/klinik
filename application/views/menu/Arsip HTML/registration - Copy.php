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
	  function undisableTxt() {
			document.getElementById("id_pat").disabled = false;
			document.getElementById("reg_date").disabled = false;
			document.getElementById("reference").disabled = false;
			document.getElementById("notes").disabled = false;
			document.getElementById("pat_sign").disabled = false;
			document.getElementById("reg_type").disabled = false;
			document.getElementById("payment_type").disabled = false;
			document.getElementById("1").disabled = false;
	  }
	  function undisablenonepackage() {
			document.getElementById("nonepackage").disabled = false;
	  }
	  function undisablepackage() {
			document.getElementById("package").disabled = false;
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }
	  
	</script>


	<?php
  include './design/koneksi/file.php';
	$query 		="SELECT cast(right(id_reg,4) as decimal) id,cast(left(id_reg,3) as decimal) dt FROM trx_registration ORDER BY id_pat DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$dater 	=$row['dt'];
		if ($dater == $date) {
			$count = $count+1; 	
		}else{
			$count = 1;
		}
        $code_no = str_pad($count, 4, "0", STR_PAD_LEFT);
    }
	$session_data 	 = $this->session->userdata('logged_in');
    $data['username'] 	 = $session_data['username'];
	$loc 	 = $session_data['location'];

	//var_dump($loc);
	?>
		
                <div class="span9" id="content">

                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Patient Registration</div>
                            </div>
                            <div class="block-content collapse in">
							            <div class="form-actions">
                                          <button type="submit" onclick="undisableTxt()" class="btn btn-primary">Add</button>
                                          <align style="left"><button type="submit" class="btn btn-primary">Edit</button></align>
                                        </div>
                                <div class="span12">
                                     <form action="<?php echo base_url();?>Registration/save_reg" method="post" class="form-horizontal">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label" for="disabledInput">ID Registration</label>
                                          <div class="controls">
										     <input class="input-xlarge disabled" id="id_reg" value="<?=$loc.$date.$code_no;?>" name="id_reg" type="text" placeholder="" readonly >
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="">Date of Registration</label>
											<div class="controls">
                                            <input type="text" name="reg_date"  disabled class="input-xlarge datepicker" id="reg_date" value="">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="">ID Patient</label>
                                          <div class="controls">
                                            <input class="input-xlarge disabled" id="id_pat" disabled name="id_pat" type="text" >
											<a href="<?php echo base_url();?>patient/data_patient"><button class="btn btn-primary">New Patient</button></a>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="select01">Patient Charge Role</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="pat_charge_rule" required>
                                              <option value="">- Choose Charge Role -</option>
                                              <?php 
											  foreach($get_charge_rule->result() as $rows){
											  ?>
												<option value="<?=$rows->id_rule?>" align="justify"><?=$rows->rule?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Payment Type</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="payment_type" disabled name="payment_type" required>
                                              <option value="">- Choose Payment Type -</option>
                                              <?php 
											  foreach($get_paytype->result() as $rows){
											  ?>
												<option value="<?=$rows->id_type?>" align="justify"><?=$rows->paytype?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										
										<!-- <div class="control-group">
                                          <label class="control-label" for="select01">Client</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="client_id" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  //foreach($client->result() as $rows){
											  ?>
												<option value="<?//=$rows->id_Client?>" align="justify"><?//=$rows->client_name?></option>
											  <?php
											  //}
											  ?>
                                            </select>
                                          </div>
                                        </div> -->

										<div class="control-group">
                                          <label class="control-label" for="select01">Client</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="id_client" name="id_client" required>
                                              <option value="">- Choose Client Name -</option>
                                              <?php 
											  foreach($get_client->result() as $rows){
											  ?>
												<option value="<?=$rows->id_Client?>" align="justify"><?=$rows->client_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<a href="<?php echo base_url();?>client/add_client"><button class="btn btn-primary">New Client</button></a>
                                          </div>
                                        </div>



										<div class="control-group">
                                          <label class="control-label" for="select01">ID Client Dept</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_client_dept" required>
                                              <option value="">- Choose Client Dept -</option>
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
                                          <label class="control-label" id="" for="select01">ID Client Job</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_client_job" required>
                                              <option value="">- Choose Client Job -</option>
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
                                          <label class="control-label" for="">Reference</label>
                                          <div class="controls">
                                            <input class="input-xlarge disabled" disabled name="reference" id="reference" type="text">
                                          </div>
                                        </div>
										
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Insurance Company</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="insurance_comp" required>
                                              <option value="">- Choose Insurance -</option>
                                              <?php 

											  foreach($get_insurance->result() as $rows){
											  ?>
												<option value="<?=$rows->id_ins_comp?>" align="justify"><?=$rows->ins_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>	
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Project</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_project" required>
                                              <option value="">- Choose Project -</option>
                                              <?php 

											  foreach($get_project->result() as $rows){
											  ?>
												<option value="<?=$rows->id_project?>" align="justify"><?=$rows->project_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>					
                                        <div class="control-group">
                                          <label class="control-label" for="">Notes</label>
                                          <div class="controls">
                                            <textarea class="" name="misc_notes" disabled  id="notes" style="width: 400px; height: 50px"></textarea>
                                          </div>
                                        </div>
										
										
                                        <div class="control-group">
                                          <label class="control-label" for="">Patient Sign</label>
                                          <div class="controls">
                                            <textarea class="" name="pat_sign" id="pat_sign" disabled   " style="width: 400px; height: 50px"></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="disabledInput">Reg Type</label>
                                          <div class="controls">
                                            <input class="input-xlarge disabled" disabled onkeypress="return DisableKey(event,'')" name="reg_type" id="reg_type" type="text"   >
                                          </div>
                                          </div>
										<br>
										<div class="control-group">
                                          <label class="control-label" for="select01">Service</label>
                                          <div class="controls">

                                            <select class="chzn-select"   id="package" name="id_client" required>
                                              <option value="">- Choose Service -</option>
                                              <?php 
											  foreach($get_services->result() as $rows){
											  ?>
												<option value="<?=$rows->id_service?>" align="justify"><?=$rows->serv_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											  
											  
                                            <select class="chzn-select" id="nonepackage"   name="id_client" required>
                                              <option value="">- Choose Package -</option>
                                              <?php 
											  foreach($get_service_package_h->result() as $rows){
											  ?>
												<option value="<?=$rows->id_package?>" align="justify"><?=$rows->package_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											 </div>
                                        </div>
																				
										
                                        <div class="control-group">
                                          <label class="control-label" for="select01">Dokter</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_dr" required>
                                              <option value="">- Choose Dokter -</option>
                                              <?php 

											  foreach($get_doctor->result() as $rows){
											  ?>
												<option value="<?=$rows->id_dr?>" align="justify"><?=$rows->drname?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
									<!--	
									                                        <div class="control-group">
                                          <label class="control-label" for="disabledInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge disabled" id="" name="id_reg" nametype="text" placeholder="Disabled input here..." disabled="">
                                          </div>
                                        </div>
									
									
									<div class="control-group">
											<label class="control-label">Category<span class="required">*</span></label>
											<div class="controls">
												<select class="span6 m-wrap" name="category">
													<option value="">Select...</option>
													<option value="Category 1">Category 1</option>
													<option value="Category 2">Category 2</option>
													<option value="Category 3">Category 5</option>
													<option value="Category 4">Category 4</option>
												</select>
											</div>
										</div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="multiSelect">Multicon-select</label>
                                          <div class="controls">
                                            <select multiple="multiple" id="multiSelect" class="chzn-select span4">
                                              <option>Alabama</option><option>Alaska</option><option>Arizona</option><option>Arkansas</option><option>California</option><option>Colorado</option><option>Connecticut</option><option>Delaware</option><option>District Of Columbia</option><option>Florida</option><option>Georgia</option><option>Hawaii</option><option>Idaho</option><option>Illinois</option><option>Indiana</option><option>Iowa</option><option>Kansas</option><option>Kentucky</option><option>Louisiana</option><option>Maine</option><option>Maryland</option><option>Massachusetts</option><option>Michigan</option><option>Minnesota</option><option>Mississippi</option><option>Missouri</option><option>Montana</option><option>Nebraska</option><option>Nevada</option><option>New Hampshire</option><option>New Jersey</option><option>New Mexico</option><option>New York</option><option>North Carolina</option><option>North Dakota</option><option>Ohio</option><option>Oklahoma</option><option>Oregon</option><option>Pennsylvania</option><option>Rhode Island</option><option>South Carolina</option><option>South Dakota</option><option>Tennessee</option><option>Texas</option><option>Utah</option><option>Vermont</option><option>Virginia</option><option>Washington</option><option>West Virginia</option><option>Wisconsin</option><option>Wyoming</option>
                                            </select>
                                            <p class="help-block">Start typing to activate auto complete!</p>
                                          </div>

                                        </div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Date input</label>
                                          <div class="controls">
                                            <input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12">
                                            <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="optionsCheckbox2">Disabled checkbox</label>
                                          <div class="controls">
                                            <label>
                                              <input type="checkbox" id="optionsCheckbox2" value="option1" disabled="">
                                              This is a disabled checkbox
                                            </label>
                                          </div>
                                        </div>
                                        <div class="control-group warning">
                                          <label class="control-label" for="inputError">Input with warning</label>
                                          <div class="controls">
                                            <input type="text" id="inputError">
                                            <span class="help-inline">Something may have gone wrong</span>
                                          </div>
                                        </div>
                                        <div class="control-group error">
                                          <label class="control-label" for="inputError">Input with error</label>
                                          <div class="controls">
                                            <input type="text" id="inputError">
                                            <span class="help-inline">Please correct the error</span>
                                          </div>
                                        </div>
                                        <div class="control-group success">
                                          <label class="control-label" for="inputError">Input with success</label>
                                          <div class="controls">
                                            <input type="text" id="inputError">
                                            <span class="help-inline">Woohoo!</span>
                                          </div>
                                        </div>
                                        <div class="control-group success">
                                          <label class="control-label" for="selectError">Select with success</label>
                                          <div class="controls">
                                            <select id="selectError">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                            <span class="help-inline">Woohoo!</span>
                                          </div>
                                        </div>-->
										
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Save</button>
                                          <button type="submit" class="btn btn-primary">Edit</button>
                                          <button type="submit" class="btn btn-primary">Exit</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

   	            <!-- /wizard -->

                </div>
     
    </body>

</html>