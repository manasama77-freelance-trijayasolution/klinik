				<script type="text/javascript">
					
				    function new_service(){
						window.open("<?php echo base_url();?>lab/new_lab_item","Popup","height=610, width=980, top=50, left=210 ");
				    }
 					

 					function update_service(id){
						window.open("<?php echo base_url();?>lab/update_lab_item/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
				    }


			      function delete_service(id){
			  		var r = confirm("Are You Sure, Delete This Item ?");
					if (r == true) {
						$.post("del_lab_item/"+id+"", $("#console").serialize()); 
						document.getElementById("del"+id+"").disabled = true;
					} else {
						x = "You pressed Cancel!";
					}
			      }


				</script>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>List Lab Item</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">    
								<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>		
								
                                   <div class="btn-group pull-right">
										<button class="btn btn-success" onclick="new_service();"><i class="icon-plus icon-white"></i> Add New</button>
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle"><span class="caret"></span></button>
                                         <!-- <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button> -->
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>lab/list_lab_item_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>lab/list_lab_item_excel2"><i class="icon-list-alt"></i> Lab Non Unit And Range</a></li>
											<!-- <li><a href="#"><i class="icon-print"></i>Print to PDF</a></li> -->
                                         </ul>
                                      </div>

                                      </br>
									  </br>

  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No.</th>
												<th>Item Description</th>
												<th>Item Abbr</th>
												<th>Unit</th>
												<th>Result Type</th>
												<th>Group</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
										<tr class="odd gradeX">
											<td><?=$i++?></td>
											<td><?php echo $row->lab_item_desc;?></td>
											<td><?php echo $row->lab_item_abbr;?></td>
											<td><?php echo $row->lab_item_unit;?></td>
											<td>
											<?php 
											if ($row->lab_item_case == 0) {
												echo "Range Normal";
											}else{
												echo "Kombinasi Karakter";
											}
											?>
												

											</td>
											<td><?php echo $row->group_name;?></td>
											<td>
													<button class="btn btn-warning btn-mini" title="Update Service" onclick="update_service(<?php echo $row->id_lab_item;?>);"><i class="icon-edit"></i></button>
													<!-- <button class="btn btn-danger btn-mini" id="del<?php echo $row->id_lab_item;?>" onclick="delete_service(<?php echo $row->id_lab_item;?>);"><i class="icon-trash"></i></button> -->
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