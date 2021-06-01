	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Label
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Label
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Label
		</div>
	<?php
		}
	?>		
	<script>
	  function undisableTxt(){	    
	  	document.getElementById("typeahead").disabled = false;
		<?php
			$x = 1; 
			while($x <= 8) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }

	  function edit_label(id){
		window.open("<?php echo base_url();?>Pharmacy/update_master_label/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
	  }

	  function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>Pharmacy/delete_label/"+id+"";
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
                            <div class="muted pull-left">Input Master Label</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/save_label" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Drug Name</label>
                                          <div class="controls">
										  <input type="text" style="width: 300px;" class="span6" id="typeahead" name="items" data-provide="typeahead" data-items="5" data-source='[<?php foreach($dosis->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->id_drug_dosage).":".substr(htmlspecialchars($row_com->drug_name,ENT_QUOTES, 'UTF-8'), 0, 140).' ( '.$row_com->dosage_main.' x '.$row_com->dosage_days.' )",'; }?>""]' autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remark</label>
                                          <div class="controls">
                                           <textarea name="remark" disabled required id="2"></textarea>
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
												<input type="submit" class="btn" value="Save" id="1" disabled>
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Drug Name</th>
												<th>Remark</th>
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
												<td><?php echo $row->drug_name;?></td>
												<td><?php echo $row->description;?></td>
												<td>
													<button onclick="edit_label(<?=$row->id_label;?>);" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button>
													<button onclick="myFunction(<?=$row->id_label;?>);" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
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
</html>