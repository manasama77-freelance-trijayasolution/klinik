	<div class="span9" id="content">	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Radiology Group
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
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
		window.location.href = "<?php echo base_url();?>radiology/input_radiology_group";
		};
		    
		<?php
			$x = 1; 
			while($x <= 7) {
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
                            <div class="muted pull-left">Update Radiology Group Form</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>radiology/process_update_radiology_group" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Group Name</label>
                                          <div class="controls">
                                          <input type="hidden" name="id_group" value="<?=$id_group;?>">
										  <textarea name="g_name" id="1" disabled><?=$group_desc;?></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Group Number</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="g_number" type="text" id="2" value="<?=$group_seq_no;?>" autocomplete="off" disabled required>
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
                </div>
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>