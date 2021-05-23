	<div class="span9" id="content">	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Questionnaire Gynecology
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Questionnaire Gynecology
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
        window.open("<?php echo base_url();?>patient/find_patient_gyn","Popup","height=700,width=525,,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_gyn/edit";
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
	                                    <li>
	                                        <a href="<?php echo base_url();?>patient/quesioner_patient_tread">Treadmill</a> <span class="divider">|</span>	
	                                    </li>
										<i class="icon-chevron-right show-sidebar" style="display:0ne;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
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
                            <div class="muted pull-left">Form Questionnaire Gynecology</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend>	
										<?php
										if ($id=="edit") {
										?>
										<font color="red">Edit Data</font>
										<?php
											}
										?>	Gynecology
										</legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Add</button>
										 <button id="btntest" onclick="return btntest_onclick()" class="btn btn-info">Edit</button>   										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
									<?php
									if ($id != "edit") {
									?>
									<form class="form-horizontal" action="<?php echo base_url();?>patient/save_que_gyn" method="post" name="quesioner_mcu">
									<?php
									} else {
									?>
									<form class="form-horizontal" action="<?php echo base_url();?>patient/update_que_gyn" method="post" name="quesioner_mcu">
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
													<div class="muted pull-left"><b>Questionnaire Form</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Subject</th>
																	<th></th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td>Last Menstruation Period</td>
																	<td><input type="text" name="lmp_month" placeholder="Month"></td>
																	<td><input type="text" name="lmp_day" placeholder="Day"></td>
																</tr>
																<tr>
																	<td>2</td>
																	<td>Regular Menstruation</td>
																	<td>
																	<select id="select01" class="chzn-select" name="rm">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td></td>
																</tr>
																<tr>
																	<td>3</td>
																	<td>Irregular Genital Bleeding</td>
																	<td>
																	<select id="select01" class="chzn-select" name="igb">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td></td>
																</tr>
																<tr>
																	<td>4</td>
																	<td>Vaginal Discharge</td>
																	<td>
																	<select id="select01" class="chzn-select" name="vd">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td>
																	<select id="select01" class="chzn-select" name="qty">
																	<option value="">- Choose -</option>
																	<option value="1">Much</option>
																	<option value="0">Little</option>
																	</select>
																	</td>
																</tr>
																<tr>
																	<td>5</td>
																	<td>Abortion</td>
																	<td>
																	<input type="text" name="spnts" placeholder="Spontaneous .... time(s)"></br></br>
																	<input type="text" name="incd" placeholder="Induced .... time(s)"></br></br>
																	<select id="select01" class="chzn-select" name="abrt">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td></td>
																</tr>
																<tr>
																	<td>6</td>
																	<td>Are you taking hormone therapy now ?</td>
																	<td>
																	<select id="select01" class="chzn-select" name="trpy">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td><input type="text" name="ther_med" placeholder="Name of medicine"></td>
																</tr>
																<tr>
																	<td>7</td>
																	<td>How many delivery did you have ?</td>
																	<td>
																	<input type="text" name="deli" placeholder=" .... time(s)">
																	</td>
																	<td></td>
																</tr>
																<tr>
																	<td>8</td>
																	<td>Contraception</td>
																	<td>
																	<select id="select01" class="chzn-select" name="cntrp">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td><input type="text" name="con_exp" placeholder=" Explain .... "></td>
																</tr>
																<tr>
																	<td>9</td>
																	<td>Gynecological Operation</td>
																	<td>
																	<select id="select01" class="chzn-select" name="go">
																	<option value="">- Choose -</option>
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	</select>
																	</td>
																	<td><input type="text" name="exp_go" placeholder=" Explain .... "></td>
																</tr>
																<tr>
																	<td>10</td>
																	<td>Last Gynecological Examination</td>
																	<td><input type="text" name="ge_year" placeholder="Year"></td>
																	<td><input type="text" name="ge_month" placeholder="Month"></td>
																</tr>
																<tr>
																	<td>11</td>
																	<td>Sexual Activity in the last 2-3 days</td>
																	<td><input type="text" name="actv_sex" placeholder=" .... time(s)"></td>
																	<td></td>
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