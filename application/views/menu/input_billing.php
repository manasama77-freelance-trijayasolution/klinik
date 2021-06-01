<?php
$id = $this->uri->segment(3);
if ($id == "ok") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Save Billing
	</div>
<?php
} else if ($id == "update") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Update Billing
	</div>
<?php
} else if ($id == "del") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Reset Billing
	</div>
<?php
}
?>
<?php if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?= $this->session->flashdata('success'); ?></strong>.
	</div>
<?php } ?>
<script>
	function undisableTxt() {
		document.getElementById("myText123").disabled = false;
	}

	function goBack() {
		window.history.back();
	}

	function popup(b_id) {
		window.open("<?php echo base_url(); ?>cashier/find_reg_patient", "Popup", "width=1200px, height=500px, top=70, left=80");
	}
</script>
<!-- morris stacked chart -->
<div class="row-fluid">
	<!-- block -->
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left"><b>Input Billing</b></div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<fieldset>

					<form class="form-horizontal" action="<?php echo base_url(); ?>cashier/input_billing_process" method="post" name="mark_mcu">

						<div class="control-group">
							<label class="control-label" for="focusedInput">ID Registration</label>
							<div class="controls">
								<input class="input-xlarge focused" name="id_reg" type="text" maxlength="0" autocomplete="off" required>
								<input name="id_pat" type="hidden" id="id_pat">
								<input name="reg_date" type="hidden" id="reg_date">
								<button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>
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

						<div class="control-group" style="display: none;">
							<label class="control-label" for="focusedInput">Client Name</label>
							<div class="controls">
								<input class="input-xlarge focused" name="client_name" type="hidden" id="myText03" readonly autocomplete="off">
								<input class="input-xlarge focused" name="id_client" type="hidden">
							</div>
						</div>

						<div class="control-group" style="display: none;">
							<label class="control-label" for="focusedInput">Package MCU</label>
							<div class="controls">
								<input class="input-xlarge focused" name="package_name" type="hidden" id="" readonly autocomplete="off">
								<input class="input-xlarge focused" name="id_package" type="hidden">
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-success">Search</button>
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
<script src="<?php echo base_url(); ?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
<link href="<?php echo base_url(); ?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>design/assets/scripts.js"></script>
<script src="<?php echo base_url(); ?>design/assets/DT_bootstrap.js"></script>