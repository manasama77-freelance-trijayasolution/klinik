<script type="text/javascript">
	// AGAR TIDAK SUBMIT SAAT DI ENTER
	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});
</script>

	<?php
	include './design/koneksi/file.php';
	$time_start = microtime(true);
	//echo $time_start;
	$seq_nums 	=substr($time_start,11);
	$query 		="SELECT cast(right(id_reg,4) as decimal) id,cast(substr(id_reg,2,4) as decimal) dt, id as id_real, id_package FROM trx_registration ORDER BY id_reg DESC LIMIT 1";  
    if($result 	=mysqli_query($con, $query))
    {
		$date	=date('ymd');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$dater 	=$row['dt'];
		$idreal	=$row['id_real'];
		$stspc	=$row['id_package'];

		if ($dater == $date){
			$idreal = $idreal+1; 	
		}else{
			$idreal = 1;
		}
		$code_no = str_pad($seq_nums+$idreal, 4, "0", STR_PAD_LEFT);
    }
	$session_data 	     	= $this->session->userdata('logged_in');
    $data['username'] 	 	= $session_data['username']; 
	$loc 	             	= $session_data['location'];
	$_SESSION["regsession"]	= $_SERVER['REQUEST_URI'];
	
	$id       = $this->uri->segment(3);
	$id_reg   = $this->uri->segment(4);
	$pat_name = $this->uri->segment(5);


		if($id=="ok"){
		?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> Registration Patient <i class="icon-info-sign"></i> <b>Press [F5] for print again.</b>
			</div>
		<?php
		}

if($id_reg && $stspc == 0 ){
?>
	<script>
	window.open("<?php echo base_url();?>registration/print_detail_regpatient/<?php echo $id_reg;?>", "", "width=700, height=550");	
	</script>
<?php
}elseif( $id_reg && $stspc =! 0 ){	
?>
	<script>
	window.open("<?php echo base_url();?>patient/print_mark_sheet/<?php echo $id_reg;?>", "", "width=700, height=550, top=60, left=0");
	window.open("<?php echo base_url();?>registration/print_detail_regpatient/<?php echo $id_reg;?>", "", "width=700, height=550");
	</script>
<?php } ?>

<script>
function getComboA(sel) {
    var value = sel.value;  
	if (sel.value == "3"){
		var y = document.getElementById("id_ins_div").style.display ='';
	}else{
		var y = document.getElementById("id_ins_div").style.display ='none';
	}
	//alert(sel.value);
}

function getComboB(sel) {
    var value = sel.value; 
	if (sel.value != "0"){
		var y = document.getElementById("id_cli_div").style.display ='';
	}else{
		var y = document.getElementById("id_cli_div").style.display ='none';
	}
	//alert(sel.value);
}
</script>	
<!--
			<div class="alert alert-danger">
				<button class="close" data-dismiss="danger">&times;</button>
				<strong>INFO :</strong> Saat ini input REGISTRASI hanya untuk <strong>Outpatient</strong>.
			</div>
-->
					<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Registration Patient</b></div>
								<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<div class="form-actions">
								<!--
                                <button type="submit" onclick="showapp()" class="btn btn-info"><i class="icon-calendar"></i> Appointment</button>
								-->
                                <button type="submit" onclick="finger('<?=$loc.$date.$code_no;?>')" class="btn btn-info"><i class="icon-thumbs-up"></i> <b>Fingerscan</b></button>
                                <button type="submit" onclick="popup_camera('<?=$loc.$date.$code_no;?>')" class="btn btn-info"><i class="icon-camera"></i> <b>Photo</b></button>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<div style="overflow-y: auto; height:auto;">
                                    <form action="<?php echo base_url();?>registration/save_reg" method="post" class="form-horizontal" onSubmit="if(!confirm('Is the form filled out correctly ?')){return false;}" id="form_sample_1" name="quesioner_mcu">
                                    <fieldset>
										<div class="alert alert-error hide" style="width: 550px;">
										<button class="close" data-dismiss="alert">&times;</button>
										You have some form Registration errors. Please check below.
										</div>
										
										<div class="alert alert-success hide" style="width: 550px;">
										<button class="close" data-dismiss="alert">&times;</button>
										Your form Registration is successful!
										</div>
										<hr>
										
										<!-- <div style="float:right;">
										<b>Manual Book : Registration</b></br>
										<iframe style="border-radius:8px;" width="185px" height="184px" src="https://www.yumpu.com/id/embed/view/iX7EWHINmhpGo5Aw" frameborder="0" allowfullscreen="true" allowtransparency="true"></iframe>
										</div>
										 -->
										<div style="float:left;">
                                        <div class="control-group">
                                              <?php 
											  foreach($get_branch->result() as $rows){
											  $codebranch = $rows->kode_company;
											  }
											  ?>
                                          <label class="control-label" for="disabledInput">ID Registration</label>
                                          <div class="controls">
											 <input class="input-mini" value="<?php echo $codebranch;?>" name="codebranch" type="text" readonly>
											 <input class="input-medium disabled" id="id_reg" value="<?=$loc.$date.$code_no;?>" name="id_reg" minlength="12" maxlength="12" type="text" readonly><readonly button class="btn-mini tooltip-right" data-original-title="ID ini meliputi data transaksi pembayaran & pemeriksaan medis, dalam setiap kunjungan akan memiliki ID yang berbeda."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="">Patient Name <span class="required">*</span></label>
                                          <div class="controls">
                                            <input class="input-large" id="pat_mrn" style="text-transform: uppercase;" readonly name="pat_mrn" data-required="1" type="text" required>
                                            <input class="input-small"  id="id_pat"  readonly name="id_pat" type="hidden" >										
											<button type="button" onclick="popup();" class="btn btn-info btn-mini"><i class="icon-plus-sign"></i> <b>Add New Patient</b></button>
											<button type="button" onclick="popup_s();" class="btn btn-success btn-mini"><i class="icon-search"></i> <b>Find Patient</b></button>
											<span for="pat_mrn" class="help-inline"></span>
                                          </div>
                                        </div>
					
                                        <div class="control-group">
                                          <label class="control-label" for="">Date of Registration</label>
											<div class="controls">
                                            <input type="text" name="reg_date" class="input-large datepicker" id="reg_date" value="<?php echo date("m/d/Y");?>" readonly><readonly button class="btn-mini tooltip-right" data-original-title="Date of Registration adalah tanggal kunjungan pasien pada hari ini, namun bisa disesuaikan tanggalnya."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="">Patient Charge Rule <span class="required">*</span></label>
                                          <div class="controls">
                                            <select class="chzn-select" name="pat_charge_rule" id="pat_charge_rule" onchange="getComboA(this)" required>
                                              <option value="">- Choose Charge Rule -</option>
                                              <?php 
											  foreach($get_charge_rule->result() as $rows){
											  ?>
											  <option value="<?=$rows->id_price_type?>" align="justify"><b><?=$rows->price_type?></b> <?php if($rows->id_price_type==2 or $rows->id_price_type==2){ echo "- Wajib Memiliki KTP Indonesia"; } ?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<readonly button class="btn-mini tooltip-right" data-original-title="Patient Charge Rule adalah penentuan harga yang akan diberikan kepada pasien saat pembayaran."><i class="icon-question-sign"></i></button>
											<span for="pat_charge_rule" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<!--
										 <div class="control-group">
                                          <label class="control-label" for="disabledInput">Reg Type <span class="required">*</span></label>
                                          <div class="controls">
											  <select class="chzn-select" name="reg_type" id="reg_type" required>
                                              <option value="">- Choose Reg Type -</option>
                                              <?php 
											  foreach($get_reg_type->result() as $rows){
											  ?>
											  <option value="<?=$rows->id_regtype?>" align="justify"><?=$rows->regtype?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<span for="reg_type" class="help-inline"></span>
                                          </div>
                                          </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Payment Type <span class="required">*</span></label>
                                          <div class="controls">
                                            <select class="chzn-select" id="payment_type"  name="payment_type" required>
                                              <option value="">- Choose Payment Type -</option>
                                              <?php 
											  foreach($get_paytype->result() as $rows){
											  ?>
												<option value="<?=$rows->id_type?>" align="justify"><?=$rows->paytype?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<span for="payment_type" class="help-inline"></span>
                                          </div>
                                        </div>
										-->
										<!--
										<div id="id_ins_div">
										-->
										<div class="control-group">
                                          <label class="control-label" for="select01">Insurance Company <span class="required">*</span></label>
                                          <div class="controls">
                                            <select class="chzn-select" name="insurance_comp" >
                                              <option value="0">- Choose Insurance -</option>
                                              <?php 
											  foreach($get_insurance->result() as $rows){
											  ?>
												<option value="<?=$rows->id_ins_comp?>" align="justify"><?=$rows->ins_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<readonly button class="btn-mini tooltip-right" data-original-title="Insurance Company adalah perusahaan Asuransi Kesehatan yang akan membayarkan tagihan pasien."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>
										<!--
										</div>
										-->
										
										<!-- <div class="control-group">
                                          <label class="control-label" for="select01">Client</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="client_id" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  //foreach($client->result() as $rows){
											  ?>
												<option value="<?//=$rows->id_Client?>" align="justify"><?//=$rows->client_name?></option>
											  <?php
											  //}
											  ?>
                                            </select>
                                          </div>
                                        </div> -->
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="id_client" name="id_client" onchange="getComboB(this)" >
                                              <option value="0">- Choose Company Name -</option>
                                              <?php 
											  foreach($get_client->result() as $rows){
											  ?>
												<option value="<?=$rows->id_Client?>" align="justify"><?=$rows->client_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<readonly button class="btn-mini tooltip-right" data-original-title="Tempat pasien bekerja saat ini."><i class="icon-question-sign"></i></button>
											<!--
											<button type="button" onclick="newclient();" class="btn btn-info btn-mini">New Client</button>
											-->
                                          </div>
                                        </div>
										
										<div id="id_cli_div">
										<div class="control-group">
                                          <label class="control-label" for="select01">Company Dept.</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_client_dept">
                                              <option value="0">- Choose Company Dept. -</option>
                                              <?php 
											  foreach($get_client_dept->result() as $rows){
											  ?>
											  <option value="<?=$rows->id_client_dept?>" align="justify"><?=$rows->client_dept?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
																						
                                        <div class="control-group">
                                          <label class="control-label" id="" for="select01">Job Position</label>
                                          <div class="controls">
                                              <input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 250px;font-style: oblique; text-transform: capitalize;" class="span6" id="typeahead" name="id_client_job" data-provide="typeahead" data-items="20" data-source='[<?php foreach($get_client_job->result() as $row){ echo '"'.$row->client_job_desc.'",'; }?>""]' autocomplete="off">
                                          </div>
                                        </div>
										</div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="">References</label>
                                          <div class="controls">
										  <input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 250px;font-style: oblique; text-transform: capitalize;" class="span6" id="typeahead" name="reference" data-provide="typeahead" data-items="20" data-source='[<?php foreach($refe->result() as $row){ echo '"'.$row->reference.'",'; }?>""]' autocomplete="off"><readonly button class="btn-mini tooltip-right" data-original-title="Dari mana pasien mengetahui tentang informasi klinik."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>
									
										<script>
										function disableElements()
										{
										//document.getElementById("selectError99").readOnly=true;
										var x = document.getElementById("multiSelect").disabled=true;
										var y = document.getElementById("item").style.display ="none";
										var y = document.getElementById("item2").style.display ="";
										var y = document.getElementById("item3").style.display ="";
										}
										</script>
										<script>
										function disableElements2()
										{
										//document.getElementById("selectError99").readOnly=true;
										var y = document.getElementById("item").style.display ="";
										var y = document.getElementById("item2").style.display ="none";
										var y = document.getElementById("item3").style.display ="none";
										var x = document.getElementById("multiSelect").disabled=false;
										}
										</script>
                                       <!-- <div class="control-group">
										<input class="input-xlarge disabled" disabled name="pat_sign" id="reference" type="hidden">
                                          <label class="control-label" for="">Patient Sign</label>
                                          <div class="controls">
                                            <textarea class="" name="pat_sign" id="pat_sign" disabled   " style="width: 400px; height: 50px"></textarea>
                                          </div>
                                        </div>!-->  
										  <div class="control-group alert alert-danger" >
                                          <label class="control-label" for="disabledInput"><b>Services</b> <font color="red">*</font></label>
                                          <div class="controls">
										  <input type="radio" style="width: 30px; height: 30px;" name="package" onclick="disableElements2()" value="1" required>&nbsp; <b>Medical Check UP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type="radio" style="width: 30px; height: 30px;" name="package" onclick="disableElements()" value="0" required>&nbsp; <b>Outpatient</b><span for="package" class="help-inline"></span>
										  </div>	
										  </div>
										  
										  <div class="control-group"  id="item">
										   <label class="control-label" for="disabledInput"><b>Package Medical</b> <font color="red">*</font></label>
											<div class="controls">
										     <select multiple="multiple" id="multiSelect" name="package_id[]" class="chzn-select" style="width: 400px;">
												<?php foreach($get_service_package_h->result() as $row_com){ echo "<option value='".substr(htmlspecialchars($row_com->id_quot,ENT_QUOTES, 'UTF-8'), 0, 140)."'>".$row_com->quot_name." [".$row_com->client_name."] [".$row_com->qout_id."]</option>"; }?>
											 </select>
											</div>
										</div>
										
                                       		
										
										<div id="item2">										
                                        <div class="control-group">
                                          <label class="control-label" for="select01"><b>Doctor</b> <font color="red">*</font></label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_dr">
                                              <option value="">- Choose Doctor -</option>
                                              <?php 
											  foreach($get_doctor2->result() as $rows){
											  ?>
												<option value="<?=$rows->id?>" align="justify"><?=$rows->fullname?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<i>*untuk data <b>Doctor Fee</b></i>
                                          </div>
                                        </div>
										</div>
										
										<div id="item3">										
                                        <div class="control-group">
                                          <label class="control-label" for="select01"><b>Marketing (Sales)</b> <font color="red">*</font></label>
                                          <div class="controls">
                                            <select class="chzn-select" name="id_sal">
                                              <option value="">- Choose Sales -</option>
											  <option value="001">Office (Website, Onsite)</option>
                                              <?php 
											  foreach($get_sales->result() as $rows){
											  ?>
												<option value="<?=$rows->id?>" align="justify"><?=$rows->fullname?></option>
											  <?php
											  }
											  ?>
                                            </select>
											<i>*untuk data <b>Sales Report</b></i>
                                          </div>
                                        </div>
										</div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="">Notes</label>
                                          <div class="controls">
                                            <textarea class="" name="misc_notes" id="notes" placeholder="Optional" style="width: 400px; height: 50px; text-transform: capitalize;"></textarea>
											<readonly button class="btn-mini tooltip-right" data-original-title="Apabila ada catatan tambahan mengenai pasien bisa ditulis disini, apabila tidak ada abaikan saja."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>
										</div>
                                      </fieldset>           
                                      </br></br></br>                        
                                </div>
                                </div>
                            </div>
								<div class="form-actions">
								<div style="float:left;">
                                    <button type="submit" class="btn btn-success" id="btn"><b>Submit</b></button>
								</div>
								<div style="float:right;">
                                    <button onClick="window.location.reload()" class="btn btn-danger"><b>Reset</b></button>
								</div>
                                </div>
                        </div>
						</form>
                        <!-- /block -->
                    </div>
					</body>
   	            <!-- /wizard -->
		<!--/.fluid-container-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
		
        <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
		
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
		
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
		
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script>
		function popup(b_id){
			var id3 = "<?=$id;?>" ;

			if (id3 == "ok") {
				window.location = "<?php echo base_url();?>registration/reg_patien";
			}

			var myWindow = window.open("<?php echo base_url();?>patient/add_patient", "Popup", "width=1350px, height=500px, top=70, left=2.5");
		}
		
		function newclient(b_id){
			var myWindow = window.open("<?php echo base_url();?>client/add_client", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function popup_s(id){
			var myWindow = window.open("<?php echo base_url();?>patient/find_patient_data", "", "width=1200px, height=500px, top=70, left=70");
		}
		
		function popup_camera(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_camera/"+id+"", "", "width=950px, height=500px, top=70, left=80");
		}
		
		function finger(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"", "", "width=1200px, height=500px, top=70, left=80");
			
			// window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        // "directories=1,location=1,menubar=1," + 
                        //  "resizable=1 status=1,history=1 top = 50 left = 100");
		}

		function showapp(){
			window.open("<?php echo base_url();?>Registration/reg_app","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top=50 left = 100");
		}
		</script>
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
		<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.popover-left').popover({placement: 'left', trigger: 'hover'});
			$('.popover-right').popover({placement: 'right', trigger: 'hover'});
			$('.popover-top').popover({placement: 'top', trigger: 'hover'});
			$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});

			$('.notification').click(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("Stick this!", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("Hello world!");
					break;
				}
			});
        });
        </script>
		<?php
		mysqli_close($con);
		?>
</html>