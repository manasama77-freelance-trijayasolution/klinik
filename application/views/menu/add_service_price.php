	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Services
		</div>
	<?php
	}
	?>
	<script>
	  function undisableTxt() {
		<?php
			$x = 1; 
			while($x <= 6) {
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
	  
	function showDiv(elem){
	var spl = elem.split(":"),
	low 	= spl[0];
	//alert(low)
		if(low == 1){
			document.getElementById('hidden_div').style.display = "";
			document.getElementById('hidden_div_2').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=1;
		}else if(low == 2){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_2').style.display = "";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=2;
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
		var user_input = accounting.formatMoney(document.getElementById('4').value);
		document.getElementById('4').value = user_input;
	}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Update Master Services</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<div class="form-actions">
									<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button>	
										<hr></hr>									
									<form class="form-horizontal" action="<?php echo base_url();?>marketing/insert_service_price" method="post" name="mst_service">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Group Services</label>
                                          <div class="controls">
                                          <input type="hidden" name="id_service" value="<?=$id_service;?>">
                                          <input type="hidden" name="id_group_serv" value="<?=$id_group_serv;?>">
                                          <input type="text" name="group_desc" value="<?=$group_desc;?>" readonly >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Branch</label>
                                          <div class="controls">
                                              <select class="chzn-select" name="branch" id="1" disabled required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($branch->result() as $rows){
											  	$sbranch = "";
											  	if ($id_branch == $rows->kode_branch) {
											  		$sbranch = "selected";
											  	}
											  ?>
												<option  <?php echo $sbranch;?>  value="<?=$rows->kode_branch?>" align="justify"><?=$rows->nama_branch?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Name</label>
                                          <div class="controls">
                                            <input name="serv_name" value="<?=$serv_name;?>" type="text" id="xx" autocomplete="off" readonly required> <button id="hidden_div" type="button" onclick="popup_2();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button><button id="hidden_div_2" type="button" onclick="popup_3();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button>
                                          </div>
                                        </div>
										
										<input name="serv_id" type="hidden" value="0" autocomplete="off">
										<input name="serv_typ" type="hidden"  value="0" autocomplete="off">

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Code</label>
                                          <div class="controls">
                                            <input  name="serv_code" type="text" id="2" autocomplete="off" value="<?=$serv_code;?>" disabled required>
                                          </div>
                                        </div>

										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Price</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
											<select class="chzn-select" name="curr_type_1" id="3" style="width: 128px;"  disabled required>
											  <option value="">- Currency -</option>
											  <option value="IDR">IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
											
										    <input class="input-xlarge-i focused" name="price_1" value="0" onchange="setBlurFocus(0);" type="text" id="4" autocomplete="off" style="text-align:right" disabled>
												
											<select class="chzn-select"  name="type_1" id="5" style="width: 160px;" disabled>
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  	$stype = "";
											  	if ($price_type == $rows->id_price_type) {
											  		$stype = "selected";
											  	}
											  ?>
												<option <?php echo $stype;?> value="<?=$rows->id_price_type?>" align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
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
												<input type="submit" class="btn btn-success" onclick="this.disabled=true;this.form.submit();" value="Save" id="6" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
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
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>