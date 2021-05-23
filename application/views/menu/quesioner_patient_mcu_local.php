	<div class="span9" id="content">	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Questionnaire MCU Local
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Questionnaire MCU Local
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
        window.open("<?php echo base_url();?>patient/find_patient","Popup","height=700,width=525,,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_tread","Popup","height=700,width=525,,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_tread/edit";
	  }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
					<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb"> 
	                                    <li>
	                                        <a href="<?php echo base_url();?>patient/quesioner_patient_mcu">Medical Check Up</a> <span class="divider">|</span>	
	                                    </li>
										<i class="icon-chevron-right show-sidebar" style="display:0ne;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="<?php echo base_url();?>patient/quesioner_patient_tread">Treadmill</a> <span class="divider">|</span>	
	                                    </li>
										<li>
	                                        <a href="<?php echo base_url();?>patient/quesioner_patient_gyn">Gynecology</a> <span class="divider">|</span>	
	                                    </li>
										<li>
	                                        <a href="<?php echo base_url();?>patient/quesioner_patient_hepvac">Hepatitis Vaccine</a> <span class="divider">|</span>	
	                                    </li>
	                                </ul>
                            	</div>
                    </div>
					
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Form Questionnaire Medical Check Up</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
										 <div class="btn-group">
										  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
										  <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>patient/quesioner_patient_tread"><i class="icon-th-large"></i> Local</a></li>
											<li><a href="<?php echo base_url();?>patient/quesioner_patient_tread"><i class="icon-th-large"></i> Treadmill</a></li>
											<li><a href="<?php echo base_url();?>patient/quesioner_patient_gyn"><i class="icon-th-large"></i> Gynecology</a></li>
										  </ul>
										 </div>
										 </div>
									<?php
									if ($id != "edit") {
									?>
									<form class="form-horizontal" action="<?php echo base_url();?>patient/save_que_tread" method="post" name="quesioner_mcu">
									<?php
									} else {
									?>
									<form class="form-horizontal" action="<?php echo base_url();?>patient/update_que_tread" method="post" name="quesioner_mcu">
									<?php
									}
									?>	
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient MRN</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" readonly autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<?php
											if ($id=="edit") {
											?>
											&nbsp; <button type="button" onclick="popup_edit();" class="btn btn-success"><li><i class="icon-search"></i></li></button>
											<?php
											} else {
											?>
											&nbsp; <button type="button" onclick="popup();" class="btn btn-success"><li><i class="icon-search"></i></li></button>
											<?php
											}
											?>	
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                          <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" required>
											&nbsp;  &nbsp;
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
                                          <input class="input-xlarge focused" name="pat_age" type="text" id="myText03" readonly autocomplete="off" required>
                                          </div>
                                        </div>
							
										<div class="row-fluid">
											<!-- block -->
											<div class="block">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Khusus Wanita</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Subject</th>
																	<th>Yes</th>
																	<th>No</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td>Usia berapakah pertama kali haid ? <input style="width: 40px;" name="pat_name" type="text" placeholder="________________" autocomplete="off"></td>
																	<td></td>
																	<td></td>
																</tr>
																<tr>
																	<td>2</td>
																	<td>Apakah siklus haid anda teratur ? </td>
																	<td><input type="radio" name="hr" value="1" required></td>
																	<td><input type="radio" name="hr" value="0" required></td>
																</tr>
																<tr>
																	<td>3</td>
																	<td>Apakah anda pernah mengalami tindakan operasi Ginekologi / Kebidanan ? </td>
																	<td><input type="radio" name="cp" value="1" required></td>
																	<td><input type="radio" name="cp" value="0" required></td>
																</tr>
																<tr>
																	<td>4</td>
																	<td>Apakah anda pernah mengalami sakit pada saluran kencing ?</td>
																	<td><input type="radio" name="hb" value="1" required></td>
																	<td><input type="radio" name="hb" value="0" required></td>
																</tr>
																<tr>
																	<td>5</td>
																	<td>Apakah ada bercak darah dalam urine anda ?</td>
																	<td><input type="radio" name="ch" value="1" required></td>
																	<td><input type="radio" name="ch" value="0" required></td>
																</tr>
																<tr>
																	<td>6</td>
																	<td>Foot Injury</td>
																	<td><input type="radio" name="fi" value="1" required></td>
																	<td><input type="radio" name="fi" value="0" required></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<!-- /block -->
										</div>				

										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3>Check Again</h3>
											</div>
											<div class="modal-body">
												<p>Are You Sure ?</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn" value="Save" id="myText123" disabled>
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>