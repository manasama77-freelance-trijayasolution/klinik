				<?php
				$id = $this->uri->segment(3);
				if ($id=="del"){
				?>
				<div class="alert alert-info">
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
							
				  function price_item(){
					window.open("<?php echo base_url();?>inv/mst_item_price","Popup","height=610, width=980, top=50, left=210 ");
				  }
				  
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/transfer_items_warehouse/"+id+"", "", "width=1000px, height=400px");
				}

				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/inv_item_warehouse/"+id+"", "", "width=1000px, height=400px");
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
                                <div class="muted pull-left"><b>Transfer Items</b></div>
                            </div>


                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/transfer_items_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
                                      <div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="#" onclick="price_item()" ><i class="icon-th-large"></i> Input Item Price</a></li>
												<li><a href="<?php echo base_url();?>inv/inv_item"><i class="icon-th-large"></i> Master Item</a></li>
												<li><a href="<?php echo base_url();?>inv/list_update_item"><i class="icon-th-large"></i> Approve Update Price Item</a></li>
												<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li>
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
												<th>Name</th>
												<th>Currency</th>
												<th>Price</th>
												<th>Type</th>
												<th>Branch</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->item_name;?></td>		
												<td><?php echo $row->Currency;?></td>			
												<td><?php echo number_format($row->Price,2);?></td>	
												<td><?php echo $row->price_type;?></td>
												<td><?php echo $row->nama_branch;?></td>
												<td>
													<button onclick="edit_price(<?php echo $row->id_price;?>);" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button>
													<button onclick="delete_price(<?php echo $row->id_price;?>);" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
												</td>
											</tr>
										</form>
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