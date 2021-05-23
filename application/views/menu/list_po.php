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
					var myWindow = window.open("<?php echo base_url();?>inv/print_po/"+id+"", "", "width=800px, height=400px");
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
                                <div class="muted pull-left">Purchase Order List</div>
                            </div>
							 <div class="form-actions">									 
							 <div class="btn-group">
							  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"> Menu <span class="caret"></span></button>
							  <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>inv/purchase_order"><i class="icon-plus"></i> New Purchase Order</a></li>
								<li><a href="<?php echo base_url();?>inv/listpr_pur"><i class="icon-list"></i> List Purchase Requests</a></li>
								<?php if ($userlvl != "user"){ ?>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>inv/listpo_app/"><i class="icon-ok-sign"></i> Request Approval</a></li>
								<?php } ?>
								<li><a href="#" onclick="goBack()"><i class="icon-share-alt"></i> Back</a></li>
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
												<th>PR Number</th>
                                                <th>Date</th>
												<th style="text-align: center;">Status</th>
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
												<!-- <td><?php 
												if ($row->pr == NULL){ ?>
												<span style=width:130px class="label label-inverse"> NO-PR/<?=$row->id_po;?> </span>
												<?php } ?>
												<?=str_replace(";"," <br> ",$row->pr);?>
												</td> -->
												<td style="text-align: center;">
													<button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->pr);?>"><i class="icon-search"></i><b> PR Number </b></button>
												</td>
												<td align="center"><?php echo date("d.m.Y",strtotime($row->po_date));?></td>
												<td style="text-align: center;"><?php 
												if ($row->status == 1){
													echo "<span style='width:80px;' class='label label-info'>Waiting</span>";
												}
												if ($row->status == 0){
													echo "<span style='width:80px;' class='label label-success'>Approved</span>";
												}
												if ($row->status == 2){
													echo "<span style='width:80px;' class='label label-important'>Rejected</span>";
												}
												if ($row->status == 3){
													echo "<span style='width:80px;' class='label label-warning'>On Process</span>";
												}
												if ($row->status == 4){
													echo "<span style='width:80px;' class='label label-info'>Completed</span>";
												}
												?></td>
												<td style="text-align: center;"><button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->items);?>"><i class="icon-search"></i><b> <?=$row->qty;?> Items </b></button></td>
												<td style="text-align: center;">
													<button class="btn btn-success btn-mini" title="Print" onclick="myFunction_3(<?=$row->id_po;?>)"> <i class="icon-print"></i> </button> 
													<button onclick="myFunction(<?=$row->id_po;?>);" title="Delete" <?php if ($row->is_completed != 1){ ?> disabled <?php } ?> class="btn btn-danger btn-mini"><i class="icon-trash"></i></button></td>
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