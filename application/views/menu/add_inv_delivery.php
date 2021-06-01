	<div class="span9" id="content">	
	
	<script>
	  function undisableTxt(){

		    
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


	function closeit(){
		var id_delivery	= document.getElementById("id_delivery").value;
		var delivery 	= document.getElementById("1").value;
		window.opener.document.forms['mst_pr'].elements['id_address'].value=id_delivery;
		window.opener.document.forms['mst_pr'].elements['delivery'].value=delivery;
	}

	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Input Master Delivery Address</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_del_addr2" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Delivery Address</label>
                                          <div class="controls">
                                          <input name="id_delivery" type="hidden" id="id_delivery" value="<?=$id_delivery;?>">
										  <textarea name="delivery" id="1" rows="4" cols="50" disabled></textarea>
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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success" onclick="closeit();">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
							
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