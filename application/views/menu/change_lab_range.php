	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Lab Item Range
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
		</div>
	<?php
		}
		//Logic Parameter Button
		foreach ($dodol->result() as $row) {}
	?>		
	<script type="text/javascript">
	  function detail(){
		if(document.getElementById('nya').style.display == "none"){
		document.getElementById('nya').style.display = "";
		document.getElementById('nya1').style.display = "";
		}else{
		document.getElementById('nya').style.display = "none";
		document.getElementById('nya1').style.display = "none";
		}
	  }

	  function undisableTxt(){
		  if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>Lab/mst_lab_range";
		};
		    
		<?php
			$x = 1; 
			while($x <= 11) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			} 
		?>
	  }
	  
	  	function change_pat(b_id){
			var myWindow = window.open("<?php echo base_url();?>lab/change_range/"+b_id, "", "width=1200px, height=500px, top=70, left=80");
		}
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
        window.open("<?php echo base_url();?>patient/find_patient","Popup","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function popup_2(){
       window.open("<?php echo base_url();?>Lab/find_range_lab/","Popup","height=610, width=980, top=50, left=210 ");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>lab/mst_lab_item/edit";
	  }
	  
	  function upload(){
		window.location.href = "<?php echo base_url();?>lab/upload_range";
	  }
	  
	function showDiv(elem){
	var spl = elem.split(":"),
	low 	= spl[1];
		if(low == 1){
			document.getElementById('hidden_div').style.display = "";
			document.getElementById('hidden_div2').style.display = "none";
		}else{
			document.getElementById('hidden_div2').style.display = "";
			document.getElementById('hidden_div').style.display = "none";
		}
	}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Master Lab Item Range</b></div>
                            </div>
								<div class="form-actions">
								 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>   										 
								 <button class="btn btn-warning" onclick="goBack()">Back</button>
								</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>lab/update_item_range" method="post" name="mst_lab">							
										<div class="control-group">
                                          <label class="control-label" for="select01">Lab Item</label>
                                          <div class="controls">
                                          <input  name="id_lab_item_range" value="<?=$row->id_lab_item_range;?>" type="hidden">
                                            <select class="chzn-select" name="lab_item" id="1" required disabled>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($list->result() as $rows){
											  	if ($row->id_lab_item == $rows->id_lab_item) {
											  		$cepot = "selected";
											  	}else{
											  		$cepot = "";
											  	}
											  ?>
												<option value="<?=$rows->id_lab_item?>:<?=$rows->lab_item_case?>" <?=$cepot?> align="justify"><?=$rows->lab_item_desc?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<!-- <input type="checkbox" name="typ" onclick="detail();" value="1" style="height: 18px; width: 18px;"> <b>Detail Item ?</b> -->
                                          </div>
                                        </div>
										<!-- 
										<div class="control-group" id="nya" style="display: none;">
                                          <label class="control-label" for="select01">Detail Item Lab Name</label>
                                          <div class="controls">
												<input class="input-xlarge focused" style="width: 208px;" name="dtl" type="text" autocomplete="off" placeholder=""> <button type="button" onclick="popup_2();" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
                                          </div>
                                        </div>
										
										<div style="display:none;" id="nya1" style="display: none;">			
											<div class="control-group">
											<label class="control-label" for="select01">Standart Value</label>
											<div class="controls">
												<input class="input-xlarge focused" style="width: 208px;" name="std_value" type="text" autocomplete="off" placeholder="">
											</div>
											</div>
										</div> -->
										 
										<div class="control-group">
                                          <label class="control-label" for="select01">Gender</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="pat_gender" id="2" required disabled>
                                              <option value="">- Choose -</option>
											  <option value="yes"> Both </option>
                                              <?php 
											  foreach($gender->result() as $rows){
											  	if ($row->pat_gender == $rows->id_gender) {
											  		$copot = "selected";
											  	}else{
											  		$copot = "";
											  	}
											  ?>
												<option value="<?=$rows->id_gender?>" <?=$copot?> align="justify"><?=$rows->gender?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age Range Between</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" style="width: 90px;" value="<?=$row->age_range_1;?>" name="range_1" type="text" id="3" autocomplete="off" placeholder="Months" disabled> to <input class="input-xlarge focused" style="width: 90px;" name="range_2" value="<?=$row->age_range_2;?>" type="text" id="4" autocomplete="off" placeholder="Months" disabled>
                                          </div>
                                        </div>
										
										<div id="hidden_div2">
										
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Limit Range Between</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" style="width: 90px;" placeholder="Low" name="low_limit" type="text" value="<?=$row->low_limit;?>" id="5" autocomplete="off" disabled > and  <input class="input-xlarge focused" value="<?=$row->high_limit;?>" style="width: 90px;" placeholder="High" name="high_limit" type="text" id="6" autocomplete="off" disabled>
                                          </div>
                                        </div>
									
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Extreme Range Between</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" style="width: 90px;" name="min_limit" placeholder="Low Min" type="text" id="7" value="<?=$row->min_limit;?>" autocomplete="off" disabled> and <input class="input-xlarge focused" style="width: 90px;" value="<?=$row->max_limit;?>" name="max_limit" placeholder="High Max" type="text" id="8" autocomplete="off" disabled>
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
												<input type="submit" class="btn btn-success" id="9" onclick="this.disabled=true;this.form.submit();" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
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