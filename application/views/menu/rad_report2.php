				<html>
				<head>
				</head>
				<body style="margin-left: 60px;" width="2480" height="3508">
				<?php
				$id = $this->uri->segment(3);
				//echo $id;
				?>
					
				<script>
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_act/"+id+"", "", "width=1000, height=700");
				}
				
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_view/"+id+"", "", "width=1000, height=700"); 
				}
				</script>
                        <!-- block -->
                        <div class="block">

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id="" style="overflow-y: auto; height:auto;">
									<center>
                                   <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
								    <thead>
									<tr>
										<td valign="top" colspan="6"><center>						
										<img src="<?php echo base_url();?>design/images/logokyoai.png"height="85" width="175">
										</center></td>
										<td valign="top" colspan="6"><center>						
										
										</center></td>
									</tr>

									<tr>
										<td colspan="6"><br><center><h3>PEMERIKSAAN RADIOLOGI </center></h3></td>                
									</tr>
									<tr>
										<td colspan="6"><center><h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </center></h3></td>                
									</tr>
									
									 </thead>
                                     <tbody>
										<?php
										foreach($detail->result() as $row){
										
                                            
                                                $id_reg = $row->id_reg;
                                                $pat_name = $row->pat_name;
                                                $group_desc = $row->group_desc;
                                                $rad_item = $row->rad_item;
                                                $order_date = $row->order_date;
                                                $result = $row->results;
                                                $id_order = $row->id_order;
                                                $id_client_job = $row->id_client_job;
                                                $client_name = $row->client_name;
                                                $pat_MRN = $row->pat_MRN;

												 } ?>
												<tr class="odd gradeX">
													<td>ID&nbsp;Reg</td>
													<td width="10%">&nbsp;:&nbsp;<?php echo  $id_reg; ?></td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td> Order ID</td>												
													<td>&nbsp;:&nbsp;<?php echo  $id_order; ?></td>
												</tr>
												<tr class="odd gradeX">
													<td>Name</td>
													<td width="40%">&nbsp;:&nbsp;<?php echo  $pat_name; ?></td>
													<td></td>
													<td></td>
													<td > Company </td>
													<td width="40%" valign="top" rowspan="2">&nbsp;:&nbsp;<?php echo $client_name; ?></td>												
												</tr>
												<tr class="odd gradeX">
													<td>Umur</td>
													<td>&nbsp;:&nbsp;Umur</td>				
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
												<tr class="odd gradeX">
													<td>Pat&nbsp;MRN</td>
													<td>&nbsp;:&nbsp;<?php echo $pat_MRN; ?></td>				
													<td></td>
													<td></td>
													<td>Client&nbsp;Job</td>
													<td>&nbsp;:&nbsp;<?php echo $id_client_job; ?></td>
												</tr>
												
									<tr>
										<td colspan="6"><center><h3><br>  </center></h3></td>                
									</tr>

                                        </tbody>
								   </table>
								 
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
												<td><b>Yth Teman Sejawat,</b></td>
                                            </tr>
                                            <tr>
												<th> </th>
												<th> </th>
                                            </tr>
                                        </thead>
										<tbody>

										<?php
										$current_cat = null;
										?>
										<?php
										foreach($detail->result() as $row){
										?>
                                            <tr class="odd gradeX">
																<?php
																if ($row->group_desc != $current_cat){
																$current_cat = $row->group_desc;
																echo "<td><b><br><u>". $row->group_desc . "</u></b>";
																}else{
																?>	
                                                <td width="30%"><?php echo $row->rad_item;?></td>
                                                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
												<td width="70%"><?php echo $result;?></td>
												<td></td>
																<?php
																}
																?>

												
												<!-- /btn-group -->
												<?php } ?>

                                            </tr>
                                        </tbody>
                                   </table>
								   </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->

				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>