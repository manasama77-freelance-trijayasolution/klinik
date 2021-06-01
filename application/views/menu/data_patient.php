<?php
$id = $this->uri->segment(3);
if ($id == "ok") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Input Patient
	</div>
<?php
} else if ($id == "add") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Add New User
	</div>
<?php
} else if ($id == "del") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Delete User
	</div>
<?php
}
//Logic Parameter Button
if ($id == "ok" || $id == "reg") {
	$id = "0";
} elseif ($id == "") {
	$id = "1";
} elseif ($id == "edit") {
	$id = "2";
} else {
	$id = $id;
}
?>
<script>
	function undisableTxt() {
		if (0 == <?= $id; ?>) {
			window.location.href = "<?php echo base_url(); ?>patient/data_patient";
		};
		<?php
		$x = 1;
		while ($x <= 28) {
			echo "document.getElementById('" . $x . "').disabled = false;";
			$x++;
		}
		?>
	}

	function goBack() {
		window.history.back();
	}

	function fetch_select(val) {
		$.ajax({
			type: 'post',
			url: 'fetch_prov',
			data: {
				get_option: val
			},
			success: function(response) {
				document.getElementById("new_select").innerHTML = response;
			}
		});
	}
</script>
<?php
include './design/koneksi/file.php';
$query 		= "SELECT pat_mrn id,cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";
if ($result 	= mysqli_query($con, $query)) {
	//$date	=date('ym');
	$row 	= mysqli_fetch_assoc($result);
	$count 	= $row['id'];
	$counts	= substr($count, 1, strlen($count) - 1);
	//$dater 	=$row['dt'];
	//if ($dater == $date) {
	$counts = $counts + 1;
	//}else{
	//	$count = 1;
	//}		
	$code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);
}
?>
<!-- morris stacked chart -->
<div class="row-fluid">
	<div class="span12">
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><b>New Patient</b></div>
				<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
			</div>

			<!-- <div class="form-actions">
			<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button>
			<button class="btn btn-warning btn-large" onclick="goBack()"><b>Back</b></button>
		</div> -->

			<form class="form-horizontal" action="<?= base_url(); ?>patient/save_pat" method="post" name="quotation">
				<div class="block-content collapse in">
					<div class="span12">
						<div style="float:left;">
							<div class="control-group">
								<div class="controls">
									<input name="pat_mrn" type="hidden" value="<?= $loc; ?>">
									<input name="pat_contact_home[1]" type="hidden" value="" id="11">
									<input name="pat_contact_home[2]" type="hidden" value="" id="12">
									<input name="pat_email" type="hidden" value="" id="15">
									<input name="pat_nationality" type="hidden" value="" id="16">
									<input name="pat_address_home" type="hidden" value="" id="17">
									<input name="pat_province" type="hidden" value="" id="18">
									<input name="pos_code" type="hidden" value="" id="22">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="pat_idno">
									<b>ID Number</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input class="input-xlarge" placeholder="KTP, SIM, KITAS, PASSPORT" name="pat_idno" type="text" id="pat_idno" maxlength="20" autocomplete="off" required> -
									<select name="pat_idtype" id="2" style="width:110px" required>
										<option value="">Type</option>
										<option value="KTP">KTP</option>
										<option value="SIM">SIM</option>
										<option value="KITAS">KITAS</option>
										<option value="PASSPORT">PASSPORT</option>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="id_his">ID Medical Record</label>
								<div class="controls">
									<input class="input-xlarge" placeholder="Medical Record Number" name="id_his" type="text" id="id_his" maxlength="20" autocomplete="off">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="pat_name">
									<b>Patient Name</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input class="input-xlarge" style="text-transform: uppercase;" name="pat_name" type="text" id="4" autocomplete="off" required> -
									<select class="input-large" name="pat_title" id="pat_title" style="width:80px">
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
								<label class="control-label" for="pat_gender">
									<b>Gender</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<select name="pat_gender" id="pat_gender" required>
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
								<label class="control-label" for="pat_pob">
									<b>Place of Birth</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input class="input-xlarge" style="text-transform: capitalize;" name="pat_pob" type="text" id="pat_pob" autocomplete="off" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="reg_date">
									<b>Date of Birth</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input type="date" name="reg_date" class="input-large" id="reg_date" value="<?= date("Y-m-d"); ?>" required>
									<span><i class="icon-calendar"></i></span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="pat_marital_status">
									<b>Marital Status</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<select name="pat_marital_status" id="pat_marital_status" required>
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
								<label class="control-label" for="religion">
									<b>Religion</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input class="input-xlarge" style="text-transform: uppercase;" name="religion" type="text" id="religion" autocomplete="off" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="jobs">
									<b>Job</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input class="input-xlarge" style="text-transform: uppercase;" name="jobs" type="text" id="jobs" autocomplete="off" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="pat_contact_misc">
									<b>Mobile Phone</b>
									<span class="required">*</span>
								</label>
								<div class="controls">
									<input type="text" name="pat_contact_misc" maxlength="20" id="pat_contact_misc" placeholder="08XXXXXXXXXXXXXXXXXX" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="pat_rel_name">
									Relative Name
								</label>
								<div class="controls">
									<input class="input-xlarge" name="pat_rel_name" type="text" id="pat_rel_name" autocomplete="off">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="pat_rel_contact">Relative Phone</label>
								<div class="controls">
									<input class="input-xlarge focused" name="pat_rel_contact" type="text" id="pat_rel_contact" autocomplete="off">
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
									<input type="submit" class="btn btn-success" value="Save" onclick="this.disabled=true;this.form.submit();">
									<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-success"><b>Submit</b></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--/.fluid-container-->
<link href="<?php echo base_url(); ?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>design/assets/form-validation.js"></script>
<script src="<?php echo base_url(); ?>design/assets/scripts.js"></script>


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