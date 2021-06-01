	<?php
	    include './design/fingers/global.php';
    	include './design/fingers/function.php';
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Marking Sheet Medical Check Up
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
	 
	 function myFunction2(id) {
		 window.location.href = "<?php echo base_url();?>patient/mark_sheet_mcu/xxx/"+id+"";
	 }

      function finger(){
       setTimeout(function(){
         window.location.reload(1);
      }, 10000);
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
					<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Marking Sheet Medical Check Up</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
                                        <div style="float:left;"></div><div style="float:right;"><button class="btn btn-success btn-mini" onclick="myFunction2('<?=$_POST['id_reg'];?>')"><i class="icon-lock"></i> <b>Unlock Form</b></button> <button class="btn btn-info btn-mini" onclick="myFunction('<?=$_POST['id_reg'];?>')"> <i class="icon-print"></i> <b>Print</b></button></div>
										</br>
										<form class="form-horizontal" action="<?php echo base_url();?>patient/save_mark_mcu" method="post" name="mark_mcu">
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
                                          <label class="control-label" for="focusedInput">Company Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" value="<?=$_POST['client_name'];?>"  id="myText03" maxlength="0" autocomplete="off" readonly>
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
											<div class="block" style="width: 56%; float: left;">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Marking Sheet For Medical Check Up</b></div>
												</div>
												<div class="block-content collapse in" style="overflow-x:scroll;overflow-y:scroll; height:auto; width:auto; overflow:hidden;">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>Contents</th>
																	<th>Result</th>
																	<th></th>
																	<th>Std. Value</th>
																</tr>
															</thead>
															<tbody>
															<?php
															$row_cnt = $find_left->num_rows();
															?>
															
															<script>
																function bmi() {
																	var weight = document.getElementById("Weight").value;
																	var height = document.getElementById("Height").value;
																	if(weight > 0 && height > 0){	
																	var finalBmi = weight/(height/100*height/100)
																	//alert('ok');
																	document.getElementById("BMI").value = parseFloat(finalBmi * 100 / 100).toFixed(1)
																	document.getElementById("StandardWeight").value = parseFloat((height/100) * (height/100) * 22).toFixed(1)
																	document.getElementById("ObeseIndex").value = parseFloat(((weight/(height*height*22/10000))-1)*100).toFixed(1)
																	}
																}	
															</script>
															
															<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
										
																<?php 
																$current_cat = null;
																$par		 = null;
																$current_cat2= null;
																$x			 = 1; $o			 = 1; $jv_2			= 1; $valu = ""; $xam = 1; $max 	= 1; $f2  = 1; 
																$y			 = 1; $b			 = 1; $jv_3			= 1; $par_b= 1;	 $axm = 1; $mina 	= 1; $f4  = 1; 
																$z			 = 1; $jv			 = 1; $jv_4			= 1; $par_c= 1;	 $min = 1; $maxb 	= 1; $rangess = 1;
																$v			 = 1; $jv_1			 = 1; $params		= "";			 $f3  = 1; $f1  	= 1; $f5  = 1;     
																foreach($find_left->result() as $row_isi){
																if($row_isi->nama_value=="BMI" || $row_isi->nama_value=="Standard Weight" || $row_isi->nama_value=="Obese Index"){
																	$params = "readonly";
																}else{
																	$params = "";
																}
																
																if($row_isi->nama_value=="Weight" || $row_isi->nama_value=="Height"){
																	$valu = " onchange='bmi()' ";
																}else{
																	$valu = "";
																}
																?>
																<script>
																function automa_<?=$axm++;?>(val)
																{
																	var mins = document.getElementById("minn_<?=$mina++;?>").value;
																	var maxs = document.getElementById("maxx_<?=$maxb++;?>").value;
																	for(var i = parseInt(mins); i <= parseInt(maxs); i++)
																	{
																	if(parseFloat(mins) != 0 || parseFloat(maxs) != 0){
																		if(parseFloat(val) < parseFloat(mins) || parseFloat(val) > parseFloat(maxs)){
																			 document.getElementById("demo<?=$f1++;?>").innerHTML = "<span class='label label-important'><i class='icon-exclamation-sign'></i></span><input type='hidden' name='mark[<?=$f4++;?>]' value='1'>";
																		}else{
																			 document.getElementById("demo<?=$f2++;?>").innerHTML = "<input type='hidden' name='mark[<?=$f5++;?>]' value='0'>";
																		}
																	}
																	}

																	var weight = document.getElementById("Weight").value;
																	var height = document.getElementById("Height").value;
																	if(weight > 0 && height > 0){	
																	var finalBmi = weight/(height/100*height/100)
																	//alert('ok');
																	document.getElementById("BMI").value = parseFloat(finalBmi * 100 / 100).toFixed(1)
																	document.getElementById("StandardWeight").value = parseFloat((height/100) * (height/100) * 22).toFixed(1)
																	document.getElementById("ObeseIndex").value = parseFloat(((weight/(height*height*22/10000))-1)*100).toFixed(1)
																	}
																
																}
																</script>
																<tr>
																<!--
																	<td><?php 
																	if($row_isi->serv_name != $current_cat){
																		$current_cat = $row_isi->serv_name;
																		$par = $jv_4++;
																		echo "<b>".$o++.". ".$current_cat."</b>";
																	}else{
																		echo "";
																	}
																	?></td>
																-->
																	<td width="255px;">[<b><?php
																	if ($row_isi->serv_name != $current_cat2){
																		$current_cat2 = $par;
																		echo $current_cat2;
																	}else{
																		echo "";
																	}
																	?>.
																	<?=$v++;?>]</b> <?=$row_isi->nama_value;?></td>
																	<td width="155px;">
																	<input type="text" onmouseover="automa_<?=$xam;?>(this.value)" onkeyup="automa_<?=$xam++;?>(this.value)" <?=$params;?> <?=$valu;?> style="width: 105px;" size="6" id="<?=str_replace(" ", "", $row_isi->nama_value);?>" name="result_<?=$x++;?>" value="<?=$row_isi->result;?>" autocomplete="off">
																	<input type="hidden" value="<?=$row_isi->limit_1;?>" id="minn_<?=$min++;?>">
																	<input type="hidden" value="<?=$row_isi->limit_2;?>" id="maxx_<?=$max++;?>">
																
																	</td>
																	<td width="40px;"><div id="demo<?=$f3++;?>"></div></td>
																	<td width="100px;"><?php if($row_isi->limit_1 != 0 || $row_isi->limit_2 != 0 ){ ?><?=$row_isi->limit_1;?> - <?=$row_isi->limit_2;?> <?php } ?> <input type="hidden" name="ranges_<?=$rangess++;?>" value="<?=$row_isi->limit_1;?> - <?=$row_isi->limit_2;?>"></td>
																
																	<input type="hidden" name="id_serv_<?=$y++;?>" value="<?=$row_isi->serpis;?>">
																	<input type="hidden" name="id_value_<?=$z++;?>" value="<?=$row_isi->id;?>">
																</tr>
																<?php
																}
																?>
																
																<?php 
																		$notee = "";
																foreach($all_note->result() as $row_note){
																		$notee = $row_note->result;
																} 
																?>
																<tr>
																	<td colspan="4" align="top"><b>Notes : </b><textarea name="result_<?=$row_cnt+1;?>" style="width:610px; height:70px;"><?=$notee;?></textarea></td>
																</tr>
															
															</tbody>
														</table>
													</div>
												</div>
											</div>
											
											<div class="block" style="width: 42%; float: right;">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>List Package Medical Check Up</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>No.</th>
																	<th>Group</th>
																	<th>Contents</th>
																	<th>Doctor</th>
																	<!--
																	<th>Patient</th>
																	<th>Checked By</th>
																	-->
																</tr>
															</thead>
															
															<tbody>
															<?php
															$i =1; $zz=1;
															$ii=1; $yy=1;
															$b =1;
															$k =1;
															$g =1;
															$aa=1;
															$bb=1;
															$cc=1;
															$pat_name=$_POST['pat_name'];
																$current_cats = null;
															foreach($find->result() as $row){
																$check = "";
																if($row->iscomplete==1){
																$check ="checked";
																}else{
																$check ="";	
																}

															$session_data 		= $this->session->userdata('logged_in');
															$nursepat			= $session_data['id'];
															$username			= $session_data['username'];
															$content 			= $row->serv_name;
															$fingerpat 			= $row->fingerid;
															$id_ms_d			= $row->id_ms_d;
															$url_verification	= base64_encode($base_path."verification2.php?content=$content&name=$pat_name&idms=$id_ms_d&upd=1&user_id=$fingerpat");
															$url_nurse			= base64_encode($base_path."verification2.php?content=$content&name=$username&idms=$id_ms_d&upd=0&user_id=$nursepat");
															?>
															<script>
																function updateArea<?=$aa++;?>(id){
																if(document.mark_mcu.dat<?=$cc++;?>.checked == true){
																	$.post("update_mark/<?=$row->id_ms_d;?>", $("#console").serialize());
																}else{
																	$.post("update_mark_2/<?=$row->id_ms_d;?>", $("#console").serialize());
																}
																
																}
																
																function update_doc<?=$zz++;?>(id){
																$.post("update_doc/<?=$row->id_ms_d;?>/"+id+"", $("#console").serialize());
																}
															</script>
																<tr>
																	<td><b><?=$ii++;?></b></td>
																	<td><b><?php 
																
																	if($row->group_desc != $current_cats){
																		$current_cats = $row->group_desc;
																		echo $current_cats;
																	}else{
																		echo "";
																	}
																	?></b></td>
																	<td><b><?php echo $row->nama_group;?></b> <?php echo $row->serv_name;?></td>
																	
																	<td>
																	<?php if($row->id_group_serv != 1 && $row->id_group_serv != 2){ ?>
																	<select name="id_dr" style="max-width:80%;" onchange="update_doc<?=$yy++;?>(this.value);">
																	<option value="0">- No Doctor -</option>
																	<?php 
																	foreach($get_doctor2->result() as $rows){
																	?>
																		<option <?php if($rows->id==$row->id_dr_fee){ echo "selected"; } ?> value="<?=$rows->id?>" align="justify"><?=$rows->fullname?></option>
																	<?php
																	}
																	?>
																	</select>
																	<?php } ?>
																	</td>
																	
																	<input type="hidden" name="id_sign<?=$g++;?>" value="<?=$row->sign;?>">
																	<input type="hidden" name="id_serv<?=$k++;?>" value="<?=$row->id_ms_d;?>">
																	<input type="hidden" name="id_service<?=$i++;?>" value="<?=$row->serpis;?>">
																	<!--
																	<td>
																		
																		<a href="finspot:FingerspotVer;<?=$url_verification;?>"><button type="button" id="button_login" onclick="finger()" class="btn btn-success"><i class="icon-user"></i></button></a>
																	</td>
																	
																	<td>
																		
																		<!--
																		<a href="finspot:FingerspotVer;<?=$url_nurse;?>"><button type="button" id="button_login" onclick="finger()" class="btn btn-info"><i class="icon-user"></i></button></a>
																		
																	</td>
																	-->
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
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" onclick="this.disabled=true;this.form.submit();" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
									</fieldset>     
                                </div>
                            </div>
							<div class="form-actions" >
							<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
							<!-- <button class="btn btn-danger" type="reset"><b>Reset</b></button> -->
							<div style="align:right; float:right;">
							<input style="width:25px; height:25px;" type="checkbox" id="optionsCheckbox" name="complete" value="1"> <b><font color="red">Last Checker</font></b>
							</div>
                            </div>
							</form>
                        </div>
                        <!-- /block -->
                    </div>
					</body>
		<!--/.fluid-container-->

        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>

</html>