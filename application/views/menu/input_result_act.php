	<?php
		//error_reporting(0);
		include './design/koneksi/file.php';
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$logic 		="update pat_mcu_result set locked=1,lock_by=$user_id where id_regist='".$_POST['id_reg']."'";  
		//echo $logic;
		if($hasil 	=mysqli_query($con, $logic)){}
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Result <b>(Doctor)</b> Medical Check Up
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
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=700,width=525,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                        "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function comment(b_id){
		window.open("<?php echo base_url();?>patient/find_comment/"+b_id+"","Popup","height=350, width=580, top=130, left=50 ");
      }
	  
	  function comment_fin(){
		window.open("<?php echo base_url();?>patient/find_comment_final","Popup","height=350, width=580, top=130, left=50 ");
      }
	  
	  function comment_lab(b_id){
		window.open("<?php echo base_url();?>patient/find_comment_lab/"+b_id+"","Popup","height=350, width=580, top=130, left=50 ");
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=700,width=525,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
	  }
      function view_mark(id) {
		var myWindow = window.open("<?php echo base_url();?>patient/print_mark_sheet/"+id+"", "", "width=680, height=650");
	  }		
	  function myFunction_2(id) {
		var myWindow = window.open("<?php echo base_url();?>lab/lab_view/"+id+"", "", "width=700, height=600");
	  }	 
      function myFunction_3(id) {
		var myWindow = window.open("<?php echo base_url();?>radiology/rad_report2/"+id+"", "", "width=700, height=600");
	  }
	</script>	
	<style>
	body {
   padding: 50px;    
}

hr {
   margin: 50px 0;   
}

hr.style-one {
    border: 0;
    height: 1px;
    background: #333;
    background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc); 
    background-image:    -moz-linear-gradient(left, #ccc, #333, #ccc); 
    background-image:     -ms-linear-gradient(left, #ccc, #333, #ccc); 
    background-image:      -o-linear-gradient(left, #ccc, #333, #ccc); 
}

hr.style-two {
    border: 0;
    height: 1px;
    background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
    background-image:    -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
    background-image:     -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
    background-image:      -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
}

hr.style-three {
    border: 0;
    border-bottom: 1px dashed #ccc;
    background: #999;
}

hr.style-four {
    height: 6px;
    border: 0;
    box-shadow: inset 0 6px 6px -6px black;
}

hr.style-five {
    border: 0;
    height: 0;
    box-shadow: 0 0 10px 1px black;
}
	</style>
	<?php
	foreach($data_lock->result() as $row_lock){} ?>
	<script>
        $(function() {
			$('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.notification').ready(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span> You had locked input :</br></br>Patient Name</br><?=$_POST['pat_name'];?>", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span> You had locked input :</br></br>Patient Name</br><?=$_POST['pat_name'];?>", { sticky: true });
						var a=<?=$row_lock->lock_by;?>;
						var b=<?=$user_id;?>;
						if (a==b) {
						//alert('Win');
								}else{ 
						alert('Input Result Medical Check Up, Conflict! please try again...');
						window.location.href = "<?php echo base_url();?>patient/input_result";
						}
					break;
				}
			});
        });
    </script>
					<body onload="startTime()">
                    <!-- morris stacked chart -->					
                    <div class="row-fluid notification" id="notification-sticky">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Medical Check Up Result (Doctor)</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
										<form class="form-horizontal" action="<?php echo base_url();?>patient/save_mcu_result" method="post" name="mark_mcu">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" value="<?=$_POST['pat_mrn'];?>" id="" readonly autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" value="<?=$_POST['id_reg'];?>" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" type="hidden" id="" value="<?=$_POST['id_pat'];?>"  autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" value="<?=$_POST['pat_name'];?>" readonly autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" type="text" id="" value="<?=$_POST['age'];?>" readonly autocomplete="off" > 	
                                          </div>
                                        </div>		
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Client Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" id="myText03" value="<?=$_POST['client_name'];?>" readonly autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="pat_mcu" type="text" value="<?=$_POST['pat_mcu'];?>" readonly autocomplete="off" > 	
                                          </div>
                                        </div>
										
										<a href="#" class="btn btn-info btn-mini" onclick="view_mark('<?=$_POST['id_reg'];?>')"><i class="icon-zoom-in"></i> <b>View Marking Sheet</b></a>
										<button class="btn btn-success btn-mini"><i class="icon-lock"></i> Unlock Input Result <i>[MCU]</i></button>
										</br>
										<!-- wizard -->
										<div class="row-fluid section">
											<!-- block -->
											<div class="block">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Input Medical Check Up Result</b></div>
													<div class="muted pull-right"></div>
													<!--<div class="muted pull-right"><input style="width:15px; height:15px;" type="checkbox" name="complete" value="1"><b><font color="red">Completed</font></b></div>-->
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<div id="rootwizard">
															<div class="navbar">
															<div class="navbar-inner">
																<div class="container" style="font-size: 10pt;">
																<ul>
																<li><a href="#tab1" data-toggle="tab"><b>Anthropometry</b></a></li>
																<li><a href="#tab2" data-toggle="tab"><b>Eyes</b></a></li>
																<li><a href="#tab3" data-toggle="tab"><b>Hearing</b></a></li>
																<li><a href="#tab4" data-toggle="tab"><b>Respiratory</b></a></li>
																<li><a href="#tab12" data-toggle="tab"><b>Lab</b></a></li>
																<li><a href="#tab13" data-toggle="tab"><b>Radiology</b></a></li>
																<li><a href="#tab5" data-toggle="tab"><b>ECG - Treadmill</b></a></li>
																<li><a href="#tab7" data-toggle="tab"><b>Dental</b></a></li>
																<li><a href="#tab8" data-toggle="tab"><b>Gynecology</b></a></li>
																<li><a href="#tab14" data-toggle="tab"><b>Final Result</b></a></li>
																</ul>
															</div>
															</div>
															</div>
															<div class="tab-content">
																<div class="tab-pane" id="tab1">
																	<fieldset>
																		<?php 
																		foreach($find->result() as $row_isi){}
																		foreach($grade->result() as $row_grade){}
																		?>
																		<!--
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Height</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->height;?>" placeholder=". . ." autocomplete="off" readonly> 
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Weight</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->weight;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">BMI</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->bmi;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">FAT</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->fat_percent;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Systolic</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->bp_systolic;?>" placeholder=". . ." autocomplete="off" readonly> 
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Diastolic</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->bp_diastolic;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		-->
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Abdominal Girth</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="abd_girth" value="<?=$row_isi->abd_girth;?>" placeholder=". . ." autocomplete="off"> Cm.
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Standard Weight</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="std_weight" value="<?=$row_isi->std_weight;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Obese Index</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="obe_index" value="<?=$row_isi->obe_index;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Blood Pressure</label>
																			<div class="controls">
																			<select name="bp_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Blood_Pressure==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Blood_Pressure=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Blood_Pressure=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Blood_Pressure=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Blood_Pressure=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Blood_Pressure=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Blood_Pressure=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Blood_Pressure=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select> <span class="label label-info">Grade</span>
																			</div>
																		</div>	
																		<div class="control-group">
																			<label class="control-label" for="select01">Obesitas</label>
																			<div class="controls">
																			<select name="obesitas_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Obesitas==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Obesitas=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Obesitas=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Obesitas=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Obesitas=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Obesitas=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Obesitas=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Obesitas=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select> <span class="label label-info">Grade</span>
																			</div>
																		</div>
																		
																		<script>
																		var counter_ant 	= 1;
																		var limit_ant	 	= 5;
																		function addInput(divName){
																			 if (counter_ant == limit_ant)  {
																				  alert("Sorry, you have only " + counter_ant + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_ant_"+counter_ant+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_ant' value='"+counter_ant+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_ant++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->ant_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea name="comment_ant_last" readonly><?=str_replace(";",", ",$row_isi->ant_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>
																		
																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput">
																			<input placeholder="Start Typing ..." title="<?=str_replace(";",";",$row_isi->ant_comment);?>" type="text" style="width: 210px;" class="span6" id="typeahead" name="comment_ant_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_ant' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput('dynamicInput');">			
																			</div>
																		</div>																		
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>																			
																	</fieldset>									
																</div>
																
																<div class="tab-pane" id="tab5">
																		<fieldset>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">ECG Result</label>
																		<div class="controls">
																			<textarea placeholder=". . ." name="ecg"><?=$row_isi->ecg_result;?></textarea> 
																		</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade ECG</label>
																			<div class="controls">
																			<select name="ecg_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->ECG==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->ECG=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->ECG=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->ECG=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->ECG=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->ECG=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->ECG=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->ECG=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</select> <span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<!--
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Echocardiographi</label>
																			<div class="controls">
																			<select name="echoca_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Echocardiographi==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Echocardiographi=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Echocardiographi=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Echocardiographi=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Echocardiographi=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Echocardiographi=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Echocardiographi=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Echocardiographi=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		-->
																		<div class="control-group">
																		<script>
																		var counter_ecg		= 1;
																		var limit_ecg	 	= 5;
																		function addInput_ecg(divName){
																			 if (counter_ecg == limit_ecg)  {
																				  alert("Sorry, you have only " + counter_ecg + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_ecg_"+counter_ecg+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br> <input type='hidden' name='count_ecg' value='"+counter_ecg+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_ecg++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->ecg_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea name="comment_ecg_last" readonly><?=str_replace(";",", ",$row_isi->ecg_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment ECG</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_ecg">
																			<input  placeholder="Start Typing ..."  title="<?=str_replace(";",";",$row_isi->ecg_comment);?>" type="text"  style="width: 210px;" class="span6" id="typeahead" name="comment_ecg_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_ecg' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_ecg('dynamicInput_ecg');">			
																			</div>
																		</div>																		
																		</div>
																		
																		<hr class="style-one">
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Treadmill Result</label>
																		<div class="controls">
																		<textarea placeholder=". . ." name="trd"><?=$row_isi->trd_result;?></textarea>
																		</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Treadmill</label>
																			<div class="controls">
																			<select name="tread_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Treadmill==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Treadmill=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Treadmill=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Treadmill=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Treadmill=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Treadmill=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Treadmill=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Treadmill=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</select> <span class="label label-info">Grade</span>
																			</div>
																		</div>
																		
																		<div class="control-group">
																		<script>
																		var counter_tm 		= 1;
																		var limit_tm	 	= 5;
																		function addInput_tm(divName){
																			 if (counter_tm == limit_tm)  {
																				  alert("Sorry, you have only " + counter_tm + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input  placeholder='Start Typing ...'  type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_tm_"+counter_tm+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_tm' value='"+counter_tm+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_tm++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->trd_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea name="comment_tm_last" readonly><?=str_replace(";",", ",$row_isi->trd_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment Treadmill</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_tm">
																			<input  placeholder="Start Typing ..."  title="<?=str_replace(";",";",$row_isi->trd_comment);?>" type="text" style="width: 210px;" class="span6" id="typeahead" name="comment_tm_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_tm' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_tm('dynamicInput_tm');">			
																			</div>
																		</div>																		
																		</div>																		
																		<fieldset>										
																</div>
																<div class="tab-pane" id="tab2">			
																	<fieldset>
																		<!--
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Glass Off - Right</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->glasses_off_right;?>" placeholder=". . ." autocomplete="off" readonly> 
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Glass Off - Left</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->glasses_off_left;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Glass On - Right</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->glasses_plus_right;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Glass On - Left</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->glasses_plus_left;?>" placeholder=". . ." autocomplete="off" readonly> 
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Ocular Tension - Right</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->glasses_min_right;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Ocular Tension - Left</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->glasses_min_left;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Color Blindness</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->color_blind;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		-->
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Rerfraction - Right</label>
																		<div class="controls">
																			<textarea name="ref_right"><?=$row_isi->ref_right;?></textarea>																		
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Rerfraction - Left</label>
																		<div class="controls">
																			<textarea name="ref_left"><?=$row_isi->ref_left;?></textarea>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Fundus H</label>
																		<div class="controls">
																		<textarea placeholder=". . ." name="fundus_h"><?=$row_isi->fundus_H;?></textarea>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Fundus S</label>
																		<div class="controls">
																		<textarea placeholder=". . ." name="fundus_s"><?=$row_isi->fundus_S;?></textarea>
																		</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Eye Sight</label>
																			<div class="controls">
																			<select name="eye_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Eyes_Sight==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Eyes_Sight=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Eyes_Sight=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Eyes_Sight=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Eyes_Sight=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Eyes_Sight=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Eyes_Sight=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Eyes_Sight=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Ocular Tension</label>
																			<div class="controls">
																			<select name="ocular_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Ocular_Tension==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Ocular_Tension=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Ocular_Tension=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Ocular_Tension=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Ocular_Tension=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Ocular_Tension=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Ocular_Tension=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Ocular_Tension=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>		
																		<div class="control-group">
																			<label class="control-label" for="select01">Color Blindness</label>
																			<div class="controls">
																			<select name="cb_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Color_Blindness==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Color_Blindness=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Color_Blindness=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Color_Blindness=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Color_Blindness=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Color_Blindness=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Color_Blindness=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Color_Blindness=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Fundus</label>
																			<div class="controls">
																			<select name="fundus_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Fundus==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Fundus=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Fundus=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Fundus=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Fundus=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Fundus=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Fundus=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Fundus=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>	
																		
																		<script>
																		var counter_eye	 	= 1;
																		var limit_eye		= 5;
																		function addInput_eye(divName){
																			 if (counter_eye == limit_eye)  {
																				  alert("Sorry, you have only " + counter_eye + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_eye_"+counter_eye+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_eye' value='"+counter_eye+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_eye++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->ref_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea placeholder=". . ." name="comment_eye_last" readonly><?=str_replace(";",", ",$row_isi->ref_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="eye_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_eye">
																			<input placeholder="Start Typing ..." title="<?=str_replace(";",";",$row_isi->ref_comment);?>" type="text" style="width: 210px;" class="span6" id="typeahead" name="comment_eye_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_eye' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_eye('dynamicInput_eye');">			
																			</div>
																		</div>
																		
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																	</fieldset>
									
																</div>
																<div class="tab-pane" id="tab3">																
																	<fieldset>
																		<!--
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">1000Hz Right</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->audio_right_1k;?>" placeholder=". . ." autocomplete="off" readonly> 
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">1000Hz Left</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->audio_left_1k;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">4000Hz Right</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->audio_right_4k;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">4000Hz Left</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->audio_left_4k;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		-->
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">ENT / THT</label>
																		<div class="controls">
																		<textarea placeholder=". . ." name="tht"><?=$row_isi->tht_comment;?></textarea>
																		</div>
																		</div>
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Hearing</label>
																			<div class="controls">
																			<select name="hear_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Hearing==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Hearing=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Hearing=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Hearing=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Hearing=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Hearing=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Hearing=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Hearing=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		
																		<script>
																		var counter_hear 	= 1;
																		var limit_hear		= 5;
																		function addInput_hea(divName){
																			 if (counter_hear == limit_hear)  {
																				  alert("Sorry, you have only " + counter_hear + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_hea_"+counter_hear+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_hea' value='"+counter_hear+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_hear++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->aud_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea placeholder=". . ." name="comment_hea_last" readonly><?=str_replace(";",", ",$row_isi->aud_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="eye_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_hea">
																			<input placeholder="Start Typing ..." title="<?=str_replace(";",";",$row_isi->aud_comment);?>" type="text"style="width: 210px;" class="span6" id="typeahead" name="comment_hea_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_hea' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_hea('dynamicInput_hea');">
																			</div>
																		</div>
																		
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		
																	</fieldset>
									
																</div>
																<div class="tab-pane" id="tab4">
																	<fieldset>
																		<!--
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Forced Vital Capasity</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->lung_vital;?>" placeholder=". . ." autocomplete="off" readonly> 
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">% FVC</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->lung_vital_percent;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">FEV 1/FVC %</label>
																		<div class="controls">
																			<input type="text" style="width: 65px;" size="6" name="hgh" value="<?=$row_isi->lung_fev;?>" placeholder=". . ." autocomplete="off" readonly>
																		</div>
																		</div>
																		-->
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Classification of Ventilation</label>
																		<div class="controls">
																			<textarea name="cov" placeholder=". . ."><?=$row_isi->class_venti;?></textarea>																			
																		</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Lung Function</label>
																			<div class="controls">
																			<select name="lung_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Lung_Function==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Lung_Function=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Lung_Function=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Lung_Function=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Lung_Function=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Lung_Function=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Lung_Function=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Lung_Function=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>					
																		<script>
																		var counter_respi 		 = 1;
																		var limit_respi			 = 5;
																		function addInput_res(divName){
																			 if (counter_respi == limit_respi)  {
																				  alert("Sorry, you have only " + counter_respi + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input type='text' placeholder='Start Typing ...' style='width: 210px;' class='span6' id='typeahead' name='comment_res_"+counter_respi+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_res' value='"+counter_respi+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_respi++;
																			 }
																		}
																		</script>
																		<?php
																		//if($row_isi->res_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea placeholder=". . ." name="comment_res_last" readonly><?=str_replace(";",", ",$row_isi->res_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="eye_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>
																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_res">
																			<input placeholder="Start Typing ..." title="<?=str_replace(";",";",$row_isi->res_comment);?>" type="text" style="width: 210px;" class="span6" id="typeahead" name="comment_res_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_res' value='0'>	
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_res('dynamicInput_res');">
																			</div>
																		</div>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																		</br>
																	</fieldset>				
																</div>
																
																<div class="tab-pane" id="tab7">
																	<fieldset>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Extra Oral</label>
																		<div class="controls">
																			<select name="dent_xral" id="" style="width: 210px;">
																				<option <?php if($row_isi->dnt_oral==""){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_isi->dnt_oral=="Normal"){ echo "selected"; }?> value="Normal" align="justify">Normal</option>
																				<option <?php if($row_isi->dnt_oral=="Lession"){ echo "selected"; }?> value="Lession" align="justify">Lession</option>
																				<option <?php if($row_isi->dnt_oral=="Edema/Tumor"){ echo "selected"; }?> value="Edema/Tumor" align="justify">Edema / Tumor</option>
																				<option <?php if($row_isi->dnt_oral=="Palsy"){ echo "selected"; }?> value="Palsy" align="justify">Palsy</option>
																			</select>
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Intra Oral</label>
																		<div class="controls">
																			<select name="dnt_inor" id="" style="width: 210px;">
																				<option <?php if($row_isi->dnt_inor==""){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_isi->dnt_inor=="Normal"){ echo "selected"; }?> value="Normal" align="justify">Normal</option>
																				<option <?php if($row_isi->dnt_inor=="Lession"){ echo "selected"; }?> value="Lession" align="justify">Lession</option>
																				<option <?php if($row_isi->dnt_inor=="Gingivitis"){ echo "selected"; }?> value="Gingivitis" align="justify">Gingivitis</option>
																				<option <?php if($row_isi->dnt_inor=="Edema/Tumor"){ echo "selected"; }?> value="Edema/Tumor" align="justify">Edema / Tumor</option>
																			</select>
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Impaction Teeth</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_impact" value="<?=$row_isi->dnt_impc;?>" placeholder=". . ." autocomplete="off"> 
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Broken</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_broken" value="<?=$row_isi->dnt_brok;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Cyst / Granuloma</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_cyst" value="<?=$row_isi->dnt_cyst;?>" placeholder=". . ." autocomplete="off"> 
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Mobilization of teeth</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_mobi" value="<?=$row_isi->dnt_mobi;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Calculus / Plaque</label>
																		<div class="controls">
																		<select name="dent_calc" id="" style="width: 210px;">
																				<option <?php if($row_isi->dnt_calc==""){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_isi->dnt_calc=="All Teeth"){ echo "selected"; }?> value="All Teeth" align="justify">All Teeth</option>
																				<option <?php if($row_isi->dnt_calc=="Lower Teeth"){ echo "selected"; }?> value="Lower Teeth" align="justify">Lower Teeth</option>
																				<option <?php if($row_isi->dnt_calc=="Upper Teeth"){ echo "selected"; }?> value="Upper Teeth" align="justify">Upper Teeth</option>
																		</select>
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Oral Hygiene</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_hygn" value="<?=$row_isi->dnt_hygn;?>" placeholder=". . ." autocomplete="off"> 
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Caries</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_caris" value="<?=$row_isi->dnt_cari;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Filling</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_fill" value="<?=$row_isi->dnt_fill;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Missing</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_miss" value="<?=$row_isi->dnt_miss;?>" placeholder=". . ." autocomplete="off">
																		</div>
																		</div>

																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Panoramic X-Ray</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="dent_xray" value="<?=$row_isi->dnt_pnrm;?>" placeholder=". . ." autocomplete="off"> 
																		</div>
																		</div>

																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Extra Oral</label>
																			<div class="controls">
																			<select name="exor_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Extra_Oral==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Extra_Oral=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Extra_Oral=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Extra_Oral=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Extra_Oral=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Extra_Oral=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Extra_Oral=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Extra_Oral=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Panoramic X-ray</label>
																			<div class="controls">
																			<select name="pano_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Extra_Oral==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Extra_Oral=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Extra_Oral=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Extra_Oral=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Extra_Oral=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Extra_Oral=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Extra_Oral=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Extra_Oral=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Intra oral</label>
																			<div class="controls">
																			<select name="intr_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Intra_Oral==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Intra_Oral=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Intra_Oral=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Intra_Oral=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Intra_Oral=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Intra_Oral=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Intra_Oral=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Intra_Oral=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Dental Hygiene</label>
																			<div class="controls">
																			<select name="dent_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Dental_Hygine==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Dental_Hygine=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Dental_Hygine=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Dental_Hygine=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Dental_Hygine=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Dental_Hygine=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Dental_Hygine=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Dental_Hygine=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		<script>
																		var counter_dent 		 = 1;
																		var limit_dent			 = 5;
																		function addInput_dent(divName){
																			 if (counter_dent == limit_dent)  {
																				  alert("Sorry, you have only " + counter_dent + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_dent_"+counter_dent+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_dent' value='"+counter_dent+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_dent++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->dnt_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Comment</b></label>
																		<div class="controls">
																			<textarea name="comment_dent_last" readonly><?=str_replace(";",", ",$row_isi->dnt_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead"><b>Comment Dental</b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_dent">
																			<input placeholder='Start Typing ...' type="text" style="width: 210px;" class="span6" id="typeahead" name="comment_dent_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_dent' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_dent('dynamicInput_dent');">
																			<p class="help-block">Start typing to activate auto complete!</p>
																			</div>
																		</div>
																		
																		<fieldset>
																	</div>
																	
																	<div class="tab-pane" id="tab8">
																	<fieldset>
																		<script>
																		var counter_gyn_result 	= 1;
																		var limit_gyn_result	= 5;
																		function addInput_gyn_result(divName){
																			 if (counter_gyn_result == limit_gyn_result)  {
																				  alert("Sorry, you have only " + counter_gyn_result + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='gyn_result_"+counter_gyn_result+"' data-provide='typeahead' data-items='10' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br> <input type='hidden' name='count_gyn_result' value='"+counter_gyn_result+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_gyn_result++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->gyn_result!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Gynecology Result</b></label>
																		<div class="controls">
																			<textarea name="comment_gyn_result_last" readonly><?=str_replace(";",", ",$row_isi->gyn_result);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Gynecology Result</label>
																		<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_gyn_result">
																			<input type="text"  style="width: 210px;"  name="gyn_result_0" class="span6" id="typeahead" data-provide="typeahead" data-items="10" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' placeholder='Start Typing ...' autocomplete="off">
																			<input type='hidden' name='count_gyn_result' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_gyn_result('dynamicInput_gyn_result');">
																		</div>
																		</div>
																		
																		<script>
																		var counter_gyn 	= 1;
																		var limit_gyn		= 5;
																		function addInput_gyn(divName){
																			 if (counter_gyn == limit_gyn)  {
																				  alert("Sorry, you have only " + counter_gyn + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_gyn_"+counter_gyn+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br> <input type='hidden' name='count_gyn' value='"+counter_gyn+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_gyn++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->gyn_comment!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Gynecology Comment</b></label>
																		<div class="controls">
																			<textarea name="comment_gyn_last" readonly><?=str_replace(";",", ",$row_isi->gyn_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead">Gynecology Comment</label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_gyn">
																			<input placeholder='Start Typing ...' type="text" style="width: 210px;" class="span6" id="typeahead" name="comment_gyn_0" data-provide="typeahead" data-items="8" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_gyn' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_gyn('dynamicInput_gyn');">
																			</div>
																		</div>
																		
																		<hr class="style-one">
																		
																		<?php
																		//if($row_isi->pap_result!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Pap Smear Result</b></label>
																		<div class="controls">
																			<textarea name="comment_pap_result_last" readonly><?=str_replace(";",", ",$row_isi->pap_result);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>
																		
																		<script>
																		var counter_pap_result 	= 1;
																		var limit_pap_result	= 5;
																		function addInput_pap_result(divName){
																			 if (counter_pap_result == limit_pap_result)  {
																				  alert("Sorry, you have only " + counter_pap_result + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='pap_result_"+counter_pap_result+"' data-provide='typeahead' data-items='10' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br> <input type='hidden' name='count_pap_result' value='"+counter_pap_result+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_pap_result++;
																			 }
																		}
																		</script>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Pap Smear Result</label>
																		<div class="controls">
																		<div id="p_scents">
																			<div id="dynamicInput_pap_result">
																			<input type="text"  style="width: 210px;"  name="pap_result_0" class="span6" id="typeahead" data-provide="typeahead" data-items="10" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' placeholder='Start Typing ...' autocomplete="off">
																			<input type='hidden' name='count_pap_result' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_pap_result('dynamicInput_pap_result');">
																		</div>
																		</div>
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Pap Smear</label>
																			<div class="controls">
																			<select name="pap_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Pap_Smear==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Pap_Smear=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Pap_Smear=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Pap_Smear=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Pap_Smear=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Pap_Smear=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Pap_Smear=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Pap_Smear=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		
																		<script>
																		var counter_pap 	= 1;
																		var limit_pap		= 5;
																		function addInput_pap(divName){
																			 if (counter_pap == limit_pap)  {
																				  alert("Sorry, you have only " + counter_pap + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input  placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='comment_pap_"+counter_pap+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_pap' value='"+counter_pap+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_pap++;
																			 }
																		}
																		</script>
																		
																		<?php
																		//if($row_isi->pap_result!=""){																	
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><b>Last Pap Smear Comment</b></label>
																		<div class="controls">
																			<textarea name="comment_pap_last" readonly><?=str_replace(";",", ",$row_isi->pap_comment);?></textarea> 
																			<!--
																			<span class="label label-warning">
																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">
																			-->
																		</div>
																		</div>
																		<?php
																		//}
																		?>

																		<div class="control-group">
																			<label class="control-label" for="typeahead">Pap Smear Comment</label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_pap">
																			<input style="width: 210px;"  placeholder='Start Typing ...' type="text" class="span6" id="typeahead" name="comment_pap_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_pap' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_pap('dynamicInput_pap');">
																			</div>
																		</div>
																		
																		<hr class="style-one">
																		<?php																		//if($row_isi->brs_result!=""){																																			?>																		<div class="control-group">																		<label class="control-label" for="focusedInput"><b>Last Breast Result</b></label>																		<div class="controls">																			<textarea name="breast_result_last" readonly><?=str_replace(";",", ",$row_isi->brs_result);?></textarea> 																			<!--																			<span class="label label-warning">																			Update Comment?</span> <input  class="btn tooltip-top" data-original-title="Check this, if you want update comment." style="width: 14px; height: 14px	;" name="ant_check" type="checkbox" id="optionsCheckbox" value="1">																			-->																		</div>																		</div>																		<?php																		//}																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Breast Result</label>
																		<div class="controls">																																				<script>																		var counter_bra_res 	= 1;																		var limit_bra_res		= 5;																		function addInput_bra_res(divName){																			 if (counter_bra_res == limit_bra_res)  {																				  alert("Sorry, you have only " + counter_bra_res + " inputs");																			 }																			 else {																				  var newdiv = document.createElement('div');																				  newdiv.innerHTML = "</br><input  placeholder='Start Typing ...' type='text' style='width: 210px;' class='span6' id='typeahead' name='breast_result_"+counter_bra_res+"' data-provide='typeahead' data-items='10' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_bra_res' value='"+counter_bra_res+"'>";																				  document.getElementById(divName).appendChild(newdiv);																				  counter_bra_res++;																			 }																		}																		</script>																			<div id="p_scents">																			<div id="dynamicInput_bra_res">																			<input style="width: 210px;"  placeholder='Start Typing ...' type="text" class="span6" id="typeahead" name="breast_result_0" data-provide="typeahead" data-items="10" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_bra_res' value='0'>																			</div>																			</div>																																						<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_bra_res('dynamicInput_bra_res');">
																		</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Grade Breast Examination</label>
																			<div class="controls">
																			<select name="breast_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Breast_Examination==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Breast_Examination=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Breast_Examination=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Breast_Examination=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Breast_Examination=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Breast_Examination=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Breast_Examination=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Breast_Examination=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			<span class="label label-info">Grade</span>
																			</div>
																		</div>
																		
																		<script>
																		var counter_bra 	= 1;
																		var limit_bra		= 5;
																		function addInput_bra(divName){
																			 if (counter_bra == limit_bra)  {
																				  alert("Sorry, you have only " + counter_bra + " inputs");
																			 }
																			 else {
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input type='text' placeholder='Start Typing ...' style='width: 210px;' class='span6' id='typeahead' name='comment_bra_"+counter_bra+"' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_bra' value='"+counter_bra+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_bra++;
																			 }
																		}
																		</script>

																		<div class="control-group">
																			<label class="control-label" for="typeahead">Breast Comment</label>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInput_bra">
																			<input type="text" style="width: 210px;" placeholder='Start Typing ...' class="span6" id="typeahead" name="comment_bra_0" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_bra' value='0'>
																			</div>
																			</div>
																			<input style="width:210px;" class="btn btn-info btn-mini" type="button" value="Add Row" onClick="addInput_bra('dynamicInput_bra');">
																			</div>
																		</div>
																	<fieldset>
																	</div>
																	
																	<div class="tab-pane" id="tab12">
																	<fieldset>
																	<div class="block" style="width: 45%; float: left;">
																	<div style="overflow-x: scroll; height:560px;">
																		<?php 
																		$a=1;
																		$b=1;
																		$c=1;
																		$d=1;
																		$e=1;
																		$row_cnt = $comment->num_rows();
																		?>
																		<input type="text" style="display: none;" name="rowC" value="<?=$row_cnt;?>">
																		<div align="center"><b><u>Comment Lab. Result</u></b></div>
																		</br>
																		<?php
																		foreach($comment->result() as $row_comment){
																		?>
														
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><?=$row_comment->group_name;?></label>
																		<div class="controls">	
									
																		<textarea style="width: 195px;" size="6" name="comment_lab_<?=$a++;?>" placeholder=". . ." autocomplete="off" readonly><?=$row_comment->comment;?></textarea> <button type="button" onclick="comment_lab(<?=$c++;?>);" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
																			
																		<input type="text" style="display: none;" name="isi_lab_<?=$b++;?>" value="<?=$row_comment->id;?>">
																		</div>
																		</div>
																		<?php
																		}
																		?>
																		<hr class="style-one">
																		<div align="center"><b><u>Judgement Grade</u></b></div>
																		</br>
																		<div class="control-group">
																			<label class="control-label" for="select01">Sputum</label>
																			<div class="controls">
																			<select name="sputum_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Sputum==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Sputum=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Sputum=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Sputum=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Sputum=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Sputum=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Sputum=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Sputum=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		
																		<div class="control-group">																			
																			<label class="control-label">Urine Analysis</label>
																			<div class="controls">
																			<select name="urinea_grade" style="width: 210px;">
																				<option <?php if($row_grade->Urine_Analysis==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Urine_Analysis=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Urine_Analysis=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Urine_Analysis=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Urine_Analysis=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Urine_Analysis=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Urine_Analysis=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Urine_Analysis=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Urine Sediment</label>
																			<div class="controls">
																			<select name="urines_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Urine_Sediment==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Urine_Sediment=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Urine_Sediment=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Urine_Sediment=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Urine_Sediment=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Urine_Sediment=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Urine_Sediment=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Urine_Sediment=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Urine Glucose</label>
																			<div class="controls">
																			<select name="urineg_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Urine_Sediment==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Urine_Sediment=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Urine_Sediment=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Urine_Sediment=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Urine_Sediment=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Urine_Sediment=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Urine_Sediment=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Urine_Sediment=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>	
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Fructosamine</label>
																			<div class="controls">
																			<select name="sero_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Fructosamine==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Fructosamine=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Fructosamine=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Fructosamine=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Fructosamine=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Fructosamine=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Fructosamine=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Fructosamine=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>	
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Tumor Marker</label>
																			<div class="controls">
																			<select name="tumor_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Tumor_Marker==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Tumor_Marker=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Tumor_Marker=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Tumor_Marker=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Tumor_Marker=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Tumor_Marker=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Tumor_Marker=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Tumor_Marker=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>	
																		
																		<!-- penambahan blood ke lab dibawah ini -->
																		<div class="control-group">
																			<label class="control-label" for="select01">OB/Parasite</label>
																			<div class="controls">
																			<select name="ob_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->OB==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->OB=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->OB=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->OB=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->OB=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->OB=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->OB=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->OB=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>		
																		
																		<div class="control-group">
																			<label class="control-label" for="select01">Liver function</label>
																			<div class="controls">
																			<select name="liver_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Liver_Function==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Liver_Function=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Liver_Function=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Liver_Function=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Liver_Function=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Liver_Function=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Liver_Function=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Liver_Function=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>			
																		<div class="control-group">
																			<label class="control-label" for="select01">Renal</label>
																			<div class="controls">
																			<select name="renal_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Renal==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Renal=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Renal=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Renal=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Renal=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Renal=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Renal=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Renal=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Pancreas</label>
																			<div class="controls">
																			<select name="pan_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Pancreas==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Pancreas=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Pancreas=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Pancreas=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Pancreas=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Pancreas=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Pancreas=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Pancreas=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Uric acid</label>
																			<div class="controls">
																			<select name="uric_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Uric_Acid==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Uric_Acid=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Uric_Acid=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Uric_Acid=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Uric_Acid=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Uric_Acid=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Uric_Acid=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Uric_Acid=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Lipid</label>
																			<div class="controls">
																			<select name="lipid_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Uric_Acid==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Uric_Acid=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Uric_Acid=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Uric_Acid=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Uric_Acid=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Uric_Acid=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Uric_Acid=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Uric_Acid=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Electrolyte</label>
																			<div class="controls">
																			<select name="elec_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Electrolyte==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Electrolyte=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Electrolyte=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Electrolyte=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Electrolyte=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Electrolyte=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Electrolyte=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Electrolyte=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Anemia Test</label>
																			<div class="controls">
																			<select name="anemia_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Anemia_Test==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Anemia_Test=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Anemia_Test=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Anemia_Test=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Anemia_Test=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Anemia_Test=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Anemia_Test=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Anemia_Test=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Hematology</label>
																			<div class="controls">
																			<select name="hema_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Hematology==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Hematology=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Hematology=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Hematology=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Hematology=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Hematology=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Hematology=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Hematology=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">WBC</label>
																			<div class="controls">
																			<select name="wbc_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->WBC_Classification==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->WBC_Classification=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->WBC_Classification=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->WBC_Classification=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->WBC_Classification=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->WBC_Classification=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->WBC_Classification=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->WBC_Classification=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Inflammation</label>
																			<div class="controls">
																			<select name="inflam_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Inflammation==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Inflammation=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Inflammation=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Inflammation=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Inflammation=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Inflammation=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Inflammation=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Inflammation=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Syphilis</label>
																			<div class="controls">
																			<select name="syph_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Syphilis==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Syphilis=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Syphilis=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Syphilis=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Syphilis=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Syphilis=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Syphilis=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Syphilis=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Serology Hepatitis</label>
																			<div class="controls">
																			<select name="sero_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Serology_Hepatitis==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Serology_Hepatitis=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Serology_Hepatitis=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Serology_Hepatitis=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Serology_Hepatitis=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Serology_Hepatitis=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Serology_Hepatitis=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Serology_Hepatitis=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Immunology test</label>
																			<div class="controls">
																			<select name="imm_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Immunology_Test==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Immunology_Test=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Immunology_Test=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Immunology_Test=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Immunology_Test=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Immunology_Test=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Immunology_Test=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Immunology_Test=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>	
																		<div class="control-group">
																			<label class="control-label" for="select01">Diabetes Mellitus</label>
																			<div class="controls">
																			<select name="diabetes_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Diabetes_Mellitus==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Diabetes_Mellitus=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>	
																		<div class="control-group">
																			<label class="control-label" for="select01">Blood Glucose</label>
																			<div class="controls">
																			<select name="bloodg_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Blood_Glucose==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Blood_Glucose=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Blood_Glucose=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Blood_Glucose=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Blood_Glucose=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Blood_Glucose=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Blood_Glucose=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Blood_Glucose=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>	
																		</div>
																		</div>
																		
																		<div class="block" style="width: 53%; padding:4px; height:100%; float: right;">
																		<script> 
																		$(function(){
																		$("#includedContent").load("<?=base_url();?>/lab/lab_view_mcu/<?=$_POST['id_reg'];?>"); 
																		});
																		</script> 
																		<div id="includedContent"></div>
																		</div>
																		</div>
																		<!-- penambahan blood ke lab diatas ini -->
																		<div class="tab-pane" id="tab13">
																		<fieldset>
																		<div class="block" style="width: 50%; float: left;">
																		<div style="overflow-x: scroll; height:560px;">
																		<?php 
																		$aa=1;
																		$bb=1;
																		$cc=1;
																		$row_cnta = $comment_rad->num_rows();
																		?>
																		<input type="text" style="display: none;" name="rowCyin" value="<?=$row_cnta;?>">
																		<div align="center"><b><u>Comment Rad. Result</u></b></div>
																		</br>
																		<?php
																		foreach($comment_rad->result() as $row_comment){
																		?>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput"><?=$row_comment->group_desc;?></label>
																		<div class="controls">
																		<textarea style="width: 195px;" size="6"  name="comment_rad_<?=$aa++;?>" placeholder=". . ." autocomplete="off" readonly><?=$row_comment->comment;?></textarea> <button type="button" onclick="comment(<?=$cc++;?>);" class="btn btn-info btn-mini"><i class="icon-pencil"></i></button>
																		<input type="text" style="display: none;" name="isi_rad_<?=$bb++;?>" value="<?=$row_comment->id;?>">
																		</div>
																		</div>
																		<?php
																		}
																		?>
																		<hr class="style-one">
																		<div align="center"><b><u>Judgement Grade</u></b></div>
																		</br>
																		<div class="control-group">
																			<label class="control-label" for="select01">Chest X-ray</label>
																			<div class="controls">
																			<select name="chest_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Chest_Xray==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Chest_Xray=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Chest_Xray=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Chest_Xray=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Chest_Xray=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Chest_Xray=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Chest_Xray=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Chest_Xray=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">X-ray Shadow</label>
																			<div class="controls">
																			<select name="shadowxray_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Xray_Shadow==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Xray_Shadow=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Xray_Shadow=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Xray_Shadow=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Xray_Shadow=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Xray_Shadow=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Xray_Shadow=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Xray_Shadow=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																	
																		<div class="control-group">
																			<label class="control-label" for="select01">USG</label>
																			<div class="controls">
																			<select name="usg_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">USG Prostate</label>
																			<div class="controls">
																			<select name="usgp_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG_Prostate==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG_Prostate=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG_Prostate=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG_Prostate=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG_Prostate=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG_Prostate=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG_Prostate=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG_Prostate=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">USG Uterus</label>
																			<div class="controls">
																			<select name="usgu_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG_Uterus==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG_Uterus=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG_Uterus=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG_Uterus=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG_Uterus=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG_Uterus=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG_Uterus=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG_Uterus=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">USG Mammae</label>
																			<div class="controls">
																			<select name="usgm_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG_Mammae==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG_Mammae=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG_Mammae=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG_Mammae=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG_Mammae=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG_Mammae=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG_Mammae=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG_Mammae=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="select01">Stomach X-ray</label>
																			<div class="controls">
																			<select name="stoxray_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Stomach_Xray==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Stomach_Xray=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Stomach_Xray=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Stomach_Xray=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Stomach_Xray=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Stomach_Xray=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Stomach_Xray=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Stomach_Xray=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																			</div>
																		</div>
																		</div>
																		</div>
																		
																		<div class="block" style="width: 48%; padding:5px; height:100%; float: right;">
																		<script> 
																		$(function(){
																		$("#includedContent_rad").load("<?=base_url();?>/radiology/rad_report_mcu/<?=$_POST['id_reg'];?>"); 
																		});
																		</script> 
																		<div id="includedContent_rad"></div>
																		</div>																		
																		<fieldset>
																		</div>
																		
																		<div class="tab-pane" id="tab14">
																		<fieldset>
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Certificate of Fitness</label>
																		<div class="controls">
																			<select name="fitness" id="" style="width: 210px;">
																				<option <?php if($row_isi->fitness==0){ echo  "selected"; }?> value="0"> Choose </option>
																				<option <?php if($row_isi->fitness=="1"){ echo "selected"; }?> value="1" align="justify">Fit to Work</option>
																				<option <?php if($row_isi->fitness=="2"){ echo "selected"; }?> value="2" align="justify">Fit with Note</option>
																				<option <?php if($row_isi->fitness=="5"){ echo "selected"; }?> value="5" align="justify">Fit with Restriction</option>
																				<option <?php if($row_isi->fitness=="3"){ echo "selected"; }?> value="3" align="justify">Temporarily unfit</option>
																				<option <?php if($row_isi->fitness=="4"){ echo "selected"; }?> value="4" align="justify">Unfit</option>						
																			</select>
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Suggestion</label>
																		<div class="controls">
																			<input type="text" style="width: 195px;" size="6" name="suggestion" value="<?=$row_isi->suggestion;?>" placeholder=". . ." autocomplete="off"> 
																		</div>
																		</div>
																		
																		<div class="control-group">
																		<label class="control-label" for="focusedInput">Comments</label>
																		<div class="controls">
																		<textarea style="width: 245px; height: 150px;" size="10"  name="comment_final" placeholder=". . ." autocomplete="off"><?=str_replace(";",";",$row_isi->fitness_comment);?></textarea> <button type="button" onclick="comment_fin();" class="btn btn-info btn-mini"><i class="icon-pencil"></i></button>
																		</div>
																		</div>
																		
																		</div>
																	<fieldset>
																	</div>
																		
																<ul class="pager wizard">
																	<li class="previous first" style="display:none;"><a href="javascript:void(0);">First</a></li>
																	<li class="previous"><a href="javascript:void(0);">Previous</a></li>
																	<li class="next last" style="display:none;"><a href="javascript:void(0);">Last</a></li>
																	<li class="next"><a href="javascript:void(0);">Next</a></li>
																	<li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
																</ul>
															</div>  
														</div>
													</div>
												</div>
											</div>
											<!-- /block -->
										
										<!-- /wizard -->
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>									
                                </div>
								<div class="form-actions" >
								<div style="float:left;">
								<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
								</div>
								<div style="float:right;">
								<button class="btn btn-danger" type="reset"><b>Reset</b></button>
                                </div>
								</form>  
                            </div>
                        </div>
						</body>
                        <!-- /block -->
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
        <script src="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.js"></script>
		<link href="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
		<script>
		jQuery(document).ready(function(){   
		FormValidation.init();
		});
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
		
        </script>
