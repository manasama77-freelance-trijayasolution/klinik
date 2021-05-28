<?php
$id = $this->uri->segment(3);
if ($id == "ok") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Doctor Order.
	</div>
<?php
} else if ($id == "update") {
?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong> Update Marking Sheet Medical Check Up
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
?>

<!--/.fluid-container-->
<script src="<?php echo base_url(); ?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
<link href="<?php echo base_url(); ?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>design/assets/scripts.js"></script>
<script src="<?php echo base_url(); ?>design/assets/DT_bootstrap.js"></script>
<script>
	$(function() {
		$(".datepicker").datepicker();
	});


	function undisableTxt() {
		document.getElementById("myText123").disabled = false;
	}

	function goBack() {
		window.history.back();
	}

	function popup(b_id) {
		window.open("<?php echo base_url(); ?>patient/find_pat_doc", "Popup", "height=550, width=1025, top=70, left=180 ");
	}

	function popup_edit(b_id) {
		window.open("<?php echo base_url(); ?>patient/find_patient_mcu", "Popup", "height=auto,width=auto,scrollbars=1," +
			"directories=1,location=1,menubar=1," +
			"resizable=1 status=1,history=1 top = 50 left = 100");
	}

	function btntest_onclick() {
		window.location.href = "<?php echo base_url(); ?>lab/order_lab/edit";
	}
</script>
<div class="row-fluid">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left"><b>Report Expense</b></div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<form class="form-horizontal" action="<?php echo base_url(); ?>cashier/report_expense_excel" method="post" name="mst_pr">

					<div style="float:left;">

						<div class="control-group">
							<label class="control-label" for="focusedInput">From</label>
							<div class="controls">
								<input class="input-medium" name="datereg1" type="date" id="datereg1" autocomplete="off" value="<?= date("Y-m-d"); ?>">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="focusedInput">To</label>
							<div class="controls">
								<input class="input-medium" name="datereg2" type="date" id="datereg2" autocomplete="off" value="<?= date("Y-m-d"); ?>">
							</div>
						</div>

					</div>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success">Download Excel</button>
			<button type="button" class="btn btn-danger" onclick="generatePDF();">Download PDF</button>
		</div>
		</form>
	</div>
</div>


<link href="<?php echo base_url(); ?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">

<script src="<?php echo base_url(); ?>design/vendors/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>

<script>
	function generatePDF() {
		let datereg1 = $("#datereg1").val();
		let datereg2 = $("#datereg2").val();

		if (datereg1.length == 0) {
			alert("From Date Can't be Empty!");
		} else if (datereg2.length == 0) {
			alert("To Date Can't be Empty!");
		} else {
			window.open(`<?= site_url('cashier/report_expense_pdf'); ?>/${datereg1}/${datereg2}`, '_blank');
		}
	}
</script>