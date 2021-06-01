				<?php
				$id = $this->uri->segment(3);
				if ($id=="del"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete Purchase Request
				</div>
				<?php
				}
				if ($id=="app"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Approve Purchase Request
				</div>
				<?php
				}
				?>
				<script>	  
				function goBack(){
					window.history.back();
				}			
				
				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/print_pr/"+id+"", "", "width=800px, height=400px");
				}
				
				function delete_order(group,id) {
					var myWindow = window.open("<?php echo base_url();?>master/add_notes/"+group+"/"+id+"", "", "width=1025, height=600, top=50, left=180");
				}
				
				function view_notes(group,id) {
					var myWindow = window.open("<?php echo base_url();?>master/view_notes/"+group+"/"+id+"", "", "width=1025, height=600, top=50, left=180");
				}


				function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/app_pr/"+id+"/all";
					} else {
					x = "You pressed Cancel!";
					}
				}
				
				function myFunction_decl(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/decl_pr/"+id+"/all";
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
                    <body onload="startTime()">
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Purchase Request Approval</b></div>
                            	<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<!--  <div class="form-actions">									 
							 <div class="btn-group">
							  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li><a href="<?php echo base_url();?>inv/list_pr"><i class="icon-th-large"></i> List Purchase Request</a></li>
								<li><a href="#"><i class="icon-th-large"></i> Report Purchase</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>inv/purchase_req" onclick="goBack()"><i class="icon-share-alt"></i> Back</a></li>
							  </ul>
							 </div>
							 </div> -->
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
                                                <th>PR Number</th>
                                                <th>Date</th>
												<th>Request By</th>
                                                <th>Department</th>
												<th>Items</th>
												<!-- <th style="text-align: center;"> ... </th> -->
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
                                                <td><?=$row->pr_no;?> </br> <?=$row->lvalue;?> </td>
												<td align="center"><?php echo date("d.m.Y",strtotime($row->pr_date));?></td>
												<td><?=$row->fullname;?></td>
                                                <td><?=$row->nama_dep;?></td>
												<td>
													<?=str_replace(";"," <br> ",$row->items);?>
													<!-- <button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->items);?>"><i class="icon-search"></i><b> <?=$row->qty;?> Items </b></button> -->
												</td>
												<!-- <td style="text-align: center;"><button class="btn btn-mini" onclick="myFunction_3(<?=$row->id_pr_no;?>)"> <i class="icon-print"></i> Print</button></td> -->
												<td style="text-align: center;">
													

													<button class="btn btn-mini" onclick="myFunction_3(<?=$row->id_pr_no;?>)"> <i class="icon-print"></i> </button>

													<?php if ($row->is_finalized == 1) { ?>
														<button onclick="myFunction(<?=$row->id_pr_no;?>)" class="btn btn-success btn-mini"><i class="icon-ok-sign"></i></button>
														<button onclick="delete_order(3,<?=$row->id_pr_no;?>)" class="btn btn-danger btn-mini"><i class="icon-remove-sign"></i></button>
														<!-- <button onclick="myFunction_decl(<?=$row->id_pr_no;?>)" class="btn btn-danger btn-mini"><i class="icon-remove-sign"></i></button> -->
													<?php }elseif ($row->is_finalized == 2 || $row->is_finalized == 5) { ?>
														<button class="btn btn-mini" onclick="view_notes(3,<?=$row->id_pr_no;?>)"> <i class="icon-comment"></i> </button>
													<?php } ?>
												</td>
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