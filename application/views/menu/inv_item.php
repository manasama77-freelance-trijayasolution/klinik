	<?php
		$id = $this->uri->segment(3);
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Data Master Items
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-info">
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
		//window.location.href = "<?php echo base_url();?>inv/inv_item";
		};
		    
		<?php
			$x = 2; 
			while($x <= 13) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function popup_2(){
		  if(document.getElementById('3').readOnly == false){
			document.getElementById('3').readOnly = true;
			window.open("<?php echo base_url();?>inv/find_manufacture","Popup","height=550, width=880, top=70, left=180 ");
		  }else{
			document.getElementById('3').readOnly = false;  
			document.getElementById('3').value = "";
		  }
      }
	  
	  function goBack(){
	  location.reload();
	  }
	  
	  function batch_code(){
	    if(document.getElementById('4').readOnly == false){
		 document.getElementById('4').readOnly = true; 
		 document.getElementById('4').value = "DOESN'T HAVE BATCH CODE!";
		}else{
		 document.getElementById('4').readOnly = false; 
		 document.getElementById('4').value = "";
		}
      }
	  
	  function batch_date(){
		if(document.getElementById('5').disabled == false){
		 document.getElementById('5').disabled = true; 
		 document.getElementById('5').value = "DOESN'T HAVE BATCH DATE!";
		 }else{
		 document.getElementById('5').disabled = false; 
		 document.getElementById('5').value = "";
		}
      }
	  
	  function exp_date(){
		if(document.getElementById('6').disabled == false){
		 document.getElementById('6').disabled = true; 
		 document.getElementById('6').value = "DOESN'T HAVE EXPIRED DATE!";
		 }else{
		 document.getElementById('6').disabled = false; 
		 document.getElementById('6').value = "";
		}
      }
	  
	  function price(){
		if(document.getElementById('10').readOnly == false){
		 document.getElementById('10').readOnly = true; 
		 document.getElementById('10').value = "INPUT LATER !";
		 }else{
		 document.getElementById('10').readOnly = false; 
		 document.getElementById('10').value = "";
		}
      }

      function delete_item(id){
  		var r = confirm("Are You Sure, Delete This Item ?");
		if (r == true) {
			x = window.location = "<?php echo base_url();?>inv/delete_item/"+id+"";
		} else {
			x = "You pressed Cancel!";
		}
      }

      function update_item(id){
      	window.open("<?php echo base_url();?>inv/update_inv_item/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
      }

      function list_item_price(){
      	window.open("<?php echo base_url();?>inv/list_item_price/","","height=610, width=980, top=50, left=210 ");
      }

      function list_item(){
      	window.open("<?php echo base_url();?>inv/list_inv_item/","","height=610, width=980, top=50, left=210 ");
      } 
      
	  function price_item(){
		window.open("<?php echo base_url();?>inv/mst_item_price","Popup","height=610, width=980, top=50, left=210 ");
	  }
	  

	</script>

                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Input Master Item</b></div>
                            </div>	
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button> 										 
							 	<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li>
									<!-- <a href="#" onclick="list_item()" ><i class="icon-th-large"></i> List Item </a> -->
									<a href="<?php echo base_url();?>inv/list_inv_item" target="_blank" ><i class="icon-th-large"></i> List Item </a>
									</li>
									<li><a href="#" onclick="price_item()" ><i class="icon-th-large"></i> Input Item Price</a></li>
									<li>
									<!-- <a href="#" onclick="list_item_price()" ><i class="icon-th-large"></i> List Item Price</a> -->
									<a href="<?php echo base_url();?>inv/list_item_price" target="_blank"  ><i class="icon-th-large"></i> List Item Price</a>
									</li>
									<li><a href="<?php echo base_url();?>inv/list_update_item"><i class="icon-th-large"></i> Approve Update Price Item</a></li>
									<li><a href="<?php echo base_url();?>inv/export_eazy"><i class="icon-th-large"></i> Export Eazy</a></li>
									<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li>
								</ul>
								</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_it" method="post" id="form_sample_1" name="mst_service">
										<div class="alert alert-error hide" style="width: 750px;">
										<button class="close" data-dismiss="alert">&times;</button>
										You have some form errors. Please check below.
										</div>
										
										<div class="alert alert-success hide" style="width: 750px;">
										<button class="close" data-dismiss="alert">&times;</button>
										Your form validation is successful!
										</div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Group <span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_group" id="2" title="Choose Item Group" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($group->result() as $rows){
											  	$wtf = "";
											  	if ($id_item_group == $rows->id_item_group) {
											  		$wtf = "selected";
											  	}
											  ?>
											  <option <?php echo $wtf;?> value="<?=$rows->id_item_group?>" align="justify"  ><?=$rows->item_group?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="2" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Name <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="i_name" type="text" id="3" autocomplete="off" disabled title="Input Item or Search Item." required> <!--<button id="hidden_div" type="button" onclick="popup_2();" class="btn btn-success btn-mini"><i class="icon-search"></i></button> -->
											<span for="3" class="help-inline"></span>
											<input type="hidden" value="0" name="i_manuid">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Batch Code <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="i_batchcode" title="Minimum 5, Maximum 17 Char." pattern=".{5,17}" type="text" id="4" autocomplete="off" disabled required> <button onclick="batch_code();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="4" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Batch Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="5" name="i_batchdate" title="click [<i class='icon-lock'></i>] if doesn't have batch date" type="text"autocomplete="off" disabled required> <button onclick="batch_date();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="5" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Expired Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" name="i_expired" title="click [<i class='icon-lock'></i>] if doesn't have exp. date" type="text" id="6" autocomplete="off" disabled required> <button onclick="exp_date();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="6" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Sales Account<span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_coa" id="77" title="Choose Sales Account." required>
                                              <option value="">- Choose -</option>
											  <option value="0">No Choose</option>
                                              <?php 
											  foreach($accno->result() as $rowss){
											  ?>
												<option value="<?=$rowss->order?>" align="justify"><?=$rowss->id_coa?> - <?=$rowss->desc1?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="77" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Inventory Account<span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_invcoa" id="777" title="Choose Inv Account." required>
                                              <option value="">- Choose -</option>
											  <option value="0">No Choose</option>
                                              <?php 
											  foreach($accno->result() as $rowss){
											  ?>
												<option value="<?=$rowss->order?>" align="justify"><?=$rowss->id_coa?> - <?=$rowss->desc1?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="777" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Cost of Sales Account<span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_costcoa" id="7777" title="Choose Cost of Sales Account." required>
                                              <option value="">- Choose -</option>
											  <option value="0">No Choose</option>
                                              <?php 
											  foreach($accno->result() as $rowss){
											  ?>
												<option value="<?=$rowss->order?>" align="justify"><?=$rowss->id_coa?> - <?=$rowss->desc1?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="7777" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Baseunit <span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_baseunit" id="7" title="Choose Baseunit." required>
                                              <option value="">- Choose -</option>
											  <option value="0">No Choose</option>
                                              <?php 
											  foreach($base->result() as $rows){
											  ?>
												<option value="<?=$rows->id_baseunit?>" align="justify"><?=$rows->baseunit?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="7" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Supplier <span class="required"></span></label>
                                          <div class="controls">
                                            <select class="chzn-select" name="i_supplier" title="Choose Supplier." id="8" required>>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($supplier->result() as $rows){
											  ?>
												<option value="<?=$rows->id_supplier?>" align="justify"><?=$rows->supp_name?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="8" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Warehouse <span class="required"></span></label>
                                          <div class="controls">
                                             <select class="chzn-select" name="i_warehouse" title="Choose Warehouse." id="9" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($warehouse->result() as $rows){
											  ?>
												<option value="<?=$rows->id_warehouse?>" align="justify"><?=$rows->warehouse_name?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="9" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<!--
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Base Price <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge-i focused" title="required, or click [<i class='icon-lock'></i>] to input later." type="text" name="i_price" id="10" style="text-align:right" autocomplete="off" disabled required> <button onclick="price();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="10" class="help-inline"></span>
                                          </div>
                                        </div>
										-->
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remarks</label>
                                          <div class="controls">
											<textarea name="i_remarks" id="10" autocomplete="off" disabled></textarea>
                                       
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
												<input type="submit" class="btn btn-success" value="Save" id="11" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
                                        </div>
										
									</form>
					           						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
    <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
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
	<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
	<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
	<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
	<script>
	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();
        });
    </script>
</html>