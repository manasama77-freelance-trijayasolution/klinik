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
	?>
	<script>
	  function undisableTxt(){
		document.getElementById('zz').disabled = false;
		document.getElementById('cv').disabled = false;
		document.getElementById('ee').disabled = false;
		document.getElementById('curr').disabled = false;
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
                                          <label class="control-label" for="focusedInput">Group Services</label>
                                          <div class="controls">
                                              <select onchange="fetch_select(this.value);" name="grp_services" id="zz" disabled required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($sv_group->result() as $rows){
											  ?>
												<option value="<?=$rows->id_item_group?>" align="justify"><?=$rows->item_group?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
										  </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Items Name</label>
                                          <div class="controls" id="new_select">                  
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Branch</label>
                                          <div class="controls">
                                              <select name="branch" id="cv" disabled required>
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
										<script>
										  var counter_ant 	= 2;
										  var limit_ant	 	= 20;
										  function addInput(divName){
										  	if (counter_ant == limit_ant)  {
										  		alert("Sorry, you have only " + counter_ant + " inputs");
										  	}
										  	else {
										  		var newdiv = document.createElement('div');
										  		newdiv.innerHTML = "<select name='curr_type_"+counter_ant+"' id='curr' style='width: 128px;' required><option value=''>- Currency -</option><option value='IDR'>IDR </option><option value='USD'>USD</option><option value='JPY'>JPY</option></select> <input type='text' style='text-align:right;' onchange='setBlurFocus("+counter_ant+");' class='input-xlarge-i focused' name='price_"+counter_ant+"' id='"+counter_ant+"b' autocomplete='off'> <select style='width: 160px;'   name='type_"+counter_ant+"'><option value=''>- Type -</option><?php foreach($pay_type->result() as $rows){ ?> <option value='<?=$rows->id_price_type?>' align='justify'><?=$rows->price_type?></option><?php } ?></select><input type='hidden' name='count_ant' value='"+counter_ant+"'>";
										  		document.getElementById(divName).appendChild(newdiv);
										  		counter_ant++;
										  	}
										  }
										</script>
										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Price</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
											<select name="curr_type_1" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
										    <!-- <input class="input-xlarge-i focused" name="price_1" onchange="setBlurFocus(0);" type="text" id="0b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_1"  type="text" id="0b" autocomplete="off" style="text-align:right">
											<select   name="type_1" id="tae" style="width: 160px;">
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="1"){ echo "selected";} ?>  align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>
										  	</div>

											<label class="control-label" for="typeahead">Price</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
											<select name="curr_type_2" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
									<!-- 	    <input class="input-xlarge-i focused" name="price_2" onchange="setBlurFocus(1);" type="text" id="1b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_2" type="text" id="1b" autocomplete="off" style="text-align:right">
											<select   name="type_2" id="tae" style="width: 160px;"
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="2"){ echo "selected";} ?>  align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>
										  	</div>
											
											<label class="control-label" for="typeahead">Price</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
											<select name="curr_type_3" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
								<!-- 		    <input class="input-xlarge-i focused" name="price_3" onchange="setBlurFocus(2);" type="text" id="2b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_3"  type="text" id="2b" autocomplete="off" style="text-align:right">
											<select   name="type_3" id="tae" style="width: 160px;"
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="3"){ echo "selected";} ?>  align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>
										  	</div>
											
											<label class="control-label" for="typeahead">Price</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
											<select name="curr_type_4" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
										<!--     <input class="input-xlarge-i focused" name="price_4" onchange="setBlurFocus(3);" type="text" id="3b" autocomplete="off" style="text-align:right"> -->
										    <input class="input-xlarge-i focused" name="price_4"  type="text" id="3b" autocomplete="off" style="text-align:right">
											<select   name="type_4" id="tae" style="width: 160px;"
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="5"){ echo "selected";} ?>  align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
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
												<input type="submit" class="btn btn-success" value="Save" id="ee" disabled>
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