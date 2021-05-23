			<?php
				$id = $this->uri->segment(3);
				
			?>
			
				<script>
						function myFunction(id) {
							var r = confirm("Are You Sure ?");
							if (r == true) {
							x = window.location = "<?php echo base_url();?>docter/del_item_value/"+id+"";
							} else {
							x = "You pressed Cancel!";
							}
						}
					
						function goBack(){
							window.history.back();
						}
									
								
				      function update_item(id){
				      	window.open("<?php echo base_url();?>docter/update_item_value/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
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
                                <div class="muted pull-left"><b>List Items</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">    
								<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>		
                                   <!-- <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/inv_item_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/inv_item_excel"><i class="icon-list-alt"></i> Export to Eazy </a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div> -->
                                      </br>
									  </br>
                        
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                          	<tr>
												<th>No</th>
												<th>Group Service</th>
												<th>Gender</th>
												<th>Services Name</th>
												<th>Value Name</th>
												<th>Age / Until</th>
												<th>Limit Min - Max</th>
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
												<td><?php echo $row->group_desc;?></td>
												<td><?php echo $row->gender;?></td>		
												<td><?php echo $row->serv_name;?></td>			
												<td><?php echo $row->nama_value;?></td>	
												<td><?php echo $row->range_age_1;?> / <?php echo $row->range_age_2;?></td>
												<td><?php echo $row->limit_1;?> - <?php echo $row->limit_2;?></td>
												<td>
												<button class="btn btn-warning btn-mini" title="Update Item" onclick="update_item(<?php echo $row->id;?>);"><i class="icon-edit"></i></button>
											
												</td>
											</tr>
										</form>
										<?php
										}
										?>
                                        </tbody>
                                   </table>
							
                        </div>
                        <!-- /block -->
                    </div>        
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