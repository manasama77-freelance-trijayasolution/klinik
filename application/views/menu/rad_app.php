				<?php
				$id = $this->uri->segment(3);
				$order = $this->uri->segment(4);
				?>
				<script>
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_act/"+id+"", "", "width=1000, height=700");
				}
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_view/"+id+"", "", "width=1000, height=700"); 
				}
				</script>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
                        <!-- block -->
                        <div class="block">

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id="" style="overflow-y: auto; height:auto;">
									<center>
                                    <table  cellpadding="0" cellspacing="0" border="0">
								    <thead>
									<tr>
										<td valign="top" colspan="6"><center>						
										<img src="<?php echo base_url();?>design/images/logokyoai.png"height="85" width="175">
										</center></td>
									</tr>

									<tr>
										<td colspan="6"><br><center><h3>PEMERIKSAAN RADIOLOGI </center></h3></td>                
									</tr>
										<?php
										foreach($header->result() as $row_header){
										?>
												<tr class="odd gradeX">
													<td>ID&nbsp;Reg</td>
													<td width="10%">&nbsp;:&nbsp;<?php echo $row_header->id_reg ?></td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td>Company</td>												
													<td width="40%" valign="top">&nbsp;:&nbsp;<?php echo $row_header->client_name ?></td>
												</tr>
												<tr class="odd gradeX">
													<td>Name</td>
													<td width="40%">&nbsp;:&nbsp;<?php echo $row_header->pat_name ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>												
												</tr>
												<tr class="odd gradeX">
													<td>Age</td>
													<td>&nbsp;:&nbsp;<?=findage_detail($row_header->pat_dob);?></td>				
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr class="odd gradeX">
													<td>Pat&nbsp;MRN</td>
													<td>&nbsp;:&nbsp;<?php echo $row_header->pat_mrn ?></td>				
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										<?php
										}
										?>										
								   </table>
								 
                                   <table border="0" cellpadding='2' class="table table-striped table-bordered" id="example2">
										<tbody>
										<?php
										$current_cat = null;
										?>
										<?php
										foreach($detail->result() as $row){
										?>
                                            <tr>
												<?php
												if ($row->group_desc != $current_cat){
												$current_cat = $row->group_desc;
												echo "<td width='20%' align='right' style='vertical-align:top'><b><u>". $current_cat . "</u></b><td>";
												}else{
												echo "<td width='20%' align='left'><td>";	
												}
												?>	
                                                <td width="30%"><?php echo $row->rad_item;?></td>
												<td width="70%"><?php echo $row->result;?></td>	
												<!-- /btn-group -->
												<?php } ?>
                                            </tr>
                                        </tbody>
                                   </table>
                                   </br></br></br>
                                   <a href="<?php echo base_url();?>radiology/radiology_app/<?=$order;?>" data-toggle="modal" class="btn btn-success"><b>Confirm</b></a>
								   </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->