<?php
include './design/koneksi/file.php';
$time_start = microtime(true);
//echo $time_start;
$seq_nums 	= substr($time_start, 11);
$query 		= "SELECT cast(right(id_reg,4) as decimal) id, cast(substr(id_reg,2,4) as decimal) dt, id as id_real, id_package FROM trx_registration ORDER BY id_reg DESC LIMIT 1";
if ($result 	= mysqli_query($con, $query)) {
	$date	= date('ymd');
	$row 	= mysqli_fetch_assoc($result);
	$count 	= $row['id'];
	$dater 	= $row['dt'];
	$idreal	= $row['id_real'];
	$stspc	= $row['id_package'];

	if ($dater == $date) {
		$idreal = $idreal + 1;
	} else {
		$idreal = 1;
	}
	$code_no = str_pad($seq_nums + $idreal, 4, "0", STR_PAD_LEFT);
}
$session_data 	     	= $this->session->userdata('logged_in');
$data['username'] 	 	= $session_data['username'];
$loc 	             	= $session_data['location'];
$_SESSION["regsession"]	= $_SERVER['REQUEST_URI'];

$id       = $this->uri->segment(3);
$id_reg   = $this->uri->segment(4);
$pat_name = $this->uri->segment(5);
?>

<script>
	function getComboA(sel) {
		var value = sel.value;
		if (sel.value == "3") {
			var y = document.getElementById("id_ins_div").style.display = '';
		} else {
			var y = document.getElementById("id_ins_div").style.display = 'none';
		}
		//alert(sel.value);
	}

	function getComboB(sel) {
		var value = sel.value;
		if (sel.value != "0") {
			var y = document.getElementById("id_cli_div").style.display = '';
		} else {
			var y = document.getElementById("id_cli_div").style.display = 'none';
		}
	}
</script>

<body onload="startTime()">

	<div class="row-fluid">
		<div class="span12">
			<?php if ($this->session->flashdata('registration_success')) { ?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">&times;</button>
					<h4><strong><?= $this->session->flashdata('registration_success'); ?></strong></h4>
				</div>
			<?php } ?>

			<?php if ($this->session->flashdata('registration_danger')) { ?>
				<div class="alert alert-danger">
					<button class="close" data-dismiss="alert">&times;</button>
					<h4><strong><?= $this->session->flashdata('registration_danger'); ?></strong></h4>
				</div>
			<?php } ?>
		</div>
	</div>

	<div class="row-fluid" id="section_registration_patient">
		<form action="<?= site_url(); ?>registration/save_reg2" method="post" class="form-horizontal" onSubmit="if(!confirm('Is the form filled out correctly ?')){return false;}" id="form_sample_1" name="quesioner_mcu">

			<div class="block">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left"><b>Registration Patient</b></div>
					<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
				</div>

				<div class="block-content collapse in">
					<div class="span12">
						<div style="overflow-y: auto; height:auto;">

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
								<div style="float:left;">
									<div class="control-group">
										<?php
										foreach ($get_branch->result() as $rows) {
											$codebranch = $rows->kode_company;
										}
										?>
										<label class="control-label" for="codebranch"><b>ID Registration</b> <span class="required">*</span></label>
										<div class="controls">
											<input class="input-mini disabled" value="<?php echo $codebranch; ?>" id="codebranch" name="codebranch" type="text" readonly required>
											<input class="input-medium disabled" id="id_reg" value="<?= $loc . $date . $code_no; ?>" name="id_reg" minlength="12" maxlength="12" type="text" readonly required>
											<span class="btn-mini tooltip-right" data-original-title="ID ini meliputi data transaksi pembayaran & pemeriksaan medis, dalam setiap kunjungan akan memiliki ID yang berbeda."><i class="icon-question-sign"></i></span>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="pat_mrn"><b>Patient Name</b> <span class="required">*</span></label>
										<div class="controls">
											<input class="input-large" id="pat_mrn" style="text-transform: uppercase;" name="pat_mrn" type="text" required readonly>
											<input class="input-small" id="id_pat" name="id_pat" type="hidden">
											<!-- <button type="button" onclick="showFormPatient();" class="btn btn-info btn-mini"><i class="icon-plus-sign"></i> <b>Add New Patient</b></button> -->
											<button type="button" onclick="popup_s();" class="btn btn-success btn-mini"><i class="icon-search"></i> <b>Find Patient</b></button>
											<span for="pat_mrn" class="help-inline"></span>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="reg_date"><b>Date of Registration</b> <span class="required">*</span></label>
										<div class="controls">
											<!-- <input type="hidden" name="pat_charge_rule" value="2">package -->
											<input type="date" name="reg_date" class="input-large" id="reg_date" value="<?php echo date("Y-m-d"); ?>">
											<span class="btn-mini tooltip-right" data-original-title="Date of Registration adalah tanggal kunjungan pasien pada hari ini, namun bisa disesuaikan tanggalnya."><i class="icon-question-sign"></i></span>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="reg_date"><b>Doctor</b> <span class="required">*</span></label>
										<div class="controls">
											<select id="id_dr" name="id_dr" required>
												<option value="">-Select Doctor-</option>
												<?php
												foreach ($arr_doctor->result() as $key) {
													echo '<option value="' . $key->id_dr . '">' . $key->drname . '</option>';
												}
												?>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="appointment_date"><b>Appointment Date</b> <span class="required">*</span></label>
										<div class="controls">
											<input type="date" name="appointment_date" class="input-large" id="appointment_date" required>
											<input type="time" name="appointment_time" class="input-large" id="appointment_time" min="16:00" max="20:00" required>
											<span class="validity"></span>
											<p class="fallbackLabel">
												Choose an appointment time (opening hours 04:00 PM to 08:00 PM)
												<span class="btn-mini tooltip-right" data-original-title="Appointment Date adalah tanggal janji pasien bertemu dengan dokter, namun bisa disesuaikan tanggalnya."><i class="icon-question-sign"></i></span>
											</p>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="notes">Notes</label>
										<div class="controls">
											<textarea class="" name="misc_notes" id="notes" placeholder="Optional" style="width: 400px; height: 50px; text-transform: capitalize;"></textarea>
											<span class="btn-mini tooltip-right" data-original-title="Apabila ada catatan tambahan mengenai pasien bisa ditulis disini, apabila tidak ada abaikan saja."><i class="icon-question-sign"></i></span>
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
						<button type="submit" class="btn btn-success" id="btn_submit_registration"><b>Submit</b></button>
					</div>
					<div style="float:right;">
						<a href="<?= site_url(); ?>registration/reg_patien" class="btn btn-danger"><b>Reset</b></a>
					</div>
				</div>
			</div>

		</form>

	</div>

	<div class="row-fluid" id="section_add_new_patient" style="display: none;">
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><b>Add New Patient</b></div>
				<div class="pull-right" style="font-weight: bold;">
					<button type="button" class="btn btn-warning btn-mini" onclick="closeFormAddNewPatient();">
						<i class="icon-remove"></i>
					</button>
				</div>
			</div>

			<div class="block-content collapse in">
				<div class="span12">
					<div style="overflow-y: auto; height:auto;">
						<form class="form-horizontal" id="form_add_new_patient">
							<fieldset>
								<div style="float:left;">
									<div class="control-group">
										<label class="control-label" for="id_number"><b>ID Number</b> <span class="required">*</span></label>
										<div class="controls">
											<input type="text" class="input-large" name="id_number" placeholder="KTP, SIM, KITAS, PASSPORT" maxlength="20" autocomplete="off" style="text-transform: uppercase;" required> -
											<select class="input-mini" id="id_number_type" name="id_number_type" style="width:110px">
												<option value="">Type</option>
												<option value="KTP">KTP</option>
												<option value="SIM">SIM</option>
												<option value="KITAS">KITAS</option>
												<option value="PASSPORT">PASSPORT</option>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="id_medical_record">ID Medical Record</label>
										<div class="controls">
											<input type="text" class="input-large" id="id_medical_record" name="id_medical_record" style="text-transform: uppercase;">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="patient_name"> <b>Patient Name</b>
											<span class="required">*</span>
										</label>
										<div class="controls">
											<input class="input-xlarge" style="text-transform: uppercase;" name="patient_name" type="text" id="patient_name" autocomplete="off" required> -
											<select id="patient_title" name="patient_title" style="width:80px" required>
												<option value="">Title</option>
												<?php
												foreach ($title->result() as $rows) {
												?>
													<option value="<?= $rows->id_title ?>" align="justify"><?= $rows->title_desc ?>.</option>
												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="gender"><b>Gender</b>
											<span class="required">*</span>
										</label>
										<div class="controls">
											<select class="input-medium" name="gender" id="gender" required>
												<option value=""> Choose </option>
												<?php
												foreach ($gender->result() as $rows) {
												?>
													<option value="<?= $rows->id_gender ?>" align="justify"><?= $rows->gender ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="pob"><b>Place of Birth</b> <span class="required">*</span></label>
										<div class="controls">
											<input class="input-xlarge" style="text-transform: capitalize;" name="pob" type="text" id="pob" autocomplete="off" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="dob"><b>Date of Birth</b>
											<span class="required">*</span>
										</label>
										<div class="controls">
											<input type="date" name="dob" class="input-large" id="dob" required>
											<span><i class="icon-calendar"></i></span>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="marital_status"><b>Marital Status</b> <span class="required">*</span></label>
										<div class="controls">
											<select class="input-large" name="marital_status" id="marital_status">
												<option value=""> Choose </option>
												<?php
												foreach ($marital->result() as $rows) {
												?>
													<option value="<?= $rows->id_status ?>" align="justify"><?= $rows->marital_status ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="religion"> <b>Religion</b>
											<span class="required">*</span>
										</label>
										<div class="controls">
											<input class="input-xlarge" style="text-transform: uppercase;" name="religion" type="text" id="religion" autocomplete="off" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="jobs"> <b>Job</b>
											<span class="required">*</span>
										</label>
										<div class="controls">
											<input class="input-xlarge" style="text-transform: uppercase;" name="jobs" type="text" id="jobs" autocomplete="off" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="mobile_phone"> <b>Mobile Phone</b>
											<span class="required">*</span>
										</label>
										<div class="controls">
											<input type="tel" class="input-large" name="mobile_phone" maxlength="20" id="mobile_phone" placeholder="08XXXXXXXXXXXXXXXXXX" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="relative_name">Relative Name</label>
										<div class="controls">
											<input class="input-xlarge" name="relative_name" type="text" id="relative_name" autocomplete="off">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="relative_phone">Relative Phone</label>
										<div class="controls">
											<input class="input-xlarge" name="relative_phone" type="tel" maxlength="20" id="relative_phone" autocomplete="off">
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
					<button type="reset" class="btn btn-danger"><b>Reset</b></button>
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

<link href="<?php echo base_url(); ?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">

<link href="<?php echo base_url(); ?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

<script src="<?php echo base_url(); ?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>design/vendors/wysiwyg/wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>design/assets/form-validation.js"></script>

<script src="<?php echo base_url(); ?>design/assets/scripts.js"></script>
<script src="<?php echo base_url(); ?>public/vendor/blockui/jquery.blockUI.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function popup(b_id) {
		var id3 = "<?= $id; ?>";

		if (id3 == "ok") {
			window.location = "<?php echo base_url(); ?>registration/reg_patien";
		}

		var myWindow = window.open("<?php echo base_url(); ?>patient/add_patient", "Popup", "width=1350px, height=500px, top=70, left=2.5");
	}

	function newclient(b_id) {
		var myWindow = window.open("<?php echo base_url(); ?>client/add_client", "", "width=1200px, height=500px, top=70, left=80");
	}

	function popup_s(id) {
		var myWindow = window.open("<?php echo base_url(); ?>patient/find_patient_data", "", "width=1200px, height=500px, top=70, left=70");
	}

	function popup_camera(id) {
		var myWindow = window.open("<?php echo base_url(); ?>registration/add_camera/" + id + "", "", "width=950px, height=500px, top=70, left=80");
	}

	function finger(id) {
		var myWindow = window.open("<?php echo base_url(); ?>registration/add_fingerid/" + id + "", "", "width=1200px, height=500px, top=70, left=80");

		// window.open("<?php echo base_url(); ?>registration/add_fingerid/"+id+"","Popup","height=800px,width=700px,scrollbars=1,"+ 
		// "directories=1,location=1,menubar=1," + 
		//  "resizable=1 status=1,history=1 top = 50 left = 100");
	}

	function showapp() {
		window.open("<?php echo base_url(); ?>Registration/reg_app", "Popup", "height=800px,width=700px,scrollbars=1," +
			"directories=1,location=1,menubar=1," +
			"resizable=1 status=1,history=1 top=50 left = 100");
	}
</script>
<script>
	jQuery(document).ready(function() {
		FormValidation.init();

		$('#appointment_date').attr('min', $('#reg_date').val());

		$('#reg_date').on('change', function() {
			$('#appointment_date').attr('min', $('#reg_date').val());
		});
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
		$('.tooltip-left').tooltip({
			placement: 'left'
		});
		$('.tooltip-right').tooltip({
			placement: 'right'
		});
		$('.tooltip-top').tooltip({
			placement: 'top'
		});
		$('.tooltip-bottom').tooltip({
			placement: 'bottom'
		});

		$('.popover-left').popover({
			placement: 'left',
			trigger: 'hover'
		});
		$('.popover-right').popover({
			placement: 'right',
			trigger: 'hover'
		});
		$('.popover-top').popover({
			placement: 'top',
			trigger: 'hover'
		});
		$('.popover-bottom').popover({
			placement: 'bottom',
			trigger: 'hover'
		});

		$('.notification').click(function() {
			var $id = $(this).attr('id');
			switch ($id) {
				case 'notification-sticky':
					$.jGrowl("Stick this!", {
						sticky: true
					});
					break;

				case 'notification-header':
					$.jGrowl("A message with a header", {
						header: 'Important'
					});
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

<script>
	$(document).ready(function() {
		$('#form_add_new_patient').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url(); ?>patient/add_new_patient_ajax',
				method: 'post',
				dataType: 'json',
				data: $('#form_add_new_patient').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).fail(function(e) {
				console.log(e);
			}).always(function(e) {
				$.unblockUI();
			}).done(function(e) {
				if (e.code == 500) {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Process Add New Patient Fail, please try again',
						showConfirmButton: false,
						timer: 1500
					});
				} else if (e.code == 200) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Process add new patient success',
						showConfirmButton: false,
						timer: 1500
					});
				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Unknown response, please try again',
						showConfirmButton: false,
						timer: 1500
					});
				}

				closeFormAddNewPatient();
			});
		});
	});

	function showFormPatient() {
		$('#section_add_new_patient').show();
		setTimeout(function() {
			document.getElementById('section_add_new_patient').scrollIntoView(true);
		}, 300);
	}

	function closeFormAddNewPatient() {
		$('#section_add_new_patient').hide();
		setTimeout(function() {
			document.getElementById('section_registration_patient').scrollIntoView(true);
		}, 300);
	}
</script>