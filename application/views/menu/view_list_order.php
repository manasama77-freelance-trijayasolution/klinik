	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Marking Sheet Medical Check Up
		</div>
	<?php
		} else if ($id=="change") {
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
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=700,width=525,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=700,width=525,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
	  }
	  
      function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>patient/print_mark_sheet/"+id+"", "", "width=680, height=650");
				}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Marking Sheet Medical Check Up Form</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
                                        <legend><div style="float:left;">Marking Sheet</div><div style="float:right;"><button class="btn" onclick="myFunction(<?=$_POST['id_reg'];?>)"> <i class="icon-print"></i><b>Print</b></button></div></legend>
										<hr>
										<form class="form-horizontal" action="<?php echo base_url();?>patient/save_mark_mcu" method="post" name="mark_mcu">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient MRN</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" value="<?=$_POST['pat_mrn'];?>" id="" readonly autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" value="<?=$_POST['id_reg'];?>" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" value="<?=$_POST['pat_name'];?>" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" type="text" id="" value="<?=$_POST['age'];?>" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>		
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="pat_mcu" type="text" value="<?=$_POST['pat_mcu'];?>" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>
										
										<div class="row-fluid">
											<!-- block -->
											<div class="block" style="width: 50%; float: left;">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Marking Sheet For Medical Check Up</b></div>
												</div>
												<div class="block-content collapse in" style="overflow-x:scroll;overflow-y:scroll;height:380px">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>Contents</th>
																	<th>Result</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Blood Pressure</td>
																	<td><input type="text" style="width: 65px;" size="6" name="hgh" placeholder="High" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="low" placeholder="Low" autocomplete="off"></td>
																</tr>
																<tr>
																	<td>Anthropemetry</td>
																	<td><input type="text" style="width: 65px;" size="6" name="height" placeholder="Height" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="weight" placeholder="Weight" autocomplete="off"></td>
																</tr>
																<tr>
																	<td>Obesitas</td>
																	<td><input type="text" style="width: 65px;" size="6" name="bmi" placeholder="BMI" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="fat" placeholder="% Fat" autocomplete="off"></br></br>
																	<input type="text" style="width: 65px;" size="6" name="bmr" placeholder="BMR" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="vfa" placeholder="VFA" autocomplete="off"></td>
																</tr>
																<tr>
																	<td>Eye Sight</td>
																	<td>Glasses On <input type="text" style="width: 65px;" size="6" name="on_right" placeholder="(+) Right" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="on_left" placeholder="(+) Left" autocomplete="off"></br></br>
																	Glasses On <input type="text" style="width: 65px;" size="6" name="on_right2" placeholder="(-) Right" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="on_left2" placeholder="(-) Left" autocomplete="off"></br></br>
																    Glasses Off <input type="text" style="width: 65px;" size="6" name="off_right" placeholder="Right" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="off_left" placeholder="Left" autocomplete="off">
																	</td>
																</tr>
																<tr>
																	<td>Color Blindness</td>
																	<td><input type="text" style="width: 65px;" size="6" name="cb" placeholder=" ... " autocomplete="off"></td>
																</tr>
																<tr>
																	<td>Audiometer</td>
																	<td>Right <input type="text" style="width: 120px;" size="6" name="au_right" placeholder="1000 Hz 4000 Hz" autocomplete="off"></br></br>
																	Left &nbsp;&nbsp;<input type="text" style="width: 120px;" size="6" name="au_left" placeholder="1000 Hz 4000 Hz" autocomplete="off">
																	</td>
																</tr>
																<tr>
																	<td>Ocular Tention</td>
																	<td><input type="text" style="width: 65px;" size="6" name="ot_right" placeholder="Right" autocomplete="off"> - <input type="text" style="width: 65px;" size="6" name="ot_left" placeholder="Left" autocomplete="off">
																	</td>
																</tr>
																<tr>
																	<td>Lung Function</td>
																	<td><input type="text" style="width: 120px;" size="6" name="vc" placeholder="Vital Capasity ... %" autocomplete="off"> - <input type="text" style="width: 120px;" size="6" name="vc2" placeholder="Vital Capasity ..." autocomplete="off"></br></br>
																	<input type="text" style="width: 120px;" size="6" name="fev" placeholder="1 ... FEV %" autocomplete="off">
																	</td>
																</tr>
																<tr>
																	<td>Gynecology</td>
																	<td><input type="text" style="width: 120px;" size="6" name="brst" placeholder="Breast ..." autocomplete="off"> - <input type="text" style="width: 120px;" size="6" name="grade" placeholder="Grade ..." autocomplete="off"></br></br>
																	<input type="text" style="width: 120px;" size="6" name="others" placeholder="Others ..." autocomplete="off"> - <input type="text" style="width: 120px;" size="6" name="grade2" placeholder="Grade ..." autocomplete="off">
																	</td>
																</tr>
																<tr>
																	<td>Remarks</td>
																	<td><input type="text" style="width: 160px;" size="6" name="remarks" placeholder=" ... " autocomplete="off">
																	</td>
																</tr>
																<tr>
																	<td>Notes</td>
																	<td><textarea style="width: 160px;" name="notes" placeholder=" ... " autocomplete="off"></textarea>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											
											<div class="block" style="width: 48%; float: right;">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Package Medical Check Up</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>Contents</th>
																	<th>Check</th>
																</tr>
															</thead>
															
															<tbody>
															<?php
															$i=1;
															$b=1;
															$row_cnt = $find->num_rows();
															?>
															<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
															<?php
															foreach($find->result() as $row){
															?>
																<tr>
																	<td><?php echo $row->serv_name;?></td>
																	<input type="hidden" name="id_service<?=$i++;?>" value="<?php echo $row->id_service;?>">
																	<td> <input type="checkbox" name="dat<?=$b++;?>" value="1" ></td>
																</tr>
															<?php
															}
															?>
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
												<input type="submit" class="btn" value="Save">
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
										
										<div class="form-actions" >
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><i class="icon-check"></i> Save</a>
										<button class="btn btn-warning" onclick="goBack()">Back</button>
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