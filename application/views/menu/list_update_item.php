				<?php
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success Update !</strong> the price will change tomorrow
				</div>
				<?php
				}
				if ($id=="del"){
				?>
			    <div class="alert alert-danger">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success Delete !</strong> Delete Purchase Request
				</div>
				<?php
				}
				?>
				<script>
	

				function b_delete(id) {
					var r = confirm("Are you sure to delete this price ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/del_price_item/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
			
				function b_approve(id) {
					var r = confirm("Are you sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/app_price_item/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
			
				function goBack(){
					window.history.back();
				}


			  function price_item(){
				window.open("<?php echo base_url();?>inv/mst_item_price","Popup","height=610, width=980, top=50, left=210 ");
			  }
					 
		      function list_item_price(){
		      	window.open("<?php echo base_url();?>inv/list_item_price/","","height=610, width=980, top=50, left=210 ");
		      }

		      function list_item(){
		      	window.open("<?php echo base_url();?>inv/list_inv_item/","","height=610, width=980, top=50, left=210 ");
		      } 
		      
			  function price_item(){
				window.open("<?php echo base_url();?>inv/mst_item_price","Popup","height=610, width=980, top=50, left=210 ");
			  }
			  
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
                                   			
                                   			<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="<?php echo base_url();?>inv/inv_item"><i class="icon-th-large"></i> Master Item</a></li>
												<li><a href="#" onclick="list_item()" ><i class="icon-th-large"></i> List Item </a></li>
												<li><a href="#" onclick="price_item()" ><i class="icon-th-large"></i> Input Item Price</a></li>
												<li><a href="#" onclick="list_item_price()" ><i class="icon-th-large"></i> List Item Price</a></li>
												<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li>
											</ul>
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
												<th>Name</th>
												<th>Currency</th>
												<th>Price Old</th>
												<th>Price New</th>
												<th>Type</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i 			= 1;
										foreach($list->result() as $row){
											$ceklist	= "";
											if ($row->hrg > $row->Price) {
												$ceklist ="disabled";
											}
										?>
                                           <tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->item_name;?></td>		
												<td>IDR</td>		
												<td><?php echo number_format($row->hrg,2);?> </td>	
												<td><?php echo number_format($row->Price,2);?> </td>	
												<td><?php echo $row->price_type;?></td>		
												<td>
												<button class="btn btn-success btn-mini" title="Approve Price" onclick="b_approve('<?php echo $row->id_price;?>');" <?php echo $ceklist; ?> ><i class="icon-ok"></i></button> 

												<button class="btn btn-danger btn-mini" title="Delete Price" onclick="b_delete('<?php echo $row->id_price;?>');"><i class="icon-trash"></i></button></td>	
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