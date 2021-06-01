				<?php
				// $id 					= $this->uri->segment(3);
				$session_data 			= $this->session->userdata('logged_in');
				$userlvl				= $session_data['userlevel'];
				$info 					= $this->uri->segment(4);
				if ($info=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Updated Order
				</div>
				<?php
				} else if ($info=="add") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Add New Order
				</div>
				<?php
				} else if ($info=="del") {
				?>
			    <div class="alert alert-error">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete Order
				</div>
				<?php
				}
				?>						
				<script>
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_act/"+id+"", "Popup", "width=950, height=650, top=20, left=250");
				}
				
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_report/"+id+"", "Popup", "width=1200px, height=650, top=20, left=250");
				}

				function fapproval(id,order) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_approval/"+id+"/"+order+"", "Popup", "width=1200px, height=650, top=20, left=250");
				}
				

				function update_rad(id,id_reg) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_rev/"+id+"/"+id_reg+"", "Popup", "width=1025, height=600, top=50, left=180");
				}

				function segarkan() {
				    location.reload();
				}

		      function delete_order(id){
		  		var r = confirm("Are You Sure Want Delete this order  ?");
				if (r == true) {
					x = window.location = "<?php echo base_url();?>radiology/delete_rad_order/"+id+"";
					// $.post("delete_lab_order/"+id+"", $("#console").serialize()); // silent delete..
					// document.getElementById("del"+id+"").disabled = true;
				} else {
					x = "You pressed Cancel!";
				}
		      }

				</script>
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
				
				     var time = new Date().getTime();
				     $(document.body).bind("mousemove keypress", function(e) {
				         time = new Date().getTime();
				     });

				     function refresh() {
				         if(new Date().getTime() - time >= 5000) 
				             window.location.reload(true);
				         else 
				             setTimeout(refresh, 60000);
				     }

				     setTimeout(refresh, 60000);
				</script>
				<!-- untuk auto refresh setiap 10 detik -->
				<!-- <meta http-equiv="refresh" content="10" > -->
				<!-- untuk auto refresh setiap 10 detik -->
					 <!-- <body onload="startTime()"> -->
					 <body>
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Radiology Order List</b></div>
								<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
								   
									  <div class="btn-group pull-left">
										<button class="btn btn-success btn-large" onclick="segarkan();" id="reloadCB"><i class="icon-refresh"></i> <b>Refresh</b></button>

										<!-- <button class="btn btn-mini btn-mini" onclick="toggleAutoRefresh(this);" id="reloadCB"><i class="icon-refresh"></i> <b>Auto</b></button> -->
										<!-- <button class="btn btn-mini btn-mini" onclick="toggleAutoRefresh_stop(this);" id="reloadCBR"><i class="icon-stop"></i> <b>Stop</b></button> -->
                                      </div>
									  <!-- 
                                      <div class="btn-group pull-right">
                                      	<button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                       </div> -->
										
										<div class="btn-group pull-right">
                                        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
                                         <?php if ($id=="0"){ ?><i class="icon-ok-sign"></i> <b>Completed</b><?php }?>
                                         <?php if ($id=="1") { ?><i class="icon-exclamation-sign"></i> <b>Waiting</b><?php }?> 
                                         <?php if ($id=="2") { ?><i class="icon-bell"></i> <b>Request Approval</b><?php }?>
                                         <?php if ($id=="3") { ?><i class="icon-remove-sign"></i> <b>Cancel</b><?php }?> 
                                         <?php if ($id=="4") { ?><i class="icon-exclamation-sign"></i> <b>Progress</b><?php }?> 
                                         <?php if ($id=="5") { ?><i class="icon-exclamation-sign"></i> <b>Pending</b><?php }?> 
                                         <span class="caret"></span>
                                         </button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1"><i class="icon-exclamation-sign"></i> <b>Waiting</b></a></li>
											<li><a href="<?php echo base_url();?>radiology/radiology_job/4"><i class="icon-exclamation-sign"></i> <b>Progress</b></a></li>
											<li><a href="<?php echo base_url();?>radiology/radiology_job/5"><i class="icon-exclamation-sign"></i> <b>Pending</b></a></li>
											<li><a href="<?php echo base_url();?>radiology/radiology_job/0"><i class="icon-ok-sign"></i> <b>Completed</b></a></li>
                                            <li><a href="<?php echo base_url();?>radiology/radiology_job/3"><i class="icon-remove-sign"></i> <b>Cancel</b></a></li>
											<?php 
											if ($userlvl != "user"){?>
											<li><a href="<?php echo base_url();?>radiology/radiology_job/2"><i class="icon-bell"></i> <b>Request Approval</b></a></li>
											<?php }?>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                               	<th>No.</th>
                                                <th>Order No.</th>
                                                <th>ID Registration</th>
												<th>Registration Date</th>
												<!-- <th>Order Date</th> -->
                                                <th>Patient</th>
												<th>Company Name</th>
												<th>Action</th>
												<!-- <th>Package</th> -->
												<!-- <th>List Exam.</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
										?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row->id_order;?></td>
												<td><?php echo $row->id_reg;?></td>
												<td><?=date("d.m.Y",strtotime($row->reg_date));?></td>
												<!-- <td><?=date("d.m.Y H:i:s",strtotime($row->order_date));?></td> -->
                                                <td><?php echo $row->pat_name;?></td>
												<td><?php echo $row->client_name;?></td>
												<!-- <td><?php echo $row->quot_name;?></td> -->
												<!-- <td><b><p style="font-size: 0.975em;">	<?php echo str_replace(",",".</br>",$row->items);?></p></b></td> -->
												<td>
												<?php 
												if ($id==1 || $id==4 || $id==5){
												?>
												<div class="btn-group">
												<!-- <?php if($row->is_complete=="1"){ ?>
													<button class="btn btn-info dropdown-toggle" onclick="myFunction_edit(<?php echo $row->id_order;?>)"><b>Process</b></button>
													<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
													<ul class="dropdown-menu">
														<li><a href="#" onclick="delete_order(<?php echo $row->id_order;?>,'<?php echo $row->id_reg;?>')">Cancel</a></li>
													</ul>
												<?php }else{ ?>
													<button class="btn btn-info" onclick="myFunction(<?php echo $row->id_order;?>)"><b>View</b></button>
												<?php } ?> -->
												<button class="btn btn-info dropdown-toggle" onclick="myFunction(<?php echo $row->id_order;?>)"><b>View</b></button>
												<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
												<ul class="dropdown-menu">
													<li><a href="#" onclick="delete_order(<?php echo $row->id_order;?>)">Cancel</a></li>
												</ul>
												</div>
												<!-- /btn-group -->
												<?php } ?>
												
												<?php 
												if ($id==0){
												?>
												<div class="btn-group">
												<button class="btn btn-info btn-mini" onclick="myFunction_2('<?php echo $row->id_reg;?>')"> <i class="icon-print"></i></button>
												</div>
												<div class="btn-group">
												<button class="btn btn-warning btn-mini" title="Revision Lab Result" onclick="update_rad('<?php echo $row->id_order;?>','<?php echo $row->id_reg;?>')"><i class="icon-edit"></i></button>
												</div>
												<!-- /btn-group -->
												<?php } 
												if($id==2){
												?>
												<div class="btn-group">
												<button class="btn" onclick="fapproval('<?php echo $row->id_reg;?>','<?php echo $row->id_order;?>')"> <i class="icon-folder-open"></i> View</button>
												</div>
												<!-- /btn-group -->
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
				</body>
				
				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>