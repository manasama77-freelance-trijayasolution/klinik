<script>
	$(function() {
		$(".datepicker").datepicker();
	});

	function popup(b_id) {
		var myWindow = window.open("<?php echo base_url(); ?>registration/print_detail_regpatient/" + b_id, "", "width=800px, height=600px, top=0, left=80");
	}

	function popup_ms(b_id) {
		var myWindow = window.open("<?php echo base_url(); ?>patient/print_mark_sheet/" + b_id, "", "width=800px, height=600px, top=0, left=80");
	}

	function change_pat(b_id) {
		var myWindow = window.open("<?php echo base_url(); ?>registration/pat_update/" + b_id, "", "width=1200px, height=500px, top=70, left=80");
	}

	function change_reg(b_id) {
		var myWindow = window.open("<?php echo base_url(); ?>registration/reg_update/" + b_id, "", "width=1200px, height=500px, top=70, left=80");
	}

	function change_reg2(b_id) {
		var myWindow = window.open("<?php echo base_url(); ?>registration/registration_update/" + b_id, "", "width=1200px, height=500px, top=70, left=80");
	}

	function del_reg(id) {
		var r = confirm("Are You Sure ?");
		if (r == true) {
			// x = window.location = "<?php echo base_url(); ?>regreport/delete_reg/"+id+"";
			// alert('masuk delete_reg');
			$.post("delete_reg/" + id + "", $("#console").serialize()); // silent delete..
			document.getElementById("del" + id + "").disabled = true;
		} else {
			x = "You pressed Cancel!";
		}
	}
</script>

<div id="content">
	<div class="row-fluid">
		<!-- block -->
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><b>Data Registration</b></div>
			</div>
			<div class="form-actions"></div>

			<form class="form-horizontal" action="<?php echo base_url(); ?>regreport/reg_report" method="post" name="mst_service">
				<div class="control-group">
					<label class="control-label" for="id_reg1">ID Registration</label>
					<div class="controls">
						<input class="input-medium focused" name="id_reg1" type="text" id="id_reg1" autocomplete="off"> to
						<input class="input-medium focused" name="id_reg2" type="text" id="id_reg2" autocomplete="off">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="datereg1">Date Registration</label>
					<div class="controls">
						<input class="input-medium" name="datereg1" type="date" id="datereg1" autocomplete="off" value="<?= $datereg1; ?>">
						to
						<input class="input-medium" name="datereg2" type="date" id="datereg2" autocomplete="off" value="<?= $datereg2; ?>">
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" name="act" id="View" class="btn btn-success" value="View"><i class="icon-zoom-in"></i> <b>View</b></button>
					<button type="submit" name="act" id="Print" class="btn btn-success" value="Print"><i class="icon-print"></i> <b>Print</b></button>
				</div>
			</form>

			<div class="row-fluid">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left"><b>Registration Patient</b></div>
				</div>
				<div class="block-content collapse in">
					<div class="span12">
						<div class="table-toolbar">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>regreport/reg_report_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
									<li><a href="<?php echo base_url(); ?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
								</ul>
							</div>
							</br>
							</br>
						</div>
						<div id="" style="overflow-y: auto; height:auto;">

							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								<thead>
									<tr>
										<th>No.</th>
										<th>ID Registration</th>
										<th>Patient Name</th>
										<th>Date Registration</th>
										<!-- <th>Company Name</th> -->
										<!-- <th>Type</th> -->
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($trx_registration->result() as $row) {
									?>
										<tr class="odd gradeX">
											<td><?php echo $i++; ?></td>
											<td><?php echo $row->id_reg; ?><div style="float:right;">
													<?php
													if ($row->id_service == 0) { // Update untuk MCU
													?>
														<button onclick="change_reg('<?php echo $row->id_reg; ?>');" class="btn btn-info btn-mini" title="Update Registration"><i class="icon-edit"></i></button>
													<?php
													} else { // Update untuk Outpatient
													?>
														<button onclick="change_reg2('<?php echo $row->id_reg; ?>');" class="btn btn-info btn-mini" title="Update Registration"><i class="icon-edit"></i></button>
													<?php } ?>
											</td>

											<td><?php echo $row->pat_name; ?> <div style="float:right;"><button onclick="change_pat(<?php echo $row->pat_MRN; ?>);" class="btn btn-info btn-mini"><i class="icon-edit"></i></button></div>
											</td>
											<td><?php echo date("d.m.Y", strtotime($row->reg_date)); ?></td>
											<!-- 
									<td><?php echo $row->client_name; ?></td>
									<td><?php if ($row->id_service == 0) {
											echo "MCU";
										} else {
											echo "Outpatient";
										}
										?>
									</td> -->
											<td style="text-align: center;">
												<!-- <b>Marking Sheet</b> -->
												<!-- <button onclick="popup('<?php echo $row->id_reg; ?>');" class="btn btn-info btn-mini"><b>Print Registration</b></button> 
									<!-- <b>Registration</b> 
									<button onclick="popup_ms('<?php echo $row->id_reg; ?>');" class="btn btn-info btn-mini"><b>Print Marking Sheet</b></button> 
									<button title="Print Registration" onclick="popup('<?php echo $row->id_reg; ?>');" class="btn btn-success btn-mini" >
									<i class="icon-print"></i> 
									</button>
									<button  onclick="popup_ms('<?php echo $row->id_reg; ?>');" class="btn btn-warning btn-mini" title="Print Marking Sheet">
									<i class="icon-print"	></i> 
									</button> -->
												<button onclick="del_reg('<?php echo $row->id_reg; ?>');" id="del<?php echo $row->id_reg; ?>" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
												</button>
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
</div>
<link href="<?php echo base_url(); ?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">

<script src="<?php echo base_url(); ?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
<link href="<?php echo base_url(); ?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>design/assets/DT_bootstrap.js"></script>

<script src="<?php echo base_url(); ?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>design/assets/scripts.js"></script>