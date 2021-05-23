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
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		}elseif($id=="del"){
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
	  
	  function price_item(){
		window.open("<?php echo base_url();?>inv/mst_item_price","Popup","height=610, width=980, top=50, left=210 ");
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
	<script type="text/javascript" src="http://rawgit.com/BobKnothe/autoNumeric/master/autoNumeric.js"></script>
	<script type="text/javascript">
	jQuery(function($) {
		$('.input-xlarge-i').autoNumeric('init');
	});
	</script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Input Master Item</b></div>
                            </div>	
										
                            <div class="block-content collapse in">
                                <div class="span12">   
                                	<div style="overflow-y: auto; height:auto;">        
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_it2" method="post" id="form_sample_1" name="mst_service">
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
											  ?>
											  <option value="<?=$rows->id_item_group?>" align="justify"><?=$rows->item_group?></option>
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
                                          	<input type="hidden" name="id_item_request_d" value="<?=$id_request;?>">
                                            <input class="input-xlarge focused" name="i_name" type="text" id="3" value="<?php echo urldecode($name_item);?>" autocomplete="off" readonly title="Input Item or Search Item." required> <span for="3" class="help-inline"></span>
											<input type="hidden" value="0" name="i_manuid">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Batch Code <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="i_batchcode" title="Minimum 5, Maximum 17 Char." pattern=".{5,17}" type="text" id="4" autocomplete="off"  required> <button onclick="batch_code();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="4" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Batch Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="5" name="i_batchdate" title="click [<i class='icon-lock'></i>] if doesn't have batch date" type="text"autocomplete="off"  required> <button onclick="batch_date();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="5" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Expired Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" name="i_expired" title="click [<i class='icon-lock'></i>] if doesn't have exp. date" type="text" id="6" autocomplete="off"  required> <button onclick="exp_date();"  type="button" class="btn btn-info btn-mini"><i class="icon-lock"></i></button>
											<span for="6" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Baseunit <span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_baseunit" id="7" title="Choose Baseunit." required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($base->result() as $rows){
                                              $checked = "";
                                              if (strtoupper($baseunit) == strtoupper($rows->baseunit)){$checked = "selected";}
											  ?>
												<option align="justify" value="<?=$rows->id_baseunit?>" <?php echo $checked;?> ><?=$rows->baseunit?> </option>
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
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remarks</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="i_remarks" type="text" id="10" autocomplete="off" required >
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
												<input type="submit" class="btn btn-success" value="Save" id="11">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
                                        </div>
									</form>
									
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Item List</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-file"></i> Export Data <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1">Excel</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                          	<tr>
												<th>No</th>
												<th>Group</th>
												<th>Name</th>
												<th>Supplier</th>
												<th>Batch Code</th>
												<th>Baseunit</th>
												<th>Action</th>
											</tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->item_group;?></td>
												<td><?php echo $row->item_name;?></td>		
												<td><?php echo $row->supp_name;?></td>			
												<td><?php echo $row->batch_code;?></td>	
												<td><?php echo $row->baseunit;?></td>
												<td></td>
											</tr>
										</form>
										<?php
										}
										?>
                                        </tbody>
                                   </table>
								   </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>             					

                                	</div>
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