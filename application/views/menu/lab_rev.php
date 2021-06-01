<script type="text/javascript">
	// AGAR TIDAK SUBMIT SAAT DI ENTER
						$(document).ready(function() {
						  $(window).keydown(function(event){
						    if(event.keyCode == 13) {
						      event.preventDefault();
						      return false;
						    }
						  });
						});
</script>

				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid" onmouseover="xbow();">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
										<?php
											foreach($data->result() as $row){
										?>
                            <div class="muted pull-left"><b>Lab Process - <?php echo date("Y/m/d H:i:s",strtotime($row->order_date));?></b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<form class="form-horizontal" action="<?php echo base_url();?>lab/lab_rev_update" method="post" name="quesioner_mcu">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Order ID</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_order" type="text" id="myText01" readonly autocomplete="off" value="<?=$row->id_order;?>">
											<input name="pat_id" type="hidden" id=""  autocomplete="off" value="<?=$row->pat_MRN;?>" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
                                          </div>
                                        </div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_reg" type="text" id="myText01" readonly autocomplete="off" value="<?=$row->id_reg;?>">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" value="<?=$row->pat_name;?>, <?=$row->title_desc;?>">
                                          </div>
                                        </div>
									
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_address" type="text" id="myText05" readonly autocomplete="off" value="<?=findage_detail($row->pat_dob);?>">
                                          </div>
                                        </div>
										
										<?php
											}
										?>
										<div class="row-fluid">
											<!-- block -->
											<div class="block">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Lab Result</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
													<div id="" style="overflow-y: auto; height:auto;">
														<table class="table table-hover table-bordered" id="example3">
															<thead>
																<tr>																	
																	<th>No</th>
																	<th>Groupas</th>
																	<th>Items</th>
																	<th>Std. Value</th>
																	<th><div align="center">Result Lab</div></th>
																	<th style="width: 85px; align: center;"><div align="center"><i class="icon-flag"></i><div></th>
																</tr>
															</thead>
															<input type="hidden" name="HB" id="HB">
															<input type="hidden" name="HT" id="HT">
															<input type="hidden" name="RBC" id="RBC">							
															<tbody>		
															<?php
															$old_result=1;
															$old_normal=1;
															
															$i=1; 
															$h=1;
															$a1=1;
															$a2=1; 
															$a3=1;
															$a4=1;
															
															$a5=1; $f110=1;
															$a6=1; 
															$a7=1;
															$a8=1;
															$a9=1;
															$a10=1;
															$a11=1;
															
															$a2=1; 																	
															$f0=1;
															$f1=1;
															$f2=1;
															$f3=1;
															$f4=1;
															$f5=1;
															$f6=1;
															$f7=1;
															$f8=1;
															$f9=1;
															$f10=1;
															$f11=1;
															$f12=1;
															$f13=1;
															$f14=1;
															$xx=1;
															$yy=1;
															
															$char=1;
															$char2=1;
															$char3=1;
															$char4=1;
															
															$sub1=1;
															$sub2=1;
															$sub3=1;
															$sub4=1;
															$sub5=1;
															
															$sub6=1;
															$sub7=1;
															$sub8=1;
															$sub9=1;
															$sub10=1;
															$sub11=1;
															$sub12=1;
															$sub13=1;
															$sub14=1;
															$sub15=1;
															
															$current_cat=null;
															//Function Convertion Age to Months
															$birthday = new DateTime('1992-02-21');
															$diff = $birthday->diff(new DateTime());
															$months = $diff->format('%m') + 12 * $diff->format('%y');
															//echo $months;
															//End of Function
															
															$row_cnt 	= $detail->num_rows();
															$row_cyin 	= $comment->num_rows();
															?>
															<input type="text" style="display: none;" name="rowC" value="<?=$row_cnt;?>">
															<input type="text" style="display: none;" name="rowCyin" value="<?=$row_cyin;?>">
															<?php
															foreach($comment->result() as $row_1){
															?>
															<input type="text" style="display: none;" name="id_lab[<?=$xx++;?>]" value="<?php echo $row_1->id_lab_item_group;?>">
															<input type="text" style="display: none;" name="group_seq[<?=$yy++;?>]" value="<?php echo $row_1->group_seq_no;?>">
															<?php
															}
															$stat	="";
															foreach($detail->result() as $row){
															//echo $stat;
															?>
															
															<script>
															function range<?=$f0++;?>(id, val)
															{
																//alert(id);
																var spl 	= id.split("#"),
																	low 	= spl[0],
																	high 	= spl[1];
																	cases 	= spl[2];
																	nama 	= spl[3];
																//alert(val);


																if (nama == "HT"){document.getElementById("HT").value = val}
																if (nama == "HB"){document.getElementById("HB").value = val}
																if (nama == "RBC"){document.getElementById("RBC").value = val}

																for(var i = low; i <= high; i++)
																{
																if(parseFloat(cases) == "0" ){
																	if(parseFloat(val) < parseFloat(low) || parseFloat(val) > parseFloat(high)){
																		 document.getElementById("demo<?=$f2++;?>").innerHTML = "<span class='label label-important'><i class='icon-exclamation-sign'></i></span><input type='hidden' name='mark[<?=$f6++;?>]' value='1'>";
																	}else if(parseFloat(val) > parseFloat(low) || parseFloat(val) < parseFloat(high)){
																		 document.getElementById("demo<?=$f4++;?>").innerHTML = "<span class='label label-success'><i class='icon-ok-circle'></i></span><input type='hidden' name='mark[<?=$f7++;?>]' value='0'>";
																	}else{
																		 document.getElementById("demo<?=$f5++;?>").innerHTML = "";
																	}
																}else{
																	if(parseFloat(cases) == "1"){
																	document.getElementById("demo<?=$a1++;?>").innerHTML = "<input type='checkbox' name='mark[<?=$a2++;?>]' style='width:25px; height:25px;' <?php if($row->is_normal==1){ echo "checked";};?> value='1'> <font color='red'>Mark ?</font>";
																	}else if(parseFloat(cases) == "2"){
																		if (parseFloat(val) >= parseFloat(high)){
																			document.getElementById("demo<?=$sub1++;?>").innerHTML = "<span class='label label-info'><i class='icon-plus'></i></span><input type='hidden' name='mark[<?=$sub2++;?>]' value='1'>";	
																		}else if(parseFloat(val) <= parseFloat(high)){
																			document.getElementById("demo<?=$sub3++;?>").innerHTML = "<span class='label label-info'><i class='icon-minus'></i></span><input type='hidden' name='mark[<?=$sub4++;?>]' value='0'>";
																		}else{
																			document.getElementById("demo<?=$sub5++;?>").innerHTML = "";
																		}
																	}else{
																	document.getElementById("demo<?=$a11++;?>").innerHTML = "Range Belum Ada, Hubungi IT";
																	}
																	}
																}

																var ht 		= document.getElementById("HT").value;
																var hb 		= document.getElementById("HB").value;
																var rbc 	= document.getElementById("RBC").value;
																document.getElementById("MCV").value 	= Math.round(ht * 10 / rbc * 100);
																document.getElementById("MCH").value 	= Math.round(hb * 10 / rbc * 100);
																document.getElementById("MCHC").value	= Math.round(hb / ht * 100);

															}
	
															function xbow(){ 
																
																var jml = <?php echo $detail->num_rows();  ?>
																
																for(var bb = 1; bb <= jml; bb++){
																var id = document.getElementsByName("result["+bb+"]")[0].getAttribute("class");;
																var val = document.getElementsByName("result["+bb+"]")[0].value;;
    															
    															//alert(id);
																var spl 	= id.split("#"),
																	low 	= spl[0],
																	high 	= spl[1];
																	cases 	= spl[2];
																	nama 	= spl[3];
																//alert(val);


																if (nama == "HT"){document.getElementById("HT").value = val}
																if (nama == "HB"){document.getElementById("HB").value = val}
																if (nama == "RBC"){document.getElementById("RBC").value = val}
																//alert(val);
																console.log(high);
																if(parseFloat(cases) == "0" ){
																
																	if(parseFloat(val) < parseFloat(low) || parseFloat(val) > parseFloat(high)){
																		 document.getElementById("demo"+bb+"").innerHTML = "<span class='label label-important'><i class='icon-exclamation-sign'></i></span><input type='hidden' name='mark["+bb+"]' value='1'>";
																		 
																	}else if(parseFloat(val) > parseFloat(low) || parseFloat(val) < parseFloat(high)){
																		 document.getElementById("demo"+bb+"").innerHTML = "<span class='label label-success'><i class='icon-ok-circle'></i></span><input type='hidden' name='mark["+bb+"]' value='0'>";
																		 
																	}else{
																		 document.getElementById("demo"+bb+"").innerHTML = "";
																		 
																	}
																	
																}else{
																
																	if(parseFloat(cases) == "1"){
																	
																	document.getElementById("demo"+bb+"").innerHTML = "<input type='checkbox' name='mark["+bb+"]' style='width:25px; height:25px;' <?php if($row->is_normal==1){ echo "checked";};?> value='1'> <font color='red'>Mark ?</font>";
																	}else if(parseFloat(cases) == "2"){
																		if (parseFloat(val) >= parseFloat(high)){
																			document.getElementById("demo"+bb+"").innerHTML = "<span class='label label-info'><i class='icon-plus'></i></span><input type='hidden' name='mark["+bb+"]' value='1'>";	
																		}else if(parseFloat(val) <= parseFloat(high)){
																			document.getElementById("demo"+bb+"").innerHTML = "<span class='label label-info'><i class='icon-minus'></i></span><input type='hidden' name='mark["+bb+"]' value='0'>";
																		}else{
																			document.getElementById("demo"+bb+"").innerHTML = "";
																		}
																	}else{
																	document.getElementById("demo"+bb+"").innerHTML = "item lab tersebut, belum melengkapi data range atau tipe item.";
																	}
																	}												
																}
															}
															</script>
															<div>
																<tr onmouseover="xbow()">
																	<td><?=$i++;?></td>
																	<input name="id_lab_item[<?=$f8++;?>]" type="hidden" value="<?=$row->id_lab_item;?>:<?=$row->lab_item_group;?>:<?=$row->lab_item_unit;?>:<?=$row->low_limit;?> - <?php echo $row->high_limit;?>:<?=$row->lab_item_seq_no;?>:<?=$row->id_lab_range;?>">
																	<?php
																	if ($row->group_name != $current_cat){
																	$current_cat = $row->group_name;
																	echo "<td><b><u>". $row->group_name . "</u></b>";
																	}else{
																	?>	
																	<td></td>
																	<?php
																	}
																	?>
																	<td><?php echo $row->lab_item_desc." <b>".$row->name_type."</b>";?></td>
																	<td>
																	<?php
																	if($row->low_limit == 0 && $row->high_limit == 0){
																	echo $row->std_value;
																	}else{
																	echo $row->low_limit;?> - <?php echo $row->high_limit;
																	}
																	?>
																	</td>
																	<input type="hidden" name="min_range[<?=$f9++;?>]" value="<?=$row->min_limit;?>">
																	<input type="hidden" name="max_range[<?=$f10++;?>]" value="<?=$row->max_limit;?>">
																	<input type="hidden" name="name[<?=$f11++;?>]" value="<?=$row->lab_item_desc;?>">
																	<input type="hidden" name="range[<?=$f110++;?>]" value="<?=$row->id_lab_range;?>">
																	<td nowrap><div align="center">
																	<?php if ($row->name_type == "MCV" || $row->name_type == "MCH" || $row->name_type == "MCHC") {?>
																	<input autocomplete="off" type="text" name="result[<?=$h++;?>]" id="<?=$row->name_type?>" class="<?=$row->low_limit.'#'.$row->high_limit.'#'.$row->lab_item_case.'#'.$row->name_type?>" style="width: 68px;" onkeyup="range<?=$f13++;?>(this.id, this.value)" value="<?=$row->result_value;?>" disabled>
																	<?php }else{ ?>
																	<input autocomplete="off" type="text" name="result[<?=$h++;?>]" id="<?=$row->low_limit.'#'.$row->high_limit.'#'.$row->lab_item_case.'#'.$row->name_type?>" class="<?=$row->low_limit.'#'.$row->high_limit.'#'.$row->lab_item_case.'#'.$row->name_type?>" style="width: 68px;" onkeyup="range<?=$f13++;?>(this.id, this.value)"  value="<?=$row->result_value;?>">
																	<?php } ?>
																	</div></td>
																	<td valign="center" width="25">
																	<div id="demo<?=$f3++;?>"></div>
																	<?php
																	if ($row->is_normal != ""){
																	echo "";
																	}
																	?>
																	<div style="font-size: 0.0001em; display: none;"><?=$row->group_name;?><?=$row->lab_item_desc;?></div>
																	<input type="text" style="display: none;" name="result_old[<?=$old_result++;?>]" value="<?=$row->result_value;?>">
																	<input type="text" style="display: none;" name="normal_old[<?=$old_normal++;?>]" value="<?=$row->is_normal;?>">
																	</td>
																</tr>	
															</div>
															<?php
															}
															?>
															</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<!-- /block -->
										</div>				
										<div style="align:right; float:right;">
												<input style="width:25px; height:20px;" type="checkbox" onclick="xbow()" id="optionsCheckbox" name="complete" value="1"> <b><font color="red">Completed</font></b>
										</div>
										</br>
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
										
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
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