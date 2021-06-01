				<?php
				$id = $this->uri->segment(3);
				if ($id=="del"){
				?>
			    <div class="alert alert-danger">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete Purchase Request
				</div>
				<?php
				}
				?>
				<script>	  
				function goBack(){
					window.history.back();
				}			
				
				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/print_mi/"+id+"", "", "width=800px, height=400px");
				}


				function myFunction_4(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/app_one/"+id+"", "", "width=800px, height=400px");
				}

				function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/app_mi/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				
				function myFunction_decl(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/decl_mi/"+id+"";
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
                                <div class="muted pull-left"><span class="badge badge-important">Transfer Item Request Approval</span></div>
                            </div>
							 <div class="form-actions">									 
							 <div class="btn-group">
							  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
							  <ul class="dropdown-menu">
								<li><a href="#"><i class="icon-th-large"></i> Report Transfer Item</a></li>
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
                                                <th>Transfer Number</th>
                                                <th>Date</th>
												<th>Request By</th>
                                                <th>Department</th>
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
                                            <td><?=$row->mi_no;?></td>
                                            <td><?=$row->mi_date;?></td>
											<td><?=$row->fullname;?></td>
                                            <td><?=$row->nama_dep;?></td>
											<td style="text-align: center;">
												<button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->items);?>"><i class="icon-folder-open"></i><b> <?=$row->qty;?> Items </b></button>
												<button title="Print" class="btn btn-mini" onclick="myFunction_3(<?=$row->id_mi_no;?>)"> <i class="icon-print"></i> Print</button>
											</td>
											<td style="text-align: center;">
												<button title="Approve" onclick="myFunction_4(<?=$row->id_mi_no;?>)" class="btn btn-primary btn-mini"><i class="icon-align-justify"></i></button>
												<button title="Approve All" onclick="myFunction(<?=$row->id_mi_no;?>)" class="btn btn-success btn-mini"><i class="icon-ok-sign"></i></button>
												<button title="Reject All" onclick="myFunction_decl(<?=$row->id_mi_no;?>)" class="btn btn-danger btn-mini"><i class="icon-remove-sign"></i></button>
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