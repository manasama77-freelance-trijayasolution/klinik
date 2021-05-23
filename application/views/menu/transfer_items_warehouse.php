<?php
$idx = $this->uri->segment(4);
if ($idx=="ok"){
?>
    <div class="alert alert-success">
		 <button class="close" data-dismiss="alert">&times;</button>
		 <strong>Success!</strong> Input Transfer Items
	</div>
<?php
}
$id = $this->uri->segment(3);
foreach($item->result() as $row){};
?>

	<div class="span9" id="content">	
	<script type="text/javascript">
	
	  function undisableTxt(){
		if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>Lab/mst_lab_item";
		};
		    
		<?php
			$x = 1; 
			while($x <= 10) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function fungsi_tutup(){
	  	setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);
	  }
	  

	  function popup_s(id){
			var myWindow = window.open("<?php echo base_url();?>inv/find_werehouse_list/"+id+"", "", "width=1200px, height=500px, top=70, left=80");
	  }
		
		function popup_d(id){
			var myWindow = window.open("<?php echo base_url();?>inv/find_werehouse", "", "width=1200px, height=500px, top=70, left=80");
		}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Input Transfer Items</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
									  <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>									 
										 <button class="btn btn-warning" onclick="fungsi_tutup()">Close</button>
										 </div>
										
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_transfer" method="post" name="mst_service">
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="id_item" type="hidden" readonly value="<?=$row->id_item;?>" >
                                            <input class="input-xlarge focused" name="item_name" type="text" readonly value="<?=$row->item_name;?>" >
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">From Warehouse</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="id_warehouse" type="hidden">
                                            <input class="input-xlarge focused" name="warehouse_name" type="text" readonly>
                                   			<button type="button" onclick="popup_s(<?=$row->id_item;?>);" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Stock Item</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="stock" type="text" readonly> <?=$row->baseunit;?>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">To Warehouse</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="move" type="hidden">
                                            <input class="input-xlarge focused" name="move_name" type="text" autocomplete="off" disabled>
                                   			<button type="button" onclick="popup_d();" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
                                          </div>
                                        </div>

																				
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Qty</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="item_move" type="number" max="0" id="1" autocomplete="off" disabled required> <?=$row->baseunit;?>
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
                </div>
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>