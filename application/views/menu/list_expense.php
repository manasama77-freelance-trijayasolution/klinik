				<?php
				$id = $this->uri->segment(3);
				// untuk alert archived
				if ($id=="del") {
				?>
				<div class="alert alert-danger">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> Delete Manufaktur
				</div>
				<?php
					}
				?>		
				<script>
				function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>Pharmacy/delete_manufaktur/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}

				function goBack(){
					window.history.back();
				}
				
				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/list_detail_expense/"+id+"", "", "width=1000px, height=600px");
				}
				
				function myFunction_4(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/check_received/"+id+"", "", "width=1200px, height=400px, top=70, left=80");
				}
				
				function myFunction_5(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/update_received/"+id+"", "", "width=1200px, height=400px, top=70, left=80");
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
                                <div class="muted pull-left"> List Expense </div>
                            </div>
							 <div class="form-actions">									 
							 <div class="btn-group">
							  <a href="<?php echo base_url();?>inv/mst_expense"><button class="btn btn-success"><i class="icon-plus icon-white"></i> Add New</button></a>
							 </div>
							 </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <!-- 
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/export_excel_listpr"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div> 
									  </br>
									  </br>
                                      -->
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
								   
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Date</th>
												<th>Supplier Name</th>
                                                <th>Total</th>
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
                                                <td><?=$row->po_date;?></td>
												<td><?=$row->supplier_id;?></td>
												<td><div align="right"><?php echo number_format($row->total_amount,2);?></div></td>	
												<td style="text-align: center;">
												<button class="btn btn-info btn-mini" title="Detail Expense" onclick="myFunction_3('<?php echo $row->id_po;?>');"><i class="icon-folder-open"></i></button> 
												<!-- <button class="btn btn-warning btn-mini" title="Update Expense" onclick="myFunction_2('<?php echo $row->id_po;?>');"><i class="icon-edit"></i></button>  -->
												<button class="btn btn-danger btn-mini" title="Delete Expense" onclick="myFunction('<?php echo $row->id_po;?>');"><i class="icon-trash"></i></button></td>	
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