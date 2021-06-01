				<?php
				$session_data 			= $this->session->userdata('logged_in');
				$userlvl				= $session_data['userlevel'];
				$id 					= $this->uri->segment(3);
				if ($id=="del") {
				?>
				<div class="alert alert-danger">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Success !</strong> Delete Prescription
				</div>
				<?php
					}
				if ($id=="ok") {
				?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Success !</strong> Already Dispenses.
				</div>
				<?php
				}
				if ($id=="arc") {
				?>
				<div class="alert alert-info">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Info !</strong> Archive Prescription.
				</div>
				<?php
				}
				if ($id=="stop") {
				?>
				<div class="alert alert-info">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Info !</strong> The recorded time of the manufacture of drugs.
				</div>
				<?php
				}
				?>				
				<script type="text/javascript" >
				var reloading;
				
				function checkReloading() {
					if (window.location.hash=="#autoreload") {
						reloading=setTimeout("window.location.reload();", 5000);
						document.getElementById("reloadCBR").click=true;
					}
				}
				
				function toggleAutoRefresh(cb) {
					if (cb.click) {
						window.location.replace("#autoreload");
						reloading=setTimeout("window.location.reload();", 5000);
					}
				}
				
				function toggleAutoRefresh_stop(cbr) {
					if (cbr.click) {
						window.location.replace("#");
						clearTimeout(reloading);
					}
				}
				
				window.onload=checkReloading;
				</script>
				<script>
				function myFunction(id) {
					var r = confirm("Are you sure to remove this drug ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>Pharmacy/delete_prescription/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}

				function b_stop(id) {
					var r = confirm("Are you sure you've finished making the drug ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>Pharmacy/stop_pharmacy/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}

				function goBack(){
					window.history.back();
				}
				
				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>Pharmacy/returnt_items_detail/"+id+"", "", "width=1200px, height=600px, top=30, left=70");
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
                                <div class="muted pull-left"><b>Returnt Items</b></div>
								<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
									  <div class="btn-group pull-left">
										<button class="btn btn-mini btn-mini" onclick="toggleAutoRefresh(this);" id="reloadCB"><i class="icon-refresh"></i> <b>Auto</b></button>
										<button class="btn btn-mini btn-mini" onclick="toggleAutoRefresh_stop(this);" id="reloadCBR"><i class="icon-stop"></i> <b>Stop</b></button>
                                      </div>
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
												<th>ID Registration - Order</th>
												<th>Order Date</th>
                                                <th>Patient Name</th>
												<th>Status</th>
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
												<td><?=$row->id_reg;?>-<?=$row->id_presc;?></td>
												<td><?=$row->create_date;?></td>												
                                                <td><?=$row->pat_name;?></td>										
												<td><?=$row->lvalue;?></td>
												<td style="text-align: center;">
												<div style="text-align: center;">
												
													<button title="Archive Items" onclick="myFunction_3(<?=$row->id_presc;?>)" class="btn btn-success btn-mini"><i class="icon-repeat"></i></button> 

												</div>
												
												<div style="float: right;">												
												</div>

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
				</body>
				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>