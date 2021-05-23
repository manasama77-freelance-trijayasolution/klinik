
	<script>
	function undisableTxt(){
		document.getElementById('pat_mrn').disabled 	= false;
		<?php
			$x = 1; 
			while($x <= 16) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	}

	function popup_2(){
		var myWindow = window.open("<?php echo base_url();?>pharmacy/choose_patient_data_reg", "", "width=1200px, height=500px, top=70, left=70");
	}

	function goBack(){
		location.reload();
	}

	function print_all(id){
		var myWindow = window.open("<?php echo base_url();?>pharmacy/print_eticket/"+id+"", "", "width=1200px, height=500px, top=70, left=70");
	}

	</script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Input E-Ticket</b></div>
                            </div>	
								<div class="form-actions">
									<button onclick="undisableTxt()" class="btn btn-primary">Start</button>	
									<button class="btn btn-warning" onclick="goBack()">Back</button>
								</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
									  <form action="<?php echo base_url();?>pharmacy/print_eticket" method="post" class="form-horizontal" id="form_sample_1" name="quesioner_mcu"  target="POPUPW" onsubmit="POPUPW = window.open('about:blank','POPUPW','width=600,height=400');">
																			
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Type <span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_group" id="2" title="Choose Item Group" required >
                                              <option value="">- Choose -</option>
                                              <option value="Blue"> Blue </option>
                                              <option value="White"> White </option>
                                           </select>
										   <span for="2" class="help-inline"></span>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Date <span class="required"></span></label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="3" name="tanggal" value="08/09/2016" type="text" autocomplete="off" required disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patien Name <span class="required"></span></label>
                                          <div class="controls">
                                          	<input class="input-large" id="pat_mrn" style="text-transform: uppercase;" name="pat_mrn" data-required="1" type="text" required disabled>
                                            <input class="input-small"  id="id_pat" name="id_pat" type="text" >	
                                            <input class="input-small"  id="id_reg" name="id_reg" type="text" >	
											<button type="button" onclick="popup_2();" class="btn btn-success btn-mini"><i class="icon-search"></i> <b>Find Patient</b></button>
											<span for="pat_mrn" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Medication <span class="required"></span></label>
                                          <div class="controls">
                                          	<input class="input-large" id="4" style="text-transform: uppercase;" name="medication" data-required="1" type="text" autocomplete="off" required disabled>
                                          </div>
                                        </div>
									
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Instruction <span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="instruction" id="6" title="Choose Item Group" required >
                                              <option value="">- Choose -</option>
                                       		  <?php 
											  foreach($instruction->result() as $rows){
											  ?>
											  <option  align="justify" value="<?=$rows->id_baseunit?>"><b><?=$rows->baseunit?></b></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="2" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Indication <span class="required"></span></label>
                                          <div class="controls">
                                          	<input class="input-large" id="5" style="text-transform: uppercase;" name="indication" data-required="1" type="text" value="Lactbacillius" required disabled>
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Times a day</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="main" type="text" id="7" autocomplete="off" disabled="" required=""> Times 
                                            <input class="input-small focused" name="day" type="text" id="8" value="1" autocomplete="off" disabled="" required="">
                                            Days
                                          </div>
                                        </div>

                                         <div class="control-group">
                                          <div class="controls">
                                            <input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>Before Meal</b>
                                            <input style="width:15px; height:20px;" type="checkbox" id="10" name="complete" value="1"> <b>After Meal</b>
                                            <input style="width:15px; height:20px;" type="checkbox" id="11" name="complete" value="1"> <b>Until Finish</b>
                                            <input style="width:15px; height:20px;" type="checkbox" id="12" name="complete" value="1"> <b>If Necessary</b>
                                            <input style="width:15px; height:20px;" type="checkbox" id="13" name="complete" value="1"> <b>Before Sleep</b>
                                          </div>
                                        </div>
											
                                         <div class="control-group">
                                          <div class="controls">
                                            <input style="width:15px; height:20px;" type="checkbox" id="14" name="complete" value="1"> <b>Morning</b>
                                            <input style="width:15px; height:20px;" type="checkbox" id="15" name="complete" value="1"> <b>After Noon</b>
                                            <input style="width:15px; height:20px;" type="checkbox" id="16" name="complete" value="1"> <b>Evening</b>
                                          </div>
                                        </div>
																				
										<div heo></div>
												
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" onclick="this.disabled=true;this.form.submit();" value="Save" id="1" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
                                        </div>
									</form>
 <div class="row-fluid">
<div class="navbar navbar-inner block-header">
   <div class="muted pull-left"><b>Registration Patient</b></div>
</div>
<div class="block-content collapse in">
   <div class="span12">                                   
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead>
			<tr>
				<th>No.</th>
				<th>ID Registration</th>
				<th>Patient Name</th>
				<th>Date Registration</th>
				<th>Company Name</th>
				<th>Type</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=1;
		foreach($trx_registration->result() as $row){
		?>
			<tr class="odd gradeX">
				<td><?php echo $i++;?></td>
				<td><?php echo $row->id_reg;?></td>
				<td><?php echo $row->pat_name;?></td>
				<td><?php echo date("d.m.Y",strtotime($row->reg_date));?></td>
				<td><?php echo $row->client_name;?></td>
				<td><?php if($row->id_service==0){
					echo "MCU";
					}else{
					echo "Outpatient";
					}
					?>
				</td>
				<td>
					<button title="Print Received Items" class="btn btn-mini" title="Print" onclick="print_all('<?php echo ($row->id_reg);?>');"><i class="icon-print"></i></button>
				</td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
   </div>
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