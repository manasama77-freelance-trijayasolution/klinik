	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Supplier
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Supplier
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Supplier
		</div>
	<?php
		}
	?>		
	<script>
	  function undisableTxt(){	    
		<?php
			$x = 1; 
			while($x <= 19) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Update Master Supplier</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/process_update_supplier" method="post" name="mst_service">
																			
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Supplier Code</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="id_supplier" type="hidden" value="<?=$id_supplier;?>">
										  <input class="input-xlarge focused" name="s_code" type="text" id="1" autocomplete="off" value="<?=$supp_code;?>" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_name" type="text" id="2" autocomplete="off" value="<?=$supp_name;?>" disabled required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address1</label>
                                          <div class="controls">
										  <textarea name="s_address" id="3" disabled required><?=$supp_address1;?></textarea>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address2</label>
                                          <div class="controls">
										  <textarea name="s_address2" id="4" disabled required><?=$supp_address2;?></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Province</label>
                                          <div class="controls">
                                            <select id="5" name="pat_province"  disabled required>
                                              <option value=""> Choose </option>
                                              <?php 
											  foreach($province->result() as $rows){
											  	if ($supp_province == $rows->provinsi_nama) {
											  		$xxx = "selected";
											  	}else{
											  		$xxx = "";
											  	}
											  ?>
												<option value="<?=$rows->provinsi_nama?>" align="justify" <?=$xxx;?> ><?=$rows->provinsi_nama;?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="">City</label>
                                          <div class="controls">
                                            <select id="6" name="city" style="width:285px" disabled required>
                                              <option value="">Choose</option>
                                              <?php 
											  foreach($city->result() as $rows){
											  	if ($supp_city == $rows->nama_kota) {
											  		$aaaa = "selected";
											  	}else{
											  		$aaaa = "";
											  	}
											  ?>
												<option value="<?=$rows->nama_kota?>" align="justify" <?=$aaaa;?> ><?=$rows->nama_kota?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>


										<div class="control-group">
                                          <label class="control-label" for="">Patient Nationality</label>
                                          <div class="controls">
                                            <select id="7" name="pat_nationality" style="width:285px" disabled required>
                                              <option value="">Choose</option>
                                              <?php 
											  foreach($national->result() as $rows){
											  	if ($supp_nationality == $rows->nationality) {
											  		$oooo = "selected";
											  	}else{
											  		$oooo = "";
											  	}
											  ?>
												<option value="<?=$rows->nationality?>" align="justify" <?=$oooo;?> ><?=$rows->nationality?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Zip Code</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="zipcode" type="text" id="8" maxlength="5" autocomplete="off" value="<?=$supp_pos_code;?>" disabled required>
                                          </div>
                                        </div>
												
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="phone" type="text" id="9" autocomplete="off" value="<?=$supp_phone;?>" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Fax</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="fax" type="text" id="10" autocomplete="off" value="<?=$supp_fax;?>" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Email</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="email" type="text" id="11" autocomplete="off" value="<?=$supp_email;?>" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Term of Payment</label>
                                          <div class="controls">
										   <input class="input-mini focused" name="t_pay" type="number" id="16" autocomplete="off" value="<?=$term_payment;?>" disabled required> Day(s).
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp1" type="text" id="12" autocomplete="off" value="<?=$supp_npwp1;?>" disabled required>
                                          </div>
                                        </div>
															
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp2" type="text" id="13" autocomplete="off" value="<?=$supp_npwp2;?>" disabled required>
                                          </div>
                                        </div>
														
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Contact1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="kontak1" type="text" id="14" autocomplete="off" value="<?=$supp_contact1;?>" disabled>
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Contact2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="kontak2" type="text" id="15" autocomplete="off" value="<?=$supp_contact2;?>" disabled>
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
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Update</a>
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