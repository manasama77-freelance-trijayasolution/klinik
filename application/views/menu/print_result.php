	<script>
	  
	  function popup(b_id){
		window.open("<?php echo base_url();?>patient/find_patient_print_mcu","Popup","width=1400, height=700, top=50, left=10"); 
      }
	  
	  function popup_id(b_id){
		window.open("<?php echo base_url();?>patient/find_patient_mark_id","Popup","width=1400, height=700, top=50, left=10"); 
      }
	  
      function del_print(){
      	var reg_id 	= document.getElementById("id_reg").value;
  		var r 		= confirm("Are You Sure Want Delete  ?");
		if (r == true) {
			// x = window.location = "<?php echo base_url();?>marketing/delete_currency/"+id+"";
			$.post("del_print_mcu/"+reg_id+"", $("#console").serialize()); // silent delete..
		} else {
			x = "You pressed Cancel!";
		}
      }
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Print Medical Check UP</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
                                        <legend>	
										</legend>
										<form class="form-horizontal " action="<?php echo base_url();?>patient/print_result_act" target="_blank" method="post" name="mark_mcu">


										<div class="control-group">
                                          <label class="control-label" for="">Language </label>
                                          <div class="controls">
                                            <select class="chzn-select" name="bahasa" id="bahasa">
                                              <option value="0"> English </option>
                                              <option value="1"> Japanese </option>
                                            </select>
                                          </div>
                                        </div>                                        
										
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" id="pat_mrn"  autocomplete="off" placeholder=" ... " maxlength="0" required>
											<input name="id_reg" type="hidden" id="id_reg"  autocomplete="off" required>
											<input name="id_up" type="hidden" id=""  autocomplete="off"  >
											<input name="id_pat" type="hidden" id=""  autocomplete="off" >
											<input name="reg_date" type="hidden" id=""  autocomplete="off" >
											<input name="print_jum" id="print_jum" type="hidden" value="0">
											
											<!-- PENCARIAN BERDASARKAN REGISTRASI -->
												&nbsp;<button type="button" title="By Registration" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>

											<!-- PENCARIAN BERDASARKAN PATIEN DAN MAX REGISTRASI -->
												<!-- &nbsp;<button type="button" onclick="popup_id();" title="By Patient" class="btn btn-success"><i class="icon-user"></i></button> -->


										  </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" type="text" id="" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>		
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Client Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" id="myText03" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="pat_mcu" type="text" id="" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>
											
										<div class="form-actions">
										<button type="submit" name="bprint" id="bprint" class="btn btn-success">Print</button>
										<button onclick="del_print();" name="reprint" id="reprint" class="btn btn-danger">Re-Print</button>
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