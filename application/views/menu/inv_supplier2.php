	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Patient
		</div>
	<?php
		} else if ($id=="add") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Add New User
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete User
		</div>
	<?php
		}
		//Logic Parameter Button
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
		<?php
			$x = 1; 
			while($x <= 13) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  function goBack() {
	  	window.history.back();
	  }
	  
	  function fetch_select(val){
		$.ajax({
			type: 'post',
			url: 'fetch_prov',
			data: {
			get_option:val
			},
			success: function (response) {
			document.getElementById("new_select").innerHTML=response; 
			}
		});
	  }

</script>
<?php
	if(empty($_SESSION["regsession"])){
	$reg_form = "patient/data_patient";		
	}else{
	$reg_form = $_SESSION["regsession"];
	}
	//echo $reg_form;
	include './design/koneksi/file.php';
	$query 		="SELECT pat_mrn id,cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";  
    if($result 	=mysqli_query($con, $query))
    {
		//$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$counts	=substr($count, 1, strlen($count)-1);
		//$dater 	=$row['dt'];
		//if ($dater == $date) {
		$counts = $counts+1; 	
		//}else{
		//	$count = 1;
		//}		
        $code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);
    }
?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>New Patient</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
																  
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button>									 
							<button class="btn btn-warning btn-large" onclick="goBack()"><b>Back</b></button>
							</div>
										 
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<div id="" style="overflow-y: scroll; height:460px;">
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_sp" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Supplier Code</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="s_code" type="text" id="1" autocomplete="off" disabled required>
                                          </div>
                                        </div>
									
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_name" type="text" id="3" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp" type="text" id="2" autocomplete="off" disabled required>
                                          </div>
                                        </div>
															
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Balance</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp" type="text" id="10" autocomplete="off" value="0" disabled required>
                                          </div>
                                        </div>
															
                                        <div class="control-group">
                                          <label class="control-label" for="">Date of The Balance</label>
											<div class="controls">
                                            <input type="text" name="reg_date" class="input-large datepicker" id="11" value="<?php echo date("m/d/Y");?>" disabled><readonly button class="btn-mini tooltip-right" data-original-title="Date of Registration adalah tanggal kunjungan pasien pada hari ini, namun bisa disesuaikan tanggalnya."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address</label>
                                          <div class="controls">
										  <textarea name="s_address" id="4" disabled></textarea>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="select01">Province</label>
                                          <div class="controls">
                                            <select id="12" name="pat_province" onchange="fetch_select(this.value);"  disabled>
                                              <option value="0"> Choose </option>
                                              <?php 
											  foreach($province->result() as $rows){
											  ?>
												<option value="<?=$rows->provinsi_id?>" align="justify"><?=$rows->provinsi_nama;?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">City</label>
                                          <div class="controls" id="new_select">                  
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="">Patient Nationality</label>
                                          <div class="controls">
                                            <select id="13" name="pat_nationality" style="width:285px" disabled>
                                              <option value="0"> Choose </option>
                                              <?php 
											  foreach($national->result() as $rows){
											  ?>
												<option value="<?=$rows->id_nationality?>" align="justify"><?=$rows->nationality?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_contact" type="text" id="5" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Mobile Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_phone" type="text" id="6" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Finance Contact</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="f_phone" type="text" id="8" autocomplete="off" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Marketing Contact</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="m_phone" type="text" id="9" autocomplete="off" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Term of Payment</label>
                                          <div class="controls">
										   <input class="input-mini focused" name="t_pay" type="number" id="7" autocomplete="off" disabled required> Day(s).
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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										</div>
									                        
									<legend></legend>
									</form>
									</fieldset>                     						
                                </div>
                            </div>
							<div class="form-actions">
							<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
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
		<?php
		mysqli_close($con);
		?>
</html>