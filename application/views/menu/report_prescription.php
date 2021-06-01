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
				function del_data(id) {
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
				
				function get_detail(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/list_detail_request_items/"+id+"");
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
                                <div class="muted pull-left"><b>List Input FO</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>patient/fo_report_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   	</div> 
								   <div id="" style="overflow-y: auto; height:auto;">
								   
                                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
									<thead>
										<tr>
											<th>No.</th>
											<th>ID Registration</th>
											<th>Patient Name</th>
											<th>Date Registration</th>
											<th>Company Name</th>
											<th>Type</th>
											<th>User</th>
											<th>Create Date</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$i=1;
									foreach($trx_registration->result() as $row){
									?>
										<tr class="odd gradeX">
											<td><?php echo $i++;?></td>
											<td><?php echo $row->id_reg;?><div style="float:right;"></td>
											<td><?php echo $row->pat_name;?> <div style="float:right;"></td>
											<td><?php echo date("d.m.Y",strtotime($row->reg_date));?></td>
											<td><?php echo $row->client_name;?></td>
											<td><?php if($row->id_service==0){
												echo "MCU";
												}else{
												echo "Outpatient";
												}
												?>
											</td>
											<td><?php echo strtoupper($row->fullname);?></td>
											<td><?php echo $row->create_date;?></td>
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