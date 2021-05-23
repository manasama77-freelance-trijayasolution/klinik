	
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

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Update Master Label</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/process_update_master_label" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Drug Name</label>
                                          <div class="controls">
                                          <input type="hidden" name="id_label" value="<?=$id_label;?>">
										  <input type="text" style="width: 300px;" class="span6" id="typeahead" name="items" value="<?=$id_drug_dosage;?>:<?=$drug_name;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($dosis->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->id_drug_dosage).":".substr(htmlspecialchars($row_com->drug_name,ENT_QUOTES, 'UTF-8'), 0, 140).' ( '.$row_com->dosage_main.' x '.$row_com->dosage_days.' )",'; }?>""]' autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remark</label>
                                          <div class="controls">
                                           <textarea name="remark" disabled required id="2"><?=$description;?></textarea>
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
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Update</a>
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