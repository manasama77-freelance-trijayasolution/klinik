	
	<script>
	  function undisableTxt(){	    
		<?php
			$x = 2; 
			while($x <= 17) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }

	function closeit(){
		var id_supplier 	= document.getElementById("id_supplier").value;
		var name_supplier 	= document.getElementById("2").value;
		var spcode 			= document.getElementById("17").value;
		var terms 			= document.getElementById("16").value;
		window.opener.document.forms['mst_pr'].elements['id_supplier'].value=id_supplier;
		window.opener.document.forms['mst_pr'].elements['name_supplier'].value=name_supplier;
		window.opener.document.forms['mst_pr'].elements['spcode'].value=spcode;
		window.opener.document.forms['mst_pr'].elements['term'].value=terms;
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
                            <div class="muted pull-left">Input Master Supplier</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
										 <!-- <button class="btn btn-warning" onclick="goBack()">Back</button> -->
                                    	 <button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>	

										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_sp2" method="post" name="mst_service">

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Code</label>
                                          <div class="controls">
                                            <input name="id_supplier" type="hidden" id="id_supplier" value="<?=$id_supplier;?>">
                                            <input class="input-xlarge focused" name="spcode" type="text" id="17" autocomplete="off" disabled required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_name" type="text" id="2" autocomplete="off" disabled required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address1</label>
                                          <div class="controls">
										  <textarea name="s_address" id="3" disabled></textarea>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address2</label>
                                          <div class="controls">
										  <textarea name="s_address2" id="4" disabled></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Province</label>
                                          <div class="controls">
                                            <select id="5" name="pat_province"  disabled>
                                              <option value="DKI Jakarta">DKI Jakarta</option>
                                              <?php 
											  foreach($province->result() as $rows){
											  ?>
												<option value="<?=$rows->provinsi_nama?>" align="justify"><?=$rows->provinsi_nama;?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="">City</label>
                                          <div class="controls">
                                            <select id="6" name="city" style="width:285px" disabled>
                                              <option value="Kota Jakarta Pusat">Kota Jakarta Pusat</option>
                                              <?php 
											  foreach($city->result() as $rows){
											  ?>
												<option value="<?=$rows->nama_kota?>" align="justify"><?=$rows->nama_kota?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>


										<div class="control-group">
                                          <label class="control-label" for="">Patient Nationality</label>
                                          <div class="controls">
                                            <select id="7" name="pat_nationality" style="width:285px" disabled>
                                              <option value="Indonesian">Indonesian</option>
                                              <?php 
											  foreach($national->result() as $rows){
											  ?>
												<option value="<?=$rows->nationality?>" align="justify"><?=$rows->nationality?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Zip Code</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="zipcode" type="text" id="8" maxlength="5" autocomplete="off" disabled required>
                                          </div>
                                        </div>
												
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="phone" type="text" id="9" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Fax</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="fax" type="text" id="10" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Email</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="email" type="text" id="11" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Term of Payment</label>
                                          <div class="controls">
										   <input class="input-mini focused" name="t_pay" type="number" id="16" value="0" autocomplete="off" disabled required> Day(s).
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp1" type="text" id="12" autocomplete="off" disabled required>
                                          </div>
                                        </div>
															
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp2" type="text" id="13" autocomplete="off" disabled required>
                                          </div>
                                        </div>
														
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Contact1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="kontak1" type="text" id="14" autocomplete="off" disabled>
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Contact2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="kontak2" type="text" id="15" autocomplete="off" disabled>
                                          </div>
                                        </div>
<!-- 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Balance</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="balance" type="text" id="14" autocomplete="off" value="0" disabled required>
                                          </div>
                                        </div>
															
                                        <div class="control-group">
                                          <label class="control-label" for="">Date of The Balance</label>
											<div class="controls">
                                            <input type="text" name="balance_date" class="input-large datepicker" id="15" value="<?php echo date("m/d/Y");?>" disabled>
                                          </div>
                                        </div>
																			
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Memo</label>
                                          <div class="controls">
										  <textarea name="memo" id="19" disabled>-</textarea>
                                          </div>
                                        </div>
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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success" onclick="closeit();">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
								<div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <!-- <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-file"></i> Export Data <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1">Excel</a></li>
                                         </ul> -->
                                          <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/inv_supplier_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
									
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