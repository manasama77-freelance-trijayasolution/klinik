<?php
$id 	= $this->uri->segment(3);
// $min 	= $Price + 1; 
if ($id=="ok"){
?>
    <div class="alert alert-success">
		 <button class="close" data-dismiss="alert">&times;</button>
		 <strong>Success!</strong> Update Item Price
	</div>
<?php
}
?>
	<script>
	  function undisableTxt(){
		document.getElementById('baru2').disabled 			= false;
		document.getElementById('code_item').required 		= true;
		document.getElementById('ee').disabled 				= false;
		document.getElementById('code_item').disabled 		= false;
	  }
	 
	  function goBack(){
	  	window.history.back();
	  }

	  function approvelebih(){
	  	var lama = document.getElementById('lama');
	  	var baru = document.getElementById('baru');

	  	if (lama.value > baru.value) {
	  		if(!confirm('Is the form filled out correctly ?')){
	  			return false;
	  		}
	  	}

	  }

	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});

	function setBlurFocus(id, copy) {
		document.getElementById(copy).value = document.getElementById(id).value;
		var user_input = accounting.formatMoney(document.getElementById(id).value);
		document.getElementById(id).value = user_input;
	}

	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Update Master Item Price</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<div class="form-actions">
                                    <button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>	

									<button onclick="undisableTxt()" class="btn btn-primary">Start</button>
									</div>
									<!-- Fungsi validasi saat submit
									onSubmit="if (document.getElementById('lama').value > document.getElementById('baru').value) { if(!confirm('Is the form filled out correctly ?')){return false;}}" -->
									<form class="form-horizontal" action="<?php echo base_url();?>inv/save_update_item_price" method="post" name="mst_service">
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Items code</label>
                                          <div class="controls">          
                                          	 <input type="hidden" name="id_harga" value="<?=$id;?>">
                                          	 <input type="hidden" name="id_price" value="<?=$id_price;?>">
                                             <input type="hidden" name="id_item" value="<?=$id_item;?>">
                                             <input type="hidden" name="price_type" value="<?=$price_type;?>">        
                                             <input type="text" name="code_item" id="code_item" value="<?=$code_item;?>" disabled required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Items Name</label>
                                          <div class="controls">                  
                                             <input type="text" name="item_name" value="<?=$item_name;?>" readonly>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Price</label>
                                          <div class="controls">
                                             <input type="text" id="xlama" name="xlama" value="<?=number_format($Price,2);?>" readonly>
                                             <input type="hidden" id="lama" name="lama" value="<?=$Price;?>" >
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Price New</label>
                                          <div class="controls">
                                             <input type="text" name="baru2" id="baru2" onchange="setBlurFocus('baru2','baru')" disabled>
                                             <input type="hidden" name="baru" id="baru" value="<?=$Price;?>">
                                             <!-- <input type="number" min="<?=$min;?>" name="baru" id="baru" disabled> -->
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
												<input type="submit" class="btn btn-success" value="Save" id="ee" disabled>
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
		<!--/.fluid-container-->
    <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
    <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
	<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
	<script>
	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
        $(function() {
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();
        });
    </script>
</html>