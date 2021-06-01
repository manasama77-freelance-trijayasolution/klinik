				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
				<script>
				$(function() {
						$('.tooltip').tooltip();	
						$('.tooltip-left').tooltip({ placement: 'left' });	
						$('.tooltip-right').tooltip({ placement: 'right' });	
						$('.tooltip-top').tooltip({ placement: 'top' });	
						$('.tooltip-bottom').tooltip({ placement: 'bottom' });
			
						$('.popover-left').popover({placement: 'left', trigger: 'hover'});
						$('.popover-right').popover({placement: 'right', trigger: 'hover'});
						$('.popover-top').popover({placement: 'top', trigger: 'hover'});
						$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
				});
				</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
										<?php
											foreach($data->result() as $row){
										?>
                            <div class="muted pull-left"><b>Form Lab - <?=$row->order_date;?></b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend>Lab Result Confirmation</legend>
									<form class="form-horizontal" action="<?php echo base_url();?>lab/app_lab" method="post" name="quesioner_mcu">
				
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Order</label>
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
													<div class="muted pull-left"><b>Lab Form</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
													<div style="overflow-x: auto; height:auto;">
														<table class="table table-hover table-bordered" id="example3">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Group</th>
																	<th>Items</th>
																	<th>Std. Value</th>
																	<th><div align="center">Lab Results</div></th>
																	<th style="width: 85px; align: center;"><div align="center"><i class="icon-flag"></i><div></th>
																</tr>
															</thead>					
															<tbody>		
															<?php
															$current_cat=null;
															$i=1; 
															$h=1;
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
															//Function Convertion Age to Months
															$birthday 	= new DateTime('1992-02-21');
															$diff 		= $birthday->diff(new DateTime());
															$months 	= $diff->format('%m') + 12 * $diff->format('%y');
															$row_cnt 	= $detail->num_rows();
															?>
															<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
															<?php
																$isi_char="<b><div style='font-size: 12px;'>History</b></br>";
															foreach($detail->result() as $row){			
															?>
																<tr>
																	<td><?=$i++;?></td>
																	
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
																	<td><?php echo $row->lab_item_desc;?></td>
																	<td>
																	<?php
																	if($row->low_limit == 0 && $row->high_limit == 0){
																	echo $row->std_value;
																	}else{
																	echo $row->low_limit;?> - <?php echo $row->high_limit;
																	}
																	?>
																	</td>
																	<input type="hidden" name="name[<?=$f11++;?>]" value="<?=$row->lab_item_desc;?>">
																	<td nowrap><div align="center"><input autocomplete="off" type="text" name="result[<?=$h++;?>]" class="btn btn-warning popover-left" style="width: 68px;" data-html="true" onkeyup="range<?=$f1++;?>(this.id, this.value)" value="<?=$row->result_value;?>" readonly></div></td>
																	<td style="align: center; valign: middle;" width="75px">
																	<?php
																	if($row->is_normal==1){
																		echo "<span class='label label-important'><i class='icon-exclamation-sign'></i></span>";
																	} else{
																		echo "<span class='label label-success'><i class='icon-ok-circle'></i></span>";
																	}
																	?>
																	<div style="font-size: 0.001em; display: none;"><?=$row->group_name;?><?=$row->lab_item_desc;?></div></td>
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
										<font color='red'><i>*jika masih terdapat salah input data, silahkan <b>[Confirm]</b>, lalu lakukan revisi kembali</i></font>
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
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Confirm</b></a>
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