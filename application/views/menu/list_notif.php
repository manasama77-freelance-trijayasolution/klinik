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
  
				function goBack(){
					window.history.back();
				}
				
				function myFunction_2(id,ix) {
					var myWindow = window.open("<?php echo base_url();?>smart/price_lab/"+id+"/"+ix+"", "Popup", "width=1000px, height=400px");
				}

				function myFunction_3(id,ix) {
					var myWindow = window.open("<?php echo base_url();?>inv/inv_item_warehouse/"+id+"/"+ix+"", "Popup", "width=1000px, height=400px");
				}

				function myFunction_4(id,ix) {
					var myWindow = window.open("<?php echo base_url();?>smart/price_n2/"+id+"/"+ix+"", "Popup", "width=1000px, height=400px");
				}
				
				function myFunction_5(id,ix,ic) {
					var myWindow = window.open("<?php echo base_url();?>smart/price_other/"+id+"/"+ix+"/"+ic+"", "Popup", "width=1000px, height=400px");
				}
				
				function myFunction_9(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/trf_item_app/"+id+"", "Popup", "height=600, width=1800, top=20, left=180 ");
				}
				
				function myFunction_10(id_item,id) {
					// var myWindow = window.open("<?php echo base_url();?>inv/mst_item_price2/5", "Popup", "width=700px, height=700px");
					var myWindow = window.open("<?php echo base_url();?>inv/mst_item_price2/"+id_item+"/"+id+"", "Popup", "width=700px, height=700px");
				}
				
				function myFunction_11(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/app_item_request/"+id+"", "Popup", "width=980px, height=610px, top=50, left=210 ");
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
                                <div class="muted pull-left"><b>Smart Notification</b></div>
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
												<th></th>
												<th>Type</th>
												<th>Name</th>
												<th>Create Date</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										$iPrice=1;
										foreach($get_list_1->result() as $row1){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td>Lab Request Approval</td>
												<td><?=$row1->pat_name;?></td>		
												<td><?=date("d.m.Y",strtotime($row1->order_date));?></td>	
												<td><button class="btn btn-info btn-mini" title="Process" onclick="javascript:location.href='<?php echo base_url();?>lab/lab_job/2'"><i class="icon-circle-arrow-right"></i></button></td>
											</tr>
										<?php
										}
										foreach($get_list_2->result() as $row2){
										?>
                                           <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td>Purchase Request Approval</td>
												<td><?=$row2->pr_no;?></td>		
												<td><?=date("d.m.Y",strtotime($row2->create_date));?></td>	
												<td>
													<?php if ($userlevel != 'user') { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="javascript:location.href='<?php echo base_url();?>inv/listpr_app'"><i class="icon-circle-arrow-right"></i></button>
													<?php } ?>
												</td>
											</tr>
										<?php
										}
										foreach($get_list_3->result() as $row3){
										?>
                                           <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td>Purchase Order Approval </td>
												<td><?=$row3->po_no;?></td>		
												<td><?=date("d.m.Y",strtotime($row3->created_date));?></td>	
												<td><button class="btn btn-info btn-mini" title="Process" onclick="javascript:location.href='<?php echo base_url();?>inv/listpr_app'"><i class="icon-circle-arrow-right"></i></button></td>
											</tr>
										<?php
										}
										foreach($get_list_5->result() as $row5){
										?>
                                           <tr class="odd gradeX">
												<td><?=$i++;?><!-- NOMOR 5 --></td>
												<td>Transfer Item Request Approval</td>
												<td><?=$row5->mi_no;?></td>		
												<td><?=date("d.m.Y",strtotime($row5->create_date));?></td>	
												<td><button class="btn btn-info btn-mini" title="Process" onclick="javascript:location.href='<?php echo base_url();?>inv/listmi_app'"><i class="icon-circle-arrow-right"></i></button></td>
											</tr>
										<?php
										}
										foreach($get_list_6->result() as $row6){
										?>
                                           <tr class="odd gradeX">
												<td><i class="icon-check"></i></td>
												<td><font color="#ff0040"><b>Price Not Available</b></font></td>
												<td><b><?=$row6->price_type;?></b> : <b><?=$row6->serv_name;?></b> [<?=$row6->notes;?>]</td>		
												<td><?=date("d.m.Y",strtotime($row6->create_date));?></td>	
												<td>
												<?php 
												// echo $row6->type_id;
												if ($row6->type_id == 0) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_5(<?=$row6->id;?>,'<?=$row6->id_reg;?>', <?=$row6->id_price_type;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												<?php if ($row6->type_id == 1) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_2(<?=$row6->id;?>,'<?=$row6->id_reg;?>', <?=$row6->id_price_type;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												<?php if ($row6->type_id == 2) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_4(<?=$row6->id;?>,'<?=$row6->id_reg;?>', <?=$row6->id_price_type;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												<?php if ($row6->type_id == 3) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_5(<?=$row6->id;?>,'<?=$row6->id_reg;?>', <?=$row6->id_price_type;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												<?php if ($row6->type_id == 4) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_5(<?=$row6->id;?>,'<?=$row6->id_reg;?>', <?=$row6->id_price_type;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												<?php if ($row6->type_id == 5) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_5(<?=$row6->id;?>,'<?=$row6->id_reg;?>', <?=$row6->id_price_type;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												<?php if ($row6->type_id == 13) { ?>
													<button class="btn btn-info btn-mini" title="Process" onclick="myFunction_10(<?=$row6->id_trouble;?>,<?=$row6->id;?>)"><i class="icon-circle-arrow-right"></i></button>
												<?php } ?>
												</td>
											</tr>
										<?php
										}
										foreach($get_list_7->result() as $row7){
										?>
                                           <tr class="odd gradeX">
												<td><i class="icon-file"></i></td>
												<td><font color="#ff8000"><b>Waiting for Approval Quotation</b></font></td>
												<td><b><?=$row7->quot_name;?></b></td>		
												<td><?=date("d.m.Y",strtotime($row7->quot_date_create));?></td>	
												<td><button class="btn btn-info btn-mini" title="Process" onclick="javascript:location.href='<?php echo base_url();?>marketing/list_quotation_app'"><i class="icon-circle-arrow-right"></i></button></td>
											</tr>
										<?php
										}
										foreach($get_list_8->result() as $row8){
										?>
                                           <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td>List Request Item</td>
												<td><?=$row8->source;?></td>		
												<td><?=date("d.m.Y",strtotime($row8->create_date));?></td>	
												<td><button class="btn btn-info btn-mini" title="Process" onclick="javascript:location.href='<?php echo base_url();?>inv/list_request_items'"><i class="icon-circle-arrow-right"></i></button></td>
											</tr>
										<?php
										}
										foreach($get_list_9->result() as $row9){
										?>
										 <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td>List Request Item</td>
												<td>List Request Transfer Item : <?=$row9->mi_no;?></td>		
												<td><?=date("d.m.Y",strtotime($row9->mi_date));?></td>	
												<td>
													<button class="btn btn-info btn-mini" title="Process" onclick="window.location='<?php echo base_url();?>inv/listmi_app'"><i class="icon-circle-arrow-right"></i></button>
													<!-- <button class="btn btn-info btn-mini" title="Process" onclick="myFunction_9(<?=$row9->id_mi_no;?>)"><i class="icon-circle-arrow-right"></i></button> -->
												</td>
											</tr>
										<?php
										}
										if ($userlevel == "master") {
											foreach($get_list_10->result() as $row10){
										?>
										 <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td>List Item Request</td>
												<td><?=$row10->item_group;?> - <?=$row10->item_name;?>, Created By <?=$row10->fullname;?></td>		
												<td><?=date("d.m.Y",strtotime($row10->create_date));?></td>	
												<td><button class="btn btn-info btn-mini" title="Process" onclick="myFunction_11(<?=$row10->id_item;?>)"><i class="icon-circle-arrow-right"></i></button></td>
											</tr>
										<?php
											}
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