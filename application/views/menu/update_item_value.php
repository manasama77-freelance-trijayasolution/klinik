	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Services
		</div>
	<?php
		}elseif($id=="upd"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Master Services
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
	?>
	<script>
	  function undisableTxt(){
		document.getElementById('zz').disabled = false;
		document.getElementById('cv').disabled = false;
		document.getElementById('yy').readOnly = false;
		document.getElementById('xx').readOnly = false;
		document.getElementById('ee').disabled = false;
		document.getElementById('curr').disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup_2(id){
        window.open("<?php echo base_url();?>docter/find_services_2/"+id+"","Popup","height=550, width=880, top=70, left=250 ");
      }
	  
	  function popup_3(id){
        window.open("<?php echo base_url();?>docter/find_services_2/"+id+"","Popup","height=550, width=880, top=70, left=250 ");
      }
	  
	  function popup_4(id){
        window.open("<?php echo base_url();?>docter/find_services_2/"+id+"","Popup","height=550, width=880, top=70, left=250 ");
      }
	
	function showDiv(elem){
	var spl = elem.split(":"),
	low 	= spl[0];
	//alert(low)
		if(low == 0){
			document.getElementById('hidden_div').style.display = "";
			document.getElementById('hidden_div_2').style.display = "none";
			document.getElementById('hidden_div_3').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=1;
		}else if(low == 3){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_2').style.display = "";
			document.getElementById('hidden_div_3').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=2;
		}else if(low == 10){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_2').style.display = "none";
			document.getElementById('hidden_div_3').style.display = "";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=10;
		}else{
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('xx').readOnly = false;
			document.forms['mst_service'].elements['serv_typ'].value=0;
			document.forms['mst_service'].elements['serv_id'].value=0;
		}
	}
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;
	}


    function update_service(id){
		window.open("<?php echo base_url();?>marketing/update_mst_service/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    }

	  function list_item_value(){
		window.open("<?php echo base_url();?>docter/list_item_value","","height=550, width=880, top=70, left=250 ");
	  }
	  

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Update Item Value</b></div>
                            </div>
							
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<form class="form-horizontal" action="<?php echo base_url();?>docter/process_update_item_value" method="post" name="mst_service">
										<input type='hidden' name='count_ant' value='1'>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Group Services</label>
                                          <div class="controls">
                                              <select class="chzn-select" onchange="showDiv(this.value)" name="grp_services" id="zz" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($sv_group->result() as $rows){
											  	if ($id_group_serv == $rows->id_serv_group) {
											  		$uuu = "selected";
											  	}else{
											  		$uuu = "";
											  	}

											  ?>
												<option value="<?=$rows->id_serv_group?>:<?=$rows->group_seq_no?>" align="justify" <?=$uuu;?>  ><?=$rows->group_desc?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                              <input type="hidden" name="id_item_value" value="<?=$id_item_value;?>">
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Gender</label>
                                          <div class="controls">
                                              <select class="chzn-select" name="gender" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($gender->result() as $rows){
											  	if ($jk == $rows->gender) {
											  		$aaaa = "selected";
											  	}else{
											  		$aaaa = "";
											  	}

											  ?>
												<option value="<?=$rows->id_gender?>" align="justify" <?=$aaaa;?> ><?=$rows->gender?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Name</label>
                                          <div class="controls">
                                            <input name="serv_name" value="<?=$serv_name;?>" type="text" id="xx" autocomplete="off" readonly required> <button id="hidden_div" type="button" onclick="popup_2(0);" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button><button id="hidden_div_2" type="button" onclick="popup_3(3);" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button> <button id="hidden_div_3" type="button" onclick="popup_4(10);" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button>
                                          </div>
                                        </div>

										<input name="serv_id" type="hidden" value="<?=$id_service;?>" autocomplete="off">
										<input name="serv_typ" type="hidden"  value="0" autocomplete="off">


										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Value</label>
										  	<div class="controls">
										  	<div id="dynamicInput">		
										    <input class="input-xlarge-i focused" name="nama_val_1" value="<?=$nama_value;?>" type="text" autocomplete="off" style="text-align:left">
											Age
											<input class="input-xlarge-i focused" name="range_1_1"  value="<?=$range_age_1;?>" type="text" autocomplete="off" style="text-align:left; width:50px;">
											Until
											<input class="input-xlarge-i focused" name="range_2_1"  value="<?=$range_age_2;?>" type="text" autocomplete="off" style="text-align:left; width:50px;">
											
											</br>
											</br>
											
											Limit Min.
											<input class="input-xlarge-i focused" name="limit_1_1"  value="<?=$limit_1;?>" type="text" autocomplete="off" style="text-align:left; width:50px;">
											Limit Max.
											<input class="input-xlarge-i focused" name="limit_2_1"  value="<?=$limit_2;?>" type="text" autocomplete="off" style="text-align:left; width:50px;">
											Unit.
											<input name="unit_1" type="text" id="unit_1" value="<?=$unit;?>" required> 
											</br>											  
										  	</div>
											</br>	
				
										  	<!-- <input style="width:355px;" class="btn btn-success btn-mini" id="butt" type="button" value="Add Value" onClick="addInput('dynamicInput');">		 -->
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
												<input type="submit" class="btn btn-success" value="Save" id="ee">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Update</a>
										<!-- <button class="btn btn-warning" type="reset">Reset</button> -->
                                        </div>		
									<legend></legend>
									</form>
									</fieldset>                     						
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