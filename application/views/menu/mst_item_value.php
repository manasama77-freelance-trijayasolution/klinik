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
	  
	  function find_services(){
	  	var id = document.getElementById('id_serv_group').value;
        window.open("<?php echo base_url();?>docter/find_services_2/"+id+"","Popup","height=550, width=880, top=70, left=250 ");
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
	  
	  function popup_5(id){
        window.open("<?php echo base_url();?>docter/find_services_2/"+id+"","Popup","height=550, width=880, top=70, left=250 ");
      }
	  
	  function popup_nama(id){
        window.open("<?php echo base_url();?>docter/list_item_value_input/"+id+"","_blank","height=550, width=880, top=70, left=250 ");
      }
	
	function showDiv(elem){
		var spl 			= elem.split(":"),
		low 				= spl[0];
		var grp_services 	= document.getElementById('zz').value;
		document.getElementById('id_serv_group').value = low;
		// alert(low)

		if(grp_services == 'xx'){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=0;
			document.forms['mst_service'].elements['serv_id'].value=0;
		}else{
			document.getElementById('hidden_div').style.display = "";
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
		window.open("<?php echo base_url();?>docter/list_item_value","","height=550, width=950, top=70, left=250 ");
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
                            <div class="muted pull-left"><b>Master Item Value</b></div>
                            </div>
							<div class="form-actions">
							<!--
							<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button>		
							-->
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>docter/list_item_value_input" target="_blank" ><i class="icon-list-alt"></i> List Item Value</a></li>
							 </ul>
							</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<form class="form-horizontal" action="<?php echo base_url();?>docter/save_item_value" method="post" name="mst_service">
										<input type='hidden' name='count_ant' value='1'>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Group Services</label>
                                          <div class="controls">
											  <input type='hidden' name='id_serv_group' id="id_serv_group" >
                                              <select class="chzn-select" onchange="showDiv(this.value)" name="grp_services" id="zz" required>
                                              <option value="xx">- Choose -</option>
                                              <?php 
											  foreach($sv_group->result() as $rows){
											  ?>
												<option value="<?=$rows->id_serv_group?>:<?=$rows->group_seq_no?>" align="justify"><?=$rows->group_desc?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Gender</label>
                                          <div class="controls">
                                              <select class="chzn-select" name="gender" required>
                                              <option value="">- Choose -</option>
											  <option value="yes">- Both -</option>
                                              <?php 
											  foreach($gender->result() as $rows){
											  ?>
												<option value="<?=$rows->id_gender?>" align="justify"><?=$rows->gender?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Name</label>
                                          <div class="controls">
                                            <input name="serv_name" onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" type="text" id="xx" autocomplete="off" readonly required> 
                                            <button id="hidden_div" type="button" onclick="find_services();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button>
                                          </div>
                                        </div>

										<input name="serv_id" type="hidden" value="0" autocomplete="off">
										<input name="serv_typ" type="hidden"  value="0" autocomplete="off">

										  <script>
										  var counter_ant 	= 2;
										  var limit_ant	 	= 20;
										  function addInput(divName){
										  	if (counter_ant == limit_ant)  {
										  		alert("Sorry, you have only " + counter_ant + " inputs");
										  	}
										  	else {
										  		var newdiv = document.createElement('div');
										  		newdiv.innerHTML = "<hr></hr><input type='hidden' name='count_ant' value="+counter_ant+" ><input class='input-xlarge-i focused' placeholder='Value Name' name='nama_val_" + counter_ant + "' type='text' autocomplete='off' style='text-align:left' required> Age <input placeholder='Month' class='input-xlarge-i focused' name='range_1_" + counter_ant + "' type='text' autocomplete='off' style='text-align:left; width:50px;' required> Until <input placeholder='Month' class='input-xlarge-i focused' name='range_2_" + counter_ant + "' type='text' autocomplete='off' style='text-align:left; width:50px;' required> </br></br> Limit Min. <input placeholder='range' class='input-xlarge-i focused' name='limit_1_" + counter_ant + "' type='text' autocomplete='off' style='text-align:left; width:50px;' required> Limit Max. <input placeholder='range' class='input-xlarge-i focused' name='limit_2_" + counter_ant + "' type='text' autocomplete='off' style='text-align:left; width:50px;' required> Unit. <input name='unit_" + counter_ant + "' type='text' id='unit_" + counter_ant + "' required> ";
										  		document.getElementById(divName).appendChild(newdiv);
										  		counter_ant++;
										  	}
										  }
										  </script>

										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Value</label>
										  	<div class="controls">
										  	<div id="dynamicInput">		
										    <input class="input-xlarge-i focused" name="nama_val_1" placeholder='Value Name' type="text" autocomplete="off" style="text-align:left">
											
											Age
											<input class="input-xlarge-i focused" name="range_1_1"  placeholder='Month' type="text" autocomplete="off" style="text-align:left; width:50px;">
											Until
											<input class="input-xlarge-i focused" name="range_2_1"  placeholder='Month' type="text" autocomplete="off" style="text-align:left; width:50px;">
											
											</br>
											</br>
											
											Limit Min.
											<input class="input-xlarge-i focused" name="limit_1_1"  placeholder='range' type="text" autocomplete="off" style="text-align:left; width:50px;">
											Limit Max.
											<input class="input-xlarge-i focused" name="limit_2_1"  placeholder='range' type="text" autocomplete="off" style="text-align:left; width:50px;">
											Unit.
											<input name="unit_1" type="text" id="unit_1" required> 
											</br>
											</br>	
										  	</div>
											</br>

										  	<input style="width:355px;" class="btn btn-success btn-mini" id="butt" type="button" value="Add Value" onClick="addInput('dynamicInput');">		
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
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
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