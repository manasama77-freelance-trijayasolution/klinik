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
	  

    function update_service(id,group){
		window.location.href = "<?php echo base_url();?>marketing/list_service_price_process/"+id+"/"+group;
		 return false;
    }

	  function price_item(){
		window.open("<?php echo base_url();?>marketing/mst_service","Popup","height=610, width=980, top=50, left=210 ");
	  }
	  
    function clear_filter(){
		window.location = "<?php echo base_url();?>marketing/list_service_price";
    }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b><a href="<?php echo base_url();?>marketing/list_service_price">Group Service Price</a></b></div>
                            </div>

							
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
							
									<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button></br></br>

										<form class="form-horizontal" action="<?php echo base_url();?>marketing/list_service_price_filter" method="post" name="mst_service">
																				
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Total</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="pilter" id="2" required>
											  <option value="">- Choose Total -</option>
											<?php 
											foreach($total->result() as $rows){ 
												if ($pilter == $rows->JML) {
													$tanda = "selected";
												}else{
													$tanda = "";
												}
											?>
												<option value="<?=$rows->JML?>" <?=$tanda;?> align="justify"><?=$rows->JML?></option>
											<?php } ?>
			                                 </select>
			                                 
                                          </div>
                                        </div>
												
										<div class="form-actions">
										<input type="submit" class="btn btn-success" id="3" value="Find">
										<?php if ($pilter > 0) { ?>
										<button onclick="clear_filter();"  type="button" class="btn btn-danger" title="Clear Filter"><i class="icon-remove icon-white"></i> Clear</button>
										<?php }	?>
										<button class="btn btn-success" onclick="price_item()" type="button"><i class="icon-plus icon-white"></i> Add New</button>
                                        </div>
                        
									<legend></legend>
									</form>

									<div class="table-toolbar">
									<!-- 
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>marketing/mst_currency_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div> -->
                                   	</div> 
								   <div id="" style="overflow-y: auto; height:auto;">
									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No.</th>
												<th>Group</th>
												<th>Services Name</th>
												<th>Total</th>
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
											<td><?php echo $row->JML;?></td>
											<td>
													<button class="btn btn-success btn-mini" title="Update Service" onclick="update_service(<?php echo $row->id_service;?>,<?php echo $row->id_group;?>);"><i class="icon-play"></i></button>
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