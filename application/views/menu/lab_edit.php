				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
						<script>
							function getComboA(sel, id) {
								var value = id;  
										document.getElementById("id_ins_div"+sel+"").style.display ='none';
										document.getElementById("id_ins_div2"+sel+"").innerHTML = "<input style='width: 95px;' type='text' name='std_value"+sel+"' value='"+id+"'>";
										document.getElementById("id_ins_div3"+sel+"").style.display ='none';
										document.getElementById("id_ins_div4"+sel+"").innerHTML = "<input style='width: 95px;' type='text' name='result["+sel+"]'>";
										document.getElementById("id_ins_div6"+sel+"").innerHTML = "<input type='checkbox' name='mark["+sel+"]' style='width:25px; height:25px;' value='1'> <font color='red'>Mark ?</font>";
										document.getElementById("id_ins_div5"+sel+"").style.display ='none';
								//alert(id);
									console.log(sel);
								$('#optionsCheckbox'+sel+'').click(function(){
									if (this.checked) {
										document.getElementById("id_ins_div"+sel+"").style.display ='none';
										document.getElementById("id_ins_div2"+sel+"").innerHTML = "<input style='width: 95px;' type='text' name='std_value"+sel+"' value='"+id+"'>";
										document.getElementById("id_ins_div3"+sel+"").style.display ='none';
										document.getElementById("id_ins_div4"+sel+"").innerHTML = "<input style='width: 95px;' type='text' name='result["+sel+"]'>";
										document.getElementById("id_ins_div6"+sel+"").innerHTML = "<input type='checkbox' name='mark["+sel+"]' style='width:25px; height:25px;' value='1'> <font color='red'>Mark ?</font>";
										document.getElementById("id_ins_div5"+sel+"").style.display ='none';
									}else{
										document.getElementById("id_ins_div"+sel+"").style.display ='';
										document.getElementById("id_ins_div3"+sel+"").style.display ='';
										document.getElementById("id_ins_div4"+sel+"").style.display ='';
										document.getElementById("id_ins_div5"+sel+"").style.display ='';
										document.getElementById("id_ins_div6"+sel+"").style.display ='';
										document.getElementById("id_ins_div2"+sel+"").innerHTML = "";
										document.getElementById("id_ins_div4"+sel+"").innerHTML = "";
										document.getElementById("id_ins_div6"+sel+"").innerHTML = "";
									}
								}) 
							}
						</script>
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
									<form class="form-horizontal" action="<?php echo base_url();?>lab/lab_update" method="post" name="quesioner_mcu">
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
															<tbody>		
															<?php
															$i=1; 
															$h=1;
															$a1=1;
															$a2=1; 
															$a3=1;
															$a4=1;
															
															$a5=1;
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
															
															$new1=1;
															$new2=1;
															$new3=1;
															$new4=1;
															$new5=1;
															$new6=1;
															$new7=1;
															$new8=1;
															$new9=1;
															$new10=1;
															$new11=1;
															$new12=1;
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
																//alert(val);
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
															}
	
															function xbow(){ 
																
																var jml = <?php echo $detail->num_rows();  ?>
																
																for(var bb = 1; bb <= jml; bb++){
																var id = document.getElementsByName("result["+bb+"]")[0].getAttribute("id");;
																var val = document.getElementsByName("result["+bb+"]")[0].value;;
    															
    															//alert(id);
																var spl 	= id.split("#"),
																	low 	= spl[0],
																	high 	= spl[1];
																	cases 	= spl[2];

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
																	document.getElementById("demo"+bb+"").innerHTML = "Range Belum Ada, Hubungi IT";
																	}
																	}												
																}
															}
															</script>
															<div>
																<tr onmouseover="xbow()">
																	<td><?=$i++;?></td>
																	<input name="id_lab_item[<?=$f8++;?>]" type="hidden" value="<?=$row->id_lab_item;?>:<?=$row->lab_item_group;?>:<?=$row->lab_item_unit;?>:<?=$row->low_limit;?> - <?php echo $row->high_limit;?>:<?=$row->lab_item_seq_no;?>">
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
																	<td><?php if($row->type_lab == "1"){ echo $row->lab_item_abbr." - <b>".$row->name_type."</b>"; }else{ echo $row->lab_item_abbr; } ?><hr><input style="width:18px; height:18px;" onclick="getComboA(<?=$new2++;?>, '<?php echo $row->low_limit;?> - <?php echo $row->high_limit;?>')" type="checkbox" id="optionsCheckbox<?=$new7++;?>" name="complete" value="1"> <i><b>External Result</b></i></td>
																	<td>
																	<div align="center" id="id_ins_div<?=$new4++;?>">
																	<?php
																	if($row->low_limit == 0 && $row->high_limit == 0){
																	echo $row->std_value;
																	}else{
																	echo $row->low_limit;?> - <?php echo $row->high_limit;
																	}
																	?>
																	</div>
																	<div align="center" id="id_ins_div2<?=$new8++;?>">
																	</div>
																	</td>
																	<input type="hidden" name="min_range[<?=$f9++;?>]" value="<?=$row->min_limit;?>">
																	<input type="hidden" name="max_range[<?=$f10++;?>]" value="<?=$row->max_limit;?>">
																	<input type="hidden" name="name[<?=$f11++;?>]" value="<?=$row->lab_item_abbr;?>">
																	<td nowrap>																	
																	<div align="center" id="id_ins_div3<?=$new9++;?>">
																	<div align="center">
																	<input autocomplete="off" type="text" name="result[<?=$h++;?>]" id="<?=$row->low_limit.'#'.$row->high_limit.'#'.$row->lab_item_case?>" style="width: 78px; text-transform: capitalize;" onkeyup="range<?=$f1++;?>(this.id, this.value)" value="<?=$row->result_value;?>" >
																	</div>
																	</div>
																	<div align="center" id="id_ins_div4<?=$new10++;?>">
																	</div>
																	</div>
																	</td>
																	<td valign="center" width="25">
																	<div align="center">
																	<div align="center" id="id_ins_div5<?=$new11++;?>">
																	<div id="demo<?=$f3++;?>"></div>
																	</div>
																	<div align="center" id="id_ins_div6<?=$new12++;?>">
																	</div>
																	<div style="font-size: 0.0001em; display: none;"><?=$row->group_name;?><?=$row->lab_item_abbr;?></div>
																	</div>
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
										<div style="align:left; float:left;">
										<font color="red">*Jika std. value kosong, <b>Wajib</b> input data range terlebih dahulu. silahkan klik <a href='<?php echo base_url();?>Lab/mst_lab_range' target='_blank' onclick="window.close()">disini</a></font></br>
										<font color="red">*<b>External Result</b> adalah khusus untuk pemeriksaan di luar lab. Kyoai.</font>
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
												<input type="submit" class="btn btn-success" value="Save">
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