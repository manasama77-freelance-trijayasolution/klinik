	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Service Price
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Master Service Price
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Service Price
		</div>
	<?php
		}
		//Logic Parameter Button
		if ($id=="ok"){
			$id="0";
		}elseif ($id==""){
			$id="1";
		}elseif ($id=="edit"){
			$id="2";
		}else{
			$id=$id;
		}

		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		// echo $url;
	?>		
	<script>
	  function undisableTxt(){
		  if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>Lab/mst_lab_group";
		};
		    
		<?php
			$x = 1; 
			while($x <= 7) {
			echo "document.getElementById('".$x."').disabled = false;";
			echo "document.getElementById('".$x."').required = true;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }  
	  

	    function update_service(id){
			window.open("<?php echo base_url();?>marketing/update_mst_service/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
	    }


	  function price_item(id){
		window.open("<?php echo base_url();?>marketing/add_service_price/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
	  }
	  
	      function delete_service(id){
	  		var r = confirm("Are You Sure, Delete This Item ?");
			if (r == true) {
				x = window.location = "<?php echo base_url();?>marketing/delete_service/"+id+"";
			} else {
				x = "You pressed Cancel!";
			}
	      }

	</script>
                  <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left"><b><a href="<?php echo base_url();?>marketing/list_service_price">Group Service Price</a> &gt; <?=$serv_name;?> </b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">    
								
								<button class="btn btn-warning" onclick="goBack()"><i class="icon-step-backward"></i> Back</button>
								<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>		
								
								<div class="btn-group pull-right">
										<button class="btn btn-success" onclick="price_item('<?=$id_service;?>')" ><i class="icon-plus icon-white"></i> Add New</button> &nbsp;
								</div> </br></br>

<!-- 
									<div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>marketing/mst_currency_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   	</div> 
								   <div id="" style="overflow-y: auto; height:auto;">
 -->									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No.</th>
												<th>Group</th>
												<th>Services Name</th>
												<th>Type</th>
												<th>Price</th>
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
											<td><?php echo $row->group_name;?></td>
											<td><?php echo $row->serv_name;?></td>
											<td>[<?php echo $row->price_type;?>]</td>
											<td><div align="right"><?php echo number_format($row->price,2);?></div></td>	
											<td>	
													<button class="btn btn-warning btn-mini" title="Update Service" onclick="update_service(<?php echo $row->id_price;?>)"><i class="icon-edit"></i></button>
													<button class="btn btn-danger btn-mini" title="Delete Service <?php echo $row->id_price;?>"  onclick="delete_service(<?php echo $row->id_price;?>);"><i class="icon-trash"></i></button>
											</td>
										</tr>
										</form>
										<?php
										}
										?>
										</tbody>
									</table>
									
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>		
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>