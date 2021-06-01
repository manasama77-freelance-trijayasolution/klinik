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

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Update Master Dosage</b></div>
                            </div>
								<div class="form-actions">
								<button onclick="undisableTxt()" class="btn btn-primary">Start</button>
								</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/process_update_master_dosage" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Drug Name</label>
                                          <div class="controls">
                                          <input type="hidden" name="id_drug_dosage" value="<?=$id_drug_dosage;?>">
                                          <input type="hidden" name="id_drug" value="<?=$id_drug;?>">
										  <input type="text" value="<?=$drug_name;?>" style="width: 300px;" class="span6" id="typeahead" name="items" data-provide="typeahead" data-items="5" data-source='[<?php foreach($item->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->id_item).":".substr(htmlspecialchars($row_com->item_name,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remark</label>
                                          <div class="controls">
                                           <textarea name="remark" disabled required id="2"><?=$dossage_remarks;?></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Dosage</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="main" type="text" id="3" autocomplete="off" value="<?=$dosage_main;?>" disabled required> Times 
                                            <input class="input-small focused" name="day" type="text" id="4" autocomplete="off" value="<?=$dosage_days;?>" disabled required>
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
												<input type="submit" class="btn btn-success" id="1" disabled value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
									
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