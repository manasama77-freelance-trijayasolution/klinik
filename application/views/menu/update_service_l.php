
	<script>
	  function undisableTxt(){   
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
		window.open("<?php echo base_url();?>inv/update_inv_warehouse/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    }

	   function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/delete_Warehouse/"+id+"";
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
                            <div class="muted pull-left">Update Master Warehouse</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>master/update_service_bahasa" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">English</label>
                                          <div class="controls">
                                          <input type="hidden" name="kode_tabel" value="<?=$kode_tabel;?>">
                                          <input type="hidden" name="nama_tabel" value="<?=$nama_tabel;?>">
                                          <input type="hidden" name="id_service" value="<?=$id_service;?>">
                                            <input class="input-xlarge focused" name="inggris" type="text" id="1" autocomplete="off" value="<?=$inggris;?>" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Jepang</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="jepang" type="text" id="2" autocomplete="off" value="<?=$jepang;?>" disabled required>
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
												<input type="submit" class="btn btn-success" value="Save" id="3" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
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