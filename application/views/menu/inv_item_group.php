	<div class="span9" id="content">	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Items Group
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Items Group
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Items Group
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
			while($x <= 3) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }

    function update_action(id){
		window.open("<?php echo base_url();?>inv/update_inv_item_group/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    }


      function delete_action(id){
  		var r = confirm("Are You Sure Want Delete  ?");
		if (r == true) {
			x = window.location = "<?php echo base_url();?>inv/delete_inv_item_group/"+id+"";
		} else {
			x = "You pressed Cancel!";
		}
      }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Input Master Items Group</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_g" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Group</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="g_item" type="text" id="1" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Description</label>
                                          <div class="controls">
                                            <textarea name="g_desc" type="text" id="2" autocomplete="off" disabled required></textarea>
                                          </div>
                                        </div>
										
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3>Check Again</h3>
											</div>
											<div class="modal-body">
												<p>Are You Sure ?</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn" value="Save" id="3" disabled>
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
								<div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <!-- <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-file"></i> Export Data <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1">Excel</a></li>
                                         </ul> -->
                                          <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/inv_item_group_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">

									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Group Name</th>
												<th>Description</th>				
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
												<td><?php echo $row->item_group;?></td>
												<td><?php echo $row->remarks;?></td>		
												<td>
													<button onclick="update_action(<?php echo $row->id_item_group;?>);" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button>
													<button class="btn btn-danger btn-mini" onclick="delete_action(<?php echo $row->id_item_group;?>);"><i class="icon-trash"></i></button>
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
		</div>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>