				<?php
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete Purchase Request
				</div>
				<?php
				}
				?>
				<script>
				function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/del_po/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				</script>
				<script>	  
				function goBack(){
					window.history.back();
				}
				
				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/print_received/"+id+"", "", "width=800px, height=400px");
				}
				
				function myFunction_4(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/update_return/"+id+"", "", "width=1200px, height=400px, top=70, left=80");
				}
				
				function myFunction_5(id) {
					window.open("<?php echo base_url();?>inv/add_return/"+id+"", "", "width=1200px, height=600px, top=70, left=80");
				}

				function myFunction_archive(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/update_arc_rt/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				
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
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Return Items</div>
                            </div>
							 <div class="form-actions">									 
							 <div class="btn-group">
							  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
							  <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>inv/received_items/"><i class="icon-th-large"></i> Received Items</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>inv/purchase_req" onclick="goBack()"><i class="icon-share-alt"></i> Back</a></li>
							  </ul>
							 </div>
							 </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/export_excel_listpr"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
								   
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
												<th>No</th>
                                                <th>PO Number</th>
												<th>Supplier</th>
                                                <th>Date</th>
												<th style="text-align: center;">Received</th>
												<th style="text-align: center;">Return</th>
												<th style="text-align: center;">Items</th>
												<th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($list->result() as $row){
										?>
                                            <tr class="odd gradeX">
												<td><?=$i++;?></td>
                                                <td><?=$row->po_no;?></td>
												<td><?=$row->supplier;?></td>
                                                <td><?=$row->po_date;?></td>
                                                <td style="text-align: center;"><?=$row->stsvalue;?></td>
												<td style="text-align: center;">
												<?php
												// echo $row->sts_rt;
												if ($row->sts_rt == 0) {
													echo "<div class='progress progress-striped active' width='50%'><div style='width: 40%;' class='bar'><font color='black'><b>Waiting</b></font></div></div>";
												} else {
													echo $row->ststrvalue;
												}
												?>
												</td>								
												<td style="text-align: center;"><button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->items);?>"><i class="icon-search"></i><b> <?=$row->qty;?> Items </b></button></td>
												<td style="text-align: center;">
												<?php 
													// echo $row->sts_rt;
													if ($row->status == 3 && $row->sts_rt == 0){												
														echo '<button title="Checklist Received Items" onclick="myFunction_5('.$row->id_po.')" class="btn btn-info btn-mini"><i class="icon-repeat"></i></button>';					
													}elseif ($row->status == 3 && $row->sts_rt == 1){											
														echo '<button title="Checklist Received Items" onclick="myFunction_4('.$row->id_po.')" class="btn btn-info btn-mini"><i class="icon-repeat"></i></button>';			
													}elseif ($row->status == 3 && $row->sts_rt == 3){											
														echo '<button title="Checklist Received Items" onclick="myFunction_4('.$row->id_po.')" class="btn btn-info btn-mini"><i class="icon-repeat"></i></button>';	
													}else{
														echo '<button title="Checklist Received Items" class="btn btn-info btn-mini" disabled><i class="icon-repeat" ></i></button>';			
													}
												?>
												<button title="Print Return Items" class="btn btn-mini" onclick="myFunction_3(<?=$row->id_po;?>)"><i class="icon-print"></i></button>
												<button onclick="myFunction(<?=$row->id_po;?>);" <?php if ($row->is_completed != 1){ ?> disabled <?php } ?> class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
												<div style="font-size: 0.0001em; display: none;"><?=str_replace(";",",",$row->items);?></div></td>
                                            </tr>
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

				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>