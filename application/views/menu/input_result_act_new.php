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

	$(document).ready(function() {
		$(window).keydown(function(event){
		if(event.keyCode == 13) {
			  event.preventDefault();
	  		return false;
			}
		});
	});


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
					<?php foreach($data_lock->result() as $row_lock){} ?>
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
										$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span> You had locked input :</br></br>Patient Name</br><?=$_POST['pat_name'];?></br><?php foreach($all_note->result() as $row_notes){ ?> <?php echo $row_notes->result;?> <?php } ?>", { sticky: true });
									break;
				
									case 'notification-header':
										$.jGrowl("A message with a header", { header: 'Important' });
									break;
				
									default:
										$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span> You had locked input :</br></br>Patient Name</br><?=$_POST['pat_name'];?></br></br><b>Notes </b></br><?php foreach($all_note->result() as $row_notes){ ?> <?php echo $row_notes->result;?> <?php } ?>", { sticky: true });
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
										<form class="form-horizontal" action="<?php echo base_url();?>patient/input_result/xxx/<?=$_POST['id_reg'];?>" method="post" name="xxxx">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" value="<?=$_POST['pat_mrn'];?>" id="" readonly autocomplete="off" placeholder=" ... ">
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
										<input name="id_reg" type="hidden" value="<?=$_POST['id_reg'];?>" id=""  autocomplete="off" >
										<button class="btn btn-success btn-mini"><i class="icon-lock"></i> Unlock Input Result <i>[MCU]</i></button>
										</form>
										</br>
										
										<form class="form-horizontal" action="<?php echo base_url();?>patient/save_mcu_result_new" method="post" name="mark_mcu">
										<!-- wizard -->
											<input name="id_reg" type="hidden" value="<?=$_POST['id_reg'];?>" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" type="hidden" id="" value="<?=$_POST['id_pat'];?>"  autocomplete="off" >
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
																<li><a href="#tab4" data-toggle="tab"><b>Physical Examination</b></a></li>
																<li><a href="#tab1" data-toggle="tab"><b>Medical Results</b></a></li>
																<li><a href="#tab3" data-toggle="tab"><b>Final Results</b></a></li>
																<li><a href="#tab2" data-toggle="tab"><b><font color="red">Judgment Grade</font></b></a></li>
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
																		$warna	= "success";
																		$obes 	= null;
																		$current_cat 	= null;
																		$current_cat_2 	= null;
																		$current_cat_3 	= null;
																		$aa= 1;
																		$bb= 1;
																		$currentss = 1; $hearingss = 1;
																		$i = 1; $c = 1; $e = 1; $add_2 = 1; $add_4 = 1; $ant_us = 1; $gh = 1; $dd = 1; $vv1 = 1; $vv3 = 1;  $vv5 = 1;
																		$b = 1; $d = 1; $add = 1; $add_3 = 1; $ant = 1; $spe_sub= 1; $cc = 1; $vv = 1; $vv2 = 1; $vv4 = 1;  $antt = 1;
																		$datt = 1; $urutan = 1;
																		foreach($filemcu->result() as $row_isis){
																		?>
																		<b>
																			<?php 
																			if($row_isis->group_header != $current_cat_3){
																				$current_cat_3 = $row_isis->group_header;
																				echo "<div class='alert alert-info'><i class='icon-chevron-down'></i> <i>".$row_isis->group_header."</i>";
																			?>
																			<script>
																			function updateAreaA<?=$aa++;?>(id){
																				// alert(<?=$row_isis->id_quot_header;?>);
																				// alert('<?=$row_isis->group_header;?>');
																				$.post("update_group/"+id+"/<?=$row_isis->id_quot_header;?>/<?=$row_isis->group_header;?>", $("#console").serialize());


																				$('.kepala').click(function() {
																				  updateSearch();
																				});

																				var updateSearch = function() {
																				  $('.urutan').val($('.kepala').val());
																				};

																			}
																			</script>
																			</div>
																			
																			<script>
																			var counter_ant_<?=$vv++;?> 	= 1;
																			var limit_ant	 				= 5;
																			function addInput<?=$add++;?>(divName,vall){
																			 if (counter_ant_<?=$vv1++;?> == limit_ant)  {
																				  alert("Sorry, you have only " + counter_ant_<?=$vv2++;?> + " inputs");
																			 }else{
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input type='hidden' name='header_atas[]'  value='<?=$row_isis->group_header;?>' ><input type='hidden' name='urutan[]' id='urutan' class='urutan' value='1' ><input placeholder='Start Typing ...' type='text' style='width: 610px;' class='span6' id='typeahead' name='comment_atas[]' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_ant_<?=$datt++;?>' value='"+counter_ant_<?=$vv4++;?>+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_ant_<?=$vv5++;?>++;

																				  $('.urutan').val($('.kepala').val());
																				}
																			}
																			</script>		
																			<?php if ($jml_komentar > 0) { ?>
																			<div class="alert alert-success control-group">
																			<label class="control-label" for="typeahead"><i class="icon-comment"></i> <b>Comment History<i></i></b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<?php
																			foreach ($komentar->result() as $row) {
																			
																				// echo $row_isis->group_header." - ".$row->nama_comment;
																				// echo "<br>";
																				// echo rtrim($row_isis->group_header)." - ".$row->nama_comment;
																				// echo "<br>";
																			
																				if (rtrim($row_isis->group_header) == rtrim($row->nama_comment)) {
																				echo "* ".$row->comment;
																				echo "<br>";
																				}
																			}
																			?>			
																			</div>
																			</div>
																			</div>
																			<?php } ?>
																																	
																	<?php if($row_isis->group_header=="Respiratory system" || $row_isis->serv_name=="Lung Function"){ ?>
																	<div class="alert alert-warning control-group">
																	<label class="control-label" for="typeahead"><b><i class="icon-certificate"></i> Lung Function Grade</b></label>
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
																	</div>
																	</div>
																	<?php } ?>
																	
																	<?php if($row_isis->group_header=="Cardiography" || $row_isis->serv_name=="ECG"){ ?>
																	<div class="alert alert-warning control-group">
																	<label class="control-label" for="typeahead"><b><i class="icon-certificate"></i> ECG Grade</b></label>
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
																	</div>
																	</div>
																	<?php } ?>
																
																	<div class="alert control-group">
																	<label class="control-label" for="typeahead"><i class="icon-comment"></i> <b>Comment for <i><?=$row_isis->group_header;?></i></b></label>
																	<input type='hidden' value='<?=ucfirst($row_isis->group_header);?>' name='group_header_<?=$gh++;?>'>
																	<div class="controls">
																	<div id="p_scents">
																	<div id="dynamicInput<?=$add_3++;?>">
																	<input type='hidden' name='header_atas[]'  value='<?=$row_isis->group_header;?>' >
																	<input type="hidden" name="urutan[]" class="urutan" value="1">
																	<input placeholder="Start Typing ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="comment_atas[]" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_ant_<?=$antt++;?>' value='0'>
																	</div>
																	</div>
																	</br>
																	<input style="width:610px;" class="btn btn-success btn-mini" type="button" value="Add Row Comment" onClick="addInput<?=$add_2++;?>('dynamicInput<?=$add_4++;?>','<?=$ant_us++;?>');">			
																	</div>
																	</div>
																		
																	<?php
																	}else{
																		echo "";
																	}
																	?>
																			
																	<?php 
																	$currents = null;
																	$string = $row_isis->nama_value;
																	if(stristr($string, 'Blood Pressure') == TRUE) {
																		$warna = "info";
																	}
																	if(stristr($string, 'Blood Pressure - Systolic') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert control-group">
																	<label class="control-label" for="typeahead"><i class="icon-comment"></i> <b>Comment for <i>Blood Pressure</i></b></label>
																	<input type='hidden' value='Blood Pressure' name='group_header_<?=$gh++;?>'>
																	<div class="controls">
																	<div id="p_scents">
																	<div id="dynamicInput">
																	<input type='hidden' name='header_atas[]'  value='Blood Pressure' >
																	<input type="hidden" name="urutan[]" class="urutan" value="1">
																	<input placeholder="Start Typing ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="comment_atas[]" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_ant_<?=$antt++;?>' value='0'>
																	</div>
																	</div>
																	</br>
																	</div>
																	</div>
																	
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Blood Pressure Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="bp_grade" id="" style="width: 210px;">
																		<option <?php if($row_grade->Blood_Pressure==0){ echo "selected"; }?> value=""> Choose </option>
																		<option <?php if($row_grade->Blood_Pressure=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																		<option <?php if($row_grade->Blood_Pressure=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																		<option <?php if($row_grade->Blood_Pressure=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																		<option <?php if($row_grade->Blood_Pressure=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																		<option <?php if($row_grade->Blood_Pressure=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																		<option <?php if($row_grade->Blood_Pressure=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																		<option <?php if($row_grade->Blood_Pressure=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</div>
																	</div>
																	
																	<?php }
																	$currents = null;
																	}else{
																		echo "";
																	}
																	$currents = null;
																	?>
	
																	<?php 		
																	$currents = null;
																	$string="";
																	$obes = $row_isis->nama_value;
																	if(stristr($obes, 'BMR') == TRUE){
																		$warna = "info";	
																	//echo $obes;																		
																	if($row_isis->nama_value == $obes){
																	
																	?>
																	<div class='alert alert-info controls' >
																	<b><i class="icon-certificate"></i> Obesitas Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="hear_grade" id="" style="width: 210px;">
																	<option <?php if($row_grade->Obesitas==0){ echo "selected"; }?> value=""> Choose </option>
																	<option <?php if($row_grade->Obesitas=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																	<option <?php if($row_grade->Obesitas=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																	<option <?php if($row_grade->Obesitas=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																	<option <?php if($row_grade->Obesitas=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																	<option <?php if($row_grade->Obesitas=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																	<option <?php if($row_grade->Obesitas=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																	<option <?php if($row_grade->Obesitas=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</div>
																	</div>
																	<?php 
																	}
																	$string="";
																	}else{
																		echo "";
																	}
																	?>
																			
																	<?php 
																	$currents = null;
																	$string = $row_isis->nama_value;
																	if(stristr($string, 'Panoramic X-Ray') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert alert-warning control-group">
																	<label class="control-label" for="typeahead"><b><i class="icon-certificate"></i> Panoramic X-Ray Grade</b></label>
																	<div class="controls"><select name="pano_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Panoramic_Xray==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Panoramic_Xray=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Panoramic_Xray=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Panoramic_Xray=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Panoramic_Xray=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Panoramic_Xray=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Panoramic_Xray=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Panoramic_Xray=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</div>
																	</div>
																	<?php }
																	$currents = null;
																	}else{
																		echo "";
																	}
																	$currents = null;
																	?>
																																					
																	<?php 
																	$currents = null;
																	$string = $row_isis->nama_value;
																	if(stristr($string, 'Extra Oral') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert alert-warning control-group">
																	<label class="control-label" for="typeahead"><b><i class="icon-certificate"></i> Extra Oral Grade</b></label>
																	<div class="controls"><select name="exor_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Extra_Oral==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Extra_Oral=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Extra_Oral=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Extra_Oral=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Extra_Oral=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Extra_Oral=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Extra_Oral=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Extra_Oral=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</div>
																	</div>
																	<?php }
																	$currents = null;
																	}else{
																		echo "";
																	}
																	$currents = null;
																	?>
																		
																	<?php 
																	$currents = null;
																	$string = $row_isis->nama_value;
																	if(stristr($string, 'Intra Oral') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert alert-warning control-group">
																	<label class="control-label" for="typeahead"><b><i class="icon-certificate"></i> Intra Oral Grade</b></label>
																	<div class="controls"><select name="intr_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Intra_Oral==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Intra_Oral=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Intra_Oral=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Intra_Oral=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Intra_Oral=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Intra_Oral=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Intra_Oral=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Intra_Oral=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</div>
																	</div>
																	<?php }
																	$currents = null;
																	}else{
																		echo "";
																	}
																	$currents = null;
																	?>
																	
																	<?php 
																	$currents = null;
																	$string = $row_isis->nama_value;
																	if(stristr($string, 'Dental Hygiene') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert alert-warning control-group">
																	<label class="control-label" for="typeahead"><b><i class="icon-certificate"></i> Dental Hygiene Grade</b></label>
																	<div class="controls"><select name="dent_grade" id="" style="width: 210px;">
																		<option <?php if($row_grade->Dental_Hygine==0){ echo "selected"; }?> value=""> Choose </option>
																		<option <?php if($row_grade->Dental_Hygine=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																		<option <?php if($row_grade->Dental_Hygine=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																		<option <?php if($row_grade->Dental_Hygine=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																		<option <?php if($row_grade->Dental_Hygine=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																		<option <?php if($row_grade->Dental_Hygine=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																		<option <?php if($row_grade->Dental_Hygine=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																		<option <?php if($row_grade->Dental_Hygine=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																		</select>
																	</div>
																	</div>
																	<?php }
																	$currents = null;
																	}else{
																		echo "";
																	}
																	$currents = null;
																	?>
																	
																	<?php if($row_isis->group_header=="Color Blindness" || $row_isis->serv_name=="Color Blindness"){ 
																	$warna = "info";
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Color Blindness Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'>
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
																	</div>
																	</div>
																	<?php } ?>
																	
																	<?php 
																	$hearings = null;
																	if($row_isis->group_header=="Hearing"){ 
																	$hearings = $hearingss++;
																	//echo $hearings;
																	$warna = "info";
																	if( $hearings == 1){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Hearing Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="hear_grade" id="" style="width: 210px;">
																		<option <?php if($row_grade->Hearing==0){ echo "selected"; }?> value=""> Choose </option>
																		<option <?php if($row_grade->Hearing=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																		<option <?php if($row_grade->Hearing=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																		<option <?php if($row_grade->Hearing=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																		<option <?php if($row_grade->Hearing=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																		<option <?php if($row_grade->Hearing=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																		<option <?php if($row_grade->Hearing=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																		<option <?php if($row_grade->Hearing=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</div>
																	</div>
																	<?php }
																	}else{
																	}
																	?>
																	
																	<?php 
																	$currentssss = null;
																	//echo $row_isis->group_header;
																	if($row_isis->group_header=="Eyes test"){ 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	if( $currentssss == 1){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Eye Sight Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'>
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
																	</div>
																	</div>
																	<?php 
																		}
																			}else{
																	}
																	?>
																	
																	<?php 
																	if($row_isis->serv_name != $current_cat){
																		$current_cat = $row_isis->serv_name;
																		//echo "<div class='alert alert-success'>".$c++.". ".$current_cat."</div>";
																	}else{
																		echo "";
																	}
																	?>
																			
																	</b>
																	<?php 
																		if ($row_isis->flags == 1) {			
																			$tinggi_fisik = "&nbsp;<i class='icon-warning-sign'></i>";
																		}else{
																			$tinggi_fisik = "";
																		}
																		if($row_isis->serv_name != $current_cat_2){
																			$current_cat_2 = $row_isis->serv_name;
																			$d=1; $spesial=1;	 
																			echo  "<div class='alert alert-success controls' >".$d++.". ".$row_isis->nama_value." <div style='float:right; margin: -5px 380px 10px 0px;'>";
																			if($row_isis->ranges != "0 - 0"){ echo "<b>Std. Value [".$row_isis->ranges."]</b> "; } 
																			echo  "<input readonly type='text' style='width: 85px;' size='12' name='result_".$spesial++."_".$spe_sub++."' value='".$row_isis->result."' autocomplete='off'>$tinggi_fisik</div></div>";
																		}else{
																			echo  "<div class='alert alert-success controls'>".$d++.". ".$row_isis->nama_value." <div style='float:right; margin: -5px 380px 0px 0px;'>";
																			if($row_isis->ranges != "0 - 0"){ echo "<b>Std. Value [".$row_isis->ranges."]</b> "; }
																			echo  "<input readonly type='text' style='width: 85px;' size='12' name='result_".$spesial++."_".$spe_sub++."' value='".$row_isis->result."' autocomplete='off'>$tinggi_fisik</div></div>";
																		}																
																	?>

																	<?php
																	$warna ="success";
																	}									
																	?>	
																		
																		</br>
																		<?php
																			$currentss = 1;
																			$LABcurrent_cat 	= null;
																			$LABcurrent_cat_2 	= null;
																			$LABcurrent_cat_3 	= null;
																			$LABaa= 1;
																			$LABbb= 1;
																			$LABi = 1; $LABc = 1; $LABe   = 1; $LABadd_2 = 1; $LABadd_4 = 1; $LABant_us = 1; $LABgh = 1; $LABdd = 1;
																			$LABb = 1; $LABd = 1; $LABadd = 1; $LABadd_3 = 1; $LABant   = 1; $LABspe_sub= 1; $LABcc = 1; $LABBd = 1;
																		foreach($filemcu_labrad->result() as $row_labrad){
																		?>
																		<b>
																			<?php 
																			if($row_labrad->group_header != $LABcurrent_cat_3){
																				$LABcurrent_cat_3 = $row_labrad->group_header;
																				echo "<div class='alert alert-info'><i class='icon-chevron-down'></i> <i>".$row_labrad->group_header."</i>";
																			?>
																			<script>
																			function updateArea<?=$LABaa++;?>(id){
																				$.post("update_group/"+id+"/<?=$row_labrad->id_quot_header;?>/<?=$row_labrad->group_header1;?>", $("#console").serialize());
																				
																				$('.kepalaradlab').click(function() {
																				  updateSearch();
																				});

																				var updateSearch = function() {
																				  $('.keurutan').val($('.kepalaradlab').val());
																				};

																			}
																			</script>																			
																			</div>
																			<?php
																			}else{
																				echo "";
																			}
																			?>
																			<?php 
																			if($row_labrad->groups != $LABcurrent_cat){
																				$LABcurrent_cat = $row_labrad->groups;
																				echo "<div class='alert alert-success'>".$LABc++.". ".$LABcurrent_cat."</div>";
																			?>
																			<script>
																			var counter_ant 	= 1;
																			var limit_ant	 	= 5;
																			function addInputs<?=$LABadd++;?>(divName,vall){
																			 if (counter_ant == limit_ant)  {
																				  alert("Sorry, you have only " + counter_ant + " inputs");
																			 }else{
																				  var newdiv = document.createElement('div');
																				  newdiv.innerHTML = "</br><input type='hidden' name='header_bawah[]'  value='<?=$LABcurrent_cat;?>' ><input type='hidden' name='keurutan[]' id='keurutan' class='keurutan' ><input placeholder='Start Typing ...' type='text' style='width: 610px;' class='span6' id='typeahead' name='comment_bawah[]' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_ant' value='"+counter_ant+"'>";
																				  document.getElementById(divName).appendChild(newdiv);
																				  counter_ant++;
																				   $('.keurutan').val($('.kepalaradlab').val());
																				}
																			}
																			</script>		
																			<?php if ($jml_komentar > 0) { ?>

																			<div class="alert control-group">
																			<label class="control-label" for="typeahead"><i class="icon-comment"></i> <b>Comment History<i></i></b></label>
																			<div class="controls">
																			<div id="p_scents">
																			<?php
																			foreach ($komentar->result() as $row) {		
																				// echo $row_isis->group_header." - ".$row->nama_comment;
																				// echo "<br>";
																				// echo rtrim($row_isis->group_header)." - ".$row->nama_comment;
																				// echo "<br>";
																				if (rtrim($LABcurrent_cat) == rtrim($row->nama_comment)) {
																				echo "* ". $row->comment;
																				echo "<br>";
																				}
																			}
																			?>																			
																			</div>
																			</div>
																			</div>
																			<?php } ?>		
																			<div class="alert control-group">
																			<label class="control-label" for="typeahead"><i class="icon-comment"></i> <b>Comment for <i><?=$LABcurrent_cat;?></i></b></label>
																			<input type='hidden' value='<?=ucfirst($row_isis->group_header);?>' name='group_header_<?=$LABgh++;?>'>
																			<div class="controls">
																			<div id="p_scents">
																			<div id="dynamicInputs<?=$LABadd_3++;?>">
																			<input type='hidden' name='header_bawah[]' value='<?=$LABcurrent_cat;?>' >
																			<input type="hidden" name="keurutan[]" class="keurutan" value="<?=$row_labrad->prints;?>">
																			<input placeholder="Start Typing ..."  type="text" style="width: 610px;" class="span6" id="typeahead" name="comment_bawah[]" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"><input type='hidden' name='count_ant' value='0'>
																			</div>
																			</div>
																			</br>
																			<input style="width:610px;" class="btn btn-success btn-mini" type="button" value="Add Row Comment" onClick="addInputs<?=$LABadd_2++;?>('dynamicInputs<?=$LABadd_4++;?>','<?=$LABant_us++;?>');">			
																			</div>
																			</div>	
																	<?php 
																	$currents_labrad = null;
																	$string = $row_labrad->serv_name;
																	if(stristr($string, 'Urinalysis') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Urine Analysis Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="urinea_grade" style="width: 210px;">
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
																	<?php }
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>

																<?php 
																	$currents_labrad = null;
																	$string = $row_labrad->serv_name;
																	if(stristr($string, 'HbA1c') == TRUE) { 
																	if($row_isis->nama_value != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Diabetes Mellitus Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="Diabetes_Mellitus" style="width: 210px;">
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
																	<?php }
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
 
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->groups;
																	//echo $string;
																	if(stristr($string, 'Hematology') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 1){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Hematology Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="hema_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->groups;
																	//echo $string;
																	if(stristr($string, 'Drug Test') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 1){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Drug Test Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="drug_grade" id="" style="width: 210px;">
																		<option <?php if($row_grade->Drug_Test==0){ echo "selected"; }?> value=""> Choose </option>
																		<option <?php if($row_grade->Drug_Test=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																		<option <?php if($row_grade->Drug_Test=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																		<option <?php if($row_grade->Drug_Test=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																		<option <?php if($row_grade->Drug_Test=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																		<option <?php if($row_grade->Drug_Test=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																		<option <?php if($row_grade->Drug_Test=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																		<option <?php if($row_grade->Drug_Test=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</div>
																	</div>
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																			
																	<?php																			
																	}else{
																		echo "";
																	}
																	?>
																	</b>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->groups;
																	//echo $string;
																	if(stristr($string, 'Inflammation') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 1){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Inflammation</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="inflam_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->groups;
																	//echo $string;
																	if(stristr($string, 'Liver Function') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 1){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Liver Function Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="liver_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->groups;
																	//echo $string;
																	if(stristr($string, 'Hepatitis ') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 1){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Serology Hepatitis Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="sero_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->nama_group;
																	//echo $string;
																	if(stristr($string, 'Urine Sediment - Bacteria') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 1){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Urine Sediment Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="urines_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php 
																	$currents_labrad = null;
																	$string = $row_labrad->groups;
																	//echo $string;
																	if(stristr($string, 'Diabetes Mellitus') == TRUE) { 
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Diabetes Mellitus Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="diabetes_grade" id="" style="width: 210px;">
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
																	<?php 
																	//}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->nama_group;
																	//echo $string;
																	if(stristr($string, 'Glucose Urine') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 8){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Urine Glucose Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="urineg_grade" id="" style="width: 210px;">
																		<option <?php if($row_grade->Urine_Glucose==0){ echo "selected"; }?> value=""> Choose </option>
																		<option <?php if($row_grade->Urine_Glucose=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																		<option <?php if($row_grade->Urine_Glucose=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																		<option <?php if($row_grade->Urine_Glucose=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																		<option <?php if($row_grade->Urine_Glucose=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																		<option <?php if($row_grade->Urine_Glucose=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																		<option <?php if($row_grade->Urine_Glucose=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																		<option <?php if($row_grade->Urine_Glucose=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																		</select>
																	</div>
																	</div>
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->nama_group;
																	//echo $string;
																	if(stristr($string, 'WBC Classification - Eosinophil') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 2){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> WBC Classification Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="wbc_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->serv_name;
																	//echo $string;
																	if(stristr($string, 'Chest X-Ray') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 2){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> Chest X-Ray Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="chest_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>
																	
																	<?php
																	$currentssss = null;																	
																	$currents_labrad = null;
																	$string = $row_labrad->serv_name;
																	//echo $string;
																	if(stristr($string, 'X-ray Shadow') == TRUE) { 
																	$currentssss = $currentss++;
																	//echo $currentssss;
																	$warna = "info";
																	//if( $currentssss == 2){
																	//if($row_isis->group_header != $currents){
																	?>
																	<div class="alert alert-info controls">
																	<b><i class="icon-certificate"></i> X-Ray Shadow Grade</b>
																	<div style='float:right; margin: -5px 380px 10px 0px;'><select name="shadowxray_grade" id="" style="width: 210px;">
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
																	<?php 
																	//	}
																	$currents_labrad = null;
																	}else{
																		echo "";
																	}
																	$currents_labrad = null;
																	?>

																	
																		<?php 
																			$LABspesial=1;	
																			if ($row_labrad->is_normal == 1) {			
																				$tinggi = "&nbsp;<i class='icon-warning-sign'></i>";
																			}else{
																				$tinggi = "";
																			}
																			if($row_labrad->serv_name != $LABcurrent_cat_2){
																				$LABcurrent_cat_2 = $row_labrad->serv_name;
																				if($LABcurrent_cat_3 == "Radiologi"){
																					echo  "<div class='alert alert-success controls' >".$LABd++.". ";
																					if($row_labrad->nama_group !=""){ echo ""; }else{ echo $row_labrad->serv_name; }
																					echo " <b> ".$row_labrad->nama_group."</b> <input readonly type='hidden' style='width: 385px;' size='12' name='result_".$LABspesial++."_".$LABspe_sub++."' value='".$row_labrad->results."' autocomplete='off'><b>".$row_labrad->results."</b></div>";
																				}else{
																					echo  "<div class='alert alert-success controls' >".$LABd++.". ";
																					if($row_labrad->nama_group !=""){ echo ""; }else{ echo $row_labrad->serv_name; }
																					echo " <b> ".$row_labrad->nama_group."</b> <div style='float:right; margin: -5px 80px 10px 0px;'>";
																					
																					if($row_labrad->std_value != "0 - 0" && $row_labrad->std_value != ""){
																					echo "<b>Std. Value  [".$row_labrad->std_value."] </b> ";
																					}
																					
																					echo "  <input readonly type='text' style='width: 85px;' size='12' name='result_".$LABspesial++."_".$LABspe_sub++."' value='".$row_labrad->results."' autocomplete='off'>$tinggi</div></div>";
																				}
																			}else{
																				if($LABcurrent_cat_3 == "Radiologi"){
																					echo  "<div class='alert alert-success controls' >".$LABd++.". ";
																					if($row_labrad->nama_group !=""){ echo ""; }else{ echo $row_labrad->serv_name; }
																					echo " <b> ".$row_labrad->nama_group."</b><input readonly type='hidden' style='width: 85px;' size='12' name='result_".$LABspesial++."_".$LABspe_sub++."' value='".$row_labrad->results."' autocomplete='off'><b>".$row_labrad->results."</b></div>";
																				}else{
																					echo  "<div class='alert alert-success controls' >".$LABd++.". ";
																					if($row_labrad->nama_group !=""){ echo ""; }else{ echo $row_labrad->serv_name; }
																					echo " <b> ".$row_labrad->nama_group."</b> <div style='float:right; margin: -5px 80px 10px 0px;'>";
																					
																					if($row_labrad->std_value != "0 - 0" && $row_labrad->std_value != ""){
																					echo "<b>Std. Value  [".$row_labrad->std_value."] </b> ";
																					}
																					
																					echo "  <input readonly type='text' style='width: 85px;' size='12' name='result_".$LABspesial++."_".$LABspe_sub++."' value='".$row_labrad->results."' autocomplete='off'>$tinggi</div></div>";
																				}
																			}
																		?>
																		<?php
																		}
																		?>	
																		</br>
																		</br>																		
																	</fieldset>									
																</div>
																
																<div class="tab-pane" id="tab4">
																<fieldset>
																<table class="table table-bordered">
																<thead>
																	<tr>
																	<th>Contents</th>
																	<th>Value</th>
																	<th>Result</th>
																	</tr>
																</thead>
																<tbody>
																<?php $masuk = 1;$nomor=1;$komentar=1;$coba=1;$cb=1;
																
																?>
																	<tr>
																		<td valign="top" rowspan="4">♦ <b>Vital Sign</b></td>
																		<td><?=$nomor++;?>. Pulse Rate</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->pulse_rate;?>" placeholder="Pulse Rate" autocomplete="off"> /menit</td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Breathing</td>
																		<td> <input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->breathing;?>" placeholder="Breathing" autocomplete="off">  /menit</td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Blood Pressure</td>
																		<td> <input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->vital_sign_bp;?>" placeholder="Blood Pressure" autocomplete="off"> /mmHg</td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Temperature</td>
																		<td> <input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->temperatur;?>" placeholder="Temperature" autocomplete="off"> &#8451;</td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="3">♦ <b>Eyes</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Anterior Chamber</td>
																		<td> <input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->anteriorc;?>" placeholder="Anterior Chamber" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Visual Examination</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->eyes_visual_exam;?>" placeholder="Visual Examination" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Eyes Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->eyes_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="3">♦ <b>Ear</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Right ear</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->ear_right;?>" placeholder="Right ear" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Left ear</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->ear_left;?>" placeholder="Left ear" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="4">♦ <b>Nose</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Septum</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->nose_septum;?>" placeholder="Septum" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Polyps</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->nose_polyps;?>" placeholder="Polyps" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Conchac</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->nose_conchae;?>" placeholder="Conchac" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Nose Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->nose_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top">♦ <b>Dental</b></td>
																		<td colspan="2"><input placeholder="Dental Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->dental;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="3">♦ <b>Throat</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Pharynx</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->throat_pharynx;?>" placeholder="Pharynx" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Tonsil</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->throat_tonsil;?>" placeholder="Tonsil" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Throat Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->throat_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="3">♦ <b>Neck</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Thyroid</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neck_thyroid;?>" placeholder="Thyroid" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Lymph Node</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neck_lymph;?>" placeholder="Lymph Node" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Neck Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neck_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="3">♦ <b>Cardiac</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. JVP</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->cardiac_jvp;?>" placeholder="JVP" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Heart Sound</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->cardiac_heartsound;?>" placeholder="Heart Sound" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Cardiac Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->cardiac_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="2">♦ <b>Breast </b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Breast Glands</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->breast_glands;?>" placeholder="Breast Glands" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Breast Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->breast_glands_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="2">♦ <b>Respiratory system</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Lung Sound</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->respiratory;?>" placeholder="Lung Sound" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Respiratory system Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->respiratory_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top">♦ <b>Abdomen general condition</b></td>
																		<td colspan="2"><input placeholder="Abdomen general condition Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->abdomen_general;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="5">♦ <b>Abdomen</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Liver</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->abdomen_liver;?>" placeholder="Liver" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Spleen</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->abdomen_spleen;?>" placeholder="Spleen" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Kidney</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->abdomen_kidney;?>" placeholder="Kidney" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Rectal Screening</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->abdomen_rectal;?>" placeholder="Rectal Screening" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Abdomen Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->abdomen_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top">♦ <b>Spine</b></td>
																		<td colspan="2"><input placeholder="Spine Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->spine;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top">♦ <b>Skin</b></td>
																		<td colspan="2"><input placeholder="Skin Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->skin;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>	<tr>
																		<td valign="top">♦ <b>Musculoskeletal disease</b></td>
																		<td colspan="2"><input placeholder="Musculoskeletal disease Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->Musculoskeletal;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="4">♦ <b>Genitourinary</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Hernia</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->genitourinary_hernia;?>" placeholder="Hernia" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Inguinal Nodes</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->genitourinary_inguinal;?>" placeholder="Inguinal Nodes" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Hemorhoid</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->genitourinary_hemorrhoid;?>" placeholder="Hemorhoid" autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Genitourinary Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->genitourinary_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top" rowspan="5">♦ <b>Neurologi</b></td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Motor system</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neurological_motor;?>" placeholder="Motor system" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Sensory system</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neurological_sensory;?>" placeholder="Sensory system" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Reflexes</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neurological_reflexes;?>" placeholder="Reflexes" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td><?=$nomor++;?>. Others</td>
																		<td><input type="text" size="6" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neurological_other;?>" placeholder="Others" autocomplete="off"></td>
																		<td> </td>
																	</tr>
																	<tr>
																		<td>&rArr; Comments</td>
																		<td colspan="2"><input placeholder="Neurologi Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->neurological_comment;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top">♦ <b>Fungsi Luhur</b></td>
																		<td colspan="2"><input placeholder="Fungsi Luhur Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->fungsi_luhur;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																	<tr>
																		<td valign="top">♦ <b>Physician comments</b></td>
																		<td colspan="2"><input placeholder="Physician comments Comment ..." title="" type="text" style="width: 610px;" class="span6" id="typeahead" name="masuk<?=$masuk++;?>" value="<?=$row_grade->physician;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off"></td>
																	</tr>
																</tbody>
																</table>
																</fieldset>
																</div>
								
																<div class="tab-pane" id="tab2">
																<fieldset>
																<table class="table table-bordered">
																<thead>
																	<tr>
																	<th>Contents</th>
																	<th>Grade</th>
																	<th>Contents</th>
																	<th>Grade</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																	
																	<td>Immunology test</td>
																	<td><select name="imm_grade" id="" style="width: 210px;">
																		<option <?php if($row_grade->Immunology_Test==0){ echo "selected"; }?> value=""> Choose </option>
																		<option <?php if($row_grade->Immunology_Test=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																		<option <?php if($row_grade->Immunology_Test=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																		<option <?php if($row_grade->Immunology_Test=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																		<option <?php if($row_grade->Immunology_Test=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																		<option <?php if($row_grade->Immunology_Test=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																		<option <?php if($row_grade->Immunology_Test=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																		<option <?php if($row_grade->Immunology_Test=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																		</select>
																	</td>
																	</tr>
																	<tr>
																	
																	</tr>
																	<tr>
																	<td>Ocular Tension</td>
																	<td>																			
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
																	</td>																
																	</tr>
																	<tr>
																	
																	</tr>
																	<tr>
																	<td>Fundus</td>
																	<td>
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
																	</td>

																	</tr>
																	<tr>
																
																	<td>Tumor Marker</td>
																	<td><select name="tumor_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Tumor_Marker==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Tumor_Marker=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Tumor_Marker=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Tumor_Marker=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Tumor_Marker=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Tumor_Marker=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Tumor_Marker=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Tumor_Marker=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	
																	
																	</tr>
																	<tr>
																	<td>Lung Function</td>
																	<td><select name="lung_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Lung_Function==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Lung_Function=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Lung_Function=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Lung_Function=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Lung_Function=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Lung_Function=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Lung_Function=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Lung_Function=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	
																	</tr>
																	<tr>
																	
																	<td>Sputum</td>
																	<td><select name="sputum_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Sputum==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Sputum=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Sputum=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Sputum=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Sputum=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Sputum=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Sputum=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Sputum=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	
																	<td>ECG</td>
																	<td><select name="ecg_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->ECG==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->ECG=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->ECG=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->ECG=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->ECG=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->ECG=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->ECG=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->ECG=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	<td>OB/Parasite in Stool</td>
																	<td><select name="ob_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->OB==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->OB=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->OB=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->OB=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->OB=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->OB=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->OB=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->OB=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</td>
																	<td>Treadmill</td>
																	<td><select name="tread_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Treadmill==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Treadmill=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Treadmill=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Treadmill=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Treadmill=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Treadmill=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Treadmill=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Treadmill=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</td>
																	</tr>
																	<tr>

																	<td>Echocardiographi</td>
																	<td><select name="echoca_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Echocardiographi==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Echocardiographi=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Echocardiographi=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Echocardiographi=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Echocardiographi=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Echocardiographi=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Echocardiographi=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Echocardiographi=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	<td>Renal</td>
																	<td><select name="renal_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Renal==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Renal=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Renal=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Renal=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Renal=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Renal=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Renal=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Renal=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	<td>USG</td>
																	<td><select name="usg_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	<td>Pancreas</td>
																	<td><select name="pan_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Pancreas==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Pancreas=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Pancreas=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Pancreas=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Pancreas=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Pancreas=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Pancreas=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Pancreas=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</td>
																	<td>USG Prostate</td>
																	<td><select name="usgp_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG_Prostate==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG_Prostate=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG_Prostate=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG_Prostate=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG_Prostate=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG_Prostate=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG_Prostate=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG_Prostate=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	<td>Uric Acid</td>
																	<td><select name="uric_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Uric_Acid==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Uric_Acid=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Uric_Acid=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Uric_Acid=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Uric_Acid=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Uric_Acid=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Uric_Acid=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Uric_Acid=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	<td>USG Uterus</td>
																	<td><select name="usgu_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG_Uterus==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG_Uterus=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG_Uterus=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG_Uterus=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG_Uterus=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG_Uterus=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG_Uterus=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG_Uterus=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	<td>Lipid</td>
																	<td><select name="lipid_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Lipid==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Lipid=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Lipid=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Lipid=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Lipid=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Lipid=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Lipid=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Lipid=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	<td>USG Mammae</td>
																	<td><select name="usgm_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->USG_Mammae==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->USG_Mammae=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->USG_Mammae=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->USG_Mammae=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->USG_Mammae=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->USG_Mammae=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->USG_Mammae=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->USG_Mammae=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	<td>Electrolyte</td>
																	<td><select name="elec_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Electrolyte==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Electrolyte=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Electrolyte=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Electrolyte=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Electrolyte=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Electrolyte=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Electrolyte=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Electrolyte=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	<td>Stomach X-ray</td>
																	<td><select name="stoxray_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Stomach_Xray==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Stomach_Xray=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Stomach_Xray=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Stomach_Xray=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Stomach_Xray=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Stomach_Xray=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Stomach_Xray=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Stomach_Xray=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	
																	<td>Pap Smear</td>
																	<td>
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
																	</td>
																	</tr>
																	<tr>
																	
																	<td>Breast Examination</td>
																	<td><select name="breast_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Breast_Examination==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Breast_Examination=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Breast_Examination=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Breast_Examination=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Breast_Examination=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Breast_Examination=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Breast_Examination=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Breast_Examination=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																	</select>
																	</td>
																	</tr>
																	<tr>
																	
																	
																	</tr>
																	<tr>
																	<td>Syphilis</td>
																	<td><select name="syph_grade" id="" style="width: 210px;">
																				<option <?php if($row_grade->Syphilis==0){ echo "selected"; }?> value=""> Choose </option>
																				<option <?php if($row_grade->Syphilis=="A"){ echo "selected"; }?> value="A" align="justify">A. No Problem</option>
																				<option <?php if($row_grade->Syphilis=="B"){ echo "selected"; }?> value="B" align="justify">B. A little problem, but not influence on daily life</option>
																				<option <?php if($row_grade->Syphilis=="BF"){ echo "selected"; }?> value="BF" align="justify">BF. Same as B, but need to follow up</option>
																				<option <?php if($row_grade->Syphilis=="C"){ echo "selected"; }?> value="C" align="justify">C. Need care on daily life</option>
																				<option <?php if($row_grade->Syphilis=="D"){ echo "selected"; }?> value="D" align="justify">D. Need medical treatment</option>
																				<option <?php if($row_grade->Syphilis=="E"){ echo "selected"; }?> value="E" align="justify">E. Under treatment</option>
																				<option <?php if($row_grade->Syphilis=="N"){ echo "selected"; }?> value="N" align="justify">N. Not tested</option>
																			</select>
																	</td>

																	</tr>
																	<tr>
																	
																	
																	</tr>
																	<tr>
																	
																	</tr>
																	
																</table>
																</fieldset>
																</div>
																
																<div class="tab-pane" id="tab3">
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
												<input onclick="this.disabled=true;this.form.submit();" type="submit" class="btn btn-success" value="Save">
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
