				<div  id="content">
				<?php
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Updated User
				</div>
				<?php
				} else if ($id=="add") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Add New User
				</div>
				<?php
				} else if ($id=="del") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete User
				</div>
				<?php
				}
				?>				
				<script>
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_act/"+id+"", "", "width=1000, height=700");
				}
				
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>radiology/rad_report/"+id+"", "", "width=1000, height=700");
				}
				</script>
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Report of Radiologi</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>ID Reg</th>
                                                <th>Patient Name</th>
												<th>Date Order</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										foreach($data->result() as $row){
										
										?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row->id_reg;?></td>
                                                <td><?php echo $row->pat_name;?></td>
                                                <td><?php echo $row->order_date;?></td>
												<td>
												
												<div class="btn-group">
												<button class="btn" onclick="myFunction_2(<?php echo $row->id_reg;?>)"> <i class="icon-folder-open"></i> Print Detail</button>
												<div class="wrap">
												<a href="#" class="button"></a>
												</div>
												</div>
												<!-- /btn-group -->
												
												<?php } ?>
												</td>
                                            </tr>
                                        </tbody>
                                   </table>
								   </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>