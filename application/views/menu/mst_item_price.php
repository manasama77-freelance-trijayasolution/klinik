	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Items Price
		</div>
	<?php
	}
	if ($id=="ok" || $id=="reg"){
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
		window.location.href = "<?php echo base_url();?>inv/mst_item_price";
		};
		    
		<?php
			$x = 4; 
			while($x <= 8) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	 
	  function goBack(){
	  	window.history.back();
	  }
	  function popup_2(){
        window.open("<?php echo base_url();?>patient/find_lab","Popup","height=550, width=880, top=70, left=250 ");
      }
	  function popup_3(){
        window.open("<?php echo base_url();?>patient/find_radiology","Popup","height=550, width=880, top=70, left=250 ");
      }
	  function list_service(){
		window.open("<?php echo base_url();?>marketing/list_service","Popup","height=550, width=880, top=70, left=250 ");
	  }
	  function fetch_select(val){
		$.ajax({
			type: 'post',
			url: 'fetch_item',
			data: {
			get_option:val
			},
			success: function (response) {
			document.getElementById("new_select").innerHTML=response; 
			}
		});
	  }
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;
	}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Master Item Price</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<div class="form-actions">
									<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button>
									</div>
									<form class="form-horizontal" action="<?php echo base_url();?>inv/save_mst_items_price2" method="post" name="mst_service">
                                 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Items Name</label>
                                          <div class="controls">
                                          <select  class="chzn-select" name="id_item" id="2" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($item_all->result() as $rows){
											  ?>
											  <option value="<?=$rows->id_item?>" align="justify"><?=$rows->item_name?></option>
											  <?php
											  }
											  ?>
                                              </select>     
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Branch</label>
                                          <div class="controls">
                                              <!-- <select name="branch" id="cv" disabled required> -->
                                               <select class="chzn-select" name="branch" id="3"  required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($branch->result() as $rows){
											  ?>
											  <option value="<?=$rows->kode_branch?>" align="justify"><?=$rows->nama_branch?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>
										
										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Base / Employee</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_1" value="IDR">
										    <!-- <input class="input-xlarge-i focused" name="price_1" onchange="setBlurFocus(0);" type="text" id="0b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_1"  type="text" id="4" autocomplete="off" style="text-align:right" disabled required >
                                            <input type="hidden" name="type_1" value="1">
											</br>											  
										  	</div>
											</br>
										  	</div>

											<label class="control-label" for="typeahead">Normal / Local</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_2" value="IDR">
									<!-- 	    <input class="input-xlarge-i focused" name="price_2" onchange="setBlurFocus(1);" type="text" id="1b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_2" type="text" id="5" autocomplete="off" style="text-align:right" disabled required>
                                            <input type="hidden" name="type_2" value="2">
											</br>											  
										  	</div>
											</br>
										  	</div>
											
											<label class="control-label" for="typeahead">Insurance / Japanese</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_3" value="IDR">
								<!-- 		    <input class="input-xlarge-i focused" name="price_3" onchange="setBlurFocus(2);" type="text" id="2b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_3"  type="text" id="6" autocomplete="off" style="text-align:right" disabled required>
                                            <input type="hidden" name="type_3" value="3">
											</br>											  
										  	</div>
											</br>
										  	</div>
											
											<label class="control-label" for="typeahead">Company / Japanese Non Insurance</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_4" value="IDR">
										<!--     <input class="input-xlarge-i focused" name="price_4" onchange="setBlurFocus(3);" type="text" id="3b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_4"  type="text" id="7" autocomplete="off" style="text-align:right" disabled required>
                                            <input type="hidden" name="type_4" value="5">
											</br>											  
										  	</div>
											</br>
										  	</div>
											
										  </div>
										  
											<!--
												<input style="width:517px;" class="btn btn-success btn-mini" id="butt" disabled type="button" value="Add Price" onClick="addInput('dynamicInput');">
											-->										  
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="Save" id="8" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
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