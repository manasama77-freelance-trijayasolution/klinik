		
	<script>
	  function undisableTxt(){
		    
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

      
	</script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Approve Item Request</b></div>
                            </div>	
								 <div class="form-actions">
								 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
								 <button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>	
								 </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
										<form class="form-horizontal" action="<?php echo base_url();?>inv/update_item_request" method="post" id="form_sample_1" name="mst_service">
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
                                            <input name="id_item" value="<?=$id_item;?>" type="hidden" id="id_item" > 
                                            <input class="input-xlarge focused" name="i_name" value="<?=$item_name;?>" type="text" id="3" autocomplete="off" disabled title="Input Item or Search Item." required> 
											<input type="hidden" value="0" name="i_manuid">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Batch Code <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="i_batchcode" title="Minimum 5, Maximum 17 Char." pattern=".{5,17}" type="text" id="4" autocomplete="off" value="<?=$batch_code;?>" disabled required> <button onclick="batch_code();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="4" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Batch Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="5" name="i_batchdate" title="click [<i class='icon-lock'></i>] if doesn't have batch date" type="text" autocomplete="off" disabled required value="<?=$batch_date;?>"> <button onclick="batch_date();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="5" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Expired Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" name="i_expired" title="click [<i class='icon-lock'></i>] if doesn't have exp. date" type="text" id="6" autocomplete="off" disabled required value="<?=$expired_date;?>"> <button onclick="exp_date();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
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
                                              <?php 
											  foreach($base->result() as $rows){
											  	$sbaseunit = "";
											  	if ($baseunit == $rows->id_baseunit) {
											  		$sbaseunit = "selected";
											  	}
											  ?>
												<option  align="justify" value="<?=$rows->id_baseunit?>" <?php echo $sbaseunit;?> ><?=$rows->baseunit?></option>
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
                                            <select class="chzn-select" name="i_supplier" title="Choose Supplier." id="8">
                                              <option value="0">- Choose -</option>
                                              <?php 
											  foreach($supplier->result() as $rows){
											  	$ssuplier = "";
											  	if ($supplier_id == $rows->id_supplier) {
											  		$ssuplier = "selected";
											  	}
											  ?>
												<option align="justify" value="<?=$rows->id_supplier?>" <?php echo $ssuplier;?> ><?=$rows->supp_name?></option>
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
											  	$swarehouse = "";
											  	if ($warehouse_id == $rows->id_warehouse) {
											  		$swarehouse = "selected";
											  	}
											  ?>
												<option align="justify" value="<?=$rows->id_warehouse?>"  <?php echo $swarehouse;	?> ><?=$rows->warehouse_name?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="9" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remarks</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="i_remarks" type="text" id="10" autocomplete="off" disabled value="<?=$item_remarks;?>">
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Stock</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="item_curr_qty" type="text" id="12" autocomplete="off" disabled value="<?=$item_curr_qty;?>" >
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
											<div style="float:left;">
			                                    <button type="submit" class="btn btn-success" name="btn" id="btn" value="app"><b>Approve</b></button>
											</div>
											<div style="float:right;">
			                                    <button type="submit" name="btn" id="btn" class="btn btn-danger" value="dec"><b>Decline</b></button>
											</div>
                                		</div>

                                        </div>
									</form>
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