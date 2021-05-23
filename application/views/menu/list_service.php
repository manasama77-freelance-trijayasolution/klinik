				<script type="text/javascript">
					
				    function new_service(id){
						window.location = "<?php echo base_url();?>marketing/mst_service";
				    }

				    function update_service(id){
						window.open("<?php echo base_url();?>marketing/update_mst_service/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
				    }


			      function delete_service(id){
			  		var r = confirm("Are You Sure, Delete This Item ?");
					if (r == true) {
						// x = window.location = "<?php echo base_url();?>marketing/delete_service2/"+id+"";
						$.post("delete_service2/"+id+"", $("#console").serialize()); // silent delete..
						document.getElementById("del"+id+"").disabled = true;
					} else {
						x = "You pressed Cancel!";
					}
			      }


				  function price_item(id){
					window.open("<?php echo base_url();?>marketing/add_service_price/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
				  }

				function segarkan() {
				    location.reload();
				}
				  

				</script>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>List Services</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">    
								
                                    <button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>	
									
									<button class="btn btn-success" onclick="segarkan();" id="reloadCB"><i class="icon-refresh"></i> <b>Refresh</b></button>

	
                                   <div class="btn-group pull-right">
										<!-- <button class="btn btn-success" onclick="new_service();" ><i class="icon-plus icon-white"></i> Add New</button> -->
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>marketing/list_service_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/inv_item_excel"><i class="icon-list-alt"></i> Export to Eazy </a></li>
											<li><a href="#"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
                                       
                                      </br>
									  </br>


  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No.</th>
												<!-- <th>Group</th> -->
												<!-- <th>Code</th> -->
												<th>Services Name</th>
												<!-- <th>Type</th> -->
												<th>Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
											if ($row->code_service == "") {
												$code_service = "kosong";
											}else{
												$code_service = $row->code_service;
											}
										?>
										<tr class="odd gradeX">
											<td><?=$i++?></td>
											<td><?php echo $row->serv_name;?></td>
											<td><div align="right"><?php echo number_format($row->price,2);?></div></td>	
											<td>
													<button class="btn btn-warning btn-mini" title="Update Service <?php echo $row->serv_name;?>" onclick="update_service(<?php echo $row->dodol;?>);"><i class="icon-edit"></i></button>
													<button class="btn btn-danger btn-mini" id="del<?php echo $row->dodol;?>" title="Delete Service <?php echo $row->serv_name;?>" onclick="delete_service(<?php echo $row->dodol;?>);"><i class="icon-trash"></i></button>
													<?php if ($userlevel <> 'user') { ?>
													<button class="btn btn-success btn-mini" title="Add Service <?php echo $row->serv_name;?>" onclick="price_item('<?php echo $row->id_service;?>')" ><i class="icon-plus icon-white"></i></button>
													<?php } ?>
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
                        <!-- /block -->
                    </div>				
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>