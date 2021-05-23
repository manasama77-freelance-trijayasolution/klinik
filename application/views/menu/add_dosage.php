	<?php
		$id 	= $this->uri->segment(3);
		$obat 	= $this->uri->segment(4);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Dosage
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Dosage
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Dosage
		</div>
	<?php
		}
	?>		
	<script>
	  function undisableTxt(){	    
	  	document.getElementById("typeahead").disabled = false;
		<?php
			$x = 1; 
			while($x <= 4) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }


	function edit_dosage($id){
		window.open("<?php echo base_url();?>Pharmacy/update_master_dosage/"+$id+"","Popup","height=610, width=980, top=50, left=210 ");
	}


	  function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					// x = window.location = "<?php echo base_url();?>Pharmacy/delete_dosage/"+id+"";
					$.post("delete_dosage/"+id+"", $("#console").serialize()); // silent delete..
					document.getElementById("del"+id+"").disabled = true;
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
                            <div class="muted pull-left"><b>Input Master Dosage</b></div>
                            </div>
								<div class="form-actions">
								<button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
								<button class="btn btn-warning" onclick="goBack()">Back</button>
								</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/save_dosage/<?=$id;?>" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Drug Name</label>
                                          <div class="controls">
										  <input type="text" value="<?=urldecode($obat);?>" style="width: 300px;" class="span6" id="typeahead" name="items" data-provide="typeahead" data-items="5" data-source='[<?php foreach($item->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->id_item).":".substr(htmlspecialchars($row_com->item_name,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remark</label>
                                          <div class="controls">
                                           <textarea name="remark" disabled required id="2"></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Dosage</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="main" type="text" id="3" autocomplete="off" disabled required> Times 
                                            <input class="input-small focused" name="day" type="text" id="4" autocomplete="off" disabled required>
                                            Days
                                          </div>
                                        </div>       
												
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" id="1" onclick="this.disabled=true;this.form.submit();" disabled value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Drug Name</th>
												<th>Main</th>
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
												<td><?php echo $row->dosage_main;?> x <?php echo $row->dosage_days;?> </td>
												<td><?php echo $row->dossage_remarks;?></td>
												<td>
													<button onclick="edit_dosage(<?=$row->id_drug_dosage;?>);" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button>
													<button onclick="myFunction(<?=$row->id_drug_dosage;?>);" id="del<?=$row->id_drug_dosage;?>" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
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