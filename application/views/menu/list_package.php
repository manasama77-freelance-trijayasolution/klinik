				<?php
				$id = $this->uri->segment(3);
				$session_data 			= $this->session->userdata('logged_in');
				$userlvl				= $session_data['userlevel'];
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
				
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/list_detail_package/"+id+"", "", "width=1000px, height=400px");
				}

				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/update_service_package/"+id+"", "","width=1200px, height=500px, top=70, left=70");
				}

				function myFunction_2x(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/update_mst_service_package/"+id+"", "","width=1200px, height=500px, top=70, left=70");
				}

				function add_new() {
					document.location = "<?php echo base_url();?>marketing/mst_service_package";
				}


				function myFunction_3(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>marketing/delete_package/"+id+"";
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
                                <div class="muted pull-left"><b>List Master Package</b></div>
                            </div>

							<div class="form-actions">
								<button onclick="add_new()" class="btn btn-success btn-large"><b>Add New</b></button>
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
									<ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>marketing/quotation"><i class="icon-plus"></i> Add Quotation</a></li>
									<li><a href="<?php echo base_url();?>marketing/list_quotation"><i class="icon-th-large"></i> My Quotation</a></li>
									<?php if ($userlvl != "user"){?>
									<li><a href="<?php echo base_url();?>marketing/list_quotation_app"><i class="icon-th-large"></i> My Quotation Staff</a></li>
									<?php }?>
									</ul>
								</div>
							</div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <!-- <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/export_excel_listpr"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div> -->
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
								   
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>Company Name</th>
												<th>Package Name</th>
												<th>Qty</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($list->result() as $row){
										?>
                                           <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->client_name;?></td>
												<td><?php echo $row->package_name;?></td>
												<td><?php echo $row->qty;?></td>
												<td>
												<div align="center">
												<button class="btn btn-info btn-mini" title="Detail Package" onclick="myFunction('<?php echo $row->id_package;?>');"><i class="icon-folder-open"></i></button> 
												<button class="btn btn-warning btn-mini" title="Update Package" onclick="myFunction_2('<?php echo $row->id_package;?>');"><i class="icon-edit"></i></button> 
												<button class="btn btn-danger btn-mini" title="Delete Package" onclick="myFunction_3('<?php echo $row->id_package;?>');"><i class="icon-trash"></i></button></div></td>	
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